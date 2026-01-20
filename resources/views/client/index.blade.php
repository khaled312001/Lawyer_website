@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? 'LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? 'LawMent' }}">
    <meta name="keywords" content="محامي سوري, محامي سويسري, استشارة قانونية, خدمات قانونية, Aman Law, أمان لو, legal services Syria, legal consultation">
@endsection
@section('og_meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? 'LawMent' }}">
    <meta property="og:description" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? 'LawMent' }}">
    <meta property="og:image" content="{{ asset($setting->logo ?? 'client/img/logo.png') }}">
@endsection
@section('structured_data')
    {{-- WebPage Schema for Homepage --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? $setting->app_name }}",
        "description": "{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? $setting->app_name }}",
        "url": "{{ url('/') }}",
        "inLanguage": "{{ app()->getLocale() }}",
        "isPartOf": {
            "@type": "WebSite",
            "name": "{{ $setting->app_name }}",
            "url": "{{ url('/') }}"
        },
        "about": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name }}"
        },
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "{{ __('Home') }}",
                "item": "{{ url('/') }}"
            }]
        }
    }
    </script>
    
    {{-- Service Schema for Legal Services --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "Legal Services",
        "provider": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name }}",
            "url": "{{ url('/') }}"
        },
        "areaServed": {
            "@type": "Country",
            "name": ["Syria", "Switzerland", "Worldwide"]
        },
        "availableChannel": {
            "@type": "ServiceChannel",
            "serviceType": "Online",
            "availableLanguage": ["ar", "en"]
        }
    }
    </script>
@endsection
@section('client-content')

    <!--Hero Section Start-->
    <section class="hero-section" style="background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%); position: relative; overflow: hidden;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="hero-content">
                        <h1 class="hero-title" style="font-size: 48px; font-weight: 800; color: #ffffff; margin-bottom: 25px; line-height: 1.3;">
                            {{ __('ملتقى المحامين السوريين-السويسريين') }}<br>
                            <span style="color: #D4A574;">{{ __('Aman Law – أمان لو') }}</span>
                        </h1>
                        <p class="hero-description" style="font-size: 18px; color: rgba(255, 255, 255, 0.9); line-height: 1.8; margin-bottom: 30px;">
                            {{ __('منصّة قانونية مُدارة من سويسرا، تضم محامين مختصين من سوريا، لتقديم استشارات قانونية وتمثيل قضائي في القضايا المتعلقة بسوريا للعملاء في جميع أنحاء العالم.') }}
                        </p>
                        <p class="hero-description" style="font-size: 16px; color: rgba(255, 255, 255, 0.85); line-height: 1.8; margin-bottom: 30px;">
                            {{ __('نقدّم خدمات قانونية متكاملة تشمل القضايا المدنية، العقارية، التجارية، قضايا الأحوال الشخصية، القضايا الجزائية، وصياغة العقود ومتابعة الدعاوى أمام المحاكم السورية.') }}
                        </p>
                        <p class="hero-description" style="font-size: 16px; color: rgba(255, 255, 255, 0.85); line-height: 1.8; margin-bottom: 40px;">
                            {{ __('تتم الاستشارات القانونية عبر التواصل على واتساب أو من خلال تعبئة نموذج الطلب، مع إمكانية حجز موعد استشارة عبر مكالمة صوتية أو مكالمة فيديو حسب رغبة العميل.') }}
                        </p>
                        <a href="{{ route('website.book.consultation.appointment') }}" 
                           class="hero-cta-btn animated-cta-btn" 
                           style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); color: #2c3e50; border-radius: 50px; font-weight: 700; font-size: 18px; text-decoration: none; transition: all 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 4px 18px rgba(212, 165, 116, 0.4); position: relative; overflow: hidden; cursor: pointer;"
                           tabindex="0"
                        >
                            <span style="position: relative; z-index: 2; display: inline-flex; align-items: center; gap: 8px;">
                                {{ __('تواصل معنا وحجز استشارة قانونية') }}
                                <i class="fas fa-arrow-left ms-2 cta-arrow" style="transition: transform 0.3s ease;"></i>
                            </span>
                        </a>
                        <style>
                            .animated-cta-btn {
                                animation: ctaPopIn 0.9s cubic-bezier(.23,1.15,.30,.89);
                                box-shadow: 0 4px 18px rgba(212, 165, 116, 0.4), 0 2px 8px rgba(220,38,38,0.14);
                                outline: none;
                            }
                            @keyframes ctaPopIn {
                                0% { 
                                    opacity: 0; 
                                    transform: scale(0.8) translateY(40px); 
                                }
                                100% { 
                                    opacity: 1; 
                                    transform: scale(1) translateY(0); 
                                }
                            }
                            .animated-cta-btn:hover,
                            .animated-cta-btn:focus {
                                background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important; /* الخلفية تبقى كما هي */
                                color: #ffffff !important;
                                box-shadow: 0 6px 25px rgba(220, 38, 38, 0.5), 0 0 0 3px rgba(212, 165, 116, 0.2) !important;
                                transform: translateY(-3px) scale(1.05) !important;
                                text-decoration: none;
                            }
                            .animated-cta-btn .cta-arrow {
                                display: inline-block;
                                transition: transform 0.35s cubic-bezier(.57,.03,.35,.98);
                            }
                            .animated-cta-btn:hover .cta-arrow,
                            .animated-cta-btn:focus .cta-arrow {
                                transform: translateX(-8px) scale(1.2) rotate(-8deg);
                            }
                        </style>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="hero-image text-center">
                        <div class="hero-icons-container" style="position: relative; border-radius: 20px; overflow: visible; min-height: 400px; background: transparent; display: flex; align-items: center; justify-content: center; padding: 40px;">
                            <div class="law-icons-animation-wrapper" style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <!-- Main Center Icon -->
                                <div class="law-icon-main" style="position: absolute; z-index: 10;">
                                    <div class="icon-wrapper-main" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(212, 165, 116, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 30px rgba(212, 165, 116, 0.3); animation: iconPulse 2s ease-in-out infinite;">
                                        <i class="fas fa-balance-scale" style="font-size: 60px; color: #D4A574; animation: iconSwing 3s ease-in-out infinite;"></i>
                                    </div>
                                </div>
                                
                                <!-- Orbiting Icons -->
                                <div class="law-icon-1" style="position: absolute; animation: orbitIcon 8s linear infinite;">
                                    <div class="icon-wrapper" style="width: 80px; height: 80px; background: rgba(212, 165, 116, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(212, 165, 116, 0.25); backdrop-filter: blur(10px);">
                                        <i class="fas fa-gavel" style="font-size: 35px; color: #D4A574; animation: iconRotate 4s linear infinite;"></i>
                                    </div>
                                </div>
                                
                                <div class="law-icon-2" style="position: absolute; animation: orbitIcon 10s linear infinite reverse;">
                                    <div class="icon-wrapper" style="width: 80px; height: 80px; background: rgba(220, 38, 38, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(220, 38, 38, 0.25); backdrop-filter: blur(10px);">
                                        <i class="fas fa-book-law" style="font-size: 35px; color: #DC2626; animation: iconBounce 2s ease-in-out infinite;"></i>
                                    </div>
                                </div>
                                
                                <div class="law-icon-3" style="position: absolute; animation: orbitIcon 12s linear infinite;">
                                    <div class="icon-wrapper" style="width: 80px; height: 80px; background: rgba(212, 165, 116, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(212, 165, 116, 0.25); backdrop-filter: blur(10px);">
                                        <i class="fas fa-file-contract" style="font-size: 35px; color: #D4A574; animation: iconFloat 3s ease-in-out infinite;"></i>
                                    </div>
                                </div>
                                
                                <div class="law-icon-4" style="position: absolute; animation: orbitIcon 9s linear infinite reverse;">
                                    <div class="icon-wrapper" style="width: 80px; height: 80px; background: rgba(220, 38, 38, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(220, 38, 38, 0.25); backdrop-filter: blur(10px);">
                                        <i class="fas fa-landmark" style="font-size: 35px; color: #DC2626; animation: iconShake 2.5s ease-in-out infinite;"></i>
                                    </div>
                                </div>
                                
                                <div class="law-icon-5" style="position: absolute; animation: orbitIcon 11s linear infinite;">
                                    <div class="icon-wrapper" style="width: 70px; height: 70px; background: rgba(212, 165, 116, 0.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(212, 165, 116, 0.2); backdrop-filter: blur(10px);">
                                        <i class="fas fa-handshake" style="font-size: 30px; color: #D4A574; animation: iconPulse 2.5s ease-in-out infinite;"></i>
                                    </div>
                                </div>
                                
                                <div class="law-icon-6" style="position: absolute; animation: orbitIcon 13s linear infinite reverse;">
                                    <div class="icon-wrapper" style="width: 70px; height: 70px; background: rgba(220, 38, 38, 0.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(220, 38, 38, 0.2); backdrop-filter: blur(10px);">
                                        <i class="fas fa-shield-alt" style="font-size: 30px; color: #DC2626; animation: iconRotate 5s linear infinite;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Hero Section End-->

    <!--Quick Points Section Start-->
    <section class="quick-points-section" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-users" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('محامون مختصون') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('شبكة من المحامين ذوي خبرة داخل سوريا، كلٌّ حسب اختصاصه القانوني.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-globe" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('استشارة عن بُعد') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('إمكانية الحصول على استشارة قانونية من أي مكان في العالم.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-eye" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('وضوح وشفافية') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('آلية عمل واضحة وتواصل مباشر مع العميل في جميع مراحل القضية.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Quick Points Section End-->

    @if (1 == $home_sections?->service_status)
        <!--Service Start-->
        <section class="service-area bg-area">
            <!-- HTML Content -->
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title">{{ __('الخدمات القانونية') }}</h2>
                            <p>{{ __('نقدّم خدمات قانونية متنوّعة متعلّقة بالقضايا داخل سوريا، موجّهة للأفراد والشركات في الداخل والخارج.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row service-row">
                    <div class="col-md-12">
                        <div class="service-swiper-container">
                            <div class="swiper service-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($services?->take($home_sections?->service_how_many) as $service)
                                        <div class="swiper-slide">
                                            <div class="service-item">
                                                <div class="service-icon-wrapper">
                                                    <i class="{{ $service?->icon }}"></i>
                                                </div>
                                                <a aria-label="{{ $service?->title }}"
                                                    href="{{ route('website.service.details', $service?->slug) }}">
                                                    <h3 class="title">{{ $service?->title }}</h3>
                                                </a>
                                                <p>{{ $service?->sort_description }}</p>
                                                <a class="service-link" aria-label="{{ __('Service Details') }}"
                                                    href="{{ route('website.service.details', $service?->slug) }}">
                                                    <span>{{ __('Service Details') }}</span>
                                                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Navigation buttons -->
                                <div class="swiper-button-next service-swiper-next"></div>
                                <div class="swiper-button-prev service-swiper-prev"></div>
                                <!-- Pagination -->
                                <div class="swiper-pagination service-swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="home-button ser-btn">
                            <a aria-label="{{ __('All Service') }}"
                                href="{{ url('service') }}">{{ __('All Service') }}</a>
                        </div>
                    </div>
                </div>
              
            </div>
        </section>
        <!--Service End-->
    @endif

    <!--How It Works Section Start-->
    <section class="how-it-works-area">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title">{{ __('كيف نعمل') }}</h2>
                        <p>{{ __('نعتمد آلية عمل بسيطة وواضحة لضمان فهم الطلب وتقديم الخدمة القانونية المناسبة.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">1</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-1">
                            <i class="fab fa-whatsapp enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('التواصل عبر واتساب أو تعبئة نموذج طلب الاستشارة') }}</h3>
                            <p class="enhanced-step-description">{{ __('ابدأ بالتواصل معنا عبر واتساب أو من خلال تعبئة نموذج طلب الاستشارة المتاح على الموقع.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">2</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-2">
                            <i class="fas fa-search enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('دراسة الحالة من قبل الفريق القانوني') }}</h3>
                            <p class="enhanced-step-description">{{ __('يقوم فريقنا القانوني بدراسة حالتك بعناية وتحديد المحامي المختص المناسب.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">3</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-3">
                            <i class="fas fa-comments enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('تقديم الاستشارة القانونية') }}</h3>
                            <p class="enhanced-step-description">{{ __('نقدّم الاستشارة القانونية عبر النص، المكالمة الصوتية أو مكالمة الفيديو حسب رغبتك.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">4</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-3">
                            <i class="fas fa-gavel enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('متابعة القضية أو التمثيل القانوني') }}</h3>
                            <p class="enhanced-step-description">{{ __('عند الطلب، نقوم بمتابعة القضية أو التمثيل القانوني أمام المحاكم السورية.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--How It Works Section End-->

    <!--About Us Section Start-->
    <section class="about-us-section" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title">{{ __('من نحن') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-10 m-auto">
                    <div class="about-us-content text-center" style="background: #ffffff; padding: 50px 40px; border-radius: 20px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);">
                        <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 0;">
                            {{ __('أمان لو – Aman Law هي منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تسهيل وصول العملاء في الخارج إلى خدمات قانونية موثوقة داخل سوريا، عبر محامين مختصين وبآلية عمل منظّمة وشفافة.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About Us Section End-->

    <!--Why Aman Law Section Start-->
    <section class="why-aman-law-section">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('لماذا') }}</span> {{ __('أمان لو') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-flag" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">
                            @php
                                $title = __('إدارة قانونية من سويسرا');
                            @endphp
                            {{ $title }}
                        </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-user-tie" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('محامون مختصون داخل سوريا') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-users" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('خدمة مخصّصة للعملاء في الخارج') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-video" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('استشارات عن بُعد (صوتية أو فيديو)') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-eye" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('وضوح في الإجراءات والمتابعة') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-shield-alt" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('التزام بالمهنية والسرّية') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Why Aman Law Section End-->


    @if (1 == $home_sections?->lawyer_status)
        <!--Lawyer Area Start-->
        <section class="lawyer-area-modern">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->lawyer_first_heading) }}</span>
                                {{ ucfirst($home_sections?->lawyer_second_heading) }}</h2>
                            <p>{{ $home_sections?->lawyer_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="lawyer-swiper-wrapper">
                    <div class="swiper lawyer-swiper-modern">
                        <div class="swiper-wrapper">
                            @foreach ($lawyers as $index => $lawyer)
                                <div class="swiper-slide">
                                    <div class="lawyer-card-mobile aman-lawyer-card-mobile-rtl lawyer-card-animated" style="animation-delay: {{ 0.12 * $index }}s;">
                                        <div class="lawyer-card-image-mobile lawyer-card-border-animated" style="animation-delay: {{ 0.16 * $index }}s;">
                                            @php
                                                $lawyerImage = $lawyer?->image ? $lawyer->image : ($setting?->default_avatar ?? 'uploads/website-images/default-avatar.png');
                                                $lawyerName = $lawyer?->name ?? '';
                                                $lawyerSlug = $lawyer?->slug ?? '';
                                                $fallbackImage = image_url($setting?->default_avatar ?? 'uploads/website-images/default-avatar.png');
                                            @endphp
                                            <a href="{{ route('website.lawyer.details', $lawyerSlug) }}" aria-label="{{ $lawyerName }}">
                                                <img src="{{ image_url($lawyerImage) }}" alt="{{ $lawyerName }}" loading="lazy" data-fallback="{{ $fallbackImage }}">
                                            </a>
                                        </div>
                                        <div class="lawyer-card-content-mobile">
                                            <h3 class="lawyer-card-name-mobile">
                                                <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                                    {{ ucfirst($lawyer?->name) }}
                                                </a>
                                            </h3>
                                            <div class="lawyer-card-meta-mobile">
                                                @php
                                                    $displayDept = ($lawyer->departments && $lawyer->departments->isNotEmpty()) 
                                                        ? $lawyer->departments->first() 
                                                        : ($lawyer->department ?? null);
                                                @endphp
                                                @if($displayDept && $displayDept->name)
                                                <div class="lawyer-meta-item-mobile lawyer-meta-animate">
                                                    <i class="fas fa-briefcase lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ ucfirst($displayDept->name) }}</span>
                                                </div>
                                                @endif
                                                @if($lawyer->location)
                                                <div class="lawyer-meta-item-mobile lawyer-meta-animate">
                                                    <i class="fas fa-map-marker-alt lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ ucfirst($lawyer->location->name) }}</span>
                                                </div>
                                                @endif
                                                @if($lawyer->designations)
                                                <div class="lawyer-meta-item-mobile lawyer-meta-animate">
                                                    <i class="fas fa-graduation-cap lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ $lawyer->designations }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <a class="lawyer-card-button-mobile lawyer-btn-animated" href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ __('View Profile') }}">
                                                <i class="fas fa-arrow-left lawyer-button-icon-mobile"></i>
                                                <span class="lawyer-button-text-mobile">{{ __('View Profile') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next lawyer-next"></div>
                        <div class="swiper-button-prev lawyer-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination lawyer-pagination"></div>
                    </div>
                </div>
                <style>
                    /* Animation for card appear/fade in with up motion */
                    .lawyer-card-animated {
                        animation: fadeUpLawyerCard 0.7s cubic-bezier(.24,.93,.47,.99);
                        animation-fill-mode: both;
                    }
                    @keyframes fadeUpLawyerCard {
                        0% {
                            opacity: 0;
                            transform: translateY(40px) scale(.93) rotateZ(-2deg);
                            box-shadow: 0 2px 14px rgba(212,165,116,0.05);
                        }
                        70% {
                            opacity: 0.98;
                            transform: translateY(-4px) scale(1.03) rotateZ(1deg);
                            box-shadow: 0 8px 28px rgba(212,165,116,0.16);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0) scale(1) rotateZ(0);
                            box-shadow: 0 8px 28px rgba(212,165,116,0.08);
                        }
                    }

                    /* Animation for border grow */
                    .lawyer-card-border-animated {
                        border-radius: 16px;
                        box-shadow: 0 2px 8px rgba(212,165,116,0.10);
                        border: 2.5px solid #D4A574;
                        position: relative;
                        overflow: hidden;
                        animation: borderGrowAnim 0.85s cubic-bezier(.34,.51,.41,1.08);
                        animation-fill-mode: both;
                    }
                    @keyframes borderGrowAnim {
                        0% {
                            box-shadow: 0 0px 0px rgba(212, 165, 116, 0.07);
                            border-width: 0px;
                            transform: scale(.85);
                            opacity: 0;
                        }
                        60% {
                            border-width: 3px;
                            box-shadow: 0 4px 28px rgba(212,165,116,0.13);
                            opacity: 0.9;
                        }
                        100% {
                            border-width: 2.5px;
                            box-shadow: 0 8px 34px rgba(212,165,116,0.10);
                            transform: scale(1);
                            opacity: 1;
                        }
                    }

                    /* Animate meta info */
                    .lawyer-meta-animate {
                        animation: fadeInMetaLawyer 0.55s cubic-bezier(.55,1,.66,1.04);
                        animation-fill-mode: both;
                    }
                    @keyframes fadeInMetaLawyer {
                        0% {
                            opacity: 0;
                            transform: translateY(18px) scale(.96);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0) scale(1);
                        }
                    }

                    /* Button animation */
                    .lawyer-btn-animated {
                        transition: background 0.3s, color 0.3s, box-shadow 0.18s;
                        animation: fadeInMetaLawyer 0.45s cubic-bezier(.45,1,.59,1.09) 0.15s backwards;
                    }
                    .lawyer-btn-animated:hover, .lawyer-btn-animated:focus {
                        background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important;
                        color: #fff !important;
                        box-shadow: 0 5px 17px rgba(212,165,116,0.11);
                        text-decoration: none;
                    }
                </style>
            </div>
        </section>
        <!--Lawyer Area End-->
    @endif

    @if (1 == $home_sections?->client_status)
        <!--Testimonial Start-->
        <section class="testimonial-area-modern">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->client_first_heading) }}</span>
                                {{ ucfirst($home_sections?->client_second_heading) }}</h2>
                            <p>{{ $home_sections?->client_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-swiper-wrapper">
                    <div class="swiper testimonial-swiper-modern">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials->take($home_sections?->client_how_many) as $index => $client)
                                <div class="swiper-slide">
                                    <div class="testimonial-card-new testimonial-card-animated" style="animation-delay: {{ 0.12 * $index }}s;">
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-content-new">
                                                <p class="testimonial-text-new">{{ $client?->comment }}</p>
                                            </div>
                                            <div class="testimonial-rating-new">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial-author-new">
                                                <div class="author-image-wrapper-new">
                                                    <img src="{{ !empty($client?->image) ? image_url($client->image) : image_url('uploads/website-images/default-avatar.png') }}"
                                                        alt="{{ $client?->name }}" loading="lazy" class="author-image-new">
                                                    <div class="author-image-border-new"></div>
                                                </div>
                                                <div class="author-info-new">
                                                    <h4 class="author-name-new">{{ $client?->name }}</h4>
                                                    <p class="author-designation-new">{{ $client?->designation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next testimonial-next"></div>
                        <div class="swiper-button-prev testimonial-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination testimonial-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonial End-->
    @endif


    <!--Contact Us Section Start-->
    <section class="contact-us-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 80px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <div class="text-center mb-5 wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">
                                {{ __('تواصل معنا') }}
                            </h2>
                            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #007bff, #0056b3); margin: 20px auto; border-radius: 2px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <div class="contact-us-content text-center" style="background: #ffffff; padding: 60px 50px; border-radius: 25px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;">
                        <!-- Decorative background elements -->
                        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: linear-gradient(135deg, rgba(0, 123, 255, 0.05), rgba(0, 86, 179, 0.05)); border-radius: 50%; z-index: 0;"></div>
                        <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: linear-gradient(135deg, rgba(40, 167, 69, 0.05), rgba(25, 135, 84, 0.05)); border-radius: 50%; z-index: 0;"></div>
                        
                        <div style="position: relative; z-index: 1;">
                            <div style="margin-bottom: 35px;">
                                <i class="fas fa-handshake" style="font-size: 3rem; color: #007bff; margin-bottom: 20px; display: block;"></i>
                            </div>
                            <p style="font-size: 20px; color: #2c3e50; line-height: 1.9; margin-bottom: 25px; font-weight: 500;">
                                {{ __('نحن جاهزون للإجابة على استفساراتكم القانونية ومساعدتكم في متابعة قضاياكم داخل سوريا.') }}
                            </p>
                            <p style="font-size: 17px; color: #6c757d; line-height: 1.8; margin-bottom: 40px;">
                                {{ __('يرجى التواصل معنا عبر واتساب أو من خلال نموذج التواصل المتاح على الموقع.') }}
                            </p>
                            <div class="contact-buttons-wrapper d-flex flex-column flex-md-row justify-content-center align-items-center gap-3" style="margin-top: 40px;">
                                @if ($contactInfo?->top_bar_phone)
                                    @php
                                        $whatsappNumber = $contactInfo->top_bar_phone;
                                        $whatsappNumber = preg_replace('/[^0-9+]/', '', $whatsappNumber);
                                        if (!str_starts_with($whatsappNumber, '+')) {
                                            $whatsappNumber = '+963' . ltrim($whatsappNumber, '0');
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" 
                                       class="btn btn-lg contact-btn-whatsapp" 
                                       style="padding: 16px 40px; font-size: 18px; font-weight: 600; border-radius: 50px; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); border: none; color: #ffffff; box-shadow: 0 5px 20px rgba(37, 211, 102, 0.3); transition: all 0.3s ease; min-width: 220px; display: inline-flex; align-items: center; justify-content: center; gap: 10px;">
                                        <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                                        <span>{{ __('تواصل عبر واتساب') }}</span>
                                    </a>
                                @endif
                                <a href="{{ route('website.contact-us') }}" 
                                   class="btn btn-lg contact-btn-form" 
                                   style="padding: 16px 40px; font-size: 18px; font-weight: 600; border-radius: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border: none; color: #ffffff; box-shadow: 0 5px 20px rgba(0, 123, 255, 0.3); transition: all 0.3s ease; min-width: 220px; display: inline-flex; align-items: center; justify-content: center; gap: 10px;">
                                    <i class="fas fa-envelope" style="font-size: 20px;"></i>
                                    <span>{{ __('نموذج التواصل') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .contact-btn-whatsapp:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4) !important;
                background: linear-gradient(135deg, #128C7E 0%, #25D366 100%) !important;
            }
            .contact-btn-form:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4) !important;
                background: linear-gradient(135deg, #0056b3 0%, #007bff 100%) !important;
            }
            @media (max-width: 768px) {
                .contact-us-content {
                    padding: 40px 30px !important;
                }
                .contact-buttons-wrapper {
                    flex-direction: column !important;
                }
                .contact-btn-whatsapp,
                .contact-btn-form {
                    width: 100%;
                    max-width: 280px;
                }
            }
        </style>
    </section>
    <!--Contact Us Section End-->

    @if (1 == $home_sections?->blog_status)
        <!--Blog-Area Start-->
        <section class="blog-area-modern">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->blog_first_heading) }}</span>
                                {{ ucfirst($home_sections?->blog_second_heading) }}</h2>
                            <p>{{ $home_sections?->blog_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="blog-swiper-wrapper">
                    <div class="swiper blog-swiper-modern">
                        <div class="swiper-wrapper">
                            @php
                                $allBlogs = collect();
                                if ($feature_blog) {
                                    $allBlogs->push($feature_blog);
                                }
                                foreach ($blogs->take($home_sections?->blog_how_many) as $blog) {
                                    if (!$feature_blog || $blog->id != $feature_blog->id) {
                                        $allBlogs->push($blog);
                                    }
                                }
                            @endphp
                            @foreach ($allBlogs->take($home_sections?->blog_how_many) as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-card-modern">
                                        <div class="blog-image-wrapper">
                                            <a aria-label="{{ $blog?->title }}"
                                                href="{{ route('website.blog.details', $blog?->slug) }}" class="blog-image-link">
                                                <img src="{{ $blog?->image ? url($blog?->image) : ($blog?->thumbnail_image ? url($blog?->thumbnail_image) : asset('client/img/shape-2.webp')) }}"
                                                    alt="{{ $blog?->title }}" loading="lazy" class="blog-image">
                                                <div class="blog-image-overlay">
                                                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                                </div>
                                            </a>
                                            <div class="blog-date-badge">
                                                <span class="blog-day">{{ date('d', strtotime($blog?->created_at)) }}</span>
                                                <span class="blog-month">{{ date('M', strtotime($blog?->created_at)) }}</span>
                                            </div>
                                        </div>
                                        <div class="blog-content">
                                            <h3 class="blog-title">
                                                <a aria-label="{{ $blog?->title }}"
                                                    href="{{ route('website.blog.details', $blog?->slug) }}">
                                                    {{ $blog?->title }}
                                                </a>
                                            </h3>
                                            <p class="blog-excerpt">{{ $blog?->sort_description }}</p>
                                            <a class="blog-read-more" aria-label="{{ __('Read More') }}"
                                                href="{{ route('website.blog.details', $blog?->slug) }}">
                                                <span>{{ __('Read More') }}</span>
                                                <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next blog-next"></div>
                        <div class="swiper-button-prev blog-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination blog-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog-Area End-->
    @endif

@push('css')
<style>
    @keyframes shimmer {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }
    .legal-stat-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.08) 100%);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 30px;
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInRight 0.8s ease both;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .legal-stat-card:nth-child(1) { animation-delay: 0.2s; }
    .legal-stat-card:nth-child(2) { animation-delay: 0.4s; }
    .legal-stat-card:nth-child(3) { animation-delay: 0.6s; }
    .legal-stat-card:nth-child(4) { animation-delay: 0.8s; }

    .legal-stat-card:hover {
        transform: translateY(-12px) scale(1.02);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.18) 0%, rgba(255, 255, 255, 0.12) 100%);
        box-shadow: 0 20px 50px rgba(212, 175, 55, 0.3), 0 10px 30px rgba(0, 0, 0, 0.25);
        border-color: rgba(212, 175, 55, 0.6);
    }

    .legal-stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.3);
    }

    .legal-stat-icon i {
        font-size: 28px;
        color: #1a1a2e;
    }

    .legal-stat-number {
        font-size: 40px;
        font-weight: 900;
        color: #ffffff;
        margin: 0 0 8px 0;
        line-height: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #ffffff 0%, rgba(244, 208, 63, 0.9) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .legal-stat-label {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        font-weight: 600;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 480px) {
        /* Center all icons in a vertical column */
        .legal-stat-card {
            padding: 18px 15px;
        }

        .legal-stat-icon {
            width: 45px;
            height: 45px;
            margin-bottom: 12px;
        }

        .legal-stat-icon i {
            font-size: 22px;
        }

        .legal-stat-number {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .legal-stat-label {
            font-size: 12px;
            line-height: 1.4;
        }
    }

    @media (max-width: 480px) {


        /* Center all icons in a vertical column */
        .legal-stat-card {
            padding: 15px;
        }

        .legal-stat-icon {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
        }

        .legal-stat-icon i {
            font-size: 20px;
        }

        .legal-stat-number {
            font-size: 22px;
        }

        .legal-stat-label {
            font-size: 11px;
        }
    }
    /* RTL: نفس الترتيب البصري - الإحصائيات على اليسار والمحتوى على اليمين */
    [dir="rtl"] .legal-stat-content {
        text-align: right;
    }

    /* LTR: الإحصائيات على اليسار والمحتوى على اليمين */
    /* RTL Mobile Support */
    @media (max-width: 768px) {
        

        /* Mobile ordering: content first, then stats */
        [dir="rtl"] .legal-stat-content {
            text-align: center;
        }
    }

    @media (max-width: 480px) {
    }


    /* Testimonial Modern Styles */
    .testimonial-area-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 30px 0 50px 0;
        position: relative;
        overflow: hidden;
    }

    .testimonial-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(107,93,71,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
        pointer-events: none;
    }

    /* ============================================
       NEW TESTIMONIALS DESIGN - Responsive & RTL
       ============================================ */
    
    .testimonial-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
        display: block !important;
        visibility: visible !important;
    }

    .testimonial-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
        display: block !important;
        visibility: visible !important;
    }
    
    .testimonial-swiper-modern .swiper-wrapper {
        display: flex !important;
        visibility: visible !important;
    }
    
    .testimonial-swiper-modern .swiper-slide {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        height: auto !important;
    }

    .testimonial-card-new {
        background: #ffffff;
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        overflow: hidden;
        position: relative;
        direction: rtl !important;
        text-align: right !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    /* Animation for testimonial card appear/fade in */
    .testimonial-card-animated {
        animation: fadeUpTestimonialCard 0.7s cubic-bezier(.24,.93,.47,.99);
        animation-fill-mode: both;
    }
    
    @keyframes fadeUpTestimonialCard {
        0% {
            opacity: 0;
            transform: translateY(40px) scale(.93) rotateZ(-2deg);
            box-shadow: 0 2px 14px rgba(212,165,116,0.05);
        }
        70% {
            opacity: 0.98;
            transform: translateY(-4px) scale(1.03) rotateZ(1deg);
            box-shadow: 0 8px 28px rgba(212,165,116,0.16);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1) rotateZ(0);
            box-shadow: 0 8px 28px rgba(212,165,116,0.08);
        }
    }

    [dir="ltr"] .testimonial-card-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-card-new::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: right;
    }

    .testimonial-card-new:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.15);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-new:hover::before {
        transform: scaleX(1);
    }

    .testimonial-card-inner {
        padding: 35px 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        direction: rtl !important;
        text-align: right !important;
        flex: 1 !important;
        height: 100% !important;
    }

    [dir="ltr"] .testimonial-card-inner {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-quote-icon-new {
        position: absolute;
        top: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.08) 0%, rgba(90, 77, 58, 0.08) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        z-index: 1;
    }

    [dir="ltr"] .testimonial-quote-icon-new {
        right: 25px;
        left: auto;
    }

    .testimonial-quote-icon-new i {
        font-size: 28px;
        color: var(--colorPrimary);
        transition: all 0.4s ease;
    }

    .testimonial-card-new:hover .testimonial-quote-icon-new {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: rotate(15deg) scale(1.1);
    }

    .testimonial-card-new:hover .testimonial-quote-icon-new i {
        color: #ffffff;
    }

    .testimonial-content-new {
        margin-top: 10px;
        flex-grow: 1;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .testimonial-content-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-text-new {
        font-size: 16px;
        line-height: 1.8;
        color: #4f5b6d;
        font-style: italic;
        margin: 0;
        direction: rtl !important;
        text-align: right !important;
        padding-right: 0;
        padding-left: 0;
    }

    [dir="ltr"] .testimonial-text-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-rating-new {
        display: flex;
        gap: 6px;
        justify-content: flex-end !important;
        direction: rtl !important;
        flex-shrink: 0;
    }

    [dir="ltr"] .testimonial-rating-new {
        justify-content: flex-end !important;
        direction: rtl !important;
    }

    .testimonial-rating-new i {
        color: #ffc107;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .testimonial-card-new:hover .testimonial-rating-new i {
        transform: scale(1.15);
        color: #ff9800;
    }

    .testimonial-author-new {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
        direction: rtl !important;
        justify-content: flex-end !important;
    }

    [dir="ltr"] .testimonial-author-new {
        direction: rtl !important;
        justify-content: flex-end !important;
    }

    .author-image-wrapper-new {
        position: relative;
        width: 70px;
        height: 70px;
        flex-shrink: 0;
        order: 1 !important;
    }

    [dir="ltr"] .author-image-wrapper-new {
        order: 1 !important;
    }

    .author-image-new {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
    }

    .author-image-border-new {
        position: absolute;
        top: -3px;
        right: -3px;
        left: -3px;
        bottom: -3px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .testimonial-card-new:hover .author-image-new {
        transform: scale(1.08);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-new:hover .author-image-border-new {
        opacity: 1;
    }

    .author-info-new {
        flex-grow: 1;
        order: 2 !important;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-info-new {
        order: 2 !important;
        direction: rtl !important;
        text-align: right !important;
    }

    .author-name-new {
        font-size: 18px;
        font-weight: 700;
        color: var(--colorBlack);
        margin: 0 0 5px 0;
        transition: color 0.3s ease;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-name-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-card-new:hover .author-name-new {
        color: var(--colorPrimary);
    }

    .author-designation-new {
        font-size: 14px;
        color: #666;
        margin: 0;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-designation-new {
        direction: rtl !important;
        text-align: right !important;
    }

    /* Swiper Navigation for Testimonials */
    .testimonial-next,
    .testimonial-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        top: 20% !important;
        margin-top: 0 !important;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .testimonial-next::after,
    .testimonial-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .testimonial-next:hover,
    .testimonial-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .testimonial-prev {
        left: -22.5px;
    }

    .testimonial-next {
        right: -22.5px;
    }

    /* Pagination */
    .testimonial-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .testimonial-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .testimonial-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .testimonial-prev {
            left: 10px;
        }

        .testimonial-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .testimonial-swiper-wrapper {
            padding: 30px 0 40px;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .testimonial-swiper-modern {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .testimonial-swiper-modern .swiper-wrapper {
            display: flex !important;
            visibility: visible !important;
        }
        
        .testimonial-swiper-modern .swiper-slide {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }
        
        .testimonial-card-new {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }

        .testimonial-card-inner {
            padding: 30px 25px;
        }

        .testimonial-quote-icon-new {
            width: 50px;
            height: 50px;
            top: 20px;
            right: 20px;
        }

        .testimonial-quote-icon-new i {
            font-size: 24px;
        }

        .testimonial-text-new {
            font-size: 15px;
        }

        .author-image-wrapper-new {
            width: 60px;
            height: 60px;
        }

        .author-name-new {
            font-size: 17px;
        }

        .author-designation-new {
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        .testimonial-next,
        .testimonial-prev {
            width: 40px;
            height: 40px;
            top: 15% !important;
            margin-top: 0 !important;
        }

        .testimonial-next::after,
        .testimonial-prev::after {
            font-size: 16px;
        }

        .testimonial-prev {
            left: 5px;
        }

        .testimonial-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .testimonial-swiper-wrapper {
            padding: 20px 0 30px;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .testimonial-swiper-modern {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .testimonial-swiper-modern .swiper-wrapper {
            display: flex !important;
            visibility: visible !important;
        }
        
        .testimonial-swiper-modern .swiper-slide {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }
        
        .testimonial-card-new {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }

        .testimonial-card-inner {
            padding: 25px 20px;
            gap: 15px;
        }

        .testimonial-quote-icon-new {
            width: 45px;
            height: 45px;
            top: 15px;
            right: 15px;
        }

        .testimonial-quote-icon-new i {
            font-size: 20px;
        }

        .testimonial-text-new {
            font-size: 14px;
            line-height: 1.7;
        }

        .author-image-wrapper-new {
            width: 55px;
            height: 55px;
        }

        .author-name-new {
            font-size: 16px;
        }

        .author-designation-new {
            font-size: 12px;
        }

        .testimonial-rating-new i {
            font-size: 14px;
        }
    }

    /* Blog Modern Styles */
    .blog-area-modern {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .blog-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(107, 93, 71, 0.03) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(107, 93, 71, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .blog-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
    }

    .blog-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .blog-card-modern {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        margin: 20px 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: var(--colorPrimary);
    }

    .blog-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: #f0f0f0;
    }

    .blog-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .blog-image-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .blog-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.8) 0%, rgba(90, 77, 58, 0.8) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .blog-image-overlay i {
        color: #ffffff;
        font-size: 32px;
        transform: scale(0);
        transition: all 0.4s ease;
    }

    .blog-card-modern:hover .blog-image {
        transform: scale(1.1);
    }

    .blog-card-modern:hover .blog-image-overlay {
        opacity: 1;
    }

    .blog-card-modern:hover .blog-image-overlay i {
        transform: scale(1);
    }

    .blog-date-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #ffffff;
        padding: 12px 16px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
        z-index: 2;
    }

    .blog-day {
        display: block;
        font-size: 24px;
        font-weight: 700;
        line-height: 1;
    }

    .blog-month {
        display: block;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        margin-top: 4px;
        opacity: 0.9;
    }

    .blog-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

.blog-title {
        margin: 0 0 15px 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.4;
        min-height: 62px;
    }

    .blog-title a {
        color: var(--colorBlack);
        text-decoration: none;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-card-modern:hover .blog-title a {
        color: var(--colorPrimary);
    }

    .blog-excerpt {
        color: #666;
        line-height: 1.8;
        margin: 0 0 20px 0;
        font-size: 15px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 12px 0;
        width: 100%;
    }

    .blog-read-more i {
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .blog-card-modern:hover .blog-read-more {
        color: var(--colorSecondary);
        transform: translateX(5px);
    }

    [dir="rtl"] .blog-card-modern:hover .blog-read-more {
        transform: translateX(-5px);
    }

    .blog-card-modern:hover .blog-read-more i {
        transform: translateX(3px);
    }

    [dir="rtl"] .blog-card-modern:hover .blog-read-more i {
        transform: translateX(-3px);
    }

    /* Swiper Navigation */
    .blog-next,
    .blog-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        top: 20% !important;
        margin-top: 0 !important;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .blog-next::after,
    .blog-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .blog-next:hover,
    .blog-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .blog-prev {
        left: -22.5px;
    }

    .blog-next {
        right: -22.5px;
    }

    /* Pagination */
    .blog-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .blog-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .blog-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .blog-prev {
            left: 10px;
        }

        .blog-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .blog-area-modern {
            padding: 30px 0;
        }

        .blog-image-wrapper {
            height: 240px;
        }

        .blog-content {
            padding: 25px 20px;
        }

        .blog-title {
            font-size: 20px;
            min-height: 56px;
        }

        .blog-date-badge {
            top: 15px;
            left: 15px;
            padding: 10px 14px;
        }

        .blog-day {
            font-size: 20px;
        }

        .blog-month {
            font-size: 11px;
        }

        .blog-next,
        .blog-prev {
            width: 40px;
            height: 40px;
            top: 15% !important;
            margin-top: 0 !important;
        }

        .blog-next::after,
        .blog-prev::after {
            font-size: 16px;
        }

        .blog-prev {
            left: 10px;
        }

        .blog-next {
            right: 10px;
        }
    }

    @media (max-width: 480px) {
        .blog-image-wrapper {
            height: 200px;
        }

        .blog-content {
            padding: 20px 15px;
        }

        .blog-title {
            font-size: 18px;
            min-height: 50px;
        }

        .blog-excerpt {
            font-size: 14px;
        }
    }
    [dir="rtl"] .blog-date-badge {
        left: auto;
        right: 20px;
    }

    [dir="rtl"] .blog-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .blog-next {
        right: auto;
        left: -30px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .blog-prev {
            right: 10px;
        }

        [dir="rtl"] .blog-next {
            left: 10px;
        }
    }

    /* Lawyer Modern Styles */
    .lawyer-area-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .lawyer-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(107,93,71,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
        pointer-events: none;
    }

    .lawyer-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
        display: block !important;
        visibility: visible !important;
    }

    .lawyer-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
        display: block !important;
        visibility: visible !important;
    }
    
    .lawyer-swiper-modern .swiper-wrapper {
        display: flex !important;
        visibility: visible !important;
    }
    
    .lawyer-swiper-modern .swiper-slide {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .lawyer-card-modern {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        margin: 20px 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .lawyer-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: var(--colorPrimary);
    }

    .lawyer-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 320px;
        background: #f0f0f0;
    }

    .lawyer-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .lawyer-image-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .lawyer-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.8) 0%, rgba(90, 77, 58, 0.8) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .lawyer-image-overlay i {
        color: #ffffff;
        font-size: 32px;
        transform: scale(0);
        transition: all 0.4s ease;
    }

    .lawyer-card-modern:hover .lawyer-image {
        transform: scale(1.1);
    }

    .lawyer-card-modern:hover .lawyer-image-overlay {
        opacity: 1;
    }

    .lawyer-card-modern:hover .lawyer-image-overlay i {
        transform: scale(1);
    }

    .lawyer-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .lawyer-name {
        margin: 0 0 15px 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.4;
    }

    .lawyer-name a {
        color: var(--colorBlack);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .lawyer-card-modern:hover .lawyer-name a {
        color: var(--colorPrimary);
    }

    .lawyer-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .lawyer-department-meta,
    .lawyer-location-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
    }

    .lawyer-department-meta i,
    .lawyer-location-meta i {
        color: var(--colorPrimary);
        font-size: 14px;
        flex-shrink: 0;
    }

    .lawyer-designations {
        color: #666;
        line-height: 1.6;
        margin: 0 0 15px 0;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .lawyer-designations i {
        color: var(--colorPrimary);
        font-size: 14px;
        flex-shrink: 0;
    }

    .lawyer-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding: 10px 0;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }

    .lawyer-rating .rating-text {
        color: #666;
        font-size: 14px;
    }

    .lawyer-rating .rating-text.no-rating {
        color: #999;
    }

    .lawyer-view-profile {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 12px 20px;
        border-radius: 8px;
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.08);
        border: 1px solid rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.2);
    }

    .lawyer-view-profile i {
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .lawyer-card-modern:hover .lawyer-view-profile {
        color: #fff;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-color: var(--colorPrimary);
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(107, 93, 71, 0.3);
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile {
        transform: translateX(-5px);
    }

    .lawyer-card-modern:hover .lawyer-view-profile i {
        transform: translateX(3px);
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile i {
        transform: translateX(-3px);
    }

    /* RTL: Enhanced button design for Arabic */
    [dir="rtl"] .lawyer-view-profile {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        padding: 12px 20px;
    }

    [dir="rtl"] .lawyer-view-profile i {
        order: 2;
        margin-left: 12px;
        margin-right: 0;
    }

    [dir="rtl"] .lawyer-view-profile span {
        order: 1;
        text-align: right;
    }

    /* Swiper Navigation */
    .lawyer-next,
    .lawyer-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        top: 20% !important;
        margin-top: 0 !important;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .lawyer-next::after,
    .lawyer-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .lawyer-next:hover,
    .lawyer-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .lawyer-prev {
        left: -22.5px;
    }

    .lawyer-next {
        right: -22.5px;
    }

    /* Pagination */
    .lawyer-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .lawyer-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .lawyer-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .lawyer-prev {
            left: 10px;
        }

        .lawyer-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .lawyer-area-modern {
            padding: 30px 0;
        }
        
        .lawyer-swiper-wrapper {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .lawyer-swiper-modern {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .lawyer-swiper-modern .swiper-wrapper {
            display: flex !important;
            visibility: visible !important;
        }
        
        .lawyer-swiper-modern .swiper-slide {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }
        
        .lawyer-card-mobile,
        .aman-lawyer-card-mobile-rtl {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }

        .lawyer-image-wrapper {
            height: 280px;
        }

        .lawyer-content {
            padding: 25px 20px;
        }

        .lawyer-name {
            font-size: 20px;
        }

        .lawyer-next,
        .lawyer-prev {
            width: 40px;
            height: 40px;
            top: 15% !important;
            margin-top: 0 !important;
        }

        .lawyer-next::after,
        .lawyer-prev::after {
            font-size: 16px;
        }

        .lawyer-prev {
            left: 5px;
        }

        .lawyer-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .lawyer-swiper-wrapper {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .lawyer-swiper-modern {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .lawyer-swiper-modern .swiper-wrapper {
            display: flex !important;
            visibility: visible !important;
        }
        
        .lawyer-swiper-modern .swiper-slide {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }
        
        .lawyer-card-mobile,
        .aman-lawyer-card-mobile-rtl {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }
        
        .lawyer-image-wrapper {
            height: 240px;
        }

        .lawyer-content {
            padding: 20px 15px;
        }

        .lawyer-name {
            font-size: 18px;
        }

        .lawyer-meta {
            flex-direction: column;
            gap: 10px;
        }
    }
    [dir="rtl"] .lawyer-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .lawyer-next {
        right: auto;
        left: -30px;
    }
    
    [dir="rtl"] .testimonial-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .testimonial-next {
        right: auto;
        left: -30px;
    }
    
    @media (max-width: 1200px) {
        [dir="rtl"] .testimonial-prev {
            left: auto;
            right: 10px;
        }

        [dir="rtl"] .testimonial-next {
            right: auto;
            left: 10px;
        }
    }
    
    @media (max-width: 768px) {
        [dir="rtl"] .testimonial-prev {
            left: auto;
            right: 5px;
        }

        [dir="rtl"] .testimonial-next {
            right: auto;
            left: 5px;
        }
    }
    [dir="rtl"] .lawyer-meta {
        justify-content: flex-end;
        align-items: flex-end;
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .lawyer-department-meta,
    [dir="rtl"] .lawyer-location-meta {
        flex-direction: row;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
    }

    /* Text on the right, icons close to text on left */
    [dir="rtl"] .lawyer-department-meta,
    [dir="rtl"] .lawyer-location-meta {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    [dir="rtl"] .lawyer-department-meta i,
    [dir="rtl"] .lawyer-location-meta i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    [dir="rtl"] .lawyer-department-meta span,
    [dir="rtl"] .lawyer-location-meta span {
        order: 1;
        text-align: right;
    }

    [dir="rtl"] .lawyer-designations {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    /* Text on the right, icon close to text on left */
    [dir="rtl"] .lawyer-designations i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }
    [dir="rtl"] .lawyer-rating {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    /* Stars should be on the left of text (after text in RTL reading direction) */
    [dir="rtl"] .lawyer-rating .star-rating {
        order: 2;
        direction: ltr;
    }

    [dir="rtl"] .lawyer-rating .rating-text {
        order: 1;
        text-align: right;
        margin-left: 0;
        margin-right: 0;
    }
    [dir="rtl"] .lawyer-view-profile {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        padding: 12px 20px;
    }

    /* Arrow icon close to text on left */
    [dir="rtl"] .lawyer-view-profile i {
        order: 2;
        margin-left: 12px;
        margin-right: 0;
        font-size: 16px;
    }

    [dir="rtl"] .lawyer-view-profile span {
        order: 1;
        text-align: right;
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile {
        box-shadow: 0 4px 12px rgba(107, 93, 71, 0.3);
    }

    /* Mobile RTL Support for Lawyer Card */
    @media (max-width: 768px) {
        [dir="rtl"] .lawyer-meta {
            align-items: flex-end;
            justify-content: flex-end;
        }

        [dir="rtl"] .lawyer-department-meta,
        [dir="rtl"] .lawyer-location-meta {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-department-meta i,
        [dir="rtl"] .lawyer-location-meta i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-designations {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-designations i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-rating {
            justify-content: flex-end;
            text-align: right;
            flex-direction: row-reverse;
        }

        [dir="rtl"] .lawyer-rating .star-rating {
            order: 2;
        }

        [dir="rtl"] .lawyer-rating .rating-text {
            order: 1;
            text-align: right;
        }

        [dir="rtl"] .lawyer-view-profile {
            justify-content: flex-end;
            text-align: right;
            padding: 12px 18px;
        }

        [dir="rtl"] .lawyer-view-profile i {
            margin-left: 12px;
            margin-right: 0;
        }
    }

    @media (max-width: 480px) {
        [dir="rtl"] .lawyer-meta {
            align-items: flex-end;
            justify-content: flex-end;
        }

        [dir="rtl"] .lawyer-department-meta,
        [dir="rtl"] .lawyer-location-meta {
            text-align: right;
            justify-content: flex-end;
            width: 100%;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-department-meta i,
        [dir="rtl"] .lawyer-location-meta i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-designations {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-designations i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-view-profile {
            padding: 10px 16px;
        }

        [dir="rtl"] .lawyer-rating {
            justify-content: flex-end;
            text-align: right;
            flex-direction: row-reverse;
        }

        [dir="rtl"] .lawyer-rating .star-rating {
            order: 2;
        }

        [dir="rtl"] .lawyer-rating .rating-text {
            order: 1;
            text-align: right;
        }

        [dir="rtl"] .lawyer-view-profile {
            justify-content: flex-end;
            text-align: right;
        }
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .lawyer-prev {
            right: 10px;
        }

        [dir="rtl"] .lawyer-next {
            left: 10px;
        }
    }

    /* Service Swiper Styles */
    .service-swiper-container {
        padding: 20px 0 40px;
        position: relative;
    }

    .service-swiper {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .service-swiper .swiper-slide {
        height: auto;
        display: flex;
        justify-content: center;
    }

    .service-item {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #e9ecef;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 380px;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 0 auto;
    }

    .service-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .service-item:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(107, 93, 71, 0.25);
        border-color: var(--colorPrimary);
    }

    .service-item:hover::before {
        transform: scaleX(1);
    }

    .service-icon-wrapper {
        margin-bottom: 25px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        text-align: center;
    }

    .service-item i {
        color: var(--colorPrimary);
        font-size: 64px;
        transition: all 0.4s ease;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
        width: 110px;
        height: 110px;
        border-radius: 25px;
        position: relative;
        z-index: 1;
        margin: 0 auto;
        text-align: center;
        line-height: 1 !important;
    }
    
    .service-item i::before {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        line-height: 1;
    }

    .service-item:hover i {
        transform: scale(1.15) rotate(5deg);
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff;
        box-shadow: 0 10px 25px rgba(107, 93, 71, 0.35);
    }

    .service-item .title {
        color: var(--colorBlack);
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 18px;
        transition: color 0.3s ease;
        line-height: 1.4;
        min-height: 68px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-item:hover .title {
        color: var(--colorPrimary);
    }

    .service-item p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 25px;
        font-size: 15px;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .service-link {
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        position: relative;
        padding: 12px 20px;
        border: 2px solid var(--colorPrimary);
        border-radius: 8px;
        margin-top: auto;
    }

    .service-link i {
        font-size: 14px;
        width: auto;
        height: auto;
        line-height: 1;
        background: none;
        border-radius: 0;
        transition: transform 0.3s ease;
    }

    .service-item:hover .service-link {
        background: var(--colorPrimary);
        color: #fff;
        transform: translateX(5px);
    }

    .service-item:hover .service-link i {
        transform: translateX(-3px);
        background: none;
        box-shadow: none;
        color: #fff;
    }

    /* Swiper Navigation Buttons */
    .service-swiper-next,
    .service-swiper-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        top: 20% !important;
        margin-top: 0 !important;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .service-swiper-next:hover,
    .service-swiper-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.1);
    }

    .service-swiper-prev {
        left: -22.5px;
    }

    .service-swiper-next {
        right: -22.5px;
    }

    /* Swiper Pagination */
    .service-swiper-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .service-swiper-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
    }

    .service-swiper-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 30px;
        border-radius: 6px;
        background: var(--colorPrimary);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .service-swiper-prev {
            left: 10px;
        }

        .service-swiper-next {
            right: 10px;
        }
    }

    @media (max-width: 991px) {
        .service-item {
            min-height: 400px;
            padding: 35px 25px;
        }

        .service-item i {
            font-size: 56px;
            width: 100px;
            height: 100px;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
        }

        .service-item .title {
            font-size: 22px;
            min-height: 60px;
        }
    }

    @media (max-width: 768px) {
        .service-swiper-container {
            padding: 15px 0 30px;
        }

        .service-item {
            min-height: 380px;
            padding: 30px 20px;
            max-width: 100%;
        }

        .service-item i {
            font-size: 48px;
            width: 90px;
            height: 90px;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
        }

        .service-item .title {
            font-size: 20px;
            min-height: 56px;
        }

        .service-swiper-next,
        .service-swiper-prev {
            width: 35px;
            height: 35px;
            top: 15% !important;
            margin-top: 0 !important;
        }

        .service-swiper-next::after,
        .service-swiper-prev::after {
            font-size: 14px;
        }

        .service-swiper-prev {
            left: 5px;
        }

        .service-swiper-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .service-item {
            min-height: 360px;
            padding: 25px 15px;
        }

        .service-item i {
            font-size: 42px;
            width: 80px;
            height: 80px;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
        }

        .service-item .title {
            font-size: 18px;
            min-height: 52px;
        }
    }
    [dir="rtl"] .service-link {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .service-swiper-prev {
        left: auto;
        right: -25px;
    }

    [dir="rtl"] .service-swiper-next {
        right: auto;
        left: -25px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .service-swiper-prev {
            right: 10px;
        }

        [dir="rtl"] .service-swiper-next {
            left: 10px;
        }
    }

    /* ============================================
       How It Works Section - Enhanced Design
       تحسين تصميم قسم كيف يعمل
       ============================================ */
    .how-it-works-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f4f8 100%);
        position: relative;
        overflow: hidden;
    }

    .how-it-works-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(107, 93, 71, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(107, 93, 71, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .how-it-works-item {
        position: relative;
        padding: 50px 35px;
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        height: 100%;
        overflow: visible;
        z-index: 1;
    }

    .how-it-works-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #6b5d47 0%, #8b7355 50%, #6b5d47 100%);
        border-radius: 25px 25px 0 0;
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: left;
    }

    .how-it-works-item:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: #6b5d47;
    }

    .how-it-works-item:hover::before {
        transform: scaleX(1);
    }

    .step-number {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%);
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        z-index: 10;
        border: 4px solid #ffffff;
        transition: all 0.4s ease;
    }

    .how-it-works-item:hover .step-number {
        transform: translateX(-50%) scale(1.15) rotate(5deg);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
        background: linear-gradient(135deg, #f4d03f 0%, #ffd700 50%, #f4d03f 100%);
    }

    .step-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #6b5d47 0%, #8b7355 50%, #a0826d 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px auto 30px;
        font-size: 42px;
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(107, 93, 71, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .step-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .step-icon i {
        font-size: 42px;
        color: #ffffff;
        position: relative;
        z-index: 1;
        transition: all 0.4s ease;
    }

    .how-it-works-item:hover .step-icon {
        transform: scale(1.15) rotate(5deg);
        box-shadow: 0 15px 40px rgba(107, 93, 71, 0.4);
        background: linear-gradient(135deg, #8b7355 0%, #a0826d 50%, #8b7355 100%);
    }

    .how-it-works-item:hover .step-icon::before {
        opacity: 1;
    }

    .how-it-works-item:hover .step-icon i {
        transform: scale(1.1);
    }

    /* Different gradient colors for each step */
    .step-item-1 .step-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .step-item-1:hover .step-icon {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .step-item-2 .step-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
    }

    .step-item-2:hover .step-icon {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4);
    }

    .step-item-3 .step-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
    }

    .step-item-3:hover .step-icon {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4);
    }

    .step-title {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 18px;
        transition: color 0.3s ease;
        line-height: 1.4;
    }

    .how-it-works-item:hover .step-title {
        color: #6b5d47;
    }

    .step-description {
        color: #5a6c7d;
        line-height: 1.9;
        margin: 0;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .how-it-works-item:hover .step-description {
        color: #4a5568;
    }

    /* Button Enhancement */
    .how-it-works-area .btn-primary {
        background: linear-gradient(135deg, #6b5d47 0%, #8b7355 100%);
        border: none;
        padding: 15px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 8px 25px rgba(107, 93, 71, 0.3);
        transition: all 0.3s ease;
        text-transform: none;
    }

    .how-it-works-area .btn-primary:hover {
        background: linear-gradient(135deg, #8b7355 0%, #6b5d47 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(107, 93, 71, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .how-it-works-item {
            padding: 40px 25px;
            margin-bottom: 40px;
        }

        .step-number {
            width: 55px;
            height: 55px;
            font-size: 24px;
            top: -25px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 90px;
            height: 90px;
            font-size: 38px;
            margin: 25px auto 25px;
        }

        .step-icon i {
            font-size: 38px;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-title {
            font-size: 22px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 15px;
            color: #5a6c7d !important;
        }
    }

    @media (max-width: 768px) {
        .how-it-works-item {
            padding: 35px 20px;
            background: #ffffff !important;
        }

        .step-number {
            width: 50px;
            height: 50px;
            font-size: 22px;
            top: -20px;
            border-width: 3px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 80px;
            height: 80px;
            font-size: 34px;
            margin: 20px auto 20px;
        }

        .step-icon i {
            font-size: 34px;
            color: #ffffff !important;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-1:hover .step-icon {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-2:hover .step-icon {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%) !important;
            box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-item-3:hover .step-icon {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%) !important;
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4) !important;
        }

        .step-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 14px;
            color: #5a6c7d !important;
        }
    }

    @media (max-width: 480px) {
        .how-it-works-item {
            padding: 30px 15px;
            background: #ffffff !important;
        }

        .step-number {
            width: 45px;
            height: 45px;
            font-size: 20px;
            top: -18px;
            border-width: 3px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 70px;
            height: 70px;
            font-size: 30px;
            margin: 15px auto 15px;
        }

        .step-icon i {
            font-size: 30px;
            color: #ffffff !important;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-1:hover .step-icon {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-2:hover .step-icon {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%) !important;
            box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-item-3:hover .step-icon {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%) !important;
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4) !important;
        }

        .step-title {
            font-size: 18px;
            margin-bottom: 12px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 13px;
            line-height: 1.7;
            color: #5a6c7d !important;
        }

        .how-it-works-area .btn-primary {
            padding: 12px 30px;
            font-size: 16px;
            background: linear-gradient(135deg, #6b5d47 0%, #8b7355 100%) !important;
        }
    }

    /* ============================================
       Mobile App Section - Image Enhancement
       تحسين عرض الصورة في قسم Mobile App
       ============================================ */
    .mobile-app-image {
        position: relative;
        z-index: 1;
    }

    .mobile-app-illustration {
        width: 100%;
        max-width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        animation: float 6s ease-in-out infinite;
    }

    .mobile-app-illustration:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }
    [dir="rtl"] .mobile-app-area .row {
        flex-direction: row-reverse;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .mobile-app-illustration {
            margin-bottom: 30px;
            max-width: 90%;
        }
    }

    @media (max-width: 768px) {
        .mobile-app-illustration {
            max-width: 100%;
            margin-bottom: 20px;
        }

        [dir="rtl"] .mobile-app-area .row {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .mobile-app-illustration {
            max-width: 100%;
            border-radius: 15px;
        }
    }

    /* Add spacing between sections */
    section,
    .hero-section,
    .quick-points-section,
    .service-area,
    .how-it-works-area,
    .about-us-section,
    .why-aman-law-section,
    .lawyer-area-modern,
    .testimonial-area-modern,
    .book-consultation-section,
    .contact-us-section,
    .blog-area-modern,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home,
    .case-study-area,
    .case-study-home-page {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
    }

    /* Add spacing between adjacent sections */
    section + section {
        margin-top: 0 !important;
        padding-top: 50px !important;
    }
    
    /* Hero section should not have top padding */
    .hero-section {
        padding-top: 0 !important;
    }

    /* Remove all padding classes */
    .pt_100, .pb_100, .pt_80, .pb_80, .pt_70, .pb_70, .pt_50, .pb_50, .pt_40, .pb_40, .pt_30, .pb_30 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    /* Remove all margin classes */
    .mt_200, .mt_100, .mt_80, .mt_70, .mt_65, .mt_50, .mt_40, .mt_30, .mt_25, .mt_20, .mt_15 {
        margin-top: 0 !important;
    }

    .mb_60, .mb_40, .mb_30, .mb_25, .mb_20, .mb_15 {
        margin-bottom: 0 !important;
    }

    /* Law Icons Animation Styles */
    .hero-icons-container {
        min-height: 400px;
        position: relative;
    }

    .law-icons-animation-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
    }

    /* Orbit Animation */
    @keyframes orbitIcon {
        0% {
            transform: rotate(0deg) translateX(var(--orbit-radius, 150px)) rotate(0deg);
        }
        100% {
            transform: rotate(360deg) translateX(var(--orbit-radius, 150px)) rotate(-360deg);
        }
    }

    /* Icon Animations */
    @keyframes iconPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.9;
        }
    }

    @keyframes iconSwing {
        0%, 100% {
            transform: rotate(-5deg);
        }
        50% {
            transform: rotate(5deg);
        }
    }

    @keyframes iconRotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes iconBounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes iconFloat {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        33% {
            transform: translateY(-8px) rotate(5deg);
        }
        66% {
            transform: translateY(-8px) rotate(-5deg);
        }
    }

    @keyframes iconShake {
        0%, 100% {
            transform: rotate(0deg);
        }
        25% {
            transform: rotate(-8deg);
        }
        75% {
            transform: rotate(8deg);
        }
    }

    /* Position Icons in Orbit - Using CSS Variables for Orbit Radius */
    .law-icons-animation-wrapper {
        --orbit-radius: 150px;
    }

    .law-icon-1 {
        top: 50%;
        left: 50%;
        margin-top: -40px;
        margin-left: -40px;
        transform-origin: 40px 40px;
    }

    .law-icon-2 {
        top: 50%;
        left: 50%;
        margin-top: -40px;
        margin-left: -40px;
        transform-origin: 40px 40px;
        animation-delay: -2s;
    }

    .law-icon-3 {
        top: 50%;
        left: 50%;
        margin-top: -40px;
        margin-left: -40px;
        transform-origin: 40px 40px;
        animation-delay: -4s;
    }

    .law-icon-4 {
        top: 50%;
        left: 50%;
        margin-top: -40px;
        margin-left: -40px;
        transform-origin: 40px 40px;
        animation-delay: -1s;
    }

    .law-icon-5 {
        top: 50%;
        left: 50%;
        margin-top: -35px;
        margin-left: -35px;
        transform-origin: 35px 35px;
        animation-delay: -3s;
    }

    .law-icon-6 {
        top: 50%;
        left: 50%;
        margin-top: -35px;
        margin-left: -35px;
        transform-origin: 35px 35px;
        animation-delay: -5s;
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .hero-icons-container {
            min-height: 350px;
        }

        .icon-wrapper-main {
            width: 100px !important;
            height: 100px !important;
        }

        .icon-wrapper-main i {
            font-size: 50px !important;
        }

        .icon-wrapper {
            width: 65px !important;
            height: 65px !important;
        }

        .icon-wrapper i {
            font-size: 28px !important;
        }

        .law-icons-animation-wrapper {
            --orbit-radius: 120px;
        }
    }

    @media (max-width: 768px) {
        .hero-icons-container {
            min-height: 300px;
        }

        .icon-wrapper-main {
            width: 90px !important;
            height: 90px !important;
        }

        .icon-wrapper-main i {
            font-size: 45px !important;
        }

        .icon-wrapper {
            width: 60px !important;
            height: 60px !important;
        }

        .icon-wrapper i {
            font-size: 25px !important;
        }

        .law-icons-animation-wrapper {
            --orbit-radius: 100px;
        }
    }

    @media (max-width: 480px) {
        .hero-icons-container {
            min-height: 250px;
        }

        .icon-wrapper-main {
            width: 80px !important;
            height: 80px !important;
        }

        .icon-wrapper-main i {
            font-size: 40px !important;
        }

        .icon-wrapper {
            width: 50px !important;
            height: 50px !important;
        }

        .icon-wrapper i {
            font-size: 20px !important;
        }

        .law-icons-animation-wrapper {
            --orbit-radius: 80px;
        }
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation for Hero Stats
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count') || element.textContent.replace(/[^0-9]/g, ''));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                // Format number with + or decimal if needed
                if (target >= 1000) {
                    element.textContent = Math.floor(current).toLocaleString() + '+';
                } else if (target < 1 && target > 0) {
                    element.textContent = current.toFixed(1);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Intersection Observer for counter animation
        const statNumbers = document.querySelectorAll('.legal-stat-number[data-count]');
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    animateCounter(entry.target);
                }
            });
        }, observerOptions);

        statNumbers.forEach(stat => {
            observer.observe(stat);
        });

        // Handle image fallbacks
        document.querySelectorAll('img[data-fallback]').forEach(function(img) {
            img.addEventListener('error', function() {
                var fallback = this.getAttribute('data-fallback');
                if (fallback) {
                    this.onerror = null;
                    this.src = fallback;
                    // Handle hide on error for hero image
                    if (this.getAttribute('data-hide-on-error') === 'true') {
                        this.addEventListener('error', function() {
                            this.style.display = 'none';
                            if (this.nextElementSibling) {
                                this.nextElementSibling.style.display = 'flex';
                            }
                        }, { once: true });
                    }
                }
            }, { once: true });
        });


        if (typeof Swiper !== 'undefined') {
            // Testimonials now use Swiper, so no need for equal height function

            // Blog Swiper
            const blogSwiper = new Swiper('.blog-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.blog-next',
                    prevEl: '.blog-prev',
                },
                pagination: {
                    el: '.blog-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                slide.style.transform = 'scale(0.95)';
                                setTimeout(() => {
                                    slide.style.transition = 'all 0.5s ease';
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'scale(1)';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const blogContainer = document.querySelector('.blog-swiper-modern');
            if (blogContainer) {
                blogContainer.addEventListener('mouseenter', function() {
                    blogSwiper.autoplay.stop();
                });
                blogContainer.addEventListener('mouseleave', function() {
                    blogSwiper.autoplay.start();
                });
            }

            // Service Swiper
            const serviceSwiper = new Swiper('.service-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.service-swiper-next',
                    prevEl: '.service-swiper-prev',
                },
                pagination: {
                    el: '.service-swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    init: function() {
                        // Ensure all slides are visible on initialization, especially on mobile
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            const card = slide.querySelector('.lawyer-card-mobile, .aman-lawyer-card-mobile-rtl');
                            if (card) {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0) scale(1)';
                                card.style.visibility = 'visible';
                            }
                            slide.style.opacity = '1';
                        });
                    },
                    slideChange: function() {
                        const slides = this.slides;
                        const isMobile = window.innerWidth <= 768;
                        slides.forEach((slide, index) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                if (!isMobile) {
                                    slide.style.opacity = '0';
                                    setTimeout(() => {
                                        slide.style.transition = 'opacity 0.5s ease';
                                        slide.style.opacity = '1';
                                    }, 50);
                                } else {
                                    // On mobile, keep slides visible
                                    slide.style.opacity = '1';
                                    const card = slide.querySelector('.lawyer-card-mobile, .aman-lawyer-card-mobile-rtl');
                                    if (card) {
                                        card.style.opacity = '1';
                                        card.style.transform = 'translateY(0) scale(1)';
                                        card.style.visibility = 'visible';
                                    }
                                }
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const swiperContainer = document.querySelector('.service-swiper');
            if (swiperContainer) {
                swiperContainer.addEventListener('mouseenter', function() {
                    serviceSwiper.autoplay.stop();
                });
                swiperContainer.addEventListener('mouseleave', function() {
                    serviceSwiper.autoplay.start();
                });
            }

            // Lawyer Swiper
            const lawyerSwiper = new Swiper('.lawyer-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.lawyer-next',
                    prevEl: '.lawyer-prev',
                },
                pagination: {
                    el: '.lawyer-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                slide.style.transform = 'scale(0.95)';
                                setTimeout(() => {
                                    slide.style.transition = 'all 0.5s ease';
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'scale(1)';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const lawyerContainer = document.querySelector('.lawyer-swiper-modern');
            if (lawyerContainer) {
                lawyerContainer.addEventListener('mouseenter', function() {
                    lawyerSwiper.autoplay.stop();
                });
                lawyerContainer.addEventListener('mouseleave', function() {
                    lawyerSwiper.autoplay.start();
                });
            }

            // Testimonial Swiper
            const testimonialSwiper = new Swiper('.testimonial-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.testimonial-next',
                    prevEl: '.testimonial-prev',
                },
                pagination: {
                    el: '.testimonial-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    init: function() {
                        // Ensure all slides are visible on initialization, especially on mobile
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            const card = slide.querySelector('.testimonial-card-new');
                            if (card) {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0) scale(1)';
                                card.style.visibility = 'visible';
                            }
                            slide.style.opacity = '1';
                        });
                    },
                    slideChange: function() {
                        const slides = this.slides;
                        const isMobile = window.innerWidth <= 768;
                        slides.forEach((slide, index) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                if (!isMobile) {
                                    slide.style.opacity = '0';
                                    setTimeout(() => {
                                        slide.style.transition = 'opacity 0.5s ease';
                                        slide.style.opacity = '1';
                                    }, 50);
                                } else {
                                    // On mobile, keep slides visible
                                    slide.style.opacity = '1';
                                    const card = slide.querySelector('.testimonial-card-new');
                                    if (card) {
                                        card.style.opacity = '1';
                                        card.style.transform = 'translateY(0) scale(1)';
                                        card.style.visibility = 'visible';
                                    }
                                }
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const testimonialContainer = document.querySelector('.testimonial-swiper-modern');
            if (testimonialContainer) {
                testimonialContainer.addEventListener('mouseenter', function() {
                    testimonialSwiper.autoplay.stop();
                });
                testimonialContainer.addEventListener('mouseleave', function() {
                    testimonialSwiper.autoplay.start();
                });
            }
        }
    });
</script>

<style>
/* ============================================
   SERVICE SWIPER NAVIGATION IMPROVEMENTS
   ============================================ */

/* Enhanced Service Swiper Container */
.service-swiper-container {
    position: relative !important;
    padding: 20px 80px 40px !important; /* Increased horizontal padding for navigation */
    overflow: visible !important;
}

/* Service Swiper Wrapper */
.service-swiper {
    padding: 20px 0 60px !important;
    overflow: visible !important;
}

/* Enhanced Service Navigation Buttons */
.service-swiper-next,
.service-swiper-prev {
    width: 56px !important;
    height: 56px !important;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
    border: 3px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 50% !important;
    color: #fff !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3) !important;
    backdrop-filter: blur(10px) !important;
    position: absolute !important;
    top: 20% !important;
    transform: none !important;
    z-index: 10 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    opacity: 0.9 !important;
}

/* Perfectly Balanced Positioning */
.service-swiper-prev {
    left: -28px !important; /* Exactly half of button width */
}

.service-swiper-next {
    right: -28px !important; /* Exactly half of button width */
}

/* Enhanced Arrow Icons */
.service-swiper-next::after,
.service-swiper-prev::after {
    font-size: 20px !important;
    font-weight: bold !important;
    color: #fff !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
    transition: all 0.3s ease !important;
}

/* Hover Effects */
.service-swiper-next:hover,
.service-swiper-prev:hover {
    background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
    transform: translateY(-50%) scale(1.1) !important;
    box-shadow: 0 8px 30px rgba(200, 180, 126, 0.4) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
    opacity: 1 !important;
}

.service-swiper-next:hover::after,
.service-swiper-prev:hover::after {
    transform: scale(1.1) !important;
    text-shadow: 0 3px 6px rgba(0,0,0,0.4) !important;
}

/* Active State */
.service-swiper-next:active,
.service-swiper-prev:active {
    transform: translateY(-50%) scale(0.95) !important;
    transition: all 0.1s ease !important;
}

/* Service Card Hover Interaction */
.service-item:hover ~ .service-swiper-next,
.service-item:hover ~ .service-swiper-prev,
.service-swiper:hover .service-swiper-next,
.service-swiper:hover .service-swiper-prev {
    opacity: 1 !important;
}

/* ============================================
   MOBILE RESPONSIVE SERVICE NAVIGATION
   ============================================ */

@media (max-width: 1200px) {
    .service-swiper-container {
        padding: 20px 70px 40px !important;
    }

    .service-swiper-prev {
        left: -23px !important;
    }

    .service-swiper-next {
        right: -23px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 50px !important;
        height: 50px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px !important;
    }
}

@media (max-width: 991px) {
    .service-swiper-container {
        padding: 15px 60px 30px !important;
    }

    .service-swiper-prev {
        left: -20px !important;
    }

    .service-swiper-next {
        right: -20px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 48px !important;
        height: 48px !important;
        opacity: 1 !important; /* Always visible on mobile */
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 16px !important;
    }
}

@media (max-width: 768px) {
    .service-swiper-container {
        padding: 15px 50px 30px !important;
    }

    .service-swiper-prev {
        left: -15px !important;
    }

    .service-swiper-next {
        right: -15px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 44px !important;
        height: 44px !important;
        border-width: 2px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 14px !important;
    }
}

@media (max-width: 576px) {
    .service-swiper-container {
        padding: 10px 40px 25px !important;
    }

    .service-swiper-prev {
        left: -12px !important;
    }

    .service-swiper-next {
        right: -12px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 40px !important;
        height: 40px !important;
        top: 15% !important;
        margin-top: 0 !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 12px !important;
    }
}

/* ============================================
   RTL SUPPORT FOR SERVICE NAVIGATION
   ============================================ */

[dir="rtl"] .service-swiper-prev {
    right: -28px !important;
    left: auto !important;
}

[dir="rtl"] .service-swiper-next {
    left: -28px !important;
    right: auto !important;
}

@media (max-width: 1200px) {
    [dir="rtl"] .service-swiper-prev {
        right: -23px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -23px !important;
    }
}

@media (max-width: 991px) {
    [dir="rtl"] .service-swiper-prev {
        right: -20px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -20px !important;
    }
}

@media (max-width: 768px) {
    [dir="rtl"] .service-swiper-prev {
        right: -15px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -15px !important;
    }
}

@media (max-width: 576px) {
    [dir="rtl"] .service-swiper-prev {
        right: -12px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -12px !important;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.service-swiper-next:focus,
.service-swiper-prev:focus {
    outline: 2px solid rgba(255, 255, 255, 0.8) !important;
    outline-offset: 3px !important;
    opacity: 1 !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .service-swiper-next,
    .service-swiper-prev {
        border-width: 4px !important;
        border-color: #fff !important;
        background: #000 !important;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .service-swiper-next,
    .service-swiper-prev {
        transition: none !important;
    }

    .service-swiper-next:hover,
    .service-swiper-prev:hover {
        transform: scale(1.1) !important;
    }
}

/* ============================================
   TOUCH DEVICE OPTIMIZATIONS
   ============================================ */

@media (hover: none) and (pointer: coarse) {
    .service-swiper-next,
    .service-swiper-prev {
        width: 52px !important;
        height: 52px !important;
        opacity: 1 !important; /* Always visible on touch devices */
        border-width: 3px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px !important;
    }
}

/* ============================================
   VISUAL ENHANCEMENT - SUBTLE ANIMATIONS
   ============================================ */

.service-swiper-next,
.service-swiper-prev {
    animation: gentlePulse 3s ease-in-out infinite !important;
}

@keyframes gentlePulse {
    0%, 100% {
        box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3);
    }
    50% {
        box-shadow: 0 6px 25px rgba(200, 180, 126, 0.4);
    }
}

/* Pause animation on hover */
.service-swiper-next:hover,
.service-swiper-prev:hover {
    animation-play-state: paused !important;
}

/* ============================================
   COMPREHENSIVE MOBILE RESPONSIVE IMPROVEMENTS
   تحسينات شاملة للتصميم المتجاوب للموبايل
   ============================================ */

@media (max-width: 991px) {
    /* Prevent horizontal scroll */
    html, body {
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }

    * {
        max-width: 100%;
    }

    /* Section improvements - Add spacing */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home,
    .hero-section,
    .quick-points-section,
    .about-us-section,
    .why-aman-law-section,
    .book-consultation-section,
    .contact-us-section {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
    }
    
    /* Hero section should not have top padding */
    .hero-section {
        padding-top: 0 !important;
    }

    /* Main headline improvements - Center all section titles and descriptions */
    .main-headline {
        text-align: center !important;
        margin-bottom: 30px;
        width: 100%;
    }
    
    .main-headline * {
        text-align: center !important;
    }

    .main-headline .title {
        font-size: 28px !important;
        line-height: 1.3;
        margin-bottom: 15px;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 15px;
        line-height: 1.7;
        text-align: center !important;
    }

    /* Service items improvements */
    .service-item {
        margin-bottom: 25px;
        padding: 25px 20px;
    }

    .service-item .title {
        font-size: 20px !important;
        margin-bottom: 15px;
    }

    .service-item p {
        font-size: 14px;
        line-height: 1.7;
    }

    /* Choose items improvements */
    .choose-item {
        padding: 25px 20px;
        margin-bottom: 20px;
    }

    .choose-item .title {
        font-size: 20px !important;
    }

    /* Feature accordion improvements */
    .feature-accordion {
        margin-top: 25px;
    }

    .faq-item {
        margin-bottom: 15px;
    }

    .faq-button {
        padding: 15px 20px;
        font-size: 16px;
        min-height: 60px;
    }

    /* Blog cards improvements */
    .blog-card-modern {
        margin-bottom: 25px;
    }

    .blog-content {
        padding: 20px;
    }

    .blog-title {
        font-size: 20px !important;
        margin-bottom: 12px;
    }

    /* Lawyer cards improvements */
    .lawyer-card-modern {
        margin-bottom: 25px;
    }

    .lawyer-content {
        padding: 20px;
    }

    .lawyer-name {
        font-size: 20px !important;
        margin-bottom: 10px;
    }

    /* Testimonial cards improvements */
    .testimonial-card-modern {
        padding: 30px 25px;
        margin-bottom: 20px;
    }

    .testimonial-text {
        font-size: 16px;
        line-height: 1.7;
    }

    /* How it works improvements */
    .how-it-works-item {
        padding: 30px 20px;
        margin-bottom: 25px;
    }

    .step-title {
        font-size: 18px !important;
    }

    .step-description {
        font-size: 14px;
        line-height: 1.7;
    }

    /* Mobile app section improvements */
    .mobile-app-content {
        text-align: center;
        margin-bottom: 30px;
    }

    .mobile-app-content .title {
        font-size: 28px !important;
        margin-bottom: 15px;
    }

    /* Fixed price section improvements */
    .fixed-price-content {
        text-align: center;
    }

    .fixed-price-content .title {
        font-size: 28px !important;
    }

    /* Legal aid check improvements */
    .legal-aid-check-content {
        text-align: center;
    }

    .legal-aid-check-content .title {
        font-size: 28px !important;
    }

    /* Swiper improvements */
  

    .swiper-pagination {
        bottom: 10px !important;
    }

    /* Video section improvements */
    .video-section {
        margin: 20px 0;
    }

    /* Image improvements */
    .about-img img,
    .service-item img,
    .blog-image-wrapper img,
    .lawyer-image-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 12px;
    }
}

@media (max-width: 768px) {
    /* Further mobile optimizations */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding: 30px 0 !important;
    }

    .main-headline .title {
        font-size: 24px !important;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 14px;
        text-align: center !important;
    }

    .service-item {
        padding: 20px 15px;
    }

    .service-item .title {
        font-size: 18px !important;
        min-height: auto !important;
    }

    .choose-item {
        padding: 20px 15px;
    }

    .blog-content,
    .lawyer-content {
        padding: 15px;
    }

    .blog-title,
    .lawyer-name {
        font-size: 18px !important;
    }

    .testimonial-card-modern {
        padding: 25px 20px;
    }

    .testimonial-text {
        font-size: 15px;
    }

    .how-it-works-item {
        padding: 25px 15px;
    }

    .step-title {
        font-size: 17px !important;
    }

    .mobile-app-content .title,
    .fixed-price-content .title,
    .legal-aid-check-content .title {
        font-size: 24px !important;
    }

    /* Swiper navigation */
    .swiper-button-next,
    .swiper-button-prev {
        width: 40px !important;
        height: 40px !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 16px !important;
    }
}

/* ============================================
   FINAL OVERRIDE - Force Features to Right
   ============================================ */
@media (max-width: 480px) {
    /* Small mobile optimizations - Remove all spacing */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home,
    .hero-section,
    .quick-points-section,
    .about-us-section,
    .why-aman-law-section,
    .book-consultation-section,
    .contact-us-section {
        padding: 0 !important;
        margin: 0 !important;
    }

    .main-headline .title {
        font-size: 22px !important;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 13px;
        text-align: center !important;
    }

    .service-item {
        padding: 18px 12px;
    }

    .service-item .title {
        font-size: 17px !important;
    }

    .service-item p {
        font-size: 13px;
    }

    .choose-item {
        padding: 18px 12px;
    }

    .blog-content,
    .lawyer-content {
        padding: 12px;
    }

    .blog-title,
    .lawyer-name {
        font-size: 17px !important;
    }

    .testimonial-card-modern {
        padding: 20px 15px;
    }

    .testimonial-text {
        font-size: 14px;
    }

    .how-it-works-item {
        padding: 20px 12px;
    }

    .step-title {
        font-size: 16px !important;
    }

    .step-description {
        font-size: 13px;
    }

    .mobile-app-content .title,
    .fixed-price-content .title,
    .legal-aid-check-content .title {
        font-size: 22px !important;
    }

    /* Swiper navigation */
    .swiper-button-next,
    .swiper-button-prev {
        width: 36px !important;
        height: 36px !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 14px !important;
    }
}

/* ============================================
   FINAL OVERRIDE - Force Buttons to Right
   ============================================ */
/* RTL Mobile Support */
@media (max-width: 991px) {
    [dir="rtl"] .main-headline {
        text-align: center !important;
    }
    
    [dir="rtl"] .main-headline .title {
        text-align: center !important;
    }
    
    [dir="rtl"] .main-headline p {
        text-align: center !important;
    }

    [dir="rtl"] .service-item,
    [dir="rtl"] .choose-item,
    [dir="rtl"] .blog-card-modern,
    [dir="rtl"] .lawyer-card-modern {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .lawyer-content {
        text-align: right;
        direction: rtl;
        align-items: flex-end;
    }

    [dir="rtl"] .lawyer-name {
        text-align: right;
    }

    [dir="rtl"] .lawyer-name a {
        text-align: right;
    }

    [dir="rtl"] .mobile-app-content,
    [dir="rtl"] .fixed-price-content,
    [dir="rtl"] .legal-aid-check-content {
        text-align: center;
    }
}

/* ============================================
   Add spacing between sections
   إضافة مسافات بين الأقسام
   ============================================ */
section,
.hero-section,
.quick-points-section,
.service-area,
.how-it-works-area,
.about-us-section,
.why-aman-law-section,
.lawyer-area-modern,
.testimonial-area-modern,
.book-consultation-section,
.contact-us-section,
.blog-area-modern,
.mobile-app-area,
.fixed-price-area,
.legal-aid-check-home,
.case-study-area,
.case-study-home-page,
.about-area,
.why-us-area {
    padding-top: 50px !important;
    padding-bottom: 50px !important;
}

/* Add spacing between adjacent sections */
section + section {
    margin-top: 0 !important;
    padding-top: 50px !important;
}

/* Hero section should not have top padding */
.hero-section {
    padding-top: 0 !important;
}

/* Override all padding and margin classes */
.pt_100, .pb_100, .pt_80, .pb_80, .pt_70, .pb_70, 
.pt_50, .pb_50, .pt_40, .pb_40, .pt_30, .pb_30,
.pt_25, .pb_25, .pt_20, .pb_20, .pt_15, .pb_15 {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

.mt_200, .mt_100, .mt_80, .mt_70, .mt_65, .mt_50, 
.mt_40, .mt_30, .mt_25, .mt_20, .mt_15 {
    margin-top: 0 !important;
}

.mb_60, .mb_40, .mb_30, .mb_25, .mb_20, .mb_15 {
    margin-bottom: 0 !important;
}

/* Mobile and tablet - add smaller spacing */
@media (max-width: 991px) {
    section,
    .hero-section,
    .quick-points-section,
    .service-area,
    .how-it-works-area,
    .about-us-section,
    .why-aman-law-section,
    .lawyer-area-modern,
    .testimonial-area-modern,
    .book-consultation-section,
    .contact-us-section,
    .blog-area-modern,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }
    
    .hero-section {
        padding-top: 0 !important;
    }
    
    section + section {
        padding-top: 40px !important;
    }
}

@media (max-width: 768px) {
    section,
    .hero-section,
    .quick-points-section,
    .service-area,
    .how-it-works-area,
    .about-us-section,
    .why-aman-law-section,
    .lawyer-area-modern,
    .testimonial-area-modern,
    .book-consultation-section,
    .contact-us-section,
    .blog-area-modern,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding-top: 30px !important;
        padding-bottom: 30px !important;
    }
    
    .hero-section {
        padding-top: 0 !important;
    }
    
    section + section {
        padding-top: 30px !important;
    }
}

@media (max-width: 480px) {
    section,
    .hero-section,
    .quick-points-section,
    .service-area,
    .how-it-works-area,
    .about-us-section,
    .why-aman-law-section,
    .lawyer-area-modern,
    .testimonial-area-modern,
    .book-consultation-section,
    .contact-us-section,
    .blog-area-modern,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding-top: 25px !important;
        padding-bottom: 25px !important;
    }
    
    .hero-section {
        padding-top: 0 !important;
    }
    
    section + section {
        padding-top: 25px !important;
    }

    /* ============================================
       HERO CTA BUTTON ANIMATIONS
       أنيميشن زر الحجز في قسم الهيرو
       ============================================ */
    /* تجاوز جميع القواعد العامة - يجب أن يكون في البداية */
    .hero-cta-btn,
    a.hero-cta-btn,
    .hero-cta-btn.animated-cta-btn,
    a.hero-cta-btn.animated-cta-btn {
        position: relative !important;
        overflow: hidden !important;
        cursor: pointer !important;
        transform: translateY(0);
        animation: pulse-glow 2s ease-in-out infinite;
        background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important; /* الخلفية الأساسية */
    }
    
    /* منع تغيير الخلفية من أي CSS عام */
    .hero-cta-btn:hover,
    a.hero-cta-btn:hover,
    .hero-cta-btn.animated-cta-btn:hover,
    a.hero-cta-btn.animated-cta-btn:hover,
    .animated-cta-btn.hero-cta-btn:hover,
    a.animated-cta-btn.hero-cta-btn:hover {
        background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important;
        background-color: transparent !important;
        background-image: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important;
    }

    /* Pulse and Glow Animation */
    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 4px 15px rgba(212, 165, 116, 0.4),
                        0 0 0 0 rgba(220, 38, 38, 0.7);
        }
        50% {
            box-shadow: 0 6px 25px rgba(212, 165, 116, 0.6),
                        0 0 0 10px rgba(220, 38, 38, 0);
        }
    }

    /* Shimmer Effect - يظهر عند hover */
    .hero-cta-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: calc(100% - 4px); /* ترك مساحة للشريط السفلي */
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.3),
            transparent
        );
        transition: left 0.5s ease;
        z-index: 1;
        border-radius: 50px 50px 0 0;
    }

    .hero-cta-btn:hover::before {
        left: 100%;
    }
    
    /* Hover Effects - تصميم حسب الصورة */
    /* تجاوز جميع القواعد العامة من unified-colors.css */
    .hero-cta-btn:hover,
    a.hero-cta-btn:hover,
    .animated-cta-btn:hover,
    a.animated-cta-btn:hover,
    .hero-cta-btn.animated-cta-btn:hover,
    a.hero-cta-btn.animated-cta-btn:hover {
        transform: translateY(-3px) scale(1.05) !important;
        background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important; /* الخلفية تبقى كما هي */
        background-color: transparent !important;
        background-image: linear-gradient(135deg, #D4A574 0%, #DC2626 100%) !important;
        color: #ffffff !important; /* نص أبيض */
        box-shadow: 0 8px 30px rgba(255, 105, 135, 0.4),
                    0 0 0 3px rgba(255, 105, 135, 0.3),
                    0 0 20px rgba(255, 105, 135, 0.2) !important; /* glow أحمر وردي */
    }
    
    /* أيقونة ذهبية عند hover */
    .hero-cta-btn:hover i {
        color: #D4A574 !important; /* لون ذهبي للأيقونة */
        transform: translateX(-5px) scale(1.2);
    }
    
    /* النص يبقى أبيض عند hover */
    .hero-cta-btn:hover span {
        color: #ffffff !important;
    }

    /* Active/Press Effect */
    .hero-cta-btn:active {
        transform: translateY(-1px) scale(1.02) !important;
        box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4) !important;
    }

    /* Icon Animation */
    .hero-cta-btn i {
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .hero-cta-btn:hover i {
        transform: translateX(-5px) scale(1.2);
    }

    /* Bounce Animation on Load */
    @keyframes bounce-in {
        0% {
            opacity: 0;
            transform: translateY(20px) scale(0.9);
        }
        60% {
            transform: translateY(-5px) scale(1.05);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .hero-cta-btn {
        animation: bounce-in 0.8s ease-out, pulse-glow 2s ease-in-out 0.8s infinite;
    }

    /* Ripple Effect on Click */
    .hero-cta-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        z-index: 0;
    }

    .hero-cta-btn:active::after {
        width: 300px;
        height: 300px;
        transition: width 0.3s, height 0.3s;
    }

    /* Ensure text stays on top */
    .hero-cta-btn span {
        position: relative;
        z-index: 2;
        color: #2c3e50 !important; /* لون نص داكن */
    }
    
    /* لون النص في الحالة العادية */
    .hero-cta-btn,
    a.hero-cta-btn {
        color: #2c3e50 !important; /* لون نص داكن */
    }
    
    /* لون النص عند hover */
    .hero-cta-btn:hover,
    a.hero-cta-btn:hover {
        color: #2c3e50 !important; /* لون نص داكن */
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .hero-cta-btn {
            padding: 14px 32px !important;
            font-size: 16px !important;
        }

        .hero-cta-btn:hover {
            transform: translateY(-2px) scale(1.03) !important;
        }
    }
}
</style>
@endpush

@endsection
