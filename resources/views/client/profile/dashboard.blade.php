@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Dashboard') }}</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Dashboard') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Dashboard Start-->
    <div class="dashboard-area pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('client.profile.sidebar')
                </div>
                <div class="col-lg-9">
                    <!-- Dashboard Stats Cards -->
                    <div class="detail-dashboard pb-0 pt-4 px-4 mb-4">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="dash-item db-yellow flex shadow-sm">
                                    <div class="dash-item-icon">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <div class="dash-item-content">
                                        <h2 class="mb-1">{{ $orders->count() }}</h2>
                                        <h4 class="mb-0">{{ __('Total Order') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="dash-item db-red flex shadow-sm">
                                    <div class="dash-item-icon">
                                        <i class="fas fa-hourglass-start"></i>
                                    </div>
                                    <div class="dash-item-content">
                                        <h2 class="mb-1">{{ $appointments->where('payment_status', 0)->count() }}</h2>
                                        <h4 class="mb-0">{{ __('Pending Appointment') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="dash-item db-blue flex shadow-sm">
                                    <div class="dash-item-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="dash-item-content">
                                        <h2 class="mb-1">{{ $appointments->count() }}</h2>
                                        <h4 class="mb-0">{{ __('Total Appointment') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile_info_area">
                        <div class="wsus__profile_info profile_info detail-dashboard shadow-sm">
                            <div class="wsus__profile_info_top d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <h2 class="d-headline mb-0">{{ __('Personal Information') }}</h2>
                                <a href="javascript:;" class="edit_btn edit_profile btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i>{{ __('Edit info') }}
                                </a>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Name') }}:</span>
                                        <span class="profile-info-value">{{ $user?->name ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Phone') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->phone ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Email') }}:</span>
                                        <span class="profile-info-value text-lowercase">{{ $user?->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Gender') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->gender ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Date Of Birth') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->date_of_birth ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Occupation') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->occupation ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Age') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->age ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Country') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->country ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('City') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->city ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">{{ __('Address') }}:</span>
                                        <span class="profile-info-value">{{ $user?->details?->address ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-dashboard add-form profile_edit_area mt_4 shadow-sm">
                            <div class="wsus__profile_info_top d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <h2 class="d-headline mb-0">{{ __('My Profile') }}</h2>
                                <a href="javascript:;" class="edit_btn del_btn btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>{{ __('Cancel') }}
                                </a>
                            </div>
                            <form action="{{ route('client.update.profile') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label for="name">{{ __('Name') }} <span>*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user?->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">{{ __('Email') }} <span>*</span></label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $user?->email }}" readonly>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Phone ') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $user?->details?->phone }}">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Age') }}<span>*</span></label>
                                        <input type="number" class="form-control" name="age"
                                            value="{{ $user?->details?->age }}">

                                    </div>
                                    <div class="form-group col-md-6 option-item">
                                        <label for="">{{ __('Date Of Birth') }} </label>
                                        <input type="text" class="form-control datepicker2" name="date_of_birth"
                                            value="{{ $user?->details?->date_of_birth }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Occupation') }}<span>*</span></label>
                                        <input type="text" class="form-control" name="occupation"
                                            value="{{ $user?->details?->occupation }}">

                                    </div>
                                    <div class="form-group col-md-6 option-item">
                                        <label for="">{{ __('Gender') }} <span>*</span></label>
                                        <select class="form-control" name="gender">
                                            <option value="">{{ __('Select gender') }}</option>
                                            <option {{ $user?->details?->gender == 'male' ? 'selected' : '' }}
                                                value="male">
                                                {{ __('Male') }}</option>
                                            <option {{ $user?->details?->gender == 'female' ? 'selected' : '' }}
                                                value="female">
                                                {{ __('Female') }}</option>
                                            <option {{ $user?->details?->gender == 'others' ? 'selected' : '' }}
                                                value="others">
                                                {{ __('Others') }}</option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Guardian Name') }}</label>
                                        <input type="text" class="form-control" name="guardian_name"
                                            value="{{ $user?->details?->guardian_name }}">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Guardian Phone') }}</label>
                                        <input type="text" class="form-control" name="guardian_phone"
                                            value="{{ $user?->details?->guardian_phone }}">

                                    </div>
                                    <div class="form-group col-md-6 option-item">
                                        <label for="">{{ __('Country') }} <span>*</span></label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ $user?->details?->country }}">

                                    </div>
                                    <div class="form-group col-md-6 option-item">
                                        <label for="">{{ __('City') }} <span>*</span></label>
                                        <input type="text" name="city" placeholder="{{ __('City') }}" class="form-control"
                                            value="{{ $user?->details?->city }}">

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Photo') }} <code>({{ __('Recommended') }}: 400X400 PX)</code></label>
                                        <input type="file" class="form-control" name="image">
                                        <input type="hidden" name="old_image" value="{{ $user?->image }}">

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="">{{ __('Address') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $user?->details?->address }}">

                                    </div>

                                    <div class="form-group col-md-12 mb-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>{{ __('Update') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Dashboard End-->
@endsection

@push('css')
<style>
    /* Improved Dashboard Design */
    .dash-item {
        transition: all 0.3s ease;
        border-radius: 12px;
        padding: 25px;
        position: relative;
        overflow: hidden;
    }
    
    .dash-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }
    
    .dash-item-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: #fff !important;
        opacity: 1 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .dash-item-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .dash-item-content h4 {
        font-size: 1rem;
        font-weight: 500;
        color: rgba(255,255,255,0.95) !important;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .profile-info-item {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .profile-info-item:last-child {
        border-bottom: none;
    }
    
    .profile-info-label {
        font-weight: 600;
        color: #555 !important;
        display: inline-block;
        min-width: 120px;
        margin-bottom: 5px;
    }
    
    .profile-info-value {
        color: #333 !important;
        font-weight: 400;
    }
    
    .detail-dashboard {
        border-radius: 12px;
        background: #fff;
        padding: 30px;
    }
    
    .wsus__profile_info_top {
        margin-bottom: 25px;
    }
    
    .wsus__profile_info_top .d-headline {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--colorPrimary, #6b5d47) !important;
    }
    
    @media (max-width: 768px) {
        .dash-item {
            padding: 20px;
        }
        
        .dash-item-icon {
            font-size: 2rem;
        }
        
        .dash-item-content h2 {
            font-size: 2rem;
        }
        
        .profile-info-label {
            min-width: 100%;
            display: block;
            margin-bottom: 5px;
        }
        
        .detail-dashboard {
            padding: 20px;
        }
    }
</style>
@endpush
