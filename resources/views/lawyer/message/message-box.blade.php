<div class="message-wrapper">
    <ul class="messages" id="lawyer-{{lawyerAuth()?->id}}">
        @if($messages && $messages->count() > 0)
            @foreach ($messages as $message)
                <li class="message clearfix">
                    @php
                        $isLawyer = $message->sender_type == 'Modules\Lawyer\app\Models\Lawyer';
                    @endphp
                    <div class="{{ $isLawyer ? 'sent' : 'received' }}">
                        <p>{{ $message->message }}</p>
                        @if($message->attachment)
                            <p class="mt-2">
                                <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank" class="text-primary">
                                    <i class="fas fa-paperclip"></i> {{ __('Attachment') }}
                                </a>
                            </p>
                        @endif
                        <p class="date">{{ formattedDateTime($message->created_at) }}</p>
                    </div>
                </li>
            @endforeach
        @else
            <li class="text-center text-muted py-4">
                {{ __('No messages yet. Start the conversation!') }}
            </li>
        @endif
    </ul>
</div>

<div class="input-text send_text">
    <input type="text" name="message" class="submit" placeholder="{{ __('Type your message...') }}">
    <button class="btn btn-primary" onclick="sendMessage()" id="sentMessageBtn">{{ __('Send') }}</button>
</div>