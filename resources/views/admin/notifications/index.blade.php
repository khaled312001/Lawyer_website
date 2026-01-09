@extends('admin.master_layout')
@section('title')
    <title>{{ __('Notifications') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Notifications') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Notifications') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('All Notifications') }}</h4>
                                <div class="card-header-action">
                                    <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" id="mark-all-read-form">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-check-double"></i> {{ __('Mark all as read') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($notifications->count() > 0)
                                    <div class="list-group">
                                        @foreach($notifications as $notification)
                                            <a href="{{ $notification->data['url'] ?? '#' }}" 
                                               class="list-group-item list-group-item-action {{ $notification->read_at ? '' : 'list-group-item-light' }}"
                                               onclick="markAsRead('{{ $notification->id }}')">
                                                <div class="d-flex w-100 justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="notification-icon-wrapper me-3">
                                                                @if($notification->data['type'] == 'new_order')
                                                                    <i class="fas fa-shopping-cart text-primary"></i>
                                                                @elseif($notification->data['type'] == 'new_message')
                                                                    <i class="fas fa-envelope text-info"></i>
                                                                @elseif($notification->data['type'] == 'new_contact_message')
                                                                    <i class="fas fa-comment text-warning"></i>
                                                                @elseif($notification->data['type'] == 'new_appointment_request')
                                                                    <i class="fas fa-calendar-check text-success"></i>
                                                                @elseif($notification->data['type'] == 'new_partnership_request')
                                                                    <i class="fas fa-handshake text-primary"></i>
                                                                @elseif($notification->data['type'] == 'new_legal_aid_check')
                                                                    <i class="fas fa-shield-alt text-info"></i>
                                                                @else
                                                                    <i class="fas fa-bell text-secondary"></i>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 {{ $notification->read_at ? '' : 'font-weight-bold' }}">
                                                                    {{ $notification->data['title'] ?? __('Notification') }}
                                                                </h6>
                                                                <p class="mb-1 text-muted">
                                                                    {{ $notification->data['message'] ?? '' }}
                                                                </p>
                                                                <small class="text-muted">
                                                                    {{ $notification->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!$notification->read_at)
                                                        <span class="badge badge-primary badge-sm">{{ __('New') }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-3">
                                        {{ $notifications->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">{{ __('No notifications found') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function markAsRead(notificationId) {
            $.ajax({
                url: '{{ route("admin.notifications.mark-read", ":id") }}'.replace(':id', notificationId),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    // Reload page after a short delay to show updated status
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            });
        }

        $('#mark-all-read-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    location.reload();
                }
            });
        });
    </script>
@endsection

