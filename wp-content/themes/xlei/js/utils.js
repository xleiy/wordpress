/**
 * Mobile navigation
 */
;
(function($, window, document, undefined) {
    "use strict";

    $(document).ready(function($) {

        var $body = $('body');
        var $search = $('#s');
        var $form = $('.search');

        $('.button-toggle').click(function(e) {
            $body.toggleClass('menu-open');
            $('body,html').scrollTop(0);
            return false;
        });

        var defaultWindowWidth = $(window).width();
        $(window).resize(function() {
            $('#blog-title').hide();
            if (defaultWindowWidth != $(window).width()) {
                var newWidth = $(window).width();
                $body.removeClass('menu-open');
                if (newWidth > 600) {
                    $search.addClass('search-open');
                    $form.addClass('serch-form-open');
                    $('#blog-title').hide();
                } else {
                    $search.removeClass('search-open');
                    $form.removeClass('serch-form-open');
                    $('#blog-title').show();
                }

            }
        });

    });
})(jQuery, window, document);


/**
 * Nav sticky
 */
;
$(document).ready(function() {
    $(".site-nav").fixeditem({ distance: 0, pos: "top" })
});


/**
 * Scroll Up
 */
;
$(document).ready(function() {
    $(".scroll-up").hide();
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 600) {
                $('.scroll-up').fadeIn();
            } else {
                $('.scroll-up').fadeOut();
            }
        });
        $('a.scroll-up').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
});
/*search*/
;
$(document).ready(function($) {
    var $search = $('#s');
    var $form = $('.search');
    $('#search').click(function(e) {
        if ($(window).width() <= 600) {
            if ($search[0].value == null || $search[0].value == undefined || $search[0].value == "") {
                $search.toggleClass('search-open');
                $form.toggleClass('serch-form-open');
                // $search.hide();
                $('#blog-title').toggle();
            } else {
                $('#search-toggle-form').submit();
                $search[0].value = null;
                // alert("search-toggle-form");
            }
        }
    })
});
