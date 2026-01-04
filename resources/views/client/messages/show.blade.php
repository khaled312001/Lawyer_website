@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Conversation with') }} {{ $conversation->receiver_id == Auth::user()->id ? $conversation->sender->name : $conversation->receiver->name }}</title>
@endsection
@section('client-content')
    <div class="dashboard-area pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('client.profile.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{ __('Conversation with') }}
                                @php
                                    $otherParticipant = $conversation->sender_id == Auth::user()->id && $conversation->sender_type == App\Models\User::class
                                        ? $conversation->receiver
                                        : $conversation->sender;
                                @endphp
                                {{ $otherParticipant->name ?? __('Unknown') }}
                            </h4>
                            <a href="{{ route('client.messages.index') }}" class="btn btn-primary btn-sm">{{ __('Back to Messages') }}</a>
                        </div>
                        <div class="card-body message-box" style="height: 500px; overflow-y: scroll;">
                            <div id="messages-container">
                                {{-- Messages will be loaded here --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="message-form" enctype="multipart/form-data">
                                @csrf
                                <div id="file-preview-container" class="mb-2" style="display: none;">
                                    <div class="position-relative d-inline-block">
                                        <img id="image-preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;" class="img-thumbnail">
                                        <div id="file-info-preview" style="display: none;" class="alert alert-info">
                                            <i class="fas fa-file"></i> <span id="file-name-preview"></span>
                                            <br><small id="file-size-preview"></small>
                                        </div>
                                        <button type="button" id="remove-file-btn" class="btn btn-sm btn-danger position-absolute" style="top: 5px; right: 5px;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <textarea name="message" id="message-input" class="form-control" rows="2"
                                        placeholder="{{ __('Type your message...') }}"></textarea>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="attachment-input" class="btn btn-info btn-sm mb-0">
                                            <i class="fas fa-paperclip"></i> {{ __('Attach File') }}
                                        </label>
                                        <input type="file" name="attachment" id="attachment-input" class="d-none" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.txt">
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                const conversationId = {{ $conversation->id }};
                const messagesContainer = $('#messages-container');

                function fetchMessages() {
                    $.get(`/client/messages/${conversationId}/get-messages`, function(data) {
                        messagesContainer.empty();
                        data.messages.forEach(function(message) {
                            const senderName = message.sender.name;
                            const isCurrentUser = message.sender_id === {{ Auth::user()->id }} && message.sender_type === 'App\\Models\\User';
                            const messageClass = isCurrentUser ? 'text-right' : 'text-left';
                            const senderClass = isCurrentUser ? 'text-primary' : 'text-info';

                            let messageHtml = `<div class="mb-3 ${messageClass}">
                                <small class="${senderClass}"><strong>${senderName}</strong></small>`;

                            if (message.message) {
                                messageHtml += `<p class="mb-1">${message.message}</p>`;
                            }

                            if (message.attachment) {
                                const attachmentUrl = message.attachment.startsWith('http') ? message.attachment : `/storage/${message.attachment}`;
                                const fileName = message.attachment.split('/').pop();
                                const fileExt = fileName.split('.').pop().toLowerCase();
                                const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                                
                                if (imageExtensions.includes(fileExt)) {
                                    messageHtml += `<div class="mb-1">
                                        <a href="${attachmentUrl}" target="_blank">
                                            <img src="${attachmentUrl}" alt="${fileName}" style="max-width: 200px; max-height: 200px;" class="img-thumbnail" 
                                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\\'http://www.w3.org/2000/svg\\' width=\\'200\\' height=\\'200\\'%3E%3Crect fill=\\'%23ddd\\' width=\\'200\\' height=\\'200\\'/%3E%3Ctext x=\\'50%25\\' y=\\'50%25\\' text-anchor=\\'middle\\' dy=\\'.3em\\' fill=\\'%23999\\'%3EImage not found%3C/text%3E%3C/svg%3E';">
                                        </a>
                                    </div>`;
                                } else {
                                    const fileIcon = getFileIcon(fileExt);
                                    messageHtml += `<div class="mb-1">
                                        <a href="${attachmentUrl}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                            <i class="${fileIcon}"></i> ${fileName}
                                        </a>
                                    </div>`;
                                }
                            }

                            messageHtml += `<small class="text-muted">${new Date(message.created_at).toLocaleString()}</small>
                            </div>`;
                            messagesContainer.append(messageHtml);
                        });
                        messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
                    });
                }

                function getFileIcon(extension) {
                    const icons = {
                        'pdf': 'fas fa-file-pdf text-danger',
                        'doc': 'fas fa-file-word text-primary',
                        'docx': 'fas fa-file-word text-primary',
                        'xls': 'fas fa-file-excel text-success',
                        'xlsx': 'fas fa-file-excel text-success',
                        'txt': 'fas fa-file-alt',
                        'zip': 'fas fa-file-archive',
                        'rar': 'fas fa-file-archive',
                    };
                    return icons[extension] || 'fas fa-file';
                }

                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                }

                fetchMessages(); // Initial load

                // Refresh messages every 3 seconds
                setInterval(fetchMessages, 3000);

                $('#attachment-input').on('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const fileName = file.name;
                        const fileSize = formatFileSize(file.size);
                        const fileExt = fileName.split('.').pop().toLowerCase();
                        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

                        $('#file-preview-container').show();

                        if (imageExtensions.includes(fileExt)) {
                            // معاينة الصورة
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                $('#image-preview').attr('src', e.target.result).show();
                                $('#file-info-preview').hide();
                            };
                            reader.readAsDataURL(file);
                        } else {
                            // معاينة الملف
                            $('#image-preview').hide();
                            $('#file-name-preview').text(fileName);
                            $('#file-size-preview').text(fileSize);
                            $('#file-info-preview').show();
                        }
                    }
                });

                $('#remove-file-btn').on('click', function() {
                    $('#attachment-input').val('');
                    $('#file-preview-container').hide();
                    $('#image-preview').attr('src', '').hide();
                    $('#file-info-preview').hide();
                });

                $('#message-form').on('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: `/client/messages/${conversationId}/send`,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#message-input').val('');
                            $('#attachment-input').val('');
                            $('#file-preview-container').hide();
                            $('#image-preview').attr('src', '').hide();
                            $('#file-info-preview').hide();
                            fetchMessages();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('{{ __("Error sending message. Please try again.") }}');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
