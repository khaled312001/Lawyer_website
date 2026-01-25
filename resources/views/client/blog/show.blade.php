@extends('layouts.client.layout')
@php
    $seoTitle = $blog?->seo_title ?? $blog?->title . ' - ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $blog?->seo_description ?? Str::limit(strip_tags($blog?->description ?? $blog?->sort_description ?? ''), 155) ?: $blog?->title;
    $seoImage = $blog?->image ? asset($blog->image) : ($blog?->thumbnail_image ? asset($blog->thumbnail_image) : ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png')));
    $blogUrl = route('website.blog.details', $blog->slug);
    $currentUrl = $blogUrl; // Always use canonical URL (non-prefixed)
    $publishedDate = $blog->created_at ? $blog->created_at->toIso8601String() : now()->toIso8601String();
    $modifiedDate = $blog->updated_at ? $blog->updated_at->toIso8601String() : $publishedDate;
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $blog?->title }}, {{ __('legal blog, law article, legal news, مدونة قانونية, مقال قانوني') }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Admin">
    <meta name="article:published_time" content="{{ $publishedDate }}">
    <meta name="article:modified_time" content="{{ $modifiedDate }}">
    @if($blog?->category)
    <meta name="article:section" content="{{ $blog->category->name ?? '' }}">
    @endif
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
    <meta property="article:published_time" content="{{ $publishedDate }}">
    <meta property="article:modified_time" content="{{ $modifiedDate }}">
    <meta property="article:author" content="Admin">
    @if($blog?->category)
    <meta property="article:section" content="{{ $blog->category->name ?? '' }}">
    @endif
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <meta name="twitter:creator" content="Admin">
@endsection

@section('structured_data')
    @php
        $appName = (!empty($setting->app_name) && trim($setting->app_name) !== '') 
            ? trim($setting->app_name) 
            : 'LawMent';
        
        $blogTitle = $blog->title ?? 'Blog Post';
        $blogDesc = !empty($blog->description) 
            ? Str::limit(strip_tags($blog->description), 200) 
            : (!empty($blog->sort_description) 
                ? Str::limit(strip_tags($blog->sort_description), 200) 
                : $blogTitle);
        
        $blogData = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $blogTitle,
            'description' => $blogDesc,
            'image' => $seoImage,
            'datePublished' => $publishedDate,
            'dateModified' => $modifiedDate,
            'author' => [
                '@type' => 'Person',
                'name' => 'Admin'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $appName,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $setting->logo ? asset($setting->logo) : asset('client/img/logo.png')
                ]
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $currentUrl
            ],
            'url' => $blogUrl
        ];
        
        if (!empty($blog->category) && !empty($blog->category->name)) {
            $blogData['articleSection'] = $blog->category->name;
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode($blogData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ url('/') }}",
                    "name": "{{ __('Home') }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ __('Blogs') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ route('website.blogs') }}",
                    "name": "{{ __('Blogs') }}"
                }
            },
            @if($blog->category && !empty($blog->category->name))
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->category->name }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ route('website.blog.category', $blog->category->slug ?? '') }}",
                    "name": "{{ $blog->category->name }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "{{ $blog->title }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}",
                    "name": "{{ $blog->title }}"
                }
            }
            @else
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->title }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}",
                    "name": "{{ $blog->title }}"
                }
            }
            @endif
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
                        <h1>{{ $blog?->title }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><a aria-label="{{ __('Blogs') }}" href="{{ route('website.blogs') }}">{{ __('Blogs') }}</a></li>
                            <li><span>{{ $blog?->title }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Blog Start-->
    <div class="blog-page single-blog pt_40 pb_90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-item">
                        <div class="single-blog-image">
                            <img src="{{ url($blog?->image) }}" alt="{{ $blog?->title }}" loading="lazy">
                            <div class="blog-author">
                                <span><i class="fas fa-user"></i> Admin</span>
                                <span><i class="far fa-calendar-alt"></i> {{ formattedDate($blog?->created_at) }}</span>
                                <span><i class="fas fa-tag" aria-hidden="true"></i> {{ $blog?->category?->title }}</span>
                            </div>
                        </div>
                        <div class="blog-text pt_40">
                            <p>
                                {!! $blog?->sort_description !!}
                            </p>

                            {!! $blog?->description !!}
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-item">
                            <h3>{{ __('Blog Category') }}</h3>
                            <ul>
                                @foreach ($blogCategories as $category)
                                    <li class="{{ $blog?->blog_category_id == $category?->id ? 'active' : '' }}"><a aria-label="{{ $category?->title }}"
                                            href="{{ route('website.blog.category', $category?->slug) }}"><i
                                                class="fas fa-chevron-right"></i>{{ $category?->title }}</a></li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="sidebar-item">
                            <h3>{{ __('Recent Posts') }}</h3>
                            @foreach ($latestBlog as $item)
                                <div class="blog-recent-item">
                                    <div class="blog-recent-photo">
                                        <a aria-label="{{ $item?->title }}" href="{{ route('website.blog.details', $item?->slug) }}"><img
                                                src="{{ url($item?->thumbnail_image) }}" alt="{{ $item?->title }}" loading="lazy"></a>
                                    </div>
                                    <div class="blog-recent-text">
                                        <a aria-label="{{ $item?->title }}"
                                            href="{{ route('website.blog.details', $item?->slug) }}">{{ $item?->title }}</a>
                                        <div class="blog-post-date">{{ formattedDate($item?->created_at) }}</div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!--Sidebar End-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    /* Enhanced Single Blog Post Design */
    .blog-page.single-blog {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
    }
    
    .blog-page.single-blog .blog-item {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
    }
    
    .blog-page.single-blog .single-blog-image {
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
    }
    
    .blog-page.single-blog .single-blog-image img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }
    
    .blog-page.single-blog .single-blog-image:hover img {
        transform: scale(1.05);
    }
    
    .blog-page.single-blog .blog-author {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        padding: 18px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
        border-left: 5px solid var(--colorBlack);
        border-right: 5px solid var(--colorBlack);
    }
    
    .blog-page.single-blog .blog-author span {
        font-size: 15px;
        font-weight: 600;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        transition: all 0.3s ease;
    }
    
    .blog-page.single-blog .blog-author span:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    
    .blog-page.single-blog .blog-author span i {
        font-size: 16px;
        color: #ffffff;
        margin: 0;
    }
    
    .blog-page.single-blog .blog-text {
        padding: 40px !important;
        background: #ffffff;
    }
    
    .blog-page.single-blog .blog-text p {
        font-size: 16px;
        line-height: 1.8;
        color: #495057;
        margin-bottom: 20px;
    }
    
    .blog-page.single-blog .blog-text h1,
    .blog-page.single-blog .blog-text h2,
    .blog-page.single-blog .blog-text h3,
    .blog-page.single-blog .blog-text h4 {
        color: #2c3e50;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .blog-page.single-blog .blog-text h1 {
        font-size: 32px;
    }
    
    .blog-page.single-blog .blog-text h2 {
        font-size: 28px;
    }
    
    .blog-page.single-blog .blog-text h3 {
        font-size: 24px;
    }
    
    .blog-page.single-blog .blog-text ul,
    .blog-page.single-blog .blog-text ol {
        margin: 20px 0;
        padding-right: 30px;
    }
    
    .blog-page.single-blog .blog-text li {
        margin-bottom: 10px;
        line-height: 1.8;
        color: #495057;
    }
    
    .blog-page.single-blog .blog-text blockquote {
        border-right: 4px solid var(--colorPrimary);
        padding: 20px 25px;
        margin: 30px 0;
        background: #f8f9fa;
        border-radius: 8px;
        font-style: italic;
        color: #495057;
    }
    
    .blog-page.single-blog .blog-text img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 25px 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .blog-page.single-blog .blog-text a {
        color: var(--colorPrimary);
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: all 0.3s ease;
    }
    
    .blog-page.single-blog .blog-text a:hover {
        color: var(--colorSecondary);
        border-bottom-color: var(--colorSecondary);
    }
    
    /* Sidebar enhancements */
    .blog-page.single-blog .sidebar {
        position: sticky;
        top: 100px;
    }
    
    .blog-page.single-blog .sidebar-item {
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }
    
    .blog-page.single-blog .sidebar-item h3 {
        font-size: 22px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--colorPrimary);
    }
    
    .blog-page.single-blog .sidebar-item ul li {
        margin-bottom: 12px;
    }
    
    .blog-page.single-blog .sidebar-item ul li a {
        color: #495057;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .blog-page.single-blog .sidebar-item ul li a:hover,
    .blog-page.single-blog .sidebar-item ul li.active a {
        background: var(--colorPrimary);
        color: #ffffff;
        transform: translateX(-5px);
    }
    
    .blog-page.single-blog .blog-recent-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .blog-page.single-blog .blog-recent-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .blog-page.single-blog .blog-recent-photo {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .blog-page.single-blog .blog-recent-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .blog-page.single-blog .blog-recent-item:hover .blog-recent-photo img {
        transform: scale(1.1);
    }
    
    .blog-page.single-blog .blog-recent-text a {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        text-decoration: none;
        display: block;
        margin-bottom: 8px;
        line-height: 1.5;
        transition: color 0.3s ease;
    }
    
    .blog-page.single-blog .blog-recent-text a:hover {
        color: var(--colorPrimary);
    }
    
    .blog-page.single-blog .blog-post-date {
        font-size: 13px;
        color: #6c757d;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .blog-page.single-blog .sidebar {
            position: static;
            margin-top: 40px;
        }
        
        .blog-page.single-blog .blog-text {
            padding: 30px !important;
        }
        
        .blog-page.single-blog .blog-author {
            padding: 15px 20px;
            gap: 15px;
        }
        
        .blog-page.single-blog .blog-author span {
            font-size: 14px;
            padding: 6px 12px;
        }
    }
    
    @media (max-width: 768px) {
        .blog-page.single-blog .blog-text {
            padding: 25px !important;
        }
        
        .blog-page.single-blog .blog-text h1 {
            font-size: 26px;
        }
        
        .blog-page.single-blog .blog-text h2 {
            font-size: 22px;
        }
        
        .blog-page.single-blog .blog-text h3 {
            font-size: 20px;
        }
        
        .blog-page.single-blog .blog-author {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endpush

