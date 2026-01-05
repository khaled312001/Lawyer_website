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
<link rel="stylesheet" href="{{ asset('client/css/kliently-features.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/animations.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/unified-colors.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/image-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/footer-icons-fix.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('client/css/icon-colors-fix.css') }}?v={{ $setting?->version }}">


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
        display: flex;
        align-items: center;
        justify-content: center;
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
        background: #fff;
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
        position: relative;
        z-index: 999;
    }

    .header-bar-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-left,
    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .cart-wrapper {
        position: relative;
    }

    .cart-link {
        display: flex;
        align-items: center;
        color: #333;
        font-size: 18px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .cart-link:hover {
        color: var(--colorPrimary);
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--colorPrimary);
        color: #fff;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
    }

    .currency-selector,
    .language-selector {
        position: relative;
    }

    .header-select {
        border: none;
        background: transparent;
        padding: 5px 25px 5px 8px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 12px;
    }

    .header-select:focus {
        outline: none;
    }

    .header-contact-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .header-contact-item i {
        color: var(--colorPrimary);
        font-size: 16px;
    }

    .header-contact-item:hover {
        color: var(--colorPrimary);
    }

    .account-link {
        font-weight: 500;
    }

    /* Main Navigation Bar - Client Only */
    body.client-frontend .main-navbar {
        background: linear-gradient(135deg, var(--navGradientStart) 0%, var(--navGradientEnd) 100%);
        padding: 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        position: sticky;
        top: 0;
        z-index: 9999 !important;
        transition: all 0.3s ease;
        overflow: visible !important;
    }

    body.client-frontend .main-navbar.sticky {
        box-shadow: 0 6px 25px rgba(0,0,0,0.2);
    }

    body.client-frontend .navbar-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        position: relative;
        overflow: visible !important;
    }

    body.client-frontend .navbar-logo {
        flex-shrink: 0;
    }

    body.client-frontend .navbar-logo img {
        max-height: 50px;
        width: auto;
        height: auto;
        display: block;
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
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    body.client-frontend .nav-link i {
        font-size: 16px;
    }

    body.client-frontend .nav-link:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-2px);
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
        background: #fff !important;
        min-width: 220px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        border-radius: 8px;
        padding: 10px 0;
        margin-top: 8px !important;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 99999 !important;
        display: block !important;
        pointer-events: none;
        overflow: visible !important;
        white-space: nowrap;
        clip: auto !important;
        clip-path: none !important;
    }

    body.client-frontend .nav-item.has-dropdown:hover .dropdown-menu,
    body.client-frontend .nav-item.has-dropdown.active .dropdown-menu,
    body.client-frontend .nav-item.has-dropdown .dropdown-menu:hover {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
        pointer-events: auto !important;
        display: block !important;
    }

    body.client-frontend .dropdown-menu li {
        margin: 0;
    }

    body.client-frontend .dropdown-menu li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    body.client-frontend .dropdown-menu li a i {
        color: var(--colorPrimary);
        font-size: 14px;
        width: 18px;
    }

    body.client-frontend .dropdown-menu li a:hover {
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
        color: var(--colorPrimary);
        padding-left: 25px;
    }

    body.client-frontend .appointment-btn-wrapper {
        margin-left: 15px;
    }

    body.client-frontend .appointment-btn {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff !important;
        padding: 12px 24px !important;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        border: 2px solid rgba(255,255,255,0.2);
    }

    body.client-frontend .appointment-btn:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.35);
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
        position: relative;
        overflow: visible !important;
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
        display: none;
        flex-direction: column;
        gap: 5px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
        z-index: 1001;
    }

    body.client-frontend .mobile-menu-toggle span {
        width: 25px;
        height: 3px;
        background: #fff;
        border-radius: 3px;
        transition: all 0.3s ease;
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
        display: none;
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
        display: flex;
        flex-direction: column;
    }

    .mobile-side-menu.active .side-menu-content {
        right: 0;
    }

    .side-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
        background: linear-gradient(135deg, var(--navGradientStart) 0%, var(--navGradientEnd) 100%);
    }

    .side-menu-logo img {
        max-height: 40px;
        width: auto;
    }

    .side-menu-close {
        background: rgba(255,255,255,0.2);
        border: none;
        color: #fff;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .side-menu-close:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
    }

    .side-menu-body {
        flex: 1;
        padding: 20px 0;
        overflow-y: auto;
    }

    .side-menu-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .side-menu-item {
        border-bottom: 1px solid #f0f0f0;
    }

    .side-menu-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 20px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .side-menu-link i {
        color: var(--colorPrimary);
        font-size: 18px;
        width: 24px;
    }

    .side-menu-link:hover {
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
        color: var(--colorPrimary);
        padding-left: 25px;
    }

    .side-menu-item.has-submenu .side-menu-link .submenu-toggle {
        margin-left: auto;
        font-size: 12px;
        transition: transform 0.3s ease;
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

    .side-submenu li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px 12px 50px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .side-submenu li a i {
        color: var(--colorPrimary);
        font-size: 14px;
        width: 18px;
    }

    .side-submenu li a:hover {
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1);
        color: var(--colorPrimary);
        padding-left: 55px;
    }

    .appointment-item {
        margin-top: 10px;
        border-top: 2px solid #e0e0e0;
        border-bottom: none;
    }

    .appointment-link {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff !important;
        border-radius: 8px;
        margin: 10px 20px;
        justify-content: center;
        font-weight: 600;
    }

    .appointment-link i {
        color: #fff !important;
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
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .app-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: var(--colorPrimary) !important;
        color: #fff !important;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid var(--colorPrimary);
    }

    .app-download-btn:hover {
        background: var(--colorSecondary) !important;
        border-color: var(--colorSecondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: #fff !important;
    }

    .app-download-btn img {
        height: 30px;
        width: auto;
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
        width: 60px;
        height: 60px;
        bottom: 25px;
        right: 25px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #fff;
        border-radius: 50%;
        text-align: center;
        font-size: 30px;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
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
            width: 55px;
            height: 55px;
            bottom: 20px;
            right: 20px;
            font-size: 28px;
        }

        .whatsapp-float i {
            font-size: 28px;
        }

        .whatsapp-tooltip {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 15px;
            right: 15px;
            font-size: 24px;
        }

        .whatsapp-float i {
            font-size: 24px;
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

    .team-name {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--colorBlack);
        transition: color 0.3s ease;
    }

    .team-item:hover .team-name {
        color: var(--colorPrimary);
    }

    .team-text p {
        font-size: 14px;
        margin: 5px 0;
        color: #666;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .team-text p i {
        color: var(--colorPrimary);
        font-size: 14px;
        width: 18px;
    }

    .team-text span {
        color: var(--colorPrimary);
    }

    .team-text span b {
        font-weight: 500;
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

    .team-item:hover .team-action-icon {
        opacity: 1;
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
            display: none;
        }

        .mobile-menu-toggle {
            display: flex;
        }

        .mobile-side-menu {
            display: block;
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

        /* Header Bar */
        .top-header-bar {
            padding: 8px 0;
        }

        .header-bar-content {
            flex-direction: column;
            gap: 10px;
        }

        .header-left,
        .header-right {
            width: 100%;
            justify-content: center;
            gap: 10px;
        }

        .header-contact-item {
            font-size: 12px;
        }

        .header-contact-item span {
            display: none;
        }

        .header-select {
            font-size: 12px;
            padding: 4px 20px 4px 6px;
        }

        /* Main Navbar */
        .navbar-wrapper {
            padding: 12px 15px;
        }

        .navbar-logo img {
            max-height: 40px;
        }

        .mobile-menu-toggle span {
            width: 22px;
            height: 2.5px;
        }

        /* Side Menu */
        .side-menu-content {
            width: 300px;
        }

        .side-menu-header {
            padding: 15px;
        }

        .side-menu-logo img {
            max-height: 35px;
        }

        .side-menu-link {
            padding: 12px 15px;
            font-size: 14px;
        }

        .side-submenu li a {
            padding: 10px 15px 10px 45px;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .alert-text {
            font-size: 11px;
            padding-right: 25px;
        }

        .header-bar-content {
            gap: 8px;
        }

        .header-left,
        .header-right {
            gap: 8px;
        }

        .cart-link {
            font-size: 16px;
        }

        .header-select {
            font-size: 11px;
        }

        .navbar-wrapper {
            padding: 10px 12px;
        }

        .navbar-logo img {
            max-height: 35px;
        }

        .side-menu-content {
            width: 280px;
            max-width: 90vw;
        }

        .side-menu-link {
            padding: 12px 15px;
            font-size: 14px;
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
</style>
