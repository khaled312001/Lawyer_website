@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'About')->first();
    $seoTitle = $seoData?->seo_title ?? __('About Us') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Learn more about our law firm and legal services');
    $seoImage = $about?->about_image ? asset($about->about_image) : ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png'));
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('about us, law firm, legal services, our story, من نحن, مكتب محاماة, خدمات قانونية') }}">
    <meta name="robots" content="index, follow">
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
@endsection

@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AboutPage",
        "name": "{{ __('About Us') }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ $currentUrl }}",
        "mainEntity": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            "description": "{{ $seoDescription }}",
            @if($totalLawyers)
            "numberOfEmployees": {
                "@type": "QuantitativeValue",
                "value": {{ $totalLawyers }},
                "unitText": "Lawyers"
            },
            @endif
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
            }
            @endif
        }
    }
    </script>
    
    @if($about && $about->about_description)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $setting->app_name ?? 'LawMent' }}",
        "description": "{{ Str::limit(strip_tags($about->about_description), 200) }}",
        "url": "{{ url('/') }}",
        "logo": "{{ $setting->logo ? asset($setting->logo) : asset('client/img/logo.png') }}",
        @if($totalLawyers)
        "numberOfEmployees": {{ $totalLawyers }},
        @endif
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
        }
        @endif
    }
    </script>
    @endif
@endsection

@section('client-content')
    <!--Banner Start-->
    <section class="banner-area enhanced-breadcrumb flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : asset('client/img/shape-2.webp') }});">
        <div class="breadcrumb-overlay"></div>
        <div class="breadcrumb-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-text enhanced-title-content">
                        <div class="title-wrapper">
                            <span class="title-icon">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <h1 class="title">{{ __('معلومات عنا') }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('الرئيسية') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ __('معلومات عنا') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>
    <!--Banner End-->


    <!--About Us Start-->
    <div class="about-style1 pt_50 pb_110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-main-content mt_30" style="background: #ffffff; padding: 50px 40px; border-radius: 20px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);">
                        <h2 class="mb_30" style="font-size: 32px; font-weight: 700; color: #0b2c64; text-align: center; margin-bottom: 30px;">{{ __('معلومات عنا') }}</h2>
                        
                        <div class="about-text-section mb_40">
                            <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 20px;">
                                {{ __('أمان لو – Aman Law هي منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تقديم استشارات قانونية وتمثيل قضائي في القضايا المتعلّقة بسوريا للعملاء في جميع أنحاء العالم.') }}
                            </p>
                            <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 0;">
                                {{ __('تقوم المنصّة بربط الأفراد والشركات المقيمين خارج سوريا بمحامين مختصين داخل سوريا، لمتابعة قضاياهم القانونية بطريقة منظّمة، مهنية، وموثوقة.') }}
                            </p>
                        </div>

                        <div class="vision-mission-section">
                            <div class="row">
                                <div class="col-lg-6 mb_30">
                                    <div class="vision-card" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 35px 30px; border-radius: 15px; border-right: 4px solid #D4A574; height: 100%;">
                                        <h3 style="font-size: 24px; font-weight: 700; color: #0b2c64; margin-bottom: 20px;">
                                            <i class="fas fa-eye" style="color: #D4A574; margin-left: 10px;"></i>
                                            {{ __('رؤيتنا') }}
                                        </h3>
                                        <p style="font-size: 16px; color: #666; line-height: 1.8;">
                                            {{ __('تسهيل وصول العملاء في الخارج إلى خدمات قانونية موثوقة داخل سوريا، عبر منصّة قانونية واضحة وآمنة، تعتمد على الخبرة، الشفافية، وحسن المتابعة.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb_30">
                                    <div class="mission-card" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 35px 30px; border-radius: 15px; border-right: 4px solid #D4A574; height: 100%;">
                                        <h3 style="font-size: 24px; font-weight: 700; color: #0b2c64; margin-bottom: 20px;">
                                            <i class="fas fa-bullseye" style="color: #D4A574; margin-left: 10px;"></i>
                                            {{ __('رسالتنا') }}
                                        </h3>
                                        <p style="font-size: 16px; color: #666; line-height: 1.8;">
                                            {{ __('تقديم استشارات قانونية دقيقة وخدمات تمثيل قضائي احترافية، من خلال شبكة محامين مختصين، وبآلية عمل تضمن وضوح الإجراءات وحماية حقوق العملاء.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="work-mechanism-section mt_40">
                            <div class="work-mechanism-card" style="background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%); padding: 40px 35px; border-radius: 15px; color: #ffffff;">
                                <h3 style="font-size: 24px; font-weight: 700; color: #ffffff; margin-bottom: 20px; text-align: center;">
                                    <i class="fas fa-cogs" style="color: #D4A574; margin-left: 10px;"></i>
                                    {{ __('آلية العمل') }}
                                </h3>
                                <p style="font-size: 17px; color: rgba(255, 255, 255, 0.9); line-height: 1.9; text-align: center;">
                                    {{ __('تعتمد أمان لو آلية عمل بسيطة وواضحة تبدأ بدراسة طلب العميل وتحديد المحامي المختص، يليها تقديم الاستشارة القانونية، مع إمكانية المتابعة أو التمثيل القانوني أمام المحاكم السورية عند الطلب.') }}
                                </p>
                            </div>
                        </div>

                        <div class="services-scope-section mt_40">
                            <div class="services-scope-card" style="background: #f8f9fa; padding: 35px 30px; border-radius: 15px;">
                                <h3 style="font-size: 24px; font-weight: 700; color: #0b2c64; margin-bottom: 20px;">
                                    <i class="fas fa-briefcase" style="color: #D4A574; margin-left: 10px;"></i>
                                    {{ __('نطاق الخدمات') }}
                                </h3>
                                <p style="font-size: 17px; color: #333; line-height: 1.9;">
                                    {{ __('تشمل خدماتنا القضايا المدنية، العقارية، التجارية، قضايا الأحوال الشخصية، القضايا الجزائية، وصياغة العقود والاستشارات القانونية، وذلك وفق القوانين السورية المعمول بها.') }}
                                </p>
                            </div>
                        </div>

                        <div class="consultation-section mt_40">
                            <div class="consultation-card" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 35px 30px; border-radius: 15px; border-top: 4px solid #D4A574;">
                                <h3 style="font-size: 24px; font-weight: 700; color: #0b2c64; margin-bottom: 20px;">
                                    <i class="fas fa-comments" style="color: #D4A574; margin-left: 10px;"></i>
                                    {{ __('التواصل والاستشارات') }}
                                </h3>
                                <p style="font-size: 17px; color: #333; line-height: 1.9;">
                                    {{ __('تُقدَّم الاستشارات القانونية عبر التواصل على واتساب أو من خلال تعبئة نموذج طلب الاستشارة، مع إمكانية حجز موعد مكالمة صوتية أو مكالمة فيديو حسب رغبة العميل.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--About Us End-->
@endsection
