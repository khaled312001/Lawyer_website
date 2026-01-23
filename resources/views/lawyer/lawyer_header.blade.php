@php
    $header_lawyer = Auth::guard('lawyer')->user();
@endphp

@php
    $textDirection = session()->get('text_direction', 'ltr');
    $currentLang = session()->get('lang', config('app.locale', 'ar'));
    $rtlLanguages = ['ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi'];
    $isRTL = $textDirection === 'rtl' || in_array($currentLang, $rtlLanguages);
@endphp

<div class="lawyer-topbar-bg"></div>
<nav class="lawyer-topbar navbar navbar-expand-lg">
    @if($isRTL)
        {{-- RTL Layout: Menu button on right --}}
        <div class="lawyer-topbar-right">
            <ul class="lawyer-topbar-nav">
                <li>
                    <a href="#" class="lawyer-menu-toggle" id="lawyer-menu-toggle-btn">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                {{-- language select --}}
                @include('backend_layouts.partials.language_select')
                {{-- currency select --}}
                @include('backend_layouts.partials.currency_select')
            </ul>
        </div>
        
        <div class="lawyer-topbar-left">
            <ul class="lawyer-topbar-nav">
                {{-- User Profile Dropdown --}}
                <li class="lawyer-nav-item lawyer-user-dropdown">
                    <a href="javascript:;" class="lawyer-nav-link lawyer-user-link" data-bs-toggle="dropdown">
                        @if ($header_lawyer->image)
                            <img alt="image" src="{{ asset($header_lawyer->image) }}" class="lawyer-user-avatar">
                        @else
                            <img alt="image" src="{{ asset($setting->default_avatar) }}" class="lawyer-user-avatar">
                        @endif
                        <span class="lawyer-user-name d-none d-lg-inline-block">{{ $header_lawyer->name }}</span>
                        <i class="fas fa-chevron-down d-none d-lg-inline-block ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end lawyer-user-menu">
                        <a href="{{ route('lawyer.edit-profile', ['code' => getSessionLanguage()]) }}" class="dropdown-item {{ isroute('lawyer.edit-profile', 'text-primary') }}">
                            <i class="fas fa-user-edit me-2"></i>{{ __('My Profile') }}
                        </a>
                        <a href="{{ route('lawyer.change-password') }}" class="dropdown-item {{ isroute('lawyer.change-password', 'text-primary') }}">
                            <i class="fas fa-lock me-2"></i>{{ __('Security Settings') }}
                        </a>
                        <a href="{{ route('lawyer.notifications.index') }}" class="dropdown-item">
                            <i class="fas fa-bell me-2"></i>{{ __('Notifications') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a target="_blank" href="{{ route('home') }}" class="dropdown-item">
                            <i class="fas fa-globe me-2"></i>{{ __('View Website') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item text-danger" onclick="event.preventDefault(); $('#lawyer-logout-form').trigger('submit');">
                            <i class="fas fa-power-off me-2"></i>{{ __('Sign Out') }}
                        </a>
                    </div>
                </li>

                {{-- Notifications Dropdown --}}
                <li class="lawyer-nav-item lawyer-notification-dropdown">
                    <a href="javascript:;" class="lawyer-nav-link lawyer-notification-btn position-relative" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="lawyer-notification-badge" id="lawyer-header-notification-count" style="display: none;">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end lawyer-notification-menu" style="width: 350px; max-height: 400px; overflow-y: auto;" id="lawyer-notification-menu-rtl">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ __('Notifications') }}</h6>
                            <a href="javascript:;" class="text-primary small lawyer-mark-all-read" style="text-decoration: none;">{{ __('Mark all as read') }}</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div id="lawyer-header-notifications-list">
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

                <li class="lawyer-nav-item">
                    <a target="_blank" href="{{ route('home') }}" class="lawyer-nav-link">
                        <i class="fas fa-home"></i>
                        <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    @else
        {{-- LTR Layout: Menu button on left --}}
        <div class="lawyer-topbar-left">
            <ul class="lawyer-topbar-nav">
                <li>
                    <a href="#" class="lawyer-menu-toggle" id="lawyer-menu-toggle-btn">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                {{-- language select --}}
                @include('backend_layouts.partials.language_select')
                {{-- currency select --}}
                @include('backend_layouts.partials.currency_select')
            </ul>
        </div>
        
        <div class="lawyer-topbar-right">
            <ul class="lawyer-topbar-nav">
                <li class="lawyer-nav-item">
                    <a target="_blank" href="{{ route('home') }}" class="lawyer-nav-link">
                        <i class="fas fa-home"></i>
                        <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
                    </a>
                </li>

                {{-- Notifications Dropdown --}}
                <li class="lawyer-nav-item lawyer-notification-dropdown">
                    <a href="javascript:;" class="lawyer-nav-link lawyer-notification-btn position-relative" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="lawyer-notification-badge" id="lawyer-header-notification-count" style="display: none;">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end lawyer-notification-menu" style="width: 350px; max-height: 400px; overflow-y: auto;" id="lawyer-notification-menu-ltr">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ __('Notifications') }}</h6>
                            <a href="javascript:;" class="text-primary small lawyer-mark-all-read" style="text-decoration: none;">{{ __('Mark all as read') }}</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div id="lawyer-header-notifications-list">
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

                {{-- User Profile Dropdown --}}
                <li class="lawyer-nav-item lawyer-user-dropdown">
                    <a href="javascript:;" class="lawyer-nav-link lawyer-user-link" data-bs-toggle="dropdown">
                        @if ($header_lawyer->image)
                            <img alt="image" src="{{ asset($header_lawyer->image) }}" class="lawyer-user-avatar">
                        @else
                            <img alt="image" src="{{ asset($setting->default_avatar) }}" class="lawyer-user-avatar">
                        @endif
                        <span class="lawyer-user-name d-none d-lg-inline-block">{{ $header_lawyer->name }}</span>
                        <i class="fas fa-chevron-down d-none d-lg-inline-block ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end lawyer-user-menu">
                        <a href="{{ route('lawyer.edit-profile', ['code' => getSessionLanguage()]) }}" class="dropdown-item {{ isroute('lawyer.edit-profile', 'text-primary') }}">
                            <i class="fas fa-user-edit me-2"></i>{{ __('My Profile') }}
                        </a>
                        <a href="{{ route('lawyer.change-password') }}" class="dropdown-item {{ isroute('lawyer.change-password', 'text-primary') }}">
                            <i class="fas fa-lock me-2"></i>{{ __('Security Settings') }}
                        </a>
                        <a href="{{ route('lawyer.notifications.index') }}" class="dropdown-item">
                            <i class="fas fa-bell me-2"></i>{{ __('Notifications') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a target="_blank" href="{{ route('home') }}" class="dropdown-item">
                            <i class="fas fa-globe me-2"></i>{{ __('View Website') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item text-danger" onclick="event.preventDefault(); $('#lawyer-logout-form').trigger('submit');">
                            <i class="fas fa-power-off me-2"></i>{{ __('Sign Out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    @endif
</nav>

<style>
/* Lawyer Header Styles - Ensure all navigation elements are visible */
.lawyer-topbar {
    overflow: visible !important;
}

.lawyer-topbar-left,
.lawyer-topbar-right {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    overflow: visible !important;
}

.lawyer-topbar-nav {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    overflow: visible !important;
}

.lawyer-topbar-nav li {
    display: list-item !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-nav-item {
    display: list-item !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-menu-toggle {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-menu-toggle i {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-nav-link {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-nav-link i {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-user-link {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-user-avatar {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-topbar-bg {
    height: 70px;
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 9998 !important;
    will-change: transform;
}

.lawyer-topbar {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 70px;
    background: transparent;
    padding: 0 20px;
    z-index: 9999 !important;
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: visible !important;
    will-change: transform;
}

.lawyer-topbar-left,
.lawyer-topbar-right {
    display: flex !important;
    align-items: center;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-topbar-nav {
    display: flex !important;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 10px;
    visibility: visible !important;
    opacity: 1 !important;
}

.lawyer-nav-item {
    position: relative;
    display: list-item !important;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 10000 !important;
}

.lawyer-menu-toggle {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: #fff !important;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 10000 !important;
    position: relative;
}

.lawyer-menu-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: scale(1.05);
}

.lawyer-nav-link {
    display: flex !important;
    align-items: center;
    padding: 8px 15px;
    color: #fff !important;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 10000 !important;
    position: relative;
}

.lawyer-nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

.lawyer-notification-btn {
    position: relative;
    padding: 8px 12px;
    cursor: pointer;
}

.lawyer-notification-btn:hover {
    background: rgba(255, 255, 255, 0.15);
}

.lawyer-notification-btn i {
    font-size: 18px;
}

.lawyer-notification-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background: #ff4757;
    color: #fff;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: bold;
    z-index: 1;
}

.lawyer-user-link {
    display: flex;
    align-items: center;
    padding: 5px 12px;
    gap: 10px;
    cursor: pointer;
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.1);
    position: relative;
    user-select: none;
    -webkit-user-select: none;
}

.lawyer-user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.lawyer-user-name {
    color: #fff;
    font-weight: 500;
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.lawyer-user-link i {
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.lawyer-user-menu {
    margin-top: 5px;
    min-width: 220px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    z-index: 10050 !important;
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    padding: 6px 0;
    background: #fff !important;
    overflow: hidden;
    position: relative;
}

/* Bootstrap dropdown compatibility */
.lawyer-user-dropdown .dropdown-menu {
    display: none;
}

.lawyer-user-menu.show,
.lawyer-user-dropdown .dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Ensure dropdown is hidden by default */
.lawyer-user-dropdown .dropdown-menu:not(.show) {
    display: none !important;
}

.lawyer-user-menu .dropdown-item {
    padding: 12px 18px;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
    cursor: pointer;
    color: #333;
    font-size: 14px;
    font-weight: 500;
    border: none;
    text-decoration: none;
}

.lawyer-user-menu .dropdown-item i {
    width: 20px;
    text-align: center;
    font-size: 16px;
    color: #667eea;
}

.lawyer-user-menu .dropdown-item:hover {
    background: linear-gradient(90deg, #f8f9ff 0%, #f0f4ff 100%);
    padding-left: 22px;
    color: #667eea;
    transform: translateX(2px);
}

.lawyer-user-menu .dropdown-item.text-danger {
    color: #dc3545 !important;
}

.lawyer-user-menu .dropdown-item.text-danger i {
    color: #dc3545 !important;
}

.lawyer-user-menu .dropdown-item.text-danger:hover {
    background: linear-gradient(90deg, #fff5f5 0%, #ffe8e8 100%);
    color: #dc3545 !important;
}

.lawyer-user-menu .dropdown-divider {
    margin: 6px 0;
    border-top: 1px solid #e9ecef;
    opacity: 0.6;
}

.lawyer-user-dropdown {
    position: relative !important;
    z-index: 10000 !important;
}

.lawyer-user-dropdown .dropdown-menu {
    position: absolute !important;
    top: calc(100% + 5px) !important;
    left: auto !important;
    right: 0 !important;
    margin-top: 0 !important;
    z-index: 10050 !important;
    transform: translateY(0) !important;
    min-width: 220px;
    max-width: 280px;
    display: none;
    margin-right: 0 !important;
}

/* Ensure dropdown is always visible on mobile */
@media (max-width: 768px) {
    .lawyer-user-dropdown {
        position: relative !important;
    }
    
    .lawyer-user-dropdown .dropdown-menu,
    .lawyer-user-menu {
        position: fixed !important;
        top: 75px !important;
        right: 10px !important;
        left: auto !important;
        width: calc(100vw - 20px) !important;
        max-width: 280px !important;
        min-width: 240px !important;
        z-index: 10050 !important;
        margin: 0 !important;
        transform: translateX(0) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
    }
}

.lawyer-user-dropdown .dropdown-menu:not(.show) {
    display: none !important;
}

.lawyer-user-dropdown .dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* RTL Support - Align to right edge of button (same as LTR) */
[dir="rtl"] .lawyer-user-dropdown .dropdown-menu,
[dir="rtl"] .lawyer-user-dropdown .dropdown-menu-end,
[dir="rtl"] .lawyer-user-dropdown .dropdown-menu-start {
    right: 0 !important;
    left: auto !important;
    transform: translateX(0) !important;
    margin-right: 0 !important;
}

[dir="rtl"] .lawyer-user-menu .dropdown-item:hover {
    padding-right: 22px;
    padding-left: 18px;
    transform: translateX(-2px);
}

/* Ensure dropdown doesn't go off screen in RTL */
@media (max-width: 768px) {
    [dir="rtl"] .lawyer-user-dropdown .dropdown-menu {
        right: 0 !important;
        left: auto !important;
        max-width: calc(100vw - 20px) !important;
    }
}

.lawyer-notification-dropdown {
    position: relative !important;
    z-index: 10000 !important;
}

.lawyer-notification-menu {
    margin-top: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border: none;
    border-radius: 8px;
    display: none !important;
    position: absolute !important;
    top: calc(100% + 8px) !important;
    right: 0 !important;
    left: auto !important;
    z-index: 10050 !important;
    background: #fff !important;
    min-width: 350px;
    max-width: 350px;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.2s ease, visibility 0.2s ease;
    transform: translateY(0);
}

.lawyer-notification-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* RTL and LTR positioning - both open to the right */
[dir="rtl"] .lawyer-notification-menu.dropdown-menu-start,
[dir="rtl"] .lawyer-notification-menu.dropdown-menu-end,
.lawyer-notification-menu.dropdown-menu-end,
.lawyer-notification-menu.dropdown-menu-start {
    right: 0 !important;
    left: auto !important;
}

.lawyer-notification-menu .dropdown-item {
    padding: 12px 15px;
    transition: all 0.2s ease;
}

.lawyer-notification-menu .dropdown-item:hover {
    background-color: #f8f9fa;
}

.lawyer-notification-menu .notification-item.bg-light {
    background-color: #f8f9fa !important;
}

.notification-icon-wrapper {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.05);
}

.notification-icon-wrapper i {
    font-size: 16px;
}

/* Responsive */
@media (max-width: 768px) {
    .lawyer-topbar {
        padding: 0 10px !important;
        height: 70px !important;
        display: flex !important;
        overflow: visible !important;
    }
    
    .lawyer-topbar-left,
    .lawyer-topbar-right {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-topbar-nav {
        gap: 5px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-nav-item {
        display: list-item !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* Hide language and currency selectors on mobile */
    .lawyer-topbar-nav .setLanguageHeader,
    .lawyer-topbar-nav .set-currency-header,
    .setLanguageHeader,
    .set-currency-header,
    li.setLanguageHeader,
    li.set-currency-header {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        pointer-events: none !important;
    }
    
    .lawyer-nav-link {
        padding: 8px 10px !important;
        font-size: 14px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-nav-link span {
        display: none !important;
    }
    
    .lawyer-user-name {
        display: none !important;
    }
    
    .lawyer-user-avatar {
        width: 32px !important;
        height: 32px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-menu-toggle {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        min-height: 40px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-menu-toggle i {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-notification-menu {
        width: calc(100vw - 40px) !important;
        max-width: 350px !important;
        max-height: calc(100vh - 100px) !important;
        position: fixed !important;
        top: 80px !important;
        right: 20px !important;
        left: auto !important;
        z-index: 10050 !important;
    }
    
    [dir="rtl"] .lawyer-notification-menu {
        right: 20px !important;
        left: auto !important;
    }
    
    .lawyer-notification-menu.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-user-menu {
        width: calc(100vw - 20px) !important;
        max-width: 280px !important;
        min-width: 240px !important;
        z-index: 10050 !important;
        position: fixed !important;
        top: 75px !important;
        right: 10px !important;
        left: auto !important;
        margin: 0 !important;
        transform: translateX(0) !important;
    }
    
    .lawyer-user-dropdown {
        position: relative !important;
    }
    
    /* On mobile, use fixed positioning to ensure visibility */
    .lawyer-user-dropdown .dropdown-menu {
        position: fixed !important;
        top: 75px !important;
        right: 10px !important;
        left: auto !important;
        margin-top: 0 !important;
        margin-right: 0 !important;
        transform: translateX(0) !important;
        width: calc(100vw - 20px) !important;
        max-width: 280px !important;
        min-width: 240px !important;
        z-index: 10050 !important;
    }
    
    /* Ensure dropdown is visible on mobile when show class is present */
    .lawyer-user-dropdown .dropdown-menu.show,
    .lawyer-user-menu.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
    }
    
    /* Hide dropdown by default on mobile */
    .lawyer-user-dropdown .dropdown-menu:not(.show),
    .lawyer-user-menu:not(.show) {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
    
    /* RTL Support for dropdown - shift from left to right */
    [dir="rtl"] .lawyer-user-dropdown .dropdown-menu,
    [dir="rtl"] .lawyer-user-dropdown .dropdown-menu-end,
    [dir="rtl"] .lawyer-user-dropdown .dropdown-menu-start,
    [dir="rtl"] .lawyer-user-menu {
        right: 10px !important;
        left: auto !important;
        max-width: calc(100vw - 20px) !important;
        min-width: 240px !important;
        transform: translateX(0) !important;
    }
}

@media (max-width: 480px) {
    .lawyer-topbar {
        padding: 0 8px !important;
        display: flex !important;
        overflow: visible !important;
    }
    
    .lawyer-topbar-left,
    .lawyer-topbar-right {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-topbar-nav {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-nav-item {
        display: list-item !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* Hide language and currency selectors on mobile */
    .lawyer-topbar-nav .setLanguageHeader,
    .lawyer-topbar-nav .set-currency-header,
    .setLanguageHeader,
    .set-currency-header,
    li.setLanguageHeader,
    li.set-currency-header {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        pointer-events: none !important;
    }
    
    .lawyer-menu-toggle {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-menu-toggle i {
        font-size: 16px !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-user-avatar {
        width: 30px !important;
        height: 30px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-nav-link {
        padding: 6px 8px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-nav-link i {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .lawyer-user-menu {
        position: fixed !important;
        top: 75px !important;
        right: 10px !important;
        left: auto !important;
        width: calc(100vw - 20px) !important;
        max-width: 260px !important;
        min-width: 220px !important;
        z-index: 10050 !important;
        margin: 0 !important;
        transform: translateX(0) !important;
    }
    
    .lawyer-user-dropdown .dropdown-menu {
        position: fixed !important;
        top: 75px !important;
        right: 10px !important;
        left: auto !important;
        width: calc(100vw - 20px) !important;
        max-width: 260px !important;
        min-width: 220px !important;
        z-index: 10050 !important;
        margin: 0 !important;
        transform: translateX(0) !important;
    }
    
    [dir="rtl"] .lawyer-user-menu,
    [dir="rtl"] .lawyer-user-dropdown .dropdown-menu {
        right: 10px !important;
        left: auto !important;
        transform: translateX(0) !important;
    }
}

/* Hide language and currency selectors on all screen sizes (PC and Mobile) */
.lawyer-topbar-nav .setLanguageHeader,
.lawyer-topbar-nav .set-currency-header,
.setLanguageHeader,
.set-currency-header,
li.setLanguageHeader,
li.set-currency-header {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    width: 0 !important;
    height: 0 !important;
    overflow: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
    position: absolute !important;
    left: -9999px !important;
    pointer-events: none !important;
}

.lawyer-topbar-nav .setLanguageHeader .nav-link {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-width: 80px;
}

.lawyer-topbar-nav .setLanguageHeader .nav-link:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
}

.lawyer-topbar-nav .setLanguageHeader .dropdown-menu {
    margin-top: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border: none;
    border-radius: 8px;
    min-width: 150px;
}

.lawyer-topbar-nav .setLanguageHeader .dropdown-menu .dropdown-item {
    padding: 10px 15px;
    transition: all 0.2s ease;
}

.lawyer-topbar-nav .setLanguageHeader .dropdown-menu .dropdown-item:hover {
    background: #f8f9fa;
}

/* RTL Support - Arabic */
@if($isRTL)
.lawyer-topbar-nav {
    flex-direction: row-reverse;
}

.lawyer-user-link {
    flex-direction: row-reverse;
}

.lawyer-user-name {
    margin-left: 0;
    margin-right: 10px;
}
@endif
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide language and currency selectors on all screen sizes (PC and Mobile)
    function hideLanguageCurrency() {
        document.querySelectorAll('.setLanguageHeader, .set-currency-header').forEach(el => {
            el.style.display = 'none';
            el.style.visibility = 'hidden';
            el.style.opacity = '0';
            el.style.width = '0';
            el.style.height = '0';
            el.style.margin = '0';
            el.style.padding = '0';
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            el.style.pointerEvents = 'none';
        });
    }
    
    // Run on load
    hideLanguageCurrency();
    
    // Run on resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(hideLanguageCurrency, 100);
    });
    
    // Ensure all dropdowns are closed on page load
    document.querySelectorAll('.lawyer-user-menu').forEach(menu => {
        menu.classList.remove('show');
    });
    
    // Initialize Bootstrap dropdown for user menu
    const userDropdownToggles = document.querySelectorAll('.lawyer-user-link[data-bs-toggle="dropdown"]');
    
    userDropdownToggles.forEach(toggle => {
        const dropdownElement = toggle.closest('.lawyer-user-dropdown');
        const dropdownMenu = dropdownElement ? dropdownElement.querySelector('.lawyer-user-menu') : null;
        
        // Make sure the entire link area is clickable
        toggle.style.cursor = 'pointer';
        toggle.style.userSelect = 'none';
        toggle.style.webkitUserSelect = 'none';
        
        // Add click event to the entire link including children
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isOpen = dropdownMenu && dropdownMenu.classList.contains('show');
            
            // Close all other dropdowns
            document.querySelectorAll('.lawyer-user-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                    menu.style.display = 'none';
                    menu.style.visibility = 'hidden';
                    menu.style.opacity = '0';
                }
            });
            
            if (dropdownMenu) {
                if (isOpen) {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.display = 'none';
                    dropdownMenu.style.visibility = 'hidden';
                    dropdownMenu.style.opacity = '0';
                } else {
                    dropdownMenu.classList.add('show');
                    dropdownMenu.style.display = 'block';
                    dropdownMenu.style.visibility = 'visible';
                    dropdownMenu.style.opacity = '1';
                    
                    // For mobile, ensure proper positioning
                    if (window.innerWidth <= 768) {
                        dropdownMenu.style.position = 'fixed';
                        dropdownMenu.style.top = '75px';
                        dropdownMenu.style.right = '10px';
                        dropdownMenu.style.left = 'auto';
                        dropdownMenu.style.transform = 'translateX(0)';
                        dropdownMenu.style.zIndex = '10050';
                        dropdownMenu.style.width = 'calc(100vw - 20px)';
                        dropdownMenu.style.maxWidth = '280px';
                        dropdownMenu.style.minWidth = '240px';
                    }
                }
            }
        });
        
        if (dropdownMenu && typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
            try {
                // Initialize Bootstrap dropdown
                const dropdownInstance = new bootstrap.Dropdown(toggle, {
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
                
                // Listen for Bootstrap dropdown events
                toggle.addEventListener('show.bs.dropdown', function() {
                    dropdownMenu.classList.add('show');
                    dropdownMenu.style.display = 'block';
                    dropdownMenu.style.visibility = 'visible';
                    dropdownMenu.style.opacity = '1';
                    // For mobile, ensure proper positioning
                    if (window.innerWidth <= 768) {
                        dropdownMenu.style.position = 'fixed';
                        dropdownMenu.style.top = '75px';
                        dropdownMenu.style.right = '10px';
                        dropdownMenu.style.left = 'auto';
                        dropdownMenu.style.transform = 'translateX(0)';
                        dropdownMenu.style.zIndex = '10050';
                        dropdownMenu.style.width = 'calc(100vw - 20px)';
                        dropdownMenu.style.maxWidth = '280px';
                        dropdownMenu.style.minWidth = '240px';
                    }
                });
                
                toggle.addEventListener('hide.bs.dropdown', function() {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.visibility = 'hidden';
                    dropdownMenu.style.opacity = '0';
                    setTimeout(function() {
                        if (!dropdownMenu.classList.contains('show')) {
                            dropdownMenu.style.display = 'none';
                        }
                    }, 150);
                });
                
                toggle.addEventListener('shown.bs.dropdown', function() {
                    dropdownMenu.style.display = 'block';
                    dropdownMenu.style.visibility = 'visible';
                    dropdownMenu.style.opacity = '1';
                    // Force reflow for mobile
                    dropdownMenu.offsetHeight;
                });
                
                toggle.addEventListener('hidden.bs.dropdown', function() {
                    dropdownMenu.style.display = 'none';
                    dropdownMenu.style.visibility = 'hidden';
                    dropdownMenu.style.opacity = '0';
                });
                
            } catch (e) {
                console.warn('Bootstrap dropdown initialization failed, using manual toggle:', e);
                // Fallback to manual toggle
                setupManualUserDropdown(toggle);
            }
        } else {
            // Fallback to manual toggle if Bootstrap is not available
            setupManualUserDropdown(toggle);
        }
    });
    
    // Manual dropdown fallback function
    function setupManualUserDropdown(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdownElement = this.closest('.lawyer-user-dropdown');
            const dropdown = dropdownElement ? dropdownElement.querySelector('.lawyer-user-menu') : null;
            
            if (!dropdown) {
                return;
            }
            
            const isOpen = dropdown.classList.contains('show');
            
            // Close all other dropdowns first
            document.querySelectorAll('.lawyer-user-menu.show').forEach(menu => {
                menu.classList.remove('show');
                menu.style.display = 'none';
                menu.style.visibility = 'hidden';
                menu.style.opacity = '0';
            });
            
            // Toggle current dropdown
            if (isOpen) {
                dropdown.classList.remove('show');
                dropdown.style.display = 'none';
                dropdown.style.visibility = 'hidden';
                dropdown.style.opacity = '0';
            } else {
                dropdown.classList.add('show');
                dropdown.style.display = 'block';
                dropdown.style.visibility = 'visible';
                dropdown.style.opacity = '1';
                // For mobile, ensure proper positioning
                if (window.innerWidth <= 768) {
                    dropdown.style.position = 'fixed';
                    dropdown.style.top = '75px';
                    dropdown.style.right = '10px';
                    dropdown.style.left = 'auto';
                    dropdown.style.transform = 'translateX(0)';
                    dropdown.style.zIndex = '10050';
                    dropdown.style.width = 'calc(100vw - 20px)';
                    dropdown.style.maxWidth = '280px';
                    dropdown.style.minWidth = '240px';
                }
                // Force reflow for mobile
                dropdown.offsetHeight;
            }
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.lawyer-user-dropdown')) {
            document.querySelectorAll('.lawyer-user-menu.show').forEach(menu => {
                menu.classList.remove('show');
                menu.style.display = 'none';
                menu.style.visibility = 'hidden';
                menu.style.opacity = '0';
            });
        }
    });
    
    // Touch event support for mobile
    document.querySelectorAll('.lawyer-user-link').forEach(link => {
        link.addEventListener('touchstart', function(e) {
            // Allow touch events but prevent double-tap zoom
            const dropdownElement = this.closest('.lawyer-user-dropdown');
            const dropdown = dropdownElement ? dropdownElement.querySelector('.lawyer-user-menu') : null;
            if (dropdown && !dropdown.classList.contains('show')) {
                // Prevent default only if dropdown is closed
                e.preventDefault();
            }
        }, { passive: false });
    });
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Update positioning on resize for mobile
            document.querySelectorAll('.lawyer-user-menu.show').forEach(menu => {
                if (window.innerWidth <= 768) {
                    menu.style.position = 'fixed';
                    menu.style.top = '75px';
                    menu.style.right = '10px';
                    menu.style.left = 'auto';
                    menu.style.transform = 'translateX(0)';
                }
            });
        }, 250);
    });
});
</script>
