@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Service')->first()?->seo_title ?? 'Service | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'Service')->first()?->seo_description ?? 'Service | LawMent' }}">
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Services') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Services') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <div class="service-area bg-area">
        <div class="container">
            <div class="row service-row">
                <div class="col-md-12">
                    <div class="service-coloum-area">
                        @foreach ($services as $service)
                            <div class="service-coloum">
                                <div class="service-item">
                                    <i class="{{ $service?->icon }}"></i>
                                    <a href="{{ route('website.service.details', $service?->slug) }}">
                                        <h4 class="title">{{ $service?->title }}</h4>
                                    </a>
                                    <p>{{ $service?->sort_description }}</p>
                                    <a aria-label="{{ __('Service Details') }}" href="{{ route('website.service.details', $service?->slug) }}">{{ __('Service Details') }}
                                        →</a>
                                </div>
                            </div>
                        @endforeach
                        
                        {{-- Real Estate Service --}}
                        <div class="service-coloum">
                            <div class="service-item real-estate-service">
                                <i class="fas fa-home"></i>
                                <a href="{{ route('website.real-estate') }}">
                                    <h4 class="title">{{ __('Real Estate Legal Services') }}</h4>
                                </a>
                                <p>{{ __('Professional legal services for real estate purchase and investment cases through specialized and experienced lawyers, completing the task in the fastest time') }}</p>
                                <a aria-label="{{ __('Service Details') }}" href="{{ route('website.real-estate') }}">{{ __('Service Details') }}
                                    →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($services->hasPages())
                {{ $services->links('client.paginator') }}
            @endif
        </div>
    </div>
    
    @push('css')
    <style>
        .real-estate-service {
            background: linear-gradient(135deg, var(--colorPrimary, #6b5d47) 0%, #5a4d3a 100%);
            color: #fff;
        }
        
        .real-estate-service i {
            color: #fff !important;
        }
        
        .real-estate-service h4,
        .real-estate-service p,
        .real-estate-service a {
            color: #fff !important;
        }
        
        .real-estate-service:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(107, 93, 71, 0.3);
        }
    </style>
    @endpush
@endsection
