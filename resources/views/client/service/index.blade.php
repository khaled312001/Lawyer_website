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
    <!-- Hero Section -->
    <section class="legal-hero-section">
        <div class="legal-hero-overlay"></div>
        <div class="legal-container">
            <div class="legal-hero-content">
                <div class="legal-hero-badge">
                    <i class="fas fa-gavel"></i>
                    <span>{{ __('Our Services') }}</span>
                </div>
                <h1 class="legal-hero-title">{{ __('Comprehensive Legal Solutions') }}</h1>
                <p class="legal-hero-subtitle">{{ __('Expert legal services tailored to your needs') }}</p>
                <div class="legal-breadcrumb-nav">
                    <a href="{{ url('/') }}" class="legal-breadcrumb-link">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Home') }}</span>
                    </a>
                    <span class="legal-breadcrumb-separator">/</span>
                    <span class="legal-breadcrumb-current">{{ __('Services') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="legal-services-main">
        <div class="legal-container">
            <div class="legal-services-header">
                <h2 class="legal-section-title">{{ __('Our Legal Services') }}</h2>
                <p class="legal-section-description">{{ __('We provide professional legal services across various domains') }}</p>
            </div>

            <div class="legal-services-grid">
                @foreach ($services as $service)
                    <div class="legal-service-card" data-service-slug="{{ $service->slug }}">
                        <div class="legal-card-inner">
                            <div class="legal-card-icon-wrapper">
                                <div class="legal-icon-circle">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                            </div>
                            <div class="legal-card-content">
                                <h3 class="legal-card-title">{{ $service->title }}</h3>
                                <p class="legal-card-text">{{ $service->sort_description }}</p>
                            </div>
                            <div class="legal-card-footer">
                                <a href="{{ route('website.service.details', $service->slug) }}" class="legal-card-button">
                                    <span>{{ __('Learn More') }}</span>
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                        <div class="legal-card-hover-effect"></div>
                    </div>
                @endforeach
            </div>

            @if ($services->hasPages())
                <div class="legal-pagination-wrapper">
                    {{ $services->links('client.paginator') }}
                </div>
            @endif
        </div>
    </section>

    <!-- Service Quick View Modal -->
    <div id="legalServiceModal" class="legal-modal-overlay">
        <div class="legal-modal-container">
            <div class="legal-modal-header">
                <button class="legal-modal-close" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="legal-modal-body">
                <div class="legal-modal-icon-section">
                    <div class="legal-modal-icon-circle">
                        <i id="legalModalIcon"></i>
                    </div>
                </div>
                <h2 id="legalModalTitle" class="legal-modal-title"></h2>
                <div id="legalModalDescription" class="legal-modal-description"></div>
                
                <div id="legalModalGallery" class="legal-modal-gallery-section" style="display: none;">
                    <h3 class="legal-modal-section-title">{{ __('Gallery') }}</h3>
                    <div class="legal-gallery-grid" id="legalModalImages"></div>
                </div>

                <div id="legalModalFaqs" class="legal-modal-faq-section" style="display: none;">
                    <h3 class="legal-modal-section-title">{{ __('Frequently Asked Questions') }}</h3>
                    <div class="legal-faq-container" id="legalModalFaqList"></div>
                </div>

                <div class="legal-modal-actions">
                    <a id="legalFullDetailsBtn" href="#" class="legal-action-button">
                        <span>{{ __('View Full Details') }}</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        /* Hero Section */
        .legal-hero-section {
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 120px 0 80px;
            overflow: hidden;
        }

        .legal-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .legal-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(107, 93, 71, 0.15) 0%, transparent 50%);
        }

        .legal-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .legal-hero-content {
            text-align: center;
            color: #ffffff;
        }

        .legal-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 12px 24px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .legal-hero-badge i {
            font-size: 18px;
            color: var(--colorPrimary, #c8b47e);
        }

        .legal-hero-title {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(135deg, #ffffff 0%, #c8b47e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .legal-hero-subtitle {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
            font-weight: 300;
        }

        .legal-breadcrumb-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 16px;
        }

        .legal-breadcrumb-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .legal-breadcrumb-link:hover {
            color: var(--colorPrimary, #c8b47e);
        }

        .legal-breadcrumb-separator {
            color: rgba(255, 255, 255, 0.5);
        }

        .legal-breadcrumb-current {
            color: var(--colorPrimary, #c8b47e);
            font-weight: 600;
        }

        /* Services Main Section */
        .legal-services-main {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .legal-services-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .legal-section-title {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 15px;
        }

        .legal-section-description {
            font-size: 18px;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Services Grid */
        .legal-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .legal-service-card {
            position: relative;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .legal-service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(26, 26, 46, 0.15);
        }

        .legal-card-inner {
            padding: 40px 30px;
            position: relative;
            z-index: 2;
        }

        .legal-card-icon-wrapper {
            margin-bottom: 25px;
        }

        .legal-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.4s ease;
        }

        .legal-icon-circle i {
            font-size: 36px;
            color: var(--colorPrimary, #c8b47e);
            transition: all 0.4s ease;
        }

        .legal-service-card:hover .legal-icon-circle {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, #b8a068 100%);
        }

        .legal-service-card:hover .legal-icon-circle i {
            color: #ffffff;
            transform: scale(1.1);
        }

        .legal-card-content {
            text-align: center;
            margin-bottom: 25px;
        }

        .legal-card-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .legal-card-text {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        .legal-card-footer {
            text-align: center;
        }

        .legal-card-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .legal-card-button:hover {
            background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, #b8a068 100%);
            transform: translateX(-5px);
            box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3);
        }

        .legal-card-button i {
            transition: transform 0.3s ease;
        }

        .legal-card-button:hover i {
            transform: translateX(-3px);
        }

        .legal-card-hover-effect {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(200, 180, 126, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .legal-service-card:hover .legal-card-hover-effect {
            opacity: 1;
        }

        /* Pagination */
        .legal-pagination-wrapper {
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }

        /* Modal Styles */
        .legal-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(26, 26, 46, 0.9);
            backdrop-filter: blur(5px);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: legalFadeIn 0.3s ease;
        }

        .legal-modal-overlay.active {
            display: flex;
        }

        .legal-modal-container {
            background: #ffffff;
            border-radius: 24px;
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: legalSlideUp 0.4s ease;
            position: relative;
        }

        .legal-modal-header {
            position: sticky;
            top: 0;
            background: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            z-index: 10;
        }

        .legal-modal-close {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8f9fa;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
        }

        .legal-modal-close:hover {
            background: #e9ecef;
            transform: rotate(90deg);
        }

        .legal-modal-body {
            padding: 40px 30px;
        }

        .legal-modal-icon-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .legal-modal-icon-circle {
            width: 100px;
            height: 100px;
            border-radius: 24px;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .legal-modal-icon-circle i {
            font-size: 48px;
            color: var(--colorPrimary, #c8b47e);
        }

        .legal-modal-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a2e;
            text-align: center;
            margin-bottom: 20px;
        }

        .legal-modal-description {
            font-size: 17px;
            color: #666;
            line-height: 1.8;
            text-align: center;
            margin-bottom: 30px;
        }

        .legal-modal-gallery-section,
        .legal-modal-faq-section {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
        }

        .legal-modal-section-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 20px;
        }

        .legal-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 15px;
        }

        .legal-gallery-grid img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .legal-gallery-grid img:hover {
            transform: scale(1.05);
            border-color: var(--colorPrimary, #c8b47e);
        }

        .legal-faq-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .legal-faq-item {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .legal-faq-question {
            width: 100%;
            padding: 20px;
            background: none;
            border: none;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .legal-faq-question:hover {
            background: #e9ecef;
        }

        .legal-faq-answer {
            padding: 0 20px 20px;
            color: #666;
            line-height: 1.7;
            display: none;
        }

        .legal-faq-item.active .legal-faq-answer {
            display: block;
        }

        .legal-modal-actions {
            margin-top: 40px;
            text-align: center;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
        }

        .legal-action-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .legal-action-button:hover {
            background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, #b8a068 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(200, 180, 126, 0.3);
        }

        @keyframes legalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes legalSlideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .legal-hero-title {
                font-size: 42px;
            }

            .legal-hero-subtitle {
                font-size: 18px;
            }

            .legal-services-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 25px;
            }

            .legal-section-title {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .legal-hero-section {
                padding: 80px 0 60px;
            }

            .legal-hero-title {
                font-size: 32px;
            }

            .legal-services-main {
                padding: 60px 0;
            }

            .legal-services-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .legal-section-title {
                font-size: 28px;
            }

            .legal-card-inner {
                padding: 30px 20px;
            }

            .legal-modal-container {
                max-width: 100%;
                border-radius: 20px 20px 0 0;
                max-height: 95vh;
            }

            .legal-modal-body {
                padding: 30px 20px;
            }

            .legal-modal-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .legal-hero-title {
                font-size: 28px;
            }

            .legal-hero-badge {
                font-size: 12px;
                padding: 10px 20px;
            }

            .legal-icon-circle {
                width: 70px;
                height: 70px;
            }

            .legal-icon-circle i {
                font-size: 30px;
            }

            .legal-card-title {
                font-size: 20px;
            }
        }
    </style>
    @endpush

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('legalServiceModal');
            const modalTitle = document.getElementById('legalModalTitle');
            const modalIcon = document.getElementById('legalModalIcon');
            const modalDescription = document.getElementById('legalModalDescription');
            const modalGallery = document.getElementById('legalModalGallery');
            const modalImages = document.getElementById('legalModalImages');
            const modalFaqs = document.getElementById('legalModalFaqs');
            const modalFaqList = document.getElementById('legalModalFaqList');
            const fullDetailsBtn = document.getElementById('legalFullDetailsBtn');
            const closeBtn = document.querySelector('.legal-modal-close');

            // Service card click handlers
            document.querySelectorAll('.legal-service-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('.legal-card-button')) {
                        const slug = this.getAttribute('data-service-slug');
                        loadServiceDetails(slug);
                    }
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
                if (e.key === 'Escape' && modal.classList.contains('active')) {
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

                        modalTitle.textContent = service.title;
                        modalIcon.className = service.icon;
                        modalDescription.textContent = service.description || service.sort_description;

                        fullDetailsBtn.href = `/service-details/${slug}`;

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
                                faqItem.className = 'legal-faq-item';

                                faqItem.innerHTML = `
                                    <button class="legal-faq-question">
                                        <span>${faq.question}</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div class="legal-faq-answer">${faq.answer}</div>
                                `;

                                const questionBtn = faqItem.querySelector('.legal-faq-question');
                                questionBtn.addEventListener('click', function() {
                                    faqItem.classList.toggle('active');
                                    const icon = this.querySelector('i');
                                    icon.style.transform = faqItem.classList.contains('active') 
                                        ? 'rotate(180deg)' : 'rotate(0deg)';
                                });

                                modalFaqList.appendChild(faqItem);
                            });
                            modalFaqs.style.display = 'block';
                        } else {
                            modalFaqs.style.display = 'none';
                        }

                        modal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    })
                    .catch(error => {
                        console.error('Error loading service details:', error);
                        alert('Error loading service details. Please try again.');
                    });
            }

            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
    @endpush
@endsection
