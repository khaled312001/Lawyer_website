@extends('layouts.client.layout')
@section('title')
    <title>{{ __('My Messages') }}</title>
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
                            <h4>{{ __('My Messages') }}</h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#startConversationModal">
                                <i class="fas fa-envelope me-2"></i>{{ __('Message Admin') }}
                            </button>
                        </div>
                        
                        <!-- Modal for Starting Conversation -->
                        <div class="modal fade" id="startConversationModal" tabindex="-1" aria-labelledby="startConversationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="startConversationModalLabel">{{ __('Start New Conversation') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                                    </div>
                                    <form action="{{ route('client.messages.start-with-admin') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="problem_type" class="form-label">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ __('Problem Type') }}
                                                </label>
                                                <input type="text" name="problem_type" id="problem_type" class="form-control" required placeholder="{{ __('Enter problem type (e.g., Criminal, Civil, Family, Commercial, Contract, etc.)') }}">
                                                <small class="form-text text-muted">{{ __('Please specify the type of problem you need help with') }}</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-2"></i>{{ __('Start Conversation') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($conversations->count() > 0)
                                <ul class="list-group">
                                    @foreach ($conversations as $conversation)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('client.messages.show', $conversation->id) }}" class="w-100">
                                                <div>
                                                    <strong>
                                                        @if($conversation->problem_type)
                                                            {{ $conversation->problem_type }}
                                                        @else
                                                            {{ __('Conversation with Admin') }}
                                                        @endif
                                                    </strong>
                                                    <p class="mb-0 text-muted">
                                                        {{ Str::limit($conversation->latestMessage->message ?? __('No messages yet'), 50) }}
                                                    </p>
                                                </div>
                                            </a>
                                            <span class="badge badge-primary badge-pill">
                                                {{ $conversation->updated_at->diffForHumans() }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-3">
                                    {{ $conversations->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <p class="mb-3">{{ __('No conversations found.') }}</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#startConversationModal">
                                        <i class="fas fa-envelope me-2"></i>{{ __('Start Conversation with Admin') }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

