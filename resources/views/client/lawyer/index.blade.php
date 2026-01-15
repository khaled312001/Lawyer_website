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




    <!--Service Start-->
    <div class="team-page pb_70">
        <div class="container">
            <div class="row">

                @if ($lawyers->count() != 0)
                    @foreach ($lawyers as $lawyer)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt_30">
                            <a href="{{ route('website.lawyer.details', $lawyer?->slug) }}" class="team-item-link aman-lawyer-link-rtl" aria-label="{{ $lawyer?->name }}">
                                <div class="team-item aman-lawyer-card-rtl">
                                    <div class="team-photo aman-lawyer-photo-rtl">
                                        <img src="{{ url($lawyer?->image ? $lawyer?->image : $setting?->default_avatar) }}"
                                            alt="{{$lawyer?->name}}" loading="lazy">
                                        <div class="team-overlay">
                                            <div class="view-profile-btn">
                                                <i class="fas fa-eye"></i>
                                                <span>{{ __('View Profile') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-text aman-lawyer-info-rtl">
                                        <h4 class="team-name aman-lawyer-name-rtl">{{ ucfirst($lawyer?->name) }}</h4>
                                        <p class="aman-lawyer-detail-rtl"><i class="fas fa-briefcase aman-icon-rtl"></i> {{ ucfirst($lawyer?->department?->name) }}</p>
                                        <p class="aman-lawyer-detail-rtl"><span><i class="fas fa-graduation-cap aman-icon-rtl"></i> {{ $lawyer?->designations }}</span></p>
                                        <p class="aman-lawyer-detail-rtl"><span><b><i class="fas fa-street-view aman-icon-rtl"></i>
                                                    {{ ucfirst($lawyer?->location?->name) }}</b></span></p>
                                        @if($lawyer->total_ratings > 0)
                                        <div class="mt-2">
                                            {!! displayStars($lawyer->average_rating) !!}
                                            <span class="ms-1" style="color: #666; font-size: 12px;">
                                                <strong>{{ number_format($lawyer->average_rating, 1) }}</strong>
                                                ({{ $lawyer->total_ratings }})
                                            </span>
                                        </div>
                                        @else
                                        <div class="mt-2">
                                            {!! displayStars(0) !!}
                                            <span class="ms-1" style="color: #999; font-size: 12px;">{{ __('No ratings') }}</span>
                                        </div>
                                        @endif
                                        <div class="team-action-icon">
                                            <i class="fas fa-arrow-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
    <!--Service End-->






@endsection
