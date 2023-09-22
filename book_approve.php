<?php

// yaha pa ham na book ka status update kia ha ka hamaray pass book ha 

include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $tableName = "books";
    
    $data = array('STATUS' => '1');
    $where = "ID = '{$id}'";
    
    $db->update($tableName, $data, $where);
    
    header("Location: book-detail.php");
    exit();
}
?>
