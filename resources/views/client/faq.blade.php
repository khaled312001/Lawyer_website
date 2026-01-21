@extends('layouts.client.layout')
@php
    $seoData = seoSetting()->where('page_name', 'FaQ')->first();
    $seoTitle = $seoData?->seo_title ?? __('FAQ') . ' | ' . ($setting->app_name ?? 'LawMent');
    $seoDescription = $seoData?->seo_description ?? __('Frequently asked questions about our legal services');
    $seoImage = $setting->logo ? asset($setting->logo) : asset('client/img/logo.png');
    $currentUrl = url()->current();
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ __('FAQ, frequently asked questions, legal questions, أسئلة شائعة, استفسارات قانونية') }}">
    <meta name="robots" content="index, follow">
@endsection

@section('canonical')
    <link rel="canonical" href="{{ $currentUrl }}">
@endsection

@section('og_meta')
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $setting->app_name ?? 'LawMent' }}">
@endsection

@section('twitter_meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
@endsection

@section('structured_data')
    @php
        $mainEntity = [];
        
        if ($faqCategories && $faqCategories->count() > 0) {
            foreach ($faqCategories as $category) {
                if ($category->faq_list && $category->faq_list->count() > 0) {
                    foreach ($category->faq_list as $faq) {
                        $question = $faq->question ?? '';
                        $answer = !empty($faq->answer) ? strip_tags($faq->answer) : '';
                        
                        if (!empty($question) && !empty($answer)) {
                            $mainEntity[] = [
                                '@type' => 'Question',
                                'name' => $question,
                                'acceptedAnswer' => [
                                    '@type' => 'Answer',
                                    'text' => $answer
                                ]
                            ];
                        }
                    }
                }
            }
        }
        
        $faqData = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($faqData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "{{ __('Home') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ url('/') }}",
                    "name": "{{ __('Home') }}"
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ __('FAQ') }}",
                "item": {
                    "@type": "WebPage",
                    "@id": "{{ $currentUrl }}",
                    "name": "{{ __('FAQ') }}"
                }
            }
        ]
    }
    </script>
@endsection

@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('FAQ') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('FAQ') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Faq Start-->
    <div class="faq-area pt_100 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="faq_page_item">
                        <h2>{{__('Frequently asked question')}}</h2>
                        <div class="faq-service feature-section-text">
                            <div class="feature-accordion" id="accordion">
                                @foreach ($faqCategories as $index => $category)
                                    @if ($category->faq_list->count() != 0)
                                        <div class="faq-single-item">
                                            <h2>{{ $category?->title }}</h2>
                                            @foreach ($category->faq_list as $faq)
                                                <div class="faq-item card">
                                                    <div class="faq-header" id="heading->{{ $faq?->id }}">
                                                        <button class="faq-button collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-{{ $faq?->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse-{{ $faq?->id }}">{{ $faq?->question }}</button>
                                                    </div>
                                                    <div id="collapse-{{ $faq?->id }}" class="collapse"
                                                        aria-labelledby="heading->{{ $faq?->id }}"
                                                        data-bs-parent="#accordion">
                                                        <div class="faq-body">
                                                            {!! $faq?->answer !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="faq_img">
                        <img src="{{asset($faq_page?->image)}}" alt="{{ __('FAQ') }}" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Faq End-->
@endsection
