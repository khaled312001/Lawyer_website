<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><img class="w-75" src="{{ asset($setting->logo) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset($setting->favicon) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <ul class="sidebar-menu">
            {{-- القسم الرئيسي - لوحة التحكم --}}
            @adminCan('dashboard.view')
                <li class="{{ isRoute('admin.dashboard', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan

            {{-- إدارة العمليات اليومية --}}
            @if (checkAdminHasPermission('appointment.view') ||
                    checkAdminHasPermission('payment.view') ||
                    checkAdminHasPermission('schedule.view') ||
                    checkAdminHasPermission('day.view') ||
                    (Module::isEnabled('Order') && checkAdminHasPermission('order.management')) ||
                    (Module::isEnabled('Customer') && checkAdminHasPermission('client.view')) ||
                    checkAdminHasPermission('admin.view'))
                <li class="menu-header">{{ __('Daily Operations') }}</li>

                @if (checkAdminHasPermission('appointment.view') ||
                        checkAdminHasPermission('payment.view') ||
                        checkAdminHasPermission('schedule.view') ||
                        checkAdminHasPermission('day.view'))
                    @if (Module::isEnabled('Appointment'))
                        @include('appointment::sidebar')
                    @endif
                @endif

                @if (checkAdminHasPermission('admin.view'))
                    <li class="{{ isRoute('admin.consultation-appointments.*', 'active') }}">
                        <a class="nav-link" href="{{ route('admin.consultation-appointments.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>{{ __('Consultation Appointments') }}</span>
                        </a>
                    </li>
                @endif

                @if (checkAdminHasPermission('partnership.request.view'))
                    <li class="{{ isRoute('admin.partnership-requests.*', 'active') }}">
                        <a class="nav-link" href="{{ route('admin.partnership-requests.index') }}">
                            <i class="fas fa-handshake"></i>
                            <span>{{ __('Partnership Requests') }}</span>
                        </a>
                    </li>
                @endif

                @if (Module::isEnabled('Order') && checkAdminHasPermission('order.management'))
                    @include('order::sidebar')
                @endif

                @if (Module::isEnabled('Customer') && checkAdminHasPermission('client.view'))
                    @include('customer::sidebar')
                @endif

                @if (checkAdminHasPermission('admin.view'))
                    <li class="{{ isRoute('admin.messages.*', 'active') }}">
                        <a class="nav-link" href="{{ route('admin.messages.index') }}">
                            <i class="fas fa-comments"></i>
                            <span>{{ __('Messages') }}</span>
                            <span class="badge badge-danger messages-badge" id="sidebar-messages-count" style="display: none;">0</span>
                        </a>
                    </li>
                @endif

                @if (Module::isEnabled('ContactMessage') && (checkAdminHasPermission('contact.message.view') || checkAdminHasPermission('contact.info.view')))
                    @include('contactmessage::sidebar')
                @endif
            @endif

            {{-- إدارة المحتوى --}}
            @if (checkAdminHasPermission('lawyer.view') || checkAdminHasPermission('leave.management') ||
                    checkAdminHasPermission('department.view') ||
                    checkAdminHasPermission('location.view') ||
                    checkAdminHasPermission('service.view') ||
                    checkAdminHasPermission('blog.category.view') ||
                    checkAdminHasPermission('blog.view') || checkAdminHasPermission('blog.comment.view') ||
                    checkAdminHasPermission('testimonial.view'))
                <li class="menu-header">{{ __('Manage Contents') }}</li>

                @if (Module::isEnabled('Lawyer') && (checkAdminHasPermission('lawyer.view') || checkAdminHasPermission('leave.management') || checkAdminHasPermission('location.view') || checkAdminHasPermission('department.view')))
                    @include('lawyer::sidebar')
                @endif

                @if (Module::isEnabled('Service') && checkAdminHasPermission('service.view'))
                    @include('service::sidebar')
                @endif

                @if (Module::isEnabled('Blog') && (checkAdminHasPermission('blog.category.view') || checkAdminHasPermission('blog.view') || checkAdminHasPermission('blog.comment.view')))
                    @include('blog::sidebar')
                @endif

                @if (Module::isEnabled('Testimonial') && checkAdminHasPermission('testimonial.view'))
                    @include('testimonial::sidebar')
                @endif
            @endif

            {{-- المالية والمدفوعات --}}
            @if (Module::isEnabled('PaymentWithdraw') && checkAdminHasPermission('withdraw.management'))
                <li class="menu-header">{{ __('Financial & Payments') }}</li>

                @if (Module::isEnabled('PaymentWithdraw') && checkAdminHasPermission('withdraw.management'))
                    @include('paymentwithdraw::admin.sidebar')
                @endif

                @if (Module::isEnabled('NewsLetter') && (checkAdminHasPermission('newsletter.view') || checkAdminHasPermission('newsletter.mail') || checkAdminHasPermission('newsletter.content.view')))
                    @include('newsletter::sidebar')
                @endif
            @endif

            {{-- إدارة الموقع --}}
            @if (checkAdminHasPermission('menu.view') ||
                    checkAdminHasPermission('slider.view') ||
                    checkAdminHasPermission('feature.view') ||
                    checkAdminHasPermission('work.section.view') ||
                    checkAdminHasPermission('counter.view') ||
                    checkAdminHasPermission('partner.view') ||
                    checkAdminHasPermission('page.aboutus.view') ||
                    checkAdminHasPermission('page.faq.view') ||
                    checkAdminHasPermission('faq.view') ||
                    checkAdminHasPermission('social.link.management') || checkAdminHasPermission('faq.category.view') ||
                    checkAdminHasPermission('page.view') ||
                    checkAdminHasPermission('section.view'))
                <li class="menu-header">{{ __('Manage Website') }}</li>

                @if (Module::isEnabled('HomeSection') &&
                        (checkAdminHasPermission('slider.view') ||
                            checkAdminHasPermission('feature.view') ||
                            checkAdminHasPermission('work.section.view') ||
                            checkAdminHasPermission('counter.view') ||
                            checkAdminHasPermission('partner.view') ||
                            checkAdminHasPermission('section.view')))
                    @include('homesection::sidebar')
                @endif

                @if (checkAdminHasPermission('page.aboutus.view') || checkAdminHasPermission('page.faq.view') || checkAdminHasPermission('page.view'))
                    <li
                        class="nav-item dropdown {{ isRoute(['admin.pages.about-us.index', 'admin.pages.contact-page.index', 'admin.pages.faq-page.index', 'admin.custom-pages.*', 'admin.pages.utility-page.index', 'admin.social.media.*','admin.pages.faq.index'], 'active') }}">
                        <a href="javascript:;" class="nav-link has-dropdown">
                            <i class="fas fa-th"></i><span>{{ __('Pages') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if (checkAdminHasPermission('page.aboutus.view'))
                                <li class="{{ isRoute('admin.pages.about-us.index', 'active') }}">
                                    <a class="nav-link"
                                        href="{{ route('admin.pages.about-us.index', ['code' => getSessionLanguage()]) }}">
                                        {{ __('About Us') }}
                                    </a>
                                </li>
                            @endif
                            @if (checkAdminHasPermission('page.faq.view'))
                                <li class="{{ isRoute('admin.pages.faq.index', 'active') }}">
                                    <a class="nav-link"
                                        href="{{ route('admin.pages.faq.index') }}">
                                        {{ __('FAQ Page') }}
                                    </a>
                                </li>
                            @endif
                            @if (Module::isEnabled('PageBuilder') && checkAdminHasPermission('page.view'))
                                @include('pagebuilder::sidebar')
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Module::isEnabled('Faq') && checkAdminHasPermission('faq.category.view'))
                    @include('faq::sidebar')
                @endif

                @if (Module::isEnabled('CustomMenu') && checkAdminHasPermission('menu.view'))
                    @include('custommenu::sidebar')
                @endif

                @if (Module::isEnabled('SocialLink') && checkAdminHasPermission('social.link.management'))
                    @include('sociallink::sidebar')
                @endif
            @endif

            {{-- الإعدادات والنظام --}}
            @if (checkAdminHasPermission('setting.view') ||
                    checkAdminHasPermission('basic.payment.view') ||
                    checkAdminHasPermission('currency.view') ||
                    checkAdminHasPermission('language.view') ||
                    checkAdminHasPermission('role.view') || 
                    checkAdminHasPermission('addon.view') ||
                    checkAdminHasPermission('admin.view') ||
                    (Module::isEnabled('App') && checkAdminHasPermission('app.management')))
                <li class="menu-header">{{ __('Settings & System') }}</li>

                @if (Module::isEnabled('GlobalSetting'))
                    <li class="{{ isRoute('admin.settings', 'active') }}">
                        <a class="nav-link" href="{{ route('admin.settings') }}">
                            <i class="fas fa-cog"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endif

                @if (checkAdminHasPermission('role.view') || checkAdminHasPermission('admin.view'))
                    <li
                        class="nav-item dropdown {{ Route::is('admin.admin.*') || Route::is('admin.role.*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-shield-alt"></i>
                            <span>{{ __('Admin & Roles') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @adminCan('admin.view')
                                <li class="{{ Route::is('admin.admin.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.admin.index') }}">{{ __('Manage Admin') }}</a>
                                </li>
                            @endadminCan
                            @adminCan('role.view')
                                <li class="{{ Route::is('admin.role.*') ? 'active' : '' }}">
                                    <a class="nav-link"
                                        href="{{ route('admin.role.index') }}">{{ __('Role & Permissions') }}</a>
                                </li>
                            @endadminCan
                        </ul>
                    </li>
                @endif

                @if (checkAdminHasPermission('basic.payment.view'))
                    @if (Module::isEnabled('BasicPayment') && checkAdminHasPermission('basic.payment.view'))
                        @include('basicpayment::sidebar')
                    @endif
                @endif

                @if (Module::isEnabled('Currency') && checkAdminHasPermission('currency.view'))
                    @include('currency::sidebar')
                @endif

                @if (Module::isEnabled('Language') && checkAdminHasPermission('language.view'))
                    @include('language::sidebar')
                @endif

                @if (Module::isEnabled('App') && checkAdminHasPermission('app.management'))
                    @include('app::sidebar')
                @endif

                @if (checkAdminHasPermission('addon.view'))
                    @if (Module::has('Addon') && Module::isEnabled('Addon'))
                        @include('addon::sidebar')
                    @endif
                @endif
            @endif
        </ul>
        <div class="py-3 text-center">
            <div class="btn-sm-group-vertical version_button" role="group" aria-label="Responsive button group">
                <button class="btn btn-danger mt-2"
                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </aside>
</div>
