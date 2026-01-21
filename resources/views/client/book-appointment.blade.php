@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Book an appointment today') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Book an appointment with our lawyers') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area enhanced-breadcrumb" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="breadcrumb-overlay"></div>
    <div class="breadcrumb-pattern"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content enhanced-title-content">
                    <div class="title-wrapper">
                        <span class="title-icon">
                            <i class="fas fa-calendar-check"></i>
                        </span>
                        <h2 class="title">{{ __('Book an appointment today') }}</h2>
                    </div>
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                        <li class="separator"><i class="fas fa-chevron-left"></i></li>
                        <li class="active">{{ __('Book Appointment') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
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
                                        <img src="{{ image_url($lawyer->image) }}" alt="{{ $lawyer->name }}" class="lawyer-img">
                                    </div>
                                @endif
                                <h3 class="lawyer-name">{{ $lawyer->name }}</h3>
                                <div class="lawyer-specialties">
                                    @php
                                        $displayDept = ($lawyer->departments && $lawyer->departments->isNotEmpty()) 
                                            ? $lawyer->departments->first() 
                                            : ($lawyer->department ?? null);
                                    @endphp
                                    @if($displayDept && $displayDept->name)
                                        <span class="specialty-badge">
                                            <i class="fas fa-briefcase me-1"></i>{{ $displayDept->name }}
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
                            <div class="fee-container">
                                <span class="fee-label">{{ __('Fee') }}:</span>
                                <div class="fee-price-section">
                                    <span class="fee-amount" data-base-fee="{{ $lawyer->fee ?? 0 }}">
                                        <span class="currency-icon">{{ session()->get('currency_icon', '$') }}</span>
                                        <span class="fee-value">{{ $lawyer->fee ?? 0 }}</span>
                                    </span>
                                    <div class="fee-duration-container">
                                        <small class="fee-duration text-muted">{{ __('per') }}</small>
                                        <span class="duration-badge">15 {{ __('min') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lawyer-card-footer">
                            <div class="action-buttons-container">
                                <a href="{{ route('website.lawyer.details', $lawyer->slug) }}" class="btn btn-outline-primary action-btn">
                                    {{ __('View Profile') }}
                                </a>
                                <button class="btn btn-primary action-btn book-lawyer-btn" data-lawyer-id="{{ $lawyer->id }}" data-lawyer-slug="{{ $lawyer->slug }}">
                                    <i class="fas fa-calendar-plus me-1"></i>{{ __('Book now') }}
                                </button>
                            </div>
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
                        <div class="date-input-wrapper">
                            <input type="text" name="date_display" id="modal-appointment-date" class="form-control date-display-input" required placeholder="{{ __('Click to select date') }}" readonly>
                            <input type="hidden" name="date" id="modal-appointment-date-alt" class="date-alt-input">
                            <div class="date-input-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                        <small class="form-text text-muted date-format-hint">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() === "ar" ? __('Format: Day/Month/Year') : __('Format: Month/Day/Year') }}
                        </small>
                    </div>

                    <div class="form-group mb-3 d-none" id="modal-time-selection">
                        <label for="modal-appointment-time" class="form-label">
                            <i class="fas fa-clock me-2"></i>{{ __('Select Time') }}
                        </label>
                        <div class="time-input-wrapper">
                            <select name="schedule_id" id="modal-appointment-time" class="form-control form-select time-select-input" required>
                                <option value="">{{ __('Select time') }}</option>
                            </select>
                            <div class="time-input-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <small class="form-text text-muted time-format-hint">
                            <i class="fas fa-info-circle me-1"></i>{{ __('Available time slots for your selected duration') }}
                        </small>
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
    const isRTL = '{{ app()->getLocale() }}' === 'ar';

    // Enhanced Time Options Function
    function enhanceTimeOptions() {
        const timeSelect = $('#modal-appointment-time');
        const options = timeSelect.find('option');

        options.each(function() {
            const option = $(this);
            const value = option.val();
            if (value && value !== '') {
                // Extract time from option text (assuming format: "10:00 AM - 10:15 AM")
                const text = option.text().trim();
                const timeMatch = text.match(/(\d{1,2}:\d{2}\s*(?:AM|PM))/i);

                if (timeMatch) {
                    const cleanTime = timeMatch[1];
                    // Add duration info if available
                    const durationText = selectedDuration + ' {{ __("min") }}';
                    const enhancedText = isRTL ?
                        `${cleanTime} (${durationText})` :
                        `${cleanTime} (${durationText})`;

                    option.text(enhancedText);
                }
            }
        });
    }
    
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
    
    function formatTime(timeString) {
        if (!timeString) return '';
        // Convert to 12-hour format with AM/PM
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const hour12 = hour % 12 || 12;
        return `${hour12}:${minutes} ${ampm}`;
    }

    function renderAvailability(availabilityDiv, availabilityData) {
        if (availabilityData.length === 0) {
            availabilityDiv.html('<div class="no-availability text-center py-4"><i class="fas fa-calendar-times fa-2x text-muted mb-2"></i><p class="text-muted mb-0">{{ __("No available times in the next 7 days") }}</p></div>');
            return;
        }

        const isRTL = '{{ app()->getLocale() }}' === 'ar';
        const dateHeaderClass = isRTL ? 'date-header-rtl' : 'date-header';
        const timeSlotsClass = isRTL ? 'time-slots-rtl' : 'time-slots';

        let availabilityHtml = '<div class="availability-dates">';

        availabilityData.forEach((item) => {
            availabilityHtml += `
                <div class="available-date">
                    <div class="${dateHeaderClass}">
                        <span class="day-name">${item.dayName}</span>
                        <span class="day-number">${item.dayNumber} ${item.monthName}</span>
                    </div>
                    <div class="${timeSlotsClass}">
            `;

            item.timeSlots.forEach((slot) => {
                const startTime = formatTime(slot.startTime);
                const endTime = formatTime(slot.endTime);
                const displayTime = startTime && endTime ? `${startTime} - ${endTime}` : formatTime(slot.time);
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
                    enhanceTimeOptions();
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
                    enhanceTimeOptions();
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

    // Handle overlay click to close datepicker on mobile
    $(document).on('click', '.datepicker-overlay', function() {
        $('#modal-appointment-date').datepicker('hide');
    });
    
    $('#bookingModal').on('shown.bs.modal', function() {
        // Update duration in modal
        $('#modal-duration').val(selectedDuration);
        
        if (!datepickerInitialized && $.fn.datepicker) {
            // Destroy any existing datepicker instance
            $('#modal-appointment-date').datepicker('destroy');
            
            // Initialize datepicker with proper settings
            $('#modal-appointment-date').datepicker({
                minDate: 0,
                dateFormat: '{{ app()->getLocale() === "ar" ? "dd/mm/yy" : "mm/dd/yy" }}',
                altFormat: 'yy-mm-dd',
                altField: '#modal-appointment-date-alt',
                changeMonth: true,
                changeYear: true,
                showAnim: 'fadeIn',
                duration: 300,
                yearRange: '{{ date("Y") }}:{{ date("Y") + 2 }}',
                monthNames: [
                    '{{ __("January") }}', '{{ __("February") }}', '{{ __("March") }}',
                    '{{ __("April") }}', '{{ __("May") }}', '{{ __("June") }}',
                    '{{ __("July") }}', '{{ __("August") }}', '{{ __("September") }}',
                    '{{ __("October") }}', '{{ __("November") }}', '{{ __("December") }}'
                ],
                monthNamesShort: [
                    '{{ __("Jan") }}', '{{ __("Feb") }}', '{{ __("Mar") }}',
                    '{{ __("Apr") }}', '{{ __("May") }}', '{{ __("Jun") }}',
                    '{{ __("Jul") }}', '{{ __("Aug") }}', '{{ __("Sep") }}',
                    '{{ __("Oct") }}', '{{ __("Nov") }}', '{{ __("Dec") }}'
                ],
                dayNames: [
                    '{{ __("Sunday") }}', '{{ __("Monday") }}', '{{ __("Tuesday") }}',
                    '{{ __("Wednesday") }}', '{{ __("Thursday") }}', '{{ __("Friday") }}',
                    '{{ __("Saturday") }}'
                ],
                dayNamesShort: [
                    '{{ __("Sun") }}', '{{ __("Mon") }}', '{{ __("Tue") }}',
                    '{{ __("Wed") }}', '{{ __("Thu") }}', '{{ __("Fri") }}',
                    '{{ __("Sat") }}'
                ],
                dayNamesMin: [
                    '{{ __("Su") }}', '{{ __("Mo") }}', '{{ __("Tu") }}',
                    '{{ __("We") }}', '{{ __("Th") }}', '{{ __("Fr") }}',
                    '{{ __("Sa") }}'
                ],
                firstDay: {{ app()->getLocale() === "ar" ? 6 : 0 }}, // Saturday for Arabic, Sunday for others
                isRTL: {{ app()->getLocale() === "ar" ? 'true' : 'false' }},
                beforeShowDay: function(date) {
                    const day = date.getDay();
                    return [day !== 0 && day !== 6]; // Disable weekends if needed
                },
                beforeShow: function(input, inst) {
                    // Add class to body to prevent scrolling
                    $('body').addClass('datepicker-open');

                    // Position the datepicker for mobile
                    setTimeout(function() {
                        var $datepicker = $('.ui-datepicker');
                        var isMobile = $(window).width() < 768;

                        if (isMobile) {
                            $datepicker.css({
                                'position': 'fixed',
                                'top': '50%',
                                'left': '50%',
                                'transform': 'translate(-50%, -50%)',
                                'z-index': '1055',
                                'max-height': '80vh',
                                'overflow-y': 'auto'
                            });

                            // Add overlay for mobile
                            if (!$('.datepicker-overlay').length) {
                                $('<div class="datepicker-overlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1054;"></div>').appendTo('body');
                            }
                        } else {
                            // Desktop positioning - position near input
                            $datepicker.css({
                                'position': 'absolute',
                                'z-index': '9999'
                            });
                        }
                    }, 1);
                },
                onClose: function() {
                    // Remove class from body
                    $('body').removeClass('datepicker-open');
                    // Remove overlay
                    $('.datepicker-overlay').remove();
                },
                onClose: function() {
                    // Remove class from body
                    $('body').removeClass('datepicker-open');
                },
                onSelect: function(dateText, inst) {
                    // Trigger change event to load available times
                    $(this).trigger('change');

                    // Close datepicker after selection on mobile
                    if ($(window).width() < 768) {
                        $(this).datepicker('hide');
                    }
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

<style>
/* ============================================
   BOOKING SCHEDULE FIXES - MOBILE RESPONSIVE
   ============================================ */

/* Availability Dates Container */
.availability-dates {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: #f8f9fa;
}

/* Available Date Item */
.available-date {
    border-bottom: 1px solid #e0e0e0;
    padding: 12px 15px;
}

.available-date:last-child {
    border-bottom: none;
}

/* Date Header - LTR */
.date-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    gap: 15px;
}

/* Date Header - RTL */
.date-header-rtl {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    gap: 15px;
    direction: rtl;
}

.day-name {
    font-weight: 600;
    color: var(--colorPrimary);
    font-size: 14px;
    white-space: nowrap;
}

.day-number {
    font-size: 13px;
    color: #666;
    font-weight: 500;
}

/* Time Slots Container - LTR */
.time-slots {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    direction: ltr;
}

/* Time Slots Container - RTL */
.time-slots-rtl {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    direction: rtl;
}

/* Time Slot Button */
.time-slot {
    display: inline-block;
    padding: 6px 12px;
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    text-align: center;
    min-width: 80px;
}

.time-slot:hover {
    background: var(--colorPrimary);
    color: #fff;
    border-color: var(--colorPrimary);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(200, 180, 126, 0.3);
}

.time-slot.selected {
    background: var(--colorSecondary);
    color: #fff;
    border-color: var(--colorSecondary);
    box-shadow: 0 2px 8px rgba(241, 163, 76, 0.3);
}

/* ============================================
   PRICING SECTION FIXES
   ============================================ */

/* Lawyer Fee Container */
.lawyer-fee {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 8px;
    padding: 12px 15px;
    border: 1px solid #e9ecef;
}

.fee-container {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.fee-label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.fee-price-section {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
}

.fee-amount {
    display: flex;
    align-items: center;
    gap: 2px;
    font-weight: 700;
    color: var(--colorPrimary);
    font-size: 18px;
}

.currency-icon {
    font-size: 16px;
    color: var(--colorSecondary);
}

.fee-duration-container {
    display: flex;
    align-items: center;
    gap: 6px;
}

.fee-duration {
    font-size: 12px;
    color: #666;
    margin: 0;
}

.duration-badge {
    background: rgba(200, 180, 126, 0.1);
    color: var(--colorPrimary);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    border: 1px solid rgba(200, 180, 126, 0.2);
}

/* ============================================
   CTA BUTTONS FIXES
   ============================================ */

/* Action Buttons Container */
.action-buttons-container {
    display: flex;
    gap: 10px;
    justify-content: space-between;
    width: 100%;
}

.action-btn {
    flex: 1;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-align: center;
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Book Button Specific */
.book-lawyer-btn {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border: none;
    color: #fff;
}

.book-lawyer-btn:hover {
    background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
    color: #fff;
}

/* ============================================
   MOBILE RESPONSIVE FIXES
   ============================================ */

@media (max-width: 768px) {
    /* Mobile Date Header Spacing */
    .date-header,
    .date-header-rtl {
        margin-bottom: 8px;
        gap: 10px;
    }

    .day-name {
        font-size: 13px;
    }

    .day-number {
        font-size: 12px;
    }

    /* Mobile Time Slots */
    .time-slots,
    .time-slots-rtl {
        gap: 6px;
    }

    .time-slot {
        padding: 5px 10px;
        font-size: 11px;
        min-width: 70px;
        border-radius: 5px;
    }

    /* Mobile Fee Section */
    .lawyer-fee {
        padding: 10px 12px;
    }

    .fee-container {
        gap: 6px;
    }

    .fee-amount {
        font-size: 16px;
    }

    .fee-duration-container {
        gap: 4px;
    }

    .duration-badge {
        font-size: 10px;
        padding: 1px 6px;
    }

    /* Mobile Action Buttons */
    .action-buttons-container {
        gap: 8px;
        flex-direction: column;
    }

    .action-btn {
        padding: 12px 16px;
        font-size: 15px;
        min-height: 48px;
    }
}

@media (max-width: 480px) {
    /* Extra Small Screens */
    .availability-dates {
        max-height: 250px;
    }

    .available-date {
        padding: 10px 12px;
    }

    .time-slot {
        min-width: 65px;
        font-size: 10px;
        padding: 4px 8px;
    }

    .lawyer-fee {
        padding: 8px 10px;
    }

    .fee-amount {
        font-size: 15px;
    }

    .action-btn {
        padding: 14px 16px;
        font-size: 16px;
    }
}

/* RTL Specific Adjustments */
[dir="rtl"] .fee-container {
    direction: rtl;
}

[dir="rtl"] .fee-price-section {
    align-items: flex-end;
}

[dir="rtl"] .fee-duration-container {
    direction: rtl;
}

/* Loading Spinner Improvements */
.loading-spinner {
    color: var(--colorPrimary);
}

.loading-spinner i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* ============================================
   DATEPICKER MOBILE FIXES
   ============================================ */

/* jQuery UI Datepicker Base Styles */
.ui-datepicker {
    font-family: 'Poppins', sans-serif !important;
    background: #fff !important;
    border: 1px solid #ddd !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
    padding: 0 !important;
    width: auto !important;
    max-width: 100% !important;
}

.ui-datepicker-header {
    background: linear-gradient(135deg, var(--colorPrimary), var(--colorSecondary)) !important;
    color: #fff !important;
    border-radius: 8px 8px 0 0 !important;
    padding: 12px !important;
    font-weight: 600 !important;
    text-align: center !important;
}

.ui-datepicker-title {
    font-size: 16px !important;
    margin: 0 !important;
    color: #fff !important;
}

.ui-datepicker-prev,
.ui-datepicker-next {
    background: rgba(255,255,255,0.2) !important;
    border: none !important;
    border-radius: 4px !important;
    color: #fff !important;
    width: 30px !important;
    height: 30px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
}

.ui-datepicker-prev:hover,
.ui-datepicker-next:hover {
    background: rgba(255,255,255,0.3) !important;
}

.ui-datepicker-calendar {
    margin: 0 !important;
    border-collapse: collapse !important;
    width: 100% !important;
}

.ui-datepicker-calendar th {
    background: #f8f9fa !important;
    color: #666 !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    padding: 8px 4px !important;
    text-align: center !important;
    border-bottom: 1px solid #e9ecef !important;
}

.ui-datepicker-calendar td {
    border: none !important;
    padding: 2px !important;
    text-align: center !important;
}

.ui-datepicker-calendar td a {
    display: block !important;
    padding: 8px 6px !important;
    text-decoration: none !important;
    color: #333 !important;
    border-radius: 6px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    transition: all 0.2s ease !important;
    min-width: 32px !important;
    min-height: 32px !important;
    line-height: 16px !important;
    margin: 0 auto !important;
}

.ui-datepicker-calendar td a:hover {
    background: var(--colorPrimary) !important;
    color: #fff !important;
}

.ui-datepicker-today a {
    background: rgba(200, 180, 126, 0.1) !important;
    color: var(--colorPrimary) !important;
    font-weight: 600 !important;
}

.ui-datepicker-current-day a {
    background: var(--colorPrimary) !important;
    color: #fff !important;
    font-weight: 600 !important;
}

.ui-datepicker-calendar .ui-state-disabled {
    opacity: 0.4 !important;
    cursor: not-allowed !important;
}

.ui-datepicker-calendar .ui-state-disabled a {
    cursor: not-allowed !important;
    background: #f5f5f5 !important;
    color: #ccc !important;
}

/* ============================================
   MOBILE DATEPICKER RESPONSIVE FIXES
   ============================================ */

@media (max-width: 768px) {
    .ui-datepicker {
        width: 320px !important;
        max-width: 95vw !important;
        margin: 0 auto !important;
        font-size: 14px !important;
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        z-index: 9999 !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3) !important;
    }

    .ui-datepicker-header {
        padding: 15px !important;
    }

    .ui-datepicker-title {
        font-size: 18px !important;
    }

    .ui-datepicker-prev,
    .ui-datepicker-next {
        width: 35px !important;
        height: 35px !important;
    }

    .ui-datepicker-calendar th {
        font-size: 11px !important;
        padding: 6px 2px !important;
    }

    .ui-datepicker-calendar td a {
        padding: 6px 4px !important;
        font-size: 13px !important;
        min-width: 28px !important;
        min-height: 28px !important;
        line-height: 16px !important;
    }

    /* Mobile Datepicker Overlay */
    body:has(.ui-datepicker) {
        position: relative;
    }

    .ui-datepicker:before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
    }
}

@media (max-width: 480px) {
    .ui-datepicker {
        width: 280px !important;
        max-width: 90vw !important;
        top: 45% !important;
        transform: translate(-50%, -50%) !important;
    }

    .ui-datepicker-header {
        padding: 12px !important;
    }

    .ui-datepicker-title {
        font-size: 16px !important;
    }

    .ui-datepicker-prev,
    .ui-datepicker-next {
        width: 32px !important;
        height: 32px !important;
    }

    .ui-datepicker-calendar th {
        font-size: 10px !important;
        padding: 4px 2px !important;
    }

    .ui-datepicker-calendar td {
        padding: 1px !important;
    }

    .ui-datepicker-calendar td a {
        padding: 5px 3px !important;
        font-size: 12px !important;
        min-width: 26px !important;
        min-height: 26px !important;
        line-height: 16px !important;
    }
}

/* RTL Datepicker Support */
[dir="rtl"] .ui-datepicker {
    direction: rtl !important;
}

[dir="rtl"] .ui-datepicker-prev {
    right: auto !important;
    left: 8px !important;
}

[dir="rtl"] .ui-datepicker-next {
    left: auto !important;
    right: 8px !important;
}

[dir="rtl"] .ui-datepicker-calendar {
    direction: rtl !important;
}

/* Datepicker Animation */
.ui-datepicker {
    animation: datepickerFadeIn 0.3s ease-out !important;
}

@keyframes datepickerFadeIn {
    from {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

/* Additional Mobile Optimizations */
@media (max-width: 768px) {
    /* Ensure datepicker button doesn't get cut off */
    .ui-datepicker .ui-datepicker-prev,
    .ui-datepicker .ui-datepicker-next {
        position: absolute !important;
    }

    .ui-datepicker .ui-datepicker-prev {
        left: 10px !important;
    }

    .ui-datepicker .ui-datepicker-next {
        right: 10px !important;
    }

    /* Make datepicker more touch-friendly */
    .ui-datepicker-calendar td a {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        touch-action: manipulation !important;
    }

    /* Prevent zoom on iOS when touching datepicker */
    .ui-datepicker,
    .ui-datepicker * {
        touch-action: manipulation !important;
        -webkit-touch-callout: none !important;
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }

    /* Re-enable text selection for date cells */
    .ui-datepicker-calendar td a {
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
        user-select: text !important;
    }
}

/* High DPI Screen Support */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .ui-datepicker {
        border-width: 0.5px !important;
    }

    .ui-datepicker-calendar td a {
        border-radius: 3px !important;
    }
}

/* Fix for modal datepicker positioning */
.modal.show .ui-datepicker {
    position: fixed !important;
}

/* Ensure modal content doesn't interfere with datepicker */
.modal-backdrop {
    z-index: 1040 !important;
}

.ui-datepicker {
    z-index: 1055 !important; /* Higher than modal */
}

/* Datepicker container fixes for modal */
.modal-dialog .modal-content .modal-body {
    position: relative;
    overflow: visible;
}

.modal.show {
    overflow: visible;
}

/* Prevent datepicker from being clipped by modal */
.modal .ui-datepicker {
    box-shadow: 0 10px 40px rgba(0,0,0,0.4) !important;
}

/* Prevent body scroll when datepicker is open */
body.datepicker-open {
    overflow: hidden !important;
    position: fixed !important;
    width: 100% !important;
}

/* Datepicker Overlay */
.datepicker-overlay {
    animation: fadeIn 0.3s ease-out !important;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Close datepicker when clicking overlay on mobile */
.datepicker-overlay {
    cursor: pointer;
}

/* ============================================
   MODAL HEADER IMPROVEMENTS - MOBILE RESPONSIVE
   ============================================ */

/* Modal Dialog Enhancements */
.modal-dialog {
    margin: 1rem !important;
    max-width: 500px !important;
}

@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem !important;
        min-height: calc(100vh - 1rem) !important;
    }
}

/* Modal Content Styling */
.modal-content {
    border: none !important;
    border-radius: 16px !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3) !important;
    overflow: hidden !important;
}

/* Modal Header - Main Improvements */
.modal-header {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
    border: none !important;
    padding: 24px 20px !important;
    position: relative !important;
    min-height: 80px !important;
}

.modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg,
        rgba(255,255,255,0.1) 0%,
        rgba(255,255,255,0.05) 50%,
        rgba(255,255,255,0.1) 100%);
    border-radius: 16px 16px 0 0;
    pointer-events: none;
}

/* Modal Title - Enhanced Visibility */
.modal-title {
    color: #ffffff !important;
    font-size: 20px !important;
    font-weight: 700 !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
    margin: 0 !important;
    line-height: 1.3 !important;
    position: relative !important;
    z-index: 1 !important;
    letter-spacing: -0.5px !important;
}

/* Arabic Text Enhancements */
[dir="rtl"] .modal-title {
    text-align: right !important;
    font-family: 'Cairo', 'Poppins', sans-serif !important;
}

[dir="ltr"] .modal-title {
    text-align: left !important;
}

/* Modal Close Button - Enhanced Design */
.btn-close {
    background: rgba(255,255,255,0.2) !important;
    border: none !important;
    border-radius: 50% !important;
    width: 36px !important;
    height: 36px !important;
    opacity: 1 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    z-index: 2 !important;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

.btn-close:hover {
    background: rgba(255,255,255,0.3) !important;
    transform: scale(1.1) !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
}

.btn-close::before {
    content: '×';
    color: #ffffff !important;
    font-size: 20px !important;
    font-weight: 300 !important;
    line-height: 1 !important;
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
}

/* Remove default Bootstrap close button styling */
.btn-close:focus {
    box-shadow: none !important;
    outline: none !important;
}

/* Modal Body - Better Spacing */
.modal-body {
    padding: 24px 20px !important;
    background: #ffffff !important;
    position: relative !important;
}

/* ============================================
   FORM FIELDS ENHANCEMENT - DATE & TIME
   ============================================ */

/* Date Input Wrapper */
.date-input-wrapper,
.time-input-wrapper {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
}

.date-display-input,
.time-select-input {
    padding-right: 50px !important; /* Space for icon */
    background: #fff !important;
    border: 2px solid #e9ecef !important;
    border-radius: 10px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    color: #333 !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
}

.date-display-input:focus,
.time-select-input:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15) !important;
    outline: none !important;
}

/* Date & Time Input Icons */
.date-input-icon,
.time-input-icon {
    position: absolute !important;
    right: 15px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    color: var(--colorPrimary) !important;
    font-size: 18px !important;
    pointer-events: none !important;
    z-index: 5 !important;
}

/* RTL Support for Icons */
[dir="rtl"] .date-input-icon,
[dir="rtl"] .time-input-icon {
    right: auto !important;
    left: 15px !important;
}

[dir="rtl"] .date-display-input,
[dir="rtl"] .time-select-input {
    padding-right: 15px !important;
    padding-left: 50px !important;
}

/* Format Hints */
.date-format-hint,
.time-format-hint {
    display: flex !important;
    align-items: center !important;
    font-size: 12px !important;
    color: #666 !important;
    margin-top: 6px !important;
    padding-left: 2px !important;
}

.date-format-hint i,
.time-format-hint i {
    font-size: 11px !important;
    opacity: 0.7 !important;
}

/* Enhanced Select Styling */
.time-select-input {
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c8b47e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 15px center !important;
    background-size: 16px !important;
    padding-right: 45px !important;
}

[dir="rtl"] .time-select-input {
    background-position: left 15px center !important;
    padding-right: 15px !important;
    padding-left: 45px !important;
}

/* Time Options Enhancement */
#modal-appointment-time option {
    padding: 12px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    color: #333 !important;
}

/* ============================================
   FORM CONSISTENCY IMPROVEMENTS
   ============================================ */

/* Form Group Spacing */
.modal-body .form-group {
    margin-bottom: 24px !important;
}

.modal-body .form-group:last-child {
    margin-bottom: 0 !important;
}

/* Label Enhancements */
.modal-body .form-label {
    font-weight: 600 !important;
    color: #333 !important;
    margin-bottom: 8px !important;
    font-size: 15px !important;
    display: flex !important;
    align-items: center !important;
}

.modal-body .form-label i {
    color: var(--colorPrimary) !important;
    margin-right: 8px !important;
    font-size: 16px !important;
}

[dir="rtl"] .modal-body .form-label i {
    margin-right: 0 !important;
    margin-left: 8px !important;
}

/* Case Type Input Enhancement */
#modal-case-type {
    border: 2px solid #e9ecef !important;
    border-radius: 10px !important;
    padding: 12px 16px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
}

#modal-case-type:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.15) !important;
}

/* Form Text Enhancement */
.form-text.text-muted {
    color: #666 !important;
    font-size: 13px !important;
    line-height: 1.4 !important;
}

/* Modal Footer Enhancements */
.modal-footer {
    padding: 24px 20px !important;
    border-top: 1px solid #e9ecef !important;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
    border-radius: 0 0 16px 16px !important;
    gap: 12px !important;
}

/* ============================================
   MOBILE RESPONSIVE FORM IMPROVEMENTS
   ============================================ */

@media (max-width: 768px) {
    .modal-body .form-group {
        margin-bottom: 20px !important;
    }

    .date-display-input,
    .time-select-input,
    #modal-case-type {
        font-size: 16px !important; /* Prevent zoom on iOS */
        padding: 14px 16px !important;
    }

    .date-display-input,
    .time-select-input {
        padding-right: 45px !important;
    }

    [dir="rtl"] .date-display-input,
    [dir="rtl"] .time-select-input {
        padding-left: 45px !important;
        padding-right: 16px !important;
    }

    .date-input-icon,
    .time-input-icon {
        right: 12px !important;
        font-size: 16px !important;
    }

    [dir="rtl"] .date-input-icon,
    [dir="rtl"] .time-input-icon {
        left: 12px !important;
        right: auto !important;
    }

    .time-select-input {
        background-position: right 12px center !important;
        padding-right: 40px !important;
    }

    [dir="rtl"] .time-select-input {
        background-position: left 12px center !important;
        padding-left: 40px !important;
        padding-right: 16px !important;
    }

    .modal-body .form-label {
        font-size: 14px !important;
    }

    .date-format-hint,
    .time-format-hint {
        font-size: 11px !important;
    }

    .modal-footer {
        padding: 20px 16px !important;
        flex-direction: column !important;
        gap: 10px !important;
    }

    .modal-footer .btn {
        width: 100% !important;
        min-height: 50px !important;
    }
}

@media (max-width: 480px) {
    .modal-body {
        padding: 16px !important;
    }

    .modal-body .form-group {
        margin-bottom: 18px !important;
    }

    .date-display-input,
    .time-select-input,
    #modal-case-type {
        padding: 12px 14px !important;
        font-size: 16px !important;
    }

    .modal-body .form-label {
        font-size: 13px !important;
        margin-bottom: 6px !important;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.date-display-input:focus + .date-input-icon,
.time-select-input:focus + .time-input-icon {
    color: var(--colorSecondary) !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .date-display-input,
    .time-select-input,
    #modal-case-type {
        border-width: 3px !important;
        border-color: #000 !important;
    }

    .modal-body .form-label {
        font-weight: 800 !important;
    }

    .date-format-hint,
    .time-format-hint {
        color: #000 !important;
        font-weight: 600 !important;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .date-display-input,
    .time-select-input,
    #modal-case-type {
        transition: none !important;
    }

    .modal-body .form-label i {
        transition: none !important;
    }
}

/* ============================================
   VISUAL ENHANCEMENT - LOADING STATES
   ============================================ */

.time-select-input:disabled {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
    cursor: not-allowed !important;
}

.time-select-input:disabled + .time-input-icon {
    color: #6c757d !important;
}

/* Loading Animation for Time Selection */
@keyframes pulse-loading {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.time-select-input[aria-busy="true"] {
    animation: pulse-loading 1.5s ease-in-out infinite !important;
}

/* Form Elements Inside Modal */
.modal-body .form-group {
    margin-bottom: 20px !important;
}

.modal-body .form-label {
    font-weight: 600 !important;
    color: #333 !important;
    margin-bottom: 8px !important;
    font-size: 14px !important;
}

.modal-body .form-control {
    border: 2px solid #e9ecef !important;
    border-radius: 8px !important;
    padding: 12px 16px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
}

.modal-body .form-control:focus {
    border-color: var(--colorPrimary) !important;
    box-shadow: 0 0 0 3px rgba(200, 180, 126, 0.1) !important;
}

/* Modal Buttons Enhancement */
.modal-footer .btn {
    padding: 12px 24px !important;
    font-weight: 600 !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    min-width: 100px !important;
    transition: all 0.3s ease !important;
}

.modal-footer .btn-primary {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
    border: none !important;
}

.modal-footer .btn-primary:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(200, 180, 126, 0.3) !important;
}

.modal-footer .btn-secondary {
    background: #6c757d !important;
    border: none !important;
}

.modal-footer .btn-secondary:hover {
    background: #5a6268 !important;
    transform: translateY(-1px) !important;
}

/* Visual Separator Between Header and Body */
.modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 20px;
    right: 20px;
    height: 1px;
    background: linear-gradient(90deg,
        transparent 0%,
        rgba(255,255,255,0.3) 20%,
        rgba(255,255,255,0.3) 80%,
        transparent 100%);
    z-index: 1;
}

/* Modal Body Shadow Effect */
.modal-body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 20px;
    background: linear-gradient(180deg,
        rgba(0,0,0,0.02) 0%,
        transparent 100%);
    pointer-events: none;
}

/* ============================================
   MOBILE SPECIFIC MODAL IMPROVEMENTS
   ============================================ */

@media (max-width: 768px) {
    .modal-header {
        padding: 20px 16px !important;
        min-height: 70px !important;
    }

    .modal-title {
        font-size: 18px !important;
        line-height: 1.4 !important;
    }

    .btn-close {
        width: 32px !important;
        height: 32px !important;
        top: 16px !important;
        right: 16px !important;
    }

    .btn-close::before {
        font-size: 18px !important;
    }

    .modal-body {
        padding: 20px 16px !important;
    }

    .modal-header::after {
        left: 16px;
        right: 16px;
    }
}

@media (max-width: 480px) {
    .modal-dialog {
        margin: 10px !important;
    }

    .modal-header {
        padding: 18px 14px !important;
        min-height: 65px !important;
    }

    .modal-title {
        font-size: 16px !important;
        line-height: 1.4 !important;
    }

    .btn-close {
        width: 30px !important;
        height: 30px !important;
        top: 14px !important;
        right: 14px !important;
    }

    .btn-close::before {
        font-size: 16px !important;
    }

    .modal-body {
        padding: 18px 14px !important;
    }

    .modal-header::after {
        left: 14px;
        right: 14px;
    }
}

/* ============================================
   MODAL ANIMATION IMPROVEMENTS
   ============================================ */

.modal.fade .modal-dialog {
    transform: translate(0, -50px) !important;
    transition: transform 0.3s ease-out !important;
}

.modal.show .modal-dialog {
    transform: translate(0, 0) !important;
}

/* Backdrop Enhancement */
.modal-backdrop {
    background: rgba(0,0,0,0.6) !important;
    backdrop-filter: blur(2px) !important;
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.modal-title:focus {
    outline: 2px solid rgba(255,255,255,0.8) !important;
    outline-offset: 2px !important;
    border-radius: 4px !important;
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .modal-header {
        background: var(--colorPrimary) !important;
    }

    .modal-header::before {
        display: none !important;
    }

    .modal-title {
        text-shadow: none !important;
        font-weight: 800 !important;
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .modal.fade .modal-dialog {
        transition: none !important;
    }

    .btn-close {
        transition: none !important;
    }

    .modal-title {
        text-shadow: none !important;
    }
}

/* ============================================
   RTL SPECIFIC MODAL IMPROVEMENTS
   ============================================ */

[dir="rtl"] .modal-header {
    direction: rtl !important;
}

[dir="rtl"] .modal-title {
    text-align: right !important;
    margin-right: 40px !important; /* Space for close button */
    margin-left: 0 !important;
}

[dir="rtl"] .btn-close {
    right: auto !important;
    left: 16px !important;
}

[dir="ltr"] .modal-title {
    margin-left: 40px !important; /* Space for close button */
    margin-right: 0 !important;
}

[dir="ltr"] .btn-close {
    right: 16px !important;
    left: auto !important;
}

/* Mobile RTL Adjustments */
@media (max-width: 768px) {
    [dir="rtl"] .modal-title {
        margin-right: 36px !important;
    }

    [dir="rtl"] .btn-close {
        left: 14px !important;
    }

    [dir="ltr"] .modal-title {
        margin-left: 36px !important;
    }

    [dir="ltr"] .btn-close {
        right: 14px !important;
    }
}

@media (max-width: 480px) {
    [dir="rtl"] .modal-title {
        margin-right: 34px !important;
    }

    [dir="rtl"] .btn-close {
        left: 12px !important;
    }

    [dir="ltr"] .modal-title {
        margin-left: 34px !important;
    }

    [dir="ltr"] .btn-close {
        right: 12px !important;
    }
}

/* ============================================
   MODAL RESPONSIVE HEIGHT FIXES
   ============================================ */

@media (max-width: 576px) {
    .modal-dialog {
        max-height: calc(100vh - 20px) !important;
    }

    .modal-content {
        max-height: 100% !important;
    }

    .modal-body {
        max-height: calc(100vh - 140px) !important;
        overflow-y: auto !important;
    }
}

/* Prevent modal from being too tall on very small screens */
@media (max-height: 600px) {
    .modal-dialog {
        margin: 5px auto !important;
    }

    .modal-header {
        padding: 16px !important;
        min-height: 60px !important;
    }

    .modal-title {
        font-size: 16px !important;
    }

    .modal-body {
        padding: 16px !important;
        max-height: calc(100vh - 120px) !important;
    }

    .modal-footer {
        padding: 16px !important;
    }
}
</style>
@endpush

