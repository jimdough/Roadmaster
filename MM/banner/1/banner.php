<div id="localEventBanner">
	<div class="headline"><a href="/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>"><?PHP echo $eventInfo['eventName'] ?></a></div>
	<div class="dateTime"><?PHP echo $eventInfo['eventDate1DayName'] . ", " . $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] . " from " .  $eventInfo['eventTime1Hour'] . ":" .  $eventInfo['eventTime1Minutes'] . " " . $eventInfo['eventTime1AMPM'] . " until " .  $eventInfo['eventTime1EndHour'] . ":" .  $eventInfo['eventTime1EndMinutes'] . " " . $eventInfo['eventTime1EndAMPM']  ?></div>
	
	<div class="description">
	<?PHP 
		echo substr($eventInfo['eventDesc'], 0, 120); 
		
		if (strlen($eventInfo['eventDesc'])>120)
			echo(" . . . ");
	?>
	</div>
	
	<div class="address"><?PHP echo $eventInfo['eventLocAdd1'] ?><?php if( !empty( $eventInfo['eventLocAdd2']  ) ): ?><?PHP echo " | " . $eventInfo['eventLocAdd2'] . " " ?><?php endif; ?> <?PHP echo $eventInfo['eventLocCity'] ?>, <?PHP echo $eventInfo['eventLocState'] ?> <?PHP echo $eventInfo['eventLocZip'] ?></div>
	<div class="cta"><a href="/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>">Reserve your spot by clicking here!</a></div>
</div>