@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Contact')->first()->seo_title ?? 'Contact | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'Contact')->first()->seo_description ?? 'Contact | LawMent' }}">
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ $contactInfo?->header }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ $contactInfo?->header }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <i class="fas fa-phone"></i> {{ __('Phone') }}:
                            </span>
                            <div class="contact-text">
                                <a aria-label="{{ $contactInfo?->phone }}" href="tel:{!! nl2br($contactInfo?->phone) !!}">
                                    {!! nl2br($contactInfo?->phone) !!}</a>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-item bg2">
                        <div class="contact-info">
                            <span>
                                <i class="far fa-envelope"></i> {{ __('Email Address') }}:
                            </span>
                            <div class="contact-text">
                                <a aria-label="{{ $contactInfo?->email }}" href="mailto:{!! nl2br(e($contactInfo?->email)) !!}">{!! nl2br(e($contactInfo?->email)) !!}</a>

                            </div>
                        </div>
                    </div>
                    <div class="contact-info-item bg3">
                        <div class="contact-info">
                            <span>
                                <i class="fas fa-map-marker-alt"></i> {{ __('Address') }}:
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

    <!--Google map start-->
    <div class="map-area">
        {!! $contactInfo?->map_embed_code !!}
    </div>
    <!--Google map end-->
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
