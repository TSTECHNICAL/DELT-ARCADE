/**
 * Enhanced Apple Liquid Glass Header JavaScript
 * Handles functionality for the Apple-style liquid glass header with modern features
 */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize the header functionality
  initAppleGlassHeader();
  // Theme toggle is now handled by dark-mode.js
  // initThemeToggle();
  initSearchBar();
  initDropdownMenus();
  initSubmenuToggle();
  initNotifications();
});

/**
 * Initialize the Apple Glass Header functionality
 */
function initAppleGlassHeader() {
  // Toggle sidebar when the sidebar toggle button is clicked
  const sidebarToggle = document.querySelector('.sidebar-toggle');
  const sidebar = document.querySelector('.sidebar');
  const contentWrapper = document.querySelector('.content-wrapper');
  const footer = document.querySelector('.footer-with-gradient');
  
  if (sidebarToggle && sidebar) {
    // Set initial state based on screen size
    if (window.innerWidth < 992) {
      document.body.classList.add('sidebar-collapsed');
      sidebar.style.transform = 'translateX(-100%)';
      if (contentWrapper) contentWrapper.style.marginLeft = '0';
      if (footer) footer.style.marginLeft = '0';
    }
    
    // Toggle sidebar on click
    sidebarToggle.addEventListener('click', function() {
      document.body.classList.toggle('sidebar-collapsed');
      
      if (document.body.classList.contains('sidebar-collapsed')) {
        // Sidebar is collapsed
        sidebar.style.transform = 'translateX(-100%)';
        document.body.classList.remove('sidebar-open');
        
        // Hide backdrop with animation
        const backdrop = document.querySelector('.sidebar-backdrop');
        if (backdrop) {
          backdrop.style.opacity = '0';
          setTimeout(() => {
            backdrop.style.display = 'none';
          }, 300);
        }
        
        // Update margins
        if (contentWrapper) contentWrapper.style.marginLeft = '0';
        if (footer) footer.style.marginLeft = '0';
      } else {
        // Sidebar is expanded
        sidebar.style.transform = 'translateX(0)';
        document.body.classList.add('sidebar-open');
        
        // Update margins based on screen size
        if (window.innerWidth >= 992) {
          if (contentWrapper) contentWrapper.style.marginLeft = 'var(--sidebar-width)';
          if (footer) footer.style.marginLeft = 'var(--sidebar-width)';
        }
        
        // Create backdrop if it doesn't exist (for mobile view)
        if (window.innerWidth < 992) {
          let backdrop = document.querySelector('.sidebar-backdrop');
          if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'sidebar-backdrop';
            document.body.appendChild(backdrop);
            
            // Close sidebar when backdrop is clicked
            backdrop.addEventListener('click', function() {
              document.body.classList.add('sidebar-collapsed');
              sidebar.style.transform = 'translateX(-100%)';
              document.body.classList.remove('sidebar-open');
              
              // Hide backdrop with animation
              this.style.opacity = '0';
              setTimeout(() => {
                this.style.display = 'none';
              }, 300);
              
              // Update margins
              if (contentWrapper) contentWrapper.style.marginLeft = '0';
              if (footer) footer.style.marginLeft = '0';
            });
          }
          
          // Show backdrop with animation
          backdrop.style.display = 'block';
          setTimeout(() => {
            backdrop.style.opacity = '1';
          }, 10);
        }
      }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 992) {
        // Desktop view
        if (!document.body.classList.contains('sidebar-collapsed')) {
          if (contentWrapper) contentWrapper.style.marginLeft = 'var(--sidebar-width)';
          if (footer) footer.style.marginLeft = 'var(--sidebar-width)';
        }
        
        // Hide backdrop if it exists
        const backdrop = document.querySelector('.sidebar-backdrop');
        if (backdrop) {
          backdrop.style.display = 'none';
        }
      } else {
        // Mobile view
        if (!document.body.classList.contains('sidebar-open')) {
          document.body.classList.add('sidebar-collapsed');
          sidebar.style.transform = 'translateX(-100%)';
          if (contentWrapper) contentWrapper.style.marginLeft = '0';
          if (footer) footer.style.marginLeft = '0';
        }
      }
    });
  }
}

/**
 * Initialize theme toggle functionality
 * Note: This function is now deprecated and replaced by dark-mode.js
 */
/*
function initThemeToggle() {
  const themeToggle = document.getElementById('themeToggle');
  const themeIcon = themeToggle ? themeToggle.querySelector('i') : null;
  
  // Check for saved theme preference or use system preference
  const savedTheme = localStorage.getItem('theme');
  const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  const currentTheme = savedTheme || systemTheme;
  
  // Apply theme on page load
  if (currentTheme === 'dark') {
    document.documentElement.setAttribute('data-bs-theme', 'dark');
    if (themeIcon) themeIcon.className = 'fas fa-sun';
  } else {
    document.documentElement.setAttribute('data-bs-theme', 'light');
    if (themeIcon) themeIcon.className = 'fas fa-moon';
  }
  
  // Toggle theme on click
  if (themeToggle) {
    themeToggle.addEventListener('click', function() {
      const currentTheme = document.documentElement.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      // Update theme
      document.documentElement.setAttribute('data-bs-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      
      // Update icon
      if (themeIcon) {
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
      }
      
      // Add animation effect
      document.body.classList.add('theme-transition');
      setTimeout(() => {
        document.body.classList.remove('theme-transition');
      }, 1000);
    });
  }
  
  // Listen for system theme changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
    if (!localStorage.getItem('theme')) {
      const newTheme = e.matches ? 'dark' : 'light';
      document.documentElement.setAttribute('data-bs-theme', newTheme);
      if (themeIcon) {
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
      }
    }
  });
}
*/

/**
 * Initialize search bar functionality
 */
function initSearchBar() {
  const searchInput = document.querySelector('.search-input');
  if (searchInput) {
    // Focus effect
    searchInput.addEventListener('focus', function() {
      this.parentElement.classList.add('search-focused');
    });
    
    searchInput.addEventListener('blur', function() {
      this.parentElement.classList.remove('search-focused');
    });
    
    // Search functionality
    searchInput.addEventListener('keyup', function(e) {
      if (e.key === 'Enter') {
        const query = this.value.trim();
        if (query) {
          // Implement search functionality here
          console.log('Searching for:', query);
          
          // Example: redirect to a search results page
          // window.location.href = `search-results.php?q=${encodeURIComponent(query)}`;
        }
      }
    });
  }
}

/**
 * Initialize dropdown menus with improved functionality
 */
function initDropdownMenus() {
  // Add animation and positioning for all dropdowns
  const dropdownToggles = document.querySelectorAll('[data-bs-toggle="dropdown"]');
  dropdownToggles.forEach(toggle => {
    toggle.addEventListener('shown.bs.dropdown', function() {
      const dropdown = document.querySelector('.dropdown-menu.show');
      if (dropdown) {
        dropdown.classList.add('animated-dropdown');
      }
    });
  });
}

/**
 * Initialize submenu toggle functionality in the sidebar
 */
function initSubmenuToggle() {
  const submenuToggles = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');
  submenuToggles.forEach(toggle => {
    toggle.addEventListener('click', function() {
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      const icon = this.querySelector('.fa-chevron-down, .fa-chevron-right');
      
      if (icon) {
        if (isExpanded) {
          icon.classList.remove('fa-chevron-right');
          icon.classList.add('fa-chevron-down');
        } else {
          icon.classList.remove('fa-chevron-down');
          icon.classList.add('fa-chevron-right');
        }
      }
    });
  });
}

/**
 * Initialize notifications functionality
 */
function initNotifications() {
  // Simulate getting notifications
  setTimeout(() => {
    const badge = document.querySelector('.notification-badge');
    if (badge) {
      badge.classList.add('has-notifications');
    }
  }, 3000);
}
  const userProfile = document.querySelector('.user-profile');
  const userDropdown = document.querySelector('.apple-glass-dropdown');
  
  if (userProfile && userDropdown) {
    userProfile.addEventListener('click', function(e) {
      e.stopPropagation();
      userDropdown.classList.toggle('show');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
      userDropdown.classList.remove('show');
    });
    
    // Prevent dropdown from closing when clicking inside it
    userDropdown.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }
  
  // Theme toggle functionality is now handled by dark-mode.js
  // Commenting out duplicate theme toggle code to avoid conflicts
  /*
  const themeToggle = document.querySelector('.theme-toggle');
  if (themeToggle) {
    themeToggle.addEventListener('click', function() {
      // Toggle between light and dark theme
      if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light');
        themeToggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
        localStorage.setItem('theme', 'light');
      } else {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
        localStorage.setItem('theme', 'dark');
      }
    });
    
    // Set initial theme based on localStorage or system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      themeToggle.innerHTML = savedTheme === 'dark' ? 
        '<i class="fa-solid fa-sun"></i>' : 
        '<i class="fa-solid fa-moon"></i>';
    } else {
      // Check system preference
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
      } else {
        document.documentElement.setAttribute('data-bs-theme', 'light');
        themeToggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
      }
    }
  }
  */
  
  // Handle responsive behavior
  handleResponsiveLayout();
  window.addEventListener('resize', handleResponsiveLayout);


/**
 * Handle responsive layout adjustments
 */
function handleResponsiveLayout() {
  const sidebar = document.querySelector('.sidebar');
  const contentWrapper = document.querySelector('.content-wrapper');
  const footer = document.querySelector('.footer-with-gradient');
  
  // Initial state for all screen sizes
  if (document.body.classList.contains('sidebar-collapsed')) {
    // Sidebar is collapsed
    if (sidebar) {
      sidebar.style.transform = 'translateX(-100%)';
    }
    if (contentWrapper) contentWrapper.style.marginLeft = '0';
    if (footer) footer.style.marginLeft = '0';
    
    // Remove any existing backdrop
    const backdrop = document.querySelector('.sidebar-backdrop');
    if (backdrop) backdrop.style.display = 'none';
    document.body.classList.remove('sidebar-open');
  } else {
    // Sidebar is expanded
    if (sidebar) {
      sidebar.style.transform = 'translateX(0)';
    }
    
    // Apply margin only on larger screens
    if (window.innerWidth >= 992) {
      if (contentWrapper) contentWrapper.style.marginLeft = '280px';
      if (footer) footer.style.marginLeft = '280px';
    } else {
      // On mobile, we don't want margins even when sidebar is open
      if (contentWrapper) contentWrapper.style.marginLeft = '0';
      if (footer) footer.style.marginLeft = '0';
    }
  }
}