<?php
include("MM/MM-dbOpen.php"); 
include("MM/geoipcity.inc");
include("MM/geoipregionvars.php");

mysql_select_db ($database,$con);

$gi = geoip_open("MM/GeoLiteCity.dat",GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];
$record = geoip_record_by_addr($gi,$ip);

//if(!empty($_GET["mode"]))	{
//	$ac = $record->area_code;
	$ac = 999;
	echo "<!--Area Code Detected:" . $ac . "-->";
	geoip_close($gi);
	$event = mysql_query("SELECT * FROM event_em WHERE approvalStatus=1 AND bannerToggle=1 ORDER BY eventDate1Year, eventDate1Month+0, eventDate1Day+0 ASC");  
	include("MM/MM-bannerConfig.php");
//}

?>