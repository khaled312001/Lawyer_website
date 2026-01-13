@extends('admin.master_layout')
@section('title')
    <title>{{ __('Inquiry Details') }} - {{ $inquiry->name }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Inquiry Details') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Real Estate') => route('admin.real-estate.index'),
                __('Inquiries') => route('admin.real-estate.inquiries.index'),
                __('Details') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-lg-8">
                        <!-- Inquiry Details -->
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Inquiry Details') }}</h4>
                                <div class="card-header-action">
                                    <x-admin.back-button :href="route('admin.real-estate.inquiries.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Client Name') }}</label>
                                            <p class="form-control-plaintext">{{ $inquiry->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Phone') }}</label>
                                            <p class="form-control-plaintext">
                                                {{ $inquiry->phone }}
                                                <a href="tel:{{ $inquiry->phone }}" class="btn btn-sm btn-primary ms-2">
                                                    <i class="fas fa-phone"></i> {{ __('Call') }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    @if($inquiry->email)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Email') }}</label>
                                            <p class="form-control-plaintext">
                                                {{ $inquiry->email }}
                                                <a href="mailto:{{ $inquiry->email }}" class="btn btn-sm btn-success ms-2">
                                                    <i class="fas fa-envelope"></i> {{ __('Email') }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Preferred Contact') }}</label>
                                            <p class="form-control-plaintext">
                                                @if($inquiry->preferred_contact_method === 'email')
                                                    <span class="badge bg-info">{{ __('Email') }}</span>
                                                @elseif($inquiry->preferred_contact_method === 'phone')
                                                    <span class="badge bg-primary">{{ __('Phone') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ __('Both') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Status') }}</label>
                                            <p class="form-control-plaintext">
                                                @if($inquiry->status === 'new')
                                                    <span class="badge bg-danger">{{ __('New') }}</span>
                                                @elseif($inquiry->status === 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($inquiry->status === 'contacted')
                                                    <span class="badge bg-info">{{ __('Contacted') }}</span>
                                                @elseif($inquiry->status === 'closed')
                                                    <span class="badge bg-success">{{ __('Closed') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Date') }}</label>
                                            <p class="form-control-plaintext">{{ formattedDate($inquiry->created_at) }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($inquiry->message)
                                <div class="form-group">
                                    <label class="form-label">{{ __('Message') }}</label>
                                    <div class="border p-3 rounded">
                                        {{ $inquiry->message }}
                                    </div>
                                </div>
                                @endif

                                @if($inquiry->metadata)
                                <div class="form-group">
                                    <label class="form-label">{{ __('Technical Details') }}</label>
                                    <div class="border p-3 rounded bg-light">
                                        <small class="text-muted">
                                            <strong>{{ __('IP Address') }}:</strong> {{ $inquiry->metadata['ip_address'] ?? 'N/A' }}<br>
                                            <strong>{{ __('User Agent') }}:</strong> {{ Str::limit($inquiry->metadata['user_agent'] ?? 'N/A', 50) }}<br>
                                            <strong>{{ __('Source') }}:</strong> {{ $inquiry->metadata['source'] ?? 'N/A' }}
                                        </small>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Property Information -->
                        @if($inquiry->realEstate)
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Property Information') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $inquiry->realEstate->main_image_url }}" alt="{{ $inquiry->realEstate->title }}" class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $inquiry->realEstate->title }}</h5>
                                        <p class="text-muted">{{ $inquiry->realEstate->location_string }}</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>{{ __('Type') }}:</strong> {{ $inquiry->realEstate->property_type_label }}
                                            </div>
                                            <div class="col-6">
                                                <strong>{{ __('Price') }}:</strong> {{ $inquiry->realEstate->formatted_price }}
                                            </div>
                                            @if($inquiry->realEstate->area)
                                            <div class="col-6">
                                                <strong>{{ __('Area') }}:</strong> {{ $inquiry->realEstate->formatted_area }}
                                            </div>
                                            @endif
                                            @if($inquiry->realEstate->bedrooms)
                                            <div class="col-6">
                                                <strong>{{ __('Bedrooms') }}:</strong> {{ $inquiry->realEstate->bedrooms }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('admin.real-estate.edit', ['real_estate' => $inquiry->realEstate->id, 'code' => getSessionLanguage()]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> {{ __('View Property') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <!-- Update Status -->
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Update Status') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.real-estate.inquiries.update', $inquiry->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                            <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                            <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>{{ __('Contacted') }}</option>
                                            <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_notes" class="form-label">{{ __('Admin Notes') }}</label>
                                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" placeholder="{{ __('Add notes about this inquiry...') }}">{{ $inquiry->admin_notes }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-save"></i> {{ __('Update Inquiry') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        @if($inquiry->realEstate)
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Property Contact') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>{{ __('Name') }}:</strong> {{ $inquiry->realEstate->contact_name }}
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('Phone') }}:</strong>
                                    <a href="tel:{{ $inquiry->realEstate->contact_phone }}">{{ $inquiry->realEstate->contact_phone }}</a>
                                </div>
                                @if($inquiry->realEstate->contact_email)
                                <div class="mb-3">
                                    <strong>{{ __('Email') }}:</strong>
                                    <a href="mailto:{{ $inquiry->realEstate->contact_email }}">{{ $inquiry->realEstate->contact_email }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection