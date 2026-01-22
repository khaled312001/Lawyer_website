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
                    <div class="dropdown-menu dropdown-menu-start lawyer-user-menu">
                        <a href="{{ route('lawyer.edit-profile', ['code' => getSessionLanguage()]) }}" class="dropdown-item {{ isroute('lawyer.edit-profile', 'text-primary') }}">
                            <i class="far fa-user me-2"></i>{{ __('Profile') }}
                        </a>
                        <a href="{{ route('lawyer.change-password') }}" class="dropdown-item {{ isroute('lawyer.change-password', 'text-primary') }}">
                            <i class="fas fa-key me-2"></i>{{ __('Change Password') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item" onclick="event.preventDefault(); $('#lawyer-logout-form').trigger('submit');">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                        </a>
                    </div>
                </li>

                {{-- Notifications Dropdown --}}
                <li class="lawyer-nav-item lawyer-notification-dropdown">
                    <a href="javascript:;" class="lawyer-nav-link lawyer-notification-btn position-relative" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="lawyer-notification-badge" id="lawyer-header-notification-count" style="display: none;">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-start lawyer-notification-menu" style="width: 350px; max-height: 400px; overflow-y: auto;">
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
                    <a href="javascript:;" class="lawyer-nav-link lawyer-notification-btn position-relative" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="lawyer-notification-badge" id="lawyer-header-notification-count" style="display: none;">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end lawyer-notification-menu" style="width: 350px; max-height: 400px; overflow-y: auto;">
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
                            <i class="far fa-user me-2"></i>{{ __('Profile') }}
                        </a>
                        <a href="{{ route('lawyer.change-password') }}" class="dropdown-item {{ isroute('lawyer.change-password', 'text-primary') }}">
                            <i class="fas fa-key me-2"></i>{{ __('Change Password') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item" onclick="event.preventDefault(); $('#lawyer-logout-form').trigger('submit');">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    @endif
</nav>

<style>
/* Lawyer Header Styles */
.lawyer-topbar-bg {
    height: 70px;
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.lawyer-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 70px;
    background: transparent;
    padding: 0 20px;
    z-index: 1001;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.lawyer-topbar-left,
.lawyer-topbar-right {
    display: flex;
    align-items: center;
}

.lawyer-topbar-nav {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 10px;
}

.lawyer-nav-item {
    position: relative;
}

.lawyer-menu-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
}

.lawyer-menu-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: scale(1.05);
}

.lawyer-nav-link {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
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
}

.lawyer-user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.lawyer-user-name {
    color: #fff;
    font-weight: 500;
}

.lawyer-user-menu {
    margin-top: 10px;
    min-width: 200px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.lawyer-user-menu .dropdown-item {
    padding: 10px 15px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.lawyer-user-menu .dropdown-item:hover {
    background: #f8f9fa;
    padding-left: 20px;
}

.lawyer-notification-menu {
    margin-top: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border: none;
    border-radius: 8px;
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
    }
    
    .lawyer-topbar-nav {
        gap: 5px !important;
    }
    
    .lawyer-nav-link {
        padding: 8px 10px !important;
        font-size: 14px !important;
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
    }
    
    .lawyer-menu-toggle {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        min-height: 40px !important;
    }
    
    .lawyer-notification-menu {
        width: calc(100vw - 40px) !important;
        max-width: 350px !important;
        max-height: calc(100vh - 100px) !important;
    }
    
    .lawyer-user-menu {
        width: calc(100vw - 40px) !important;
        max-width: 250px !important;
    }
}

@media (max-width: 480px) {
    .lawyer-topbar {
        padding: 0 8px !important;
    }
    
    .lawyer-menu-toggle {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
    }
    
    .lawyer-menu-toggle i {
        font-size: 16px !important;
    }
    
    .lawyer-user-avatar {
        width: 30px !important;
        height: 30px !important;
    }
    
    .lawyer-nav-link {
        padding: 6px 8px !important;
    }
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
