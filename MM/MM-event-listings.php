<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="canonical" href="/MM/MM-event-listings.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="DESCRIPTION" CONTENT="Roadmaster is a truck driving school and CDL training center with schools across the united states that holds hiring events and special events.">
<title>Upcoming School Events - Roadmaster</title>
<?php include("../inc/head-subdirectory.inc"); ?>
</head>

<body>
<div id="interiorWrapper">
	<div id="menu">
	<?php include("../inc/menu.inc"); ?>
	</div>

  <div id="content">

<!-- Top Page Content Starts Here -->
<img src="/images/event-listings.jpg" alt="Truck Driving School Hiring Events"><br>
<h1>Listing of Special Events at Roadmaster's locations</h1>
  
<div id="listingsInternal">

<?PHP

	include("MM-dbOpen.php"); 

	mysql_select_db ($database,$con);

	for ($month=ltrim(date('m'), "0"); $month<=12; $month++)	{             // START FOR LOOP - Loop through each month
	
	$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . date('Y') ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0");
	
		
	echo "<h2>Upcoming Events in " . $month . "/" . date('Y') . "</h2>"; 	
	echo '<div class="header"><span class="eventDate">Date</span><span class="schoolName">School Name</span><span class="eventName">Event Name</span></div>';

			while($recordInfo = mysql_fetch_array($record))	 {         //START WHILE LOOP - Loop through each event
			
			  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
				$schoolInfo = mysql_fetch_array($school);
		
	echo "<div class='entry'><span class='eventDate'>" . $recordInfo['eventDate1DayName'] . " " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] ;
	
	if (!empty($recordInfo['eventDate2DayName']))
	echo " to <br>";

	 if (!empty($recordInfo['eventDate5DayName']))
	  	echo $recordInfo['eventDate5DayName'] . " " . $recordInfo['eventDate5Month'] . "/" . $recordInfo['eventDate5Day'] . "/" . $recordInfo['eventDate5Year'];

	 elseif (!empty($recordInfo['eventDate4DayName']))
		echo $recordInfo['eventDate4DayName'] . " " . $recordInfo['eventDate4Month'] . "/" . $recordInfo['eventDate4Day'] . "/" . $recordInfo['eventDate4Year'];
		
	 elseif (!empty($recordInfo['eventDate3DayName']))
		echo $recordInfo['eventDate3DayName'] . " " . $recordInfo['eventDate3Month'] . "/" . $recordInfo['eventDate3Day'] . "/" . $recordInfo['eventDate3Year'];
		
	 elseif (!empty($recordInfo['eventDate2DayName']))
		echo $recordInfo['eventDate2DayName'] . " " . $recordInfo['eventDate2Month'] . "/" . $recordInfo['eventDate2Day'] . "/" . $recordInfo['eventDate2Year'];
					 
	  echo "</span><span class='schoolName'>" . $schoolInfo['schoolName'] . "<br><a href='MM-event-view.php?eventID=" . $recordInfo['id'] .  "'>Click here for details</a></span>";
	  echo "</span><span class='eventName'>" . $recordInfo['eventName'] . "</span>";
	  echo "</div>";
				  	
		    	}  // END WHILE LOOP

	 }     // CLOSE FOR LOOP


	 ///// BEGIN NEXT YEAR /////
	
	$year=date('Y')+1;
		    
	 for ($month=1; $month<=12; $month++)	{      // START FOR LOOP - Loop through each month
	 
			$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . $year ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0");
			
			$returned_rows = mysql_num_rows ($record);
			if ($returned_rows == 0){
    				
			}else{
   				 echo "<h2>Upcoming Events in " . $month . "/" . $year . "</h2>"; 
				 echo '<div class="header"><span class="eventDate">Date</span><span class="schoolName">School Name</span><span class="eventName">Event Name</span></div>';
			}
	
			while($recordInfo = mysql_fetch_array($record))	 {   //START WHILE LOOP - Loop through each event
	  	
		  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
			$schoolInfo = mysql_fetch_array($school);
	
			echo "<div class='entry'><span class='eventDate'>" . $recordInfo['eventDate1DayName'] . " " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] ;
	
			if (!empty($recordInfo['eventDate2DayName']))
			echo " to <br>";
		
			 if (!empty($recordInfo['eventDate5DayName']))
			  	echo $recordInfo['eventDate5DayName'] . " " . $recordInfo['eventDate5Month'] . "/" . $recordInfo['eventDate5Day'] . "/" . $recordInfo['eventDate5Year'];
		
			 elseif (!empty($recordInfo['eventDate4DayName']))
				echo $recordInfo['eventDate4DayName'] . " " . $recordInfo['eventDate4Month'] . "/" . $recordInfo['eventDate4Day'] . "/" . $recordInfo['eventDate4Year'];
				
			 elseif (!empty($recordInfo['eventDate3DayName']))
				echo $recordInfo['eventDate3DayName'] . " " . $recordInfo['eventDate3Month'] . "/" . $recordInfo['eventDate3Day'] . "/" . $recordInfo['eventDate3Year'];
				
			 elseif (!empty($recordInfo['eventDate2DayName']))
				echo $recordInfo['eventDate2DayName'] . " " . $recordInfo['eventDate2Month'] . "/" . $recordInfo['eventDate2Day'] . "/" . $recordInfo['eventDate2Year'];
					 
			  echo "</span><span class='schoolName'>" . $schoolInfo['schoolName'] . "<br><a href='MM-event-view.php?eventID=" . $recordInfo['id'] .  "'>Click here for details</a></span>";
			  echo "</span><span class='eventName'>" . $recordInfo['eventName'] . "</span>";
			  echo "</div>";
			  }  // END WHILE LOOP

		    }     // CLOSE FOR LOOP
		    
 include("MM-dbClose.php"); ?>
	
</div>

<!-- Top Page Content Ends Here -->



<!-- QuickForm Starts Here -->

<div id="quickformINT">
<div id="quickFormHeader"><span class="left">Get Started Today</span><span class="right">Call Roadmaster at 1-800-831-1300</span></div>
<?php include("../inc/quickFormInterior.inc"); ?>
</div>

 
 
</div>
<?php include("../inc/footer.inc"); ?>
</div>


<?php include("../analytics.inc"); ?>
</body>
</html>
