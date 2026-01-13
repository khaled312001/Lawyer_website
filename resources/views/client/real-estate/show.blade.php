@extends('layouts.client.layout')

@section('title')
    <title>{{ $property->seo_title ?? $property->title . ' - ' . __('Real Estate') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $property->seo_description ?? Str::limit($property->description, 155) }}">
    @if($property->seo_keywords)
        <meta name="keywords" content="{{ implode(', ', $property->seo_keywords) }}">
    @endif
    <meta property="og:title" content="{{ $property->title }}">
    <meta property="og:description" content="{{ Str::limit($property->description, 155) }}">
    <meta property="og:image" content="{{ $property->main_image_url }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection

@section('client-content')

<!-- Property Header/Breadcrumb -->
<section class="property-header" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="property-header-content">
                    <h1 class="property-title">{{ $property->title }}</h1>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $property->location_string }}
                    </div>
                    <div class="property-meta">
                        <span class="meta-item">
                            <i class="fas fa-tag"></i> {{ $property->listing_type_label }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-building"></i> {{ $property->property_type_label }}
                        </span>
                        @if($property->area)
                            <span class="meta-item">
                                <i class="fas fa-vector-square"></i> {{ $property->formatted_area }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property Details Section -->
<section class="property-details-section pt_80 pb_80">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div class="property-gallery mb_40">
                    @if($property->gallery_images && count($property->gallery_images) > 0)
                        <div class="gallery-main">
                            <img id="main-gallery-image" src="{{ $property->gallery_images[0] }}" alt="{{ $property->title }}" class="img-fluid">
                            <div class="gallery-nav">
                                <button class="gallery-nav-btn prev" onclick="changeGalleryImage(-1)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="gallery-nav-btn next" onclick="changeGalleryImage(1)">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="gallery-thumbnails">
                            @foreach($property->gallery_images as $index => $image)
                                <img src="{{ $image }}" alt="{{ $property->title }} {{ $index + 1 }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="setGalleryImage({{ $index }})">
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
                    <h3 class="section-title">{{ __('Property Overview') }}</h3>
                    <div class="overview-grid">
                        @if($property->bedrooms)
                            <div class="overview-item">
                                <i class="fas fa-bed"></i>
                                <span class="label">{{ __('Bedrooms') }}</span>
                                <span class="value">{{ $property->bedrooms }}</span>
                            </div>
                        @endif
                        @if($property->bathrooms)
                            <div class="overview-item">
                                <i class="fas fa-bath"></i>
                                <span class="label">{{ __('Bathrooms') }}</span>
                                <span class="value">{{ $property->bathrooms }}</span>
                            </div>
                        @endif
                        @if($property->area)
                            <div class="overview-item">
                                <i class="fas fa-vector-square"></i>
                                <span class="label">{{ __('Area') }}</span>
                                <span class="value">{{ $property->formatted_area }}</span>
                            </div>
                        @endif
                        @if($property->floor)
                            <div class="overview-item">
                                <i class="fas fa-layer-group"></i>
                                <span class="label">{{ __('Floor') }}</span>
                                <span class="value">{{ $property->floor }}</span>
                            </div>
                        @endif
                        @if($property->year_built)
                            <div class="overview-item">
                                <i class="fas fa-calendar"></i>
                                <span class="label">{{ __('Year Built') }}</span>
                                <span class="value">{{ $property->year_built }}</span>
                            </div>
                        @endif
                        @if($property->listing_type === 'rent')
                            <div class="overview-item">
                                <i class="fas fa-tag"></i>
                                <span class="label">{{ __('Rent Period') }}</span>
                                <span class="value">{{ __('Monthly') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Property Description -->
                <div class="property-description mb_40">
                    <h3 class="section-title">{{ __('Description') }}</h3>
                    <div class="description-content">
                        {!! nl2br(e($property->description)) !!}
                    </div>
                </div>

                <!-- Features & Amenities -->
                @if($property->features || $property->amenities)
                    <div class="property-features mb_40">
                        <h3 class="section-title">{{ __('Features & Amenities') }}</h3>
                        <div class="features-grid">
                            @if($property->features)
                                @foreach($property->features as $feature)
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>{{ ucfirst(str_replace(['_', '-'], ' ', $feature)) }}</span>
                                    </div>
                                @endforeach
                            @endif
                            @if($property->amenities)
                                @foreach($property->amenities as $amenity)
                                    <div class="feature-item">
                                        <i class="fas fa-star"></i>
                                        <span>{{ ucfirst(str_replace(['_', '-'], ' ', $amenity)) }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Property Price Card -->
                <div class="price-card mb_30">
                    <div class="price-header">
                        <div class="price-amount">{{ $property->formatted_price }}</div>
                        @if($property->listing_type === 'rent')
                            <div class="price-period">{{ __('per month') }}</div>
                        @endif
                    </div>
                    <div class="price-actions">
                        <a href="tel:{{ $property->contact_phone }}" class="btn btn-primary btn-lg w-100 mb-2">
                            <i class="fas fa-phone me-2"></i>{{ __('Call Now') }}
                        </a>
                        <a href="{{ route('website.book.consultation.appointment') }}?service=real_estate&property={{ $property->id }}" class="btn btn-warning btn-lg w-100 mb-2">
                            <i class="fas fa-calendar-check me-2"></i>{{ __('Book Consultation') }}
                        </a>
                        <a href="{{ route('website.real-estate.interest', $property->slug) }}" class="btn btn-success btn-lg w-100 mb-2">
                            <i class="fas fa-heart me-2"></i>{{ __('Show Interest') }}
                        </a>
                        <button class="btn btn-outline-primary btn-lg w-100" onclick="shareProperty()">
                            <i class="fas fa-share me-2"></i>{{ __('Share Property') }}
                        </button>
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
                        <h4>{{ __('Similar Properties') }}</h4>
                        @foreach($similarProperties as $similarProperty)
                            <div class="similar-property-item">
                                <div class="similar-property-image">
                                    <img src="{{ $similarProperty->main_image_url }}" alt="{{ $similarProperty->title }}">
                                </div>
                                <div class="similar-property-info">
                                    <h5><a href="{{ route('website.real-estate.show', $similarProperty->slug) }}">{{ Str::limit($similarProperty->title, 30) }}</a></h5>
                                    <div class="similar-property-price">{{ $similarProperty->formatted_price }}</div>
                                    <div class="similar-property-location">
                                        <i class="fas fa-map-marker-alt"></i> {{ $similarProperty->city }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

/* Property Header */
.property-header {
    padding: 80px 0;
    position: relative;
}

.property-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 1;
}

.property-header-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}

.property-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.property-location {
    font-size: 18px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.property-location i {
    color: var(--colorSecondary);
}

.property-meta {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

/* Property Gallery */
.property-gallery {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.gallery-main {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 2;
}

.gallery-nav-btn {
    background: rgba(255,255,255,0.9);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.gallery-nav-btn:hover {
    background: var(--colorPrimary);
    color: white;
    transform: scale(1.1);
}

.gallery-thumbnails {
    display: flex;
    gap: 10px;
    padding: 15px;
    overflow-x: auto;
    background: #f8f9fa;
}

.thumbnail {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.thumbnail.active {
    border-color: var(--colorPrimary);
    transform: scale(1.05);
}

.thumbnail:hover {
    transform: scale(1.05);
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
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
}

.overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
}

.overview-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.overview-item:hover {
    background: var(--colorPrimary);
    color: white;
    transform: translateY(-3px);
}

.overview-item i {
    font-size: 32px;
    color: var(--colorPrimary);
    margin-bottom: 10px;
    display: block;
}

.overview-item:hover i {
    color: white;
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

/* Property Description */
.property-description {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.description-content {
    line-height: 1.8;
    color: #555;
    font-size: 16px;
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
}

.feature-item i {
    color: var(--colorPrimary);
    font-size: 16px;
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

/* Sidebar Styles */
.price-card {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(200, 180, 126, 0.3);
}

.price-header {
    margin-bottom: 25px;
}

.price-amount {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
}

.price-period {
    font-size: 14px;
    opacity: 0.9;
}

.price-actions .btn {
    margin-bottom: 10px;
}

/* Property Summary */
.property-summary {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.property-summary h4 {
    margin-bottom: 20px;
    color: #333;
    font-size: 18px;
    font-weight: 600;
}

.summary-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.summary-list li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.summary-list li:last-child {
    border-bottom: none;
}

.summary-list .label {
    font-weight: 500;
    color: #666;
}

.summary-list .value {
    font-weight: 600;
    color: #333;
}

/* Similar Properties */
.similar-properties {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.similar-properties h4 {
    margin-bottom: 20px;
    color: #333;
    font-size: 18px;
    font-weight: 600;
}

.similar-property-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.similar-property-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.similar-property-image {
    width: 80px;
    height: 60px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
}

.similar-property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.similar-property-info h5 {
    margin: 0 0 5px 0;
    font-size: 14px;
    font-weight: 600;
}

.similar-property-info h5 a {
    color: #333;
    text-decoration: none;
}

.similar-property-info h5 a:hover {
    color: var(--colorPrimary);
}

.similar-property-price {
    font-weight: 700;
    color: var(--colorPrimary);
    font-size: 14px;
    margin-bottom: 3px;
}

.similar-property-location {
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ============================================
   MOBILE RESPONSIVE STYLES
   ============================================ */

@media (max-width: 768px) {
    .property-title {
        font-size: 24px;
    }

    .property-location {
        font-size: 16px;
    }

    .property-meta {
        gap: 10px;
    }

    .meta-item {
        padding: 6px 12px;
        font-size: 12px;
    }

    .gallery-main {
        height: 300px;
    }

    .property-overview,
    .property-description,
    .property-features,
    .property-contact {
        padding: 20px;
    }

    .section-title {
        font-size: 20px;
    }

    .overview-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
    }

    .overview-item {
        padding: 15px;
    }

    .contact-card {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .contact-actions {
        margin-left: 0;
        width: 100%;
    }

    .contact-actions .btn {
        width: 100%;
    }

    .price-card {
        padding: 20px;
    }

    .price-amount {
        font-size: 28px;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .property-header {
        padding: 60px 0;
    }

    .property-title {
        font-size: 20px;
    }

    .property-location {
        font-size: 14px;
        flex-direction: column;
        gap: 4px;
    }

    .property-meta {
        flex-direction: column;
        gap: 8px;
    }

    .gallery-nav {
        padding: 0 10px;
    }

    .gallery-nav-btn {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }

    .gallery-thumbnails {
        padding: 10px;
    }

    .thumbnail {
        width: 60px;
        height: 45px;
    }

    .price-card {
        margin-bottom: 20px;
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
        currentImageIndex = index;
    };

    // Share property functionality
    window.shareProperty = function() {
        const url = window.location.href;
        const title = "{{ $property->title }}";

        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            });
        } else {
            // Fallback for browsers that don't support Web Share API
            const dummy = document.createElement('input');
            document.body.appendChild(dummy);
            dummy.value = url;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);

            // Show success message
            alert('{{ __("Property link copied to clipboard!") }}');
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
