@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Real Estate Legal Services') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Professional legal services for real estate purchase and investment cases through specialized and experienced lawyers') }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex"
    style="background-image:url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ __('Real Estate Legal Services') }}</h1>
                    <ul>
                        <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                        <li><span>{{ __('Real Estate Services') }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Real Estate Services Detail Start-->
<section class="real-estate-detail-area pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="real-estate-content">
                    <div class="main-headline mb_40">
                        <h2 class="title">{{ __('Real Estate Legal Services') }}</h2>
                        <p class="lead">{{ __('Professional legal services for real estate purchase and investment cases through specialized and experienced lawyers, completing the task in the fastest time') }}</p>
                    </div>

                    <div class="service-features mb_40">
                        <div class="row">
                            <div class="col-md-6 mb_30">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h4>{{ __('Property Purchase') }}</h4>
                                    <p>{{ __('Complete legal procedures for property purchase transactions with professional lawyers specialized in real estate law. We ensure all documents are properly reviewed and all legal requirements are met.') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb_30">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h4>{{ __('Real Estate Investment') }}</h4>
                                    <p>{{ __('Legal consultation and support for real estate investment projects with experienced lawyers. We help you make informed investment decisions and protect your interests.') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb_30">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <h4>{{ __('Legal Documentation') }}</h4>
                                    <p>{{ __('Preparation and review of all legal documents related to real estate transactions including contracts, deeds, and agreements.') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb_30">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-gavel"></i>
                                    </div>
                                    <h4>{{ __('Legal Disputes') }}</h4>
                                    <p>{{ __('Resolution of real estate disputes and conflicts through legal channels with experienced lawyers who understand real estate law.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-description mb_40">
                        <h3 class="mb_20">{{ __('Why Choose Our Real Estate Legal Services?') }}</h3>
                        <ul class="service-list">
                            <li><i class="fas fa-check-circle"></i> {{ __('Specialized lawyers with extensive experience in real estate law') }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('Fast and efficient completion of all legal procedures') }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('Comprehensive review of all documents and contracts') }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('Protection of your rights and interests throughout the process') }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('Professional consultation and guidance at every step') }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('Transparent pricing with no hidden fees') }}</li>
                        </ul>
                    </div>

                    <div class="service-process mb_40">
                        <h3 class="mb_20">{{ __('Our Process') }}</h3>
                        <div class="process-steps">
                            <div class="process-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>{{ __('Initial Consultation') }}</h4>
                                    <p>{{ __('We start with a comprehensive consultation to understand your needs and requirements') }}</p>
                                </div>
                            </div>
                            <div class="process-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>{{ __('Document Review') }}</h4>
                                    <p>{{ __('Our lawyers review all relevant documents and contracts thoroughly') }}</p>
                                </div>
                            </div>
                            <div class="process-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>{{ __('Legal Procedures') }}</h4>
                                    <p>{{ __('We handle all legal procedures and requirements efficiently') }}</p>
                                </div>
                            </div>
                            <div class="process-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>{{ __('Completion') }}</h4>
                                    <p>{{ __('We ensure all tasks are completed in the fastest time possible') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <div class="widget-box">
                        <h3 class="widget-title">{{ __('Contact Us') }}</h3>
                        <p>{{ __('Need help with your real estate legal matters? Contact our specialized lawyers today.') }}</p>
                        <a href="{{ route('website.book.consultation.appointment') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-calendar-check me-2"></i>{{ __('Book Consultation') }}
                        </a>
                    </div>
                    <div class="widget-box mt_30">
                        <h3 class="widget-title">{{ __('Our Services') }}</h3>
                        <ul class="service-links">
                            <li><a href="{{ route('website.services') }}"><i class="fas fa-chevron-left me-2"></i>{{ __('All Services') }}</a></li>
                            <li><a href="{{ route('website.departments') }}"><i class="fas fa-chevron-left me-2"></i>{{ __('Departments') }}</a></li>
                            <li><a href="{{ route('website.lawyers') }}"><i class="fas fa-chevron-left me-2"></i>{{ __('Our Lawyers') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Real Estate Services Detail End-->

@push('css')
<style>
.real-estate-section {
    background: #f8f9fa;
}

.real-estate-item {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.real-estate-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.real-estate-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--colorPrimary, #6b5d47) 0%, #5a4d3a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 32px;
}

.real-estate-item h3 {
    color: #333;
    margin-bottom: 15px;
    font-size: 20px;
}

.real-estate-item p {
    color: #666;
    line-height: 1.6;
}

.real-estate-detail-area .feature-box {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    height: 100%;
    transition: all 0.3s ease;
}

.real-estate-detail-area .feature-box:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.12);
    transform: translateY(-3px);
}

.real-estate-detail-area .feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--colorPrimary, #6b5d47) 0%, #5a4d3a 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    margin-bottom: 15px;
}

.real-estate-detail-area .feature-box h4 {
    color: #333;
    margin-bottom: 10px;
    font-size: 18px;
}

.service-list {
    list-style: none;
    padding: 0;
}

.service-list li {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: flex-start;
}

.service-list li:last-child {
    border-bottom: none;
}

.service-list li i {
    color: var(--colorPrimary, #6b5d47);
    margin-right: 10px;
    margin-top: 5px;
    font-size: 18px;
}

.process-steps {
    margin-top: 30px;
}

.process-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--colorPrimary, #6b5d47) 0%, #5a4d3a 100%);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
    margin-right: 20px;
    flex-shrink: 0;
}

.step-content h4 {
    color: #333;
    margin-bottom: 8px;
    font-size: 18px;
}

.step-content p {
    color: #666;
    margin: 0;
}

.sidebar-widget .widget-box {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.widget-title {
    color: #333;
    margin-bottom: 15px;
    font-size: 20px;
    font-weight: 600;
}

.service-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.service-links li {
    margin-bottom: 10px;
}

.service-links li a {
    color: #666;
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.service-links li a:hover {
    background: #f8f9fa;
    color: var(--colorPrimary, #6b5d47);
    padding-right: 15px;
}

@media (max-width: 768px) {
    .real-estate-item {
        margin-bottom: 20px;
    }
    
    .process-step {
        flex-direction: column;
        text-align: center;
    }
    
    .step-number {
        margin: 0 auto 15px;
    }
}
</style>
@endpush

@endsection

