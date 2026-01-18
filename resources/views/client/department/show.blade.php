@extends('layouts.client.layout')
@php
    $seoTitle = $department?->seo_title ?? $department?->name . ' - ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $department?->seo_description ?? Str::limit(strip_tags($department?->description ?? ''), 155) ?: $department?->name;
    $seoImage = $department?->thumbnail_image ? asset($department->thumbnail_image) : ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png'));
    $currentUrl = url()->current();
    $departmentUrl = route('website.department.details', $department->slug);
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $department?->name }}, {{ __('legal department, law practice, تخصص قانوني, قسم قانوني') }}">
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
        "name": "{{ $department->name }}",
        "description": "{{ Str::limit(strip_tags($department->description ?? ''), 200) }}",
        "url": "{{ $departmentUrl }}",
        @if($department->thumbnail_image)
        "image": "{{ asset($department->thumbnail_image) }}",
        @endif
        "provider": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            "url": "{{ url('/') }}"
        },
        "serviceType": "Legal Services",
        "areaServed": {
            "@type": "Country",
            "name": "Syria"
        }
    }
    </script>
    
    @if($lawyers && $lawyers->count() > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($lawyers->take(10) as $index => $lawyer)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Person",
                    "name": "{{ $lawyer->name }}",
                    "jobTitle": "{{ $lawyer->designations ?? 'Lawyer' }}",
                    "url": "{{ route('website.lawyer.details', $lawyer->slug) }}"
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
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ __('Departments') }}",
                "item": "{{ route('website.departments') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $department->name }}",
                "item": "{{ $currentUrl }}"
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
                        <h1>{{ $department?->name }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ $department?->name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!-- Department Thumbnail Image -->
    @if ($department?->thumbnail_image)
    <div class="department-thumbnail-section pt_40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="department-thumbnail-wrapper">
                        <img src="{{ asset($department->thumbnail_image) }}" 
                             alt="{{ $department?->name }}" 
                             class="department-thumbnail-image"
                             loading="lazy"
                             onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="service-detail-area pt_40">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="service-detail-text pt_30">

                        @if ($department?->images && $department->images->count() > 0)
                        <div class="row mb_30">
                            <div class="col-md-12">
                                <!-- Swiper -->
                                <div class="swiper-container pro-detail-top">
                                    <div class="swiper-wrapper">
                                        @foreach ($department->images as $item)
                                            @if ($item?->large_image && file_exists(public_path($item->large_image)))
                                            <div class="swiper-slide">
                                                <div class="catagory-item">
                                                    <div class="catagory-img-holder">
                                                        <img src="{{ asset($item->large_image) }}"
                                                            alt="{{ $department?->name }}" loading="lazy"
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
                                @if ($department->images->where('small_image', '!=', null)->count() > 0)
                                <div class="swiper-container pro-detail-thumbs">
                                    <div class="swiper-wrapper">
                                        @foreach ($department->images as $item)
                                            @if ($item?->small_image && file_exists(public_path($item->small_image)))
                                            <div class="swiper-slide"><img src="{{ asset($item->small_image) }}"
                                                    alt="{{ $department?->name }}" loading="lazy"
                                                    onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;"></div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        {!! $department?->description !!}
                    </div>
                    @if ($department->department_faq->count() != 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faq-service feature-section-text mt_50">
                                    <h2>{{ __('Frequently Asked Questions') }}</h2>
                                    <div class="feature-accordion" id="accordion">
                                        @foreach ($department?->department_faq as $faq)
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
                                @foreach ($departments as $item)
                                    <li class="{{ $item->id == $department?->id ? 'active' : '' }}"><a aria-label="{{ $item?->name }}"
                                            href="{{ route('website.department.details', $item?->slug) }}"><i
                                                class="fas fa-chevron-right"></i> {{ $item?->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="service-widget-contact mt_45">
                            <h2>{{ $contactInfo?->header }}</h2>
                            <p>{{ $contactInfo?->description }}</p>
                            <ul>
                                <li><i class="fas fa-phone"></i> {!! nl2br(e($contactInfo?->email)) !!}</li>
                                <li><i class="far fa-envelope"></i> 
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


    @if ($lawyers->count() != 0)
        <div class="team-page service_details_team pt_40 pb_70 bg_f2f2f2">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title">{{ __('Department Lawyer') }}</h2>
                            <p>{{ $description }}</p>
                        </div>
                    </div>
                </div>


                <div class="row">

                    @if ($lawyers->count() != 0)
                        @foreach ($lawyers as $lawyer)
                            <div class="col-lg-3 col-md-6 mt_30">
                                <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" class="team-item-link" aria-label="{{ $lawyer?->name }}">
                                    <div class="team-item">
                                        <div class="team-photo">
                                            <img src="{{ url($lawyer?->image ? $lawyer?->image : $setting?->default_avatar) }}"
                                                alt="{{ $lawyer?->name }}" loading="lazy">
                                            <div class="team-overlay">
                                                <div class="view-profile-btn">
                                                    <i class="fas fa-eye"></i>
                                                    <span>{{ __('View Profile') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="team-text">
                                            <h4 class="team-name">{{ ucfirst($lawyer?->name) }}</h4>
                                            @php
                                                $displayDept = ($lawyer->departments && $lawyer->departments->isNotEmpty()) 
                                                    ? $lawyer->departments->first() 
                                                    : ($lawyer->department ?? null);
                                            @endphp
                                            <p><i class="fas fa-briefcase"></i> {{ $displayDept && $displayDept->name ? ucfirst($displayDept->name) : '' }}</p>
                                            <p><span><i class="fas fa-graduation-cap"></i> {{ $lawyer?->designations }}</span>
                                            </p>
                                            <p><span><b><i class="fas fa-street-view"></i>
                                                        {{ ucfirst($lawyer?->location?->name) }}</b></span></p>
                                            <div class="team-action-icon">
                                                <i class="fas fa-arrow-left"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-danger text-center">{{ __('Lawyer Not Found') }}</h3>
                    @endif


                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
<style>
/* Department Thumbnail Section */
.department-thumbnail-section {
    background: #f8f9fa;
    padding: 40px 0;
}

.department-thumbnail-wrapper {
    text-align: center;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    background: #fff;
    padding: 10px;
}

.department-thumbnail-image {
    width: 100%;
    max-width: 800px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .department-thumbnail-section {
        padding: 20px 0;
    }
    
    .department-thumbnail-wrapper {
        padding: 5px;
    }
    
    .department-thumbnail-image {
        max-width: 100%;
    }
}
</style>
@endpush

@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
