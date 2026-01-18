@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Home')->first()->seo_title ?? 'LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ seoSetting()->where('page_name', 'Home')->first()->seo_description ?? 'LawMent' }}">
@endsection
@section('client-content')

    <!--Hero Section Start-->
    <section class="hero-section pt_100 pb_100" style="background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%); position: relative; overflow: hidden;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="hero-content">
                        <h1 class="hero-title" style="font-size: 48px; font-weight: 800; color: #ffffff; margin-bottom: 25px; line-height: 1.3;">
                            {{ __('ملتقى المحامين السوريين-السويسريين') }}<br>
                            <span style="color: #D4A574;">{{ __('Aman Law – أمان لو') }}</span>
                        </h1>
                        <p class="hero-description" style="font-size: 18px; color: rgba(255, 255, 255, 0.9); line-height: 1.8; margin-bottom: 30px;">
                            {{ __('منصّة قانونية مُدارة من سويسرا، تضم محامين مختصين من سوريا، لتقديم استشارات قانونية وتمثيل قضائي في القضايا المتعلقة بسوريا للعملاء في جميع أنحاء العالم.') }}
                        </p>
                        <p class="hero-description" style="font-size: 16px; color: rgba(255, 255, 255, 0.85); line-height: 1.8; margin-bottom: 30px;">
                            {{ __('نقدّم خدمات قانونية متكاملة تشمل القضايا المدنية، العقارية، التجارية، قضايا الأحوال الشخصية، القضايا الجزائية، وصياغة العقود ومتابعة الدعاوى أمام المحاكم السورية.') }}
                        </p>
                        <p class="hero-description" style="font-size: 16px; color: rgba(255, 255, 255, 0.85); line-height: 1.8; margin-bottom: 40px;">
                            {{ __('تتم الاستشارات القانونية عبر التواصل على واتساب أو من خلال تعبئة نموذج الطلب، مع إمكانية حجز موعد استشارة عبر مكالمة صوتية أو مكالمة فيديو حسب رغبة العميل.') }}
                        </p>
                        <a href="{{ route('website.book.consultation.appointment') }}" class="hero-cta-btn" style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); color: #ffffff; border-radius: 50px; font-weight: 700; font-size: 18px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(212, 165, 116, 0.4);">
                            {{ __('تواصل معنا وحجز استشارة قانونية') }}
                            <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="hero-image text-center">
                        <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); min-height: 400px; background: linear-gradient(135deg, rgba(212, 165, 116, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%); display: flex; align-items: center; justify-content: center;">
                            @php
                                $heroImage = null;
                                $imagePaths = [
                                    'uploads/website-images/hero-aman-law.png',
                                    'uploads/website-images/app_banner.webp',
                                    'uploads/website-images/overview-banner.webp',
                                    'client/img/mobile-app-illustration.png'
                                ];
                                foreach ($imagePaths as $path) {
                                    if (file_exists(public_path($path))) {
                                        $heroImage = asset($path);
                                        break;
                                    }
                                }
                            @endphp
                            @if($heroImage)
                                <img src="{{ $heroImage }}" 
                                     alt="{{ __('Aman Law - أمان لو') }}" 
                                     style="width: 100%; height: auto; display: block; border-radius: 20px;"
                                     loading="lazy">
                            @else
                                <div style="text-align: center; padding: 40px; color: rgba(255, 255, 255, 0.9);">
                                    <i class="fas fa-balance-scale" style="font-size: 120px; margin-bottom: 20px; opacity: 0.3;"></i>
                                    <h3 style="font-size: 28px; font-weight: 700; margin-bottom: 10px;">{{ __('Aman Law') }}</h3>
                                    <p style="font-size: 16px; opacity: 0.8;">{{ __('أمان لو') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Hero Section End-->

    <!--Quick Points Section Start-->
    <section class="quick-points-section pt_80 pb_80" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-users" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('محامون مختصون') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('شبكة من المحامين ذوي خبرة داخل سوريا، كلٌّ حسب اختصاصه القانوني.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-globe" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('استشارة عن بُعد') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('إمكانية الحصول على استشارة قانونية من أي مكان في العالم.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="quick-point-card" style="background: #ffffff; padding: 40px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%;">
                        <div class="quick-point-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #D4A574 0%, #DC2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fas fa-eye" style="font-size: 36px; color: #ffffff;"></i>
                        </div>
                        <h3 class="quick-point-title" style="font-size: 22px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('وضوح وشفافية') }}</h3>
                        <p class="quick-point-text" style="font-size: 16px; color: #666; line-height: 1.7;">{{ __('آلية عمل واضحة وتواصل مباشر مع العميل في جميع مراحل القضية.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Quick Points Section End-->

    @if (1 == $home_sections?->service_status)
        <!--Service Start-->
        <section class="service-area bg-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                        <div class="main-headline">
                            <h2 class="title"><span>{{ __('الخدمات') }}</span> {{ __('القانونية') }}</h2>
                            <p>{{ __('نقدّم خدمات قانونية متنوّعة متعلّقة بالقضايا داخل سوريا، موجّهة للأفراد والشركات في الداخل والخارج.') }}</p>
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
              
            </div>
        </section>
        <!--Service End-->
    @endif

    <!--How It Works Section Start-->
    <section class="how-it-works-area pt_100 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('كيف') }}</span> {{ __('نعمل') }}</h2>
                        <p>{{ __('نعتمد آلية عمل بسيطة وواضحة لضمان فهم الطلب وتقديم الخدمة القانونية المناسبة.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">1</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-1">
                            <i class="fab fa-whatsapp enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('التواصل عبر واتساب أو تعبئة نموذج طلب الاستشارة') }}</h3>
                            <p class="enhanced-step-description">{{ __('ابدأ بالتواصل معنا عبر واتساب أو من خلال تعبئة نموذج طلب الاستشارة المتاح على الموقع.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">2</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-2">
                            <i class="fas fa-search enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('دراسة الحالة من قبل الفريق القانوني') }}</h3>
                            <p class="enhanced-step-description">{{ __('يقوم فريقنا القانوني بدراسة حالتك بعناية وتحديد المحامي المختص المناسب.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">3</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-3">
                            <i class="fas fa-comments enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('تقديم الاستشارة القانونية') }}</h3>
                            <p class="enhanced-step-description">{{ __('نقدّم الاستشارة القانونية عبر النص، المكالمة الصوتية أو مكالمة الفيديو حسب رغبتك.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt_30">
                    <div class="enhanced-how-works-card">
                        <div class="enhanced-step-number">4</div>
                        <div class="enhanced-step-icon-wrapper enhanced-icon-3">
                            <i class="fas fa-gavel enhanced-step-icon"></i>
                        </div>
                        <div class="enhanced-step-content">
                            <h3 class="enhanced-step-title">{{ __('متابعة القضية أو التمثيل القانوني') }}</h3>
                            <p class="enhanced-step-description">{{ __('عند الطلب، نقوم بمتابعة القضية أو التمثيل القانوني أمام المحاكم السورية.') }}</p>
                        </div>
                        <div class="enhanced-step-decoration"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--How It Works Section End-->

    <!--About Us Section Start-->
    <section class="about-us-section pt_100 pb_100" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('من') }}</span> {{ __('نحن') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-10 m-auto">
                    <div class="about-us-content text-center" style="background: #ffffff; padding: 50px 40px; border-radius: 20px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);">
                        <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 0;">
                            {{ __('أمان لو – Aman Law هي منصّة قانونية مُدارة من سويسرا، تعمل كملتقى للمحامين السوريين-السويسريين، وتهدف إلى تسهيل وصول العملاء في الخارج إلى خدمات قانونية موثوقة داخل سوريا، عبر محامين مختصين وبآلية عمل منظّمة وشفافة.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About Us Section End-->

    <!--Why Aman Law Section Start-->
    <section class="why-aman-law-section pt_100 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('لماذا') }}</span> {{ __('أمان لو') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-flag" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('إدارة قانونية من سويسرا') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-user-tie" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('محامون مختصون داخل سوريا') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-users" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('خدمة مخصّصة للعملاء في الخارج') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-video" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('استشارات عن بُعد (صوتية أو فيديو)') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-eye" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('وضوح في الإجراءات والمتابعة') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt_30">
                    <div class="why-aman-card" style="background: #ffffff; padding: 35px 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; border-top: 4px solid #D4A574;">
                        <i class="fas fa-shield-alt" style="font-size: 40px; color: #D4A574; margin-bottom: 20px;"></i>
                        <h4 style="font-size: 20px; font-weight: 700; color: #0b2c64; margin-bottom: 15px;">{{ __('التزام بالمهنية والسرّية') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Why Aman Law Section End-->

    @if (1 == $home_sections?->department_status)
        <!--Department Start-->
        <section class="case-study-home-page case-study-area">
            <div class="container">
                <div class="row mb_25">
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
                                        <img src="{{ asset($department?->thumbnail_image ?? 'client/images/default-image.jpg') }}"
                                            alt="{{ $department?->name }}" 
                                            loading="lazy"
                                            onerror="this.src='{{ asset('client/images/default-image.jpg') }}'; this.onerror=null;">
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
        <!--Department End-->
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
                                    <div class="lawyer-card-mobile aman-lawyer-card-mobile-rtl">
                                        <div class="lawyer-card-image-mobile">
                                            <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                                @php
                                                    $lawyerImage = $lawyer?->image ? $lawyer->image : ($setting?->default_avatar ?? 'uploads/website-images/default-avatar.png');
                                                @endphp
                                                <img src="{{ url($lawyerImage) }}" alt="{{ $lawyer?->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ url($setting?->default_avatar ?? 'uploads/website-images/default-avatar.png') }}';">
                                            </a>
                                        </div>
                                        <div class="lawyer-card-content-mobile">
                                            <h3 class="lawyer-card-name-mobile">
                                                <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                                    {{ ucfirst($lawyer?->name) }}
                                                </a>
                                            </h3>
                                            <div class="lawyer-card-meta-mobile">
                                                @php
                                                    $displayDept = ($lawyer->departments && $lawyer->departments->isNotEmpty()) 
                                                        ? $lawyer->departments->first() 
                                                        : ($lawyer->department ?? null);
                                                @endphp
                                                @if($displayDept && $displayDept->name)
                                                <div class="lawyer-meta-item-mobile">
                                                    <i class="fas fa-briefcase lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ ucfirst($displayDept->name) }}</span>
                                                </div>
                                                @endif
                                                @if($lawyer->location)
                                                <div class="lawyer-meta-item-mobile">
                                                    <i class="fas fa-map-marker-alt lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ ucfirst($lawyer->location->name) }}</span>
                                                </div>
                                                @endif
                                                @if($lawyer->designations)
                                                <div class="lawyer-meta-item-mobile">
                                                    <i class="fas fa-graduation-cap lawyer-meta-icon-mobile"></i>
                                                    <span class="lawyer-meta-text-mobile">{{ $lawyer->designations }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <a class="lawyer-card-button-mobile" href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ __('View Profile') }}">
                                                <i class="fas fa-arrow-left lawyer-button-icon-mobile"></i>
                                                <span class="lawyer-button-text-mobile">{{ __('View Profile') }}</span>
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

    @if (1 == $home_sections?->client_status)
        <!--Testimonial Start-->
        <section class="testimonial-area-modern">
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

                <div class="testimonials-grid-wrapper">
                    <div class="testimonials-grid-container">
                        @foreach ($testimonials->take($home_sections?->client_how_many) as $client)
                            <div class="testimonial-card-new">
                                <div class="testimonial-card-inner">
                                    <div class="testimonial-content-new">
                                        <p class="testimonial-text-new">{{ $client?->comment }}</p>
                                    </div>
                                    <div class="testimonial-rating-new">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="testimonial-author-new">
                                        <div class="author-image-wrapper-new">
                                            <img src="{{ !empty($client?->image) ? url($client?->image) : asset('uploads/website-images/default-avatar.png') }}"
                                                alt="{{ $client?->name }}" loading="lazy" class="author-image-new">
                                            <div class="author-image-border-new"></div>
                                        </div>
                                        <div class="author-info-new">
                                            <h4 class="author-name-new">{{ $client?->name }}</h4>
                                            <p class="author-designation-new">{{ $client?->designation }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonial End-->
    @endif

    <!--Book Consultation Section Start-->
    <section class="book-consultation-section pt_100 pb_100" style="background: linear-gradient(135deg, #0b2c64 0%, #1a3d7a 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="book-consultation-content text-center" style="background: rgba(255, 255, 255, 0.1); padding: 60px 40px; border-radius: 20px; backdrop-filter: blur(10px);">
                        <h2 class="title mb_30" style="color: #ffffff; font-size: 36px; font-weight: 700; margin-bottom: 25px;">{{ __('حجز استشارة قانونية') }}</h2>
                        <p style="font-size: 18px; color: rgba(255, 255, 255, 0.9); line-height: 1.8; margin-bottom: 40px;">
                            {{ __('للحصول على استشارة قانونية، يمكنكم التواصل معنا عبر واتساب أو تعبئة نموذج طلب الاستشارة لتوضيح تفاصيل القضية، مع إمكانية حجز موعد مكالمة صوتية أو فيديو مع محامٍ مختص.') }}
                        </p>
                        <a href="{{ route('website.book.consultation.appointment') }}" class="btn btn-primary btn-lg" style="padding: 16px 40px; font-size: 18px; font-weight: 700; border-radius: 50px;">
                            {{ __('احجز استشارتك الآن') }}
                            <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Book Consultation Section End-->

    <!--Contact Us Section Start-->
    <section class="contact-us-section pt_100 pb_100" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                    <div class="main-headline text-center">
                        <h2 class="title"><span>{{ __('تواصل') }}</span> {{ __('معنا') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt_50">
                <div class="col-lg-8 m-auto">
                    <div class="contact-us-content text-center" style="background: #ffffff; padding: 50px 40px; border-radius: 20px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);">
                        <p style="font-size: 18px; color: #333; line-height: 1.9; margin-bottom: 30px;">
                            {{ __('نحن جاهزون للإجابة على استفساراتكم القانونية ومساعدتكم في متابعة قضاياكم داخل سوريا.') }}
                        </p>
                        <p style="font-size: 16px; color: #666; line-height: 1.8; margin-bottom: 0;">
                            {{ __('يرجى التواصل معنا عبر واتساب أو من خلال نموذج التواصل المتاح على الموقع.') }}
                        </p>
                        <div class="mt_40">
                            @if ($contactInfo?->top_bar_phone)
                                @php
                                    $whatsappNumber = $contactInfo->top_bar_phone;
                                    $whatsappNumber = preg_replace('/[^0-9+]/', '', $whatsappNumber);
                                    if (!str_starts_with($whatsappNumber, '+')) {
                                        $whatsappNumber = '+963' . ltrim($whatsappNumber, '0');
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn btn-success btn-lg me-3" style="padding: 14px 35px; font-size: 18px; font-weight: 600; border-radius: 50px;">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    {{ __('تواصل عبر واتساب') }}
                                </a>
                            @endif
                            <a href="{{ route('website.contact-us') }}" class="btn btn-primary btn-lg" style="padding: 14px 35px; font-size: 18px; font-weight: 600; border-radius: 50px;">
                                <i class="fas fa-envelope me-2"></i>
                                {{ __('نموذج التواصل') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Us Section End-->

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
                                                    <span>Admin</span>
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

@push('css')
<style>
    @keyframes shimmer {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }
    .legal-stat-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.08) 100%);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 30px;
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInRight 0.8s ease both;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .legal-stat-card:nth-child(1) { animation-delay: 0.2s; }
    .legal-stat-card:nth-child(2) { animation-delay: 0.4s; }
    .legal-stat-card:nth-child(3) { animation-delay: 0.6s; }
    .legal-stat-card:nth-child(4) { animation-delay: 0.8s; }

    .legal-stat-card:hover {
        transform: translateY(-12px) scale(1.02);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.18) 0%, rgba(255, 255, 255, 0.12) 100%);
        box-shadow: 0 20px 50px rgba(212, 175, 55, 0.3), 0 10px 30px rgba(0, 0, 0, 0.25);
        border-color: rgba(212, 175, 55, 0.6);
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
        font-size: 40px;
        font-weight: 900;
        color: #ffffff;
        margin: 0 0 8px 0;
        line-height: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #ffffff 0%, rgba(244, 208, 63, 0.9) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .legal-stat-label {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        font-weight: 600;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
    }


        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Animated Legal Icons */


        25% {
            transform: translate(20px, -20px) rotate(5deg) scale(1.08);
            opacity: 0.3;
        }
        50% {
            transform: translate(-15px, 15px) rotate(-5deg) scale(0.92);
            opacity: 0.27;
        }
        75% {
            transform: translate(15px, 20px) rotate(3deg) scale(1.05);
            opacity: 0.32;
        }
    }



        /* Center all icons in a vertical column */
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


        /* Center all icons in a vertical column */
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
    /* RTL: نفس الترتيب البصري - الإحصائيات على اليسار والمحتوى على اليمين */
    [dir="rtl"] .legal-stat-content {
        text-align: right;
    }

    /* LTR: الإحصائيات على اليسار والمحتوى على اليمين */
    /* RTL Mobile Support */
    @media (max-width: 768px) {
        

        /* Mobile ordering: content first, then stats */
        [dir="rtl"] .legal-stat-content {
            text-align: center;
        }
    }

    @media (max-width: 480px) {
    }

    
    @media (max-width: 768px) {
        body.client-frontend 

        body.client-frontend 

        body.client-frontend 
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

    /* ============================================
       NEW TESTIMONIALS DESIGN - Responsive & RTL
       ============================================ */
    
    .testimonials-grid-wrapper {
        padding: 40px 0 60px;
        position: relative;
    }

    .testimonials-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        direction: rtl !important;
    }

    [dir="ltr"] .testimonials-grid-container {
        direction: rtl !important;
    }

    .testimonial-card-new {
        background: #ffffff;
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        overflow: hidden;
        position: relative;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .testimonial-card-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-card-new::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: right;
    }

    .testimonial-card-new:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(107, 93, 71, 0.15);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-new:hover::before {
        transform: scaleX(1);
    }

    .testimonial-card-inner {
        padding: 35px 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .testimonial-card-inner {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-quote-icon-new {
        position: absolute;
        top: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.08) 0%, rgba(90, 77, 58, 0.08) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        z-index: 1;
    }

    [dir="ltr"] .testimonial-quote-icon-new {
        right: 25px;
        left: auto;
    }

    .testimonial-quote-icon-new i {
        font-size: 28px;
        color: var(--colorPrimary);
        transition: all 0.4s ease;
    }

    .testimonial-card-new:hover .testimonial-quote-icon-new {
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        transform: rotate(15deg) scale(1.1);
    }

    .testimonial-card-new:hover .testimonial-quote-icon-new i {
        color: #ffffff;
    }

    .testimonial-content-new {
        margin-top: 10px;
        flex-grow: 1;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .testimonial-content-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-text-new {
        font-size: 16px;
        line-height: 1.8;
        color: #4f5b6d;
        font-style: italic;
        margin: 0;
        direction: rtl !important;
        text-align: right !important;
        padding-right: 0;
        padding-left: 0;
    }

    [dir="ltr"] .testimonial-text-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-rating-new {
        display: flex;
        gap: 6px;
        justify-content: flex-end !important;
        direction: rtl !important;
        flex-shrink: 0;
    }

    [dir="ltr"] .testimonial-rating-new {
        justify-content: flex-end !important;
        direction: rtl !important;
    }

    .testimonial-rating-new i {
        color: #ffc107;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .testimonial-card-new:hover .testimonial-rating-new i {
        transform: scale(1.15);
        color: #ff9800;
    }

    .testimonial-author-new {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
        direction: rtl !important;
        justify-content: flex-end !important;
    }

    [dir="ltr"] .testimonial-author-new {
        direction: rtl !important;
        justify-content: flex-end !important;
    }

    .author-image-wrapper-new {
        position: relative;
        width: 70px;
        height: 70px;
        flex-shrink: 0;
        order: 1 !important;
    }

    [dir="ltr"] .author-image-wrapper-new {
        order: 1 !important;
    }

    .author-image-new {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
    }

    .author-image-border-new {
        position: absolute;
        top: -3px;
        right: -3px;
        left: -3px;
        bottom: -3px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .testimonial-card-new:hover .author-image-new {
        transform: scale(1.08);
        border-color: var(--colorPrimary);
    }

    .testimonial-card-new:hover .author-image-border-new {
        opacity: 1;
    }

    .author-info-new {
        flex-grow: 1;
        order: 2 !important;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-info-new {
        order: 2 !important;
        direction: rtl !important;
        text-align: right !important;
    }

    .author-name-new {
        font-size: 18px;
        font-weight: 700;
        color: var(--colorBlack);
        margin: 0 0 5px 0;
        transition: color 0.3s ease;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-name-new {
        direction: rtl !important;
        text-align: right !important;
    }

    .testimonial-card-new:hover .author-name-new {
        color: var(--colorPrimary);
    }

    .author-designation-new {
        font-size: 14px;
        color: #666;
        margin: 0;
        direction: rtl !important;
        text-align: right !important;
    }

    [dir="ltr"] .author-designation-new {
        direction: rtl !important;
        text-align: right !important;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .testimonials-grid-container {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
    }

    @media (max-width: 768px) {
        .testimonials-grid-wrapper {
            padding: 30px 0 40px;
        }

        .testimonials-grid-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .testimonial-card-inner {
            padding: 30px 25px;
        }

        .testimonial-quote-icon-new {
            width: 50px;
            height: 50px;
            top: 20px;
            right: 20px;
        }

        .testimonial-quote-icon-new i {
            font-size: 24px;
        }

        .testimonial-text-new {
            font-size: 15px;
        }

        .author-image-wrapper-new {
            width: 60px;
            height: 60px;
        }

        .author-name-new {
            font-size: 17px;
        }

        .author-designation-new {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .testimonials-grid-wrapper {
            padding: 20px 0 30px;
        }

        .testimonial-card-inner {
            padding: 25px 20px;
            gap: 15px;
        }

        .testimonial-quote-icon-new {
            width: 45px;
            height: 45px;
            top: 15px;
            right: 15px;
        }

        .testimonial-quote-icon-new i {
            font-size: 20px;
        }

        .testimonial-text-new {
            font-size: 14px;
            line-height: 1.7;
        }

        .author-image-wrapper-new {
            width: 55px;
            height: 55px;
        }

        .author-name-new {
            font-size: 16px;
        }

        .author-designation-new {
            font-size: 12px;
        }

        .testimonial-rating-new i {
            font-size: 14px;
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
        line-clamp: 2;
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
        line-clamp: 3;
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
        top: 20% !important;
        margin-top: 0 !important;
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
            top: 15% !important;
            margin-top: 0 !important;
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
        flex-shrink: 0;
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
        flex-shrink: 0;
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
        padding: 12px 20px;
        border-radius: 8px;
        background: rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.08);
        border: 1px solid rgba(var(--colorPrimary-rgb, 200, 180, 126), 0.2);
    }

    .lawyer-view-profile i {
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .lawyer-card-modern:hover .lawyer-view-profile {
        color: #fff;
        background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
        border-color: var(--colorPrimary);
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(107, 93, 71, 0.3);
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

    /* RTL: Enhanced button design for Arabic */
    [dir="rtl"] .lawyer-view-profile {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        padding: 12px 20px;
    }

    [dir="rtl"] .lawyer-view-profile i {
        order: 2;
        margin-left: 12px;
        margin-right: 0;
    }

    [dir="rtl"] .lawyer-view-profile span {
        order: 1;
        text-align: right;
    }

    /* Swiper Navigation */
    .lawyer-next,
    .lawyer-prev {
        width: 45px;
        height: 45px;
        background: var(--colorPrimary);
        border-radius: 50%;
        color: #fff;
        top: 20% !important;
        margin-top: 0 !important;
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
            top: 15% !important;
            margin-top: 0 !important;
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
    [dir="rtl"] .lawyer-prev {
        left: auto;
        right: -30px;
    }

    [dir="rtl"] .lawyer-next {
        right: auto;
        left: -30px;
    }
    [dir="rtl"] .lawyer-meta {
        justify-content: flex-end;
        align-items: flex-end;
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .lawyer-department-meta,
    [dir="rtl"] .lawyer-location-meta {
        flex-direction: row;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
    }

    /* Text on the right, icons close to text on left */
    [dir="rtl"] .lawyer-department-meta,
    [dir="rtl"] .lawyer-location-meta {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    [dir="rtl"] .lawyer-department-meta i,
    [dir="rtl"] .lawyer-location-meta i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    [dir="rtl"] .lawyer-department-meta span,
    [dir="rtl"] .lawyer-location-meta span {
        order: 1;
        text-align: right;
    }

    [dir="rtl"] .lawyer-designations {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    /* Text on the right, icon close to text on left */
    [dir="rtl"] .lawyer-designations i {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }
    [dir="rtl"] .lawyer-rating {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        gap: 10px;
    }

    /* Stars should be on the left of text (after text in RTL reading direction) */
    [dir="rtl"] .lawyer-rating .star-rating {
        order: 2;
        direction: ltr;
    }

    [dir="rtl"] .lawyer-rating .rating-text {
        order: 1;
        text-align: right;
        margin-left: 0;
        margin-right: 0;
    }
    [dir="rtl"] .lawyer-view-profile {
        flex-direction: row-reverse;
        justify-content: flex-end;
        text-align: right;
        direction: rtl;
        align-items: center;
        padding: 12px 20px;
    }

    /* Arrow icon close to text on left */
    [dir="rtl"] .lawyer-view-profile i {
        order: 2;
        margin-left: 12px;
        margin-right: 0;
        font-size: 16px;
    }

    [dir="rtl"] .lawyer-view-profile span {
        order: 1;
        text-align: right;
    }

    [dir="rtl"] .lawyer-card-modern:hover .lawyer-view-profile {
        box-shadow: 0 4px 12px rgba(107, 93, 71, 0.3);
    }

    /* Mobile RTL Support for Lawyer Card */
    @media (max-width: 768px) {
        [dir="rtl"] .lawyer-meta {
            align-items: flex-end;
            justify-content: flex-end;
        }

        [dir="rtl"] .lawyer-department-meta,
        [dir="rtl"] .lawyer-location-meta {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-department-meta i,
        [dir="rtl"] .lawyer-location-meta i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-designations {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-designations i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-rating {
            justify-content: flex-end;
            text-align: right;
            flex-direction: row-reverse;
        }

        [dir="rtl"] .lawyer-rating .star-rating {
            order: 2;
        }

        [dir="rtl"] .lawyer-rating .rating-text {
            order: 1;
            text-align: right;
        }

        [dir="rtl"] .lawyer-view-profile {
            justify-content: flex-end;
            text-align: right;
            padding: 12px 18px;
        }

        [dir="rtl"] .lawyer-view-profile i {
            margin-left: 12px;
            margin-right: 0;
        }
    }

    @media (max-width: 480px) {
        [dir="rtl"] .lawyer-meta {
            align-items: flex-end;
            justify-content: flex-end;
        }

        [dir="rtl"] .lawyer-department-meta,
        [dir="rtl"] .lawyer-location-meta {
            text-align: right;
            justify-content: flex-end;
            width: 100%;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-department-meta i,
        [dir="rtl"] .lawyer-location-meta i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-designations {
            text-align: right;
            justify-content: flex-end;
            flex-direction: row-reverse;
            gap: 10px;
        }

        [dir="rtl"] .lawyer-designations i {
            margin-left: 10px;
            margin-right: 0;
        }

        [dir="rtl"] .lawyer-view-profile {
            padding: 10px 16px;
        }
    }

        [dir="rtl"] .lawyer-rating {
            justify-content: flex-end;
            text-align: right;
            flex-direction: row-reverse;
        }

        [dir="rtl"] .lawyer-rating .star-rating {
            order: 2;
        }

        [dir="rtl"] .lawyer-rating .rating-text {
            order: 1;
            text-align: right;
        }

        [dir="rtl"] .lawyer-view-profile {
            justify-content: flex-end;
            text-align: right;
        }
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
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        text-align: center;
    }

    .service-item i {
        color: var(--colorPrimary);
        font-size: 64px;
        transition: all 0.4s ease;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, rgba(107, 93, 71, 0.1) 0%, rgba(90, 77, 58, 0.1) 100%);
        width: 110px;
        height: 110px;
        border-radius: 25px;
        position: relative;
        z-index: 1;
        margin: 0 auto;
        text-align: center;
        line-height: 1 !important;
    }
    
    .service-item i::before {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        line-height: 1;
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
        top: 20% !important;
        margin-top: 0 !important;
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
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
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
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
        }

        .service-item .title {
            font-size: 20px;
            min-height: 56px;
        }

        .service-swiper-next,
        .service-swiper-prev {
            width: 35px;
            height: 35px;
            top: 15% !important;
            margin-top: 0 !important;
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
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto;
            text-align: center;
            line-height: 1 !important;
        }
        
        .service-item i::before {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 1;
        }

        .service-item .title {
            font-size: 18px;
            min-height: 52px;
        }
    }
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
        padding-top: 0 !important;
        padding-bottom: 40px !important;
    }

    /* Reduce spacing for department section */
    .case-study-home-page {
        padding-top: 0 !important;
        padding-bottom: 30px !important;
        margin-top: 0 !important;
    }

    @media (max-width: 768px) {
        .case-study-home-page {
            margin-top: 0 !important;
        }
    }

    @media (max-width: 480px) {
        .case-study-home-page {
            margin-top: 0 !important;
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


        if (typeof Swiper !== 'undefined') {
            // New Testimonials Grid - No swiper needed, just ensure equal heights
            function equalizeTestimonialCardsNew() {
                const cards = document.querySelectorAll('.testimonial-card-new');
                if (cards.length === 0) return;
                
                let maxHeight = 0;
                cards.forEach(card => {
                    card.style.height = 'auto';
                });
                
                cards.forEach(card => {
                    const height = card.offsetHeight;
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });
                
                // Only set height if there's a significant difference
                if (maxHeight > 0) {
                    cards.forEach(card => {
                        const cardHeight = card.offsetHeight;
                        if (cardHeight < maxHeight * 0.9) {
                            card.style.minHeight = maxHeight + 'px';
                        }
                    });
                }
            }

            // Run on load and resize
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    equalizeTestimonialCardsNew();
                    window.addEventListener('resize', equalizeTestimonialCardsNew);
                });
            } else {
                equalizeTestimonialCardsNew();
                window.addEventListener('resize', equalizeTestimonialCardsNew);
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
    top: 20% !important;
    transform: none !important;
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
        top: 15% !important;
        margin-top: 0 !important;
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
        transform: scale(1.1) !important;
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

/* ============================================
   COMPREHENSIVE MOBILE RESPONSIVE IMPROVEMENTS
   تحسينات شاملة للتصميم المتجاوب للموبايل
   ============================================ */

@media (max-width: 991px) {
    /* Prevent horizontal scroll */
    html, body {
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }

    * {
        max-width: 100%;
    }

    /* Section improvements */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding: 40px 0 !important;
    }

    /* Main headline improvements - Center all section titles and descriptions */
    .main-headline {
        text-align: center !important;
        margin-bottom: 30px;
        width: 100%;
    }
    
    .main-headline * {
        text-align: center !important;
    }

    .main-headline .title {
        font-size: 28px !important;
        line-height: 1.3;
        margin-bottom: 15px;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 15px;
        line-height: 1.7;
        text-align: center !important;
    }

    /* Service items improvements */
    .service-item {
        margin-bottom: 25px;
        padding: 25px 20px;
    }

    .service-item .title {
        font-size: 20px !important;
        margin-bottom: 15px;
    }

    .service-item p {
        font-size: 14px;
        line-height: 1.7;
    }

    /* Choose items improvements */
    .choose-item {
        padding: 25px 20px;
        margin-bottom: 20px;
    }

    .choose-item .title {
        font-size: 20px !important;
    }

    /* Feature accordion improvements */
    .feature-accordion {
        margin-top: 25px;
    }

    .faq-item {
        margin-bottom: 15px;
    }

    .faq-button {
        padding: 15px 20px;
        font-size: 16px;
        min-height: 60px;
    }

    /* Blog cards improvements */
    .blog-card-modern {
        margin-bottom: 25px;
    }

    .blog-content {
        padding: 20px;
    }

    .blog-title {
        font-size: 20px !important;
        margin-bottom: 12px;
    }

    /* Lawyer cards improvements */
    .lawyer-card-modern {
        margin-bottom: 25px;
    }

    .lawyer-content {
        padding: 20px;
    }

    .lawyer-name {
        font-size: 20px !important;
        margin-bottom: 10px;
    }

    /* Testimonial cards improvements */
    .testimonial-card-modern {
        padding: 30px 25px;
        margin-bottom: 20px;
    }

    .testimonial-text {
        font-size: 16px;
        line-height: 1.7;
    }

    /* How it works improvements */
    .how-it-works-item {
        padding: 30px 20px;
        margin-bottom: 25px;
    }

    .step-title {
        font-size: 18px !important;
    }

    .step-description {
        font-size: 14px;
        line-height: 1.7;
    }

    /* Mobile app section improvements */
    .mobile-app-content {
        text-align: center;
        margin-bottom: 30px;
    }

    .mobile-app-content .title {
        font-size: 28px !important;
        margin-bottom: 15px;
    }

    /* Fixed price section improvements */
    .fixed-price-content {
        text-align: center;
    }

    .fixed-price-content .title {
        font-size: 28px !important;
    }

    /* Legal aid check improvements */
    .legal-aid-check-content {
        text-align: center;
    }

    .legal-aid-check-content .title {
        font-size: 28px !important;
    }

    /* Swiper improvements */
  

    .swiper-pagination {
        bottom: 10px !important;
    }

    /* Video section improvements */
    .video-section {
        margin: 20px 0;
    }

    /* Image improvements */
    .about-img img,
    .service-item img,
    .blog-image-wrapper img,
    .lawyer-image-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 12px;
    }
}

@media (max-width: 768px) {
    /* Further mobile optimizations */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding: 30px 0 !important;
    }

    .main-headline .title {
        font-size: 24px !important;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 14px;
        text-align: center !important;
    }

    .service-item {
        padding: 20px 15px;
    }

    .service-item .title {
        font-size: 18px !important;
        min-height: auto !important;
    }

    .choose-item {
        padding: 20px 15px;
    }

    .blog-content,
    .lawyer-content {
        padding: 15px;
    }

    .blog-title,
    .lawyer-name {
        font-size: 18px !important;
    }

    .testimonial-card-modern {
        padding: 25px 20px;
    }

    .testimonial-text {
        font-size: 15px;
    }

    .how-it-works-item {
        padding: 25px 15px;
    }

    .step-title {
        font-size: 17px !important;
    }

    .mobile-app-content .title,
    .fixed-price-content .title,
    .legal-aid-check-content .title {
        font-size: 24px !important;
    }

    /* Swiper navigation */
    .swiper-button-next,
    .swiper-button-prev {
        width: 40px !important;
        height: 40px !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 16px !important;
    }
}

/* ============================================
   FINAL OVERRIDE - Force Features to Right
   ============================================ */
@media (max-width: 480px) {
    /* Small mobile optimizations */
    .why-us-area,
    .about-area,
    .service-area,
    .testimonial-area-modern,
    .lawyer-area-modern,
    .blog-area-modern,
    .how-it-works-area,
    .mobile-app-area,
    .fixed-price-area,
    .legal-aid-check-home {
        padding: 25px 0 !important;
    }

    .main-headline .title {
        font-size: 22px !important;
        text-align: center !important;
    }

    .main-headline p {
        font-size: 13px;
        text-align: center !important;
    }

    .service-item {
        padding: 18px 12px;
    }

    .service-item .title {
        font-size: 17px !important;
    }

    .service-item p {
        font-size: 13px;
    }

    .choose-item {
        padding: 18px 12px;
    }

    .blog-content,
    .lawyer-content {
        padding: 12px;
    }

    .blog-title,
    .lawyer-name {
        font-size: 17px !important;
    }

    .testimonial-card-modern {
        padding: 20px 15px;
    }

    .testimonial-text {
        font-size: 14px;
    }

    .how-it-works-item {
        padding: 20px 12px;
    }

    .step-title {
        font-size: 16px !important;
    }

    .step-description {
        font-size: 13px;
    }

    .mobile-app-content .title,
    .fixed-price-content .title,
    .legal-aid-check-content .title {
        font-size: 22px !important;
    }

    /* Swiper navigation */
    .swiper-button-next,
    .swiper-button-prev {
        width: 36px !important;
        height: 36px !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 14px !important;
    }
}

/* ============================================
   FINAL OVERRIDE - Force Buttons to Right
   ============================================ */
/* RTL Mobile Support */
@media (max-width: 991px) {
    [dir="rtl"] .main-headline {
        text-align: center !important;
    }
    
    [dir="rtl"] .main-headline .title {
        text-align: center !important;
    }
    
    [dir="rtl"] .main-headline p {
        text-align: center !important;
    }

    [dir="rtl"] .service-item,
    [dir="rtl"] .choose-item,
    [dir="rtl"] .blog-card-modern,
    [dir="rtl"] .lawyer-card-modern {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .lawyer-content {
        text-align: right;
        direction: rtl;
        align-items: flex-end;
    }

    [dir="rtl"] .lawyer-name {
        text-align: right;
    }

    [dir="rtl"] .lawyer-name a {
        text-align: right;
    }

    [dir="rtl"] .mobile-app-content,
    [dir="rtl"] .fixed-price-content,
    [dir="rtl"] .legal-aid-check-content {
        text-align: center;
    }
}
</style>
@endpush

@endsection
