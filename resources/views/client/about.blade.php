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
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('About Us') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('About Us') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->


    <!--About Us Start-->
    <div class="about-style1 pt_50 pb_110">
        <div class="container">
            @if ($about && $about?->status)
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about1-text sm_pr_0 pr_150 mt_30">
                            {!! $about?->about_description !!}
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="about1-bgimg mt_30"
                            style="background-image:url({{ $about?->background_image ? url($about?->background_image) : '' }});">
                            <div class="about1-inner">
                                <img src="{{ url($about?->about_image) }}" alt="{{ __('About Us') }}" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--About Us End-->


    @if ($about)
        <!--Mission Start-->
        <div class="mission-area bg-area pt_40 pb_90">
            <div class="container">
                @if ($about?->mission_status)
                    <div class="row align-items-center">
                        <div class="col-md-6 pt_30">
                            <div class="mission-img">
                                <img src="{{ url($about?->mission_image) }}" alt="{{ __('About Us') }}" loading="lazy">
                            </div>
                        </div>
                        <div class="col-md-6 pt_30">
                            <div class="mission-text">
                                {!! $about?->mission_description !!}



                            </div>
                        </div>
                    </div>
                @endif

                @if ($about?->vision_status)
                    <div class="row align-items-center mt_40">
                        <div class="col-md-6 pt_30">
                            <div class="mission-text">
                                {!! $about?->vision_description !!}
                            </div>
                        </div>
                        <div class="col-md-6 pt_30">
                            <div class="mission-img vision-img">
                                <img src="{{ url($about?->vision_image) }}" alt="{{ __('About Us') }}" loading="lazy">
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <!--Mission End-->
    @endif
    <!--Counter Start-->
    <div class="counter-page pt_40 pb_70"
        style="background-image: url({{ asset('uploads/website-images/overview-banner.webp') }})">
        <div class="container">
            <div class="row">
                @foreach ($overviews as $overview)
                    <div class="col-lg-3 col-6 mt_30 wow fadeInDown" data-wow-delay="0.2s">
                        <div class="counter-item">
                            <div class="counter-icon">
                                <i class="{{$overview?->icon}}"></i>
                            </div>
                            <span class="counter counter_up">{{ $overview?->qty }}</span>
                            <p class="title">{{ $overview?->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--Counter End-->


    @if (1 == $home_sections?->work_status)
        <!--Feature Start-->
        <div class="about-area">
            <div class="container">
                <div class="row ov_hd">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->work_first_heading) }}</span>
                                {{ ucfirst($home_sections?->work_second_heading) }}</h2>
                            <p>{{ $home_sections?->work_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row ov_hd">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-skey mt_50">
                            <div class="about-img">
                                <img src="{{ $work?->image ? url($work?->image) : '' }}" alt="{{$home_sections?->work_first_heading.' '.$home_sections?->work_second_heading}}" loading="lazy">
                                <div class="video-section video-section-home">
                                    <a aria-label="{{$home_sections?->work_first_heading.' '.$home_sections?->work_second_heading}}" class="video-button mgVideo" href="{{ $work?->video }}"><span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="feature-section-text mt_50">
                            <h2>{{ $work?->title }}</h2>
                            <div class="feature-accordion" id="accordion">
                                @foreach ($workFaqs?->take($home_sections?->work_how_many) as $faqIndex => $faq)
                                    <div class="faq-item card">
                                        <div class="faq-header" id="heading1-{{ $faq->id }}">
                                            <button class="faq-button {{ $faqIndex != 0 ? 'collapsed' : '' }}"
                                                data-bs-toggle="collapse" data-bs-target="#collapse1-{{ $faq->id }}"
                                                aria-expanded="true"
                                                aria-controls="collapse1-{{ $faq->id }}">{{ $faq->question }}</button>
                                        </div>

                                        <div id="collapse1-{{ $faq->id }}"
                                            class="collapse {{ $faqIndex == 0 ? 'show' : '' }}"
                                            aria-labelledby="heading1-{{ $faq->id }}" data-bs-parent="#accordion">
                                            <div class="faq-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Feature End-->
    @endif
@endsection
