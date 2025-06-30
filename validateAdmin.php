<?php 
ob_start();
session_start();
include("../assets/include/connection.php");
if(isset($_POST['login'])=="login")
{
	// First try to find the admin by username
	$sql="select * from `tbl_admin` where `admin_name`='".$_POST['admin_id']."' and `status`='1'";
	$result=mysqli_query($con,$sql);
	if(!$result) {
		error_log("SQL Error in validateAdmin.php: ".mysqli_error($con));
		header("location:index.php?err=dberror");
		exit;
	}
	$num=mysqli_num_rows($result);
	if($num >= 1) {
		$line=mysqli_fetch_assoc($result);
	} else {
		$line = null;
		header("location:index.php?err=ture");
		exit;
	}
	if($num>=1)
	{
		$authenticated = false;
		// Check if using bcrypt hash
		if(password_verify($_POST['password_admin'], $line['password'])) {
			$authenticated = true;
		}
		// Legacy support for MD5 passwords
		else if($line['password'] === md5($_POST['password_admin'])) {
			// Upgrade to bcrypt
			$bcrypt_password = password_hash($_POST['password_admin'], PASSWORD_BCRYPT);
			$upgrade_sql = "UPDATE `tbl_admin` SET `password`= '".$bcrypt_password."' WHERE `id`='".$line['id']."'";
			mysqli_query($con, $upgrade_sql);
			$authenticated = true;
		}
		
		if($authenticated) {
			$userid=$line['id'] ;
			$_SESSION['userid']=$userid;
			$_SESSION['admin_name']=$line['admin_name'];
			$_SESSION['role_id']=$line['role'];
			
			header("location:desktop.php");
			exit;
		}
		else {
			header("location:index.php?err=ture");
			exit;
		}
	}
	else
	{
		header("location:index.php?err=ture");
		exit;
	}
}
else
{
	header("location:index.php?err=ture");
	exit;
}
?>