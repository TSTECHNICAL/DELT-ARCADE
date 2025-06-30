<link rel="stylesheet" href="css/apple-glass-header.css">
<script src="js/apple-glass-header.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Gradient background for body removed as requested
    // document.body.classList.add('gradient-bg-body');
    
    // Find the sidebar and add the glass header class if not already present
    const sidebar = document.querySelector('.sidebar');
    if (sidebar && !sidebar.classList.contains('sidebar-with-glass-header')) {
      sidebar.classList.add('sidebar-with-glass-header');
    }
    
    // Find the content wrapper and add the glass header class if not already present
    const contentWrapper = document.querySelector('.content-wrapper');
    if (contentWrapper && !contentWrapper.classList.contains('content-wrapper-with-glass-header')) {
      contentWrapper.classList.add('content-wrapper-with-glass-header');
    }
    
    // Find the footer and add the gradient class if not already present
    const footer = document.querySelector('.footer');
    if (footer && !footer.classList.contains('footer-with-gradient')) {
      footer.classList.add('footer-with-gradient');
    }
    
    // Apply glass card effect to info boxes and other card elements
    const infoBoxes = document.querySelectorAll('.info-box, .box, .card');
    infoBoxes.forEach(function(box) {
      if (!box.classList.contains('glass-card')) {
        box.classList.add('glass-card');
      }
    });
  });
</script>