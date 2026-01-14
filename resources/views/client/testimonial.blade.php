@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Testimonial')->first()?->seo_title ?? 'Testimonial | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'Testimonial')->first()?->seo_description ?? 'Testimonial | LawMent' }}">
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Testimonials') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Testimonials') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Testimonial Start-->
    <div class="testimonial-page pt_70 pb_100">
        <div class="container">
            <div class="row testimonial-grid">
                @foreach ($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="testimonial-item mt_30">
                            <div class="testimonial-content-wrapper">
                                <div class="testimonial-quote-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                                <p class="testimonial-text">
                                    {{ $testimonial?->comment }}
                                </p>
                                <div class="testi-info">
                                    <div class="testi-image-wrapper">
                                        <img src="{{ url($testimonial?->image) }}" alt="{{ $testimonial?->name }}" loading="lazy">
                                    </div>
                                    <div class="testi-details">
                                        <h4 class="title">{{ $testimonial?->name }}</h4>
                                        <span class="designation">{{ $testimonial?->designation }}</span>
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
                            <div class="testi-link">
                                <a href="javascript:void;"></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if ($testimonials->hasPages())
                {{ $testimonials->links('client.paginator') }}
            @endif
        </div>
    </div>
    <!--Testimonial End-->
@endsection

@push('css')
<style>
/* ============================================
   TESTIMONIAL PAGE - ENHANCED DESIGN
   ============================================ */

.testimonial-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
}

.testimonial-grid {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
}

.testimonial-grid > [class*="col-"] {
    display: flex;
    flex-direction: column;
}

.testimonial-item {
    position: relative;
    display: flex;
    flex-direction: column;
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    padding: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    height: 100%;
    min-height: 400px;
    background-image: none;
}

.testimonial-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    transform: scaleX(0);
    transition: transform 0.4s ease;
    z-index: 1;
}

.testimonial-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(200, 180, 126, 0.2);
    border-color: var(--colorPrimary);
}

.testimonial-item:hover::before {
    transform: scaleX(1);
}

.testimonial-content-wrapper {
    padding: 40px 35px 35px 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
}

.testimonial-quote-icon {
    position: absolute;
    top: 25px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(200, 180, 126, 0.1) 0%, rgba(200, 180, 126, 0.05) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s ease;
    z-index: 1;
}

[dir="rtl"] .testimonial-quote-icon {
    right: auto;
    left: 30px;
}

.testimonial-quote-icon i {
    font-size: 24px;
    color: var(--colorPrimary);
    transition: all 0.4s ease;
}

.testimonial-item:hover .testimonial-quote-icon {
    background: linear-gradient(135deg, var(--colorPrimary) 0%, var(--colorSecondary) 100%);
    transform: rotate(15deg) scale(1.1);
}

.testimonial-item:hover .testimonial-quote-icon i {
    color: #ffffff;
}

.testimonial-text {
    font-size: 17px;
    line-height: 1.8;
    color: #4f5b6d;
    font-style: italic;
    margin: 0 0 30px 0;
    flex-grow: 1;
    position: relative;
    padding-top: 20px;
    text-align: justify;
}

[dir="rtl"] .testimonial-text {
    text-align: right;
}

.testimonial-text::before {
    content: '"';
    position: absolute;
    left: -10px;
    top: -5px;
    font-size: 70px;
    color: var(--colorPrimary);
    opacity: 0.15;
    font-family: Georgia, serif;
    line-height: 1;
    font-weight: 900;
}

[dir="rtl"] .testimonial-text::before {
    left: auto;
    right: -10px;
}

.testi-info {
    margin-top: auto;
    padding-top: 25px;
    border-top: 2px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-shrink: 0;
}

[dir="rtl"] .testi-info {
    flex-direction: row-reverse;
}

.testi-image-wrapper {
    position: relative;
    flex-shrink: 0;
}

.testi-info img {
    width: 70px !important;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--colorPrimary);
    box-shadow: 0 4px 15px rgba(200, 180, 126, 0.2);
    transition: all 0.4s ease;
}

.testimonial-item:hover .testi-info img {
    transform: scale(1.1);
    border-color: var(--colorSecondary);
    box-shadow: 0 6px 20px rgba(200, 180, 126, 0.3);
}

.testi-details {
    flex: 1;
    min-width: 0;
}

.testi-info .title {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 5px 0;
    transition: color 0.3s ease;
}

.testimonial-item:hover .testi-info .title {
    color: var(--colorPrimary);
}

.testi-info .designation {
    font-size: 14px;
    color: #666;
    display: block;
    margin: 0;
}

.testimonial-rating {
    display: flex;
    gap: 4px;
    margin-top: 20px;
    justify-content: center;
    flex-shrink: 0;
}

.testimonial-rating i {
    color: #ffc107;
    font-size: 16px;
    transition: all 0.3s ease;
}

.testimonial-item:hover .testimonial-rating i {
    transform: scale(1.2);
    color: #ff9800;
}

.testi-link {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 0 50px 50px;
    border-color: transparent transparent var(--colorPrimary) transparent;
    opacity: 0;
    transition: all 0.4s ease;
    z-index: 2;
}

[dir="rtl"] .testi-link {
    right: auto;
    left: 0;
    border-width: 0 50px 50px 0;
    border-color: transparent var(--colorPrimary) transparent transparent;
}

.testimonial-item:hover .testi-link {
    opacity: 1;
}

.testi-link:hover {
    border-color: transparent transparent var(--colorSecondary) transparent;
}

[dir="rtl"] .testi-link:hover {
    border-color: transparent var(--colorSecondary) transparent transparent;
}

/* Responsive Design */
@media (max-width: 992px) {
    .testimonial-content-wrapper {
        padding: 35px 30px 30px 30px;
    }

    .testimonial-quote-icon {
        width: 55px;
        height: 55px;
        top: 20px;
        right: 25px;
    }

    [dir="rtl"] .testimonial-quote-icon {
        right: auto;
        left: 25px;
    }

    .testimonial-quote-icon i {
        font-size: 22px;
    }

    .testimonial-text {
        font-size: 16px;
        padding-top: 15px;
    }

    .testi-info img {
        width: 65px !important;
        height: 65px;
    }
}

@media (max-width: 768px) {
    .testimonial-item {
        min-height: 350px;
    }

    .testimonial-content-wrapper {
        padding: 30px 25px 25px 25px;
    }

    .testimonial-quote-icon {
        width: 50px;
        height: 50px;
        top: 15px;
        right: 20px;
    }

    [dir="rtl"] .testimonial-quote-icon {
        right: auto;
        left: 20px;
    }

    .testimonial-quote-icon i {
        font-size: 20px;
    }

    .testimonial-text {
        font-size: 15px;
        margin-bottom: 25px;
    }

    .testi-info {
        padding-top: 20px;
        gap: 15px;
    }

    .testi-info img {
        width: 60px !important;
        height: 60px;
    }

    .testi-info .title {
        font-size: 17px;
    }

    .testi-info .designation {
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .testimonial-item {
        min-height: 320px;
    }

    .testimonial-content-wrapper {
        padding: 25px 20px 20px 20px;
    }

    .testimonial-quote-icon {
        width: 45px;
        height: 45px;
        top: 12px;
        right: 15px;
    }

    [dir="rtl"] .testimonial-quote-icon {
        right: auto;
        left: 15px;
    }

    .testimonial-quote-icon i {
        font-size: 18px;
    }

    .testimonial-text {
        font-size: 14px;
        margin-bottom: 20px;
        padding-top: 10px;
    }

    .testimonial-text::before {
        font-size: 60px;
        left: -8px;
        top: -8px;
    }

    [dir="rtl"] .testimonial-text::before {
        left: auto;
        right: -8px;
    }

    .testi-info {
        padding-top: 15px;
        gap: 12px;
    }

    .testi-info img {
        width: 55px !important;
        height: 55px;
    }

    .testi-info .title {
        font-size: 16px;
    }

    .testi-info .designation {
        font-size: 12px;
    }

    .testimonial-rating {
        margin-top: 15px;
    }

    .testimonial-rating i {
        font-size: 14px;
    }
}

/* Equal Height JavaScript Support */
.testimonial-grid .testimonial-item {
    height: 100%;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .testimonial-item,
    .testimonial-quote-icon,
    .testi-info img,
    .testimonial-rating i {
        transition: none !important;
    }

    .testimonial-item:hover {
        transform: none;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .testimonial-item {
        border: 2px solid #000;
    }

    .testimonial-item:hover {
        border-color: #000;
    }
}
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Equalize testimonial cards height
    function equalizeTestimonialCards() {
        const cards = document.querySelectorAll('.testimonial-item');
        if (cards.length === 0) return;
        
        // Reset heights
        cards.forEach(card => {
            card.style.height = 'auto';
        });
        
        // Find max height
        let maxHeight = 0;
        cards.forEach(card => {
            const height = card.offsetHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        
        // Apply max height to all cards
        cards.forEach(card => {
            card.style.height = maxHeight + 'px';
        });
    }
    
    // Equalize on load and resize
    if (document.querySelector('.testimonial-item')) {
        // Wait for images to load
        const images = document.querySelectorAll('.testimonial-item img');
        let imagesLoaded = 0;
        
        if (images.length > 0) {
            images.forEach(img => {
                if (img.complete) {
                    imagesLoaded++;
                } else {
                    img.addEventListener('load', function() {
                        imagesLoaded++;
                        if (imagesLoaded === images.length) {
                            setTimeout(equalizeTestimonialCards, 100);
                        }
                    });
                }
            });
            
            if (imagesLoaded === images.length) {
                setTimeout(equalizeTestimonialCards, 100);
            }
        } else {
            setTimeout(equalizeTestimonialCards, 100);
        }
        
        window.addEventListener('resize', function() {
            setTimeout(equalizeTestimonialCards, 100);
        });
    }
});
</script>
@endpush
@endsection
