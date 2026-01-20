@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'Lawyers')->first();
    $seoTitle = $seoData?->seo_title ?? __('Lawyers') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Browse our team of experienced lawyers and legal professionals');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('lawyers, attorneys, legal professionals, محامون, محامين, محامي') }}">
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
        "@type": "CollectionPage",
        "name": "{{ __('Lawyers') }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ $currentUrl }}"
    }
    </script>
    
    @if($lawyers && $lawyers->count() > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($lawyers->take(20) as $index => $lawyer)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Person",
                    "name": "{{ $lawyer->name }}",
                    "jobTitle": "{{ $lawyer->designations ?? 'Lawyer' }}",
                    "url": "{{ route('website.lawyer.details', $lawyer->slug) }}",
                    @if($lawyer->image)
                    "image": "{{ image_url($lawyer->image) }}",
                    @endif
                    "worksFor": {
                        "@type": "LegalService",
                        "name": "{{ $setting->app_name ?? 'LawMent' }}"
                    }
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
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
                                <i class="fas fa-gavel"></i>
                            </span>
                            <h1 class="title">{{ __('Lawyers ') }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ __('Lawyers ') }}</span></li>
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

    <!--Lawyers Page Description Start-->
    <div class="lawyers-page-description pt_50 pb_30" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="description-content text-center" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                        <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 20px;">
                            {{ __('منصّة قانونية مُدارة من سويسرا، تضم محامين مختصين داخل سوريا، لتقديم استشارات قانونية وتمثيل قضائي في القضايا المتعلقة بسوريا للعملاء في جميع أنحاء العالم.') }}
                        </p>
                        <p style="font-size: 16px; color: #666; line-height: 1.8; margin-bottom: 0;">
                            {{ __('تتم الاستشارات عبر واتساب أو نموذج الطلب، مع إمكانية حجز مكالمة صوتية أو فيديو.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Lawyers Page Description End-->

    <div class="lawyer-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="s-container">
                        <form action="{{ route('website.search.lawyer') }}">
                            <div class="s-box">
                                <select name="location" class="form-control select2">
                                    <option value="">{{ __('Select Location') }}</option>
                                    @foreach ($locations as $location)
                                        <option {{ @$location_id == $location?->id ? 'selected' : '' }}
                                            value="{{ $location?->id }}">{{ ucwords($location?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-box">
                                <select name="department" class="form-control select2">
                                    <option value="">{{ __('Select Department') }}</option>
                                    @foreach ($departments as $department)
                                        <option {{ @$department_id == $department?->id ? 'selected' : '' }}
                                            value="{{ $department?->id }}">{{ ucwords($department?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-box">
                                <select name="lawyer" class="form-control select2">
                                    <option value="">{{ __('Select Lawyer') }}</option>
                                    @foreach ($lawyersForSearch as $lawyer)
                                        <option {{ @$lawyer_id == $lawyer->id ? 'selected' : '' }}
                                            value="{{ $lawyer?->id }}">
                                            {{ ucwords($lawyer?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-button">
                                <button type="submit">{{ __('Search') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Lawyers List Start-->
    <div class="team-page pb_70">
        <div class="container">
            <div class="row">
                @if ($lawyers->count() != 0)
                    @foreach ($lawyers as $lawyer)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt_30">
                            <div class="lawyer-card-mobile aman-lawyer-card-mobile-rtl lawyer-card-animated">
                                <div class="lawyer-card-image-mobile lawyer-card-border-animated">
                                    <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                        <img src="{{ image_url($lawyer?->image ? $lawyer?->image : $setting?->default_avatar) }}"
                                            alt="{{ $lawyer?->name }}" loading="lazy">
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
                        <style>
                            /* Animation for card appear/fade in with up motion */
                            .lawyer-card-animated {
                                animation: fadeUpLawyerCard 0.7s cubic-bezier(.24,.93,.47,.99);
                                box-shadow: 0 8px 32px 0 rgba(212,165,116,0.07), 0 2px 8px rgba(220,38,38,0.07);
                                transition: box-shadow 0.3s, transform 0.25s;
                                border-radius: 18px;
                            }
                            .lawyer-card-animated:hover, .lawyer-card-animated:focus-within {
                                box-shadow: 0 12px 38px 0 rgba(212,165,116,0.13), 0 4px 16px rgba(220,38,38,0.14);
                                transform: translateY(-5px) scale(1.02);
                            }
                            @keyframes fadeUpLawyerCard {
                                0% {
                                    opacity: 0;
                                    transform: translateY(40px) scale(0.97);
                                }
                                100% {
                                    opacity: 1;
                                    transform: translateY(0) scale(1);
                                }
                            }

                            /* Border/outlines effect on card image wrapper */
                            .lawyer-card-border-animated {
                                position: relative;
                                border-radius: 16px;
                                overflow: hidden;
                            }
                            .lawyer-card-border-animated::after {
                                /* Animated border using gradient and movement */
                                content: "";
                                position: absolute;
                                inset: 0;
                                border-radius: 16px;
                                z-index: 1;
                                pointer-events: none;
                                border: 2px solid transparent;
                                background: linear-gradient(115deg, #D4A574 10%, #38B2AC 60%, #DC2626 100%) border-box;
                                mask:
                                    linear-gradient(#fff 0 0) padding-box, 
                                    linear-gradient(#fff 0 0);
                                -webkit-mask:
                                    linear-gradient(#fff 0 0) padding-box, 
                                    linear-gradient(#fff 0 0);
                                mask-composite: exclude;
                                -webkit-mask-composite: xor;
                                opacity: 0.5;
                                animation: borderGlowLawyerCard 2.5s linear infinite;
                                transition: opacity 0.23s;
                            }
                            .lawyer-card-animated:hover .lawyer-card-border-animated::after {
                                opacity: 1;
                                animation-duration: 1.2s;
                            }
                            @keyframes borderGlowLawyerCard {
                                0% {
                                    box-shadow: 0 0 0 0 #D4A57466;
                                    border-color: #D4A574;
                                }
                                50% {
                                    box-shadow: 0 0 16px 5px #38B2AC3A;
                                    border-color: #38B2AC;
                                }
                                100% {
                                    box-shadow: 0 0 0 0 #DC262673;
                                    border-color: #DC2626;
                                }
                            }

                            /* Pop-in effect for meta items */
                            .lawyer-meta-animate {
                                opacity: 0;
                                transform: translateY(12px) scale(0.98);
                                animation: metaCardIn 0.55s cubic-bezier(.23,1.05,.42,0.97) forwards;
                            }
                            .lawyer-meta-animate:nth-child(1) { animation-delay: .13s; }
                            .lawyer-meta-animate:nth-child(2) { animation-delay: .24s; }
                            .lawyer-meta-animate:nth-child(3) { animation-delay: .34s; }
                            @keyframes metaCardIn {
                                100% {
                                    opacity: 1;
                                    transform: translateY(0) scale(1);
                                }
                            }

                            /* Animated button effect */
                            .lawyer-btn-animated {
                                position: relative;
                                display: inline-flex;
                                align-items: center;
                                gap: 6px;
                                font-weight: 700;
                                border-radius: 30px;
                                background: linear-gradient(135deg, #2D3748 0%, #38B2AC 100%);
                                color: #fff !important;
                                text-decoration: none;
                                padding: 10px 24px;
                                box-shadow: 0 2px 8px rgba(45,55,72,0.08);
                                transition: background 0.24s, color 0.2s, box-shadow 0.18s, transform 0.2s;
                                overflow: hidden;
                                z-index: 1;
                            }
                            .lawyer-btn-animated:hover, .lawyer-btn-animated:focus {
                                background: linear-gradient(135deg, #fff 0%, #E6FFFA 100%);
                                color: #38B2AC !important;
                                box-shadow: 0 6px 22px rgba(45, 55, 72, 0.15);
                                transform: scale(1.06) translateY(-2px);
                                text-decoration: none;
                            }
                            .lawyer-btn-animated .lawyer-button-icon-mobile {
                                transition: transform 0.25s cubic-bezier(.58,.36,.46,1.22);
                            }
                            .lawyer-btn-animated:hover .lawyer-button-icon-mobile, 
                            .lawyer-btn-animated:focus .lawyer-button-icon-mobile {
                                transform: translateX(-5px) scale(1.10) rotate(-7deg);
                            }
                        </style>
                    @endforeach
                @else
                    <h3 class="text-danger text-center mt-5">{{ __('Lawyer Not Found') }}</h3>
                @endif
            </div>
            @if ($lawyers->hasPages())
                {{ $lawyers->links('client.paginator') }}
            @endif
        </div>
    </div>
    <!--Lawyers List End-->

<style>
    /* ============================================
       ENHANCED LAWYER SEARCH SECTION
       ============================================ */
    
    .lawyer-search {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 40px 0;
        margin-bottom: 50px;
        border-bottom: 3px solid var(--colorPrimary);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .s-container {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 2px solid rgba(200, 180, 126, 0.1);
        transition: all 0.3s ease;
    }
    
    .s-container:hover {
        box-shadow: 0 12px 40px rgba(107, 93, 71, 0.15);
        border-color: var(--colorPrimary);
    }
    
    .s-container form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-end;
    }
    
    .s-box {
        flex: 1;
        min-width: 200px;
    }
    
    .s-box .form-control.select2 {
        width: 100% !important;
        padding: 14px 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 500;
        color: #333;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        transition: all 0.3s ease;
        direction: rtl;
        text-align: right;
    }
    
    .s-box .form-control.select2:focus {
        border-color: var(--colorPrimary);
        box-shadow: 0 0 0 4px rgba(200, 180, 126, 0.15);
        outline: none;
        background: #ffffff;
    }
    
    .s-box .form-control.select2:hover {
        border-color: var(--colorPrimary);
        background: #ffffff;
    }
    
    .s-button {
        flex-shrink: 0;
    }
    
    .s-button button {
        padding: 14px 35px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(107, 93, 71, 0.25);
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .s-button button::before {
        content: '\f002';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        font-size: 16px;
    }
    
    .s-button button:hover {
        background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 93, 71, 0.35);
    }
    
    .s-button button:active {
        transform: translateY(0);
    }
    
    /* ============================================
       ENHANCED TEAM PAGE SECTION
       ============================================ */
    
    .team-page {
        padding: 30px 0 70px;
    }
    
    .team-page .row {
        margin: 0 -15px;
    }
    
    .team-page .col-lg-3,
    .team-page .col-md-4,
    .team-page .col-sm-6 {
        padding: 0 15px;
    }
    
    /* Empty State */
    .team-page .text-danger {
        font-size: 24px;
        font-weight: 600;
        color: #dc3545 !important;
        padding: 60px 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        border: 2px dashed #e9ecef;
    }
    
    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */
    
    @media (max-width: 991px) {
        .lawyer-search {
            padding: 30px 0;
            margin-bottom: 40px;
        }
        
        .s-container {
            padding: 25px;
            border-radius: 16px;
        }
        
        .s-container form {
            gap: 15px;
        }
        
        .s-box {
            min-width: 100%;
        }
        
        .s-button {
            width: 100%;
        }
        
        .s-button button {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 768px) {
        .lawyer-search {
            padding: 25px 0;
            margin-bottom: 30px;
        }
        
        .s-container {
            padding: 20px;
            border-radius: 12px;
        }
        
        .s-box .form-control.select2 {
            padding: 12px 16px;
            font-size: 15px;
        }
        
        .s-button button {
            padding: 12px 25px;
            font-size: 15px;
        }
    }
    
    /* ============================================
       RTL SUPPORT
       ============================================ */
    
    [dir="rtl"] .s-container form {
        direction: rtl;
    }
    
    [dir="rtl"] .s-button button::before {
        margin-left: 10px;
        margin-right: 0;
    }
    
    [dir="ltr"] .s-button button::before {
        margin-right: 10px;
        margin-left: 0;
    }
    
    /* ============================================
       SELECT2 CUSTOMIZATION
       ============================================ */
    
    .select2-container--default .select2-selection--single {
        border: 2px solid #e9ecef !important;
        border-radius: 12px !important;
        height: auto !important;
        padding: 12px 20px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    }
    
    .select2-container--default .select2-selection--single:focus,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: var(--colorPrimary) !important;
        box-shadow: 0 0 0 4px rgba(200, 180, 126, 0.15) !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding: 0 !important;
        color: #333 !important;
        font-weight: 500 !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: auto !important;
        left: 15px !important;
    }
    
    [dir="rtl"] .select2-container--default .select2-selection--single .select2-selection__arrow {
        left: auto !important;
        right: 15px !important;
    }
    
    .select2-dropdown {
        border: 2px solid var(--colorPrimary) !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1) !important;
        margin-top: 5px !important;
    }
    
    .select2-results__option {
        padding: 12px 20px !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    .select2-results__option--highlighted {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
        color: #ffffff !important;
    }
    
    /* ============================================
       ENHANCED BANNER SECTION
       ============================================ */
    
    .banner-area {
        position: relative;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        padding: 80px 0;
        margin-bottom: 0;
    }
    
    .banner-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(107, 93, 71, 0.75) 100%);
        z-index: 1;
    }
    
    .banner-area .container {
        position: relative;
        z-index: 2;
    }
    
    .banner-text h1 {
        font-size: 42px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        text-align: center;
    }
    
    .banner-text ul {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .banner-text ul li {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
    }
    
    .banner-text ul li a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .banner-text ul li a:hover {
        color: var(--colorPrimary);
    }
    
    .banner-text ul li span {
        color: var(--colorPrimary);
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .banner-area {
            padding: 60px 0;
        }
        
        .banner-text h1 {
            font-size: 32px;
        }
        
        .banner-text ul li {
            font-size: 14px;
        }
    }
</style>

@endsection
