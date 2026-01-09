@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'About')->first()->seo_title ?? 'About | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'About')->first()->seo_description ?? 'About | LawMent' }}">
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

    <!--Company Information Start-->
    <div class="company-info-area pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-headline text-center mb_50">
                        <h2 class="title">{{ __('Company Information') }}</h2>
                        <p>{{ __('Get to know more about our law firm') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="company-info-card">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4>{{ __('Company Name') }}</h4>
                        <p>{{ $setting?->app_name ?? __('Law Firm') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="company-info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>{{ __('Email') }}</h4>
                        <p>
                            @if($contactInfo?->email)
                                <a href="mailto:{{ $contactInfo->email }}">{{ $contactInfo->email }}</a>
                            @elseif($contactInfo?->top_bar_email)
                                <a href="mailto:{{ $contactInfo->top_bar_email }}">{{ $contactInfo->top_bar_email }}</a>
                            @else
                                {{ __('Not available') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="company-info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h4>{{ __('Phone') }}</h4>
                        <p>
                            @if($contactInfo?->phone)
                                <a href="tel:{{ $contactInfo->phone }}">{{ $contactInfo->phone }}</a>
                            @elseif($contactInfo?->top_bar_phone)
                                <a href="tel:{{ $contactInfo->top_bar_phone }}">{{ $contactInfo->top_bar_phone }}</a>
                            @else
                                {{ __('Not available') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="company-info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4>{{ __('Address') }}</h4>
                        <p>{{ $contactInfo?->address ?? __('Not available') }}</p>
                    </div>
                </div>
            </div>

            <!--Statistics Section-->
            <div class="row mt_50">
                <div class="col-lg-12">
                    <div class="main-headline text-center mb_50">
                        <h2 class="title">{{ __('Our Statistics') }}</h2>
                        <p>{{ __('Numbers that reflect our success') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="stat-number">{{ $totalLawyers ?? 0 }}</h3>
                        <p class="stat-label">{{ __('Expert Lawyers') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <h3 class="stat-number">{{ $totalDepartments ?? 0 }}</h3>
                        <p class="stat-label">{{ __('Departments') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="stat-number">{{ $totalServices ?? 0 }}</h3>
                        <p class="stat-label">{{ __('Services') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="stat-number">{{ $totalTestimonials ?? 0 }}</h3>
                        <p class="stat-label">{{ __('Testimonials') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Company Information End-->

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
