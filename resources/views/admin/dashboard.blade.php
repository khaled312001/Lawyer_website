@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        @if (checkAdminHasPermission('dashboard.view'))
            {{-- Show Credentials Setup Alert --}}
            <div class="row position-relative">
                @if (Route::is('admin.dashboard') && ($checkCredentials = checkCredentials()))
                    @foreach ($checkCredentials as $checkCredential)
                        @if ($checkCredential->status)
                            <div
                                class="alert alert-danger alert-has-icon alert-dismissible position-absolute w-100 missingCrentialsAlert">
                                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">{{ $checkCredential->message }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                                    {{ $checkCredential->description }} <b><a class="btn btn-sm btn-outline-warning"
                                            href="{{ !empty($checkCredential->route) ? route($checkCredential->route) : url($checkCredential->url) }}">{{ __('Update') }}</a></b>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>    

            @if ($setting->is_queable == 'active' && Cache::get('corn_working') !== 'working')
                <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                    <div class="alert-icon"><i class="fas fa-sync"></i></div>
                    <div class="alert-body">
                        <div class="alert-title"><a href="{{ route('admin.email-configuration') }}" target="_blank"
                                rel="noopener noreferrer">{{ __('Corn Job Is Not Running! Many features will be disabled and face errors') }}</a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif
        @endif
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Dashboard') }}" />
            @if (checkAdminHasPermission('dashboard.view'))
                <div class="section-body">
                    <div class="row">
                        <!-- New Appointment -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Appointment') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $new_appointment_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Orders -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Pending Orders') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $pending_orders_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Success Appointment -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Successful Appointment') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $success_appointment_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Client -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Client') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $client_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Lawyer  -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Lawyer') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $lawyer_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings Monthly -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Earnings') }} ({{ __('Monthly') }})</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($monthlyEarning) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings Total -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Earnings') }} ({{ __('Total') }})</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($totalEarning) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings Subscriber -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-dark">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Subscriber') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $subscriber_qty ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Real Estate Statistics Row -->
                    <div class="row">
                        <!-- Total Properties -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Properties') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_properties ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Active Properties -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Active Properties') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $active_properties ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Featured Properties -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Featured Properties') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $featured_properties ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sold/Rented Properties -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Sold/Rented') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $sold_rented_properties ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Inquiries -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-secondary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Inquiries') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_inquiries ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Inquiries -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Inquiries') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $new_inquiries ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Inquiries -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Pending Inquiries') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $pending_inquiries ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Closed Inquiries -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Closed Inquiries') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $closed_inquiries ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tables Row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Pending Orders') }}</h4>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Phone') }}</th>
                                                    <th>{{ __('Date') }}</th>
                                                    <th>{{ __('Payment') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pending_orders as $index => $pending_order)
                                                    <tr>
                                                        <td>{{ ++$index }}</td>
                                                        <td>{{ $pending_order?->user?->name }}</td>
                                                        <td>{{ $pending_order?->user?->email }}</td>
                                                        <td>{{ $pending_order?->user?->details?->phone }}</td>
                                                        <td>{{ formattedDate($pending_order?->created_at) }}</td>
                                                        </td>
                                                        <td>
                                                            @if ($pending_order->payment_status == 0)
                                                                <span
                                                                    class="badge bg-danger">{{ __('Pending') }}</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-success">{{ __('Success') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.order', $pending_order?->order_id) }}"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <x-empty-table :name="__('')" route="" create="no"
                                                        :message="__('No data found!')" colspan="7" />
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Lawyer Payment In') }} {{ date('F, Y') }}</h4>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Phone') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($payment_histories as $index => $payment)
                                                    <tr>
                                                        <td>{{ ++$index }}</td>
                                                        <td>{{ $payment?->lawyer?->name }}</td>
                                                        <td>{{ $payment?->lawyer?->email }}</td>
                                                        <td>{{ $payment?->lawyer?->phone }}</td>
                                                        <td>{{ currency($payment?->total_payment_fee) }}</td>
                                                    </tr>
                                                @empty
                                                    <x-empty-table :name="__('')" route="" create="no"
                                                        :message="__('No data found!')" colspan="5" />
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (request()->get('par-page') !== 'all')
                                        <div class="float-right">
                                            {{ $payment_histories->onEachSide(0)->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Properties and Inquiries Tables -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Recent Properties') }}</h4>
                                    <div class="card-header-action">
                                        <a href="{{ route('admin.real-estate.index') }}" class="btn btn-primary btn-sm">{{ __('View All') }}</a>
                                    </div>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Property') }}</th>
                                                    <th>{{ __('Type') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($recent_properties ?? [] as $property)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm me-3">
                                                                    <img src="{{ $property->main_image_url }}" alt="{{ $property->title }}" class="rounded">
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">{{ Str::limit($property->title, 20) }}</div>
                                                                    <small class="text-muted">{{ $property->location_string }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $property->property_type_label }}</td>
                                                        <td>{{ $property->formatted_price }}</td>
                                                        <td>
                                                            @if($property->status === 'active')
                                                                <span class="badge bg-success">{{ __('Active') }}</span>
                                                            @elseif($property->status === 'inactive')
                                                                <span class="badge bg-secondary">{{ __('Inactive') }}</span>
                                                            @elseif($property->status === 'sold')
                                                                <span class="badge bg-info">{{ __('Sold') }}</span>
                                                            @elseif($property->status === 'rented')
                                                                <span class="badge bg-primary">{{ __('Rented') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">{{ __('No properties found') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Recent Inquiries') }}</h4>
                                    <div class="card-header-action">
                                        <a href="{{ route('admin.real-estate.inquiries.index') }}" class="btn btn-primary btn-sm">{{ __('View All') }}</a>
                                    </div>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Client') }}</th>
                                                    <th>{{ __('Property') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($recent_inquiries ?? [] as $inquiry)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div class="font-weight-bold">{{ $inquiry->name }}</div>
                                                                <small class="text-muted">{{ $inquiry->phone }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="font-weight-bold">{{ Str::limit($inquiry->realEstate?->title ?? 'N/A', 20) }}</div>
                                                            <small class="text-muted">{{ $inquiry->realEstate?->location_string ?? '' }}</small>
                                                        </td>
                                                        <td>
                                                            @if($inquiry->status === 'new')
                                                                <span class="badge bg-danger">{{ __('New') }}</span>
                                                            @elseif($inquiry->status === 'pending')
                                                                <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                            @elseif($inquiry->status === 'contacted')
                                                                <span class="badge bg-info">{{ __('Contacted') }}</span>
                                                            @elseif($inquiry->status === 'closed')
                                                                <span class="badge bg-success">{{ __('Closed') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ formattedDate($inquiry->created_at) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">{{ __('No inquiries found') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col">
                            <div class="mb-4 shadow card">
                                <!-- Card Header - Dropdown -->
                                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"> {{ __('Earnings In') }}
                                        {{ request()->has('year') && request()->has('month') ? Carbon\Carbon::createFromFormat('Y-m', request('year') . '-' . request('month'))->format('F, Y') : date('F, Y') }}
                                    </h6>
                                    <div class="form-inline">
                                        <form method="get" onchange="$(this).trigger('submit');">
                                            <select name="year" id="year" class="form-control">
                                                @php
                                                    $currentYear = Carbon\Carbon::now()->year;
                                                    $currentMonth = Carbon\Carbon::now()->month;
                                                    $selectYear = request('year') ?? $currentYear;
                                                    $selectMonth = request('month') ?? $currentMonth;
                                                @endphp
                                                @for ($i = $oldestYear; $i <= $latestYear; $i++)
                                                    <option value="{{ $i }}" @selected($selectYear == $i)>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                            <select name="month" id="month" class="form-control">
                                                @php
                                                    for ($month = 1; $month <= 12; $month++) {
                                                        $monthNumber = str_pad($month, 2, '0', STR_PAD_LEFT);
                                                        $monthName = Carbon\Carbon::createFromFormat(
                                                            'm',
                                                            $month,
                                                        )->format('M');
                                                        echo '<option value="' .
                                                            $monthNumber .
                                                            '" ' .
                                                            ($selectMonth == $monthNumber ? 'selected' : '') .
                                                            '>' .
                                                            $monthName .
                                                            '</option>';
                                                    }
                                                @endphp
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection

@push('css')
<style>
    /* تحسين تصميم لوحة التحكم */
    .card-statistic-1 {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        background: #fff;
    }

    .card-statistic-1:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .card-statistic-1 .card-icon {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-statistic-1:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .card-statistic-1 .card-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 100%);
    }

    .card-statistic-1 .card-icon i {
        font-size: 28px;
        color: #fff;
        z-index: 1;
        position: relative;
    }

    /* تحسين الألوان مع تدرجات */
    .card-statistic-1 .card-icon.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card-statistic-1 .card-icon.bg-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .card-statistic-1 .card-icon.bg-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .card-statistic-1 .card-icon.bg-danger {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .card-statistic-1 .card-icon.bg-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .card-statistic-1 .card-icon.bg-dark {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
    }

    .card-statistic-1 .card-icon.bg-secondary {
        background: linear-gradient(135deg, #8e9eab 0%, #eef2f3 100%);
    }

    .card-statistic-1 .card-wrap {
        padding: 20px;
    }

    .card-statistic-1 .card-header h4 {
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-statistic-1 .card-body {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.2;
        margin-top: 5px;
    }

    /* تحسين الجداول */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 12px 12px 0 0;
        padding: 20px;
        border: none;
    }

    .card-header h4 {
        color: #fff;
        font-weight: 600;
        margin: 0;
        font-size: 18px;
    }

    .card-header-action .btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        transition: all 0.3s ease;
    }

    .card-header-action .btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
        padding: 15px;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    /* تحسين الرسم البياني */
    .chart-area {
        position: relative;
        height: 400px;
        padding: 20px;
    }

    /* تحسين الأزرار */
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 8px 16px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    /* تحسين الـ badges */
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* تحسين التنبيهات */
    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* تحسين الصور في الجداول */
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
    }

    /* تحسين الـ breadcrumb */
    .section-header {
        margin-bottom: 30px;
    }

    /* تحسين المسافات */
    .row {
        margin-bottom: 25px;
    }

    .row:last-child {
        margin-bottom: 0;
    }

    /* تحسين الاستجابة للشاشات الصغيرة */
    @media (max-width: 768px) {
        .card-statistic-1 .card-body {
            font-size: 24px;
        }

        .card-statistic-1 .card-icon {
            width: 60px;
            height: 60px;
            margin: 10px;
        }

        .card-statistic-1 .card-icon i {
            font-size: 24px;
        }
    }

    /* تحسين الألوان للوضع الليلي (اختياري) */
    @media (prefers-color-scheme: dark) {
        .card-statistic-1 {
            background: #1e1e1e;
        }

        .card-statistic-1 .card-header h4 {
            color: #adb5bd;
        }

        .card-statistic-1 .card-body {
            color: #fff;
        }
    }

    /* تحسين الرسوم المتحركة */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-statistic-1 {
        animation: fadeInUp 0.5s ease-out;
    }

    .card-statistic-1:nth-child(1) { animation-delay: 0.1s; }
    .card-statistic-1:nth-child(2) { animation-delay: 0.2s; }
    .card-statistic-1:nth-child(3) { animation-delay: 0.3s; }
    .card-statistic-1:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@push('js')
    @if (checkAdminHasPermission('dashboard.view'))
        <script src="{{ asset('backend/chart.js/chart.umd.min.js') }}"></script>
        <script>
            (function($) {
                "use strict";
                // Area Chart Example
                $(document).ready(function() {

                    var bData = @json($monthly_data);
                    var jData = JSON.parse(bData);

                    var ctx = document.getElementById("myAreaChart");
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13",
                                "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25",
                                "26", "27", "28", "29", "30", "31"
                            ],
                            datasets: [{
                                label: "{{ __('Earnings') }}",
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: jData,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                x: {
                                    time: {
                                        unit: 'date'
                                    },
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 7
                                    }
                                },
                                y: {
                                    ticks: {
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return '{{ session()->get('currency_icon') }}' +
                                                number_format(value);
                                        }
                                    },
                                    grid: {
                                        color: "rgb(234, 236, 244)",
                                        borderColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        borderDashOffset: 0
                                    }
                                }
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex]
                                            .label || '';
                                        return datasetLabel +
                                            ': {{ session()->get('currency_icon') }}' +
                                            number_format(tooltipItem.yLabel);
                                    }
                                }
                            }
                        }
                    });
                });
            })(jQuery);
        </script>
        
        <script>
            // JavaScript number_format function
            function number_format(number, decimals, dec_point, thousands_sep) {
                decimals = decimals !== undefined ? decimals : 2;
                dec_point = dec_point !== undefined ? dec_point : '.';
                thousands_sep = thousands_sep !== undefined ? thousands_sep : ',';
                
                number = parseFloat(number);
                if (isNaN(number)) return '0';
                
                var negative = number < 0;
                number = Math.abs(number);
                
                var s = number.toFixed(decimals);
                var parts = s.split('.');
                var integerPart = parts[0];
                var decimalPart = parts.length > 1 ? dec_point + parts[1] : '';
                
                if (thousands_sep) {
                    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
                }
                
                return (negative ? '-' : '') + integerPart + decimalPart;
            }
        </script>
    @endif
@endpush
