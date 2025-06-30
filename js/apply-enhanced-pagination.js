/**
 * Apply Enhanced Pagination to All DataTables
 * 
 * This script automatically converts all standard DataTables to use the enhanced pagination.
 * Include this script after the custom-pagination.js file to apply the enhancements globally.
 */
$(document).ready(function() {
    // Store the original DataTable function
    var originalDataTable = $.fn.DataTable;
    
    // Override the DataTable function
    $.fn.DataTable = function(options) {
        // Default options for enhanced pagination
        var enhancedOptions = {
            pagingType: 'full_numbers',
            language: {
                paginate: {
                    first: '<i class="fa fa-angle-double-left"></i>',
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>'
                }
            },
            drawCallback: function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                
                // Only show pagination if we have more than one page
                if (pageInfo.pages <= 1) {
                    $('.dataTables_paginate, .dataTables_info').hide();
                } else {
                    $('.dataTables_paginate, .dataTables_info').show();
                    
                    // Add a page indicator
                    var paginationContainer = $(api.table().container()).find('.dataTables_paginate');
                    
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
            }
        };
        
        // Merge user options with enhanced options
        var mergedOptions = $.extend({}, options, enhancedOptions);
        
        // If the user provided a drawCallback, store it and call it from our enhanced drawCallback
        if (options && options.drawCallback) {
            var userDrawCallback = options.drawCallback;
            mergedOptions.drawCallback = function(settings) {
                enhancedOptions.drawCallback.call(this, settings);
                userDrawCallback.call(this, settings);
            };
        }
        
        // Call the original DataTable function with the merged options
        return originalDataTable.call(this, mergedOptions);
    };
    
    // Preserve the defaults and API methods
    $.extend(true, $.fn.DataTable, originalDataTable);
    
    // Apply to existing DataTables
    $('.dataTable').each(function() {
        var table = $(this).DataTable();
        var pageInfo = table.page.info();
        
        if (pageInfo.pages > 1) {
            // Add page indicator
            var paginationContainer = $(table.table().container()).find('.dataTables_paginate');
            
            if (paginationContainer.find('.page-indicator').length === 0) {
                var pageIndicator = $('<div class="page-indicator"></div>');
                paginationContainer.append(pageIndicator);
                pageIndicator.html('Page ' + (pageInfo.page + 1) + ' of ' + pageInfo.pages);
            }
            
            // Add tooltips
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
    });
    
    console.log('Enhanced pagination applied to all DataTables');
});