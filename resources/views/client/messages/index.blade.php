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
                            <a href="{{ route('client.messages.start-with-admin') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-envelope me-2"></i>{{ __('Message Admin') }}
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($conversations->count() > 0)
                                <ul class="list-group">
                                    @foreach ($conversations as $conversation)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('client.messages.show', $conversation->id) }}">
                                                @php
                                                    $otherParticipant = $conversation->sender_id == Auth::user()->id && $conversation->sender_type == App\Models\User::class
                                                        ? $conversation->receiver
                                                        : $conversation->sender;
                                                @endphp
                                                <div>
                                                    <strong>{{ __('Conversation with') }}
                                                        {{ $otherParticipant->name ?? __('Unknown') }}</strong>
                                                    <p class="mb-0 text-muted">
                                                        {{ Str::limit($conversation->lastMessage->message ?? __('No messages yet'), 50) }}
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
                                    <a href="{{ route('client.messages.start-with-admin') }}" class="btn btn-primary">
                                        <i class="fas fa-envelope me-2"></i>{{ __('Start Conversation with Admin') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

