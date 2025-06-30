
<!-- Apple Glass Footer styling -->
<style>
  .footer-with-gradient {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    -webkit-backdrop-filter: var(--glass-blur);
    border-top: var(--glass-border);
    color: var(--glass-text);
    padding: 1rem;
    font-size: 1em;
    margin-left: var(--sidebar-width);
    z-index: 1000;
    box-shadow: var(--glass-shadow);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: margin-left var(--transition-speed) ease;
  }
  
  .footer-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    text-decoration: none;
    border-radius: 50%;
    background: var(--glass-bg-darker);
    color: var(--glass-text);
    margin-left: 0.5rem;
    transition: all 0.3s ease;
  }
  
  .footer-icon:hover {
    background: var(--glass-bg-lighter);
    transform: translateY(-2px);
    text-decoration: solid;
    color: var(--glass-text-hover);
  }
  
  body.sidebar-collapsed .footer-with-gradient {
    margin-left: 0;
  }
  
  @media (max-width: 991.98px) {
    .footer-with-gradient {
      margin-left: 0;
    }
  }
  
  /* Dark mode support */
  @media (prefers-color-scheme: dark) {
    .footer-with-gradient {
      background: var(--glass-bg-dark);
      border-top: var(--glass-border-dark);
      box-shadow: var(--glass-shadow-dark);
    }
  }
  
  [data-bs-theme="dark"] .footer-with-gradient {
    background: var(--glass-bg-dark);
    border-top: var(--glass-border-dark);
    box-shadow: var(--glass-shadow-dark);
  }
</style>
<div class="clearfix"></div>
<footer class="footer py-3 mt-auto footer-with-gradient">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <strong>Copyright &copy; <?php echo date('Y'); ?> DELT ARCADE</strong>
            </div>
            <div class="col-md-6 text-md-end">
                <span>Control Panel Dashboard v2.1</span>
                <div class="d-inline-block ms-3">
                    <a href="#" class="footer-icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>  
  <!-- jQuery (required for Bootstrap 5 JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="js/jquery-ui.min.js"></script>
<!-- Bootstrap 5 Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Morris.js charts -->
<script src="dist/raphael-min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Animate.css for SweetAlert animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- SweetAlert Helper Functions -->
<script src="js/sweetalert-helper.js"></script>
<!-- Dark Mode Toggle -->
<script src="js/dark-mode.js"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Modern Admin CSS - Must be after other CSS -->
<link rel="stylesheet" href="css/modern-admin.css">
<!-- Bootstrap Admin Enhancement CSS -->
<link rel="stylesheet" href="css/bootstrap-admin.css">
<!-- Glassmorphism UI CSS -->
<link rel="stylesheet" href="css/glassmorphism.css">
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- daterangepicker -->
<script src="dist/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Bootstrap Admin Enhancement JS -->
<script src="js/admin-panel.js"></script>
<!-- Glassmorphism UI JS -->
<script src="js/glassmorphism.js"></script>

<script>
  $(function () {
    // Initialize Select2 Elements
    if ($.fn.select2) {
      $(".select2").select2({
        theme: 'bootstrap-5'
      });
    }
    
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
    
    // Initialize DataTables with Bootstrap 5 styling
    if ($.fn.DataTable) {
      $('.datatable').DataTable({
        responsive: true,
        autoWidth: false
      });
    }
  });
</script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


</script>
<?php include("include/changepassword.php");?>