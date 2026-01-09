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
                                <input type="email" required name="email" placeholder="{{ __('Email') }}" class="subscribe-input">
                            </div>
                            <button type="submit" class="btn-sub">
                                <span>{{ __('Subscribe') }}</span>
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

</body>

</html>
