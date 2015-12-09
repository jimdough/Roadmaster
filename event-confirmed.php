<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

 <head>
  <title>Confirmation - CDL Training and Truck Driving School - Roadmaster</title>
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
	   <img width="100%" data-interchange="[img/headers/ph-gen1-s.gif, (default)], [img/headers/ph-gen1-m.gif, (medium)], [img/headers/ph-gen1-l.gif, (large)]" alt="Page Header">
   </div>
   
      <!-- Small Nav-->
  	 <?php include("inc/small-nav.inc"); ?>
   <!-- END Small Nav -->
	
		<div class="row">
	  <!-- Column #1 -->
	  <div class="small-12 medium-7 large-8 columns editable" id="row-col1">
	  		
<h2><?PHP echo $recordInfo['eventName']; ?></h2>
<h3>Event Information</h3>
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

<div data-alert class="alert-box success radius">
  Your spot has been saved! We will see you there!
  <a href="#" class="close">&times;</a>
</div>
<br>
   <!-- Map -->
 <iframe
  width="750"
  height="300"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAs52q3vxBaFOt1sk1VjAN0DZ3sFGrnOeI&q=<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>+<?PHP echo $recordInfo['eventLocAdd1'] ?>+<?PHP echo $recordInfo['eventLocAdd2'] ?>+<?PHP echo $recordInfo['eventLocCity'] ?>+<?PHP echo $recordInfo['eventLocState'] ?>+<?PHP echo $recordInfo['eventLocZip'] ?>">
</iframe>


<?PHP include("MM/MM-dbClose.php"); ?>
</div> <!-- End Column 1-->

<!-- Column #2 -->
<div class="small-12 medium-5 large-4 columns">
	<?php include("right.inc"); ?>
</div>

	</div>
	
<div class="row" id="hpForm"><?php include("inc/small-call.inc"); ?>		<div class="panel radius">
			<?php include("inc/form.php"); ?>
		</div>
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