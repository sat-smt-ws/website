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


$fnameErr = $lnameErr = $affErr = $curposErr = $add1Err = $cityErr = $pinErr = $countryErr = $phErr = $emailErr = $urlErr = $refnameErr = $refemailErr =  $relErr = $motErr =  "";
$fname = $lname = $aff = $curpos = $add1 = $add2 = $city = $pin = $country = $ph = $email = $url = $dietres = $refname = $refemail = $rel = $mot = "";
$acc = "y";
$refcat = "uninv";

$iserror = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && isset($_SESSION)) {
	if (empty($_POST["fname"])) {
		$fnameErr = "*Required Field";
		$iserror = 1;
	} else {
		$fname = convert($_POST["fname"]);
		if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
	  		$fnameErr = "Use only letters"; 
	  		$iserror = 1;
		}
	}

	if (empty($_POST["lname"])) {
		$lnameErr = "*Required Field";
		$iserror = 1;
	} else {
		$lname = convert($_POST["lname"]);
		if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
	  		$lnameErr = "Use only letters"; 
	  		$iserror = 1;
		}
	}

	if (empty($_POST["aff"])) {
		$affErr = "*Required Field";
		$iserror = 1;
	} else {
		$aff = convert($_POST["aff"]);
	}

	if (empty($_POST["curpos"])) {
		$curposErr = "*Select an option";
		$iserror = 1;
	} else {
		$curpos = convert($_POST["curpos"]);
	}

	if (empty($_POST["add1"])) {
		$add1Err = "*Required Field";
		$iserror = 1;
	} else {
		$add1 = convert($_POST["add1"]);
	}

	$add2 = $_POST["add2"];

	if (empty($_POST["city"])) {
		$cityErr = "*Required Field";
		$iserror = 1;
	} else {
		$city = convert($_POST["city"]);
	}

	if (empty($_POST["pin"])) {
		$pinErr = "*Required Field";
		$iserror = 1;
	} else {
		$pin = convert($_POST["pin"]);
	}

	if (empty($_POST["country"])) {
		$countryErr = "*Select an option";
		$iserror = 1;
	} else {
		$country = convert($_POST["country"]);
	}

	if (empty($_POST["ph"])) {
		$phErr = "*Required Field";
		$iserror = 1;
	} else {
		$ph = convert($_POST["ph"]);
	}  

	if (empty($_POST["email"])) {
		$emailErr = "*Required Field";
		$iserror = 1;
	} else {
		$email = convert($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  		$emailErr = "Invalid email format"; 
	  		$iserror = 1;
		}
	}

	if (empty($_POST["url"])) {
		$url = "";
	} else {
		$url = convert($_POST["url"]);
		// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
	  		$urlErr = "Invalid URL"; 
	  		$iserror = 1;
		}
	}

	$acc = convert($_POST["acc"]);

	$dietres = convert($_POST["dietres"]);

	$refcat = convert($_POST["refcat"]);

	if ($refcat == "ref"){
		if (empty($_POST['refname'])){
			$refnameErr = "*Required Field";
			$iserror = 1;
		} else {
			$refname = convert($_POST["refname"]);
		}

		if (empty($_POST['refemail'])){
			$refemailErr = "*Required Field";
			$iserror = 1;
		} else {
			$refemail = convert($_POST["refemail"]);
		}

		if ($curpos == "MS" || $curpos == "PS" || $curpos == "PD"){
			if (empty($_POST["rel"])) {
				$relErr = "*Required Field";
				$iserror = 1;
			} else {
				$rel = convert($_POST["rel"]);
				$word_count = str_word_count($rel);
				if ($word_count > 205){
					$relErr = "*Word limit exceeded";
					$iserror = 1;
				}
			}

			if (empty($_POST["mot"])) {
				$motErr = "*Required Field";
				$iserror = 1;
			} else {
				$mot = convert($_POST["mot"]);
				$word_count = str_word_count($mot);
				if ($word_count > 505){
					$motErr = "*Word limit exceeded";
					$iserror = 1;
				}
			}
		}
	}
	if ($refcat == "uninv"){
		if (empty($_POST["rel"])) {
			$relErr = "*Required Field";
			$iserror = 1;
		} else {
			$rel = convert($_POST["rel"]);
			$word_count = str_word_count($rel);
			if ($word_count > 205){
				$relErr = "*Word limit exceeded";
				$iserror = 1;
			}
		}

		if (empty($_POST["mot"])) {
			$motErr = "*Required Field";
			$iserror = 1;
		} else {
			$mot = convert($_POST["mot"]);
			$word_count = str_word_count($mot);
			if ($word_count > 505){
				$motErr = "*Word limit exceeded";
				$iserror = 1;
			}
		}
	}

	if ($iserror == 0){
		$fp = fopen("id.txt","r");
		fscanf($fp,"%d",$i);
		fclose($fp);

		$id = $i + 1;

		$fp = fopen("id.txt","w");
		fwrite($fp,$id);
		fclose($fp);

		$array = array(
			"MS" => "Masters Student",
			"PS" => "PhD Student",
			"PD" => "PostDoc",
			"JF" => "Junior Faculty",
			"SF" => "Senior Faculty",
			"GL" => "Government Labs",
			"WI" => "Working in Industry"
		);

		$refarray = array(
			"inv" => "Invited",
			"ref" => "Referred",
			"uninv" => "Uninvited"
		);

		$address = $add1; $address .= '-';
		$address .= $add2; $address .= '-';
		$address .= $city; $address .= '-';
		$address .= $country; $address .= '-';
		$address .= $pin;

		$address = str_replace(',',';',$address);
		$aff = str_replace(',',';',$aff);
		$url = str_replace(',',';',$url);
		$dietres = str_replace(',',';',$dietres);
		$refname = str_replace(',',';',$refname);
		$rel = str_replace(',',';',$rel);
		$mot = str_replace(',',';',$mot);

		$record = $id; $record .= ',';
		$record .= $fname; $record .= ',';
		$record .= $lname; $record .= ',';
		$record .= $aff; $record .= ',';
		$record .= $array[$curpos]; $record .= ',';
		$record .= $address; $record .= ',';
		$record .= $ph; $record .= ',';
		$record .= $email; $record .= ',';
		$record .= $url; $record .= ',';
		$record .= $acc; $record .= ',';
		$record .= $dietres; $record .= ',';
		$record .= $refarray[$refcat]; $record .= ',';
		$record .= $refname; $record .= ',';
		$record .= $refemail; $record .= ',';
		$record .= $rel; $record .= ',';
		$record .= $mot;

		$val = explode(",",$record);

		$fp = fopen("registration_record.csv","a");
		fputcsv($fp,$val);
		fclose($fp);

		//confirmation email
		$to = $email;
		$subject = "Successful registration to SATSMT2017 school";
		$message = "
					<html>
					<body>
						Dear " . $fname . " " . $lname . ",
						<p>You have Successfully registered for SAT SMT School 2017.</p>
						<p>Please note your reference no: <b>satsmt" . $id . "</b>. Use the reference no. for all future communications.</p>
						<p>Please note that the submission of the form is not the final registration. We will notify you soon about the acceptance.</p>
						<p>Since we  have limited space, we can not promise automated acceptance. We will evaluate all the applicants and try to accept as many applicants as possible.</p>
						<p>Registration of academics is free. The registration fee for the industry/government labs participants is Rs. 10,000, which is for supporting similar events and the money will be donated to IARCS. We will ask for the payment of the fee only after accepting the registration.</p>
						<p><br>Best Wishes<br>Team SATSMT-2017</p>
					</body>
					</html>
					";
		$headers = "Content-type: text/html; charset=iso-8859-1" . "\r\n" . "From: SATSMT2017 <indian.satsmt.school@gmail.com>" . "\r\n" .
					"CC: indian.satsmt.school@gmail.com";

		if (mail($to,$subject,$message,$headers)){
			$mailsuccess = 1;
		} else {
			$mailsuccess = 0;
		}

		$refno = "satsmt";
		$refno .= $id;
		$_SESSION['ref'] = $refno;
		$_SESSION['mailsuccess'] = $mailsuccess;
		header("Location: reg_success.php");
		exit();
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

	<!--/div-->

	<div class="w3-container content w3-text-red" style="margin-top:70px">
		Please note that the registrations have closed for students, Ph.D.s, PostDocs and Faculty members. The registrations remain open for participants from Government Labs and Industry.
	</div>
	<div class="w3-container content" style="margin-top:70px">
		Please fill the following form to register (if you have received an invitation email) or apply (if you have not received an invitation email for the school.  All attendees are required to register.
		<p>Since we have limited space, we cannot promise automated acceptance to those who are applying without an invitation. All such applications will be evaluated, and we will try to accept as many applicants whose work and interests match the goals of the school.</p>
		<p>Registration of academics is free. The registration fee for industry/government lab participants is Rs. 10,000 per person. This amount is intended for supporting this and similar events; the fee will be donated to the <a href="http://www.iarcs.org.in/">Indian Association for Research in Computing Sciences (IARCS)</a>, the parent body under whose aegis this school is being conducted.  For applicants from industry/government labs, the fee payment is required only after your registration is accepted by the organizers.</p>
		<p><i>Note that: In case you haven't received an invitation email, submission of your application is not the final registration. All such applicants will be notified of the acceptance or otherwise of their application after 22nd October.</i></p>
	</div>

	<div class="w3-container content w3-theme w3-border" style="margin-top:70px">
  		<h3>Registration Form</h3>
	</div>

	<div class="w3-container content w3-border" style="margin-bottom:70px">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<p>
		<label>First Name</label>
		<input name="fname" class="w3-input" type="text" value="<?php echo $fname;?>">
		<label class="error w3-margin-0"><?php echo $fnameErr;?></label></p>
		
		<p><br>
		<label>Last Name</label>
		<input name="lname" class="w3-input" type="text" value="<?php echo $lname;?>">
		<label class="error w3-margin-0"><?php echo $lnameErr;?></label></p>
		
		<p><br>
		<label>Affiliation</label>
		<input name="aff" class="w3-input" type="text" value="<?php echo $aff;?>">
		<label class="error w3-margin-0"><?php echo $affErr;?></label></p>
		
		<p><br>
		<label>Current Position</label>
		<select id="curpos" name="curpos" class="w3-select w3-white" value="<?php $curpos;?>">
			<option value="" disabled selected>Choose your option</option>
			<option value="GL" <?php if ($curpos == "GL") echo "selected"; ?>>Government Labs (participation fee applicable)</option>
			<option value="WI" <?php if ($curpos == "WI") echo "selected"; ?>>Working in Industry (participation fee applicable)</option>
		</select>
		<label class="error w3-margin-0"><?php echo $curposErr;?></label></p>

		<p><br>
		<label>Address</label>
		<input name="add1" class="w3-input" type="text" placeholder="Address line 1" value="<?php echo $add1;?>">
		<label class="error w3-margin-0"><?php echo $add1Err;?></label><br>
		<input name="add2" class="w3-input" type="text" placeholder="Address line 2 (optional)" value="<?php echo $add2;?>"><br>
		<div class="w3-row-padding">
			<div class="w3-third">
				<input name="city" class="w3-input" type="text" placeholder="City" value="<?php echo $city;?>">
				<label class="error w3-margin-0"><?php echo $cityErr;?></label>
			</div>
			<div class="w3-third">
				<input name="pin" class="w3-input" type="number" placeholder="Pincode" value="<?php echo $pin;?>">
				<label class="error w3-margin-0"><?php echo $pinErr;?></label>
			</div>
			<div class="w3-third">
				<select name="country" class="w3-select w3-white" value="<?php $country;?>">
				<option value="" disabled selected>Country</option>
					<option value="Afghanistan" <?php if ($country == "Afghanistan") echo "selected"; ?>>Afghanistan</option>
					<option value="Albania">Albania</option>
					<option value="Algeria">Algeria</option>
					<option value="American Samoa">American Samoa</option>
					<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Anguilla">Anguilla</option>
					<option value="Antartica">Antarctica</option>
					<option value="Antigua and Barbuda">Antigua and Barbuda</option>
					<option value="Argentina">Argentina</option>
					<option value="Armenia">Armenia</option>
					<option value="Aruba">Aruba</option>
					<option value="Australia" <?php if ($country == "Australia") echo "selected"; ?>>Australia</option>
					<option value="Austria" <?php if ($country == "Austria") echo "selected"; ?>>Austria</option>
					<option value="Azerbaijan">Azerbaijan</option>
					<option value="Bahamas">Bahamas</option>
					<option value="Bahrain">Bahrain</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Barbados">Barbados</option>
					<option value="Belarus">Belarus</option>
					<option value="Belgium">Belgium</option>
					<option value="Belize">Belize</option>
					<option value="Benin">Benin</option>
					<option value="Bermuda">Bermuda</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
					<option value="Botswana">Botswana</option>
					<option value="Bouvet Island">Bouvet Island</option>
					<option value="Brazil">Brazil</option>
					<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
					<option value="Brunei Darussalam">Brunei Darussalam</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Burkina Faso">Burkina Faso</option>
					<option value="Burundi">Burundi</option>
					<option value="Cambodia">Cambodia</option>
					<option value="Cameroon">Cameroon</option>
					<option value="Canada">Canada</option>
					<option value="Cape Verde">Cape Verde</option>
					<option value="Cayman Islands">Cayman Islands</option>
					<option value="Central African Republic">Central African Republic</option>
					<option value="Chad">Chad</option>
					<option value="Chile">Chile</option>
					<option value="China">China</option>
					<option value="Christmas Island">Christmas Island</option>
					<option value="Cocos Islands">Cocos (Keeling) Islands</option>
					<option value="Colombia">Colombia</option>
					<option value="Comoros">Comoros</option>
					<option value="Congo">Congo</option>
					<option value="Congo">Congo, the Democratic Republic of the</option>
					<option value="Cook Islands">Cook Islands</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cota D'Ivoire">Cote d'Ivoire</option>
					<option value="Croatia">Croatia (Hrvatska)</option>
					<option value="Cuba">Cuba</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czech Republic">Czech Republic</option>
					<option value="Denmark">Denmark</option>
					<option value="Djibouti">Djibouti</option>
					<option value="Dominica">Dominica</option>
					<option value="Dominican Republic">Dominican Republic</option>
					<option value="East Timor">East Timor</option>
					<option value="Ecuador">Ecuador</option>
					<option value="Egypt">Egypt</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Equatorial Guinea">Equatorial Guinea</option>
					<option value="Eritrea">Eritrea</option>
					<option value="Estonia">Estonia</option>
					<option value="Ethiopia">Ethiopia</option>
					<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
					<option value="Faroe Islands">Faroe Islands</option>
					<option value="Fiji">Fiji</option>
					<option value="Finland">Finland</option>
					<option value="France">France</option>
					<option value="France Metropolitan">France, Metropolitan</option>
					<option value="French Guiana">French Guiana</option>
					<option value="French Polynesia">French Polynesia</option>
					<option value="French Southern Territories">French Southern Territories</option>
					<option value="Gabon">Gabon</option>
					<option value="Gambia">Gambia</option>
					<option value="Georgia">Georgia</option>
					<option value="Germany">Germany</option>
					<option value="Ghana">Ghana</option>
					<option value="Gibraltar">Gibraltar</option>
					<option value="Greece">Greece</option>
					<option value="Greenland">Greenland</option>
					<option value="Grenada">Grenada</option>
					<option value="Guadeloupe">Guadeloupe</option>
					<option value="Guam">Guam</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Guinea">Guinea</option>
					<option value="Guinea-Bissau">Guinea-Bissau</option>
					<option value="Guyana">Guyana</option>
					<option value="Haiti">Haiti</option>
					<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
					<option value="Holy See">Holy See (Vatican City State)</option>
					<option value="Honduras">Honduras</option>
					<option value="Hong Kong">Hong Kong</option>
					<option value="Hungary">Hungary</option>
					<option value="Iceland">Iceland</option>
					<option value="India" <?php if ($country == "India") echo "selected"; ?>>India</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Iran">Iran (Islamic Republic of)</option>
					<option value="Iraq">Iraq</option>
					<option value="Ireland">Ireland</option>
					<option value="Israel">Israel</option>
					<option value="Italy">Italy</option>
					<option value="Jamaica">Jamaica</option>
					<option value="Japan">Japan</option>
					<option value="Jordan">Jordan</option>
					<option value="Kazakhstan">Kazakhstan</option>
					<option value="Kenya">Kenya</option>
					<option value="Kiribati">Kiribati</option>
					<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
					<option value="Korea">Korea, Republic of</option>
					<option value="Kuwait">Kuwait</option>
					<option value="Kyrgyzstan">Kyrgyzstan</option>
					<option value="Lao">Lao People's Democratic Republic</option>
					<option value="Latvia">Latvia</option>
					<option value="Lebanon">Lebanon</option>
					<option value="Lesotho">Lesotho</option>
					<option value="Liberia">Liberia</option>
					<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
					<option value="Liechtenstein">Liechtenstein</option>
					<option value="Lithuania">Lithuania</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Macau">Macau</option>
					<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
					<option value="Madagascar">Madagascar</option>
					<option value="Malawi">Malawi</option>
					<option value="Malaysia">Malaysia</option>
					<option value="Maldives">Maldives</option>
					<option value="Mali">Mali</option>
					<option value="Malta">Malta</option>
					<option value="Marshall Islands">Marshall Islands</option>
					<option value="Martinique">Martinique</option>
					<option value="Mauritania">Mauritania</option>
					<option value="Mauritius">Mauritius</option>
					<option value="Mayotte">Mayotte</option>
					<option value="Mexico">Mexico</option>
					<option value="Micronesia">Micronesia, Federated States of</option>
					<option value="Moldova">Moldova, Republic of</option>
					<option value="Monaco">Monaco</option>
					<option value="Mongolia">Mongolia</option>
					<option value="Montserrat">Montserrat</option>
					<option value="Morocco">Morocco</option>
					<option value="Mozambique">Mozambique</option>
					<option value="Myanmar">Myanmar</option>
					<option value="Namibia">Namibia</option>
					<option value="Nauru">Nauru</option>
					<option value="Nepal">Nepal</option>
					<option value="Netherlands">Netherlands</option>
					<option value="Netherlands Antilles">Netherlands Antilles</option>
					<option value="New Caledonia">New Caledonia</option>
					<option value="New Zealand">New Zealand</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Niger">Niger</option>
					<option value="Nigeria">Nigeria</option>
					<option value="Niue">Niue</option>
					<option value="Norfolk Island">Norfolk Island</option>
					<option value="Northern Mariana Islands">Northern Mariana Islands</option>
					<option value="Norway">Norway</option>
					<option value="Oman">Oman</option>
					<option value="Pakistan">Pakistan</option>
					<option value="Palau">Palau</option>
					<option value="Panama">Panama</option>
					<option value="Papua New Guinea">Papua New Guinea</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Peru">Peru</option>
					<option value="Philippines">Philippines</option>
					<option value="Pitcairn">Pitcairn</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Puerto Rico">Puerto Rico</option>
					<option value="Qatar">Qatar</option>
					<option value="Reunion">Reunion</option>
					<option value="Romania">Romania</option>
					<option value="Russia">Russian Federation</option>
					<option value="Rwanda">Rwanda</option>
					<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
					<option value="Saint LUCIA">Saint LUCIA</option>
					<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
					<option value="Samoa">Samoa</option>
					<option value="San Marino">San Marino</option>
					<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
					<option value="Saudi Arabia">Saudi Arabia</option>
					<option value="Senegal">Senegal</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Sierra">Sierra Leone</option>
					<option value="Singapore">Singapore</option>
					<option value="Slovakia">Slovakia (Slovak Republic)</option>
					<option value="Slovenia">Slovenia</option>
					<option value="Solomon Islands">Solomon Islands</option>
					<option value="Somalia">Somalia</option>
					<option value="South Africa">South Africa</option>
					<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
					<option value="Span">Spain</option>
					<option value="SriLanka">Sri Lanka</option>
					<option value="St. Helena">St. Helena</option>
					<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
					<option value="Sudan">Sudan</option>
					<option value="Suriname">Suriname</option>
					<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
					<option value="Swaziland">Swaziland</option>
					<option value="Sweden">Sweden</option>
					<option value="Switzerland">Switzerland</option>
					<option value="Syria">Syrian Arab Republic</option>
					<option value="Taiwan">Taiwan, Province of China</option>
					<option value="Tajikistan">Tajikistan</option>
					<option value="Tanzania">Tanzania, United Republic of</option>
					<option value="Thailand">Thailand</option>
					<option value="Togo">Togo</option>
					<option value="Tokelau">Tokelau</option>
					<option value="Tonga">Tonga</option>
					<option value="Trinidad and Tobago">Trinidad and Tobago</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Turkey">Turkey</option>
					<option value="Turkmenistan">Turkmenistan</option>
					<option value="Turks and Caicos">Turks and Caicos Islands</option>
					<option value="Tuvalu">Tuvalu</option>
					<option value="Uganda">Uganda</option>
					<option value="Ukraine">Ukraine</option>
					<option value="United Arab Emirates">United Arab Emirates</option>
					<option value="United Kingdom">United Kingdom</option>
					<option value="United States" <?php if ($country == "United States") echo "selected"; ?>>United States</option>
					<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Uzbekistan">Uzbekistan</option>
					<option value="Vanuatu">Vanuatu</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Vietnam">Viet Nam</option>
					<option value="Virgin Islands (British)">Virgin Islands (British)</option>
					<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
					<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
					<option value="Western Sahara">Western Sahara</option>
					<option value="Yemen">Yemen</option>
					<option value="Yugoslavia">Yugoslavia</option>
					<option value="Zambia">Zambia</option>
					<option value="Zimbabwe">Zimbabwe</option>
				</select>
				<label class="error w3-margin-0"><?php echo $countryErr;?></label>
			</div>
		</div></p>

		<p><br>
		<div class="w3-row-padding">
			<div class="w3-half">
				<label>Phone Number</label>
				<input name="ph" class="w3-input" type="number" value="<?php echo $ph;?>">
				<label class="error w3-margin-0"><?php echo $phErr;?></label>
			</div>
			<div class="w3-half">
				<label>Email</label>
				<input name="email" class="w3-input" type="email" value="<?php echo $email;?>">
				<label class="error w3-margin-0"><?php echo $emailErr;?></label>
			</div>
		</div></p>

		<p><br>
		<label>Personal Homepage</label>
		<input name="url" class="w3-input" type="url" placeholder="optional" value="<?php echo $url;?>">
		<label class="error w3-margin-0"><?php echo $urlErr;?></label></p>

		<p><br>
		<label>Accommodation needed?</label>
		<input name="acc" class="w3-radio w3-margin" type="radio" value="y" <?php if (isset($acc) && $acc=="y") echo "checked";?>>
		<label>Yes</label>
		<input name="acc" class="w3-radio w3-margin" type="radio" value="n" <?php if (isset($acc) && $acc=="n") echo "checked";?>>
		<label>No</label></p>

		<p><br>
		<label>Any dietary restrictions?</label>
		<input name="dietres" class="w3-input" type="text" placeholder="optional" value="<?php echo $dietres;?>"></p>

		<p><br>
		<label>I have</label>
		<input id="ref1" name="refcat" class="w3-radio w3-margin" type="radio" value="inv" onclick="showref();" <?php if (isset($refcat) && $refcat=="inv") echo "checked";?>>
		<label>received an invitation</label>
		<input id="ref2" name="refcat" class="w3-radio w3-margin" type="radio" value="ref" onclick="showref();" <?php if (isset($refcat) && $refcat=="ref") echo "checked";?>>
		<label>been referred by an invitee</label>
		<input id="ref3" name="refcat" class="w3-radio w3-margin" type="radio" value="uninv" onclick="showref();" <?php if (isset($refcat) && $refcat=="uninv") echo "checked";?>>
		<label>not received an invitation</label></p>
		<p><label id="lr" style="display:none">Referred by:</label>
		<div class="w3-row-padding">
			<div class="w3-half">
				<input id="r1" name="refname" class="w3-input" type="text" placeholder="Name" value="<?php echo $refname;?>">
				<label id="re1" class="error w3-margin-0"><?php echo $refnameErr;?></label>
			</div>
			<div class="w3-half">
				<input id="r2" name="refemail" class="w3-input" type="email" placeholder="Email" value="<?php echo $refemail;?>">
				<label id="re2" class="error w3-margin-0"><?php echo $refemailErr;?></label>
			</div>
		</div></p>

		<p><br>
		<label id="rell">Relevant publications/projects <i>(200 words max)</i></label><br>
		<textarea id='relta' name="rel" type="text" rows="7" style="width:100%" placeholder="Brief summary." maxlength="2000"><?php echo $rel;?></textarea>
		<label id="rele" class="error w3-margin-0"><?php echo $relErr;?></label></p>

		<p><br>
		<label id="motl">Motivation for attending. <i>(500 words max)</i></label><br>
		<textarea id='motta' name="mot" type="text" rows="7" style="width:100%" placeholder="What motivates you to participate in our school?" maxlength="5000"><?php echo $mot;?></textarea>
		<label id="mote" class="error w3-margin-0"><?php echo $motErr;?></label></p>

		<input type="submit" name="submit" value="Register" class="w3-btn w3-blue-grey w3-margin">
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

function showref() {
	if (document.getElementById('ref1').checked){
		document.getElementById('r1').style.display = 'none';
		document.getElementById('r2').style.display = 'none';
		document.getElementById('lr').style.display = 'none';
		document.getElementById('re1').style.display = 'none';
		document.getElementById('re2').style.display = 'none';

		document.getElementById('rell').style.display = 'none';
		document.getElementById('relta').style.display = 'none';
		document.getElementById('rele').style.display = 'none';
		document.getElementById('motl').style.display = 'none';
		document.getElementById('motta').style.display = 'none';
		document.getElementById('mote').style.display = 'none';
	}
	else if (document.getElementById('ref2').checked){
		document.getElementById('r1').style.display = 'block';
		document.getElementById('r2').style.display = 'block';
		document.getElementById('lr').style.display = 'block';
		document.getElementById('re1').style.display = 'block';
		document.getElementById('re2').style.display = 'block';
/*		
		if (document.getElementById('curpos').value == "MS" || document.getElementById('curpos').value == "PS" || document.getElementById('curpos').value == "PD") {
			document.getElementById('rell').style.display = 'block';
			document.getElementById('relta').style.display = 'block';
			document.getElementById('rele').style.display = 'block';
			document.getElementById('motl').style.display = 'block';
			document.getElementById('motta').style.display = 'block';
			document.getElementById('mote').style.display = 'block';
		}
		else {   */
			document.getElementById('rell').style.display = 'none';
			document.getElementById('relta').style.display = 'none';
			document.getElementById('rele').style.display = 'none';
			document.getElementById('motl').style.display = 'none';
			document.getElementById('motta').style.display = 'none';
			document.getElementById('mote').style.display = 'none';
	//	}
	}
	else if (document.getElementById('ref3').checked){
		document.getElementById('r1').style.display = 'none';
		document.getElementById('r2').style.display = 'none';
		document.getElementById('lr').style.display = 'none';
		document.getElementById('re1').style.display = 'none';
		document.getElementById('re2').style.display = 'none';

		document.getElementById('rell').style.display = 'block';
		document.getElementById('relta').style.display = 'block';
		document.getElementById('rele').style.display = 'block';
		document.getElementById('motl').style.display = 'block';
		document.getElementById('motta').style.display = 'block';
		document.getElementById('mote').style.display = 'block';
	}
}

</script>