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
                                <span><i class="fas fa-user"></i> Admin</span>
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

@push('css')
<style>
    /* Enhanced Blog Page Design */
    .blog-page {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
    }
    
    .blog-page .blog-item {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .blog-page .blog-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        border-color: var(--colorPrimary);
    }
    
    .blog-page .blog-image {
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    
    .blog-page .blog-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .blog-page .blog-item:hover .blog-image::after {
        opacity: 1;
    }
    
    .blog-page .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .blog-page .blog-item:hover .blog-image img {
        transform: scale(1.1);
    }
    
    .blog-page .blog-author {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        padding: 15px 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
        border-left: 4px solid var(--colorBlack);
        border-right: 4px solid var(--colorBlack);
    }
    
    .blog-page .blog-author span {
        font-size: 14px;
        font-weight: 500;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0;
        transition: transform 0.2s ease;
    }
    
    .blog-page .blog-item:hover .blog-author span {
        transform: scale(1.05);
    }
    
    .blog-page .blog-author span i {
        font-size: 16px;
        color: #ffffff;
        margin: 0;
    }
    
    .blog-page .blog-text {
        padding: 25px !important;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background: #ffffff;
    }
    
    .blog-page .blog-item .title {
        margin-top: 0;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    
    .blog-page .blog-item .title a {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.5;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .blog-page .blog-item .title a:hover {
        color: var(--colorPrimary);
    }
    
    .blog-page .blog-item p {
        color: #6c757d;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 20px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .blog-page .blog-item .sm_btn {
        font-size: 15px;
        font-weight: 600;
        color: var(--colorPrimary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 8px 0;
    }
    
    .blog-page .blog-item .sm_btn:hover {
        color: var(--colorSecondary);
        gap: 12px;
        transform: translateX(5px);
    }
    
    .blog-page .blog-item .sm_btn::after {
        content: '→';
        transition: transform 0.3s ease;
    }
    
    .blog-page .blog-item:hover .sm_btn::after {
        transform: translateX(5px);
    }
    
    /* Responsive improvements */
    @media (max-width: 768px) {
        .blog-page .blog-image {
            height: 220px;
        }
        
        .blog-page .blog-author {
            padding: 12px 15px;
            gap: 15px;
        }
        
        .blog-page .blog-author span {
            font-size: 13px;
        }
        
        .blog-page .blog-text {
            padding: 20px !important;
        }
        
        .blog-page .blog-item .title a {
            font-size: 18px;
        }
    }
    
    /* Empty state */
    .blog-page .row:empty::before {
        content: 'لا توجد مقالات متاحة حالياً';
        display: block;
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
        font-size: 18px;
    }
</style>
@endpush
