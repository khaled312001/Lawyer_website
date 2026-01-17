@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Lawyers')->first()?->seo_title ?? 'Lawyers | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'Lawyers')->first()?->seo_description ?? 'Lawyers | LawMent' }}">
@endsection
@section('client-content')

    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Lawyers ') }}</h1>
                        <ul>
                            <li><a aria-label="{{ __('Home') }}" href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Lawyers ') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <div class="lawyer-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="s-container">
                        <form action="{{ route('website.search.lawyer') }}">
                            <div class="s-box">
                                <select name="location" class="form-control select2">
                                    <option value="">{{ __('Select Location') }}</option>
                                    @foreach ($locations as $location)
                                        <option {{ @$location_id == $location?->id ? 'selected' : '' }}
                                            value="{{ $location?->id }}">{{ ucwords($location?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-box">
                                <select name="department" class="form-control select2">
                                    <option value="">{{ __('Select Department') }}</option>
                                    @foreach ($departments as $department)
                                        <option {{ @$department_id == $department?->id ? 'selected' : '' }}
                                            value="{{ $department?->id }}">{{ ucwords($department?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-box">
                                <select name="lawyer" class="form-control select2">
                                    <option value="">{{ __('Select Lawyer') }}</option>
                                    @foreach ($lawyersForSearch as $lawyer)
                                        <option {{ @$lawyer_id == $lawyer->id ? 'selected' : '' }}
                                            value="{{ $lawyer?->id }}">
                                            {{ ucwords($lawyer?->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="s-button">
                                <button type="submit">{{ __('Search') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Lawyers List Start-->
    <div class="team-page pb_70">
        <div class="container">
            <div class="row">
                @if ($lawyers->count() != 0)
                    @foreach ($lawyers as $lawyer)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt_30">
                            <div class="lawyer-card-mobile aman-lawyer-card-mobile-rtl">
                                <div class="lawyer-card-image-mobile">
                                    <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                        <img src="{{ url($lawyer?->image ? $lawyer?->image : $setting?->default_avatar) }}"
                                            alt="{{ $lawyer?->name }}" loading="lazy">
                                    </a>
                                </div>
                                <div class="lawyer-card-content-mobile">
                                    <h3 class="lawyer-card-name-mobile">
                                        <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ $lawyer?->name }}">
                                            {{ ucfirst($lawyer?->name) }}
                                        </a>
                                    </h3>
                                    <div class="lawyer-card-meta-mobile">
                                        @if($lawyer->department)
                                        <div class="lawyer-meta-item-mobile">
                                            <i class="fas fa-briefcase lawyer-meta-icon-mobile"></i>
                                            <span class="lawyer-meta-text-mobile">{{ ucfirst($lawyer->department->name) }}</span>
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
                                    @if($lawyer->total_ratings > 0)
                                    <div class="lawyer-card-rating-mobile">
                                        <span class="lawyer-rating-text-mobile">
                                            <strong>{{ number_format($lawyer->average_rating, 1) }}</strong>
                                            ({{ $lawyer->total_ratings }})
                                        </span>
                                        <div class="lawyer-rating-stars-mobile">{!! displayStars($lawyer->average_rating) !!}</div>
                                    </div>
                                    @else
                                    <div class="lawyer-card-rating-mobile">
                                        <span class="lawyer-rating-text-mobile no-rating">{{ __('No ratings') }}</span>
                                        <div class="lawyer-rating-stars-mobile">{!! displayStars(0) !!}</div>
                                    </div>
                                    @endif
                                    <a class="lawyer-card-button-mobile" href="{{ route('website.lawyer.details', $lawyer?->slug) }}" aria-label="{{ __('View Profile') }}">
                                        <i class="fas fa-arrow-left lawyer-button-icon-mobile"></i>
                                        <span class="lawyer-button-text-mobile">{{ __('View Profile') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-danger text-center mt-5">{{ __('Lawyer Not Found') }}</h3>
                @endif
            </div>
            @if ($lawyers->hasPages())
                {{ $lawyers->links('client.paginator') }}
            @endif
        </div>
    </div>
    <!--Lawyers List End-->

@endsection
