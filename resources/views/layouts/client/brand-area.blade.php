@if (getPartners()->isNotEmpty())
    <!--Brand-Area Start-->
    <div class="brand-area bg-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-carousel owl-carousel">
                        @foreach (getPartners() as $item)
                            <a aria-label="Partner" target="_blank" href="{{ $item?->link ?? 'javascript:;' }}">
                                <div class="brand-item">
                                    <div class="brand-colume">
                                        <div class="brand-bg"></div>
                                        <img src="{{ url($item->image) }}" alt="{{ __('Partner') }}" loading="lazy" class="brand-logo-img">
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Brand-Area End-->
@endif

@push('css')
<style>
    /* Brand Area Mobile Fix - إصلاح قسم الشعارات على الموبايل */
    .brand-area {
        position: relative;
        overflow: visible;
        width: 100%;
        display: block !important;
        visibility: visible !important;
    }

    .brand-carousel {
        width: 100%;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .brand-carousel.owl-carousel {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .brand-carousel .owl-stage-outer {
        overflow: visible !important;
        width: 100% !important;
    }

    .brand-carousel .owl-stage {
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
    }

    .brand-carousel .owl-item {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: auto !important;
    }

    .brand-item {
        width: 100% !important;
        display: block !important;
        margin: 0 auto !important;
        position: relative;
    }

    .brand-item a {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }

    .brand-colume {
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 20px;
        position: relative;
    }

    .brand-logo-img,
    .brand-item img,
    .brand-colume img {
        width: 100% !important;
        max-width: 180px !important;
        height: auto !important;
        max-height: 140px !important;
        object-fit: contain !important;
        object-position: center !important;
        display: block !important;
        margin: 0 auto !important;
        opacity: 1 !important;
        visibility: visible !important;
        position: relative !important;
        z-index: 2 !important;
    }

    /* Force all brand images to be visible - Global fix */
    .brand-area img,
    .brand-carousel img,
    .brand-item img,
    .brand-colume img,
    .brand-logo-img {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 10 !important;
    }
    
    /* Override any inline styles that might hide images */
    .brand-area img[style],
    .brand-carousel img[style],
    .brand-item img[style],
    .brand-colume img[style],
    .brand-logo-img[style] {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .brand-bg {
        display: none !important;
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .brand-area {
            padding: 40px 0 !important;
        }

        .brand-carousel {
            padding: 0 20px !important;
        }

        .brand-item {
            margin: 0 10px !important;
        }

        .brand-colume {
            padding: 15px !important;
        }

        .brand-logo-img,
        .brand-item img,
        .brand-colume img {
            max-width: 150px !important;
            max-height: 120px !important;
        }
    }

    @media (max-width: 768px) {
        .brand-area {
            padding: 30px 0 !important;
            background-color: #ffffff !important;
        }

        .brand-area .container {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .brand-area .row {
            display: block !important;
            visibility: visible !important;
            margin: 0 !important;
        }

        .brand-area .col-12 {
            display: block !important;
            visibility: visible !important;
            padding: 0 15px !important;
        }

        .brand-carousel {
            padding: 0 !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }

        .brand-carousel.owl-carousel {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .brand-carousel .owl-stage-outer {
            overflow: visible !important;
            width: 100% !important;
            display: block !important;
        }

        .brand-carousel .owl-stage {
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
        }

        .brand-carousel .owl-item {
            padding: 0 8px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: auto !important;
            min-width: 0 !important;
            max-width: 50% !important;
            flex: 0 0 auto !important;
        }
        
        /* Fix owl-item width calculation on mobile */
        .brand-carousel .owl-item[style*="width"] {
            width: calc(50% - 10px) !important;
            max-width: calc(50% - 10px) !important;
        }

        .brand-item {
            margin: 0 5px !important;
            min-height: 120px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            position: relative !important;
        }

        .brand-item a {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .brand-colume {
            padding: 12px !important;
            min-height: 120px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            position: relative !important;
        }

        .brand-logo-img,
        .brand-item img,
        .brand-colume img {
            max-width: 100% !important;
            width: 100% !important;
            max-height: 100px !important;
            height: auto !important;
            padding: 10px !important;
            margin: 0 auto !important;
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: relative !important;
            z-index: 10 !important;
            object-fit: contain !important;
            object-position: center !important;
        }

        /* Force image visibility */
        .brand-carousel img,
        .brand-item img,
        .brand-colume img,
        .brand-logo-img {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 10 !important;
        }
        
        /* Override owl-carousel inline styles on mobile */
        .brand-carousel .owl-item[style] {
            width: calc(50% - 10px) !important;
            max-width: calc(50% - 10px) !important;
            min-width: 0 !important;
        }
        
        /* Ensure stage doesn't overflow */
        .brand-carousel .owl-stage {
            width: auto !important;
        }
        
        /* Make sure images are not hidden by parent containers */
        .brand-carousel .owl-item .brand-item,
        .brand-carousel .owl-item .brand-colume {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }
    }

    @media (max-width: 480px) {
        .brand-area {
            padding: 25px 0 !important;
            background-color: #ffffff !important;
        }

        .brand-area .container {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            padding: 0 15px !important;
        }

        .brand-area .row {
            display: block !important;
            visibility: visible !important;
            margin: 0 !important;
        }

        .brand-area .col-12 {
            display: block !important;
            visibility: visible !important;
            padding: 0 !important;
        }

        .brand-carousel {
            padding: 0 !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }

        .brand-carousel.owl-carousel {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .brand-carousel .owl-stage-outer {
            overflow: visible !important;
            width: 100% !important;
            display: block !important;
        }

        .brand-carousel .owl-stage {
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
        }

        .brand-carousel .owl-item {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: auto !important;
            min-width: 0 !important;
            max-width: 50% !important;
            padding: 0 5px !important;
            flex: 0 0 auto !important;
        }
        
        /* Fix owl-item width on very small screens */
        .brand-carousel .owl-item[style*="width"] {
            width: calc(50% - 10px) !important;
            max-width: calc(50% - 10px) !important;
        }

        .brand-item {
            margin: 0 5px !important;
            min-height: 100px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            position: relative !important;
        }

        .brand-item a {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .brand-colume {
            padding: 10px !important;
            min-height: 100px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            position: relative !important;
        }

        .brand-logo-img,
        .brand-item img,
        .brand-colume img {
            max-width: 100% !important;
            width: 100% !important;
            max-height: 80px !important;
            height: auto !important;
            padding: 8px !important;
            margin: 0 auto !important;
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: relative !important;
            z-index: 10 !important;
            object-fit: contain !important;
            object-position: center !important;
        }

        /* Force image visibility */
        .brand-carousel img,
        .brand-item img,
        .brand-colume img,
        .brand-logo-img {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 10 !important;
        }
        
        /* Override owl-carousel inline styles on very small screens */
        .brand-carousel .owl-item[style] {
            width: calc(50% - 10px) !important;
            max-width: calc(50% - 10px) !important;
            min-width: 0 !important;
        }
        
        /* Ensure containers don't hide images */
        .brand-carousel .owl-item .brand-item,
        .brand-carousel .owl-item .brand-colume {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }
    }

    /* Force visibility on all screen sizes */
    .brand-area .container,
    .brand-area .row,
    .brand-area .col-12 {
        display: block !important;
        visibility: visible !important;
    }

    /* RTL Support */
    [dir="rtl"] .brand-item {
        direction: ltr;
    }

    [dir="rtl"] .brand-item img {
        direction: ltr;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Force brand carousel to initialize on mobile
        if (typeof $ !== 'undefined' && $.fn.owlCarousel) {
            const brandCarousel = $('.brand-carousel');
            if (brandCarousel.length > 0) {
                // Destroy existing carousel if any
                if (brandCarousel.data('owl.carousel')) {
                    brandCarousel.trigger('destroy.owl.carousel');
                }
                
                // Force images to be visible before initialization
                $('.brand-carousel img').css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'position': 'relative',
                    'z-index': '10'
                });
                
                // Reinitialize with mobile-friendly settings
                const isRtl = $('html').attr('dir') === 'rtl';
                brandCarousel.owlCarousel({
                    rtl: isRtl,
                    loop: true,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplaySpeed: 2000,
                    smartSpeed: 1000,
                    margin: 15,
                    nav: false,
                    dots: false,
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
                            items: 4,
                            margin: 20,
                        },
                        1200: {
                            items: 4,
                            margin: 25,
                        },
                    },
                });

                // Force images to be visible after carousel initialization
                setTimeout(function() {
                    // Force all images to be visible
                    $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').each(function() {
                        $(this).css({
                            'display': 'block',
                            'visibility': 'visible',
                            'opacity': '1',
                            'position': 'relative',
                            'z-index': '10',
                            'width': '100%',
                            'max-width': '100%',
                            'height': 'auto'
                        });
                    });
                    
                    // Fix owl-item widths on mobile
                    if (window.innerWidth <= 768) {
                        $('.brand-carousel .owl-item').each(function() {
                            $(this).css({
                                'width': 'calc(50% - 10px)',
                                'max-width': 'calc(50% - 10px)',
                                'min-width': '0'
                            });
                        });
                    }
                    
                    // Ensure carousel is visible
                    brandCarousel.css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                }, 100);
                
                // Additional check after a longer delay
                setTimeout(function() {
                    $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').each(function() {
                        $(this).css({
                            'display': 'block',
                            'visibility': 'visible',
                            'opacity': '1',
                            'width': '100%',
                            'max-width': '100%'
                        });
                    });
                    
                    // Re-apply mobile fixes
                    if (window.innerWidth <= 768) {
                        $('.brand-carousel .owl-item').css({
                            'width': 'calc(50% - 10px)',
                            'max-width': 'calc(50% - 10px)'
                        });
                    }
                }, 1000);
            }
        }
        
        // Fallback: Force visibility on window resize
        window.addEventListener('resize', function() {
            setTimeout(function() {
                $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').each(function() {
                    $(this).css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1',
                        'width': '100%',
                        'max-width': '100%'
                    });
                });
                
                // Fix owl-item widths on mobile after resize
                if (window.innerWidth <= 768) {
                    $('.brand-carousel .owl-item').css({
                        'width': 'calc(50% - 10px)',
                        'max-width': 'calc(50% - 10px)',
                        'min-width': '0'
                    });
                }
            }, 100);
        });
        
        // Additional mobile-specific fix
        if (window.innerWidth <= 768) {
            setTimeout(function() {
                $('.brand-carousel .owl-item').css({
                    'width': 'calc(50% - 10px) !important',
                    'max-width': 'calc(50% - 10px) !important'
                });
                $('.brand-carousel img').css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
            }, 500);
        }
    });
</script>
@endpush

