<?php
include('../assets/include/connection.php');
if(isset($_POST['editid']))
{
@$amount = mysqli_real_escape_string($con,$_POST['amount']);
@$roleid = mysqli_real_escape_string($con,$_POST['editid']);

$date=date( 'Y-m-d h:i:s' );

// Make sure amount is numeric
if(!is_numeric($amount)) {
    echo "0"; // Invalid amount
    exit;
}

// Convert to float/integer to ensure proper formatting
$amount = floatval($amount);

$role_query=mysqli_query($con,"UPDATE `tbl_wallet` SET `amount`='".$amount."' WHERE `userid` ='".$roleid."'");
if($role_query){	
    echo"1";
} else { 
    echo"0";
}		
	
}
?>