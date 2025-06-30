<?php
// Database connection
include("../assets/include/connection.php");

// SQL to remove the 'manage banner' entry from the navigation
// Removed ID restriction to ensure all instances are deleted
$sql = "DELETE FROM child_menu WHERE child = 'Manage Banner' AND url = 'manage_banner.php'";

// Execute the query
$result = mysqli_query($con, $sql);
$success = $result && mysqli_affected_rows($con) > 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Removing Banner Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .processing-container {
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
    </style>
</head>
<body>
    <div class="processing-container">
        <h3>Processing Navigation Update</h3>
        <p>Please wait while we update your navigation menu...</p>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if($success): ?>
        Swal.fire({
            title: 'Success',
            text: 'Manage Banner entry removed successfully from navigation!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            backdrop: `
                rgba(0,0,123,0.4)
                url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M25,2 L75,2 C88,2 98,12 98,25 L98,75 C98,88 88,98 75,98 L25,98 C12,98 2,88 2,75 L2,25 C2,12 12,2 25,2 Z' fill='none' stroke='%23fff' stroke-width='4'/%3E%3Cpath d='M77.5,55.5 L44.5,87.5 C43.5,88.5 42,88.5 41,87.5 L22.5,69.5 C21.5,68.5 21.5,67 22.5,66 L27,61.5 C28,60.5 29.5,60.5 30.5,61.5 L41,72 L66.5,46.5 C67.5,45.5 69,45.5 70,46.5 L74.5,51 C75.5,52 75.5,53.5 74.5,54.5 L77.5,55.5 Z' fill='%23fff'/%3E%3C/svg%3E")
                center 40% no-repeat
            `
        }).then(function() {
            window.location.href = 'desktop.php';
        });
        <?php else: ?>
        Swal.fire({
            title: 'Error',
            text: 'Error removing Manage Banner entry: <?php echo mysqli_error($con); ?>',
            icon: 'error',
            confirmButtonColor: '#3085d6'
        }).then(function() {
            window.location.href = 'desktop.php';
        });
        <?php endif; ?>
    });
    </script>
</body>
</html>