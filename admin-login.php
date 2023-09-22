<?php
session_start();

include("config.php");
$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, status, user_type FROM admin WHERE name = ? AND email = ?";
    $stmt = $database->getMysqli()->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
// yaha pa agar status hata dia ha agar password vaerify hota ha to agay bhr jay ga 
        if ($row["status"] == 1 && password_verify($password, $hashedPassword)) {
            $_SESSION['user'] = $username;
            $_SESSION['id'] = $row["id"];
            $_SESSION['user_type'] = $row["user_type"];
            $_SESSION['status'] = $row["status"];

            // yaha pa agar data agar user_type agar admin ka brabar ha to ya index pa bhr jay ga
            if ($_SESSION['user_type'] == 'admin') {
                header("Location: index.php");
            } else  if($row["status"] == 0) {
                header("Location: user-login.php");
            }else{
                header("Location: user-login.php");

            }
            exit;
        } else {
            $failed = "Invalid login credentials. Please try again.";
        }
    } else {
        $failed = "Invalid login credentials. Please try again.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ADMIN LOGIN</title>
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
        <h1>ADMIN LOGIN</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form method="post">

                    <input class="text" type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'] ?>" placeholder="Username" required=""><br>

                    <input class="text email" type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Email" required=""><br>

                    <input class="text" type="password" name="password" placeholder="Password" required="">
                    <p style="color: red;"><?php echo @$passerr ?></p>

                    <input type="submit" name="submit" value="LOGIN">
                    <p style="color: green;"><?php echo @$success ?></p>
                    <p style="color: red;"><?php echo @$failed ?></p>
                    <p style="color: red;"><?php echo @$approve ?></p>

                </form>
                <p>Don't have an Account? <a href="user-login.php"> User</a></p>
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
    </div>
</body>

</html>
