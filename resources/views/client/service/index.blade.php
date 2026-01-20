@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'Service')->first();
    $seoTitle = $seoData?->seo_title ?? __('Services') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Discover our comprehensive legal services and solutions');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('services, legal services, consultation services, خدمات قانونية, استشارات قانونية') }}">
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
        "@type": "Service",
        "serviceType": "Legal Services",
        "provider": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name ?? 'LawMent' }}"
        },
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Legal Services",
            "itemListElement": [
                @if($services && $services->count() > 0)
                    @foreach($services->take(20) as $index => $service)
                    {
                        "@type": "OfferCatalog",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "{{ $service->title }}",
                            "description": "{{ Str::limit(strip_tags($service->sort_description ?? ''), 150) }}",
                            "url": "{{ route('website.service.details', $service->slug) }}"
                        }
                    }@if(!$loop->last),@endif
                    @endforeach
                @endif
            ]
        }
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
                                <i class="fas fa-briefcase"></i>
                            </span>
                            <h1 class="title">{{ __('Services') }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ __('Services') }}</span></li>
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

    <div class="service-area bg-area">
        <div class="container">
            <div class="row service-row">
                <div class="col-md-12">
                    <div class="service-coloum-area">
                        @foreach ($services as $service)
                            <div class="service-coloum">
                                <div class="service-item">
                                    <i class="{{ $service?->icon }}"></i>
                                    <a href="#" class="service-link" data-slug="{{ $service?->slug }}">
                                        <h4 class="title">{{ $service?->title }}</h4>
                                    </a>
                                    <p>{{ $service?->sort_description }}</p>
                                    <a aria-label="{{ __('Service Details') }}" href="#" class="service-link" data-slug="{{ $service?->slug }}">{{ __('Service Details') }}
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

    <!-- Service Details Modal -->
    <div id="serviceModal" class="service-modal">
        <div class="service-modal-content">
            <div class="service-modal-header">
                <span class="service-modal-close">&times;</span>
                <h2 id="serviceModalTitle"></h2>
            </div>
            <div class="service-modal-body">
                <div class="service-modal-icon">
                    <i id="serviceModalIcon"></i>
                </div>
                <div class="service-modal-description">
                    <p id="serviceModalDescription"></p>
                </div>

                <!-- Service Images Gallery -->
                <div class="service-modal-gallery" id="serviceModalGallery" style="display: none;">
                    <h3>{{ __('Gallery') }}</h3>
                    <div class="gallery-images" id="serviceModalImages"></div>
                </div>


                <!-- Service FAQs -->
                <div class="service-modal-faqs" id="serviceModalFaqs" style="display: none;">
                    <h3>{{ __('Frequently Asked Questions') }}</h3>
                    <div class="faq-list" id="serviceModalFaqList"></div>
                </div>

                <!-- Full Details Link -->
                <div class="service-modal-footer">
                    <a id="serviceFullDetailsLink" href="#" class="btn btn-primary" target="_blank">
                        {{ __('View Full Details') }}
                    </a>
                </div>
            </div>
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
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
            width: 100px;
            height: 100px;
            border-radius: 20px;
            position: relative;
            text-align: center;
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
            text-align: center;
            width: 100%;
        }

        .service-item .title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .service-item .title a:hover {
            color: var(--colorPrimary);
        }

        .service-item:hover .title {
            color: var(--colorPrimary);
        }

        .service-item p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 15px;
            text-align: center;
            flex-grow: 1;
        }

        .service-item a[aria-label] {
            color: var(--colorPrimary);
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            position: relative;
            padding: 10px 20px;
            border-radius: 8px;
            background: rgba(200, 180, 126, 0.1);
            margin-top: auto;
            width: 100%;
        }

        .service-item a[aria-label]:hover {
            background: rgba(200, 180, 126, 0.2);
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

        .service-link {
            text-decoration: none;
        }

        .service-link:hover {
            text-decoration: none;
        }

        /* Service Column Area */
        .service-coloum-area {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .service-coloum {
            display: flex;
        }

        /* Enhanced Pagination Styles */
        .service-area .pagination {
            margin-top: 60px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .service-area .page-numbers {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-area .page-numbers li {
            margin: 0;
        }

        /* Page Links - Light Brown/Tan Color */
        .service-area .page-numbers .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(200, 180, 126, 0.3);
            position: relative;
            overflow: hidden;
        }

        .service-area .page-numbers .page-link::before {
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

        .service-area .page-numbers .page-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(200, 180, 126, 0.5);
            background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        }

        .service-area .page-numbers .page-link:hover::before {
            opacity: 1;
        }

        /* Current Page - Dark Blue with Red Edge */
        .service-area .page-numbers .page-current {
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

        .service-area .page-numbers .page-current::after {
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
        .service-area .page-numbers .page-nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(200, 180, 126, 0.3);
            font-size: 18px;
        }

        .service-area .page-numbers .page-nav-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(200, 180, 126, 0.5);
            background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
        }

        /* Disabled State */
        .service-area .page-numbers li.disabled span {
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
        .service-area .page-numbers li.disabled span:not([aria-label]) {
            background: transparent;
            color: #6B7280;
            font-weight: 600;
            font-size: 20px;
            width: auto;
            padding: 0 8px;
        }

        /* Service Modal Styles */
        .service-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            animation: modalFadeIn 0.3s ease-out;
        }

        .service-modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 20px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.4s ease-out;
            max-height: 90vh;
            overflow-y: auto;
        }

        .service-modal-header {
            background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .service-modal-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .service-modal-close {
            color: #fff;
            float: right;
            font-size: 36px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: absolute;
            top: 15px;
            right: 25px;
        }

        .service-modal-close:hover,
        .service-modal-close:focus {
            color: #ccc;
            transform: scale(1.1);
        }

        .service-modal-body {
            padding: 30px;
        }

        .service-modal-icon {
            text-align: center;
            margin-bottom: 25px;
        }

        .service-modal-icon i {
            color: var(--colorPrimary);
            font-size: 64px;
            background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
            width: 120px;
            height: 120px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .service-modal-description {
            text-align: center;
            margin-bottom: 30px;
        }

        .service-modal-description p {
            font-size: 18px;
            line-height: 1.7;
            color: #555;
            margin: 0;
        }

        .service-modal-gallery,
        .service-modal-videos,
        .service-modal-faqs {
            margin-bottom: 30px;
        }

        .service-modal-gallery h3,
        .service-modal-videos h3,
        .service-modal-faqs h3 {
            color: var(--colorPrimary);
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .gallery-images {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .gallery-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: transform 0.3s ease;
        }

        .gallery-images img:hover {
            transform: scale(1.05);
            border-color: var(--colorPrimary);
        }

        .video-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .video-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .video-item iframe {
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-item {
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
            color: var(--colorPrimary);
            transition: background-color 0.3s ease;
        }

        .faq-question:hover {
            background-color: rgba(107, 93, 71, 0.05);
        }

        .faq-answer {
            padding: 0 20px 20px;
            color: #666;
            line-height: 1.6;
            display: none;
        }

        .service-modal-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .service-modal-footer .btn {
            background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .service-modal-footer .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 93, 71, 0.3);
        }

        @keyframes modalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px) scale(0.9);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .service-coloum-area {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 25px;
            }

            .service-item {
                width: 100% !important;
                max-width: 100%;
                margin: 0;
            }

            .service-item i {
                font-size: 48px;
                width: 90px;
                height: 90px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .service-modal-content {
                width: 95%;
                margin: 10% auto;
            }

            .service-modal-header {
                padding: 20px;
            }

            .service-modal-body {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .service-area {
                padding: 60px 0;
            }

            .service-coloum-area {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .service-item {
                padding: 35px 25px;
            }

            .service-area .page-numbers {
                gap: 8px;
            }

            .service-area .page-numbers .page-link,
            .service-area .page-numbers .page-current,
            .service-area .page-numbers .page-nav-btn,
            .service-area .page-numbers li.disabled span {
                width: 42px;
                height: 42px;
                font-size: 15px;
            }

            .service-area .page-numbers .page-current {
                font-size: 16px;
            }

            .service-item i {
                font-size: 42px;
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .service-item .title {
                font-size: 20px;
            }

            .service-modal-content {
                width: 98%;
                margin: 5% auto;
                max-height: 95vh;
            }

            .service-modal-header h2 {
                font-size: 24px;
            }

            .service-modal-icon i {
                font-size: 48px;
                width: 100px;
                height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .gallery-images {
                justify-content: center;
            }

            .gallery-images img {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            .service-item {
                padding: 30px 20px;
            }

            .service-area .page-numbers {
                gap: 6px;
            }

            .service-area .page-numbers .page-link,
            .service-area .page-numbers .page-current,
            .service-area .page-numbers .page-nav-btn,
            .service-area .page-numbers li.disabled span {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .service-area .page-numbers .page-current {
                font-size: 15px;
            }

            .service-item i {
                font-size: 36px;
                width: 70px;
                height: 70px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .service-modal-body {
                padding: 15px;
            }

            .service-modal-header h2 {
                font-size: 20px;
            }

            .service-modal-icon i {
                font-size: 40px;
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .service-modal-description p {
                font-size: 16px;
            }
        }
    </style>
    @endpush

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('serviceModal');
            const modalTitle = document.getElementById('serviceModalTitle');
            const modalIcon = document.getElementById('serviceModalIcon');
            const modalDescription = document.getElementById('serviceModalDescription');
            const modalGallery = document.getElementById('serviceModalGallery');
            const modalImages = document.getElementById('serviceModalImages');
            const modalFaqs = document.getElementById('serviceModalFaqs');
            const modalFaqList = document.getElementById('serviceModalFaqList');
            const fullDetailsLink = document.getElementById('serviceFullDetailsLink');
            const closeBtn = document.querySelector('.service-modal-close');

            // Service links click handler
            document.querySelectorAll('.service-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const slug = this.getAttribute('data-slug');
                    loadServiceDetails(slug);
                });
            });

            // Close modal handlers
            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // ESC key handler
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    closeModal();
                }
            });

            function loadServiceDetails(slug) {
                fetch(`/api/service-details/${slug}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert('Service not found');
                            return;
                        }

                        const service = data.service;

                        // Update modal content
                        modalTitle.textContent = service.title;
                        modalIcon.className = service.icon;
                        modalDescription.textContent = service.description || service.sort_description;

                        // Update full details link
                        fullDetailsLink.href = `/service-details/${slug}`;

                        // Handle gallery
                        if (service.images && service.images.length > 0) {
                            modalImages.innerHTML = '';
                            service.images.forEach(image => {
                                const img = document.createElement('img');
                                img.src = `/${image.large_image}`;
                                img.alt = service.title;
                                modalImages.appendChild(img);
                            });
                            modalGallery.style.display = 'block';
                        } else {
                            modalGallery.style.display = 'none';
                        }


                        // Handle FAQs
                        if (service.faqs && service.faqs.length > 0) {
                            modalFaqList.innerHTML = '';
                            service.faqs.forEach(faq => {
                                const faqItem = document.createElement('div');
                                faqItem.className = 'faq-item';

                                faqItem.innerHTML = `
                                    <button class="faq-question">
                                        ${faq.question}
                                        <span class="faq-toggle">+</span>
                                    </button>
                                    <div class="faq-answer">
                                        ${faq.answer}
                                    </div>
                                `;

                                // Add click handler for FAQ toggle
                                const questionBtn = faqItem.querySelector('.faq-question');
                                const answer = faqItem.querySelector('.faq-answer');
                                const toggle = faqItem.querySelector('.faq-toggle');

                                questionBtn.addEventListener('click', function() {
                                    const isVisible = answer.style.display === 'block';
                                    answer.style.display = isVisible ? 'none' : 'block';
                                    toggle.textContent = isVisible ? '+' : '−';
                                });

                                modalFaqList.appendChild(faqItem);
                            });
                            modalFaqs.style.display = 'block';
                        } else {
                            modalFaqs.style.display = 'none';
                        }

                        // Show modal
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    })
                    .catch(error => {
                        console.error('Error loading service details:', error);
                        alert('Error loading service details. Please try again.');
                    });
            }


            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    </script>
    @endpush
@endsection
