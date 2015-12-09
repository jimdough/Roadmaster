
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Banner Test</title>

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link href="/common/inc/rm/styles.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Oswald" rel='stylesheet' type='text/css'>

<?PHP
include("eventManager/inc/dbOpen.php"); 
mysql_select_db ($database,$con);

$event = mysql_query("SELECT * FROM event_em WHERE id=' " . $_GET['eventID'] . " ' "); 
$eventInfo = mysql_fetch_array($event);
include("/eventManager/banner/1/banner.php");

?>

<link href="custom.css" rel="stylesheet" type="text/css" /></head>
<body>
<table border="0" cellspacing="0" cellpadding="0" id="hpInterior">
  <tr><td colspan="2" valign="top" id="topInterior"><div id="interiorLogo"><a href="default.php"><img src="images/interiorHeaderLogo.jpg" border="0" alt="Roadmaster Drivers School" title="Roadmaster Drivers School" /></a></div></td></tr>
  <tr><td colspan="2" valign="top" height="85"><div id="menuInterior"><?php include("rm/menu.inc"); ?></div></td></tr>
  <tr>
    <td width="141" id="hpInteriorLeft" valign="top"><div class="urbangreymenuInterior"><?php include("rm/locations.inc"); ?></div></td>
    <td id="content" width="777" valign="top"><div id="socialInterior"><?php include("rm/social.inc"); ?></div>
    <!-- Insert Content Here-->
<p>In in nibh at neque euismod laoreet in vitae nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel rutrum elit. Etiam volutpat, mi id convallis pretium, eros urna iaculis massa, eu faucibus turpis ipsum et erat. Donec tortor nisl, egestas at tristique nec, eleifend sed velit. Nullam ligula justo, laoreet quis congue at, eleifend id elit. Fusce elit ipsum, sagittis sit amet pharetra ac, lacinia at augue. Duis rutrum sem libero, vitae tempus arcu. Vestibulum vulputate vestibulum cursus. Aliquam erat volutpat. Vivamus suscipit mollis est, at tempus urna mattis vitae. Nullam rutrum accumsan velit, quis sagittis metus molestie vel.</p>

<p>Etiam consequat enim vitae arcu dapibus eu malesuada massa porta. Integer iaculis, nibh in semper posuere, dui nulla consectetur metus, vitae blandit velit mi id augue. Proin id neque vel erat interdum ultricies. Mauris in enim ut ante rhoncus ultricies. Integer aliquam, purus vel sagittis iaculis, leo tellus feugiat diam, nec tempus nisl urna eu eros. Nam sit amet ante ac erat semper ullamcorper. Integer nec diam purus. Ut auctor lorem sed mi ornare ut dictum risus interdum. Morbi aliquam suscipit auctor. Nam non risus quis neque bibendum laoreet.</p>

<p>Vestibulum velit eros, vehicula eget feugiat in, vehicula sed nunc. In dignissim, risus vel iaculis viverra, dolor est ullamcorper libero, a mattis neque arcu dapibus turpis. Vivamus vel dolor sed massa hendrerit vestibulum. Duis at leo est, vitae pretium nisl. Pellentesque turpis neque, ullamcorper non venenatis a, laoreet quis arcu. In sed tempus lacus. Praesent eu placerat enim. Curabitur sodales bibendum sapien, sit amet rutrum ante luctus at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum fermentum dignissim metus, molestie aliquet elit posuere sit amet. Mauris quis dui et libero consectetur molestie ac vel justo. Pellentesque tristique ligula quis justo ultricies nec sollicitudin eros venenatis. Aenean purus turpis, semper sit amet ultrices nec, euismod dapibus massa. Maecenas laoreet, nunc non tempor ultricies, sapien purus porttitor nunc, id accumsan metus nunc eget sapien.</p>

<p>Etiam at mattis ligula. Integer sed orci at ipsum dictum gravida. Cras elementum odio enim. In pulvinar urna non massa ultricies sodales. Praesent et eros quis purus cursus lobortis ut mattis magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pulvinar, lectus vel rutrum dictum, dolor justo porttitor mi, nec eleifend lectus ante sit amet tellus. Praesent eu vestibulum felis. Pellentesque feugiat pharetra commodo. Cras consequat ligula at felis suscipit eu placerat magna venenatis. Quisque pellentesque urna a magna aliquam quis tempus nisi malesuada. Mauris in tellus et sem tincidunt faucibus et quis nisi. Phasellus pharetra imperdiet nisl, quis tristique erat accumsan id. Praesent elit mi, auctor vulputate molestie at, ultrices eu ligula. Curabitur at tellus vel odio faucibus ultricies. Cras ut suscipit erat.</p>

<p>Aenean sit amet erat id dui consequat sollicitudin. In ultricies, tortor quis pharetra interdum, risus metus malesuada eros, non semper metus eros ac est. Sed tortor turpis, semper nec fermentum eu, viverra ut mi. Pellentesque rhoncus ultrices ipsum congue eleifend. Aenean id ante neque. Proin eu tortor vel felis luctus porta nec at arcu. Maecenas odio urna, aliquam quis ornare eget, rhoncus et augue. Donec in arcu id dolor vestibulum commodo eu vel ligula. Nam dui nibh, malesuada quis interdum non, tincidunt quis dui. Vivamus eu ante felis, id suscipit velit. Maecenas at tempor metus. Nulla est tortor, eleifend sed faucibus eu, varius eu dolor.</p>


     <!-- End Content Here-->
    </td>
  </tr>
  <tr>
  <td width="141" class="hpInteriorLeft"></td>
  <td align="center"><div id="quickForm"><?php include("rm/quickFormInterior.inc"); ?></div></td>
  </tr>
</table>
<?php include("rm/footer.inc"); ?>
</body>
</html>
