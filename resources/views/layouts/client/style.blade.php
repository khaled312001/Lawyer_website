<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('client/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/swiper-bundle.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/datatable.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/spacing.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/cookie-consent.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/prescription.css') }}?v={{ $setting?->version }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">



<link rel="stylesheet" href="{{ asset('client/css/style.css') }}?v={{ $setting?->version }}">
@php
    $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'ltr');
@endphp
@if ($textDirection == 'rtl')
    <link rel="stylesheet" href="{{ asset('client/css/rtl.css') }}?v={{ $setting?->version }}">
@endif
<link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/horizontal-scroll-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/kliently-features.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/animations.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/unified-colors.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/image-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/footer-icons-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/icon-colors-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/dashboard-mobile.css') }}?v={{ $setting?->version }}">


<link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/jquery-ui.css') }}">

<style>
    :root {
        --colorPrimary: {{ $setting->theme_one }} !important;
        --colorSecondary: {{ $setting->theme_two }} !important;
        --navGradientStart: {{ $setting->theme_one }};
        --navGradientEnd: {{ $setting->theme_two }};
        
        /* Unified Color System */
        --btn-primary-bg: var(--colorPrimary);
        --btn-primary-hover: var(--colorSecondary);
        --btn-primary-text: #fff;
        --btn-secondary-bg: var(--colorBlack);
        --btn-secondary-hover: var(--colorPrimary);
        --btn-secondary-text: #fff;
        --btn-outline-border: var(--colorPrimary);
        --btn-outline-text: var(--colorPrimary);
        --btn-outline-hover-bg: var(--colorPrimary);
        --btn-outline-hover-text: #fff;
        
        /* Link Colors */
        --link-color: var(--colorPrimary);
        --link-hover: var(--colorSecondary);
        
        /* Border Colors */
        --border-primary: var(--colorPrimary);
        --border-light: #e0e0e0;
        
        /* Text Colors */
        --text-primary: var(--colorBlack);
        --text-secondary: #666;
        --text-muted: #999;
        
        /* Navigation Heights */
        --top-header-bar-height: 50px;
        --main-navbar-height: 70px;
        --total-navbar-height: 120px; /* top-header-bar + main-navbar */
    }

    /* ============================================
       NEW NAVIGATION SYSTEM - RESPONSIVE & MODERN
       ============================================ */

    /* Top Alert Banner */
    .top-alert-banner {
        background: linear-gradient(135deg, #ffe5e5 0%, #ffd6d6 100%);
        padding: 12px 0;
        position: relative;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-top: var(--total-navbar-height); /* Space for top header bar + main navbar */
    }

    .top-alert-banner.hidden {
        display: none;
    }

    .alert-content {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 0 40px;
    }

    .alert-text {
        font-size: 14px;
        color: #333;
        font-weight: 500;
        text-align: center;
        flex: 1;
    }

    .alert-close-btn {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: #000;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .alert-close-btn:hover {
        background: #333;
        transform: translateY(-50%) scale(1.1);
    }

    /* Top Header Bar */
    .top-header-bar {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 10000 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .header-bar-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-left,
    .header-right {
        display: flex;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .header-left {
        justify-content: flex-start;
    }

    .header-right {
        justify-content: flex-end;
    }

    .cart-wrapper {
        position: relative;
    }

    .cart-link {
        display: flex;
        align-items: center;
        color: #555;
        font-size: 18px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        padding: 8px 12px;
        border-radius: 8px;
        background: rgba(200, 180, 126, 0.05);
    }
   
    .cart-link:hover {
        color: var(--colorPrimary);
        background: rgba(200, 180, 126, 0.1);
        transform: translateY(-2px);
    }

    .cart-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(200, 180, 126, 0.4);
        border: 2px solid #fff;
    }

    .currency-selector,
    .language-selector {
        position: relative;
    }

    .header-select {
        border: 1px solid #e0e0e0;
        background: #fff;
        padding: 8px 30px 8px 12px;
        cursor: pointer;
        font-size: 14px;
        color: #555;
        appearance: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23555' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        min-width: 120px;
    }

    .header-select:hover {
        border-color: var(--colorPrimary);
        color: var(--colorPrimary);
        box-shadow: 0 2px 8px rgba(200, 180, 126, 0.1);
    }

    .header-select:focus {
        outline: none;
        border-color: var(--colorPrimary);
        box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1);
    }

    .header-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        padding: 8px 12px;
        border-radius: 6px;
        white-space: nowrap;
    }

    .header-contact-item i {
        color: var(--colorPrimary);
        font-size: 16px;
        min-width: 18px;
    }

    .header-contact-item:hover {
        color: var(--colorPrimary);
        background: rgba(200, 180, 126, 0.08);
        transform: translateY(-1px);
    }

    .account-link {
        font-weight: 500;
    }

    .auth-links {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .login-link,
    .register-link {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
    }

    .login-link {
        background: rgba(200, 180, 126, 0.1);
        color: var(--colorPrimary);
    }

    .login-link:hover {
        background: var(--colorPrimary);
        color: #fff;
    }

    .login-link:hover i {
        color: #fff;
    }

    .register-link {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff;
    }

    .register-link i {
        color: #fff;
    }

    .register-link:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(200, 180, 126, 0.3);
    }

    /* Main Navigation Bar - Enhanced Design - Always Visible on Scroll */
    body.client-frontend .main-navbar {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%) !important;
        padding: 0;
        box-shadow: 0 4px 25px rgba(0,0,0,0.08), 0 2px 10px rgba(0,0,0,0.05);
        position: fixed !important;
        top: var(--top-header-bar-height) !important; /* Position below top header bar */
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 9999 !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: visible !important;
        border-bottom: 2px solid rgba(200, 180, 126, 0.15);
        backdrop-filter: blur(10px);
    }

    body.client-frontend .main-navbar.sticky {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12), 0 4px 15px rgba(0,0,0,0.08);
        border-bottom-color: rgba(200, 180, 126, 0.25);
        background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(250,251,252,0.98) 100%) !important;
    }

    body.client-frontend .navbar-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 25px;
        position: relative;
        overflow: visible !important;
        min-height: 70px;
    }

    body.client-frontend .navbar-logo {
        flex-shrink: 0;
    }

    body.client-frontend .navbar-logo {
        overflow: visible !important;
    }

    body.client-frontend .navbar-logo a {
        display: block;
        overflow: visible !important;
    }

    body.client-frontend .navbar-logo img {
        max-height: 45px !important;
        max-width: 200px !important;
        width: auto !important;
        height: auto !important;
        display: block;
        object-fit: contain !important;
        object-position: center !important;
        filter: brightness(0.9) contrast(1.1);
        transition: all 0.3s ease;
    }

    body.client-frontend .navbar-logo:hover img {
        filter: brightness(1) contrast(1);
        transform: scale(1.02);
    }

    /* Override any conflicting styles from main CSS */
    body.client-frontend .logo img {
        height: auto !important;
        max-height: 50px !important;
        object-fit: contain !important;
        object-position: center !important;
    }

    body.client-frontend .navbar-menu {
        flex: 1;
        display: flex;
        justify-content: center;
        position: relative;
        z-index: 10000;
        overflow: visible !important;
    }

    body.client-frontend .nav-menu-list {
        display: flex;
        align-items: center;
        gap: 5px;
        list-style: none;
        margin: 0;
        padding: 0;
        overflow: visible !important;
    }

    body.client-frontend .nav-item {
        position: relative;
    }

    body.client-frontend .nav-item.has-dropdown {
        position: relative;
        z-index: 10001;
    }

    body.client-frontend .nav-item.has-dropdown.active {
        z-index: 10002;
    }

    body.client-frontend .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        color: #2c3e50 !important;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        position: relative;
    }

    body.client-frontend .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 80%;
        height: 3px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 3px 3px 0 0;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body.client-frontend .nav-link i {
        font-size: 15px;
        color: #555 !important;
        transition: all 0.4s ease;
    }

    body.client-frontend .nav-link:hover {
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.12) 0%, rgba(200, 180, 126, 0.08) 100%) !important;
        color: var(--colorPrimary) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(200, 180, 126, 0.2);
    }

    body.client-frontend .nav-link:hover::before {
        transform: translateX(-50%) scaleX(1);
    }

    body.client-frontend .nav-link:hover i {
        color: var(--colorPrimary) !important;
        transform: scale(1.15);
    }

    body.client-frontend .nav-item.has-dropdown .nav-link .dropdown-icon {
        font-size: 12px;
        margin-left: 5px;
        transition: transform 0.3s ease;
    }

    body.client-frontend .nav-item.has-dropdown:hover .dropdown-icon {
        transform: rotate(180deg);
    }

    body.client-frontend .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%) !important;
        min-width: 240px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.15), 0 4px 15px rgba(0,0,0,0.1) !important;
        border-radius: 12px;
        padding: 12px 0;
        margin-top: 10px !important;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px) scale(0.95);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 99999 !important;
        display: block !important;
        pointer-events: none;
        overflow: visible !important;
        white-space: nowrap;
        clip: auto !important;
        clip-path: none !important;
        border: 1px solid rgba(200, 180, 126, 0.15);
        backdrop-filter: blur(10px);
    }

    /* Only show dropdown when active class is present (controlled by JavaScript) */
    body.client-frontend .nav-item.has-dropdown.active .dropdown-menu {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) scale(1) !important;
        pointer-events: auto !important;
        display: block !important;
    }

    /* Ensure dropdown is hidden by default and only shown when active */
    body.client-frontend .nav-item.has-dropdown:not(.active) .dropdown-menu {
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
        transform: translateY(-10px) !important;
    }

    /* Remove all hover-based CSS that conflicts with JavaScript */
    body.client-frontend .nav-item.has-dropdown:hover:not(.active) .dropdown-menu {
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }

    body.client-frontend .dropdown-menu li {
        margin: 0;
    }

    body.client-frontend .dropdown-menu li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 22px;
        color: #2c3e50;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border-radius: 0;
    }

    body.client-frontend .dropdown-menu li a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0 4px 4px 0;
    }

    body.client-frontend .dropdown-menu li a i {
        color: var(--colorPrimary);
        font-size: 15px;
        width: 20px;
        transition: all 0.4s ease;
    }

    body.client-frontend .dropdown-menu li a:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.12) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary);
        padding-left: 28px;
        transform: translateX(3px);
    }

    body.client-frontend .dropdown-menu li a:hover::before {
        width: 4px;
    }

    body.client-frontend .dropdown-menu li a:hover i {
        transform: scale(1.2) rotate(5deg);
        color: var(--colorSecondary);
    }

    body.client-frontend .appointment-btn-wrapper {
        margin-left: 15px;
    }

    body.client-frontend .appointment-btn {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        background-size: 200% auto;
        color: #fff !important;
        padding: 14px 28px !important;
        border-radius: 10px;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 6px 20px rgba(200, 180, 126, 0.4), 0 2px 8px rgba(0,0,0,0.1);
        border: 2px solid var(--colorPrimary);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-shadow: none;
        position: relative;
        overflow: hidden;
    }

    body.client-frontend .appointment-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    body.client-frontend .appointment-btn:hover {
        background-position: right center !important;
        border-color: var(--colorSecondary);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(200, 180, 126, 0.6), 0 4px 12px rgba(0,0,0,0.15);
        color: #fff !important;
    }

    body.client-frontend .appointment-btn:hover::before {
        left: 100%;
    }

    body.client-frontend .appointment-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    body.client-frontend .appointment-btn i {
        color: #fff !important;
    }

    /* Ensure dropdown appears above all sections */
    body.client-frontend section,
    body.client-frontend .section,
    body.client-frontend [class*="section"],
    body.client-frontend .banner-area,
    body.client-frontend .hero-section,
    body.client-frontend [class*="banner"],
    body.client-frontend [class*="hero"] {
        position: relative;
        z-index: 1 !important;
    }

    /* Ensure navbar and dropdown are above everything */
    body.client-frontend .main-navbar {
        position: fixed !important;
        overflow: visible !important;
    }

    /* Add padding-top to body to prevent content from hiding behind fixed navbar */
    body.client-frontend {
        padding-top: var(--total-navbar-height) !important; /* Top header bar + Main navbar */
    }

    /* Ensure navbar is always on top */
    body.client-frontend .top-header-bar {
        position: fixed !important;
        z-index: 10000 !important;
    }

    /* Ensure first section doesn't have extra padding */
    body.client-frontend .slider,
    body.client-frontend #main-slider {
        margin-top: 0 !important;
    }

    /* On mobile, adjust padding for smaller screens */
    @media (max-width: 768px) {
        body.client-frontend {
            padding-top: var(--total-navbar-height) !important; /* Keep same padding on mobile */
        }
        body.client-frontend .main-navbar {
            top: var(--top-header-bar-height) !important; /* Keep main navbar below top header bar */
        }
        .top-alert-banner {
            margin-top: var(--total-navbar-height) !important; /* Keep alert banner below both bars */
        }
    }

    /* Ensure container doesn't clip dropdown */
    body.client-frontend .main-navbar .container-fluid,
    body.client-frontend .main-navbar .container {
        overflow: visible !important;
        position: relative;
        height: auto !important;
        max-height: none !important;
    }

    body.client-frontend .main-navbar .navbar-wrapper {
        overflow: visible !important;
        height: auto !important;
        max-height: none !important;
    }

    /* Prevent navbar from expanding when dropdown is shown */
    body.client-frontend .main-navbar {
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
    }

    body.client-frontend .navbar-menu {
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
    }

    body.client-frontend .nav-menu-list {
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
    }

    /* Ensure nav-item doesn't clip dropdown */
    body.client-frontend .nav-item.has-dropdown {
        overflow: visible !important;
        height: auto !important;
    }

    /* Force dropdown to appear outside navbar */
    body.client-frontend .nav-item.has-dropdown .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        margin-top: 8px !important;
        clip: auto !important;
        clip-path: none !important;
    }

    /* Override any global overflow rules */
    body.client-frontend .main-navbar,
    body.client-frontend .main-navbar *,
    body.client-frontend .main-navbar .container-fluid,
    body.client-frontend .main-navbar .container,
    body.client-frontend .main-navbar .navbar-wrapper,
    body.client-frontend .main-navbar .navbar-menu,
    body.client-frontend .main-navbar .nav-menu-list,
    body.client-frontend .main-navbar .nav-item {
        overflow: visible !important;
        clip: auto !important;
        clip-path: none !important;
    }

    /* Mobile Menu Toggle Button - Client Only */
    body.client-frontend .mobile-menu-toggle {
        display: none !important;
        flex-direction: column;
        gap: 5px;
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.1) 0%, rgba(200, 180, 126, 0.05) 100%);
        border: 2px solid rgba(200, 180, 126, 0.2);
        border-radius: 10px;
        cursor: pointer;
        padding: 10px;
        z-index: 1001;
        position: relative;
        width: 44px;
        height: 44px;
        justify-content: center;
        align-items: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    body.client-frontend .mobile-menu-toggle:hover {
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.2) 0%, rgba(200, 180, 126, 0.1) 100%);
        border-color: var(--colorPrimary);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(200, 180, 126, 0.2);
    }

    body.client-frontend .mobile-menu-toggle span {
        width: 26px;
        height: 3px;
        background: var(--colorBlack);
        border-radius: 3px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    body.client-frontend .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    body.client-frontend .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    body.client-frontend .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Mobile Side Menu */
    .mobile-side-menu {
        display: none !important;
    }
    
    @media (max-width: 991px) {
        .mobile-side-menu {
            display: block !important;
        }
    }

    .side-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .mobile-side-menu.active .side-menu-overlay {
        opacity: 1;
        visibility: visible;
    }

    .side-menu-content {
        position: fixed;
        top: 0;
        right: -100%;
        width: 320px;
        max-width: 85vw;
        height: 100%;
        background: #fff;
        box-shadow: -2px 0 15px rgba(0,0,0,0.2);
        z-index: 9999;
        transition: right 0.3s ease;
        overflow-y: auto;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
    }
    
    /* Make main menu items visible without scroll */
    @media (max-width: 991px) {
        .side-menu-body {
            overflow-y: visible !important;
            overflow: visible !important;
            max-height: none !important;
            flex: 0 0 auto !important;
        }
        
        .side-menu-body .side-menu-list {
            overflow: visible !important;
            max-height: none !important;
        }
        
        .side-menu-item {
            flex-shrink: 0;
        }
    }

    .mobile-side-menu.active .side-menu-content {
        right: 0;
    }

    .side-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 22px 26px;
        border-bottom: 2px solid rgba(255,255,255,0.2);
        background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, var(--colorSecondary, #8b7355) 100%);
        position: relative;
        z-index: 10;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2), inset 0 1px 0 rgba(255,255,255,0.1);
        min-height: 80px;
    }
    
    .side-menu-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.08) 100%);
        pointer-events: none;
    }

    .side-menu-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    }
    
    /* Mobile header improvements */
    @media (max-width: 991px) {
        .side-menu-header {
            padding: 18px 20px;
            min-height: 70px;
        }
    }

    .side-menu-logo {
        overflow: visible !important;
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .side-menu-logo img {
        max-height: 45px;
        max-width: 200px;
        width: auto;
        height: auto;
        object-fit: contain !important;
        object-position: center !important;
        display: block;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .side-menu-close {
        background: rgba(255, 255, 255, 0.98) !important;
        border: 2px solid rgba(255, 255, 255, 0.4) !important;
        color: #d32f2f !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 19px !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 0 rgba(255,255,255,0.5) !important;
        position: relative;
        z-index: 2;
        padding: 0 !important;
        margin: 0 !important;
        flex-shrink: 0;
    }

    .side-menu-close::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(211, 47, 47, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        transition: transform 0.4s ease;
    }

    .side-menu-close:hover {
        background: #fff !important;
        border-color: #d32f2f !important;
        transform: rotate(90deg) scale(1.12) !important;
        box-shadow: 0 6px 18px rgba(211, 47, 47, 0.4), inset 0 1px 0 rgba(255,255,255,0.6) !important;
        color: #b71c1c !important;
    }

    .side-menu-close:hover::before {
        transform: translate(-50%, -50%) scale(1.5);
    }

    .side-menu-close:active {
        transform: rotate(90deg) scale(0.95) !important;
        box-shadow: 0 2px 6px rgba(211, 47, 47, 0.2) !important;
    }

    .side-menu-close i {
        transition: all 0.3s ease !important;
        font-weight: 600;
    }

    .side-menu-close:hover i {
        transform: scale(1.1) !important;
    }
    
    /* Mobile specific improvements for close button */
    @media (max-width: 991px) {
        .side-menu-close {
            width: 32px !important;
            height: 32px !important;
            font-size: 16px !important;
        }
    }

    .side-menu-body {
        flex: 1;
        padding: 0;
        overflow-y: visible !important;
        overflow: visible !important;
        display: flex;
        flex-direction: column;
        order: 1;
    }

    /* Main Menu Items - Show First */
    .side-menu-body .side-menu-list {
        list-style: none;
        margin: 0;
        padding: 0;
        order: 1;
        background: #fff;
        overflow: visible !important;
        max-height: none !important;
        width: 100%;
        display: block;
    }

    .side-menu-item {
        border-bottom: 1px solid #f0f0f0;
        position: relative;
        width: 100%;
        display: block;
    }

    .side-menu-item:last-child {
        border-bottom: none;
    }

    .side-menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 20px;
        color: #2c3e50;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        background: #fff;
        border-left: 3px solid transparent;
        width: 100%;
        box-sizing: border-box;
        direction: ltr;
    }

    [dir="rtl"] .side-menu-link {
        direction: rtl;
        border-left: none;
        border-right: 3px solid transparent;
    }

    .side-menu-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background: linear-gradient(90deg, var(--colorPrimary, #c8b47e) 0%, rgba(200, 180, 126, 0.1) 100%);
        transition: width 0.3s ease;
    }

    [dir="rtl"] .side-menu-link::before {
        left: auto;
        right: 0;
        background: linear-gradient(270deg, var(--colorPrimary, #c8b47e) 0%, rgba(200, 180, 126, 0.1) 100%);
    }

    .side-menu-link i {
        color: var(--colorPrimary, #c8b47e);
        font-size: 18px;
        width: 22px;
        min-width: 22px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        flex-shrink: 0;
    }

    [dir="rtl"] .side-menu-link i {
        order: 1;
        margin-left: 0;
        margin-right: 8px;
    }

    .side-menu-link span {
        flex: 1;
        text-align: left;
    }

    [dir="rtl"] .side-menu-link span {
        text-align: right;
        order: 2;
    }

    [dir="rtl"] .side-menu-link {
        flex-direction: row;
        justify-content: flex-start;
    }

    .side-menu-link:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.08) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.03) 100%);
        color: var(--colorPrimary, #c8b47e);
        padding-left: 24px;
        border-left-color: var(--colorPrimary, #c8b47e);
    }

    [dir="rtl"] .side-menu-link:hover {
        padding-left: 20px;
        padding-right: 24px;
        border-left: none;
        border-right-color: var(--colorPrimary, #c8b47e);
    }

    .side-menu-link:hover::before {
        width: 100%;
    }

    .side-menu-link:hover i {
        transform: scale(1.15);
        color: var(--colorPrimary, #c8b47e);
    }

    .side-menu-item.has-submenu .side-menu-link {
        width: 100%;
    }

    .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
        margin-left: auto;
        font-size: 12px;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    [dir="rtl"] .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
        margin-left: auto;
        margin-right: 0;
        order: 3;
    }

    .side-menu-item.has-submenu.active .side-menu-link .submenu-toggle {
        transform: rotate(180deg);
    }

    .side-submenu {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: #f8f8f8;
    }

    .side-menu-item.has-submenu.active .side-submenu {
        max-height: 500px;
    }

    .side-submenu {
        width: 100%;
        display: block;
    }

    .side-submenu li {
        width: 100%;
        display: block;
    }

    .side-submenu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px 12px 50px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border-left: 2px solid transparent;
        width: 100%;
        box-sizing: border-box;
        direction: ltr;
    }

    [dir="rtl"] .side-submenu li a {
        direction: rtl;
        padding: 12px 50px 12px 20px;
        border-left: none;
        border-right: 2px solid transparent;
        justify-content: flex-end;
        text-align: right;
    }

    .side-submenu li a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background: var(--colorPrimary, #c8b47e);
        transition: width 0.3s ease;
    }

    [dir="rtl"] .side-submenu li a::before {
        left: auto;
        right: 0;
    }

    .side-submenu li a i {
        color: var(--colorPrimary, #c8b47e);
        font-size: 14px;
        width: 16px;
        min-width: 16px;
        text-align: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    [dir="rtl"] .side-submenu li a i {
        order: 2;
        margin-left: 8px;
        margin-right: 0;
    }

    .side-submenu li a span {
        flex: 1;
        text-align: left;
    }

    [dir="rtl"] .side-submenu li a span {
        text-align: right;
        order: 1;
        justify-content: flex-end;
    }

    /* RTL: Ensure submenu links are right-aligned with text on right, icons on left */
    [dir="rtl"] .side-submenu li a {
        justify-content: flex-end;
        text-align: right;
        flex-direction: row-reverse;
    }

    .side-submenu li a:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary, #c8b47e);
        padding-left: 54px;
        border-left-color: var(--colorPrimary, #c8b47e);
    }

    [dir="rtl"] .side-submenu li a:hover {
        padding-left: 20px;
        padding-right: 54px;
        border-left: none;
        border-right-color: var(--colorPrimary, #c8b47e);
    }

    .side-submenu li a:hover::before {
        width: 3px;
    }

    .side-submenu li a:hover i {
        transform: translateX(2px) scale(1.1);
    }

    [dir="rtl"] .side-submenu li a:hover i {
        transform: translateX(-2px) scale(1.1);
    }

    /* Appointment Button - Show After Main Menu Items */
    .appointment-item {
        margin-top: 20px;
        border-top: 2px solid #e8e8e8;
        border-bottom: none;
        background: linear-gradient(180deg, #fafafa 0%, #f5f5f5 100%);
        padding: 20px 0;
        position: relative;
        width: 100%;
        display: block;
    }

    .appointment-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--colorPrimary, #c8b47e), transparent);
    }

    .appointment-link {
        background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, var(--colorSecondary, #6b5d47) 100%) !important;
        color: #fff !important;
        border-radius: 12px;
        margin: 0 20px;
        padding: 16px 24px;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 6px 20px rgba(107, 93, 71, 0.4) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none !important;
        position: relative;
        overflow: hidden;
        width: calc(100% - 40px);
        box-sizing: border-box;
        display: flex;
        gap: 10px;
        direction: ltr;
    }

    [dir="rtl"] .appointment-link {
        direction: rtl;
    }

    .appointment-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .appointment-link:hover::before {
        left: 100%;
    }

    .appointment-link i {
        color: #fff !important;
        font-size: 18px;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    [dir="rtl"] .appointment-link i {
        order: 2;
    }

    .appointment-link span {
        text-align: center;
    }
    
    .appointment-link:hover {
        background: linear-gradient(135deg, var(--colorSecondary, #6b5d47) 0%, var(--colorPrimary, #c8b47e) 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 93, 71, 0.5) !important;
    }

    .appointment-link:hover i {
        transform: scale(1.1) rotate(5deg);
    }

    /* Header Items in Side Menu - Show After Main Menu */
    .side-menu-header-items {
        padding: 20px;
        border-top: 2px solid #e8e8e8;
        border-bottom: none;
        background: linear-gradient(180deg, #fafafa 0%, #f5f5f5 100%);
        order: 2;
        margin-top: auto;
        position: relative;
    }

    .side-menu-header-items::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--colorPrimary, #c8b47e), transparent);
    }

    .side-menu-header-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        color: #2c3e50;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 10px;
        margin-bottom: 10px;
        background: #fff;
        border: 2px solid #e8e8e8;
        position: relative;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .side-menu-header-link:last-child {
        margin-bottom: 0;
    }

    .side-menu-header-link i {
        color: var(--colorPrimary, #c8b47e);
        font-size: 18px;
        width: 22px;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* RTL: Text on the right, icons close to text on left */
    [dir="rtl"] .side-menu-header-link {
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 8px;
        margin-bottom: 6px;
    }

    [dir="rtl"] .side-menu-header-link i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    [dir="rtl"] .side-menu-header-link span {
        order: 1;
        text-align: right;
    }

    /* LTR content detection for phone/email - icons on right, text on left */
    [dir="rtl"] .side-menu-header-link[href^="tel:"],
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] {
        flex-direction: row;
        gap: 8px;
    }

    [dir="rtl"] .side-menu-header-link[href^="tel:"] i,
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] i {
        order: 1;
        margin-right: 0;
    }

    [dir="rtl"] .side-menu-header-link[href^="tel:"] span,
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] span {
        order: 2;
        direction: ltr;
        text-align: left;
        margin-left: 8px;
    }

    .side-menu-header-link:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.12) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary, #c8b47e);
        border-color: var(--colorPrimary, #c8b47e);
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(200, 180, 126, 0.2);
    }

    .side-menu-header-link:hover i {
        transform: scale(1.15);
        color: var(--colorPrimary, #c8b47e);
    }

    .side-menu-badge {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--colorPrimary);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    .side-menu-selectors {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .side-menu-form {
        width: 100%;
    }

    .side-menu-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e8e8e8;
        border-radius: 10px;
        background: #fff;
        color: #2c3e50;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .side-menu-select:focus {
        outline: none;
        border-color: var(--colorPrimary, #c8b47e);
        box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15), 0 4px 10px rgba(200, 180, 126, 0.2);
        transform: translateY(-1px);
    }

    .side-menu-select:hover {
        border-color: var(--colorPrimary, #c8b47e);
        box-shadow: 0 2px 8px rgba(200, 180, 126, 0.15);
    }

    .appointment-link:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* RTL Support */
    @php
        $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'ltr');
    @endphp
    @if ($textDirection == 'rtl')
        .side-menu-content {
            right: auto;
            left: -100%;
        }
        .mobile-side-menu.active .side-menu-content {
            left: 0;
            right: auto;
        }
        .appointment-btn-wrapper {
            margin-left: 0;
            margin-right: 15px;
        }
        
        /* RTL: البرجر منيو في أقصى اليمين */
        @media (max-width: 991px) {
            body.client-frontend .mobile-menu-toggle {
                order: 1;
                margin-right: 0;
                margin-left: 30px;
            }
            .navbar-logo {
                order: 0;
                margin-right: 0;
                margin-left: auto;
            }
            .navbar-wrapper {
                justify-content: flex-start !important;
                gap: 30px;
            }
        }
    @endif

    @if ($setting->tawk_status != 'active')
        .scroll-top {
            bottom: 26px;
        }
    @endif

    /* Mobile App Section - Stay on top of your case */
    .mobile-app-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        position: relative;
        overflow: hidden;
    }

    .mobile-app-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.05) 0%, rgba(241, 99, 76, 0.05) 100%);
        pointer-events: none;
    }

    .mobile-app-content {
        position: relative;
        z-index: 1;
    }

    .mobile-app-content .title {
        color: var(--colorBlack) !important;
        font-size: 42px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 20px;
    }

    .mobile-app-content .title span {
        color: var(--colorPrimary) !important;
        display: block;
    }

    .mobile-app-content p {
        color: #555 !important;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .app-features .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .app-features .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    }

    .app-features .feature-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 12px;
        color: #fff;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
    }

    .app-features .feature-text h4 {
        color: var(--colorBlack) !important;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .app-features .feature-text p {
        color: #666 !important;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
    }

    .app-download-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 35px;
        justify-content: flex-start;
    }
    
    @media (max-width: 768px) {
        .app-download-buttons {
            flex-direction: column;
            gap: 15px;
        }
    }

    .app-download-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 16px 32px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        color: #fff !important;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.35);
        border: 2px solid transparent;
        min-width: 200px;
        position: relative;
        overflow: hidden;
    }
    
    .app-download-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .app-download-btn:hover::before {
        left: 100%;
    }

    .app-download-btn:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.5);
        color: #fff !important;
    }
    
    .app-download-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 3px 12px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.4);
    }
    
    .app-download-btn i {
        font-size: 18px;
        transition: transform 0.3s ease;
    }
    
    .app-download-btn:hover i {
        transform: scale(1.15);
    }
    
    .app-download-btn .btn-text {
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .app-download-btn img {
        height: 30px;
        width: auto;
    }
    
    /* Mobile responsive */
    @media (max-width: 768px) {
        .app-download-btn {
            width: 100%;
            min-width: 100%;
            padding: 18px 24px;
            font-size: 16px;
        }
        
        .app-download-buttons {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .mobile-app-content .title {
            font-size: 32px;
        }

        .app-features .feature-item {
            padding: 15px;
        }

        .app-features .feature-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            font-size: 20px;
        }
    }

    /* Mobile Menu Fix - Ensure it's hidden by default */
    .mobile-menu {
        display: none;
    }

    @media (max-width: 991px) {
        .mobile-menu {
            display: block;
        }
    }

    .mobile-menu .sidenav {
        width: 0 !important;
        overflow-x: hidden;
        transition: width 0.3s ease;
        background-color: #111 !important;
    }

    .mobile-menu .sidenav.show {
        width: 100% !important;
    }

    /* Ensure modals are properly hidden */
    .modal {
        display: none !important;
    }

    /* WhatsApp Floating Button */
    .whatsapp-float {
        position: fixed;
        width: 52px;
        height: 52px;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #fff;
        border-radius: 50%;
        text-align: center;
        font-size: 26px;
        box-shadow: 0 3px 15px rgba(37, 211, 102, 0.3);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        animation: pulse-whatsapp 2s infinite;
    }

    .whatsapp-float:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
        background: linear-gradient(135deg, #128C7E 0%, #25D366 100%);
    }

    .whatsapp-float i {
        color: #fff;
        font-size: 32px;
        line-height: 1;
    }

    .whatsapp-tooltip {
        position: absolute;
        right: 70px;
        top: 50%;
        transform: translateY(-50%);
        background: #333;
        color: #fff;
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        pointer-events: none;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .whatsapp-tooltip::after {
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        border: 6px solid transparent;
        border-left-color: #333;
    }

    .whatsapp-float:hover .whatsapp-tooltip {
        opacity: 1;
        visibility: visible;
        right: 75px;
    }

    @keyframes pulse-whatsapp {
        0% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        }
        50% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4), 0 0 0 10px rgba(37, 211, 102, 0.1);
        }
        100% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        }
    }

    /* Responsive WhatsApp Button */
    @media (max-width: 768px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 18px;
            right: 18px;
            font-size: 25px;
        }

        .whatsapp-float i {
            font-size: 25px;
        }

        .whatsapp-tooltip {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .whatsapp-float {
            width: 48px;
            height: 48px;
            bottom: 16px;
            right: 16px;
            font-size: 24px;
        }

        .whatsapp-float i {
            font-size: 24px;
        }
    }

    /* Safe Area for Mobile Browsers */
    @media (max-width: 768px) {
        body {
            padding-bottom: env(safe-area-inset-bottom, 0);
        }

        .footer-copyrignt {
            padding-bottom: calc(20px + env(safe-area-inset-bottom, 0));
            margin-bottom: 0;
        }

        .main-footer {
            margin-bottom: 0;
        }

        .scroll-top {
            bottom: calc(25px + env(safe-area-inset-bottom, 0));
        }

        .whatsapp-float {
            bottom: calc(16px + env(safe-area-inset-bottom, 0));
        }
    }

    .modal.show,
    .modal.in,
    .modal.fade.show {
        display: block !important;
    }

    .modal-backdrop {
        display: none !important;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal.show .modal-backdrop,
    .modal.in .modal-backdrop,
    .modal.fade.show ~ .modal-backdrop {
        display: block !important;
    }

    /* Fix any white overlays - Remove any unwanted white backgrounds */
    body.modal-open {
        overflow: hidden;
    }

    /* Remove any fixed white overlays */
    body > div[style*="background"][style*="white"],
    body > div[style*="background-color: white"],
    body > div[style*="background-color:#fff"],
    body > div[style*="background-color:#ffffff"] {
        display: none !important;
    }

    /* Ensure no unwanted fixed elements */
    .fixed-overlay,
    .white-overlay,
    .sidebar-overlay {
        display: none !important;
    }

    /* ============================================
       Responsive Design Improvements
       ============================================ */

    /* Tablet and Below (991px) */
    /* ============================================
       Lawyer Card - Clickable Design
       ============================================ */

    /* Make entire card clickable */
    .team-item-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .team-item-link:hover {
        text-decoration: none;
        color: inherit;
        transform: translateY(-5px);
    }

    .team-item-link:hover .team-item {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border-color: var(--colorPrimary);
    }

    /* Team Item Enhanced Design */
    .team-item {
        overflow: hidden;
        position: relative;
        border: 2px solid #eee;
        border-radius: 12px;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .team-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        border-color: var(--colorPrimary);
    }

    /* Team Photo with Overlay */
    .team-photo {
        overflow: hidden;
        position: relative;
        height: 280px;
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    }

    .team-photo img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.5s ease;
    }

    .team-item:hover .team-photo img {
        transform: scale(1.1);
    }

    /* Overlay with View Profile Button */
    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.9) 0%, rgba(241, 99, 76, 0.9) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 2;
    }

    .team-item:hover .team-overlay {
        opacity: 1;
        visibility: visible;
    }

    .view-profile-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .team-item:hover .view-profile-btn {
        transform: translateY(0);
    }

    .view-profile-btn i {
        font-size: 32px;
        margin-bottom: 5px;
        animation: pulse-icon 2s infinite;
    }

    @keyframes pulse-icon {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    .view-profile-btn span {
        font-size: 14px;
        opacity: 0.95;
    }

    /* Team Text Enhanced */
    .team-text {
        text-align: left;
        padding: 20px 25px;
        background: var(--colorWhite);
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    /* دعم RTL - محاذاة كاملة لليمين في العربية */
    [dir="rtl"] .team-text {
        text-align: right;
        direction: rtl;
    }

    .team-name {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--colorBlack);
        transition: color 0.3s ease;
        text-align: center;
        line-height: 1.3;
    }

    /* دعم RTL للاسم */
    [dir="rtl"] .team-name {
        text-align: center;
    }

    .team-item:hover .team-name {
        color: var(--colorPrimary);
    }

    .team-text p {
        font-size: 14px;
        margin: 8px 0;
        color: #666;
        display: flex;
        align-items: center;
        gap: 10px;
        direction: ltr;
        text-align: left;
        justify-content: flex-start;
    }

    /* دعم RTL للنصوص - محاذاة لليمين في العربية */
    [dir="rtl"] .team-text p {
        direction: rtl;
        text-align: right;
        justify-content: flex-end;
        flex-direction: row-reverse;
    }

    .team-text p i {
        color: var(--colorPrimary);
        font-size: 16px;
        width: 20px;
        min-width: 20px;
        text-align: center;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* في LTR: الأيقونات على اليسار */
    .team-text p i.fa-briefcase,
    .team-text p i.fa-graduation-cap,
    .team-text p i.fa-street-view {
        order: -1;
    }

    /* في RTL: الأيقونات على اليمين */
    [dir="rtl"] .team-text p i.fa-briefcase,
    [dir="rtl"] .team-text p i.fa-graduation-cap,
    [dir="rtl"] .team-text p i.fa-street-view {
        order: 1;
        margin-left: 0;
        margin-right: 0;
    }

    /* ضمان أن النص يبدأ بعد الأيقونة مباشرة في RTL */
    [dir="rtl"] .team-text p {
        text-align: right;
    }

    [dir="rtl"] .team-text p span {
        text-align: right;
    }

    .team-text span {
        color: var(--colorPrimary);
        display: inline;
    }

    .team-text span b {
        font-weight: 500;
        color: #666;
    }

    /* تحسين محاذاة التقييمات */
    .team-text .mt-2 {
        margin-top: 15px !important;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: flex-start;
        direction: ltr;
    }

    /* في RTL: محاذاة التقييمات لليمين */
    [dir="rtl"] .team-text .mt-2 {
        justify-content: flex-end;
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .team-text .mt-2 span {
        text-align: right;
    }

    .team-text .mt-2 span {
        font-size: 12px;
        color: #666;
        display: inline-flex;
        align-items: center;
    }

    /* ضمان أن النجوم والتقييم في نفس السطر */
    .team-text .mt-2 .stars,
    .team-text .mt-2 .fa-star {
        display: inline-flex;
        align-items: center;
    }

    /* Action Icon - Arrow */
    .team-action-icon {
        position: absolute;
        bottom: 20px;
        left: 25px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
    }

    /* في RTL: نقل الأيقونة لليمين */
    [dir="rtl"] .team-action-icon {
        left: auto;
        right: 25px;
        transform: translateX(10px);
    }

    .team-item:hover .team-action-icon {
        opacity: 1;
        transform: translateX(0);
    }

    [dir="rtl"] .team-item:hover .team-action-icon {
        transform: translateX(0);
    }

    .team-item:hover .team-action-icon i {
        animation: arrow-bounce 1s infinite;
    }

    @keyframes arrow-bounce {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(3px);
        }
    }

    /* Remove old photo overlay */
    .team-photo:after {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .team-photo {
            height: 240px;
        }

        .view-profile-btn {
            font-size: 14px;
        }

        .view-profile-btn i {
            font-size: 28px;
        }

        .team-action-icon {
            width: 35px;
            height: 35px;
            font-size: 14px;
        }
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */

    @media (max-width: 991px) {
        /* Hide desktop menu, show mobile toggle */
        .navbar-menu {
            display: none !important;
        }

        body.client-frontend .mobile-menu-toggle {
            display: flex !important;
            order: -1;
            margin-right: 30px;
            margin-left: 0;
        }

        .mobile-side-menu {
            display: block !important;
        }

        /* إعادة ترتيب العناصر في الموبايل - البرجر منيو في أقصى اليسار */
        .navbar-wrapper {
            justify-content: flex-start !important;
            gap: 30px;
        }

        .navbar-logo {
            order: 0;
            margin-right: auto;
            margin-left: 0;
        }

        .navbar-menu {
            order: 1;
        }

        /* Adjust header bar for tablet */
        .header-bar-content {
            justify-content: center;
            gap: 10px;
        }

        .header-left,
        .header-right {
            gap: 15px;
        }

        .header-contact-item span {
            display: none;
        }

        .alert-content {
            padding: 0 35px;
        }

        .alert-text {
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        /* Top Alert Banner */
        .top-alert-banner {
            padding: 10px 0;
        }

        .alert-content {
            padding: 0 30px;
        }

        .alert-text {
            font-size: 12px;
        }

        .alert-close-btn {
            width: 24px;
            height: 24px;
            right: 10px;
            font-size: 12px;
        }

        /* Hide Header Bar on Mobile - Move to Side Menu */
        .top-header-bar {
            display: none !important;
        }

        /* Main Navbar */
        .navbar-wrapper {
            padding: 12px 18px;
            min-height: 65px;
        }

        body.client-frontend .navbar-logo img {
            max-height: 42px !important;
            max-width: 180px !important;
        }

        body.client-frontend .mobile-menu-toggle {
            width: 42px;
            height: 42px;
        }

        .navbar-logo img {
            max-height: 40px !important;
            max-width: 160px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
        }

        body.client-frontend .mobile-menu-toggle {
            display: flex !important;
            width: 38px;
            height: 38px;
            order: -1;
            margin-right: 25px;
            margin-left: 0;
            align-self: center;
        }

        body.client-frontend .mobile-menu-toggle span {
            width: 22px;
            height: 2.5px;
        }

        /* إعادة ترتيب العناصر في الموبايل */
        .navbar-wrapper {
            justify-content: flex-start !important;
            gap: 30px;
        }

        .navbar-logo {
            order: 0;
            margin-right: auto;
            margin-left: 0;
        }

        .navbar-menu {
            order: 1;
        }

        /* Side Menu - Enhanced Design */
        .side-menu-content {
            width: 320px;
            max-width: 85vw;
        }

        .side-menu-header {
            padding: 18px 20px;
        }

        .side-menu-logo img {
            max-height: 40px !important;
            max-width: 160px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
        }

        /* Header Items in Side Menu */
        .side-menu-header-items {
            padding: 15px 20px;
        }

        .side-menu-header-link {
            padding: 12px 15px;
            font-size: 14px;
        }

        .side-menu-select {
            font-size: 14px;
            padding: 10px 15px;
        }

        .side-menu-link {
            padding: 14px 20px;
            font-size: 15px;
        }

        .side-submenu li a {
            padding: 12px 20px 12px 50px;
            font-size: 14px;
        }

        /* Improve overall mobile design */
        body.client-frontend {
            font-size: 15px;
        }

        h1 {
            font-size: 28px;
            line-height: 1.3;
        }

        h2 {
            font-size: 24px;
            line-height: 1.3;
        }

        h3 {
            font-size: 20px;
            line-height: 1.3;
        }

        /* Better spacing on mobile */
        .container,
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Improve cards on mobile */
        .card {
            margin-bottom: 20px;
            border-radius: 12px;
        }

        .card-body {
            padding: 20px;
        }

        /* Better buttons on mobile */
        .btn {
            padding: 12px 24px;
            font-size: 15px;
            min-height: 48px;
            border-radius: 8px;
        }

        /* Better forms on mobile */
        .form-control,
        .form-select {
            font-size: 16px;
            padding: 12px 15px;
            border-radius: 8px;
        }
    }

    @media (max-width: 480px) {
        .alert-text {
            font-size: 11px;
            padding-right: 25px;
        }

        /* Main Navbar */
        .navbar-wrapper {
            padding: 10px 12px;
        }

        .navbar-logo img {
            max-height: 35px !important;
            max-width: 140px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
        }

        /* Side Menu - Smaller screens */
        .side-menu-content {
            width: 100%;
            max-width: 100vw;
        }

        .side-menu-header {
            padding: 15px;
        }

        .side-menu-logo img {
            max-height: 35px !important;
            max-width: 140px !important;
        }

        .side-menu-header-items {
            padding: 12px 15px;
        }

        .side-menu-header-link {
            padding: 10px 12px;
            font-size: 13px;
        }

        .side-menu-select {
            font-size: 13px;
            padding: 10px 12px;
        }

        .side-menu-link {
            padding: 12px 15px;
            font-size: 14px;
        }

        .side-submenu li a {
            padding: 10px 15px 10px 45px;
            font-size: 13px;
        }

        /* Improve typography on small screens */
        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 20px;
        }

        h3 {
            font-size: 18px;
        }

        /* Better spacing */
        .container,
        .container-fluid {
            padding-left: 12px;
            padding-right: 12px;
        }

        .card-body {
            padding: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            min-height: 44px;
        }
    }

    /* Improve tables on mobile */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        font-size: 14px;
    }

    table th,
    table td {
        padding: 8px 10px;
        white-space: nowrap;
    }

    /* Improve forms on mobile */
    .form-control,
    .form-select {
        font-size: 16px; /* Prevents zoom on iOS */
        padding: 10px 15px;
    }

    /* Improve buttons on mobile */
    .btn {
        padding: 10px 20px;
        font-size: 14px;
        min-height: 44px; /* Better touch target */
    }

    /* Improve cards on mobile */
    .card {
        margin-bottom: 20px;
    }

    .card-body {
        padding: 15px;
    }

    /* Mobile (768px and below) */
    @media (max-width: 768px) {
        /* Header improvements */
        .header-area {
            padding: 8px 0;
        }

        .header-info ul li {
            font-size: 12px;
            margin-left: 15px;
        }

        .header-info ul li i {
            font-size: 14px;
        }

        /* Menu area improvements */
        .menu-area .row {
            padding: 10px 0;
        }

        .logo img {
            max-height: 40px;
        }

        /* Mobile menu icon */
        .mobile-menuicon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .mobile-menuicon .menu-bar {
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        /* Improve typography */
        h1 {
            font-size: 28px;
            line-height: 1.3;
        }

        h2 {
            font-size: 24px;
            line-height: 1.3;
        }

        h3 {
            font-size: 20px;
            line-height: 1.3;
        }

        /* Improve spacing */
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .section-padding {
            padding: 40px 0;
        }

        /* Improve tables - make them scrollable */
        .table-responsive {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        table {
            min-width: 600px;
        }

        /* Stack form elements */
        .row > [class*="col-"] {
            margin-bottom: 15px;
        }

        /* Improve modals */
        .modal-dialog {
            margin: 10px;
            max-width: calc(100% - 20px);
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 15px;
        }

        /* Improve dropdowns */
        .dropdown-menu {
            max-width: calc(100vw - 30px);
            left: 15px !important;
            right: 15px !important;
        }
    }

    /* Small Mobile (480px and below) */
    @media (max-width: 480px) {
        /* Further reduce font sizes */
        body {
            font-size: 14px;
        }

        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 20px;
        }

        h3 {
            font-size: 18px;
        }

        /* Compact header */
        .header-info ul {
            gap: 10px;
        }

        .header-info ul li {
            font-size: 11px;
            margin-left: 10px;
        }

        /* Compact buttons */
        .btn {
            padding: 8px 16px;
            font-size: 13px;
        }

        .btn-lg {
            padding: 10px 20px;
            font-size: 14px;
        }

        /* Compact forms */
        .form-control,
        .form-select {
            padding: 8px 12px;
            font-size: 16px;
        }

        /* Compact cards */
        .card-body {
            padding: 12px;
        }

        /* Compact tables */
        table {
            font-size: 12px;
        }

        table th,
        table td {
            padding: 6px 8px;
        }

        /* Full width buttons on small screens */
        .btn-group-vertical .btn,
        .btn-block {
            width: 100%;
            margin-bottom: 10px;
        }

        /* Improve spacing */
        .mb-3,
        .mb-4,
        .mb-5 {
            margin-bottom: 15px !important;
        }

        .mt-3,
        .mt-4,
        .mt-5 {
            margin-top: 15px !important;
        }

        .p-3,
        .p-4,
        .p-5 {
            padding: 15px !important;
        }
    }

    /* Landscape orientation improvements */
    @media (max-width: 991px) and (orientation: landscape) {
        .header-area {
            padding: 5px 0;
        }

        .menu-area .row {
            padding: 8px 0;
        }
    }

    /* Touch device improvements */
    @media (hover: none) and (pointer: coarse) {
        /* Larger touch targets */
        a,
        button,
        .btn,
        input[type="button"],
        input[type="submit"] {
            min-height: 44px;
            min-width: 44px;
        }

        /* Remove hover effects on touch devices */
        a:hover,
        button:hover {
            opacity: 1;
        }

        /* Improve focus states */
        a:focus,
        button:focus,
        input:focus {
            outline: 2px solid var(--colorPrimary);
            outline-offset: 2px;
        }
    }

    /* ============================================
       REGISTER PAGE - MODERN DESIGN IMPROVEMENTS
       ============================================ */

    /* Register Area Container */
    .register-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 300px);
        padding: 60px 0 !important;
        display: flex;
        align-items: center;
    }
    
    /* Login Area Container */
    .login-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 300px);
        padding: 60px 0 !important;
        display: flex;
        align-items: center;
    }

    /* Banner Area for Register Page */
    .register-area + .banner-area,
    .banner-area {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        padding: 40px 0;
        position: relative;
        overflow: hidden;
    }

    .banner-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .banner-text {
        position: relative;
        z-index: 1;
    }

    .banner-text h1 {
        color: #fff;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .banner-text ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .banner-text ul li {
        color: rgba(255,255,255,0.9);
        font-size: 15px;
    }

    .banner-text ul li a {
        color: rgba(255,255,255,0.9);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .banner-text ul li a:hover {
        color: #fff;
    }

    .banner-text ul li span {
        color: rgba(255,255,255,0.7);
    }

    /* ============================================
       LOGIN & REGISTER - PROFESSIONAL FRAMED DESIGN
       ============================================ */
    
    .login-area,
    .register-area {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        padding: 80px 20px !important;
        position: relative;
        overflow: hidden;
    }
    
    .login-area .container,
    .register-area .container {
        width: 100%;
        max-width: 1200px;
        position: relative;
        z-index: 1;
    }
    
    .login-area .row,
    .register-area .row {
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Professional Framed Card */
    .login_area_bg {
        background: #ffffff;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.08),
            0 2px 8px rgba(0, 0, 0, 0.04);
        padding: 60px 50px !important;
        border-radius: 20px !important;
        border: 1px solid #e8e8e8;
        position: relative;
        overflow: visible;
        transition: all 0.3s ease;
        max-width: 100%;
        width: 100%;
        animation: fadeInUp 0.6s ease-out;
    }
    
    /* Decorative Frame Elements - Full Border */
    .login_area_bg::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, 
            rgba(200, 180, 126, 0.3) 0%, 
            rgba(241, 99, 76, 0.3) 50%,
            rgba(200, 180, 126, 0.3) 100%);
        border-radius: 22px;
        pointer-events: none;
        z-index: -1;
    }
    
    /* Add subtle animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .login_area_bg:hover {
        box-shadow: 
            0 15px 50px rgba(0, 0, 0, 0.12),
            0 3px 12px rgba(0, 0, 0, 0.06);
        transform: translateY(-2px);
    }
    
    .login_area_bg:hover::before {
        background: linear-gradient(135deg, 
            rgba(200, 180, 126, 0.4) 0%, 
            rgba(241, 99, 76, 0.4) 50%,
            rgba(200, 180, 126, 0.4) 100%);
    }

    /* Tab Navigation - Premium Design */
    .login_area_bg .nav-pills {
        margin-bottom: 35px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 15px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 18px;
        width: 100%;
        position: relative;
    }
    
    .login_area_bg .nav-pills::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transition: width 0.3s ease;
    }

    .login_area_bg .nav-pills .nav-item {
        width: auto;
        flex: 0 0 auto;
        max-width: 220px;
        min-width: 160px;
    }

    .login_area_bg .nav-pills .nav-item .nav-link {
        width: 100%;
        color: #666 !important;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 22px;
        background: #ffffff !important;
        position: relative;
        text-align: center;
        display: block;
        overflow: hidden;
    }
    
    .login_area_bg .nav-pills .nav-item .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .login_area_bg .nav-pills .nav-item .nav-link:hover {
        color: var(--colorPrimary) !important;
        background: rgba(200, 180, 126, 0.08) !important;
        border-color: var(--colorPrimary);
    }
    
    .login_area_bg .nav-pills .nav-item .nav-link:hover::before {
        left: 100%;
    }

    .login_area_bg .nav-pills .nav-item .nav-link.active {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        color: #fff !important;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(200, 180, 126, 0.25);
    }
    
    .login_area_bg .nav-pills .nav-item .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 3px;
        background: var(--colorPrimary);
        border-radius: 2px;
    }

    .login_area_bg .nav-pills .nav-item .nav-link:not(.active) {
        color: #555 !important;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
    }

    /* Title in Register Form */
    .login_area_bg h4 {
        text-align: center;
        color: var(--colorPrimary);
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }

    /* Form Inputs - Modern Design */
    .login_area_bg form,
    .regiser-form.login-form {
        margin-top: 20px;
    }

    .login_area_bg form .form-row,
    .regiser-form.login-form .form-row {
        margin: 0;
    }

    .login_area_bg form label,
    .regiser-form.login-form label {
        color: #2c3e50;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 12px;
        display: block;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 12px;
        position: relative;
        padding-left: 8px;
    }
    
    .login_area_bg form label::before,
    .regiser-form.login-form label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 16px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 2px;
    }

    .login_area_bg form input[type="text"],
    .login_area_bg form input[type="email"],
    .login_area_bg form input[type="password"],
    .login_area_bg form input[type="tel"],
    .login_area_bg form .form-control,
    .regiser-form.login-form input[type="text"],
    .regiser-form.login-form input[type="email"],
    .regiser-form.login-form input[type="password"],
    .regiser-form.login-form input[type="tel"],
    .regiser-form.login-form .form-control {
        border: 1.5px solid #e0e0e0;
        height: 55px;
        margin-bottom: 22px !important;
        border-radius: 12px;
        padding: 14px 20px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #333;
        width: 100%;
        font-weight: 400;
        position: relative;
    }
    
    .login_area_bg form input::placeholder,
    .regiser-form.login-form input::placeholder {
        color: #aaa;
        font-weight: 400;
        transition: all 0.3s ease;
    }
    
    .login_area_bg form input:focus::placeholder,
    .regiser-form.login-form input:focus::placeholder {
        color: #ccc;
        transform: translateX(5px);
    }

    .login_area_bg form input:focus,
    .login_area_bg form .form-control:focus,
    .regiser-form.login-form input:focus,
    .regiser-form.login-form .form-control:focus {
        border-color: var(--colorPrimary);
        background: #fff;
        box-shadow: 
            0 0 0 3px rgba(200, 180, 126, 0.1), 
            0 2px 8px rgba(200, 180, 126, 0.08);
        outline: none;
    }

    /* Select Dropdowns - Premium Design */
    .login_area_bg .select2-container--default .select2-selection--single {
        border: 2px solid #e8e8e8;
        border-radius: 14px;
        height: 58px;
        line-height: 58px;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }

    .login_area_bg .select2-container--default .select2-selection--single:focus,
    .login_area_bg .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: var(--colorPrimary);
        background: #fff;
        box-shadow: 
            0 0 0 5px rgba(200, 180, 126, 0.15), 
            0 6px 20px rgba(200, 180, 126, 0.15),
            inset 0 1px 3px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    .login_area_bg .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 58px;
        padding-left: 24px;
        color: #333;
        font-size: 15px;
        font-weight: 500;
    }
    
    .login_area_bg .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 58px;
        right: 20px;
    }

    .login_area_bg .select2-container {
        margin-bottom: 25px !important;
    }

    /* Submit Button - Premium Design */
    .login_area_bg form button[type="submit"],
    .login_area_bg form .btn-primary,
    .regiser-form.login-form button[type="submit"],
    .regiser-form.login-form .btn-primary {
        width: 100%;
        border-radius: 14px;
        margin-top: 20px !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        margin-bottom: 25px;
        border: none;
        padding: 18px 35px;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 
            0 8px 25px rgba(200, 180, 126, 0.4),
            0 0 0 0 rgba(200, 180, 126, 0.5);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    
    .login_area_bg form button[type="submit"]::before,
    .regiser-form.login-form button[type="submit"]::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }
    
    .login_area_bg form button[type="submit"]::after,
    .regiser-form.login-form button[type="submit"]::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .login_area_bg form button[type="submit"]:hover::before,
    .regiser-form.login-form button[type="submit"]:hover::before {
        left: 100%;
    }
    
    .login_area_bg form button[type="submit"]:active::after,
    .regiser-form.login-form button[type="submit"]:active::after {
        width: 300px;
        height: 300px;
    }

    .login_area_bg form button[type="submit"]:hover,
    .login_area_bg form .btn-primary:hover,
    .regiser-form.login-form button[type="submit"]:hover,
    .regiser-form.login-form .btn-primary:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
        transform: translateY(-2px);
        box-shadow: 
            0 8px 25px rgba(200, 180, 126, 0.35),
            0 0 0 3px rgba(200, 180, 126, 0.15);
    }
    
    .login_area_bg form button[type="submit"]:active,
    .regiser-form.login-form button[type="submit"]:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* Link to Login - Premium Design */
    .login_area_bg form p,
    .regiser-form.login-form p {
        text-align: center;
        margin-top: 25px;
        margin-bottom: 0;
        color: #555;
        font-size: 15px;
        font-weight: 500;
    }

    .login_area_bg form p a.link,
    .regiser-form.login-form p a.link {
        color: var(--colorPrimary);
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        border-bottom: 2px solid transparent;
        position: relative;
        padding-bottom: 2px;
    }
    
    .login_area_bg form p a.link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transition: width 0.3s ease;
    }

    .login_area_bg form p a.link:hover,
    .regiser-form.login-form p a.link:hover {
        color: var(--colorSecondary);
    }
    
    .login_area_bg form p a.link:hover::after,
    .regiser-form.login-form p a.link:hover::after {
        width: 100%;
    }

    /* Google Login Button - Premium Design */
    .account__social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        width: 100%;
        padding: 16px 24px;
        border: 2px solid #e8e8e8;
        border-radius: 14px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: #333;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    
    .account__social-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(200, 180, 126, 0.1), transparent);
        transition: left 0.5s;
    }

    .account__social-btn:hover {
        border-color: var(--colorPrimary);
        background: linear-gradient(135deg, rgba(200, 180, 126, 0.08) 0%, rgba(241, 99, 76, 0.08) 100%);
        color: var(--colorPrimary);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(200, 180, 126, 0.2);
    }
    
    .account__social-btn:hover::before {
        left: 100%;
    }
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .account__social-btn img {
        width: 20px;
        height: 20px;
    }
    
    /* WhatsApp Button Special Styling */
    .account__social-btn--whatsapp {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%) !important;
        color: #fff !important;
        border-color: #25D366 !important;
    }
    
    .account__social-btn--whatsapp:hover {
        background: linear-gradient(135deg, #128C7E 0%, #25D366 100%) !important;
        border-color: #128C7E !important;
        color: #fff !important;
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3) !important;
    }
    
    .account__social-btn--whatsapp::before {
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    /* Divider */
    /* Divider - Premium Design */
    .account__divider {
        text-align: center;
        margin: 20px 0 25px 0;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .account__divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        width: 100%;
        height: 1px;
        background: #e0e0e0;
        transform: translateY(-50%);
    }

    .account__divider span {
        position: absolute;
        background: #ffffff;
        padding: 6px 16px;
        color: #888;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        display: inline-block;
        z-index: 2;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
    }

    /* Recaptcha - Premium Design */
    .login_area_bg .g-recaptcha {
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        padding: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 14px;
        border: 2px solid #e8e8e8;
        transition: all 0.3s ease;
    }
    
    .login_area_bg .g-recaptcha:hover {
        border-color: var(--colorPrimary);
        box-shadow: 0 4px 12px rgba(200, 180, 126, 0.1);
    }

    /* Error Messages - Premium Design */
    .login_area_bg .text-danger,
    .regiser-form.login-form .text-danger {
        color: #dc3545;
        font-size: 13px;
        font-weight: 600;
        margin-top: -20px;
        margin-bottom: 18px;
        display: block;
        padding: 8px 12px;
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
        border-left: 3px solid #dc3545;
        border-radius: 6px;
        animation: shake 0.5s ease;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Remember Me & Checkbox Styling */
    /* Remember Me & Forgot Password - Premium Design */
    .login_area_bg .remember,
    .regiser-form.login-form .remember {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
        padding: 15px 0;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .login_area_bg .form-check,
    .regiser-form.login-form .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .login_area_bg .form-check-input {
        width: 20px;
        height: 20px;
        border: 2px solid #d0d0d0;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin: 0;
        flex-shrink: 0;
        background: #fff;
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .login_area_bg .form-check-input:checked {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-color: var(--colorPrimary);
        box-shadow: 0 0 0 4px rgba(200, 180, 126, 0.2), inset 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .login_area_bg .form-check-input:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 14px;
        font-weight: 900;
        line-height: 1;
    }
    
    .login_area_bg .form-check-input:focus {
        box-shadow: 0 0 0 5px rgba(200, 180, 126, 0.25);
        border-color: var(--colorPrimary);
        transform: scale(1.1);
    }
    
    .login_area_bg .form-check-input:hover {
        border-color: var(--colorPrimary);
        transform: scale(1.05);
    }
    
    .login_area_bg .form-check-label {
        color: #555;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin: 0;
        user-select: none;
        transition: color 0.3s ease;
    }
    
    .login_area_bg .form-check:hover .form-check-label {
        color: var(--colorPrimary);
    }
    
    .login_area_bg .link {
        color: var(--colorPrimary);
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        padding-bottom: 2px;
    }
    
    .login_area_bg .link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transition: width 0.3s ease;
    }
    
    .login_area_bg .link:hover {
        color: var(--colorSecondary);
    }
    
    .login_area_bg .link:hover::after {
        width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .register-area,
        .login-area {
            padding: 40px 0 !important;
            min-height: auto;
        }
        
        .register-area .row,
        .login-area .row {
            min-height: auto;
        }

        .login_area_bg {
            padding: 35px 25px !important;
            border-radius: 16px !important;
        }

        .banner-text h1 {
            font-size: 28px;
        }

        .login_area_bg h4 {
            font-size: 20px;
        }

        .login_area_bg .nav-pills .nav-item .nav-link {
            font-size: 14px;
            padding: 10px 15px;
        }
        
        .login_area_bg form input[type="text"],
        .login_area_bg form input[type="email"],
        .login_area_bg form input[type="password"],
        .login_area_bg form input[type="tel"],
        .login_area_bg form .form-control,
        .regiser-form.login-form input[type="text"],
        .regiser-form.login-form input[type="email"],
        .regiser-form.login-form input[type="password"],
        .regiser-form.login-form input[type="tel"],
        .regiser-form.login-form .form-control {
            height: 50px;
            padding: 12px 16px;
        }
    }

    @media (max-width: 480px) {
        .login_area_bg {
            padding: 30px 20px !important;
        }

        .banner-text h1 {
            font-size: 24px;
        }

        .login_area_bg form input,
        .login_area_bg form .form-control {
            height: 48px;
            padding: 10px 14px;
            font-size: 14px;
        }
        
        .login_area_bg .select2-container--default .select2-selection--single {
            height: 48px;
            line-height: 48px;
        }
        
        .login_area_bg .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 48px;
        }
        
        .login_area_bg form button[type="submit"],
        .regiser-form.login-form button[type="submit"] {
            padding: 14px 25px;
            font-size: 15px;
        }
            font-size: 14px;
        }

        .login_area_bg form button[type="submit"] {
            padding: 12px 20px;
            font-size: 14px;
        }
    }

    /* ============================================
       REMOVE UNNECESSARY SCROLLBARS FROM SECTIONS
       ============================================ */

    /* Remove scrollbar from feature sections and accordion containers */
    .feature-section-text,
    .feature-accordion,
    .faq-service,
    .faq-body,
    .collapse,
    section,
    .container,
    .row {
        overflow: visible !important;
        overflow-x: visible !important;
        overflow-y: visible !important;
        max-height: none !important;
    }

    /* Ensure sections take full width */
    .feature-section-text,
    .feature-accordion,
    .faq-service,
    section {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Remove scrollbar from blog sections */
    .blog-area,
    .blog-page,
    .blog-text {
        overflow: visible !important;
        overflow-x: visible !important;
        overflow-y: visible !important;
        max-height: none !important;
    }

    /* Ensure blog section takes full width */
    .blog-area,
    .blog-page {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Remove any max-height restrictions from accordion content */
    .feature-accordion .faq-body,
    .feature-accordion .collapse,
    .feature-accordion .collapse.show,
    .feature-accordion .collapse:not(.show) {
        max-height: none !important;
        height: auto !important;
        overflow: visible !important;
        overflow-y: visible !important;
    }

    /* Remove scrollbar from all main containers (but keep Bootstrap grid intact) */
    body.client-frontend .container,
    body.client-frontend .container-fluid,
    body.client-frontend section,
    body.client-frontend .row {
        overflow: visible !important;
        overflow-x: visible !important;
        overflow-y: visible !important;
    }

    /* Ensure full width on all screen sizes */
    @media (max-width: 991px) {
        .feature-section-text,
        .feature-accordion,
        .faq-service,
        .blog-area,
        .blog-page,
        section {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }
    }

    @media (max-width: 768px) {
        .feature-section-text,
        .feature-accordion,
        .faq-service,
        .blog-area,
        .blog-page,
        section {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }
    }

    @media (max-width: 480px) {
        .feature-section-text,
        .feature-accordion,
        .faq-service,
        .blog-area,
        .blog-page,
        section {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }
    }

    /* ============================================
       HERO SECTION - MOBILE IMPROVEMENTS & IMAGE TRANSITIONS
       ============================================ */

    /* Hero/Banner Slider Area - Base Styles */
    .banner_slider_area {
        position: relative;
        overflow: hidden;
        height: 600px;
        width: 100%;
    }

    /* Smooth Image Transitions */
    .banner_slider_item {
        overflow: hidden;
        position: relative;
        width: 100%;
        height: 100%;
    }

    .banner_slider_item img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        transition: opacity 0.6s ease-in-out, transform 0.6s ease-in-out !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Ensure slick slider items have proper dimensions */
    .banner_slider .slick-slide {
        height: 100% !important;
    }

    .banner_slider .slick-slide > div {
        height: 100% !important;
    }

    .banner_slider .slick-list,
    .banner_slider .slick-track {
        height: 100% !important;
    }

    /* Smooth fade transition for slider */
    .banner_slider.slick-slider .slick-slide {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
    }

    .banner_slider.slick-slider .slick-slide.slick-active {
        opacity: 1;
    }

    /* Fix for image loading and transitions */
    .banner_slider_item img {
        will-change: opacity, transform;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }

    /* Overlay for better text readability */
    .banner_slider_area::after {
        position: absolute;
        content: "";
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 32, 76, 0.80);
        background: rgb(0 32 76 / 69%);
        z-index: 1;
        pointer-events: none;
    }

    /* Slider Dots - Better visibility on mobile */
    .banner_slider_area .slick-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        bottom: 60px;
        gap: 7px;
        z-index: 99;
        left: 50%;
        transform: translateX(-50%);
    }

    .banner_slider_area .slick-dots li {
        margin: 0;
    }

    .banner_slider_area .slick-dots li button {
        width: 35px;
        display: block;
        height: 6px;
        font-size: 0;
        background: #fff;
        border-radius: 20px;
        cursor: pointer;
        opacity: 0.5;
        transition: all 0.3s ease;
        border: none;
        padding: 0;
    }

    .banner_slider_area .slick-dots li.slick-active button {
        opacity: 1;
        width: 45px;
        background: var(--colorPrimary);
    }

    .banner_slider_area .slick-dots li button:hover {
        opacity: 0.8;
    }

    /* Mobile Responsive Design */
    @media (max-width: 991px) {
        .banner_slider_area {
            height: 500px;
        }

        .banner_slider_area .slick-dots {
            bottom: 40px;
        }

        .banner_slider_area .slick-dots li button {
            width: 30px;
            height: 5px;
        }

        .banner_slider_area .slick-dots li.slick-active button {
            width: 40px;
        }
    }

    @media (max-width: 768px) {
        .banner_slider_area {
            height: 450px;
            min-height: 450px;
        }

        .banner_slider_item {
            height: 100%;
        }

        .banner_slider_item img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            min-height: 450px;
        }

        /* Ensure proper image display on mobile */
        .banner_slider .slick-slide img {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .banner_slider_area .slick-dots {
            bottom: 30px;
            gap: 5px;
        }

        .banner_slider_area .slick-dots li button {
            width: 25px;
            height: 4px;
        }

        .banner_slider_area .slick-dots li.slick-active button {
            width: 35px;
        }
    }

    @media (max-width: 480px) {
        .banner_slider_area {
            height: 400px;
            min-height: 400px;
        }

        .banner_slider_item img {
            min-height: 400px;
        }

        .banner_slider_area .slick-dots {
            bottom: 20px;
            gap: 4px;
        }

        .banner_slider_area .slick-dots li button {
            width: 20px;
            height: 3px;
        }

        .banner_slider_area .slick-dots li.slick-active button {
            width: 30px;
        }
    }

    /* Fix for image transition issues - Prevent flickering */
    .banner_slider.slick-initialized .slick-slide {
        display: block !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .banner_slider.slick-initialized .slick-slide:not(.slick-active) {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .banner_slider.slick-initialized .slick-slide.slick-active {
        opacity: 1 !important;
        visibility: visible !important;
        z-index: 10;
        position: relative;
    }
    
    /* Mobile specific fixes */
    @media (max-width: 768px) {
        .banner_slider.slick-initialized .slick-slide {
            display: block !important;
            opacity: 0;
        }
        
        .banner_slider.slick-initialized .slick-slide.slick-active {
            opacity: 1 !important;
            display: block !important;
            visibility: visible !important;
        }
        
        .banner_slider .slick-list,
        .banner_slider .slick-track {
            height: 100% !important;
        }
    }

    /* Ensure images are loaded before transition */
    .banner_slider_item img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }

    /* Prevent layout shift during image load */
    .banner_slider_item {
        background: #f0f0f0;
    }

    /* Smooth transition for all slider states */
    .banner_slider .slick-slide {
        transition: opacity 0.6s ease-in-out !important;
    }

    /* ============================================
       SUBSCRIBE AREA - ENHANCED DESIGN
       تحسين تصميم قسم الاشتراك
       ============================================ */

    /* Subscribe Area Background */
    .subscribe-area {
        position: relative;
        padding: 60px 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .subscribe-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }
    
    .subscribe-area .container {
        position: relative;
        z-index: 2;
    }

    /* Ensure subscribe form has proper positioning */
    .subscribe-form {
        position: relative;
        max-width: 600px;
        margin: 30px auto 0;
    }

    /* Ensure form wrapper has proper positioning and layout */
    .subscribe-form-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    /* Make sure input wrapper allows for button positioning */
    .subscribe-input-wrapper {
        position: relative;
        flex: 1;
        display: flex;
        align-items: center;
    }
    
    .subscribe-icon {
        position: absolute;
        left: 18px;
        color: var(--colorPrimary);
        font-size: 18px;
        z-index: 3;
        pointer-events: none;
    }
    
    [dir="rtl"] .subscribe-icon {
        left: auto;
        right: 18px;
    }

    /* Ensure input field has proper height and styling */
    .subscribe-form .subscribe-input,
    .subscribe-form input {
        height: 56px;
        line-height: 56px;
        padding-left: 50px;
        padding-right: 20px;
        border: 2px solid transparent;
        border-radius: 8px;
        font-size: 16px;
        background: #fff;
        color: #333;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    [dir="rtl"] .subscribe-form .subscribe-input,
    [dir="rtl"] .subscribe-form input {
        padding-left: 20px;
        padding-right: 50px;
    }
    
    .subscribe-form .subscribe-input:focus,
    .subscribe-form input:focus {
        outline: none;
        border-color: var(--colorPrimary);
        box-shadow: 0 0 0 3px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
    }
    
    .subscribe-form .subscribe-input::placeholder,
    .subscribe-form input::placeholder {
        color: #999;
        font-size: 15px;
    }

    /* Enhanced Subscribe Button - Prominent Design */
    .subscribe-form-wrapper .btn-sub {
        position: relative !important;
        height: 56px !important;
        min-width: 140px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        margin: 0 !important;
        padding: 12px 28px !important;
        border-radius: 8px !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600 !important;
        font-size: 16px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 15px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.4) !important;
        text-transform: none !important;
        white-space: nowrap !important;
    }
    
    .subscribe-form-wrapper .btn-sub span {
        display: inline-block;
    }
    
    .subscribe-form-wrapper .btn-sub i {
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .subscribe-form-wrapper .btn-sub:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.5) !important;
    }
    
    .subscribe-form-wrapper .btn-sub:hover i {
        transform: translateX(3px);
    }
    
    [dir="rtl"] .subscribe-form-wrapper .btn-sub:hover i {
        transform: translateX(-3px);
    }

    .subscribe-form-wrapper .btn-sub:active {
        transform: translateY(0) !important;
        box-shadow: 0 2px 10px rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.3) !important;
    }

    /* Alternative: If button should be inside input field */
    .subscribe-input-wrapper .btn-sub {
        position: absolute !important;
        right: 8px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        -webkit-transform: translateY(-50%) !important;
        height: 44px !important;
        min-width: 120px !important;
        margin: 0 !important;
    }
    
    [dir="rtl"] .subscribe-input-wrapper .btn-sub {
        right: auto;
        left: 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .subscribe-area {
            padding: 40px 0;
        }
        
        .subscribe-form {
            max-width: 100%;
            margin: 20px auto 0;
        }
        
        .subscribe-form-wrapper {
            flex-direction: column;
            gap: 12px;
            padding: 12px;
            border-radius: 12px;
        }
        
        .subscribe-input-wrapper {
            width: 100%;
        }

        .subscribe-form-wrapper .btn-sub {
            width: 100% !important;
            height: 56px !important;
            min-width: 100% !important;
        }

        .subscribe-input-wrapper .btn-sub {
            position: relative !important;
            right: auto !important;
            left: auto !important;
            top: auto !important;
            transform: none !important;
            width: 100% !important;
            margin-top: 0 !important;
        }
        
        .subscribe-form .subscribe-input,
        .subscribe-form input {
            padding-right: 20px;
        }
        
        [dir="rtl"] .subscribe-form .subscribe-input,
        [dir="rtl"] .subscribe-form input {
            padding-left: 20px;
        }
    }

    /* ============================================
       MOBILE CENTERING & ALIGNMENT IMPROVEMENTS
       تحسين التوسيط والمحاذاة على الموبايل
       ============================================ */

    /* Base Mobile Styles - Center Everything */
    @media (max-width: 991px) {
        /* Center all containers */
        .container,
        .container-fluid {
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center rows */
        .row {
            margin-left: auto !important;
            margin-right: auto !important;
            display: flex !important;
            flex-wrap: wrap !important;
        }

        /* Center columns */
        [class*="col-"] {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center text content */
        .text-center,
        .text-center * {
            text-align: center !important;
        }

        /* Center headings */
        h1, h2, h3, h4, h5, h6 {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center paragraphs */
        p {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center images */
        img {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center buttons */
        .btn,
        button,
        .button {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center forms */
        form {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center cards */
        .card {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center lists */
        ul, ol {
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 0 !important;
            list-style-position: inside !important;
        }

        /* Center sections */
        section {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        /* Enhanced centering for mobile */
        body.client-frontend {
            text-align: center !important;
        }

        /* Center all containers */
        .container,
        .container-fluid {
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center all content */
        .main-headline,
        .section-title,
        .title,
        .subtitle {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center all text elements */
        p, span, div, a, li {
            text-align: center !important;
        }

        /* Center images and media */
        img, video, iframe {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 100% !important;
        }

        /* Center buttons and inputs */
        .btn,
        button,
        input[type="submit"],
        input[type="button"],
        .button {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center form elements - but keep text left-aligned for readability */
        .form-control,
        .form-select,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        textarea,
        select {
            text-align: left !important; /* Keep text left for better readability */
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center form placeholders */
        .form-control::placeholder,
        textarea::placeholder {
            text-align: center !important;
        }

        /* Center cards and boxes */
        .card,
        .box,
        .item,
        .service-item,
        .team-item,
        .blog-item {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center navigation and menus */
        .nav-menu-list,
        .nav-item {
            text-align: center !important;
        }

        .nav-link {
            text-align: center !important;
            justify-content: center !important;
        }

        /* Center tables */
        table {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Keep table cells left-aligned for readability */
        table th,
        table td {
            text-align: left !important;
        }

        /* Center table headers if needed */
        table th.text-center,
        table td.text-center {
            text-align: center !important;
        }

        /* Center modals */
        .modal-dialog {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center flex containers */
        .d-flex,
        .flex {
            justify-content: center !important;
            align-items: center !important;
        }

        /* Center grid items */
        .row > [class*="col-"] {
            text-align: center !important;
        }

        /* Center sections */
        section,
        .section {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center hero/banner content */
        .banner-text,
        .slider-text,
        .hero-content {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center feature items */
        .feature-item,
        .choose-item,
        .service-item {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center icons */
        i, .icon, .fa, .fas, .far, .fal {
            display: inline-block !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
    }

    @media (max-width: 480px) {
        /* Extra small screens - Enhanced centering */
        body.client-frontend {
            text-align: center !important;
        }

        /* Center main content elements */
        body.client-frontend > *,
        body.client-frontend section,
        body.client-frontend .section,
        body.client-frontend .container,
        body.client-frontend .container-fluid {
            text-align: center !important;
        }

        /* Override for specific elements that should remain left-aligned */
        .text-left,
        .text-start {
            text-align: left !important;
        }

        .text-right,
        .text-end {
            text-align: right !important;
        }

        /* Center containers with proper padding */
        .container,
        .container-fluid {
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Center all content blocks */
        .content,
        .content-wrapper,
        .main-content {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            text-align: center !important;
        }

        /* Center headings with proper spacing */
        h1, h2, h3, h4, h5, h6 {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center paragraphs */
        p {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center buttons - full width */
        .btn,
        button,
        .button,
        input[type="submit"],
        input[type="button"] {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            text-align: center !important;
        }

        /* Center form groups */
        .form-group,
        .form-row {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center labels */
        label {
            text-align: center !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center inputs - but keep text left-aligned for readability */
        input,
        textarea,
        select,
        .form-control,
        .form-select {
            text-align: left !important; /* Keep text left for better readability */
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center input placeholders */
        input::placeholder,
        textarea::placeholder {
            text-align: center !important;
        }

        /* Center cards */
        .card,
        .card-body {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center lists */
        ul, ol {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 0 !important;
            list-style-position: inside !important;
        }

        /* Center list items */
        li {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* Center images */
        img {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 100% !important;
        }

        /* Center sections */
        section,
        .section {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
        }

        /* Center all flex items */
        .d-flex,
        .flex {
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
        }

        /* Center grid columns */
        .row > [class*="col-"] {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
    }

    /* Prevent horizontal scrolling */
    @media (max-width: 768px) {
        html, body {
            overflow-x: hidden !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        * {
            max-width: 100% !important;
        }

        .container,
        .container-fluid,
        .row {
            overflow-x: hidden !important;
            max-width: 100% !important;
        }
    }

    /* ============================================
       REDUCE SPACING BETWEEN SECTIONS ON MOBILE
       تقليل المسافات بين الأقسام على الموبايل
       ============================================ */

    /* Reduce padding and margin for all sections on mobile */
    @media (max-width: 991px) {
        /* Reduce section padding */
        section {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Specific sections - reduce spacing */
        .testimonial-area,
        .team-area,
        .team_slider_area,
        .blog-area,
        .service-area,
        .case-study-area,
        .about-area,
        .why-us-area,
        .mobile-app-area,
        .how-it-works-area,
        .fixed-price-area,
        .legal-aid-check-home {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce margin classes */
        .mt_200 {
            margin-top: 30px !important;
        }

        .mt_100 {
            margin-top: 30px !important;
        }

        .mt_65 {
            margin-top: 25px !important;
        }

        .mt_50 {
            margin-top: 20px !important;
        }

        .mt_40 {
            margin-top: 20px !important;
        }

        .mt_30 {
            margin-top: 15px !important;
        }

        .mt_25 {
            margin-top: 15px !important;
        }

        .mt_20 {
            margin-top: 10px !important;
        }

        .mt_15 {
            margin-top: 10px !important;
        }

        .mb_60 {
            margin-bottom: 30px !important;
        }

        .mb_40 {
            margin-bottom: 25px !important;
        }

        .mb_30 {
            margin-bottom: 20px !important;
        }

        .mb_25 {
            margin-bottom: 15px !important;
        }

        .mb_20 {
            margin-bottom: 15px !important;
        }

        /* Reduce padding classes */
        .pt_100 {
            padding-top: 40px !important;
        }

        .pb_100 {
            padding-bottom: 40px !important;
        }

        .pt_70 {
            padding-top: 35px !important;
        }

        .pb_70 {
            padding-bottom: 35px !important;
        }

        .pt_40 {
            padding-top: 30px !important;
        }

        .pb_40 {
            padding-bottom: 30px !important;
        }

        .pt_30 {
            padding-top: 25px !important;
        }

        /* Reduce row margins */
        .row {
            margin-top: 0 !important;
            margin-bottom: 15px !important;
        }

        .row.mt_50 {
            margin-top: 20px !important;
        }

        .row.mt_40 {
            margin-top: 20px !important;
        }

        .row.mt_30 {
            margin-top: 15px !important;
        }

        .row.mb_30 {
            margin-bottom: 20px !important;
        }

        .row.mb_60 {
            margin-bottom: 30px !important;
        }

        /* Reduce spacing in testimonial area */
        .testimonial-area {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .testimonial-area .row {
            margin-bottom: 10px !important;
            margin-top: 0 !important;
        }
        
        .testimonial-area .row.mb_30 {
            margin-bottom: 15px !important;
        }
        
        .testimonial-area .main-headline {
            margin-bottom: 20px !important;
        }
        
        .testimonial-area .main-headline .title {
            margin-bottom: 10px !important;
        }
        
        .testimonial-area .main-headline p {
            margin-bottom: 15px !important;
        }
        
        .testimonial_slider {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
        
        .testimonial-item {
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in team/lawyer area */
        .team-area,
        .team_slider_area {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .team-area .row,
        .team_slider_area .row {
            margin-bottom: 10px !important;
            margin-top: 0 !important;
        }
        
        .team-area .row.mb_30 {
            margin-bottom: 15px !important;
        }

        .team-item {
            margin-bottom: 15px !important;
        }
        
        .team-area .main-headline {
            margin-bottom: 20px !important;
        }
        
        .team-area .main-headline .title {
            margin-bottom: 10px !important;
        }
        
        .team-area .main-headline p {
            margin-bottom: 15px !important;
        }
        
        .lawyer_slider {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Reduce spacing in blog area */
        .blog-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        .blog-area .row {
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in service area */
        .service-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce spacing in case study area */
        .case-study-area {
            padding-top: 40px !important;
            padding-bottom: 30px !important;
        }

        /* Reduce spacing in about area */
        .about-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce spacing in why-us area */
        .why-us-area {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        /* Reduce spacing in mobile app area */
        .mobile-app-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce spacing in how-it-works area */
        .how-it-works-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce spacing in fixed-price area */
        .fixed-price-area {
            padding: 50px 0 !important;
        }
        
        /* Enhanced Price Benefits Design */
        .price-benefits {
            margin: 30px 0;
        }
        
        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        /* RTL Support for benefit items */
        [dir="rtl"] .benefit-item {
            flex-direction: row-reverse;
        }
        
        [dir="ltr"] .benefit-item {
            flex-direction: row;
        }
        
        .benefit-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }
        
        .benefit-item i {
            font-size: 28px;
            color: var(--colorPrimary);
            flex-shrink: 0;
            margin-top: 5px;
            min-width: 32px;
            text-align: center;
        }
        
        /* RTL Support for icons */
        [dir="rtl"] .benefit-item i {
            margin-left: 0;
            margin-right: 0;
        }
        
        [dir="ltr"] .benefit-item i {
            margin-left: 0;
            margin-right: 0;
        }
        
        .benefit-content {
            flex: 1;
        }
        
        /* RTL Support for benefit content */
        [dir="rtl"] .benefit-content {
            text-align: right;
        }
        
        [dir="ltr"] .benefit-content {
            text-align: left;
        }
        
        .benefit-content strong {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .benefit-content p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }
        
        .fixed-price-content .title {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        
        .fixed-price-content .title span {
            color: var(--colorPrimary);
        }
        
        .fixed-price-content > p {
            font-size: 17px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .fixed-price-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* Reduce spacing in legal-aid area */
        .legal-aid-check-home {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }
    }

    @media (max-width: 768px) {
        /* Further reduce spacing on smaller mobile */
        section {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        .blog-area,
        .service-area,
        .case-study-area,
        .about-area,
        .why-us-area,
        .mobile-app-area,
        .how-it-works-area,
        .fixed-price-area,
        .legal-aid-check-home {
            padding-top: 20px !important;
            padding-bottom: 10px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
        
        /* Testimonial area - even less spacing */
        .testimonial-area {
            padding-top: 15px !important;
            padding-bottom: 10px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
        
        .testimonial-area .row {
            margin-bottom: 8px !important;
        }
        
        .testimonial-area .main-headline {
            margin-bottom: 15px !important;
        }
        
        .testimonial_slider {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-top: 0 !important;
        }
        
        .testimonial-item {
            margin-bottom: 12px !important;
        }
        
        /* Team area - even less spacing */
        .team-area,
        .team_slider_area {
            padding-top: 15px !important;
            padding-bottom: 10px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
        
        .team-area .row,
        .team_slider_area .row {
            margin-bottom: 8px !important;
        }
        
        .team-area .main-headline {
            margin-bottom: 15px !important;
        }
        
        .lawyer_slider {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-top: 0 !important;
        }
        
        .team-item {
            margin-bottom: 12px !important;
        }
        
        /* Reduce gap between legal-aid-check and blog-area on mobile */
        .legal-aid-check-home + .blog-area,
        .blog-area + .legal-aid-check-home {
            margin-top: 0 !important;
            padding-top: 10px !important;
        }
        
        .blog-area {
            margin-top: 0 !important;
            padding-top: 10px !important;
        }

        .pt_100 {
            padding-top: 30px !important;
        }

        .pb_100 {
            padding-bottom: 30px !important;
        }

        .pt_70 {
            padding-top: 25px !important;
        }

        .pb_70 {
            padding-bottom: 25px !important;
        }

        .pt_40 {
            padding-top: 25px !important;
        }

        .pb_40 {
            padding-bottom: 25px !important;
        }

        .pt_30 {
            padding-top: 20px !important;
        }

        .mt_200 {
            margin-top: 20px !important;
        }

        .mt_100 {
            margin-top: 20px !important;
        }

        .mt_65 {
            margin-top: 20px !important;
        }

        .mt_50 {
            margin-top: 15px !important;
        }

        .mt_40 {
            margin-top: 15px !important;
        }

        .mt_30 {
            margin-top: 12px !important;
        }

        .mt_25 {
            margin-top: 12px !important;
        }

        .mt_20 {
            margin-top: 10px !important;
        }

        .mt_15 {
            margin-top: 8px !important;
        }

        .mb_60 {
            margin-bottom: 25px !important;
        }

        .mb_40 {
            margin-bottom: 20px !important;
        }

        .mb_30 {
            margin-bottom: 15px !important;
        }

        .mb_25 {
            margin-bottom: 12px !important;
        }

        .mb_20 {
            margin-bottom: 12px !important;
        }

        .row {
            margin-bottom: 12px !important;
        }

        .row.mt_50 {
            margin-top: 15px !important;
        }

        .row.mt_40 {
            margin-top: 15px !important;
        }

        .row.mt_30 {
            margin-top: 12px !important;
        }

        .row.mb_30 {
            margin-bottom: 15px !important;
        }

        .row.mb_60 {
            margin-bottom: 25px !important;
        }

        .team-item {
            margin-bottom: 15px !important;
        }
    }

    @media (max-width: 480px) {
        /* Extra small screens - minimal spacing */
        section {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }

        .testimonial-area,
        .team-area,
        .team_slider_area,
        .blog-area,
        .service-area,
        .case-study-area,
        .about-area,
        .why-us-area,
        .mobile-app-area,
        .how-it-works-area,
        .fixed-price-area,
        .legal-aid-check-home {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }

        .pt_100 {
            padding-top: 25px !important;
        }

        .pb_100 {
            padding-bottom: 25px !important;
        }

        .pt_70 {
            padding-top: 20px !important;
        }

        .pb_70 {
            padding-bottom: 20px !important;
        }

        .pt_40 {
            padding-top: 20px !important;
        }

        .pb_40 {
            padding-bottom: 20px !important;
        }

        .pt_30 {
            padding-top: 15px !important;
        }

        .mt_200 {
            margin-top: 15px !important;
        }

        .mt_100 {
            margin-top: 15px !important;
        }

        .mt_65 {
            margin-top: 15px !important;
        }

        .mt_50 {
            margin-top: 12px !important;
        }

        .mt_40 {
            margin-top: 12px !important;
        }

        .mt_30 {
            margin-top: 10px !important;
        }

        .mt_25 {
            margin-top: 10px !important;
        }

        .mt_20 {
            margin-top: 8px !important;
        }

        .mt_15 {
            margin-top: 8px !important;
        }

        .mb_60 {
            margin-bottom: 20px !important;
        }

        .mb_40 {
            margin-bottom: 15px !important;
        }

        .mb_30 {
            margin-bottom: 12px !important;
        }

        .mb_25 {
            margin-bottom: 10px !important;
        }

        .mb_20 {
            margin-bottom: 10px !important;
        }

        .row {
            margin-bottom: 10px !important;
        }

        .row.mt_50 {
            margin-top: 12px !important;
        }

        .row.mt_40 {
            margin-top: 12px !important;
        }

        .row.mt_30 {
            margin-top: 10px !important;
        }

        .row.mb_30 {
            margin-bottom: 12px !important;
        }

        .row.mb_60 {
            margin-bottom: 20px !important;
        }

        .team-item {
            margin-bottom: 12px !important;
        }

        /* Reduce spacing in main headline */
        .main-headline {
            margin-bottom: 20px !important;
        }

        /* Reduce spacing in testimonial items */
        .testimonial-item {
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in blog items */
        .blog-item {
            margin-bottom: 20px !important;
        }

        /* Reduce spacing in service items */
        .service-item {
            margin-bottom: 20px !important;
        }
    }

    /* Additional spacing fixes for specific elements */
    @media (max-width: 768px) {
        /* Reduce gap between sections */
        section + section {
            margin-top: 0 !important;
        }
        
        /* Specifically reduce gap between legal-aid-check and blog-area */
        .legal-aid-check-home {
            padding-bottom: 10px !important;
            margin-bottom: 0 !important;
        }
        
        .legal-aid-check-home + .blog-area,
        .blog-area + .legal-aid-check-home {
            margin-top: 0 !important;
            padding-top: 10px !important;
        }
        
        .blog-area {
            padding-top: 10px !important;
            margin-top: 0 !important;
        }

        /* Reduce container padding */
        .container,
        .container-fluid {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* Reduce spacing in columns */
        [class*="col-"] {
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in slider areas */
        .testimonial_slider,
        .lawyer_slider,
        .blog-carousel {
            margin-top: 15px !important;
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in feature items */
        .feature-item,
        .choose-item {
            margin-bottom: 15px !important;
        }

        /* Reduce spacing in department items */
        .case-item,
        .department-item {
            margin-bottom: 15px !important;
        }
    }

    @media (max-width: 480px) {
        /* Further reduce spacing on extra small screens */
        [class*="col-"] {
            margin-bottom: 12px !important;
        }

        .testimonial_slider,
        .lawyer_slider,
        .blog-carousel {
            margin-top: 12px !important;
            margin-bottom: 12px !important;
        }

        .feature-item,
        .choose-item,
        .case-item,
        .department-item {
            margin-bottom: 12px !important;
        }
    }

    /* ============================================
       BRAND AREA (PARTNERS/LOGO CAROUSEL) - MOBILE FIX
       إصلاح قسم الصور فوق الفوتر على الموبايل
       ============================================ */

    /* Brand Area - Base Styles */
    .brand-area {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .brand-carousel {
        width: 100%;
        display: block !important;
    }

    .brand-carousel .owl-stage-outer {
        overflow: visible !important;
    }

    .brand-carousel .owl-stage {
        display: flex !important;
        align-items: center !important;
    }

    .brand-carousel .owl-item {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .brand-item {
        width: 100% !important;
        display: block !important;
        margin: 0 auto !important;
    }

    .brand-item img {
        width: 100% !important;
        height: auto !important;
        max-height: 140px !important;
        object-fit: contain !important;
        object-position: center !important;
        display: block !important;
        margin: 0 auto !important;
        padding: 15px !important;
        opacity: 1 !important;
        visibility: visible !important;
        position: relative !important;
    }

    .brand-colume {
        width: 100% !important;
        display: block !important;
    }

    .brand-bg {
        display: none !important;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 991px) {
        .brand-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        .brand-carousel {
            padding: 0 15px !important;
        }

        .brand-item {
            margin: 0 10px !important;
        }

        .brand-item img {
            max-height: 120px !important;
            padding: 12px !important;
        }
    }

    @media (max-width: 768px) {
        .brand-area {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        .brand-carousel {
            padding: 0 10px !important;
        }

        .brand-carousel .owl-item {
            padding: 0 5px !important;
        }

        .brand-item {
            margin: 0 5px !important;
            min-height: 100px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .brand-item img {
            max-height: 100px !important;
            padding: 10px !important;
            width: 100% !important;
            height: auto !important;
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: relative !important;
        }
        
        .brand-colume img {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
        }
        
        .brand-item a {
            display: block !important;
            width: 100% !important;
        }

        .brand-colume {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Ensure carousel is visible */
        .brand-carousel.owl-carousel {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .brand-carousel .owl-stage-outer {
            overflow: hidden !important;
        }

        .brand-carousel .owl-stage {
            display: flex !important;
        }

        .brand-carousel .owl-item {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
    }

    @media (max-width: 480px) {
        .brand-area {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }

        .brand-carousel {
            padding: 0 5px !important;
        }

        .brand-item {
            margin: 0 3px !important;
            min-height: 80px !important;
        }

        .brand-item img {
            max-height: 80px !important;
            padding: 8px !important;
        }

        /* Ensure images are visible */
        .brand-item img {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: relative !important;
            z-index: 1 !important;
        }
        
        .brand-colume {
            position: relative !important;
        }
        
        .brand-colume img {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: relative !important;
            z-index: 2 !important;
        }
        
        .brand-item a {
            display: block !important;
            width: 100% !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .brand-bg {
            display: none !important;
        }

        /* Fix for empty carousel */
        .brand-carousel:empty::before {
            content: '';
            display: none;
        }

        /* Ensure carousel wrapper is visible */
        .brand-area .container {
            display: block !important;
            visibility: visible !important;
        }

        .brand-area .row {
            display: block !important;
            visibility: visible !important;
        }

        .brand-area .col-12 {
            display: block !important;
            visibility: visible !important;
        }
    }

    /* Fix for RTL */
    @media (max-width: 768px) {
        [dir="rtl"] .brand-item {
            direction: ltr;
        }

        [dir="rtl"] .brand-item img {
            direction: ltr;
        }
    }

    /* Ensure carousel loads properly */
    .brand-carousel.owl-carousel.owl-loaded {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .brand-carousel.owl-carousel:not(.owl-loaded) {
        display: block !important;
        visibility: visible !important;
    }

    /* Fix for hidden carousel */
    .brand-carousel[style*="display: none"],
    .brand-carousel.hidden,
    .brand-carousel.d-none {
        display: block !important;
        visibility: visible !important;
    }

    /* Ensure brand area is not hidden */
    .brand-area[style*="display: none"],
    .brand-area.hidden,
    .brand-area.d-none {
        display: block !important;
        visibility: visible !important;
    }
    
    /* Force images to be visible on mobile */
    @media (max-width: 768px) {
        .brand-area .brand-carousel .owl-item .brand-item .brand-colume img {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 10 !important;
            width: 100% !important;
            height: auto !important;
            max-width: 100% !important;
        }
        
        .brand-area .brand-carousel .owl-item {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .brand-area .brand-carousel .owl-stage {
            display: flex !important;
            align-items: center !important;
        }
        
        .brand-area .brand-carousel .owl-stage-outer {
            overflow: visible !important;
        }
    }

    /* ============================================
       FOOTER MOBILE DESIGN IMPROVEMENTS
       تحسين تصميم الفوتر على الموبايل
       ============================================ */

    /* Main Footer - Base Styles */
    .main-footer {
        position: relative;
        width: 100%;
        overflow-x: hidden;
    }

    /* Top Footer - Contact Information */
    .top-footer {
        position: relative;
        width: 100%;
        overflow-x: hidden;
        padding: 30px 0 !important;
    }

    .footer-address {
        text-align: center !important;
        margin-bottom: 25px !important;
        padding: 15px !important;
    }

    .footer-address ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-address ul li {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        text-align: right;
        padding: 15px 0;
        margin-bottom: 15px;
        gap: 15px;
    }
    
    [dir="ltr"] .footer-address ul li {
        text-align: left;
        flex-direction: row;
    }
    
    [dir="rtl"] .footer-address ul li {
        text-align: right;
        flex-direction: row-reverse;
    }

    .footer-address ul li i {
        font-size: 24px;
        color: var(--colorPrimary);
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        min-width: 40px;
    }
    
    [dir="ltr"] .footer-address ul li i {
        margin-right: 0;
    }
    
    [dir="rtl"] .footer-address ul li i {
        margin-left: 0;
    }

    .footer-address ul li .title {
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 8px;
        display: block;
        text-align: right;
    }
    
    [dir="ltr"] .footer-address ul li .title {
        text-align: left;
    }
    
    [dir="rtl"] .footer-address ul li .title {
        text-align: right;
    }

    .footer-address ul li p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin: 0;
        text-align: right;
    }
    
    [dir="ltr"] .footer-address ul li p {
        text-align: left;
    }
    
    [dir="rtl"] .footer-address ul li p {
        text-align: right;
    }
    
    .footer-address ul li > div {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    /* Footer Area - Main Content */
    .footer-area {
        position: relative;
        width: 100%;
        overflow-x: hidden;
        padding: 40px 0 !important;
    }

    .footer-item {
        margin-bottom: 30px !important;
        text-align: center !important;
    }

    .footer-item .title {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        text-align: center !important;
    }

    .footer-item p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
        margin-bottom: 15px;
        text-align: center !important;
    }

    .footer-item .sm_fbtn {
        display: inline-block;
        color: var(--colorPrimary);
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .footer-item .sm_fbtn:hover {
        color: var(--colorSecondary);
        transform: translateX(5px);
    }

    /* Footer Links */
    .footer-item ul {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center !important;
    }

    .footer-item ul li {
        margin-bottom: 12px;
        text-align: center !important;
    }

    .footer-item ul li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-block;
        padding: 5px 0;
    }

    .footer-item ul li a:hover {
        color: var(--colorPrimary);
        transform: translateX(5px);
    }

    /* Social Media Icons */
    .footer-item .icon {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
        list-style: none;
        padding: 0;
    }

    .footer-item .icon li {
        margin: 0;
    }

    .footer-item .icon li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #fff;
        font-size: 18px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .footer-item .icon li a:hover {
        background: var(--colorPrimary);
        color: #fff;
        transform: translateY(-3px);
    }

    /* Footer Recent Posts */
    .footer-recent-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding: 10px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .footer-recent-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .footer-recent-photo {
        flex-shrink: 0;
        width: 70px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
    }

    .footer-recent-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .footer-recent-text {
        flex: 1;
        min-width: 0;
    }

    .footer-recent-text a {
        display: block;
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.4;
        margin-bottom: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-recent-text a:hover {
        color: var(--colorPrimary);
    }

    .footer-post-date {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Footer Copyright */
    .footer-copyrignt {
        padding: 20px 0 !important;
        text-align: center !important;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .copyright-text {
        text-align: center !important;
    }

    .copyright-text p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin: 0;
        text-align: center !important;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 991px) {
        .top-footer {
            padding: 25px 0 !important;
        }

        .footer-area {
            padding: 35px 0 !important;
        }

        .footer-address {
            margin-bottom: 20px !important;
        }

        .footer-item {
            margin-bottom: 25px !important;
        }

        .footer-item .title {
            font-size: 17px;
            margin-bottom: 15px;
        }
    }

    @media (max-width: 768px) {
        .top-footer {
            padding: 20px 0 !important;
        }

        .footer-area {
            padding: 25px 0 !important;
        }

        /* Stack columns vertically */
        .top-footer .row > [class*="col-"] {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-bottom: 15px !important;
        }

        .footer-area .row {
            margin: 0 !important;
        }

        .footer-area .row > [class*="col-"] {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-bottom: 25px !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
        
        /* Remove empty spaces */
        .footer-area .row > [class*="col-"]:empty {
            display: none !important;
        }
        
        .footer-item:empty {
            display: none !important;
        }

        .footer-address {
            margin-bottom: 15px !important;
            padding: 10px !important;
        }

        .footer-address ul li {
            padding: 12px 0;
            margin-bottom: 12px;
        }

        .footer-address ul li i {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .footer-address ul li .title {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .footer-address ul li p {
            font-size: 13px;
        }

        .footer-item {
            margin-bottom: 20px !important;
            text-align: center !important;
            padding: 15px !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border-radius: 10px !important;
        }

        .footer-item .title {
            font-size: 16px;
            margin-bottom: 12px !important;
            text-align: center !important;
            padding-bottom: 8px !important;
        }

        .footer-item p {
            font-size: 13px;
            text-align: center !important;
            margin-bottom: 10px !important;
            line-height: 1.6 !important;
        }
        
        .footer-item .textwidget {
            padding: 0 !important;
        }
        
        .footer-item .textwidget p {
            margin-bottom: 12px !important;
        }

        .footer-item ul {
            margin-top: 10px !important;
            margin-bottom: 0 !important;
        }

        .footer-item ul li {
            margin-bottom: 8px !important;
        }

        .footer-item ul li a {
            font-size: 13px !important;
            padding: 5px 0 !important;
            display: block !important;
        }
        
        .footer-item .icon {
            justify-content: center !important;
            margin-top: 15px !important;
            margin-bottom: 0 !important;
        }
        
        .footer-item .sm_fbtn {
            margin-top: 10px !important;
            margin-bottom: 15px !important;
        }

        .footer-item .icon {
            gap: 12px;
            margin-top: 15px;
        }

        .footer-item .icon li a {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }

        .footer-recent-item {
            gap: 10px !important;
            margin-bottom: 12px !important;
            padding: 10px !important;
            background: rgba(255, 255, 255, 0.05) !important;
            border-radius: 8px !important;
        }

        .footer-recent-photo {
            width: 55px !important;
            height: 55px !important;
            flex-shrink: 0 !important;
        }

        .footer-recent-text {
            flex: 1 !important;
            min-width: 0 !important;
        }

        .footer-recent-text a {
            font-size: 12px !important;
            line-height: 1.4 !important;
            margin-bottom: 5px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }

        .footer-post-date {
            font-size: 11px !important;
            margin-top: 5px !important;
        }

        .footer-copyrignt {
            padding: 15px 0 !important;
        }

        .copyright-text p {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .top-footer {
            padding: 15px 0 !important;
        }

        .footer-area {
            padding: 20px 0 !important;
        }
        
        .footer-area .row > [class*="col-"] {
            margin-bottom: 20px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        
        .footer-item {
            margin-bottom: 18px !important;
            padding: 12px !important;
        }

        .footer-address {
            margin-bottom: 12px !important;
            padding: 8px !important;
        }

        .footer-address ul li {
            padding: 10px 0;
            margin-bottom: 10px;
        }

        .footer-address ul li i {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .footer-address ul li .title {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .footer-address ul li p {
            font-size: 12px;
        }

        .footer-item {
            margin-bottom: 20px !important;
        }

        .footer-item .title {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .footer-item p {
            font-size: 12px;
        }

        .footer-item ul li {
            margin-bottom: 8px;
        }

        .footer-item ul li a {
            font-size: 12px;
        }

        .footer-item .icon {
            gap: 10px;
            margin-top: 12px;
        }

        .footer-item .icon li a {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .footer-recent-item {
            gap: 10px;
            margin-bottom: 12px;
            padding: 6px;
        }

        .footer-recent-photo {
            width: 50px;
            height: 50px;
        }

        .footer-recent-text a {
            font-size: 12px;
        }

        .footer-post-date {
            font-size: 10px;
        }

        .footer-copyrignt {
            padding: 12px 0 !important;
        }

        .copyright-text p {
            font-size: 12px;
        }
    }

    /* Fix for RTL */
    @media (max-width: 768px) {
        [dir="rtl"] .footer-item .sm_fbtn:hover {
            transform: translateX(-5px);
        }

        [dir="rtl"] .footer-item ul li a:hover {
            transform: translateX(-5px);
        }

        [dir="rtl"] .footer-recent-item:hover {
            transform: translateX(-5px);
        }
    }

    /* Ensure footer is not hidden */
    .main-footer[style*="display: none"],
    .main-footer.hidden,
    .main-footer.d-none {
        display: block !important;
        visibility: visible !important;
    }

    .top-footer[style*="display: none"],
    .top-footer.hidden,
    .top-footer.d-none {
        display: block !important;
        visibility: visible !important;
    }

    .footer-area[style*="display: none"],
    .footer-area.hidden,
    .footer-area.d-none {
        display: block !important;
        visibility: visible !important;
    }

    /* ============================================
       MOBILE SIDE MENU - ENHANCED DESIGN
       تحسين تصميم القائمة الجانبية على الموبايل
       ============================================ */

    /* Reorder Side Menu Content */
    .side-menu-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    /* Main Menu Section - Show First */
    .side-menu-body {
        order: 1;
        flex: 0 0 auto;
        overflow-y: visible !important;
        overflow: visible !important;
        padding: 0;
        background: #fff;
        max-height: none !important;
    }

    /* Main Menu Items - Enhanced Design */
    .side-menu-body .side-menu-list {
        padding: 8px 0;
        overflow: visible !important;
        max-height: none !important;
        width: 100%;
        display: block;
    }

    .side-menu-item {
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        width: 100%;
        display: block;
    }

    .side-menu-item:first-child {
        border-top: 1px solid #f0f0f0;
    }

    .side-menu-body .side-menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        background: #fff;
        width: 100%;
        box-sizing: border-box;
        direction: ltr;
        border-radius: 8px;
        margin-bottom: 4px;
    }

    [dir="rtl"] .side-menu-body .side-menu-link {
        direction: rtl;
        justify-content: flex-end;
        text-align: right;
        flex-direction: row-reverse;
        padding: 12px 18px;
    }

    .side-menu-body .side-menu-link:hover {
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
        color: var(--colorPrimary);
        padding-left: 22px;
        transform: translateX(-2px);
    }

    [dir="rtl"] .side-menu-body .side-menu-link:hover {
        padding-left: 18px;
        padding-right: 22px;
        transform: translateX(2px);
    }

    .side-menu-link i {
        color: var(--colorPrimary);
        font-size: 18px;
        width: 20px;
        min-width: 20px;
        text-align: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* RTL: Text on right, icons close to text on left */
    [dir="rtl"] .side-menu-link i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    .side-menu-link span {
        flex: 1;
        text-align: left;
        display: flex;
        align-items: center;
    }

    [dir="rtl"] .side-menu-link span {
        text-align: right;
        order: 1;
        justify-content: flex-end;
    }

    .side-menu-link:hover i {
        transform: scale(1.1);
    }

    /* Submenu Design */
    .side-menu-item.has-submenu .side-menu-link {
        width: 100%;
    }

    .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
        margin-left: auto;
        font-size: 12px;
        color: #999;
        transition: transform 0.3s ease;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    [dir="rtl"] .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
        margin-left: auto;
        margin-right: 0;
        order: 3;
    }

    .side-menu-item.has-submenu.active .side-menu-link {
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
        color: var(--colorPrimary);
    }

    .side-menu-item.has-submenu.active .side-menu-link .submenu-toggle {
        transform: rotate(180deg);
        color: var(--colorPrimary);
    }

    .side-submenu {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
        background: #f8f9fa;
    }

    .side-menu-item.has-submenu.active .side-submenu {
        max-height: 500px;
    }

    .side-submenu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px 10px 45px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border-left: 2px solid transparent;
        background: #f8f9fa;
        width: 100%;
        box-sizing: border-box;
        direction: ltr;
        border-radius: 6px;
        margin-bottom: 2px;
    }

    [dir="rtl"] .side-submenu li a {
        direction: rtl;
        padding: 10px 45px 10px 20px;
        border-left: none;
        border-right: 2px solid transparent;
        justify-content: flex-end;
        text-align: right;
        flex-direction: row-reverse;
    }

    .side-submenu li a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background: var(--colorPrimary, #c8b47e);
        transition: width 0.3s ease;
    }

    [dir="rtl"] .side-submenu li a::before {
        left: auto;
        right: 0;
    }

    .side-submenu li a i {
        color: var(--colorPrimary, #c8b47e);
        font-size: 14px;
        width: 16px;
        min-width: 16px;
        text-align: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    [dir="rtl"] .side-submenu li a i {
        order: 2;
        margin-left: 8px;
        margin-right: 0;
    }

    .side-submenu li a span {
        flex: 1;
        text-align: left;
    }

    [dir="rtl"] .side-submenu li a span {
        text-align: right;
        order: 1;
        justify-content: flex-end;
    }

    /* RTL: Ensure submenu links are right-aligned with text on right, icons on left */
    [dir="rtl"] .side-submenu li a {
        justify-content: flex-end;
        text-align: right;
        flex-direction: row-reverse;
    }

    .side-submenu li a:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary, #c8b47e);
        padding-left: 54px;
        border-left-color: var(--colorPrimary, #c8b47e);
    }

    [dir="rtl"] .side-submenu li a:hover {
        padding-left: 20px;
        padding-right: 54px;
        border-left: none;
        border-right-color: var(--colorPrimary, #c8b47e);
    }

    .side-submenu li a:hover::before {
        width: 3px;
    }

    .side-submenu li a:hover i {
        transform: translateX(2px) scale(1.1);
    }

    [dir="rtl"] .side-submenu li a:hover i {
        transform: translateX(-2px) scale(1.1);
    }

    /* Appointment Button - Show After Main Menu */
    .appointment-item {
        order: 2;
        margin-top: 0;
        border-top: 2px solid #e0e0e0;
        border-bottom: none;
        background: #f8f9fa;
        padding: 15px 0;
        width: 100%;
        display: block;
    }

    .appointment-link {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        color: #fff !important;
        border-radius: 12px;
        margin: 0 20px;
        padding: 16px 24px;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 6px 20px rgba(107, 93, 71, 0.4) !important;
        transition: all 0.3s ease;
        border: none !important;
        width: calc(100% - 40px);
        box-sizing: border-box;
        display: flex;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    /* RTL: Text on right, icon close to text on left */
    [dir="rtl"] .appointment-link {
        flex-direction: row-reverse;
        justify-content: center;
        text-align: right;
    }

    [dir="rtl"] .appointment-link i {
        order: 2;
        margin-left: 12px;
        margin-right: 0;
    }

    [dir="rtl"] .appointment-link span {
        order: 1;
        text-align: right;
    }

    .appointment-link:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 93, 71, 0.6) !important;
    }

    .appointment-link:hover i {
        transform: scale(1.1) rotate(5deg);
    }

    .appointment-link i {
        color: #fff !important;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    /* Header Items Section - Show Last */
    .side-menu-header-items {
        order: 3;
        padding: 20px;
        border-top: 2px solid #e8e8e8;
        border-bottom: none;
        background: linear-gradient(180deg, #fafafa 0%, #f5f5f5 100%);
        margin-top: auto;
        position: relative;
    }

    .side-menu-header-items::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--colorPrimary, #c8b47e), transparent);
    }

    .side-menu-header-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        color: #2c3e50;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 10px;
        margin-bottom: 10px;
        background: #fff;
        border: 2px solid #e8e8e8;
        position: relative;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .side-menu-header-link:last-child {
        margin-bottom: 0;
    }

    .side-menu-header-link i {
        color: var(--colorPrimary, #c8b47e);
        font-size: 18px;
        width: 22px;
        min-width: 22px;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* RTL: Text on the right, icons close to text on left */
    [dir="rtl"] .side-menu-header-link {
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 8px;
        margin-bottom: 6px;
    }

    [dir="rtl"] .side-menu-header-link i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    [dir="rtl"] .side-menu-header-link span {
        order: 1;
        text-align: right;
    }

    /* LTR content detection for phone/email - icons on right, text on left */
    [dir="rtl"] .side-menu-header-link[href^="tel:"],
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] {
        flex-direction: row;
        gap: 8px;
    }

    [dir="rtl"] .side-menu-header-link[href^="tel:"] i,
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] i {
        order: 1;
        margin-right: 0;
    }

    [dir="rtl"] .side-menu-header-link[href^="tel:"] span,
    [dir="rtl"] .side-menu-header-link[href^="mailto:"] span {
        order: 2;
        direction: ltr;
        text-align: left;
        margin-left: 8px;
    }

    .side-menu-header-link:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.12) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary, #c8b47e);
        border-color: var(--colorPrimary, #c8b47e);
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(200, 180, 126, 0.2);
    }

    [dir="rtl"] .side-menu-header-link:hover {
        transform: translateX(-5px);
    }

    [dir="rtl"] .side-menu-header-link[href^="tel:"]:hover,
    [dir="rtl"] .side-menu-header-link[href^="mailto:"]:hover {
        transform: translateX(5px);
    }

    .side-menu-header-link:hover i {
        transform: scale(1.15);
        color: var(--colorPrimary, #c8b47e);
    }

    .side-menu-badge {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--colorPrimary);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    [dir="rtl"] .side-menu-badge {
        left: auto;
        right: 10px;
    }

    /* Selectors Section */
    .side-menu-selectors {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .side-menu-form {
        width: 100%;
    }

    .side-menu-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e8e8e8;
        border-radius: 10px;
        background: #fff;
        color: #2c3e50;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .side-menu-select:focus {
        outline: none;
        border-color: var(--colorPrimary, #c8b47e);
        box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15), 0 4px 10px rgba(200, 180, 126, 0.2);
        transform: translateY(-1px);
    }

    .side-menu-select:hover {
        border-color: var(--colorPrimary, #c8b47e);
        box-shadow: 0 2px 8px rgba(200, 180, 126, 0.15);
    }

    /* Mobile Responsive Enhancements */
    @media (max-width: 768px) {
        .side-menu-content {
            width: 320px;
            max-width: 85vw;
        }

        .side-menu-link {
            padding: 14px 18px;
            font-size: 15px;
        }

        .side-menu-link i {
            font-size: 17px;
            width: 22px;
        }

        .appointment-link {
            padding: 12px 18px;
            font-size: 15px;
            background: var(--colorPrimary) !important;
            box-shadow: 0 4px 15px rgba(107, 93, 71, 0.5) !important;
            border: 2px solid var(--colorPrimary) !important;
        }
        
        .appointment-link:hover {
            background: var(--colorSecondary) !important;
            border-color: var(--colorSecondary) !important;
            box-shadow: 0 6px 20px rgba(107, 93, 71, 0.6) !important;
        }

        .side-menu-header-items {
            padding: 12px 18px;
        }

        .side-menu-header-link {
            padding: 10px 12px;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .side-menu-content {
            width: 100%;
            max-width: 100vw;
        }

        .side-menu-link {
            padding: 12px 15px;
            font-size: 14px;
        }

        .side-menu-link i {
            font-size: 16px;
            width: 20px;
        }

        .appointment-link {
            padding: 12px 15px;
            font-size: 14px;
            margin: 0 15px;
        }

        .side-menu-header-items {
            padding: 10px 15px;
        }

        .side-menu-header-link {
            padding: 10px 12px;
            font-size: 13px;
        }

        .side-submenu li a {
            padding: 10px 15px 10px 50px;
            font-size: 13px;
        }
    }

    /* RTL Support for Side Menu */
    @media (max-width: 768px) {
        [dir="rtl"] .side-menu-link:hover {
            padding-left: 20px;
            padding-right: 24px;
        }

        [dir="rtl"] .side-menu-body .side-menu-link {
            justify-content: flex-start;
            text-align: right;
            flex-direction: row;
        }

        [dir="rtl"] .side-menu-body .side-menu-link:hover {
            padding-left: 18px;
            padding-right: 22px;
        }

        /* RTL: Text on right, icons on left */
        [dir="rtl"] .side-menu-body .side-menu-link i {
            order: 2;
            margin-left: 8px;
            margin-right: 0;
        }

        [dir="rtl"] .side-menu-body .side-menu-link span {
            order: 1;
            text-align: right;
            justify-content: flex-end;
        }

        /* RTL: Submenu toggle button alignment */
        [dir="rtl"] .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
            margin-left: auto;
            margin-right: 0;
            order: 3;
        }

        /* RTL: Submenu items alignment */
        [dir="rtl"] .side-submenu li a {
            justify-content: flex-start;
            text-align: right;
            padding: 12px 20px 12px 50px;
            flex-direction: row;
        }

        [dir="rtl"] .side-submenu li a:hover {
            padding-right: 54px;
            padding-left: 20px;
        }

        /* RTL: Submenu icons alignment */
        [dir="rtl"] .side-submenu li a i {
            order: 1;
            margin-left: 0;
            margin-right: 8px;
        }

        [dir="rtl"] .side-submenu li a span {
            order: 2;
            text-align: right;
            justify-content: flex-start;
        }

        [dir="rtl"] .side-submenu li a {
            flex-direction: row;
            justify-content: flex-start;
        }

        [dir="rtl"] .side-menu-header-link:hover {
            transform: translateX(-5px);
        }
    }

    @media (max-width: 480px) {
        /* RTL: Enhanced mobile alignment for smaller screens */
        [dir="rtl"] .side-menu-body .side-menu-link {
            justify-content: flex-end;
            text-align: right;
            padding: 12px 15px;
            flex-direction: row-reverse;
        }

        [dir="rtl"] .side-menu-body .side-menu-link i {
            order: 2;
            margin-left: 8px;
            margin-right: 0;
        }

        [dir="rtl"] .side-menu-body .side-menu-link span {
            order: 1;
            text-align: right;
            justify-content: flex-end;
        }

        [dir="rtl"] .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
            margin-left: auto;
            margin-right: 0;
            order: 3;
        }

        [dir="rtl"] .side-submenu li a {
            justify-content: flex-start;
            text-align: right;
            padding: 10px 15px 10px 50px;
            flex-direction: row;
        }

        [dir="rtl"] .side-submenu li a i {
            order: 1;
            margin-left: 0;
            margin-right: 8px;
        }

        [dir="rtl"] .side-submenu li a span {
            order: 2;
            text-align: right;
            justify-content: flex-start;
        }
    }

    /* ============================================
       VIDEO FRAMES DESIGN - DEPARTMENT/SERVICE PAGES
       تحسين تصميم إطارات الفيديو في صفحات التفاصيل
       ============================================ */

    /* Video Headline */
    .video-headline {
        margin-bottom: 30px;
        text-align: center;
    }

    .video-headline h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--colorBlack);
        margin: 0;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--colorPrimary);
        display: inline-block;
    }

    /* Video Item Container - Simple & Clean */
    .video-item {
        position: relative;
        margin: 0;
        margin-bottom: 30px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: #fff;
        border: 2px solid #e0e0e0;
    }

    .video-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        border-color: var(--colorPrimary);
    }

    /* Remove old decorative borders */
    .video-item:before,
    .video-item:after {
        display: none !important;
    }

    /* Video Image Container */
    .video-img {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
        background: #000;
        border-radius: 10px;
    }

    .video-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.3s ease;
    }

    .video-item:hover .video-img img {
        transform: scale(1.05);
    }

    /* Remove old overlay */
    .video-img:before {
        display: none !important;
    }

    /* Video Section - Overlay */
    .video-section {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .video-item:hover .video-section {
        background: rgba(0, 0, 0, 0.5);
    }

    /* Video Button - Complete & Simple Design */
    .video-button {
        position: relative;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background: var(--colorPrimary) !important;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(200, 180, 126, 0.4);
        border: 3px solid #fff;
    }

    .video-button:hover {
        background: var(--colorSecondary) !important;
        transform: scale(1.1);
        box-shadow: 0 6px 30px rgba(200, 180, 126, 0.6);
    }

    /* Remove old button pseudo-elements */
    .video-button:before,
    .video-button:after {
        display: none !important;
    }

    /* Play Icon - Complete Triangle */
    .video-button span {
        position: relative;
        z-index: 3;
        display: block;
        width: 0;
        height: 0;
        border-left: 24px solid #fff !important;
        border-top: 14px solid transparent;
        border-bottom: 14px solid transparent;
        margin-left: 4px;
        transition: all 0.3s ease;
    }

    .video-button:hover span {
        border-left-color: #fff !important;
        transform: scale(1.1);
    }

    /* Alternative: Use Font Awesome Icon */
    .video-button i {
        color: #fff;
        font-size: 32px;
        margin-left: 4px;
        display: none;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .video-headline h3 {
            font-size: 22px;
        }

        .video-item {
            margin-bottom: 25px;
        }

        .video-button {
            width: 70px;
            height: 70px;
        }

        .video-button span {
            border-left-width: 20px;
            border-top-width: 12px;
            border-bottom-width: 12px;
        }
    }

    @media (max-width: 768px) {
        .video-headline {
            margin-bottom: 25px;
        }

        .video-headline h3 {
            font-size: 20px;
            padding-bottom: 12px;
        }

        .video-item {
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .video-img {
            border-radius: 8px;
        }

        .video-button {
            width: 65px;
            height: 65px;
            border-width: 2px;
        }

        .video-button span {
            border-left-width: 18px;
            border-top-width: 11px;
            border-bottom-width: 11px;
        }
    }

    @media (max-width: 480px) {
        .video-headline h3 {
            font-size: 18px;
            padding-bottom: 10px;
        }

        .video-item {
            margin-bottom: 15px;
            border-width: 1px;
        }

        .video-button {
            width: 60px;
            height: 60px;
        }

        .video-button span {
            border-left-width: 16px;
            border-top-width: 10px;
            border-bottom-width: 10px;
        }
    }

    /* Ensure full frame visibility */
    .video-item,
    .video-img,
    .video-section,
    .video-button {
        opacity: 1 !important;
        visibility: visible !important;
        display: block !important;
    }

    /* Fix for video images */
    .video-img img {
        opacity: 1 !important;
        visibility: visible !important;
        display: block !important;
    }

    /* Ensure colors are complete */
    .video-button {
        background: var(--colorPrimary) !important;
        border-color: #fff !important;
    }

    .video-button:hover {
        background: var(--colorSecondary) !important;
    }

    .video-button span {
        border-left-color: #fff !important;
    }

    /* Ensure icons are complete */
    .video-button span {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* ============================================
       BLOG/ARTICLES SECTION - MOBILE FULL DISPLAY
       تحسين تصميم قسم المقالات على الموبايل ليظهر كاملاً
       ============================================ */

    /* Blog Area - Base Styles */
    .blog-area,
    .blog-page {
        width: 100% !important;
        max-width: 100% !important;
        overflow: visible !important;
    }

    /* Blog Item - Full Width on Mobile */
    .blog-item {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 0 25px 0 !important;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: #fff;
        border: 1px solid #e0e0e0;
        display: flex;
        flex-direction: column;
    }

    .blog-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        border-color: var(--colorPrimary);
    }

    /* Blog Image - Full Width */
    .blog-image {
        width: 100% !important;
        max-width: 100% !important;
        height: auto !important;
        min-height: 200px;
        overflow: hidden;
        position: relative;
    }

    .blog-image a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .blog-image img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.5s ease;
        min-height: 200px;
    }

    .blog-item:hover .blog-image img {
        transform: scale(1.1);
    }

    /* Blog Text - Full Content */
    .blog-text {
        width: 100% !important;
        max-width: 100% !important;
        padding: 20px !important;
        background: #fff;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Blog Author - Full Display */
    .blog-author {
        width: 100% !important;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .blog-author span {
        display: inline-flex;
        align-items: center;
        font-size: 13px;
        color: #777;
        white-space: nowrap;
    }

    .blog-author span i {
        color: var(--colorPrimary);
        margin-right: 5px;
        font-size: 14px;
    }

    /* Blog Title - Full Display */
    .blog-item .title {
        width: 100% !important;
        margin: 0 0 12px 0;
        line-height: 1.4;
    }

    .blog-item .title a {
        font-size: 18px;
        font-weight: 600;
        color: var(--colorBlack);
        text-decoration: none;
        display: block;
        line-height: 1.4;
        transition: all 0.3s ease;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .blog-item .title a:hover {
        color: var(--colorPrimary);
    }

    /* Blog Description - Full Display */
    .blog-item p {
        width: 100% !important;
        margin: 0 0 15px 0;
        color: #666;
        font-size: 14px;
        line-height: 1.7;
        display: block !important;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Blog Details Button - Full Display */
    .blog-item .sm_btn {
        display: inline-block;
        font-size: 15px;
        color: var(--colorPrimary);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        align-self: flex-start;
    }

    .blog-item .sm_btn:hover {
        color: var(--colorSecondary);
        transform: translateX(5px);
    }

    /* First Blog - Special Styling */
    .first-blog {
        width: 100% !important;
        max-width: 100% !important;
        margin-bottom: 25px !important;
    }

    .first-blog .blog-image {
        width: 100% !important;
        height: auto !important;
        min-height: 250px;
    }

    .first-blog .blog-text {
        position: relative !important;
        transform: none !important;
        left: auto !important;
        width: 100% !important;
        margin-top: 0 !important;
        background: #fff !important;
        color: var(--colorBlack) !important;
        padding: 20px !important;
    }

    .first-blog .blog-text .title a,
    .first-blog .blog-text .sm_btn {
        color: var(--colorBlack) !important;
    }

    .first-blog .blog-text .title a:hover {
        color: var(--colorPrimary) !important;
    }

    .first-blog .blog-text .blog-author span,
    .first-blog .blog-text .blog-author span i {
        color: #777 !important;
    }

    .first-blog .blog-text .blog-author span i {
        color: var(--colorPrimary) !important;
    }

    /* Effect Item - Full Display */
    .blog-item.effect-item {
        width: 100% !important;
        max-width: 100% !important;
    }

    .blog-item.effect-item .blog-image {
        width: 100% !important;
        height: auto !important;
        min-height: 200px;
    }

    /* Blog Page Specific */
    .blog-page .blog-item {
        width: 100% !important;
        max-width: 100% !important;
        margin-bottom: 30px !important;
    }

    .blog-page .blog-image {
        width: 100% !important;
        height: auto !important;
        min-height: 220px;
    }

    .blog-page .blog-author {
        width: 100% !important;
        text-align: center;
        padding: 12px 20px;
    }

    /* Blog Carousel - Full Display */
    .blog-carousel {
        width: 100% !important;
    }

    .blog-carousel .blog-item {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 991px) {
        .blog-item {
            margin-bottom: 20px !important;
        }

        .blog-image {
            min-height: 180px;
        }

        .blog-item .title a {
            font-size: 17px;
        }

        .blog-item p {
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        /* Full width columns */
        .blog-area .row > [class*="col-"],
        .blog-page .row > [class*="col-"] {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-bottom: 20px;
        }

        .blog-item {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 0 20px 0 !important;
            border-radius: 10px;
        }

        .blog-image {
            width: 100% !important;
            height: auto !important;
            min-height: 200px;
            max-height: 250px;
        }

        .blog-image img {
            width: 100% !important;
            height: 100% !important;
            min-height: 200px;
            max-height: 250px;
        }

        .blog-text {
            width: 100% !important;
            padding: 18px !important;
        }

        .blog-author {
            width: 100% !important;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            padding-bottom: 12px;
        }

        .blog-author span {
            font-size: 12px;
            width: 100%;
        }

        .blog-item .title {
            width: 100% !important;
            margin-bottom: 10px;
        }

        .blog-item .title a {
            font-size: 16px;
            line-height: 1.4;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .blog-item p {
            width: 100% !important;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 12px;
            -webkit-line-clamp: 3;
            line-clamp: 3;
        }

        .blog-item .sm_btn {
            font-size: 14px;
        }

        /* First Blog Mobile */
        .first-blog {
            width: 100% !important;
            margin-bottom: 20px !important;
        }

        .first-blog .blog-image {
            min-height: 220px;
            max-height: 280px;
        }

        .first-blog .blog-text {
            position: relative !important;
            transform: none !important;
            width: 100% !important;
            margin-top: 0 !important;
        }

        /* Effect Item Mobile */
        .blog-item.effect-item .blog-image {
            min-height: 200px;
            max-height: 250px;
        }

        /* Blog Page Mobile */
        .blog-page .blog-item {
            width: 100% !important;
            margin-bottom: 25px !important;
        }

        .blog-page .blog-image {
            min-height: 200px;
            max-height: 250px;
        }

        .blog-page .blog-author {
            padding: 10px 15px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .blog-item {
            margin-bottom: 15px !important;
            border-radius: 8px;
        }

        .blog-image {
            min-height: 180px;
            max-height: 220px;
        }

        .blog-image img {
            min-height: 180px;
            max-height: 220px;
        }

        .blog-text {
            padding: 15px !important;
        }

        .blog-author {
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .blog-author span {
            font-size: 11px;
        }

        .blog-item .title a {
            font-size: 15px;
        }

        .blog-item p {
            font-size: 12px;
            line-height: 1.6;
            -webkit-line-clamp: 2;
            line-clamp: 2;
        }

        .blog-item .sm_btn {
            font-size: 13px;
        }

        .first-blog .blog-image {
            min-height: 200px;
            max-height: 250px;
        }

        .blog-item.effect-item .blog-image {
            min-height: 180px;
            max-height: 220px;
        }

        .blog-page .blog-image {
            min-height: 180px;
            max-height: 220px;
        }
    }

    /* Ensure all blog elements are visible */
    .blog-item,
    .blog-image,
    .blog-text,
    .blog-author,
    .blog-item .title,
    .blog-item p,
    .blog-item .sm_btn {
        opacity: 1 !important;
        visibility: visible !important;
        display: block !important;
    }

    .blog-image img {
        opacity: 1 !important;
        visibility: visible !important;
        display: block !important;
    }

    /* Fix for blog carousel dots visibility */
    .blog-carousel .owl-dots {
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
        padding: 0 15px;
    }

    .blog-carousel .owl-dots .owl-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #ddd;
        border: 2px solid #ddd;
        transition: all 0.3s ease;
    }

    .blog-carousel .owl-dots .owl-dot.active {
        background: var(--colorPrimary);
        border-color: var(--colorPrimary);
        width: 30px;
        border-radius: 5px;
    }

    /* ============================================
       ICONS & NUMBERS - MOBILE FULL DISPLAY
       ضمان ظهور الأيقونات والأرقام كاملة على الموبايل
       ============================================ */

    /* How It Works Section - Step Numbers & Icons */
    .how-it-works-item {
        position: relative;
        width: 100% !important;
        max-width: 100% !important;
        padding: 30px 20px;
        margin-bottom: 30px;
    }

    .step-number {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px !important;
        height: 50px !important;
        min-width: 50px !important;
        min-height: 50px !important;
        background: var(--colorPrimary) !important;
        color: #fff !important;
        border-radius: 50%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 24px !important;
        font-weight: 700 !important;
        box-shadow: 0 5px 15px rgba(200, 180, 126, 0.4);
        z-index: 10;
        opacity: 1 !important;
        visibility: visible !important;
        border: 3px solid #fff;
    }

    .step-icon {
        width: 80px !important;
        height: 80px !important;
        min-width: 80px !important;
        min-height: 80px !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        border-radius: 50%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 20px auto 25px;
        font-size: 36px !important;
        color: #fff !important;
        box-shadow: 0 5px 20px rgba(200, 180, 126, 0.3);
        transition: all 0.3s ease;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .step-icon i {
        font-size: 36px !important;
        color: #fff !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Counter Section - Icons & Numbers */
    .counter-item {
        width: 100% !important;
        text-align: center;
        margin-bottom: 20px;
    }

    .counter-icon {
        width: 70px !important;
        height: 70px !important;
        min-width: 70px !important;
        min-height: 70px !important;
        line-height: 70px !important;
        border-radius: 50%;
        font-size: 26px !important;
        color: var(--colorPrimary) !important;
        margin: 0 auto 13px;
        box-shadow: 0 14px 41px 0 rgba(58, 17, 98, .1);
        background: var(--colorWhite) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .counter-icon i {
        font-size: 26px !important;
        color: var(--colorPrimary) !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .counter-icon img {
        width: 40px !important;
        height: 40px !important;
        object-fit: contain;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .counter {
        font-size: 36px !important;
        font-weight: 600;
        color: var(--colorWhite) !important;
        margin: 0;
        margin-bottom: 5px;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    /* Counter Row - Mobile Fix */
    @media (max-width: 991px) {
        .counter-row {
            position: relative !important;
            width: 100% !important;
            left: auto !important;
            bottom: auto !important;
            transform: none !important;
            padding: 30px 20px !important;
            margin: 20px 0 !important;
            border-radius: 12px;
            background: var(--colorPrimary) !important;
            background-image: none !important;
        }
        
        .counter-row .row {
            margin: 0 !important;
        }
        
        .counter-row [class*="col-"] {
            margin-bottom: 20px !important;
            padding: 0 10px !important;
        }
        
        .counter-item {
            margin-bottom: 0 !important;
        }
        
        .counter-icon {
            width: 60px !important;
            height: 60px !important;
            min-width: 60px !important;
            min-height: 60px !important;
            line-height: 60px !important;
            font-size: 22px !important;
            margin-bottom: 10px !important;
        }
        
        .counter-icon i {
            font-size: 22px !important;
        }
        
        .counter {
            font-size: 28px !important;
            margin-bottom: 5px !important;
        }
        
        .counter-item .title {
            font-size: 16px !important;
            line-height: 1.4 !important;
        }
    }
    
    @media (max-width: 768px) {
        .counter-row {
            padding: 25px 15px !important;
            margin: 15px 0 !important;
        }
        
        .counter-row [class*="col-"] {
            margin-bottom: 25px !important;
            padding: 0 5px !important;
        }
        
        .counter-icon {
            width: 55px !important;
            height: 55px !important;
            min-width: 55px !important;
            min-height: 55px !important;
            line-height: 55px !important;
            font-size: 20px !important;
        }
        
        .counter-icon i {
            font-size: 20px !important;
        }
        
        .counter {
            font-size: 24px !important;
        }
        
        .counter-item .title {
            font-size: 14px !important;
        }
    }
    
    @media (max-width: 480px) {
        .counter-row {
            padding: 20px 10px !important;
            margin: 10px 0 !important;
        }
        
        .counter-row [class*="col-"] {
            margin-bottom: 20px !important;
            padding: 0 !important;
        }
        
        .counter-icon {
            width: 50px !important;
            height: 50px !important;
            min-width: 50px !important;
            min-height: 50px !important;
            line-height: 50px !important;
            font-size: 18px !important;
        }
        
        .counter-icon i {
            font-size: 18px !important;
        }
        
        .counter {
            font-size: 22px !important;
        }
        
        .counter-item .title {
            font-size: 13px !important;
        }
    }

    /* Features Section - Choose Icons */
    .choose-icon {
        width: 60px !important;
        height: 60px !important;
        min-width: 60px !important;
        min-height: 60px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 12px;
        color: #fff;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
        opacity: 1 !important;
        visibility: visible !important;
    }

    .choose-icon i {
        font-size: 24px !important;
        color: #fff !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Feature Icons - Mobile App Section */
    .feature-icon,
    .app-features .feature-icon {
        width: 60px !important;
        height: 60px !important;
        min-width: 60px !important;
        min-height: 60px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 12px;
        color: #fff;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
        opacity: 1 !important;
        visibility: visible !important;
    }

    .feature-icon i,
    .app-features .feature-icon i {
        font-size: 24px !important;
        color: #fff !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Service Icons */
    .service-item .service-icon,
    .service-box .service-icon {
        width: 80px !important;
        height: 80px !important;
        min-width: 80px !important;
        min-height: 80px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .service-item .service-icon i,
    .service-box .service-icon i {
        font-size: 36px !important;
        color: var(--colorPrimary) !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 991px) {
        .step-number {
            width: 45px !important;
            height: 45px !important;
            min-width: 45px !important;
            min-height: 45px !important;
            font-size: 22px !important;
        }

        .step-icon {
            width: 70px !important;
            height: 70px !important;
            min-width: 70px !important;
            min-height: 70px !important;
            font-size: 32px !important;
        }

        .step-icon i {
            font-size: 32px !important;
        }

        .counter-icon {
            width: 65px !important;
            height: 65px !important;
            min-width: 65px !important;
            min-height: 65px !important;
            font-size: 24px !important;
        }

        .counter-icon i {
            font-size: 24px !important;
        }

        .counter {
            font-size: 32px !important;
        }
    }

    @media (max-width: 768px) {
        .how-it-works-item {
            padding: 25px 15px;
            margin-bottom: 25px;
        }

        .step-number {
            width: 45px !important;
            height: 45px !important;
            min-width: 45px !important;
            min-height: 45px !important;
            font-size: 20px !important;
            top: -18px;
            border-width: 2px;
        }

        .step-icon {
            width: 70px !important;
            height: 70px !important;
            min-width: 70px !important;
            min-height: 70px !important;
            font-size: 30px !important;
            margin: 15px auto 20px;
        }

        .step-icon i {
            font-size: 30px !important;
        }

        .step-title {
            font-size: 18px;
            margin-bottom: 12px;
        }

        .step-description {
            font-size: 14px;
            line-height: 1.7;
        }

        .counter-item {
            margin-bottom: 25px;
        }

        .counter-icon {
            width: 60px !important;
            height: 60px !important;
            min-width: 60px !important;
            min-height: 60px !important;
            line-height: 60px !important;
            font-size: 22px !important;
            margin-bottom: 10px;
        }

        .counter-icon i {
            font-size: 22px !important;
        }

        .counter {
            font-size: 28px !important;
        }

        .counter .title {
            font-size: 16px;
        }

        .choose-icon {
            width: 55px !important;
            height: 55px !important;
            min-width: 55px !important;
            min-height: 55px !important;
            font-size: 22px !important;
        }

        .choose-icon i {
            font-size: 22px !important;
        }

        .feature-icon,
        .app-features .feature-icon {
            width: 55px !important;
            height: 55px !important;
            min-width: 55px !important;
            min-height: 55px !important;
            font-size: 22px !important;
        }

        .feature-icon i,
        .app-features .feature-icon i {
            font-size: 22px !important;
        }

        .service-item .service-icon,
        .service-box .service-icon {
            width: 70px !important;
            height: 70px !important;
            min-width: 70px !important;
            min-height: 70px !important;
        }

        .service-item .service-icon i,
        .service-box .service-icon i {
            font-size: 32px !important;
        }
    }

    @media (max-width: 480px) {
        .how-it-works-item {
            padding: 20px 12px;
            margin-bottom: 20px;
        }

        .step-number {
            width: 40px !important;
            height: 40px !important;
            min-width: 40px !important;
            min-height: 40px !important;
            font-size: 18px !important;
            top: -15px;
            border-width: 2px;
        }

        .step-icon {
            width: 65px !important;
            height: 65px !important;
            min-width: 65px !important;
            min-height: 65px !important;
            font-size: 28px !important;
            margin: 12px auto 18px;
        }

        .step-icon i {
            font-size: 28px !important;
        }

        .step-title {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .step-description {
            font-size: 13px;
            line-height: 1.6;
        }

        .counter-icon {
            width: 55px !important;
            height: 55px !important;
            min-width: 55px !important;
            min-height: 55px !important;
            line-height: 55px !important;
            font-size: 20px !important;
            margin-bottom: 8px;
        }

        .counter-icon i {
            font-size: 20px !important;
        }

        .counter {
            font-size: 24px !important;
        }

        .counter .title {
            font-size: 14px;
        }

        .choose-icon {
            width: 50px !important;
            height: 50px !important;
            min-width: 50px !important;
            min-height: 50px !important;
            font-size: 20px !important;
        }

        .choose-icon i {
            font-size: 20px !important;
        }

        .feature-icon,
        .app-features .feature-icon {
            width: 50px !important;
            height: 50px !important;
            min-width: 50px !important;
            min-height: 50px !important;
            font-size: 20px !important;
        }

        .feature-icon i,
        .app-features .feature-icon i {
            font-size: 20px !important;
        }

        .service-item .service-icon,
        .service-box .service-icon {
            width: 65px !important;
            height: 65px !important;
            min-width: 65px !important;
            min-height: 65px !important;
        }

        .service-item .service-icon i,
        .service-box .service-icon i {
            font-size: 28px !important;
        }
    }

    /* Ensure all icons and numbers are visible */
    .step-number,
    .step-icon,
    .step-icon i,
    .counter-icon,
    .counter-icon i,
    .counter-icon img,
    .counter,
    .choose-icon,
    .choose-icon i,
    .feature-icon,
    .feature-icon i,
    .service-icon,
    .service-icon i {
        opacity: 1 !important;
        visibility: visible !important;
        display: flex !important;
    }

    /* Fix for hidden elements */
    .step-number[style*="display: none"],
    .step-icon[style*="display: none"],
    .counter-icon[style*="display: none"],
    .choose-icon[style*="display: none"],
    .feature-icon[style*="display: none"] {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Ensure proper alignment */
    .how-it-works-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .step-number,
    .step-icon {
        flex-shrink: 0;
    }
    
    /* Real Estate Icons - Building, City, Landmark */
    .real-estate-icon {
        width: 100px !important;
        height: 100px !important;
        min-width: 100px !important;
        min-height: 100px !important;
        margin: 0 auto 25px !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #fff !important;
        font-size: 40px !important;
        box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3) !important;
        transition: all 0.3s ease !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    .real-estate-icon i {
        font-size: 40px !important;
        color: #fff !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    .real-estate-item:hover .real-estate-icon {
        transform: scale(1.1) !important;
        box-shadow: 0 8px 25px rgba(200, 180, 126, 0.4) !important;
    }
    
    @media (max-width: 768px) {
        .real-estate-icon {
            width: 80px !important;
            height: 80px !important;
            min-width: 80px !important;
            min-height: 80px !important;
            font-size: 32px !important;
            margin-bottom: 20px !important;
        }
        
        .real-estate-icon i {
            font-size: 32px !important;
        }
    }
    
    @media (max-width: 480px) {
        .real-estate-icon {
            width: 70px !important;
            height: 70px !important;
            min-width: 70px !important;
            min-height: 70px !important;
            font-size: 28px !important;
            margin-bottom: 15px !important;
        }
        
        .real-estate-icon i {
            font-size: 28px !important;
        }
    }

    /* Company Information Section Styles */
    .company-info-area {
        background: #f8f9fa;
    }

    .company-info-card {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .company-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .company-info-card .info-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--colorPrimary), var(--colorSecondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 28px;
    }

    .company-info-card h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--colorBlack);
    }

    .company-info-card p {
        margin: 0;
        color: #666;
        font-size: 16px;
    }

    .company-info-card p a {
        color: var(--colorPrimary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .company-info-card p a:hover {
        color: var(--colorSecondary);
        text-decoration: underline;
    }

    /* Statistics Section Styles */
    .stat-card {
        background: linear-gradient(135deg, var(--colorPrimary), var(--colorSecondary));
        padding: 40px 20px;
        border-radius: 10px;
        text-align: center;
        color: #fff;
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .stat-card .stat-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .stat-card .stat-number {
        font-size: 42px;
        font-weight: 700;
        margin: 10px 0;
        color: #fff;
    }

    .stat-card .stat-label {
        font-size: 16px;
        margin: 0;
        opacity: 0.95;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 768px) {
        .company-info-card {
            padding: 20px;
        }

        .stat-card {
            padding: 30px 15px;
        }

        .stat-card .stat-number {
            font-size: 36px;
        }
    }

    /* Legal Hero Stats Cards */
    .legal-hero-stats {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 25px;
        padding: 0 10px;
    }

    .legal-stat-card {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        padding: 18px 12px;
        border-radius: 10px;
        text-align: center;
        color: #fff;
        transition: all 0.3s ease;
        min-width: 130px;
        box-shadow: 0 3px 12px rgba(200, 180, 126, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.15);
        position: relative;
        overflow: hidden;
        flex: 1;
        max-width: 160px;
    }

    .legal-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        border-radius: 10px;
        pointer-events: none;
    }

    .legal-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(200, 180, 126, 0.3);
    }

    .legal-stat-icon {
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }

    .legal-stat-icon i {
        font-size: 28px;
        color: #fff;
        opacity: 0.95;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .legal-stat-content {
        position: relative;
        z-index: 1;
    }

    .legal-stat-number {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 6px 0;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,0.25);
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .legal-stat-label {
        font-size: 11px;
        margin: 0;
        opacity: 0.95;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        line-height: 1.3;
        color: rgba(255, 255, 255, 0.95);
    }

    /* Client Header Notifications Styles */
    .notification-dropdown-header {
        position: relative;
        display: inline-block;
    }

    .notification-dropdown-header .header-contact-item {
        position: relative;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .notification-badge-header {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        min-width: 18px;
        text-align: center;
        font-weight: bold;
        z-index: 10;
    }

    .notification-dropdown-menu-header {
        position: absolute;
        right: 0;
        margin-top: 10px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        min-width: 350px;
        max-width: 350px;
    }

    .notification-dropdown-menu-header.show {
        display: block !important;
    }

    .notification-item-header {
        padding: 12px 16px;
        display: block;
        text-decoration: none;
        color: inherit;
        transition: background-color 0.2s;
    }

    .notification-item-header:hover {
        background-color: #f8f9fa;
        text-decoration: none;
        color: inherit;
    }

    .notification-item-header.bg-light {
        background-color: #f8f9fa !important;
    }

    @media (max-width: 768px) {
        .notification-dropdown-menu-header {
            min-width: 300px;
            max-width: 300px;
            right: -50px;
        }

        /* Legal Stats Cards Mobile */
        .legal-hero-stats {
            gap: 12px;
            margin-top: 25px;
        }

        .legal-stat-card {
            padding: 18px 12px;
            min-width: 120px;
            border-radius: 10px;
        }

        .legal-stat-icon i {
            font-size: 24px;
        }

        .legal-stat-number {
            font-size: 28px;
            margin-bottom: 4px;
        }

        .legal-stat-label {
            font-size: 11px;
            letter-spacing: 0.3px;
        }
    }

    @media (max-width: 480px) {
        .legal-hero-stats {
            gap: 10px;
            margin-top: 20px;
        }

        .legal-stat-card {
            padding: 15px 10px;
            min-width: 100px;
        }

        .legal-stat-icon i {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .legal-stat-number {
            font-size: 24px;
            margin-bottom: 3px;
        }

        .legal-stat-label {
            font-size: 10px;
            opacity: 0.95;
        }
    }

    /* ============================================
       COMPREHENSIVE MOBILE UI IMPROVEMENTS
       تحسينات شاملة لواجهة المستخدم للموبايل
       ============================================ */

    /* Prevent horizontal scroll */
    @media (max-width: 991px) {
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            position: relative;
        }

        * {
            max-width: 100%;
        }

        img, video, iframe, embed, object, svg {
            max-width: 100% !important;
            height: auto !important;
        }

        /* Container improvements */
        .container,
        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
            max-width: 100% !important;
        }

        /* Section spacing */
        section {
            padding: 40px 0 !important;
        }

        .section {
            padding: 35px 0 !important;
        }

        /* Typography improvements */
        body.client-frontend {
            font-size: 15px;
            line-height: 1.7;
        }

        h1, .h1 {
            font-size: 28px !important;
            line-height: 1.3 !important;
            margin-bottom: 15px !important;
        }

        h2, .h2 {
            font-size: 24px !important;
            line-height: 1.3 !important;
            margin-bottom: 12px !important;
        }

        h3, .h3 {
            font-size: 20px !important;
            line-height: 1.4 !important;
            margin-bottom: 10px !important;
        }

        h4, .h4 {
            font-size: 18px !important;
            line-height: 1.4 !important;
        }

        h5, .h5 {
            font-size: 16px !important;
        }

        h6, .h6 {
            font-size: 14px !important;
        }

        p {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        /* Button improvements */
        .btn {
            padding: 12px 24px !important;
            font-size: 15px !important;
            min-height: 48px !important;
            border-radius: 8px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-lg {
            padding: 14px 28px !important;
            font-size: 16px !important;
            min-height: 52px !important;
        }

        .btn-sm {
            padding: 10px 20px !important;
            font-size: 14px !important;
            min-height: 44px !important;
        }

        .btn-group {
            width: 100%;
            flex-direction: column;
        }

        .btn-group .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        /* Form improvements */
        .form-control,
        .form-select,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        textarea,
        select {
            font-size: 16px !important;
            padding: 12px 15px !important;
            border-radius: 8px !important;
            min-height: 48px !important;
            width: 100% !important;
        }

        textarea {
            min-height: 120px !important;
        }

        label {
            font-size: 14px !important;
            margin-bottom: 8px !important;
            font-weight: 600 !important;
            display: block;
        }

        .form-group {
            margin-bottom: 20px !important;
        }

        /* Card improvements */
        .card {
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .card-body {
            padding: 20px !important;
        }

        .card-header {
            padding: 15px 20px !important;
            font-size: 16px !important;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-footer {
            padding: 15px 20px !important;
            border-radius: 0 0 12px 12px !important;
        }

        /* Table improvements */
        .table-responsive {
            border-radius: 8px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            font-size: 14px;
            width: 100%;
        }

        table th,
        table td {
            padding: 12px 8px !important;
            font-size: 14px !important;
            white-space: nowrap;
        }

        /* Modal improvements */
        .modal-dialog {
            margin: 10px !important;
            max-width: calc(100% - 20px) !important;
        }

        .modal-content {
            border-radius: 12px !important;
        }

        .modal-header {
            padding: 20px !important;
            border-radius: 12px 12px 0 0 !important;
        }

        .modal-body {
            padding: 20px !important;
        }

        .modal-footer {
            padding: 15px 20px !important;
            border-radius: 0 0 12px 12px !important;
        }

        /* Grid improvements */
        .row {
            margin-left: -10px !important;
            margin-right: -10px !important;
        }

        .row > [class*="col-"] {
            padding-left: 10px !important;
            padding-right: 10px !important;
            margin-bottom: 20px;
        }

        /* List improvements */
        ul, ol {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        /* Image improvements */
        img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 8px;
        }

        /* Badge improvements */
        .badge {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
        }

        /* Alert improvements */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Breadcrumb improvements */
        .breadcrumb {
            padding: 10px 0;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Pagination improvements */
        .pagination {
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .pagination .page-link {
            padding: 10px 15px;
            font-size: 14px;
            min-width: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Accordion improvements */
        .accordion-item {
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        .accordion-button {
            padding: 15px 20px;
            font-size: 16px;
            min-height: 60px;
        }

        .accordion-body {
            padding: 20px;
        }

        /* Tabs improvements */
        .nav-tabs {
            flex-wrap: wrap;
            border-bottom: 2px solid #e9ecef;
        }

        .nav-tabs .nav-link {
            padding: 12px 20px;
            font-size: 15px;
            min-height: 48px;
            border-radius: 8px 8px 0 0;
        }

        .tab-content {
            padding: 20px 0;
        }

        /* Progress bar improvements */
        .progress {
            height: 12px;
            border-radius: 6px;
        }

        /* Spinner improvements */
        .spinner-border,
        .spinner-grow {
            width: 2rem;
            height: 2rem;
        }

        /* Tooltip improvements */
        .tooltip {
            font-size: 13px;
        }

        /* Dropdown improvements */
        .dropdown-menu {
            max-width: calc(100vw - 30px);
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .dropdown-item {
            padding: 12px 20px;
            font-size: 15px;
            min-height: 44px;
        }

        /* Input group improvements */
        .input-group {
            flex-wrap: wrap;
        }

        .input-group-text {
            padding: 12px 15px;
            font-size: 15px;
        }

        /* Nav improvements */
        .nav-link {
            padding: 12px 15px;
            font-size: 15px;
            min-height: 44px;
        }

        /* Footer improvements */
        footer {
            padding: 40px 0 20px !important;
        }

        footer .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Spacing utilities */
        .mt-5 { margin-top: 2rem !important; }
        .mb-5 { margin-bottom: 2rem !important; }
        .pt-5 { padding-top: 2rem !important; }
        .pb-5 { padding-bottom: 2rem !important; }

        /* Text alignment */
        .text-center {
            text-align: center !important;
        }

        /* Flex improvements */
        .d-flex {
            flex-wrap: wrap;
        }

        /* Gap improvements */
        .gap-3 { gap: 1rem !important; }
        .gap-4 { gap: 1.5rem !important; }
        .gap-5 { gap: 2rem !important; }
    }

    @media (max-width: 768px) {
        /* Further mobile optimizations */
        section {
            padding: 30px 0 !important;
        }

        .section {
            padding: 25px 0 !important;
        }

        h1, .h1 {
            font-size: 24px !important;
        }

        h2, .h2 {
            font-size: 22px !important;
        }

        h3, .h3 {
            font-size: 19px !important;
        }

        .container,
        .container-fluid {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .card-body {
            padding: 15px !important;
        }

        .btn {
            padding: 11px 22px !important;
            font-size: 14px !important;
        }

        .form-control,
        .form-select {
            padding: 11px 14px !important;
            font-size: 16px !important;
        }

        table th,
        table td {
            padding: 10px 6px !important;
            font-size: 13px !important;
        }

        .modal-dialog {
            margin: 5px !important;
            max-width: calc(100% - 10px) !important;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 15px !important;
        }
    }

    @media (max-width: 480px) {
        /* Small mobile optimizations */
        section {
            padding: 25px 0 !important;
        }

        .section {
            padding: 20px 0 !important;
        }

        body.client-frontend {
            font-size: 14px;
        }

        h1, .h1 {
            font-size: 22px !important;
        }

        h2, .h2 {
            font-size: 20px !important;
        }

        h3, .h3 {
            font-size: 18px !important;
        }

        h4, .h4 {
            font-size: 16px !important;
        }

        .container,
        .container-fluid {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .card-body {
            padding: 12px !important;
        }

        .btn {
            padding: 10px 20px !important;
            font-size: 14px !important;
            min-height: 44px !important;
        }

        .form-control,
        .form-select {
            padding: 10px 12px !important;
            font-size: 16px !important;
        }

        table {
            font-size: 12px;
        }

        table th,
        table td {
            padding: 8px 4px !important;
            font-size: 12px !important;
        }

        .modal-dialog {
            margin: 0 !important;
            max-width: 100% !important;
            border-radius: 0 !important;
        }

        .modal-content {
            border-radius: 0 !important;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 12px !important;
        }

        .alert {
            padding: 12px 15px;
            font-size: 13px;
        }
    }

    /* Touch device improvements */
    @media (hover: none) and (pointer: coarse) {
        /* Larger touch targets */
        a,
        button,
        .btn,
        input[type="button"],
        input[type="submit"],
        .nav-link,
        .dropdown-item {
            min-height: 44px;
            min-width: 44px;
        }

        /* Remove hover effects */
        a:hover,
        button:hover {
            opacity: 1;
        }

        /* Improve focus states */
        a:focus,
        button:focus,
        input:focus,
        textarea:focus,
        select:focus {
            outline: 2px solid var(--colorPrimary);
            outline-offset: 2px;
        }
    }

    /* Landscape orientation */
    @media (max-width: 991px) and (orientation: landscape) {
        section {
            padding: 25px 0 !important;
        }

        .section {
            padding: 20px 0 !important;
        }
    }

    /* تقليل المسافة بين قسم خدماتنا القانونية وأقسامنا القانونية */
    .service-area {
        padding-bottom: 20px !important;
    }

    .team-area {
        padding-top: 20px !important;
    }

    /* على الشاشات الصغيرة */
    @media (max-width: 768px) {
        .service-area {
            padding-bottom: 15px !important;
        }

        .team-area {
            padding-top: 15px !important;
        }
    }

    /* تحسين تصميم كروت الشهادات لتكون متساوية */
    .testimonial-item {
        height: 100% !important;
        min-height: 400px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        box-sizing: border-box !important;
    }

    .testimonial-item p {
        flex: 1 !important;
        display: flex !important;
        align-items: flex-start !important;
        margin-bottom: 20px !important;
        line-height: 1.6 !important;
    }

    .testi-info {
        margin-top: auto !important;
        flex-shrink: 0 !important;
        padding-top: 20px !important;
    }

    /* جعل الكروت في نفس الصف متساوية في الارتفاع */
    .testimonial_slider .slick-slide,
    .testimonial_slider .slick-track .slick-slide,
    .owl-testimonial .owl-item,
    .testimonial-area .row > div,
    .testimonial-area .col-md-6,
    .testimonial-area .col-lg-6 {
        display: flex !important;
        height: auto !important;
    }

    .testimonial_slider .slick-slide > div,
    .owl-testimonial .owl-item > div,
    .testimonial-area .row > div > div,
    .testimonial-area .col-md-6 > div,
    .testimonial-area .col-lg-6 > div {
        height: 100% !important;
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
    }

    /* ضمان أن جميع الكروت في نفس الصف لها نفس الارتفاع */
    .testimonial_slider .slick-track,
    .owl-testimonial .owl-stage {
        display: flex !important;
        align-items: stretch !important;
    }

    .testimonial_slider .slick-slide,
    .owl-testimonial .owl-item {
        height: auto !important;
        display: flex !important;
    }

    /* على الشاشات الصغيرة */
    @media (max-width: 768px) {
        .testimonial-item {
            min-height: 350px !important;
            padding: 60px 30px 50px 30px !important;
        }

        .testimonial-item:before {
            left: 20px !important;
            top: 10px !important;
            font-size: 60px !important;
        }

        .testi-info {
            padding: 15px 0px 15px 80px !important;
        }
    }

    /* على الشاشات المتوسطة */
    @media (min-width: 769px) and (max-width: 991px) {
        .testimonial-item {
            min-height: 380px !important;
            padding: 70px 50px 60px 50px !important;
        }
    }

    /* على الشاشات الكبيرة */
    @media (min-width: 992px) {
        .testimonial-item {
            min-height: 420px !important;
        }
    }

    /* تحسين محاذاة كروت المحامين في الصفحة الرئيسية */
    .team-area .row > div,
    .team-page .row > div {
        display: flex !important;
        flex-direction: column !important;
    }

    .team-item-link {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        text-decoration: none !important;
    }

    /* ضمان أن جميع الكروت متساوية في الارتفاع */
    .team-item {
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
    }

    /* تحسين محاذاة النصوص والأيقونات */
    .team-text {
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    /* ضمان أن الأيقونات دائماً في نفس الموضع */
    .team-text p {
        display: flex !important;
        align-items: center !important;
        margin: 8px 0 !important;
    }

    /* في RTL: محاذاة كاملة لليمين في العربية */
    [dir="rtl"] .team-text {
        text-align: right !important;
        direction: rtl !important;
    }

    [dir="rtl"] .team-text p {
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
        flex-direction: row-reverse !important;
    }

    [dir="rtl"] .team-text p i {
        margin-left: 0 !important;
        margin-right: 0 !important;
        order: 1 !important;
    }

    [dir="rtl"] .team-text p span {
        text-align: right !important;
    }

    [dir="rtl"] .team-text .mt-2 {
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
    }

    [dir="rtl"] .team-text .mt-2 span {
        text-align: right !important;
    }

    /* على الشاشات الصغيرة */
    @media (max-width: 768px) {
        .team-text p {
            font-size: 13px !important;
            margin: 6px 0 !important;
        }

        .team-text p i {
            font-size: 14px !important;
            width: 18px !important;
            min-width: 18px !important;
        }

        .team-name {
            font-size: 18px !important;
            margin-bottom: 12px !important;
        }

        /* RTL على الشاشات الصغيرة */
        [dir="rtl"] .team-text p {
            flex-direction: row-reverse !important;
            text-align: right !important;
        }
    }
</style>
