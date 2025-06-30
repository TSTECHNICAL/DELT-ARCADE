/**
 * Glassmorphism UI for VClub Admin Panel
 * This JavaScript file handles the responsive behavior and dynamic effects
 * for the glassmorphism UI design
 */

// Initialize when document is ready
$(document).ready(function() {
  // Create dynamic background for glassmorphism effect
  createGlassmorphismBackground();
  
  // Apply glassmorphism to elements
  applyGlassmorphism();
  
  // Setup responsive sidebar behavior
  setupResponsiveSidebar();
  
  // Initialize Bootstrap components with glassmorphism styling
  initBootstrapComponents();
  
  // Add parallax effect to cards
  addParallaxEffect();
  
  // Handle body styling based on screen width
  handleBodyStyling();
  
  // Update on window resize
  $(window).resize(function() {
    handleResponsiveSidebar();
    
    // Handle body styling based on screen width
    handleBodyStyling();
    
    // Re-create mobile menu toggle button if needed
    if ($(window).width() < 768 && $('.mobile-menu-toggle').length === 0) {
      $('body').append('<button class="mobile-menu-toggle btn glass-btn"><i class="fas fa-bars"></i></button>');
      
      $('.mobile-menu-toggle').on('click', function() {
        $('body').toggleClass('sidebar-open');
        $('.sidebar').toggleClass('show');
      });
    } else if ($(window).width() >= 768) {
      $('.mobile-menu-toggle').remove();
    }
  });
  
  // Add CSS for mobile menu toggle button
  $('<style>').html(`
    .mobile-menu-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1030;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.18);
      background: rgba(255, 255, 255, 0.25);
      color: var(--glass-text);
      font-size: 1.5rem;
    }
    
    .sidebar-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 1029;
      display: none;
    }
    
    body.sidebar-open .sidebar-backdrop {
      display: block;
    }
    
    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }
      
      .sidebar.show {
        transform: translateX(0);
      }
    }
  `).appendTo('head');
});

/**
 * Apply glassmorphism classes to elements
 */
function applyGlassmorphism() {
  // Add glassmorphism class to body
  $('body').addClass('glassmorphism');
  
  // Apply to main containers
  $('.content-wrapper').addClass('glassmorphism');
  $('.main-header').addClass('glassmorphism');
  $('.main-sidebar').addClass('glassmorphism');
  $('.main-footer').addClass('glassmorphism');
  
  // Apply to cards and boxes
  $('.card, .box').addClass('glassmorphism');
  $('.card-header, .box-header').addClass('glassmorphism');
  $('.card-footer, .box-footer').addClass('glassmorphism');
  
  // Apply to tables
  $('.table').addClass('glassmorphism');
  $('.table-responsive').addClass('glassmorphism');
  
  // Apply to form controls
  $('.form-control, .form-select').addClass('glassmorphism');
  $('.input-group').addClass('glassmorphism');
  
  // Apply to buttons
  $('.btn').addClass('glassmorphism');
  
  // Apply to navigation
  $('.nav-link').addClass('glassmorphism');
  $('.sidebar-menu > li > a').addClass('glassmorphism');
  $('.treeview-menu > li > a').addClass('glassmorphism');
  
  // Apply to modal dialogs
  $('.modal-content').addClass('glassmorphism');
  $('.modal-header').addClass('glassmorphism');
  $('.modal-footer').addClass('glassmorphism');
  
  // Apply to search forms
  $('.sidebar-form .input-group').addClass('glassmorphism');
  
  // Add ripple effect to buttons
  $('.btn').on('click', function(e) {
    const button = $(this);
    
    // Create ripple element
    const ripple = $('<span class="ripple"></span>');
    button.append(ripple);
    
    // Set ripple position
    const buttonPos = button.offset();
    const xPos = e.pageX - buttonPos.left;
    const yPos = e.pageY - buttonPos.top;
    
    ripple.css({
      width: button.outerWidth(),
      height: button.outerHeight(),
      top: 0,
      left: 0,
      background: 'radial-gradient(circle, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0) 70%)',
      transform: 'scale(0)',
      position: 'absolute',
      borderRadius: '50%',
      pointerEvents: 'none',
      transformOrigin: `${xPos}px ${yPos}px`
    }).animate({
      opacity: 0,
      transform: 'scale(2)'
    }, 500, function() {
      ripple.remove();
    });
  });
}

/**
 * Handle responsive sidebar behavior for different screen sizes
 */
function handleResponsiveSidebar() {
  const windowWidth = $(window).width();
  
  if (windowWidth < 992) {
    // Mobile and tablet view
    $('.sidebar').addClass('sidebar-mobile');
  } else {
    // Desktop view
    $('.sidebar').removeClass('sidebar-mobile');
    $('body').removeClass('sidebar-open');
  }
}

/**
 * Setup responsive sidebar behavior
 */
function setupResponsiveSidebar() {
  // Create backdrop for mobile sidebar if it doesn't exist
  if ($('.sidebar-backdrop').length === 0) {
    $('body').append('<div class="sidebar-backdrop"></div>');
    
    // Close sidebar when backdrop is clicked
    $('.sidebar-backdrop').on('click', function() {
      $('body').removeClass('sidebar-open');
      $('.sidebar').removeClass('show');
    });
  }
  
  // Create mobile menu toggle button for small screens
  if ($(window).width() < 768 && $('.mobile-menu-toggle').length === 0) {
    $('body').append('<button class="mobile-menu-toggle btn glass-btn"><i class="fas fa-bars"></i></button>');
    
    // Toggle sidebar on mobile button click
    $('.mobile-menu-toggle').on('click', function() {
      $('body').toggleClass('sidebar-open');
      $('.sidebar').toggleClass('show');
    });
  }
  
  // Toggle sidebar on button click
  $('.sidebar-toggler').on('click', function() {
    $('body').toggleClass('sidebar-open');
    $('.sidebar').toggleClass('show');
  });
  
  // Handle initial responsive state
  handleResponsiveSidebar();
}

/**
 * Initialize Bootstrap components with glassmorphism styling
 */
function initBootstrapComponents() {
  // Initialize tooltips with glassmorphism styling
  if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        template: '<div class="tooltip glass-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
      });
    });
  }
  
  // Initialize popovers with glassmorphism styling
  if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl, {
        template: '<div class="popover glass-popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
      });
    });
  }
}

/**
 * Add subtle parallax effect to glassmorphism cards
 */
function addParallaxEffect() {
  $('.glass-card, .card').on('mousemove', function(e) {
    const card = $(this);
    const rect = this.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    const moveX = (x - centerX) / 20;
    const moveY = (y - centerY) / 20;
    
    card.css('transform', `perspective(1000px) rotateX(${-moveY}deg) rotateY(${moveX}deg) translateZ(10px)`);
  }).on('mouseleave', function() {
    $(this).css('transform', 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)');
  });
}

/**
 * Create dynamic background for glassmorphism effect
 */
function createGlassmorphismBackground() {
  // Only create if it doesn't exist yet
  if ($('.glassmorphism-background').length === 0) {
    const container = $('<div class="glassmorphism-background"></div>');
    container.css({
      'position': 'fixed',
      'top': '0',
      'left': '0',
      'width': '100%',
      'height': '100%',
      'z-index': '-1',
      'overflow': 'hidden',
      'pointer-events': 'none'
    });
    
    // Create gradient circles
    const colors = [
      'rgba(78, 115, 223, 0.3)',
      'rgba(28, 200, 138, 0.3)',
      'rgba(54, 185, 204, 0.3)',
      'rgba(246, 194, 62, 0.3)',
      'rgba(231, 74, 59, 0.3)'
    ];
    
    for (let i = 0; i < 5; i++) {
      const circle = $('<div></div>');
      const size = Math.random() * 300 + 100;
      const color = colors[Math.floor(Math.random() * colors.length)];
      
      circle.css({
        'position': 'absolute',
        'width': `${size}px`,
        'height': `${size}px`,
        'border-radius': '50%',
        'background': color,
        'filter': 'blur(60px)',
        'opacity': '0.7',
        'left': `${Math.random() * 100}%`,
        'top': `${Math.random() * 100}%`,
        'transition': 'all 10s ease-in-out'
      });
      
      // Animation
      const keyframes = `
        @keyframes float-${i} {
          0% { transform: translate(0, 0) scale(1); }
          25% { transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(${0.8 + Math.random() * 0.5}); }
          50% { transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(${0.8 + Math.random() * 0.5}); }
          75% { transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(${0.8 + Math.random() * 0.5}); }
          100% { transform: translate(0, 0) scale(1); }
        }
      `;
      
      $('<style>').html(keyframes).appendTo('head');
      circle.css('animation', `float-${i} ${20 + i * 5}s infinite ease-in-out`);
      
      container.append(circle);
    }
    
    // Add the background container to the body
    $('body').prepend(container);
  }
}
    $('.content-wrapper').addClass('content-mobile');
    $('.footer').addClass('footer-mobile');
    
    // Collapse sidebar by default on mobile
    if (!$('.sidebar').hasClass('sidebar-collapse-init')) {
      $('.sidebar').addClass('sidebar-collapse');
      $('.sidebar').addClass('sidebar-collapse-init');
    }
    
    // Handle sidebar toggle on mobile
    $('.sidebar-toggler').off('click').on('click', function() {
      $('.sidebar').toggleClass('sidebar-collapse');
    });
   if (window.innerWidth > 991) {
    // Desktop view
    $('.sidebar').removeClass('sidebar-mobile sidebar-collapse sidebar-collapse-init');
    $('.content-wrapper').removeClass('content-mobile');
    $('.footer').removeClass('footer-mobile');
    
    // Hide sidebar toggle button in desktop view
    $('.sidebar-toggle').hide();
    
    // Handle sidebar toggle on desktop
    $('.sidebar-toggler').off('click').on('click', function() {
      $('body').toggleClass('sidebar-collapse');
    });
  }


/**
 * Initialize Bootstrap tooltips and popovers with glassmorphism styling
 */
function initTooltipsAndPopovers() {
  // Initialize tooltips
  $('[data-bs-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip glass-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
  });
  
  // Initialize popovers
  $('[data-bs-toggle="popover"]').popover({
    template: '<div class="popover glass-popover" role="tooltip"><div class="popover-arrow"></div><div class="popover-header"></div><div class="popover-body"></div></div>'
  });
}

/**
 * Add a subtle parallax effect to glassmorphism cards on mouse move
 */
$(document).on('mousemove', '.glass-card', function(e) {
  const card = $(this);
  const cardRect = card[0].getBoundingClientRect();
  const cardCenterX = cardRect.left + cardRect.width / 2;
  const cardCenterY = cardRect.top + cardRect.height / 2;
  
  // Calculate mouse position relative to card center
  const mouseX = e.clientX - cardCenterX;
  const mouseY = e.clientY - cardCenterY;
  
  // Calculate rotation angle (max 5 degrees)
  const rotateY = mouseX * 5 / (cardRect.width / 2);
  const rotateX = -mouseY * 5 / (cardRect.height / 2);
  
  // Apply subtle transform
  card.css('transform', `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`);
});

// Reset card transform when mouse leaves
$(document).on('mouseleave', '.glass-card', function() {
  $(this).css('transform', 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)');
});

/**
 * Add a background animation for the glassmorphism effect
 */
function createGlassmorphismBackground() {
  // Check if background already exists
  if (document.getElementById('glassmorphism-bg')) return;
  
  // Create a div element for the background
  const bgElement = document.createElement('div');
  bgElement.id = 'glassmorphism-bg';
  
  // Add the background to the body
  document.body.insertBefore(bgElement, document.body.firstChild);
  
  // Add glassmorphism class to body
  document.body.classList.add('glassmorphism');
  
  // Handle window resize
  window.addEventListener('resize', function() {
    // Adjust any responsive elements if needed
  });
  
  // Add mouse movement effect to enhance the glassmorphism feel
  document.addEventListener('mousemove', function(e) {
    // Only apply on desktop for performance
    if (window.innerWidth > 992) {
      const mouseX = e.clientX / window.innerWidth;
      const mouseY = e.clientY / window.innerHeight;
      
      // Subtle background position shift based on mouse position
      bgElement.style.backgroundPosition = `${50 + mouseX * 10}% ${50 + mouseY * 10}%`;
    }
  });
}

// Initialize background animation

/**
 * Handle body styling based on screen width
 * This function previously added/removed the gradient-bg-body class
 * Now it's been simplified since admin-gradient-bg.css has been removed
 */
function handleBodyStyling() {
  // Check if we're on index.php page
  const isIndexPage = window.location.pathname.endsWith('index.php');
  const currentPath = window.location.pathname.toLowerCase();
  
  // Only apply this logic to non-index pages
  if (!isIndexPage && !currentPath.includes('index.php')) {
    // Always remove gradient-bg-body class since the CSS file has been removed
    document.body.classList.remove('gradient-bg-body');
  }
}
$(document).ready(function() {
  // Only create background animation if not on mobile (for performance)
  if ($(window).width() > 992) {
    createGlassmorphismBackground();
  }
});