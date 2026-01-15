@extends('layouts.client.layout')

@section('title')
    <title>{{ __('Real Estate Properties') }} - {{ $setting?->app_name }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('Find your perfect property - apartments, villas, offices, and more for sale and rent') }}">
@endsection

@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Real Estate Properties') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Real Estate Properties') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!-- Introduction Section Start -->
<section class="real-estate-intro pt_100 pb_80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="intro-content">
                    <div class="section-title-wrapper">
                        <span class="section-subtitle">{{ __('Real Estate Department') }}</span>
                        <h2 class="section-title">{{ __('Your Trusted Partner in Real Estate') }}</h2>
                    </div>
                    <p class="intro-text">
                        {{ __('We provide comprehensive real estate services including property sales, rentals, legal consultations, and investment advice. Our experienced team helps you find the perfect property or sell your assets with confidence.') }}
                    </p>
                    <div class="intro-features">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="feature-content">
                                <h4>{{ __('Wide Selection') }}</h4>
                                <p>{{ __('Apartments, villas, offices, and commercial properties') }}</p>
                            </div>
                        </div>
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>{{ __('Legal Protection') }}</h4>
                                <p>{{ __('Full legal support and contract review') }}</p>
                            </div>
                        </div>
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="feature-content">
                                <h4>{{ __('Expert Guidance') }}</h4>
                                <p>{{ __('Professional advice from experienced real estate specialists') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="intro-image">
                    <div class="image-wrapper">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon-wrapper">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="placeholder-text">
                                    <h3>{{ __('Real Estate') }}</h3>
                                    <p>{{ __('Your Trusted Partner') }}</p>
                                </div>
                                <div class="placeholder-pattern"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Introduction Section End -->

<!-- Properties Filter Start -->
<section class="properties-filter pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="properties-filter-content">
                    <form action="{{ route('website.real-estate') }}" method="GET" class="properties-filter-form">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">{{ __('Search') }}</label>
                                    <div class="search-input-wrapper">
                                        <input type="text" name="search" class="form-control" placeholder="{{ __('Search properties...') }}" value="{{ request('search') }}">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">{{ __('Property Type') }}</label>
                                    <select name="property_type" class="form-select">
                                        <option value="">{{ __('All Types') }}</option>
                                        @foreach($propertyTypes as $key => $type)
                                            <option value="{{ $key }}" {{ request('property_type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">{{ __('Listing Type') }}</label>
                                    <select name="listing_type" class="form-select">
                                        <option value="">{{ __('All Listings') }}</option>
                                        <option value="sale" {{ request('listing_type') == 'sale' ? 'selected' : '' }}>{{ __('For Sale') }}</option>
                                        <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>{{ __('For Rent') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">{{ __('City') }}</label>
                                    <select name="city" class="form-select">
                                        <option value="">{{ __('All Cities') }}</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">{{ __('Sort By') }}</label>
                                    <select name="sort" class="form-select">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>{{ __('Latest First') }}</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                                        <option value="area" {{ request('sort') == 'area' ? 'selected' : '' }}>{{ __('Largest Area') }}</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest First') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-6">
                                <div class="form-group">
                                    <label class="filter-label d-none d-md-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search d-md-none"></i>
                                        <span class="d-none d-md-inline">{{ __('Search') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if(request()->hasAny(['search', 'property_type', 'listing_type', 'city', 'sort']))
                            <div class="row mt-3">
                                <div class="col-12">
                                    <a href="{{ route('website.real-estate') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times"></i> {{ __('Clear Filters') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Properties Filter End -->

<!-- Results Count Start -->
@if($properties->total() > 0)
<section class="results-count-section pt_30 pb_30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="results-info">
                    <div class="results-content">
                        <i class="fas fa-building"></i>
                        <div>
                            <strong>{{ __('Found') }} {{ $properties->total() }} {{ __('properties') }}</strong>
                            @if(request()->hasAny(['search', 'property_type', 'listing_type', 'city']))
                                <span class="text-muted">{{ __('for your search') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Results Count End -->

<!-- Properties Grid Start -->
<section class="properties-grid pt_50 pb_100">
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="property-card">
                        <div class="property-image">
                            <img src="{{ $property->main_image_url }}" alt="{{ $property->title }}" class="img-fluid">
                            <div class="property-badges">
                                <span class="badge {{ $property->listing_type === 'sale' ? 'badge-sale' : 'badge-rent' }}">{{ $property->listing_type_label }}</span>
                                @if($property->featured)
                                    <span class="badge badge-featured">{{ __('Featured') }}</span>
                                @endif
                            </div>
                            <div class="property-overlay">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-light">
                                    <i class="fas fa-eye"></i> {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                        <div class="property-content">
                            <h4 class="property-title">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}">{{ Str::limit($property->title, 50) }}</a>
                            </h4>
                            <div class="property-meta">
                                <span class="property-type">
                                    <i class="fas fa-building"></i> {{ $property->property_type_label }}
                                </span>
                                <span class="property-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $property->location_string }}
                                </span>
                            </div>
                            <div class="property-details">
                                @if($property->bedrooms)
                                    <span class="detail-item">
                                        <i class="fas fa-bed"></i> {{ $property->bedrooms }} {{ __('Beds') }}
                                    </span>
                                @endif
                                @if($property->bathrooms)
                                    <span class="detail-item">
                                        <i class="fas fa-bath"></i> {{ $property->bathrooms }} {{ __('Baths') }}
                                    </span>
                                @endif
                                <span class="detail-item">
                                    <i class="fas fa-expand-arrows-alt"></i> {{ $property->formatted_area }}
                                </span>
                            </div>
                            <div class="property-price">
                                <strong class="price-amount">{{ $property->formatted_price }}</strong>
                                @if($property->price_per_sqm)
                                    <small class="price-per-sqm">({{ number_format($property->price_per_sqm) }} {{ $property->currency }}/m²)</small>
                                @endif
                            </div>
                            <div class="property-actions">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-info-circle"></i> {{ __('Details') }}
                                </a>
                                <a href="{{ route('website.book.consultation.appointment') }}?service=real_estate&property={{ $property->id }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-calendar-alt"></i> {{ __('Consultation') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-properties">
                        <div class="no-properties-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>{{ __('No Properties Found') }}</h3>
                        <p class="text-muted">{{ __('Try adjusting your search criteria or browse all properties.') }}</p>
                        <a href="{{ route('website.real-estate') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> {{ __('Browse All Properties') }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($properties->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <div class="pagination-wrapper">
                        {{ $properties->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- Properties Grid End -->

@endsection

@push('css')
<style>
/* ============================================
   REAL ESTATE PAGE STYLES
   ============================================ */

/* Introduction Section - Enhanced Design */
.real-estate-intro {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
    padding: 100px 0 80px;
}

.real-estate-intro::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.08) 0%, rgba(200, 180, 126, 0.15) 100%);
    z-index: 0;
    border-radius: 0 0 0 100px;
}

.real-estate-intro::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(200, 180, 126, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

[dir="rtl"] .real-estate-intro::before {
    right: auto;
    left: 0;
    border-radius: 0 0 100px 0;
}

[dir="rtl"] .real-estate-intro::after {
    left: auto;
    right: -50px;
}

.intro-content {
    position: relative;
    z-index: 1;
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.section-title-wrapper {
    margin-bottom: 2.5rem;
    position: relative;
}

.section-subtitle {
    display: inline-block;
    color: var(--colorPrimary);
    font-size: 0.95rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 1rem;
    padding: 0.5rem 1.2rem;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.1) 0%, rgba(200, 180, 126, 0.05) 100%);
    border-radius: 30px;
    border: 2px solid rgba(200, 180, 126, 0.2);
    position: relative;
    overflow: hidden;
}

.section-subtitle::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.section-subtitle:hover::before {
    left: 100%;
}

.section-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    position: relative;
    padding-bottom: 1rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 2px;
}

[dir="rtl"] .section-title::after {
    left: auto;
    right: 0;
}

.intro-text {
    font-size: 1.15rem;
    line-height: 1.9;
    color: #555;
    margin-bottom: 3rem;
    text-align: justify;
}

[dir="rtl"] .intro-text {
    text-align: right;
}

.intro-features {
    display: flex;
    flex-direction: column;
    gap: 1.8rem;
}

.feature-box {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(200, 180, 126, 0.1);
    position: relative;
    overflow: hidden;
}

.feature-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.feature-box:hover::before {
    transform: scaleY(1);
}

[dir="rtl"] .feature-box::before {
    left: auto;
    right: 0;
}

.feature-box:hover {
    transform: translateX(8px) translateY(-4px);
    box-shadow: 0 8px 30px rgba(200, 180, 126, 0.2);
    border-color: rgba(200, 180, 126, 0.3);
}

[dir="rtl"] .feature-box:hover {
    transform: translateX(-8px) translateY(-4px);
}

.feature-icon {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 16px;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.feature-icon::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.3s ease, height 0.3s ease;
}

.feature-box:hover .feature-icon::before {
    width: 100px;
    height: 100px;
}

.feature-box:hover .feature-icon {
    transform: rotate(5deg) scale(1.05);
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.4);
}

.feature-icon i {
    font-size: 2rem;
    color: white;
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease;
}

.feature-box:hover .feature-icon i {
    transform: scale(1.1);
}

.feature-content {
    flex: 1;
}

.feature-content h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.75rem;
    transition: color 0.3s ease;
}

.feature-box:hover .feature-content h4 {
    color: var(--colorPrimary);
}

.feature-content p {
    font-size: 1rem;
    color: #666;
    margin: 0;
    line-height: 1.7;
    transition: color 0.3s ease;
}

.feature-box:hover .feature-content p {
    color: #555;
}

.intro-image {
    position: relative;
    z-index: 1;
    animation: fadeInRight 1s ease-out;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

[dir="rtl"] .intro-image {
    animation: fadeInLeft 1s ease-out;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.image-wrapper {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0,0,0,0.15);
    transition: all 0.4s ease;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    min-height: 500px;
}

.image-wrapper:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(200, 180, 126, 0.3);
}

.image-placeholder {
    width: 100%;
    height: 100%;
    min-height: 500px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    position: relative;
    overflow: hidden;
    padding: 60px 40px;
}

.image-placeholder::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

.image-placeholder::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 50%);
    z-index: 1;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.placeholder-content {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 100%;
}

.placeholder-icon-wrapper {
    width: 150px;
    height: 150px;
    margin: 0 auto 30px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    transition: all 0.4s ease;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
}

.image-wrapper:hover .placeholder-icon-wrapper {
    transform: scale(1.1) translateY(-10px);
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
}

.placeholder-icon-wrapper i {
    font-size: 5rem;
    color: white;
    opacity: 0.95;
    transition: all 0.4s ease;
}

.image-wrapper:hover .placeholder-icon-wrapper i {
    transform: scale(1.1) rotate(5deg);
    opacity: 1;
}

.placeholder-text {
    color: white;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.placeholder-text h3 {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 0 0 10px 0;
    color: white;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.image-wrapper:hover .placeholder-text h3 {
    transform: scale(1.05);
}

.placeholder-text p {
    font-size: 1.2rem;
    font-weight: 500;
    margin: 0;
    opacity: 0.95;
    letter-spacing: 0.5px;
}

.placeholder-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.03) 10px, rgba(255,255,255,0.03) 20px),
        repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255,255,255,0.03) 10px, rgba(255,255,255,0.03) 20px);
    z-index: 1;
    opacity: 0.5;
}

/* Additional decorative elements */
.image-placeholder {
    background-image: 
        radial-gradient(circle at 30% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
}

/* Responsive adjustments for better display */
@media (max-width: 992px) {
    .image-wrapper {
        min-height: 400px;
    }

    .image-placeholder {
        min-height: 400px;
        padding: 50px 35px;
    }

    .placeholder-icon-wrapper {
        width: 130px;
        height: 130px;
    }

    .placeholder-icon-wrapper i {
        font-size: 4.5rem;
    }

    .placeholder-text h3 {
        font-size: 2rem;
    }

    .placeholder-text p {
        font-size: 1.1rem;
    }
}

/* RTL Support for Introduction Section */
[dir="rtl"] .intro-content {
    text-align: right;
}

[dir="rtl"] .section-title {
    text-align: right;
}

[dir="rtl"] .section-title::after {
    left: auto;
    right: 0;
}

[dir="rtl"] .feature-content h4,
[dir="rtl"] .feature-content p {
    text-align: right;
}

/* RTL Support for Image Placeholder */
[dir="rtl"] .placeholder-content {
    text-align: center;
}

[dir="rtl"] .placeholder-text {
    text-align: center;
}

/* Properties Filter Section */
.properties-filter {
    background: #fff;
    border-bottom: 1px solid #e9ecef;
}

.properties-filter-content {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.filter-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group {
    margin-bottom: 0;
}

.form-control,
.form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #fff;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--colorPrimary);
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1);
    outline: none;
}

.search-input-wrapper {
    position: relative;
}

.search-input-wrapper i {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--colorPrimary);
    font-size: 1rem;
    pointer-events: none;
}

[dir="rtl"] .search-input-wrapper i {
    right: auto;
    left: 15px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(200, 180, 126, 0.3);
}

/* Results Count Section */
.results-count-section {
    background: #f8f9fa;
}

.results-info {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
    padding: 1.2rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.2);
}

.results-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.results-content i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.results-content strong {
    font-size: 1.1rem;
    font-weight: 600;
}

.results-content .text-muted {
    color: rgba(255, 255, 255, 0.8) !important;
    font-size: 0.95rem;
}

/* Property Card */
.property-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.property-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.property-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    background: #f8f9fa;
}

.property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.property-card:hover .property-image img {
    transform: scale(1.1);
}

.property-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 2;
}

[dir="rtl"] .property-badges {
    left: auto;
    right: 15px;
}

.badge {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-sale {
    background: #28a745;
    color: white;
}

.badge-rent {
    background: #17a2b8;
    color: white;
}

.badge-featured {
    background: #ffc107;
    color: #333;
}

.property-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.property-card:hover .property-overlay {
    opacity: 1;
}

.property-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .property-content {
    direction: ltr;
    text-align: left;
}

.property-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .property-title {
    text-align: left;
    direction: ltr;
}

.property-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.property-title a:hover {
    color: var(--colorPrimary);
}

.property-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: #666;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .property-meta {
    text-align: left;
    direction: ltr;
}

.property-type,
.property-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: flex-start;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .property-type,
[dir="ltr"] .property-location {
    direction: ltr;
    text-align: left;
    justify-content: flex-start;
}

.property-type i,
.property-location i {
    color: var(--colorPrimary);
    width: 16px;
    flex-shrink: 0;
    order: 2;
}

[dir="ltr"] .property-type i,
[dir="ltr"] .property-location i {
    order: 1;
}

.property-type span,
.property-location span {
    order: 1;
    flex: 1;
    text-align: right;
}

[dir="ltr"] .property-type span,
[dir="ltr"] .property-location span {
    order: 2;
    text-align: left;
}

.property-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
    justify-content: flex-start;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .property-details {
    direction: ltr;
    text-align: left;
    justify-content: flex-start;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.9rem;
    color: #666;
    direction: rtl;
    text-align: right;
    justify-content: flex-start;
}

[dir="ltr"] .detail-item {
    direction: ltr;
    text-align: left;
    justify-content: flex-start;
}

.detail-item i {
    color: var(--colorPrimary);
    width: 16px;
    flex-shrink: 0;
    order: 2;
}

[dir="ltr"] .detail-item i {
    order: 1;
}

.detail-item span {
    order: 1;
    text-align: right;
}

[dir="ltr"] .detail-item span {
    order: 2;
    text-align: left;
}

.property-price {
    margin-bottom: 1.5rem;
    text-align: right;
    direction: rtl;
}

[dir="ltr"] .property-price {
    text-align: left;
    direction: ltr;
}

.price-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--colorPrimary);
    display: block;
    text-align: right;
}

[dir="ltr"] .price-amount {
    text-align: left;
}

.price-per-sqm {
    font-size: 0.85rem;
    color: #999;
    display: block;
    margin-top: 0.25rem;
    text-align: right;
}

[dir="ltr"] .price-per-sqm {
    text-align: left;
}

.property-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: auto;
    justify-content: flex-start;
    direction: rtl;
}

[dir="ltr"] .property-actions {
    direction: ltr;
    justify-content: flex-start;
}

.property-actions .btn {
    flex: 1;
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    direction: rtl;
    text-align: right;
}

[dir="ltr"] .property-actions .btn {
    direction: ltr;
    text-align: left;
    justify-content: flex-start;
}

.property-actions .btn i {
    order: 2;
    flex-shrink: 0;
}

[dir="ltr"] .property-actions .btn i {
    order: 1;
}

.property-actions .btn span {
    order: 1;
    text-align: right;
}

[dir="ltr"] .property-actions .btn span {
    order: 2;
    text-align: left;
}

.property-actions .btn-outline-primary {
    border: 2px solid var(--colorPrimary);
    color: var(--colorPrimary);
}

.property-actions .btn-outline-primary:hover {
    background: var(--colorPrimary);
    color: white;
    transform: translateY(-2px);
}

.property-actions .btn-primary {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border: none;
    color: white;
}

.property-actions .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(200, 180, 126, 0.3);
}

/* No Properties */
.no-properties {
    text-align: center;
    padding: 4rem 2rem;
}

.no-properties-icon {
    font-size: 5rem;
    color: #ddd;
    margin-bottom: 1.5rem;
}

.no-properties h3 {
    font-size: 1.8rem;
    color: #666;
    margin-bottom: 1rem;
    font-weight: 600;
}

.no-properties p {
    font-size: 1.1rem;
    color: #999;
    margin-bottom: 2rem;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

.pagination-wrapper .pagination {
    margin: 0;
}

.pagination-wrapper .page-link {
    color: var(--colorPrimary);
    border-color: #e9ecef;
    padding: 0.75rem 1rem;
    margin: 0 0.25rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: var(--colorPrimary);
    color: white;
    border-color: var(--colorPrimary);
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-color: var(--colorPrimary);
    color: white;
}

/* ============================================
   RESPONSIVE STYLES
   ============================================ */

@media (max-width: 992px) {
    .real-estate-intro {
        padding: 80px 0 60px;
    }

    .section-title {
        font-size: 2.2rem;
    }

    .intro-text {
        font-size: 1.05rem;
    }

    .feature-box {
        padding: 1.5rem;
    }

    .feature-icon {
        width: 65px;
        height: 65px;
    }

    .feature-icon i {
        font-size: 1.7rem;
    }

    .properties-filter-content {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .real-estate-intro {
        padding: 60px 0 50px;
    }

    .real-estate-intro::before {
        width: 100%;
        border-radius: 0;
    }

    .section-title-wrapper {
        margin-bottom: 2rem;
    }

    .section-subtitle {
        font-size: 0.85rem;
        padding: 0.4rem 1rem;
        letter-spacing: 1.5px;
    }

    .section-title {
        font-size: 1.9rem;
        padding-bottom: 0.8rem;
    }

    .section-title::after {
        width: 60px;
        height: 3px;
    }

    .intro-text {
        font-size: 1rem;
        margin-bottom: 2.5rem;
        text-align: right;
    }

    [dir="rtl"] .intro-text {
        text-align: right;
    }

    .intro-features {
        gap: 1.2rem;
    }

    .feature-box {
        flex-direction: row;
        text-align: right;
        padding: 1.5rem;
        gap: 1.2rem;
    }

    [dir="rtl"] .feature-box {
        text-align: right;
    }

    .feature-box:hover {
        transform: translateY(-4px);
    }

    [dir="rtl"] .feature-box:hover {
        transform: translateY(-4px);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        margin: 0;
    }

    .feature-icon i {
        font-size: 1.6rem;
    }

    .feature-content h4 {
        font-size: 1.1rem;
    }

    .feature-content p {
        font-size: 0.95rem;
    }

    .image-wrapper {
        border-radius: 16px;
        min-height: 350px;
    }

    .image-placeholder {
        min-height: 350px;
        padding: 40px 25px;
    }

    .placeholder-icon-wrapper {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }

    .placeholder-icon-wrapper i {
        font-size: 3.5rem;
    }

    .placeholder-text h3 {
        font-size: 1.6rem;
    }

    .placeholder-text p {
        font-size: 0.95rem;
    }

    .image-placeholder {
        height: 350px;
    }

    .image-placeholder i {
        font-size: 5rem;
    }

    .properties-filter-content {
        padding: 1.2rem;
    }

    .filter-label {
        font-size: 0.8rem;
    }

    .property-image {
        height: 200px;
    }

    .property-content {
        padding: 1.2rem;
    }

    .property-title {
        font-size: 1.1rem;
    }

    .price-amount {
        font-size: 1.3rem;
    }

    .property-actions {
        flex-direction: column;
    }

    .property-actions .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .real-estate-intro {
        padding: 50px 0 40px;
    }

    .section-subtitle {
        font-size: 0.8rem;
        padding: 0.35rem 0.9rem;
        letter-spacing: 1px;
    }

    .section-title {
        font-size: 1.6rem;
        padding-bottom: 0.6rem;
    }

    .section-title::after {
        width: 50px;
        height: 3px;
    }

    .intro-text {
        font-size: 0.95rem;
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    .intro-features {
        gap: 1rem;
    }

    .feature-box {
        padding: 1.2rem;
        gap: 1rem;
    }

    .feature-icon {
        width: 55px;
        height: 55px;
    }

    .feature-icon i {
        font-size: 1.4rem;
    }

    .feature-content h4 {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .feature-content p {
        font-size: 0.9rem;
    }

    .image-wrapper {
        min-height: 350px;
    }

    .image-placeholder {
        min-height: 350px;
        padding: 40px 30px;
    }

    .placeholder-icon-wrapper {
        width: 120px;
        height: 120px;
        margin-bottom: 25px;
    }

    .placeholder-icon-wrapper i {
        font-size: 4rem;
    }

    .placeholder-text h3 {
        font-size: 1.8rem;
    }

    .placeholder-text p {
        font-size: 1rem;
    }

    .properties-filter-content {
        padding: 1rem;
    }

    .form-control,
    .form-select {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }

    .property-image {
        height: 180px;
    }

    .property-badges {
        top: 10px;
        left: 10px;
    }

    [dir="rtl"] .property-badges {
        right: 10px;
        left: auto;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }

    .property-content {
        padding: 1rem;
    }

    .property-details {
        gap: 0.75rem;
    }

    .no-properties {
        padding: 3rem 1rem;
    }

    .no-properties-icon {
        font-size: 4rem;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.property-card:focus-within {
    outline: 2px solid var(--colorPrimary);
    outline-offset: 2px;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .property-card {
        border: 2px solid #000;
    }

    .property-overlay {
        background: rgba(0,0,0,0.9);
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .property-card,
    .property-image img,
    .property-overlay,
    .feature-box,
    .form-control,
    .form-select,
    .btn,
    .intro-content,
    .intro-image,
    .image-wrapper,
    .image-wrapper img,
    .feature-icon,
    .feature-icon i,
    .section-subtitle::before {
        transition: none !important;
        animation: none !important;
    }

    .property-card:hover,
    .feature-box:hover,
    .image-wrapper:hover {
        transform: none;
    }

    .feature-box:hover .feature-icon {
        transform: none;
    }

    .image-placeholder::before {
        animation: none !important;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .real-estate-intro {
        background: #fff;
    }

    .feature-box {
        border: 2px solid #000;
    }

    .section-title {
        color: #000;
    }

    .intro-text {
        color: #333;
    }
}

/* Print Styles */
@media print {
    .real-estate-intro {
        background: #fff;
        padding: 2rem 0;
    }

    .intro-image,
    .image-wrapper {
        display: none;
    }

    .feature-box {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>
@endpush
