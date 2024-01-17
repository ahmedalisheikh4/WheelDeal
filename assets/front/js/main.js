$(function ($) {
    "use strict";

    jQuery(document).ready(function () {
       
    //   magnific popup activation
    $('.video-play-btn, .play-video').magnificPopup({
        type: 'video'
    });
    $('.img-popup').magnificPopup({
        type: 'image'
    });
    

    /*  Accordion Active js */
    $("#accordion, #accordion2").accordion({
        heightStyle: "content",
        collapsible: true,
        icons: {
        "header": "ui-icon-caret-1-e",
        "activeHeader": " ui-icon-caret-1-s"
        }
    });

    /*  select2 Active js */
    $('.js-example-basic-single').select2();

    $('.north-west').powerTip({ placement: 'n' });
    
    // Hero Area Slider
    var $mainSlider = $('.intro-carousel');
    $mainSlider.owlCarousel({
        loop: true,
        navText: ['<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>'],
        nav: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 6000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    });



    // testimonial-slider
    var $testimonial_slider = $('.testimonial-slider');
    $testimonial_slider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
 
    // blog-slider
    var $blog_slider = $('.blog-slider');
    $blog_slider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });



    /**------------------------------
     * Product Details  carousel
     * ---------------------------**/
    $('.one-item-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.all-item-slider',
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    horizontal: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.all-item-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.one-item-slider',
        arrows: true,
        prevArrow: '<i class="fa fa fa-chevron-left slidPrv4"></i>',
        nextArrow: '<i class="fa fa-chevron-right slidNext4"></i>',
        dots: false,
        centerMode: false,
        centerPadding: '20px',
        focusOnSelect: true
    });





   
});



    /*-- back to top --*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        if ($window.scrollTop( ) > 0 ) {
            $(".mainmenu-area").addClass('nav-fixed');
        } else {
            $(".mainmenu-area").removeClass('nav-fixed');
        }

        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {
  
    /*---------------------
        Preloader
    -----------------------*/
    var preLoder = $("#preloader");
    preLoder.addClass('hide');
    var backtoTop = $('.back-to-top')
    /*-----------------------------
        back to top
    -----------------------------*/
    var backtoTop = $('.bottomtotop')
    backtoTop.fadeOut(100);
    });



});