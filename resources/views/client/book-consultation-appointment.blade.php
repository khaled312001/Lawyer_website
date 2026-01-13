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
                <div class="card shadow-sm">
                    <div class="card-body p-4">
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

                        <form action="{{ route('website.create.consultation.appointment') }}" method="POST" id="consultationAppointmentForm">
                            @csrf
                            <input type="hidden" name="service" value="{{ request('service') }}">
                            <input type="hidden" name="property" value="{{ request('property') }}">
                            
                            <!-- Lawyer Selection -->
                            <div class="mb-4">
                                <label for="lawyer_id" class="form-label">
                                    <i class="fas fa-user-tie me-2"></i>{{ __('Select Lawyer') }} <span class="text-danger">*</span>
                                </label>
                                <div class="lawyer-selection-wrapper">
                                    <select name="lawyer_id" id="lawyer_id" class="form-select lawyer-select @error('lawyer_id') is-invalid @enderror" required>
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
                                    <i class="fas fa-info-circle me-1"></i>{{ __('Select the lawyer you want to consult with') }}
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


                            <!-- Case Details -->
                            <div class="mb-4">
                                <label for="case_details" class="form-label">
                                    <i class="fas fa-file-alt me-2"></i>{{ __('Case Details') }} <span class="text-danger">*</span>
                                </label>
                                <textarea name="case_details" id="case_details" class="form-control @error('case_details') is-invalid @enderror" rows="5" required placeholder="{{ request('service') === 'real_estate' ? __('Provide details about the property consultation you need...') : __('Provide detailed information about your case...') }}">{{ old('case_details', request('service') === 'real_estate' ? 'Property consultation regarding real estate transaction.' : '') }}</textarea>
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
                                <div class="client-info-header">
                                    <h5 class="mb-2"><i class="fas fa-user me-2"></i>{{ __('Client Information') }}</h5>
                                    <div class="contact-method-notice">
                                        <div class="notice-icon">
                                            <i class="fas fa-phone-square"></i>
                                        </div>
                                        <div class="notice-text">
                                            <strong>{{ __('Primary Contact Method:') }}</strong> {{ __('We will contact you via phone for appointment confirmation and updates.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="client_name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="client_name" id="client_name" class="form-control @error('client_name') is-invalid @enderror" required value="{{ old('client_name', Auth::user()->name ?? '') }}" placeholder="{{ __('Enter your full name') }}">
                                        @error('client_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span> <small class="text-primary">({{ __('Primary Contact') }})</small></label>
                                        <div class="input-group phone-input-group">
                                            <select name="country_code" id="country_code" class="form-select country-code-select @error('country_code') is-invalid @enderror">
                                                <option value="+963" {{ (old('country_code') ?: '+963') == '+963' ? 'selected' : '' }}>🇸🇾 +963</option>
                                                <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                                <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                                <option value="+49" {{ old('country_code') == '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                                <option value="+33" {{ old('country_code') == '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                                <option value="+966" {{ old('country_code') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                                <option value="+971" {{ old('country_code') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                                <option value="+20" {{ old('country_code') == '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                                <option value="+962" {{ old('country_code') == '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                                <option value="+961" {{ old('country_code') == '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                                <option value="+964" {{ old('country_code') == '+964' ? 'selected' : '' }}>🇮🇶 +964</option>
                                                <option value="+965" {{ old('country_code') == '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                                <option value="+974" {{ old('country_code') == '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                                <option value="+973" {{ old('country_code') == '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                                <option value="+968" {{ old('country_code') == '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                                <option value="+970" {{ old('country_code') == '+970' ? 'selected' : '' }}>🇵🇸 +970</option>
                                            </select>
                                            <input type="tel" name="client_phone" id="client_phone" class="form-control @error('client_phone') is-invalid @enderror" required value="{{ old('client_phone', Auth::user()->details->phone ?? '') }}" placeholder="{{ __('Enter your phone number') }}">
                                        </div>
                                        @error('country_code')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('client_phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-primary">
                                            <i class="fas fa-phone me-1"></i>{{ __('We will contact you through this number for appointment confirmation') }}
                                        </small>
                                    </div>
                                </div>
                            </div>



                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-calendar-check me-2"></i>{{ __('Submit Appointment Request') }}
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
            const today = new Date().toISOString().split('T')[0];

            if (appointmentDate < today) {
                e.preventDefault();
                alert('{{ __("Appointment date must be today or later") }}');
                return false;
            }

            if (!appointmentTime) {
                e.preventDefault();
                alert('{{ __("Please select an appointment time") }}');
                return false;
            }

            // Check if phone number is provided
            if (!clientPhone.trim()) {
                e.preventDefault();
                alert('{{ __("Phone number is required for appointment confirmation") }}');
                $('#client_phone').focus();
                return false;
            }

            // Check if country code is selected
            if (!countryCode) {
                e.preventDefault();
                alert('{{ __("Please select your country code") }}');
                $('#country_code').focus();
                return false;
            }
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

@media (max-width: 768px) {
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
        width: 80px !important;
        font-size: 13px !important;
    }

    .phone-input-group {
        flex-direction: column;
    }

    .country-code-select {
        width: 70px !important;
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
    .contact-method-notice::before {
        display: none;
    }
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
    width: 90px !important;
    flex-shrink: 0;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border-right: none !important;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
    font-weight: 600 !important;
    font-size: 14px !important;
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

.lawyer-specialty {
    font-size: 13px;
    color: #666;
    font-weight: 400;
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
</style>
@endpush

@endsection

