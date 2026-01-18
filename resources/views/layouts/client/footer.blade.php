<!--Footer Start-->
<div class="main-footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-address footer-address-first">
                        <ul>
                            <li>
                                <div>
                                    <p class="title">{{ __('Email Address') }} </p>
                                    <p>{!! nl2br(e($contactInfo?->email)) !!}</p>
                                </div>
                                <i class="far fa-envelope"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <div>
                                    <p class="title">{{ __('Phone') }}</p>
                                    <p>
                                        @php
                                            $phoneDisplay = $contactInfo?->phone ?? '';
                                            // Move + to end for Arabic language (RTL)
                                            if (getSessionLanguage() == 'ar' && $phoneDisplay) {
                                                // Handle multiple lines
                                                $phoneLines = explode("\n", $phoneDisplay);
                                                $formattedLines = [];
                                                foreach ($phoneLines as $line) {
                                                    $line = trim($line);
                                                    if ($line) {
                                                        // Remove + from start if exists
                                                        if (str_starts_with($line, '+')) {
                                                            $line = substr($line, 1);
                                                        }
                                                        // Add + at the end
                                                        $formattedLines[] = $line . '+';
                                                    }
                                                }
                                                $phoneDisplay = implode("\n", $formattedLines);
                                            }
                                            // Handle multiple lines (nl2br)
                                            $phoneLines = explode("\n", $phoneDisplay);
                                            foreach ($phoneLines as $line) {
                                                echo e($line) . '<br>';
                                            }
                                        @endphp
                                    </p>
                                </div>
                                <i class="fas fa-phone"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <div>
                                    <p class="title">{{ __('Address') }}</p>
                                    <p>{!! nl2br(e($contactInfo?->address)) !!}</p>
                                </div>
                                <i class="fas fa-map-marker-alt"></i>
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
                @if(getSessionLanguage() == 'ar')
                    <p>حقوق الطبع والنشر © 2026، أمان لو. جميع الحقوق محفوظة.</p>
                @else
                    <p>Copyright © 2026, Aman Law. All rights reserved.</p>
                @endif
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
        $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'rtl');
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
        
        // Header Scroll Animation - إخفاء/إظهار الهيدر عند السكرول
        let amanLastScrollTop = 0;
        let amanScrollTimer = null;
        const amanWelcomeBanner = document.querySelector('.aman-welcome-banner-rtl, .top-alert-banner');
        const amanTopBar = document.querySelector('.aman-top-bar-rtl, .top-header-bar');
        const amanMainNav = document.querySelector('.aman-main-nav-rtl, .main-navbar');
        const amanBody = document.body;
        const isMobile = window.innerWidth <= 768;

        window.addEventListener('scroll', function() {
            clearTimeout(amanScrollTimer);
            
            amanScrollTimer = setTimeout(function() {
                let amanScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // على الموبايل، navbar يبقى في الأعلى دائماً
                if (isMobile) {
                    if (amanMainNav) {
                        amanMainNav.style.top = '0';
                        amanMainNav.classList.add('scrolled', 'aman-scrolled-state');
                    }
                    amanBody.classList.add('header-scrolled', 'aman-header-hidden');
                    return;
                }
                
                if (amanScrollTop > 100) {
                    // عند النزول - إخفاء الشريط العلوي فقط
                    if (amanTopBar) {
                        amanTopBar.style.transform = 'translateY(-100%)';
                        amanTopBar.style.opacity = '0';
                        amanTopBar.style.pointerEvents = 'none';
                    }
                    if (amanMainNav) {
                        amanMainNav.style.top = '0';
                        amanMainNav.classList.add('scrolled', 'aman-scrolled-state');
                    }
                    amanBody.classList.add('header-scrolled', 'aman-header-hidden');
                } else {
                    // عند الصعود - إظهار الشريط العلوي
                    if (amanTopBar) {
                        amanTopBar.style.transform = 'translateY(0)';
                        amanTopBar.style.opacity = '1';
                        amanTopBar.style.pointerEvents = 'auto';
                    }
                    if (amanMainNav) {
                        amanMainNav.style.top = '50px';
                        amanMainNav.classList.remove('scrolled', 'aman-scrolled-state');
                    }
                    amanBody.classList.remove('header-scrolled', 'aman-header-hidden');
                }
                
                amanLastScrollTop = amanScrollTop;
            }, 10);
        });
        
        // تحديث عند تغيير حجم الشاشة
        window.addEventListener('resize', function() {
            const newIsMobile = window.innerWidth <= 768;
            if (newIsMobile !== isMobile && amanMainNav) {
                amanMainNav.style.top = '0';
            }
        });

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

@stack('js')

{{-- Client Header Notifications Script --}}
@auth
<script>
    $(document).ready(function() {
        // Initialize Bootstrap dropdown for header notifications
        var dropdownElement = document.getElementById('client-header-notification-dropdown');
        if (dropdownElement && typeof bootstrap !== 'undefined') {
            var dropdown = new bootstrap.Dropdown(dropdownElement.querySelector('[data-bs-toggle="dropdown"]'));
        }

        // Load header notifications
        function loadHeaderNotifications() {
            $.ajax({
                url: '{{ route("client.notifications.fetch") }}',
                method: 'GET',
                success: function(response) {
                    if (response && response.unread_count !== undefined) {
                        updateHeaderNotificationCount(response.unread_count || 0);
                        renderHeaderNotifications(response.notifications || []);
                    } else {
                        $('#client-header-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Notification fetch error:', error);
                    $('#client-header-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("Failed to load notifications") }}</div>');
                    updateHeaderNotificationCount(0);
                }
            });
        }

        function updateHeaderNotificationCount(count) {
            const badge = $('#client-header-notification-count');
            if (count > 0) {
                badge.text(count > 99 ? '99+' : count).show();
            } else {
                badge.hide();
            }
        }

        function renderHeaderNotifications(notifications) {
            const list = $('#client-header-notifications-list');
            if (!notifications || notifications.length === 0) {
                list.html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                return;
            }

            let html = '';
            notifications.forEach(function(notification) {
                try {
                    const isRead = notification.read_at !== null && notification.read_at !== '';
                    const readClass = isRead ? '' : 'bg-light';
                    const notificationData = notification.data || {};
                    const icon = getHeaderNotificationIcon(notificationData.type || '');
                    html += `
                        <a href="${notificationData.url || '#'}" class="dropdown-item notification-item-header ${readClass}" data-id="${notification.id || ''}">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon-wrapper me-2">
                                    <i class="${icon}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold small">${notificationData.title || '{{ __("Notification") }}'}</div>
                                    <div class="text-muted small" style="font-size: 0.85rem;">${notificationData.message || ''}</div>
                                    <div class="text-muted" style="font-size: 0.75rem; margin-top: 4px;">${formatHeaderTime(notification.created_at)}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    `;
                } catch (e) {
                    console.error('Error rendering notification:', e, notification);
                }
            });
            list.html(html);

            // Mark as read on click
            $('.notification-item-header').on('click', function(e) {
                const notificationId = $(this).data('id');
                if (!$(this).hasClass('bg-light')) return; // Already read
                
                $.ajax({
                    url: '{{ route("client.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        loadHeaderNotifications();
                    }
                });
            });
        }

        function getHeaderNotificationIcon(type) {
            const icons = {
                'new_order': 'fas fa-shopping-cart text-primary',
                'new_message': 'fas fa-envelope text-info',
                'new_appointment': 'fas fa-calendar-check text-success',
                'payment_approved': 'fas fa-check-circle text-success'
            };
            return icons[type] || 'fas fa-bell text-secondary';
        }

        function formatHeaderTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diff = now - date;
            const minutes = Math.floor(diff / 60000);
            const hours = Math.floor(diff / 3600000);
            const days = Math.floor(diff / 86400000);
            
            if (minutes < 1) return '{{ __("Just now") }}';
            if (minutes < 60) return minutes + ' {{ __("minutes ago") }}';
            if (hours < 24) return hours + ' {{ __("hours ago") }}';
            if (days < 7) return days + ' {{ __("days ago") }}';
            return date.toLocaleDateString();
        }

        // Mark all as read
        $('.mark-all-read-header').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("client.notifications.mark-all-read") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    loadHeaderNotifications();
                }
            });
        });

        // Load notifications on page load
        loadHeaderNotifications();
        
        // Refresh notifications every 30 seconds
        setInterval(loadHeaderNotifications, 30000);

        // Toggle dropdown on button click (fallback)
        $('#client-header-notification-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var menu = $('#client-header-notification-menu');
            if (menu.hasClass('show')) {
                menu.removeClass('show');
            } else {
                menu.addClass('show');
                loadHeaderNotifications();
            }
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#client-header-notification-dropdown').length) {
                $('#client-header-notification-menu').removeClass('show');
            }
        });
    });
</script>
@endauth

@if (customCode()?->footer_javascript)
    <script>
        "use strict";
        {!! customCode()->footer_javascript !!}
    </script>
@endif

<script>
    // Mobile Menu Submenu Toggle
    function toggleSubmenu(element) {
        const listItem = element.closest('.mobile-menu-list-item');
        if (listItem) {
            listItem.classList.toggle('active');
        }
    }

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileSideMenu');
        if (menu) {
            menu.classList.toggle('active');
            document.body.style.overflow = menu.classList.contains('active') ? 'hidden' : '';
        }
    }

    // Close mobile menu when clicking overlay
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.querySelector('.side-menu-overlay');
        if (overlay) {
            overlay.addEventListener('click', toggleMobileMenu);
        }
    });
</script>

@push('css')
<style>
    /* Enhanced Top Footer Design with Icons on Right */
    .top-footer {
        background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%);
        position: relative;
        padding: 40px 0 !important;
    }
    
    .top-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #DC2626 0%, #EF4444 50%, #F97316 100%);
        z-index: 1;
    }
    
    .footer-address {
        text-align: center;
        padding: 25px 20px !important;
        border-right: 1px solid rgba(255, 255, 255, 0.15);
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .footer-address:hover {
        background: rgba(255, 255, 255, 0.05);
    }
    
    .footer-address-first {
        border-left: 1px solid rgba(255, 255, 255, 0.15);
    }
    
    .footer-address ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-address ul li {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 20px !important;
        padding: 0 !important;
        position: relative;
    }
    
    [dir="ltr"] .footer-address ul li {
        flex-direction: row !important;
    }
    
    [dir="rtl"] .footer-address ul li {
        flex-direction: row !important;
    }
    
    /* Icons on Right for RTL, Left for LTR */
    .footer-address ul li i {
        position: relative !important;
        left: auto !important;
        right: auto !important;
        top: auto !important;
        font-size: 32px !important;
        line-height: 1 !important;
        color: #D4A574 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 50px !important;
        height: 50px !important;
        min-width: 50px !important;
        background: rgba(212, 165, 116, 0.1);
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }
    
    /* LTR: Icon on right (order 2) */
    [dir="ltr"] .footer-address ul li i {
        order: 2 !important;
    }
    
    /* RTL: Icon on right (order 1) - because in RTL, order 1 appears on the right */
    [dir="rtl"] .footer-address ul li i {
        order: 1 !important;
    }
    
    .footer-address ul li:hover i {
        background: rgba(212, 165, 116, 0.2);
        transform: scale(1.1) rotate(5deg);
        color: #E0B584 !important;
        box-shadow: 0 4px 12px rgba(212, 165, 116, 0.3);
    }
    
    /* Text Content */
    .footer-address ul li > div {
        display: flex !important;
        flex-direction: column !important;
        flex: 1 !important;
        text-align: center;
    }
    
    [dir="ltr"] .footer-address ul li > div {
        order: 1 !important;
        direction: ltr;
        text-align: center;
    }
    
    [dir="rtl"] .footer-address ul li > div {
        order: 2 !important;
        direction: rtl;
        text-align: center;
    }
    
    .footer-address ul li .title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #D4A574 !important;
        margin-bottom: 8px !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .footer-address ul li p {
        font-size: 15px !important;
        line-height: 1.6 !important;
        color: #E5E7EB !important;
        font-weight: 500 !important;
        margin: 0 !important;
        word-break: break-word;
    }
    
    /* Remove old separators */
    .footer-address ul li::before {
        display: none !important;
    }
    
    /* Responsive Design */
    @media (max-width: 991px) {
        .footer-address {
            border-right: none !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 30px 20px !important;
        }
        
        .footer-address:last-child {
            border-bottom: none !important;
        }
        
        .footer-address-first {
            border-left: none !important;
        }
        
        .footer-address ul li {
            flex-direction: column !important;
            gap: 15px !important;
        }
        
        .footer-address ul li i {
            order: 1 !important;
        }
        
        .footer-address ul li > div {
            order: 2 !important;
        }
    }
    
    @media (max-width: 768px) {
        .top-footer {
            padding: 30px 0 !important;
        }
        
        .footer-address ul li i {
            font-size: 28px !important;
            width: 45px !important;
            height: 45px !important;
            min-width: 45px !important;
        }
        
        .footer-address ul li .title {
            font-size: 14px !important;
        }
        
        .footer-address ul li p {
            font-size: 14px !important;
        }
    }
</style>
@endpush

</body>

</html>
