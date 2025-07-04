<?php
session_start();
include("../assets/include/connection.php");
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(1);
if (!isset($_SESSION['admin_name'])) {
    
    echo "<script>
    window.location = './index.php';
</script>";
} 
?>

<?php 
if(isset($_POST['approve'])){
    
    $uid = mysqli_real_escape_string($con, $_POST['uid']);
    $deposit = mysqli_real_escape_string($con, $_POST['amount']);

    // Validate deposit amount is numeric
    if(!is_numeric($deposit)) {
        echo "<script>showErrorAlert('Invalid amount');</script>";
        exit;
    }

    date_default_timezone_set('Asia/Calcutta');
    $today = date("F j, Y, g:i a"); 
    
    $up = mysqli_query($con, "SELECT * FROM `tbl_wallet` WHERE `userid` = '".$uid."'");
    $rup = mysqli_fetch_array($up);
    
    // Check if user has a wallet record
    if($rup !== null) {
        // User has existing wallet - update amount
        $currentAmount = isset($rup['amount']) ? floatval($rup['amount']) : 0;
        $addmoney = $currentAmount + floatval($deposit);
        $wal = mysqli_query($con, "UPDATE `tbl_wallet` SET `amount` = '".$addmoney."' WHERE `userid` = '".$uid."'");
    } else {
        // User doesn't have a wallet yet - create one
        $addmoney = floatval($deposit);
        $wal = mysqli_query($con, "INSERT INTO `tbl_wallet` (`userid`, `amount`) VALUES ('".$uid."', '".$addmoney."')");
    }
    
    if($wal){
        $succes = mysqli_query($con, "UPDATE `deposits` SET `status` = '2' WHERE `uid` = '".$uid."' && `amount` = '$deposit'");
        $wager = mysqli_query($con, "INSERT into `wager_amount` (`tot_deposit`, `wager_amt`,`uid`, `date`) VALUES ('$deposit', '$deposit','$uid', '$today')");
        
        // Show success message
        echo "<script>showSuccessAlert('Payment approved successfully!');</script>";
    } else {
        echo "<script>showErrorAlert('Payment failed: " . mysqli_error($con) . "');</script>";
    }
}

?>
<?php 
if(isset($_POST['reject'])){
    
    $uid = $_POST['uid'];
    $deposit = $_POST['amount'];
    
      $reject = mysqli_query($con, "UPDATE `deposits` SET `status` = '3' WHERE `uid` = '".$uid."' && `amount` = '$deposit'");
   
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>colorslife</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Datatable CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
     <!-- Datatables JS Library -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <link rel="stylesheet" href="css/app.css" id="maincss">
    <link rel="stylesheet" href="css/style.css" id="maincss">"></script>
<![endif]-->
</head>
<style>
#overlay {
  position:absolute;
  display: none;
  width: 70%;
  height: 70px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 9;
  cursor: pointer;
}
</style>
<body class="fix-header hold-transition skin-red sidebar-mini">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <?php include ("include/header.inc.php");?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include ("include/navigation.inc.php"); ?>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">deposit</h4> </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
              
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h4>Payment Update</h4>           
                            
            <div class="table-responsive">
            <table id="gameSpots" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Uid</th>
                        <th>EMAIL</th>
                        <th>REFERENCE ID</th>
                        <th>AMOUNT</th>
                        <th>DATE</th>
                        <th>Action</th>
                                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sqq = mysqli_query($con, "SELECT * FROM `deposits` WHERE `status` = '1' ORDER BY `id` DESC");
                        $i = 0;
                        while ($row = mysqli_fetch_array($sqq)) {
                        $i = $i + 1;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['uid'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['ref_num'];?></td>
                        <td><?php echo $row['amount'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td>
                        <form action="" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['uid'];?>">
                            <input type="hidden" name="amount" value="<?php echo $row['amount'];?>">
                            <input class="btn btn-primary" type="submit" name="approve" value="Approve Payment">
                        </form> <br>
                        <form action="" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['uid'];?>">
                            <input type="hidden" name="amount" value="<?php echo $row['amount'];?>">
                            <input class="btn btn-danger" type="submit" name="reject" value="Reject Payment">
                        </form>
                    
                                      
                </td>
                       
                      </tr>            
                        <?php 
                            }
                        ?>                   
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
             
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h4>Completed Payment Records</h4>           
                            
            <div class="table-responsive">
            <table id="dep_comp" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Uid</th>
                        <th>EMAIL</th>
                        <th>REFERENCE ID</th>
                        <th>AMOUNT</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sqq = mysqli_query($con, "SELECT * FROM `deposits` WHERE `status` = '2' ORDER BY `id` DESC");
                        $i = 0;
                        while ($row = mysqli_fetch_array($sqq)) {
                        $i = $i + 1;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['uid'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['ref_num'];?></td>
                        <td><?php echo $row['amount'];?></td>
                        <td><?php echo $row['date'];?></td>
                     
                       
                      </tr>            
                        <?php 
                            }
                        ?>                   
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
                     
              





    



            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script type="text/javascript">
        $(document).ready(function() {
    $('#allSpots').DataTable({
        "searching": true,
        "order": [[ 0, "desc" ]],
        });
    } );
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
    $('#gameSpots').DataTable({
        "searching": true
        });
    } );
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
    $('#dep_comp').DataTable({
        "searching": true
        });
    } );
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
    $('#lostSpots').DataTable({
        "searching": true
        });
    } );
    </script>
   
<!-- 
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script> -->
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
</body>

</html>
