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
                                <i class="fas fa-blog"></i>
                            </span>
                            <h1 class="title">{{ __('Blogs') }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ __('Blogs') }}</span></li>
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
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 8px 0;
        width: 100%;
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
    
    /* Enhanced Pagination Design */
    .blog-page .pagination {
        margin-top: 60px;
        margin-bottom: 30px;
    }
    
    .blog-page .page-numbers {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .blog-page .page-numbers li {
        margin: 0;
    }
    
    /* Page Links - Light Brown/Tan Color */
    .blog-page .page-numbers .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #D4A574 0%, #C8965F 100%);
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(212, 165, 116, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .blog-page .page-numbers .page-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .blog-page .page-numbers .page-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(212, 165, 116, 0.5);
        background: linear-gradient(135deg, #E0B584 0%, #D4A574 100%);
    }
    
    .blog-page .page-numbers .page-link:hover::before {
        opacity: 1;
    }
    
    /* Current Page - Dark Blue with Red Edge */
    .blog-page .page-numbers .page-current {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 18px;
        border-radius: 12px;
        position: relative;
        box-shadow: 0 4px 12px rgba(30, 58, 138, 0.4);
        border-right: 3px solid #DC2626;
    }
    
    .blog-page .page-numbers .page-current::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #DC2626 0%, #B91C1C 100%);
        border-radius: 0 12px 12px 0;
    }
    
    /* Navigation Buttons */
    .blog-page .page-numbers .page-nav-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #D4A574 0%, #C8965F 100%);
        color: #ffffff;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(212, 165, 116, 0.3);
        font-size: 18px;
    }
    
    .blog-page .page-numbers .page-nav-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(212, 165, 116, 0.5);
        background: linear-gradient(135deg, #E0B584 0%, #D4A574 100%);
    }
    
    /* Disabled State */
    .blog-page .page-numbers li.disabled span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: #E5E7EB;
        color: #9CA3AF;
        border-radius: 12px;
        cursor: not-allowed;
        font-size: 18px;
    }
    
    /* Dots Separator */
    .blog-page .page-numbers li.disabled span:not([aria-label]) {
        background: transparent;
        color: #6B7280;
        font-weight: 600;
        font-size: 20px;
        width: auto;
        padding: 0 8px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .blog-page .page-numbers {
            gap: 8px;
        }
        
        .blog-page .page-numbers .page-link,
        .blog-page .page-numbers .page-current,
        .blog-page .page-numbers .page-nav-btn,
        .blog-page .page-numbers li.disabled span {
            width: 42px;
            height: 42px;
            font-size: 15px;
        }
        
        .blog-page .page-numbers .page-current {
            font-size: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .blog-page .page-numbers {
            gap: 6px;
        }
        
        .blog-page .page-numbers .page-link,
        .blog-page .page-numbers .page-current,
        .blog-page .page-numbers .page-nav-btn,
        .blog-page .page-numbers li.disabled span {
            width: 38px;
            height: 38px;
            font-size: 14px;
        }
    }
</style>
@endpush
