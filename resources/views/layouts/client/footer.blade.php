@if (subscriberContent())
    <!--Subscribe Start-->
    <div class="subscribe-area"
        style="background-image: url({{ subscriberContent()?->image ? url(subscriberContent()?->image) : '' }})">
        <div class="container">
            <div class="row ov_hd">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline white">
                        <h2 class="title">{{ ucwords(subscriberContent()?->title) }}</h2>
                        <p>{{ subscriberContent()?->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row ov_hd">
                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="subscribe-form">
                        <form method="POST" action="{{ route('newsletter-request') }}" class="subscribe-form-wrapper">
                            @csrf
                            <div class="subscribe-input-wrapper">
                                <i class="fas fa-envelope subscribe-icon"></i>
                                <input type="email" required name="email" placeholder="{{ __('بريد إلكتروني') }}" class="subscribe-input">
                            </div>
                            <button type="submit" class="btn-sub">
                                <span>{{ __('اشترك') }}</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Subscribe Start-->
@endif

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
            max-width: 130px !important;
            max-height: 100px !important;
            width: auto !important;
            height: auto !important;
            padding: 0 !important;
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
            padding: 0 5px !important;
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
            max-width: 110px !important;
            max-height: 80px !important;
            width: auto !important;
            height: auto !important;
            padding: 0 !important;
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

<!--Footer Start-->
<div class="main-footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-address footer-address-first">
                        <ul>
                            <li>
                                <i class="far fa-envelope"></i>
                                <div>
                                    <p class="title">{{ __('Email Address') }} </p>
                                    <p>{!! nl2br(e($contactInfo?->email)) !!}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <i class="fas fa-phone"></i>
                                <div>
                                    <p class="title">{{ __('Phone') }}</p>
                                    <p>{!! nl2br(e($contactInfo?->phone)) !!}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <p class="title">{{ __('Address') }}</p>
                                    <p>{!! nl2br(e($contactInfo?->address)) !!}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-area" style="background-image: url({{ url('client/img/shape-2.webp') }})">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-3 col-lg-3">
                    <div class="footer-item">
                        <p class="title">{{ __('About Us') }}</p>
                        <div class="textwidget pe-0">
                            <p>{{ $contactInfo?->about }}</p>
                            <a aria-label="{{ __('Details') }}" class="sm_fbtn"
                                href="{{ url('about-us') }}">{{ __('Details') }} →</a>
                            <ul class="icon">
                                @foreach (getSocialLinks() as $social)
                                    <li><a target="_blank" aria-label="{{ $social?->link }}" href="{{ $social?->link }}"><i class="{{ $social?->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-lg-2 col-md-6">
                    <div class="footer-item">
                        <p class="title">{{ __('Important Link') }}</p>
                        @if ($footerFirstMenu = footerFirstMenu())
                            <ul>
                                @foreach ($footerFirstMenu as $menu)
                                    <li><a @if ($menu['open_new_tab']) target="_blank" @endif
                                            href="{{ $menu['link'] == '#' || empty($menu['link']) ? 'javascript:;' : url($menu['link']) }}">{{ $menu['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-2 col-lg-2 col-md-6">
                    <div class="footer-item">
                        <p class="title">{{ __('Account') }}</p>
                        @if ($footerSecondMenu = footerSecondMenu())
                            <ul>
                                @foreach ($footerSecondMenu as $menu)
                                    <li><a @if ($menu['open_new_tab']) target="_blank" @endif
                                            href="{{ $menu['link'] == '#' || empty($menu['link']) ? 'javascript:;' : url($menu['link']) }}">{{ $menu['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="footer-item">
                        <p class="title">{{ __('Recent Post') }}</p>
                        @foreach (footerLatestNews() as $item)
                            <div class="footer-recent-item">
                                <div class="footer-recent-photo">
                                    <a aria-label="{{ $item?->title }}"
                                        href="{{ route('website.blog.details', $item?->slug) }}"><img
                                            src="{{ url($item?->thumbnail_image) }}" alt="{{ $item?->title }}"
                                            loading="lazy"></a>
                                </div>
                                <div class="footer-recent-text">
                                    <a aria-label="{{ $item?->title }}"
                                        href="{{ route('website.blog.details', $item?->slug) }}">{{ $item?->title }}</a>
                                    <div class="footer-post-date">{{ formattedDate($item?->created_at) }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyrignt">
        <div class="container">
            <div class="copyright-text text-center">
                <p>{{ $contactInfo?->copyright }}</p>
            </div>
        </div>
    </div>
</div>
<!--Footer End-->


<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fas fa-angle-double-up"></i>
</div>
<!--Scroll-Top-->


<script>
    @php
        $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'ltr');
    @endphp
    var isRtl = "{{ $textDirection == 'rtl' }}"
    var rtlTrue = false;
    if (isRtl) {
        rtlTrue = true;
    }
</script>


<!--Js-->
<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('client/js/popper.min.js') }}"></script>
<script src="{{ asset('client/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.collapse.js') }}"></script>
<script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('client/js/swiper-bundle.js') }}"></script>
<script src="{{ asset('client/js/jquery.filterizr.min.js') }}"></script>
<script src="{{ asset('client/js/select2.min.js') }}"></script>
<script src="{{ asset('client/js/wow.min.js') }}"></script>
<script>
    // Initialize WOW.js
    if (typeof WOW !== 'undefined') {
        new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 100,
            mobile: true,
            live: true
        }).init();
    }
</script>
<script src="{{ asset('client/js/slick.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('client/js/viewportchecker.js') }}"></script>
<script src="{{ asset('client/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('client/js/custom.js') }}?v={{ $setting?->version }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('client/js/jquery-ui.js') }}"></script>
<script src="{{ asset('https://js.pusher.com/7.0/pusher.min.js') }}"></script>
@include('client.dynamic-js-variables')
<script src="{{ asset('client/js/ajax-request.js') }}"></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif

<!--Start of Tawk.to Script-->
@if ($setting->tawk_status == 'active')
    <script type="text/javascript">
        "use strict";
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = '{{ $setting->tawk_chat_link }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
<!--End of Tawk.to Script-->


@if ($setting->cookie_status == 'active')
    <script src="{{ asset('client/js/cookieconsent.min.js') }}"></script>

    <script>
        "use strict";
        window.addEventListener("load", function() {
            @php
                $currentLang = app()->getLocale();
                $cookieMessage = $currentLang === 'ar' 
                    ? 'يستخدم هذا الموقع ملفات تعريف ارتباط أساسية لضمان عمله الصحيح وملفات تتبع لفهم كيفية تفاعلك معه. سيتم تفعيل الأخيرة فقط عند الموافقة.'
                    : 'This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.';
                $cookieLinkText = $currentLang === 'ar' ? 'اقرأ سياسة الخصوصية' : 'Policy';
                $cookieBtnText = $currentLang === 'ar' ? 'موافق' : 'Yes';
            @endphp
            window.wpcc.init({
                "border": "{{ $setting->border }}",
                "corners": "{{ $setting->corners }}",
                "colors": {
                    "popup": {
                        "background": "{{ $setting->background_color }}",
                        "text": "{{ $setting->text_color }} !important",
                        "border": "{{ $setting->border_color }}"
                    },
                    "button": {
                        "background": "{{ $setting->btn_bg_color }}",
                        "text": "{{ $setting->btn_text_color }}"
                    }
                },
                "content": {
                    "href": "{{ route('website.privacy-policy') }}",
                    "message": "{{ $cookieMessage }}",
                    "link": "{{ $cookieLinkText }}",
                    "button": "{{ $cookieBtnText }}"
                }
            })
        });
    </script>
@endif
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
                    $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1',
                        'position': 'relative',
                        'z-index': '10'
                    });
                    
                    // Ensure carousel is visible
                    brandCarousel.css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                }, 100);
                
                // Additional check after a longer delay
                setTimeout(function() {
                    $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                }, 1000);
            }
        }
        
        // Fallback: Force visibility on window resize
        window.addEventListener('resize', function() {
            setTimeout(function() {
                $('.brand-carousel img, .brand-item img, .brand-colume img, .brand-logo-img').css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1'
                });
            }, 100);
        });
    });
</script>
@endpush

@stack('js')
@if (customCode()?->footer_javascript)
    <script>
        "use strict";
        {!! customCode()->footer_javascript !!}
    </script>
@endif

</body>

</html>
