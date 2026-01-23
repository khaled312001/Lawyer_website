@php
    $header_user = Auth::user();
@endphp

@php
    $textDirection = session()->get('text_direction', 'ltr');
    $currentLang = session()->get('lang', config('app.locale', 'ar'));
    $rtlLanguages = ['ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi'];
    $isRTL = $textDirection === 'rtl' || in_array($currentLang, $rtlLanguages);
@endphp

<div class="client-topbar-bg"></div>
<nav class="client-topbar navbar navbar-expand-lg">
    @if($isRTL)
        {{-- RTL Layout: Menu button on right --}}
        <div class="client-topbar-right">
            <ul class="client-topbar-nav">
                <li>
                    <a href="javascript:void(0);" class="client-menu-toggle" id="client-menu-toggle-btn" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof toggleClientSidebar !== 'undefined'){toggleClientSidebar(e);}else if(typeof window.toggleClientSidebar !== 'undefined'){window.toggleClientSidebar(e);}else{console.error('toggleClientSidebar not found');}return false;})(event)">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="client-topbar-left">
            <ul class="client-topbar-nav">
                {{-- User Profile Dropdown --}}
                <li class="client-nav-item client-user-dropdown">
                    <a href="javascript:;" class="client-nav-link client-user-link" data-bs-toggle="dropdown">
                        @if ($header_user->image)
                            <img alt="image" src="{{ asset($header_user->image) }}" class="client-user-avatar">
                        @else
                            <img alt="image" src="{{ asset($setting->default_avatar) }}" class="client-user-avatar">
                        @endif
                        <span class="client-user-name d-none d-lg-inline-block">{{ $header_user->name }}</span>
                        <i class="fas fa-chevron-down d-none d-lg-inline-block ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end client-user-menu">
                        <a href="{{ route('dashboard') }}" class="dropdown-item {{ isroute('dashboard', 'text-primary') }}">
                            <i class="fas fa-home me-2"></i>{{ __('Dashboard') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a target="_blank" href="{{ route('home') }}" class="dropdown-item">
                            <i class="fas fa-globe me-2"></i>{{ __('View Website') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item text-danger" onclick="event.preventDefault(); $('#logout-form').trigger('submit');">
                            <i class="fas fa-power-off me-2"></i>{{ __('Sign Out') }}
                        </a>
                    </div>
                </li>

                <li class="client-nav-item">
                    <a target="_blank" href="{{ route('home') }}" class="client-nav-link">
                        <i class="fas fa-home"></i>
                        <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    @else
        {{-- LTR Layout: Menu button on left --}}
        <div class="client-topbar-left">
            <ul class="client-topbar-nav">
                <li>
                    <a href="javascript:void(0);" class="client-menu-toggle" id="client-menu-toggle-btn" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof toggleClientSidebar !== 'undefined'){toggleClientSidebar(e);}else if(typeof window.toggleClientSidebar !== 'undefined'){window.toggleClientSidebar(e);}else{console.error('toggleClientSidebar not found');}return false;})(event)">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="client-topbar-right">
            <ul class="client-topbar-nav">
                <li class="client-nav-item">
                    <a target="_blank" href="{{ route('home') }}" class="client-nav-link">
                        <i class="fas fa-home"></i>
                        <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
                    </a>
                </li>

                {{-- User Profile Dropdown --}}
                <li class="client-nav-item client-user-dropdown">
                    <a href="javascript:;" class="client-nav-link client-user-link" data-bs-toggle="dropdown">
                        @if ($header_user->image)
                            <img alt="image" src="{{ asset($header_user->image) }}" class="client-user-avatar">
                        @else
                            <img alt="image" src="{{ asset($setting->default_avatar) }}" class="client-user-avatar">
                        @endif
                        <span class="client-user-name d-none d-lg-inline-block">{{ $header_user->name }}</span>
                        <i class="fas fa-chevron-down d-none d-lg-inline-block ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end client-user-menu">
                        <a href="{{ route('dashboard') }}" class="dropdown-item {{ isroute('dashboard', 'text-primary') }}">
                            <i class="fas fa-home me-2"></i>{{ __('Dashboard') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a target="_blank" href="{{ route('home') }}" class="dropdown-item">
                            <i class="fas fa-globe me-2"></i>{{ __('View Website') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item text-danger" onclick="event.preventDefault(); $('#logout-form').trigger('submit');">
                            <i class="fas fa-power-off me-2"></i>{{ __('Sign Out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    @endif
</nav>

<style>
/* Client Header Styles - Similar to Lawyer Header */
.client-topbar-bg {
    height: 70px;
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.client-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 70px;
    background: transparent;
    padding: 0 20px;
    z-index: 1001;
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: visible !important;
}

.client-topbar-left,
.client-topbar-right {
    display: flex !important;
    align-items: center;
    visibility: visible !important;
    opacity: 1 !important;
}

.client-topbar-nav {
    display: flex !important;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 10px;
    visibility: visible !important;
    opacity: 1 !important;
}

.client-nav-item {
    position: relative;
    display: list-item !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.client-menu-toggle {
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
    z-index: 1002 !important;
}

.client-menu-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: scale(1.05);
}

.client-nav-link {
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
}

.client-nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

.client-user-link {
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

.client-user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.client-user-name {
    color: #fff;
    font-weight: 500;
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.client-user-link i {
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.client-user-menu {
    margin-top: 5px;
    min-width: 220px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    z-index: 10000 !important;
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    padding: 6px 0;
    background: #fff !important;
    overflow: hidden;
}

.client-user-dropdown .dropdown-menu {
    display: none;
}

.client-user-menu.show,
.client-user-dropdown .dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.client-user-dropdown .dropdown-menu:not(.show) {
    display: none !important;
}

.client-user-menu .dropdown-item {
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

.client-user-menu .dropdown-item i {
    width: 20px;
    text-align: center;
    font-size: 16px;
    color: #667eea;
}

.client-user-menu .dropdown-item:hover {
    background: linear-gradient(90deg, #f8f9ff 0%, #f0f4ff 100%);
    padding-left: 22px;
    color: #667eea;
    transform: translateX(2px);
}

.client-user-menu .dropdown-item.text-danger {
    color: #dc3545 !important;
}

.client-user-menu .dropdown-item.text-danger i {
    color: #dc3545 !important;
}

.client-user-menu .dropdown-item.text-danger:hover {
    background: linear-gradient(90deg, #fff5f5 0%, #ffe8e8 100%);
    color: #dc3545 !important;
}

.client-user-menu .dropdown-divider {
    margin: 6px 0;
    border-top: 1px solid #e9ecef;
    opacity: 0.6;
}

.client-user-dropdown {
    position: relative !important;
}

.client-user-dropdown .dropdown-menu {
    position: absolute !important;
    top: calc(100% + 5px) !important;
    left: auto !important;
    right: 0 !important;
    margin-top: 0 !important;
    z-index: 10000 !important;
    transform: translateY(0) !important;
    min-width: 220px;
    max-width: 280px;
    display: none;
    margin-right: 0 !important;
}

/* Responsive */
@media (max-width: 768px) {
    .client-topbar {
        padding: 0 10px !important;
        height: 70px !important;
        display: flex !important;
        overflow: visible !important;
    }
    
    .client-topbar-left,
    .client-topbar-right {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .client-topbar-nav {
        gap: 5px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .client-nav-link span {
        display: none !important;
    }
    
    .client-user-name {
        display: none !important;
    }
    
    .client-user-avatar {
        width: 32px !important;
        height: 32px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .client-menu-toggle {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        min-height: 40px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .client-user-menu {
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
    
    .client-user-dropdown .dropdown-menu {
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
    }
}

@media (max-width: 480px) {
    .client-topbar {
        padding: 0 8px !important;
        display: flex !important;
        overflow: visible !important;
    }
    
    .client-menu-toggle {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .client-user-avatar {
        width: 30px !important;
        height: 30px !important;
    }
}
</style>

<script>
// Client Dashboard Sidebar Toggle Function - Must be defined before use
function toggleClientSidebar(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    const body = document.body;
    const sidebar = document.querySelector('.client-dashboard-sidebar');
    const backdrop = document.querySelector('.client-sidebar-backdrop');
    
    console.log('toggleClientSidebar called', {
        hasClass: body.classList.contains('client-sidebar-show'),
        sidebar: sidebar ? 'found' : 'not found',
        backdrop: backdrop ? 'found' : 'not found',
        windowWidth: window.innerWidth
    });
    
    // Check if mobile
    const isMobile = window.innerWidth < 992;
    
    if (body.classList.contains('client-sidebar-show')) {
        // Close sidebar
        console.log('Closing sidebar');
        body.classList.remove('client-sidebar-show');
        body.style.overflow = 'auto';
        
        if (sidebar) {
            if (isMobile) {
                sidebar.style.right = '-100%';
                sidebar.style.visibility = 'hidden';
            }
        }
        
        if (backdrop) {
            backdrop.style.opacity = '0';
            backdrop.style.visibility = 'hidden';
            backdrop.style.pointerEvents = 'none';
        }
    } else {
        // Open sidebar
        console.log('Opening sidebar');
        body.classList.add('client-sidebar-show');
        body.style.overflow = 'hidden';
        
        if (sidebar) {
            if (isMobile) {
                sidebar.style.right = '0';
                sidebar.style.visibility = 'visible';
                sidebar.style.display = 'block';
                sidebar.style.zIndex = '9999';
            }
        }
        
        if (backdrop) {
            backdrop.style.opacity = '1';
            backdrop.style.visibility = 'visible';
            backdrop.style.pointerEvents = 'auto';
        }
    }
}

// Make function globally available immediately
window.toggleClientSidebar = toggleClientSidebar;

// Also add as inline function for immediate access
if (typeof window.clientSidebarToggle === 'undefined') {
    window.clientSidebarToggle = toggleClientSidebar;
}

// Also add as direct onclick handler on the button
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded - Setting up client sidebar toggle');
    
    // Toggle sidebar from header button
    const menuToggleBtn = document.getElementById('client-menu-toggle-btn');
    const sidebar = document.querySelector('.client-dashboard-sidebar');
    const closeBtn = document.getElementById('client-sidebar-close-btn');
    
    console.log('Elements found:', {
        button: menuToggleBtn ? 'found' : 'NOT FOUND',
        sidebar: sidebar ? 'found' : 'NOT FOUND',
        closeBtn: closeBtn ? 'found' : 'NOT FOUND'
    });
    
    if (menuToggleBtn) {
        // Add click event listener
        menuToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Menu button clicked - opening sidebar');
            toggleClientSidebar(e);
            return false;
        });
        
        console.log('Event listeners attached to menu button');
    } else {
        console.error('Client menu toggle button not found! ID: client-menu-toggle-btn');
    }
    
    // Setup close button
    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Close button clicked - closing sidebar');
            toggleClientSidebar(e);
            return false;
        });
        
        console.log('Event listeners attached to close button');
    }
    
    // Initialize Bootstrap dropdown for user menu
    const userDropdownToggles = document.querySelectorAll('.client-user-link[data-bs-toggle="dropdown"]');
    
    userDropdownToggles.forEach(toggle => {
        const dropdownElement = toggle.closest('.client-user-dropdown');
        const dropdownMenu = dropdownElement ? dropdownElement.querySelector('.client-user-menu') : null;
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isOpen = dropdownMenu && dropdownMenu.classList.contains('show');
            
            document.querySelectorAll('.client-user-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                    menu.style.display = 'none';
                }
            });
            
            if (dropdownMenu) {
                if (isOpen) {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.display = 'none';
                } else {
                    dropdownMenu.classList.add('show');
                    dropdownMenu.style.display = 'block';
                }
            }
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.client-user-dropdown')) {
            document.querySelectorAll('.client-user-menu.show').forEach(menu => {
                menu.classList.remove('show');
                menu.style.display = 'none';
            });
        }
    });
});
</script>
