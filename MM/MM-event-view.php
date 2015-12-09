<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Information - Roadmaster Drivers School</title>
<?php include("../inc/head-subdirectory.inc"); ?>
</head>

<body>
<div id="interiorWrapper">
	<div id="menu">
	<?php include("../inc/menu.inc"); ?>
	</div>

  <div id="content">

<!-- Top Page Content Starts Here -->
  
<?php 
		
	include("MM-dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $_GET['eventID'] . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $recordInfo['flyer'] . " ' ");
	$selectedFlyer = mysql_fetch_array($flyer);

?>

<div id="viewInternal">

<div id="rsvpLeft">

<h1><?PHP echo $recordInfo['eventName']; ?></h1>
<h2>Event Information</h2>
<p class="desc"><?PHP echo $recordInfo['eventDesc']; ?></p>
<ul>
<?php if( !empty( $recordInfo['eventHighlight1']  ) ): ?>
	<li><?PHP echo $recordInfo['eventHighlight1'] ?></li>
<?php endif; ?>

<?php if( !empty( $recordInfo['eventHighlight2']  ) ): ?>
	<li><?PHP echo $recordInfo['eventHighlight2'] ?></li>
<?php endif; ?>
	
<?php if( !empty( $recordInfo['eventHighlight3']  ) ): ?>	
	<li><?PHP echo $recordInfo['eventHighlight3'] ?></li>
<?php endif; ?>
	
<?php if( !empty( $recordInfo['eventHighlight4']  ) ): ?>	
	<li><?PHP echo $recordInfo['eventHighlight4'] ?></li>
<?php endif; ?>
	
<?php if( !empty( $recordInfo['eventHighlight5']  ) ): ?>	
	<li><?PHP echo $recordInfo['eventHighlight5'] ?></li>
<?php endif; ?>

<?php if( !empty( $recordInfo['eventHighlight6']  ) ): ?>	
	<li><?PHP echo $recordInfo['eventHighlight6'] ?></li>
<?php endif; ?>
</ul>

<h2>Event Date(s) and Time(s)</h2>

<ul>
	<li><?PHP echo $recordInfo['eventDate1DayName'] . ", " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] . " at " . $recordInfo['eventTime1Hour'] . ":" . $recordInfo['eventTime1Minutes'] . $recordInfo['eventTime1AMPM'] . " until " . $recordInfo['eventTime1EndHour'] . ":" . $recordInfo['eventTime1EndMinutes'] . $recordInfo['eventTime1EndAMPM'] ; ?></li>
	
	<?php if( !empty( $recordInfo['eventDate2DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate2DayName'] . ", " . $recordInfo['eventDate2Month'] . "/" . $recordInfo['eventDate2Day'] . "/" . $recordInfo['eventDate2Year'] . " at " . $recordInfo['eventTime2Hour'] . ":" . $recordInfo['eventTime2Minutes'] . " " . $recordInfo['eventTime2AMPM']  . " until " . $recordInfo['eventTime2EndHour'] . ":" . $recordInfo['eventTime2EndMinutes'] . $recordInfo['eventTime2EndAMPM'] ; ?></li>
	<?php endif; ?>
	
	<?php if( !empty( $recordInfo['eventDate3DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate3DayName'] . ", " . $recordInfo['eventDate3Month'] . "/" . $recordInfo['eventDate3Day'] . "/" . $recordInfo['eventDate3Year'] . " at " . $recordInfo['eventTime3Hour'] . ":" . $recordInfo['eventTime3Minutes'] . " " . $recordInfo['eventTime3AMPM'] . " until " . $recordInfo['eventTime3EndHour'] . ":" . $recordInfo['eventTime3EndMinutes'] . $recordInfo['eventTime3EndAMPM']  ; ?></li>
	<?php endif; ?>

	<?php if( !empty( $recordInfo['eventDate4DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate4DayName'] . ", " . $recordInfo['eventDate4Month'] . "/" . $recordInfo['eventDate4Day'] . "/" . $recordInfo['eventDate4Year'] . " at " . $recordInfo['eventTime4Hour'] . ":" . $recordInfo['eventTime4Minutes'] . " " . $recordInfo['eventTime4AMPM'] . " until " . $recordInfo['eventTime4EndHour'] . ":" . $recordInfo['eventTime4EndMinutes'] . $recordInfo['eventTime4EndAMPM']  ; ?></li>
	<?php endif; ?>

	<?php if( !empty( $recordInfo['eventDate5DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate5DayName'] . ", " . $recordInfo['eventDate5Month'] . "/" . $recordInfo['eventDate5Day'] . "/" . $recordInfo['eventDate5Year'] . " at " . $recordInfo['eventTime5Hour'] . ":" . $recordInfo['eventTime5Minutes'] . " " . $recordInfo['eventTime5AMPM'] . " until " . $recordInfo['eventTime5EndHour'] . ":" . $recordInfo['eventTime5EndMinutes'] . $recordInfo['eventTime5EndAMPM']  ; ?></li>
	<?php endif; ?>

</ul>

<h2>Event Details</h2>
<ul>
	<li><b>RSVP Phone:</b> <?PHP echo $recordInfo['rsvpPhone']; ?></li>
	<li><b>RSVP Email:</b> <a href="mailto:<?PHP echo $recordInfo['rsvpEmail']; ?>?SUBJECT=<?PHP echo $recordInfo['eventName']; ?> RSVP"><?PHP echo $recordInfo['rsvpEmail']; ?></a></li>
	<li><b>Location Name:</b> <?PHP echo $recordInfo['eventLocationName']; ?></li>
		<li><b>Event Address:</b><br>
		<?PHP echo $recordInfo['eventLocAdd1'];
		
		if( !empty( $recordInfo['eventLocAdd2']  ) )
		 echo "<br>" . $recordInfo['eventLocAdd2'];
		 
		 echo "<br>" . $recordInfo['eventLocCity'] . ", " . $recordInfo['eventLocState'] . " " . $recordInfo['eventLocZip'] ;?></li>
		 
	<li><a target="_blank" href="http://maps.google.com/maps?daddr=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>">Directions to the event</a></li>
	<li><a href="<?PHP echo $schoolInfo['schoolURL'] ?>">School Website</a></li>
	<li><a target="_blank" href="http://do.convertapi.com/web2pdf?curl=http://www.roadmaster.com/eventmanager/flyers/<?PHP echo $recordInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $recordInfo['id']; ?>&OutputFileName=EventFlyer&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=2&PageSize=letter&ApiKey=225522257&PageOrientation=<?PHP echo $selectedFlyer['orientation']; ?>">Save Flyer as PDF</a></li>
<li><a href="/MM/MM-event-listings.php">View All Listings</a></li>

</ul>		

</div>

</div>

<div id="rsvpRight">

<div id="rsvpFormWrap">
                <form action="http://mm.careerpathtraining.com/eventManager/functions/rsvp.php" method="post" name="rsvpForm" id="rsvpForm">
                <input type="hidden" name="event" value="<?PHP echo $_GET['eventID']; ?>" />
                <input type="hidden" name="date" value="<?PHP echo date("m/d/Y"); ?>" />
                <input type="hidden" name="eventName" value="<?PHP echo $recordInfo['eventName']; ?>" />
                <input type="hidden" name="eventDate" value="<?PHP echo $recordInfo['eventDate1DayName'] . ", " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year']; ?>" />
                <input type="hidden" name="rsvpEmail" value="<?PHP echo $recordInfo['rsvpEmail']; ?>" />
                <div class="label">First Name </div><div class="input"><input name="firstName" type="text" id="firstName" size="14" class="required"/></div>
                <div class="label">Last Name </div><div class="input"><input name="lastName" type="text" id="lastName" size="14" class="required" /></div>
                <div class="label clear">Phone </div><div class="input"><input name="phone" type="text" id="phone" size="14" maxlength="14" /></div>
                <div class="label">E-Mail </div><div class="input"><input name="email" type="text" id="email" size="14" maxlength="40" class="required email"/></div>
                <div class="submit clear"><input name="Submit" type="image" value="Submit" src="/images/rsvpFormButton.png" /></div>
                </form>
</div>
<div id="rsvpMap"><img border="0" src="http://maps.googleapis.com/maps/api/staticmap?center=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>&markers=color:red%7Clabel:%7C<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>&zoom=14&size=250x250&maptype=roadmap&sensor=false" alt="Event Location" /></div>

<div id="rsvpMapInfo">
<h2>Event Address</h2><p><b><?PHP echo $recordInfo['eventLocAdd1'] . "<br>" . $recordInfo['eventLocAdd2'] . "<br>" . $recordInfo['eventLocCity'] . ", " . $recordInfo['eventLocState'] . " " . $recordInfo['eventLocZip'] ;?></b></p>
<p><a target="_blank" href="http://maps.google.com/maps?daddr=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>">Directions to the event</a></li></p>
</ul>
</div>
</div>

<?PHP include("MM-dbClose.php"); ?>
<!-- Top Page Content Ends Here -->
<!-- QuickForm Starts Here -->

<div id="quickformINT">
<div id="quickFormHeader"><span class="left">Get Started Today</span><span class="right">Call Roadmaster at 1-800-831-1300</span></div>
<?php include("../inc/quickFormInterior.inc"); ?>
</div>

<!-- QuickForm Ends Here -->

 <!-- Bottom Page Content Ends Here -->
  
</div>
<?php include("../inc/footer.inc"); ?>
</div>


<?php include("../analytics.inc"); ?>
</body>
</html>
