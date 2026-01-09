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
                                        <div class="testimonial-quote-icon">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
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
                    <div class="mobile-app-content">
                        <h2 class="title mb_30"><span>{{ __('Stay on top') }}</span> {{ __('of your case') }}</h2>
                        <p class="mb_30">{{ __('تابع قضيتك بسهولة من خلال حسابك الشخصي. احصل على تحديثات فورية، تابع تقدم القضية، وتواصل مع محاميك في أي وقت ومن أي مكان.') }}</p>
                        
                        <div class="app-features mb_40">
                            <div class="feature-item mb_20">
                                <div class="feature-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('1. أنشئ حسابك') }}</h4>
                                    <p>{{ __('سجل حسابك ببساطة باستخدام بريدك الإلكتروني. احصل على وصول كامل لجميع خدماتنا القانونية وأدر قضاياك بسهولة.') }}</p>
                                </div>
                            </div>
                            <div class="feature-item mb_20">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('2. تابع حالة قضيتك') }}</h4>
                                    <p>{{ __('ابق على اطلاع دائم بآخر التحديثات. تابع تقدم قضيتك خطوة بخطوة من خلال لوحة التحكم الخاصة بك.') }}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>{{ __('3. احجز استشاراتك') }}</h4>
                                    <p>{{ __('احجز موعدك مع محامينا الخبراء مباشرة من الموقع. متاح طوال الأسبوع لمساعدتك في أي وقت تحتاجه.') }}</p>
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
                        <h2 class="title"><span>{{ __('كيف') }}</span> {{ __('يعمل') }}</h2>
                        <p>{{ __('الحصول على المساعدة القانونية لم يكن أسهل من قبل. اتبع هذه الخطوات البسيطة للبدء.') }}</p>
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
                        <h3 class="step-title">{{ __('اختر التاريخ والمحامي والوقت') }}</h3>
                        <p class="step-description">{{ __('ابدأ باختيار تاريخ مناسب لموعدك. ثم اختر المحامي الذي تريد التحدث معه والوقت الذي يناسبك.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="step-title">{{ __('دفع سهل وآمن') }}</h3>
                        <p class="step-description">{{ __('بعد اختيارك للتاريخ والوقت، ستنتقل تلقائياً إلى صفحة دفع آمنة. يمكنك الدفع بالبطاقة الائتمانية أو أي طريقة دفع متاحة.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="how-it-works-item text-center">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="step-title">{{ __('رابط الاجتماع في بريدك') }}</h3>
                        <p class="step-description">{{ __('بعد الدفع، ستصلك رسالة تأكيد على بريدك الإلكتروني تحتوي على رابط الاجتماع. عند موعد استشارتك، اضغط على الرابط للبدء.') }}</p>
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
                        <h2 class="title mb_30">{{ __('هل أنت مؤهل للحصول على المساعدة القانونية؟') }}</h2>
                        <p class="mb_40">{{ __('إذا كنت بحاجة إلى محامٍ للحصول على المساعدة القانونية، فقد تكون مؤهلاً لتغطية جزء من التكاليف من خلال تأمين الحماية القانونية أو المساعدة القانونية الممولة من الحكومة. اكتشف الآن إذا كنت مؤهلاً للحصول على الدعم المالي.') }}</p>
                        <a href="{{ route('website.legal.aid.check') }}" class="btn btn-primary btn-lg">{{ __('اكتشف الآن') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Legal Aid Check Section End-->

@push('css')
<style>
    /* Testimonial Modern Styles */
    .testimonial-area-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 100px 0;
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
        padding: 60px 0 80px;
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
        width: 60px;
        height: 60px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -30px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .testimonial-next::after,
    .testimonial-prev::after {
        font-size: 24px;
        font-weight: bold;
    }

    .testimonial-next:hover,
    .testimonial-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .testimonial-prev {
        left: -30px;
    }

    .testimonial-next {
        right: -30px;
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
    }

    @media (max-width: 768px) {
        .testimonial-area-modern {
            padding: 60px 0;
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
            width: 50px;
            height: 50px;
            margin-top: -25px;
        }

        .testimonial-next::after,
        .testimonial-prev::after {
            font-size: 20px;
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
        padding: 100px 0;
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
        padding: 60px 0 80px;
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
        width: 60px;
        height: 60px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -30px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .blog-next::after,
    .blog-prev::after {
        font-size: 24px;
        font-weight: bold;
    }

    .blog-next:hover,
    .blog-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .blog-prev {
        left: -30px;
    }

    .blog-next {
        right: -30px;
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
            padding: 60px 0;
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
            width: 50px;
            height: 50px;
            margin-top: -25px;
        }

        .blog-next::after,
        .blog-prev::after {
            font-size: 20px;
        }

        .blog-prev {
            left: 5px;
        }

        .blog-next {
            right: 5px;
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
        padding: 100px 0;
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
        padding: 60px 0 80px;
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
        width: 60px;
        height: 60px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -30px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(107, 93, 71, 0.3);
    }

    .lawyer-next::after,
    .lawyer-prev::after {
        font-size: 24px;
        font-weight: bold;
    }

    .lawyer-next:hover,
    .lawyer-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.15);
        box-shadow: 0 8px 30px rgba(107, 93, 71, 0.4);
    }

    .lawyer-prev {
        left: -30px;
    }

    .lawyer-next {
        right: -30px;
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
            padding: 60px 0;
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
            width: 50px;
            height: 50px;
            margin-top: -25px;
        }

        .lawyer-next::after,
        .lawyer-prev::after {
            font-size: 20px;
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
        padding: 40px 0 80px;
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
        width: 50px;
        height: 50px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        margin-top: -25px;
        transition: all 0.3s ease;
    }

    .service-swiper-next::after,
    .service-swiper-prev::after {
        font-size: 20px;
        font-weight: bold;
    }

    .service-swiper-next:hover,
    .service-swiper-prev:hover {
        background: var(--colorSecondary);
        transform: scale(1.1);
    }

    .service-swiper-prev {
        left: -25px;
    }

    .service-swiper-next {
        right: -25px;
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
            padding: 30px 0 60px;
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
            width: 40px;
            height: 40px;
            margin-top: -20px;
        }

        .service-swiper-next::after,
        .service-swiper-prev::after {
            font-size: 16px;
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
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
@endpush

@endsection
