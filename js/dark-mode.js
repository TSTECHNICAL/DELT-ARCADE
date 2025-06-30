/**
 * Dark Mode Toggle Functionality
 * This script handles the dark mode toggle functionality for the admin panel
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get the theme toggle button
  const themeToggle = document.getElementById('themeToggle');
  
  if (themeToggle) {
    // Get the icon element
    const themeIcon = themeToggle.querySelector('i');
    
    // Initialize theme based on saved preference or system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
    
    // Apply initial theme
    document.documentElement.setAttribute('data-bs-theme', initialTheme);
    
    // Update icon based on initial theme
    if (themeIcon) {
      themeIcon.className = initialTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
    
    // Add click event listener
    themeToggle.addEventListener('click', function() {
      // Get current theme
      const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
      
      // Toggle theme
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      // Apply new theme
      document.documentElement.setAttribute('data-bs-theme', newTheme);
      
      // Save preference to localStorage
      localStorage.setItem('theme', newTheme);
      
      // Update icon
      if (themeIcon) {
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
      }
      
      // Add transition effect
      document.body.classList.add('theme-transition');
      setTimeout(() => {
        document.body.classList.remove('theme-transition');
      }, 1000);
      
      // Force refresh of styles in a more gentle way
      // This approach avoids the flickering caused by hiding/showing the body
      setTimeout(() => {
        // Trigger a CSS recalculation by adding and removing a class
        document.body.classList.add('theme-refresh');
        setTimeout(() => {
          document.body.classList.remove('theme-refresh');
        }, 10);
      }, 50);
    });
    
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
});