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
        /* Enhanced Service Items Color Design */
        .service-area {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 80px 0;
        }

        .service-item {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .service-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .service-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(107, 93, 71, 0.2);
            border-color: var(--colorPrimary);
        }

        .service-item:hover::before {
            transform: scaleX(1);
        }

        .service-item i {
            color: var(--colorPrimary);
            font-size: 56px;
            margin-bottom: 25px;
            transition: all 0.4s ease;
            display: inline-block;
            background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 20px;
            position: relative;
        }

        .service-item:hover i {
            color: var(--colorSecondary);
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            color: #fff;
            box-shadow: 0 8px 20px rgba(107, 93, 71, 0.3);
        }

        .service-item .title {
            color: var(--colorBlack);
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .service-item:hover .title {
            color: var(--colorPrimary);
        }

        .service-item p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .service-item a[aria-label] {
            color: var(--colorPrimary);
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .service-item a[aria-label]::after {
            content: '→';
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .service-item:hover a[aria-label] {
            color: var(--colorSecondary);
            transform: translateX(5px);
        }

        .service-item:hover a[aria-label]::after {
            transform: translateX(5px);
        }

        .service-item a[href*="service-details"]:not([aria-label]) {
            text-decoration: none;
        }

        .service-item a[href*="service-details"]:not([aria-label]):hover {
            text-decoration: none;
        }

        /* Service Column Area */
        .service-coloum-area {
            gap: 30px;
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .service-item {
                width: 100% !important;
                max-width: 100%;
                margin: 15px 0;
            }

            .service-item i {
                font-size: 48px;
                width: 90px;
                height: 90px;
                line-height: 90px;
            }
        }

        @media (max-width: 768px) {
            .service-area {
                padding: 60px 0;
            }

            .service-item {
                padding: 40px 20px 35px;
            }

            .service-item i {
                font-size: 42px;
                width: 80px;
                height: 80px;
                line-height: 80px;
            }

            .service-item .title {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .service-item {
                padding: 30px 15px 25px;
            }

            .service-item i {
                font-size: 36px;
                width: 70px;
                height: 70px;
                line-height: 70px;
            }
        }
    </style>
    @endpush
@endsection
