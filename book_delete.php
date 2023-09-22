<?php
// yaha pa ham na book delete ki ha

include("config.php");
$db = new Database();

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    $deleteQuery = "DELETE FROM books WHERE ID = $bookId";

    $deleteResult = $db->executeQuery($deleteQuery);

    if ($deleteResult) {
        header("Location: book-detail.php"); 
        exit();
    } else {
        echo "Error: " . $db->getMysqli()->error;
    }
} else {
    echo "Book ID is missing in the URL.";
}
?>
