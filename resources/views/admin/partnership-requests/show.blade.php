@extends('admin.master_layout')
@section('title')
    <title>{{ __('Partnership Request Details') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Partnership Request Details') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Partnership Requests') => route('admin.partnership-requests.index'),
                __('Partnership Request Details') => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Contact Information')" />
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>{{ __('Name') }}</td>
                                            <td>{{ $partnershipRequest->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td><a href="mailto:{{ $partnershipRequest->email }}">{{ $partnershipRequest->email }}</a></td>
                                        </tr>
                                        @if($partnershipRequest->company)
                                            <tr>
                                                <td>{{ __('Company') }}</td>
                                                <td>{{ $partnershipRequest->company }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{{ __('Partnership Type') }}</td>
                                            <td>
                                                @if($partnershipRequest->partnership_type == 'law_firm')
                                                    <span class="badge bg-info">{{ __('Law Firm') }}</span>
                                                @elseif($partnershipRequest->partnership_type == 'legal_tech')
                                                    <span class="badge bg-primary">{{ __('Legal Tech Company') }}</span>
                                                @elseif($partnershipRequest->partnership_type == 'business')
                                                    <span class="badge bg-success">{{ __('Business Partner') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ __('Other') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Status') }}</td>
                                            <td>
                                                @if($partnershipRequest->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($partnershipRequest->status == 'reviewed')
                                                    <span class="badge bg-info">{{ __('Reviewed') }}</span>
                                                @elseif($partnershipRequest->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @elseif($partnershipRequest->status == 'rejected')
                                                    <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $partnershipRequest->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Created At') }}</td>
                                            <td>{{ formattedDateTime($partnershipRequest->created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Updated At') }}</td>
                                            <td>{{ formattedDateTime($partnershipRequest->updated_at) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Message')" />
                            </div>
                            <div class="card-body">
                                <p>{!! nl2br(e($partnershipRequest->message)) !!}</p>
                            </div>
                        </div>
                        @if($partnershipRequest->admin_notes)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <x-admin.form-title :text="__('Admin Notes')" />
                                </div>
                                <div class="card-body">
                                    <p>{!! nl2br(e($partnershipRequest->admin_notes)) !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Update Request Status')" />
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.partnership-requests.update', $partnershipRequest->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="pending" {{ $partnershipRequest->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                <option value="reviewed" {{ $partnershipRequest->status == 'reviewed' ? 'selected' : '' }}>{{ __('Reviewed') }}</option>
                                                <option value="approved" {{ $partnershipRequest->status == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                                                <option value="rejected" {{ $partnershipRequest->status == 'rejected' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Admin Notes') }}</label>
                                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="{{ __('Add notes about this request...') }}">{{ $partnershipRequest->admin_notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                                        <a href="{{ route('admin.partnership-requests.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                        <button type="button" class="btn btn-danger" onclick="deleteData({{ $partnershipRequest->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-admin.delete-modal />
    @push('js')
        <script>
            function deleteData(id) {
                $("#deleteForm").attr("action", '{{ url("/admin/partnership-requests/") }}' + "/" + id)
            }
        </script>
    @endpush
@endsection

