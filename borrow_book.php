<?php
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST["book_id"];
    $userName = $_POST["userName"]; // Get user's name
    $userEmail = $_POST["userEmail"]; // Get user's email
    $borrowDate = $_POST["borrowDate"];
    $returnDate = $_POST["returnDate"];

    // Perform necessary validation here


    $sql = "INSERT INTO borrow (id, user_name, user_email, borrow_date, return_date) VALUES ('$bookId', '$userName', '$userEmail', '$borrowDate', '$returnDate')";

    if ($conn->query($sql) === TRUE) {
        header("Location: b_detail.php?id=$bookId");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
