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
        <div class="banner_slider_area">
            <div class="banner_slider_overlay"></div>
            @if($sliders->count() > 0)
                <div class="row banner_slider">
                    @foreach ($sliders as $item)
                        <div class="col-12">
                            <div class="banner_slider_item">
                                <img src="{{ url($item->image) }}" alt="{{ $item->title }}" class="img-fluid w-100">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <div class="legal-hero-section">
            <div class="legal-hero-overlay"></div>
            <!-- Animated Legal Icons -->
            <div class="legal-hero-animated-icons" style="overflow: hidden;">
                <i class="fas fa-gavel legal-icon-1"></i>
                <i class="fas fa-balance-scale legal-icon-2"></i>
                <i class="fas fa-book legal-icon-3"></i>
                <i class="fas fa-landmark legal-icon-4"></i>
                <i class="fas fa-file-alt legal-icon-5"></i>
                <i class="fas fa-handshake legal-icon-6"></i>
            </div>
            <div class="d-flex align-items-center h_100_p">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="legal-hero-content text-center">
                                <div class="legal-hero-badge">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>{{ __('Trusted Legal Services') }}</span>
                                </div>
                                <h1 class="legal-hero-title">
                                    {{ __('Professional Legal') }} 
                                    <span class="legal-highlight">{{ __('Consultation') }}</span>
                                    {{ __('at Your Fingertips') }}
                                </h1>
                                <p class="legal-hero-description">
                                    {{ __('Get expert legal advice from experienced lawyers. Book your consultation online and receive professional guidance for all your legal matters. Fast, secure, and reliable legal services.') }}
                                </p>
                                <div class="legal-hero-features">
                                    <div class="legal-hero-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Expert Lawyers') }}</span>
                                    </div>
                                    <div class="legal-hero-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Online Consultation') }}</span>
                                    </div>
                                    <div class="legal-hero-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Fixed Prices') }}</span>
                                    </div>
                                </div>
                                <div class="legal-hero-buttons">
                                    <a href="{{ route('website.book.appointment') }}" class="legal-hero-btn-primary">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>{{ __('Book Consultation Now') }}</span>
                                    </a>
                                    <a href="{{ route('website.services') }}" class="legal-hero-btn-secondary">
                                        <i class="fas fa-info-circle"></i>
                                        <span>{{ __('Our Services') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="service-swiper-container">
                            <div class="swiper service-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($services?->take($home_sections?->service_how_many) as $service)
                                        <div class="swiper-slide">
                                            <div class="service-item">
                                                <div class="service-icon-wrapper">
                                                    <i class="{{ $service?->icon }}"></i>
                                                </div>
                                                <a aria-label="{{ $service?->title }}"
                                                    href="{{ route('website.service.details', $service?->slug) }}">
                                                    <h3 class="title">{{ $service?->title }}</h3>
                                                </a>
                                                <p>{{ $service?->sort_description }}</p>
                                                <a class="service-link" aria-label="{{ __('Service Details') }}"
                                                    href="{{ route('website.service.details', $service?->slug) }}">
                                                    <span>{{ __('Service Details') }}</span>
                                                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Navigation buttons -->
                                <div class="swiper-button-next service-swiper-next"></div>
                                <div class="swiper-button-prev service-swiper-prev"></div>
                                <!-- Pagination -->
                                <div class="swiper-pagination service-swiper-pagination"></div>
                            </div>
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
        <section class="testimonial-area-modern {{ $home_sections?->department_status == 0 ? 'mt_200' : '' }}">
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

                <div class="testimonial-swiper-wrapper">
                    <div class="swiper testimonial-swiper-modern">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials->take($home_sections?->client_how_many) as $client)
                                <div class="swiper-slide">
                                    <div class="testimonial-card-modern">
                                     
                                        <div class="testimonial-content">
                                            <p class="testimonial-text">{{ $client?->comment }}</p>
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-image-wrapper">
                                                <img src="{{ !empty($client?->image) ? url($client?->image) : asset('uploads/website-images/default-avatar.png') }}"
                                                    alt="{{ $client?->name }}" loading="lazy" class="author-image">
                                                <div class="author-image-border"></div>
                                            </div>
                                            <div class="author-info">
                                                <h4 class="author-name">{{ $client?->name }}</h4>
                                                <p class="author-designation">{{ $client?->designation }}</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next testimonial-next"></div>
                        <div class="swiper-button-prev testimonial-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination testimonial-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonial End-->
    @endif


    @if (1 == $home_sections?->lawyer_status)
        <!--Lawyer Area Start-->
        <section class="lawyer-area-modern">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ ucfirst($home_sections?->lawyer_first_heading) }}</span>
                                {{ ucfirst($home_sections?->lawyer_second_heading) }}</h2>
                            <p>{{ $home_sections?->lawyer_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="lawyer-swiper-wrapper">
                    <div class="swiper lawyer-swiper-modern">
                        <div class="swiper-wrapper">
                            @foreach ($lawyers->take($home_sections?->lawyer_how_many) as $lawyer)
                                <div class="swiper-slide">
                                    <div class="lawyer-card-modern">
                                        <div class="lawyer-image-wrapper">
                                            <a aria-label="{{ $lawyer?->name }}"
                                                href="{{ route('website.lawyer.details', $lawyer?->slug) }}" class="lawyer-image-link">
                                                <img src="{{ url($lawyer?->image) }}" alt="{{ $lawyer?->name }}" loading="lazy" class="lawyer-image">
                                                <div class="lawyer-image-overlay">
                                                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="lawyer-content">
                                            <h3 class="lawyer-name">
                                                <a aria-label="{{ $lawyer?->name }}"
                                                    href="{{ route('website.lawyer.details', $lawyer?->slug) }}">
                                                    {{ $lawyer?->name }}
                                                </a>
                                            </h3>
                                            <div class="lawyer-meta">
                                                @if($lawyer->department)
                                                <span class="lawyer-department-meta">
                                                    <i class="fas fa-briefcase"></i>
                                                    <span>{{ $lawyer->department->name }}</span>
                                                </span>
                                                @endif
                                                @if($lawyer->location)
                                                <span class="lawyer-location-meta">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span>{{ ucfirst($lawyer->location->name) }}</span>
                                                </span>
                                                @endif
                                            </div>
                                            @if($lawyer->designations)
                                            <p class="lawyer-designations">
                                                <i class="fas fa-graduation-cap"></i>
                                                {{ $lawyer->designations }}
                                            </p>
                                            @endif
                                            @if($lawyer->total_ratings > 0)
                                            <div class="lawyer-rating">
                                                {!! displayStars($lawyer->average_rating) !!}
                                                <span class="rating-text">
                                                    <strong>{{ number_format($lawyer->average_rating, 1) }}</strong>
                                                    ({{ $lawyer->total_ratings }})
                                                </span>
                                            </div>
                                            @else
                                            <div class="lawyer-rating">
                                                {!! displayStars(0) !!}
                                                <span class="rating-text no-rating">{{ __('No ratings') }}</span>
                                            </div>
                                            @endif
                                            <a class="lawyer-view-profile" aria-label="{{ __('View Profile') }}"
                                                href="{{ route('website.lawyer.details', $lawyer?->slug) }}">
                                                <span>{{ __('View Profile') }}</span>
                                                <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next lawyer-next"></div>
                        <div class="swiper-button-prev lawyer-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination lawyer-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Lawyer Area End-->
    @endif


    @if (1 == $home_sections?->blog_status)
        <!--Blog-Area Start-->
        <section class="blog-area-modern">
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

                <div class="blog-swiper-wrapper">
                    <div class="swiper blog-swiper-modern">
                        <div class="swiper-wrapper">
                            @php
                                $allBlogs = collect();
                                if ($feature_blog) {
                                    $allBlogs->push($feature_blog);
                                }
                                foreach ($blogs->take($home_sections?->blog_how_many) as $blog) {
                                    if (!$feature_blog || $blog->id != $feature_blog->id) {
                                        $allBlogs->push($blog);
                                    }
                                }
                            @endphp
                            @foreach ($allBlogs->take($home_sections?->blog_how_many) as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-card-modern">
                                        <div class="blog-image-wrapper">
                                            <a aria-label="{{ $blog?->title }}"
                                                href="{{ route('website.blog.details', $blog?->slug) }}" class="blog-image-link">
                                                <img src="{{ $blog?->image ? url($blog?->image) : ($blog?->thumbnail_image ? url($blog?->thumbnail_image) : asset('client/img/shape-2.webp')) }}"
                                                    alt="{{ $blog?->title }}" loading="lazy" class="blog-image">
                                                <div class="blog-image-overlay">
                                                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                                </div>
                                            </a>
                                            <div class="blog-date-badge">
                                                <span class="blog-day">{{ date('d', strtotime($blog?->created_at)) }}</span>
                                                <span class="blog-month">{{ date('M', strtotime($blog?->created_at)) }}</span>
                                            </div>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <span class="blog-author-meta">
                                                    <i class="fas fa-user"></i>
                                                    <span>{{ $blog?->admin?->name ?? __('Admin') }}</span>
                                                </span>
                                                <span class="blog-category-meta">
                                                    <i class="fas fa-folder"></i>
                                                    <span>{{ $blog?->category?->title ?? __('Blog') }}</span>
                                                </span>
                                            </div>
                                            <h3 class="blog-title">
                                                <a aria-label="{{ $blog?->title }}"
                                                    href="{{ route('website.blog.details', $blog?->slug) }}">
                                                    {{ $blog?->title }}
                                                </a>
                                            </h3>
                                            <p class="blog-excerpt">{{ $blog?->sort_description }}</p>
                                            <a class="blog-read-more" aria-label="{{ __('Read More') }}"
                                                href="{{ route('website.blog.details', $blog?->slug) }}">
                                                <span>{{ __('Read More') }}</span>
                                                <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next blog-next"></div>
                        <div class="swiper-button-prev blog-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination blog-pagination"></div>
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
                    <div class="mobile-app-image text-center">
                        <img src="{{ asset('client/img/mobile-app-illustration.png') }}" alt="{{ __('Online Platform') }}" class="img-fluid mobile-app-illustration" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="app-mockup-placeholder" style="display: none;">
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
                <div class="col-lg-6 wow fadeInRight">
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
                    <div class="how-it-works-item text-center step-item-1">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="step-title">{{ __('Choose date, lawyer and time') }}</h3>
                        <p class="step-description">{{ __('Start by choosing a date for your appointment. Then choose the lawyer you want to speak to and the time that suits you best.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center step-item-2">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="step-title">{{ __('Easy and secure payments') }}</h3>
                        <p class="step-description">{{ __('When you\'ve chosen a date and time for your appointment, you\'ll be directed to a secure page for payments. Choose to pay with card or Klarna.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center step-item-3">
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
                        <h2 class="title mb_30">{{ __('Fixed Price Guarantee') }}</h2>
                        <p class="mb_30">{{ __("When you work with us, you will always receive a price estimate in advance. We work with fixed and transparent prices, so you don't have to worry about any unexpected or hidden fees. You will know exactly what you will pay before starting any legal service.") }}</p>
                        
                        <div class="price-benefits">
                            <div class="benefit-item mb_20">
                                <i class="fas fa-shield-alt"></i>
                                <div class="benefit-content">
                                    <strong>{{ __('No Hidden Fees') }}</strong>
                                    <p>{{ __('All costs are clearly stated upfront. No surprises, no additional charges after service completion.') }}</p>
                                </div>
                            </div>
                            <div class="benefit-item mb_20">
                                <i class="fas fa-eye"></i>
                                <div class="benefit-content">
                                    <strong>{{ __('Transparent Pricing') }}</strong>
                                    <p>{{ __('Complete transparency in all our pricing. You see exactly what you pay for each service.') }}</p>
                                </div>
                            </div>
                            <div class="benefit-item mb_20">
                                <i class="fas fa-handshake"></i>
                                <div class="benefit-content">
                                    <strong>{{ __('Price Agreed Upfront') }}</strong>
                                    <p>{{ __('The price is agreed upon before starting any work. No price changes during the service.') }}</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-credit-card"></i>
                                <div class="benefit-content">
                                    <strong>{{ __('Flexible Payment Plans') }}</strong>
                                    <p>{{ __('We offer flexible payment options that suit your budget. Pay in installments if needed.') }}</p>
                                </div>
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

@push('css')
<style>
    /* Slider Background Styles */
    #main-slider {
        position: relative;
        min-height: 600px;
        overflow: hidden;
    }

    .banner_slider_area {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }

    .banner_slider_area .banner_slider {
        height: 100% !important;
        width: 100%;
    }

    .banner_slider_area .banner_slider .slick-list,
    .banner_slider_area .banner_slider .slick-track {
        height: 100% !important;
    }

    .banner_slider_area .banner_slider .slick-slide {
        height: 100% !important;
    }

    .banner_slider_area .banner_slider .slick-slide > div {
        height: 100% !important;
    }

    .banner_slider_area .banner_slider_item {
        height: 100% !important;
        position: relative;
        display: block !important;
    }

    .banner_slider_area .banner_slider_item img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
    }

    .banner_slider_overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            linear-gradient(135deg, 
                rgba(15, 23, 42, 0.95) 0%, 
                rgba(30, 41, 59, 0.92) 25%, 
                rgba(51, 65, 85, 0.90) 50%, 
                rgba(30, 58, 138, 0.88) 75%, 
                rgba(15, 23, 42, 0.95) 100%
            ),
            radial-gradient(circle at 20% 30%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(244, 208, 63, 0.12) 0%, transparent 50%),
            radial-gradient(ellipse at 50% 50%, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
        z-index: 1;
        pointer-events: none;
    }

    /* Legal Hero Section Styles - New Classes */
    .legal-hero-section {
        position: relative;
        min-height: 600px;
        display: flex;
        align-items: center;
        z-index: 2;
        padding: 60px 0;
    }

    .legal-hero-section .container-fluid {
        padding-left: 40px;
        padding-right: 40px;
        width: 100%;
        max-width: 100%;
    }

    .legal-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 15% 25%, rgba(212, 175, 55, 0.2) 0%, transparent 40%),
            radial-gradient(circle at 85% 75%, rgba(244, 208, 63, 0.15) 0%, transparent 40%),
            radial-gradient(ellipse at 50% 100%, rgba(59, 130, 246, 0.1) 0%, transparent 60%),
            linear-gradient(180deg, transparent 0%, rgba(15, 23, 42, 0.3) 100%);
        pointer-events: none;
        z-index: 1;
    }

    .legal-hero-content {
        position: relative;
        z-index: 3;
        color: #ffffff;
        padding: 40px 0;
    }
    
    .legal-hero-stats {
        position: relative;
        z-index: 3;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        padding: 20px 0;
    }

    .legal-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(107, 93, 71, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        border: 1px solid rgba(107, 93, 71, 0.3);
        margin-bottom: 25px;
        font-size: 14px;
        font-weight: 600;
        color: #ffffff;
        animation: legalFadeInDown 0.8s ease;
    }

    .legal-hero-badge i {
        color: #d4af37;
        flex-shrink: 0;
    }

    [dir="rtl"] .legal-hero-badge {
        flex-direction: row-reverse;
    }

    .legal-hero-title {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
        color: #ffffff;
        animation: legalFadeInUp 0.8s ease 0.2s both;
    }

    .legal-hero-title .legal-highlight {
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .legal-hero-description {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 30px;
        animation: legalFadeInUp 0.8s ease 0.4s both;
    }

    .legal-hero-features {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 35px;
        animation: legalFadeInUp 0.8s ease 0.6s both;
    }

    .legal-hero-feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.95);
        font-size: 16px;
        font-weight: 500;
    }

    .legal-hero-feature-item i {
        color: #d4af37;
        font-size: 18px;
        flex-shrink: 0;
    }

    [dir="rtl"] .legal-hero-feature-item {
        flex-direction: row-reverse;
    }

    .legal-hero-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        animation: legalFadeInUp 0.8s ease 0.8s both;
    }

    .legal-hero-btn-primary {
        padding: 16px 35px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 50px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        color: #1a1a2e;
        border: none;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .legal-hero-btn-primary i,
    .legal-hero-btn-secondary i {
        flex-shrink: 0;
    }

    [dir="rtl"] .legal-hero-btn-primary,
    [dir="rtl"] .legal-hero-btn-secondary {
        flex-direction: row-reverse;
    }

    .legal-hero-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.5);
        background: linear-gradient(135deg, #f4d03f 0%, #d4af37 100%);
        color: #1a1a2e;
    }

    .legal-hero-btn-secondary {
        padding: 16px 35px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .legal-hero-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-3px);
        color: #ffffff;
    }

    .legal-stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s ease;
        animation: legalFadeInRight 0.8s ease both;
    }

    .legal-stat-card:nth-child(1) { animation-delay: 0.2s; }
    .legal-stat-card:nth-child(2) { animation-delay: 0.4s; }
    .legal-stat-card:nth-child(3) { animation-delay: 0.6s; }
    .legal-stat-card:nth-child(4) { animation-delay: 0.8s; }

    .legal-stat-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(212, 175, 55, 0.5);
    }

    .legal-stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.3);
    }

    .legal-stat-icon i {
        font-size: 28px;
        color: #1a1a2e;
    }

    .legal-stat-number {
        font-size: 36px;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 5px 0;
        line-height: 1;
    }

    .legal-stat-label {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-weight: 500;
    }

    /* Legal Hero Animations */
    @keyframes legalFadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes legalFadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes legalFadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Animated Legal Icons */
    .legal-hero-animated-icons {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        pointer-events: none;
        overflow: hidden;
    }

    .legal-hero-animated-icons i {
        position: absolute;
        font-size: 80px;
        color: rgba(212, 175, 55, 0.2);
        animation: legalIconFloat 15s infinite ease-in-out;
        display: block !important;
        visibility: visible !important;
        opacity: 0.2 !important;
    }

    .legal-icon-1 {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .legal-icon-2 {
        top: 20%;
        right: 8%;
        animation-delay: 2s;
    }

    .legal-icon-3 {
        top: 50%;
        left: 3%;
        animation-delay: 4s;
    }

    .legal-icon-4 {
        bottom: 20%;
        right: 5%;
        animation-delay: 6s;
    }

    .legal-icon-5 {
        top: 30%;
        left: 50%;
        animation-delay: 8s;
    }

    .legal-icon-6 {
        bottom: 10%;
        left: 15%;
        animation-delay: 10s;
    }

    @keyframes legalIconFloat {
        0%, 100% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.2;
        }
        25% {
            transform: translate(15px, -15px) rotate(3deg) scale(1.05);
            opacity: 0.25;
        }
        50% {
            transform: translate(-10px, 10px) rotate(-3deg) scale(0.95);
            opacity: 0.22;
        }
        75% {
            transform: translate(10px, 15px) rotate(2deg) scale(1.02);
            opacity: 0.28;
        }
    }

    /* Ensure slider works as background */
    #main-slider .banner_slider_area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #main-slider .banner_slider {
        height: 100% !important;
    }

    #main-slider .banner_slider .slick-list,
    #main-slider .banner_slider .slick-track {
        height: 100% !important;
    }

    #main-slider .banner_slider .slick-slide {
        height: 100% !important;
    }

    #main-slider .banner_slider .slick-slide > div {
        height: 100% !important;
    }

    #main-slider .banner_slider .slick-slide img {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Legal Hero Responsive Design */
    @media (max-width: 991px) {
        .legal-hero-animated-icons i {
            font-size: 60px;
        }
        .legal-hero-section .container-fluid {
            padding-left: 30px;
            padding-right: 30px;
        }

        [dir="rtl"] .legal-hero-section .col-lg-5 {
            padding-right: 50px !important;
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        [dir="rtl"] .legal-hero-section .col-lg-7 {
            padding-left: 50px !important;
            padding-right: 15px !important;
        }

        [dir="ltr"] .legal-hero-section .col-lg-5,
        html:not([dir="rtl"]) .legal-hero-section .col-lg-5 {
            padding-right: 50px;
            padding-left: 0;
            margin-left: 0;
        }

        [dir="ltr"] .legal-hero-section .col-lg-7,
        html:not([dir="rtl"]) .legal-hero-section .col-lg-7 {
            padding-left: 50px;
            padding-right: 15px;
        }

        .legal-hero-stats {
            margin-top: 40px;
        }
        
        #main-slider {
            min-height: 500px;
        }
    }

    @media (max-width: 768px) {
        #main-slider {
            min-height: 550px;
        }
        
        .legal-hero-section {
            min-height: 550px;
            padding: 30px 0;
        }

        .legal-hero-animated-icons i {
            font-size: 50px;
        }

        .legal-icon-1 {
            top: 5%;
            left: 2%;
        }

        .legal-icon-2 {
            top: 15%;
            right: 3%;
        }

        .legal-icon-3 {
            top: 45%;
            left: 1%;
        }

        .legal-icon-4 {
            bottom: 15%;
            right: 2%;
        }

        .legal-icon-5 {
            top: 25%;
            left: 45%;
        }

        .legal-icon-6 {
            bottom: 5%;
            left: 10%;
        }

        .legal-hero-content {
            padding: 20px 0;
            text-align: center;
        }

        .legal-hero-badge {
            font-size: 12px;
            padding: 6px 16px;
            margin-bottom: 20px;
        }

        .legal-hero-title {
            font-size: 28px;
            line-height: 1.3;
            margin-bottom: 15px;
        }

        .legal-hero-description {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 25px;
            padding: 0 10px;
        }

        .legal-hero-features {
            flex-direction: column;
            gap: 12px;
            margin-bottom: 25px;
            justify-content: center;
            align-items: center;
        }

        .legal-hero-feature-item {
            font-size: 14px;
            justify-content: center;
        }

        .legal-hero-buttons {
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .legal-hero-btn-primary,
        .legal-hero-btn-secondary {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            justify-content: center;
            padding: 14px 25px;
            font-size: 15px;
        }

        .legal-hero-stats {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 15px 0;
            margin-top: 30px;
        }

        .legal-stat-card {
            padding: 18px 15px;
        }

        .legal-stat-icon {
            width: 45px;
            height: 45px;
            margin-bottom: 12px;
        }

        .legal-stat-icon i {
            font-size: 22px;
        }

        .legal-stat-number {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .legal-stat-label {
            font-size: 12px;
            line-height: 1.4;
        }
    }

    @media (max-width: 480px) {
        #main-slider {
            min-height: 500px;
        }

        .legal-hero-section {
            min-height: 500px;
            padding: 25px 0;
        }

        .legal-hero-animated-icons i {
            font-size: 40px;
        }

        .legal-hero-content {
            padding: 15px 0;
        }

        .legal-hero-badge {
            font-size: 11px;
            padding: 5px 14px;
            margin-bottom: 15px;
        }

        .legal-hero-badge i {
            font-size: 12px;
        }

        .legal-hero-title {
            font-size: 24px;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .legal-hero-description {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 0 5px;
        }

        .legal-hero-features {
            gap: 10px;
            margin-bottom: 20px;
        }

        .legal-hero-feature-item {
            font-size: 13px;
        }

        .legal-hero-feature-item i {
            font-size: 14px;
        }

        .legal-hero-btn-primary,
        .legal-hero-btn-secondary {
            padding: 12px 20px;
            font-size: 14px;
            max-width: 100%;
        }

        .legal-hero-btn-primary i,
        .legal-hero-btn-secondary i {
            font-size: 14px;
        }

        .legal-hero-stats {
            grid-template-columns: 1fr;
            gap: 10px;
            padding: 10px 0;
            margin-top: 25px;
        }

        .legal-stat-card {
            padding: 15px;
        }

        .legal-stat-icon {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
        }

        .legal-stat-icon i {
            font-size: 20px;
        }

        .legal-stat-number {
            font-size: 22px;
        }

        .legal-stat-label {
            font-size: 11px;
        }
    }

    /* Legal Hero RTL Support */
    [dir="rtl"] .legal-hero-content {
        text-align: right;
    }

    [dir="rtl"] .legal-hero-badge {
        direction: rtl;
    }

    [dir="rtl"] .legal-hero-badge i {
        margin-left: 8px;
        margin-right: 0;
    }

    [dir="rtl"] .legal-hero-title {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .legal-hero-description {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .legal-hero-buttons {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

    [dir="rtl"] .legal-hero-features {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

    [dir="rtl"] .legal-hero-feature-item {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

    [dir="rtl"] .legal-hero-feature-item i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    [dir="rtl"] .legal-hero-feature-item span {
        order: 1;
    }

    /* RTL: نفس الترتيب البصري - الإحصائيات على اليسار والمحتوى على اليمين */
    [dir="rtl"] .legal-hero-section .row.align-items-center {
        flex-direction: row;
        display: flex;
        direction: ltr; /* إجبار الترتيب من اليسار لليمين */
    }

    [dir="rtl"] .legal-hero-section .col-lg-5 {
        order: 1 !important;
        padding-right: 80px !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
    }

    [dir="rtl"] .legal-hero-section .col-lg-7 {
        order: 2 !important;
        padding-left: 80px !important;
        padding-right: 20px !important;
    }

    [dir="rtl"] .legal-hero-stats {
        direction: rtl;
    }

    [dir="rtl"] .legal-stat-content {
        text-align: right;
    }

    /* LTR: الإحصائيات على اليسار والمحتوى على اليمين */
    [dir="ltr"] .legal-hero-section .row.align-items-center,
    html:not([dir="rtl"]) .legal-hero-section .row.align-items-center {
        flex-direction: row;
        display: flex;
    }

    [dir="ltr"] .legal-hero-section .col-lg-5,
    html:not([dir="rtl"]) .legal-hero-section .col-lg-5 {
        order: 1;
        padding-right: 80px;
        padding-left: 0;
        margin-left: 0;
    }

    [dir="ltr"] .legal-hero-section .col-lg-7,
    html:not([dir="rtl"]) .legal-hero-section .col-lg-7 {
        order: 2;
        padding-left: 80px;
        padding-right: 20px;
    }

    /* RTL Mobile Support */
    @media (max-width: 768px) {
        .legal-hero-section .container-fluid {
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Mobile ordering: content first, then stats */
        .legal-hero-section .col-lg-5 {
            order: 2 !important;
        }

        .legal-hero-section .col-lg-7 {
            order: 1 !important;
        }

        [dir="rtl"] .legal-hero-section .col-lg-5,
        [dir="rtl"] .legal-hero-section .col-lg-7 {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        [dir="ltr"] .legal-hero-section .col-lg-5,
        [dir="ltr"] .legal-hero-section .col-lg-7,
        html:not([dir="rtl"]) .legal-hero-section .col-lg-5,
        html:not([dir="rtl"]) .legal-hero-section .col-lg-7 {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        [dir="rtl"] .legal-hero-content {
            text-align: center;
        }

        [dir="rtl"] .legal-hero-title {
            text-align: center;
        }

        [dir="rtl"] .legal-hero-description {
            text-align: center;
        }

        [dir="rtl"] .legal-hero-features {
            align-items: center;
        }

        [dir="rtl"] .legal-hero-feature-item {
            justify-content: center;
        }

        [dir="rtl"] .legal-hero-buttons {
            justify-content: center;
        }

        [dir="rtl"] .legal-stat-content {
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        [dir="rtl"] .legal-hero-content {
            text-align: center;
        }

        [dir="rtl"] .legal-hero-title {
            text-align: center;
        }

        [dir="rtl"] .legal-hero-description {
            text-align: center;
        }
    }

    /* Mobile Hero Section Column Ordering - Applied after all other media queries */
    @media (max-width: 768px) {
        body.client-frontend .legal-hero-section .row.align-items-center {
            flex-direction: column !important;
            display: flex !important;
        }

        body.client-frontend .legal-hero-section .col-lg-7 {
            order: -1 !important;
            width: 100% !important;
            margin-bottom: 30px !important;
        }

        body.client-frontend .legal-hero-section .col-lg-5 {
            order: 1 !important;
            width: 100% !important;
        }
    }

    /* Testimonial Modern Styles */
    .testimonial-area-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 30px 0 50px 0;
        position: relative;
        overflow: hidden;
    }

    .testimonial-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(107,93,71,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
        pointer-events: none;
    }

    .testimonial-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
    }

    .testimonial-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .testimonial-card-modern {
        background: #ffffff;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        margin: 20px 10px;
        min-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .testimonial-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-radius: 25px 25px 0 0;
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .testimonial-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 70px rgba(107, 93, 71, 0.2);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-modern:hover::before {
        transform: scaleX(1);
    }

    .testimonial-quote-icon {
        position: absolute;
        top: 30px;
        right: 40px;
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }

    .testimonial-quote-icon i {
        font-size: 32px;
        color: var(--colorPrimary);
        transition: all 0.4s ease;
    }

    .testimonial-card-modern:hover .testimonial-quote-icon {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: rotate(15deg) scale(1.1);
    }

    .testimonial-card-modern:hover .testimonial-quote-icon i {
        color: #ffffff;
    }

    .testimonial-content {
        margin-top: 30px;
        margin-bottom: 40px;
        flex-grow: 1;
    }

    .testimonial-text {
        font-size: 18px;
        line-height: 1.8;
        color: #4f5b6d;
        font-style: italic;
        position: relative;
        padding: 0 20px;
        margin: 0;
    }

    .testimonial-text::before {
        content: '"';
        position: absolute;
        left: 0;
        top: -10px;
        font-size: 60px;
        color: var(--colorPrimary);
        opacity: 0.2;
        font-family: Georgia, serif;
        line-height: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }

    .author-image-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        flex-shrink: 0;
    }

    .author-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
    }

    .author-image-border {
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .testimonial-card-modern:hover .author-image {
        transform: scale(1.1);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-modern:hover .author-image-border {
        opacity: 1;
    }

    .author-info {
        flex-grow: 1;
    }

    .author-name {
        font-size: 20px;
        font-weight: 700;
        color: var(--colorBlack);
        margin: 0 0 5px 0;
        transition: color 0.3s ease;
    }

    .testimonial-card-modern:hover .author-name {
        color: var(--colorPrimary);
    }

    .author-designation {
        font-size: 15px;
        color: #666;
        margin: 0;
    }

    .testimonial-rating {
        display: flex;
        gap: 5px;
        margin-top: 20px;
        justify-content: center;
    }

    .testimonial-rating i {
        color: #ffc107;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .testimonial-card-modern:hover .testimonial-rating i {
        transform: scale(1.2);
        color: #ff9800;
    }

    /* Swiper Navigation */
    .testimonial-next,
    .testimonial-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -22.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .testimonial-next::after,
    .testimonial-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .testimonial-next:hover,
    .testimonial-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .testimonial-prev {
        left: -22.5px;
    }

    .testimonial-next {
        right: -22.5px;
    }

    /* Pagination */
    .testimonial-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .testimonial-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .testimonial-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .testimonial-prev {
            left: 10px;
        }

        .testimonial-next {
            right: 10px;
        }

        .blog-prev {
            left: 10px;
        }

        .blog-next {
            right: 10px;
        }

        .lawyer-prev {
            left: 10px;
        }

        .lawyer-next {
            right: 10px;
        }

        .service-swiper-prev {
            left: 10px;
        }

        .service-swiper-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .testimonial-area-modern {
            padding: 20px 0;
        }

        .testimonial-card-modern {
            padding: 40px 30px;
            margin: 15px 5px;
            min-height: 380px;
        }

        .testimonial-text {
            font-size: 16px;
            padding: 0 15px;
        }

        .testimonial-quote-icon {
            width: 60px;
            height: 60px;
            top: 20px;
            right: 30px;
        }

        .testimonial-quote-icon i {
            font-size: 28px;
        }

        .author-image-wrapper {
            width: 70px;
            height: 70px;
        }

        .testimonial-next,
        .testimonial-prev {
            width: 40px;
            height: 40px;
            margin-top: -20px;
        }

        .testimonial-next::after,
        .testimonial-prev::after {
            font-size: 16px;
        }

        .testimonial-prev {
            left: 5px;
        }

        .testimonial-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .testimonial-card-modern {
            padding: 30px 20px;
            min-height: 360px;
        }

        .testimonial-text {
            font-size: 15px;
        }

        .author-image-wrapper {
            width: 60px;
            height: 60px;
        }

        .author-name {
            font-size: 18px;
        }

        .author-designation {
            font-size: 14px;
        }
    }

    /* RTL Support */
    [dir="rtl"] .testimonial-quote-icon {
        right: auto;
        left: 40px;
    }

    [dir="rtl"] .testimonial-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .testimonial-next {
        right: auto;
        left: -30px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .testimonial-prev {
            right: 10px;
        }

        [dir="rtl"] .testimonial-next {
            left: 10px;
        }
    }

    /* Blog Modern Styles */
    .blog-area-modern {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .blog-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(107, 93, 71, 0.03) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(107, 93, 71, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .blog-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
    }

    .blog-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .blog-card-modern {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        margin: 20px 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: var(--colorPrimary);
    }

    .blog-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: #f0f0f0;
    }

    .blog-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .blog-image-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .blog-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.8) 0%, rgba(90, 77, 58, 0.8) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .blog-image-overlay i {
        color: #ffffff;
        font-size: 32px;
        transform: scale(0);
        transition: all 0.4s ease;
    }

    .blog-card-modern:hover .blog-image {
        transform: scale(1.1);
    }

    .blog-card-modern:hover .blog-image-overlay {
        opacity: 1;
    }

    .blog-card-modern:hover .blog-image-overlay i {
        transform: scale(1);
    }

    .blog-date-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #ffffff;
        padding: 12px 16px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
        z-index: 2;
    }

    .blog-day {
        display: block;
        font-size: 24px;
        font-weight: 700;
        line-height: 1;
    }

    .blog-month {
        display: block;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        margin-top: 4px;
        opacity: 0.9;
    }

    .blog-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .blog-author-meta,
    .blog-category-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
    }

    .blog-author-meta i,
    .blog-category-meta i {
        color: var(--colorPrimary);
        font-size: 14px;
    }

    .blog-title {
        margin: 0 0 15px 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.4;
        min-height: 62px;
    }

    .blog-title a {
        color: var(--colorBlack);
        text-decoration: none;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-card-modern:hover .blog-title a {
        color: var(--colorPrimary);
    }

    .blog-excerpt {
        color: #666;
        line-height: 1.8;
        margin: 0 0 20px 0;
        font-size: 15px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-read-more {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 12px 0;
    }

    .blog-read-more i {
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .blog-card-modern:hover .blog-read-more {
        color: var(--colorSecondary);
        transform: translateX(5px);
    }

    [dir="rtl"] .blog-card-modern:hover .blog-read-more {
        transform: translateX(-5px);
    }

    .blog-card-modern:hover .blog-read-more i {
        transform: translateX(3px);
    }

    [dir="rtl"] .blog-card-modern:hover .blog-read-more i {
        transform: translateX(-3px);
    }

    /* Swiper Navigation */
    .blog-next,
    .blog-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -22.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .blog-next::after,
    .blog-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .blog-next:hover,
    .blog-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .blog-prev {
        left: -22.5px;
    }

    .blog-next {
        right: -22.5px;
    }

    /* Pagination */
    .blog-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .blog-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .blog-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .blog-prev {
            left: 10px;
        }

        .blog-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .blog-area-modern {
            padding: 30px 0;
        }

        .blog-image-wrapper {
            height: 240px;
        }

        .blog-content {
            padding: 25px 20px;
        }

        .blog-title {
            font-size: 20px;
            min-height: 56px;
        }

        .blog-date-badge {
            top: 15px;
            left: 15px;
            padding: 10px 14px;
        }

        .blog-day {
            font-size: 20px;
        }

        .blog-month {
            font-size: 11px;
        }

        .blog-next,
        .blog-prev {
            width: 40px;
            height: 40px;
            margin-top: -20px;
        }

        .blog-next::after,
        .blog-prev::after {
            font-size: 16px;
        }

        .blog-prev {
            left: 10px;
        }

        .blog-next {
            right: 10px;
        }
    }

    @media (max-width: 480px) {
        .blog-image-wrapper {
            height: 200px;
        }

        .blog-content {
            padding: 20px 15px;
        }

        .blog-title {
            font-size: 18px;
            min-height: 50px;
        }

        .blog-excerpt {
            font-size: 14px;
        }
    }

    /* RTL Support */
    [dir="rtl"] .blog-date-badge {
        left: auto;
        right: 20px;
    }

    [dir="rtl"] .blog-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .blog-next {
        right: auto;
        left: -30px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .blog-prev {
            right: 10px;
        }

        [dir="rtl"] .blog-next {
            left: 10px;
        }
    }

    /* Lawyer Modern Styles */
    .lawyer-area-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .lawyer-area-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(107,93,71,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
        pointer-events: none;
    }

    .lawyer-swiper-wrapper {
        padding: 30px 0 40px;
        position: relative;
    }

    .lawyer-swiper-modern {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .lawyer-card-modern {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        margin: 20px 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .lawyer-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: var(--colorPrimary);
    }

    .lawyer-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 320px;
        background: #f0f0f0;
    }

    .lawyer-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .lawyer-image-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .lawyer-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.8) 0%, rgba(90, 77, 58, 0.8) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .lawyer-image-overlay i {
        color: #ffffff;
        font-size: 32px;
        transform: scale(0);
        transition: all 0.4s ease;
    }

    .lawyer-card-modern:hover .lawyer-image {
        transform: scale(1.1);
    }

    .lawyer-card-modern:hover .lawyer-image-overlay {
        opacity: 1;
    }

    .lawyer-card-modern:hover .lawyer-image-overlay i {
        transform: scale(1);
    }

    .lawyer-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .lawyer-name {
        margin: 0 0 15px 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.4;
    }

    .lawyer-name a {
        color: var(--colorBlack);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .lawyer-card-modern:hover .lawyer-name a {
        color: var(--colorPrimary);
    }

    .lawyer-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .lawyer-department-meta,
    .lawyer-location-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
    }

    .lawyer-department-meta i,
    .lawyer-location-meta i {
        color: var(--colorPrimary);
        font-size: 14px;
    }

    .lawyer-designations {
        color: #666;
        line-height: 1.6;
        margin: 0 0 15px 0;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .lawyer-designations i {
        color: var(--colorPrimary);
        font-size: 14px;
    }

    .lawyer-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding: 10px 0;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }

    .lawyer-rating .rating-text {
        color: #666;
        font-size: 14px;
    }

    .lawyer-rating .rating-text.no-rating {
        color: #999;
    }

    .lawyer-view-profile {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 12px 0;
    }

    .lawyer-view-profile i {
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .lawyer-card-modern:hover .lawyer-view-profile {
        color: var(--colorSecondary);
        transform: translateX(5px);
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile {
        transform: translateX(-5px);
    }

    .lawyer-card-modern:hover .lawyer-view-profile i {
        transform: translateX(3px);
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile i {
        transform: translateX(-3px);
    }

    /* Swiper Navigation */
    .lawyer-next,
    .lawyer-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -22.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .lawyer-next::after,
    .lawyer-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .lawyer-next:hover,
    .lawyer-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .lawyer-prev {
        left: -22.5px;
    }

    .lawyer-next {
        right: -22.5px;
    }

    /* Pagination */
    .lawyer-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .lawyer-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .lawyer-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 35px;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .lawyer-prev {
            left: 10px;
        }

        .lawyer-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .lawyer-area-modern {
            padding: 30px 0;
        }

        .lawyer-image-wrapper {
            height: 280px;
        }

        .lawyer-content {
            padding: 25px 20px;
        }

        .lawyer-name {
            font-size: 20px;
        }

        .lawyer-next,
        .lawyer-prev {
            width: 40px;
            height: 40px;
            margin-top: -20px;
        }

        .lawyer-next::after,
        .lawyer-prev::after {
            font-size: 16px;
        }

        .lawyer-prev {
            left: 5px;
        }

        .lawyer-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .lawyer-image-wrapper {
            height: 240px;
        }

        .lawyer-content {
            padding: 20px 15px;
        }

        .lawyer-name {
            font-size: 18px;
        }

        .lawyer-meta {
            flex-direction: column;
            gap: 10px;
        }
    }

    /* RTL Support */
    [dir="rtl"] .lawyer-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .lawyer-next {
        right: auto;
        left: -30px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .lawyer-prev {
            right: 10px;
        }

        [dir="rtl"] .lawyer-next {
            left: 10px;
        }
    }

    /* Service Swiper Styles */
    .service-swiper-container {
        padding: 20px 0 40px;
        position: relative;
    }

    .service-swiper {
        padding: 20px 0 60px;
        overflow: visible;
    }

    .service-swiper .swiper-slide {
        height: auto;
        display: flex;
        justify-content: center;
    }

    .service-item {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #e9ecef;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 380px;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 0 auto;
    }

    .service-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .service-item:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(107, 93, 71, 0.25);
        border-color: var(--colorPrimary);
    }

    .service-item:hover::before {
        transform: scaleX(1);
    }

    .service-icon-wrapper {
        margin-bottom: 25px;
        position: relative;
    }

    .service-item i {
        color: var(--colorPrimary);
        font-size: 64px;
        transition: all 0.4s ease;
        display: inline-block;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
        width: 110px;
        height: 110px;
        line-height: 110px;
        border-radius: 25px;
        position: relative;
        z-index: 1;
    }

    .service-item:hover i {
        transform: scale(1.15) rotate(5deg);
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        color: #fff;
        box-shadow: 0 10px 25px rgba(107, 93, 71, 0.35);
    }

    .service-item .title {
        color: var(--colorBlack);
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 18px;
        transition: color 0.3s ease;
        line-height: 1.4;
        min-height: 68px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-item:hover .title {
        color: var(--colorPrimary);
    }

    .service-item p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 25px;
        font-size: 15px;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .service-link {
        color: var(--colorPrimary);
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        position: relative;
        padding: 12px 20px;
        border: 2px solid var(--colorPrimary);
        border-radius: 8px;
        margin-top: auto;
    }

    .service-link i {
        font-size: 14px;
        width: auto;
        height: auto;
        line-height: 1;
        background: none;
        border-radius: 0;
        transition: transform 0.3s ease;
    }

    .service-item:hover .service-link {
        background: var(--colorPrimary);
        color: #fff;
        transform: translateX(5px);
    }

    .service-item:hover .service-link i {
        transform: translateX(-3px);
        background: none;
        box-shadow: none;
        color: #fff;
    }

    /* Swiper Navigation Buttons */
    .service-swiper-next,
    .service-swiper-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -22.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px;
        font-weight: bold;
    }

    .service-swiper-next:hover,
    .service-swiper-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.1);
    }

    .service-swiper-prev {
        left: -22.5px;
    }

    .service-swiper-next {
        right: -22.5px;
    }

    /* Swiper Pagination */
    .service-swiper-pagination {
        bottom: 10px !important;
        position: absolute;
    }

    .service-swiper-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: var(--colorPrimary);
        opacity: 0.3;
        transition: all 0.3s ease;
    }

    .service-swiper-pagination .swiper-pagination-bullet-active {
        opacity: 1;
        width: 30px;
        border-radius: 6px;
        background: var(--colorPrimary);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .service-swiper-prev {
            left: 10px;
        }

        .service-swiper-next {
            right: 10px;
        }
    }

    @media (max-width: 991px) {
        .service-item {
            min-height: 400px;
            padding: 35px 25px;
        }

        .service-item i {
            font-size: 56px;
            width: 100px;
            height: 100px;
            line-height: 100px;
        }

        .service-item .title {
            font-size: 22px;
            min-height: 60px;
        }
    }

    @media (max-width: 768px) {
        .service-swiper-container {
            padding: 15px 0 30px;
        }

        .service-item {
            min-height: 380px;
            padding: 30px 20px;
            max-width: 100%;
        }

        .service-item i {
            font-size: 48px;
            width: 90px;
            height: 90px;
            line-height: 90px;
        }

        .service-item .title {
            font-size: 20px;
            min-height: 56px;
        }

        .service-swiper-next,
        .service-swiper-prev {
            width: 35px;
            height: 35px;
            margin-top: -17.5px;
        }

        .service-swiper-next::after,
        .service-swiper-prev::after {
            font-size: 14px;
        }

        .service-swiper-prev {
            left: 5px;
        }

        .service-swiper-next {
            right: 5px;
        }
    }

    @media (max-width: 480px) {
        .service-item {
            min-height: 360px;
            padding: 25px 15px;
        }

        .service-item i {
            font-size: 42px;
            width: 80px;
            height: 80px;
            line-height: 80px;
        }

        .service-item .title {
            font-size: 18px;
            min-height: 52px;
        }
    }

    /* RTL Support */
    [dir="rtl"] .service-link {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .service-swiper-prev {
        left: auto;
        right: -25px;
    }

    [dir="rtl"] .service-swiper-next {
        right: auto;
        left: -25px;
    }

    @media (max-width: 1200px) {
        [dir="rtl"] .service-swiper-prev {
            right: 10px;
        }

        [dir="rtl"] .service-swiper-next {
            left: 10px;
        }
    }

    /* ============================================
       How It Works Section - Enhanced Design
       تحسين تصميم قسم كيف يعمل
       ============================================ */
    .how-it-works-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f4f8 100%);
        position: relative;
        overflow: hidden;
    }

    .how-it-works-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(107, 93, 71, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(107, 93, 71, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .how-it-works-item {
        position: relative;
        padding: 50px 35px;
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        height: 100%;
        overflow: visible;
        z-index: 1;
    }

    .how-it-works-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #6b5d47 0%, #8b7355 50%, #6b5d47 100%);
        border-radius: 25px 25px 0 0;
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: left;
    }

    .how-it-works-item:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.2);
        border-color: #6b5d47;
    }

    .how-it-works-item:hover::before {
        transform: scaleX(1);
    }

    .step-number {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%);
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        z-index: 10;
        border: 4px solid #ffffff;
        transition: all 0.4s ease;
    }

    .how-it-works-item:hover .step-number {
        transform: translateX(-50%) scale(1.15) rotate(5deg);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
        background: linear-gradient(135deg, #f4d03f 0%, #ffd700 50%, #f4d03f 100%);
    }

    .step-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #6b5d47 0%, #8b7355 50%, #a0826d 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px auto 30px;
        font-size: 42px;
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(107, 93, 71, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .step-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .step-icon i {
        font-size: 42px;
        color: #ffffff;
        position: relative;
        z-index: 1;
        transition: all 0.4s ease;
    }

    .how-it-works-item:hover .step-icon {
        transform: scale(1.15) rotate(5deg);
        box-shadow: 0 15px 40px rgba(107, 93, 71, 0.4);
        background: linear-gradient(135deg, #8b7355 0%, #a0826d 50%, #8b7355 100%);
    }

    .how-it-works-item:hover .step-icon::before {
        opacity: 1;
    }

    .how-it-works-item:hover .step-icon i {
        transform: scale(1.1);
    }

    /* Different gradient colors for each step */
    .step-item-1 .step-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .step-item-1:hover .step-icon {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .step-item-2 .step-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
    }

    .step-item-2:hover .step-icon {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4);
    }

    .step-item-3 .step-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
    }

    .step-item-3:hover .step-icon {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4);
    }

    .step-title {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 18px;
        transition: color 0.3s ease;
        line-height: 1.4;
    }

    .how-it-works-item:hover .step-title {
        color: #6b5d47;
    }

    .step-description {
        color: #5a6c7d;
        line-height: 1.9;
        margin: 0;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .how-it-works-item:hover .step-description {
        color: #4a5568;
    }

    /* Button Enhancement */
    .how-it-works-area .btn-primary {
        background: linear-gradient(135deg, #6b5d47 0%, #8b7355 100%);
        border: none;
        padding: 15px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 8px 25px rgba(107, 93, 71, 0.3);
        transition: all 0.3s ease;
        text-transform: none;
    }

    .how-it-works-area .btn-primary:hover {
        background: linear-gradient(135deg, #8b7355 0%, #6b5d47 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(107, 93, 71, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .how-it-works-item {
            padding: 40px 25px;
            margin-bottom: 40px;
        }

        .step-number {
            width: 55px;
            height: 55px;
            font-size: 24px;
            top: -25px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 90px;
            height: 90px;
            font-size: 38px;
            margin: 25px auto 25px;
        }

        .step-icon i {
            font-size: 38px;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-title {
            font-size: 22px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 15px;
            color: #5a6c7d !important;
        }
    }

    @media (max-width: 768px) {
        .how-it-works-item {
            padding: 35px 20px;
            background: #ffffff !important;
        }

        .step-number {
            width: 50px;
            height: 50px;
            font-size: 22px;
            top: -20px;
            border-width: 3px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 80px;
            height: 80px;
            font-size: 34px;
            margin: 20px auto 20px;
        }

        .step-icon i {
            font-size: 34px;
            color: #ffffff !important;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-1:hover .step-icon {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-2:hover .step-icon {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%) !important;
            box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-item-3:hover .step-icon {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%) !important;
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4) !important;
        }

        .step-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 14px;
            color: #5a6c7d !important;
        }
    }

    @media (max-width: 480px) {
        .how-it-works-item {
            padding: 30px 15px;
            background: #ffffff !important;
        }

        .step-number {
            width: 45px;
            height: 45px;
            font-size: 20px;
            top: -18px;
            border-width: 3px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%) !important;
        }

        .step-icon {
            width: 70px;
            height: 70px;
            font-size: 30px;
            margin: 15px auto 15px;
        }

        .step-icon i {
            font-size: 30px;
            color: #ffffff !important;
        }

        /* الحفاظ على ألوان الأيقونات في الموبايل */
        .step-item-1 .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .step-item-1:hover .step-icon {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4) !important;
        }

        .step-item-2 .step-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3) !important;
        }

        .step-item-2:hover .step-icon {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%) !important;
            box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4) !important;
        }

        .step-item-3 .step-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3) !important;
        }

        .step-item-3:hover .step-icon {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%) !important;
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4) !important;
        }

        .step-title {
            font-size: 18px;
            margin-bottom: 12px;
            color: #2c3e50 !important;
        }

        .step-description {
            font-size: 13px;
            line-height: 1.7;
            color: #5a6c7d !important;
        }

        .how-it-works-area .btn-primary {
            padding: 12px 30px;
            font-size: 16px;
            background: linear-gradient(135deg, #6b5d47 0%, #8b7355 100%) !important;
        }
    }

    /* ============================================
       Mobile App Section - Image Enhancement
       تحسين عرض الصورة في قسم Mobile App
       ============================================ */
    .mobile-app-image {
        position: relative;
        z-index: 1;
    }

    .mobile-app-illustration {
        width: 100%;
        max-width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        animation: float 6s ease-in-out infinite;
    }

    .mobile-app-illustration:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    /* RTL Support - Swap columns order */
    [dir="rtl"] .mobile-app-area .row {
        flex-direction: row-reverse;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .mobile-app-illustration {
            margin-bottom: 30px;
            max-width: 90%;
        }
    }

    @media (max-width: 768px) {
        .mobile-app-illustration {
            max-width: 100%;
            margin-bottom: 20px;
        }

        [dir="rtl"] .mobile-app-area .row {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .mobile-app-illustration {
            max-width: 100%;
            border-radius: 15px;
        }
    }

    /* Reduce spacing for all sections */
    .mobile-app-area,
    .how-it-works-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
    }

    /* Reduce spacing for service area and other sections */
    .service-area,
    .about-area,
    .why-us-area,
    .case-study-area {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }

    /* Reduce spacing for department section */
    .case-study-home-page {
        padding-bottom: 30px !important;
        margin-top: 100px !important;
    }

    @media (max-width: 768px) {
        .case-study-home-page {
            margin-top: 40px !important;
        }
    }

    @media (max-width: 480px) {
        .case-study-home-page {
            margin-top: 30px !important;
        }
    }

    /* Reduce large margin top */
    .mt_200 {
        margin-top: 50px !important;
    }

    /* Mobile responsive - further reduce spacing */
    @media (max-width: 768px) {
        .mobile-app-area,
        .how-it-works-area,
        .fixed-price-area,
        .legal-aid-check-home {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        .service-area,
        .about-area,
        .why-us-area,
        .case-study-area {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }
    }

    @media (max-width: 480px) {
        .mobile-app-area,
        .how-it-works-area,
        .fixed-price-area,
        .legal-aid-check-home {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }

        .service-area,
        .about-area,
        .why-us-area,
        .case-study-area {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation for Hero Stats
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count') || element.textContent.replace(/[^0-9]/g, ''));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                // Format number with + or decimal if needed
                if (target >= 1000) {
                    element.textContent = Math.floor(current).toLocaleString() + '+';
                } else if (target < 1 && target > 0) {
                    element.textContent = current.toFixed(1);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Intersection Observer for counter animation
        const statNumbers = document.querySelectorAll('.legal-stat-number[data-count]');
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    animateCounter(entry.target);
                }
            });
        }, observerOptions);

        statNumbers.forEach(stat => {
            observer.observe(stat);
        });

        // Initialize banner slider if it exists and Slick is available
        if (typeof jQuery !== 'undefined' && jQuery('.banner_slider').length) {
            setTimeout(function() {
                if (typeof jQuery.fn.slick !== 'undefined') {
                    var bannerSlider = jQuery('.banner_slider');
                    if (!bannerSlider.hasClass('slick-initialized')) {
                        bannerSlider.slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 4000,
                            speed: 800,
                            fade: true,
                            cssEase: 'linear',
                            dots: true,
                            arrows: false,
                            pauseOnHover: true,
                            pauseOnFocus: true,
                            infinite: true,
                            adaptiveHeight: false,
                            swipe: true,
                            touchMove: true
                        });
                    }
                }
            }, 200);
        }

        if (typeof Swiper !== 'undefined') {
            // Testimonial Swiper
            const testimonialSwiper = new Swiper('.testimonial-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 1000,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.testimonial-next',
                    prevEl: '.testimonial-prev',
                },
                pagination: {
                    el: '.testimonial-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 40,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1200: {
                        slidesPerView: 2,
                        spaceBetween: 50,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                slide.style.transform = 'scale(0.9)';
                                setTimeout(() => {
                                    slide.style.transition = 'all 0.6s ease';
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'scale(1)';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const testimonialContainer = document.querySelector('.testimonial-swiper-modern');
            if (testimonialContainer) {
                testimonialContainer.addEventListener('mouseenter', function() {
                    testimonialSwiper.autoplay.stop();
                });
                testimonialContainer.addEventListener('mouseleave', function() {
                    testimonialSwiper.autoplay.start();
                });
            }

            // Blog Swiper
            const blogSwiper = new Swiper('.blog-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.blog-next',
                    prevEl: '.blog-prev',
                },
                pagination: {
                    el: '.blog-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                slide.style.transform = 'scale(0.95)';
                                setTimeout(() => {
                                    slide.style.transition = 'all 0.5s ease';
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'scale(1)';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const blogContainer = document.querySelector('.blog-swiper-modern');
            if (blogContainer) {
                blogContainer.addEventListener('mouseenter', function() {
                    blogSwiper.autoplay.stop();
                });
                blogContainer.addEventListener('mouseleave', function() {
                    blogSwiper.autoplay.start();
                });
            }

            // Service Swiper
            const serviceSwiper = new Swiper('.service-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.service-swiper-next',
                    prevEl: '.service-swiper-prev',
                },
                pagination: {
                    el: '.service-swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide, index) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                setTimeout(() => {
                                    slide.style.transition = 'opacity 0.5s ease';
                                    slide.style.opacity = '1';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const swiperContainer = document.querySelector('.service-swiper');
            if (swiperContainer) {
                swiperContainer.addEventListener('mouseenter', function() {
                    serviceSwiper.autoplay.stop();
                });
                swiperContainer.addEventListener('mouseleave', function() {
                    serviceSwiper.autoplay.start();
                });
            }

            // Lawyer Swiper
            const lawyerSwiper = new Swiper('.lawyer-swiper-modern', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 800,
                effect: 'slide',
                grabCursor: true,
                navigation: {
                    nextEl: '.lawyer-next',
                    prevEl: '.lawyer-prev',
                },
                pagination: {
                    el: '.lawyer-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 25,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                // Animation on slide change
                on: {
                    slideChange: function() {
                        const slides = this.slides;
                        slides.forEach((slide) => {
                            if (slide.classList.contains('swiper-slide-active')) {
                                slide.style.opacity = '0';
                                slide.style.transform = 'scale(0.95)';
                                setTimeout(() => {
                                    slide.style.transition = 'all 0.5s ease';
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'scale(1)';
                                }, 50);
                            }
                        });
                    },
                },
            });

            // Pause autoplay on hover
            const lawyerContainer = document.querySelector('.lawyer-swiper-modern');
            if (lawyerContainer) {
                lawyerContainer.addEventListener('mouseenter', function() {
                    lawyerSwiper.autoplay.stop();
                });
                lawyerContainer.addEventListener('mouseleave', function() {
                    lawyerSwiper.autoplay.start();
                });
            }
        }
    });
</script>

<style>
/* ============================================
   SERVICE SWIPER NAVIGATION IMPROVEMENTS
   ============================================ */

/* Enhanced Service Swiper Container */
.service-swiper-container {
    position: relative !important;
    padding: 20px 80px 40px !important; /* Increased horizontal padding for navigation */
    overflow: visible !important;
}

/* Service Swiper Wrapper */
.service-swiper {
    padding: 20px 0 60px !important;
    overflow: visible !important;
}

/* Enhanced Service Navigation Buttons */
.service-swiper-next,
.service-swiper-prev {
    width: 56px !important;
    height: 56px !important;
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%) !important;
    border: 3px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 50% !important;
    color: #fff !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3) !important;
    backdrop-filter: blur(10px) !important;
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    z-index: 10 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    opacity: 0.9 !important;
}

/* Perfectly Balanced Positioning */
.service-swiper-prev {
    left: -28px !important; /* Exactly half of button width */
}

.service-swiper-next {
    right: -28px !important; /* Exactly half of button width */
}

/* Enhanced Arrow Icons */
.service-swiper-next::after,
.service-swiper-prev::after {
    font-size: 20px !important;
    font-weight: bold !important;
    color: #fff !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
    transition: all 0.3s ease !important;
}

/* Hover Effects */
.service-swiper-next:hover,
.service-swiper-prev:hover {
    background: linear-gradient(135deg, var(--colorSecondary) 0%, var(--colorPrimary) 100%) !important;
    transform: translateY(-50%) scale(1.1) !important;
    box-shadow: 0 8px 30px rgba(200, 180, 126, 0.4) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
    opacity: 1 !important;
}

.service-swiper-next:hover::after,
.service-swiper-prev:hover::after {
    transform: scale(1.1) !important;
    text-shadow: 0 3px 6px rgba(0,0,0,0.4) !important;
}

/* Active State */
.service-swiper-next:active,
.service-swiper-prev:active {
    transform: translateY(-50%) scale(0.95) !important;
    transition: all 0.1s ease !important;
}

/* Service Card Hover Interaction */
.service-item:hover ~ .service-swiper-next,
.service-item:hover ~ .service-swiper-prev,
.service-swiper:hover .service-swiper-next,
.service-swiper:hover .service-swiper-prev {
    opacity: 1 !important;
}

/* ============================================
   MOBILE RESPONSIVE SERVICE NAVIGATION
   ============================================ */

@media (max-width: 1200px) {
    .service-swiper-container {
        padding: 20px 70px 40px !important;
    }

    .service-swiper-prev {
        left: -23px !important;
    }

    .service-swiper-next {
        right: -23px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 50px !important;
        height: 50px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px !important;
    }
}

@media (max-width: 991px) {
    .service-swiper-container {
        padding: 15px 60px 30px !important;
    }

    .service-swiper-prev {
        left: -20px !important;
    }

    .service-swiper-next {
        right: -20px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 48px !important;
        height: 48px !important;
        opacity: 1 !important; /* Always visible on mobile */
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 16px !important;
    }
}

@media (max-width: 768px) {
    .service-swiper-container {
        padding: 15px 50px 30px !important;
    }

    .service-swiper-prev {
        left: -15px !important;
    }

    .service-swiper-next {
        right: -15px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 44px !important;
        height: 44px !important;
        border-width: 2px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 14px !important;
    }
}

@media (max-width: 576px) {
    .service-swiper-container {
        padding: 10px 40px 25px !important;
    }

    .service-swiper-prev {
        left: -12px !important;
    }

    .service-swiper-next {
        right: -12px !important;
    }

    .service-swiper-next,
    .service-swiper-prev {
        width: 40px !important;
        height: 40px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 12px !important;
    }
}

/* ============================================
   RTL SUPPORT FOR SERVICE NAVIGATION
   ============================================ */

[dir="rtl"] .service-swiper-prev {
    right: -28px !important;
    left: auto !important;
}

[dir="rtl"] .service-swiper-next {
    left: -28px !important;
    right: auto !important;
}

@media (max-width: 1200px) {
    [dir="rtl"] .service-swiper-prev {
        right: -23px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -23px !important;
    }
}

@media (max-width: 991px) {
    [dir="rtl"] .service-swiper-prev {
        right: -20px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -20px !important;
    }
}

@media (max-width: 768px) {
    [dir="rtl"] .service-swiper-prev {
        right: -15px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -15px !important;
    }
}

@media (max-width: 576px) {
    [dir="rtl"] .service-swiper-prev {
        right: -12px !important;
    }

    [dir="rtl"] .service-swiper-next {
        left: -12px !important;
    }
}

/* ============================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================ */

.service-swiper-next:focus,
.service-swiper-prev:focus {
    outline: 2px solid rgba(255, 255, 255, 0.8) !important;
    outline-offset: 3px !important;
    opacity: 1 !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .service-swiper-next,
    .service-swiper-prev {
        border-width: 4px !important;
        border-color: #fff !important;
        background: #000 !important;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .service-swiper-next,
    .service-swiper-prev {
        transition: none !important;
    }

    .service-swiper-next:hover,
    .service-swiper-prev:hover {
        transform: translateY(-50%) !important;
    }
}

/* ============================================
   TOUCH DEVICE OPTIMIZATIONS
   ============================================ */

@media (hover: none) and (pointer: coarse) {
    .service-swiper-next,
    .service-swiper-prev {
        width: 52px !important;
        height: 52px !important;
        opacity: 1 !important; /* Always visible on touch devices */
        border-width: 3px !important;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 18px !important;
    }
}

/* ============================================
   VISUAL ENHANCEMENT - SUBTLE ANIMATIONS
   ============================================ */

.service-swiper-next,
.service-swiper-prev {
    animation: gentlePulse 3s ease-in-out infinite !important;
}

@keyframes gentlePulse {
    0%, 100% {
        box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3);
    }
    50% {
        box-shadow: 0 6px 25px rgba(200, 180, 126, 0.4);
    }
}

/* Pause animation on hover */
.service-swiper-next:hover,
.service-swiper-prev:hover {
    animation-play-state: paused !important;
}
</style>
@endpush

@endsection
