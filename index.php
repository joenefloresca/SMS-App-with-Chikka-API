<html>
<head>
<!-- META TAGS -->
<meta charset="UTF-8">
<meta name="description" content="Send SMS using Chikka API">
<meta name="keywords" content="SMS,Chikka,Text">
<meta name="author" content="Joene Floresca">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body background="backgrounds/bg.jpg">
	<div class="container" id="container">
		<div class="row">
		  <div class="col-xs-6 col-md-12">
		  	<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h1 class="panel-title">Send SMS | BETA</h1>
				  </div>
				  <div class="panel-body">
				    <form action="process.php" method="post" name="myForm" id="myForm" onsubmit="return validateCapcha()">
						<input type="text" name="number" id="number" class="form-control" placeholder="Enter Number | eg. 639491111111" required /><br />
						<textarea rows="4" name="msg" id="msg" class="form-control" placeholder="Enter Message" required></textarea><br />
						<input type="text" name="capcha" id="capcha" class="form-control" placeholder="Enter Capcha" required/><br />
						<?php
							 session_start();
							 include("simple-php-captcha.php");
							 $_SESSION['captcha'] = simple_php_captcha();
							 echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" /> <br />';
						?>
						<button type="submit" class="btn btn-primary" name="submit">
							Send SMS
						</button>

					</form>
				  </div>
			   </div>
		  </div>
		</div>
	</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- Live Validation -->
<script src="js/livevalidation_standalone.compressed.js"></script>
<script type="text/javascript">

 //  	var f1 = new LiveValidation('number');
	// f1.add( Validate.Presence );
	// f1.add( Validate.Numericality );

	// var f2 = new LiveValidation('msg');
	// f2.add( Validate.Presence );

	// var f3 = new LiveValidation('capcha');
	// f3.add( Validate.Presence );
</script>
<script type="text/javascript">
	function validateCapcha()
	{
		var capcha = "<?php echo $_SESSION['captcha']['code']; ?>";
		var input =  document.forms["myForm"]["capcha"].value;

		if(capcha != input)
		{
			alert("Incorrect Capcha!");
			return false;
		}
	
	}
</script>
</body>
</html>