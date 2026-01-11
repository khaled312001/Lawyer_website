@extends('layouts.client.layout')

@section('title')
    <title>{{ __('Real Estate') }} - {{ $setting?->app_name }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('Find your perfect property from our extensive real estate listings') }}">
@endsection

@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Real Estate') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Real Estate') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!-- Real Estate Listings Start -->
<section class="real-estate-listings pt_100 pb_100">
    <div class="container">
        <!-- Search and Filters -->
        <div class="row mb_50">
            <div class="col-12">
                <div class="real-estate-filters">
                    <form action="{{ route('website.real-estate') }}" method="GET" class="filter-form">
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-3">
                                <div class="search-input-wrapper">
                                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search properties...') }}" value="{{ request('search') }}">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="col-md-2">
                                <select name="type" class="form-select">
                                    <option value="">{{ __('All Types') }}</option>
                                    @foreach($propertyTypes as $key => $label)
                                        <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Listing Type -->
                            <div class="col-md-2">
                                <select name="listing" class="form-select">
                                    <option value="">{{ __('All Listings') }}</option>
                                    <option value="sale" {{ request('listing') == 'sale' ? 'selected' : '' }}>{{ __('For Sale') }}</option>
                                    <option value="rent" {{ request('listing') == 'rent' ? 'selected' : '' }}>{{ __('For Rent') }}</option>
                                </select>
                            </div>

                            <!-- City -->
                            <div class="col-md-2">
                                <select name="city" class="form-select">
                                    <option value="">{{ __('All Cities') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort -->
                            <div class="col-md-2">
                                <select name="sort" class="form-select">
                                    <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>{{ __('Latest') }}</option>
                                    <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>{{ __('Featured') }}</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                                    <option value="area" {{ request('sort') == 'area' ? 'selected' : '' }}>{{ __('Largest Area') }}</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="row mb_30">
            <div class="col-12">
                <div class="results-info">
                    <h4 class="mb-0">
                        <i class="fas fa-home me-2"></i>
                        {{ __('Found') }} {{ $properties->total() }} {{ __('properties') }}
                        @if(request()->hasAny(['search', 'type', 'listing', 'city']))
                            {{ __('for your search') }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

        <!-- Properties Grid -->
        @if($properties->count() > 0)
            <div class="row">
                @foreach($properties as $property)
                    <div class="col-lg-4 col-md-6 mb_30">
                        <div class="property-card">
                            <!-- Property Image -->
                            <div class="property-image">
                                <img src="{{ $property->main_image_url }}" alt="{{ $property->title }}" class="img-fluid">

                                <!-- Badges -->
                                <div class="property-badges">
                                    @if($property->featured)
                                        <span class="badge featured-badge">{{ __('Featured') }}</span>
                                    @endif
                                    <span class="badge type-badge {{ $property->listing_type }}">
                                        {{ $property->listing_type_label }}
                                    </span>
                                </div>

                                <!-- Overlay -->
                                <div class="property-overlay">
                                    <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-eye me-1"></i>{{ __('View Details') }}
                                    </a>
                                </div>
                            </div>

                            <!-- Property Info -->
                            <div class="property-info">
                                <h5 class="property-title">
                                    <a href="{{ route('website.real-estate.show', $property->slug) }}">
                                        {{ Str::limit($property->title, 50) }}
                                    </a>
                                </h5>

                                <div class="property-location">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $property->location_string }}
                                </div>

                                <div class="property-details">
                                    @if($property->bedrooms)
                                        <span class="detail-item">
                                            <i class="fas fa-bed"></i> {{ $property->bedrooms }}
                                        </span>
                                    @endif
                                    @if($property->bathrooms)
                                        <span class="detail-item">
                                            <i class="fas fa-bath"></i> {{ $property->bathrooms }}
                                        </span>
                                    @endif
                                    @if($property->area)
                                        <span class="detail-item">
                                            <i class="fas fa-vector-square"></i> {{ $property->formatted_area }}
                                        </span>
                                    @endif
                                </div>

                                <div class="property-price">
                                    <span class="price-amount">{{ $property->formatted_price }}</span>
                                    @if($property->listing_type === 'rent')
                                        <small class="price-period">{{ __('per month') }}</small>
                                    @endif
                                </div>

                                <div class="property-actions">
                                    <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-outline-primary btn-sm">
                                        {{ __('View Details') }}
                                    </a>
                                    <a href="{{ route('website.real-estate.interest', $property->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-heart me-1"></i>{{ __('Interested') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrapper">
                        {{ $properties->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @else
            <!-- No Properties Found -->
            <div class="row">
                <div class="col-12">
                    <div class="no-properties text-center">
                        <div class="no-properties-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>{{ __('No Properties Found') }}</h3>
                        <p>{{ __('Try adjusting your search criteria or browse all properties.') }}</p>
                        <a href="{{ route('website.real-estate') }}" class="btn btn-primary">
                            <i class="fas fa-refresh me-2"></i>{{ __('View All Properties') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- Real Estate Listings End -->

@endsection

@push('css')
<style>
/* ============================================
   REAL ESTATE LISTINGS STYLES
   ============================================ */

/* Filters Section */
.real-estate-filters {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filter-form .form-control,
.filter-form .form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.filter-form .form-control:focus,
.filter-form .form-select:focus {
    border-color: var(--colorPrimary);
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1);
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
    font-size: 16px;
}

[dir="rtl"] .search-input-wrapper i {
    right: auto;
    left: 15px;
}

/* Results Info */
.results-info {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.2);
}

.results-info h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.results-info i {
    opacity: 0.9;
}

/* Property Card */
.property-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.property-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

/* Property Image */
.property-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.property-card:hover .property-image img {
    transform: scale(1.05);
}

/* Property Badges */
.property-badges {
    position: absolute;
    top: 12px;
    left: 12px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    z-index: 2;
}

[dir="rtl"] .property-badges {
    left: auto;
    right: 12px;
}

.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.featured-badge {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
}

.type-badge {
    color: white;
}

.type-badge.sale {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.type-badge.rent {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
}

/* Property Overlay */
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
}

.property-card:hover .property-overlay {
    opacity: 1;
}

/* Property Info */
.property-info {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.property-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
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

.property-location {
    color: #666;
    font-size: 13px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
}

.property-location i {
    color: var(--colorPrimary);
    margin-right: 4px;
}

[dir="rtl"] .property-location i {
    margin-right: 0;
    margin-left: 4px;
}

/* Property Details */
.property-details {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #666;
}

.detail-item i {
    color: var(--colorPrimary);
    margin-right: 4px;
    font-size: 12px;
}

[dir="rtl"] .detail-item i {
    margin-right: 0;
    margin-left: 4px;
}

/* Property Price */
.property-price {
    margin-bottom: 15px;
    display: flex;
    align-items: baseline;
    gap: 6px;
}

.price-amount {
    font-size: 20px;
    font-weight: 700;
    color: var(--colorPrimary);
}

.price-period {
    color: #666;
    font-size: 12px;
}

/* Property Actions */
.property-actions {
    margin-top: auto;
    display: flex;
    gap: 8px;
}

.property-actions .btn {
    flex: 1;
    padding: 8px 12px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 6px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination-wrapper .pagination {
    margin: 0;
}

/* No Properties */
.no-properties {
    padding: 60px 20px;
}

.no-properties-icon {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 20px;
}

.no-properties h3 {
    color: #666;
    margin-bottom: 10px;
}

.no-properties p {
    color: #888;
    margin-bottom: 20px;
}

/* ============================================
   MOBILE RESPONSIVE STYLES
   ============================================ */

@media (max-width: 768px) {
    .real-estate-filters {
        padding: 20px;
    }

    .filter-form .row {
        --bs-gutter-x: 10px;
    }

    .property-card {
        margin-bottom: 20px;
    }

    .property-info {
        padding: 15px;
    }

    .property-title {
        font-size: 15px;
    }

    .property-price .price-amount {
        font-size: 18px;
    }

    .property-actions {
        flex-direction: column;
        gap: 6px;
    }

    .property-actions .btn {
        padding: 10px 12px;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .filter-form .col-md-3,
    .filter-form .col-md-2,
    .filter-form .col-md-1 {
        margin-bottom: 10px;
    }

    .results-info {
        padding: 12px 16px;
    }

    .results-info h4 {
        font-size: 16px;
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

    .property-info {
        padding: 12px;
    }

    .property-details {
        gap: 10px;
        margin-bottom: 10px;
    }

    .property-price {
        margin-bottom: 12px;
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
    .filter-form .form-control,
    .filter-form .form-select {
        transition: none !important;
    }
}
</style>
@endpush