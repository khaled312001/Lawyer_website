@php
    $header_lawyer = Auth::guard('lawyer')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <link rel="icon" href="{{ asset($setting->favicon) }}">
    @include('backend_layouts.partials.styles')
    @stack('css')
</head>

<body>
    <div id="app" class="lawyer_dashboard_layout">
        <div class="main-wrapper">
            {{-- New Lawyer Header --}}
            @include('lawyer.lawyer_header')

            {{-- New Lawyer Sidebar --}}
            @include('lawyer.lawyer_navigation')

            <div class="lawyer-main-content">
                @yield('admin-content')
            </div>

            <footer class="main-footer">
                <div class="footer-right">
                    <p>{{ $contactInfo?->copyright }}</p>
                </div>
            </footer>
        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="lawyer-logout-form" action="{{ route('lawyer.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
    @include('backend_layouts.partials.javascripts')

    @stack('js')
    
    <style>
    /* Lawyer Main Content Layout */
    @php
        $textDirection = session()->get('text_direction', 'ltr');
        $currentLang = session()->get('lang', config('app.locale', 'ar'));
        $rtlLanguages = ['ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi'];
        $isRTL = $textDirection === 'rtl' || in_array($currentLang, $rtlLanguages);
    @endphp
    
    .lawyer-main-content {
        margin-left: 260px;
        margin-top: 70px;
        padding: 0;
        padding-top: 0;
        min-height: calc(100vh - 70px);
        transition: margin-left 0.3s ease, margin-right 0.3s ease;
        width: calc(100% - 260px);
        box-sizing: border-box;
    }
    
    @media (min-width: 1025px) {
        .lawyer-main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
        }
    }
    
    .lawyer-main-content .main-content {
        margin-top: 0;
        padding-top: 0;
        padding: 20px;
    }
    
    .lawyer-main-content .section {
        margin-top: 0;
        padding-top: 0;
    }
    
    @media (max-width: 1024px) {
        .lawyer-main-content {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding: 15px 10px !important;
            width: 100% !important;
        }
        
        .lawyer-main-content .main-content {
            padding: 0 !important;
        }
        
        .lawyer-main-content .section {
            padding: 0 !important;
        }
    }
    
    /* Footer adjustments */
    .main-footer {
        margin-left: 260px;
        transition: margin-left 0.3s ease, margin-right 0.3s ease;
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e3e6f0;
        width: calc(100% - 260px);
        box-sizing: border-box;
    }
    
    @media (min-width: 1025px) {
        .main-footer {
            margin-left: 260px;
            width: calc(100% - 260px);
        }
    }
    
    @media (max-width: 1024px) {
        .main-footer {
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
            padding: 12px 15px !important;
            text-align: center !important;
            font-size: 13px !important;
        }
    }
    
    @if($isRTL)
    /* RTL Support - Arabic */
    .lawyer-main-content {
        margin-left: 0;
        margin-right: 260px;
        width: calc(100% - 260px);
        padding: 0;
    }
    
    .main-footer {
        margin-left: 0;
        margin-right: 260px;
        width: calc(100% - 260px);
    }
    
    @media (max-width: 1024px) {
        .lawyer-main-content {
            margin-right: 0 !important;
            width: 100% !important;
        }
        
        .main-footer {
            margin-right: 0 !important;
            width: 100% !important;
        }
    }
    @endif
    </style>
    
    <script>
        // Notifications functionality for Lawyer
        $(document).ready(function() {

            // Load notifications
            function loadNotifications() {
                // Show loading indicator
                var list = $('#lawyer-header-notifications-list');
                if (list.length && list.html().trim() === '') {
                    list.html('<div class="text-center p-3"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                }
                
                $.ajax({
                    url: '{{ route("lawyer.notifications.fetch") }}',
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    timeout: 10000,
                    success: function(response) {
                        if (response && response.unread_count !== undefined) {
                            updateNotificationCount(response.unread_count || 0);
                            renderNotifications(response.notifications || []);
                        } else {
                            $('#lawyer-header-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Only log errors that aren't connection/timeout issues to avoid console spam
                        if (status !== 'timeout' && status !== 'abort' && xhr.status !== 0) {
                            console.error('Notification fetch error:', {
                                status: status,
                                error: error,
                                statusCode: xhr.status,
                                responseText: xhr.responseText
                            });
                            $('#lawyer-header-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("Failed to load notifications") }}</div>');
                        } else if (xhr.status === 0) {
                            // Connection error - don't show error message, just keep current state
                            console.warn('Notification fetch: Connection issue');
                        }
                        updateNotificationCount(0);
                    }
                });
            }

            function updateNotificationCount(count) {
                const badge = $('#lawyer-header-notification-count');
                if (count > 0) {
                    badge.text(count > 99 ? '99+' : count).show();
                } else {
                    badge.hide();
                }
            }

            function renderNotifications(notifications) {
                const list = $('#lawyer-header-notifications-list');
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
                        const icon = getNotificationIcon(notificationData.type || '');
                        html += `
                            <a href="${notificationData.url || '#'}" class="dropdown-item notification-item ${readClass}" data-id="${notification.id || ''}">
                                <div class="d-flex align-items-start">
                                    <div class="notification-icon-wrapper me-2">
                                        <i class="${icon}"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold small">${notificationData.title || '{{ __("Notification") }}'}</div>
                                        <div class="text-muted small" style="font-size: 0.85rem;">${notificationData.message || ''}</div>
                                        <div class="text-muted" style="font-size: 0.75rem; margin-top: 4px;">${formatTime(notification.created_at)}</div>
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
                $('.notification-item').on('click', function(e) {
                    const notificationId = $(this).data('id');
                    if (!$(this).hasClass('bg-light')) return; // Already read
                    
                    $.ajax({
                        url: '{{ route("lawyer.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            loadNotifications();
                        }
                    });
                });
            }

            function getNotificationIcon(type) {
                const icons = {
                    'new_order': 'fas fa-shopping-cart text-primary',
                    'new_message': 'fas fa-envelope text-info',
                    'new_appointment': 'fas fa-calendar-check text-success',
                    'payment_approved': 'fas fa-check-circle text-success'
                };
                return icons[type] || 'fas fa-bell text-secondary';
            }

            function formatTime(dateString) {
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
            $('.lawyer-mark-all-read').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("lawyer.notifications.mark-all-read") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        loadNotifications();
                    }
                });
            });

            // Load notifications on page load
            loadNotifications();
            
            // Refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);

            // Handle notification dropdown toggle
            $('.lawyer-notification-btn').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var $dropdown = $(this).closest('.lawyer-notification-dropdown');
                var $menu = $dropdown.find('.lawyer-notification-menu');
                var isOpen = $menu.hasClass('show');
                
                // Close all other dropdowns
                $('.lawyer-notification-menu').not($menu).removeClass('show');
                
                // Toggle current dropdown
                if (isOpen) {
                    $menu.removeClass('show');
                } else {
                    $menu.addClass('show');
                    loadNotifications();
                }
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.lawyer-notification-dropdown').length) {
                    $('.lawyer-notification-menu').removeClass('show');
                }
            });
            
            // Also try to initialize Bootstrap dropdown if available (for better positioning)
            if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                var notificationDropdowns = document.querySelectorAll('.lawyer-notification-dropdown');
                notificationDropdowns.forEach(function(dropdownElement) {
                    var toggleButton = dropdownElement.querySelector('.lawyer-notification-btn[data-bs-toggle="dropdown"]');
                    if (toggleButton) {
                        try {
                            var dropdownInstance = new bootstrap.Dropdown(toggleButton, {
                                boundary: 'viewport',
                                popperConfig: {
                                    modifiers: [
                                        {
                                            name: 'offset',
                                            options: {
                                                offset: [0, 8]
                                            }
                                        }
                                    ]
                                }
                            });
                            
                            // Load notifications when dropdown is shown via Bootstrap
                            toggleButton.addEventListener('show.bs.dropdown', function() {
                                loadNotifications();
                            });
                        } catch (e) {
                            // Bootstrap failed, manual toggle will handle it
                            console.warn('Bootstrap dropdown init failed, using manual toggle');
                        }
                    }
                });
            }
        });

    </script>

</body>

</html>
