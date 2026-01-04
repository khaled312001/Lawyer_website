@extends('lawyer.master_layout')
@section('title')
    <title>{{ __('Conversation with') }} {{ $conversation->user->name }}</title>
@endsection
@section('lawyer-content')
<style>
    .chat-box {
        height: 500px;
        overflow-y: auto;
        background: #f5f5f5;
        padding: 20px;
        border-radius: 5px;
    }
    .message-item {
        margin-bottom: 15px;
        display: flex;
    }
    .message-item.sent {
        justify-content: flex-end;
    }
    .message-item.received {
        justify-content: flex-start;
    }
    .message-bubble {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 15px;
    }
    .message-item.sent .message-bubble {
        background: #007bff;
        color: white;
    }
    .message-item.received .message-bubble {
        background: white;
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Conversation with') }} {{ $conversation->user->name }}</h1>
            <div class="section-header-button">
                <a href="{{ route('lawyer.messages.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="chat-box" id="chatBox">
                                @foreach($conversation->messages as $message)
                                    <div class="message-item {{ $message->sender_type == 'Modules\Lawyer\app\Models\Lawyer' ? 'sent' : 'received' }}">
                                        <div class="message-bubble">
                                            <div>{{ $message->message }}</div>
                                            @if($message->attachment)
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">
                                                        <i class="fas fa-paperclip"></i> {{ __('Attachment') }}
                                                    </a>
                                                </div>
                                            @endif
                                            <small class="text-muted d-block mt-1">
                                                {{ $message->created_at->format('h:i A') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <form action="{{ route('lawyer.messages.send', $conversation->id) }}" method="POST" 
                                  enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <textarea name="message" class="form-control" rows="3" 
                                              placeholder="{{ __('Type your message...') }}" required></textarea>
                                </div>
                                <div class="form-group">
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

<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection

