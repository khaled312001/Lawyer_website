@extends('layouts.client.layout')

@section('title')
    <title>{{ __('Real Estate Lawyers') }} - {{ $setting?->app_name }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('Find experienced real estate lawyers and legal consultants for your property needs') }}">
@endsection

@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Real Estate Lawyers') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Real Estate Lawyers') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!-- Service Description Start -->
<section class="service-description pt_100 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="service-description-content text-center">
                    <h2 class="section-title">{{ __('Real Estate Legal Services') }}</h2>
                    <p class="section-subtitle">{{ __('Professional Legal Support for All Your Property Needs') }}</p>
                    <div class="service-description-text">
                        <p>{{ __('Our real estate lawyers provide comprehensive legal services for property transactions, contracts, disputes, and regulatory compliance. With years of experience in Syrian property law, we ensure your real estate investments and transactions are legally protected and compliant with all local regulations.') }}</p>
                        <p>{{ __('Whether you are buying, selling, renting, or developing property, our expert legal team offers personalized consultation and representation to protect your interests and achieve the best possible outcomes for your real estate matters.') }}</p>
                    </div>
                    <div class="service-features mt_40">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="fas fa-home"></i>
                                    <h4>{{ __('Property Transactions') }}</h4>
                                    <p>{{ __('Legal support for buying, selling, and transferring property rights') }}</p>
                                </div>
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
                                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search lawyers...') }}" value="{{ request('search') }}">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-md-3">
                                <select name="department" class="form-select">
                                    <option value="">{{ __('All Departments') }}</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->translation?->name ?? __('Department') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="col-md-3">
                                <select name="location" class="form-select">
                                    <option value="">{{ __('All Locations') }}</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                                            {{ $location->translation?->name ?? __('Location') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort -->
                            <div class="col-md-2">
                                <select name="sort" class="form-select">
                                    <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>{{ __('Name') }}</option>
                                    <option value="experience" {{ request('sort') == 'experience' ? 'selected' : '' }}>{{ __('Experience') }}</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Rating') }}</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest') }}</option>
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
                        <i class="fas fa-user-tie me-2"></i>
                        {{ __('Found') }} {{ $lawyers->total() }} {{ __('real estate lawyers') }}
                        @if(request()->hasAny(['search', 'department', 'location']))
                            {{ __('for your search') }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

        <!-- Lawyers Grid -->
        @if($lawyers->count() > 0)
            <div class="row">
                @foreach($lawyers as $lawyer)
                    <div class="col-lg-4 col-md-6 mb_30">
                        <div class="lawyer-card">
                            <!-- Lawyer Image -->
                            <div class="lawyer-image">
                                <img src="{{ $lawyer->image ? asset('storage/' . $lawyer->image) : asset('client/img/default-avatar.png') }}" alt="{{ $lawyer->name }}" class="img-fluid">

                                <!-- Rating Badge -->
                                @if($lawyer->average_rating > 0)
                                    <div class="lawyer-rating-badge">
                                        <i class="fas fa-star"></i>
                                        <span>{{ number_format($lawyer->average_rating, 1) }}</span>
                                        <small>({{ $lawyer->total_ratings }})</small>
                                    </div>
                                @endif
                            </div>

                            <!-- Lawyer Info -->
                            <div class="lawyer-info">
                                <h5 class="lawyer-name">
                                    <a href="{{ route('website.lawyer.details', $lawyer->slug) }}">
                                        {{ $lawyer->name }}
                                    </a>
                                </h5>

                                <div class="lawyer-specialty">
                                    <i class="fas fa-briefcase me-1"></i>
                                    {{ $lawyer->translation?->designations ?? $lawyer->designations ?? __('Lawyer') }}
                                </div>

                                <div class="lawyer-department">
                                    <i class="fas fa-building me-1"></i>
                                    {{ $lawyer->department?->translation?->name ?? __('Department') }}
                                </div>

                                @if($lawyer->years_of_experience)
                                    <div class="lawyer-experience">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $lawyer->years_of_experience }} {{ __('years of experience') }}
                                    </div>
                                @endif

                                <div class="lawyer-actions">
                                    <a href="{{ route('website.lawyer.details', $lawyer->slug) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>{{ __('View Profile') }}
                                    </a>
                                    <a href="{{ route('website.book.consultation.appointment', ['lawyer' => $lawyer->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-calendar-check me-1"></i>{{ __('Book Consultation') }}
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
                        {{ $lawyers->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @else
            <!-- No Lawyers Found -->
            <div class="row">
                <div class="col-12">
                    <div class="no-properties text-center">
                        <div class="no-properties-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>{{ __('No Lawyers Found') }}</h3>
                        <p>{{ __('Try adjusting your search criteria or browse all lawyers.') }}</p>
                        <a href="{{ route('website.real-estate') }}" class="btn btn-primary">
                            <i class="fas fa-refresh me-2"></i>{{ __('View All Lawyers') }}
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