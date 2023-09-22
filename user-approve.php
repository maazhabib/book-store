<?php
// data update and approve a user detail and aprove a data 
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $tableName = "user";
    
    $data = array('STATUS' => '1');
    $where = "ID = '{$id}'";
    
    $db->update($tableName, $data, $where);
    
    header("Location: user-detail.php");
    exit();
}
?>
