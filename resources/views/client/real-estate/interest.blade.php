@extends('layouts.client.layout')

@section('title')
    <title>{{ __('Show Interest in') }} {{ $property->title }} - {{ $setting?->app_name }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('Show your interest in') }} {{ $property->title }}">
@endsection

@section('client-content')

<!-- Property Interest Header -->
<section class="property-interest-header" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="interest-header-content">
                    <h1 class="interest-title">{{ __('Show Interest') }}</h1>
                    <p class="interest-subtitle">{{ __('in') }} "{{ $property->title }}"</p>
                    <div class="property-quick-info">
                        <span class="quick-info-item">
                            <i class="fas fa-tag"></i> {{ $property->listing_type_label }}
                        </span>
                        <span class="quick-info-item">
                            <i class="fas fa-dollar-sign"></i> {{ $property->formatted_price }}
                        </span>
                        <span class="quick-info-item">
                            <i class="fas fa-map-marker-alt"></i> {{ $property->city }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interest Form Section -->
<section class="interest-form-section pt_80 pb_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- Property Preview Card -->
                <div class="property-preview-card mb_40">
                    <div class="preview-image">
                        <img src="{{ $property->main_image_url }}" alt="{{ $property->title }}" class="img-fluid">
                        <div class="preview-overlay">
                            <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-eye me-1"></i>{{ __('View Property') }}
                            </a>
                        </div>
                    </div>
                    <div class="preview-content">
                        <h4 class="property-title">{{ $property->title }}</h4>
                        <div class="property-details">
                            @if($property->bedrooms)
                                <span class="detail-item">
                                    <i class="fas fa-bed"></i> {{ $property->bedrooms }} {{ __('Bedrooms') }}
                                </span>
                            @endif
                            @if($property->bathrooms)
                                <span class="detail-item">
                                    <i class="fas fa-bath"></i> {{ $property->bathrooms }} {{ __('Bathrooms') }}
                                </span>
                            @endif
                            @if($property->area)
                                <span class="detail-item">
                                    <i class="fas fa-vector-square"></i> {{ $property->formatted_area }}
                                </span>
                            @endif
                        </div>
                        <div class="property-price">
                            <span class="price">{{ $property->formatted_price }}</span>
                            @if($property->listing_type === 'rent')
                                <small>{{ __('per month') }}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Interest Form -->
                <div class="interest-form-card">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="form-title-section">
                            <h3>{{ __('Contact Information') }}</h3>
                            <p>{{ __('Please provide your contact details so we can get back to you about this property') }}</p>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ __('Please fix the following errors:') }}</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('website.real-estate.store-interest', $property->slug) }}" method="POST" id="interestForm">
                        @csrf

                        <!-- Personal Information -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-user me-2"></i>{{ __('Personal Information') }}
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-signature me-2"></i>{{ __('Full Name') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', Auth::user()->name ?? '') }}" placeholder="{{ __('Enter your full name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>{{ __('Email Address') }} <small class="text-muted">({{ __('Optional') }})</small>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="{{ __('Enter your email address') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>{{ __('We will contact you primarily through phone') }}
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone me-2"></i>{{ __('Phone Number') }} <span class="text-danger">*</span> <small class="text-primary">({{ __('Primary Contact') }})</small>
                                </label>
                                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" required value="{{ old('phone', Auth::user()->details->phone ?? '') }}" placeholder="{{ __('Enter your phone number') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-primary">
                                    <i class="fas fa-phone me-1"></i>{{ __('This is our primary way to contact you about this property') }}
                                </small>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-comment me-2"></i>{{ __('Additional Information') }}
                            </h4>

                            <div class="mb-3">
                                <label for="message" class="form-label">
                                    <i class="fas fa-pencil-alt me-2"></i>{{ __('Message') }} <small class="text-muted">({{ __('Optional') }})</small>
                                </label>
                                <textarea name="message" id="message" class="form-control" rows="4" placeholder="{{ __('Tell us more about your interest in this property...') }}">{{ old('message') }}</textarea>
                                <small class="form-text text-muted">{{ __('Any specific questions or requirements you have') }}</small>
                            </div>
                        </div>

                        <!-- Property Info Summary -->
                        <div class="property-info-summary">
                            <h5>{{ __('Property Information') }}</h5>
                            <div class="summary-details">
                                <div class="summary-item">
                                    <span class="label">{{ __('Property') }}:</span>
                                    <span class="value">{{ $property->title }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">{{ __('Type') }}:</span>
                                    <span class="value">{{ $property->property_type_label }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">{{ __('Price') }}:</span>
                                    <span class="value">{{ $property->formatted_price }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">{{ __('Location') }}:</span>
                                    <span class="value">{{ $property->location_string }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Privacy -->
                        <div class="terms-section">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacyConsent" required>
                                <label class="form-check-label" for="privacyConsent">
                                    {{ __('I agree to the') }} <a href="{{ route('website.privacy-policy') }}" target="_blank">{{ __('Privacy Policy') }}</a> {{ __('and consent to being contacted about this property') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>{{ __('Send Interest Request') }}
                            </button>
                            <a href="{{ route('website.real-estate.show', $property->slug) }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('Back to Property') }}
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="contact-info-card">
                    <h4><i class="fas fa-address-book me-2"></i>{{ __('Need Help?') }}</h4>
                    <p>{{ __('Our property specialists are here to help you with any questions about this property.') }}</p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>{{ __('Call Us') }}</strong>
                                <br>
                                <a href="tel:{{ $property->contact_phone }}">{{ $property->contact_phone }}</a>
                            </div>
                        </div>

                        @if($property->contact_email)
                            <div class="contact-method">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>{{ __('Email Us') }}</strong>
                                    <br>
                                    <a href="mailto:{{ $property->contact_email }}">{{ $property->contact_email }}</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="contact-person">
                        <div class="contact-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="contact-details">
                            <strong>{{ $property->contact_name }}</strong>
                            <br>
                            <small>{{ __('Property Specialist') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('css')
<style>
/* ============================================
   PROPERTY INTEREST FORM STYLES
   ============================================ */

/* Interest Header */
.property-interest-header {
    padding: 80px 0;
    position: relative;
}

.property-interest-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 1;
}

.interest-header-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}

.interest-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.interest-subtitle {
    font-size: 20px;
    margin-bottom: 20px;
    opacity: 0.9;
}

.property-quick-info {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.quick-info-item {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

/* Property Preview Card */
.property-preview-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 30px;
}

.preview-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.preview-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.preview-image:hover img {
    transform: scale(1.05);
}

.preview-overlay {
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

.preview-image:hover .preview-overlay {
    opacity: 1;
}

.preview-content {
    padding: 20px;
}

.property-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.property-details {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    color: #666;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

[dir="ltr"] .detail-item {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.detail-item i {
    color: var(--colorPrimary);
    order: 1 !important;
    flex-shrink: 0;
    margin-left: 0.5rem;
}

[dir="ltr"] .detail-item i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.detail-item {
    direction: rtl !important;
}

[dir="ltr"] .detail-item {
    direction: rtl !important;
}

.property-price {
    display: flex;
    align-items: baseline;
    gap: 6px;
}

.property-price .price {
    font-size: 20px;
    font-weight: 700;
    color: var(--colorPrimary);
}

.property-price small {
    color: #666;
    font-size: 12px;
}

/* Interest Form Card */
.interest-form-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: white;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.form-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.form-title-section h3 {
    margin: 0 0 8px 0;
    font-size: 24px;
    font-weight: 600;
}

.form-title-section p {
    margin: 0;
    opacity: 0.9;
    font-size: 14px;
}

/* Form Sections */
.form-section {
    padding: 30px;
    border-bottom: 1px solid #f0f0f0;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.section-title i {
    color: var(--colorPrimary);
    margin-right: 8px;
}

/* Form Controls */
.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.form-label i {
    color: var(--colorPrimary);
    margin-right: 6px;
    font-size: 14px;
}

.form-label small {
    font-weight: 400;
    opacity: 0.8;
    margin-left: 6px;
}

.form-label .text-primary {
    color: var(--colorPrimary) !important;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--colorPrimary);
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* Property Info Summary */
.property-info-summary {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
}

.property-info-summary h5 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 16px;
    font-weight: 600;
}

.summary-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e0e0e0;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-item .label {
    font-weight: 500;
    color: #666;
}

.summary-item .value {
    font-weight: 600;
    color: #333;
}

/* Terms Section */
.terms-section {
    padding: 20px 30px;
    background: #fff8e1;
    border-top: 1px solid #e9ecef;
}

.form-check-input:checked {
    background-color: var(--colorPrimary);
    border-color: var(--colorPrimary);
}

.form-check-label {
    font-size: 14px;
    line-height: 1.5;
}

.form-check-label a {
    color: var(--colorPrimary);
    text-decoration: none;
    font-weight: 600;
}

.form-check-label a:hover {
    text-decoration: underline;
}

/* Form Actions */
.form-actions {
    padding: 30px;
    background: #f8f9fa;
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.form-actions .btn {
    min-width: 160px;
    padding: 12px 24px;
    font-weight: 600;
    border-radius: 8px;
}

/* Contact Info Card */
.contact-info-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
}

.contact-info-card h4 {
    color: #333;
    margin-bottom: 10px;
    font-size: 18px;
}

.contact-info-card p {
    color: #666;
    margin-bottom: 20px;
}

.contact-methods {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #555;
}

.contact-method i {
    color: var(--colorPrimary);
    font-size: 18px;
}

.contact-method a {
    color: var(--colorPrimary);
    text-decoration: none;
    font-weight: 600;
}

.contact-method a:hover {
    text-decoration: underline;
}

.contact-person {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.contact-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
}

.contact-details {
    text-align: left;
}

.contact-details strong {
    color: #333;
    display: block;
    margin-bottom: 2px;
}

.contact-details small {
    color: #666;
}

/* ============================================
   MOBILE RESPONSIVE STYLES
   ============================================ */

@media (max-width: 768px) {
    .interest-title {
        font-size: 28px;
    }

    .interest-subtitle {
        font-size: 16px;
    }

    .property-quick-info {
        gap: 10px;
    }

    .quick-info-item {
        padding: 6px 12px;
        font-size: 12px;
    }

    .preview-content {
        padding: 15px;
    }

    .property-title {
        font-size: 16px;
    }

    .form-header {
        padding: 20px;
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .form-title-section h3 {
        font-size: 20px;
    }

    .form-section {
        padding: 20px;
    }

    .section-title {
        font-size: 16px;
    }

    .form-actions {
        padding: 20px;
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
        min-width: auto;
    }

    .contact-methods {
        gap: 20px;
    }

    .contact-person {
        flex-direction: column;
        gap: 10px;
    }

    .contact-details {
        text-align: center;
    }

    .summary-details {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .property-interest-header {
        padding: 60px 0;
    }

    .interest-title {
        font-size: 24px;
    }

    .preview-image {
        height: 150px;
    }

    .form-header {
        padding: 15px;
    }

    .form-section {
        padding: 15px;
    }

    .terms-section {
        padding: 15px 20px;
    }

    .contact-info-card {
        padding: 20px;
    }

    .contact-methods {
        flex-direction: column;
        gap: 15px;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.form-control:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1) !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .interest-form-card,
    .property-preview-card,
    .contact-info-card {
        border: 2px solid #000;
    }

    .form-header {
        background: var(--colorPrimary);
    }

    .terms-section {
        border-color: #000;
        background: #fff;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .preview-image img,
    .form-control {
        transition: none !important;
    }
}
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Form validation and enhancement
    const interestForm = $('#interestForm');
    const submitBtn = $('#submitBtn');

    // Phone number validation
    $('#phone').on('input', function() {
        const phoneValue = $(this).val().trim();
        const phoneField = $(this);

        if (phoneValue) {
            // Basic phone validation (at least 7 digits)
            const phoneRegex = /^[\d\s\-\+\(\)]{7,}$/;
            if (phoneRegex.test(phoneValue)) {
                phoneField.removeClass('is-invalid').addClass('is-valid');
            } else {
                phoneField.removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            phoneField.removeClass('is-valid is-invalid');
        }
    });

    // Email validation
    $('#email').on('input', function() {
        const emailValue = $(this).val().trim();
        const emailField = $(this);

        if (emailValue) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(emailValue)) {
                emailField.removeClass('is-invalid').addClass('is-valid');
            } else {
                emailField.removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            emailField.removeClass('is-valid is-invalid');
        }
    });

    // Form submission
    interestForm.on('submit', function(e) {
        const phoneValue = $('#phone').val().trim();
        const emailValue = $('#email').val().trim();
        const privacyConsent = $('#privacyConsent').is(':checked');

        // Validate phone
        if (!phoneValue) {
            e.preventDefault();
            alert('{{ __("Please enter your phone number") }}');
            $('#phone').focus();
            return false;
        }

        // Validate privacy consent
        if (!privacyConsent) {
            e.preventDefault();
            alert('{{ __("Please agree to the privacy policy to continue") }}');
            $('#privacyConsent').focus();
            return false;
        }

        // Show loading state
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>{{ __("Sending...") }}');
    });

    // Auto-fill user data if logged in
    @auth
        // Data is already filled from the controller
    @endauth

    // Character counter for message field
    $('#message').on('input', function() {
        const maxLength = 1000;
        const currentLength = $(this).val().length;

        if (currentLength > maxLength * 0.9) {
            $(this).addClass('warning');
        } else {
            $(this).removeClass('warning');
        }
    });
});
</script>
@endpush
