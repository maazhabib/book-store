<?php

include("config.php");

if (isset($_POST['submit'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phone_no = $_POST['phone'];
	$cnic = $_POST['cnic'];
	$pass = $_POST['password'];

	$nameReg = "/[A-Z]{1}[a-z]{1,20}[0-9]{1,9}$/";
	$emailReg = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";
	$phone_noReg = "/^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}|^\d{11}$|^\d{4}-\d{7}$/";
	$cnicReg = "/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/";
	$passReg = "/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/";

	$blowfish = password_hash($pass, CRYPT_BLOWFISH);

	$query = "SELECT * FROM `patient_signup` WHERE name= '$name' OR email= '$email'";
	$queryResult = mysqli_query($conn, $query);
	$users = mysqli_num_rows($queryResult);

	if (preg_match($nameReg, $name)) {
		if (preg_match($phone_noReg, $phone_no)) {
			if (preg_match($cnicReg, $cnic)) {
				if (preg_match($passReg, $pass)) {

					if ($users > 0) {
						$exist   = "User Already Exist";
					} else {
						$sql = "INSERT INTO `patient_signup` ( `name`, `address`, `phone_no`, `cnic`, `password`, `email`) VALUES ( '$name', '$address', '$phone_no', '$cnic', '$blowfish', '$email')";
						$sqlres = mysqli_query($conn, $sql);


						if ($sqlres) {

							$success = "Signup successfully";

							echo "<script>
	
				setTimeout(()=>{
					window.location.href='patient_detail.php'
				},1000)
				
				</script>";
						} else {
							$failed = "Failed to signup";
						}
					}
				} else {
					$passerr = "Don't Use Special character";
				}
			} else {
				$cnicerr = "Use - to varify your cnic";
			}
		} else {
			$phoerr = "Enter Valid Number";
		}
	} else {
		$nameerr = "Use Capital Alphabat & Number";
	}
}


?>


<!DOCTYPE html>
<html>

<head>
	<title>Patient SignUp</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	

	<!-- Custom Theme files -->
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->
	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
	<!-- //web font -->
	<link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Patient SignUp</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form method="post">
					<input class="text" type="text" name="name" placeholder="Username" required="">
					<p style="color: red;"><?php echo @$nameerr ?></p>
					<br>
					<input class="text email" type="email" name="email" placeholder="Email" required=""><br>

					<input class="text" type="text" name="address" placeholder="Address" required=""><br>

					<input class="text" type="text" name="phone" placeholder="Phone" required="">
					<p style="color: red;"><?php echo @$phoerr ?></p>
					<br>

					<input class="text" type="text" name="cnic" placeholder="CNIC" required="">
					<p style="color: red;"><?php echo @$cnicerr ?></p>
					<br>

					<input class="text" type="password" name="password" placeholder="Password" required="">
					<p style="color: red;"><?php echo @$passerr ?></p>
					<br>
					<input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required="">
					<p style="color: red;"><?php echo @$passerr ?></p>
					<br>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" name="submit" value="SIGNUP">
					<p style="color: green;"><?php echo @$success ?></p>
					<p style="color: red;"><?php echo @$failed ?></p>

				</form>
				<p>Already have an Account? <a href="patient-login.php"> Login Now!</a></p>
			</div>
		</div>

		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>

</html>