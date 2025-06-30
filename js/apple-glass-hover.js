/**
 * Apple Glass Hover Effects
 * Enhances UI with smooth hover animations for the Apple Glass UI
 */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize hover effects
  initAppleGlassHover();
});

/**
 * Initialize hover effects for Apple Glass UI elements
 */
function initAppleGlassHover() {
  // Add hover effects to sidebar navigation items
  addSidebarHoverEffects();
  
  // Add hover effects to header buttons
  addHeaderButtonHoverEffects();
  
  // Add hover effects to dropdown items
  addDropdownHoverEffects();
}

/**
 * Add hover effects to sidebar navigation items
 */
function addSidebarHoverEffects() {
  const navLinks = document.querySelectorAll('.sidebar .nav-link');
  
  navLinks.forEach(link => {
    // Mouse enter effect
    link.addEventListener('mouseenter', function() {
      // Add a subtle scale effect
      this.style.transform = 'translateX(5px) scale(1.02)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
      
      // Highlight icon if present
      const icon = this.querySelector('i:first-child');
      if (icon) {
        icon.style.transform = 'scale(1.1)';
        icon.style.opacity = '1';
      }
    });
    
    // Mouse leave effect
    link.addEventListener('mouseleave', function() {
      // Reset styles
      this.style.transform = '';
      this.style.boxShadow = '';
      
      // Reset icon styles
      const icon = this.querySelector('i:first-child');
      if (icon) {
        icon.style.transform = '';
        icon.style.opacity = '';
      }
    });
  });
}

/**
 * Add hover effects to header buttons
 */
function addHeaderButtonHoverEffects() {
  // Target header buttons
  const headerButtons = document.querySelectorAll('.apple-glass-header .sidebar-toggle, .apple-glass-header .theme-toggle');
  
  headerButtons.forEach(button => {
    // Mouse enter effect
    button.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.1)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
      
      // Add glow effect
      this.style.boxShadow = '0 0 15px rgba(255, 255, 255, 0.3)';
      
      // Animate icon if present
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = 'scale(1.1)';
      }
    });
    
    // Mouse leave effect
    button.addEventListener('mouseleave', function() {
      this.style.transform = '';
      this.style.backgroundColor = '';
      this.style.boxShadow = '';
      
      // Reset icon animation
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = '';
      }
    });
  });
  
  // Add special effects to user profile
  const userProfile = document.querySelector('.apple-glass-header .user-profile');
  if (userProfile) {
    userProfile.addEventListener('mouseenter', function() {
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
      this.style.boxShadow = '0 0 15px rgba(255, 255, 255, 0.2)';
      
      // Animate avatar
      const avatar = this.querySelector('.user-avatar');
      if (avatar) {
        avatar.style.transform = 'scale(1.05)';
        avatar.style.borderColor = 'rgba(255, 255, 255, 0.4)';
      }
    });
    
    userProfile.addEventListener('mouseleave', function() {
      this.style.backgroundColor = '';
      this.style.boxShadow = '';
      
      // Reset avatar animation
      const avatar = this.querySelector('.user-avatar');
      if (avatar) {
        avatar.style.transform = '';
        avatar.style.borderColor = '';
      }
    });
  }
}

/**
 * Add hover effects to dropdown items
 */
function addDropdownHoverEffects() {
  const dropdownItems = document.querySelectorAll('.apple-glass-dropdown .dropdown-item');
  
  dropdownItems.forEach(item => {
    // Mouse enter effect
    item.addEventListener('mouseenter', function() {
      this.style.transform = 'translateX(5px)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
      
      // Highlight icon if present
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = 'scale(1.2)';
        icon.style.opacity = '1';
      }
    });
    
    // Mouse leave effect
    item.addEventListener('mouseleave', function() {
      this.style.transform = '';
      this.style.backgroundColor = '';
      
      // Reset icon styles
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = '';
        icon.style.opacity = '';
      }
    });
  });
}