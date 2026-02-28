@php
    $textDirection = session()->get('text_direction', function_exists('getTextDirection') ? getTextDirection() : 'rtl');
    $currentLang = app()->getLocale();
    $isRtl = $textDirection === 'rtl';
    // WhatsApp number
    $whatsappNumber = '';
    if ($contactInfo?->top_bar_phone) {
        $whatsappNumber = preg_replace('/[^0-9+]/', '', $contactInfo->top_bar_phone);
        if (!str_starts_with($whatsappNumber, '+')) $whatsappNumber = '+963' . ltrim($whatsappNumber, '0');
    }
    // Logo fallback
    $logoPath = $setting->logo ?? 'uploads/website-images/logo.webp';
@endphp
<!DOCTYPE html>
<html lang="{{ $currentLang }}" dir="{{ $textDirection }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? $setting->app_name }}</title>
    <meta name="description" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? $setting->app_name }}">
    <meta name="keywords" content="محامي سوري, محامي سويسري, استشارة قانونية, خدمات قانونية, Aman Law, أمان لو">
    <meta name="theme-color" content="#0b2c64">
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon ?? '') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? $setting->app_name }}">
    <meta property="og:image" content="{{ asset($logoPath) }}">
    <meta property="og:url" content="{{ url('/') }}">
    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"LegalService","name":"{{ $setting->app_name }}","url":"{{ url('/') }}","logo":"{{ url($logoPath) }}"}
    </script>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/landing.css') }}?v={{ time() }}">
    @if ($setting->googel_tag_status == 'active')
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $setting->googel_tag_id }}');</script>
    @endif
    @if ($setting->google_analytic_status == 'active')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_id }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $setting->google_analytic_id }}');</script>
    @endif
</head>
<body class="landing-page" style="direction: {{ $textDirection }}; text-align: {{ $isRtl ? 'right' : 'left' }};">

{{-- ========== NAVBAR ========== --}}
<nav class="landing-navbar" id="landingNav">
    <div class="nav-inner">
        <a href="{{ url('/') }}" class="nav-logo">
            <img src="{{ asset($logoPath) }}" alt="{{ $setting->app_name }}"
                 onerror="this.onerror=null; this.src='{{ asset('uploads/website-images/logo.webp') }}';">
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#hero">{{ __('الرئيسية') }}</a></li>
            <li><a href="#services">{{ __('الخدمات') }}</a></li>
            <li><a href="#how-it-works">{{ __('كيف نعمل') }}</a></li>
            <li><a href="#departments">{{ __('الأقسام') }}</a></li>
            <li><a href="#about">{{ __('من نحن') }}</a></li>
            <li><a href="#lawyers">{{ __('المحامون') }}</a></li>
            <li><a href="#testimonials">{{ __('آراء العملاء') }}</a></li>
            <li><a href="#blog">{{ __('المدونة') }}</a></li>
            <li><a href="#booking">{{ __('حجز استشارة') }}</a></li>
            <li><a href="#contact">{{ __('تواصل') }}</a></li>
        </ul>
        <div class="nav-actions">
            @if (allLanguages()?->where('status', 1)->count() > 1)
            <form action="{{ route('set-language') }}" method="get" id="langForm">
                <select class="lang-switcher" name="code" onchange="this.form.submit()">
                    @foreach (allLanguages()->where('status', 1) as $language)
                        <option value="{{ $language->code }}" {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                            {{ $language->code == 'ar' ? 'عربي' : 'EN' }}
                        </option>
                    @endforeach
                </select>
            </form>
            @endif
            <a href="#booking" class="nav-cta"><i class="fas fa-calendar-check"></i> <span>{{ __('حجز استشارة') }}</span></a>
        </div>
        <button class="hamburger" onclick="toggleLandingMenu()" aria-label="Menu"><span></span><span></span><span></span></button>
    </div>
</nav>

{{-- Mobile Drawer --}}
<div class="mobile-overlay" id="mobileOverlay" onclick="toggleLandingMenu()"></div>
<div class="mobile-drawer" id="mobileDrawer">
    <button class="close-btn" onclick="toggleLandingMenu()"><i class="fas fa-times"></i></button>
    <ul class="mobile-nav-list">
        <li><a href="#hero" onclick="toggleLandingMenu()"><i class="fas fa-home"></i> {{ __('الرئيسية') }}</a></li>
        <li><a href="#services" onclick="toggleLandingMenu()"><i class="fas fa-briefcase"></i> {{ __('الخدمات') }}</a></li>
        <li><a href="#how-it-works" onclick="toggleLandingMenu()"><i class="fas fa-cogs"></i> {{ __('كيف نعمل') }}</a></li>
        <li><a href="#departments" onclick="toggleLandingMenu()"><i class="fas fa-building"></i> {{ __('الأقسام') }}</a></li>
        <li><a href="#about" onclick="toggleLandingMenu()"><i class="fas fa-info-circle"></i> {{ __('من نحن') }}</a></li>
        <li><a href="#lawyers" onclick="toggleLandingMenu()"><i class="fas fa-gavel"></i> {{ __('المحامون') }}</a></li>
        <li><a href="#testimonials" onclick="toggleLandingMenu()"><i class="fas fa-star"></i> {{ __('آراء العملاء') }}</a></li>
        <li><a href="#blog" onclick="toggleLandingMenu()"><i class="fas fa-blog"></i> {{ __('المدونة') }}</a></li>
        <li><a href="#booking" onclick="toggleLandingMenu()"><i class="fas fa-calendar-check"></i> {{ __('حجز استشارة') }}</a></li>
        <li><a href="#contact" onclick="toggleLandingMenu()"><i class="fas fa-envelope"></i> {{ __('تواصل') }}</a></li>
    </ul>
    @if (allLanguages()?->where('status', 1)->count() > 1)
    <div style="margin-top:24px; padding-top:16px; border-top:1px solid #eee;">
        <form action="{{ route('set-language') }}" method="get">
            <select class="form-select" name="code" onchange="this.form.submit()">
                @foreach (allLanguages()->where('status', 1) as $language)
                    <option value="{{ $language->code }}" {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                        {{ $language->code == 'ar' ? '🇸🇦 العربية' : '🇬🇧 English' }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    @endif
</div>

{{-- ========== HERO v2 — Glass card layout + particles ========== --}}
<section class="landing-hero" id="hero">
    {{-- Background effects --}}
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>
    <div class="hero-grid-overlay"></div>
    <div class="hero-particles" id="heroParticles"></div>

    <div class="container">
        <div class="landing-row" style="align-items:center;">
            {{-- Left: content --}}
            <div class="landing-col-6">
                <div class="hero-content">
                    <div class="hero-tagline">
                        <span class="dot"></span>
                        <span>{{ __('منصّة قانونية مُدارة من سويسرا') }}</span>
                    </div>
                    <h1>
                        {{ __('خبراء القانون') }}<br>
                        <span class="typed-gold">{{ __('السوري والسويسري') }}</span><br>
                        <span style="font-size:0.7em; color:rgba(255,255,255,0.7);">{{ __('Aman Law – أمان لو') }}</span>
                    </h1>
                    <p class="hero-desc">
                        {{ __('نربط بين محامين مختصين داخل سوريا وعملاء حول العالم، لتقديم استشارات قانونية موثوقة وتمثيل قضائي احترافي بإشراف سويسري.') }}
                    </p>
                    <div class="hero-btns">
                        <a href="#booking" class="btn-primary-hero">
                            <i class="fas fa-calendar-check"></i>
                            {{ __('احجز استشارة مجانية') }}
                        </a>
                        @if ($whatsappNumber)
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn-secondary-hero">
                            <i class="fab fa-whatsapp"></i>
                            {{ __('تواصل عبر واتساب') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Right: glass card --}}
            <div class="landing-col-6">
                <div class="hero-glass-card">
                    <div class="glass-stat-row">
                        @foreach($overviews->take(4) as $counter)
                        <div class="glass-stat">
                            <span class="stat-val">{{ $counter->qty }}+</span>
                            <span class="stat-lbl">{{ $counter->title }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="glass-features">
                        <div class="glass-feature">
                            <div class="glass-feature-icon"><i class="fas fa-flag"></i></div>
                            <span>{{ __('إدارة قانونية من سويسرا') }}</span>
                        </div>
                        <div class="glass-feature">
                            <div class="glass-feature-icon"><i class="fas fa-video"></i></div>
                            <span>{{ __('استشارات عن بُعد (صوت وفيديو)') }}</span>
                        </div>
                        <div class="glass-feature">
                            <div class="glass-feature-icon"><i class="fas fa-shield-alt"></i></div>
                            <span>{{ __('سرّية تامة والتزام مهني') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== FEATURES ========== --}}
<section class="landing-features" id="features">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-star"></i> {{ __('لماذا أمان لو') }}</div>
            <h2 class="section-title">{{ __('مميزاتنا') }} <span>{{ __('القانونية') }}</span></h2>
        </div>
        <div class="landing-grid cols-3">
            <div class="feature-card reveal-card">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h3>{{ __('محامون مختصون') }}</h3>
                <p>{{ __('شبكة من المحامين ذوي خبرة داخل سوريا، كلٌّ حسب اختصاصه القانوني.') }}</p>
            </div>
            <div class="feature-card reveal-card">
                <div class="feature-icon"><i class="fas fa-globe"></i></div>
                <h3>{{ __('استشارة عن بُعد') }}</h3>
                <p>{{ __('إمكانية الحصول على استشارة قانونية من أي مكان في العالم.') }}</p>
            </div>
            <div class="feature-card reveal-card">
                <div class="feature-icon"><i class="fas fa-eye"></i></div>
                <h3>{{ __('وضوح وشفافية') }}</h3>
                <p>{{ __('آلية عمل واضحة وتواصل مباشر مع العميل في جميع مراحل القضية.') }}</p>
            </div>
        </div>
        <div class="landing-grid cols-3" style="margin-top: 40px;">
            <div class="feature-card reveal-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #0b2c64, #1a3d7a);"><i class="fas fa-flag"></i></div>
                <h3>{{ __('إدارة قانونية من سويسرا') }}</h3>
            </div>
            <div class="feature-card reveal-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #0b2c64, #1a3d7a);"><i class="fas fa-video"></i></div>
                <h3>{{ __('استشارات عن بُعد (صوتية أو فيديو)') }}</h3>
            </div>
            <div class="feature-card reveal-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #0b2c64, #1a3d7a);"><i class="fas fa-shield-alt"></i></div>
                <h3>{{ __('التزام بالمهنية والسرّية') }}</h3>
            </div>
        </div>
    </div>
</section>

{{-- ========== SERVICES ========== --}}
@if (1 == $home_sections?->service_status)
<section class="landing-services" id="services">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-briefcase"></i> {{ __('خدماتنا') }}</div>
            <h2 class="section-title">{{ __('الخدمات') }} <span>{{ __('القانونية') }}</span></h2>
            <p class="section-subtitle" style="margin:auto;">{{ __('نقدّم خدمات قانونية متنوّعة متعلّقة بالقضايا داخل سوريا، موجّهة للأفراد والشركات في الداخل والخارج.') }}</p>
        </div>
        <div class="landing-grid cols-3">
            @foreach ($services?->take($home_sections?->service_how_many ?? 9) as $service)
            <div class="service-card reveal-card">
                <div class="service-icon"><i class="{{ $service?->icon }}"></i></div>
                <h3>{{ $service?->title }}</h3>
                <p>{{ $service?->sort_description }}</p>
                <a href="{{ route('website.service.details', $service?->slug) }}" class="service-link">
                    {{ __('تفاصيل الخدمة') }} <i class="fas fa-arrow-{{ $isRtl ? 'left' : 'right' }}"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========== HOW IT WORKS ========== --}}
<section class="landing-how-works" id="how-it-works">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-cogs"></i> {{ __('آلية العمل') }}</div>
            <h2 class="section-title">{{ __('كيف') }} <span>{{ __('نعمل') }}</span></h2>
            <p class="section-subtitle" style="margin:auto;">{{ __('نعتمد آلية عمل بسيطة وواضحة لضمان فهم الطلب وتقديم الخدمة القانونية المناسبة.') }}</p>
        </div>
        <div class="how-works-steps">
            @php $steps = [
                ['fab fa-whatsapp', __('التواصل عبر واتساب أو تعبئة النموذج'), __('ابدأ بالتواصل معنا عبر واتساب أو من خلال تعبئة نموذج طلب الاستشارة.')],
                ['fas fa-search', __('دراسة الحالة من الفريق القانوني'), __('يقوم فريقنا القانوني بدراسة حالتك بعناية وتحديد المحامي المختص المناسب.')],
                ['fas fa-comments', __('تقديم الاستشارة القانونية'), __('نقدّم الاستشارة عبر النص، المكالمة الصوتية أو مكالمة الفيديو حسب رغبتك.')],
                ['fas fa-gavel', __('متابعة القضية أو التمثيل القانوني'), __('عند الطلب، نقوم بمتابعة القضية أو التمثيل القانوني أمام المحاكم السورية.')],
            ]; @endphp
            @foreach($steps as $i => $step)
            <div class="step-card reveal-card">
                <div class="step-number">{{ $i + 1 }}</div>
                <div class="step-icon"><i class="{{ $step[0] }}"></i></div>
                <h3>{{ $step[1] }}</h3>
                <p>{{ $step[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== DEPARTMENTS ========== --}}
@if($departmentsForSearch && $departmentsForSearch->count() > 0)
<section class="landing-departments" id="departments">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-building"></i> {{ __('التخصصات') }}</div>
            <h2 class="section-title">{{ __('الأقسام') }} <span>{{ __('القانونية') }}</span></h2>
        </div>
        <div class="landing-grid cols-3">
            @foreach($departmentsForSearch as $dept)
            <div class="dept-card reveal-card">
                @if($dept->thumbnail_image ?? null)
                <div class="dept-img"><img src="{{ image_url($dept->thumbnail_image) }}" alt="{{ $dept->name }}" loading="lazy"></div>
                @endif
                <div class="dept-body">
                    <h3>{{ $dept->name }}</h3>
                    @if($dept->description ?? null)
                    <p>{{ Str::limit(strip_tags($dept->description), 120) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========== ABOUT ========== --}}
<section class="landing-about" id="about">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge" style="background:rgba(212,165,116,0.2); border-color:rgba(212,165,116,0.4); color:#e6c9a8;"><i class="fas fa-info-circle"></i> {{ __('تعرف علينا') }}</div>
            <h2 class="section-title">{{ __('من') }} <span>{{ __('نحن') }}</span></h2>
        </div>
        <div style="max-width:800px; margin:0 auto;">
            <p class="about-text text-center">
                {{ __('أمان لو – Aman Law هي منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تسهيل وصول العملاء في الخارج إلى خدمات قانونية موثوقة داخل سوريا، عبر محامين مختصين وبآلية عمل منظّمة وشفافة.') }}
            </p>
        </div>
        <div class="landing-grid cols-3" style="margin-top:50px;">
            @php $whys = [
                ['fas fa-flag', __('إدارة قانونية من سويسرا')],
                ['fas fa-user-tie', __('محامون مختصون داخل سوريا')],
                ['fas fa-users', __('خدمة مخصّصة للعملاء في الخارج')],
                ['fas fa-video', __('استشارات عن بُعد (صوتية أو فيديو)')],
                ['fas fa-eye', __('وضوح في الإجراءات والمتابعة')],
                ['fas fa-shield-alt', __('التزام بالمهنية والسرّية')],
            ]; @endphp
            @foreach($whys as $why)
            <div class="why-card reveal-card"><i class="{{ $why[0] }}"></i><h4>{{ $why[1] }}</h4></div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== LAWYERS — Infinite loop carousel ========== --}}
@if (1 == $home_sections?->lawyer_status && $lawyers->count() > 0)
<section class="landing-lawyers" id="lawyers">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-gavel"></i> {{ __('فريقنا') }}</div>
            <h2 class="section-title"><span>{{ ucfirst($home_sections?->lawyer_first_heading) }}</span> {{ ucfirst($home_sections?->lawyer_second_heading) }}</h2>
            <p class="section-subtitle" style="margin:auto;">{{ $home_sections?->lawyer_description }}</p>
        </div>
        <div class="swiper lawyer-landing-swiper">
            <div class="swiper-wrapper">
                @foreach ($lawyers as $lawyer)
                <div class="swiper-slide">
                    <div class="lawyer-card-mobile style="background: linear-gradient(145deg, #ffffff 0%, #f9f9fa 100%); border-radius: 16px; border: 1px solid rgba(212, 165, 116, 0.3); border-left: 5px solid #D4A574; padding: 30px 25px; height: 100%; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; transition: all 0.3s ease; margin-bottom: 20px;"">
                        <div class="lawyer-body" style="position: relative; z-index: 1;">
                            <h3 style="font-size: 24px; font-weight: 800; color: #0b2c64; margin-bottom: 20px; line-height: 1.3; border-bottom: 1px solid rgba(212, 165, 116, 0.2); padding-bottom: 15px;"><a href="{{ route('website.lawyer.details', $lawyer->slug) }}" style="color: inherit; text-decoration: none;">{{ ucfirst($lawyer->name) }}</a></h3>
                            @php $displayDept = ($lawyer->departments && $lawyer->departments->isNotEmpty()) ? $lawyer->departments->first() : ($lawyer->department ?? null); @endphp
                            @if($displayDept && ($displayDept->name ?? null))
                            <div class="lawyer-dept" style="display: flex; align-items: center; color: #4a5568; font-size: 15px; font-weight: 500; margin-bottom: 15px;"><i class="fas fa-briefcase" style="margin-{{ $isRtl ? 'left' : 'right' }}:6px; color: #D4A574; font-size: 18px; width: 30px;"></i> {{ $displayDept->name }}</div>
                            @endif
                            @if($lawyer->location && $lawyer->location->name)
                            <div class="lawyer-location" style="display: flex; align-items: center; color: #4a5568; font-size: 15px; font-weight: 500;"><i class="fas fa-map-marker-alt" style="margin-{{ $isRtl ? 'left' : 'right' }}:6px; color: #D4A574; font-size: 18px; width: 30px;"></i> {{ $lawyer->location->name }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination" style="margin-top:20px;"></div>
        </div>
    </div>
</section>
@endif

{{-- ========== TESTIMONIALS — Infinite loop carousel ========== --}}
@if (1 == $home_sections?->client_status && $testimonials->count() > 0)
<section class="landing-testimonials" id="testimonials">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-star"></i> {{ __('آراء العملاء') }}</div>
            <h2 class="section-title"><span>{{ ucfirst($home_sections?->client_first_heading) }}</span> {{ ucfirst($home_sections?->client_second_heading) }}</h2>
        </div>
        <div class="swiper testimonial-landing-swiper">
            <div class="swiper-wrapper">
                @foreach ($testimonials->take($home_sections?->client_how_many ?? 6) as $client)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                        <p class="testimonial-text">{{ $client?->comment }}</p>
                        <div class="testimonial-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-author">
                            <img class="author-img" src="{{ !empty($client?->image) ? image_url($client->image) : image_url('uploads/website-images/default-avatar.png') }}" alt="{{ $client?->name }}" loading="lazy">
                            <div>
                                <div class="author-name">{{ $client?->name }}</div>
                                <div class="author-role">{{ $client?->designation }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination" style="margin-top:20px;"></div>
        </div>
    </div>
</section>
@endif

{{-- ========== BLOG ========== --}}
@if (1 == $home_sections?->blog_status && $blogs->count() > 0)
<section class="landing-blog d-none" id="blog">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-blog"></i> {{ __('المدونة') }}</div>
            <h2 class="section-title"><span>{{ ucfirst($home_sections?->blog_first_heading) }}</span> {{ ucfirst($home_sections?->blog_second_heading) }}</h2>
        </div>
        <div class="swiper blog-landing-swiper" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
            <div class="swiper-wrapper">
                @php
                    $allBlogs = collect();
                    if ($feature_blog) $allBlogs->push($feature_blog);
                    foreach ($blogs->take($home_sections?->blog_how_many ?? 6) as $blog) {
                        if (!$feature_blog || $blog->id != $feature_blog->id) $allBlogs->push($blog);
                    }
                    // Force minimum 9 items for infinite loop to work seamlessly in Swiper array
                    $displayBlogs = collect();
                    if ($allBlogs->count() > 0) {
                        while ($displayBlogs->count() < 9) {
                            foreach ($allBlogs as $b) {
                                $displayBlogs->push($b);
                                if ($displayBlogs->count() >= 9) break;
                            }
                        }
                    }
                @endphp
                @foreach ($displayBlogs as $blog)
                <div class="swiper-slide">
                    <div class="blog-card reveal-card">
                        <div class="blog-img">
                            <a href="{{ route('website.blog.details', $blog?->slug) }}">
                                <img src="{{ $blog?->image ? image_url($blog->image) : ($blog?->thumbnail_image ? image_url($blog->thumbnail_image) : asset('client/img/shape-2.webp')) }}" alt="{{ $blog?->title }}" loading="lazy">
                            </a>
                        </div>
                        <div class="blog-body">
                            <div class="blog-date"><i class="far fa-calendar-alt"></i> {{ date('d M Y', strtotime($blog?->created_at)) }}</div>
                            <h3><a href="{{ route('website.blog.details', $blog?->slug) }}">{{ $blog?->title }}</a></h3>
                            <p>{{ $blog?->sort_description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination" style="margin-top:20px;"></div>
        </div>
    </div>
</section>
@endif

{{-- ========== BOOKING FORM ========== --}}
<section class="landing-booking" id="booking">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-calendar-check"></i> {{ __('احجز الآن') }}</div>
            <h2 class="section-title">{{ __('حجز') }} <span>{{ __('استشارة قانونية') }}</span></h2>
            <p class="section-subtitle" style="margin:auto;">{{ __('املأ النموذج أدناه لحجز موعد استشارة. سنقوم بمراجعة طلبك والتواصل معك لتأكيد الموعد.') }}</p>
        </div>
        <div class="booking-form-card reveal-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px;">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="border-radius:12px;">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('website.create.consultation.appointment') }}" method="POST" id="landingBookingForm">
                @csrf
                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-user-tie"></i> {{ __('اختر المحامي') }} <small class="text-muted">({{ __('اختياري') }})</small></label>
                    <select name="lawyer_id" class="form-select @error('lawyer_id') is-invalid @enderror">
                        <option value="">{{ __('اختر محامياً للاستشارة') }}</option>
                        @foreach($bookingLawyers ?? [] as $lawyer)
                            @php
                                $d = ($lawyer->departments && $lawyer->departments->isNotEmpty()) ? $lawyer->departments->first() : ($lawyer->department ?? null);
                                $dn = $d && $d->name ? $d->name : __('محامي');
                            @endphp
                            <option value="{{ $lawyer->id }}" {{ old('lawyer_id') == $lawyer->id ? 'selected' : '' }}>
                                {{ $lawyer->name }} - {{ $dn }}@if($lawyer->designations) ({{ $lawyer->designations }})@endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> {{ __('تاريخ الموعد') }} <span class="text-danger">*</span></label>
                        <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" required min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-clock"></i> {{ __('وقت الموعد') }} <span class="text-danger">*</span></label>
                        <input type="time" name="appointment_time" class="form-control @error('appointment_time') is-invalid @enderror" required value="{{ old('appointment_time') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-tag"></i> {{ __('نوع القضية') }} <span class="text-danger">*</span></label>
                    <input type="text" name="case_type" class="form-control @error('case_type') is-invalid @enderror" required value="{{ old('case_type') }}" placeholder="{{ __('مثال: مدنية، جزائية، أحوال شخصية، تجارية...') }}">
                </div>
                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-file-alt"></i> {{ __('تفاصيل القضية') }} <span class="text-danger">*</span></label>
                    <textarea name="case_details" class="form-control @error('case_details') is-invalid @enderror" rows="4" required placeholder="{{ __('اذكر تفاصيل قضيتك بشكل واضح...') }}">{{ old('case_details') }}</textarea>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> {{ __('الاسم الكامل') }} <span class="text-danger">*</span></label>
                        <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" required value="{{ old('client_name') }}" placeholder="{{ __('أدخل اسمك الكامل') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> {{ __('رقم الهاتف') }} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="country_code" class="form-select @error('country_code') is-invalid @enderror" required style="max-width:160px;">
                                <option value="">{{ __('الرمز') }}</option>
                                @foreach($countries ?? [] as $country)
                                    @php $cName = $currentLang === 'ar' ? ($country->name_ar ?? $country->name) : $country->name; @endphp
                                    <option value="+{{ $country->phone }}" {{ (old('country_code') ?: '+963') == '+'.$country->phone ? 'selected' : '' }}>
                                        {{ $country->flag }} {{ $cName }} (+{{ $country->phone }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="tel" name="client_phone" class="form-control @error('client_phone') is-invalid @enderror" required value="{{ old('client_phone') }}" placeholder="{{ __('رقم هاتفك') }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-city"></i> {{ __('المدينة') }} <small class="text-muted">({{ __('اختياري') }})</small></label>
                        <input type="text" name="client_city" class="form-control" value="{{ old('client_city') }}" placeholder="{{ __('مدينتك') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-globe-americas"></i> {{ __('الدولة') }} <small class="text-muted">({{ __('اختياري') }})</small></label>
                        <input type="text" name="client_country" class="form-control" value="{{ old('client_country') }}" placeholder="{{ __('دولتك') }}">
                    </div>
                </div>
                <button type="submit" class="btn-submit-booking">
                    <i class="fas fa-calendar-check"></i> {{ __('إرسال طلب الاستشارة') }}
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ========== CONTACT ========== --}}
<section class="landing-contact" id="contact">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <div class="section-badge"><i class="fas fa-envelope"></i> {{ __('اتصل بنا') }}</div>
            <h2 class="section-title">{{ __('تواصل') }} <span>{{ __('معنا') }}</span></h2>
        </div>
        <div class="contact-card reveal-card">
            <div class="contact-icon"><i class="fas fa-handshake"></i></div>
            <p class="contact-text">{{ __('نحن جاهزون للإجابة على استفساراتكم القانونية ومساعدتكم في متابعة قضاياكم داخل سوريا.') }}</p>
            <p class="contact-sub">{{ __('يرجى التواصل معنا عبر واتساب أو من خلال نموذج التواصل المتاح.') }}</p>
            <div class="contact-btns">
                @if ($whatsappNumber)
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn-whatsapp">
                    <i class="fab fa-whatsapp" style="font-size:22px;"></i> {{ __('تواصل عبر واتساب') }}
                </a>
                @endif
                <a href="#booking" class="btn-form-contact">
                    <i class="fas fa-calendar-check"></i> {{ __('حجز استشارة') }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ========== FOOTER ========== --}}
<footer class="landing-footer">
    <div class="container">
        <div class="landing-grid cols-2">
            <div>
                <h4>{{ __('عن أمان لو') }}</h4>
                <p>{{ __('أمان لو – Aman Law منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تقديم استشارات قانونية وتمثيل قضائي موثوق.') }}</p>
                <div class="footer-social">
                    @foreach (getSocialLinks() as $social)
                        <a href="{{ $social?->link }}" target="_blank" aria-label="social"><i class="{{ $social?->icon }}"></i></a>
                    @endforeach
                </div>
            </div>
            <div>
                <h4>{{ __('التواصل') }}</h4>
                @if ($contactInfo?->top_bar_phone)
                <p><strong>{{ __('واتساب:') }}</strong><br><a href="https://wa.me/{{ $whatsappNumber }}" style="color:var(--gold);">{{ $contactInfo->top_bar_phone }}</a></p>
                @endif
                @if ($contactInfo?->top_bar_email)
                <p><strong>{{ __('البريد:') }}</strong><br><a href="mailto:{{ $contactInfo->top_bar_email }}" style="color:var(--gold);">{{ $contactInfo->top_bar_email }}</a></p>
                @endif
                <p style="margin-top: 10px;"><i class="fas fa-map-marker-alt" style="color:var(--gold);"></i> {{ $contactInfo?->address }}</p>
            </div>
        </div>
        <div class="footer-bottom">
            @if($currentLang == 'ar')
                <p>© {{ date('Y') }} {{ __('جميع الحقوق محفوظة – أمان لو Aman Law') }} | {{ __('منصّة قانونية مُدارة من سويسرا') }}</p>
            @else
                <p>© {{ date('Y') }} Aman Law. All rights reserved. | Legal platform managed from Switzerland</p>
            @endif
        </div>
    </div>
</footer>

{{-- ========== FLOATING WHATSAPP ========== --}}
@if ($whatsappNumber)
<div class="floating-whatsapp">
    <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" aria-label="WhatsApp">
        <div class="wa-pulse"></div>
        <i class="fab fa-whatsapp"></i>
    </a>
</div>
@endif

{{-- Scroll Top --}}
<button class="scroll-top-btn" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="fas fa-angle-double-up"></i>
</button>

{{-- ========== SCRIPTS ========== --}}
<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('client/js/swiper-bundle.js') }}"></script>
<script src="{{ asset('client/js/select2.min.js') }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== Generate hero particles =====
    (function() {
        var c = document.getElementById('heroParticles');
        if (!c) return;
        for (var i = 0; i < 30; i++) {
            var p = document.createElement('div');
            p.className = 'hero-particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.animationDuration = (6 + Math.random() * 10) + 's';
            p.style.animationDelay = Math.random() * 8 + 's';
            p.style.width = p.style.height = (2 + Math.random() * 4) + 'px';
            c.appendChild(p);
        }
    })();

    // ===== Navbar scroll =====
    var nav = document.getElementById('landingNav');
    var sb = document.getElementById('scrollTopBtn');
    window.addEventListener('scroll', function() {
        nav.classList.toggle('scrolled', window.scrollY > 80);
        sb.style.display = window.scrollY > 400 ? 'flex' : 'none';
    });

    // ===== Smooth scroll =====
    document.querySelectorAll('a[href^="#"]').forEach(function(a) {
        a.addEventListener('click', function(e) {
            e.preventDefault();
            var t = document.querySelector(this.getAttribute('href'));
            if (t) window.scrollTo({ top: t.offsetTop - 80, behavior: 'smooth' });
        });
    });

    // ===== Active nav link =====
    var sections = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.nav-links a');
    window.addEventListener('scroll', function() {
        var cur = '';
        sections.forEach(function(s) { if (window.scrollY >= s.offsetTop - 150) cur = s.getAttribute('id'); });
        navLinks.forEach(function(a) {
            a.classList.remove('active');
            if (a.getAttribute('href') === '#' + cur) a.classList.add('active');
        });
    });

    // ===== Staggered scroll-reveal animations =====
    var revealObs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) {
                // Stagger siblings
                var parent = e.target.parentElement;
                var siblings = parent.querySelectorAll('.reveal-card');
                var idx = Array.prototype.indexOf.call(siblings, e.target);
                setTimeout(function() { e.target.classList.add('revealed'); }, idx * 120);
            }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal-card').forEach(function(el) { revealObs.observe(el); });

    // ===== Swipers — INFINITE LOOP =====
    // Remove loopedSlides setting and let Swiper auto-calculate clones
    if (document.querySelector('.lawyer-landing-swiper') && document.querySelectorAll('.lawyer-landing-swiper .swiper-slide').length > 0) {
        new Swiper('.lawyer-landing-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            speed: 700,
            autoplay: { delay: 3500, disableOnInteraction: false },
            pagination: { el: '.lawyer-landing-swiper .swiper-pagination', clickable: true },
            navigation: { nextEl: '.lawyer-landing-swiper .swiper-button-next', prevEl: '.lawyer-landing-swiper .swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    if (document.querySelector('.testimonial-landing-swiper') && document.querySelectorAll('.testimonial-landing-swiper .swiper-slide').length > 0) {
        new Swiper('.testimonial-landing-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            speed: 700,
            autoplay: { delay: 4500, disableOnInteraction: false },
            pagination: { el: '.testimonial-landing-swiper .swiper-pagination', clickable: true },
            navigation: { nextEl: '.testimonial-landing-swiper .swiper-button-next', prevEl: '.testimonial-landing-swiper .swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    if (document.querySelector('.blog-landing-swiper') && document.querySelectorAll('.blog-landing-swiper .swiper-slide').length > 0) {
        new Swiper('.blog-landing-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            speed: 700,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.blog-landing-swiper .swiper-pagination', clickable: true },
            navigation: { nextEl: '.blog-landing-swiper .swiper-button-next', prevEl: '.blog-landing-swiper .swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    // ===== Select2 =====
    if ($.fn.select2) {
        $('select[name="country_code"]').select2({ placeholder: '{{ __("اختر رمز الدولة") }}', allowClear: false, width: '100%' });
    }

    // ===== Form submit spinner =====
    var form = document.getElementById('landingBookingForm');
    if (form) form.addEventListener('submit', function() {
        var btn = this.querySelector('.btn-submit-booking');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("جاري الإرسال...") }}';
        btn.disabled = true;
    });
});

// Mobile menu
function toggleLandingMenu() {
    document.getElementById('mobileOverlay').classList.toggle('active');
    document.getElementById('mobileDrawer').classList.toggle('active');
    document.body.style.overflow = document.getElementById('mobileDrawer').classList.contains('active') ? 'hidden' : '';
}
</script>

{{-- Toastr --}}
<script>
@if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    toastr[type]("{{ Session::get('message') }}");
@endif
</script>

@if ($setting->tawk_status == 'active')
<script>var Tawk_API=Tawk_API||{},Tawk_LoadStart=new Date();(function(){var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];s1.async=true;s1.src='{{ $setting->tawk_chat_link }}';s1.charset='UTF-8';s1.setAttribute('crossorigin','*');s0.parentNode.insertBefore(s1,s0);})();</script>
@endif

</body>
</html>
