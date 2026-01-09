@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Verify OTP') }}</title>
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Verify OTP') }}</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Verify OTP') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--WhatsApp Verify Start-->
    <div class="login-area pt_70 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="login_area_bg">
                        <h4 class="text-center mb-4">{{ __('Enter Verification Code') }}</h4>
                        <p class="text-center text-muted mb-4">
                            {{ __('We sent a 6-digit code to') }} 
                            <strong>{{ session('whatsapp_phone') }}</strong>
                        </p>
                        
                        <form action="{{ route('whatsapp.verify-otp') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="otp">{{ __('Verification Code') }}</label>
                                    <input type="text" name="otp" id="otp" class="form-control text-center"
                                        placeholder="000000" maxlength="6" pattern="[0-9]{6}" 
                                        style="font-size: 24px; letter-spacing: 8px; font-weight: 600;" required autofocus>
                                    @error('otp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ __('Verify') }}</button>
                                </div>
                            </div>
                        </form>
                        
                        <p class="text-center mt-3">
                            <a href="{{ route('whatsapp.phone') }}" class="link">{{ __('Resend OTP') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--WhatsApp Verify End-->
@endsection
@push('js')
<script>
    // Auto-focus and format OTP input
    document.getElementById('otp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length === 6) {
            this.form.submit();
        }
    });
</script>
@endpush

