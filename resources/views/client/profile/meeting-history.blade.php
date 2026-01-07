@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Meeting History') }}</title>
@endsection
@section('client-content')
    <!--Banner Start-->
    <div class="banner-area flex"
        style="background-image:url({{ $setting?->breadcrumb_image ? url($setting?->breadcrumb_image) : '' }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ __('Meeting History') }}</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><span>{{ __('Meeting History') }}</span></li>
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
                    <div class="detail-dashboard">
                        <h2 class="d-headline">{{ __('Meeting History') }}</h2>
                        
                        @if($meetingsByDepartment->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>{{ __('No meeting history found.') }}
                            </div>
                        @else
                            @foreach($meetingsByDepartment as $departmentId => $meetings)
                                @php
                                    $department = $meetings->first()->lawyer->department ?? null;
                                    $departmentName = $department ? $department->name : __('No Department');
                                @endphp
                                
                                <div class="department-meetings-section mb-5">
                                    <div class="department-header mb-3">
                                        <h3 class="department-title">
                                            <i class="fas fa-building me-2"></i>{{ $departmentName }}
                                            <span class="badge bg-primary ms-2">{{ $meetings->count() }}</span>
                                        </h3>
                                    </div>
                                    
                                    <div class="table_border">
                                        <div class="table-responsive">
                                            <table class="coustom-dashboard dashboard-table display table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('SN') }}</th>
                                                        <th>{{ __('Lawyer') }}</th>
                                                        <th>{{ __('Time') }}</th>
                                                        <th>{{ __('Duration') }}</th>
                                                        <th>{{ __('Meeting ID') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($meetings as $index => $meeting)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $meeting->lawyer->name }}</td>
                                                            <td>{{ staticFormattedDateTime($meeting->meeting_time) }}</td>
                                                            <td>{{ $meeting->duration }} {{ __('Minutes') }}</td>
                                                            <td>{{ $meeting->meeting->meeting_id ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Dashboard End-->
@endsection
