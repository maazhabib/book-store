<?php
include "config.php";
session_start();

$database = new Database();
$failed = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, status, user_type FROM user WHERE name = ? AND email = ?";
    $stmt = $database->getMysqli()->prepare($sql);
    $stmt->bind_param("ss", $username, $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

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
            } else if($status == 0) {
                $failed = "Your account is deactivated. Please contact support for further information.";
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
    <title>USER LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
        <h1>USER LOGIN</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form method="post">

                    <input class="text" type="text" name="uname" placeholder="Username" required=""><br>

                    <input class="text email" type="email" name="email" placeholder="Email" required=""><br>

                    <input class="text" type="password" name="password" placeholder="Password" required="">
                    <p style="color: red;"><?php echo @$failed ?></p>

                    <input type="submit" name="submit" value="LOGIN">
                </form>
                <p>Don't have an Account? <a href="user-signup.php"> Sign UP!</a></p><br>
                
            </div>
            <div class="d-flex justify-content-end">

            <a href="libradian-login.php"><button type="button" class="btn btn-dark">librarian</button></a>:
            <a href="admin-login.php"><button type="button" class="btn btn-dark">admin</button></a>

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
