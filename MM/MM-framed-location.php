<?PHP

	include("MM-dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$count=1;
	$limit=10;
	$rows=0;	
	
	for ($month=ltrim(date('m'), "0"); $month<=12; $month++)	{             // START FOR LOOP - Loop through each month
	
	$record = mysql_query("SELECT * FROM event_em WHERE approvalStatus='1' AND calendarToggle='1' AND eventDate1Year='" . date('Y') ."' AND eventDate1Month = '" . $month . "' ORDER BY eventDate1Day+0") or die(mysql_error());

	while($recordInfo = mysql_fetch_array($record))	 {         //START WHILE LOOP - Loop through each event

	if ($count<=$limit)	{
			
  	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
		
	  echo "<tr><td>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "</td>" ;
	  echo "<td>" . $recordInfo['eventName'] . "</td>";
	  echo "<td><a href='event-view.php?eventID=" . $recordInfo['id'] .  "'>Attend</a></td></tr>";
				  
	  $count++;	
		    	}    // END IF LOOP
		    	
		    		}  // END IF AND WHILE LOOP

		 }     // CLOSE FOR LOOP
		 		    
 include("MM-dbClose.php"); ?>