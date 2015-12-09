<?PHP

	include("MM-dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$count=1;
	$limit=100;
	$rows=0;	
	
	echo "<table style='margin:auto;' width='100%'>";
	
	echo "<tr><td><b>Date</b></td><td><b>Location</b></td><td class='hide-for-small-only'><b>Event</b></td><td><b>RSVP</b></td></tr>";
	
	$year = date('Y');
	
	for ($month=ltrim(date('m'), "0"); $month<=12; $month++)	{             // START FOR LOOP - Loop through each month
	
	$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . date('Y') ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0") or die(mysql_error());


	while($recordInfo = mysql_fetch_array($record))	 {         //START WHILE LOOP - Loop through each event
			
  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
		
	  echo "<tr><td nowrap>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] ;
		
	  echo "</td><td nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $schoolInfo['city'] . ", " . $schoolInfo['state'] . "</a></td>";
	  
	  echo "<td class='hide-for-small-only' nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $recordInfo['eventName'] . "</a></td>";
	  
	  echo "<td nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>Details</a></td></tr>";
				  
	  $count++;	
		    	
		    		}  // END IF AND WHILE LOOP

		 }     // CLOSE FOR LOOP
		 
		 $year = $year+1;
		 
		 	for ($month=ltrim(date('m'), "0"); $month<=12; $month++)	{             // START FOR LOOP - Loop through each month
		 	
	$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . $year ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0") or die(mysql_error());

	while($recordInfo = mysql_fetch_array($record))	 {         //START WHILE LOOP - Loop through each event
			
  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
		
     echo "<tr><td nowrap>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] ;
		
	  echo "</td><td nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $schoolInfo['city'] . ", " . $schoolInfo['state'] . "</a></td>";
	  
	  echo "<td class='hide-for-small-only' nowrap><a href='MM/MM-event-view.php?eventID=" . $recordInfo['id'] .  "'>" . $recordInfo['eventName'] . "</a></td>";
	  
	  echo "<td class='hide-for-small-only' nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>View Details & RSVP</a></td></tr>";
	  
	  echo "<td class='hide-for-medium-up' nowrap><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>Details</a></td></tr>";
				  
	  $count++;	
		    	
		    		}  // END IF AND WHILE LOOP

		 }     // CLOSE FOR LOOP
		 
		
		echo "</table>";
		    
 include("MM-dbClose.php"); ?>
	
