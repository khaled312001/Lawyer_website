@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Book an appointment today') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Book an appointment with our admin team') }}">
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
                    <p>{{ __('At our platform, you can always connect with our admin team who listens, offers advice, and helps you move forward in your legal matters. This means you get quick answers and suggestions of solutions to your issues, so you can let go of your worries and feel confident about what to do next.') }}</p>
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
                            <span class="fee-amount" data-base-fee="{{ $lawyer->fee ?? 0 }}">
                                {{ session()->get('currency_icon', '$') }}<span class="fee-value">{{ $lawyer->fee ?? 0 }}</span>
                            </span>
                            <small class="fee-duration text-muted d-block mt-1">({{ __('per 15 min') }})</small>
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
                    <input type="hidden" name="duration" id="modal-duration" value="15">
                    
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

                    <div class="form-group mb-3">
                        <label for="modal-case-type" class="form-label">
                            <i class="fas fa-gavel me-2"></i>{{ __('Case Type') }}
                        </label>
                        <input type="text" name="case_type" id="modal-case-type" class="form-control" required placeholder="{{ __('Enter case type (e.g., Criminal, Civil, Family, Commercial, etc.)') }}">
                        <small class="form-text text-muted">{{ __('Please specify the type of case you need consultation for') }}</small>
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
    
    // Duration selection handler
    let selectedDuration = 15; // Default duration
    const currencyIcon = '{{ session()->get("currency_icon", "$") }}';
    
    // Calculate fee based on duration
    function calculateFee(baseFee, duration) {
        return ((baseFee / 15) * duration).toFixed(2);
    }
    
    // Update all lawyer fees based on selected duration
    function updateLawyerFees(duration) {
        $('.lawyer-card').each(function() {
            const feeElement = $(this).find('.fee-amount');
            const baseFee = parseFloat(feeElement.data('base-fee')) || 0;
            const calculatedFee = calculateFee(baseFee, duration);
            feeElement.find('.fee-value').text(calculatedFee);
        });
    }
    
    // Handle duration button clicks
    $(document).on('click', '.duration-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Remove active class from all buttons
        $('.duration-btn').removeClass('active');
        // Add active class to clicked button
        $(this).addClass('active');
        // Get selected duration
        selectedDuration = parseInt($(this).data('duration')) || 15;
        
        // Update fees
        updateLawyerFees(selectedDuration);
        
        // Show loading state
        $('.lawyer-availability').each(function() {
            $(this).html('<div class="loading-spinner text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2 mb-0">{{ __("Loading available times...") }}</p></div>');
        });
        
        // Reload availability for all lawyers with new duration
        $('.lawyer-card').each(function() {
            const lawyerId = $(this).data('lawyer-id');
            if (lawyerId) {
                loadLawyerAvailability(lawyerId, selectedDuration);
            }
        });
    });
    
    // Load available times for each lawyer
    function loadLawyerAvailability(lawyerId, duration = 15) {
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
                    date: date,
                    duration: duration
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
                                const scheduleId = $(this).val();
                                const startTime = $(this).data('start-time') || '';
                                const endTime = $(this).data('end-time') || '';
                                const time = startTime && endTime ? (startTime + '-' + endTime) : $(this).text().trim();
                                if (scheduleId && time) {
                                    timeSlots.push({ scheduleId, time, startTime, endTime });
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
                const displayTime = slot.startTime && slot.endTime ? `${slot.startTime}-${slot.endTime}` : slot.time;
                availabilityHtml += `<span class="time-slot" data-schedule-id="${slot.scheduleId}" data-date="${item.date}" data-start-time="${slot.startTime || ''}" data-end-time="${slot.endTime || ''}" title="{{ __('Click to book') }}">${displayTime}</span>`;
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
        loadLawyerAvailability(lawyerId, selectedDuration);
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
                date: date,
                duration: selectedDuration
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
        const startTime = $(this).data('start-time');
        const endTime = $(this).data('end-time');
        const lawyerCard = $(this).closest('.lawyer-booking-card');
        const lawyerId = $(this).closest('.lawyer-availability').data('lawyer-id');
        
        // Update duration in modal
        $('#modal-duration').val(selectedDuration);
        
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
                date: date,
                duration: selectedDuration
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
        $('#modal-duration').val(selectedDuration);
        
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
        // Update duration in modal
        $('#modal-duration').val(selectedDuration);
        
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
        const caseType = $('#modal-case-type').val();
        
        // Validation
        if (!lawyerId || !departmentId || !date || !scheduleId || !caseType) {
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
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'duration',
            'value': selectedDuration
        }));
        
        hiddenForm.append($('<input>', {
            'type': 'hidden',
            'name': 'case_type',
            'value': caseType
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

