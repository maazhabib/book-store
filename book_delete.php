<?php

include("config.php");
$db = new Database();

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Define the DELETE query
    $deleteQuery = "DELETE FROM books WHERE ID = $bookId";

    // Execute the DELETE query
    $deleteResult = $db->executeQuery($deleteQuery);

    if ($deleteResult) {
        // Deletion was successful
        header("Location: book_edit.php"); // Redirect to a suitable page
        exit();
    } else {
        // Error occurred during deletion
        echo "Error: " . $db->getMysqli()->error;
    }
} else {
    // 'id' parameter is not set
    echo "Book ID is missing in the URL.";
}
?>
