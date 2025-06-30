<?php
/**
 * Admin Page Template
 * This is a template for creating new admin pages with the updated design
 * Copy this file and modify as needed for new admin pages
 */

ob_start();
session_start();
include("../assets/include/connection.php");

// Check if user is logged in
if(!isset($_SESSION['userid']) || $_SESSION['userid']=="") {
    header("location:index.php?msg1=notauthorized");
    exit();
}

// Page-specific PHP logic goes here

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Vclub Admin | Page Title</title>
  <?php include("include/admin-head.inc.php"); ?>
  
  <!-- Add any page-specific CSS here -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include("include/header.inc.php"); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <div class="sidebar sidebar-with-glass-header">
    <?php include("include/navigation.inc.php"); ?>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper content-wrapper-with-glass-header">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Title
        <small>Description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Page Title</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your page content goes here -->
      <div class="row">
        <div class="col-md-12">
          <div class="glass-card">
            <div class="card-header glass-card-header d-flex align-items-center">
              <i class="fa fa-file me-2"></i>
              <h3 class="card-title mb-0">Card Title</h3>
            </div>
            <div class="card-body">
              <!-- Card content goes here -->
              <p>This is a template for creating new admin pages with the updated design.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php include("include/footer.inc.php"); ?>
</div>
<!-- ./wrapper -->

<?php include("include/admin-scripts.inc.php"); ?>

<!-- Add any page-specific scripts here -->
<script>
  // Your page-specific JavaScript goes here
</script>

</body>
</html>