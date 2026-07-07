/**
 * Main Theme JavaScript
 *
 * @package DigiNova_Plus
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Init Bootstrap Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Init Bootstrap Popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        // Sticky Header functionality
        var header = $('.site-header.fixed-top');
        if (header.length) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 50) {
                    header.addClass('header-scrolled shadow-sm bg-white');
                    header.removeClass('bg-transparent');
                } else {
                    header.removeClass('header-scrolled shadow-sm bg-white');
                    if (header.hasClass('header-transparent')) {
                        header.addClass('bg-transparent');
                    }
                }
            });
        }

        // Mobile menu toggle animation
        $('.navbar-toggler').on('click', function() {
            $(this).toggleClass('is-active');
        });
    });

})(jQuery);
