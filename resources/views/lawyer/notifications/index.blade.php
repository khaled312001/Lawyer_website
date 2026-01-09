@extends('lawyer.master_layout')
@section('title')
    <title>{{ __('Notifications') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Notifications') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('lawyer.dashboard') }}">{{ __('Dashboard') }}</a></div>
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
                                    <form action="{{ route('lawyer.notifications.mark-all-read') }}" method="POST" id="mark-all-read-form">
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
function markAsRead(id) {
    $.ajax({
        url: '{{ route("lawyer.notifications.mark-read", ":id") }}'.replace(':id', id),
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
</script>
@endsection

