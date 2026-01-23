@php
    $current_user = Auth::user();
    $textDirection = session()->get('text_direction', 'ltr');
    $currentLang = session()->get('lang', config('app.locale', 'ar'));
    $rtlLanguages = ['ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi'];
    $isRTL = $textDirection === 'rtl' || in_array($currentLang, $rtlLanguages);
@endphp

<div class="dashboard-header-bg"></div>
<nav class="dashboard-header-nav">
    @if($isRTL)
        {{-- RTL: Menu button on right --}}
        <div class="dashboard-header-right">
            <button class="dashboard-menu-btn" id="dashboard-menu-toggle" type="button" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        {{-- Center Title --}}
        <div class="dashboard-header-center">
            <h2 class="dashboard-title">لوحة تحكم العميل</h2>
        </div>
        
        <div class="dashboard-header-left">
            <div class="dashboard-user-menu">
                <button class="dashboard-user-btn" type="button" id="dashboard-user-toggle">
                    @if ($current_user->image)
                        <img src="{{ asset($current_user->image) }}" alt="{{ $current_user->name }}" class="dashboard-user-img">
                    @else
                        <img src="{{ asset($setting->default_avatar) }}" alt="{{ $current_user->name }}" class="dashboard-user-img">
                    @endif
                    <span class="dashboard-user-name d-none d-lg-inline">{{ $current_user->name }}</span>
                    <i class="fas fa-chevron-down d-none d-lg-inline"></i>
                </button>
                <div class="dashboard-user-dropdown" id="dashboard-user-dropdown">
                    <a href="{{ route('dashboard') }}" class="dashboard-dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <div class="dashboard-dropdown-divider"></div>
                    <a target="_blank" href="{{ route('home') }}" class="dashboard-dropdown-item">
                        <i class="fas fa-globe"></i>
                        <span>{{ __('View Website') }}</span>
                    </a>
                    <div class="dashboard-dropdown-divider"></div>
                    <a href="javascript:;" class="dashboard-dropdown-item dashboard-dropdown-danger" onclick="event.preventDefault(); $('#logout-form').trigger('submit');">
                        <i class="fas fa-power-off"></i>
                        <span>{{ __('Sign Out') }}</span>
                    </a>
                </div>
            </div>
            
            <a target="_blank" href="{{ route('home') }}" class="dashboard-home-btn">
                <i class="fas fa-home"></i>
                <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
            </a>
        </div>
    @else
        {{-- LTR: Menu button on left --}}
        <div class="dashboard-header-left">
            <button class="dashboard-menu-btn" id="dashboard-menu-toggle" type="button" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        {{-- Center Title --}}
        <div class="dashboard-header-center">
            <h2 class="dashboard-title">لوحة تحكم العميل</h2>
        </div>
        
        <div class="dashboard-header-right">
            <a target="_blank" href="{{ route('home') }}" class="dashboard-home-btn">
                <i class="fas fa-home"></i>
                <span class="d-none d-md-inline">{{ __('Visit Website') }}</span>
            </a>
            
            <div class="dashboard-user-menu">
                <button class="dashboard-user-btn" type="button" id="dashboard-user-toggle">
                    @if ($current_user->image)
                        <img src="{{ asset($current_user->image) }}" alt="{{ $current_user->name }}" class="dashboard-user-img">
                    @else
                        <img src="{{ asset($setting->default_avatar) }}" alt="{{ $current_user->name }}" class="dashboard-user-img">
                    @endif
                    <span class="dashboard-user-name d-none d-lg-inline">{{ $current_user->name }}</span>
                    <i class="fas fa-chevron-down d-none d-lg-inline"></i>
                </button>
                <div class="dashboard-user-dropdown" id="dashboard-user-dropdown">
                    <a href="{{ route('dashboard') }}" class="dashboard-dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <div class="dashboard-dropdown-divider"></div>
                    <a target="_blank" href="{{ route('home') }}" class="dashboard-dropdown-item">
                        <i class="fas fa-globe"></i>
                        <span>{{ __('View Website') }}</span>
                    </a>
                    <div class="dashboard-dropdown-divider"></div>
                    <a href="javascript:;" class="dashboard-dropdown-item dashboard-dropdown-danger" onclick="event.preventDefault(); $('#logout-form').trigger('submit');">
                        <i class="fas fa-power-off"></i>
                        <span>{{ __('Sign Out') }}</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</nav>

<style>
/* Dashboard Header Background */
.dashboard-header-bg {
    height: 70px;
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

/* Dashboard Header Navigation */
.dashboard-header-nav {
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

.dashboard-header-left,
.dashboard-header-right {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 0 0 auto;
}

/* Center Title */
.dashboard-header-center {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.dashboard-title {
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
    white-space: nowrap;
}

/* Menu Toggle Button - Hidden on desktop, visible on mobile only */
.dashboard-menu-btn {
    display: none;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.15);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.dashboard-menu-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.dashboard-menu-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.05);
}

.dashboard-menu-btn:active {
    transform: scale(0.95);
}

/* Show menu button only on mobile */
@media (max-width: 991px) {
    .dashboard-menu-btn {
        display: flex;
    }
}

/* Home Button */
.dashboard-home-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 15px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    min-width: 40px;
    min-height: 40px;
}

.dashboard-home-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-home-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

/* User Menu */
.dashboard-user-menu {
    position: relative;
}

.dashboard-user-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 5px 12px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 8px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 40px;
}

.dashboard-user-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-user-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.dashboard-user-img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.dashboard-user-name {
    color: #fff;
    font-weight: 500;
    font-size: 14px;
}

/* User Dropdown */
.dashboard-user-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    min-width: 220px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    padding: 8px 0;
    display: none;
    z-index: 10000;
    border: 1px solid rgba(0, 0, 0, 0.08);
}

.dashboard-user-menu.active .dashboard-user-dropdown {
    display: block;
}

.dashboard-dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s ease;
}

.dashboard-dropdown-item:hover {
    background: #f8f9fa;
    color: #667eea;
    padding-left: 22px;
}

.dashboard-dropdown-item i {
    width: 20px;
    text-align: center;
    color: #667eea;
    font-size: 16px;
}

.dashboard-dropdown-divider {
    height: 1px;
    background: #e9ecef;
    margin: 6px 0;
}

.dashboard-dropdown-danger {
    color: #dc3545 !important;
}

.dashboard-dropdown-danger:hover {
    background: #fff5f5 !important;
    color: #dc3545 !important;
}

.dashboard-dropdown-danger i {
    color: #dc3545 !important;
}

/* Mobile Styles */
@media (max-width: 991px) {
    .dashboard-header-nav {
        padding: 0 10px;
    }
    
    .dashboard-menu-btn {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
    
    .dashboard-title {
        font-size: 16px;
    }
    
    .dashboard-user-name {
        display: none;
    }
    
    .dashboard-user-img {
        width: 32px;
        height: 32px;
    }
    
    .dashboard-home-btn {
        min-width: 38px;
        min-height: 38px;
        padding: 8px;
    }
    
    .dashboard-home-btn span {
        display: none;
    }
    
    .dashboard-user-btn {
        min-height: 38px;
        padding: 5px 8px;
    }
    
    .dashboard-user-dropdown {
        position: fixed;
        top: 75px;
        right: 10px;
        left: auto;
        min-width: 240px;
        max-width: calc(100vw - 20px);
    }
}

@media (max-width: 480px) {
    .dashboard-header-nav {
        padding: 0 8px;
    }
    
    .dashboard-menu-btn {
        width: 36px;
        height: 36px;
        font-size: 15px;
    }
    
    .dashboard-title {
        font-size: 14px;
    }
    
    .dashboard-user-img {
        width: 30px;
        height: 30px;
    }
    
    .dashboard-home-btn {
        min-width: 36px;
        min-height: 36px;
        padding: 6px;
    }
    
    .dashboard-user-btn {
        min-height: 36px;
        padding: 4px 6px;
    }
}
</style>

<script>
(function() {
    'use strict';
    
    // Toggle sidebar function
    function toggleDashboardSidebar() {
        const body = document.body;
        const sidebar = document.querySelector('.dashboard-sidebar');
        
        body.classList.toggle('dashboard-sidebar-open');
        
        if (sidebar) {
            if (body.classList.contains('dashboard-sidebar-open')) {
                sidebar.style.right = '0';
                body.style.overflow = 'hidden';
            } else {
                sidebar.style.right = '-100%';
                body.style.overflow = 'auto';
            }
        }
    }
    
    // Close sidebar function
    function closeDashboardSidebar() {
        const body = document.body;
        const sidebar = document.querySelector('.dashboard-sidebar');
        
        body.classList.remove('dashboard-sidebar-open');
        body.style.overflow = 'auto';
        
        if (sidebar) {
            sidebar.style.right = '-100%';
        }
    }
    
    // Setup on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        // Menu toggle button
        const menuBtn = document.getElementById('dashboard-menu-toggle');
        if (menuBtn) {
            menuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleDashboardSidebar();
            });
        }
        
        // Close button in sidebar
        const closeBtn = document.getElementById('dashboard-sidebar-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeDashboardSidebar();
            });
        }
        
        // Close sidebar when clicking backdrop (using event delegation)
        document.body.addEventListener('click', function(e) {
            if (window.innerWidth < 992 && document.body.classList.contains('dashboard-sidebar-open')) {
                const sidebar = document.querySelector('.dashboard-sidebar');
                const menuBtn = document.getElementById('dashboard-menu-toggle');
                
                // If click is outside sidebar and not on menu button
                if (sidebar && !sidebar.contains(e.target) && 
                    menuBtn && !menuBtn.contains(e.target) &&
                    !e.target.closest('.dashboard-sidebar')) {
                    closeDashboardSidebar();
                }
            }
        });
        
        // Setup user dropdown
        const userBtn = document.getElementById('dashboard-user-toggle');
        const userMenuContainer = userBtn ? userBtn.closest('.dashboard-user-menu') : null;
        
        if (userBtn && userMenuContainer) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenuContainer.classList.toggle('active');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userMenuContainer.contains(e.target)) {
                    userMenuContainer.classList.remove('active');
                }
            });
        }
        
        // Close sidebar when clicking menu items on mobile
        const sidebar = document.querySelector('.dashboard-sidebar');
        if (sidebar) {
            const menuLinks = sidebar.querySelectorAll('ul li a');
            menuLinks.forEach(link => {
                if (!link.getAttribute('onclick') || !link.getAttribute('onclick').includes('logout')) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 992) {
                            setTimeout(closeDashboardSidebar, 300);
                        }
                    });
                }
            });
        }
    });
})();
</script>
