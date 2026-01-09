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
                        
                        {{-- زر الحجز فقط --}}
                        <div class="mt-3 d-flex gap-2 flex-wrap">
                            <a href="{{ route('website.book.consultation.appointment') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check"></i> {{ __('Book Consultation Appointment') }}
                            </a>
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
                            <li class="nav-item">
                                <a aria-label="{{ __('Education') }}" aria-selected="true" 
                                    class="nav-link active" data-bs-toggle="tab" href="#education">
                                    <i class="fas fa-graduation-cap me-2"></i>{{ __('Education') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a aria-label="{{ __('Experience') }}" aria-selected="false" 
                                    class="nav-link" data-bs-toggle="tab" href="#experience">
                                    <i class="fas fa-briefcase me-2"></i>{{ __('Experience') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a aria-label="{{ __('Qualification') }}" aria-selected="false" 
                                    class="nav-link" data-bs-toggle="tab" href="#qualification">
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

@endsection

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
            color: #6b5d47;
            border-bottom-color: #6b5d47;
            background: rgba(107, 93, 71, 0.08);
        }
        
        /* تحسين التبويب النشط - نمط CV احترافي */
        .event-detail-tab .nav-tabs li.active a,
        .event-detail-tab .nav-tabs li a.active,
        .event-detail-tab .nav-tabs li a.active.show,
        .event-detail-tab .nav-tabs .nav-link.active {
            color: #ffffff !important;
            border-bottom-color: #6b5d47;
            background: linear-gradient(135deg, #6b5d47 0%, #5a4d3a 100%) !important;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 -2px 8px rgba(107, 93, 71, 0.2);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .event-detail-tab .nav-tabs li.active a i,
        .event-detail-tab .nav-tabs li a.active i,
        .event-detail-tab .nav-tabs .nav-link.active i {
            color: #ffffff !important;
        }
        
        /* إزالة التمييز من التبويبات غير النشطة عند النقر */
        .event-detail-tab .nav-tabs .nav-link:not(.active) {
            color: #666;
            background: transparent;
        }
        
        .event-detail-tab .nav-tabs li a i {
            font-size: 18px;
            margin-left: 8px;
            transition: all 0.3s ease;
        }
        
        .event-detail-tab .nav-tabs li a:hover i {
            color: #6b5d47;
        }
        
        /* تحسين تصميم محتوى المعلومات - نمط CV احترافي */
        .info-section {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            min-height: 200px;
        }
        
        .info-content {
            font-size: 16px;
            line-height: 1.9;
            color: #2c3e50;
            direction: inherit;
        }
        
        /* دعم RTL/LTR للمحتوى */
        [dir="rtl"] .info-content {
            direction: rtl;
            text-align: right;
        }
        
        [dir="ltr"] .info-content {
            direction: ltr;
            text-align: left;
        }
        
        /* تحسين الجداول - نمط CV احترافي مع دعم RTL/LTR */
        .info-content table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 30px 0;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e8e8e8;
            direction: inherit;
        }
        
        /* دعم RTL/LTR للجداول */
        [dir="rtl"] .info-content table,
        .info-content table[dir="rtl"] {
            direction: rtl;
        }
        
        [dir="ltr"] .info-content table,
        .info-content table[dir="ltr"] {
            direction: ltr;
        }
        
        /* رأس الجدول - تصميم احترافي */
        .info-content table thead {
            background: linear-gradient(135deg, #6b5d47 0%, #5a4d3a 100%);
            background-color: #6b5d47;
            color: #ffffff;
            position: relative;
        }
        
        .info-content table thead::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 100%);
        }
        
        .info-content table thead th {
            padding: 20px 24px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
            color: #ffffff !important;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #6b5d47 0%, #5a4d3a 100%) !important;
            border: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            white-space: nowrap;
        }
        
        /* محاذاة النص حسب الاتجاه */
        [dir="rtl"] .info-content table thead th,
        .info-content table[dir="rtl"] thead th {
            text-align: right;
        }
        
        [dir="ltr"] .info-content table thead th,
        .info-content table[dir="ltr"] thead th {
            text-align: left;
        }
        
        /* خط فاصل بين الأعمدة في الرأس */
        .info-content table thead th:not(:last-child) {
            border-left: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        [dir="rtl"] .info-content table thead th:not(:last-child),
        .info-content table[dir="rtl"] thead th:not(:last-child) {
            border-left: none;
            border-right: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        /* ضمان التباين الجيد في جميع الحالات */
        .info-content table thead[style*="background"] th,
        .info-content table thead th,
        .info-content table thead th[style*="color"] {
            color: #ffffff !important;
            background: linear-gradient(135deg, #6b5d47 0%, #5a4d3a 100%) !important;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
        }
        
        /* صفوف الجدول - تصميم منظم */
        .info-content table tbody {
            background: #fff;
        }
        
        .info-content table tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            position: relative;
        }
        
        .info-content table tbody tr:last-child {
            border-bottom: none;
        }
        
        .info-content table tbody tr:nth-child(even) {
            background: #fafbfc;
        }
        
        .info-content table tbody tr:hover {
            background: #f5f3f0;
            box-shadow: 0 4px 12px rgba(107, 93, 71, 0.12);
            transform: translateY(-1px);
        }
        
        /* خلايا الجدول - تصميم احترافي */
        .info-content table tbody td {
            padding: 18px 24px;
            color: #2c3e50;
            font-size: 15px;
            line-height: 1.7;
            border: none;
            background: transparent;
            vertical-align: middle;
            position: relative;
        }
        
        /* محاذاة النص في الخلايا حسب الاتجاه */
        [dir="rtl"] .info-content table tbody td,
        .info-content table[dir="rtl"] tbody td {
            text-align: right;
        }
        
        [dir="ltr"] .info-content table tbody td,
        .info-content table[dir="ltr"] tbody td {
            text-align: left;
        }
        
        /* خط فاصل بين الأعمدة */
        .info-content table tbody td:not(:last-child) {
            border-left: 1px solid #f0f0f0;
        }
        
        [dir="rtl"] .info-content table tbody td:not(:last-child),
        .info-content table[dir="rtl"] tbody td:not(:last-child) {
            border-left: none;
            border-right: 1px solid #f0f0f0;
        }
        
        .info-content table tbody tr:hover td:not(:last-child) {
            border-left-color: rgba(107, 93, 71, 0.2);
        }
        
        [dir="rtl"] .info-content table tbody tr:hover td:not(:last-child),
        .info-content table[dir="rtl"] tbody tr:hover td:not(:last-child) {
            border-left-color: transparent;
            border-right-color: rgba(107, 93, 71, 0.2);
        }
        
        /* العمود الأول - تصميم مميز */
        .info-content table tbody td:first-child {
            font-weight: 600;
            color: #2c3e50;
            min-width: 150px;
            width: 25%;
            background: transparent;
            position: relative;
        }
        
        [dir="rtl"] .info-content table tbody td:first-child::after,
        .info-content table[dir="rtl"] tbody td:first-child::after {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: linear-gradient(to bottom, #6b5d47, transparent);
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        [dir="ltr"] .info-content table tbody td:first-child::after,
        .info-content table[dir="ltr"] tbody td:first-child::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: linear-gradient(to bottom, #6b5d47, transparent);
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .info-content table tbody tr:hover td:first-child {
            color: #6b5d47;
        }
        
        .info-content table tbody tr:hover td:first-child::after {
            opacity: 1;
        }
        
        /* تحسين الألوان للصفوف الزوجية */
        .info-content table tbody tr:nth-child(even) td {
            background: transparent;
        }
        
        /* تحسين الخطوط والتباعد */
        .info-content table tbody td strong {
            color: #1a252f;
            font-weight: 700;
        }
        
        .info-content table tbody td em {
            color: #6b5d47;
            font-style: italic;
        }
        
        /* تحسين الجدول على الشاشات الصغيرة */
        @media (max-width: 768px) {
            .info-content table {
                border-radius: 8px;
                margin: 20px 0;
            }
            
            .info-content table thead th {
                padding: 14px 16px;
                font-size: 14px;
            }
            
            .info-content table tbody td {
                padding: 14px 16px;
                font-size: 14px;
            }
            
            .info-content table tbody td:first-child {
                min-width: 120px;
                width: 30%;
            }
        }
        
        /* تحسين القوائم - نمط CV */
        .info-content ul,
        .info-content ol {
            margin: 25px 0;
            padding-right: 0;
            list-style: none;
        }
        
        .info-content ul li {
            margin-bottom: 18px;
            position: relative;
            padding-right: 35px;
            padding-top: 5px;
            line-height: 1.8;
        }
        
        .info-content ul li::before {
            content: "";
            position: absolute;
            right: 0;
            top: 10px;
            width: 12px;
            height: 12px;
            background: #6b5d47;
            border-radius: 50%;
            border: 3px solid rgba(107, 93, 71, 0.2);
            box-shadow: 0 0 0 3px rgba(107, 93, 71, 0.1);
        }
        
        .info-content ul li::after {
            content: "";
            position: absolute;
            right: 5px;
            top: 25px;
            width: 2px;
            height: calc(100% + 5px);
            background: linear-gradient(to bottom, #6b5d47, transparent);
            opacity: 0.3;
        }
        
        .info-content ul li:last-child::after {
            display: none;
        }
        
        /* تحسين العناوين */
        .info-content h2,
        .info-content h3,
        .info-content h4 {
            color: #6b5d47;
            margin-top: 35px;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(107, 93, 71, 0.2);
        }
        
        .info-content h2 {
            font-size: 24px;
        }
        
        .info-content h3 {
            font-size: 20px;
        }
        
        .info-content h4 {
            font-size: 18px;
        }
        
        .info-content h2:first-child,
        .info-content h3:first-child,
        .info-content h4:first-child {
            margin-top: 0;
        }
        
        .info-content h2::after,
        .info-content h3::after,
        .info-content h4::after {
            content: "";
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 60px;
            height: 2px;
            background: #6b5d47;
        }
        
        /* تحسين الفقرات */
        .info-content p {
            margin-bottom: 18px;
            color: #2c3e50;
            line-height: 1.9;
        }
        
        .info-content strong {
            color: #1a252f;
            font-weight: 700;
        }
        
        /* تحسين الروابط */
        .info-content a {
            color: var(--colorPrimary);
            text-decoration: none;
            border-bottom: 1px dotted var(--colorPrimary);
            transition: all 0.3s ease;
        }
        
        .info-content a:hover {
            color: var(--colorSecondary);
            border-bottom-color: var(--colorSecondary);
        }
        
        /* بطاقات CV للعناصر المهمة */
        .info-content > div,
        .info-content > section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-right: 4px solid #6b5d47;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }
        
        /* تحسين القوائم المرقمة */
        .info-content ol {
            counter-reset: cv-counter;
        }
        
        .info-content ol li {
            counter-increment: cv-counter;
            position: relative;
            padding-right: 40px;
            margin-bottom: 18px;
        }
        
        .info-content ol li::before {
            content: counter(cv-counter);
            position: absolute;
            right: 0;
            top: 0;
            width: 28px;
            height: 28px;
            background: #6b5d47;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(107, 93, 71, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
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
            color: #2c3e50;
            margin-bottom: 10px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        .team-headline h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, var(--colorPrimary), var(--colorSecondary));
            border-radius: 2px;
        }
        
        /* تحسين تصميم بطاقة المحامي */
        .team-detail-text h4 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
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
                padding: 20px 15px;
                border-radius: 8px;
            }
            
            /* تحسين التبويبات على الموبايل */
            .event-detail-tab .nav-tabs {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 20px;
            }
            
            .event-detail-tab .nav-tabs::-webkit-scrollbar {
                display: none;
            }
            
            .event-detail-tab .nav-tabs li {
                flex: 0 0 auto;
                white-space: nowrap;
            }
            
            .event-detail-tab .nav-tabs li a {
                padding: 12px 18px;
                font-size: 14px;
                white-space: nowrap;
            }
            
            .event-detail-tab .nav-tabs li a i {
                font-size: 16px;
                margin-left: 6px;
            }
            
            .team-headline h2 {
                font-size: 22px;
                margin-bottom: 15px;
            }
            
            /* تحسين الجداول على الموبايل مع دعم RTL/LTR */
            .info-content table {
                font-size: 13px;
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
            }
            
            /* على الشاشات الصغيرة، نعرض الجدول بشكل عمودي */
            .info-content table thead {
                display: none;
            }
            
            .info-content table tbody {
                display: block;
            }
            
            .info-content table tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 0;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
                overflow: hidden;
            }
            
            .info-content table tbody tr:last-child {
                margin-bottom: 0;
            }
            
            .info-content table tbody td {
                padding: 12px 16px;
                display: block;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                position: relative;
            }
            
            /* محاذاة النص حسب الاتجاه */
            [dir="rtl"] .info-content table tbody td,
            .info-content table[dir="rtl"] tbody td {
                text-align: right;
            }
            
            [dir="ltr"] .info-content table tbody td,
            .info-content table[dir="ltr"] tbody td {
                text-align: left;
            }
            
            .info-content table tbody td:last-child {
                border-bottom: none;
            }
            
            /* إضافة تسمية للعمود الأول */
            .info-content table tbody td:first-child {
                background: linear-gradient(135deg, #6b5d47 0%, #5a4d3a 100%);
                color: #ffffff !important;
                font-weight: 700;
                font-size: 14px;
                padding: 14px 16px;
                border-bottom: 2px solid rgba(255, 255, 255, 0.2);
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            }
            
            [dir="rtl"] .info-content table tbody td:first-child::after,
            .info-content table[dir="rtl"] tbody td:first-child::after {
                display: none;
            }
            
            [dir="ltr"] .info-content table tbody td:first-child::after,
            .info-content table[dir="ltr"] tbody td:first-child::after {
                display: none;
            }
            
            /* إزالة الحدود الجانبية على الموبايل */
            .info-content table tbody td:not(:last-child) {
                border-left: none;
                border-right: none;
            }
            
            .info-content table tbody tr:hover {
                transform: none;
                box-shadow: 0 3px 12px rgba(107, 93, 71, 0.15);
            }
            
            .info-content h2 {
                font-size: 20px;
                margin-top: 25px;
            }
            
            .info-content h3 {
                font-size: 18px;
            }
            
            .info-content h4 {
                font-size: 16px;
            }
            
            .info-content ul li {
                padding-right: 30px;
                margin-bottom: 15px;
            }
            
            .info-content ul li::before {
                width: 10px;
                height: 10px;
                top: 8px;
            }
            
            /* تحسين بطاقة المحامي */
            .team-detail-photo {
                margin-bottom: 20px;
            }
            
            .team-detail-text h4 {
                font-size: 24px;
            }
            
            .team-detail-text span {
                font-size: 16px;
            }
            
            /* تحسين الأزرار */
            .team-detail-text .btn {
                width: 100%;
                margin-bottom: 10px;
                padding: 12px 20px;
                font-size: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .info-section {
                padding: 15px 12px;
            }
            
            .event-detail-tab .nav-tabs li a {
                padding: 10px 15px;
                font-size: 13px;
            }
            
            .team-headline h2 {
                font-size: 20px;
            }
            
            .info-content table thead th {
                padding: 12px 14px;
                font-size: 13px;
            }
            
            .info-content table tbody td {
                padding: 10px 14px;
                font-size: 13px;
            }
            
            .info-content table tbody td:first-child {
                padding: 12px 14px;
                font-size: 13px;
            }
            
            .info-content h2 {
                font-size: 18px;
            }
            
            .info-content h3 {
                font-size: 16px;
            }
            
            .info-content h4 {
                font-size: 14px;
            }
            
            .team-detail-text h4 {
                font-size: 20px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
    $(document).ready(function() {
        // تفعيل التبويبات بشكل صحيح
        $('.event-detail-tab .nav-tabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            // إزالة class active من جميع التبويبات
            $('.event-detail-tab .nav-tabs li').removeClass('active');
            $('.event-detail-tab .nav-tabs .nav-link').removeClass('active');
            
            // إضافة class active للتبويب المختار
            $(this).addClass('active');
            $(this).closest('li').addClass('active');
            
            // إزالة show active من جميع المحتويات
            $('.tab-content .tab-pane').removeClass('show active');
            
            // إضافة show active للمحتوى المختار
            var target = $(this).attr('href');
            $(target).addClass('show active');
        });
        
        // التأكد من أن التبويب الأول نشط عند التحميل
        var firstTab = $('.event-detail-tab .nav-tabs .nav-link').first();
        if (firstTab.length && !firstTab.hasClass('active')) {
            firstTab.addClass('active');
            firstTab.closest('li').addClass('active');
        }
    });
    </script>
@endpush
