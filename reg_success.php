<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"><title>SAT+SMTv2</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css" type="text/css" />
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/lib/w3-colors-2017.css">

	<style>
		div {
		   	margin-left : auto;
			margin-right : auto;
		}
		footer {
			position: absolute;
			right: 0;
			bottom: 0;
			left: 0;
			padding: 1rem;
		}

		@media screen and (max-width: 480px) {
			.w3-content{
				max-width:100%;
			}
		}
		@media screen and (min-width: 480px) {
			.w3-content{
				max-width:75%;
			}
			.webmaster{
				float:right;
			}
		}
	</style>

	<div id="topContainer" class="w3-container w3-theme-d4 w3-top">
		<div class="w3-container w3-theme-d4 w3-border-bottom w3-mobile">
		<div id="topBand" class="w3-container w3-theme-d4 w3-hide-small" style="width:75%">
			<a target="_blank" href="https://indico.tifr.res.in/indico/conferenceDisplay.py?confId=5062" class="w3-button w3-padding-12 w3-theme-light w3-hover-blue-gray w3-right w3-margin-right">First SAT+SMT</a>
			<a href="/" class="w3-button w3-theme-d4 w3-hover-blue-gray"><i class="fa fa-home w3-xlarge"></i></a>
			<a href="/#contact" class="w3-button w3-theme-d4 w3-hover-blue-gray"><i class="fa fa-envelope w3-large"></i></a>
		</div>
		<div id="topBand" class="w3-container w3-theme-d4 w3-hide-medium w3-hide-large">
			<a target="_blank" href="https://indico.tifr.res.in/indico/conferenceDisplay.py?confId=5062" class="w3-button w3-padding-6 w3-theme-light w3-hover-blue-gray w3-right">First SAT+SMT</a>
			<a href="/" class="w3-button w3-theme-d4 w3-hover-blue-gray"><i class="fa fa-home w3-large"></i></a>
			<a href="/#contact" class="w3-button w3-theme-d4 w3-hover-blue-gray"><i class="fa fa-envelope w3-medium"></i></a>
		</div>
		</div>
		
		<div class="w3-container w3-theme-d4 w3-padding-16 w3-xxlarge w3-hide-small w3-hide-medium w3-mobile" style="width:75%">
			The Second Indian SAT+SMT School
		</div>
		<div class="w3-container w3-theme-d4 w3-padding-16 w3-xlarge w3-hide-large w3-mobile" style="width:75%">
			The Second Indian SAT+SMT School
		</div>
	</div>

	<div id="secondBand" class="w3-container w3-theme-l4 w3-border-bottom w3-border-blue-gray w3-mobile">
		<div class="w3-container w3-theme-l4" style="width:75%">
			<font color=#000033>06-08 December 2017<br>Mysore, Karnatka<br></font><font color=#808080 size=2>Asia/Kolkata timezone</font>
		</div>
	</div>

</head>

<body>

<?php

	session_start();

	if (isset($_SESSION['ref'])){
		$line1 = "Registration Successfull.";
		$line2 = "Reference No. ";
		$line3 = $_SESSION['ref'];
		$line4 = "Please note the reference number for all future communications";

		unset($_SESSION['ref']);
	} else {
		$line1 = "Registration Failed.";
		$line2 = "";
		$line3 = "";
		$line4 = "Please try again.";
	}

	if (isset($_SESSION['mailsuccess'])){
		$ms = $_SESSION['mailsuccess'];
		if ($ms == 1)
			$line5 = "A confirmation mail has been sent to your email address.";
		else if ($ms == 0)
			$line5 = "Failed to send confirmation email. Please contact webmaster.";
	}

	session_destroy();

?>
	
<div class="w3-container content w3-center w3-margin w3-padding-64">
	<p><font color="red">Do not press back or refresh button</font></p><br>
	<b><br><?php echo $line1; ?>
	<p><?php echo $line2; ?><font color="red"><?php echo $line3 ?></font><br><?php echo $line4 ?></p>
	<p><br><?php echo $line5; ?></p></b>
	<p><br><br><a href="/" class="w3-btn w3-blue-grey w3-margin w3-center">Return to Site</a></p>
</div>

<div class="w3-container w3-theme-l2 w3-padding-16 w3-hide-large">
	©2017 Sat-Smt School
	<a href="mailto:webmaster@/?subject=The Second Indian SAT+SMT School " class="webmaster">webmaster</a>
</div>
<footer class="w3-container w3-theme-l2 w3-padding-16 w3-bottom w3-hide-small w3-hide-medium">
	©2017 Sat-Smt School
	<a href="mailto:webmaster@/?subject=The Second Indian SAT+SMT School " class="webmaster">webmaster</a>
</footer>

</body>
</html>

<script>
window.onscroll = function() {scrollFunction()};
window.onload = function() {loadFunction()};
window.onresize = function() {resizeFunction();}

function loadFunction() {
	var h = document.getElementById("topContainer").offsetHeight;
	document.getElementById("secondBand").style.marginTop = h.toString() + "px";
}

function resizeFunction() {
	var h = document.getElementById("topContainer").offsetHeight;
	document.getElementById("secondBand").style.marginTop = h.toString() + "px";
}
</script>