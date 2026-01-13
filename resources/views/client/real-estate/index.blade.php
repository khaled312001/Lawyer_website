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

<!-- Properties Filter Start -->
<section class="properties-filter pt_100 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="properties-filter-content">
                    <form action="{{ route('website.real-estate') }}" method="GET" class="properties-filter-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search properties...') }}" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="property_type" class="form-select">
                                        <option value="">{{ __('All Types') }}</option>
                                        @foreach($propertyTypes as $key => $type)
                                            <option value="{{ $key }}" {{ request('property_type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="listing_type" class="form-select">
                                        <option value="">{{ __('All Listings') }}</option>
                                        <option value="sale" {{ request('listing_type') == 'sale' ? 'selected' : '' }}>{{ __('For Sale') }}</option>
                                        <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>{{ __('For Rent') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="city" class="form-select">
                                        <option value="">{{ __('All Cities') }}</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="sort" class="form-select">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>{{ __('Latest First') }}</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                                        <option value="area" {{ request('sort') == 'area' ? 'selected' : '' }}>{{ __('Largest Area') }}</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest First') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">{{ __('Search Properties') }}</button>
                                <a href="{{ route('website.real-estate') }}" class="btn btn-outline-secondary ms-2">{{ __('Clear Filters') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Properties Filter End -->

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
                                <span class="badge {{ $property->listing_type === 'sale' ? 'bg-success' : 'bg-info' }}">{{ $property->listing_type_label }}</span>
                                @if($property->featured)
                                    <span class="badge bg-warning">{{ __('Featured') }}</span>
                                @endif
                            </div>
                            <div class="property-overlay">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-primary">{{ __('View Details') }}</a>
                            </div>
                        </div>
                        <div class="property-content">
                            <h4 class="property-title">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}">{{ Str::limit($property->title, 50) }}</a>
                            </h4>
                            <div class="property-meta">
                                <span class="property-type"><i class="fas fa-building"></i> {{ $property->property_type_label }}</span>
                                <span class="property-location"><i class="fas fa-map-marker-alt"></i> {{ $property->location_string }}</span>
                            </div>
                            <div class="property-details">
                                @if($property->bedrooms)
                                    <span><i class="fas fa-bed"></i> {{ $property->bedrooms }} {{ __('Beds') }}</span>
                                @endif
                                @if($property->bathrooms)
                                    <span><i class="fas fa-bath"></i> {{ $property->bathrooms }} {{ __('Baths') }}</span>
                                @endif
                                <span><i class="fas fa-expand-arrows-alt"></i> {{ $property->formatted_area }}</span>
                            </div>
                            <div class="property-price">
                                <strong>{{ $property->formatted_price }}</strong>
                                @if($property->price_per_sqm)
                                    <small class="text-muted">({{ number_format($property->price_per_sqm) }} {{ $property->currency }}/m²)</small>
                                @endif
                            </div>
                            <div class="property-actions">
                                <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-outline-primary btn-sm">{{ __('Details') }}</a>
                                <a href="{{ route('website.book.consultation.appointment') }}?service=real_estate&property={{ $property->id }}" class="btn btn-primary btn-sm">{{ __('Book Consultation') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-home fa-3x text-muted mb-3"></i>
                        <h4>{{ __('No Properties Found') }}</h4>
                        <p class="text-muted">{{ __('Try adjusting your search criteria or browse all properties.') }}</p>
                        <a href="{{ route('website.real-estate') }}" class="btn btn-primary">{{ __('Browse All Properties') }}</a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($properties->hasPages())
            <div class="row mt-4">
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
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="fas fa-file-contract"></i>
                                    <h4>{{ __('Contract Drafting') }}</h4>
                                    <p>{{ __('Professional contract preparation and legal review') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="fas fa-gavel"></i>
                                    <h4>{{ __('Dispute Resolution') }}</h4>
                                    <p>{{ __('Legal representation in property disputes and litigation') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Description End -->

<!-- Real Estate Listings Start -->
<section class="real-estate-listings pt_50 pb_100">
    <div class="container">
        <!-- Search and Filters -->
        <div class="row mb_50">
            <div class="col-12">
                <div class="real-estate-filters">
                    <form action="{{ route('website.real-estate') }}" method="GET" class="filter-form">
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-4">
                                <div class="search-input-wrapper">
                                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search properties...') }}" value="{{ request('search') }}">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="col-md-3">
                                <select name="property_type" class="form-select">
                                    <option value="">{{ __('All Types') }}</option>
                                    @foreach($propertyTypes as $key => $type)
                                        <option value="{{ $key }}" {{ request('property_type') == $key ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- City -->
                            <div class="col-md-3">
                                <select name="city" class="form-select">
                                    <option value="">{{ __('All Cities') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                            {{ $city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Listing Type -->
                            <div class="col-md-2">
                                <select name="listing_type" class="form-select">
                                    <option value="">{{ __('All Listings') }}</option>
                                    <option value="sale" {{ request('listing_type') == 'sale' ? 'selected' : '' }}>{{ __('For Sale') }}</option>
                                    <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>{{ __('For Rent') }}</option>
                                </select>
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
                        <i class="fas fa-building me-2"></i>
                        {{ __('Found') }} {{ $properties->total() }} {{ __('properties') }}
                        @if(request()->hasAny(['search', 'property_type', 'listing_type', 'city']))
                            {{ __('for your search') }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Real Estate Listings End -->

@endsection

@push('css')
<style>
/* ============================================
   REAL ESTATE LAWYERS STYLES
   ============================================ */

/* Service Description Section */
.service-description {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
}

.service-description-content {
    max-width: 900px;
    margin: 0 auto;
}

.service-description .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.service-description .section-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    font-weight: 300;
}

.service-description-text p {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    opacity: 0.95;
}

.service-features {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 3rem 2rem;
    backdrop-filter: blur(10px);
}

.feature-item {
    text-align: center;
    padding: 1.5rem;
}

.feature-item i {
    font-size: 3rem;
    color: white;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.feature-item h4 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: white;
}

.feature-item p {
    font-size: 0.95rem;
    opacity: 0.8;
    line-height: 1.5;
}

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

/* Lawyer Card */
.lawyer-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.lawyer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

/* Lawyer Image */
.lawyer-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
}

.lawyer-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.lawyer-card:hover .lawyer-image img {
    transform: scale(1.05);
}

/* Lawyer Rating Badge */
.lawyer-rating-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 6px 10px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

[dir="rtl"] .lawyer-rating-badge {
    right: auto;
    left: 12px;
}

.lawyer-rating-badge i {
    color: #ffc107;
}

.lawyer-rating-badge small {
    color: #666;
    font-weight: 400;
}

/* Lawyer Info */
.lawyer-info {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.lawyer-name {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    line-height: 1.4;
}

.lawyer-name a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.lawyer-name a:hover {
    color: var(--colorPrimary);
}

.lawyer-specialty,
.lawyer-department,
.lawyer-experience {
    color: #666;
    font-size: 13px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
}

.lawyer-specialty i,
.lawyer-department i,
.lawyer-experience i {
    color: var(--colorPrimary);
    margin-right: 6px;
    width: 14px;
    text-align: center;
}

[dir="rtl"] .lawyer-specialty i,
[dir="rtl"] .lawyer-department i,
[dir="rtl"] .lawyer-experience i {
    margin-right: 0;
    margin-left: 6px;
}

/* Lawyer Actions */
.lawyer-actions {
    margin-top: auto;
    display: flex;
    gap: 8px;
}

.lawyer-actions .btn {
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