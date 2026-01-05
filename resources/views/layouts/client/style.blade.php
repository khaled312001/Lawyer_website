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

    /* Top Promotional Banner */
    .promo-banner {
        background: #ffe5e5;
        padding: 10px 0;
        text-align: center;
        position: relative;
        font-size: 14px;
        color: #333;
    }

    .promo-banner .close-btn {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        background: #000;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        line-height: 1;
    }

    /* Header Area - Light Grey Background */
    .header-area {
        background: #f5f5f5 !important;
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .header-info ul {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 25px;
        flex-wrap: wrap;
    }

    .header-info ul li {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #333;
    }

    .header-info ul li i {
        color: var(--colorPrimary);
        font-size: 16px;
    }

    .header-info ul li a {
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .header-info ul li a:hover {
        color: var(--colorPrimary);
    }

    /* Language Selection with Flags */
    .header-info .select_js {
        border: none;
        background: transparent;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 14px;
    }

    /* Menu Area - Gradient Background */
    .menu-area {
        background: linear-gradient(135deg, var(--navGradientStart) 0%, var(--navGradientEnd) 100%) !important;
        padding: 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        position: relative;
    }

    .menu-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        pointer-events: none;
    }

    .menu-area .container {
        max-width: 100%;
        padding: 0 30px;
    }

    .menu-area .row {
        align-items: center;
        padding: 15px 0;
    }

    /* Logo Styling */
    .logo {
        display: flex;
        align-items: center;
        height: 100%;
    }

    .logo img {
        max-height: 50px;
        width: auto;
        height: auto;
        display: block;
        /* Remove filter to show original logo colors */
        filter: none;
    }

    /* If logo needs to be white on gradient background, use this instead: */
    /* .menu-area .logo img {
        filter: brightness(0) invert(1);
    } */

    /* Navigation Menu */
    .main-menu {
        float: none !important;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
    }

    ul.nav-menu {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 0;
    }

    ul.nav-menu li {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        position: relative;
    }

    ul.nav-menu li:not(.special-button) {
        margin-right: 5px;
    }

    ul.nav-menu li a {
        padding: 15px 20px !important;
        display: flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #fff !important;
        font-weight: 500;
        font-size: 15px;
        text-decoration: none;
        position: relative;
        border-radius: 6px;
    }

    ul.nav-menu li a i {
        font-size: 15px;
        width: 20px;
        text-align: center;
        margin-right: 8px;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.95);
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.1));
    }

    ul.nav-menu li a:hover {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 6px;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    ul.nav-menu li a:hover i {
        color: #fff;
        transform: scale(1.1);
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    /* Dropdown Arrow - Removed */
    ul.nav-menu li.menu-item-has-children > a::after {
        display: none !important;
    }

    /* Dropdown Submenu */
    ul.nav-menu li.menu-item-has-children {
        position: relative;
    }

    ul.nav-menu li ul.sub-menu {
        position: absolute;
        top: 100% !important;
        left: 0;
        background: #fff;
        min-width: 200px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 4px;
        margin-top: 0;
        z-index: 999;
        padding: 15px 0 10px 0;
        display: none !important;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    ul.nav-menu li.menu-item-has-children:hover > ul.sub-menu,
    ul.nav-menu li.menu-item-has-children ul.sub-menu:hover {
        display: block !important;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    ul.nav-menu li ul.sub-menu li {
        display: block;
        width: 100%;
        margin: 0;
    }

    ul.nav-menu li ul.sub-menu li a {
        color: #333 !important;
        padding: 12px 20px !important;
        display: flex;
        align-items: center;
    }

    ul.nav-menu li ul.sub-menu li a i {
        font-size: 13px;
        width: 18px;
        text-align: center;
        color: var(--colorPrimary);
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    ul.nav-menu li ul.sub-menu li a:hover {
        background: linear-gradient(90deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.08) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
        color: var(--colorPrimary) !important;
        padding-left: 25px !important;
    }

    ul.nav-menu li ul.sub-menu li a:hover i {
        transform: translateX(3px);
        color: var(--colorSecondary);
    }

    /* Special Button - CTA */
    ul.nav-menu li.special-button {
        margin-left: 20px;
    }

    ul.nav-menu li.special-button a {
        padding: 13px 32px !important;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        color: #fff !important;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        position: relative;
        overflow: hidden;
        border: 2px solid rgba(255,255,255,0.2);
    }

    ul.nav-menu li.special-button a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    ul.nav-menu li.special-button a:hover::before {
        left: 100%;
    }

    ul.nav-menu li.special-button a:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 6px 20px rgba(0,0,0,0.35);
        border-color: rgba(255,255,255,0.3);
    }

    ul.nav-menu li.special-button a i {
        margin-right: 8px;
        font-size: 16px;
    }

    /* Sticky Menu Adjustments */
    #strickymenu.sticky {
        background: linear-gradient(135deg, var(--navGradientStart) 0%, var(--navGradientEnd) 100%) !important;
        box-shadow: 0 6px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }

    #strickymenu.sticky ul.nav-menu li a {
        padding: 12px 18px !important;
    }

    #strickymenu.sticky ul.nav-menu li.special-button a {
        padding: 10px 25px !important;
    }

    #strickymenu.sticky ul.nav-menu li ul.sub-menu {
        display: none !important;
    }

    #strickymenu.sticky ul.nav-menu li.menu-item-has-children:hover > ul.sub-menu {
        display: block !important;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Hide all dropdown indicators */
    ul.nav-menu li.menu-item-has-children::before {
        display: none !important;
    }

    ul.nav-menu li.menu-item-has-children li.menu-item-has-children::before {
        display: none !important;
    }

    /* RTL Support */
    @php
        $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'ltr');
    @endphp
    @if ($textDirection == 'rtl')
        ul.nav-menu li.special-button {
            margin-left: 0;
            margin-right: 20px;
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

    /* Responsive */
    @media (max-width: 991px) {
        .header-info ul {
            justify-content: center;
            gap: 15px;
        }

        ul.nav-menu li.special-button {
            margin-left: 10px;
        }
    }
</style>
