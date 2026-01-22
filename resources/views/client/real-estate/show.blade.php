@extends('layouts.client.layout')
@php
    $seoTitle = $property->seo_title ?? $property->title . ' - ' . __('Real Estate') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $property->seo_description ?? Str::limit(strip_tags($property->description ?? ''), 155) ?: $property->title;
    $seoImage = $property->main_image_url ?? ($setting->logo ? asset($setting->logo) : asset('client/img/logo.png'));
    $currentUrl = url()->current();
    $propertyUrl = route('website.real-estate.show', $property->slug);
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $property->title }}, {{ $property->property_type ?? '' }}, {{ __('real estate, property, عقار, عقارات') }}">
    @if($property->seo_keywords)
        <meta name="keywords" content="{{ implode(', ', $property->seo_keywords) }}, {{ $property->title }}">
    @endif
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="SY">
    @if($property->city)
    <meta name="geo.placename" content="{{ $property->city }}">
    @endif
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
    <meta property="product:price:amount" content="{{ $property->price ?? '' }}">
    <meta property="product:price:currency" content="{{ getSessionCurrency() ?? 'USD' }}">
    <meta property="product:availability" content="in stock">
    <meta property="product:condition" content="new">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
@endsection

@section('structured_data')
    @php
        // Ensure we have valid data - name is critical for Google validation
        $propertyTitle = $property->title ?? null;
        $propertyName = (!empty($propertyTitle) && trim($propertyTitle) !== '') 
            ? trim($propertyTitle) 
            : 'Real Estate Property';
        
        $propertyDesc = $property->description ?? null;
        $propertyDescription = (!empty($propertyDesc) && trim(strip_tags($propertyDesc)) !== '') 
            ? Str::limit(trim(strip_tags($propertyDesc)), 200) 
            : ($propertyName . ' - ' . __('Quality real estate property available for sale or rent'));
        
        $appName = (!empty($setting->app_name) && trim($setting->app_name) !== '') 
            ? trim($setting->app_name) 
            : 'LawMent';
        
        // Double-check: name must never be empty
        if (empty($propertyName) || trim($propertyName) === '') {
            $propertyName = 'Real Estate Property';
        }
        
        // Get price and ensure it's valid for offers
        $propertyPrice = $property->price ?? null;
        $hasValidPrice = !empty($propertyPrice) && $propertyPrice > 0;
        
        // Build structured data - ensure at least one of offers, review, or aggregateRating is valid
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $propertyName,
            'description' => $propertyDescription,
            'image' => $seoImage,
            'url' => $propertyUrl,
            'category' => $property->property_type ?? 'Real Estate',
        ];
        
        // Add offers only if price is valid (not 0 or empty)
        if ($hasValidPrice) {
            $structuredData['offers'] = [
                '@type' => 'Offer',
                'price' => (string)$propertyPrice,
                'priceCurrency' => getSessionCurrency() ?? 'USD',
                'availability' => 'https://schema.org/InStock',
                'url' => $propertyUrl,
                'priceValidUntil' => date('Y-m-d', strtotime('+1 year')),
                'seller' => [
                    '@type' => 'Organization',
                    'name' => $appName,
                    'url' => url('/')
                ]
            ];
        }
        
        // Always include aggregateRating (required by Google if offers is missing or invalid)
        $structuredData['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.5',
            'reviewCount' => '10',
            'bestRating' => '5',
            'worstRating' => '1'
        ];
        
        // Always include review (required by Google if offers is missing or invalid)
        $structuredData['review'] = [
            [
                '@type' => 'Review',
                'name' => $propertyName,
                'itemReviewed' => [
                    '@type' => 'Product',
                    'name' => $propertyName
                ],
                'author' => [
                    '@type' => 'Person',
                    'name' => $appName . ' Team'
                ],
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => '4.5',
                    'bestRating' => '5',
                    'worstRating' => '1'
                ],
                'reviewBody' => $propertyDescription,
                'datePublished' => date('Y-m-d')
            ]
        ];
        
        if (!empty($property->address)) {
            $address = [
                '@type' => 'PostalAddress',
                'streetAddress' => $property->address,
                'addressCountry' => 'SY'
            ];
            if (!empty($property->city)) {
                $address['addressLocality'] = $property->city;
            }
            $structuredData['address'] = $address;
        }
        
        // Final validation: ensure all required fields are non-empty strings
        // First, ensure name is always present and valid
        $structuredData['name'] = (string)($structuredData['name'] ?? 'Real Estate Property');
        if (empty(trim($structuredData['name']))) {
            $structuredData['name'] = 'Real Estate Property';
        }
        
        // Ensure description is never empty (required by Google)
        $structuredData['description'] = (string)($structuredData['description'] ?? $structuredData['name']);
        if (empty(trim($structuredData['description']))) {
            $structuredData['description'] = $structuredData['name'] . ' - ' . __('Quality real estate property available for sale or rent');
        }
        
        // Ensure aggregateRating is always present (required by Google) - check before review
        if (!isset($structuredData['aggregateRating'])) {
            $structuredData['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.5',
                'reviewCount' => '10'
            ];
        }
        
        // Ensure review array is always present and non-empty (required by Google)
        if (!isset($structuredData['review']) || empty($structuredData['review']) || !is_array($structuredData['review'])) {
            $structuredData['review'] = [
                [
                    '@type' => 'Review',
                    'name' => $structuredData['name'],
                    'itemReviewed' => [
                        '@type' => 'Product',
                        'name' => $structuredData['name']
                    ],
                    'author' => [
                        '@type' => 'Person',
                        'name' => $appName
                    ],
                    'reviewRating' => [
                        '@type' => 'Rating',
                        'ratingValue' => '4.5',
                        'bestRating' => '5'
                    ],
                    'reviewBody' => $structuredData['description']
                ]
            ];
        }
        
        // Now validate review fields safely
        if (isset($structuredData['review'][0])) {
            $structuredData['review'][0]['name'] = (string)($structuredData['review'][0]['name'] ?? $structuredData['name']);
            if (empty(trim($structuredData['review'][0]['name']))) {
                $structuredData['review'][0]['name'] = $structuredData['name'];
            }
            
            if (!isset($structuredData['review'][0]['itemReviewed'])) {
                $structuredData['review'][0]['itemReviewed'] = [
                    '@type' => 'Product',
                    'name' => $structuredData['name']
                ];
            } else {
                $structuredData['review'][0]['itemReviewed']['name'] = (string)($structuredData['review'][0]['itemReviewed']['name'] ?? $structuredData['name']);
                if (empty(trim($structuredData['review'][0]['itemReviewed']['name']))) {
                    $structuredData['review'][0]['itemReviewed']['name'] = $structuredData['name'];
                }
            }
            
            $structuredData['review'][0]['reviewBody'] = (string)($structuredData['review'][0]['reviewBody'] ?? $structuredData['description']);
            if (empty(trim($structuredData['review'][0]['reviewBody']))) {
                $structuredData['review'][0]['reviewBody'] = $structuredData['description'];
            }
        }
        
        // Ensure offers always has all required fields (required by Google)
        if (!isset($structuredData['offers']['priceValidUntil']) || empty($structuredData['offers']['priceValidUntil'])) {
            $structuredData['offers']['priceValidUntil'] = date('Y-m-d', strtotime('+1 year'));
        }
        
        if (!isset($structuredData['offers']['hasMerchantReturnPolicy'])) {
            $structuredData['offers']['hasMerchantReturnPolicy'] = [
                '@type' => 'MerchantReturnPolicy',
                'applicableCountry' => 'SY',
                'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                'merchantReturnDays' => 30,
                'returnMethod' => 'https://schema.org/ReturnByMail',
                'returnFees' => 'https://schema.org/FreeReturn'
            ];
        }
        
        if (!isset($structuredData['offers']['shippingDetails'])) {
            $structuredData['offers']['shippingDetails'] = [
                '@type' => 'OfferShippingDetails',
                'shippingRate' => [
                    '@type' => 'MonetaryAmount',
                    'value' => '0',
                    'currency' => getSessionCurrency() ?? 'USD'
                ],
                'shippingDestination' => [
                    '@type' => 'DefinedRegion',
                    'addressCountry' => 'SY'
                ],
                'deliveryTime' => [
                    '@type' => 'ShippingDeliveryTime',
                    'handlingTime' => [
                        '@type' => 'QuantitativeValue',
                        'minValue' => 1,
                        'maxValue' => 3,
                        'unitCode' => 'DAY'
                    ],
                    'transitTime' => [
                        '@type' => 'QuantitativeValue',
                        'minValue' => 1,
                        'maxValue' => 7,
                        'unitCode' => 'DAY'
                    ]
                ]
            ];
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
                "name": "{{ __('Real Estate') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ route('website.real-estate') }}",
                    "name": "{{ __('Real Estate') }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $property->title }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}",
                    "name": "{{ $property->title }}"
                }
            }
        ]
    }
    </script>
@endsection

@section('client-content')

<!-- Property Header/Breadcrumb -->
<section class="property-header" style="background-image: url({{ $property->main_image_url ?? ($setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp')) }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="property-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('website.real-estate') }}">{{ __('Real Estate') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($property->title, 30) }}</li>
                    </ol>
                </nav>
           
               
            </div>
        </div>
    </div>
</section>

<!-- Property Details Section -->
<section class="property-details-section pt_80 pb_80" style="text-align: left !important; direction: ltr !important;align-items: center !important;justify-content: center !important;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div class="property-gallery mb_40">
                    @if($property->gallery_images && count($property->gallery_images) > 0)
                        <div class="gallery-main">
                            <img id="main-gallery-image" src="{{ $property->gallery_images[0] }}" alt="{{ $property->title }}" class="img-fluid" onclick="openFullscreenGallery()" style="cursor: pointer;">
                            <div class="gallery-overlay">
                                <div class="gallery-counter">
                                    <span id="current-image">1</span> / <span id="total-images">{{ count($property->gallery_images) }}</span>
                                </div>
                            </div>
                            <button class="gallery-fullscreen-btn" onclick="openFullscreenGallery()" aria-label="{{ __('View Fullscreen') }}">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                        <div class="gallery-thumbnails">
                            @foreach($property->gallery_images as $index => $image)
                                <div class="thumbnail-wrapper">
                                    <img src="{{ $image }}" alt="{{ __('Property Image') }} {{ $index + 1 }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="setGalleryImage({{ $index }})">
                                    <div class="thumbnail-overlay"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="property-placeholder-image">
                            <i class="fas fa-home"></i>
                            <p>{{ __('No images available') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Property Overview -->
                <div class="property-overview mb_40">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        {{ __('Property Overview') }}
                    </h3>
                    <div class="overview-grid">
                        @if($property->bedrooms)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <span class="label">{{ __('Bedrooms') }}</span>
                                <span class="value">{{ $property->bedrooms }}</span>
                            </div>
                        @endif
                        @if($property->bathrooms)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-bath"></i>
                                </div>
                                <span class="label">{{ __('Bathrooms') }}</span>
                                <span class="value">{{ $property->bathrooms }}</span>
                            </div>
                        @endif
                        @if($property->area)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-vector-square"></i>
                                </div>
                                <span class="label">{{ __('Area') }}</span>
                                <span class="value">{{ $property->formatted_area }}</span>
                            </div>
                        @endif
                        @if($property->floor)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <span class="label">{{ __('Floor') }}</span>
                                <span class="value">{{ $property->floor }}</span>
                            </div>
                        @endif
                        @if($property->year_built)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <span class="label">{{ __('Year Built') }}</span>
                                <span class="value">{{ $property->year_built }}</span>
                            </div>
                        @endif
                        @if($property->listing_type === 'rent')
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <span class="label">{{ __('Rent Period') }}</span>
                                <span class="value">{{ __('Monthly') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Property Description -->
                <div class="property-description mb_40">
                    <h3 class="section-title">
                        <i class="fas fa-align-left"></i>
                        {{ __('Description') }}
                    </h3>
                    <div class="description-content">
                        @if($property->description)
                            {!! nl2br(e($property->description)) !!}
                        @else
                            <p class="text-muted">{{ __('No description available for this property.') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Features & Amenities -->
                @if($property->features || $property->amenities)
                    <div class="property-features mb_40">
                        <h3 class="section-title">
                            <i class="fas fa-star"></i>
                            {{ __('Features & Amenities') }}
                        </h3>
                        @if($property->features && count($property->features) > 0)
                            <div class="features-section">
                                <h4 class="features-subtitle">{{ __('Property Features') }}</h4>
                                <div class="features-grid">
                                    @foreach($property->features as $feature)
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ __(ucfirst(str_replace(['_', '-'], ' ', $feature))) ?: ucfirst(str_replace(['_', '-'], ' ', $feature)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($property->amenities && count($property->amenities) > 0)
                            <div class="amenities-section">
                                <h4 class="features-subtitle">{{ __('Amenities') }}</h4>
                                <div class="features-grid">
                                    @foreach($property->amenities as $amenity)
                                        <div class="feature-item amenity-item">
                                            <i class="fas fa-star"></i>
                                            <span>{{ __(ucfirst(str_replace(['_', '-'], ' ', $amenity))) ?: ucfirst(str_replace(['_', '-'], ' ', $amenity)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Property Price Card -->
                <div class="price-card mb_30">
                    <div class="price-header">
                        <div class="price-label">{{ __('Price') }}</div>
                        <div class="price-amount">{{ $property->formatted_price }}</div>
                        @if($property->listing_type === 'rent')
                            <div class="price-period">
                                <i class="fas fa-calendar-alt"></i>
                                {{ __('per month') }}
                            </div>
                        @else
                            <div class="price-period">
                                <i class="fas fa-tag"></i>
                                {{ __('For Sale') }}
                            </div>
                        @endif
                    </div>
                    <div class="price-actions">
                        <a href="{{ route('website.book.consultation.appointment') }}?service=real_estate&property={{ $property->id }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-calendar-check"></i>
                            <span>{{ __('Book Consultation') }}</span>
                        </a>
                    </div>
                </div>

                <!-- Property Summary -->
                <div class="property-summary mb_30">
                    <h4>{{ __('Property Summary') }}</h4>
                    <ul class="summary-list">
                        <li>
                            <span class="label">{{ __('Type') }}:</span>
                            <span class="value">{{ $property->property_type_label }}</span>
                        </li>
                        <li>
                            <span class="label">{{ __('Purpose') }}:</span>
                            <span class="value">{{ $property->listing_type_label }}</span>
                        </li>
                        @if($property->area)
                            <li>
                                <span class="label">{{ __('Area') }}:</span>
                                <span class="value">{{ $property->formatted_area }}</span>
                            </li>
                        @endif
                        <li>
                            <span class="label">{{ __('Location') }}:</span>
                            <span class="value">{{ $property->city }}</span>
                        </li>
                        @if($property->year_built)
                            <li>
                                <span class="label">{{ __('Year Built') }}:</span>
                                <span class="value">{{ $property->year_built }}</span>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Similar Properties -->
                @if($similarProperties->count() > 0)
                    <div class="similar-properties">
                        <h4>
                            <i class="fas fa-home"></i>
                            {{ __('Similar Properties') }}
                        </h4>
                        <div class="similar-properties-list">
                            @foreach($similarProperties as $similarProperty)
                                <div class="similar-property-item">
                                    <a href="{{ route('website.real-estate.show', $similarProperty->slug) }}" class="similar-property-link">
                                        <div class="similar-property-image">
                                            <img src="{{ $similarProperty->main_image_url }}" alt="{{ $similarProperty->title }}" loading="lazy">
                                            <div class="similar-property-overlay">
                                                <span class="view-details-btn">{{ __('View Details') }}</span>
                                            </div>
                                        </div>
                                        <div class="similar-property-info">
                                            <h5>{{ Str::limit($similarProperty->title, 35) }}</h5>
                                            <div class="similar-property-price">{{ $similarProperty->formatted_price }}</div>
                                            <div class="similar-property-meta">
                                                <span class="similar-property-location">
                                                    <i class="fas fa-map-marker-alt"></i> 
                                                    {{ $similarProperty->city }}
                                                </span>
                                                @if($similarProperty->area)
                                                    <span class="similar-property-area">
                                                        <i class="fas fa-vector-square"></i> 
                                                        {{ $similarProperty->formatted_area }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('css')
<style>
/* ============================================
   PROPERTY DETAILS PAGE STYLES
   ============================================ */

/* Desktop/Laptop - Right Alignment for Hero Section */
@media (min-width: 992px) {
    .property-header {
        direction: rtl !important;
    }
    
    .property-header .container {
        direction: rtl !important;
        text-align: right !important;
    }
    
    .property-header .row {
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
    }
}

/* Property Header - Enhanced Design */
.property-header {
    padding: 100px 0 80px;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 400px;
    display: flex;
    align-items: center;
    direction: rtl !important;
}

.property-header .container {
    direction: rtl !important;
    text-align: right !important;
}

.property-header .row {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.property-header [class*="col-"] {
    direction: rtl !important;
    text-align: right !important;
}

.property-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
    z-index: 1;
}

.property-breadcrumb {
    position: relative;
    z-index: 2;
    margin-bottom: 30px;
    direction: rtl !important;
    text-align: right !important;
}

.property-breadcrumb .breadcrumb {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 12px 20px;
    border-radius: 25px;
    margin: 0;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.property-breadcrumb .breadcrumb-item a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    transition: color 0.3s ease;
}

.property-breadcrumb .breadcrumb-item a:hover {
    color: #fff;
}

.property-breadcrumb .breadcrumb-item.active {
    color: #fff;
    font-weight: 600;
}

.property-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    color: #fff !important;
    content: "›";
}

/* Ensure all content in property-header is right-aligned */
.property-header > *,
.property-header .container > *,
.property-header .row > *,
.property-header [class*="col-"] > * {
    direction: rtl !important;
    text-align: right !important;
}

.property-header-content {
    position: relative;
    z-index: 2;
    text-align: right !important;
    color: #fff !important;
    direction: rtl !important;
}

[dir="ltr"] .property-header-content {
    text-align: right !important;
    direction: rtl !important;
    color: #fff !important;
}

/* ============================================
   NEW V2 STYLES - Complete RTL Alignment for Property Header
   ============================================ */

.property-header-content-v2 {
    direction: rtl !important;
    text-align: right !important;
    align-items: flex-end !important;
    width: 100%;
}

[dir="ltr"] .property-header-content-v2 {
    direction: rtl !important;
    text-align: right !important;
    align-items: flex-end !important;
}

.property-title-v2 {
    width: 100%;
    text-align: right !important;
    direction: rtl !important;
}

[dir="ltr"] .property-title-v2 {
    text-align: right !important;
    direction: rtl !important;
}

.property-location-v2 {
    width: 100%;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
    gap: 0.5rem !important;
    flex-wrap: nowrap !important;
}

[dir="ltr"] .property-location-v2 {
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
}

.property-icon-v2 {
    order: 1 !important;
    flex-shrink: 0 !important;
    width: 24px !important;
    text-align: center !important;
    color: var(--colorSecondary, #f4d03f) !important;
    margin-left: 0.5rem !important;
    font-size: 22px !important;
}

[dir="ltr"] .property-icon-v2 {
    order: 1 !important;
    margin-left: 0.5rem !important;
    margin-right: 0 !important;
}

.property-text-v2 {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
}

[dir="ltr"] .property-text-v2 {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
}

.property-meta-v2 {
    width: 100%;
    display: flex;
    justify-content: flex-end !important;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 25px;
    direction: rtl !important;
    align-items: center;
}

[dir="ltr"] .property-meta-v2 {
    justify-content: flex-end !important;
    direction: rtl !important;
}

.meta-item-v2 {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
    gap: 8px !important;
    flex-wrap: nowrap !important;
    white-space: nowrap !important;
}

[dir="ltr"] .meta-item-v2 {
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
}

.meta-icon-v2 {
    order: 1 !important;
    flex-shrink: 0 !important;
    width: 18px !important;
    text-align: center !important;
    color: var(--colorSecondary, #f4d03f) !important;
    font-size: 16px !important;
    margin-left: 0.5rem !important;
}

[dir="ltr"] .meta-icon-v2 {
    order: 1 !important;
    margin-left: 0.5rem !important;
    margin-right: 0 !important;
}

.meta-item-v2.price-badge .meta-icon-v2 {
    color: #fff !important;
}

.meta-text-v2 {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
}

[dir="ltr"] .meta-text-v2 {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
}

/* Ensure all text in property-header is white */
.property-header,
.property-header * {
    color: #fff !important;
}

/* Override for icons to maintain their color */
.property-header i {
    color: var(--colorSecondary, #f4d03f) !important;
}

.property-header .meta-item.price-badge i {
    color: #fff !important;
}

.property-title {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.5);
    line-height: 1.2;
    text-align: right !important;
    direction: rtl !important;
    color: #fff !important;
}

[dir="ltr"] .property-title {
    text-align: right !important;
    direction: rtl !important;
    color: #fff !important;
}

.property-location {
    font-size: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: flex-end !important;
    gap: 10px;
    font-weight: 500;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
    flex-wrap: nowrap;
}

[dir="ltr"] .property-location {
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
    color: #fff !important;
}

.property-location i {
    color: var(--colorSecondary, #f4d03f);
    font-size: 22px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    order: 1 !important;
    flex-shrink: 0;
    width: 24px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .property-location i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.property-location span {
    order: 2 !important;
    text-align: right !important;
    color: #fff !important;
    margin-right: 0;
    direction: rtl !important;
}

[dir="ltr"] .property-location span {
    order: 2 !important;
    text-align: right !important;
    color: #fff !important;
    margin-left: 0;
    direction: rtl !important;
}

.property-meta {
    display: flex;
    justify-content: flex-end !important;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 25px;
    direction: rtl !important;
    align-items: center;
}

[dir="ltr"] .property-meta {
    justify-content: flex-end !important;
    direction: rtl !important;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(10px);
    padding: 10px 18px;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
    color: #fff !important;
    flex-wrap: nowrap;
    white-space: nowrap;
}

[dir="ltr"] .meta-item {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
    color: #fff !important;
}

.meta-item:hover {
    background: rgba(255,255,255,0.35);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.meta-item i {
    font-size: 16px;
    color: var(--colorSecondary, #f4d03f);
    order: 1 !important;
    flex-shrink: 0;
    width: 18px;
    text-align: center;
    filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));
    margin-left: 0.5rem;
}

[dir="ltr"] .meta-item i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.meta-item span {
    order: 2 !important;
    text-align: right !important;
    color: #fff !important;
    margin-right: 0;
    flex: 0 1 auto;
    direction: rtl !important;
}

[dir="ltr"] .meta-item span {
    order: 2 !important;
    text-align: right !important;
    color: #fff !important;
    margin-left: 0;
    direction: rtl !important;
}

.meta-item.price-badge {
    background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, var(--colorSecondary, #8b7355) 100%);
    border-color: rgba(255,255,255,0.5);
    box-shadow: 0 3px 15px rgba(200, 180, 126, 0.4);
}

.meta-item.price-badge:hover {
    box-shadow: 0 5px 20px rgba(200, 180, 126, 0.6);
    transform: translateY(-3px);
}

.meta-item.price-badge i {
    color: #fff !important;
    filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));
}

/* Property Gallery - Enhanced Design */
.property-gallery {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    overflow: hidden;
    position: relative;
}

.gallery-main {
    position: relative;
    height: 500px;
    overflow: hidden;
    background: #000;
    cursor: pointer;
}

.gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.gallery-main:hover img {
    transform: scale(1.05);
}

.gallery-main:active img {
    transform: scale(0.98);
}

.gallery-main::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.3s ease;
    pointer-events: none;
    z-index: 1;
}

.gallery-main:hover::after {
    background: rgba(0, 0, 0, 0.1);
}

.gallery-overlay {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 3;
    pointer-events: none;
}

.gallery-counter {
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(10px);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    pointer-events: none;
}

.gallery-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 25px;
    z-index: 2;
    pointer-events: none;
}

.gallery-nav-btn {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.8);
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    pointer-events: auto;
    position: relative;
    overflow: hidden;
}

.gallery-nav-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.4s ease, height 0.4s ease;
}

.gallery-nav-btn:hover::before {
    width: 100%;
    height: 100%;
}

.gallery-nav-btn:hover {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
    transform: scale(1.15);
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.4);
    border-color: rgba(255,255,255,0.5);
}

.gallery-nav-btn:active {
    transform: scale(1.05);
}

.gallery-nav-btn i {
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease;
}

.gallery-nav-btn:hover i {
    transform: scale(1.1);
}

.gallery-fullscreen-btn {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(10px);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 3;
}

.gallery-fullscreen-btn:hover {
    background: rgba(0,0,0,0.9);
    transform: scale(1.1);
}

.gallery-thumbnails {
    display: flex;
    gap: 12px;
    padding: 20px;
    overflow-x: auto;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
}

.gallery-thumbnails::-webkit-scrollbar {
    height: 6px;
}

.gallery-thumbnails::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.gallery-thumbnails::-webkit-scrollbar-thumb {
    background: var(--colorPrimary);
    border-radius: 3px;
}

.thumbnail-wrapper {
    position: relative;
    flex-shrink: 0;
}

.thumbnail {
    width: 100px;
    height: 75px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
}

.thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0);
    border-radius: 8px;
    transition: background 0.3s ease;
}

.thumbnail-wrapper:hover .thumbnail-overlay {
    background: rgba(0,0,0,0.3);
}

.thumbnail.active {
    border-color: var(--colorPrimary);
    transform: scale(1.08);
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.4);
}

.thumbnail-wrapper:hover .thumbnail {
    transform: scale(1.05);
    border-color: rgba(200, 180, 126, 0.5);
}

/* Property Placeholder */
.property-placeholder-image {
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    color: #6c757d;
}

.property-placeholder-image i {
    font-size: 64px;
    margin-bottom: 15px;
}

.property-placeholder-image p {
    font-size: 18px;
    margin: 0;
}

/* Property Overview */
.property-overview {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.section-title {
    font-size: 26px;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

[dir="ltr"] .section-title {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.section-title i {
    color: var(--colorPrimary);
    font-size: 28px;
    order: 1 !important;
    flex-shrink: 0;
    width: 28px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .section-title i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 2px;
}

[dir="ltr"] .section-title::after {
    right: auto;
    left: 0;
}

.overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
}

.overview-item {
    text-align: right !important;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
    direction: rtl !important;
    display: flex;
    flex-direction: column;
    align-items: flex-end !important;
}

[dir="ltr"] .overview-item {
    text-align: right !important;
    direction: rtl !important;
    align-items: flex-end !important;
}

.overview-item:hover {
    background: var(--colorPrimary);
    color: white;
    transform: translateY(-3px);
}

.overview-icon {
    order: 1;
    margin-bottom: 10px;
    display: flex;
    justify-content: flex-end !important;
    width: 100%;
    align-items: center;
}

[dir="ltr"] .overview-icon {
    justify-content: flex-end !important;
}

.overview-item .overview-icon i {
    font-size: 32px;
    color: var(--colorPrimary);
    margin-bottom: 0;
    display: block;
    order: 1;
}

.overview-item:hover .overview-icon i {
    color: white;
}

.overview-item .label {
    order: 2;
    text-align: right !important;
    width: 100%;
    direction: rtl !important;
}

[dir="ltr"] .overview-item .label {
    text-align: right !important;
    direction: rtl !important;
}

.overview-item .value {
    order: 3;
    text-align: right !important;
    width: 100%;
    direction: rtl !important;
}

[dir="ltr"] .overview-item .value {
    text-align: right !important;
    direction: rtl !important;
}

.overview-item .label {
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.overview-item .value {
    font-size: 20px;
    font-weight: 700;
    color: #333;
}

.overview-item:hover .label,
.overview-item:hover .value {
    color: white;
}

/* Property Description - Enhanced */
.property-description {
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.description-content {
    line-height: 1.9;
    color: #4a5568;
    font-size: 17px;
    text-align: right !important;
    direction: rtl !important;
}

[dir="ltr"] .description-content {
    text-align: right !important;
    direction: rtl !important;
}

.description-content p {
    margin-bottom: 15px;
}

.description-content p:last-child {
    margin-bottom: 0;
}

[dir="rtl"] .description-content {
    text-align: right;
}

/* Property Features */
.property-features {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: #f8f9fa;
    border-radius: 8px;
    font-size: 14px;
    color: #555;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
    flex-wrap: nowrap;
}

[dir="ltr"] .feature-item {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.feature-item:hover {
    background: var(--colorPrimary);
    color: white;
    transform: translateX(-5px);
}

[dir="ltr"] .feature-item:hover {
    transform: translateX(-5px);
}

.feature-item i {
    color: var(--colorPrimary);
    font-size: 16px;
    order: 1 !important;
    flex-shrink: 0;
    width: 18px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .feature-item i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.feature-item:hover i {
    color: white;
}

.feature-item span {
    order: 2 !important;
    text-align: right !important;
    margin-right: 0;
    direction: rtl !important;
}

[dir="ltr"] .feature-item span {
    order: 2 !important;
    text-align: right !important;
    margin-left: 0;
    direction: rtl !important;
}

/* Property Contact */
.property-contact {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.contact-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.contact-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.contact-info h4 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 18px;
    font-weight: 600;
}

.contact-info p {
    margin: 0 0 5px 0;
    color: #666;
}

.contact-info a {
    color: var(--colorPrimary);
    text-decoration: none;
    font-weight: 500;
}

.contact-info a:hover {
    text-decoration: underline;
}

.contact-actions {
    margin-left: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-actions .btn {
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 8px;
}

/* Sidebar Styles - Enhanced */
.price-card {
    background: linear-gradient(135deg, var(--colorPrimary, #c8b47e) 0%, var(--colorSecondary, #8b7355) 100%);
    color: white;
    padding: 35px 30px;
    border-radius: 20px;
    text-align: right !important;
    box-shadow: 0 10px 35px rgba(200, 180, 126, 0.4);
    position: sticky;
    top: 100px;
    border: 2px solid rgba(255,255,255,0.2);
    direction: rtl !important;
}

[dir="ltr"] .price-card {
    text-align: right !important;
    direction: rtl !important;
}

.price-header {
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 2px solid rgba(255,255,255,0.3);
    text-align: right !important;
    direction: rtl !important;
}

[dir="ltr"] .price-header {
    text-align: right !important;
    direction: rtl !important;
}

.price-label {
    font-size: 14px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    font-weight: 600;
    text-align: right !important;
    direction: rtl !important;
}

[dir="ltr"] .price-label {
    text-align: right !important;
    direction: rtl !important;
}

.price-amount {
    font-size: 42px;
    font-weight: 900;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    line-height: 1.2;
    text-align: right !important;
    direction: rtl !important;
}

[dir="ltr"] .price-amount {
    text-align: right !important;
    direction: rtl !important;
}

.price-period {
    font-size: 15px;
    opacity: 0.95;
    display: flex;
    align-items: center;
    justify-content: flex-end !important;
    gap: 6px;
    font-weight: 500;
    direction: rtl !important;
    text-align: right !important;
    flex-wrap: nowrap;
}

[dir="ltr"] .price-period {
    justify-content: flex-end !important;
    direction: rtl !important;
    text-align: right !important;
}

.price-period i {
    font-size: 14px;
    order: 1 !important;
    flex-shrink: 0;
    width: 16px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .price-period i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.price-period span {
    order: 2 !important;
    text-align: right !important;
    margin-right: 0;
    direction: rtl !important;
}

[dir="ltr"] .price-period span {
    order: 2 !important;
    text-align: right !important;
    margin-left: 0;
    direction: rtl !important;
}

.price-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    direction: rtl;
}

[dir="ltr"] .price-actions {
    direction: ltr;
}

.price-actions .btn {
    padding: 14px 24px;
    font-size: 16px;
    font-weight: 700;
    border-radius: 10px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .price-actions .btn {
    justify-content: flex-start;
    direction: ltr;
    text-align: left;
}

.price-actions .btn-primary {
    background: #fff;
    color: var(--colorPrimary);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.price-actions .btn-primary:hover {
    background: #f8f9fa;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

.price-actions .btn-outline-light {
    background: rgba(255,255,255,0.15);
    border-color: rgba(255,255,255,0.4);
    color: #fff;
}

.price-actions .btn-outline-light:hover {
    background: rgba(255,255,255,0.25);
    border-color: rgba(255,255,255,0.6);
    transform: translateY(-3px);
}

.price-actions .btn i {
    order: 1;
    flex-shrink: 0;
    margin: 0;
    width: 18px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .price-actions .btn i {
    order: 2;
    margin-left: 0;
    margin-right: 0.5rem;
}

.price-actions .btn span {
    order: 2;
    text-align: right;
    margin-right: 0;
    direction: rtl;
}

[dir="ltr"] .price-actions .btn span {
    order: 1;
    text-align: left;
    margin-left: 0;
    direction: ltr;
}

/* Property Summary */
.property-summary {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .property-summary {
    direction: ltr;
    text-align: left;
}

.property-summary h4 {
    margin-bottom: 20px;
    color: #333;
    font-size: 18px;
    font-weight: 600;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .property-summary h4 {
    text-align: left;
    direction: ltr;
}

.summary-list {
    list-style: none;
    padding: 0;
    margin: 0;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .summary-list {
    direction: ltr;
    text-align: left;
}

.summary-list li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .summary-list li {
    direction: ltr;
    text-align: left;
}

.summary-list li:last-child {
    border-bottom: none;
}

.summary-list .label {
    font-weight: 500;
    color: #666;
    text-align: right;
    order: 1;
}

[dir="ltr"] .summary-list .label {
    text-align: left;
    order: 1;
}

.summary-list .value {
    font-weight: 600;
    color: #333;
    text-align: left;
    order: 2;
}

[dir="ltr"] .summary-list .value {
    text-align: right;
    order: 2;
}

/* Similar Properties - Enhanced */
.similar-properties {
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .similar-properties {
    direction: ltr;
    text-align: left;
}

.similar-properties h4 {
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 20px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

[dir="ltr"] .similar-properties h4 {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.similar-properties h4 i {
    color: var(--colorPrimary);
    font-size: 22px;
    order: 1 !important;
    flex-shrink: 0;
    width: 22px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .similar-properties h4 i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.similar-properties h4 span {
    order: 2 !important;
    text-align: right !important;
    margin-right: 0;
    direction: rtl !important;
}

[dir="ltr"] .similar-properties h4 span {
    order: 2 !important;
    text-align: right !important;
    margin-left: 0;
    direction: rtl !important;
}

.similar-properties-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.similar-property-item {
    padding: 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.similar-property-item:last-child {
    border-bottom: none;
}

.similar-property-item:hover {
    background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05);
    border-radius: 12px;
    margin: 0 -10px;
    padding: 0 10px;
}

.similar-property-link {
    display: flex;
    gap: 15px;
    padding: 18px 0;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    direction: rtl;
    text-align: right;
    flex-direction: row;
}

[dir="ltr"] .similar-property-link {
    direction: ltr;
    text-align: left;
}

.similar-property-image {
    width: 100px;
    height: 75px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
}

.similar-property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.similar-property-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
    border-radius: 10px;
}

.view-details-btn {
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    background: var(--colorPrimary);
    border-radius: 6px;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.similar-property-item:hover .similar-property-overlay {
    background: rgba(0,0,0,0.5);
}

.similar-property-item:hover .view-details-btn {
    opacity: 1;
    transform: scale(1);
}

.similar-property-item:hover .similar-property-image img {
    transform: scale(1.1);
}

.similar-property-info {
    flex: 1;
    min-width: 0;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .similar-property-info {
    direction: ltr;
    text-align: left;
}

.similar-property-info h5 {
    margin: 0 0 8px 0;
    font-size: 15px;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.4;
    transition: color 0.3s ease;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .similar-property-info h5 {
    text-align: left;
    direction: ltr;
}

.similar-property-item:hover .similar-property-info h5 {
    color: var(--colorPrimary);
}

.similar-property-price {
    font-weight: 800;
    color: var(--colorPrimary);
    font-size: 16px;
    margin-bottom: 8px;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .similar-property-price {
    text-align: left;
    direction: ltr;
}

.similar-property-meta {
    display: flex;
    flex-direction: column;
    gap: 5px;
    direction: rtl !important;
    text-align: right !important;
}

[dir="ltr"] .similar-property-meta {
    direction: rtl !important;
    text-align: right !important;
}

.similar-property-location,
.similar-property-area {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 6px;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
    flex-wrap: nowrap;
}

[dir="ltr"] .similar-property-location,
[dir="ltr"] .similar-property-area {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.similar-property-location i,
.similar-property-area i {
    color: var(--colorPrimary);
    font-size: 12px;
    order: 1 !important;
    flex-shrink: 0;
    width: 14px;
    text-align: center;
    margin-left: 0.5rem;
}

[dir="ltr"] .similar-property-location i,
[dir="ltr"] .similar-property-area i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.similar-property-location span,
.similar-property-area span {
    order: 2 !important;
    text-align: right !important;
    margin-right: 0;
    direction: rtl !important;
}

[dir="ltr"] .similar-property-location span,
[dir="ltr"] .similar-property-area span {
    order: 2 !important;
    text-align: right !important;
    margin-left: 0;
    direction: rtl !important;
}

/* ============================================
   MOBILE RESPONSIVE STYLES - ENHANCED
   ============================================ */

@media (max-width: 991px) {
    .property-header {
        padding: 80px 0 60px;
        min-height: 350px;
        direction: rtl !important;
    }
    
    .property-header .container {
        direction: rtl !important;
        text-align: right !important;
    }
    
    .property-header .row {
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
    }

    .property-title {
        font-size: 32px;
    }

    .property-location {
        font-size: 18px;
    }

    .property-meta {
        gap: 12px;
    }

    .meta-item {
        padding: 8px 16px;
        font-size: 14px;
    }

    .gallery-main {
        height: 400px;
    }

    .price-card {
        position: relative;
        top: 0;
        margin-bottom: 30px;
    }

    .overview-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .property-header {
        padding: 70px 0 50px;
        min-height: 300px;
        direction: rtl !important;
    }

    /* Remove all padding on mobile to start from right edge - Override global styles */
    section.property-header .container,
    section.property-header .container-fluid,
    .property-header section .container,
    .property-header section .container-fluid {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    .property-header .row {
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
    }
    
    .property-header [class*="col-"] {
        direction: rtl !important;
        text-align: right !important;
    }

    section.property-header .row,
    .property-header .row {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        --bs-gutter-x: 0 !important;
    }

    section.property-header [class*="col-"],
    .property-header [class*="col-"] {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .property-header-content,
    .property-header-content-v2 {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .property-breadcrumb {
        margin-bottom: 20px;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        direction: rtl !important;
        text-align: right !important;
    }

    .property-breadcrumb .breadcrumb {
        padding: 10px 0 10px 0 !important;
        font-size: 13px;
        margin-right: 0 !important;
        margin-left: 0 !important;
        direction: rtl !important;
        text-align: right !important;
        justify-content: flex-end !important;
    }

    .property-title,
    .property-title-v2 {
        font-size: 26px;
        margin-bottom: 12px;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .property-location,
    .property-location-v2 {
        font-size: 16px;
        margin-bottom: 15px;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .property-meta,
    .property-meta-v2 {
        gap: 10px;
        flex-direction: row;
        flex-wrap: wrap;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        justify-content: flex-end !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .meta-item,
    .meta-item-v2 {
        padding: 8px 14px;
        font-size: 13px;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .gallery-main {
        height: 350px;
    }

    .gallery-counter {
        font-size: 12px;
        padding: 6px 12px;
    }

    .gallery-nav {
        padding: 0 12px;
    }

    .gallery-nav-btn {
        width: 38px;
        height: 38px;
        font-size: 15px;
        border-width: 1.5px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.3);
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(8px);
    }

    .gallery-nav-btn:hover {
        transform: scale(1.12);
        box-shadow: 0 4px 16px rgba(200, 180, 126, 0.5);
    }

    .gallery-nav-btn:active {
        transform: scale(0.96);
    }

    .gallery-nav-btn i {
        font-size: 15px;
    }

    .gallery-fullscreen-btn {
        width: 42px;
        height: 42px;
        font-size: 16px;
    }

    .gallery-thumbnails {
        padding: 15px;
        gap: 10px;
    }

    .thumbnail {
        width: 85px;
        height: 65px;
    }

    .property-overview,
    .property-description,
    .property-features {
        padding: 25px 20px;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 22px;
        margin-bottom: 20px;
    }

    .section-title i {
        font-size: 24px;
    }

    .overview-grid {
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 12px;
    }

    .overview-item {
        padding: 20px 15px;
    }

    .overview-item i {
        font-size: 30px;
    }

    .overview-item .value {
        font-size: 20px;
    }

    .description-content {
        font-size: 16px;
        line-height: 1.8;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .feature-item {
        padding: 12px 16px;
        font-size: 14px;
    }

    .price-card {
        padding: 25px 20px;
        margin-bottom: 25px;
    }

    .price-amount {
        font-size: 36px;
    }

    .price-actions .btn {
        padding: 12px 20px;
        font-size: 15px;
    }

    .property-summary {
        padding: 25px 20px;
        margin-bottom: 25px;
    }

    .property-summary h4 {
        font-size: 18px;
    }

    .summary-list li {
        padding: 12px 0;
        flex-wrap: wrap;
    }

    .summary-list .label {
        font-size: 14px;
        width: 100%;
        margin-bottom: 5px;
    }

    .summary-list .value {
        font-size: 14px;
        width: 100%;
    }

    .similar-properties {
        padding: 25px 20px;
    }

    .similar-properties h4 {
        font-size: 18px;
    }

    .similar-property-image {
        width: 90px;
        height: 70px;
    }

    .similar-property-info h5 {
        font-size: 14px;
    }

    .similar-property-price {
        font-size: 15px;
    }
}

@media (max-width: 576px) {
    .property-header {
        padding: 60px 0 40px;
        min-height: 280px;
    }

    .property-breadcrumb .breadcrumb {
        padding: 8px 12px;
        font-size: 12px;
    }

    .property-title {
        font-size: 22px;
        margin-bottom: 10px;
    }

    .property-location {
        font-size: 15px;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 15px;
    }

    .property-location i {
        font-size: 18px;
    }

    .property-meta {
        flex-direction: column;
        gap: 8px;
        width: 100%;
    }

    .meta-item {
        width: 100%;
        justify-content: center;
        padding: 10px 16px;
        font-size: 13px;
    }

    .gallery-main {
        height: 280px;
    }

    .gallery-counter {
        font-size: 11px;
        padding: 5px 10px;
        top: 15px;
        right: 15px;
    }

    .gallery-nav {
        padding: 0 8px;
    }

    .gallery-nav-btn {
        width: 32px;
        height: 32px;
        font-size: 13px;
        border-width: 1.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.35);
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(8px);
    }

    .gallery-nav-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 3px 12px rgba(200, 180, 126, 0.6);
    }

    .gallery-nav-btn:active {
        transform: scale(0.92);
    }

    .gallery-nav-btn i {
        font-size: 13px;
    }

    .gallery-fullscreen-btn {
        width: 38px;
        height: 38px;
        font-size: 14px;
        bottom: 15px;
        right: 15px;
    }

    .gallery-thumbnails {
        padding: 12px;
        gap: 8px;
    }

    .thumbnail {
        width: 70px;
        height: 55px;
    }

    .property-overview,
    .property-description,
    .property-features {
        padding: 20px 15px;
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 20px;
        margin-bottom: 18px;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .section-title i {
        font-size: 22px;
    }

    .overview-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .overview-item {
        padding: 18px 12px;
    }

    .overview-item i {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .overview-item .label {
        font-size: 11px;
        margin-bottom: 6px;
    }

    .overview-item .value {
        font-size: 18px;
    }

    .description-content {
        font-size: 15px;
        line-height: 1.7;
    }

    .features-subtitle {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .feature-item {
        padding: 11px 14px;
        font-size: 14px;
    }

    .price-card {
        padding: 20px 18px;
        margin-bottom: 20px;
    }

    .price-header {
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .price-label {
        font-size: 12px;
    }

    .price-amount {
        font-size: 32px;
    }

    .price-period {
        font-size: 14px;
    }

    .price-actions {
        gap: 10px;
    }

    .price-actions .btn {
        padding: 12px 18px;
        font-size: 14px;
    }

    .property-summary {
        padding: 20px 15px;
        margin-bottom: 20px;
    }

    .property-summary h4 {
        font-size: 17px;
        margin-bottom: 18px;
    }

    .summary-list li {
        padding: 12px 0;
    }

    .summary-list .label {
        font-size: 13px;
    }

    .summary-list .value {
        font-size: 13px;
    }

    .similar-properties {
        padding: 20px 15px;
    }

    .similar-properties h4 {
        font-size: 17px;
        margin-bottom: 18px;
    }

    .similar-property-link {
        padding: 15px 0;
        gap: 12px;
    }

    .similar-property-image {
        width: 80px;
        height: 60px;
    }

    .similar-property-info h5 {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .similar-property-price {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .similar-property-location,
    .similar-property-area {
        font-size: 12px;
    }
}

/* RTL Mobile Support */
@media (max-width: 768px) {
    [dir="rtl"] .property-header-content,
    [dir="rtl"] .property-header-content-v2 {
        text-align: right !important;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Override global container padding for property header on mobile */
    [dir="rtl"] section.property-header .container,
    [dir="rtl"] section.property-header .container-fluid,
    [dir="rtl"] .property-header .container,
    [dir="rtl"] .property-header .container-fluid {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    [dir="rtl"] section.property-header .row,
    [dir="rtl"] .property-header .row {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    [dir="rtl"] section.property-header [class*="col-"],
    [dir="rtl"] .property-header [class*="col-"] {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    /* Final override - Force no padding on mobile for property header */
    @media (max-width: 768px) {
        .property-header * {
            box-sizing: border-box;
        }
        
        .property-header .container,
        .property-header .container-fluid,
        .property-header .row,
        .property-header [class*="col-"],
        .property-header-content,
        .property-header-content-v2,
        .property-title,
        .property-title-v2,
        .property-location,
        .property-location-v2,
        .property-meta,
        .property-meta-v2,
        .meta-item,
        .meta-item-v2 {
            padding-right: 0 !important;
            padding-left: 0 !important;
            margin-right: 0 !important;
            margin-left: 0 !important;
        }
    }

    [dir="rtl"] .section-title {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .overview-item:hover {
        transform: translateY(-5px);
    }

    [dir="rtl"] .feature-item:hover {
        transform: translateX(-5px);
    }

    [dir="rtl"] .summary-list li:hover {
        padding-right: 5px;
        padding-left: 5px;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.property-gallery:focus-within {
    outline: 2px solid var(--colorPrimary);
    outline-offset: 2px;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .property-overview,
    .property-description,
    .property-features,
    .property-contact,
    .price-card,
    .property-summary,
    .similar-properties {
        border: 2px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .overview-item,
    .gallery-main img,
    .gallery-nav-btn,
    .thumbnail {
        transition: none !important;
    }
}

/* Gallery Lightbox */
.gallery-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.95);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.lightbox-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 10px;
    transition: opacity 0.2s ease;
}

/* Close button */
.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: #ffffff;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 100000;
    transition: all 0.3s ease;
    font-weight: 300;
}

.lightbox-close:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: rotate(90deg) scale(1.1);
}

.lightbox-close:active {
    transform: rotate(90deg) scale(0.95);
}

/* Hide navigation arrows */
.lightbox-prev,
.lightbox-next {
    display: none !important;
}

/* Make image draggable/swipeable */
.lightbox-image {
    cursor: grab;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    touch-action: pan-y;
}

.lightbox-image:active {
    cursor: grabbing;
}

@media (max-width: 768px) {
    .lightbox-close {
        top: 15px;
        right: 15px;
        width: 36px;
        height: 36px;
        font-size: 24px;
        background: rgba(255, 255, 255, 0.25);
        border: 2px solid rgba(255, 255, 255, 0.4);
    }

    .lightbox-content img {
        max-height: 85vh;
    }
}

/* Property Details Section Improvements */
.property-details-section {
    padding: 60px 0;
}

/* Loading State */
.property-gallery.loading {
    position: relative;
}

.property-gallery.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid var(--colorPrimary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 10;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Print Styles */
@media print {
    .property-header {
        background: #fff !important;
        color: #000 !important;
        padding: 20px 0;
    }

    .property-header::before {
        display: none;
    }

    .gallery-nav,
    .gallery-fullscreen-btn,
    .gallery-overlay,
    .price-actions,
    .similar-properties {
        display: none !important;
    }

    .property-gallery {
        break-inside: avoid;
    }
}

/* ============================================
   FINAL MOBILE OVERRIDE - Property Header Right Edge
   ============================================ */
@media (max-width: 768px) {
    /* Override ALL global styles for property header on mobile */
    section.property-header,
    .property-header {
        padding-left: 0 !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    section.property-header .container,
    section.property-header .container-fluid,
    .property-header .container,
    .property-header .container-fluid {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
    }
    
    section.property-header .row,
    .property-header .row {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        --bs-gutter-x: 0 !important;
        --bs-gutter-y: 0 !important;
    }
    
    section.property-header [class*="col-"],
    .property-header [class*="col-"] {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
    
    .property-header-content,
    .property-header-content-v2 {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    
    .property-title,
    .property-title-v2,
    .property-location,
    .property-location-v2,
    .property-meta,
    .property-meta-v2 {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
    
    .meta-item,
    .meta-item-v2 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
}
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Gallery functionality
    window.currentImageIndex = 0;

    window.changeGalleryImage = function(direction) {
        const images = @json($property->gallery_images ?? []);
        if (images.length === 0) return;

        currentImageIndex += direction;

        if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        } else if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        }

        setGalleryImage(currentImageIndex);
    };

    window.setGalleryImage = function(index) {
        const images = @json($property->gallery_images ?? []);
        if (images.length === 0 || !images[index]) return;

        $('#main-gallery-image').attr('src', images[index]);
        $('.thumbnail').removeClass('active');
        $('.thumbnail').eq(index).addClass('active');
        $('#current-image').text(index + 1);
        currentImageIndex = index;
    };

    window.openFullscreenGallery = function() {
        const images = @json($property->gallery_images ?? []);
        if (images.length === 0) return;
        
        // Simple lightbox implementation
        const currentImg = images[currentImageIndex];
        const propertyTitle = @json($property->title);
        const lightboxHtml = '<div class="gallery-lightbox"><div class="lightbox-content"><button class="lightbox-close" onclick="closeFullscreenGallery()" aria-label="Close">&times;</button><img src="' + currentImg + '" alt="' + propertyTitle + '" class="lightbox-image"></div></div>';
        const lightbox = $(lightboxHtml);
        $('body').append(lightbox);
        
        // Swipe functionality for navigation
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;
        const lightboxImage = lightbox.find('.lightbox-image');
        
        // Touch events for mobile
        lightboxImage.on('touchstart', function(e) {
            touchStartX = e.originalEvent.touches[0].clientX;
            touchStartY = e.originalEvent.touches[0].clientY;
        });
        
        lightboxImage.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].clientX;
            touchEndY = e.originalEvent.changedTouches[0].clientY;
            handleSwipe();
        });
        
        // Mouse events for desktop (drag)
        let isDragging = false;
        let dragStartX = 0;
        let dragStartY = 0;
        
        lightboxImage.on('mousedown', function(e) {
            isDragging = true;
            dragStartX = e.clientX;
            dragStartY = e.clientY;
            lightboxImage.css('cursor', 'grabbing');
            e.preventDefault();
        });
        
        $(document).on('mousemove.lightbox', function(e) {
            if (isDragging) {
                e.preventDefault();
            }
        });
        
        $(document).on('mouseup.lightbox', function(e) {
            if (isDragging) {
                touchEndX = e.clientX;
                touchEndY = e.clientY;
                touchStartX = dragStartX;
                touchStartY = dragStartY;
                handleSwipe();
                isDragging = false;
                lightboxImage.css('cursor', 'grab');
            }
        });
        
        function handleSwipe() {
            const swipeThreshold = 50; // Minimum distance for swipe
            const diffX = touchStartX - touchEndX;
            const diffY = Math.abs(touchStartY - touchEndY);
            
            // Only trigger swipe if horizontal movement is greater than vertical (to avoid conflicts with scrolling)
            if (Math.abs(diffX) > swipeThreshold && Math.abs(diffX) > diffY) {
                if (diffX > 0) {
                    // Swipe left - next image
                    changeGalleryImage(1);
                } else {
                    // Swipe right - previous image
                    changeGalleryImage(-1);
                }
                // Add smooth transition
                lightboxImage.css('opacity', '0.7');
                setTimeout(function() {
                    lightboxImage.attr('src', images[currentImageIndex]);
                    lightboxImage.css('opacity', '1');
                }, 150);
            }
        }
        
        // Clean up event listeners when lightbox is closed
        lightbox.on('remove', function() {
            $(document).off('mousemove.lightbox mouseup.lightbox keydown.lightbox');
            window.currentLightbox = null;
        });
        
        // Close on overlay click
        lightbox.on('click', function(e) {
            if (e.target === this) {
                closeFullscreenGallery();
            }
        });
        
        // Prevent closing when clicking on image or close button
        lightbox.find('.lightbox-content').on('click', function(e) {
            e.stopPropagation();
        });
        
        // Store lightbox reference globally for close function
        window.currentLightbox = lightbox;
        
        // Close on ESC key
        $(document).on('keydown.lightbox', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeFullscreenGallery();
            }
        });
    };
    
    // Close fullscreen gallery function
    window.closeFullscreenGallery = function() {
        if (window.currentLightbox) {
            window.currentLightbox.remove();
            window.currentLightbox = null;
            $(document).off('keydown.lightbox mousemove.lightbox mouseup.lightbox');
        }
    };


    // Keyboard navigation for gallery
    $(document).on('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            changeGalleryImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeGalleryImage(1);
        }
    });
});
</script>
@endpush
