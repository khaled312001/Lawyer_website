@extends('layouts.client.layout')
@php
    $seoTitle = $service?->seo_title ?? $service?->title . ' - ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $service?->seo_description ?? Str::limit(strip_tags($service?->description ?? $service?->sort_description ?? ''), 155) ?: $service?->title;
    $seoImage = $service?->icon ? asset($service->icon) : ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png'));
    $currentUrl = url()->current();
    $serviceUrl = route('website.service.details', $service->slug);
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $service?->title }}, {{ __('legal service, consultation, خدمة قانونية, استشارة') }}">
    <meta name="robots" content="index, follow">
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="service">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
    <meta property="service:name" content="{{ $service->title }}">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
@endsection

@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "{{ $service->title }}",
        "description": "{{ Str::limit(strip_tags($service->description ?? $service->sort_description ?? ''), 200) }}",
        "url": "{{ $serviceUrl }}",
        @if($service->icon)
        "image": "{{ asset($service->icon) }}",
        @endif
        "provider": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            "url": "{{ url('/') }}"
        },
        "serviceType": "Legal Consultation",
        "areaServed": {
            "@type": "Country",
            "name": "Syria"
        }
    }
    </script>
    
    @if($service->service_faq && $service->service_faq->count() > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($service->service_faq as $faq)
            {
                "@type": "Question",
                "name": "{{ $faq->question }}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ strip_tags($faq->answer) }}"
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>
    @endif
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "{{ __('Home') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ url('/') }}",
                    "name": "{{ __('Home') }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ __('Services') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ route('website.services') }}",
                    "name": "{{ __('Services') }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $service->title }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}",
                    "name": "{{ $service->title }}"
                }
            }
        ]
    }
    </script>
@endsection

@section('client-content')

    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ $service?->title }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ $service?->title }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Service Detail Start-->
    <div class="service-detail-area pt_40">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="service-detail-text pt_30">

                        @if ($service?->images && $service->images->count() > 0)
                        <div class="row mb_30">
                            <div class="col-md-12">
                                <!-- Swiper -->
                                <div class="swiper-container pro-detail-top">
                                    <div class="swiper-wrapper">
                                        @foreach ($service->images as $item)
                                            @if ($item?->large_image && file_exists(public_path($item->large_image)))
                                            <div class="swiper-slide">
                                                <div class="catagory-item">
                                                    <div class="catagory-img-holder">
                                                        <img src="{{ asset($item->large_image) }}" 
                                                             alt="{{ $service?->title }}" 
                                                             loading="lazy"
                                                             onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;">
                                                        <div class="catagory-text">
                                                            <div class="catagory-text-table">
                                                                <div class="catagory-text-cell">
                                                                    <ul class="catagory-hover">
                                                                        <li><a aria-label="{{ __('Search') }}" href="{{ asset($item->large_image) }}"
                                                                                class="magnific"><i
                                                                                    class="fas fa-search"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach


                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next swiper-button-white"></div>
                                    <div class="swiper-button-prev swiper-button-white"></div>
                                </div>
                                @if ($service->images->where('small_image', '!=', null)->count() > 0)
                                <div class="swiper-container pro-detail-thumbs">
                                    <div class="swiper-wrapper">
                                        @foreach ($service->images as $item)
                                            @if ($item?->small_image && file_exists(public_path($item->small_image)))
                                            <div class="swiper-slide"><img src="{{ asset($item->small_image) }}" 
                                                                           alt="{{ $service?->title }}" 
                                                                           loading="lazy"
                                                                           onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;"></div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <!-- Service Description -->
                        <div class="service-description-content mb_40">
                            {!! $service?->description !!}
                        </div>

                        <!-- Service Features Section -->
                        <div class="service-features-section mb_50">
                            <h2 class="section-title mb_30">{{ __('Service Features') }}</h2>
                            <div class="row">
                                <div class="col-md-6 mb_20">
                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>{{ __('Professional Legal Consultation') }}</h4>
                                            <p>{{ __('Expert legal advice tailored to your specific needs and circumstances.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb_20">
                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>{{ __('Legal Protection') }}</h4>
                                            <p>{{ __('Comprehensive legal protection for all your transactions and agreements.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb_20">
                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-file-contract"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>{{ __('Document Preparation') }}</h4>
                                            <p>{{ __('Professional preparation and review of all legal documents and contracts.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb_20">
                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>{{ __('Expert Team') }}</h4>
                                            <p>{{ __('Experienced legal professionals dedicated to achieving the best results for you.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Benefits Section -->
                        <div class="service-benefits-section mb_50">
                            <h2 class="section-title mb_30">{{ __('Why Choose Our Service') }}</h2>
                            <div class="benefits-list">
                                <div class="benefit-item">
                                    <i class="fas fa-star"></i>
                                    <div class="benefit-text">
                                        <h5>{{ __('Experienced Professionals') }}</h5>
                                        <p>{{ __('Our team consists of highly qualified lawyers with extensive experience in their respective fields.') }}</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-clock"></i>
                                    <div class="benefit-text">
                                        <h5>{{ __('Timely Service') }}</h5>
                                        <p>{{ __('We understand the importance of time and ensure prompt and efficient handling of all legal matters.') }}</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-handshake"></i>
                                    <div class="benefit-text">
                                        <h5>{{ __('Personalized Approach') }}</h5>
                                        <p>{{ __('Each case is handled with individual attention and customized solutions to meet your specific requirements.') }}</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-lock"></i>
                                    <div class="benefit-text">
                                        <h5>{{ __('Confidentiality') }}</h5>
                                        <p>{{ __('Complete confidentiality and privacy protection for all your legal matters and information.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Process Section -->
                        <div class="service-process-section mb_50">
                            <h2 class="section-title mb_30">{{ __('How We Work') }}</h2>
                            <div class="process-steps">
                                <div class="process-step">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h4>{{ __('Initial Consultation') }}</h4>
                                        <p>{{ __('Schedule a consultation to discuss your legal needs and requirements.') }}</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h4>{{ __('Case Analysis') }}</h4>
                                        <p>{{ __('Our experts analyze your case and provide detailed recommendations.') }}</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h4>{{ __('Action Plan') }}</h4>
                                        <p>{{ __('We develop a comprehensive action plan tailored to your specific situation.') }}</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">4</div>
                                    <div class="step-content">
                                        <h4>{{ __('Execution & Support') }}</h4>
                                        <p>{{ __('We execute the plan and provide ongoing support throughout the process.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($service?->service_faq->count() != 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faq-service feature-section-text mt_50">
                                    <h2>{{ __('Frequently Asked Questions') }}</h2>
                                    <div class="feature-accordion" id="accordion">
                                        @foreach ($service?->service_faq as $faq)
                                            <div class="faq-item card">
                                                <div class="faq-header" id="heading-{{ $faq?->id }}">
                                                    <button class="faq-button collapsed" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $faq?->id }}" aria-expanded="true"
                                                        aria-controls="collapse-{{ $faq?->id }}">{{ $faq?->question }}</button>
                                                </div>

                                                <div id="collapse-{{ $faq?->id }}" class="collapse"
                                                    aria-labelledby="heading-{{ $faq?->id }}" data-parent="#accordion">
                                                    <div class="faq-body">
                                                        {!! $faq?->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-4">
                    <div class="service-sidebar pt_30">
                        <div class="service-widget">
                            <ul>
                                @foreach ($services as $item)
                                    <li class="{{ $item?->id == $service?->id ? 'active' : '' }}"><a
                                            href="{{ route('website.service.details', $item?->slug) }}"><i
                                                class="fas fa-chevron-right"></i> {{ $item?->title }}</a></li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="service-widget-contact mt_45">
                            <h2>{{ $contactInfo?->header }}</h2>
                            <p>{{ $contactInfo?->description }}</p>
                            <ul>
                                <li><i class="fas fa-phone"></i> 
                                    @php
                                        $phoneDisplay = $contactInfo?->phone ?? '';
                                        // Move + to end for Arabic language (RTL)
                                        if (getSessionLanguage() == 'ar' && $phoneDisplay) {
                                            // Handle multiple lines
                                            $phoneLines = explode("\n", $phoneDisplay);
                                            $formattedLines = [];
                                            foreach ($phoneLines as $line) {
                                                $line = trim($line);
                                                if ($line) {
                                                    // Remove + from start if exists
                                                    if (str_starts_with($line, '+')) {
                                                        $line = substr($line, 1);
                                                    }
                                                    // Add + at the end
                                                    $formattedLines[] = $line . '+';
                                                }
                                            }
                                            $phoneDisplay = implode("\n", $formattedLines);
                                        }
                                        $phoneLines = explode("\n", $phoneDisplay);
                                        foreach ($phoneLines as $line) {
                                            echo e($line) . '<br>';
                                        }
                                    @endphp
                                </li>
                                <li><i class="far fa-envelope"></i> {{ $contactInfo?->top_bar_email ?? $contactInfo?->email }}</li>
                                <li><i class="fas fa-map-marker-alt"></i>{!! nl2br(e($contactInfo?->address)) !!}</li>
                            </ul>
                        </div>
                        <div class="service-qucikcontact event-form mt_30">
                            <h3>{{ __('Quick Contact') }}</h3>
                            <div class="quick-contact-content">
                                <p>{{ __('Book a consultation with our expert lawyers for personalized legal advice.') }}</p>
                                <a href="{{ route('website.book.consultation.appointment') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-calendar-check"></i> {{ __('Book Consultation') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--Service Detail End-->
@endsection

@push('css')
<style>
/* Service Features Section */
.service-features-section {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin-top: 40px;
}

.service-features-section .section-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    text-align: center;
}

.feature-box {
    display: flex;
    align-items: flex-start;
    padding: 25px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
}

[dir="rtl"] .feature-icon {
    margin-right: 0;
    margin-left: 20px;
}

.feature-icon i {
    font-size: 24px;
    color: #fff;
}

.feature-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.feature-content p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Service Benefits Section */
.service-benefits-section {
    margin-top: 50px;
}

.service-benefits-section .section-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    text-align: center;
}

.benefits-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    padding: 25px;
    background: #fff;
    border-left: 4px solid var(--colorPrimary);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

[dir="rtl"] .benefit-item {
    border-left: none;
    border-right: 4px solid var(--colorPrimary);
}

.benefit-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

[dir="rtl"] .benefit-item:hover {
    transform: translateX(-5px);
}

.benefit-item i {
    font-size: 28px;
    color: var(--colorPrimary);
    margin-right: 20px;
    margin-top: 5px;
    flex-shrink: 0;
}

[dir="rtl"] .benefit-item i {
    margin-right: 0;
    margin-left: 20px;
}

.benefit-text h5 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.benefit-text p {
    color: #666;
    line-height: 1.7;
    margin: 0;
}

/* Service Process Section */
.service-process-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 40px;
    border-radius: 12px;
    margin-top: 50px;
}

.service-process-section .section-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 40px;
    text-align: center;
}

.process-steps {
    display: flex;
    flex-direction: column;
    gap: 30px;
    position: relative;
}

.process-steps::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--colorPrimary);
    opacity: 0.3;
}

[dir="rtl"] .process-steps::before {
    left: auto;
    right: 30px;
}

.process-step {
    display: flex;
    align-items: flex-start;
    position: relative;
    padding-left: 80px;
}

[dir="rtl"] .process-step {
    padding-left: 0;
    padding-right: 80px;
}

.step-number {
    position: absolute;
    left: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    flex-shrink: 0;
}

[dir="rtl"] .step-number {
    left: auto;
    right: 0;
}

.step-content {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    flex: 1;
}

.step-content h4 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.step-content p {
    color: #666;
    line-height: 1.7;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .service-features-section,
    .service-process-section {
        padding: 25px;
    }
    
    .feature-box {
        flex-direction: column;
        text-align: center;
    }
    
    .feature-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    [dir="rtl"] .feature-icon {
        margin-left: 0;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
    }
    
    .benefit-item i {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    [dir="rtl"] .benefit-item i {
        margin-left: 0;
    }
    
    .process-steps::before {
        display: none;
    }
    
    .process-step {
        padding-left: 0;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    [dir="rtl"] .process-step {
        padding-right: 0;
    }
    
    .step-number {
        position: relative;
        margin-bottom: 20px;
    }
    
    .step-content {
        width: 100%;
    }
}
</style>
@endpush

@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
