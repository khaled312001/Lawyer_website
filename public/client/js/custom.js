(function ($) {
    "use strict";

    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        startDate: "-Infinity",
    });

    $(".datepicker2").datepicker({
        format: "yyyy-mm-dd",
    });

    $(".book-appointment .schedule").on("click", function () {
        $(".book-appointment .schedule").css("background-color", "#ddd");
        $(".book-appointment .schedule").css("color", "#333");
        $(this).css("background-color", "#f1634c");
        $(this).css("color", "#fff");
    });

    // caching selectors
    var mainWindow = $(window),
        mainBody = $("body"),
        mainpreStatus = $("#preloader-status"),
        mainPreloader = $("#preloader"),
        strickymenu = $("#strickymenu"),
        dropdown_menu = $(".dropdown-menu"),
        dropdown_toggle = $(".dropdown-toggle"),
        carousel = $(".carousel"),
        slideCarousel = $(".slide-carousel"),
        owl_testimonial = $(".owl-testimonial"),
        team_carousel = $(".team-carousel"),
        blog_carousel = $(".blog-carousel"),
        brand_carousel = $(".brand-carousel"),
        portfolioNav = $(".portfolio-nav"),
        relative_ptCarousel = $(".relative-pt-carousel"),
        relative_product = $(".relative-product-carousel"),
        select2 = $(".select2"),
        mgVideo = $(".mgVideo"),
        magnific = $(".magnific"),
        open_popup_link = $(".open-popup-link"),
        filtr_container = $(".filtr-container"),
        filtrnav_li = $("#filtrnav li"),
        filtr = $(".filtr"),
        scrollUp = $(".scroll-top"),
        counter = $(".counter");

    mainWindow.on("load", function () {
        // Preloader
        mainPreloader.fadeOut();
        mainpreStatus.delay(250).fadeOut("slow");
        mainBody.delay(250).css({
            "overflow-x": "hidden",
        });

        // StickyHeader
        function stickyHeader() {
            if (strickymenu.length) {
                var nextElement = strickymenu.next();
                if (nextElement.length && nextElement.offset()) {
                    var strickyScrollPos = nextElement.offset().top;
                if (mainWindow.scrollTop() > strickyScrollPos) {
                    strickymenu.addClass("sticky");
                    mainBody.addClass("sticky");
                } else if (mainWindow.scrollTop() <= strickyScrollPos) {
                    strickymenu.removeClass("sticky");
                    mainBody.removeClass("sticky");
                    }
                } else {
                    // Fallback: use menu position if next element doesn't exist
                    if (strickymenu.offset()) {
                        var menuPos = strickymenu.offset().top;
                        if (mainWindow.scrollTop() > menuPos) {
                            strickymenu.addClass("sticky");
                            mainBody.addClass("sticky");
                        } else {
                            strickymenu.removeClass("sticky");
                            mainBody.removeClass("sticky");
                        }
                    }
                }
            }
        }
        mainWindow.on("scroll", function () {
            stickyHeader();
        });

        //Search
        dropdown_menu.hide();
        dropdown_toggle.on("click", function () {
            dropdown_menu.fadeToggle();
        });

        //Carousel
        carousel.carousel();

        // Slider
        slideCarousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 0,
            animateIn: "fadeIn",
            animateOut: "fadeOut",
            dots: true,
            nav: false,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
            },
        });

        slideCarousel.on("translate.owl.carousel", function () {
            $(".text-animated h1").removeClass("fadeInDown animated").hide();
            $(".text-animated p").removeClass("fadeInUp animated").hide();
            $(".text-animated li").removeClass("fadeInUp animated").hide();
        });

        slideCarousel.on("translated.owl.carousel", function () {
            $(".text-animated h1").addClass("fadeInDown animated").show();
            $(".text-animated p").addClass("fadeInUp animated").show();
            $(".text-animated li").addClass("fadeInUp animated").show();
        });

        // Testimonial
        owl_testimonial.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 30,
            dots: true,
            nav: false,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                460: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
            },
        });

        // Team
        team_carousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                540: {
                    items: 2,
                    nav: false,
                },
                991: {
                    items: 3,
                    nav: false,
                },
                1199: {
                    items: 4,
                    nav: false,
                },
            },
        });

        // Blog
        blog_carousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: false,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 1,
                },
                991: {
                    items: 1,
                },
                1200: {
                    items: 2,
                },
            },
        });

        // Brand
        if (brand_carousel.length > 0) {
            brand_carousel.owlCarousel({
                rtl: rtlTrue ? true : false,
                loop: true,
                autoplay: true,
                autoplayHoverPause: true,
                autoplaySpeed: 2000,
                smartSpeed: 1000,
                margin: 15,
                nav: false,
                dots: false,
                navText: [
                    "<i class='fa fa-caret-left'></i>",
                    "<i class='fa fa-caret-right'></i>",
                ],
                responsive: {
                    0: {
                        items: 2,
                        margin: 10,
                        autoplaySpeed: 2500,
                    },
                    480: {
                        items: 2,
                        margin: 15,
                    },
                    750: {
                        items: 3,
                        margin: 20,
                    },
                    991: {
                        items: 3,
                        margin: 25,
                    },
                    1200: {
                        items: 4,
                        margin: 30,
                    },
                },
                onInitialized: function() {
                    // Ensure carousel is visible after initialization
                    brand_carousel.css('display', 'block');
                    brand_carousel.css('visibility', 'visible');
                    brand_carousel.css('opacity', '1');
                },
                onRefreshed: function() {
                    // Ensure carousel is visible after refresh
                    brand_carousel.css('display', 'block');
                    brand_carousel.css('visibility', 'visible');
                    brand_carousel.css('opacity', '1');
                }
            });
        }

        // Portfolio Nav
        portfolioNav.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 15,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 3,
                },
                520: {
                    items: 5,
                },
                750: {
                    items: 6,
                },
                1000: {
                    items: 7,
                },
            },
        });

        // Relative Protfolio
        relative_ptCarousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                    dots: false,
                },
                768: {
                    items: 2,
                    nav: false,
                },
                991: {
                    items: 3,
                    nav: false,
                },
                1200: {
                    items: 3,
                    nav: false,
                },
            },
        });

        // Relative Product
        relative_product.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                    dots: false,
                },
                768: {
                    items: 2,
                    nav: false,
                },
                991: {
                    items: 3,
                    nav: false,
                },
                1200: {
                    items: 4,
                    nav: false,
                },
            },
        });

        select2.select2();

        // Magnific Popup Video
        mgVideo.magnificPopup({
            type: "iframe",
            iframe: {
                markup:
                    '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    "</div>",
                patterns: {
                    youtube: {
                        index: "youtube.com/",
                        id: "v=",
                        src: "https://www.youtube.com/embed/%id%?autoplay=1",
                    },
                    vimeo: {
                        index: "vimeo.com/",
                        id: "/",
                        src: "https://player.vimeo.com/video/%id%?autoplay=1",
                    },
                    gmaps: {
                        index: "//maps.google.",
                        src: "%id%&output=embed",
                    },
                },
                srcAction: "iframe_src",
            },
        });

        //Team Swiper
        var swiper = new Swiper(".team-swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        //Brand Swiper
        var swiper = new Swiper(".brand-swiper", {
            slidesPerView: 4,
            slidesPerColumn: 2,
            spaceBetween: 30,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        //Single Product
        var galleryThumbs = new Swiper(".pro-detail-thumbs", {
            spaceBetween: 10,
            slidesPerView: 4,
            loop: false,
            freeMode: true,
            loopedSlides: 5, //looped slides should be the same
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper(".pro-detail-top", {
            spaceBetween: 10,
            loop: false,
            loopedSlides: 5, //looped slides should be the same
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });

        // filter-price
        $("#range-bar").slider({
            range: true,
            min: 5,
            max: 1500,
            values: [240, 960],
            slide: function (event, ui) {
                $("#range-show").html(
                    ui.values[0] + "$" + "-" + ui.values[1] + "$"
                );
            },
        });
        $("#range-show").html(
            $("#range-bar").slider("values", 0) +
                "$" +
                "-" +
                $("#range-bar").slider("values", 1) +
                "$"
        );

        // Spinner
        $("#shop_spinner").spinner({
            min: 1,
        });

        // Magnific Popup
        magnific.magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
            },
        });

        open_popup_link.magnificPopup({
            type: "inline",
            midClick: true,
        });

        // Scroll-Top
        scrollUp.hide();
        mainWindow.on("scroll", function () {
            if ($(this).scrollTop() > 300) {
                scrollUp.fadeIn();
            } else {
                scrollUp.fadeOut();
            }
        });
        scrollUp.on("click", function () {
            $("html, body").animate(
                {
                    scrollTop: 0,
                },
                700
            );
        });

        $(".mySelect2Item").select2({
            dropdownParent: $("#appointment_modal1"),
        });

        $(".modal_select2").select2({
            dropdownParent: $("#appointment_modal"),
        });
    });

    // nice select js
    $(".select_js").niceSelect();

    $(document).ready(function () {
        setupChangeHandler("#setLanguageHeader");
        setupChangeHandler("#setCurrencyHeader");
        //Form autocomplete off
        $("form").attr("autocomplete", "off");

        $(".select2").select2();
    });

    function setupChangeHandler(formSelector) {
        var $form = $(formSelector);
        var $select = $form.find("select");
        var previousValue = $select.val();

        $select.on("change", function (e) {
            var currentValue = $(this).val();
            if (currentValue !== previousValue) $form.trigger("submit");
            previousValue = currentValue;
        });
    }
    $(document).ready(function () {
        $(".counter_up").counterUp();
    });

    const isRtl = $('html').attr('dir') === 'rtl';


    //======banner slider======
    // Destroy existing slider if it exists
    if ($(".banner_slider").hasClass('slick-initialized')) {
        $(".banner_slider").slick('unslick');
    }
    
    $(".banner_slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        speed: 800,
        fade: true,
        cssEase: 'linear',
        dots: true,
        arrows: false,
        rtl: isRtl,
        pauseOnHover: true,
        pauseOnFocus: true,
        pauseOnDotsHover: false,
        infinite: true,
        lazyLoad: 'ondemand',
        adaptiveHeight: false,
        mobileFirst: true,
        swipe: true,
        touchMove: true,
        touchThreshold: 5,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    speed: 600,
                    autoplaySpeed: 3500,
                    swipe: true,
                    touchMove: true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    speed: 500,
                    autoplaySpeed: 3000,
                    swipe: true,
                    touchMove: true,
                }
            }
        ]
    });
    
    // Force refresh on mobile devices
    if (window.innerWidth <= 768) {
        setTimeout(function() {
            if ($(".banner_slider").hasClass('slick-initialized')) {
                $(".banner_slider").slick('setPosition');
            }
        }, 100);
    }

    //======testimonial slider======
    $(".testimonial_slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,
        rtl: isRtl
    });

    //======lawyer slider======
    $(".lawyer_slider").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        rtl: isRtl,
        nextArrow: '<i class="fas fa-chevron-right nextArrow"></i>',
        prevArrow: '<i class="fas fa-chevron-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                },
            },
        ],
    });

    // user profile edit
    $(".edit_profile").on("click", function () {
        $(".profile_info_area").addClass("show_edit");
    });
    $(".del_btn").on("click", function () {
        $(".profile_info_area").removeClass("show_edit");
    });

    $(document).on("click", ".wpcc-btn", function () {
        $(".wpcc-container").fadeOut(1000);
    });
})(jQuery);

//Search
function openSearch() {
    document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
    document.getElementById("myOverlay").style.display = "none";
}

//New Mobile Menu Functions
function toggleMobileMenu() {
    var mobileMenu = document.getElementById("mobileSideMenu");
    var menuToggle = document.querySelector('.mobile-menu-toggle');
    
    if (mobileMenu) {
        mobileMenu.classList.toggle('active');
        if (menuToggle) {
            menuToggle.classList.toggle('active');
        }
        
        if (mobileMenu.classList.contains('active')) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "auto";
        }
    }
}

function toggleSubmenu(element) {
    var menuItem = element.closest('.side-menu-item');
    if (menuItem) {
        menuItem.classList.toggle('active');
    }
}

// Close Alert Banner
function closeAlertBanner() {
    var alertBanner = document.getElementById("topAlertBanner");
    if (alertBanner) {
        alertBanner.classList.add('hidden');
        // Store in localStorage to remember user preference
        localStorage.setItem('alertBannerClosed', 'true');
    }
}

// Check if alert banner was previously closed
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('alertBannerClosed') === 'true') {
        var alertBanner = document.getElementById("topAlertBanner");
        if (alertBanner) {
            alertBanner.classList.add('hidden');
        }
    }
    
    // Close mobile menu when clicking outside
    var mobileMenu = document.getElementById("mobileSideMenu");
    var overlay = document.querySelector('.side-menu-overlay');
    
    if (overlay) {
        overlay.addEventListener('click', function() {
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                toggleMobileMenu();
            }
        });
    }
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            var mobileMenu = document.getElementById("mobileSideMenu");
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                toggleMobileMenu();
            }
        }
    });
    
    // Desktop Dropdown Menu Enhancement
    if (window.innerWidth > 991) {
        var dropdownItems = document.querySelectorAll('body.client-frontend .nav-item.has-dropdown');
        
        dropdownItems.forEach(function(item) {
            var navLink = item.querySelector('.nav-link');
            var dropdownMenu = item.querySelector('.dropdown-menu');
            var closeTimeout = null;
            
            if (navLink && dropdownMenu) {
                // Function to show dropdown
                function showDropdown() {
                    if (closeTimeout) {
                        clearTimeout(closeTimeout);
                        closeTimeout = null;
                    }
                    item.classList.add('active');
                    dropdownMenu.style.opacity = '1';
                    dropdownMenu.style.visibility = 'visible';
                    dropdownMenu.style.transform = 'translateY(0)';
                    dropdownMenu.style.pointerEvents = 'auto';
                }
                
                // Function to hide dropdown
                function hideDropdown() {
                    if (closeTimeout) {
                        clearTimeout(closeTimeout);
                    }
                    closeTimeout = setTimeout(function() {
                        item.classList.remove('active');
                        dropdownMenu.style.opacity = '0';
                        dropdownMenu.style.visibility = 'hidden';
                        dropdownMenu.style.transform = 'translateY(-10px)';
                        dropdownMenu.style.pointerEvents = 'none';
                        closeTimeout = null;
                    }, 200);
                }
                
                // Mouse enter on nav item - show dropdown immediately
                item.addEventListener('mouseenter', function() {
                    showDropdown();
                });
                
                // Mouse leave from nav item - hide dropdown with delay
                item.addEventListener('mouseleave', function(e) {
                    // Check if mouse is moving to dropdown menu
                    var relatedTarget = e.relatedTarget;
                    if (relatedTarget && dropdownMenu.contains(relatedTarget)) {
                        // Mouse is moving to dropdown, don't hide
                        return;
                    }
                    hideDropdown();
                });
                
                // Keep dropdown open when hovering over it
                dropdownMenu.addEventListener('mouseenter', function() {
                    showDropdown();
                });
                
                // Close dropdown when mouse leaves it
                dropdownMenu.addEventListener('mouseleave', function(e) {
                    // Check if mouse is moving back to nav item
                    var relatedTarget = e.relatedTarget;
                    if (relatedTarget && item.contains(relatedTarget)) {
                        // Mouse is moving to nav item, don't hide
                        return;
                    }
                    hideDropdown();
                });
            }
        });
    }
});

// ============================================
// Scroll Animations for All Sections
// ============================================
(function() {
    'use strict';

    // Initialize WOW.js for animations (only for elements with 'wow' class)
    if (typeof WOW !== 'undefined') {
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 100,
            mobile: true,
            live: true
        });
        wow.init();
    }

    // Only animate elements that explicitly have animation classes
    // Don't auto-add classes to all elements
    $(document).ready(function() {
        // Only add hover animations to elements that should have them
        $('.case-box, .service-box, .lawyer-box, .blog-box').addClass('hover-lift');
        
        // Only add button animations to buttons that should have them
        $('.btn-animate, .app-download-btn').addClass('btn-animate');
    });
})();
// make a function to scroll down auto
function scrollToBottomFunc() {
    $(".message-wrapper").animate(
        {
            scrollTop: $(".message-wrapper").get(0).scrollHeight,
        },
        50
    );
}

$(document).on("click", ".wpcc-btn", function () {
    $(".wpcc-container").fadeOut(1000);
});
