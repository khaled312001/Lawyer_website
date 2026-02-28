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
                                    <p>{!! nl2br(e($contactInfo?->top_bar_email ?? $contactInfo?->email)) !!}</p>
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
                <div class="col-xxl-3 col-lg-3 col-md-6">
                    <div class="footer-item">
                        <p class="title">{{ __('عن أمان لو') }}</p>
                        <div class="textwidget pe-0">
                            <p style="font-size: 13px; line-height: 1.7; color: rgba(255, 255, 255, 0.85); margin-bottom: 12px;">
                                {{ __('أمان لو – Aman Law') }}<br>
                                {{ __('منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تقديم استشارات قانونية وتمثيل قضائي في القضايا المتعلقة بسوريا للعملاء في جميع أنحاء العالم، عبر محامين مختصين وبآلية عمل شفافة وموثوقة.') }}
                            </p>
                            <ul class="icon">
                                @foreach (getSocialLinks() as $social)
                                    <li><a target="_blank" aria-label="{{ $social?->link }}" href="{{ $social?->link }}"><i class="{{ $social?->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 col-md-6 d-none">
                    <div class="footer-item">
                        <p class="title">{{ __('روابط سريعة') }}</p>
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('الرئيسية') }}</a></li>
                            <li><a href="{{ url('about-us') }}">{{ __('من نحن') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 col-md-6 d-none">
                    <div class="footer-item">
                        <p class="title">{{ __('الخدمات القانونية') }}</p>
                        <ul>
                            <li><a href="javascript:;">{{ __('الخدمات') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 col-md-6 d-none">
                    <div class="footer-item">
                        <p class="title">{{ __('معلومات قانونية') }}</p>
                        <ul>
                            <li><a href="{{ route('website.privacy-policy') }}">{{ __('سياسة الخصوصية') }}</a></li>
                            <li><a href="{{ route('website.termsCondition') }}">{{ __('الشروط والأحكام') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="footer-item">
                        <p class="title">{{ __('التواصل') }}</p>
                        <div style="font-size: 13px; line-height: 1.7; color: rgba(255, 255, 255, 0.85);">
                            @if ($contactInfo?->top_bar_phone)
                                @php
                                    $whatsappNumber = $contactInfo->top_bar_phone;
                                    $whatsappNumber = preg_replace('/[^0-9+]/', '', $whatsappNumber);
                                    if (!str_starts_with($whatsappNumber, '+')) {
                                        $whatsappNumber = '+963' . ltrim($whatsappNumber, '0');
                                    }
                                @endphp
                                <p style="margin-bottom: 10px;">
                                    <strong>{{ __('التواصل عبر واتساب:') }}</strong><br>
                                    <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" style="color: #D4A574; text-decoration: none;">{{ $contactInfo->top_bar_phone }}</a>
                                </p>
                            @endif
                            @if ($contactInfo?->top_bar_email)
                                <p style="margin-bottom: 10px;">
                                    <strong>{{ __('البريد الإلكتروني:') }}</strong><br>
                                    <a href="mailto:{{ $contactInfo->top_bar_email }}" style="color: #D4A574; text-decoration: none;">{{ $contactInfo->top_bar_email }}</a>
                                </p>
                            @endif
                            <p style="margin-bottom: 0;">
                                <strong>{{ __('الاستشارات:') }}</strong><br>
                                {{ __('استشارات قانونية عن بُعد عبر واتساب، مكالمات صوتية أو فيديو.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyrignt">
        <div class="container">
            <div class="copyright-text text-center">
                @if(getSessionLanguage() == 'ar')
                    <p style="margin-bottom: 5px;">© {{ __('جميع الحقوق محفوظة – أمان لو Aman Law') }}</p>
                    <p style="margin-top: 0; font-size: 12px; color: rgba(255, 255, 255, 0.7);">{{ __('منصّة قانونية مُدارة من سويسرا') }}</p>
                @else
                    <p style="margin-bottom: 5px;">Copyright © 2026, Aman Law. All rights reserved.</p>
                    <p style="margin-top: 0; font-size: 12px; color: rgba(255, 255, 255, 0.7);">{{ __('Legal platform managed from Switzerland') }}</p>
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
        let amanWelcomeBanner = null;
        let amanTopBar = null;
        let amanMainNav = null;
        const amanBody = document.body;
        const isMobile = window.innerWidth <= 768;
        
        // Initialize DOM elements safely
        function initAmanElements() {
            if (!amanWelcomeBanner) {
                amanWelcomeBanner = document.querySelector('.aman-welcome-banner-rtl, .top-alert-banner');
            }
            if (!amanTopBar) {
                amanTopBar = document.querySelector('.aman-top-bar-rtl, .top-header-bar');
            }
            if (!amanMainNav) {
                amanMainNav = document.querySelector('.aman-main-nav-rtl, .main-navbar');
            }
        }
        
        // Initialize on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAmanElements);
        } else {
            initAmanElements();
        }

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
    
    // Dashboard sidebar functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Hide main site header and banner in dashboard pages
        const dashboardArea = document.querySelector('.dashboard-area');
        if (dashboardArea) {
            // Hide banner area
            const bannerArea = document.querySelector('.banner-area');
            if (bannerArea && !bannerArea.classList.contains('dashboard-banner-hidden')) {
                bannerArea.style.display = 'none';
                bannerArea.style.visibility = 'hidden';
                bannerArea.style.opacity = '0';
                bannerArea.style.height = '0';
                bannerArea.style.padding = '0';
                bannerArea.style.margin = '0';
                bannerArea.style.overflow = 'hidden';
            }
            const topHeaderBar = document.querySelector('.top-header-bar');
            const mainNavbar = document.querySelector('.main-navbar');
            const mobileSideMenu = document.getElementById('mobileSideMenu');
            
            if (topHeaderBar) {
                topHeaderBar.style.display = 'none';
                topHeaderBar.style.visibility = 'hidden';
                topHeaderBar.style.opacity = '0';
                topHeaderBar.style.height = '0';
                topHeaderBar.style.overflow = 'hidden';
            }
            
            if (mainNavbar) {
                mainNavbar.style.display = 'none';
                mainNavbar.style.visibility = 'hidden';
                mainNavbar.style.opacity = '0';
                mainNavbar.style.height = '0';
                mainNavbar.style.overflow = 'hidden';
            }
            
            if (mobileSideMenu) {
                mobileSideMenu.style.display = 'none';
                mobileSideMenu.style.visibility = 'hidden';
                mobileSideMenu.style.opacity = '0';
            }
            
            // Remove padding-top from body
            document.body.style.paddingTop = '0';
        }
        
        // Close sidebar when clicking backdrop
        document.addEventListener('click', function(e) {
            if (e.target === document.body.querySelector('::before') || 
                (e.target.classList && e.target.classList.contains('dashboard-area'))) {
                if (window.innerWidth < 992 && document.body.classList.contains('dashboard-sidebar-open')) {
                    document.body.classList.remove('dashboard-sidebar-open');
                    document.body.style.overflow = 'auto';
                    const sidebar = document.querySelector('.dashboard-sidebar');
                    if (sidebar) {
                        sidebar.style.right = '-100%';
                    }
                }
            }
        });
        
        // Close sidebar when clicking menu items on mobile
        const sidebar = document.querySelector('.dashboard-sidebar');
        if (sidebar) {
            const menuLinks = sidebar.querySelectorAll('ul li a');
            menuLinks.forEach(link => {
                if (!link.getAttribute('onclick') || !link.getAttribute('onclick').includes('logout')) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 992) {
                            setTimeout(() => {
                                document.body.classList.remove('dashboard-sidebar-open');
                                document.body.style.overflow = 'auto';
                                sidebar.style.right = '-100%';
                            }, 300);
                        }
                    });
                }
            });
            
            // Close button
            const closeBtn = document.getElementById('dashboard-sidebar-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    document.body.classList.remove('dashboard-sidebar-open');
                    document.body.style.overflow = 'auto';
                    sidebar.style.right = '-100%';
                });
            }
        }
        
        // Close sidebar on window resize if desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                document.body.classList.remove('dashboard-sidebar-open');
                document.body.style.overflow = 'auto';
                const sidebar = document.querySelector('.dashboard-sidebar');
                if (sidebar) {
                    sidebar.style.right = '0';
                }
            }
        });
    });
</script>

@push('css')
<style>
    /* Hide main site header in client dashboard pages */
    @php
        $isDashboardPage = request()->routeIs('dashboard') || 
                           request()->routeIs('client.*') || 
                           request()->routeIs('client.messages.*') || 
                           request()->routeIs('client.meeting-history') || 
                           request()->routeIs('client.upcomming-meeting') || 
                           request()->routeIs('client.payment');
    @endphp
    
    @if($isDashboardPage)
    .top-header-bar,
    .main-navbar,
    #mainNavbar,
    .mobile-side-menu {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    body.client-frontend {
        padding-top: 0 !important;
    }
    
    /* Ensure client dashboard header is visible */
    .client-topbar {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    @endif
    
    /* Enhanced Top Footer Design with Icons on Right */
    .top-footer {
        background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%);
        position: relative;
        padding: 25px 0 !important;
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
        padding: 15px 20px !important;
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
    
    /* RTL: Use row-reverse to put icon on right side */
    [dir="rtl"] .footer-address ul li {
        flex-direction: row-reverse !important;
    }
    
    /* Icons */
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
        direction: ltr;
        text-align: center;
    }
    
    [dir="rtl"] .footer-address ul li > div {
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
            padding: 20px 0 !important;
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
    
    /* Reduce Footer Area Height - تقليل ارتفاع منطقة الفوتر */
    .footer-area {
        padding-top: 35px !important;
        padding-bottom: 40px !important;
    }
    
    /* Reduce textwidget padding */
    .textwidget {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    
    .footer-item {
        margin-top: 15px !important;
        margin-bottom: 20px !important;
    }
    
    .footer-item .title {
        font-size: 18px !important;
        margin-bottom: 20px !important;
        padding-bottom: 10px !important;
    }
    
    .footer-item p {
        font-size: 13px !important;
        line-height: 1.7 !important;
        margin-bottom: 12px !important;
    }
    
    .footer-item ul {
        margin-top: 0 !important;
    }
    
    .footer-item ul li {
        padding-bottom: 4px !important;
        margin-bottom: 4px !important;
    }
    
    .footer-item ul li a {
        font-size: 13px !important;
        line-height: 1.6 !important;
    }
    
    .footer-item .icon {
        margin-top: 15px !important;
        gap: 8px !important;
    }
    
    .footer-item .icon li a {
        width: 36px !important;
        height: 36px !important;
        line-height: 36px !important;
        font-size: 14px !important;
    }
    
    /* Reduce Copyright Section Height - تقليل ارتفاع قسم حقوق النشر */
    .footer-copyrignt {
        padding-top: 15px !important;
        padding-bottom: 12px !important;
    }
    
    .copyright-text {
        text-align: center !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .copyright-text p {
        font-size: 13px !important;
        line-height: 1.6 !important;
        margin-bottom: 5px !important;
        text-align: center !important;
        width: 100% !important;
    }
    
    .copyright-text p:last-child {
        margin-bottom: 0 !important;
    }
    
    /* Responsive adjustments for footer area */
    @media (max-width: 991px) {
        .footer-area {
            padding-top: 30px !important;
            padding-bottom: 35px !important;
        }
        
        .footer-item {
            margin-bottom: 25px !important;
        }
    }
    
    @media (max-width: 768px) {
        .footer-area {
            padding-top: 25px !important;
            padding-bottom: 30px !important;
        }
        
        .footer-item .title {
            font-size: 16px !important;
            margin-bottom: 15px !important;
        }
        
        .footer-item p,
        .footer-item ul li a {
            font-size: 12px !important;
        }
        
        .footer-copyrignt {
            padding-top: 12px !important;
            padding-bottom: 10px !important;
        }
        
        .copyright-text p {
            font-size: 12px !important;
        }
    }
</style>
@endpush

</body>

</html>
