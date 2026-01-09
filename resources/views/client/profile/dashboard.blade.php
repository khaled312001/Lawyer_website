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
                    <!-- Notifications Button -->
                    <div class="mb-3 d-flex justify-content-end">
                        <div class="dropdown" id="client-dashboard-notification-dropdown">
                            <button type="button" class="btn btn-primary position-relative notification-btn" id="client-dashboard-notification-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge badge bg-danger" id="client-notification-count" style="display: none; position: absolute; top: -5px; right: -5px; border-radius: 50%; padding: 2px 6px; font-size: 10px;">0</span>
                                <span class="ms-2">{{ __('Notifications') }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu" id="client-dashboard-notification-menu" style="width: 350px; max-height: 400px; overflow-y: auto;">
                                <div class="dropdown-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ __('Notifications') }}</h6>
                                    <a href="javascript:;" class="text-primary small mark-all-read" style="text-decoration: none;">{{ __('Mark all as read') }}</a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div id="client-notifications-list">
                                    <div class="text-center p-3">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-footer text-center">
                                    <a href="{{ route('client.notifications.index') }}" class="text-primary small" style="text-decoration: none;">{{ __('View all notifications') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-dashboard pb-0 pt-4 px-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dash-item db-yellow flex">
                                    <i class="fas fa-handshake"></i>
                                    <h2>{{ $orders->count() }}</h2>
                                    <h4>{{ __('Total Order') }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dash-item db-red flex">
                                    <i class="fas fa-hourglass-start"></i>
                                    <h2>{{ $appointments->where('payment_status', 0)->count() }}</h2>
                                    <h4>{{ __('Pending Appointment') }}</h4>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dash-item db-blue flex">
                                    <i class="fas fa-check-circle"></i>
                                    <h2>{{ $appointments->count() }}</h2>
                                    <h4>{{ __('Total Appointment') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile_info_area">

                        <div class="wsus__profile_info profile_info detail-dashboard">
                            <div class="wsus__profile_info_top">
                                <h2 class="d-headline">{{ __('Personal Information') }}</h2>
                                <a href="javascript:;" class="edit_btn edit_profile">{{ __('Edit info') }}</a>
                            </div>

                            <ul class="">
                                <li><span>{{ __('Name') }}:</span>{{ $user?->name }}</li>
                                <li><span>{{ __('Phone ') }}:</span>{{ $user?->details?->phone }}</li>
                                <li class="text-lowercase"><span
                                        class="text-capitalize">{{ __('Email') }}:</span>{{ $user?->email }}</li>
                                <li><span>{{ __('Gender ') }}:</span>{{ $user?->details?->phone }}</li>
                                <li><span>{{ __('Date Of Birth ') }}:</span>{{ $user?->details?->date_of_birth }}</li>
                                <li><span>{{ __('Occupation ') }}:</span>{{ $user?->details?->occupation }}</li>
                                <li><span>{{ __('Age ') }}:</span>{{ $user?->details?->age }}</li>
                                <li><span>{{ __('Country ') }}:</span>{{ $user?->details?->country }}</li>
                                <li><span>{{ __('City ') }}:</span>{{ $user?->details?->city }}</li>
                                <li><span>{{ __('Address') }}:</span>{{ $user?->details?->address }}</li>
                            </ul>
                        </div>

                        <div class="detail-dashboard add-form profile_edit_area mt_25">
                            <div class="wsus__profile_info_top">
                                <h2 class="d-headline">{{ __('My Profile') }}</h2>
                                <a href="javascript:;" class="edit_btn del_btn">{{ __('Cancel') }}</a>
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
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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

@push('js')
<script>
    $(document).ready(function() {
        // Load notifications
        function loadNotifications() {
            $.ajax({
                url: '{{ route("client.notifications.fetch") }}',
                method: 'GET',
                success: function(response) {
                    if (response && response.unread_count !== undefined) {
                        updateNotificationCount(response.unread_count || 0);
                        renderNotifications(response.notifications || []);
                    } else {
                        $('#client-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("No notifications") }}</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Notification fetch error:', error);
                    $('#client-notifications-list').html('<div class="text-center p-3 text-muted">{{ __("Failed to load notifications") }}</div>');
                    updateNotificationCount(0);
                }
            });
        }

        function updateNotificationCount(count) {
            const badge = $('#client-notification-count');
            if (count > 0) {
                badge.text(count > 99 ? '99+' : count).show();
            } else {
                badge.hide();
            }
        }

        function renderNotifications(notifications) {
            const list = $('#client-notifications-list');
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
                    const icon = getNotificationIcon(notificationData.type || '');
                    html += `
                        <a href="${notificationData.url || '#'}" class="dropdown-item notification-item ${readClass}" data-id="${notification.id || ''}">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon-wrapper me-2">
                                    <i class="${icon}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold small">${notificationData.title || '{{ __("Notification") }}'}</div>
                                    <div class="text-muted small" style="font-size: 0.85rem;">${notificationData.message || ''}</div>
                                    <div class="text-muted" style="font-size: 0.75rem; margin-top: 4px;">${formatTime(notification.created_at)}</div>
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
            $('.notification-item').on('click', function(e) {
                const notificationId = $(this).data('id');
                if (!$(this).hasClass('bg-light')) return; // Already read
                
                $.ajax({
                    url: '{{ route("client.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        loadNotifications();
                    }
                });
            });
        }

        function getNotificationIcon(type) {
            const icons = {
                'new_order': 'fas fa-shopping-cart text-primary',
                'new_message': 'fas fa-envelope text-info',
                'new_appointment': 'fas fa-calendar-check text-success',
                'payment_approved': 'fas fa-check-circle text-success'
            };
            return icons[type] || 'fas fa-bell text-secondary';
        }

        function formatTime(dateString) {
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
        $('.mark-all-read').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("client.notifications.mark-all-read") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    loadNotifications();
                }
            });
        });

        // Load notifications on page load
        loadNotifications();
        
        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);

        // Toggle dropdown on button click (fallback)
        $('#client-dashboard-notification-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var menu = $('#client-dashboard-notification-menu');
            if (menu.hasClass('show')) {
                menu.removeClass('show');
            } else {
                menu.addClass('show');
                loadNotifications();
            }
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#client-dashboard-notification-dropdown').length) {
                $('#client-dashboard-notification-menu').removeClass('show');
            }
        });
    });
</script>
@endpush
