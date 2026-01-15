@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Book Consultation Appointment') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Book a consultation appointment with our admin team') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Book Consultation Appointment') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Book Consultation Appointment') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!--Book Consultation Appointment Section Start-->
<section class="book-appointment-page pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-lg-10 col-xl-9 m-auto wow fadeInDown">
                <div class="main-headline text-center mb_50">
                    <h2 class="title"><span>{{ __('Book Consultation') }}</span> {{ __('Appointment') }}</h2>
                    <p>{{ __('Fill out the form below to book a consultation appointment with our admin team. We will review your request and contact you to confirm the appointment.') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-xl-9 m-auto">
                <div class="appointment-form-card">
                    <div class="appointment-form-body">
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

                        @if(isset($property) && $property)
                        <!-- Property Information - Enhanced -->
                        <div class="property-info-card mb-4">
                            <div class="property-info-wrapper">
                                <div class="property-info-header">
                                    <div class="property-info-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="property-info-title">
                                        <h5 class="mb-0">{{ __('Property Information') }}</h5>
                                        <p class="mb-0">{{ __('Consultation for this property') }}</p>
                                    </div>
                                </div>
                                <div class="property-info-content">
                                    @if($property->main_image_url)
                                        <div class="property-info-image">
                                            <img src="{{ $property->main_image_url }}" alt="{{ $property->title }}" loading="lazy">
                                        </div>
                                    @endif
                                    <div class="property-info-details">
                                        <div class="property-info-main">
                                            <h6 class="property-title">{{ $property->title }}</h6>
                                            <div class="property-location-info">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $property->city }}{!! $property->district ? ', ' . $property->district : '' !!}</span>
                                            </div>
                                        </div>
                                        <div class="property-info-grid">
                                            <div class="property-info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">{{ __('Type') }}</span>
                                                    <span class="info-value">{{ $property->property_type_label }}</span>
                                                </div>
                                            </div>
                                            <div class="property-info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-hand-holding-usd"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">{{ __('Purpose') }}</span>
                                                    <span class="info-value">{{ $property->listing_type_label }}</span>
                                                </div>
                                            </div>
                                            @if($property->area)
                                                <div class="property-info-item">
                                                    <div class="info-icon">
                                                        <i class="fas fa-vector-square"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <span class="info-label">{{ __('Area') }}</span>
                                                        <span class="info-value">{{ $property->formatted_area }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="property-info-item highlight">
                                                <div class="info-icon">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">{{ __('Price') }}</span>
                                                    <span class="info-value price-value">{{ $property->formatted_price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="property-info-notice">
                                            <div class="notice-icon">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                            <div class="notice-text">
                                                {{ __('This consultation is specifically for real estate services related to this property.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('website.create.consultation.appointment') }}" method="POST" id="consultationAppointmentForm">
                            @csrf
                            <input type="hidden" name="service" value="{{ request('service') }}">
                            <input type="hidden" name="property" value="{{ request('property') }}">
                            
                            <!-- Lawyer Selection -->
                            <div class="mb-4">
                                <label for="lawyer_id" class="form-label">
                                    <i class="fas fa-user-tie me-2"></i>{{ __('Select Lawyer') }}
                                </label>
                                <div class="lawyer-selection-wrapper">
                                    <select name="lawyer_id" id="lawyer_id" class="form-select lawyer-select @error('lawyer_id') is-invalid @enderror">
                                        <option value="">{{ __('Choose a lawyer for your consultation') }}</option>
                                        @foreach($lawyers ?? [] as $lawyer)
                                            <option value="{{ $lawyer->id }}"
                                                    data-department="{{ $lawyer->department->name ?? '' }}"
                                                    data-specialty="{{ $lawyer->designations ?? '' }}"
                                                    data-slug="{{ $lawyer->slug ?? '' }}"
                                                    data-rating="{{ $lawyer->average_rating ?? 0 }}"
                                                    data-rating-count="{{ $lawyer->total_ratings ?? 0 }}"
                                                    {{ old('lawyer_id') == $lawyer->id ? 'selected' : '' }}>
                                                {{ $lawyer->name }} - {{ $lawyer->department->name ?? __('Lawyer') }}
                                                @if($lawyer->designations)
                                                    ({{ $lawyer->designations }})
                                                @endif
                                                @if($lawyer->average_rating > 0)
                                                    ({{ $lawyer->average_rating }} ⭐)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="lawyer-info-display" id="lawyer-info-display">
                                        <div class="lawyer-avatar">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="lawyer-details">
                                            <div class="lawyer-name">{{ __('Select a lawyer to see details') }}</div>
                                            <div class="lawyer-specialty">{{ __('Choose from the list above') }}</div>
                                            <div class="lawyer-rating" id="lawyer-rating-display" style="display: none;">
                                                <div class="rating-stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="rating-text">
                                                    <span id="rating-score">0.0</span> (<span id="rating-count">0</span> {{ __('reviews') }})
                                                </div>
                                            </div>
                                            <div class="lawyer-profile-link" id="lawyer-profile-link" style="display: none;">
                                                <a href="#" id="lawyer-profile-url" class="btn btn-sm btn-outline-primary" target="_blank">
                                                    <i class="fas fa-user me-1"></i>{{ __('View Profile') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('lawyer_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>{{ __('Select the lawyer you want to consult with (optional)') }}
                                </small>
                            </div>

                            <!-- Appointment Date & Time -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_date" class="form-label">
                                        <i class="fas fa-calendar-alt me-2"></i>{{ __('Appointment Date') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="appointment_date" id="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" required min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" placeholder="{{ __('12-Jan-2026') }}">
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">{{ __('Please select a date for your consultation') }}</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_time" class="form-label">
                                        <i class="fas fa-clock me-2"></i>{{ __('Appointment Time') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" name="appointment_time" id="appointment_time" class="form-control @error('appointment_time') is-invalid @enderror" required value="{{ old('appointment_time') }}">
                                    @error('appointment_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">{{ __('Please select a time for your consultation') }}</small>
                                </div>
                            </div>


                            <!-- Case Type -->
                            <div class="mb-4">
                                <label for="case_type" class="form-label">
                                    <i class="fas fa-tag me-2"></i>{{ __('Case Type') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="case_type" id="case_type" class="form-control @error('case_type') is-invalid @enderror" required value="{{ old('case_type', request('service') === 'real_estate' ? __('Real Estate Consultation') : '') }}" placeholder="{{ __('e.g., Criminal, Civil, Family, Commercial, Contract, etc.') }}">
                                @error('case_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">{{ __('Specify the type of your case') }}</small>
                            </div>

                            <!-- Case Details -->
                            <div class="mb-4">
                                <label for="case_details" class="form-label">
                                    <i class="fas fa-file-alt me-2"></i>{{ __('Case Details') }} <span class="text-danger">*</span>
                                </label>
                                <textarea name="case_details" id="case_details" class="form-control @error('case_details') is-invalid @enderror" rows="5" required placeholder="{{ request('service') === 'real_estate' ? __('Provide details about the property consultation you need...') : __('Provide detailed information about your case...') }}">{{ old('case_details', '') }}</textarea>
                                @error('case_details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">{{ __('Please provide comprehensive details about your case') }}</small>
                                @if(request('service') === 'real_estate')
                                    <div class="alert alert-info mt-2">
                                        <i class="fas fa-info-circle me-2"></i>
                                        {{ __('This consultation is specifically for real estate services.') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Client Information -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="client_name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="client_name" id="client_name" class="form-control @error('client_name') is-invalid @enderror" required value="{{ old('client_name', Auth::user()->name ?? '') }}" placeholder="{{ __('Enter your full name') }}">
                                        @error('client_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                        <div class="input-group phone-input-group">
                                            <select name="country_code" id="country_code" class="form-select country-code-select @error('country_code') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Country Code') }}</option>
                                                @foreach($countries ?? [] as $country)
                                                    @php
                                                        $currentLang = app()->getLocale();
                                                        $countryName = $currentLang === 'ar' ? ($country->name_ar ?? $country->name) : $country->name;
                                                    @endphp
                                                    <option value="+{{ $country->phone }}" {{ (old('country_code') ?: '+963') == '+'.$country->phone ? 'selected' : '' }}>
                                                        {{ $country->flag }} {{ $countryName }} (+{{ $country->phone }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="tel" name="client_phone" id="client_phone" class="form-control @error('client_phone') is-invalid @enderror" required value="{{ old('client_phone', Auth::user()->details->phone ?? '') }}" placeholder="{{ __('Enter your phone number') }}">
                                        </div>
                                        @error('country_code')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('client_phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="client_city" class="form-label">{{ __('City') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                                        <input type="text" name="client_city" id="client_city" class="form-control @error('client_city') is-invalid @enderror" value="{{ old('client_city', Auth::user()->details->city ?? '') }}" placeholder="{{ __('Enter your city') }}">
                                        @error('client_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="client_country" class="form-label">{{ __('Country') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                                        <input type="text" name="client_country" id="client_country" class="form-control @error('client_country') is-invalid @enderror" value="{{ old('client_country', Auth::user()->details->country ?? '') }}" placeholder="{{ __('Enter your country') }}">
                                        @error('client_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <!-- Submit Button -->
                            <div class="form-submit-wrapper">
                                <button type="submit" class="btn-submit-appointment">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>{{ __('Submit Appointment Request') }}</span>
                                    <div class="btn-shine"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Book Consultation Appointment Section End-->

@push('js')
<script>
    $(document).ready(function() {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        $('#appointment_date').attr('min', today);

        // Open date picker on focus for date field
        $('#appointment_date').on('focus', function() {
            // For modern browsers, focusing on date input opens the picker automatically
            // This ensures it works across all browsers
            if (this.showPicker) {
                this.showPicker();
            }
        });

        // Open time picker on focus for time field
        $('#appointment_time').on('focus', function() {
            // For modern browsers, focusing on time input opens the picker automatically
            // This ensures it works across all browsers
            if (this.showPicker) {
                this.showPicker();
            }
        });

        // Auto-select lawyer from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const lawyerId = urlParams.get('lawyer');
        if (lawyerId) {
            $('#lawyer_id').val(lawyerId).trigger('change');
        }

        // Form validation
        $('#consultationAppointmentForm').on('submit', function(e) {
            const appointmentDate = $('#appointment_date').val();
            const appointmentTime = $('#appointment_time').val();
            const clientPhone = $('#client_phone').val();
            const countryCode = $('#country_code').val();
            const lawyerId = $('#lawyer_id').val();
            const caseDetails = $('#case_details').val();
            const today = new Date().toISOString().split('T')[0];

            let isValid = true;
            let firstErrorField = null;

            // Lawyer selection is optional - no validation needed
            $('#lawyer_id').removeClass('is-invalid');

            // Validate appointment date
            if (!appointmentDate || appointmentDate < today) {
                isValid = false;
                $('#appointment_date').addClass('is-invalid').focus();
                if (!firstErrorField) firstErrorField = $('#appointment_date');
            } else {
                $('#appointment_date').removeClass('is-invalid');
            }

            // Validate appointment time
            if (!appointmentTime) {
                isValid = false;
                $('#appointment_time').addClass('is-invalid').focus();
                if (!firstErrorField) firstErrorField = $('#appointment_time');
            } else {
                $('#appointment_time').removeClass('is-invalid');
            }

            // Validate case details
            if (!caseDetails || caseDetails.trim().length < 10) {
                isValid = false;
                $('#case_details').addClass('is-invalid').focus();
                if (!firstErrorField) firstErrorField = $('#case_details');
            } else {
                $('#case_details').removeClass('is-invalid');
            }

            // Check if phone number is provided
            if (!clientPhone.trim()) {
                isValid = false;
                $('#client_phone').addClass('is-invalid').focus();
                if (!firstErrorField) firstErrorField = $('#client_phone');
            } else {
                $('#client_phone').removeClass('is-invalid');
            }

            // Check if country code is selected
            if (!countryCode) {
                isValid = false;
                $('#country_code').addClass('is-invalid').focus();
                if (!firstErrorField) firstErrorField = $('#country_code');
            } else {
                $('#country_code').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error field
                if (firstErrorField) {
                    $('html, body').animate({
                        scrollTop: firstErrorField.offset().top - 100
                    }, 500);
                }
                return false;
            }

            // Add loading state to submit button
            const submitBtn = $('.btn-submit-appointment');
            submitBtn.addClass('loading');
            submitBtn.prop('disabled', true);
        });

        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Lawyer Selection Functionality
        $('#lawyer_id').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const lawyerId = $(this).val();
            const lawyerInfo = $('#lawyer-info-display');

            if (lawyerId) {
                // Get lawyer data from option attributes
                const lawyerName = selectedOption.text().split(' - ')[0].trim();
                const department = selectedOption.data('department') || '';
                const specialty = selectedOption.data('specialty') || '';
                const lawyerSlug = selectedOption.data('slug') || '';
                const rating = parseFloat(selectedOption.data('rating')) || 0;
                const ratingCount = parseInt(selectedOption.data('rating-count')) || 0;

                // Update lawyer info display
                lawyerInfo.find('.lawyer-name').text(lawyerName);
                lawyerInfo.find('.lawyer-specialty').text(department + (specialty ? ` (${specialty})` : ''));

                // Show rating display and update with lawyer data
                const ratingDisplay = $('#lawyer-rating-display');
                const profileLink = $('#lawyer-profile-link');
                const profileUrl = $('#lawyer-profile-url');

                // Update profile link with correct URL
                if (lawyerSlug) {
                    const profileLinkUrl = `/lawyer-details/${lawyerSlug}`;
                    profileUrl.attr('href', profileLinkUrl);
                    profileLink.show();
                } else {
                    profileLink.hide();
                }

                // Update rating display
                if (rating > 0) {
                    updateLawyerRating(rating, ratingCount);
                    ratingDisplay.show();
                } else {
                    ratingDisplay.hide();
                }

                // Show and animate the info display
                lawyerInfo.addClass('show');

                // Load available times for selected lawyer if date is already selected
                const selectedDate = $('#appointment_date').val();
                if (selectedDate) {
                    loadLawyerAvailability(lawyerId, selectedDate);
                }

            } else {
                // Reset to default state
                lawyerInfo.find('.lawyer-name').text('{{ __("Select a lawyer to see details") }}');
                lawyerInfo.find('.lawyer-specialty').text('{{ __("Choose from the list above") }}');
                $('#lawyer-rating-display').hide();
                $('#lawyer-profile-link').hide();
                lawyerInfo.removeClass('show');
            }
        });



        // Update lawyer rating display
        function updateLawyerRating(averageRating, totalRatings) {
            $('#rating-score').text(averageRating);

            // Update star rating display
            const stars = $('#lawyer-rating-display .rating-stars i');
            const rating = parseFloat(averageRating);

            stars.each(function(index) {
                if (index < Math.floor(rating)) {
                    $(this).removeClass('far').addClass('fas');
                } else if (index === Math.floor(rating) && rating % 1 >= 0.5) {
                    $(this).removeClass('far').addClass('fas fa-star-half-alt');
                } else {
                    $(this).removeClass('fas fa-star-half-alt').addClass('far');
                }
            });

            $('#rating-count').text(totalRatings);
        }

        // Load lawyer availability
        function loadLawyerAvailability(lawyerId, date) {
            // This function can be used to load specific lawyer availability
            // For now, we'll show a loading state
            const timeSelect = $('#appointment_time');
            const currentValue = timeSelect.val();

            timeSelect.prop('disabled', true).html('<option value="">{{ __("Loading available times...") }}</option>');

            // Simulate loading (replace with actual AJAX call)
            setTimeout(function() {
                timeSelect.prop('disabled', false);
                // Reset to default state - actual implementation would load real data
                timeSelect.html('<option value="">{{ __("Select time") }}</option>');
                if (currentValue) {
                    timeSelect.val(currentValue);
                }
            }, 500);
        }

        // Update lawyer availability when date changes
        $('#appointment_date').on('change', function() {
            const selectedDate = $(this).val();
            const selectedLawyer = $('#lawyer_id').val();

            if (selectedDate && selectedLawyer) {
                loadLawyerAvailability(selectedLawyer, selectedDate);
            }
        });

        // Visual feedback for phone number
        $('#client_phone').on('input', function() {
            const phoneValue = $(this).val().trim();
            const countryCode = $('#country_code').val();
            const phoneIcon = $(this).closest('.col-md-6').find('.form-text i');

            if (phoneValue && countryCode) {
                phoneIcon.removeClass('fa-phone').addClass('fa-check-circle').css('color', '#28a745');
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                phoneIcon.removeClass('fa-check-circle').addClass('fa-phone').css('color', 'var(--colorPrimary)');
                $(this).removeClass('is-valid is-invalid');
            }
        });

        // Real-time validation feedback
        $('#case_type').on('input', function() {
            const value = $(this).val().trim();
            if (value.length >= 3) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else if (value.length > 0) {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-valid is-invalid');
            }
        });

        $('#case_details').on('input', function() {
            const value = $(this).val().trim();
            if (value.length >= 10) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else if (value.length > 0) {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-valid is-invalid');
            }
        });


        // Remove validation classes on focus
        $('.form-control, .form-select').on('focus', function() {
            $(this).removeClass('is-invalid');
        });

        // Initialize Select2 for country code dropdown
        $('#country_code').select2({
            placeholder: '{{ __("Select Country Code") }}',
            allowClear: false,
            width: '100%',
            language: {
                noResults: function() {
                    return '{{ __("No countries found") }}';
                },
                searching: function() {
                    return '{{ __("Searching...") }}';
                }
            }
        });

        // Update phone field when country code changes
        $('#country_code').on('change', function() {
            $('#client_phone').trigger('input');
        });

    });
</script>
@endpush

@push('css')
<style>
/* ============================================
   BOOK APPOINTMENT PAGE - ENHANCED DESIGN
   ============================================ */

/* Page Title Enhancement */
.page-title-area {
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 100px 0 80px;
}

.page-title-area::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
    z-index: 1;
}

.page-title-content {
    position: relative;
    z-index: 2;
    color: #fff;
    text-align: center;
}

.page-title-content .title {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.5);
}

.page-title-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.page-title-content ul li {
    color: rgba(255,255,255,0.9);
    font-size: 16px;
}

.page-title-content ul li a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    transition: color 0.3s ease;
}

.page-title-content ul li a:hover {
    color: #fff;
}

.page-title-content ul li span {
    color: #fff !important;
}

.page-title-content ul li:not(:last-child)::after {
    content: '›';
    margin-left: 10px;
    color: rgba(255,255,255,0.7);
}

/* Main Headline Enhancement */
.main-headline {
    margin-bottom: 50px;
}

.main-headline .title {
    font-size: 36px;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 15px;
    line-height: 1.3;
}

[dir="rtl"] .main-headline {
    text-align: right;
}

[dir="rtl"] .main-headline .title {
    text-align: right;
    direction: rtl;
}

.main-headline .title span {
    color: var(--colorPrimary);
    position: relative;
}

.main-headline .title span::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 2px;
}

.main-headline p {
    font-size: 17px;
    color: #666;
    line-height: 1.8;
    max-width: 700px;
    margin: 0 auto;
}

[dir="rtl"] .main-headline p {
    text-align: right;
    direction: rtl;
}

/* Appointment Form Card - Enhanced */
.appointment-form-card {
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    border-radius: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.appointment-form-card:hover {
    box-shadow: 0 15px 50px rgba(0,0,0,0.12);
}

.appointment-form-body {
    padding: 40px;
}

/* Alerts Enhancement */
.alert {
    border-radius: 12px;
    border: none;
    padding: 18px 20px;
    margin-bottom: 25px;
    font-size: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    color: #0c5460;
    border-left: 4px solid #17a2b8;
}

.alert i {
    font-size: 20px;
    flex-shrink: 0;
}

.alert .btn-close {
    margin-left: auto;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.alert .btn-close:hover {
    opacity: 1;
}

/* Form Labels Enhancement */
.form-label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 15px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

[dir="rtl"] .form-label {
    flex-direction: row-reverse;
    text-align: right;
    justify-content: flex-start;
}

.form-label i {
    color: var(--colorPrimary);
    font-size: 16px;
}

.form-label .text-danger {
    color: #dc3545 !important;
    font-weight: 700;
}

/* Form Controls Enhancement */
.form-control,
.form-select {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 18px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
}

[dir="rtl"] .form-control,
[dir="rtl"] .form-select {
    text-align: right;
    direction: rtl;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--colorPrimary);
    box-shadow: 0 0 0 4px rgba(200, 180, 126, 0.15);
    outline: none;
    background: #fff;
}

.form-control::placeholder {
    color: #adb5bd;
    opacity: 0.8;
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

/* Date and Time Inputs */
input[type="date"],
input[type="time"] {
    position: relative;
}

input[type="date"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

input[type="date"]::-webkit-calendar-picker-indicator:hover,
input[type="time"]::-webkit-calendar-picker-indicator:hover {
    opacity: 1;
}

/* Form Text Helper */
.form-text {
    font-size: 13px;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

[dir="rtl"] .form-text {
    flex-direction: row-reverse;
    text-align: right;
    direction: rtl;
    justify-content: flex-start;
}

.form-text.text-muted {
    color: #6c757d !important;
}

.form-text.text-primary {
    color: var(--colorPrimary) !important;
    font-weight: 500;
}

.form-text i {
    font-size: 12px;
}

/* Invalid Feedback */
.invalid-feedback {
    display: block;
    font-size: 13px;
    color: #dc3545;
    margin-top: 6px;
    font-weight: 500;
}

[dir="rtl"] .invalid-feedback {
    text-align: right;
    direction: rtl;
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6 .4.4.4-.4m0 4.8h-.8'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    animation: shake 0.3s ease-in-out;
}

.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%2328a745'%3e%3cpath d='M10 3L4.5 8.5L2 6' stroke-linecap='round' stroke-linejoin='round'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

[dir="rtl"] .form-control.is-invalid,
[dir="rtl"] .form-control.is-valid {
    background-position: left 15px center;
}

/* Submit Button - Enhanced */
.form-submit-wrapper {
    margin-top: 40px;
    text-align: center;
    padding-top: 30px;
    border-top: 2px solid #e9ecef;
}

.btn-submit-appointment {
    position: relative;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: #fff;
    border: none;
    padding: 18px 50px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 15px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(200, 180, 126, 0.4);
    display: inline-flex;
    align-items: center;
    gap: 12px;
    min-width: 280px;
    justify-content: center;
}

.btn-submit-appointment::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn-submit-appointment:hover::before {
    left: 100%;
}

.btn-submit-appointment:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(200, 180, 126, 0.5);
}

.btn-submit-appointment:active {
    transform: translateY(-1px);
}

.btn-submit-appointment i {
    font-size: 20px;
    transition: transform 0.3s ease;
}

.btn-submit-appointment:hover i {
    transform: scale(1.15) rotate(5deg);
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: shine 3s infinite;
}

@keyframes shine {
    0% {
        left: -100%;
    }
    50%, 100% {
        left: 100%;
    }
}

/* Section Dividers */
.mb-4 {
    margin-bottom: 30px !important;
}

.mb-3 {
    margin-bottom: 20px !important;
}

/* Form Groups Enhancement */
.form-group {
    position: relative;
}

/* Loading State */
.btn-submit-appointment.loading {
    pointer-events: none;
    opacity: 0.7;
}

.btn-submit-appointment.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-left: 10px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Focus Visible Enhancement */
.form-control:focus-visible,
.form-select:focus-visible {
    outline: 2px solid var(--colorPrimary);
    outline-offset: 2px;
}

/* Print Styles */
@media print {
    .appointment-form-card {
        box-shadow: none;
        border: 1px solid #000;
    }

    .btn-submit-appointment {
        display: none;
    }

    .alert {
        border: 1px solid #000;
    }
}

/* ============================================
   CLIENT INFORMATION SECTION ENHANCEMENTS
   ============================================ */

/* Client Info Header */
.client-info-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
}

.client-info-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
}

.client-info-header h5 {
    color: var(--colorPrimary);
    font-weight: 600;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
}

.client-info-header h5 i {
    color: var(--colorSecondary);
}

/* Contact Method Notice */
.contact-method-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: rgba(200, 180, 126, 0.05);
    border: 1px solid rgba(200, 180, 126, 0.2);
    border-radius: 8px;
    padding: 12px 16px;
    position: relative;
    z-index: 1;
}

.notice-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(200, 180, 126, 0.3);
}

.notice-text {
    flex: 1;
    font-size: 14px;
    line-height: 1.5;
    color: #555;
}

.notice-text strong {
    color: var(--colorPrimary);
    font-weight: 600;
}

/* Form Labels Enhancement */
.form-label small {
    font-weight: 400;
    opacity: 0.8;
}

.form-label .text-primary {
    color: var(--colorPrimary) !important;
    font-weight: 500;
}

.form-label .text-muted {
    color: #6c757d !important;
}


/* Phone Field Styling - Primary Contact */
#client_phone {
    border: 2px solid rgba(40, 167, 69, 0.3);
    background: linear-gradient(135deg, #ffffff 0%, #f8fff9 100%);
    position: relative;
}

#client_phone:focus {
    border-color: #28a745;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.15);
}

#client_phone::placeholder {
    color: #28a745;
    opacity: 0.7;
}


/* Form Text Enhancement */
.form-text {
    font-size: 12px;
    line-height: 1.4;
    margin-top: 4px;
}

.form-text.text-primary {
    color: var(--colorPrimary) !important;
}

.form-text.text-muted i {
    color: var(--colorPrimary);
    margin-right: 8px;
}

/* ============================================
   MOBILE RESPONSIVE IMPROVEMENTS
   ============================================ */

@media (max-width: 991px) {
    .page-title-content .title {
        font-size: 32px;
    }

    .main-headline .title {
        font-size: 28px;
    }

    .main-headline p {
        font-size: 16px;
    }

    .appointment-form-body {
        padding: 30px 25px;
    }
}

@media (max-width: 768px) {
    .page-title-area {
        padding: 80px 0 60px;
    }

    .page-title-content .title {
        font-size: 28px;
    }

    .main-headline {
        margin-bottom: 35px;
    }

    .main-headline .title {
        font-size: 24px;
    }

    .main-headline p {
        font-size: 15px;
    }

    .appointment-form-body {
        padding: 25px 20px;
    }

    .alert {
        padding: 15px 18px;
        font-size: 14px;
        flex-direction: column;
        align-items: flex-start;
    }

    .alert .btn-close {
        margin-left: 0;
        margin-top: 10px;
        align-self: flex-end;
    }

    .form-label {
        font-size: 14px;
    }

    .form-control,
    .form-select {
        padding: 11px 16px;
        font-size: 14px;
    }

    .btn-submit-appointment {
        padding: 16px 40px;
        font-size: 16px;
        min-width: 100%;
    }
    .client-info-header {
        padding: 16px;
        margin-bottom: 16px;
    }

    .contact-method-notice {
        flex-direction: column;
        gap: 10px;
        padding: 10px 12px;
    }

    .notice-icon {
        align-self: flex-start;
    }

    .notice-text {
        font-size: 13px;
    }

    .client-info-header h5 {
        font-size: 18px;
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .page-title-area {
        padding: 60px 0 50px;
    }

    .page-title-content .title {
        font-size: 24px;
    }

    .page-title-content ul {
        font-size: 14px;
    }

    .main-headline .title {
        font-size: 22px;
    }

    .main-headline p {
        font-size: 14px;
    }

    .appointment-form-body {
        padding: 20px 15px;
    }

    .alert {
        padding: 12px 15px;
        font-size: 13px;
    }

    .form-label {
        font-size: 13px;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        padding: 10px 14px;
        font-size: 14px;
        border-radius: 10px;
    }

    textarea.form-control {
        min-height: 100px;
    }

    .form-text {
        font-size: 12px;
    }

    .form-submit-wrapper {
        margin-top: 30px;
        padding-top: 25px;
    }

    .btn-submit-appointment {
        padding: 14px 30px;
        font-size: 15px;
        border-radius: 12px;
        width: 100%;
    }

    .contact-method-notice {
        gap: 8px;
        padding: 8px 10px;
    }

    .notice-icon {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }

    .notice-text {
        font-size: 12px;
    }

    .notice-text strong {
        display: block;
        margin-bottom: 4px;
    }

    .country-code-select {
        width: auto !important;
        min-width: 180px !important;
        font-size: 13px !important;
    }
    
    /* Ensure flag emojis display correctly on mobile */
    .country-code-select option {
        font-family: "Segoe UI Emoji", "Apple Color Emoji", "Noto Color Emoji", "EmojiOne Color", "Android Emoji", sans-serif !important;
    }

    .phone-input-group {
        flex-direction: column;
    }

    .country-code-select {
        width: auto !important;
        min-width: 180px !important;
        font-size: 12px !important;
        border-radius: 10px 10px 0 0 !important;
        border-bottom: none !important;
        border-bottom-right-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    .phone-input-group .form-control {
        border-radius: 0 0 10px 10px !important;
        border-left: 2px solid #e9ecef !important;
        border-top: none !important;
    }

    /* RTL Mobile Phone Input */
    [dir="rtl"] .phone-input-group {
        flex-direction: column;
    }

    [dir="rtl"] .country-code-select {
        border-radius: 10px 10px 0 0 !important;
        border-bottom: none !important;
        border-right: 2px solid #e9ecef !important;
        border-left: 2px solid #e9ecef !important;
    }

    [dir="rtl"] .phone-input-group .form-control {
        border-radius: 0 0 10px 10px !important;
        border-right: 2px solid #e9ecef !important;
        border-left: 2px solid #e9ecef !important;
        border-top: none !important;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.contact-method-notice {
    position: relative;
}

.contact-method-notice::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 3px;
    height: 100%;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 2px;
}

/* Focus States */
#client_phone:focus + .form-text {
    color: var(--colorPrimary) !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .contact-method-notice {
        border-color: #000;
        background: #fff;
    }

    .notice-icon {
        background: #000;
    }

    .client-info-header {
        border-color: #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .client-info-header::before,
    .contact-method-notice::before,
    .btn-shine,
    .btn-submit-appointment::before {
        display: none;
        animation: none !important;
    }

    .btn-submit-appointment:hover {
        transform: none;
    }
}

/* Additional RTL Fixes */
[dir="rtl"] .appointment-form-body {
    direction: rtl;
}

[dir="rtl"] .appointment-form-card {
    direction: rtl;
}

[dir="rtl"] .form-submit-wrapper {
    text-align: center;
}

[dir="rtl"] .main-headline p {
    text-align: right !important;
    direction: rtl !important;
}

/* Additional RTL Text Alignment Fixes */
[dir="rtl"] .appointment-form-body p,
[dir="rtl"] .appointment-form-body span:not(.text-danger):not(.text-primary):not(.text-muted),
[dir="rtl"] .appointment-form-body div:not(.row):not([class*="col-"]):not(.input-group):not(.phone-input-group):not(.form-check) {
    text-align: right !important;
}

/* Specific fixes for instructional text */
[dir="rtl"] .form-text.text-muted,
[dir="rtl"] small.form-text,
[dir="rtl"] small.text-muted {
    text-align: right !important;
    direction: rtl !important;
    display: block;
}

/* Fix for all input placeholders */
[dir="rtl"] input::placeholder,
[dir="rtl"] textarea::placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] input::-webkit-input-placeholder,
[dir="rtl"] textarea::-webkit-input-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] input::-moz-placeholder,
[dir="rtl"] textarea::-moz-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] input:-ms-input-placeholder,
[dir="rtl"] textarea:-ms-input-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .mb-4,
[dir="rtl"] .mb-3 {
    direction: rtl;
}

/* Input Group RTL */
[dir="rtl"] .input-group {
    flex-direction: row-reverse;
}

[dir="rtl"] .input-group-text {
    border-left: none;
    border-right: 2px solid #e9ecef;
}

[dir="rtl"] .input-group .form-control {
    border-right: none;
    border-left: 2px solid #e9ecef;
}

/* Date and Time Inputs RTL */
[dir="rtl"] input[type="date"],
[dir="rtl"] input[type="time"] {
    text-align: right;
    direction: rtl;
}

/* Select Dropdown RTL */
[dir="rtl"] .form-select {
    background-position: left 15px center;
    padding-right: 18px;
    padding-left: 40px;
}

/* Breadcrumb RTL */
[dir="rtl"] .page-title-content ul li a {
    text-align: right;
}

/* ============================================
   RTL SUPPORT - COMPREHENSIVE
   ============================================ */

/* Page Title RTL */
[dir="rtl"] .page-title-content {
    text-align: center;
}

[dir="rtl"] .page-title-content .title {
    text-align: center;
    direction: rtl;
}

[dir="rtl"] .page-title-content ul {
    flex-direction: row-reverse;
}

[dir="rtl"] .page-title-content ul li:not(:last-child)::after {
    content: '‹';
    margin-left: 0;
    margin-right: 10px;
}

/* Main Headline RTL */
[dir="rtl"] .main-headline {
    text-align: right !important;
}

[dir="rtl"] .main-headline .title {
    text-align: right !important;
}

[dir="rtl"] .main-headline .title span {
    text-align: right !important;
}

[dir="rtl"] .main-headline .title span::after {
    left: auto;
    right: 0;
}

[dir="rtl"] .main-headline p {
    text-align: right !important;
    direction: rtl !important;
}

/* Form Labels RTL */
[dir="rtl"] .form-label {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .form-label i {
    margin-left: 8px;
    margin-right: 0;
}

/* Form Controls RTL */
[dir="rtl"] .form-control,
[dir="rtl"] .form-select {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] textarea.form-control {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-control::placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-control::-webkit-input-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-control::-moz-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-control:-ms-input-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-control:-moz-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

/* Date and Time Inputs RTL - Force RTL */
[dir="rtl"] input[type="date"],
[dir="rtl"] input[type="time"] {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] input[type="date"]::-webkit-calendar-picker-indicator,
[dir="rtl"] input[type="time"]::-webkit-calendar-picker-indicator {
    left: 10px !important;
    right: auto !important;
}

/* Form Text RTL */
[dir="rtl"] .form-text {
    flex-direction: row-reverse;
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-text i {
    margin-left: 6px;
    margin-right: 0;
}

[dir="rtl"] .form-text.text-muted {
    text-align: right !important;
}

[dir="rtl"] .form-text.text-primary {
    text-align: right !important;
}

/* Alerts RTL */
[dir="rtl"] .alert {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .alert i {
    margin-left: 12px;
    margin-right: 0;
}

[dir="rtl"] .alert .btn-close {
    margin-left: 0;
    margin-right: auto;
}

[dir="rtl"] .alert-success,
[dir="rtl"] .alert-danger,
[dir="rtl"] .alert-info {
    border-left: none;
    border-right: 4px solid;
}

[dir="rtl"] .alert-success {
    border-right-color: #28a745;
}

[dir="rtl"] .alert-danger {
    border-right-color: #dc3545;
}

[dir="rtl"] .alert-info {
    border-right-color: #17a2b8;
}

/* Invalid/Valid Feedback RTL */
[dir="rtl"] .form-control.is-invalid,
[dir="rtl"] .form-control.is-valid {
    background-position: left 15px center;
    padding-right: 18px;
    padding-left: 45px;
}

/* Submit Button RTL */
[dir="rtl"] .btn-submit-appointment {
    flex-direction: row-reverse;
}

[dir="rtl"] .btn-submit-appointment i {
    margin-left: 12px;
    margin-right: 0;
}

[dir="rtl"] .btn-submit-appointment.loading::after {
    margin-left: 0;
    margin-right: 10px;
}

/* Phone Input Group RTL */
[dir="rtl"] .phone-input-group {
    flex-direction: row-reverse;
}

[dir="rtl"] .country-code-select {
    border-top-right-radius: 12px !important;
    border-bottom-right-radius: 12px !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-right: 2px solid #e9ecef !important;
    border-left: none !important;
}

[dir="rtl"] .phone-input-group .form-control {
    border-top-left-radius: 12px !important;
    border-bottom-left-radius: 12px !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border-left: 1px solid #dee2e6 !important;
    border-right: none !important;
}

[dir="rtl"] .phone-input-group .form-control:focus {
    border-left-color: var(--colorPrimary) !important;
    border-right-color: var(--colorPrimary) !important;
}

/* Client Info Header RTL */
[dir="rtl"] .client-info-header {
    text-align: right;
}

[dir="rtl"] .client-info-header::before {
    left: auto;
    right: 0;
}

[dir="rtl"] .client-info-header h5 {
    text-align: right;
}

[dir="rtl"] .client-info-header h5 i {
    margin-left: 8px;
    margin-right: 0;
}

/* Contact Method Notice RTL */
[dir="rtl"] .contact-method-notice {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .contact-method-notice .notice-icon {
    margin-left: 12px;
    margin-right: 0;
}

[dir="rtl"] .contact-method-notice .notice-text {
    text-align: right !important;
}

[dir="rtl"] .contact-method-notice .notice-text strong {
    text-align: right !important;
}

/* Form Row RTL */
[dir="rtl"] .row {
    direction: rtl;
}

[dir="rtl"] .col-md-6,
[dir="rtl"] .col-md-4 {
    direction: rtl;
}

/* Text Alignment RTL */
[dir="rtl"] .text-center {
    text-align: center !important;
}

[dir="rtl"] .text-start {
    text-align: right !important;
}

[dir="rtl"] .text-end {
    text-align: left !important;
}

/* Force all paragraphs and text to align right in RTL */
[dir="rtl"] p {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] span {
    text-align: right !important;
}

[dir="rtl"] div {
    text-align: inherit;
}

/* Force all labels to align right */
[dir="rtl"] label {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all headings to align right */
[dir="rtl"] h1,
[dir="rtl"] h2,
[dir="rtl"] h3,
[dir="rtl"] h4,
[dir="rtl"] h5,
[dir="rtl"] h6 {
    text-align: right !important;
    direction: rtl !important;
}

/* ============================================
   OPTIONAL FIELD INDICATORS
   ============================================ */

.form-label small.text-muted {
    font-size: 11px;
    font-weight: 400;
    margin-left: 6px;
    background: rgba(108, 117, 125, 0.1);
    padding: 2px 6px;
    border-radius: 10px;
    border: 1px solid rgba(108, 117, 125, 0.2);
}

[dir="rtl"] .form-label small.text-muted {
    margin-left: 0;
    margin-right: 6px;
}

/* ============================================
   PHONE INPUT WITH COUNTRY CODE
   ============================================ */

.phone-input-group {
    display: flex;
    align-items: stretch;
}

.country-code-select {
    width: auto !important;
    min-width: 200px !important;
    flex-shrink: 0;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border-right: none !important;
    font-size: 14px !important;
}

/* Ensure flag emojis display correctly */
.country-code-select option {
    font-family: "Segoe UI Emoji", "Apple Color Emoji", "Noto Color Emoji", "EmojiOne Color", "Android Emoji", sans-serif !important;
    font-size: 14px !important;
    padding: 8px 12px !important;
}

.country-code-select option::before {
    content: '';
}

/* Fix flag display in select2 dropdown */
.select2-results__option {
    font-family: "Segoe UI Emoji", "Apple Color Emoji", "Noto Color Emoji", "EmojiOne Color", "Android Emoji", sans-serif !important;
}

.country-code-select:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: none !important;
    z-index: 3;
}

.phone-input-group .form-control {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-left: 1px solid #dee2e6 !important;
}

.phone-input-group .form-control:focus {
    border-left-color: var(--colorPrimary) !important;
    z-index: 2;
}

/* ============================================
   VISUAL HIERARCHY IMPROVEMENTS
   ============================================ */

.client-info-header h5 {
    border-bottom: 2px solid rgba(200, 180, 126, 0.2);
    padding-bottom: 8px;
    display: inline-block;
}

/* Field Groups */
.row .col-md-6 {
    position: relative;
}

/* Primary vs Optional Field Distinction */
.col-md-6:has(#client_phone) {
    order: -1; /* Phone field comes first */
}


/* ============================================
   LAWYER SELECTION ENHANCEMENTS
   ============================================ */

/* Lawyer Selection Wrapper */
.lawyer-selection-wrapper {
    position: relative;
}

/* Lawyer Select Styling */
.lawyer-select {
    padding-right: 50px !important;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    border: 2px solid #e9ecef !important;
    border-radius: 10px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    color: #333 !important;
    transition: all 0.3s ease !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
}

/* Custom option styling for better rating display */
.lawyer-select option {
    padding: 8px 12px !important;
    background: #fff !important;
    color: #333 !important;
}

.lawyer-select:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15) !important;
    background: #fff !important;
    outline: none !important;
}

.lawyer-select:hover {
    border-color: var(--colorPrimary) !important;
    background: #fff !important;
}

/* Custom Dropdown Arrow */
.lawyer-select {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c8b47e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 15px center !important;
    background-size: 20px !important;
}

[dir="rtl"] .lawyer-select {
    background-position: left 15px center !important;
    padding-right: 15px !important;
    padding-left: 50px !important;
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .lawyer-select option {
    text-align: right;
    direction: rtl;
}

/* Lawyer Info Display RTL */
[dir="rtl"] .lawyer-info-display {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .lawyer-details {
    text-align: right;
}

[dir="rtl"] .lawyer-name,
[dir="rtl"] .lawyer-specialty {
    text-align: right;
}

[dir="rtl"] .lawyer-rating {
    flex-direction: row-reverse;
    justify-content: flex-start;
}

[dir="rtl"] .rating-stars i {
    margin-right: 0;
    margin-left: 1px;
}

[dir="rtl"] .lawyer-profile-link {
    text-align: right;
}

/* Lawyer Info Display */
.lawyer-info-display {
    display: flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    margin-top: 12px;
    transition: all 0.3s ease;
    opacity: 0.7;
}

[dir="rtl"] .lawyer-info-display {
    flex-direction: row-reverse;
    text-align: right;
    direction: rtl;
}

.lawyer-info-display.show {
    opacity: 1;
    border-color: var(--colorPrimary);
    box-shadow: 0 2px 8px rgba(200, 180, 126, 0.1);
}

.lawyer-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
    flex-shrink: 0;
}

.lawyer-details {
    flex: 1;
    min-width: 0;
}

.lawyer-name {
    font-weight: 600;
    color: var(--colorPrimary);
    font-size: 16px;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

[dir="rtl"] .lawyer-name {
    text-align: right;
    direction: rtl;
}

.lawyer-specialty {
    font-size: 13px;
    color: #666;
    font-weight: 400;
}

[dir="rtl"] .lawyer-specialty {
    text-align: right;
    direction: rtl;
}

/* Lawyer Rating Display */
.lawyer-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 4px;
}

.rating-stars {
    color: #ffc107;
    font-size: 12px;
}

.rating-stars i {
    margin-right: 1px;
}

.rating-text {
    font-size: 12px;
    color: #666;
}

/* Lawyer Profile Link */
.lawyer-profile-link {
    margin-top: 8px;
}

.lawyer-profile-link .btn {
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.lawyer-profile-link .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* ============================================
   MOBILE RESPONSIVE LAWYER SELECTION
   ============================================ */

@media (max-width: 768px) {
    .lawyer-info-display {
        padding: 12px;
        gap: 10px;
    }

    .lawyer-avatar {
        width: 45px;
        height: 45px;
        font-size: 18px;
    }

    .lawyer-name {
        font-size: 15px;
    }

    .lawyer-specialty {
        font-size: 12px;
    }

    .lawyer-profile-link .btn {
        font-size: 10px;
        padding: 3px 6px;
    }

    .rating-stars {
        font-size: 11px;
    }

    .rating-text {
        font-size: 11px;
    }
}

@media (max-width: 576px) {
    .lawyer-selection-wrapper {
        margin-bottom: 15px;
    }

    .lawyer-info-display {
        padding: 10px;
        gap: 8px;
    }

    .lawyer-avatar {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }

    .lawyer-name {
        font-size: 14px;
    }

    .lawyer-specialty {
        font-size: 11px;
    }

    .lawyer-profile-link .btn {
        font-size: 9px;
        padding: 2px 4px;
    }

    .rating-stars {
        font-size: 10px;
    }

    .rating-text {
        font-size: 10px;
    }
}

/* ============================================
   LAWYER SELECTION ANIMATIONS
   ============================================ */

.lawyer-info-display {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Focus States */
.lawyer-select:focus + .lawyer-info-display {
    opacity: 1;
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.lawyer-select:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15) !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .lawyer-info-display {
        border-color: #000;
        background: #fff;
    }

    .lawyer-select {
        border-width: 3px !important;
        border-color: #000 !important;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .lawyer-info-display {
        animation: none !important;
    }

    .lawyer-select {
        transition: none !important;
    }
}

/* ============================================
   PROPERTY INFORMATION CARD - ENHANCED DESIGN
   ============================================ */

.property-info-card {
    margin-bottom: 30px;
}

.property-info-wrapper {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 2px solid var(--colorPrimary);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(200, 180, 126, 0.15);
    transition: all 0.3s ease;
}

.property-info-wrapper:hover {
    box-shadow: 0 12px 40px rgba(200, 180, 126, 0.25);
    transform: translateY(-2px);
}

.property-info-header {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    color: #fff;
    padding: 20px 25px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.property-info-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.property-info-title h5 {
    color: #fff;
    font-weight: 700;
    font-size: 20px;
    margin-bottom: 4px;
}

.property-info-title p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
    margin: 0;
}

.property-info-content {
    padding: 25px;
}

.property-info-image {
    width: 100%;
    height: 200px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.property-info-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.property-info-image:hover img {
    transform: scale(1.05);
}

.property-info-main {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.property-title {
    font-size: 22px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
    line-height: 1.3;
}

.property-location-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #666;
    font-size: 15px;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

[dir="ltr"] .property-location-info {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.property-location-info i {
    color: var(--colorPrimary);
    font-size: 16px;
    order: 1 !important;
    flex-shrink: 0;
    margin-left: 0.5rem;
}

[dir="ltr"] .property-location-info i {
    order: 1 !important;
    margin-left: 0.5rem;
    margin-right: 0;
}

.property-location-info span {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
}

[dir="ltr"] .property-location-info span {
    order: 2 !important;
    direction: rtl !important;
    text-align: right !important;
}

.property-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.property-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 1px solid #e9ecef;
    border-radius: 12px;
    transition: all 0.3s ease;
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

[dir="ltr"] .property-info-item {
    direction: rtl !important;
    text-align: right !important;
    justify-content: flex-end !important;
}

.property-info-item:hover {
    border-color: var(--colorPrimary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(200, 180, 126, 0.15);
}

.property-info-item.highlight {
    background: linear-gradient(135deg, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.1) 0%, rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.05) 100%);
    border-color: var(--colorPrimary);
}

.info-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
    min-width: 0;
}

.info-label {
    display: block;
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
    font-weight: 600;
}

.info-value {
    display: block;
    font-size: 15px;
    color: #2c3e50;
    font-weight: 600;
}

.info-value.price-value {
    color: var(--colorPrimary);
    font-size: 18px;
    font-weight: 700;
}

.property-contact-info {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 20px;
}

.contact-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 15px;
}

.contact-header i {
    color: var(--colorPrimary);
    font-size: 18px;
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #555;
}

.contact-item i {
    color: var(--colorPrimary);
    width: 18px;
    text-align: center;
}

.contact-item a {
    color: var(--colorPrimary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.contact-item a:hover {
    color: var(--colorSecondary);
    text-decoration: underline;
}

.property-info-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.1) 0%, rgba(200, 180, 126, 0.05) 100%);
    border: 1px solid rgba(200, 180, 126, 0.3);
    border-radius: 12px;
    padding: 15px;
}

.notice-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
}

.notice-text {
    flex: 1;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .property-info-header {
        padding: 18px 20px;
        flex-direction: column;
        text-align: center;
    }

    .property-info-icon {
        width: 45px;
        height: 45px;
        font-size: 22px;
    }

    .property-info-title h5 {
        font-size: 18px;
    }

    .property-info-content {
        padding: 20px;
    }

    .property-info-image {
        height: 180px;
        margin-bottom: 18px;
    }

    .property-title {
        font-size: 20px;
    }

    .property-info-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .property-info-item {
        padding: 12px;
        flex-direction: column;
        text-align: center;
    }

    .info-icon {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }

    .info-value.price-value {
        font-size: 16px;
    }

    .property-contact-info {
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .property-info-header {
        padding: 15px;
    }

    .property-info-content {
        padding: 15px;
    }

    .property-info-image {
        height: 150px;
    }

    .property-title {
        font-size: 18px;
    }

    .property-info-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .property-info-item {
        padding: 12px;
    }

    .info-value.price-value {
        font-size: 15px;
    }

    .contact-details {
        gap: 8px;
    }
}

/* Property Info Card RTL */
[dir="rtl"] .property-info-card {
    direction: rtl;
    text-align: right;
}

[dir="rtl"] .property-info-header {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .property-info-icon {
    margin-left: 15px;
    margin-right: 0;
}

[dir="rtl"] .property-info-title {
    text-align: right;
}

[dir="rtl"] .property-info-title h5 {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .property-info-title p {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .property-info-content {
    text-align: right;
}

[dir="rtl"] .property-info-main {
    text-align: right;
}

[dir="rtl"] .property-title {
    text-align: right;
}

[dir="rtl"] .property-location-info {
    flex-direction: row-reverse;
    justify-content: flex-start;
}

[dir="rtl"] .property-location-info i {
    margin-left: 8px;
    margin-right: 0;
}

[dir="rtl"] .property-info-item {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .info-content {
    text-align: right;
}

[dir="rtl"] .info-label,
[dir="rtl"] .info-value {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .info-content {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .property-contact-info {
    text-align: right;
}

[dir="rtl"] .contact-header {
    flex-direction: row-reverse;
    justify-content: flex-start;
}

[dir="rtl"] .contact-header i {
    margin-left: 10px;
    margin-right: 0;
}

[dir="rtl"] .contact-item {
    flex-direction: row-reverse;
    justify-content: flex-start;
}

[dir="rtl"] .contact-item i {
    margin-left: 10px;
    margin-right: 0;
}

[dir="rtl"] .property-info-notice {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .property-info-notice .notice-icon {
    margin-left: 12px;
    margin-right: 0;
}

[dir="rtl"] .property-info-notice .notice-text {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .property-info-main {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .property-title {
    text-align: right;
    direction: rtl;
}

/* Property Info Grid RTL */
[dir="rtl"] .property-info-grid {
    direction: rtl;
}

/* Form Groups RTL */
[dir="rtl"] .form-group {
    direction: rtl;
}

/* Small Text RTL */
[dir="rtl"] small {
    display: inline-block;
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .form-label small {
    text-align: right !important;
}

[dir="rtl"] .form-label small.text-muted {
    text-align: right !important;
}

[dir="rtl"] .form-label small.text-primary {
    text-align: right !important;
}

/* Invalid Feedback RTL */
[dir="rtl"] .invalid-feedback {
    text-align: right !important;
    direction: rtl !important;
}

/* Valid Feedback RTL */
[dir="rtl"] .valid-feedback {
    text-align: right !important;
    direction: rtl !important;
}

/* Button Groups RTL */
[dir="rtl"] .btn-group {
    flex-direction: row-reverse;
}

/* Dropdown RTL */
[dir="rtl"] .dropdown-menu {
    text-align: right;
    right: 0;
    left: auto;
}

/* Tooltip RTL */
[dir="rtl"] .tooltip {
    direction: rtl;
}

/* Modal RTL */
[dir="rtl"] .modal-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .modal-header .btn-close {
    margin-left: 0;
    margin-right: auto;
}

/* Card RTL */
[dir="rtl"] .card {
    direction: rtl;
    text-align: right;
}

[dir="rtl"] .card-header {
    text-align: right;
}

[dir="rtl"] .card-body {
    text-align: right;
}

[dir="rtl"] .card-footer {
    text-align: right;
}

/* List RTL */
[dir="rtl"] ul,
[dir="rtl"] ol {
    padding-right: 20px;
    padding-left: 0;
}

[dir="rtl"] .list-group {
    text-align: right;
}

[dir="rtl"] .list-group-item {
    text-align: right;
}

/* Table RTL */
[dir="rtl"] table {
    direction: rtl;
}

[dir="rtl"] th,
[dir="rtl"] td {
    text-align: right;
}

/* Pagination RTL */
[dir="rtl"] .pagination {
    flex-direction: row-reverse;
}

/* Badge RTL */
[dir="rtl"] .badge {
    direction: rtl;
}

/* Spinner RTL */
[dir="rtl"] .spinner-border,
[dir="rtl"] .spinner-grow {
    direction: rtl;
}

/* Progress Bar RTL */
[dir="rtl"] .progress {
    direction: rtl;
}

/* Toast RTL */
[dir="rtl"] .toast {
    direction: rtl;
    text-align: right;
}

[dir="rtl"] .toast-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .toast-header .btn-close {
    margin-left: 0;
    margin-right: auto;
}

/* Ensure text direction for all form elements */
[dir="rtl"] input,
[dir="rtl"] textarea,
[dir="rtl"] select {
    direction: rtl !important;
    text-align: right !important;
}

/* Ensure all labels are right-aligned in RTL */
[dir="rtl"] label {
    text-align: right !important;
    direction: rtl !important;
}

/* Ensure all headings are right-aligned in RTL */
[dir="rtl"] h1,
[dir="rtl"] h2,
[dir="rtl"] h3,
[dir="rtl"] h4,
[dir="rtl"] h5,
[dir="rtl"] h6 {
    text-align: right !important;
    direction: rtl !important;
}

/* Ensure all paragraphs are right-aligned in RTL */
[dir="rtl"] p {
    text-align: right !important;
    direction: rtl !important;
}

/* Ensure all spans are right-aligned in RTL */
[dir="rtl"] span {
    text-align: right !important;
    direction: rtl !important;
}

/* Force RTL for all text inputs */
[dir="rtl"] input[type="text"],
[dir="rtl"] input[type="tel"],
[dir="rtl"] input[type="date"],
[dir="rtl"] input[type="time"],
[dir="rtl"] input[type="search"] {
    direction: rtl !important;
    text-align: right !important;
}

/* Keep LTR for technical inputs */
[dir="rtl"] input[type="number"],
[dir="rtl"] input[type="email"],
[dir="rtl"] input[type="url"] {
    direction: ltr !important;
    text-align: left !important;
}

/* But force placeholder alignment to right for Arabic */
[dir="rtl"] input[type="email"]::placeholder,
[dir="rtl"] input[type="email"]::-webkit-input-placeholder,
[dir="rtl"] input[type="email"]::-moz-placeholder,
[dir="rtl"] input[type="email"]:-ms-input-placeholder {
    text-align: right !important;
    direction: rtl !important;
}

/* Ensure icons don't flip */
[dir="rtl"] i,
[dir="rtl"] .fas,
[dir="rtl"] .far,
[dir="rtl"] .fab,
[dir="rtl"] .fal {
    transform: none;
}

/* Fix for checkboxes and radio buttons */
[dir="rtl"] .form-check {
    padding-right: 1.5em;
    padding-left: 0;
}

[dir="rtl"] .form-check-input {
    margin-right: -1.5em;
    margin-left: 0;
    float: right;
}

[dir="rtl"] .form-check-label {
    padding-right: 0.5em;
    padding-left: 0;
    text-align: right !important;
}

/* Comprehensive RTL Text Alignment - Force all text elements to align right */
[dir="rtl"] .appointment-form-card,
[dir="rtl"] .appointment-form-body {
    direction: rtl !important;
}

[dir="rtl"] .appointment-form-body > * {
    direction: rtl !important;
}

/* Force all text content in form to align right */
[dir="rtl"] .appointment-form-body p,
[dir="rtl"] .appointment-form-body span:not(.text-danger):not(.text-primary),
[dir="rtl"] .appointment-form-body div:not(.row):not([class*="col-"]):not(.input-group):not(.phone-input-group):not(.form-check):not(.alert) {
    text-align: right !important;
}

/* Force all labels and their text to align right */
[dir="rtl"] .form-label,
[dir="rtl"] .form-label * {
    text-align: right !important;
}

/* Force all small text and helper text to align right */
[dir="rtl"] small,
[dir="rtl"] .small,
[dir="rtl"] .form-text {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all input values and placeholders to align right */
[dir="rtl"] input[type="text"],
[dir="rtl"] input[type="tel"],
[dir="rtl"] input[type="date"],
[dir="rtl"] input[type="time"],
[dir="rtl"] textarea {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] input[type="text"]::placeholder,
[dir="rtl"] input[type="tel"]::placeholder,
[dir="rtl"] input[type="date"]::placeholder,
[dir="rtl"] input[type="time"]::placeholder,
[dir="rtl"] textarea::placeholder {
    text-align: right !important;
    direction: rtl !important;
}

/* Force select dropdowns to align right */
[dir="rtl"] select,
[dir="rtl"] .form-select {
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] select option {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all headings to align right */
[dir="rtl"] .main-headline h2,
[dir="rtl"] .main-headline .title,
[dir="rtl"] .client-info-header h5,
[dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3,
[dir="rtl"] h4, [dir="rtl"] h5, [dir="rtl"] h6 {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all paragraphs to align right */
[dir="rtl"] p {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all list items to align right */
[dir="rtl"] ul,
[dir="rtl"] ol,
[dir="rtl"] li {
    text-align: right !important;
    direction: rtl !important;
}

/* Force all divs with text to align right (except structural divs) */
[dir="rtl"] div:not(.row):not([class*="col-"]):not(.input-group):not(.phone-input-group):not(.form-check):not(.alert):not(.btn-group) {
    text-align: right !important;
}

/* Override any inline styles or conflicting styles */
[dir="rtl"] * {
    unicode-bidi: embed;
}

[dir="rtl"] input,
[dir="rtl"] textarea,
[dir="rtl"] select {
    unicode-bidi: embed;
}

/* Ensure proper text direction inheritance */
[dir="rtl"] body,
[dir="rtl"] html {
    direction: rtl !important;
    text-align: right !important;
}
</style>
@endpush

@endsection

