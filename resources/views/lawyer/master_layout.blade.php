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
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar px-2 py-2">
                <div class="me-auto form-inline">
                    <ul class="me-2 navbar-nav d-flex align-items-center">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        {{-- language select --}}
                        @include('backend_layouts.partials.language_select')
                        {{-- currency select --}}
                        @include('backend_layouts.partials.currency_select')
                    </ul>
                </div>
                <ul class="navbar-nav lawyer_nav ms-auto d-flex align-items-center">
                    <li class="dropdown dropdown-list-toggle">
                        <a target="_blank" href="{{ route('home') }}" class="nav-link nav-link-lg">
                            <i class="fas fa-home"></i> {{ __('Visit Website') }}</i>
                        </a>
                    </li>

                    {{-- Notifications Dropdown --}}
                    <li class="dropdown dropdown-list-toggle notification-dropdown">
                        <a href="javascript:;" data-bs-toggle="dropdown" class="nav-link nav-link-lg notification-icon p-0 position-relative">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notification-count" style="display: none;">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification-dropdown-menu" style="width: 350px; max-height: 400px; overflow-y: auto;">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">{{ __('Notifications') }}</h6>
                                <a href="javascript:;" class="text-primary small mark-all-read" style="text-decoration: none;">{{ __('Mark all as read') }}</a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div id="notifications-list">
                                <div class="text-center p-3">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-footer text-center">
                                <a href="{{ route('lawyer.notifications.index') }}" class="text-primary small" style="text-decoration: none;">{{ __('View all notifications') }}</a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown"><a href="javascript:;" data-bs-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if ($header_lawyer->image)
                                <img alt="image" src="{{ asset($header_lawyer->image) }}"
                                    class="me-1 rounded-circle">
                            @else
                                <img alt="image" src="{{ asset($setting->default_avatar) }}"
                                    class="me-1 rounded-circle">
                            @endif

                            <div class="d-sm-none d-lg-inline-block">{{ $header_lawyer->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('lawyer.edit-profile', ['code' => getSessionLanguage()]) }}"
                                class="dropdown-item has-icon d-flex align-items-center {{ isroute('lawyer.edit-profile', 'text-primary') }}">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                            <a href="{{ route('lawyer.change-password') }}"
                                class="dropdown-item has-icon d-flex align-items-center {{ isroute('lawyer.change-password', 'text-primary') }}">
                                <i class="fas fa-key"></i> {{ __('Change Password') }}
                            </a>
                            <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center"
                                onclick="event.preventDefault(); $('#lawyer-logout-form').trigger('submit');">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>


            @include('lawyer.sidebar')

            @yield('admin-content')

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
    
    <script>
        // Notifications functionality for Lawyer
        $(document).ready(function() {
            // Load notifications
            function loadNotifications() {
                $.ajax({
                    url: '{{ route("lawyer.notifications.fetch") }}',
                    method: 'GET',
                    success: function(response) {
                        if (response && response.unread_count !== undefined) {
                            updateNotificationCount(response.unread_count || 0);
                            renderNotifications(response.notifications || []);
                        } else {
                            $('#notifications-list').html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Notification fetch error:', error);
                        $('#notifications-list').html('<div class="text-center p-3 text-muted">{{ __("Failed to load notifications") }}</div>');
                        updateNotificationCount(0);
                    }
                });
            }

            function updateNotificationCount(count) {
                const badge = $('#notification-count');
                if (count > 0) {
                    badge.text(count > 99 ? '99+' : count).show();
                } else {
                    badge.hide();
                }
            }

            function renderNotifications(notifications) {
                const list = $('#notifications-list');
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
            $('.mark-all-read').on('click', function(e) {
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
        });

        // Close sidebar when clicking backdrop on mobile (Lawyer Dashboard)
        $(document).ready(function() {
            $(document).on('click', function(e) {
                if ($(window).width() <= 1024) {
                    if ($('body').hasClass('sidebar-show')) {
                        // Check if click is outside sidebar and not on toggle button
                        if (!$(e.target).closest('.main-sidebar').length && 
                            !$(e.target).closest('[data-toggle="sidebar"]').length &&
                            !$(e.target).is('[data-toggle="sidebar"]')) {
                            $('body').removeClass('sidebar-show');
                        }
                    }
                }
            });
            
            // Prevent body scroll when sidebar is open on mobile
            $('[data-toggle="sidebar"]').on('click', function() {
                if ($(window).width() <= 1024) {
                    setTimeout(function() {
                        if ($('body').hasClass('sidebar-show')) {
                            $('body').css('overflow', 'hidden');
                        } else {
                            $('body').css('overflow', 'auto');
                        }
                    }, 100);
                }
            });
        });
    </script>

</body>

</html>
