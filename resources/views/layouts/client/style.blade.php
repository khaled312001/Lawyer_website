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
        padding: 0 20px;
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
        padding-right: 10px;
    }

    .logo img {
        max-height: 45px;
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
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    ul.nav-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 0;
        flex-wrap: nowrap;
    }

    ul.nav-menu li {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        position: relative;
    }

    ul.nav-menu li:not(.special-button) {
        margin-right: 2px;
    }

    ul.nav-menu li a {
        padding: 15px 16px !important;
        display: flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #fff !important;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        position: relative;
        border-radius: 6px;
        white-space: nowrap;
    }

    ul.nav-menu li a i {
        font-size: 14px;
        width: 18px;
        text-align: center;
        margin-right: 6px;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.95);
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.1));
        flex-shrink: 0;
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
        margin-left: 15px;
    }

    ul.nav-menu li.special-button a {
        padding: 13px 28px !important;
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

    /* ============================================
       Responsive Design Improvements
       ============================================ */

    /* Tablet and Below (991px) */
    @media (max-width: 991px) {
        .header-info ul {
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        ul.nav-menu li.special-button {
            margin-left: 10px;
        }

        .menu-area .container {
            padding: 0 15px;
        }

        ul.nav-menu li a {
            padding: 12px 15px !important;
            font-size: 14px;
        }

        ul.nav-menu li.special-button a {
            padding: 10px 20px !important;
            font-size: 14px;
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
