<script type="text/javascript">
  $(function(){
    $foobar({
      "position" : {
        "bar" : "top",
        "button" : "left",
        "social" : "right"
      },
      
      "width": {
 	   "left": "0",
 	   "center": "90%",
 	   "right": "0",
 	   "button": "80px"
    },
  
  		"social":{
	  		"text" : "RSVP NOW"
  		},
  
      "display" : {
      	"button": {
		  	"type": "close"
		  },
		"theme": {
			"bar": "triangle-arrow"
	  },
	  
	  "cookie":{
		  "enabled" : "true"
	  },
	  
        "type" : "delayed",
        "delay" : 1000,
        "backgroundColor" : "red",
        "border" : "none"
      },
      
      "message":{
	      "delay" : 4000,
	      "navigation" : true
      },

      "scroll":{
	      "enabled": true
      },
      
      "messages": [ 
        "<b><a href='/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>'><?PHP echo $eventInfo['eventName'] ?></a></b> - <?PHP echo $eventInfo['eventDate1DayName'] . ", " . $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] . " from " .  $eventInfo['eventTime1Hour'] . ":" .  $eventInfo['eventTime1Minutes'] . " " . $eventInfo['eventTime1AMPM'] . " until " .  $eventInfo['eventTime1EndHour'] . ":" .  $eventInfo['eventTime1EndMinutes'] . " " . $eventInfo['eventTime1EndAMPM']  ?> at <?PHP echo $eventInfo['eventLocAdd1'] ?><?php if( !empty( $eventInfo['eventLocAdd2']  ) ): ?><?PHP echo " | " . $eventInfo['eventLocAdd2'] . " " ?><?php endif; ?> <?PHP echo $eventInfo['eventLocCity'] ?>, <?PHP echo $eventInfo['eventLocState'] ?> - <a href='/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>'>RSVP</a>", 
        
        "<?PHP echo substr($eventInfo['eventDesc'], 0, 2000); ?>",
        
        <?PHP if ($disp==1) { echo '"Additional Events are scheduled for your area - <a href=#>Click Here</a>"';
			     $disp++;
		 } ?>
		 
      ],
          });	});
</script>