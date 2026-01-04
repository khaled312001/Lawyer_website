@extends('lawyer.master_layout')
@section('title')
    <title>{{ __('Messages') }}</title>
@endsection
@section('lawyer-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Messages') }}</h1>
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
                                                    <th>{{ __('Client') }}</th>
                                                    <th>{{ __('Subject') }}</th>
                                                    <th>{{ __('Last Message') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($conversations as $conversation)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $conversation->user->name }}</strong><br>
                                                            <small class="text-muted">{{ $conversation->user->email }}</small>
                                                        </td>
                                                        <td>{{ $conversation->subject ?? 'استشارة قانونية' }}</td>
                                                        <td>
                                                            @if($conversation->latestMessage)
                                                                <small>
                                                                    {{ Str::limit($conversation->latestMessage->message, 40) }}<br>
                                                                    <span class="text-muted">{{ $conversation->latestMessage->created_at->diffForHumans() }}</span>
                                                                </small>
                                                            @else
                                                                <small class="text-muted">{{ __('No messages') }}</small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($conversation->is_active)
                                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                                            @else
                                                                <span class="badge badge-secondary">{{ __('Closed') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('lawyer.messages.show', $conversation->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i> {{ __('View') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

