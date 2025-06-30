
<style>
  /* Enhanced Modern Sidebar Styling with Apple Glass UI */
  .sidebar {
    width: var(--sidebar-width);
    height: calc(100vh - var(--header-height));
    position: fixed;
    top: var(--header-height);
    left: 0;
    bottom: 0;
    background: var(--glass-bg);
    backdrop-filter: blur(var(--glass-blur));
    -webkit-backdrop-filter: blur(var(--glass-blur));
    border-right: 1px solid var(--glass-border);
    z-index: 1030;
    transition: transform var(--transition-speed) ease, width var(--transition-speed) ease;
    box-sizing: border-box;
    box-shadow: 0 4px 30px var(--glass-shadow);
    overflow-y: auto;
    scrollbar-width: thin;
    transform: translateX(0); /* Default state is visible */
  }
  
  .sidebar::-webkit-scrollbar {
    width: 5px;
  }
  
  .sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
  }
  
  .content-wrapper {
    margin-left: var(--sidebar-width) !important;
    margin-top: var(--header-height) !important;
    transition: margin-left var(--transition-speed) ease;
    position: relative;
    min-height: calc(100vh - var(--header-height));
    padding: 20px;
    background-color: transparent;
  }
  
  body.sidebar-collapsed .content-wrapper {
    margin-left: 0 !important;
  }
  
  /* Dark mode support */
  @media (prefers-color-scheme: dark) {
    .sidebar {
      background: var(--glass-bg);
      border-right: 1px solid var(--glass-border);
      box-shadow: 0 4px 30px var(--glass-shadow);
    }
    
    .sidebar::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.2);
    }
  }
  
  /* Add sidebar-with-glass-header class for JavaScript control */
  .sidebar-with-glass-header {
    top: var(--header-height);
    height: calc(100vh - var(--header-height));
  }
  
  .sidebar-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
    box-sizing: border-box;
    padding: 0.75rem;
  }
  
  /* Admin Profile Styling */
  .admin-profile {
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 1rem;
  }
  
  .profile-card {
    background: linear-gradient(135deg, var(--glass-primary), var(--glass-danger));
    border-radius: var(--card-border-radius);
    padding: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--glass-border);
    overflow: hidden;
    transition: all var(--transition-speed) ease;
  }
  
  .profile-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
  }
  
  .profile-image {
    position: relative;
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #10b981;
    border: 2px solid #ffffff;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    animation: pulse 2s infinite;
  }
  
  .profile-info {
    flex-grow: 1;
    min-width: 0;
    margin-left: 1rem;
  }
  
  .profile-info h5 {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 160px;
  }
  
  .profile-info p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
  }
  
  .profile-stats {
    display: flex;
    gap: 1rem;
    margin-top: 0.5rem;
  }
  
  .stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .stat-value {
    font-weight: 600;
    color: #ffffff;
    font-size: 0.9rem;
  }
  
  .stat-label {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.7);
  }
  
  /* Navigation styling */
  .sidebar-menu {
    padding: 0.5rem 0;
    width: 100%;
    overflow-x: hidden;
    box-sizing: border-box;
    flex-grow: 1;
  }
  
  .sidebar-menu .nav {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
  }
  
  .nav-section {
    margin-bottom: 1rem;
  }
  
  .nav-section-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: rgba(255, 255, 255, 0.6);
    padding: 0.5rem 1rem;
    margin-bottom: 0.5rem;
  }
  
  .nav-link {
    color: var(--text-color);
    padding: 0.75rem 1rem;
    border-radius: var(--button-border-radius);
    margin: 0.25rem 0.5rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-left: 3px solid transparent;
    text-decoration: none;
  }
  
  .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--text-color);
    border-left-color: var(--notification-badge-color);
  }
  
  .nav-link.active {
    background-color: rgba(255, 255, 255, 0.15);
    color: var(--text-color);
    border-left-color: var(--notification-badge-color);
    font-weight: 600;
  }
  
  .nav-link i:first-child {
    width: 24px;
    text-align: center;
    font-size: 1.1rem;
    margin-right: 10px;
    opacity: 0.9;
  }
  
  .nav-link .badge {
    margin-left: auto;
    background: var(--notification-badge-color);
    color: white;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    border-radius: 10px;
  }
  
  .nav-link .fa-chevron-down,
  .nav-link .fa-chevron-right {
    margin-left: auto;
    font-size: 0.75rem;
    transition: transform 0.2s ease;
    opacity: 0.7;
  }
  
  .nav-link[aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
  }
  
  /* Submenu styling */
  .submenu {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: var(--button-border-radius);
    margin: 0.25rem 0.75rem 0.5rem 1.5rem;
    overflow: hidden;
    box-shadow: inset 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border-left: 1px solid var(--glass-border);
  }
  
  .submenu .nav-link {
    padding: 0.6rem 1rem;
    font-size: 0.85rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-radius: var(--button-border-radius);
    margin: 0.25rem 0.5rem;
    border-left: none;
    font-weight: normal;
  }
  
  .submenu .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.08);
  }
  
  .submenu .nav-link.active {
    background-color: rgba(255, 255, 255, 0.12);
    color: var(--text-color);
    font-weight: 500;
  }
  
  .submenu .nav-link i:first-child {
    font-size: 0.7rem;
    margin-right: 8px;
  }
  
  /* Collapse animation */
  .collapse {
    transition: all 0.35s ease;
  }
  
  /* Section divider */
  .section-divider {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 1rem 1.25rem 0.5rem;
    font-weight: 600;
  }
  
  /* Sidebar base styles for all screen sizes */
  .sidebar {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 280px;
    top: var(--header-height); /* Use the header height variable */
    height: calc(100vh - var(--header-height));
    z-index: 1040;
    transition: transform 0.3s ease;
  }
  
  /* Collapsed sidebar state */
  body.sidebar-collapsed .sidebar {
    transform: translateX(-100%);
  }
  
  /* Sidebar backdrop for all screen sizes */
  body.sidebar-open {
    overflow: hidden;
  }
  
  .sidebar-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1035;
    display: none;
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    transition: opacity 0.3s ease;
    opacity: 0;
  }
  
  body.sidebar-open .sidebar-backdrop {
    display: block;
    opacity: 1;
  }
    
  /* Content wrapper styles for mobile */
  @media (max-width: 991.98px) {
    .content-wrapper {
      margin-left: 0 !important;
      width: 100%;
      padding: 15px;
    }
  }
  
  /* Fix for sidebar toggle button - always visible */
  .sidebar-toggle {
    display: block !important;
    z-index: 1050;
  }
  
  /* Dark mode support */
  [data-bs-theme="dark"] .sidebar {
    background-color: #212529;
    border-right-color: #495057;
  }
  
  [data-bs-theme="dark"] .user-panel {
    background-color: rgba(255, 255, 255, 0.05);
    border-bottom-color: #495057;
  }
  
  [data-bs-theme="dark"] .nav-link {
    color: #e9ecef;
  }
  
  [data-bs-theme="dark"] .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
  }
  

  
  @media (max-width: 991.98px) {
    .content-wrapper {
      margin-left: 0;
      min-height: calc(100vh - 56px);
    }
  }
  /* Search bar styling */
  .search-container {
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 1.25rem;
  }
  
  .search-wrapper {
    position: relative;
    width: 100%;
    border-radius: 0.5rem;
    background-color: rgba(0, 0, 0, 0.03);
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
  }
  
  .search-wrapper:hover {
    border-color: rgba(220, 53, 69, 0.2);
  }
  
  .search-wrapper:focus-within {
    background-color: #fff;
    border-color: rgba(220, 53, 69, 0.3);
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
  }
  
  .search-icon {
    position: absolute;
    left: 12px;
    color: rgba(220, 53, 69, 0.7);
    font-size: 14px;
  }
  
  .search-clear {
    position: absolute;
    right: 12px;
    color: #6c757d;
    font-size: 12px;
    cursor: pointer;
    display: none;
    width: 18px;
    height: 18px;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    text-align: center;
    line-height: 18px;
    transition: all 0.2s ease;
  }
  
  .search-clear:hover {
    background-color: rgba(220, 53, 69, 0.2);
    color: #dc3545;
  }
  
  .search-input {
    width: 100%;
    background: transparent;
    border: none;
    padding: 10px 15px 10px 35px;
    font-size: 14px;
    color: #495057;
    outline: none;
    transition: all 0.2s ease;
  }
  
  .search-input::placeholder {
    color: #adb5bd;
    font-style: italic;
  }
  
  /* Dark mode support */
  [data-bs-theme="dark"] .search-wrapper {
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
  }
  
  [data-bs-theme="dark"] .search-wrapper:hover {
    border-color: rgba(255, 255, 255, 0.2);
  }
  
  [data-bs-theme="dark"] .search-wrapper:focus-within {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: rgba(220, 53, 69, 0.5);
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
  }
  
  [data-bs-theme="dark"] .search-input {
    color: #e9ecef;
  }
  
  [data-bs-theme="dark"] .search-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
  }
  
  [data-bs-theme="dark"] .search-clear {
    background-color: rgba(255, 255, 255, 0.2);
  }
  
  [data-bs-theme="dark"] .search-clear:hover {
    background-color: rgba(220, 53, 69, 0.4);
  }
</style>

<!-- JavaScript for sidebar functionality -->
<!-- Include glassmorphism CSS -->
<link rel="stylesheet" href="css/glassmorphism.css">

<aside class="sidebar glassmorphism">
  <div class="sidebar-wrapper">
    <!-- Profile card removed as requested -->
    <!-- Redesigned search form --> 
    <div class="search-container px-3 mb-3">
      <div class="search-wrapper">
        <label for="sidebarSearch" class="visually-hidden">Search menu</label>
        <i class="fa fa-search search-icon"></i>
        <input type="text" id="sidebarSearch" class="search-input" placeholder="Search menu..." aria-label="Search">
        <i class="fa fa-times search-clear" id="clearSearch" style="display: none;"></i>
      </div>
    </div>
    <!-- sidebar menu -->
    <div class="sidebar-menu" style="max-width: 100%;">
      <div class="px-3 mb-2 text-uppercase fw-bold small text-muted">Main Navigation</div>
      <ul class="nav flex-column" id="sidebarNav">
      <?php 
$session_role = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : 0;
$url = basename($_SERVER['PHP_SELF']);
$chkurl = mysqli_query($con, "SELECT `id`, `p_id` FROM `child_menu` WHERE `url`='$url' AND `status`='1'");
$chkurl_result = mysqli_fetch_array($chkurl);
$chk = ($chkurl_result !== null) ? $chkurl_result['p_id'] : 0;
$chkid = ($chkurl_result !== null) ? $chkurl_result['id'] : 0;
$valurl = mysqli_query($con, "SELECT * FROM `task` WHERE `role_id`='$session_role' AND task LIKE '%$chk%' AND `status`='1'");
$val_row = mysqli_num_rows($valurl);

if($val_row == '0') {
    session_start();
    session_unset();
    session_destroy();
    header("location:index.php?msg1=notauthorized");
} else {
    $task = mysqli_query($con, "SELECT * FROM `task` WHERE `role_id`='$session_role' AND `status`='1'");
    $task_result = mysqli_fetch_array($task);
    $taskid = $task_result['task'];	
    $parent = mysqli_query($con, "SELECT * FROM `services` WHERE id IN($taskid) AND `status`='1'");
    
    while(@$parent_array = mysqli_fetch_array($parent)) {
        $isActive = ($parent_array['url'] == $url || $chk == $parent_array['id']) ? true : false;
        
        if($parent_array['url'] == 'desktop.php') {
        ?>
        <li class="nav-item mb-1"> 
            <a href="<?php echo $parent_array['url']; ?>" class="nav-link <?php echo ($isActive) ? 'active' : ''; ?>"> 
                <i class="fa fa-dashboard me-2"></i>
                <span><?php echo $parent_array['services']; ?></span>
            </a>
        </li>
        <?php } else { 
            // Check if any child menu is active to expand parent
            $hasActiveChild = false;
            $childQuery = mysqli_query($con, "SELECT * FROM `child_menu` WHERE `p_id`='{$parent_array['id']}' AND `status`='1'");
            while($childCheck = mysqli_fetch_array($childQuery)) {
                if($childCheck['url'] == $url) {
                    $hasActiveChild = true;
                    break;
                }
            }
            mysqli_data_seek($childQuery, 0); // Reset pointer
        ?>
        <li class="nav-item mb-1"> 
            <a href="javascript:void(0);" class="nav-link menu-toggle <?php echo ($isActive || $hasActiveChild) ? 'active' : ''; ?>" 
               data-menu-id="menu-<?php echo $parent_array['id']; ?>">
                <i class="fa fa-list-alt me-2"></i>
                <span><?php echo $parent_array['services']; ?></span>
                <i class="fa fa-chevron-down ms-auto small"></i>
            </a>
            <div class="collapse <?php echo ($isActive || $hasActiveChild) ? 'show' : ''; ?>" id="menu-<?php echo $parent_array['id']; ?>">
                <ul class="nav flex-column ms-3 mt-1 submenu">
                <?php 
                while($child_array = mysqli_fetch_array($childQuery)) { 
                    $childActive = ($child_array['url'] == $url) ? true : false;
                ?>
                    <li class="nav-item"> 
                        <a href="<?php echo $child_array['url']; ?>" class="nav-link py-2 <?php echo ($childActive) ? 'active' : ''; ?>">
                            <i class="fa fa-circle-o me-2 small"></i>
                            <span><?php echo $child_array['child']; ?></span>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </li>
        <?php }
    }
}
?>
      </ul>
    </div>
  </div>
</aside>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebarToggler = document.querySelector('.sidebar-toggler');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const body = document.body;
    
    // Use either sidebar-toggler or sidebar-toggle (whichever is available)
    const toggleButton = sidebarToggler || sidebarToggle;
    
    if (toggleButton) {
      toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('show');
        body.classList.toggle('sidebar-open');
      });
    }
    
    // Create backdrop for sidebar if it doesn't exist
    let backdrop = document.querySelector('.sidebar-backdrop');
    if (!backdrop) {
      backdrop = document.createElement('div');
      backdrop.className = 'sidebar-backdrop glassmorphism-backdrop';
      document.body.appendChild(backdrop);
      
      // Close sidebar when clicking outside
      backdrop.addEventListener('click', function() {
        sidebar.classList.remove('show');
        body.classList.remove('sidebar-open');
        document.body.classList.add('sidebar-collapsed');
        
        // Update sidebar transform
        if (sidebar) {
          sidebar.style.transform = 'translateX(-100%)';
        }
        
        // Hide backdrop
        backdrop.style.opacity = '0';
        setTimeout(() => {
          backdrop.style.display = 'none';
        }, 300);
      });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth > 991.98) {
        // On desktop view
        sidebar.classList.remove('show');
        body.classList.remove('sidebar-open');
        
        // Hide sidebar toggle button in desktop view
        const sidebarToggleBtn = document.querySelector('.sidebar-toggle');
        if (sidebarToggleBtn) {
          sidebarToggleBtn.style.display = 'none';
        }
        
        // If sidebar is not collapsed, ensure proper styling
        if (!document.body.classList.contains('sidebar-collapsed')) {
          if (sidebar) {
            sidebar.style.transform = 'translateX(0)';
          }
          
          // Hide backdrop
          if (backdrop) {
            backdrop.style.opacity = '0';
            backdrop.style.display = 'none';
          }
        }
      } else {
        // On mobile view, show the sidebar toggle button
        const sidebarToggleBtn = document.querySelector('.sidebar-toggle');
        if (sidebarToggleBtn) {
          sidebarToggleBtn.style.display = 'flex';
        }
      }
    });
    
    // Menu toggle functionality - hide submenu when clicked a second time
    const menuToggles = document.querySelectorAll('.menu-toggle');
    menuToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const menuId = this.getAttribute('data-menu-id');
        const targetMenu = document.getElementById(menuId);
        
        // Toggle the menu
        if (targetMenu) {
          // If it's already open, close it
          if (targetMenu.classList.contains('show')) {
            targetMenu.classList.remove('show');
            // Update the chevron icon
            const chevron = this.querySelector('.fa-chevron-down');
            if (chevron) {
              chevron.classList.remove('fa-chevron-down');
              chevron.classList.add('fa-chevron-right');
            }
          } else {
            // Close all other open menus first (optional - for accordion style)
            document.querySelectorAll('.submenu').forEach(submenu => {
              if (submenu.id !== menuId && submenu.classList.contains('show')) {
                submenu.classList.remove('show');
                // Update other chevron icons
                const otherToggle = document.querySelector(`[data-menu-id="${submenu.id}"]`);
                if (otherToggle) {
                  const otherChevron = otherToggle.querySelector('.fa-chevron-down');
                  if (otherChevron) {
                    otherChevron.classList.remove('fa-chevron-down');
                    otherChevron.classList.add('fa-chevron-right');
                  }
                }
              }
            });
            
            // Open this menu
            targetMenu.classList.add('show');
            // Update the chevron icon
            const chevron = this.querySelector('.fa-chevron-right, .fa-chevron-down');
            if (chevron) {
              chevron.classList.remove('fa-chevron-right');
              chevron.classList.add('fa-chevron-down');
            }
          }
        }
      });
    });
    
    // Initialize chevron icons based on menu state
    menuToggles.forEach(toggle => {
      const menuId = toggle.getAttribute('data-menu-id');
      const targetMenu = document.getElementById(menuId);
      const chevron = toggle.querySelector('.fa-chevron-down');
      
      if (targetMenu && !targetMenu.classList.contains('show') && chevron) {
        chevron.classList.remove('fa-chevron-down');
        chevron.classList.add('fa-chevron-right');
      }
    });
    
    // Search functionality
    const searchInput = document.getElementById('sidebarSearch');
    const clearSearch = document.getElementById('clearSearch');
    const navItems = document.querySelectorAll('#sidebarNav .nav-item');
    const navLinks = document.querySelectorAll('#sidebarNav .nav-link');
    
    if (searchInput) {
      // Search input event
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        // Show/hide clear button
        if (searchTerm.length > 0) {
          clearSearch.style.display = 'block';
        } else {
          clearSearch.style.display = 'none';
        }
        
        // Filter menu items
        filterMenuItems(searchTerm);
      });
      
      // Clear search
      if (clearSearch) {
        clearSearch.addEventListener('click', function() {
          searchInput.value = '';
          this.style.display = 'none';
          filterMenuItems('');
          searchInput.focus();
        });
      }
    }
    
    // Function to filter menu items
    function filterMenuItems(searchTerm) {
      // If empty search, reset everything
      if (searchTerm === '') {
        navItems.forEach(item => {
          item.style.display = '';
          
          // Reset collapsed menus to their original state
          const collapse = item.querySelector('.collapse');
          if (collapse) {
            // Only keep 'show' class if it had the 'active' class
            const navLink = item.querySelector('.nav-link');
            if (navLink && navLink.classList.contains('active')) {
              collapse.classList.add('show');
            } else {
              collapse.classList.remove('show');
            }
          }
        });
        return;
      }
      
      // Hide all items initially
      navItems.forEach(item => {
        item.style.display = 'none';
      });
      
      // Show items that match the search term
      navLinks.forEach(link => {
        const text = link.textContent.toLowerCase();
        const parentItem = link.closest('.nav-item');
        
        if (text.includes(searchTerm)) {
          // Show this item
          if (parentItem) {
            parentItem.style.display = '';
            
            // If it's a submenu item, also show its parent
            const parentMenu = parentItem.closest('.collapse');
            if (parentMenu) {
              parentMenu.classList.add('show');
              const parentNavItem = parentMenu.closest('.nav-item');
              if (parentNavItem) {
                parentNavItem.style.display = '';
              }
            }
          }
        }
      });
    }
  });
</script>