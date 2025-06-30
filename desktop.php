// admin/desktop.php
<?php 
ob_start();
session_start();
include("../assets/include/connection.php");
if(!isset($_SESSION['userid']) || $_SESSION['userid']=="")
{
    header("location:index.php?msg1=notauthorized");
    exit();
}
function counter($table){
  global $con;
  $rs=mysqli_query($con, "select count(*) from `$table`");
  $row = mysqli_fetch_row($rs);
  return $row[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Remixicon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins -->
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
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include ("include/header.inc.php");?>
 <div class="sidebar sidebar-with-glass-header">
 <?php include ("include/navigation.inc.php");?>
 </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper content-wrapper-with-glass-header">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box glass-card glass-card-primary">
            <span class="info-box-icon glass-icon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Users</span>
              <span class="info-box-number">
                <?php 
                  $userCount = mysqli_query($con, "SELECT COUNT(*) as total FROM tbl_user WHERE status='1'");
                  $userRow = mysqli_fetch_assoc($userCount);
                  echo number_format($userRow['total']);
                ?>
              </span>
              <div class="progress glass-progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">Active registered users</span>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box glass-card glass-card-success">
            <span class="info-box-icon glass-icon"><i class="fa fa-gift"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Rewards</span>
              <span class="info-box-number">
                <?php 
                  $rewardCount = mysqli_query($con, "SELECT COUNT(*) as total FROM tbl_reward");
                  $rewardRow = mysqli_fetch_assoc($rewardCount);
                  echo number_format($rewardRow['total']);
                ?>
              </span>
              <div class="progress glass-progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">Available reward items</span>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box glass-card glass-card-info">
            <span class="info-box-icon glass-icon"><i class="fa fa-credit-card"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Deposits</span>
              <span class="info-box-number">
                <?php 
                  $depositCount = mysqli_query($con, "SELECT COUNT(*) as total FROM tbl_walletsummery WHERE actiontype='deposit'");
                  $depositRow = mysqli_fetch_assoc($depositCount);
                  echo number_format($depositRow['total']);
                ?>
              </span>
              <div class="progress glass-progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">Successful transactions</span>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box glass-card glass-card-warning">
            <span class="info-box-icon glass-icon"><i class="fa fa-tasks"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Active Tasks</span>
              <span class="info-box-number">
                <?php 
                  $taskCount = mysqli_query($con, "SELECT COUNT(*) as total FROM task WHERE status='1'");
                  $taskRow = mysqli_fetch_assoc($taskCount);
                  echo number_format($taskRow['total']);
                ?>
              </span>
              <div class="progress glass-progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">Currently active tasks</span>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mt-4">
        <div class="col-md-8">
          <!-- RECENT ACTIVITY -->
          <div class="glass-card">
            <div class="card-header glass-card-header d-flex align-items-center">
              <i class="fa fa-list me-2"></i>
              <h3 class="card-title mb-0">Recent Activity</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover glass-table">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Action</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Get recent activity from wallet summary
                    $recentActivity = mysqli_query($con, "SELECT w.*, u.email FROM tbl_walletsummery w 
                                                          LEFT JOIN tbl_user u ON w.userid = u.id 
                                                          ORDER BY w.createdate DESC LIMIT 5");
                    while($activity = mysqli_fetch_assoc($recentActivity)) {
                      $actionType = ucfirst(htmlspecialchars($activity['actiontype']));
                      $statusClass = '';
                      $statusText = '';
                      
                      // Determine status based on action type
                      if ($actionType == 'Deposit') {
                        $statusClass = 'badge bg-success';
                        $statusText = 'Completed';
                      } else if ($actionType == 'Withdraw') {
                        $statusClass = 'badge bg-warning';
                        $statusText = 'Processed';
                      } else {
                        $statusClass = 'badge bg-info';
                        $statusText = 'Recorded';
                      }
                      
                      echo '<tr>';
                      echo '<td><span class="user-name">' . htmlspecialchars($activity['email'] ?? 'Unknown User') . '</span></td>';
                      echo '<td><span class="action-type">' . $actionType . '</span> <span class="amount">$' . htmlspecialchars($activity['amount']) . '</span></td>';
                      echo '<td>' . date('M d, Y H:i', strtotime($activity['createdate'])) . '</td>';
                      echo '<td><span class="' . $statusClass . '">' . $statusText . '</span></td>';
                      echo '</tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="text-end mt-3">
                <a href="transactions.php" class="btn btn-sm btn-primary glass-btn">View All Transactions</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <!-- QUICK LINKS -->
          <div class="glass-card mb-4">
            <div class="card-header glass-card-header d-flex align-items-center">
              <i class="fa fa-link me-2"></i>
              <h3 class="card-title mb-0">Quick Links</h3>
            </div>
            <div class="card-body p-0">
              <div class="list-group glass-list-group">
                <a href="reward_system.php" class="list-group-item glass-list-item d-flex align-items-center">
                  <div class="icon-wrapper me-3">
                    <i class="fa fa-gift"></i>
                  </div>
                  <div>
                    <span class="d-block">Reward System</span>
                    <small class="text-muted">Manage user rewards</small>
                  </div>
                </a>
                <a href="manage_adminuser.php" class="list-group-item glass-list-item d-flex align-items-center">
                  <div class="icon-wrapper me-3">
                    <i class="fa fa-users"></i>
                  </div>
                  <div>
                    <span class="d-block">Admin Users</span>
                    <small class="text-muted">Manage administrator accounts</small>
                  </div>
                </a>
                <a href="privacy.php" class="list-group-item glass-list-item d-flex align-items-center">
                  <div class="icon-wrapper me-3">
                    <i class="fa fa-lock"></i>
                  </div>
                  <div>
                    <span class="d-block">Privacy Policy</span>
                    <small class="text-muted">Update privacy settings</small>
                  </div>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#changepasword" class="list-group-item glass-list-item d-flex align-items-center">
                  <div class="icon-wrapper me-3">
                    <i class="fa fa-key"></i>
                  </div>
                  <div>
                    <span class="d-block">Change Password</span>
                    <small class="text-muted">Update your security credentials</small>
                  </div>
                </a>
              </div>
            </div>
          </div>
          
          <!-- SYSTEM INFO -->
          <div class="glass-card">
            <div class="card-header glass-card-header d-flex align-items-center">
              <i class="fa fa-info-circle me-2"></i>
              <h3 class="card-title mb-0">System Info</h3>
            </div>
            <div class="card-body">
              <ul class="system-info-list">
                <li>
                  <i class="fa fa-code"></i>
                  <span class="info-label">PHP Version:</span>
                  <span class="info-value"><?php echo phpversion(); ?></span>
                </li>
                <li>
                  <i class="fa fa-server"></i>
                  <span class="info-label">Server:</span>
                  <span class="info-value"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></span>
                </li>
                <li>
                  <i class="fa fa-calendar"></i>
                  <span class="info-label">Date:</span>
                  <span class="info-value" id="current-time"><?php echo date('Y-m-d H:i:s'); ?></span>
                </li>
                <li>
                  <i class="fa fa-tachometer-alt"></i>
                  <span class="info-label">Admin Panel:</span>
                  <span class="info-value">v2.1</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("include/footer.inc.php"); ?>
<script src="dist/js/pages/dashboard.js"></script>

<script>
// Function to update the time every second
function updateTime() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  
  const formattedTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
  document.getElementById('current-time').textContent = formattedTime;
}

// Update time immediately and then every second
updateTime();
setInterval(updateTime, 1000);
</script>

</div>

</body>
</html>
