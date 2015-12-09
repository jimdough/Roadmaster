<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Roadmaster Truck Driving & CDL Training School</title>

  <!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  <link rel="stylesheet" href="styles.css" />
  <script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

  <!-- body content here -->

  <div class="row">
  	  <div class="large-12 columns">
  	  	<div class="panel radius">
  	  			<h1>Partner Referral</h1>

  	  	<div id="form">
	  	  		<form data-abide action="http://www.roadmaster.com/common/form/leadform.php" method="post">
                <input type="hidden" name="LeadType" value="CTR"/>
                <input type="hidden" name="SourceName" value="AIT Referral"/>
                <input type="hidden" name="SuccessPage" value="/confirmationCTR.php"/>
                <input type="hidden" name="ErrorPage" value="/error.php"/>
                <input type="hidden" name="EmailOptIn" value="1"/>
                <input type="hidden" name="HasCDL" value="1"/>
		  	  	<fieldset>
			  	<div class="row">
			      <div class="large-6 columns">
			        <label>First Name</label>
			        <input name="FirstName" required type="text" id="FirstName" placeholder="First Name">
			        <small class="error">Your first name is required.</small>
			      </div>
			      <div class="large-6 columns">
			        <label>Last Name</label>
			        <input name="LastName" required type="text" id="LastName" placeholder="Last Name">
			        <small class="error">Your last name is required.</small>
			      </div>
			    </div>

			    <div class="row">
			      <div class="large-6 columns">
			        <label>Phone Number</label>
			        <input name="Phone" type="text" required id="Phone" placeholder="555-555-1212">
			        <small class="error">A valid phone number is required.</small>
			      </div>
			      <div class="large-6 columns">
			        <label>E-Mail Address</label>
			        <input name="EmailAddress" type="email" required id="EmailAddress" placeholder="email@somewhere.com">
			        <small class="error">A valid email address is required.</small>
			      </div>
			    </div>

			    <div class="row">
			      <div class="large-2 columns">
			        <label>Zip Code</label>
			        <input name="ZipCode" type="text" required id="ZipCode" placeholder="55555">
			        <small class="error">Your zip code is required.</small>
			      </div>

			      <div class="large-4 columns">
			        <label>Lead Type</label>
			        <input type="radio" name="leadType" value="new" id="new" checked><label style="display:inline;" checked for="new"> New Lead</label>&nbsp;&nbsp;&nbsp;
					<input type="radio" name="leadType" value="old" id="old"><label style="display:inline;" for="old"> Recirculated</label>
			      </div>

			      <div class="large-6 columns">
					  <input type="submit" value="Submit" style="width:100%;" class="button success radius" />
			      </div>
			    </div>

			    </form>
			    <div class="row" id="disclaimer">By submitting this form you are expressly consenting to our <a style="text-decoration:underline;" href="http://www.roadmaster.com/terms-of-use.php" target="_blank">Terms of Use</a> and that you may be contacted by a representative via telephone, email or SMS Text</div>
  	  	</div>

  	  	</div>
  	  </div><!-- end column-->
  </div><!-- end row-->


  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>

  <script src="js/foundation.min.js"></script>

  <script>
    $(document).foundation();
  </script>

  <!-- Google Analytics Tracking Code-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-317493-11', 'auto');
  ga('send', 'pageview');

</script>
<!-- END Google Analytics Tracking Code-->


</body>
</html>
