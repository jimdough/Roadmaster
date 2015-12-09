<?PHP
if (mysql_num_rows ($event) == 0) {
	echo "<!--There are no events found-->";
}  // END IF

else { 
	echo "<!--Proceeding with Banner Build-->";
	$disp=0;   // has a banner been displayed
	$nextYear=date("Y")+1;
	$month=ltrim(date('m'), "0");
	
	// start while loop
	while($eventInfo = mysql_fetch_array($event))
			  {
		
		// start area code switch loop
		switch ($ac) {
		    
		    case $eventInfo['targetAreaCode1'];
		    case $eventInfo['targetAreaCode2'];
		    case $eventInfo['targetAreaCode3'];
		    case $eventInfo['targetAreaCode4'];
		    case $eventInfo['targetAreaCode5'];
		    
		    $endDate=0;
		    
		    if (!empty($eventInfo['eventDate5Month']))
		    {
		    		$endDate=$endDate+1;
		    }
		    
		    if (!empty($eventInfo['eventDate4Month']))
		    {
		    		$endDate=$endDate+1;
		    }
		    
		    if (!empty($eventInfo['eventDate3Month']))
		    {
		    		$endDate=$endDate+1;
		    }
		    
		    if (!empty($eventInfo['eventDate2Month']))
		    {
		    		$endDate=$endDate+1;
		    }
		    
		     if (!empty($eventInfo['eventDate1Month']))
		    {
		    		$endDate=$endDate+1;
		    }
		
			 if ($eventInfo['eventDate1Year']==date("Y"))	{
			 		if ($eventInfo['eventDate1Month']>=$month) 	{
			 				if ($eventInfo['eventDate1Day']+$endDate>date("d"))	   {
			 					if ($disp==0) {
				       					 include("MM/banner.php");
				       					 $disp++;
			       					 } } } 

			} elseif ($eventInfo['eventDate1Year']==$nextYear)	 {
			 	if ($disp==0) {
			 		include("MM/banner.php");
			 		 $disp++;
				} } 
			 
		        break;
		       
		} // END area code SWITCH
		
	}  // END WHILE LOOP
	
} // END ELSE

?>