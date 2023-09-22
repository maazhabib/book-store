<?php
// yaha pa ham data update kr ka reject karay ga librarian
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $tableName = "shoper";
    
    $data = array('STATUS' => '0');
    $where = "ID = '{$id}'";
    
    $db->update($tableName, $data, $where);
    
    header("Location: libradian-detail.php");
    exit();
}
?>
