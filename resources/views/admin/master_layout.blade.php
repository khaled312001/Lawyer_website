@php
    $header_admin = Auth::guard('admin')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    @yield('title')
    <link rel="icon" href="{{ asset($setting->favicon) }}">
    @include('backend_layouts.partials.styles')
    @stack('css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar px-3 py-2">
                <div class="navbar-left d-flex align-items-center">
                    {{-- Mobile Burger Menu Button (Left) --}}
                    <button class="navbar-toggler d-lg-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbarMenu" aria-controls="mobileNavbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    {{-- Desktop Sidebar Toggle --}}
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg me-3 d-none d-lg-block">
                        <i class="fas fa-bars"></i>
                    </a>
                    
                    {{-- Logo --}}
                    <a href="{{ route('admin.dashboard') }}" class="navbar-logo d-flex align-items-center me-3">
                        <img src="{{ asset($setting->logo) ?? asset($setting->favicon) }}" alt="{{ $setting->app_name ?? '' }}" class="navbar-logo-img">
                    </a>
                    
                    {{-- Desktop Menu Items --}}
                    <div class="d-none d-lg-flex align-items-center">
                        {{-- language select --}}
                        @include('backend_layouts.partials.language_select')
                        {{-- currency select --}}
                        @include('backend_layouts.partials.currency_select')
                    </div>
                </div>
                
                <div class="navbar-center me-auto search-box position-relative d-none d-md-block">
                    <x-admin.form-input id="search_menu" :placeholder="__('Search option')" />
                    <div id="admin_menu_list" class="position-absolute d-none rounded-2">
                        @foreach (App\Enums\RouteList::getAll() as $route_item)
                            @if (checkAdminHasPermission($route_item?->permission) || empty($route_item?->permission))
                                <a @isset($route_item->tab)
                                        data-active-tab="{{ $route_item->tab }}" class="border-bottom search-menu-item"
                                    @else
                                        class="border-bottom"
                                    @endisset
                                    href="{{ $route_item?->route }}">{{ $route_item?->name }}</a>
                            @endif
                        @endforeach
                        <a class="not-found-message d-none" href="javascript:;">{{ __('Not Found!') }}</a>
                    </div>
                </div>
                
                <div class="navbar-right d-flex align-items-center">
                    <ul class="navbar-nav d-none d-lg-flex align-items-center">
                        <li class="dropdown dropdown-list-toggle">
                            <a target="_blank" href="{{ route('home') }}" class="nav-link nav-link-lg p-0">
                                <i class="fas fa-home"></i> <span class="d-md-none d-lg-inline-block">{{ __('Visit Website') }}</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image"
                                    src="{{ !empty($header_admin->image) ? asset($header_admin->image) : asset($setting->default_avatar) }}"
                                    class="me-1 my-1 rounded-circle">
                                <div class="d-sm-none d-lg-inline-block">{{ $header_admin->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @adminCan('admin.profile.view')
                                    <a href="{{ route('admin.edit-profile') }}"
                                        class="dropdown-item has-icon d-flex align-items-center {{ isRoute('admin.edit-profile', 'text-primary') }}">
                                        <i class="far fa-user"></i> {{ __('Profile') }}
                                    </a>
                                @endadminCan
                                @adminCan('setting.view')
                                    <a href="{{ route('admin.settings') }}"
                                        class="dropdown-item has-icon d-flex align-items-center {{ isRoute('admin.settings', 'text-primary') }}">
                                        <i class="fas fa-cog"></i> {{ __('Setting') }}
                                    </a>
                                @endadminCan
                                <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center"
                                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            {{-- Mobile Menu --}}
            <div class="collapse navbar-collapse mobile-navbar-menu d-lg-none" id="mobileNavbarMenu">
                <div class="mobile-menu-content">
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Search') }}</h6>
                        <div class="search-box-mobile position-relative mb-3">
                            <x-admin.form-input id="search_menu_mobile" :placeholder="__('Search option')" />
                            <div id="admin_menu_list_mobile" class="position-absolute d-none rounded-2 w-100">
                                @foreach (App\Enums\RouteList::getAll() as $route_item)
                                    @if (checkAdminHasPermission($route_item?->permission) || empty($route_item?->permission))
                                        <a @isset($route_item->tab)
                                                data-active-tab="{{ $route_item->tab }}" class="border-bottom search-menu-item"
                                            @else
                                                class="border-bottom"
                                            @endisset
                                            href="{{ $route_item?->route }}">{{ $route_item?->name }}</a>
                                    @endif
                                @endforeach
                                <a class="not-found-message d-none" href="javascript:;">{{ __('Not Found!') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Language & Currency') }}</h6>
                        <div class="d-flex flex-column gap-2">
                            @include('backend_layouts.partials.language_select')
                            @include('backend_layouts.partials.currency_select')
                        </div>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Quick Actions') }}</h6>
                        <a target="_blank" href="{{ route('home') }}" class="mobile-menu-item">
                            <i class="fas fa-home"></i> {{ __('Visit Website') }}
                        </a>
                    </div>
                    
                    <div class="mobile-menu-section">
                        <h6 class="mobile-menu-title">{{ __('Account') }}</h6>
                        <div class="mobile-user-info mb-3">
                            <img alt="image"
                                src="{{ !empty($header_admin->image) ? asset($header_admin->image) : asset($setting->default_avatar) }}"
                                class="rounded-circle me-2" style="width: 40px; height: 40px;">
                            <span>{{ $header_admin->name }}</span>
                        </div>
                        @adminCan('admin.profile.view')
                            <a href="{{ route('admin.edit-profile') }}" class="mobile-menu-item">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endadminCan
                        @adminCan('setting.view')
                            <a href="{{ route('admin.settings') }}" class="mobile-menu-item">
                                <i class="fas fa-cog"></i> {{ __('Setting') }}
                            </a>
                        @endadminCan
                        <a href="javascript:;" class="mobile-menu-item text-danger"
                            onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>

            @if (request()->routeIs(
                    'admin.general-setting',
                    'admin.crediential-setting',
                    'admin.email-configuration',
                    'admin.edit-email-template',
                    'admin.currency.*',
                    'admin.seo-setting',
                    'admin.custom-code',
                    'admin.cache-clear',
                    'admin.database-clear',
                    'admin.system-update.index',
                    'admin.addons.*',
                    'admin.admin.*',
                    'admin.languages.*',
                    'admin.basicpayment',
                    'admin.paymentgateway',
                    'admin.role.*'))
                @include('admin.settings.sidebar')
            @else
                @include('admin.sidebar')
            @endif
            @yield('admin-content')

            <footer class="main-footer">
                <div class="footer-right">
                </div>
            </footer>

        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
    @include('backend_layouts.partials.javascripts')

    @stack('js')
    
    <script>
        // Mobile search functionality
        $(document).ready(function() {
            // Copy search functionality to mobile
            $('#search_menu_mobile').on('input', function() {
                var searchValue = $(this).val().toLowerCase();
                var menuList = $('#admin_menu_list_mobile');
                var menuItems = menuList.find('.search-menu-item, .border-bottom').not('.not-found-message');
                var notFound = menuList.find('.not-found-message');
                
                if (searchValue.length > 0) {
                    menuList.removeClass('d-none');
                    var found = false;
                    
                    menuItems.each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(searchValue)) {
                            $(this).show();
                            found = true;
                        } else {
                            $(this).hide();
                        }
                    });
                    
                    if (found) {
                        notFound.addClass('d-none');
                    } else {
                        notFound.removeClass('d-none');
                        menuItems.hide();
                    }
                } else {
                    menuList.addClass('d-none');
                }
            });
            
            // Mobile menu toggle with backdrop
            $('#mobileNavbarMenu').on('show.bs.collapse', function() {
                $('body').addClass('mobile-menu-open');
            });
            
            $('#mobileNavbarMenu').on('hide.bs.collapse', function() {
                $('body').removeClass('mobile-menu-open');
            });
            
            // Close mobile menu when clicking backdrop
            $('body').on('click', function(e) {
                if ($(e.target).is('body::before') || ($(e.target).closest('.mobile-navbar-menu').length === 0 && $(e.target).closest('.navbar-toggler').length === 0)) {
                    if ($('#mobileNavbarMenu').hasClass('show')) {
                        $('#mobileNavbarMenu').collapse('hide');
                    }
                }
            });
        });
    </script>

</body>

</html>
