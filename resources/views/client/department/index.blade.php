@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'Department')->first();
    $seoTitle = $seoData?->seo_title ?? __('Departments') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Explore our legal departments and specialized areas of practice');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('departments, legal departments, law practice areas, أقسام قانونية, تخصصات قانونية') }}">
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
        "name": "{{ __('Departments') }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ $currentUrl }}"
    }
    </script>
    
    @if($departments && $departments->count() > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($departments->take(20) as $index => $department)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Service",
                    "name": "{{ $department->name }}",
                    "description": "{{ Str::limit(strip_tags($department->description ?? ''), 150) }}",
                    "url": "{{ route('website.department.details', $department->slug) }}",
                    @if($department->thumbnail_image)
                    "image": "{{ asset($department->thumbnail_image) }}",
                    @endif
                    "provider": {
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
                                <i class="fas fa-sitemap"></i>
                            </span>
                            <h1 class="title">{{ __('Departments') }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ __('Departments') }}</span></li>
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

    <div class="case-study-home-page case-study-area pt_50">
        <div class="container">
            <div class="row">
                @foreach ($departments as $department)
                    <div class="col-lg-4 col-md-6 mt_15">
                        <div class="case-item">
                            <div class="case-box">
                                <div class="case-image">
                                    <img src="{{ asset($department?->thumbnail_image ?? 'client/images/default-image.jpg') }}" 
                                         alt="{{ $department?->name }}" 
                                         loading="lazy"
                                         onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;">
                                    <div class="overlay"><a aria-label="{{ $department?->name }}"
                                            href="{{ route('website.department.details', $department?->slug) }}"
                                            class="btn-case">{{ __('See Details') }}</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h4 class="title"><a aria-label="{{ $department?->name }}"
                                            href="{{ route('website.department.details', $department?->slug) }}">{{ $department?->name }}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
            <div class="mb-5">
                @if ($departments->hasPages())
                    {{ $departments->links('client.paginator') }}
                @endif
            </div>

        </div>
    </div>
@endsection
