@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Partnerships') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Partner with us to provide legal services') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Partnerships') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Partnerships') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!--Partnerships Start-->
<section class="partnerships-area pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                <div class="main-headline text-center">
                    <h2 class="title"><span>{{ __('Partner') }}</span> {{ __('With Us') }}</h2>
                    <p>{{ __('We are always looking for strategic partnerships that can help us better serve our clients and expand our reach. Whether you\'re a law firm, legal tech company, or business looking to offer legal services to your customers, we\'d love to hear from you.') }}</p>
                </div>
            </div>
        </div>

        <div class="row mt_50">
            <div class="col-lg-4 col-md-6 mt_30">
                <div class="partnership-type-card">
                    <div class="partnership-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h3>{{ __('Law Firms') }}</h3>
                    <p>{{ __('Partner with us to expand your client base and offer additional services through our platform. We provide the technology and infrastructure while you focus on delivering excellent legal services.') }}</p>
                    <ul class="partnership-benefits">
                        <li><i class="fas fa-check"></i> {{ __('Access to our client network') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Technology platform') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Marketing support') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Revenue sharing') }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="partnership-type-card">
                    <div class="partnership-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>{{ __('Legal Tech Companies') }}</h3>
                    <p>{{ __('Join forces with us to create innovative legal solutions. We\'re open to integrating with legal tech platforms, case management systems, and other tools that can enhance our service delivery.') }}</p>
                    <ul class="partnership-benefits">
                        <li><i class="fas fa-check"></i> {{ __('API integration') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Co-marketing opportunities') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Technical collaboration') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Joint product development') }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="partnership-type-card">
                    <div class="partnership-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>{{ __('Business Partners') }}</h3>
                    <p>{{ __('Offer legal services as part of your business offering. Whether you\'re an insurance company, HR platform, or business service provider, we can help you add legal services to your portfolio.') }}</p>
                    <ul class="partnership-benefits">
                        <li><i class="fas fa-check"></i> {{ __('White-label solutions') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Custom integration') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Dedicated support') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('Flexible pricing') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt_60">
            <div class="col-lg-6 mt_30">
                <div class="partnership-form-section">
                    <h3>{{ __('Interested in Partnering?') }}</h3>
                    <p>{{ __('Fill out the form below and we\'ll get back to you as soon as possible.') }}</p>
                    <form action="{{ route('website.contact-us') }}" method="GET" class="partnership-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Your Name') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('Your Email') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="company" class="form-control" placeholder="{{ __('Company Name') }}">
                        </div>
                        <div class="form-group">
                            <select name="partnership_type" class="form-control" required>
                                <option value="">{{ __('Partnership Type') }}</option>
                                <option value="law_firm">{{ __('Law Firm') }}</option>
                                <option value="legal_tech">{{ __('Legal Tech Company') }}</option>
                                <option value="business">{{ __('Business Partner') }}</option>
                                <option value="other">{{ __('Other') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="5" placeholder="{{ __('Tell us about your partnership interest') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 mt_30">
                <div class="partnership-info">
                    <h3>{{ __('Why Partner With Us?') }}</h3>
                    <div class="info-item">
                        <h4><i class="fas fa-chart-line"></i> {{ __('Growing Platform') }}</h4>
                        <p>{{ __('Join a rapidly growing legal tech platform with thousands of active users.') }}</p>
                    </div>
                    <div class="info-item">
                        <h4><i class="fas fa-shield-alt"></i> {{ __('Trusted Brand') }}</h4>
                        <p>{{ __('Partner with a trusted name in legal services with proven track record.') }}</p>
                    </div>
                    <div class="info-item">
                        <h4><i class="fas fa-handshake"></i> {{ __('Mutual Benefits') }}</h4>
                        <p>{{ __('We believe in partnerships that benefit both parties and create value for everyone.') }}</p>
                    </div>
                    <div class="info-item">
                        <h4><i class="fas fa-headset"></i> {{ __('Support') }}</h4>
                        <p>{{ __('Dedicated partnership support team to help you succeed.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Partnerships End-->

@endsection

