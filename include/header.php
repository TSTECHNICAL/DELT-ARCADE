// admin/include/header.php

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/apple-glass-header.css">
<link rel="stylesheet" href="css/glassmorphism-menu.css">
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");
  * {
    box-sizing: border-box;
    scroll-behavior: smooth;
    font-family: 'Poppins', sans-serif;
  }
  
  body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background-color: #f5f5f5;
    overflow-x: hidden;
    transition: background-color 0.5s ease, color 0.5s ease;
  }
  
  [data-bs-theme="dark"] body {
    background-color: #121212;
    color: #f5f5f5;
  }
  
  .bg-gradient {
    background: linear-gradient(135deg, #1dcc70, #9c27b0, #ff2d55);
    background-size: 200% 200%;
    animation: gradientAnimation 15s ease infinite;
  }
  
  @keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
</style>
<header class="apple-glass-header">
  <div class="header-container">
    <div class="logo-section">
      <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
      </button>
    <img src="../assets/img/sample/logo.png" alt="Logo" class="logo-img" />
      <div class="brand-text">
        <span>DELT ARCADE</span>
        <small>Admin Panel</small>
      </div>
    </div>
    <div class="actions-section">
      <!-- Search Bar -->
      <div class="search-bar">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Search...">
      </div>
      
      <!-- Quick Actions -->
      <div class="quick-actions d-none d-md-flex">
        <a href="manage_user.php" class="quick-action-btn">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
        <a href="manage_withdraw.php" class="quick-action-btn">
          <i class="fas fa-money-bill-wave"></i>
          <span>Withdrawals</span>
        </a>
      </div>
      
      <!-- Notification Icon -->
      <div class="notification-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="notification-badge"></span>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><h6 class="dropdown-header">Notifications</h6></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-user-plus"></i> New user registered</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-money-bill-wave"></i> New withdrawal request</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle"></i> System alert</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
        </ul>
      </div>
      
<!-- Theme Toggle -->
<button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle dark mode">
  <i class="fas fa-moon"></i>
</button>
      <!-- User Profile -->
      <div class="user-profile" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="images/user.png" alt="Admin" class="user-avatar">
        <div class="user-info d-none d-md-block">
          <div class="user-name"><?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin'; ?></div>
          <div class="user-role">Administrator</div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <div class="px-4 py-3 text-center">
              <img src="images/user.png" alt="Admin" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
              <h5 class="mb-0"><?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin'; ?></h5>
              <small class="text-muted">Administrator</small>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> My Profile</a></li>
          <li><a class="dropdown-item" href="change_password.php"><i class="fas fa-key"></i> Change Password</a></li>
          <li><a class="dropdown-item" href="site_setting.php"><i class="fas fa-cog"></i> Settings</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>
<link rel="stylesheet" href="css/form-custom.css">
<script src="js/dark-mode.js"></script>
<script src="js/apple-glass-header.js"></script>
<script src="js/apple-glass-hover.js"></script>