@php
/**
 * @var \Gloudemans\Shoppingcart\Facades\Cart $cart
 */
@endphp
<!DOCTYPE html>
@php
    $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'rtl');
@endphp
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ $textDirection }}">

<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $appName = $setting->app_name;
        $currentUrl = url()->current();
        $currentLang = app()->getLocale();
        $siteUrl = url('/');
        
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
        
        // Get default SEO data
        $defaultSeo = seoSetting()->where('page_name', 'Home')->first();
        $defaultTitle = $defaultSeo?->seo_title ?? $appName;
        $defaultDescription = $defaultSeo?->seo_description ?? $appName;
        $defaultImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
        
        // Get all languages for hreflang
        $languages = allLanguages()?->where('status', 1) ?? collect();
    @endphp

    <!-- Title -->
    @yield('title')
    
    <!-- Default Meta Tags -->
    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="description" content="{{ $defaultDescription }}">
        <meta name="keywords" content="{{ __('lawyer, legal services, consultation, law firm, محامي, خدمات قانونية, استشارة قانونية') }}">
        <meta name="author" content="{{ $appName }}">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <meta name="googlebot" content="index, follow">
        <meta name="language" content="{{ $currentLang }}">
        <meta name="revisit-after" content="7 days">
    @endif
    
    <!-- Canonical URL -->
    @hasSection('canonical')
        @yield('canonical')
    @else
        <link rel="canonical" href="{{ $currentUrl }}">
    @endif
    
    <!-- Open Graph Meta Tags -->
    @hasSection('og_meta')
        @yield('og_meta')
    @else
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $currentUrl }}">
        <meta property="og:title" content="{{ $defaultTitle }}">
        <meta property="og:description" content="{{ $defaultDescription }}">
        <meta property="og:image" content="{{ $defaultImage }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:site_name" content="{{ $appName }}">
        <meta property="og:locale" content="{{ $currentLang == 'ar' ? 'ar_SY' : 'en_US' }}">
    @endif
    
    <!-- Twitter Card Meta Tags -->
    @hasSection('twitter_meta')
        @yield('twitter_meta')
    @else
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ $currentUrl }}">
        <meta name="twitter:title" content="{{ $defaultTitle }}">
        <meta name="twitter:description" content="{{ $defaultDescription }}">
        <meta name="twitter:image" content="{{ $defaultImage }}">
    @endif
    
    <!-- Language Alternates (hreflang) -->
    @if($languages->count() > 1)
        @foreach($languages as $lang)
            @php
                $langUrl = $currentUrl;
                // Replace language in URL if needed
                if (strpos($langUrl, '/ar/') !== false || strpos($langUrl, '/en/') !== false) {
                    $langUrl = preg_replace('/\/(ar|en)\//', '/' . $lang->code . '/', $langUrl);
                } else {
                    // Add language prefix if not exists
                    $langUrl = rtrim($siteUrl, '/') . '/' . $lang->code . str_replace($siteUrl, '', $currentUrl);
                }
            @endphp
            <link rel="alternate" hreflang="{{ $lang->code }}" href="{{ $langUrl }}">
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ $currentUrl }}">
    @endif
    
    <!-- Additional Meta Tags -->
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="{{ $appName }}">
    
    <!-- Structured Data (JSON-LD) - Organization -->
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LegalService",
            "name": "{{ $appName }}",
            "description": "{{ $defaultDescription }}",
            "url": "{{ $siteUrl }}",
            "logo": "{{ $defaultImage }}",
            @if($contactInfo?->top_bar_phone)
            "telephone": "{{ $contactInfo->top_bar_phone }}",
            @endif
            @if($contactInfo?->top_bar_email)
            "email": "{{ $contactInfo->top_bar_email }}",
            @endif
            @if($contactInfo?->address)
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $contactInfo->address }}"
            },
            @endif
            "sameAs": [
                @if($socialLinks = getSocialLinks())
                    @foreach($socialLinks as $index => $social)
                        "{{ $social->link }}"@if(!$loop->last),@endif
                    @endforeach
                @endif
            ]
        }
        </script>
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) ?? '' }}">
    <link rel="apple-touch-icon" href="{{ asset($setting->favicon) ?? '' }}">

    @include('layouts.client.style')
    @stack('css')
    @if (customCode()?->css)
        @php
            $customCss = customCode()->css;
        @endphp
        <style>
            /* Custom CSS - Dynamically injected */
            /* css-validator-disable */
            /* css-validator-enable */
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
        @php
            $customHeaderJs = customCode()->header_javascript;
        @endphp
        <script>
            /* eslint-disable */
            /* jshint ignore:start */
            "use strict";
            // Custom JavaScript - Dynamically injected
            /* jshint ignore:end */
            /* eslint-enable */
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
            <div class="status" style="background-image: url('{{ url($setting->preloader_image) }}')"></div>
        </div>
    @endif
    <!--Preloader End-->
    @if (customCode()?->body_javascript)
        @php
            $customBodyJs = customCode()->body_javascript;
        @endphp
        <script>
            /* eslint-disable */
            /* jshint ignore:start */
            "use strict";
            // Custom JavaScript - Dynamically injected
            /* jshint ignore:end */
            /* eslint-enable */
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
                            @php
                                /** @var \Gloudemans\Shoppingcart\Facades\Cart $cart */
                                $cartCount = \Gloudemans\Shoppingcart\Facades\Cart::count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
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
                                <a href="{{ route('website.book.consultation.appointment') }}" class="nav-link book-appointment-btn-desktop">
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
            
            <!-- Mobile Menu Items -->
            <div class="mobile-menu-items">
                <!-- Quick Actions -->
                <div class="mobile-menu-section">
                    <a href="{{ route('client.payment') }}" class="mobile-menu-item">
                        <span class="mobile-menu-text">{{ __('Appointment List') }}</span>
                        <i class="fas fa-shopping-cart mobile-menu-icon"></i>
                        @php
                            /** @var \Gloudemans\Shoppingcart\Facades\Cart $cart */
                            $cartCount = \Gloudemans\Shoppingcart\Facades\Cart::count();
                        @endphp
                        @if($cartCount > 0)
                            <span class="mobile-menu-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @if ($contactInfo?->top_bar_phone)
                        @php
                            $displayPhone = $contactInfo->top_bar_phone;
                            if (getSessionLanguage() == 'ar') {
                                if (str_starts_with($displayPhone, '+')) {
                                    $displayPhone = substr($displayPhone, 1);
                                }
                                $displayPhone = $displayPhone . '+';
                            }
                        @endphp
                        <a href="tel:{{ $contactInfo->top_bar_phone }}" class="mobile-menu-item">
                            <span class="mobile-menu-text">{{ $displayPhone }}</span>
                            <i class="fas fa-phone mobile-menu-icon"></i>
                        </a>
                    @endif
                    @if ($contactInfo?->top_bar_email)
                        <a href="mailto:{{ $contactInfo->top_bar_email }}" class="mobile-menu-item">
                            <span class="mobile-menu-text">{{ $contactInfo->top_bar_email }}</span>
                            <i class="far fa-envelope mobile-menu-icon"></i>
                        </a>
                    @endif
                    @guest
                        <a href="{{ url('login') }}" class="mobile-menu-item">
                            <span class="mobile-menu-text">{{ __('Login') }}</span>
                            <i class="fas fa-sign-in-alt mobile-menu-icon"></i>
                        </a>
                        <a href="{{ url('register') }}" class="mobile-menu-item">
                            <span class="mobile-menu-text">{{ __('Register') }}</span>
                            <i class="fas fa-user-plus mobile-menu-icon"></i>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="mobile-menu-item">
                            <span class="mobile-menu-text">{{ __('My account') }}</span>
                            <i class="fas fa-user mobile-menu-icon"></i>
                        </a>
                    @endguest
                </div>

                <!-- Main Navigation -->
                <div class="mobile-menu-section">
                    @if ($public_menu = mainMenu())
                        <ul class="mobile-menu-list">
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
                                <li class="mobile-menu-list-item @if($is_child) has-submenu @endif">
                                    @if($is_child)
                                        <a href="javascript:;" class="mobile-menu-item" onclick="toggleSubmenu(this)">
                                            <span class="mobile-menu-text">{{ $menu['label'] }}</span>
                                            <i class="{{ $icon }} mobile-menu-icon"></i>
                                            <i class="fas fa-chevron-down mobile-submenu-toggle"></i>
                                        </a>
                                        <ul class="mobile-submenu">
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
                                                       class="mobile-menu-item">
                                                        <span class="mobile-menu-text">{{ $child['label'] }}</span>
                                                        <i class="{{ $child_icon }} mobile-menu-icon"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <a href="{{ $menu['link'] == '#' || empty($menu['link']) ? 'javascript:;' : url($menu['link']) }}"
                                           @if ($menu['open_new_tab']) target="_blank" @endif
                                           class="mobile-menu-item">
                                            <span class="mobile-menu-text">{{ $menu['label'] }}</span>
                                            <i class="{{ $icon }} mobile-menu-icon"></i>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                            <li class="mobile-menu-list-item book-appointment-item-mobile">
                                <a href="{{ route('website.book.consultation.appointment') }}" class="book-appointment-btn-mobile">
                                    <span class="book-appointment-text">{{ __('Book Consultation Appointment') }}</span>
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul class="mobile-menu-list">
                            <li class="mobile-menu-list-item">
                                <a href="{{ route('home') }}" class="mobile-menu-item" aria-label="{{ __('Home') }}">
                                    <span class="mobile-menu-text">{{ __('Home') }}</span>
                                    <i class="fas fa-home mobile-menu-icon"></i>
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>

                <!-- Language & Currency Selectors -->
                @if (allCurrencies()?->where('status', 'active')->count() > 1 || allLanguages()?->where('status', 1)->count() > 1)
                    <div class="mobile-menu-section">
                        @if (allCurrencies()?->where('status', 'active')->count() > 1)
                            <form id="setCurrencyMobileMenu" action="{{ route('set-currency') }}" method="get" class="mobile-menu-form">
                                <select class="mobile-menu-select" name="currency" onchange="this.form.submit()">
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
                            <form id="setLanguageMobileMenu" action="{{ route('set-language') }}" method="get" class="mobile-menu-form">
                                <select class="mobile-menu-select" name="code" onchange="this.form.submit()">
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

@push('css')
<style>
    /* ============================================
       BOOK APPOINTMENT BUTTON - DESKTOP (NEW CLASSES)
       ============================================ */
    .book-appointment-btn-desktop,
    a.book-appointment-btn-desktop,
    .nav-link.book-appointment-btn-desktop,
    .appointment-btn-wrapper .book-appointment-btn-desktop,
    body.client-frontend .book-appointment-btn-desktop,
    body.client-frontend a.book-appointment-btn-desktop,
    body.client-frontend .nav-link.book-appointment-btn-desktop,
    body.client-frontend .appointment-btn-wrapper .book-appointment-btn-desktop {
        background: #C89B6C !important;
        background-color: #C89B6C !important;
        background-image: none !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 22px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        position: relative !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 3px 12px rgba(200, 155, 108, 0.35) !important;
        text-transform: none !important;
        letter-spacing: 0.2px !important;
        white-space: nowrap !important;
        min-width: auto !important;
    }
    
    .book-appointment-btn-desktop:hover,
    a.book-appointment-btn-desktop:hover,
    .nav-link.book-appointment-btn-desktop:hover,
    body.client-frontend .book-appointment-btn-desktop:hover {
        background: #D4A574 !important;
        background-color: #D4A574 !important;
        background-image: none !important;
        transform: translateY(-2px) scale(1.03) !important;
        box-shadow: 0 5px 20px rgba(200, 155, 108, 0.5) !important;
    }
    
    .book-appointment-btn-desktop i {
        font-size: 16px !important;
        color: #ffffff !important;
    }
    
    .book-appointment-btn-desktop span {
        color: #ffffff !important;
        font-weight: 600 !important;
    }
    
    @media (max-width: 991px) {
        .book-appointment-btn-desktop {
            padding: 9px 18px !important;
            font-size: 13px !important;
        }
        
        .book-appointment-btn-desktop i {
            font-size: 15px !important;
        }
    }
    
    @media (max-width: 768px) {
        .book-appointment-btn-desktop {
            padding: 8px 16px !important;
            font-size: 12px !important;
            gap: 6px !important;
        }
        
        .book-appointment-btn-desktop i {
            font-size: 14px !important;
        }
    }
    
    /* ============================================
       BOOK APPOINTMENT BUTTON - MOBILE (NEW CLASSES)
       ============================================ */
    .book-appointment-btn-mobile,
    a.book-appointment-btn-mobile,
    .book-appointment-item-mobile .book-appointment-btn-mobile,
    .mobile-menu-list-item .book-appointment-btn-mobile,
    body.client-frontend .book-appointment-btn-mobile,
    body.client-frontend a.book-appointment-btn-mobile,
    body.client-frontend .book-appointment-item-mobile .book-appointment-btn-mobile {
        background: #C89B6C !important;
        background-color: #C89B6C !important;
        background-image: none !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 14px 24px !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        text-decoration: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        position: relative !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 16px rgba(200, 155, 108, 0.5), 0 2px 8px rgba(0, 0, 0, 0.15) !important;
        text-transform: none !important;
        letter-spacing: 0.3px !important;
        white-space: nowrap !important;
        width: calc(100% - 30px) !important;
        max-width: 95% !important;
        margin: 15px auto !important;
        z-index: 10 !important;
    }
    
    .book-appointment-btn-mobile:hover,
    a.book-appointment-btn-mobile:hover,
    body.client-frontend .book-appointment-btn-mobile:hover {
        background: #D4A574 !important;
        background-color: #D4A574 !important;
        background-image: none !important;
        box-shadow: 0 6px 24px rgba(200, 155, 108, 0.6), 0 3px 12px rgba(0, 0, 0, 0.2) !important;
        transform: translateY(-3px) scale(1.05) !important;
    }
    
    .book-appointment-btn-mobile i {
        font-size: 18px !important;
        color: #ffffff !important;
    }
    
    .book-appointment-text {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 15px !important;
    }
    
    .book-appointment-item-mobile {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        list-style: none !important;
        width: 100% !important;
    }
    
    /* جعل الزر بارز أكثر في الموبايل */
    @media (max-width: 768px) {
        .book-appointment-btn-mobile {
            padding: 16px 28px !important;
            font-size: 16px !important;
            margin: 20px auto !important;
            box-shadow: 0 5px 20px rgba(200, 155, 108, 0.6), 0 3px 10px rgba(0, 0, 0, 0.2) !important;
        }
        
        .book-appointment-btn-mobile i {
            font-size: 20px !important;
        }
        
        .book-appointment-text {
            font-size: 16px !important;
        }
    }
    
    /* Enhanced Book Appointment Button Design */
    .appointment-btn {
        background: linear-gradient(135deg, #C89B6C 0%, #B8860B 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 35px !important;
        padding: 10px 22px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        position: relative !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 3px 12px rgba(184, 134, 11, 0.35) !important;
        text-transform: none !important;
        letter-spacing: 0.2px !important;
        white-space: nowrap !important;
    }
    
    /* Mobile Appointment Button - Smaller and More Elegant */
    .mobile-appointment-btn {
        color: #ffffff !important;
        border: none !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        text-transform: none !important;
        letter-spacing: 0.2px !important;
        white-space: nowrap !important;
        font-weight: 600 !important;
    }
    
    /* Animated Background Gradient */
    .appointment-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transition: left 0.5s ease;
    }
    
    .appointment-btn:hover::before {
        left: 100%;
    }
    
    /* Mobile Button Shine Effect */
    .mobile-appointment-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transition: left 0.5s ease;
    }
    
    .mobile-appointment-btn:hover::before {
        left: 100%;
    }
    
    /* Hover Effects */
    .appointment-btn:hover {
        transform: translateY(-2px) scale(1.03) !important;
        box-shadow: 0 5px 20px rgba(184, 134, 11, 0.5) !important;
        background: linear-gradient(135deg, #D4A574 0%, #DAA520 100%) !important;
    }
    
    .appointment-btn:active {
        transform: translateY(-1px) scale(0.98) !important;
    }
    
    .mobile-appointment-btn:active {
        transform: translateY(-1px) scale(0.97) !important;
    }
    
    /* Icon Animation */
    .appointment-btn i {
        font-size: 16px !important;
        transition: all 0.3s ease !important;
        position: relative;
        z-index: 1;
    }
    
    .appointment-btn:hover i {
        transform: scale(1.2) rotate(5deg) !important;
    }
    
    .mobile-appointment-btn i {
        transition: all 0.3s ease !important;
        position: relative;
        z-index: 1;
    }
    
    .mobile-appointment-btn:hover i {
        transform: scale(1.15) !important;
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: rotate(15deg) scale(1.1);
        }
        50% {
            transform: rotate(15deg) scale(1.2);
        }
    }
    
    /* Text Styling */
    .appointment-btn span {
        position: relative;
        z-index: 1;
        font-weight: 600 !important;
    }
    
    .mobile-appointment-btn .mobile-menu-text {
        position: relative;
        z-index: 1;
        font-weight: 600 !important;
    }
    
    /* Mobile Menu Button Specific */
    .mobile-appointment-btn {
        width: auto !important;
        max-width: 90% !important;
        margin: 8px auto !important;
        border-radius: 30px !important;
        padding: 10px 20px !important;
        font-size: 13px !important;
        gap: 8px !important;
        align-self: center !important;
        background: linear-gradient(135deg, #C89B6C 0%, #B8860B 100%) !important;
        box-shadow: 0 3px 12px rgba(184, 134, 11, 0.35) !important;
    }
    
    .mobile-appointment-btn i {
        font-size: 14px !important;
    }
    
    .mobile-appointment-btn:hover {
        background: linear-gradient(135deg, #D4A574 0%, #DAA520 100%) !important;
        box-shadow: 0 5px 18px rgba(184, 134, 11, 0.45) !important;
        transform: translateY(-2px) scale(1.03) !important;
    }
    
    .mobile-appointment-item {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        display: flex !important;
        justify-content: center !important;
    }
    
    /* Desktop Navbar Button */
    .appointment-btn-wrapper {
        margin-left: 15px !important;
    }
    
    .appointment-btn {
        min-width: auto !important;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .appointment-btn {
            padding: 9px 18px !important;
            font-size: 13px !important;
        }
        
        .appointment-btn i {
            font-size: 15px !important;
        }
    }
    
    @media (max-width: 768px) {
        .appointment-btn {
            padding: 8px 16px !important;
            font-size: 12px !important;
            gap: 6px !important;
        }
        
        .appointment-btn i {
            font-size: 14px !important;
        }
    }
    
    /* Side Menu Mobile - Smaller Width */
    @media (max-width: 991px) {
        .side-menu-content {
            width: 280px !important;
            max-width: 75vw !important;
        }
    }
    
    @media (max-width: 768px) {
        .side-menu-content {
            width: 260px !important;
            max-width: 70vw !important;
        }
    }
    
    @media (max-width: 480px) {
        .side-menu-content {
            width: 240px !important;
            max-width: 65vw !important;
        }
    }
    
    /* Mobile Menu Items - Compact Design */
    .mobile-menu-list-item {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .mobile-menu-item {
        width: 100% !important;
        padding: 12px 18px !important;
        font-size: 14px !important;
    }
    
    .mobile-menu-text {
        font-size: 14px !important;
    }
    
    .mobile-menu-icon {
        font-size: 16px !important;
    }
</style>
@endpush
