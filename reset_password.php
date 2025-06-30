<?php 
include("../assets/include/connection.php");
$userid=$_POST['puserid'];
$newpassword=$_POST['nnewpassword'];
$cpassword=$_POST['ccpassword'];
// Use bcrypt for secure password hashing
$finalnewpassword=password_hash($newpassword, PASSWORD_BCRYPT);
if($newpassword !== $cpassword){echo "2";}else{
$sql2= "UPDATE `tbl_admin` SET `password`= '".$finalnewpassword."' WHERE `id`='".$userid."'";
$query2=mysqli_query($con,$sql2);

	echo "1";
}
	?>