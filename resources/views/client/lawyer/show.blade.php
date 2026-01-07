@extends('layouts.client.layout')
@section('title')
    <title>{{ $lawyer?->seo_title ?? $lawyer?->name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $lawyer?->seo_description }}">
    <meta property="og:title" content="{{ $lawyer?->seo_title }}" />
    <meta property="og:description" content="{{ $lawyer?->seo_description }}" />
    <meta property="og:image" content="{{ asset($lawyer?->image) }}" />
    <meta property="og:URL" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ ucfirst($lawyer?->name) }} ({{ $lawyer?->designations }})</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a>
                            </li>
                            <li><span>{{ ucfirst($lawyer?->name) }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Team Detail Start-->
    <div class="team-detail-page pt_40 pb_70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="team-detail-photo">
                        <img src="{{ url($lawyer?->image ? $lawyer?->image : $setting?->default_avatar) }}"
                            alt="{{ $lawyer?->name }}" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="team-detail-text">
                        <h4>{{ $lawyer?->name }} </h4>
                        <span><b>{{ $lawyer?->department?->name }} ({{ $lawyer?->designations }})</b></span>
                        <p class="mt-0"><b>{{ __('Years of experience') }}: {{ $lawyer?->years_of_experience }}</b></p>
                        @if($lawyer->total_ratings > 0)
                        <div class="mt-2 mb-2">
                            {!! displayStars($lawyer->average_rating) !!}
                            <span class="ms-2" style="color: #666; font-size: 14px;">
                                <strong>{{ number_format($lawyer->average_rating, 1) }}</strong> 
                                ({{ $lawyer->total_ratings }} {{ $lawyer->total_ratings == 1 ? __('rating') : __('ratings') }})
                            </span>
                        </div>
                        @else
                        <div class="mt-2 mb-2">
                            {!! displayStars(0) !!}
                            <span class="ms-2" style="color: #666; font-size: 14px;">{{ __('No ratings yet') }}</span>
                        </div>
                        @endif
                        {{-- تم حذف الرسوم - سيتم تحديدها بعد استشارة الحالة --}}

                        {!! $lawyer?->about !!}
                        
                        {{-- أزرار التواصل والحجز --}}
                        <div class="mt-3 d-flex gap-2 flex-wrap">
                            @auth('web')
                            <form action="{{ route('client.messages.start', $lawyer->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-comments"></i> {{ __('Contact Lawyer') }}
                                </button>
                            </form>
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#bookAppointmentModal{{ $lawyer->id }}">
                                <i class="fas fa-calendar-check"></i> {{ __('Book a web meeting') }}
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-comments"></i> {{ __('Contact Lawyer') }}
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check"></i> {{ __('Book a web meeting') }}
                            </a>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="team-exp-area bg-area pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-headline">
                        <h2>{{ __('Lawyer Info') }}</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <!--Tab Start-->
                    <div class="event-detail-tab mt_20">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a aria-label="{{ __('Education') }}" aria-selected="true" data-bs-toggle="tab"
                                    class="active" href="#education" data-bs-toggle="tab">
                                    <i class="fas fa-graduation-cap me-2"></i>{{ __('Education') }}
                                </a>
                            </li>
                            <li>
                                <a aria-label="{{ __('Experience') }}" aria-selected="false" data-bs-toggle="tab"
                                    href="#experience" data-bs-toggle="tab">
                                    <i class="fas fa-briefcase me-2"></i>{{ __('Experience') }}
                                </a>
                            </li>
                            <li>
                                <a aria-label="{{ __('Qualification') }}" aria-selected="false" data-bs-toggle="tab"
                                    href="#qualification" data-bs-toggle="tab">
                                    <i class="fas fa-certificate me-2"></i>{{ __('Qualification') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content event-detail-content">
                        <div id="education" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="info-section">
                                        @if($lawyer?->educations)
                                            <div class="info-content">
                                                {!! $lawyer->educations !!}
                                            </div>
                                        @else
                                            <div class="no-data-message">
                                                <i class="fas fa-info-circle"></i>
                                                <p>{{ __('No data found!') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="experience" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="info-section">
                                        @if($lawyer?->experience)
                                            <div class="info-content">
                                                {!! $lawyer->experience !!}
                                            </div>
                                        @else
                                            <div class="no-data-message">
                                                <i class="fas fa-info-circle"></i>
                                                <p>{{ __('No data found!') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="qualification" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="info-section">
                                        @if($lawyer?->qualifications)
                                            <div class="info-content">
                                                {!! $lawyer->qualifications !!}
                                            </div>
                                        @else
                                            <div class="no-data-message">
                                                <i class="fas fa-info-circle"></i>
                                                <p>{{ __('No data found!') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tab End-->
                </div>

            </div>
        </div>
    </div>
    <!--Team Detail End-->

    <!--Book Appointment Modal for Lawyer Detail Page-->
    <div class="modal fade" id="bookAppointmentModal{{ $lawyer->id }}" tabindex="-1" aria-labelledby="bookAppointmentModalLabel{{ $lawyer->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookAppointmentModalLabel{{ $lawyer->id }}">{{ __('Book a web meeting with') }} {{ $lawyer->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('website.create.appointment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
                        <input type="hidden" name="department_id" value="{{ $lawyer->department_id }}">
                        
                        <div class="form-group mb-3">
                            <label for="lawyer-detail-date-{{ $lawyer->id }}">{{ __('Select Date') }}</label>
                            <input type="text" name="date" class="form-control datepicker" id="lawyer-detail-date-{{ $lawyer->id }}" required>
                        </div>

                        <div class="form-group mb-3 d-none" id="lawyer-detail-schedule-box-{{ $lawyer->id }}">
                            <label for="lawyer-detail-schedule-{{ $lawyer->id }}">{{ __('Select Time') }}</label>
                            <select name="schedule_id" class="form-control" id="lawyer-detail-schedule-{{ $lawyer->id }}" required>
                                <option value="">{{ __('Select time') }}</option>
                            </select>
                        </div>

                        <div id="lawyer-detail-error-{{ $lawyer->id }}" class="alert alert-danger d-none"></div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="lawyer-detail-submit-{{ $lawyer->id }}" disabled>{{ __('Book Appointment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        /* تحسين تصميم تبويبات معلومات المحامي */
        .event-detail-tab .nav-tabs {
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 30px;
        }
        
        .event-detail-tab .nav-tabs li {
            margin-bottom: -2px;
        }
        
        .event-detail-tab .nav-tabs li a {
            padding: 15px 25px;
            font-size: 16px;
            font-weight: 600;
            color: #666;
            border: none;
            border-bottom: 3px solid transparent;
            background: transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .event-detail-tab .nav-tabs li a:hover {
            color: var(--colorPrimary);
            border-bottom-color: var(--colorPrimary);
            background: rgba(200, 180, 126, 0.05);
        }
        
        .event-detail-tab .nav-tabs li.active a,
        .event-detail-tab .nav-tabs li a.active {
            color: var(--colorPrimary);
            border-bottom-color: var(--colorPrimary);
            background: rgba(200, 180, 126, 0.05);
        }
        
        .event-detail-tab .nav-tabs li a i {
            font-size: 18px;
            margin-left: 8px;
        }
        
        /* تحسين تصميم محتوى المعلومات */
        .info-section {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            min-height: 200px;
        }
        
        .info-content {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
        }
        
        .info-content ul,
        .info-content ol {
            margin: 20px 0;
            padding-right: 25px;
        }
        
        .info-content li {
            margin-bottom: 12px;
            position: relative;
        }
        
        .info-content ul li::before {
            content: "•";
            color: var(--colorPrimary);
            font-weight: bold;
            font-size: 20px;
            position: absolute;
            right: -20px;
        }
        
        .info-content h3,
        .info-content h4 {
            color: var(--colorPrimary);
            margin-top: 25px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .info-content h3:first-child,
        .info-content h4:first-child {
            margin-top: 0;
        }
        
        .info-content p {
            margin-bottom: 15px;
        }
        
        .info-content strong {
            color: #333;
            font-weight: 600;
        }
        
        /* تصميم رسالة عدم وجود بيانات */
        .no-data-message {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        
        .no-data-message i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 15px;
            display: block;
        }
        
        .no-data-message p {
            font-size: 18px;
            margin: 0;
        }
        
        /* تحسين تصميم العنوان الرئيسي */
        .team-headline h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        
        /* تحسين تصميم بطاقة المحامي */
        .team-detail-text h4 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        
        .team-detail-text span {
            font-size: 18px;
            color: var(--colorPrimary);
            display: block;
            margin-bottom: 15px;
        }
        
        /* تحسين التصميم على الشاشات الصغيرة */
        @media (max-width: 768px) {
            .info-section {
                padding: 25px 20px;
            }
            
            .event-detail-tab .nav-tabs li a {
                padding: 12px 15px;
                font-size: 14px;
            }
            
            .team-headline h2 {
                font-size: 24px;
            }
        }
    </style>
    @endpush

    @push('js')
    <script>
    $(document).ready(function() {
        $('#lawyer-detail-date-{{ $lawyer->id }}').on('change', function() {
            const date = $(this).val();
            const lawyerId = {{ $lawyer->id }};
            
            if (!date) return;
            
            $.ajax({
                url: '{{ url("/get-appointment") }}',
                method: 'GET',
                data: {
                    lawyer_id: lawyerId,
                    date: date
                },
                success: function(response) {
                    if (response.success) {
                        $('#lawyer-detail-schedule-{{ $lawyer->id }}').html(response.success);
                        $('#lawyer-detail-schedule-box-{{ $lawyer->id }}').removeClass('d-none');
                        $('#lawyer-detail-submit-{{ $lawyer->id }}').prop('disabled', false);
                        $('#lawyer-detail-error-{{ $lawyer->id }}').addClass('d-none');
                    } else if (response.error) {
                        $('#lawyer-detail-schedule-box-{{ $lawyer->id }}').addClass('d-none');
                        $('#lawyer-detail-submit-{{ $lawyer->id }}').prop('disabled', true);
                        $('#lawyer-detail-error-{{ $lawyer->id }}').removeClass('d-none').html(response.error);
                    }
                },
                error: function() {
                    $('#lawyer-detail-error-{{ $lawyer->id }}').removeClass('d-none').html('{{ __("Error loading available times") }}');
                }
            });
        });
    });
    </script>
    @endpush
@endsection
