<?php 
ob_start();
session_start();
if($_SESSION['userid']=="")
{
	header("location:index.php");
	exit();
}
include ("../assets/include/connection.php");
	?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Control Panel |  Withdrawal Accept/Reject</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="plugins/morris/morris.css">
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="plugins/iCheck/all.css">

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/app.css" id="maincss">
<style>
#confirm h4{font-size: 1rem;}
#confirm p{font-size: 13px; margin-top:20px;}
#confirm .modal-content{border-radius:3px}
#confirm .modal-dialog{padding:20px; margin-top:130px;}

.img-container {
        text-align: center;
      }
</style>





</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <?php include ("include/header.inc.php");?>
  <?php include ("include/navigation.inc.php");

// Initialize $Result as an empty array to avoid null warnings
$Result = array(
  'payout' => '',
  'mobile' => '',
  'createdate' => '',
  'amount' => 0,
  'bankname' => '',
  'name' => '',
  'ifsc' => '',
  'account' => '',
  'status' => '',
  'id' => 0
);

if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = encryptor('decrypt', $_GET['id']);
  if($id){
    $Query = mysqli_query($con,"select tbl_user.mobile,tbl_user.email,tbl_user.owncode,tbl_bankdetail.name,tbl_bankdetail.ifsc,tbl_bankdetail.bankname,tbl_bankdetail.account,`tbl_withdrawal`.`id`,`tbl_withdrawal`.`amount`,`tbl_withdrawal`.`payout`,`tbl_withdrawal`.`status`,`tbl_withdrawal`.`createdate` from `tbl_withdrawal`
      INNER JOIN tbl_user ON tbl_user.id=`tbl_withdrawal`.`userid`
      INNER JOIN tbl_bankdetail ON tbl_bankdetail.id=`tbl_withdrawal`.`payid`
      where `tbl_withdrawal`.`id`='".$id."'");
    $fetchResult = mysqli_fetch_array($Query);
    if($fetchResult){
      $Result = $fetchResult;
    }
  }
}
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Withdrawal Accept/Reject</h1>
      <ol class="breadcrumb">
        <li><a href="manage_withdraw.php"><i class="fa fa-dashboard"></i> Manage Withdrawal</a></li>
        <li class="active"> Withdrawal Accept/Reject</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header box-header2">
              <div class="col-xs-12 text-center">
                <h3 class="box-title">
                  <?php 
				if((@$_GET['msg'])=="updt") 
				{ ?>
                  <font size="+1" color="#FF0000">Save Successfully......</font>
                  <?php  } ?>
                </h3>
              </div>
            </div>
            <!-- /.box-header -->
            
            <div class="col-sm-10 col-xs-offset-1 bg-success">
              <div class="box-body bg-succesd">
                <div class="col-md-12 bg-success">
                  <div class="box box-solid bg-succesd">
                  <h3 class="box-title text-center text-danger">
                      <?php echo strtoupper($Result['payout'] ?? '').' Withdrawal';?></h3>

                    <div class="box-header with-border bg-success">
                    
                      <div class="col-md-12">
                           <div class="col-md-6">
                           <br>
                          <div class="container-fluid   d-flex  justify-content-center">
                          <p style="font-size:40px; text-align: center; color: black;"> Payout</p>
                          <div class="img-container">
                          <img src="1631338755611.png" alt="payment success" style="text-align: center;" width="200" height="200">
                          <p style="font-size:60px; text-align: center; color: green;">Transaction Successful.</p>
                         
                          </div>
                          </div>
                 <table class="table">
  <tbody>
    <tr>
      <td style="color: blue; font-size:25px;" scope="col">Mobile:</td>
      <td style="color: blue; font-size:25px;" scope="col" ><?php echo $Result['mobile'] ?? '';?></td>
      
    </tr>
  
  
    <tr>
      
      <td style="color: blue; font-size:25px;">Date:</td>
      <td style="color: blue; font-size:25px;"><?php echo !empty($Result['createdate']) ? date('d-m-Y',strtotime($Result['createdate'])) : '01-01-1970'; ?>
                          </td>
      
    </tr>
    </table>
                          
                          
                          
                        </div>
                        <div class="col-md-6">
                          <br>
                          <table class="table">
  <tbody>
    <tr>
      <td style="color: blue; font-size:50px;" scope="col">Amount:</td>
      <td style="color: blue; font-size:25px;" scope="col"><i class="red_txt" style="font-size:50px;"><?php echo number_format($Result['amount'] ?? 0, 2);?></i></td>
      
    </tr>
    </tbody>
    </table>
                          
                          
                          <?php if (isset($Result['payout']) && $Result['payout']=='upi'){?>
          <h4 style="color: blue; font-size:25px;" ><strong>Upi:</strong> <?php echo $Result['bankname'] ?? '';?></h4>
                          <?php }else{?>
                         <h4 style="color: blue; font-size:25px;"><strong>Account Holder Name:</strong> <?php echo $Result['name'] ?? '';?></h4>
                         
                          <h4 style="color: blue; font-size:25px;"><strong>Bank Name:</strong> <?php echo $Result['bankname'] ?? '';?></h4>
                          <h4 style="color: blue; font-size:25px;"><strong>IFSC Code:</strong> <?php echo $Result['ifsc'] ?? '';?></h4>
                          <h4 style="color: blue; font-size:25px;"><strong>Account Number:</strong> <?php echo $Result['account'] ?? '';?></h4>
                          <?php }?>
           
                        </div>
                      </div>
                      <p>&nbsp;</p>
                      <div class="col-md-12">
                      <?php if(isset($Result['status']) && $Result['status']==0){?>
                        <div class="col-md-12 text-center"> 
						<a href="javascript:void(0);" class="btn btn-success"><strong><i class="fa fa-check"></i> Accepted</strong></a></div>
                        <?php }else if(isset($Result['status']) && $Result['status']==2){?>
                        <div class="col-md-12 text-center"> 
						<a href="javascript:void(0);" class="btn btn-danger"><strong><i class="fa fa-times"></i> Rejected</strong></a></div>
						<?php }else if(isset($Result['status']) && $Result['status']==1){?><div class="col-md-6 "><a href="javascript:void(0);" class="btn btn-success btn-block" onClick="acceptrejectconfirm(<?php echo $Result['id'] ?? 0;?>,'accept');"><strong><i class="fa fa-check"></i> Accept</strong></a> </div>
                        <div class="col-md-6 "> <a href="javascript:void(0);" class="btn btn-danger btn-block" onClick="acceptrejectconfirm(<?php echo $Result['id'] ?? 0;?>,'reject');"><strong><i class="fa fa-times"></i> Reject</strong></a> </div>
                        <?php }?>
                      </div>
                      
                    </div>
                    
                    <!-- /.box-body --> 
                  </div>
                  <!-- /.box --> 
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  
  <?php  include("include/footer.inc.php");?>
</div>
<div id="confirm" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="padding:8px;">
      <div class="modal-body text-center">Are you sure you want to <span id="typetext"></span>?</div>
<input type="hidden" id="id" name="id" value="">
<input type="hidden" id="type" name="type" value="">
      <div class="text-center">
    <a type="button" class="btn btn-sm btn-success text-light" onClick="acceptreject();">&nbsp;YES&nbsp;</a>&nbsp;
    <a type="button" class="btn btn-sm btn-danger text-light" data-dismiss="modal">&nbsp;NO&nbsp;</a>
    </div> 
    </div>
  </div>
</div>
<script type="text/javascript">
function acceptrejectconfirm(Id,type) {
 $('#confirm').modal({backdrop: 'static', keyboard: false})  
     $('#confirm').modal('show');
	 $('#id').val(Id);
	 $('#type').val(type);
	 document.getElementById('typetext').innerHTML = type;
       }

function acceptreject() {
var Id=$('#id').val();
var Type=$('#type').val();

               $.ajax({
                   type: "Post",
                  data:"id=" + Id + "& type=" + Type ,
                   url: "manage_withdrawaAction.php",
                   success: function (html) {
                       //alert(html);
                       window.location = '';
                       return false;
                   },
                   error: function (e) {
                   }
               });

       }
</script>
</body>
</html>
