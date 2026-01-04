@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? 'LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? 'LawMent' }}">
@endsection
@section('client-content')

    <!--Slider Start-->
    <div class="slider" id="main-slider">
        <div class="doc-search-item">
            <div class="d-flex align-items-center h_100_p">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-xxl-9">
                            <div class="v-mid-content">
                                <div class="heading">
                                    <h2>{{ __('Search The Best lawyers') }}</h2>
                                    <p>{{ __('Find out department and location based lawyers near your area') }}</p>
                                </div>
                                <div class="doc-search-section">
                                    <form action="{{ route('website.search.lawyer') }}">
                                        <div class="box">
                                            <select name="location" class="form-control select2">
                                                <option value="">{{ __('Select Location') }}</option>
                                                @foreach ($locations as $location)
                                                    <option {{ @$location_id == $location?->id ? 'selected' : '' }}
                                                        value="{{ $location?->id }}">{{ ucwords($location?->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="box">
                                            <select name="department" class="form-control select2">
                                                <option value="">
                                                    {{ __('Select Department') }}</option>
                                                @foreach ($departmentsForSearch as $department)
                                                    <option {{ @$department_id == $department?->id ? 'selected' : '' }}
                                                        value="{{ $department?->id }}">{{ ucwords($department?->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="box">
                                            <select name="lawyer" class="form-control select2">
                                                <option value="">
                                                    {{ __('Select Lawyer') }}</option>
                                                @foreach ($lawyersForSearch as $lawyer)
                                                    <option {{ @$lawyer_id == $lawyer?->id ? 'selected' : '' }}
                                                        value="{{ $lawyer?->id }}">
                                                        {{ ucwords($lawyer?->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="doc-search-button">
                                            <button type="submit" class="btn btn-danger">{{ __('Search') }}</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner_slider_area">
            <div class="banner_slider_overlay">
                <div class="row banner_slider">
                    @foreach ($sliders as $item)
                        <div class="col-12">
                            <div class="banner_slider_item">
                                <img src="{{ url($item->image) }}" alt="{{ $item->title }}" class="img-fluid w-100">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!--Slider End-->


    <!--Why Us Start-->
    @if (1 == $home_sections?->feature_status)
        <section class="why-us-area pt_30">
            <div class="container">
                <div class="row">
                    @foreach ($features->take($home_sections?->feature_how_many) as $feature)
                        <div class="col-lg-4 choose-col">
                            <div class="choose-item flex" style="background-image: url({{ url($feature->image) }})">
                                <div class="choose-icon">
                                    <i class="{{ $feature->icon }}"></i>
                                </div>
                                <div class="choose-text">
                                    <h2 class="title">{{ $feature->title }}</h2>
                                    <p>
                                        {{ $feature->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!--why Us End-->
    @endif


    @if (1 == $home_sections?->work_status)
        <!--Feature Start-->
        <section class="about-area">
            <div class="container">
                <div class="row ov_hd">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->work_first_heading) }}</span>
                                {{ ucfirst($home_sections?->work_second_heading) }}</h2>
                            <p>{{ $home_sections?->work_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row ov_hd">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-skey mt_65">
                            <div class="about-img">
                                <img src="{{ $work?->image ? url($work?->image) : '' }}"
                                    alt="{{ $home_sections?->work_first_heading . ' ' . $home_sections?->work_second_heading }}"
                                    loading="lazy">
                                <div class="video-section video-section-home">
                                    <a aria-label="{{ $home_sections?->work_first_heading . ' ' . $home_sections?->work_second_heading }}"
                                        class="video-button mgVideo" href="{{ $work?->video }}"><span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="feature-section-text mt_50">
                            <h2>{{ $work?->title }}</h2>
                            <div class="feature-accordion" id="accordion">
                                @foreach ($workFaqs?->take($home_sections?->work_how_many) as $faqIndex => $faq)
                                    <div class="faq-item card">
                                        <div class="faq-header" id="heading1-{{ $faq->id }}">
                                            <button class="faq-button {{ $faqIndex != 0 ? 'collapsed' : '' }}"
                                                data-bs-toggle="collapse" data-bs-target="#collapse1-{{ $faq->id }}"
                                                aria-expanded="true"
                                                aria-controls="collapse1-{{ $faq->id }}">{{ $faq->question }}</button>
                                        </div>

                                        <div id="collapse1-{{ $faq->id }}"
                                            class="collapse {{ $faqIndex == 0 ? 'show' : '' }}"
                                            aria-labelledby="heading1-{{ $faq->id }}" data-bs-parent="#accordion">
                                            <div class="faq-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Feature End-->
    @endif


    @if (1 == $home_sections?->service_status)
        <!--Service Start-->
        <section class="service-area bg-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->service_first_heading) }}</span>
                                {{ ucfirst($home_sections?->service_second_heading) }}</h2>
                            <p>{{ $home_sections?->service_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row service-row">
                    <div class="col-md-12">
                        <div class="service-coloum-area">
                            @foreach ($services?->take($home_sections?->service_how_many) as $service)
                                <div class="service-coloum">
                                    <div class="service-item">
                                        <i class="{{ $service?->icon }}"></i>
                                        <a aria-label="{{ $service?->title }}"
                                            href="{{ route('website.service.details', $service?->slug) }}">
                                            <h3 class="title">{{ $service?->title }}</h3>
                                        </a>
                                        <p>{{ $service?->sort_description }}</p>
                                        <a aria-label="{{ __('Service Details') }}"
                                            href="{{ route('website.service.details', $service?->slug) }}">{{ __('Service Details') }}
                                            →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="home-button ser-btn">
                            <a aria-label="{{ __('All Service') }}"
                                href="{{ url('service') }}">{{ __('All Service') }}</a>
                        </div>
                    </div>
                </div>
                <!--Counter Start-->
                <div class="counter-row row"
                    style="background-image: url({{ asset('uploads/website-images/overview-banner.webp') }})">
                    @foreach ($overviews as $overview)
                        <div class="col-lg-3 col-6 mt_30 wow fadeInDown" data-wow-delay="0.2s">
                            <div class="counter-item">
                                <div class="counter-icon">
                                    <i class="{{ $overview?->icon }}"></i>
                                </div>
                                <span class="counter counter_up">{{ $overview?->qty }}</span>
                                <p class="title">{{ $overview?->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--Counter End-->
            </div>
        </section>
        <!--Service End-->
    @endif


    @if (1 == $home_sections?->department_status)
        <!--Department Start-->
        <section class="case-study-home-page case-study-area pb_40">
            <div class="container">
                <div class="row mb_25 mt_50">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown" data-wow-delay="0.1s">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->department_first_heading) }}</span>
                                {{ ucfirst($home_sections?->department_second_heading) }}</h2>
                            <p>{{ $home_sections?->department_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($departments->take($home_sections?->department_how_many) as $department)
                        <div class="col-lg-4 col-md-6 mt_15">
                            <div class="case-item">
                                <div class="case-box">
                                    <div class="case-image">
                                        <img src="{{ url($department?->thumbnail_image) }}"
                                            alt="{{ $department?->name }}" loading="lazy">
                                        <div class="overlay"><a aria-label="{{ __('See Details') }}"
                                                href="{{ route('website.department.details', $department?->slug) }}"
                                                class="btn-case">{{ __('See Details') }}</a>
                                        </div>
                                    </div>
                                    <div class="case-content">
                                        <h3 class="title"><a aria-label="{{ $department?->name }}"
                                                href="{{ route('website.department.details', $department?->slug) }}">{{ $department?->name }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mb_60">
                    <div class="col-md-12">
                        <div class="home-button">
                            <a aria-label="{{ __('All Department') }}"
                                href="{{ url('department') }}">{{ __('All Department') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    @if (1 == $home_sections?->client_status)
        <!--Testimonial Start-->
        <section class="testimonial-area {{ $home_sections?->department_status == 0 ? 'mt_200' : '' }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->client_first_heading) }}</span>
                                {{ ucfirst($home_sections?->client_second_heading) }}</h2>
                            <p>{{ $home_sections?->client_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row testimonial_slider mt_30">
                    @foreach ($testimonials->take($home_sections?->client_how_many) as $client)
                        <div class="col-lg-12">
                            <div class="testimonial-texarea">
                                <div class="testimonial-item wow fadeIn" data-wow-delay="0.2s">
                                    <p class="wow fadeInDown" data-wow-delay="0.2s">
                                        {{ $client?->comment }}
                                    </p>
                                    <div class="testi-info wow fadeInUp d-flex align-items-center home-testi-info"
                                        data-wow-delay="0.2s">
                                        <img src="{{ !empty($client?->image) ? url($client?->image) : '' }}"
                                            alt="{{ $client?->name }}" loading="lazy">
                                        <div>
                                            <h3 class="title">{{ $client?->name }}</h3>
                                            <span>{{ $client?->designation }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
        <!--Testimonial End-->
    @endif


    @if (1 == $home_sections?->lawyer_status)
        <!--Lawyer Area Start-->
        <section class="team-area team_slider_area">
            <div class="container">
                <div class="row mb_30">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->lawyer_first_heading) }}</span>
                                {{ ucfirst($home_sections?->lawyer_second_heading) }}</h2>
                            <p>{{ $home_sections?->lawyer_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row lawyer_slider">
                    @foreach ($lawyers->take($home_sections?->lawyer_how_many) as $lawyer)
                        <div class="col-xl-4">
                            <div class="team-item">
                                <div class="team-photo">
                                    <img src="{{ url($lawyer?->image) }}" alt="{{ $lawyer?->name }}" loading="lazy">
                                </div>
                                <div class="team-text">
                                    <a
                                        href="{{ route('website.lawyer.details', $lawyer?->slug) }}">{{ $lawyer?->name }}</a>
                                    <p>{{ $lawyer?->department->name }}</p>
                                    <p><span><i class="fas fa-graduation-cap"></i> {{ $lawyer?->designations }}</span>
                                    </p>
                                    <p><span><b><i class="fas fa-street-view"></i>
                                                {{ ucfirst($lawyer?->location?->name) }}</b></span></p>
                                </div>
                                <div class="team-social">
                                    <ul>
                                        @foreach ($lawyer?->socialMedia as $socialMedia)
                                            <li><a target="_blank" aria-label="{{ $socialMedia?->link }}"
                                                    href="{{ $socialMedia?->link }}"><i class="{{$socialMedia?->icon}}"></i></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
        <!--Lawyer Area End-->
    @endif


    @if (1 == $home_sections?->blog_status)
        <!--Blog-Area Start-->
        <section class="blog-area bg_ecf1f8">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->blog_first_heading) }}</span>
                                {{ ucfirst($home_sections?->blog_second_heading) }}</h2>
                            <p>{{ $home_sections?->blog_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($feature_blog)
                        <div class="col-md-6">
                            <div class="blog-item first-blog">
                                <a aria-label="{{ $feature_blog?->title }}"
                                    href="{{ route('website.blog.details', $feature_blog?->slug) }}"
                                    class="image-effect">
                                    <div class="blog-image">
                                        <img src="{{ url($feature_blog?->image) }}" alt="{{ $feature_blog?->title }}"
                                            loading="lazy">
                                    </div>
                                </a>
                                <div class="blog-text">
                                    <div class="blog-author">
                                        <span><i class="fas fa-user"></i>
                                            {{ $feature_blog?->admin?->name ?? __('Admin') }}</span>
                                        <span><i class="far fa-calendar-alt"></i>
                                            {{ formattedDate($feature_blog?->created_at) }}</span>
                                    </div>
                                    <h3 class="title"><a aria-label="{{ $feature_blog?->title }}"
                                            href="{{ route('website.blog.details', $feature_blog?->slug) }}">{{ $feature_blog?->title }}</a>
                                    </h3>
                                    <p>
                                        {{ $feature_blog?->sort_description }}
                                    </p>
                                    <a class="sm_btn" aria-label="{{ __('Details') }}"
                                        href="{{ route('website.blog.details', $feature_blog?->slug) }}">{{ __('Details') }}
                                        →</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 home_blog_slider">
                        <div class="blog-carousel owl-carousel">
                            @php $i=0; @endphp
                            @foreach ($blogs?->take($home_sections?->blog_how_many) as $blog)
                                @php $i++; @endphp
                                @if ($i == 1)
                                    @continue
                                @endif
                                <div class="blog-item effect-item">
                                    <a aria-label="{{ $blog?->title }}"
                                        href="{{ route('website.blog.details', $blog?->slug) }}" class="image-effect">
                                        <div class="blog-image">
                                            <img src="{{ $blog?->thumbnail_image ? url($blog?->thumbnail_image) : asset('client/img/shape-2.webp') }}" alt="{{ $blog?->title }}"
                                                loading="lazy" onerror="this.src='{{ asset('client/img/shape-2.webp') }}'">
                                        </div>
                                    </a>
                                    <div class="blog-text">
                                        <div class="blog-author">
                                            <span><i class="fas fa-user"></i>
                                                {{ $blog?->admin?->name ?? __('Admin') }}</span>
                                            <span><i class="far fa-calendar-alt"></i>
                                                {{ formattedDate($blog?->created_at) }}</span>
                                        </div>
                                        <h3 class="title"><a aria-label="{{ $blog?->title }}"
                                                href="{{ route('website.blog.details', $blog?->slug) }}">{{ Str::limit($blog?->title,30,'...') }}</a>
                                        </h3>
                                        <p>
                                            {{ $blog?->sort_description }}
                                        </p>
                                        <a class="sm_btn" aria-label="{{ __('Details') }}"
                                            href="{{ route('website.blog.details', $blog?->slug) }}">{{ __('Details') }}
                                            →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog-Area End-->
    @endif

    <!--Mobile App Section Start-->
    <section class="mobile-app-area pt_100 pb_100 bg_ecf1f8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="mobile-app-content">
                        <h2 class="title mb_30"><span>{{ __('Stay on top') }}</span> {{ __('of your case') }}</h2>
                        <p class="mb_30">{{ __('With your account on our website, you always have access to our legal experts. Plus, you can easily track your case, see when we need more information, and get a clear overview of how far along the process is.') }}</p>
                        
                        <div class="app-features mb_40">
                            <div class="feature-item mb_20">
                                <div class="feature-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('1. Create your account') }}</h4>
                                    <p>{{ __('Easily create an account using your email. Access all our legal services and manage your cases from anywhere.') }}</p>
                                </div>
                            </div>
                            <div class="feature-item mb_20">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('2. Track your case status') }}</h4>
                                    <p>{{ __('Stay updated on any required information and get a clear view of your case\'s progress through your dashboard.') }}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('3. Book consultations') }}</h4>
                                    <p>{{ __('Need legal help? Schedule an appointment with our expert lawyers directly through the website, available throughout the week.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="app-download-buttons">
                            <a href="{{ route('register') }}" class="app-download-btn" aria-label="Create Account">
                                <i class="fas fa-user-plus me-2"></i>
                                <span class="btn-text">{{ __('Create Account') }}</span>
                            </a>
                            <a href="{{ route('website.lawyers') }}" class="app-download-btn" aria-label="Find a Lawyer">
                                <i class="fas fa-search me-2"></i>
                                <span class="btn-text">{{ __('Find a Lawyer') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="mobile-app-image text-center">
                        <div class="app-mockup-placeholder">
                            <div class="phone-mockup">
                                <div class="phone-screen">
                                    <div class="screen-content">
                                        <i class="fas fa-laptop"></i>
                                        <h3>{{ __('Online Platform') }}</h3>
                                        <p>{{ __('Access from Anywhere') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Mobile App Section End-->

    <!--How It Works Section Start-->
    <section class="how-it-works-area pt_100 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('How') }}</span> {{ __('It Works') }}</h2>
                        <p>{{ __('Getting legal help has never been easier. Follow these simple steps to get started.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="step-title">{{ __('Choose date, lawyer and time') }}</h3>
                        <p class="step-description">{{ __('Start by choosing a date for your appointment. Then choose the lawyer you want to speak to and the time that suits you best.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="step-title">{{ __('Easy and secure payments') }}</h3>
                        <p class="step-description">{{ __('When you\'ve chosen a date and time for your appointment, you\'ll be directed to a secure page for payments. Choose to pay with card or Klarna.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="step-title">{{ __('Link to meeting in email') }}</h3>
                        <p class="step-description">{{ __('After payment, you\'ll get a confirmation sent to your email, with a Google Meet-link. When it\'s time for your appointment, simply click on the link to start your meeting.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt_40">
                <div class="col-12 text-center">
                    <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointment_modal">{{ __('Book Your Appointment Now') }}</a>
                </div>
            </div>
        </div>
    </section>
    <!--How It Works Section End-->

    <!--Fixed Price Guarantee Section Start-->
    <section class="fixed-price-area pt_100 pb_100 bg_ecf1f8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="fixed-price-image text-center">
                        <img src="{{ asset('client/img/fixed-price-guarantee.jpg') }}" alt="{{ __('Fixed Price Guarantee') }}" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="fixed-price-content">
                        <h2 class="title mb_30"><span>{{ __('Fixed Price') }}</span> {{ __('Guarantee') }}</h2>
                        <p class="mb_30">{{ __('When you hire us, you\'ll always receive an estimate in advance so you know exactly what the assistance will cost. We always work with fixed prices, so you don\'t have to worry about any unexpected fees.') }}</p>
                        
                        <div class="price-benefits">
                            <div class="benefit-item mb_20">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ __('No hidden fees') }}</span>
                            </div>
                            <div class="benefit-item mb_20">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ __('Transparent pricing') }}</span>
                            </div>
                            <div class="benefit-item mb_20">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ __('Price agreed upfront') }}</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ __('Payment plans available') }}</span>
                            </div>
                        </div>

                        <div class="mt_40">
                            <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Get a Quote') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Fixed Price Guarantee Section End-->

    <!--Legal Aid Check Section Start-->
    <section class="legal-aid-check-home pt_100 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="legal-aid-check-box text-center">
                        <div class="check-icon mb_30">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <h2 class="title mb_30">{{ __('Are you eligible for legal aid or legal protection insurance?') }}</h2>
                        <p class="mb_40">{{ __('If you need a lawyer for legal assistance, you may be eligible to have part of the cost covered through legal protection insurance or government-funded legal aid. This means you could receive financial support to cover a portion of your lawyer\'s fees—provided you meet certain criteria.') }}</p>
                        <a href="{{ route('website.legal.aid.check') }}" class="btn btn-primary btn-lg">{{ __('Find out now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Legal Aid Check Section End-->

@endsection
