@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Book an appointment today') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Book an appointment with our lawyers') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Book an appointment today') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Book Appointment') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!--Book Appointment Section Start-->
<section class="book-appointment-page pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                <div class="main-headline text-center mb_50">
                    <h2 class="title"><span>{{ __('Book an appointment') }}</span> {{ __('today') }}</h2>
                    <p>{{ __('At our platform, you can always connect with a lawyer who listens, offers advice, and helps you move forward in your legal matters. This means you get quick answers and suggestions of solutions to your issues, so you can let go of your worries and feel confident about what to do next.') }}</p>
                    <p>{{ __('A video meeting is ideal when you need answers to your questions and guidance on how to handle your case.') }}</p>
                </div>
            </div>
        </div>

        <!--Duration Selection-->
        <div class="row mb_40">
            <div class="col-12 text-center">
                <div class="duration-selector">
                    <span class="duration-label">{{ __('Select Duration') }}:</span>
                    <button class="duration-btn active" data-duration="15">15 {{ __('min') }}</button>
                    <button class="duration-btn" data-duration="30">30 {{ __('min') }}</button>
                    <button class="duration-btn" data-duration="60">60 {{ __('min') }}</button>
                </div>
            </div>
        </div>

        <!--Lawyers List-->
        <div class="row" id="lawyers-list">
            @foreach ($lawyers as $lawyer)
                <div class="col-lg-6 col-md-12 mb_30 lawyer-card" data-lawyer-id="{{ $lawyer->id }}">
                    <div class="lawyer-booking-card">
                        <div class="lawyer-card-header">
                            <div class="lawyer-info">
                                @if($lawyer->image)
                                    <div class="lawyer-avatar mb-3">
                                        <img src="{{ asset($lawyer->image) }}" alt="{{ $lawyer->name }}" class="lawyer-img">
                                    </div>
                                @endif
                                <h3 class="lawyer-name">{{ $lawyer->name }}</h3>
                                <div class="lawyer-specialties">
                                    @if($lawyer->department)
                                        <span class="specialty-badge">
                                            <i class="fas fa-briefcase me-1"></i>{{ $lawyer->department->name ?? '' }}
                                        </span>
                                    @endif
                                    @if ($lawyer->designations)
                                        <span class="specialty-badge">
                                            <i class="fas fa-graduation-cap me-1"></i>{{ $lawyer->designations }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="lawyer-availability" data-lawyer-id="{{ $lawyer->id }}">
                            <div class="loading-spinner text-center py-4">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p class="mt-2 mb-0">{{ __('Loading available times...') }}</p>
                            </div>
                        </div>
                        
                        <div class="lawyer-fee mt-3">
                            <span class="fee-label">{{ __('Fee') }}:</span>
                            <span class="fee-amount">{{ session()->get('currency_icon', '$') }}{{ $lawyer->fee ?? 0 }}</span>
                        </div>

                        <div class="lawyer-card-footer">
                            <a href="{{ route('website.lawyer.details', $lawyer->slug) }}" class="btn btn-outline-primary btn-sm">
                                {{ __('View Profile') }}
                            </a>
                            <button class="btn btn-primary btn-sm book-lawyer-btn" data-lawyer-id="{{ $lawyer->id }}" data-lawyer-slug="{{ $lawyer->slug }}">
                                <i class="fas fa-calendar-plus me-1"></i>{{ __('Book now') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($lawyers->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <div class="no-lawyers-message">
                        <i class="fas fa-user-times" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                        <h3>{{ __('No lawyers available') }}</h3>
                        <p>{{ __('There are currently no lawyers available for booking. Please check back later.') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!--Book Appointment Section End-->

<!--Booking Modal-->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">{{ __('Book Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" action="{{ route('website.create.appointment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lawyer_id" id="modal-lawyer-id">
                    <input type="hidden" name="department_id" id="modal-department-id">
                    <input type="hidden" name="schedule_id" id="modal-schedule-id">
                    
                    <div class="form-group mb-3">
                        <label for="modal-appointment-date" class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>{{ __('Select Date') }}
                        </label>
                        <input type="text" name="date" id="modal-appointment-date" class="form-control" required placeholder="{{ __('Choose a date') }}" readonly>
                    </div>

                    <div class="form-group mb-3 d-none" id="modal-time-selection">
                        <label for="modal-appointment-time" class="form-label">
                            <i class="fas fa-clock me-2"></i>{{ __('Select Time') }}
                        </label>
                        <select name="schedule_id" id="modal-appointment-time" class="form-control form-select" required>
                            <option value="">{{ __('Select time') }}</option>
                        </select>
                    </div>

                    <div id="modal-error-message" class="alert alert-danger d-none"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>{{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary" id="modal-submit-btn" disabled>
                            <i class="fas fa-calendar-check me-2"></i>{{ __('Book Appointment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
$(document).ready(function() {
    const baseUrl = '{{ url("/") }}';
    const csrfToken = '{{ csrf_token() }}';
    
    // Load available times for each lawyer
    function loadLawyerAvailability(lawyerId) {
        const availabilityDiv = $(`.lawyer-availability[data-lawyer-id="${lawyerId}"]`);
        
        // Get next 7 days
        const dates = [];
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        for (let i = 0; i < 7; i++) {
            const date = new Date(today);
            date.setDate(date.getDate() + i);
            dates.push(date.toISOString().split('T')[0]);
        }
        
        // Load availability for each date
        let loadedDates = 0;
        const availabilityData = [];
        
        dates.forEach((date) => {
            $.ajax({
                url: baseUrl + '/get-appointment',
                method: 'GET',
                data: {
                    lawyer_id: lawyerId,
                    date: date
                },
                success: function(response) {
                    loadedDates++;
                    const dateObj = new Date(date + 'T00:00:00');
                    const locale = '{{ app()->getLocale() }}';
                    const dayName = dateObj.toLocaleDateString(locale === 'ar' ? 'ar-SA' : 'en-US', { weekday: 'long' });
                    const dayNumber = dateObj.getDate();
                    const monthName = dateObj.toLocaleDateString(locale === 'ar' ? 'ar-SA' : 'en-US', { month: 'short' });
                    
                    if (response.success) {
                        const options = $(response.success);
                        if (options.length > 0) {
                            const timeSlots = [];
                            options.each(function() {
                                const time = $(this).text().trim();
                                const scheduleId = $(this).val();
                                if (scheduleId && time) {
                                    timeSlots.push({ scheduleId, time });
                                }
                            });
                            
                            if (timeSlots.length > 0) {
                                availabilityData.push({
                                    date,
                                    dayName,
                                    dayNumber,
                                    monthName,
                                    timeSlots
                                });
                            }
                        }
                    }
                    
                    if (loadedDates === dates.length) {
                        renderAvailability(availabilityDiv, availabilityData);
                    }
                },
                error: function() {
                    loadedDates++;
                    if (loadedDates === dates.length) {
                        renderAvailability(availabilityDiv, availabilityData);
                    }
                }
            });
        });
    }
    
    function renderAvailability(availabilityDiv, availabilityData) {
        if (availabilityData.length === 0) {
            availabilityDiv.html('<div class="no-availability text-center py-4"><i class="fas fa-calendar-times fa-2x text-muted mb-2"></i><p class="text-muted mb-0">{{ __("No available times in the next 7 days") }}</p></div>');
            return;
        }
        
        let availabilityHtml = '<div class="availability-dates">';
        
        availabilityData.forEach((item) => {
            availabilityHtml += `
                <div class="available-date">
                    <div class="date-header">
                        <span class="day-name">${item.dayName}</span>
                        <span class="day-number">${item.dayNumber} ${item.monthName}</span>
                    </div>
                    <div class="time-slots">
            `;
            
            item.timeSlots.forEach((slot) => {
                availabilityHtml += `<span class="time-slot" data-schedule-id="${slot.scheduleId}" data-date="${item.date}" title="{{ __('Click to book') }}">${slot.time}</span>`;
            });
            
            availabilityHtml += `
                    </div>
                </div>
            `;
        });
        
        availabilityHtml += '</div>';
        availabilityDiv.html(availabilityHtml);
    }
    
    // Load availability for all lawyers
    $('.lawyer-card').each(function() {
        const lawyerId = $(this).data('lawyer-id');
        loadLawyerAvailability(lawyerId);
    });
    
    
    // Handle date selection
    $(document).on('change', '#modal-appointment-date', function() {
        const date = $(this).val();
        const lawyerId = $('#modal-lawyer-id').val();
        
        if (!date || !lawyerId) return;
        
        $.ajax({
            url: baseUrl + '/get-appointment',
            method: 'GET',
            data: {
                lawyer_id: lawyerId,
                date: date
            },
            success: function(response) {
                if (response.success) {
                    $('#modal-appointment-time').html(response.success);
                    $('#modal-time-selection').removeClass('d-none');
                    $('#modal-submit-btn').prop('disabled', false);
                    $('#modal-error-message').addClass('d-none');
                } else if (response.error) {
                    $('#modal-appointment-time').html('<option value="">{{ __("No times available") }}</option>');
                    $('#modal-time-selection').removeClass('d-none');
                    $('#modal-submit-btn').prop('disabled', true);
                    $('#modal-error-message').removeClass('d-none').html(response.error);
                }
            },
            error: function() {
                $('#modal-error-message').removeClass('d-none').html('{{ __("Error loading available times") }}');
            }
        });
    });
    
    // Handle time slot click in availability display
    $(document).on('click', '.time-slot', function() {
        // Remove previous selection
        $('.time-slot').removeClass('selected');
        // Add selection to clicked slot
        $(this).addClass('selected');
        
        const scheduleId = $(this).data('schedule-id');
        const date = $(this).data('date');
        const lawyerCard = $(this).closest('.lawyer-booking-card');
        const lawyerId = $(this).closest('.lawyer-availability').data('lawyer-id');
        
        // Get department_id
        $.ajax({
            url: baseUrl + '/get-lawyer-department/' + lawyerId,
            method: 'GET',
            success: function(response) {
                if (response.department_id) {
                    $('#modal-department-id').val(response.department_id);
                }
            }
        });
        
        $('#modal-lawyer-id').val(lawyerId);
        $('#modal-appointment-date').val(date);
        $('#modal-schedule-id').val(scheduleId);
        
        // Load times for this date
        $.ajax({
            url: baseUrl + '/get-appointment',
            method: 'GET',
            data: {
                lawyer_id: lawyerId,
                date: date
            },
            success: function(response) {
                if (response.success) {
                    $('#modal-appointment-time').html(response.success);
                    $('#modal-time-selection').removeClass('d-none');
                    $('#modal-appointment-time').val(scheduleId);
                    $('#modal-submit-btn').prop('disabled', false);
                    $('#modal-error-message').addClass('d-none');
                } else if (response.error) {
                    $('#modal-appointment-time').html('<option value="">{{ __("No times available") }}</option>');
                    $('#modal-time-selection').removeClass('d-none');
                    $('#modal-submit-btn').prop('disabled', true);
                    $('#modal-error-message').removeClass('d-none').html(response.error);
                }
            },
            error: function() {
                $('#modal-error-message').removeClass('d-none').html('{{ __("Error loading available times") }}');
            }
        });
        
        $('#bookingModal').modal('show');
    });
    
    // Get department_id when booking
    $(document).on('click', '.book-lawyer-btn', function() {
        const lawyerId = $(this).data('lawyer-id');
        const lawyerCard = $(this).closest('.lawyer-booking-card');
        
        // Reset modal
        $('#modal-appointment-date').val('');
        $('#modal-appointment-time').html('<option value="">{{ __("Select time") }}</option>');
        $('#modal-time-selection').addClass('d-none');
        $('#modal-submit-btn').prop('disabled', true);
        $('#modal-error-message').addClass('d-none');
        $('#modal-lawyer-id').val(lawyerId);
        
        // Get department_id
        $.ajax({
            url: baseUrl + '/get-lawyer-department/' + lawyerId,
            method: 'GET',
            success: function(response) {
                if (response.department_id) {
                    $('#modal-department-id').val(response.department_id);
                }
            }
        });
        
        $('#bookingModal').modal('show');
    });
    
    // Initialize datepicker only once when modal is shown
    let datepickerInitialized = false;
    
    $('#bookingModal').on('shown.bs.modal', function() {
        if (!datepickerInitialized && $.fn.datepicker) {
            // Destroy any existing datepicker instance
            $('#modal-appointment-date').datepicker('destroy');
            
            // Initialize datepicker with proper settings
            $('#modal-appointment-date').datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                beforeShowDay: function(date) {
                    const day = date.getDay();
                    return [day !== 0 && day !== 6]; // Disable weekends if needed
                },
                onSelect: function(dateText, inst) {
                    // Trigger change event to load available times
                    $(this).trigger('change');
                }
            });
            
            datepickerInitialized = true;
        }
    });
    
    // Reset datepicker when modal is hidden
    $('#bookingModal').on('hidden.bs.modal', function() {
        $('#modal-appointment-date').val('');
        $('#modal-appointment-time').html('<option value="">{{ __("Select time") }}</option>');
        $('#modal-time-selection').addClass('d-none');
        $('#modal-submit-btn').prop('disabled', true);
        $('#modal-error-message').addClass('d-none');
    });
    
    // Handle form submission
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        
        const lawyerId = $('#modal-lawyer-id').val();
        const departmentId = $('#modal-department-id').val();
        const date = $('#modal-appointment-date').val();
        const scheduleId = $('#modal-schedule-id').val() || $('#modal-appointment-time').val();
        
        // Validation
        if (!lawyerId || !departmentId || !date || !scheduleId) {
            $('#modal-error-message').removeClass('d-none').html('{{ __("Every field are required") }}');
            return false;
        }
        
        // Disable submit button
        const submitBtn = $('#modal-submit-btn');
        const originalBtnText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>{{ __("Loading...") }}');
        
        // Prepare form data
        const formData = new FormData(this);
        // Ensure schedule_id is set correctly
        formData.set('schedule_id', scheduleId);
        
        // Submit form using standard form submission (not AJAX) to handle redirects properly
        // Create a hidden form and submit it
        const hiddenForm = $('<form>', {
            'method': 'POST',
            'action': $(this).attr('action'),
            'style': 'display: none;'
        });
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': csrfToken
        }));
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'lawyer_id',
            'value': lawyerId
        }));
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'department_id',
            'value': departmentId
        }));
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'date',
            'value': date
        }));
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'schedule_id',
            'value': scheduleId
        }));
        
        $('body').append(hiddenForm);
        hiddenForm.submit();
        
        return false;
    });
    
    // Enable submit button when time is selected
    $(document).on('change', '#modal-appointment-time', function() {
        const scheduleId = $(this).val();
        if (scheduleId) {
            $('#modal-schedule-id').val(scheduleId);
            $('#modal-submit-btn').prop('disabled', false);
            $('#modal-error-message').addClass('d-none');
        } else {
            $('#modal-submit-btn').prop('disabled', true);
        }
    });
});
</script>
@endpush

