@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Blog')->first()?->seo_title ?? $category?->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ seoSetting()->where('page_name', 'Blog')->first()?->seo_description ?? 'Blog | LawMent' }}">
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $category?->title }}</h1>
                    <ul>
                        <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                        <li><span>{{ $category?->title }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<div class="blog-page pt_40 pb_90">
    @if ($blogs->count()!=0)
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
                        <h3 class="title"><a aria-label="{{ $blog?->title }}" href="{{ route('website.blog.details',$blog?->slug) }}">{{ Str::limit($blog?->title,40,'...') }}</a></h3>
                        <p>
                            {{ $blog?->sort_description }}
                        </p>
                        <a aria-label="{{ $blog?->title }}" class="sm_btn" href="{{ route('website.blog.details',$blog?->slug) }}">{{ __('Details') }} →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--Pagination Start-->
        {{ $blogs->links('client.paginator') }}
        <!--Pagination End-->
    </div>
    @else
        <div class="container">
            <h1 class="text-center text-danger display-4">{{ __('Blog Not Found') }}</h1>
        </div>
    @endif

</div>

@endsection

@push('css')
<style>
    /* Enhanced Blog Category Page Design */
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
</style>
@endpush
