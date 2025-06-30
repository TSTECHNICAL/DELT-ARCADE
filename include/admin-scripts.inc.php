<?php
/**
 * Admin Scripts Include File
 * Contains common script elements for all admin pages
 */
?>
<!-- jQuery (required for Bootstrap 5 JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<script src="js/jquery-ui.min.js"></script>

<!-- Bootstrap 5 Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- Custom Admin Scripts -->
<script src="js/apple-glass-header.js"></script>
<script src="js/glassmorphism.js"></script>
<script src="js/admin-panel.js"></script>

<!-- Initialize common components -->
<script>
  $(function () {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Initialize DataTables if available
    if ($.fn.DataTable) {
      $('.datatable').DataTable({
        responsive: true,
        autoWidth: false
      });
    }
    
    // Initialize Select2 if available
    if ($.fn.select2) {
      $(".select2").select2({
        theme: 'bootstrap-5'
      });
    }
  });
</script>

<!-- Additional page-specific scripts can be added after this include -->