@extends('lawyer.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Dashboard') }}" />

            <!-- Notifications Button -->
            <div class="mb-3 d-flex justify-content-end">
                <div class="dropdown">
                    <a href="javascript:;" data-bs-toggle="dropdown" class="btn btn-primary position-relative notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge badge bg-danger" id="lawyer-dashboard-notification-count" style="display: none; position: absolute; top: -5px; right: -5px; border-radius: 50%; padding: 2px 6px; font-size: 10px;">0</span>
                        <span class="ms-2">{{ __('Notifications') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu" style="width: 350px; max-height: 400px; overflow-y: auto;">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ __('Notifications') }}</h6>
                            <a href="javascript:;" class="text-primary small mark-all-read-dashboard" style="text-decoration: none;">{{ __('Mark all as read') }}</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div id="lawyer-dashboard-notifications-list">
                            <div class="text-center p-3">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-footer text-center">
                            <a href="{{ route('lawyer.notifications.index') }}" class="text-primary small" style="text-decoration: none;">{{ __('View all notifications') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                        <!-- Today Appointment -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Today Appointment') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ count($today_appointment)}}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        {{ $new_appointment ?? 0 }}
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
                                        {{ $success_appointment ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
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
                </div>
                @use('Carbon\Carbon', 'Carbon')
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col">
                            <div class="mb-4 shadow card">
                                <!-- Card Header - Dropdown -->
                                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"> {{ __('Earnings In') }}
                                        {{ request()->has('year') && request()->has('month') ? Carbon::createFromFormat('Y-m', request('year') . '-' . request('month'))->format('F, Y') : date('F, Y') }}
                                    </h6>
                                    <div class="form-inline">
                                        <form method="get" onchange="$(this).trigger('submit');">
                                            <select name="year" id="year" class="form-control">
                                                @php
                                                    $currentYear = Carbon::now()->year;
                                                    $currentMonth = Carbon::now()->month;
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
                                                        $monthName = Carbon::createFromFormat('m', $month)->format('M');
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


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Today Appointment') }}</h4>
                            </div>
                            <div class="p-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Schedule') }}</th>
                                                <th>{{ __('Payment') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($today_appointment as $index => $appointment)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{$appointment?->user?->email}}</td>
                                                    <td>{{formattedDate($appointment?->date)}}</td>
                                                    <td>{{$appointment?->user?->details?->phone}}</td>
                                                    <td>{{strtoupper($appointment?->schedule?->start_time) . '-' . strtoupper($appointment?->schedule?->end_time)}}</td>
                                                    <td>
                                                        @if ($appointment->payment_status == 0)
                                                            <span class="badge bg-danger">{{ __('Pending') }}</span>
                                                        @else
                                                            <span class="badge bg-success">{{ __('Success') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a  href="{{ route('lawyer.treatment',$appointment->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                            <x-empty-table :name="__('Dashboard')" route="lawyer.dashboard"
                                            create="no" :message="__('No data found!')" colspan="7" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
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
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return '{{ session()->get('currency_icon') }}' +
                                            number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
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

        // Notifications functionality for Lawyer Dashboard
        $(document).ready(function() {
            // Load notifications
            function loadDashboardNotifications() {
                $.ajax({
                    url: '{{ route("lawyer.notifications.fetch") }}',
                    method: 'GET',
                    success: function(response) {
                        if (response && response.unread_count !== undefined) {
                            updateDashboardNotificationCount(response.unread_count || 0);
                            renderDashboardNotifications(response.notifications || []);
                        } else {
                            $('#lawyer-dashboard-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Notification fetch error:', error);
                        $('#lawyer-dashboard-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("Failed to load notifications") }}</div>');
                        updateDashboardNotificationCount(0);
                    }
                });
            }

            function updateDashboardNotificationCount(count) {
                const badge = $('#lawyer-dashboard-notification-count');
                if (count > 0) {
                    badge.text(count > 99 ? '99+' : count).show();
                } else {
                    badge.hide();
                }
            }

            function renderDashboardNotifications(notifications) {
                const list = $('#lawyer-dashboard-notifications-list');
                if (!notifications || notifications.length === 0) {
                    list.html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                    return;
                }

                let html = '';
                notifications.forEach(function(notification) {
                    try {
                        const isRead = notification.read_at !== null && notification.read_at !== '';
                        const readClass = isRead ? '' : 'bg-light';
                        const notificationData = notification.data || {};
                        const icon = getDashboardNotificationIcon(notificationData.type || '');
                        html += `
                            <a href="${notificationData.url || '#'}" class="dropdown-item notification-item-dashboard ${readClass}" data-id="${notification.id || ''}">
                                <div class="d-flex align-items-start">
                                    <div class="notification-icon-wrapper me-2">
                                        <i class="${icon}"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold small">${notificationData.title || '{{ __("Notification") }}'}</div>
                                        <div class="text-muted small" style="font-size: 0.85rem;">${notificationData.message || ''}</div>
                                        <div class="text-muted" style="font-size: 0.75rem; margin-top: 4px;">${formatDashboardTime(notification.created_at)}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        `;
                    } catch (e) {
                        console.error('Error rendering notification:', e, notification);
                    }
                });
                list.html(html);

                // Mark as read on click
                $('.notification-item-dashboard').on('click', function(e) {
                    const notificationId = $(this).data('id');
                    if (!$(this).hasClass('bg-light')) return; // Already read
                    
                    $.ajax({
                        url: '{{ route("lawyer.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            loadDashboardNotifications();
                        }
                    });
                });
            }

            function getDashboardNotificationIcon(type) {
                const icons = {
                    'new_order': 'fas fa-shopping-cart text-primary',
                    'new_message': 'fas fa-envelope text-info',
                    'new_appointment': 'fas fa-calendar-check text-success',
                    'payment_approved': 'fas fa-check-circle text-success'
                };
                return icons[type] || 'fas fa-bell text-secondary';
            }

            function formatDashboardTime(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diff = now - date;
                const minutes = Math.floor(diff / 60000);
                const hours = Math.floor(diff / 3600000);
                const days = Math.floor(diff / 86400000);
                
                if (minutes < 1) return '{{ __("Just now") }}';
                if (minutes < 60) return minutes + ' {{ __("minutes ago") }}';
                if (hours < 24) return hours + ' {{ __("hours ago") }}';
                if (days < 7) return days + ' {{ __("days ago") }}';
                return date.toLocaleDateString();
            }

            // Mark all as read
            $('.mark-all-read-dashboard').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("lawyer.notifications.mark-all-read") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        loadDashboardNotifications();
                    }
                });
            });

            // Load notifications on page load
            loadDashboardNotifications();
            
            // Refresh notifications every 30 seconds
            setInterval(loadDashboardNotifications, 30000);
        });
    </script>
@endpush
