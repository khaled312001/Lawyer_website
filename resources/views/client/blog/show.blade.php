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
    <meta name="author" content="{{ $blog?->admin?->name ?? $setting->app_name ?? 'LawMent' }}">
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
    @if($blog?->admin)
    <meta property="article:author" content="{{ $blog->admin->name }}">
    @endif
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
    @if($blog?->admin)
    <meta name="twitter:creator" content="{{ $blog->admin->name }}">
    @endif
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
            "name": "{{ $blog->admin->name ?? $setting->app_name ?? 'LawMent' }}"
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
                                <span><i class="fas fa-user"></i> {{ $blog?->admin?->name ?? __('Admin') }}</span>
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
@push('js')
    @if ($setting?->comment_type == 0)
        <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $setting?->facebook_comment_script }}&autoLogAppEvents=1"
            nonce="MoLwqHe5"></script>
    @endif
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
