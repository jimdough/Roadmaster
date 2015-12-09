<?PHP

	include("MM-dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$count=1;
	$limit=6;
	$rows=0;	
	
	echo "<table id='eventListings'>";
	
	for ($month=ltrim(date('m'), "0"); $month<=12; $month++)	{             // START FOR LOOP - Loop through each month
	
	$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . date('Y') ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0") or die(mysql_error());

	while($recordInfo = mysql_fetch_array($record))	 {         //START WHILE LOOP - Loop through each event

	if ($count<=$limit)	{
			
  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
		
	echo "<tr><td valign=top>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] ;
		
	  echo "</td><td nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $recordInfo['eventName'] . "</a><br>";
	  echo "<a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $schoolInfo['city'] . ", " . $schoolInfo['state'] . "</a></td><td valign='top'><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>View</a></td></tr>";
				  
	  $count++;	
		    	}    // END IF LOOP
		    	
		    		}  // END IF AND WHILE LOOP

		 }     // CLOSE FOR LOOP
		 


	 ///// BEGIN NEXT YEAR /////
	
	$year=date('Y')+1;
		    
	 for ($month=1; $month<=12; $month++)	{      // START FOR LOOP - Loop through each month
	 
			$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . $year ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0") or die(mysql_error()); 

			while($recordInfo = mysql_fetch_array($record))	 {   //START WHILE LOOP - Loop through each event
			
			if ($count<=$limit)	{
	  	
		  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
			$schoolInfo = mysql_fetch_array($school);
	
			echo "<tr><td nowrap>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] ;

					 
	  echo "</td><td nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $schoolInfo['city'] . ", " . $schoolInfo['state'] . "</a></td>";
	  echo "<td><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $recordInfo['eventName'] . "</a></td>";
	 			  
			  $count++;	
		    		}    // END IF LOOP
			  
			  }  // END WHILE LOOP

		    }     // CLOSE FOR LOOP

		
		echo "</table>";
		    
 include("MM-dbClose.php"); ?>
	
