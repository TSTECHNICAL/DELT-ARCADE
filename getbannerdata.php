<?php
include("../assets/include/connection.php");
if($_POST['type']=='roleedit'){
$id=$_POST['id'];
  $department_query=mysqli_query($con,"select * from `banner` where `id`='".$id."'");
  $department_result=mysqli_fetch_array($department_query);
   echo $SocietyDepartmentName=$department_result['banner_title'];
}
?>