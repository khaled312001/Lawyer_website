@extends('layouts.client.layout')
@php
    $seoTitle = $blog?->seo_title ?? $blog?->title . ' - ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $blog?->seo_description ?? Str::limit(strip_tags($blog?->description ?? $blog?->sort_description ?? ''), 155) ?: $blog?->title;
    $seoImage = $blog?->image ? asset($blog->image) : ($blog?->thumbnail_image ? asset($blog->thumbnail_image) : ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png')));
    $currentUrl = url()->current();
    $blogUrl = route('website.blog.details', $blog->slug);
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
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $blog->title }}",
        "description": "{{ Str::limit(strip_tags($blog->description ?? $blog->sort_description ?? ''), 200) }}",
        "image": "{{ $seoImage }}",
        "datePublished": "{{ $publishedDate }}",
        "dateModified": "{{ $modifiedDate }}",
        "author": {
            "@type": "Person",
            "name": "Admin"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ $setting->logo ? asset($setting->logo) : asset('client/img/logo.png') }}"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ $currentUrl }}"
        },
        @if($blog->category)
        "articleSection": "{{ $blog->category->name ?? '' }}",
        @endif
        "url": "{{ $blogUrl }}"
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
                "name": "{{ __('Blogs') }}",
                "item": "{{ route('website.blogs') }}"
            },
            @if($blog->category)
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->category->name ?? '' }}",
                "item": "{{ route('website.blog.category', $blog->category->slug ?? '') }}"
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "{{ $blog->title }}",
                "item": "{{ $currentUrl }}"
            }
            @else
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->title }}",
                "item": "{{ $currentUrl }}"
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
                    @if ($setting?->comment_type == 0)
                        <div class="comment-list mt_30">
                            <h4>{{ __('Comments') }}</h4>
                        </div>
                        <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                    @else
                        <div class="comment-list mt_30">
                            @if ($blog?->comments->count() != 0)
                                <h4>{{ __('Comments') }} <span class="c-number">({{ $blog?->comments->count() }})</span>
                                </h4>
                            @endif

                            <ul>
                                @foreach ($blog?->comments as $comment)
                                    <li>
                                        <div class="comment-item">
                                            <div class="thumb">
                                                @php
                                                    $gravatar_link =
                                                        'http://www.gravatar.com/avatar/' .
                                                        md5($comment?->email) .
                                                        '?s=32';
                                                    header('content-type: image/jpeg');
                                                @endphp
                                                <img src="{{ $gravatar_link }}" alt="{{ $comment?->name }}" loading="lazy">
                                            </div>
                                            <div class="com-text">
                                                <h5>{{ ucwords($comment?->name) }}</h5>
                                                <span class="date"><i
                                                        class="fas fa-calendar"></i> {{ formattedDateTime($comment?->created_at) }}</span>
                                                <p>
                                                    {{ $comment?->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="comment-form mt_30">
                            <h4>{{ __('Submit A Comment') }}</h4>
                            <form method="POST" action="{{ route('website.comment.store', $blog?->slug) }}">
                                @csrf
                                <div class="form-row row">
                                    @auth('web')
                                        <div class="form-group col-12">
                                            <input type="hidden" class="form-control" name="name" value="{{ userAuth()->name }}">
                                            <input type="hidden" class="form-control" name="email" value="{{ userAuth()->email }}">
                                            <input type="hidden" class="form-control" name="phone" value="{{ userAuth()?->details?->phone }}">
                                        </div>
                                    @else
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}" placeholder="{{ __('Name') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone') }}" placeholder="{{ __('Phone') }}">
                                        </div>
                                    @endauth
                                    <div class="form-group col-12">
                                        <textarea class="form-control" name="comment" placeholder="{{ __('Comment') }}">{{ old('comment') }}</textarea>
                                    </div>
                                    @if ($setting->recaptcha_status == 'active')
                                        <div class="form-group col-12">
                                            <div class="g-recaptcha" data-sitekey="{{ $setting->recaptcha_site_key }}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

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
    @if ($setting?->comment_type == 0)
        <div id="fb-root"></div>
    @endif
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
    
    /* Comments section */
    .blog-page.single-blog .comment-list {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }
    
    .blog-page.single-blog .comment-list h4 {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--colorPrimary);
    }
    
    .blog-page.single-blog .comment-item {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .blog-page.single-blog .comment-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .blog-page.single-blog .comment-item .thumb {
        flex-shrink: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
    }
    
    .blog-page.single-blog .comment-item .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .blog-page.single-blog .comment-item .com-text h5 {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    
    .blog-page.single-blog .comment-item .com-text .date {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 12px;
        display: block;
    }
    
    .blog-page.single-blog .comment-item .com-text p {
        font-size: 15px;
        line-height: 1.7;
        color: #495057;
        margin: 0;
    }
    
    .blog-page.single-blog .comment-form {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }
    
    .blog-page.single-blog .comment-form h4 {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--colorPrimary);
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

@push('js')
    @if ($setting?->comment_type == 0)
        <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $setting?->facebook_comment_script }}&autoLogAppEvents=1"
            nonce="MoLwqHe5"></script>
    @endif
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
