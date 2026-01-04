@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Business Subscription') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Reliable legal support for businesses at a fixed price') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('For Employers') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Business Subscription') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!--Business Subscription Start-->
<section class="business-subscription-area pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                <div class="main-headline text-center">
                    <h2 class="title"><span>{{ __('Reliable legal support') }}</span> {{ __('for businesses') }}</h2>
                    <p class="subtitle">{{ __('at a fixed price') }}</p>
                    <p>{{ __('As a business client, you can sign up for a subscription tailored to your company\'s needs. Your plan includes a set number of video meetings per year – perfect for when you need to quickly speak to a lawyer. With our larger subscriptions, you also get discounts on legal services, such as for help drafting or reviewing contracts, handling disputes, or getting support with other legal matters.') }}</p>
                    <p>{{ __('With us, you get access to your own in-house lawyer – without having to hire one yourself. You\'ll always know the price upfront, making it easy to plan and feel confident using our services.') }}</p>
                </div>
            </div>
        </div>

        <div class="row mt_50">
            <div class="col-lg-4 col-md-6 mt_30">
                <div class="subscription-plan-card">
                    <div class="plan-header">
                        <h3 class="plan-name">{{ __('Basic Plan') }}</h3>
                        <div class="plan-price">
                            <span class="currency">{{ session()->get('currency_icon', '$') }}</span>
                            <span class="amount">299</span>
                            <span class="period">/{{ __('month') }}</span>
                        </div>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check"></i> {{ __('5 video consultations per year') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Email support') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Basic contract review') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('10% discount on legal services') }}</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Get Started') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="subscription-plan-card featured">
                    <div class="plan-badge">{{ __('Most Popular') }}</div>
                    <div class="plan-header">
                        <h3 class="plan-name">{{ __('Professional Plan') }}</h3>
                        <div class="plan-price">
                            <span class="currency">{{ session()->get('currency_icon', '$') }}</span>
                            <span class="amount">599</span>
                            <span class="period">/{{ __('month') }}</span>
                        </div>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check"></i> {{ __('15 video consultations per year') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Priority email support') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Contract drafting & review') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('20% discount on legal services') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Dispute resolution support') }}</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Get Started') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="subscription-plan-card">
                    <div class="plan-header">
                        <h3 class="plan-name">{{ __('Enterprise Plan') }}</h3>
                        <div class="plan-price">
                            <span class="currency">{{ session()->get('currency_icon', '$') }}</span>
                            <span class="amount">999</span>
                            <span class="period">/{{ __('month') }}</span>
                        </div>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check"></i> {{ __('Unlimited video consultations') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('24/7 priority support') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Full legal service suite') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('30% discount on legal services') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Dedicated account manager') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('Custom legal solutions') }}</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Get Started') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt_60">
            <div class="col-12">
                <div class="subscription-benefits">
                    <h3 class="text-center mb_40">{{ __('Why Choose Our Business Subscription?') }}</h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mt_30">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <h4>{{ __('Fixed Price') }}</h4>
                                <p>{{ __('No hidden fees or surprises. Always know what you\'ll pay upfront.') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mt_30">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4>{{ __('Quick Access') }}</h4>
                                <p>{{ __('Get legal advice when you need it, without long waiting times.') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mt_30">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4>{{ __('Expert Team') }}</h4>
                                <p>{{ __('Access to experienced lawyers specialized in business law.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt_60">
            <div class="col-12 text-center">
                <div class="cta-section">
                    <h3>{{ __('Ready to get started?') }}</h3>
                    <p>{{ __('Contact us today to discuss which plan is right for your business.') }}</p>
                    <a href="{{ route('website.contact-us') }}" class="btn btn-primary btn-lg mt_30">{{ __('Contact Us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Business Subscription End-->

@endsection

