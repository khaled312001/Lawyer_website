@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Login with WhatsApp') }}</title>
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Login with WhatsApp') }}</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('WhatsApp Login') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--WhatsApp Phone Start-->
    <div class="login-area pt_70 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="login_area_bg">
                        <h4 class="text-center mb-4">{{ __('Enter Your Phone Number') }}</h4>
                        <p class="text-center text-muted mb-4">{{ __('We will send you a verification code via WhatsApp') }}</p>
                        
                        <form action="{{ route('whatsapp.send-otp') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="phone">{{ __('Phone Number') }}</label>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        placeholder="963912345678" value="{{ old('phone') }}" required>
                                    <small class="form-text text-muted">{{ __('Enter your phone number without + or spaces') }}</small>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ __('Send OTP') }}</button>
                                </div>
                            </div>
                        </form>
                        
                        <p class="text-center mt-3">
                            <a href="{{ route('login') }}" class="link">{{ __('Back to Login') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--WhatsApp Phone End-->
@endsection

