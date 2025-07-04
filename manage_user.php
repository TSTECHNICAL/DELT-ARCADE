<?php 
ob_start();
session_start();
if($_SESSION['userid']=="")
{
	header("location:index.php?msg1=notauthorized");
	exit();
}
	?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | Manage User</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
<?php include ("../assets/include/connection.php");?>
<?php include ("include/header.inc.php");?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php include ("include/navigation.inc.php");?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manage User</h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header box-header2">
            <div class="col-xs-6 text-right">
         <h3 class="box-title"><?php 
				if(isset($_GET['msg'])=="updt") 
				{ ?>
                <font size="+1" color="#FF0000">Update Successfully...</font>
                <?php  } ?></h3>
         </div>
              <div class="col-sm-6">
              <div class="pull-right">&nbsp;</div>
       </div>
      
            </div>
            <!-- /.box-header -->
            <div class="box-body">
  <form id="formID" name="formID" method="post" action="#" enctype="multipart/form-data">
          <div class="table-responsive"> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Mobile</th>
                <th>Email</th>
                <th>Own Code</th>
                <th>Ref. Code</th>
                <th>Cust ID</th>
                <th>Member</th>
                <th>Wallet</th>
                <th>Recharge</th>
                <th>Reg. Date</th>
                 <th>Action</th>
                </tr>
                </thead>
                <tbody>
     <?php
  $Query=mysqli_query($con,"select * from `tbl_user` order by id desc");
  $i=0; 
  while($row=mysqli_fetch_array($Query)){$i++;?>  
                  <tr>
              <td><?php echo @$row["mobile"]; ?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo @$row["owncode"]; ?></td>
              <td><?php echo @$row["code"]; ?></td>
              <td> <?php echo sprintf("%06d",@$row["id"]);?></td>
               <td> Member <?php echo $row["id"];?></td>
              <td><?php echo number_format(wallet($con,'amount',$row["id"]),2);?>&nbsp;<a href="javascript:void(0);" onClick="edit(<?php echo $row['id']; ?>,<?php echo @$row["mobile"]; ?>,<?php echo wallet($con,'amount',$row["id"]);?>)" class="text-aqua" title="Delete"><i class="fa fa-edit"></i></a>              
              </td>
              </td>
              <td><?php 
			  $totalrecharge=mysqli_query($con,"select sum(`amount`)as total from  `tbl_walletsummery` where `userid`='".$row["id"]."' and `actiontype`='recharge'");
			  $totalResult=mysqli_fetch_array($totalrecharge);
			  echo number_format($totalResult['total'],2);?></td>
              <td><?php echo @date('d-m-Y', strtotime($row['createdate']));?></td>
              
			  <td>
              
              <a href="javascript:void(0);" onClick="delete_row(<?php echo $row['id']; ?>)" class="update-person" style="color:#f56954; font-size:16px;" title="Delete"><i class="fa fa-trash"></i></a>
			  <?php 
	  if($row['status']==1){
	  ?>
      &nbsp;
      <a href="javascript:void(0);" onClick="Respond(<?php echo $row['id']; ?>)" class="update-person" style="color:#090; font-size:16px;" data-toggle="tooltip" title="Publish"><i class="fa fa-check-square-o"></i></a>
      <?php } else if($row['status']==0){?>
      &nbsp;
      <a href="javascript:void(0);" onClick="UnRespond(<?php echo $row['id']; ?>)" class="update-person" style="color:#f00; font-size:16px;" data-toggle="tooltip" title="Unpublish"><i class="fa fa-square-o"></i></a>
       <?php }?>
      
       </td>
                </tr>
        <?php }?>
               
               
                </tbody>
                
              </table>
             </div>
   <div class="box-header box-header2" style="margin-bottom: 10px;">&nbsp; </div>
<div class="row">              
<div class="col-sm-10"></div>
              <div class="col-sm-2">
               &nbsp;
            </div>
              </div>
              </form>
            </div>
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
  <div id="excel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="chn">Change Amount<br>
<small id="mob"></small></h4>
              </div>
  <form name="type" id="type" enctype="multipart/form-data" action="#" method="post">
              <div class="modal-body">
              
              <div class="form-group ">
                  <label for="add_item">Amount</label>  
   <input class="form-control" id="amount" name="amount" type="text" value="" onkeypress="return isNumber(event)" required>
    <input class="form-control" id="editid" name="editid"  type="hidden">
    <i id="error"></i>
                </div>
            			
              </div>
              <div class="modal-footer">
                
  <button type="submit" class="btn btn-danger" id="add_role">Save</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
         
</div>
<?php include("include/footer.inc.php");?></div>
<!-- ./wrapper -->
 

<script>

  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
	  "pageLength": 100
    });
  });
</script>
<script type="text/javascript">

function edit(id,mob,balance) {
$('#excel').modal({backdrop: 'static', keyboard: false})   
 $('#excel').modal('show');
 document.getElementById('mob').innerHTML = 'Mobile: '+mob;
 document.getElementById('amount').value = balance;
 document.getElementById('editid').value = id;
}

$(document).ready(function () {
		$("#type").on('submit',(function(e) {
		e.preventDefault();
		
		// Validate amount field
		var amount = $('#amount').val();
		if (amount == "" || isNaN(amount)) {
            $("#amount").focus();
			$('#amount').css({'border-color': '#f00'});
			$('#error').html('<font color="#f00">Please enter a valid amount</font>');
            return false;
		}
		
		$.ajax({
			type: "POST", 
			url: "updatewalletNow.php",              
			data: new FormData(this), 
			contentType: false,       
			cache: false,             
			processData:false,       

			success: function(html)   
			{ //alert(html);
			if (html == 1) {
			showSuccessAlert("Amount update successfully...");			
            $("#type")[0].reset();
			 $('#excel').modal('hide');
			  window.location ='';
			}
			
			else if(html==0)
			{ showErrorAlert("Some Technical Error....");		
				}
			
			}
		});
	
	}));
	
	
	
});
</script>
<script type="text/javascript">
 function delete_row(Id) {
    // Use SweetAlert for confirmation instead of standard confirm
    Swal.fire({
        title: 'Confirm Deletion',
        text: "Are You Sure You Want To Delete?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "Post",
                data:"id=" + Id + "& type=" + "delete" ,
                url: "manage_userAction.php",
                success: function (html) { 
                    if(html==1){
                        showSuccessAlert("Selected Item Deleted Successfully...");
                        window.location = '';
                    }
                    else if(html==0){
                        showErrorAlert("Some Technical Problem");
                    }
                },
                error: function (e) {
                    showErrorAlert("An error occurred during the request.");
                }
            });
        }
    });
}
</script>
<script type="text/javascript">
 function Respond(Id) {
    // Use SweetAlert for confirmation instead of standard confirm
    Swal.fire({
        title: 'Confirm Unpublish',
        text: "Are you sure you want to Unpublish?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, unpublish it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "Post",
                data:"id=" + Id + "& type=" + "chk" ,
                url: "manage_userAction.php",
                success: function (html) {
                    //alert(html);
                    showSuccessAlert("User unpublished successfully");
                    window.location = '';
                    return false;
                },
                error: function (e) {
                    showErrorAlert("An error occurred during the request.");
                }
            });
        }
    });
}
</script>
<script type="text/javascript">
 function UnRespond(Id) {
    // Use SweetAlert for confirmation instead of standard confirm
    Swal.fire({
        title: 'Confirm Publish',
        text: "Are you sure you want to Publish?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, publish it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "Post",
                data:"id=" + Id + "& type=" + "unchk" ,
                url: "manage_userAction.php",
                success: function (html) {
                    //alert(html);
                    showSuccessAlert("User published successfully");
                    window.location = '';
                    return false;
                },
                error: function (e) {
                    showErrorAlert("An error occurred during the request.");
                }
            });
        }
    });
}
</script>

</body>
</html>
