@extends('admin.master_layout')
@section('title')
    <title>{{ __('Messages Management') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Messages Management') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if($conversations->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Client') }}</th>
                                                    <th>{{ __('Problem Type') }}</th>
                                                    <th>{{ __('Messages Count') }}</th>
                                                    <th>{{ __('Last Update') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($conversations as $conversation)
                                                    <tr>
                                                        <td>{{ $conversation->id }}</td>
                                                        <td>
                                                            <strong>{{ $conversation->user?->name ?? __('Client') }}</strong><br>
                                                            <small class="text-muted">{{ $conversation->user?->email ?? '-' }}</small>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $conversation->problem_type ?? __('General Inquiry') }}</strong>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-info">{{ $conversation->messages->count() }} {{ __('messages') }}</span>
                                                        </td>
                                                        <td>{{ $conversation->updated_at ? $conversation->updated_at->diffForHumans() : '-' }}</td>
                                                        <td>
                                                            @if($conversation->status == 'active')
                                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                                            @else
                                                                <span class="badge badge-secondary">{{ __('Closed') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.messages.show', $conversation->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i> {{ __('View') }}
                                                            </a>
                                                            <form action="{{ route('admin.messages.toggle-status', $conversation->id) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-{{ $conversation->status == 'active' ? 'warning' : 'success' }} btn-sm">
                                                                    <i class="fas fa-{{ $conversation->status == 'active' ? 'lock' : 'unlock' }}"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    {{ $conversations->links() }}
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                        <h4>{{ __('No conversations') }}</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

