<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $tableName = "shoper";
    
    $data = array('STATUS' => '1');
    $where = "ID = '{$id}'";
    
    $db->update($tableName, $data, $where);
    
    header("Location: libradian-detail.php");
    exit();
}
?>
