/**
 * AJAX Filter JS
 */
(function($) {
    'use strict';

    const $form = $('#products-filter-form');
    const $grid = $('#products-grid');
    const $overlay = $('.ajax-loading-overlay');
    const $resultsCount = $('.results-count');
    const $loadMoreBtn = $('#load-more-products');
    let maxPages = 1;
    let isFetching = false;
    let timeoutId;

    if (!$form.length || !$grid.length) {
        return;
    }

    function fetchProducts(append = false) {
        if (isFetching) return;
        isFetching = true;
        
        if (!append) {
            $overlay.removeClass('d-none').addClass('d-flex');
            $grid.addClass('opacity-50');
        }

        const formData = $form.serialize();

        $.ajax({
            url: diginovaplus_ajax.ajaxurl,
            type: 'GET',
            data: formData,
            success: function(response) {
                if (response.success) {
                    if (append) {
                        $grid.append(response.data.html);
                    } else {
                        $grid.html(response.data.html);
                    }
                    
                    $resultsCount.html(response.data.results_text);
                    maxPages = response.data.max_pages;
                    
                    const currentPage = parseInt($('#filter-paged').val(), 10);
                    if (currentPage < maxPages) {
                        $loadMoreBtn.removeClass('d-none');
                    } else {
                        $loadMoreBtn.addClass('d-none');
                    }
                }
            },
            complete: function() {
                isFetching = false;
                $overlay.addClass('d-none').removeClass('d-flex');
                $grid.removeClass('opacity-50');
            }
        });
    }

    // Debounce for search and inputs
    $form.find('input[type="text"], input[type="number"], input[type="search"]').on('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            $('#filter-paged').val(1);
            fetchProducts();
        }, 500);
    });

    // Checkboxes, radios, selects
    $form.find('input[type="checkbox"], input[type="radio"], select').on('change', function() {
        $('#filter-paged').val(1);
        fetchProducts();
    });

    // Sort Dropdown (outside form but controls form input)
    $('#sort-dropdown').on('change', function() {
        $('#filter-paged').val(1);
        fetchProducts();
    });

    // Load More
    $loadMoreBtn.on('click', function(e) {
        e.preventDefault();
        const currentPage = parseInt($('#filter-paged').val(), 10);
        $('#filter-paged').val(currentPage + 1);
        
        $(this).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...').prop('disabled', true);
        
        fetchProducts(true);
        
        // Reset button state after a delay (ajax complete will handle actual state)
        setTimeout(() => {
            $(this).html('Load More Products').prop('disabled', false);
        }, 1000);
    });

    // View Toggle
    $('.view-btn').on('click', function() {
        $('.view-btn').removeClass('active btn-light').addClass('btn-white text-muted');
        $(this).addClass('active btn-light').removeClass('btn-white text-muted');
        
        const viewMode = $(this).data('view');
        $('#filter-view-mode').val(viewMode);
        
        if (viewMode === 'list') {
            $grid.removeClass('view-grid').addClass('view-list');
            // Change column classes
            $grid.find('.item').removeClass('col-sm-6 col-md-4').addClass('col-12');
        } else {
            $grid.removeClass('view-list').addClass('view-grid');
            $grid.find('.item').removeClass('col-12').addClass('col-sm-6 col-md-4');
        }
        
        $('#filter-paged').val(1);
        fetchProducts();
    });

    // Clear All Filters
    $('.clear-all-filters').on('click', function(e) {
        e.preventDefault();
        $form[0].reset();
        $('#filter-paged').val(1);
        // Special case for radio
        $('#rating-any').prop('checked', true);
        fetchProducts();
    });

    // Initial load
    fetchProducts();

})(jQuery);
