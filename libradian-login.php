<?php
session_start();
include("config.php");

$database = new Database();

// yaha pa agar server sa request mathod post ka brabar ho ga to yya agay bhr jay ga 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // yaha ham na select kia ha 

    $sql = "SELECT id, password, status, user_type FROM shoper WHERE name = ? AND email = ?";
    $stmt = $database->getMysqli()->prepare($sql);
    $stmt->bind_param("ss", $username, $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
// yaha pa ham na num row kia ha 
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];
            $id = $row["id"];
            $status = $row["status"];
            $user_type = $row["user_type"];

            if ($status == 1 && password_verify($password, $hashedPassword)) {
                $_SESSION['id'] = $id; 
                $_SESSION['name'] = $username; 
                $_SESSION['user_type'] = $user_type; 
                $_SESSION['status'] = $status; 
                header("Location: book-detail.php");
                exit;
            } else {
                $failed = "Invalid login credentials. Please try again.";
            }
        } else {
            $failed = "Invalid login credentials. Please try again.";
        }
    } else {
        // Handle SQL error
        echo "SQL Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>LIBRADIAN LOGIN</title>
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
        <h1>LIBRADIAN LOGIN</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form method="post">

                    <input class="text" type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'] ?>" placeholder="Username" required=""><br>

                    <input class="text email" type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Email" required=""><br>

                    <input class="text" type="password" name="password" placeholder="Password" required="">
                    <p style="color: red;"><?php echo @$failed ?></p>

                    <input type="submit" name="submit" value="LOGIN">
                </form>
                <p>Don't have an Account? <a href="libradian.php"> Sign UP!</a></p>
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
