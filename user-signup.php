<?php
include("config.php");
//  ya user signup ha yaha paa data get karay ga 
if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $cnic = $_POST["cnic"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// blow fish and pattern 
    
    $namePattern= '/^(?=[a-zA-Z0-9._]{4,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/';
    $phonePattern = '/^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/';
    $cnicPattern= '/^[0-9]{5}-[0-9]{7}-[0-9]$/';
    $passwordPattern='/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+}{":;<>,.?~\\-]+$/';

// pregmatch 
    if (preg_match($namePattern, $name) &&
    filter_var($email, FILTER_VALIDATE_EMAIL) &&
    preg_match($phonePattern, $phone) &&
    preg_match($cnicPattern, $cnic) &&
    preg_match($passwordPattern, $password)) {
    // data enter 
    $table = "user";
    $data = array(
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "cnic" => $cnic,
        "password" => $hashedPassword,
        "pass"=>$password
    );

    $db = new Database();
    $result = $db->insert($table, $data);
// query sesses jb ho gi to if condition ya phr else
    if($result) {
        $success = "Registration successful!";
        header("Location: user-login.php");
    } else {
        $failed = "Registration failed. Please try again.";
    }
} else {
    $failed = "Invalid input data. Please check your input.";
}
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>USER SIGNUP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <!-- Custom Theme files -->
    <link href="style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- //web font -->
    <link rel="stylesheet" href="assets/css/enter.css">
</head>

<body>
    <!-- main -->
    <div class="main-w3layouts wrapper">
        <h1>USER SIGNUP</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form method="post">
                    <input class="text" type="text" name="name" placeholder="Enter Name" required="">
                    <br>
                    <input class="text email" type="email" name="email" placeholder="Email" required=""><br>

                    <input class="text" type="text" name="phone" placeholder="Phone" required="">
					<br>

					 <input class="text" type="text" name="cnic" placeholder="CNIC" required="">
					<br> 

                    <input class="text" type="password" name="password" placeholder="Password" required="">
                    <br>
                    <input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required="">
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
                <p>Already have an Account? <a href="user-login.php"> Login Now!</a></p>
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