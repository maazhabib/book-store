<?php
session_start();
include("config.php");
// yaha pa ham na id get ki ha ka kon login ho ga ous time
$id = isset($_GET['id']) ? $_GET['id'] : null;
$user_type = isset($_GET['type']) ? $_GET['type'] : null;

if (
    isset($_SESSION['id']) &&
    isset($_SESSION['user_type']) &&
    $_SESSION['id'] == $id &&
    $_SESSION['user_type'] == $user_type
) {
    session_unset();
    session_destroy();
}

// agar ham logout click karay ga to yaha pa to jo ous time login ho ga vo logout ho jay ga

if ($user_type === 'admin') {
    session_unset();
    // session_destroy();
    header("Location: user-login.php");
} elseif ($user_type === 'librarian') {
    session_unset();
    // session_destroy();
    header("Location: user-login.php");
} elseif ($user_type === 'user') {
    session_unset();
    // session_destroy();
    header("Location: user-login.php");
} else {
    header("Location: user-login.php");
    session_unset();
    // session_destroy();
}

exit;
?>
