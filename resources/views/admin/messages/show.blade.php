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
    
    /* Modal Fixes */
    .modal-backdrop {
        z-index: 1040 !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
        pointer-events: auto !important;
    }
    
    .modal {
        z-index: 1050 !important;
        pointer-events: none !important;
    }
    
    .modal.show {
        display: block !important;
    }
    
    .modal-dialog {
        pointer-events: auto !important;
    }
    
    .modal-content {
        pointer-events: auto !important;
    }
    
    /* Ensure backdrop is clickable and closes modal */
    .modal-backdrop.show {
        pointer-events: auto !important;
        cursor: pointer !important;
    }
    
    /* Remove any fixed overlays that might block clicks */
    body.modal-open {
        overflow: hidden !important;
        padding-right: 0 !important;
    }
    
    /* Force remove backdrop when modal is hidden */
    body:not(.modal-open) .modal-backdrop {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }
    
    /* Remove all backdrops that shouldn't be there */
    .modal-backdrop:not(.show) {
        display: none !important;
    }
    
    /* Ensure only one backdrop exists at a time */
    .modal-backdrop ~ .modal-backdrop {
        display: none !important;
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
                            <h4>
                                {{ __('Client') }}: {{ $conversation->user?->name ?? __('Client') }} | 
                                {{ __('Problem Type') }}: {{ $conversation->problem_type ?? __('General Inquiry') }}
                            </h4>
                            <div class="card-header-action">
                                @if($conversation->status == 'active')
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ __('Closed') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chat-container">
                                @foreach($conversation->messages as $message)
                                    <div class="message-row" id="message-{{ $message->id }}">
                                        <div class="message-card {{ 
                                            $message->sender_type == 'App\Models\User' ? 'from-client' : 'from-admin' 
                                        }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <strong>
                                                        @if($message->sender_type == 'App\Models\User')
                                                            <i class="fas fa-user text-primary"></i> {{ $conversation->user?->name ?? $message->sender?->name ?? __('Client') }} ({{ __('Client') }})
                                                        @else
                                                            <i class="fas fa-user-shield text-danger"></i> {{ $message->sender?->name ?? __('Admin') }} ({{ __('Admin') }})
                                                        @endif
                                                    </strong>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <small class="text-muted">{{ $message->created_at->format('Y-m-d h:i A') }}</small>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMessageModal{{ $message->id }}" title="{{ __('Edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMessageModal{{ $message->id }}" title="{{ __('Delete') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2" id="message-content-{{ $message->id }}">
                                                @if($message->message)
                                                    <p class="mb-2">{{ $message->message }}</p>
                                                @endif
                                                @if($message->attachment)
                                                    @php
                                                        // Files are stored in public/uploads/store, so use /uploads/store path
                                                        $attachmentUrl = (str_starts_with($message->attachment, 'http')) ? $message->attachment : asset('uploads/store/' . $message->attachment);
                                                        $fileName = basename($message->attachment);
                                                        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                                                    @endphp
                                                    <div class="mt-2">
                                                        @if(in_array($fileExt, $imageExtensions))
                                                            <div class="mb-2">
                                                                <a href="{{ $attachmentUrl }}" target="_blank">
                                                                    <img src="{{ $attachmentUrl }}" alt="{{ $fileName }}" 
                                                                         style="max-width: 300px; max-height: 300px;" 
                                                                         class="img-thumbnail"
                                                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'300\'%3E%3Crect fill=\'%23ddd\' width=\'300\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\'%3E{{ __('Image not found') }}%3C/text%3E%3C/svg%3E';">
                                                                </a>
                                                            </div>
                                                            <a href="{{ $attachmentUrl }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-download"></i> {{ __('Download Image') }}
                                                            </a>
                                                        @else
                                                            @php
                                                                $fileIcons = [
                                                                    'pdf' => 'fas fa-file-pdf text-danger',
                                                                    'doc' => 'fas fa-file-word text-primary',
                                                                    'docx' => 'fas fa-file-word text-primary',
                                                                    'xls' => 'fas fa-file-excel text-success',
                                                                    'xlsx' => 'fas fa-file-excel text-success',
                                                                    'txt' => 'fas fa-file-alt',
                                                                    'zip' => 'fas fa-file-archive',
                                                                    'rar' => 'fas fa-file-archive',
                                                                ];
                                                                $fileIcon = $fileIcons[$fileExt] ?? 'fas fa-file';
                                                            @endphp
                                                            <a href="{{ $attachmentUrl }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="{{ $fileIcon }}"></i> {{ __('Download') }} {{ $fileName }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Message Modal -->
                                    <div class="modal fade" id="editMessageModal{{ $message->id }}" tabindex="-1" aria-labelledby="editMessageModalLabel{{ $message->id }}" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMessageModalLabel{{ $message->id }}">{{ __('Edit Message') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                                                </div>
                                                <form action="{{ route('admin.messages.update', $message->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>{{ __('Message') }}</label>
                                                            <textarea name="message" class="form-control" rows="5" required>{{ $message->message }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Message Confirmation Modal -->
                                    <div class="modal fade" id="deleteMessageModal{{ $message->id }}" tabindex="-1" aria-labelledby="deleteMessageModalLabel{{ $message->id }}" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteMessageModalLabel{{ $message->id }}">
                                                        <i class="fas fa-exclamation-triangle"></i> {{ __('Delete Message') }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center mb-3">
                                                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                                                        <p class="lead">{{ __('Are you sure you want to delete this message?') }}</p>
                                                        <p class="text-muted">{{ __('This action cannot be undone.') }}</p>
                                                    </div>
                                                    <div class="alert alert-warning">
                                                        <i class="fas fa-info-circle"></i> 
                                                        <strong>{{ __('Note:') }}</strong> {{ __('The message and any attachments will be permanently deleted.') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                                                    </button>
                                                    <form action="{{ route('admin.messages.delete', $message->id) }}" method="POST" class="d-inline" id="deleteForm{{ $message->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>
                            <h5>{{ __('Send Message as Admin') }}</h5>
                            <form action="{{ route('admin.messages.send', $conversation->id) }}" method="POST" enctype="multipart/form-data" id="admin-message-form">
                                @csrf
                                <div id="admin-file-preview-container" class="mb-2" style="display: none;">
                                    <div class="position-relative d-inline-block">
                                        <img id="admin-image-preview" src="" alt="{{ __('Preview') }}" style="max-width: 200px; max-height: 200px; display: none;" class="img-thumbnail">
                                        <div id="admin-file-info-preview" style="display: none;" class="alert alert-info">
                                            <i class="fas fa-file"></i> <span id="admin-file-name-preview"></span>
                                            <br><small id="admin-file-size-preview"></small>
                                        </div>
                                        <button type="button" id="admin-remove-file-btn" class="btn btn-sm btn-danger position-absolute" style="top: 5px; right: 5px;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Message') }} <small class="text-muted">({{ __('optional if attachment is provided') }})</small></label>
                                    <textarea name="message" id="admin-message-input" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Attachment (optional)') }}</label>
                                    <input type="file" name="attachment" id="admin-attachment-input" class="form-control-file" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.txt">
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

@push('js')
<script>
// Ensure modals close properly and backdrop is removed
(function() {
    'use strict';
    
    // Function to clean up backdrop
    function removeBackdrop() {
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(function(backdrop) {
            backdrop.remove();
        });
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
    
    // Handle modal close events
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        
        modals.forEach(function(modal) {
            // When modal is shown
            modal.addEventListener('show.bs.modal', function() {
                // Remove any existing backdrops first
                removeBackdrop();
            });
            
            // When modal is hidden
            modal.addEventListener('hidden.bs.modal', function() {
                // Force remove backdrop
                removeBackdrop();
            });
            
            // Handle click on backdrop to close
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                }
            });
        });
        
        // Also listen for backdrop clicks directly
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-backdrop')) {
                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    const bsModal = bootstrap.Modal.getInstance(openModal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                }
            }
        });
        
        // Monitor and remove orphaned backdrops
        setInterval(function() {
            const openModal = document.querySelector('.modal.show');
            if (!openModal) {
                removeBackdrop();
            }
        }, 100);
        
        // Clean up on page unload
        window.addEventListener('beforeunload', function() {
            removeBackdrop();
        });
    });
    
    // Also run cleanup immediately if DOM is already loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', removeBackdrop);
    } else {
        removeBackdrop();
    }
    
    // Global cleanup function that can be called from anywhere
    window.cleanupModalBackdrop = removeBackdrop;
})();

// File preview functionality for admin message form
(function() {
    'use strict';
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const attachmentInput = document.getElementById('admin-attachment-input');
        const imagePreview = document.getElementById('admin-image-preview');
        const fileInfoPreview = document.getElementById('admin-file-info-preview');
        const fileNamePreview = document.getElementById('admin-file-name-preview');
        const fileSizePreview = document.getElementById('admin-file-size-preview');
        const filePreviewContainer = document.getElementById('admin-file-preview-container');
        const removeFileBtn = document.getElementById('admin-remove-file-btn');
        
        if (attachmentInput) {
            attachmentInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const fileName = file.name;
                    const fileSize = formatFileSize(file.size);
                    const fileExt = fileName.split('.').pop().toLowerCase();
                    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                    
                    filePreviewContainer.style.display = 'block';
                    
                    if (imageExtensions.includes(fileExt)) {
                        // Preview image
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                            fileInfoPreview.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Preview file info
                        imagePreview.style.display = 'none';
                        fileNamePreview.textContent = fileName;
                        fileSizePreview.textContent = fileSize;
                        fileInfoPreview.style.display = 'block';
                    }
                }
            });
        }
        
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function() {
                if (attachmentInput) attachmentInput.value = '';
                filePreviewContainer.style.display = 'none';
                if (imagePreview) {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
                if (fileInfoPreview) fileInfoPreview.style.display = 'none';
            });
        }
        
        // Reset form after successful submission
        const messageForm = document.getElementById('admin-message-form');
        if (messageForm) {
            messageForm.addEventListener('submit', function() {
                // Reset will happen after page reload, but we can clear preview
                setTimeout(function() {
                    if (attachmentInput) attachmentInput.value = '';
                    filePreviewContainer.style.display = 'none';
                    if (imagePreview) {
                        imagePreview.src = '';
                        imagePreview.style.display = 'none';
                    }
                    if (fileInfoPreview) fileInfoPreview.style.display = 'none';
                }, 100);
            });
        }
    });
})();
</script>
@endpush
@endsection

