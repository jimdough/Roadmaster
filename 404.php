<?php

    $notfound_uri = $_SERVER['REDIRECT_SCRIPT_URL'];
    
    $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $hostname = $_SERVER['HTTP_HOST'];
    $port = (($port = (int)$_SERVER['SERVER_PORT']) == 80) ? '' : ":$port";
    
    $homepage = $protocol . $hostname . $port;
    
?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"> 
<html>
    <head>
        <meta http-equiv="REFRESH" content="10;url=<?php echo htmlspecialchars($homepage); ?>">
        <title>Error - Roadmaster Drivers School - Page Not Found</title> 
    </head>
<body style="padding:2em;">
<p>
    <h3>Sorry!</h3>
    <p>The resource you requested: &quot;<em><?php echo htmlspecialchars($notfound_uri); ?></em>&quot; could not be located.</p>
    <p>You will be redirected to the <a href="<?php echo htmlspecialchars($homepage); ?>">homepage</a> in a few moments.</p>
</p>
</body>
</html> 
