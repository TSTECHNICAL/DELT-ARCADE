<?php 
ob_start();
session_start();
if($_SESSION['userid']=="")
{
	header("location:index.php?msg1=notauthorized");
	exit();
}
	
include ("../assets/include/connection.php");

if(isset($_POST['submit'])=='Submit'){
	$userid=($_POST['userid']);
	$reward=($_POST['reward']);
$sql= "INSERT INTO `tbl_reward`(`userid`,`amount`) VALUES ('".$userid."','".$reward."')";
$query=mysqli_query($con,$sql);
$sqlorder= mysqli_query($con,"INSERT INTO `tbl_order`(`userid`,`transactionid`,`amount`,`status`) VALUES ('".$userid."','reward','".$reward."','1')");
@$orderid=mysqli_insert_id($con);

$today = date("Y-m-d H:i:s");
$sql3= mysqli_query($con,"INSERT INTO `tbl_walletsummery`(`userid`,`orderid`,`amount`,`type`,`actiontype`,`createdate`) VALUES ('".$userid."','".$orderid."','".$reward."','credit','reward','".$today."')");


$walletAvailablebalance=wallet($con,'amount',$userid);	
$finalbalanceCredit=$walletAvailablebalance+$reward;	
$sqlwallet= mysqli_query($con,"UPDATE `tbl_wallet` SET `amount` = '$finalbalanceCredit' WHERE `userid`= '$userid'");
if($query){
	
	header("location:reward_system.php?msg=updt");
	
	}

	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | Reward System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="plugins/iCheck/all.css">
<link rel="stylesheet" type="text/css" href="css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
<?php include ("include/header.inc.php");?>
 <?php include ("include/navigation.inc.php");?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Reward System</h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Reward System</li>
      </ol>
    </section>

                        
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-gift"></i> Add New Reward</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label><i class="fa fa-envelope"></i> Select User by Email</label>
                  <select class="form-control select2" style="width: 100%;" name="userid" required>
                    <option value="">Select Email Address</option>
                    <?php
                    $userSql = "SELECT id, email FROM tbl_user WHERE status='1'";
                    $userResult = mysqli_query($con, $userSql);
                    while ($userResult && $row = mysqli_fetch_assoc($userResult)) {
                        echo '<option value="' . $row['id'] . '">' . $row['email'] . '</option>';
                    }
                    ?>
                  </select>
                  <small class="text-muted">Choose the user who will receive the reward</small>
                </div>
                <div class="form-group">
                  <label for="rewardAmount"><i class="fa fa-money"></i> Reward Amount</label>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control" id="rewardAmount" placeholder="Enter Amount" name="reward" onkeypress="return isNumber(event)" required>
                  </div>
                  <small class="text-muted">Enter the amount to reward the user</small>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">
                  <i class="fa fa-check"></i> Submit Reward
                </button>
              </div>
            </form>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-info-circle"></i> Reward Instructions</h3>
            </div>
            <div class="box-body">
              <div class="callout callout-info">
                <h4>How to use the reward system</h4>
                <p>Follow these steps to reward users:</p>
                <ol>
                  <li>Select a user by their email address</li>
                  <li>Enter the reward amount</li>
                  <li>Click the Submit button</li>
                </ol>
                <p>The user's account will be credited immediately and they will be able to use the funds.</p>
              </div>
              
              <div class="alert alert-warning">
                <h4><i class="icon fa fa-warning"></i> Important Note</h4>
                <p>All reward transactions are logged and cannot be reversed. Please verify the user and amount before submitting.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-history"></i> Reward History</h3>
            </div>
            <div class="box-body">
              <div id="reward_history" class="table-responsive"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include("include/footer.inc.php"); ?></div>
<script type="text/javascript">
$(document).ready(function(){
	// Load reward history when user is selected
	$(".select2").change(function(){
		var id=$(this).val();
		
		if(id) {
			$.ajax({
				type:"post",
				url:"ajax_rewardlist.php",
				data:{id:id},
				beforeSend: function() {
					$("#reward_history").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><br>Loading reward history...</div>');
				},
				success:function(data){
					$("#reward_history").html(data);
				},
				error: function() {
					$("#reward_history").html('<div class="alert alert-danger">Error loading reward history. Please try again.</div>');
				}
			});
		} else {
			$("#reward_history").html('<div class="alert alert-info">Please select a user to view their reward history.</div>');
		}
	});
	
	// Show message if URL has success parameter
	if(window.location.href.indexOf('?msg=updt') > -1) {
		Swal.fire({
			icon: 'success',
			title: 'Success!',
			text: 'Reward added successfully',
			showConfirmButton: false,
			timer: 2000
		});
	}
});
</script>

</body>
</html>
