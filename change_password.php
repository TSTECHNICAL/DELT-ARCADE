<?php 
include("../assets/include/connection.php");
$userid=$_POST['userid'];
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$cpassword=$_POST['cpassword'];
$finalnewpassword=password_hash($newpassword, PASSWORD_BCRYPT);

if($newpassword !== $cpassword){
    echo "2";
} else {
    $sql="select * from `tbl_admin` where `id`='".$userid."'";
    $result=mysqli_query($con,$sql);
    $num=mysqli_num_rows($result);
    $line=mysqli_fetch_assoc($result);
    
    // Check both bcrypt and legacy MD5 passwords
    $authenticated = false;
    if(password_verify($oldpassword, $line['password'])) {
        $authenticated = true;
    } else if($line['password'] === md5($oldpassword)) {
        $authenticated = true;
    }
    
    if($authenticated) {
        $sql2= "UPDATE `tbl_admin` SET `password`= '".$finalnewpassword."' WHERE `id`='".$userid."'";
        $query2=mysqli_query($con,$sql2);
        echo "1";
        
        session_start();
        session_unset();
        session_destroy();
    } else {
        echo "0";
    }
}
?>