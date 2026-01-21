@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'Contact')->first();
    $seoTitle = $seoData?->seo_title ?? __('Contact Us') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Get in touch with us for legal consultation and services');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('contact, contact us, legal consultation, get in touch, اتصل بنا, استشارة قانونية') }}">
    <meta name="robots" content="index, follow">
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
@endsection

@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ContactPage",
        "name": "{{ __('Contact Us') }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ $currentUrl }}",
        "mainEntity": {
            "@type": "LegalService",
            "name": "{{ $setting->app_name ?? 'LawMent' }}",
            @if($contactInfo?->top_bar_phone)
            "telephone": "{{ $contactInfo->top_bar_phone }}",
            @endif
            @if($contactInfo?->top_bar_email)
            "email": "{{ $contactInfo->top_bar_email }}",
            @endif
            @if($contactInfo?->address)
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $contactInfo->address }}"
            }
            @endif
        }
    }
    </script>
    
    @if($contactInfo)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "{{ $setting->app_name ?? 'LawMent' }}",
        "description": "{{ $seoDescription }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ $contactInfo->top_bar_phone ?? '' }}",
        "email": "{{ $contactInfo->top_bar_email ?? '' }}",
        @if($contactInfo->address)
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $contactInfo->address }}"
        },
        @endif
        "priceRange": "$$",
        "image": "{{ $seoImage }}"
    }
    </script>
    @endif
@endsection

@section('client-content')
    <!--Banner Start-->
    <section class="banner-area enhanced-breadcrumb flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : asset('client/img/shape-2.webp') }});">
        <div class="breadcrumb-overlay"></div>
        <div class="breadcrumb-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-text enhanced-title-content">
                        <div class="title-wrapper">
                            <span class="title-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <h1 class="title">{{ $contactInfo?->header }}</h1>
                        </div>
                        <ul class="breadcrumb-nav">
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                            <li class="separator"><i class="fas fa-chevron-left"></i></li>
                            <li class="active"><span>{{ $contactInfo?->header }}</span></li>
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
    <!--Banner End-->

    <!--Form Start-->
    <div class="contauct-style1  pt_50 pb_65">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="about1-text mt_30">
                        <h1>{{ $contactInfo?->header }}</h1>
                        <p class="mb_30">
                            {{ $contactInfo?->description }}
                        </p>
                    </div>
                    <form action="{{ route('send-contact-message') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-{{ session('alert-type', 'success') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row contact-form">
                            <div class="col-md-6 form-group">
                                <label>{{ __('Name') }} *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Email') }} *</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Phone') }}</label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Subject') }} *</label>
                                <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>{{ __('Message') }} *</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="massege" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if ($setting->recaptcha_status == 'active')
                                <div class="form-group col-12">
                                    <div class="g-recaptcha" data-sitekey="{{ $setting->recaptcha_site_key }}"></div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 contact_margin">
                    <div class="contact-info-item bg1">
                        <div class="contact-info">
                            <span>
                                <span>{{ __('Phone') }}:</span>
                                <i class="fas fa-phone"></i>
                            </span>
                            <div class="contact-text">
                                @php
                                    $phoneDisplay = $contactInfo?->phone ?? '';
                                    // Move + to end for Arabic language (RTL)
                                    if (getSessionLanguage() == 'ar' && $phoneDisplay) {
                                        // Handle multiple lines
                                        $phoneLines = explode("\n", $phoneDisplay);
                                        $formattedLines = [];
                                        foreach ($phoneLines as $line) {
                                            $line = trim($line);
                                            if ($line) {
                                                // Remove + from start if exists
                                                if (str_starts_with($line, '+')) {
                                                    $line = substr($line, 1);
                                                }
                                                // Add + at the end
                                                $formattedLines[] = $line . '+';
                                            }
                                        }
                                        $phoneDisplay = implode("\n", $formattedLines);
                                    }
                                @endphp
                                <a aria-label="{{ $contactInfo?->phone }}" href="tel:{{ $contactInfo?->phone }}">
                                    {!! nl2br(e($phoneDisplay)) !!}</a>
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-item bg2">
                        <div class="contact-info">
                            <span>
                                <span>{{ __('Email Address') }}:</span>
                                <i class="far fa-envelope"></i>
                            </span>
                            <div class="contact-text">
                                <a aria-label="{{ $contactInfo?->top_bar_email ?? $contactInfo?->email }}" href="mailto:{{ $contactInfo?->top_bar_email ?? $contactInfo?->email }}">{{ $contactInfo?->top_bar_email ?? $contactInfo?->email }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-item bg3">
                        <div class="contact-info">
                            <span>
                                <span>{{ __('Address') }}:</span>
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <div class="contact-text">
                                <p>
                                    {!! nl2br($contactInfo?->address) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Form End-->
@endsection

@push('css')
<style>
/* ============================================
   CONTACT US PAGE - ENHANCED DESIGN
   ============================================ */

/* Contact Section */
.contauct-style1 {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}

.contauct-style1::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.05) 0%, rgba(200, 180, 126, 0.1) 100%);
    z-index: 0;
    border-radius: 0 0 0 100px;
}

[dir="rtl"] .contauct-style1::before {
    right: auto;
    left: 0;
    border-radius: 0 0 100px 0;
}

/* Form Section */
.contauct-style1 .col-lg-7 {
    position: relative;
    z-index: 1;
}

.about1-text {
    margin-bottom: 40px;
}

.about1-text h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .about1-text h1 {
    text-align: right;
}

.about1-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .about1-text p {
    text-align: right;
}

/* Contact Form Enhancement */
.contact-form {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.contact-form:hover {
    box-shadow: 0 15px 50px rgba(0,0,0,0.12);
}

.contact-form .form-group {
    margin-bottom: 25px;
}

.contact-form label {
    display: block;
    font-weight: 600;
    font-size: 15px;
    color: #2c3e50;
    margin-bottom: 10px;
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] .contact-form label,
[dir="ltr"] .contact-form label {
    text-align: right !important;
    direction: rtl !important;
}

.contact-form .form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
    text-align: right !important;
    direction: rtl !important;
    width: 100%;
}

[dir="rtl"] .contact-form .form-control,
[dir="ltr"] .contact-form .form-control {
    text-align: right !important;
    direction: rtl !important;
}

.contact-form .form-control:focus {
    border-color: var(--colorPrimary);
    box-shadow: 0 0 0 4px rgba(200, 180, 126, 0.15);
    outline: none;
    background: #fff;
}

.contact-form .form-control::placeholder {
    text-align: right !important;
    direction: rtl !important;
    color: #adb5bd;
}

textarea.form-control {
    min-height: 150px;
    resize: vertical;
    text-align: right !important;
    direction: rtl !important;
}

[dir="rtl"] textarea.form-control,
[dir="ltr"] textarea.form-control {
    text-align: right !important;
    direction: rtl !important;
}

/* Submit Button */
.contact-form .btn {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    border: none;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    padding: 16px 40px;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.3);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-width: 180px;
    direction: rtl;
    text-align: right;
}

[dir="rtl"] .contact-form .btn,
[dir="ltr"] .contact-form .btn {
    direction: rtl;
    text-align: right;
}

.contact-form .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.4);
    background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%);
}

.contact-form .btn:active {
    transform: translateY(-1px);
}

/* Contact Info Cards */
.contact_margin {
    margin-top: 0;
    padding-left: 0;
    position: relative;
    z-index: 1;
}

[dir="rtl"] .contact_margin {
    padding-left: 0;
    padding-right: 0;
}

.contact-info-item {
    margin-bottom: 25px;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

.contact-info-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.contact-info-item:hover::before {
    opacity: 1;
}

.contact-info-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.contact-info-item.bg1 {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
}

.contact-info-item.bg2 {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
}

.contact-info-item.bg3 {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
}

.contact-info {
    padding: 30px 25px;
    position: relative;
    z-index: 1;
}

.contact-info span {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    text-align: right !important;
    direction: rtl !important;
    justify-content: flex-end !important;
}

[dir="rtl"] .contact-info span,
[dir="ltr"] .contact-info span {
    text-align: right !important;
    direction: rtl !important;
    justify-content: flex-end !important;
}

.contact-info span i {
    font-size: 22px;
    color: var(--colorSecondary, #f4d03f);
    order: 1 !important;
    margin-left: 10px !important;
    margin-right: 0 !important;
    width: 28px;
    min-width: 28px;
    text-align: center;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    padding: 8px;
    transition: all 0.3s ease;
}

.contact-info-item:hover .contact-info span i {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.1) rotate(5deg);
}

[dir="rtl"] .contact-info span i,
[dir="ltr"] .contact-info span i {
    order: 1 !important;
    margin-left: 10px !important;
    margin-right: 0 !important;
}

.contact-info span > span {
    order: 2 !important;
    text-align: right !important;
    direction: rtl !important;
    flex: 1;
}

[dir="rtl"] .contact-info span > span,
[dir="ltr"] .contact-info span > span {
    order: 2 !important;
    text-align: right !important;
    direction: rtl !important;
}

.contact-text {
    margin-top: 10px;
}

.contact-text p,
.contact-text a {
    font-size: 18px;
    font-weight: 500;
    color: #fff;
    text-decoration: none;
    line-height: 1.6;
    text-align: right;
    direction: rtl;
    transition: all 0.3s ease;
    display: block;
}

[dir="rtl"] .contact-text p,
[dir="rtl"] .contact-text a,
[dir="ltr"] .contact-text p,
[dir="ltr"] .contact-text a {
    text-align: right;
    direction: rtl;
}

.contact-text a:hover {
    color: var(--colorSecondary, #f4d03f);
    transform: translateX(-5px);
}

[dir="rtl"] .contact-text a:hover {
    transform: translateX(5px);
}

/* Alerts */
.alert {
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 25px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .alert,
[dir="ltr"] .alert {
    text-align: right;
    direction: rtl;
}

.alert-danger {
    background: #fff5f5;
    color: #c53030;
    border-left: 4px solid #c53030;
}

[dir="rtl"] .alert-danger {
    border-left: none;
    border-right: 4px solid #c53030;
}

.alert-success {
    background: #f0fff4;
    color: #22543d;
    border-left: 4px solid #22543d;
}

[dir="rtl"] .alert-success {
    border-left: none;
    border-right: 4px solid #22543d;
}

.alert ul {
    margin: 0;
    padding-right: 20px;
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .alert ul {
    padding-right: 20px;
    padding-left: 0;
}

/* Invalid Feedback */
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 8px;
    font-size: 14px;
    color: #dc3545;
    text-align: right;
    direction: rtl;
}

[dir="rtl"] .invalid-feedback,
[dir="ltr"] .invalid-feedback {
    text-align: right;
    direction: rtl;
}

/* Recaptcha */
.g-recaptcha {
    margin: 20px 0;
    display: flex;
    justify-content: flex-end;
    direction: rtl;
}

[dir="rtl"] .g-recaptcha,
[dir="ltr"] .g-recaptcha {
    justify-content: flex-end;
    direction: rtl;
}

/* Responsive Design */
@media (max-width: 992px) {
    .contact_margin {
        margin-top: 40px;
        padding-left: 0;
    }

    .about1-text h1 {
        font-size: 2rem;
    }

    .contact-form {
        padding: 30px 25px;
    }
}

@media (max-width: 768px) {
    .contauct-style1::before {
        width: 100%;
        border-radius: 0;
    }

    .about1-text h1 {
        font-size: 1.8rem;
    }

    .about1-text p {
        font-size: 1rem;
    }

    .contact-form {
        padding: 25px 20px;
    }

    .contact-form .form-control {
        padding: 12px 16px;
        font-size: 14px;
    }

    .contact-form .btn {
        width: 100%;
        padding: 14px 30px;
    }

    .contact-info {
        padding: 25px 20px;
    }

    .contact-info span {
        font-size: 15px;
    }

    .contact-text p,
    .contact-text a {
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .about1-text h1 {
        font-size: 1.6rem;
    }

    .contact-form {
        padding: 20px 15px;
    }

    .contact-info {
        padding: 20px 15px;
    }

    .contact-info span {
        font-size: 14px;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
    }

    .contact-info span i {
        margin-left: 0;
        margin-bottom: 5px;
    }

    .contact-text p,
    .contact-text a {
        font-size: 15px;
    }
}
</style>
@endpush

@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
