@extends('admin.master_layout')
@section('title')
    <title>{{ __('Conversation Details') }}</title>
@endsection
@section('admin-content')
<style>
    .chat-container {
        max-height: 600px;
        overflow-y: auto;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
    }
    .message-row {
        margin-bottom: 20px;
    }
    .message-card {
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .message-card.from-client {
        background: #e3f2fd;
        margin-left: 0;
        margin-right: 20%;
    }
    .message-card.from-lawyer {
        background: #fff3e0;
        margin-left: 20%;
        margin-right: 0;
    }
    .message-card.from-admin {
        background: #f3e5f5;
        margin: 0 10%;
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Conversation Details') }}</h1>
            <div class="section-header-button">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Conversation between') }}: {{ $conversation->user->name }} & {{ $conversation->lawyer->name }}</h4>
                            <div class="card-header-action">
                                @if($conversation->is_active)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ __('Closed') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chat-container">
                                @foreach($conversation->messages as $message)
                                    <div class="message-row">
                                        <div class="message-card {{ 
                                            $message->sender_type == 'App\Models\User' ? 'from-client' : 
                                            ($message->sender_type == 'Modules\Lawyer\app\Models\Lawyer' ? 'from-lawyer' : 'from-admin') 
                                        }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <strong>
                                                        @if($message->sender_type == 'App\Models\User')
                                                            <i class="fas fa-user text-primary"></i> {{ $conversation->user->name }} ({{ __('Client') }})
                                                        @elseif($message->sender_type == 'Modules\Lawyer\app\Models\Lawyer')
                                                            <i class="fas fa-gavel text-warning"></i> {{ $conversation->lawyer->name }} ({{ __('Lawyer') }})
                                                        @else
                                                            <i class="fas fa-user-shield text-danger"></i> {{ __('Admin') }}
                                                        @endif
                                                    </strong>
                                                </div>
                                                <small class="text-muted">{{ $message->created_at->format('Y-m-d h:i A') }}</small>
                                            </div>
                                            <div class="mt-2">
                                                {{ $message->message }}
                                            </div>
                                            @if($message->attachment)
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-paperclip"></i> {{ __('View Attachment') }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>
                            <h5>{{ __('Send Message as Admin') }}</h5>
                            <form action="{{ route('admin.messages.send', $conversation->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('Message') }}</label>
                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Attachment (optional)') }}</label>
                                    <input type="file" name="attachment" class="form-control-file">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> {{ __('Send') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

