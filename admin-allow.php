<?php 
// yaha pa ham na id get kr ka status ko update kr ka 1 kr ka apprve kia ha
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