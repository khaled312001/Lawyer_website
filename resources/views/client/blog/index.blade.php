@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'Blog')->first();
    $seoTitle = $seoData?->seo_title ?? __('Blogs') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Read our latest legal articles, news, and insights');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('blog, legal blog, law articles, legal news, مدونة, مقالات قانونية') }}">
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
        "@type": "Blog",
        "name": "{{ __('Blogs') }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ $currentUrl }}",
        "publisher": {
            "@type": "Organization",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ $seoImage }}"
            }
        }
    }
    </script>
    
    @if($blogs && $blogs->count() > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($blogs->take(20) as $index => $blog)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "BlogPosting",
                    "headline": "{{ $blog->title }}",
                    "description": "{{ Str::limit(strip_tags($blog->sort_description ?? ''), 150) }}",
                    "url": "{{ route('website.blog.details', $blog->slug) }}",
                    @if($blog->thumbnail_image)
                    "image": "{{ asset($blog->thumbnail_image) }}",
                    @endif
                    "datePublished": "{{ $blog->created_at ? $blog->created_at->toIso8601String() : '' }}"
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
                "name": "{{ __('Blogs') }}",
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
                        <h1>{{ __('Blogs') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Blogs') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Blog Start-->
    <div class="blog-page pt_70 pb_100">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-item">
                            <div class="blog-image">
                                <a aria-label="{{ $blog?->title }}" href="{{ route('website.blog.details', $blog?->slug) }}"><img src="{{ url($blog?->thumbnail_image) }}" alt="{{ $blog?->title }}" loading="lazy"></a>
                            </div>
                            <div class="blog-author">
                                <span><i class="fas fa-user"></i> {{ $blog?->admin?->name ?? __('Admin') }}</span>
                                <span><i class="far fa-calendar-alt"></i> {{ formattedDate($blog?->created_at) }}</span>
                            </div>
                            <div class="blog-text">
                                <h3 class="title"><a aria-label="{{ $blog?->title }}" href="{{ route('website.blog.details', $blog?->slug) }}">{{ Str::limit($blog?->title,40,'...') }}</a>
                                </h3>
                                <p>
                                    {{ $blog?->sort_description }}

                                </p>
                                <a aria-label="{{ $blog?->title }}" class="sm_btn"
                                    href="{{ route('website.blog.details', $blog?->slug) }}">{{ __('Details') }} →</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!--Pagination Start-->
            @if ($blogs->hasPages())
                {{ $blogs->links('client.paginator') }}
            @endif
            <!--Pagination End-->
        </div>
    </div>
    <!--Blog End-->
@endsection
