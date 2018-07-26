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
		.error{
			color:red;
		}

		@media screen and (max-width: 480px) {
			.content{
				max-width:100%;
			}
		}
		@media screen and (min-width: 480px) {
			.content{
				max-width:75%;
			}
			.webmaster{
				float:right;
			}
		}
	</style>
</head>

<body>

<?php

if (!isset($_SESSION)) {
	session_start();
}


$nameErr = $brandErr = $modelErr = $serialErr = "";
$name = $brand = $model = $serial = "";

$success_message = "";
$iserror = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && isset($_SESSION)) {
	if (empty($_POST["name"])) {
		$nameErr = "*Required Field";
		$iserror = 1;
	} else {
		$name = convert($_POST["name"]);
	}

	if (empty($_POST["brand"])) {
		$brandErr = "*Required Field";
		$iserror = 1;
	} else {
		$brand = convert($_POST["brand"]);
	}

	if (empty($_POST["model"])) {
		$modelErr = "*Required Field";
		$iserror = 1;
	} else {
		$model = convert($_POST["model"]);
	}

	if (empty($_POST["serial"])) {
		$serialErr = "*Required Field";
		$iserror = 1;
	} else {
		$serial = convert($_POST["serial"]);
	}

	if ($iserror == 0){
		$name = str_replace(',',';',$name);
		$brand = str_replace(',',';',$brand);
		$model = str_replace(',',';',$model);
		$serial = str_replace(',',';',$serial);

		$record = $name; $record .= ',';
		$record .= $brand; $record .= ',';
		$record .= $model; $record .= ',';
		$record .= $serial;

		$val = explode(",",$record);

		$fp = fopen("laptop_details.csv","a");
		fputcsv($fp,$val);
		fclose($fp);

		$nameErr = $brandErr = $modelErr = $serialErr = "";
		$name = $brand = $model = $serial = "";

		$success_message = "Laptop details recorded successfully!!";
	}

}

function convert($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>



	<div id="topContainer" class="w3-container w3-theme-d4 w3-top">
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

	<div class="w3-container content" style="margin-top:70px">
		<label class="w3-text-green w3-center"><b><?php echo $success_message;?></b></label>
		<p>
		Please provide the make, model and serial no. of your laptops that you would bring along, to help us manage the hands-on sessions better.</p><br>
	</div>


	<div class="w3-container content w3-border" style="margin-bottom:70px">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<p>
		<label>Participant's Name</label>
		<input name="name" class="w3-input" type="text" value="<?php echo $name;?>">
		<label class="error w3-margin-0"><?php echo $nameErr;?></label></p>
	
		<p><br>
		<label>Laptop's Brand</label>
		<input name="brand" class="w3-input" type="text" value="<?php echo $brand;?>">
		<label class="error w3-margin-0"><?php echo $brandErr;?></label></p>

		<p><br>
		<label>Laptop's Model</label>
		<input name="model" class="w3-input" type="text" value="<?php echo $model;?>">
		<label class="error w3-margin-0"><?php echo $modelErr;?></label></p>

		<p><br>
		<label>Laptop's Serial No.</label>
		<input name="serial" class="w3-input" type="text" value="<?php echo $serial;?>">
		<label class="error w3-margin-0"><?php echo $serialErr;?></label></p>
		
		<input type="submit" name="submit" value="Submit" class="w3-btn w3-blue-grey w3-margin">
	</form>
	</div>
	
	<footer class="w3-container w3-theme-l2 w3-padding-16" style="z-index:3; position:relative">
		©2017 Sat-Smt School
		<a href="mailto:webmaster@sat-smt.in?subject=The Second Indian SAT+SMT School " class="webmaster">webmaster</a>
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

	showref();
}

function resizeFunction() {
	var h = document.getElementById("topContainer").offsetHeight;
	document.getElementById("secondBand").style.marginTop = h.toString() + "px";
}

</script>