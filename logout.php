<?php
session_start();
include("config.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
$user_type = isset($_GET['type']) ? $_GET['type'] : null;

var_dump($id);

if (
    isset($_SESSION['id']) &&
    isset($_SESSION['user_type']) &&
    $_SESSION['id'] == $id &&
    $_SESSION['user_type'] == $user_type
) {
    session_unset();
    session_destroy();
}

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
