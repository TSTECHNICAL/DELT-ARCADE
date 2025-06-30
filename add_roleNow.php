<?php
include('../assets/include/connection.php');

// Handle both parameter formats (add_item or role)
if(isset($_POST['add_item']) || isset($_POST['role']))
{
    // Get the role name from either parameter
    $particular = isset($_POST['add_item']) ? mysqli_real_escape_string($con, $_POST['add_item']) : mysqli_real_escape_string($con, $_POST['role']);
    
    // Get the role ID
    $roleid = isset($_POST['roleid']) ? mysqli_real_escape_string($con, $_POST['roleid']) : (isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '');
    
    $date = date('Y-m-d h:i:s');
    
    // Check if role already exists (for new roles)
    if($roleid == '') {
        $check_query = mysqli_query($con, "SELECT * FROM `role` WHERE `role` = '".$particular."'");
        if(mysqli_num_rows($check_query) > 0) {
            echo "2"; // Role already exists
            exit;
        }
        
        // Insert new role
        $sql = "INSERT INTO `role`(`role`,`status`,`created_date`) VALUES ('".$particular."','1','".$date."')";
        $query = mysqli_query($con, $sql);
        
        if($query) {
            echo "1"; // Success
        } else {
            echo "0"; // Error
        }
    } else {
        // Update existing role
        $role_query = mysqli_query($con, "UPDATE `role` SET `role`='".$particular."',`modified_date`='".$date."' WHERE `id` ='".$roleid."'");
        
        if($role_query) {
            echo "1"; // Success
        } else {
            echo "0"; // Error
        }
    }
}


if(isset($_POST['type']))
{
	if($_POST['type']=='chk'){
		$sqlA = "Update `role` set status = '0' where `id`='".$_POST['id']."' ";
		mysqli_query($con,$sqlA);
	} else if($_POST['type']=='unchk') {
		$sqlA = "Update `role` set status = '1' where `id`='".$_POST['id']."' ";
		mysqli_query($con,$sqlA);
	} else if($_POST['type']=='delete'){	
		$id = $_POST['id'];
		$sqlDel = "Delete from `role` where `id` in ($id) ";
		$queryDel = mysqli_query($con,$sqlDel);
		if($queryDel){ echo "1"; } else { echo "0"; }
	} else if($_POST['type']=='roleedit'){
		// Get role data for editing
		$id = $_POST['id'];
		$query = mysqli_query($con, "SELECT * FROM `role` WHERE `id` = '".$id."'");
		$row = mysqli_fetch_assoc($query);
		
		if($row) {
			// Return role data as JSON
			echo json_encode(array(
				'id' => $row['id'],
				'role' => $row['role'],
				'status' => $row['status']
			));
		} else {
			echo json_encode(array('error' => 'Role not found'));
		}
	}
}

?>