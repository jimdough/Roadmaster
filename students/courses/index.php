<?php

    define('CYPHER_KEY_TEXT', 'ymyzFuEz7k5TdzQANmq5ln/4mWOq9IpLEMNCO9ZAjCI=');
    
    define('COOKIE_NAME', 'rmcoursetok');
    
    define('COOKIE_PATH', '/');
    
    define('COOKIE_EXP_SECONDS', 3600);
    
    define('TOKEN_EXP_DAYS', 14);


    function exit404()
    {
        $headerMsg = $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found';
        header($headerMsg);
        echo $headerMsg;
        exit;
    }
    
    function exit403()
    {
        $headerMsg = $_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden';
        header($headerMsg);
        echo $headerMsg.' - Token invalid or expired';
        exit;
    }

    function getValidToken(DateTime $newExpDate = null)
    {
        $utcNow = new DateTime('Now', new DateTimeZone('UTC'));
        
        $cypher_iv = mcrypt_create_iv(32);
        
        $cypher_key = hash('sha256', CYPHER_KEY_TEXT, true);
        
        if(isset($newExpDate))
        {
            $dstr = $newExpDate->format('c');
            
            return base64_encode(
                mcrypt_encrypt(
                    MCRYPT_RIJNDAEL_256, 
                    $cypher_key, 
                    serialize(array(crc32($dstr), $dstr)), 
                    MCRYPT_MODE_ECB, 
                    $cypher_iv
                )
            );
        }
        

        if(isset($_GET['token']))
            $token_encrypted = $_GET['token'];
        elseif(isset($_COOKIE[COOKIE_NAME]))
            $token_encrypted = $_COOKIE[COOKIE_NAME];
        
        if(!isset($token_encrypted))
            return null;
        
        $token_serial = trim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_256,
                $cypher_key,
                base64_decode($token_encrypted),
                MCRYPT_MODE_ECB,
                $cypher_iv
        ));
        
        if(!$token_serial)
            return null;
        
        $token_data = @unserialize($token_serial);
        
        if(!(is_array($token_data) && count($token_data) == 2))
            return null;
        
        $token_crc = $token_data[0];
        
        $token_expstr = $token_data[1];
        
        if($token_crc !== crc32($token_expstr))
            return null;
            
        try {
            $token_expdate = new DateTime($token_expstr, new DateTimeZone('UTC'));
        } catch(Exception $e) {
            return null;
        }
        
        if($utcNow > $token_expdate)
            return null;
            
        return $token_encrypted;
    }
    
    
    function setTokenAsCookie($token)
    {
        $expire = isset($token)
            ? time() + COOKIE_EXP_SECONDS
            : time() - 3600;
        
        setcookie(COOKIE_NAME, $token, $expire, COOKIE_PATH);
    }
    
    
    function passthruFile()
    {
        $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $document_root = realpath($_SERVER['DOCUMENT_ROOT']);
        
        $requested_file = realpath($document_root . urldecode($request_path));
        
        if(!$requested_file)
            return false;
        
        $request_inside_docroot = !(strncasecmp($document_root, $requested_file, strlen($document_root)));
        
        if(!$request_inside_docroot)
            return false;
        
        if($requested_file == realpath(__FILE__))
            return false;
        
        if(!is_file($requested_file))
            return false;
        
        readfile($requested_file);
        
        return true;
    }
    
    
    if(!isset($_GET['generate']))
    {
        require_once('cpt/school_ips.php');
        
        $ips = new cpt\school_ips();
        
        if(!$ips->client_ip_is_school())
        {
            if(!($token = getValidToken()))
                exit403();
        
            if(isset($_GET['token']))
                setTokenAsCookie($token);
        }

        if(!passthruFile())
            exit404();
    }
    else
    {
        $expdate = new DateTime('Now', new DateTimeZone('UTC'));
        
        if(isset($_GET['xs']))
            $expdate->add(new DateInterval('PT'.$_GET['xs'].'D'));
        else $expdate->add(new DateInterval('P'.TOKEN_EXP_DAYS.'D'));
        
        $newtoken = getValidToken($expdate);
    }

?>
<?php if(isset($_GET['generate'])): ?>
<html>
    <head>
        <title></title>
    </head>
    <body style="margin-left:10em">
        <form style="visibility:hidden" action="/students/courses">
            <label>Days before URL expires: </label><input type="text" name="xs" value="<?php echo @$_GET['xs']; ?>" />
            <input type="hidden" name="generate" value="" />
            <input type="submit" value="Create URL" />
        </form>
        <br/>
        <br/>
        <h3>This page generated the following link:</h3>
        <h2><a href="<?php echo '/students/courses/permitprep/story.html?token='.urlencode($newtoken); ?>">Click here to take the Roadmaster CDL Permit Preparation Course</a></h2>
        <h3></h3>
        <h3>This URL is only valid for <?php echo TOKEN_EXP_DAYS; ?> days from TODAY (until <?php echo $expdate->format('m/d/Y'); ?>)</h3>
        <h3>Copy and paste this URL into an email to the student</h3>
        <h3>Come back tomorrow for another <?php echo TOKEN_EXP_DAYS; ?> day link</h3>
    </body>
</html>
<?php endif; ?>