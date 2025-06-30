<?php
include ("../assets/include/connection.php");
if($_POST['id'])
{

$id = isset($_POST['id']) ? $_POST['id'] : 0;

// Get user information
$userInfo = mysqli_query($con, "SELECT email FROM tbl_user WHERE id='$id' LIMIT 1");
$userRow = mysqli_fetch_assoc($userInfo);
$userEmail = isset($userRow['email']) ? $userRow['email'] : 'Unknown User';

// Get reward history
$sql = mysqli_query($con, "SELECT * FROM tbl_reward WHERE userid='$id' ORDER BY id DESC");

// Calculate total rewards
$totalQuery = mysqli_query($con, "SELECT SUM(amount) as total FROM tbl_reward WHERE userid='$id'");
$totalRow = mysqli_fetch_assoc($totalQuery);
$totalRewards = isset($totalRow['total']) ? $totalRow['total'] : 0;

if(mysqli_num_rows($sql) > 0) {
?>
<div class="user-reward-summary fade-in">
    <div class="alert alert-info">
        <h4><i class="fa fa-user"></i> User: <?php echo htmlspecialchars($userEmail); ?></h4>
        <p><strong>Total Rewards:</strong> $<?php echo number_format($totalRewards, 2); ?></p>
        <p><strong>Total Transactions:</strong> <?php echo mysqli_num_rows($sql); ?></p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            while($row = mysqli_fetch_array($sql)) { 
                $dateTime = strtotime($row['createdate']);
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td>
                    <span class="label label-success">$<?php echo number_format($row['amount'], 2); ?></span>
                </td>
                <td><?php echo date('M d, Y', $dateTime); ?></td>
                <td><?php echo date('h:i A', $dateTime); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="text-right">
    <a href="#" class="btn btn-default btn-sm" onclick="window.print();"><i class="fa fa-print"></i> Print History</a>
</div>
<?php } else { ?>
<div class="alert alert-warning">
    <h4><i class="icon fa fa-exclamation-triangle"></i> No Records Found</h4>
    <p>There are no reward records for this user. You can add a new reward using the form.</p>
</div>
<?php } ?>
<?php
}
?>