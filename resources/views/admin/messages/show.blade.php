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
                            <h4>{{ __('Conversation between') }}: 
                                {{ $conversation->user?->name ?? __('Client') }} & 
                                {{ $conversation->lawyer?->name ?? __('Lawyer') }}
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
                                            $message->sender_type == 'App\Models\User' ? 'from-client' : 
                                            ($message->sender_type == 'Modules\Lawyer\app\Models\Lawyer' ? 'from-lawyer' : 'from-admin') 
                                        }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <strong>
                                                        @if($message->sender_type == 'App\Models\User')
                                                            <i class="fas fa-user text-primary"></i> {{ $conversation->user?->name ?? $message->sender?->name ?? __('Client') }} ({{ __('Client') }})
                                                        @elseif($message->sender_type == 'Modules\Lawyer\app\Models\Lawyer')
                                                            <i class="fas fa-gavel text-warning"></i> {{ $conversation->lawyer?->name ?? $message->sender?->name ?? __('Lawyer') }} ({{ __('Lawyer') }})
                                                        @else
                                                            <i class="fas fa-user-shield text-danger"></i> {{ $message->sender?->name ?? __('Admin') }}
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
</script>
@endpush
@endsection

