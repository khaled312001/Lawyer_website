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
                        <img src="{{ asset('client/img/real-estate-intro.jpg') }}" alt="{{ __('Real Estate') }}" class="img-fluid" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="image-placeholder" style="display: none;">
                            <i class="fas fa-building"></i>
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

/* Introduction Section */
.real-estate-intro {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}

.real-estate-intro::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.05) 0%, rgba(200, 180, 126, 0.1) 100%);
    z-index: 0;
}

[dir="rtl"] .real-estate-intro::before {
    right: auto;
    left: 0;
}

.intro-content {
    position: relative;
    z-index: 1;
}

.section-title-wrapper {
    margin-bottom: 2rem;
}

.section-subtitle {
    display: inline-block;
    color: var(--colorPrimary);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 1.5rem;
    line-height: 1.3;
}

.intro-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #666;
    margin-bottom: 2.5rem;
}

.intro-features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.feature-box {
    display: flex;
    align-items: flex-start;
    gap: 1.2rem;
    padding: 1.5rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.feature-box:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

[dir="rtl"] .feature-box:hover {
    transform: translateX(-5px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 12px;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.8rem;
    color: white;
}

.feature-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.feature-content p {
    font-size: 0.95rem;
    color: #666;
    margin: 0;
    line-height: 1.6;
}

.intro-image {
    position: relative;
    z-index: 1;
}

.image-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.image-wrapper img {
    width: 100%;
    height: auto;
    display: block;
}

.image-placeholder {
    width: 100%;
    height: 400px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.image-placeholder i {
    font-size: 5rem;
    opacity: 0.5;
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
}

.property-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
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
}

.property-type,
.property-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.property-type i,
.property-location i {
    color: var(--colorPrimary);
    width: 16px;
}

.property-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.9rem;
    color: #666;
}

.detail-item i {
    color: var(--colorPrimary);
    width: 16px;
}

.property-price {
    margin-bottom: 1.5rem;
}

.price-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--colorPrimary);
    display: block;
}

.price-per-sqm {
    font-size: 0.85rem;
    color: #999;
    display: block;
    margin-top: 0.25rem;
}

.property-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: auto;
}

.property-actions .btn {
    flex: 1;
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
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
    .section-title {
        font-size: 2rem;
    }

    .intro-text {
        font-size: 1rem;
    }

    .feature-box {
        padding: 1.2rem;
    }

    .properties-filter-content {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .real-estate-intro {
        padding: 3rem 0;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .intro-features {
        gap: 1rem;
    }

    .feature-box {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }

    .feature-icon {
        margin: 0 auto;
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
    .section-title {
        font-size: 1.5rem;
    }

    .intro-text {
        font-size: 0.95rem;
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
    .btn {
        transition: none !important;
    }

    .property-card:hover {
        transform: none;
    }
}
</style>
@endpush
