/**
 * Custom Pagination Enhancement for DataTables
 * Improves the next and previous buttons and adds better page number display
 */
$(document).ready(function() {
    // Custom DataTables initialization function
    $.fn.enhancedDataTable = function(options) {
        // Default options
        var settings = $.extend({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 100,
            pagingType: 'full_numbers',
            language: {
                paginate: {
                    first: '<i class="fa fa-angle-double-left"></i>',
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>'
                },
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                infoEmpty: 'Showing 0 to 0 of 0 entries',
                infoFiltered: '(filtered from _MAX_ total entries)',
                search: 'Search:'
            },
            drawCallback: function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                
                // Only show pagination if we have more than one page
                if (pageInfo.pages <= 1) {
                    $('.dataTables_paginate, .dataTables_info').hide();
                } else {
                    $('.dataTables_paginate, .dataTables_info').show();
                    
                    // Enhance the pagination display
                    enhancePagination(api, pageInfo);
                }
            }
        }, options);
        
        // Initialize DataTable with our settings
        return this.DataTable(settings);
    };
    
    // Function to enhance pagination display
    function enhancePagination(api, pageInfo) {
        // Get pagination container
        var paginationContainer = $(api.table().container()).find('.dataTables_paginate');
        
        // Add a page indicator
        if (paginationContainer.find('.page-indicator').length === 0) {
            var pageIndicator = $('<div class="page-indicator"></div>');
            paginationContainer.append(pageIndicator);
        }
        
        // Update the page indicator text
        var pageIndicator = paginationContainer.find('.page-indicator');
        pageIndicator.html('Page ' + (pageInfo.page + 1) + ' of ' + pageInfo.pages);
        
        // Add tooltip to pagination buttons for better UX
        paginationContainer.find('a').each(function() {
            var $this = $(this);
            var tooltipText = '';
            
            if ($this.parent().hasClass('first')) {
                tooltipText = 'First Page';
            } else if ($this.parent().hasClass('previous')) {
                tooltipText = 'Previous Page';
            } else if ($this.parent().hasClass('next')) {
                tooltipText = 'Next Page';
            } else if ($this.parent().hasClass('last')) {
                tooltipText = 'Last Page';
            } else {
                tooltipText = 'Page ' + $this.text();
            }
            
            $this.attr('title', tooltipText);
        });
    }
    
    // Apply to all existing DataTables
    // This will automatically enhance any DataTable that's already initialized
    $('.dataTable').each(function() {
        var table = $(this).DataTable();
        var pageInfo = table.page.info();
        
        if (pageInfo.pages > 1) {
            enhancePagination(table, pageInfo);
        }
    });
});