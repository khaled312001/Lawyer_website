<!DOCTYPE html>
@php
    $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'ltr');
@endphp
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ $textDirection }}">

<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $appName = $setting->app_name;
        try {
            $routeName = str(Route::currentRouteName())
                ->replace('_', ' - ')
                ->replace('-', ' - ')
                ->replace('.', ' - ')
                ->title();
        } catch (\Exception $e) {
            info($e);
            $routeName = '';
        }
        $SeoTitle = $routeName . ' || ' . $appName;
    @endphp

    <!-- Title -->
    @yield('title')
    @yield('meta')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) ?? '' }}">

    @include('layouts.client.style')
    @stack('css')
    @if (customCode()?->css)
        <style>
            {!! customCode()->css !!}
        </style>
    @endif

    @if ($setting->googel_tag_status == 'active')
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $setting->googel_tag_id }}');
            // Initialize Data Layer
            window.dataLayer = window.dataLayer || [];
        </script>
        <!-- End Google Tag Manager -->
    @endif

    @if ($setting->google_analytic_status == 'active')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $setting->google_analytic_id }}');
        </script>
    @endif

    @if ($setting->pixel_status == 'active')
        <!-- Meta Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $setting->pixel_app_id }}');
            fbq('track', 'PageView');
        </script>

        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $setting->pixel_app_id }}&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
    @endif
    @if (customCode()?->header_javascript)
        <script>
            "use strict";
            {!! customCode()->header_javascript !!}
        </script>
    @endif

</head>

<body class="client-frontend">
    <!--============================
    Google Tag Manager
    ==============================-->
    @if ($setting->googel_tag_status == 'active')
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $setting->googel_tag_id }}" height="0"
                width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    <!--Preloader Start-->
    @if ($setting->preloader == 1)
        <div id="preloader" class="preloader">
            <div class="status" style="background-image: url({{ url($setting->preloader_image) }})"></div>
        </div>
    @endif
    <!--Preloader End-->
    @if (customCode()?->body_javascript)
        <script>
            "use strict";
            {!! customCode()->body_javascript !!}
        </script>
    @endif

    <!--New Header Bar-->
    <div class="top-header-bar aman-top-bar-rtl">
        <div class="container-fluid">
            <div class="header-bar-content aman-bar-content-rtl">
                <div class="header-left">
                    <div class="cart-wrapper">
                        <a href="{{ route('client.payment') }}" class="cart-link" aria-label="{{ __('Appointment List') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @if(Cart::count() > 0)
                                <span class="cart-badge">{{ Cart::count() }}</span>
                            @endif
                        </a>
                    </div>
                    @if (allCurrencies()?->where('status', 'active')->count() > 1)
                        <div class="currency-selector">
                            <form id="setCurrencyHeader" action="{{ route('set-currency') }}" method="get">
                                <select class="header-select" name="currency" onchange="this.form.submit()">
                                    @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                        <option value="{{ $currency->currency_code }}"
                                            {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                            {{ $currency->currency_name }}
                                        </option>
                                    @empty
                                        <option value="USD" {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                            {{ __('USD') }}
                                        </option>
                                    @endforelse
                                </select>
                            </form>
                        </div>
                    @endif
                    @if (allLanguages()?->where('status', 1)->count() > 1)
                        <div class="language-selector">
                            <form id="setLanguageHeader" action="{{ route('set-language') }}" method="get">
                                <select class="header-select" name="code" onchange="this.form.submit()">
                                    @forelse (allLanguages()?->where('status', 1) as $language)
                                        <option value="{{ $language->code }}"
                                            {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                            @if($language->code == 'en') 🇬🇧 @elseif($language->code == 'ar') 🇸🇦 @endif {{ $language->name }}
                                        </option>
                                    @empty
                                        <option value="en" {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                            🇬🇧 {{ __('English') }}
                                        </option>
                                    @endforelse
                                </select>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="header-right">
                    @if ($contactInfo?->top_bar_phone)
                        @php
                            $displayPhone = $contactInfo->top_bar_phone;
                            // Move + to end for Arabic language (RTL)
                            if (getSessionLanguage() == 'ar') {
                                // Remove + from start if exists
                                if (str_starts_with($displayPhone, '+')) {
                                    $displayPhone = substr($displayPhone, 1);
                                }
                                // Add + at the end
                                $displayPhone = $displayPhone . '+';
                            }
                        @endphp
                        <a href="tel:{{ $contactInfo->top_bar_phone }}" class="header-contact-item">
                            <i class="fas fa-phone"></i>
                            <span>{{ $displayPhone }}</span>
                        </a>
                    @endif
                    @if ($contactInfo?->top_bar_email)
                        <a href="mailto:{{ $contactInfo->top_bar_email }}" class="header-contact-item">
                            <i class="far fa-envelope"></i>
                            <span>{{ $contactInfo->top_bar_email }}</span>
                        </a>
                    @endif
                    @guest
                        <a href="{{ url('login') }}" class="header-contact-item account-link">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>{{ __('Login') }}</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="header-contact-item account-link">
                            <i class="fas fa-user"></i>
                            <span>{{ __('My account') }}</span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!--New Main Navigation Bar-->
    <nav class="main-navbar aman-main-nav-rtl" id="mainNavbar">
        <div class="container-fluid">
            <div class="navbar-wrapper aman-nav-wrapper-rtl">
                <div class="navbar-logo">
                    <a href="{{ url('/') }}" aria-label="{{ $setting?->app_name }}">
                        <img src="{{ asset($setting->logo) }}" alt="{{ $setting?->app_name }}" loading="lazy">
                    </a>
                </div>
                <div class="navbar-menu">
                    <ul class="nav-menu-list">
                        @if ($public_menu = mainMenu())
                            @foreach ($public_menu as $menu)
                                @php
                                    $is_child = isset($menu['child']) && is_array($menu['child']) && count($menu['child']) > 0;
                                    $icon = 'fas fa-circle';
                                    $label_lower = strtolower($menu['label']);
                                    if (strpos($label_lower, 'home') !== false || $menu['link'] == '/' || $menu['link'] == '/home') {
                                        $icon = 'fas fa-home';
                                    } elseif (strpos($label_lower, 'lawyer') !== false || strpos($label_lower, 'محام') !== false) {
                                        $icon = 'fas fa-gavel';
                                    } elseif (strpos($label_lower, 'blog') !== false || strpos($label_lower, 'مدونة') !== false) {
                                        $icon = 'fas fa-blog';
                                    } elseif (strpos($label_lower, 'about') !== false || strpos($label_lower, 'معلومات') !== false || strpos($label_lower, 'عنا') !== false) {
                                        $icon = 'fas fa-info-circle';
                                    } elseif (strpos($label_lower, 'page') !== false || strpos($label_lower, 'صفحة') !== false) {
                                        $icon = 'fas fa-file-alt';
                                    } elseif (strpos($label_lower, 'contact') !== false || strpos($label_lower, 'اتصل') !== false || strpos($label_lower, 'تواصل') !== false) {
                                        $icon = 'fas fa-envelope';
                                    } elseif (strpos($label_lower, 'service') !== false || strpos($label_lower, 'خدمة') !== false) {
                                        $icon = 'fas fa-briefcase';
                                    } elseif (strpos($label_lower, 'department') !== false || strpos($label_lower, 'قسم') !== false) {
                                        $icon = 'fas fa-building';
                                    } elseif (strpos($label_lower, 'testimonial') !== false || strpos($label_lower, 'شهادة') !== false) {
                                        $icon = 'fas fa-quote-left';
                                    } elseif (strpos($label_lower, 'faq') !== false || strpos($label_lower, 'سؤال') !== false) {
                                        $icon = 'fas fa-question-circle';
                                    } elseif (strpos($label_lower, 'real estate') !== false || strpos($label_lower, 'عقار') !== false || strpos($label_lower, 'عقارات') !== false) {
                                        $icon = 'fas fa-building';
                                    } elseif (strpos($label_lower, 'more') !== false || strpos($label_lower, 'المزيد') !== false || strpos($label_lower, 'أكثر') !== false) {
                                        $icon = 'fas fa-ellipsis-h';
                                    }
                                @endphp
                                <li class="nav-item @if($is_child) has-dropdown @endif">
                                    <a href="{{ $menu['link'] == '#' || empty($menu['link']) ? 'javascript:;' : url($menu['link']) }}"
                                       @if ($menu['open_new_tab']) target="_blank" @endif
                                       class="nav-link">
                                        <i class="{{ $icon }}"></i>
                                        <span>{{ $menu['label'] }}</span>
                                        @if($is_child)
                                            <i class="fas fa-chevron-down dropdown-icon"></i>
                                        @endif
                                    </a>
                                    @if ($is_child)
                                        <ul class="dropdown-menu">
                                            @foreach ($menu['child'] as $child)
                                                @php
                                                    $child_icon = 'fas fa-circle';
                                                    $child_label_lower = strtolower($child['label']);
                                                    if (strpos($child_label_lower, 'home') !== false || $child['link'] == '/' || $child['link'] == '/home') {
                                                        $child_icon = 'fas fa-home';
                                                    } elseif (strpos($child_label_lower, 'lawyer') !== false || strpos($child_label_lower, 'محام') !== false) {
                                                        $child_icon = 'fas fa-gavel';
                                                    } elseif (strpos($child_label_lower, 'blog') !== false || strpos($child_label_lower, 'مدونة') !== false) {
                                                        $child_icon = 'fas fa-blog';
                                                    } elseif (strpos($child_label_lower, 'about') !== false || strpos($child_label_lower, 'معلومات') !== false) {
                                                        $child_icon = 'fas fa-info-circle';
                                                    } elseif (strpos($child_label_lower, 'page') !== false || strpos($child_label_lower, 'صفحة') !== false) {
                                                        $child_icon = 'fas fa-file-alt';
                                                    } elseif (strpos($child_label_lower, 'contact') !== false || strpos($child_label_lower, 'اتصل') !== false) {
                                                        $child_icon = 'fas fa-envelope';
                                                    } elseif (strpos($child_label_lower, 'service') !== false || strpos($child_label_lower, 'خدمة') !== false) {
                                                        $child_icon = 'fas fa-briefcase';
                                                    } elseif (strpos($child_label_lower, 'department') !== false || strpos($child_label_lower, 'قسم') !== false) {
                                                        $child_icon = 'fas fa-building';
                                                    } elseif (strpos($child_label_lower, 'testimonial') !== false || strpos($child_label_lower, 'شهادة') !== false) {
                                                        $child_icon = 'fas fa-quote-left';
                                                    } elseif (strpos($child_label_lower, 'faq') !== false || strpos($child_label_lower, 'سؤال') !== false) {
                                                        $child_icon = 'fas fa-question-circle';
                                                    } elseif (strpos($child_label_lower, 'real estate') !== false || strpos($child_label_lower, 'عقار') !== false || strpos($child_label_lower, 'عقارات') !== false) {
                                                        $child_icon = 'fas fa-building';
                                                    } else {
                                                        $child_icon = 'fas fa-chevron-right';
                                                    }
                                                @endphp
                                                <li>
                                                    <a href="{{ $child['link'] == '#' || empty($child['link']) ? 'javascript:;' : url($child['link']) }}"
                                                       @if ($child['open_new_tab']) target="_blank" @endif>
                                                        <i class="{{ $child_icon }}"></i>
                                                        <span>{{ $child['label'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            <li class="nav-item appointment-btn-wrapper">
                                <a href="{{ route('website.book.consultation.appointment') }}" class="nav-link appointment-btn">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>{{ __('Book Consultation Appointment') }}</span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link" aria-label="{{ __('Home') }}">
                                    <i class="fas fa-home"></i>
                                    <span>{{ __('Home') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>
    @php
        $getDepartments = getDepartments();
    @endphp

    <!--New Mobile Side Menu-->
    <div class="mobile-side-menu" id="mobileSideMenu">
        <div class="side-menu-overlay" onclick="toggleMobileMenu()"></div>
        <div class="side-menu-content">
            <div class="side-menu-header">
                <a href="{{ url('/') }}" class="side-menu-logo" aria-label="{{ $setting?->app_name }}">
                    <img src="{{ url($setting->logo) }}" alt="{{ $setting?->app_name }}" loading="lazy">
                </a>
                <button class="side-menu-close" onclick="toggleMobileMenu()" aria-label="Close Menu" title="{{ __('Close Menu') }}">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Header Items in Side Menu -->
            <div class="side-menu-header-items">
                <div class="side-menu-cart">
                    <a href="{{ route('client.payment') }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ __('Appointment List') }}</span>
                        <i class="fas fa-shopping-cart aman-menu-icon-rtl"></i>
                        @if(Cart::count() > 0)
                            <span class="side-menu-badge">{{ Cart::count() }}</span>
                        @endif
                    </a>
                </div>
                @if ($contactInfo?->top_bar_phone)
                    @php
                        $displayPhone = $contactInfo->top_bar_phone;
                        // Move + to end for Arabic language (RTL)
                        if (getSessionLanguage() == 'ar') {
                            // Remove + from start if exists
                            if (str_starts_with($displayPhone, '+')) {
                                $displayPhone = substr($displayPhone, 1);
                            }
                            // Add + at the end
                            $displayPhone = $displayPhone . '+';
                        }
                    @endphp
                    <a href="tel:{{ $contactInfo->top_bar_phone }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ $displayPhone }}</span>
                        <i class="fas fa-phone aman-menu-icon-rtl"></i>
                    </a>
                @endif
                @if ($contactInfo?->top_bar_email)
                    <a href="mailto:{{ $contactInfo->top_bar_email }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ $contactInfo->top_bar_email }}</span>
                        <i class="far fa-envelope aman-menu-icon-rtl"></i>
                    </a>
                @endif
                @guest
                    <a href="{{ url('login') }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ __('Login') }}</span>
                        <i class="fas fa-sign-in-alt aman-menu-icon-rtl"></i>
                    </a>
                    <a href="{{ url('register') }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ __('Register') }}</span>
                        <i class="fas fa-user-plus aman-menu-icon-rtl"></i>
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="side-menu-header-link aman-menu-link-rtl">
                        <span class="aman-menu-text-rtl">{{ __('My account') }}</span>
                        <i class="fas fa-user aman-menu-icon-rtl"></i>
                    </a>
                @endguest
                @if (allCurrencies()?->where('status', 'active')->count() > 1 || allLanguages()?->where('status', 1)->count() > 1)
                    <div class="side-menu-selectors">
                        @if (allCurrencies()?->where('status', 'active')->count() > 1)
                            <form id="setCurrencySideMenu" action="{{ route('set-currency') }}" method="get" class="side-menu-form">
                                <select class="side-menu-select" name="currency" onchange="this.form.submit()">
                                    @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                        <option value="{{ $currency->currency_code }}"
                                            {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                            {{ $currency->currency_name }}
                                        </option>
                                    @empty
                                        <option value="USD" {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                            {{ __('USD') }}
                                        </option>
                                    @endforelse
                                </select>
                            </form>
                        @endif
                        @if (allLanguages()?->where('status', 1)->count() > 1)
                            <form id="setLanguageSideMenu" action="{{ route('set-language') }}" method="get" class="side-menu-form">
                                <select class="side-menu-select" name="code" onchange="this.form.submit()">
                                    @forelse (allLanguages()?->where('status', 1) as $language)
                                        <option value="{{ $language->code }}"
                                            {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                            @if($language->code == 'en') 🇬🇧 @elseif($language->code == 'ar') 🇸🇦 @endif {{ $language->name }}
                                        </option>
                                    @empty
                                        <option value="en" {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                            🇬🇧 {{ __('English') }}
                                        </option>
                                    @endforelse
                                </select>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
            
            <div class="side-menu-body">
                @if ($public_menu = mainMenu())
                    <ul class="side-menu-list">
                        @foreach ($public_menu as $menu)
                            @php
                                $is_child = isset($menu['child']) && is_array($menu['child']) && count($menu['child']) > 0;
                                $icon = 'fas fa-circle';
                                $label_lower = strtolower($menu['label']);
                                if (strpos($label_lower, 'home') !== false || $menu['link'] == '/' || $menu['link'] == '/home') {
                                    $icon = 'fas fa-home';
                                } elseif (strpos($label_lower, 'lawyer') !== false || strpos($label_lower, 'محام') !== false) {
                                    $icon = 'fas fa-gavel';
                                } elseif (strpos($label_lower, 'blog') !== false || strpos($label_lower, 'مدونة') !== false) {
                                    $icon = 'fas fa-blog';
                                } elseif (strpos($label_lower, 'about') !== false || strpos($label_lower, 'معلومات') !== false || strpos($label_lower, 'عنا') !== false) {
                                    $icon = 'fas fa-info-circle';
                                } elseif (strpos($label_lower, 'page') !== false || strpos($label_lower, 'صفحة') !== false) {
                                    $icon = 'fas fa-file-alt';
                                } elseif (strpos($label_lower, 'contact') !== false || strpos($label_lower, 'اتصل') !== false || strpos($label_lower, 'تواصل') !== false) {
                                    $icon = 'fas fa-envelope';
                                } elseif (strpos($label_lower, 'service') !== false || strpos($label_lower, 'خدمة') !== false) {
                                    $icon = 'fas fa-briefcase';
                                } elseif (strpos($label_lower, 'department') !== false || strpos($label_lower, 'قسم') !== false) {
                                    $icon = 'fas fa-building';
                                } elseif (strpos($label_lower, 'testimonial') !== false || strpos($label_lower, 'شهادة') !== false) {
                                    $icon = 'fas fa-quote-left';
                                } elseif (strpos($label_lower, 'faq') !== false || strpos($label_lower, 'سؤال') !== false) {
                                    $icon = 'fas fa-question-circle';
                                } elseif (strpos($label_lower, 'real estate') !== false || strpos($label_lower, 'عقار') !== false || strpos($label_lower, 'عقارات') !== false) {
                                    $icon = 'fas fa-building';
                                } elseif (strpos($label_lower, 'more') !== false || strpos($label_lower, 'المزيد') !== false || strpos($label_lower, 'أكثر') !== false) {
                                    $icon = 'fas fa-ellipsis-h';
                                }
                            @endphp
                            <li class="side-menu-item @if($is_child) has-submenu @endif">
                                @if($is_child)
                                    <a href="javascript:;" class="side-menu-link aman-menu-link-rtl" onclick="toggleSubmenu(this)">
                                        <span class="aman-menu-text-rtl">{{ $menu['label'] }}</span>
                                        <i class="{{ $icon }} aman-menu-icon-rtl"></i>
                                        <i class="fas fa-chevron-down submenu-toggle aman-submenu-toggle-rtl"></i>
                                    </a>
                                    <ul class="side-submenu">
                                        @foreach ($menu['child'] as $child)
                                            @php
                                                $child_icon = 'fas fa-circle';
                                                $child_label_lower = strtolower($child['label']);
                                                if (strpos($child_label_lower, 'home') !== false || $child['link'] == '/' || $child['link'] == '/home') {
                                                    $child_icon = 'fas fa-home';
                                                } elseif (strpos($child_label_lower, 'lawyer') !== false || strpos($child_label_lower, 'محام') !== false) {
                                                    $child_icon = 'fas fa-gavel';
                                                } elseif (strpos($child_label_lower, 'blog') !== false || strpos($child_label_lower, 'مدونة') !== false) {
                                                    $child_icon = 'fas fa-blog';
                                                } elseif (strpos($child_label_lower, 'about') !== false || strpos($child_label_lower, 'معلومات') !== false) {
                                                    $child_icon = 'fas fa-info-circle';
                                                } elseif (strpos($child_label_lower, 'page') !== false || strpos($child_label_lower, 'صفحة') !== false) {
                                                    $child_icon = 'fas fa-file-alt';
                                                } elseif (strpos($child_label_lower, 'contact') !== false || strpos($child_label_lower, 'اتصل') !== false) {
                                                    $child_icon = 'fas fa-envelope';
                                                } elseif (strpos($child_label_lower, 'service') !== false || strpos($child_label_lower, 'خدمة') !== false) {
                                                    $child_icon = 'fas fa-briefcase';
                                                } elseif (strpos($child_label_lower, 'department') !== false || strpos($child_label_lower, 'قسم') !== false) {
                                                    $child_icon = 'fas fa-building';
                                                } elseif (strpos($child_label_lower, 'testimonial') !== false || strpos($child_label_lower, 'شهادة') !== false) {
                                                    $child_icon = 'fas fa-quote-left';
                                                } elseif (strpos($child_label_lower, 'faq') !== false || strpos($child_label_lower, 'سؤال') !== false) {
                                                    $child_icon = 'fas fa-question-circle';
                                                } elseif (strpos($child_label_lower, 'real estate') !== false || strpos($child_label_lower, 'عقار') !== false || strpos($child_label_lower, 'عقارات') !== false) {
                                                    $child_icon = 'fas fa-building';
                                                } else {
                                                    $child_icon = 'fas fa-chevron-right';
                                                }
                                            @endphp
                                            <li>
                                                <a href="{{ $child['link'] == '#' || empty($child['link']) ? 'javascript:;' : url($child['link']) }}"
                                                   @if ($child['open_new_tab']) target="_blank" @endif
                                                   class="aman-submenu-link-rtl">
                                                    <span class="aman-menu-text-rtl">{{ $child['label'] }}</span>
                                                    <i class="{{ $child_icon }} aman-menu-icon-rtl"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ $menu['link'] == '#' || empty($menu['link']) ? 'javascript:;' : url($menu['link']) }}"
                                       @if ($menu['open_new_tab']) target="_blank" @endif
                                       class="side-menu-link aman-menu-link-rtl">
                                        <span class="aman-menu-text-rtl">{{ $menu['label'] }}</span>
                                        <i class="{{ $icon }} aman-menu-icon-rtl"></i>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                        <li class="side-menu-item appointment-item">
                            <a href="{{ route('website.book.consultation.appointment') }}" class="side-menu-link appointment-link aman-menu-link-rtl">
                                <span class="aman-menu-text-rtl">{{ __('Book Consultation Appointment') }}</span>
                                <i class="fas fa-calendar-check aman-menu-icon-rtl"></i>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="side-menu-list">
                        <li class="side-menu-item">
                            <a href="{{ route('home') }}" class="side-menu-link" aria-label="{{ __('Home') }}">
                                <i class="fas fa-home"></i>
                                <span>{{ __('Home') }}</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="appointment_modal" role="dialog" aria-labelledby="exampleModalLabelTwo"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelTwo">{{ __('Create Appointment') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body book-appointment">
                    <form action="{{ url('create-appointment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('Select Department') }}</label>
                            <select name="department_id" onchange="loadlawyer()" class="department-id modal_select2">
                                <option value="">{{ __('Select Department') }}</option>
                                @foreach ($getDepartments as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group d-none" id="modal-lawyer-box">
                            <label for="">{{ __('Select Lawyer') }}</label>
                            <select name="" class="lawyer-id form-select" onchange="loadDate()">
                                <option value="">{{ __('Select Lawyer') }}</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="modal-date-box">
                            <label for="">{{ __('Select Date') }}</label>
                            <input type="text" name="date" class="form-control datepicker"
                                id="modal-datepicker-value">
                            <input type="hidden" name="lawyer_id" value="" id="modal_lawyer_id">
                        </div>
                        <div class="form-group d-none" id="modal-schedule-box">
                            <label for="">{{ __('Select Schedule') }}</label>
                            <select name="schedule_id" class="form-select modal_select2"
                                id="available-modal-schedule">

                            </select>
                        </div>
                        <div id="modal-schedule-error" class="d-none"></div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <input type="submit" value="{{ __('Submit') }}" class="btn btn-primary"
                                id="modal-sub" disabled>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- // Modal -->

    <!-- WhatsApp Floating Button -->
    @if ($contactInfo?->top_bar_phone || $contactInfo?->phone)
        @php
            $whatsappNumber = $contactInfo?->top_bar_phone ?: $contactInfo?->phone;
            // Remove any non-numeric characters except + for WhatsApp
            $whatsappNumber = preg_replace('/[^0-9+]/', '', $whatsappNumber);
            // If number doesn't start with +, add country code (default +963 for Syria)
            if (!str_starts_with($whatsappNumber, '+')) {
                $whatsappNumber = '+963' . ltrim($whatsappNumber, '0');
            }
        @endphp
        <a href="https://wa.me/{{ $whatsappNumber }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="whatsapp-float" 
           aria-label="{{ __('Contact us on WhatsApp') }}"
           title="{{ __('Contact us on WhatsApp') }}">
            <i class="fab fa-whatsapp"></i>
            <span class="whatsapp-tooltip">{{ __('Chat with us') }}</span>
        </a>
    @endif
