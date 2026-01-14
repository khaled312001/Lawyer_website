@extends('layouts.client.layout')
@section('title')
    <title>{{ $service?->seo_title ?? $service?->title  }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $service?->seo_description }}">
    <meta property="og:title" content="{{ $service?->seo_title }}" />
    <meta property="og:description" content="{{ $service?->seo_description }}" />
    <meta property="og:image" content="{{ asset($service?->icon) }}" />
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
                        <h1>{{ $service?->title }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ $service?->title }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Service Detail Start-->
    <div class="service-detail-area pt_40">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="service-detail-text pt_30">

                        @if ($service?->images && $service->images->count() > 0)
                        <div class="row mb_30">
                            <div class="col-md-12">
                                <!-- Swiper -->
                                <div class="swiper-container pro-detail-top">
                                    <div class="swiper-wrapper">
                                        @foreach ($service->images as $item)
                                            @if ($item?->large_image && file_exists(public_path($item->large_image)))
                                            <div class="swiper-slide">
                                                <div class="catagory-item">
                                                    <div class="catagory-img-holder">
                                                        <img src="{{ asset($item->large_image) }}" 
                                                             alt="{{ $service?->title }}" 
                                                             loading="lazy"
                                                             onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;">
                                                        <div class="catagory-text">
                                                            <div class="catagory-text-table">
                                                                <div class="catagory-text-cell">
                                                                    <ul class="catagory-hover">
                                                                        <li><a aria-label="{{ __('Search') }}" href="{{ asset($item->large_image) }}"
                                                                                class="magnific"><i
                                                                                    class="fas fa-search"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach


                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next swiper-button-white"></div>
                                    <div class="swiper-button-prev swiper-button-white"></div>
                                </div>
                                @if ($service->images->where('small_image', '!=', null)->count() > 0)
                                <div class="swiper-container pro-detail-thumbs">
                                    <div class="swiper-wrapper">
                                        @foreach ($service->images as $item)
                                            @if ($item?->small_image && file_exists(public_path($item->small_image)))
                                            <div class="swiper-slide"><img src="{{ asset($item->small_image) }}" 
                                                                           alt="{{ $service?->title }}" 
                                                                           loading="lazy"
                                                                           onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;"></div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        {!! $service?->description !!}
                    </div>
                    @if ($service?->service_faq->count() != 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faq-service feature-section-text mt_50">
                                    <h2>{{ __('Frequently Asked Questions') }}</h2>
                                    <div class="feature-accordion" id="accordion">
                                        @foreach ($service?->service_faq as $faq)
                                            <div class="faq-item card">
                                                <div class="faq-header" id="heading-{{ $faq?->id }}">
                                                    <button class="faq-button collapsed" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $faq?->id }}" aria-expanded="true"
                                                        aria-controls="collapse-{{ $faq?->id }}">{{ $faq?->question }}</button>
                                                </div>

                                                <div id="collapse-{{ $faq?->id }}" class="collapse"
                                                    aria-labelledby="heading-{{ $faq?->id }}" data-parent="#accordion">
                                                    <div class="faq-body">
                                                        {!! $faq?->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-4">
                    <div class="service-sidebar pt_30">
                        <div class="service-widget">
                            <ul>
                                @foreach ($services as $item)
                                    <li class="{{ $item?->id == $service?->id ? 'active' : '' }}"><a
                                            href="{{ route('website.service.details', $item?->slug) }}"><i
                                                class="fas fa-chevron-right"></i> {{ $item?->title }}</a></li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="service-widget-contact mt_45">
                            <h2>{{ $contactInfo?->header }}</h2>
                            <p>{{ $contactInfo?->description }}</p>
                            <ul>
                                <li><i class="fas fa-phone"></i> {!! nl2br(e($contactInfo?->email)) !!}</li>
                                <li><i class="far fa-envelope"></i> 
                                    @php
                                        $phoneDisplay = $contactInfo?->phone ?? '';
                                        // Add + before number for Arabic language
                                        if (getSessionLanguage() == 'ar' && $phoneDisplay && !str_starts_with($phoneDisplay, '+')) {
                                            $phoneDisplay = '+' . $phoneDisplay;
                                        }
                                        $phoneLines = explode("\n", $phoneDisplay);
                                        foreach ($phoneLines as $line) {
                                            echo e($line) . '<br>';
                                        }
                                    @endphp
                                </li>
                                <li><i class="fas fa-map-marker-alt"></i>{!! nl2br(e($contactInfo?->address)) !!}</li>
                            </ul>
                        </div>
                        <div class="service-qucikcontact event-form mt_30">
                            <h3>{{ __('Quick Contact') }}</h3>
                            <div class="quick-contact-content">
                                <p>{{ __('Book a consultation with our expert lawyers for personalized legal advice.') }}</p>
                                <a href="{{ route('website.book.consultation.appointment') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-calendar-check"></i> {{ __('Book Consultation') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--Service Detail End-->
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
