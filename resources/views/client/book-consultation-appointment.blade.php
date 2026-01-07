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
                            
                            <!-- Appointment Date & Time -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_date" class="form-label">
                                        <i class="fas fa-calendar-alt me-2"></i>{{ __('Appointment Date') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" required min="{{ date('Y-m-d') }}">
                                    <small class="form-text text-muted">{{ __('Please select a date for your consultation') }}</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_time" class="form-label">
                                        <i class="fas fa-clock me-2"></i>{{ __('Appointment Time') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
                                    <small class="form-text text-muted">{{ __('Please select a time for your consultation') }}</small>
                                </div>
                            </div>

                            <!-- Department & Case Type -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="department_id" class="form-label">
                                        <i class="fas fa-building me-2"></i>{{ __('Department') }} <span class="text-danger">*</span>
                                    </label>
                                    <select name="department_id" id="department_id" class="form-select" required>
                                        <option value="">{{ __('Select Department') }}</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->translation->name ?? $department->name ?? __('Department') }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">{{ __('Select the department related to your case') }}</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="case_type" class="form-label">
                                        <i class="fas fa-gavel me-2"></i>{{ __('Case Type') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="case_type" id="case_type" class="form-control" required placeholder="{{ __('e.g., Criminal, Civil, Family, Commercial, Contract, etc.') }}">
                                    <small class="form-text text-muted">{{ __('Specify the type of your case') }}</small>
                                </div>
                            </div>

                            <!-- Case Details -->
                            <div class="mb-4">
                                <label for="case_details" class="form-label">
                                    <i class="fas fa-file-alt me-2"></i>{{ __('Case Details') }} <span class="text-danger">*</span>
                                </label>
                                <textarea name="case_details" id="case_details" class="form-control" rows="5" required placeholder="{{ __('Provide detailed information about your case...') }}"></textarea>
                                <small class="form-text text-muted">{{ __('Please provide comprehensive details about your case') }}</small>
                            </div>

                            <!-- Client Information -->
                            <div class="mb-4">
                                <h5 class="mb-3"><i class="fas fa-user me-2"></i>{{ __('Client Information') }}</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="client_name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="client_name" id="client_name" class="form-control" required value="{{ Auth::user()->name ?? '' }}" placeholder="{{ __('Enter your full name') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                        <input type="email" name="client_email" id="client_email" class="form-control" required value="{{ Auth::user()->email ?? '' }}" placeholder="{{ __('Enter your email address') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                        <input type="tel" name="client_phone" id="client_phone" class="form-control" required value="{{ Auth::user()->details->phone ?? '' }}" placeholder="{{ __('Enter your phone number') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_city" class="form-label">{{ __('City') }}</label>
                                        <input type="text" name="client_city" id="client_city" class="form-control" value="{{ Auth::user()->details->city ?? '' }}" placeholder="{{ __('Enter your city') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_country" class="form-label">{{ __('Country') }}</label>
                                        <input type="text" name="client_country" id="client_country" class="form-control" value="{{ Auth::user()->details->country ?? '' }}" placeholder="{{ __('Enter your country') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="client_address" class="form-label">{{ __('Address') }}</label>
                                        <input type="text" name="client_address" id="client_address" class="form-control" value="{{ Auth::user()->details->address ?? '' }}" placeholder="{{ __('Enter your address') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Problem Description -->
                            <div class="mb-4">
                                <label for="problem_description" class="form-label">
                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ __('Problem Description') }} <span class="text-danger">*</span>
                                </label>
                                <textarea name="problem_description" id="problem_description" class="form-control" rows="6" required placeholder="{{ __('Describe your problem in detail...') }}"></textarea>
                                <small class="form-text text-muted">{{ __('Please provide a detailed description of the problem you are facing') }}</small>
                            </div>

                            <!-- Additional Information -->
                            <div class="mb-4">
                                <label for="additional_info" class="form-label">
                                    <i class="fas fa-info-circle me-2"></i>{{ __('Additional Information') }}
                                </label>
                                <textarea name="additional_info" id="additional_info" class="form-control" rows="4" placeholder="{{ __('Any additional information you would like to share...') }}"></textarea>
                                <small class="form-text text-muted">{{ __('Optional: Any other relevant information') }}</small>
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

        // Form validation
        $('#consultationAppointmentForm').on('submit', function(e) {
            const appointmentDate = $('#appointment_date').val();
            const appointmentTime = $('#appointment_time').val();
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
        });
    });
</script>
@endpush

@endsection

