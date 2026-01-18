@php
    $header_admin = Auth::guard('admin')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <link rel="icon" href="{{ $setting?->favicon ? asset($setting->favicon) : '' }}">
    @include('backend_layouts.partials.styles')
    @stack('css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar admin-navbar-improved">
                <div class="navbar-left d-flex align-items-center flex-grow-1">
                    {{-- Mobile & Desktop Sidebar Toggle --}}
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg sidebar-toggle-btn">
                        <i class="fas fa-bars"></i>
                    </a>
                    
                    {{-- Logo --}}
                    <a href="{{ route('admin.dashboard') }}" class="navbar-logo d-flex align-items-center">
                    </a>
                    
                    {{-- Desktop Menu Items - Language & Currency Grouped --}}
                    <div class="d-none d-lg-flex align-items-center navbar-controls-group">
                        {{-- language select --}}
                        @include('backend_layouts.partials.language_select')
                        {{-- currency select --}}
                        @include('backend_layouts.partials.currency_select')
                    </div>
                    
                    {{-- Mobile Menu Toggle Button --}}
                    <button class="navbar-toggler d-lg-none ms-auto border-0 bg-transparent mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbarMenu" aria-controls="mobileNavbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-ellipsis-v text-white"></i>
                    </button>
                </div>
                
                {{-- Search Box - Centered --}}
                <div class="navbar-center search-box-wrapper d-none d-md-flex">
                    <div class="search-box position-relative">
                        <x-admin.form-input id="search_menu" :placeholder="__('Search option')" />
                        <div id="admin_menu_list" class="position-absolute d-none rounded-2 search-dropdown">
                            @foreach (App\Enums\RouteList::getAll() as $route_item)
                                @if (checkAdminHasPermission($route_item?->permission) || empty($route_item?->permission))
                                    <a @isset($route_item->tab)
                                            data-active-tab="{{ $route_item->tab }}" class="border-bottom search-menu-item"
                                        @else
                                            class="border-bottom"
                                        @endisset
                                        href="{{ $route_item?->route }}">{{ $route_item?->name }}</a>
                                @endif
                            @endforeach
                            <a class="not-found-message d-none" href="javascript:;">{{ __('Not Found!') }}</a>
                        </div>
                    </div>
                </div>
                
                {{-- Right Side Actions --}}
                <div class="navbar-right d-flex align-items-center">
                    <ul class="navbar-nav d-none d-lg-flex align-items-center navbar-actions-list">
                        {{-- Notifications Dropdown --}}
                        <li class="dropdown admin-alert-wrapper">
                            <a href="javascript:;" data-bs-toggle="dropdown" id="admin-notification-toggle" class="admin-alert-button" aria-label="{{ __('Notifications') }}" aria-expanded="false">
                                <i class="fas fa-bell admin-alert-icon"></i>
                                <span class="admin-alert-counter" id="notification-count" style="display: none;">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end admin-alert-panel" id="admin-notification-dropdown">
                                <div class="admin-alert-top">
                                    <h6 class="admin-alert-heading">{{ __('Notifications') }}</h6>
                                    <a href="javascript:;" class="admin-alert-mark-all mark-all-read">{{ __('Mark all as read') }}</a>
                                </div>
                                <div class="admin-alert-separator"></div>
                                <div class="admin-alert-content" id="notifications-list">
                                    <div class="admin-alert-spinner">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="admin-alert-separator"></div>
                                <div class="admin-alert-bottom">
                                    <a href="{{ route('admin.notifications.index') }}" class="admin-alert-link">{{ __('View all notifications') }}</a>
                                </div>
                            </div>
                        </li>

                        {{-- Visit Website Link --}}
                        <li class="dropdown dropdown-list-toggle">
                            <a target="_blank" href="{{ route('home') }}" class="nav-link nav-link-lg visit-site-link">
                                <i class="fas fa-home"></i> 
                                <span class="visit-site-text">{{ __('Visit Website') }}</span>
                            </a>
                        </li>

                        {{-- User Profile Dropdown --}}
                        <li class="dropdown">
                            <a href="javascript:;" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image"
                                    src="{{ !empty($header_admin->image) ? asset($header_admin->image) : ($setting?->default_avatar ? asset($setting->default_avatar) : '') }}"
                                    class="user-avatar rounded-circle">
                                <div class="d-sm-none d-lg-inline-block user-name">{{ $header_admin->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @adminCan('admin.profile.view')
                                    <a href="{{ route('admin.edit-profile') }}"
                                        class="dropdown-item has-icon d-flex align-items-center {{ isRoute('admin.edit-profile', 'text-primary') }}">
                                        <i class="far fa-user"></i> {{ __('Profile') }}
                                    </a>
                                @endadminCan
                                @adminCan('setting.view')
                                    <a href="{{ route('admin.settings') }}"
                                        class="dropdown-item has-icon d-flex align-items-center {{ isRoute('admin.settings', 'text-primary') }}">
                                        <i class="fas fa-cog"></i> {{ __('Setting') }}
                                    </a>
                                @endadminCan
                                <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center"
                                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                    
                    {{-- Mobile User Avatar --}}
                    <div class="d-lg-none mobile-user-avatar">
                        <a href="javascript:;" data-bs-toggle="collapse" data-bs-target="#mobileNavbarMenu" aria-controls="mobileNavbarMenu" class="nav-link nav-link-lg nav-link-user p-0">
                            <img alt="image"
                                src="{{ !empty($header_admin->image) ? asset($header_admin->image) : ($setting?->default_avatar ? asset($setting->default_avatar) : '') }}"
                                class="rounded-circle mobile-avatar-img">
                        </a>
                    </div>
                </div>
            </nav>
            
            {{-- Mobile Menu --}}
            <div class="collapse navbar-collapse mobile-navbar-menu" id="mobileNavbarMenu">
                <div class="mobile-menu-content">
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Search') }}</h6>
                        <div class="search-box-mobile position-relative mb-3">
                            <x-admin.form-input id="search_menu_mobile" :placeholder="__('Search option')" />
                            <div id="admin_menu_list_mobile" class="position-absolute d-none rounded-2 w-100">
                                @foreach (App\Enums\RouteList::getAll() as $route_item)
                                    @if (checkAdminHasPermission($route_item?->permission) || empty($route_item?->permission))
                                        <a @isset($route_item->tab)
                                                data-active-tab="{{ $route_item->tab }}" class="border-bottom search-menu-item"
                                            @else
                                                class="border-bottom"
                                            @endisset
                                            href="{{ $route_item?->route }}">{{ $route_item?->name }}</a>
                                    @endif
                                @endforeach
                                <a class="not-found-message d-none" href="javascript:;">{{ __('Not Found!') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Language & Currency') }}</h6>
                        <div class="d-flex flex-column gap-2">
                            @include('backend_layouts.partials.language_select')
                            @include('backend_layouts.partials.currency_select')
                        </div>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Quick Actions') }}</h6>
                        <a target="_blank" href="{{ route('home') }}" class="mobile-menu-item">
                            <i class="fas fa-home"></i> {{ __('Visit Website') }}
                        </a>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Account') }}</h6>
                        <div class="mobile-user-info mb-3">
                            <img alt="image"
                                src="{{ !empty($header_admin->image) ? asset($header_admin->image) : ($setting?->default_avatar ? asset($setting->default_avatar) : '') }}"
                                class="rounded-circle me-2" style="width: 40px; height: 40px;">
                            <span>{{ $header_admin->name }}</span>
                        </div>
                        @adminCan('admin.profile.view')
                            <a href="{{ route('admin.edit-profile') }}" class="mobile-menu-item">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endadminCan
                        @adminCan('setting.view')
                            <a href="{{ route('admin.settings') }}" class="mobile-menu-item">
                                <i class="fas fa-cog"></i> {{ __('Setting') }}
                            </a>
                        @endadminCan
                        <a href="javascript:;" class="mobile-menu-item text-danger"
                            onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>

            @if (request()->routeIs(
                    'admin.general-setting',
                    'admin.crediential-setting',
                    'admin.email-configuration',
                    'admin.edit-email-template',
                    'admin.currency.*',
                    'admin.seo-setting',
                    'admin.custom-code',
                    'admin.cache-clear',
                    'admin.database-clear',
                    'admin.system-update.index',
                    'admin.addons.*',
                    'admin.admin.*',
                    'admin.languages.*',
                    'admin.basicpayment',
                    'admin.paymentgateway',
                    'admin.role.*'))
                @include('admin.settings.sidebar')
            @else
                @include('admin.sidebar')
            @endif
            @yield('admin-content')

            <footer class="main-footer">
                <div class="footer-right">
                </div>
            </footer>

        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
    @include('backend_layouts.partials.javascripts')

    @stack('js')
    
    <script>
        // Sidebar behavior: Always open on desktop, toggleable on mobile only
        $(document).ready(function() {
            function handleSidebar() {
                // On mobile (width <= 1024px), allow toggle
                if ($(window).width() <= 1024) {
                    // Mobile: Sidebar should be closed by default
                    if (!$('body').hasClass('sidebar-show')) {
                        $('body').addClass('sidebar-gone');
                    }
                } else {
                    // Desktop: Always keep sidebar open
                    $('body').removeClass('sidebar-gone sidebar-show');
                }
            }
            
            // Initial check
            handleSidebar();
            
            // Check on window resize
            $(window).on('resize', function() {
                handleSidebar();
            });
            
            // Toggle sidebar only on mobile - Enhanced with better event handling
            $(document).on('click', '[data-toggle="sidebar"]', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Only allow toggle on mobile
                if ($(window).width() <= 1024) {
                    if ($('body').hasClass('sidebar-gone') || !$('body').hasClass('sidebar-show')) {
                        $('body').removeClass('sidebar-gone');
                        $('body').addClass('sidebar-show');
                        // Prevent body scroll when sidebar is open
                        $('body').css('overflow', 'hidden');
                    } else {
                        $('body').removeClass('sidebar-show');
                        $('body').addClass('sidebar-gone');
                        // Allow body scroll when sidebar is closed
                        $('body').css('overflow', 'auto');
                    }
                }
            });
            
            // Close sidebar when clicking on backdrop (mobile only)
            $(document).on('click', function(e) {
                if ($(window).width() <= 1024) {
                    if ($('body').hasClass('sidebar-show')) {
                        // Check if click is outside sidebar and not on toggle button
                        if (!$(e.target).closest('.main-sidebar').length && 
                            !$(e.target).closest('[data-toggle="sidebar"]').length &&
                            !$(e.target).is('[data-toggle="sidebar"]')) {
                            $('body').removeClass('sidebar-show');
                            $('body').addClass('sidebar-gone');
                            $('body').css('overflow', 'auto');
                        }
                    }
                }
            });
            
            // Prevent sidebar click from closing sidebar
            $('.main-sidebar').on('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    
    <script>
        // Initialize Bootstrap dropdowns for notifications
        $(document).ready(function() {
            const notificationButton = document.getElementById('admin-notification-toggle');
            const notificationDropdown = document.getElementById('admin-notification-dropdown');
            const notificationWrapper = document.querySelector('.admin-alert-wrapper');
            
            if (notificationButton && notificationDropdown) {
                // Initialize Bootstrap dropdown if available
                if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                    try {
                        const dropdownInstance = new bootstrap.Dropdown(notificationButton);
                    } catch (e) {
                        console.log('Bootstrap dropdown initialization failed, using manual toggle');
                    }
                }
                
                // Manual toggle fallback
                notificationButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isShown = notificationWrapper && notificationWrapper.classList.contains('show');
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown.show').forEach(function(dropdown) {
                        if (dropdown !== notificationWrapper) {
                            dropdown.classList.remove('show');
                            const menu = dropdown.querySelector('.dropdown-menu');
                            if (menu) menu.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown - MUST add 'show' to parent wrapper, not just menu
                    if (isShown) {
                        if (notificationWrapper) notificationWrapper.classList.remove('show');
                        notificationDropdown.classList.remove('show');
                        notificationButton.setAttribute('aria-expanded', 'false');
                    } else {
                        if (notificationWrapper) notificationWrapper.classList.add('show');
                        notificationDropdown.classList.add('show');
                        notificationButton.setAttribute('aria-expanded', 'true');
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (notificationWrapper && !notificationWrapper.contains(e.target)) {
                        notificationWrapper.classList.remove('show');
                        notificationDropdown.classList.remove('show');
                        notificationButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
    
    <script>
        // Notifications functionality
        $(document).ready(function() {
            // Load notifications
            function loadNotifications() {
                $.ajax({
                    url: '{{ route("admin.notifications.fetch") }}',
                    method: 'GET',
                    success: function(response) {
                        if (response && response.unread_count !== undefined) {
                            updateNotificationCount(response.unread_count || 0);
                            renderNotifications(response.notifications || []);
                        } else {
                            $('#notifications-list').html('<div class="admin-alert-no-data">{{ __("No notifications") }}</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Notification fetch error:', error);
                        $('#notifications-list').html('<div class="admin-alert-no-data">{{ __("Failed to load notifications") }}</div>');
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
                    list.html('<div class="admin-alert-no-data">{{ __("No notifications") }}</div>');
                    return;
                }

                let html = '';
                notifications.forEach(function(notification) {
                    try {
                        const isRead = notification.read_at !== null && notification.read_at !== '';
                        const readClass = isRead ? 'admin-alert-read' : 'admin-alert-new';
                        const notificationData = notification.data || {};
                        const icon = getNotificationIcon(notificationData.type || '');
                        html += `
                            <a href="${notificationData.url || '#'}" class="admin-alert-entry ${readClass}" data-id="${notification.id || ''}">
                                <div class="admin-alert-entry-box">
                                    <div class="admin-alert-entry-icon-box">
                                        <i class="${icon}"></i>
                                    </div>
                                    <div class="admin-alert-entry-text-box">
                                        <div class="admin-alert-entry-heading">${notificationData.title || '{{ __("Notification") }}'}</div>
                                        <div class="admin-alert-entry-text">${notificationData.message || ''}</div>
                                        <div class="admin-alert-entry-date">${formatTime(notification.created_at)}</div>
                                    </div>
                                </div>
                            </a>
                        `;
                    } catch (e) {
                        console.error('Error rendering notification:', e, notification);
                    }
                });
                list.html(html);

                // Mark as read on click
                $('.admin-alert-entry').on('click', function(e) {
                    const notificationId = $(this).data('id');
                    if ($(this).hasClass('admin-alert-read')) return; // Already read
                    
                    $.ajax({
                        url: '{{ route("admin.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
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
                    'new_contact_message': 'fas fa-comment text-warning',
                    'new_appointment_request': 'fas fa-calendar-check text-success',
                    'new_partnership_request': 'fas fa-handshake text-primary',
                    'new_legal_aid_check': 'fas fa-shield-alt text-info'
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
                    url: '{{ route("admin.notifications.mark-all-read") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        loadNotifications();
                    }
                });
            });

            // Ensure notification dropdown is closed on page load (only if not clicked)
            $(document).ready(function() {
                // Close dropdown if it's open on page load without user interaction
                setTimeout(function() {
                    var $wrapper = $('.admin-alert-wrapper');
                    if ($wrapper.hasClass('show')) {
                        // Check if user actually clicked (by checking if button was focused/clicked recently)
                        var wasClicked = sessionStorage.getItem('notificationClicked') === 'true';
                        if (!wasClicked) {
                            $wrapper.removeClass('show');
                            $('.admin-alert-panel').removeClass('show');
                        }
                        sessionStorage.removeItem('notificationClicked');
                    }
                }, 50);
            });
            
            // Track when notification button is clicked
            $('.admin-alert-button').on('click', function() {
                sessionStorage.setItem('notificationClicked', 'true');
            });
            
            // Load notifications on page load
            loadNotifications();

            // Refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);
        });

        // Unread Messages Count functionality
        $(document).ready(function() {
            function loadUnreadMessagesCount() {
                $.ajax({
                    url: '{{ route("admin.notifications.unread-messages-count") }}',
                    method: 'GET',
                    success: function(response) {
                        updateSidebarMessagesCount(response.unread_count);
                    },
                    error: function() {
                        // Silently fail
                    }
                });
            }

            function updateSidebarMessagesCount(count) {
                const badge = $('#sidebar-messages-count');
                if (count > 0) {
                    badge.text(count > 99 ? '99+' : count).show();
                } else {
                    badge.hide();
                }
            }

            // Load unread messages count on page load
            loadUnreadMessagesCount();

            // Refresh unread messages count every 30 seconds
            setInterval(loadUnreadMessagesCount, 30000);
        });

        // Mobile search functionality
        $(document).ready(function() {
            // Copy search functionality to mobile
            $('#search_menu_mobile').on('input', function() {
                var searchValue = $(this).val().toLowerCase();
                var menuList = $('#admin_menu_list_mobile');
                var menuItems = menuList.find('.search-menu-item, .border-bottom').not('.not-found-message');
                var notFound = menuList.find('.not-found-message');
                
                if (searchValue.length > 0) {
                    menuList.removeClass('d-none');
                    var found = false;
                    
                    menuItems.each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(searchValue)) {
                            $(this).show();
                            found = true;
                        } else {
                            $(this).hide();
                        }
                    });
                    
                    if (found) {
                        notFound.addClass('d-none');
                    } else {
                        notFound.removeClass('d-none');
                        menuItems.hide();
                    }
                } else {
                    menuList.addClass('d-none');
                }
            });
            
        });
        
        // Fix dropdown menus position on mobile
        $(document).ready(function() {
            function fixDropdownPosition() {
                if ($(window).width() <= 991.98) {
                    $('.navbar .dropdown-menu.show').each(function() {
                        const $dropdown = $(this);
                        const $dropdownParent = $dropdown.closest('.dropdown');
                        const $toggle = $dropdownParent.find('a[data-bs-toggle="dropdown"]').first();
                        
                        if ($toggle.length) {
                            const toggleOffset = $toggle.offset();
                            const toggleHeight = $toggle.outerHeight();
                            const toggleWidth = $toggle.outerWidth();
                            const windowHeight = $(window).height();
                            const windowWidth = $(window).width();
                            
                            // Calculate position - position below toggle button
                            let top = toggleOffset.top + toggleHeight + 5;
                            let left = toggleOffset.left;
                            
                            // Get dropdown width (or use min-width)
                            const dropdownWidth = Math.max($dropdown.outerWidth(), 200);
                            
                            // Adjust if dropdown goes off right edge
                            if (left + dropdownWidth > windowWidth - 10) {
                                left = windowWidth - dropdownWidth - 10;
                            }
                            
                            // Adjust if dropdown goes off left edge
                            if (left < 10) {
                                left = 10;
                            }
                            
                            // Adjust if dropdown goes off bottom
                            const dropdownHeight = Math.min($dropdown.outerHeight(), windowHeight - top - 20);
                            if (top + dropdownHeight > windowHeight - 10) {
                                top = Math.max(10, windowHeight - dropdownHeight - 10);
                            }
                            
                            // Apply position
                            $dropdown.css({
                                'position': 'fixed',
                                'top': top + 'px',
                                'left': left + 'px',
                                'z-index': '99999',
                                'max-width': (windowWidth - 20) + 'px',
                                'max-height': (windowHeight - top - 20) + 'px',
                                'overflow-y': 'auto',
                                'overflow-x': 'hidden'
                            });
                        }
                    });
                } else {
                    // Reset on desktop
                    $('.navbar .dropdown-menu').css({
                        'position': '',
                        'top': '',
                        'left': '',
                        'z-index': '',
                        'max-width': '',
                        'max-height': ''
                    });
                }
            }
            
            // Fix on dropdown show
            $(document).on('shown.bs.dropdown', '.navbar .dropdown', function() {
                setTimeout(fixDropdownPosition, 10);
            });
            
            // Fix on dropdown hide (reset)
            $(document).on('hidden.bs.dropdown', '.navbar .dropdown', function() {
                const $dropdown = $(this).find('.dropdown-menu');
                if ($(window).width() > 991.98) {
                    $dropdown.css({
                        'position': '',
                        'top': '',
                        'left': '',
                        'z-index': '',
                        'max-width': '',
                        'max-height': ''
                    });
                }
            });
            
            // Fix on window resize
            $(window).on('resize', function() {
                fixDropdownPosition();
            });
            
            // Fix on scroll (for fixed navbar)
            $(window).on('scroll', function() {
                if ($(window).width() <= 991.98) {
                    fixDropdownPosition();
                }
            });
        });
    </script>

</body>


</html>
