/**
 * Admin Panel Enhancement Script
 * Improves UI/UX functionality with Bootstrap integration
 */

$(function() {
  'use strict';
  
  // Initialize Bootstrap tooltips
  $('[data-toggle="tooltip"]').tooltip();
  
  // Initialize Bootstrap popovers
  $('[data-toggle="popover"]').popover();
  
  // Handle sidebar toggle for mobile
  $('.sidebar-toggle').on('click', function(e) {
    e.preventDefault();
    if (window.innerWidth <= 768) {
      $('body').toggleClass('sidebar-open');
    } else {
      $('body').toggleClass('sidebar-collapse');
    }
  });
  
  // Handle treeview menu
  $('.nav-sidebar .nav-item.has-treeview > .nav-link').on('click', function(e) {
    e.preventDefault();
    $(this).parent().toggleClass('menu-open');
    $(this).parent().siblings().removeClass('menu-open');
  });
  
  // Auto-activate current page in sidebar
  const currentPath = window.location.pathname;
  const currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1);
  
  $('.nav-sidebar .nav-link').each(function() {
    const href = $(this).attr('href');
    if (href === currentPage) {
      $(this).addClass('active');
      $(this).parents('.has-treeview').addClass('menu-open');
    }
  });
  
  // Enhance DataTables if present
  if ($.fn.DataTable) {
    $('.datatable').DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "search": "Search:",
        "lengthMenu": "Show _MENU_ entries per page",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty": "Showing 0 to 0 of 0 entries",
        "infoFiltered": "(filtered from _MAX_ total entries)"
      }
    });
  }
  
  // Enhance Select2 if present
  if ($.fn.select2) {
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  }
  
  // Enhance form validation
  if ($.fn.parsley) {
    $('form.validate').parsley({
      errorClass: 'is-invalid',
      successClass: 'is-valid',
      errorsWrapper: '<div class="invalid-feedback"></div>',
      errorTemplate: '<span></span>',
      classHandler: function(field) {
        return field.$element;
      }
    });
  }
  
  // Enhance date pickers
  if ($.fn.datepicker) {
    $('.datepicker').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      templates: {
        leftArrow: '<i class="fa fa-chevron-left"></i>',
        rightArrow: '<i class="fa fa-chevron-right"></i>'
      }
    });
  }
  
  // Add confirmation to delete actions
  $('.btn-delete, [data-action="delete"]').on('click', function(e) {
    e.preventDefault();
    const target = $(this).attr('href') || $(this).data('target');
    
    if (window.Swal) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = target;
        }
      });
    } else if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
      window.location.href = target;
    }
  });
  
  // Enhance card widgets
  $('.card-header .card-tools .btn-tool').on('click', function(e) {
    e.preventDefault();
    const $card = $(this).closest('.card');
    
    if ($(this).hasClass('btn-collapse')) {
      $card.toggleClass('collapsed-card');
      $card.find('.card-body, .card-footer').slideToggle();
    } else if ($(this).hasClass('btn-remove')) {
      $card.slideUp('fast', function() {
        $(this).remove();
      });
    } else if ($(this).hasClass('btn-refresh')) {
      const $cardBody = $card.find('.card-body');
      const originalContent = $cardBody.html();
      
      $cardBody.html('<div class="text-center p-4"><i class="fa fa-sync fa-spin"></i> Loading...</div>');
      
      // Simulate refresh - replace with actual AJAX call if needed
      setTimeout(function() {
        $cardBody.html(originalContent);
      }, 1000);
    }
  });
  
  // Add responsive behavior to tables
  $('.table:not(.table-responsive)').each(function() {
    if (!$(this).parent().hasClass('table-responsive')) {
      $(this).wrap('<div class="table-responsive"></div>');
    }
  });
  
  // Handle dark mode toggle if present
  $('#dark-mode-toggle').on('change', function() {
    if ($(this).is(':checked')) {
      $('html').addClass('dark-mode');
      localStorage.setItem('darkMode', 'enabled');
    } else {
      $('html').removeClass('dark-mode');
      localStorage.setItem('darkMode', 'disabled');
    }
  });
  
  // Check for saved dark mode preference
  if (localStorage.getItem('darkMode') === 'enabled') {
    $('html').addClass('dark-mode');
    $('#dark-mode-toggle').prop('checked', true);
  }
  
  // Add fade effects to alerts
  $('.alert:not(.alert-permanent)').each(function() {
    const $alert = $(this);
    setTimeout(function() {
      $alert.fadeOut('slow', function() {
        $(this).remove();
      });
    }, 5000);
  });
  
  // Add custom file input enhancement
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
  
  // Add smooth scrolling to page
  $('a.smooth-scroll').on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      const hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function() {
        window.location.hash = hash;
      });
    }
  });
  
  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn();
    } else {
      $('.back-to-top').fadeOut();
    }
  });
  
  $('.back-to-top').on('click', function() {
    $('html, body').animate({scrollTop: 0}, 800);
    return false;
  });
  
  // Add responsive sidebar behavior
  $(window).resize(function() {
    if (window.innerWidth <= 768) {
      $('body').removeClass('sidebar-collapse').addClass('sidebar-closed sidebar-collapse');
    }
  });
  
  // Trigger initial resize check
  $(window).trigger('resize');
});
