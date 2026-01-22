@php
    $lawyer = lawyerAuth();
    
    // Get unread messages for lawyer
    $un_seen_message = App\Models\Message::whereHas('conversation', function($query) use ($lawyer) {
        $query->where(function($q) use ($lawyer) {
            $q->where('receiver_type', 'Modules\Lawyer\app\Models\Lawyer')
              ->where('receiver_id', $lawyer?->id);
        });
    })
    ->where('is_read', false)
    ->where('sender_type', '!=', 'Modules\Lawyer\app\Models\Lawyer')
    ->count();
    
    $not_treated = $lawyer->appointments()->paymentSuccess()->notTreated()->count();

    $now = now();
    $tenMinutesLater = now()->addMinutes(10);
    $upcoming_meeting = $lawyer->meeting_history()->where('meeting_time', '>', $now)->where('meeting_time', '<=', $tenMinutesLater)->count();
@endphp

<div class="lawyer-sidebar-wrapper">
    <aside class="lawyer-sidebar" id="lawyer-sidebar">
        <button class="lawyer-sidebar-close d-lg-none" id="lawyer-sidebar-close-btn" aria-label="Close Sidebar">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="lawyer-sidebar-brand">
            <a href="{{ route('lawyer.dashboard') }}">
                <img class="lawyer-sidebar-logo" src="{{ asset($setting->logo) ?? '' }}" alt="{{ $setting->app_name ?? '' }}">
            </a>
        </div>

        <div class="lawyer-sidebar-brand-sm">
            <a href="{{ route('lawyer.dashboard') }}">
                <img src="{{ asset($setting->favicon) ?? '' }}" alt="{{ $setting->app_name ?? '' }}">
            </a>
        </div>

        <nav class="lawyer-sidebar-nav">
            <ul class="lawyer-sidebar-menu">
                <li class="lawyer-menu-item {{ isroute('lawyer.dashboard', 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.dashboard') }}">
                        <i class="fas fa-home lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                
                <li class="lawyer-menu-item {{ isRoute(['lawyer.today.appointment', 'lawyer.treatment', 'lawyer.treatment.edit'], 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.today.appointment') }}">
                        <i class="fas fa-calendar-day lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">{{ __('Today Appointment') }}</span>
                    </a>
                </li>
                
                <li class="lawyer-menu-item lawyer-menu-has-dropdown {{ isRoute(['lawyer.new.appointment', 'lawyer.not.treated.appointment', 'lawyer.all.appointment', 'lawyer.old.appointment'], 'lawyer-menu-active') }}">
                    <a href="javascript:;" class="lawyer-menu-link lawyer-menu-toggle-dropdown">
                        <i class="fas fa-calendar lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">
                            {{ __('Manage Appointment') }}
                            @if ($not_treated > 0)
                                <span class="lawyer-menu-badge">{{ $not_treated }}</span>
                            @endif
                        </span>
                        <i class="fas fa-chevron-down lawyer-menu-arrow"></i>
                    </a>
                    <ul class="lawyer-submenu">
                        <li class="lawyer-submenu-item {{ isroute('lawyer.new.appointment', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.new.appointment') }}">
                                {{ __('New Appointment') }}
                            </a>
                        </li>
                        <li class="lawyer-submenu-item {{ isroute('lawyer.not.treated.appointment', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.not.treated.appointment') }}">
                                {{ __('Not Consulted') }}
                                @if ($not_treated)
                                    <span class="lawyer-menu-badge">{{ $not_treated }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="lawyer-submenu-item {{ isroute('lawyer.all.appointment', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.all.appointment') }}">
                                {{ __('Appointment History') }}
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="lawyer-menu-item lawyer-menu-has-dropdown {{ isRoute(['lawyer.zoom-credential', 'lawyer.zoom-meetings', 'lawyer.create-zoom-meeting', 'lawyer.upcomming-meeting', 'lawyer.meeting-history'], 'lawyer-menu-active') }}">
                    <a href="javascript:;" class="lawyer-menu-link lawyer-menu-toggle-dropdown">
                        <i class="fas fa-video lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">
                            {{ __('Live Consultation') }}
                            @if ($upcoming_meeting > 0)
                                <span class="lawyer-menu-badge">{{ $upcoming_meeting }}</span>
                            @endif
                        </span>
                        <i class="fas fa-chevron-down lawyer-menu-arrow"></i>
                    </a>
                    <ul class="lawyer-submenu">
                        <li class="lawyer-submenu-item {{ isRoute(['lawyer.zoom-meetings', 'lawyer.create-zoom-meeting'], 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.zoom-meetings') }}">
                                {{ __('Zoom Meeting') }}
                            </a>
                        </li>
                        <li class="lawyer-submenu-item {{ isroute('lawyer.upcomming-meeting', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.upcomming-meeting') }}">
                                {{ __('Upcoming Meeting') }}
                                @if ($upcoming_meeting)
                                    <span class="lawyer-menu-badge">{{ $upcoming_meeting }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="lawyer-submenu-item {{ isroute('lawyer.meeting-history', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.meeting-history') }}">
                                {{ __('Meeting History') }}
                            </a>
                        </li>
                        <li class="lawyer-submenu-item {{ isroute('lawyer.zoom-credential', 'lawyer-submenu-active') }}">
                            <a class="lawyer-submenu-link" href="{{ route('lawyer.zoom-credential') }}">
                                {{ __('Setting') }}
                            </a>
                        </li>
                    </ul>
                </li>
                
                @if (Module::isEnabled('Leave'))
                    @include('leave::sidebar')
                @endif
                
                <li class="lawyer-menu-item {{ isroute('lawyer.payment.history', 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.payment.history') }}">
                        <i class="fas fa-credit-card lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">{{ __('Payment History') }}</span>
                    </a>
                </li>
                
                <li class="lawyer-menu-item {{ isroute('lawyer.withdraw.*', 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.withdraw.index') }}">
                        <i class="fas fa-money-bill-wave lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">{{ __('My Withdraw') }}</span>
                    </a>
                </li>
                
                <li class="lawyer-menu-item {{ isroute('lawyer.schedule', 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.schedule') }}">
                        <i class="fas fa-clipboard-list lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">{{ __('My Schedule') }}</span>
                    </a>
                </li>
                
                <li class="lawyer-menu-item {{ isroute('lawyer.message.index', 'lawyer-menu-active') }}">
                    <a class="lawyer-menu-link" href="{{ route('lawyer.message.index') }}">
                        <i class="fas fa-envelope lawyer-menu-icon"></i>
                        <span class="lawyer-menu-text">
                            {{ __('Message') }}
                            @if ($un_seen_message > 0)
                                <span class="lawyer-menu-badge">{{ $un_seen_message }}</span>
                            @endif
                        </span>
                    </a>
                </li>
                
                @if ($setting->lawyer_can_add_social_links == 'active')
                    <li class="lawyer-menu-item {{ isroute('lawyer.social-link.*', 'lawyer-menu-active') }}">
                        <a class="lawyer-menu-link" href="{{ route('lawyer.social-link.index') }}">
                            <i class="fas fa-hashtag lawyer-menu-icon"></i>
                            <span class="lawyer-menu-text">{{ __('Social Links') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </aside>
</div>

<style>
/* Lawyer Sidebar Styles */
.lawyer-sidebar-wrapper {
    position: fixed;
    left: 0;
    top: 70px;
    width: 260px;
    height: calc(100vh - 70px);
    background: #fff;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 999;
    transition: all 0.3s ease;
    overflow-y: auto;
    overflow-x: hidden;
    box-sizing: border-box;
}

.lawyer-sidebar {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.lawyer-sidebar-close {
    display: none;
    position: absolute;
    top: 15px;
    right: 15px;
    width: 35px;
    height: 35px;
    background: rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 50%;
    color: #333;
    font-size: 18px;
    cursor: pointer;
    z-index: 1000;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.lawyer-sidebar-close:hover {
    background: rgba(0, 0, 0, 0.2);
    transform: scale(1.1);
}

.lawyer-sidebar-brand {
    padding: 20px;
    border-bottom: 1px solid #e3e6f0;
    text-align: center;
}

.lawyer-sidebar-brand a {
    display: block;
}

.lawyer-sidebar-logo {
    max-width: 80%;
    height: auto;
}

.lawyer-sidebar-brand-sm {
    display: none;
    padding: 15px;
    border-bottom: 1px solid #e3e6f0;
    text-align: center;
}

.lawyer-sidebar-nav {
    flex: 1;
    padding: 15px 0;
    overflow-y: auto;
}

.lawyer-sidebar-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.lawyer-menu-item {
    margin: 2px 0;
}

.lawyer-menu-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.lawyer-menu-link:hover {
    background: #f8f9fa;
    color: #667eea;
    padding-left: 25px;
}

.lawyer-menu-item.lawyer-menu-active > .lawyer-menu-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-left: 4px solid #fff;
}

.lawyer-menu-icon {
    width: 20px;
    margin-right: 12px;
    text-align: center;
    font-size: 16px;
}

.lawyer-menu-text {
    flex: 1;
    font-weight: 500;
}

.lawyer-menu-arrow {
    margin-left: auto;
    font-size: 12px;
    transition: transform 0.3s ease;
}

.lawyer-menu-item.lawyer-menu-open > .lawyer-menu-link .lawyer-menu-arrow {
    transform: rotate(180deg);
}

.lawyer-menu-badge {
    display: inline-block;
    padding: 2px 8px;
    background: #ff4757;
    color: #fff;
    border-radius: 12px;
    font-size: 11px;
    font-weight: bold;
    margin-left: 8px;
}

.lawyer-menu-item.lawyer-menu-active > .lawyer-menu-link .lawyer-menu-badge {
    background: rgba(255, 255, 255, 0.3);
}

.lawyer-submenu {
    list-style: none;
    margin: 0;
    padding: 0;
    background: #f8f9fa;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.lawyer-menu-item.lawyer-menu-open > .lawyer-submenu {
    max-height: 500px;
}

.lawyer-submenu-item {
    margin: 0;
}

.lawyer-submenu-link {
    display: block;
    padding: 10px 20px 10px 52px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.lawyer-submenu-link:hover {
    background: #e9ecef;
    color: #667eea;
    padding-left: 57px;
}

.lawyer-submenu-item.lawyer-submenu-active > .lawyer-submenu-link {
    background: #e9ecef;
    color: #667eea;
    font-weight: 600;
    border-left: 3px solid #667eea;
}

/* Mobile Styles */
@media (max-width: 1024px) {
    .lawyer-sidebar-wrapper {
        left: -100% !important;
        top: 70px !important;
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.3) !important;
        transform: translateX(-100%) !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
    
    body.lawyer-sidebar-open .lawyer-sidebar-wrapper {
        left: 0 !important;
        transform: translateX(0) !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    body.lawyer-sidebar-open::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 998;
    }
    
    .lawyer-sidebar-close {
        display: flex;
    }
}

/* Scrollbar Styling */
.lawyer-sidebar-nav::-webkit-scrollbar {
    width: 6px;
}

.lawyer-sidebar-nav::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.lawyer-sidebar-nav::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.lawyer-sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* RTL Support - Arabic */
@php
    $textDirection = session()->get('text_direction', 'ltr');
    $currentLang = session()->get('lang', config('app.locale', 'ar'));
    $rtlLanguages = ['ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi'];
    $isRTL = $textDirection === 'rtl' || in_array($currentLang, $rtlLanguages);
@endphp

@if($isRTL)
/* RTL Styles */
.lawyer-sidebar-wrapper {
    left: auto;
    right: 0;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
}

.lawyer-sidebar-close {
    right: auto;
    left: 15px;
}

.lawyer-menu-link {
    flex-direction: row-reverse;
    text-align: right;
}

.lawyer-menu-link:hover {
    padding-left: 20px;
    padding-right: 25px;
}

.lawyer-menu-item.lawyer-menu-active > .lawyer-menu-link {
    border-left: none;
    border-right: 4px solid #fff;
}

.lawyer-menu-icon {
    margin-right: 0;
    margin-left: 12px;
}

.lawyer-menu-arrow {
    margin-left: 0;
    margin-right: auto;
    transform: scaleX(-1);
}

.lawyer-menu-item.lawyer-menu-open > .lawyer-menu-link .lawyer-menu-arrow {
    transform: scaleX(-1) rotate(180deg);
}

.lawyer-submenu-link {
    padding: 10px 52px 10px 20px;
    text-align: right;
}

.lawyer-submenu-link:hover {
    padding-left: 20px;
    padding-right: 57px;
}

.lawyer-submenu-item.lawyer-submenu-active > .lawyer-submenu-link {
    border-left: none;
    border-right: 3px solid #667eea;
}

/* Mobile RTL */
@media (max-width: 1024px) {
    [dir="rtl"] .lawyer-sidebar-wrapper {
        left: auto !important;
        right: -100% !important;
        box-shadow: -2px 0 15px rgba(0, 0, 0, 0.3) !important;
        transform: translateX(100%) !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
    
    [dir="rtl"] body.lawyer-sidebar-open .lawyer-sidebar-wrapper {
        left: auto !important;
        right: 0 !important;
        transform: translateX(0) !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
}
@endif
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenu
    const dropdownToggles = document.querySelectorAll('.lawyer-menu-toggle-dropdown');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menuItem = this.closest('.lawyer-menu-item');
            menuItem.classList.toggle('lawyer-menu-open');
        });
    });
    
    // Mobile sidebar toggle
    const menuToggleBtn = document.getElementById('lawyer-menu-toggle-btn');
    const sidebarCloseBtn = document.getElementById('lawyer-sidebar-close-btn');
    
    if (menuToggleBtn) {
        menuToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('lawyer-sidebar-open');
        });
    }
    
    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', function() {
            document.body.classList.remove('lawyer-sidebar-open');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024) {
            const sidebar = document.querySelector('.lawyer-sidebar-wrapper');
            const toggleBtn = document.getElementById('lawyer-menu-toggle-btn');
            
            if (sidebar && !sidebar.contains(e.target) && !toggleBtn?.contains(e.target)) {
                document.body.classList.remove('lawyer-sidebar-open');
            }
        }
    });
    
    // Auto-open active submenu
    const activeSubmenu = document.querySelector('.lawyer-submenu-item.lawyer-submenu-active');
    if (activeSubmenu) {
        const parentMenuItem = activeSubmenu.closest('.lawyer-menu-item');
        if (parentMenuItem) {
            parentMenuItem.classList.add('lawyer-menu-open');
        }
    }
});
</script>
