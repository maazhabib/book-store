<?php
// ya dlt work ha yaha pa admin ka status update ho rha ha
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $tableName = "admin";
    
    $data = array('STATUS' => '1');
    $where = "ID = '{$id}'";
    
    $db->update($tableName, $data, $where);
    
    header("Location: show-user.php");
    exit();
}
?>
