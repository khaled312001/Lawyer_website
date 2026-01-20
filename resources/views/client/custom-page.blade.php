@extends('layouts.client.layout')
@php
    $seoTitle = $customPage?->title . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = Str::limit(strip_tags($customPage?->description ?? $customPage?->title ?? ''), 155) ?: $customPage?->title;
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $customPage?->title }}, {{ $setting->app_name ?? 'LawMent' }}">
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
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
@endsection

@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ $customPage->title }}",
        "description": "{{ Str::limit(strip_tags($customPage->description ?? ''), 200) }}",
        "url": "{{ $currentUrl }}"
    }
    </script>
    
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
                "name": "{{ $customPage->title }}",
                "item": "{{ $currentUrl }}"
            }
        ]
    }
    </script>
@endsection

@section('client-content')

<!--Banner Start-->
<section class="banner-area enhanced-breadcrumb flex" style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : asset('client/img/shape-2.webp') }});">
    <div class="breadcrumb-overlay"></div>
    <div class="breadcrumb-pattern"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner-text enhanced-title-content">
                    <div class="title-wrapper">
                        <span class="title-icon">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <h1 class="title">{{ $customPage->title }}</h1>
                    </div>
                    <ul class="breadcrumb-nav">
                        <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                        <li class="separator"><i class="fas fa-chevron-left"></i></li>
                        <li class="active"><span>{{ $customPage?->title }}</span></li>
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


<div class="about-style1 pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {!! $customPage?->description !!}
            </div>
        </div>
    </div>
</div>



@endsection
