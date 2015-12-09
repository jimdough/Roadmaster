<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

 <head>
  <title>Upcoming Events at our CDL Training and Truck Driving School - Roadmaster</title>
  <meta name="DESCRIPTION" content="Roadmaster is a hands on truck driving school & Class A CDL license training center that provides complete truck driver training across the USA">
  
  <?php include("inc/head.inc"); ?>
  <!-- End Scripts -->
  <?php 
		
	include("MM/MM-dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $_GET['eventID'] . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $recordInfo['flyer'] . " ' ");
	$selectedFlyer = mysql_fetch_array($flyer);

?>

 </head>
 <body>
 <?php include("inc/analytics.inc"); ?>

<!-- OFFCANVAS MENU -->
<div class="off-canvas-wrap row" data-offcanvas>

  <div class="inner-wrap"> <!-- All Content in Here -->
  
 <nav class="tab-bar">
      <section class="left-small">
        <a class="left-off-canvas-toggle" href="#"><i class="fi-align-left"></i><span></span></a>
      </section>

	  <!-- Include Nav -->
	  <?php include("inc/nav.inc"); ?>

      <section class="right-small">
        <a class="right-off-canvas-toggle" href="#"><i class="fi-align-right"></i><span></span></a>
      </section>
    </nav>

  <aside class="left-off-canvas-menu">
 	 <?php include("inc/left-nav.inc"); ?>
   </aside>

  <aside class="right-off-canvas-menu">
	  <?php include("inc/right-nav.inc"); ?>
   </aside>
   
   <div class="row center">
	   <img width="100%" data-interchange="[img/headers/ph-gen3-S.gif, (default)], [img/headers/ph-gen3-M.gif, (medium)], [img/headers/ph-gen3-L.gif, (large)]" alt="Class A CDL License Training and Truck Driving Classes">
	      </div>
   
      <!-- Small Nav-->
  	 <?php include("inc/small-nav.inc"); ?>
   <!-- END Small Nav -->
	
		<div class="row">
	  <!-- Column #1 -->
	  <div class="small-12 medium-12 large-8 columns editable" id="row-col1">
	  		
<h2><?PHP echo $recordInfo['eventName']; ?></h2>
<h3>Event Information</h3>
<p><?PHP echo $recordInfo['eventDesc']; ?></p>

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
</ul>

<h3>Event Date and Time</h3>

<ul>
	<li><?PHP echo $recordInfo['eventDate1DayName'] . ", " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] . " at " . $recordInfo['eventTime1Hour'] . ":" . $recordInfo['eventTime1Minutes'] . $recordInfo['eventTime1AMPM'] . " until " . $recordInfo['eventTime1EndHour'] . ":" . $recordInfo['eventTime1EndMinutes'] . $recordInfo['eventTime1EndAMPM'] ; ?></li>
</ul>

<h3>Event Details</h3>

<div class="row">

	<div class="column small-12 large-7 medium-6">
		<ul>
			<li><b>Location Name:</b> <?PHP echo $recordInfo['eventLocationName']; ?></li>
			<li><b>RSVP Phone:</b> <?PHP echo $recordInfo['rsvpPhone']; ?></li>
			<li><b>RSVP Email:</b> <a href="mailto:<?PHP echo $recordInfo['rsvpEmail']; ?>?SUBJECT=<?PHP echo $recordInfo['eventName']; ?> RSVP"><?PHP echo $recordInfo['rsvpEmail']; ?></a></li>
				<li><b>Event Address:</b><br>
				<?PHP echo $recordInfo['eventLocAdd1'];
				
				if( !empty( $recordInfo['eventLocAdd2']  ) )
				 echo "<br>" . $recordInfo['eventLocAdd2'];
				 
				 echo "<br>" . $recordInfo['eventLocCity'] . ", " . $recordInfo['eventLocState'] . " " . $recordInfo['eventLocZip'] ;?></li>
		</ul>
	</div><!-- End Internal Col 1 -->

	<div class="column small-12 large-5 medium-6">		 
		<div class="panel radius">
			<ul>
				<li><a target="_blank" href="http://maps.google.com/maps?daddr=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>">Directions to the event</a></li>
				<li><a href="<?PHP echo $schoolInfo['schoolURL'] ?>">School Website</a></li>
				<li><a target="_blank" href="http://do.convertapi.com/web2pdf?curl=http://www.roadmaster.com/eventmanager/flyers/<?PHP echo $recordInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $recordInfo['id']; ?>&OutputFileName=EventFlyer&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=2&PageSize=letter&ApiKey=225522257&PageOrientation=<?PHP echo $selectedFlyer['orientation']; ?>">Save Flyer as PDF</a></li>
				<li><a href="event-listings.php">View All Listings</a></li>
			</ul>
		</div><!-- End Panel -->
	</div><!-- End Internal Col 2 -->

</div><!-- End Internal Row -->

   
<!-- End Map -->

<h3>Reserve Your Spot Today</h3>
<p>Reserve your spot at this special event today to make sure we don't run out of seats!</p>
<!-- RSVP Form -->
<div class="panel">
 <form data-abide action="http://mm.careerpathtraining.com/eventManager/functions/rsvp.php" method="post" name="rsvpForm" id="rsvpForm">
                <input type="hidden" name="event" value="<?PHP echo $_GET['eventID']; ?>" />
                <input type="hidden" name="date" value="<?PHP echo date("m/d/Y"); ?>" />
                <input type="hidden" name="eventName" value="<?PHP echo $recordInfo['eventName']; ?>" />
                <input type="hidden" name="eventDate" value="<?PHP echo $recordInfo['eventDate1DayName'] . ", " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year']; ?>" />
                <input type="hidden" name="rsvpEmail" value="<?PHP echo $recordInfo['rsvpEmail']; ?>" />
                <div class="row">
                	<div class="column large-6 medium-6 small-12">
	                	<label>First Name
	                		<input name="firstName" type="text" id="firstName" size="14" required/>
	                	</label>
	                	<small class="error">First Name is required</small>
                	</div>
                	
                	<div class="column large-6 medium-6 small-12">
	                	 <label>Last Name
						 	<input name="=lastName" type="text" id="lastName" size="14" required/>
	                	</label>
	                	<small class="error">Last Name is required</small>
                	</div>
                </div><!-- END Row -->
                
                <div class="row">
                	<div class="column large-6 medium-6 small-12">
	                	<label>Phone
	                		<input name="phone" type="text" id="phone" size="14" maxlength="14" />
	                	</label>
                	</div>
                	<div class="column large-6 medium-6 small-12">
	                	 <label>E-Mail
						 	<input name="email" type="text" id="email" size="14" maxlength="40" required pattern="email"/>
	                	</label>
	                	<small class="error">E-Mail is required</small>
                	</div>
                </div><!-- END Row -->

				<div class="row">
                	<div class="column large-12 medium-12 small-12">
						<input type="submit" value="Save My Spot!" style="width:100%;" class="button alert radius" />
                	</div>
				</div>
                </form>
		</div>
<!-- END RSVP Form -->
   <!-- Map -->
<!-- <iframe
  width="756"
  height="300"
  frameborder="1" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAs52q3vxBaFOt1sk1VjAN0DZ3sFGrnOeI&q=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>+<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>">
</iframe>-->


<?PHP include("MM/MM-dbClose.php"); ?>
</div> <!-- End Column 1-->

	</div>


  <a class="exit-off-canvas"></a><?php include("inc/quick-nav.inc"); ?>
	   	</div> <!-- End off-canvas-wrap row -->
 
   <!-- END PAGE WRAP-->
   <div class="row" id="footer">
   		<?php include("inc/footer.inc"); ?>
   </div>
   <?php include("inc/footer-scripts.inc"); ?>

 </body>
</html>