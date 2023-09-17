<?php 
include("config.php");

$id=$_GET['id'];

$query= "UPDATE `admin` SET `status`='1' WHERE `id` = '{$id}'";
$queRes=mysqli_query($conn,$query);
if($queRes){
echo "<script>
window.location.href = 'show-user.php';
</script>";
}


?>