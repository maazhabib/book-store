<?php 
include "config.php";
session_start();
$db = new Database();

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$b_date = date('Y-m-d');

$checkColumnQuery = "SHOW COLUMNS FROM books LIKE 'borrow_date'";
$columnResult = $db->getMysqli()->query($checkColumnQuery);

if ($columnResult->num_rows === 0) {
    $addColumnQuery = "ALTER TABLE books ADD borrow_date DATE";
    $db->getMysqli()->query($addColumnQuery);
}

if (isset($_POST['borrow'])) {
    $newUserId = $userId;
    $bookId = $_GET['id'];
    $returnDate = $_POST['returnDate'];

    $sql = "UPDATE books SET user_id = $newUserId, b_date = '$b_date', r_date = '$returnDate', btn = 1 WHERE id = $bookId";

    if ($db->getMysqli()->query($sql)) {
        header("location:b_detail.php");
    } else {
        echo"<script>alert('write now you cant borrow a book')</script>";
    }
}







?>

