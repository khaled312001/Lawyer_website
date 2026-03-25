@extends('admin.master_layout')
@section('title')
    <title>{{ __('Lawyer Join Request Details') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Lawyer Join Request Details') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Lawyer Join Requests') => route('admin.lawyer-join-requests.index'),
                __('Details') => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    {{-- Contact Info --}}
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Lawyer Information')" />
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table table-striped">
                                        <tr>
                                            <td><strong>{{ __('Full Name') }}</strong></td>
                                            <td>{{ $joinRequest->lawyer_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Email') }}</strong></td>
                                            <td><a href="mailto:{{ $joinRequest->lawyer_email }}">{{ $joinRequest->lawyer_email }}</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Phone') }}</strong></td>
                                            <td dir="ltr">{{ $joinRequest->country_code }} {{ $joinRequest->lawyer_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Specialization') }}</strong></td>
                                            <td>{{ $joinRequest->specialization }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Experience') }}</strong></td>
                                            <td>{{ $joinRequest->experience_years }} {{ __('years') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Location') }}</strong></td>
                                            <td>{{ $joinRequest->lawyer_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('CV / Resume') }}</strong></td>
                                            <td>
                                                @if($joinRequest->cv_path)
                                                    <a href="{{ Storage::url($joinRequest->cv_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-file-download"></i> {{ __('Download CV') }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">{{ __('Not uploaded') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Status') }}</strong></td>
                                            <td>
                                                @if($joinRequest->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($joinRequest->status == 'reviewed')
                                                    <span class="badge bg-info">{{ __('Reviewed') }}</span>
                                                @elseif($joinRequest->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @elseif($joinRequest->status == 'rejected')
                                                    <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('Submitted At') }}</strong></td>
                                            <td>{{ formattedDateTime($joinRequest->created_at) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bio & Notes --}}
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Bio & Experience')" />
                            </div>
                            <div class="card-body">
                                <p style="line-height:1.8;">{!! nl2br(e($joinRequest->lawyer_bio)) !!}</p>
                            </div>
                        </div>

                        @if($joinRequest->admin_notes)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <x-admin.form-title :text="__('Admin Notes')" />
                                </div>
                                <div class="card-body">
                                    <p>{!! nl2br(e($joinRequest->admin_notes)) !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Update Status --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Update Request Status')" />
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.lawyer-join-requests.update', $joinRequest->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="pending"  {{ $joinRequest->status == 'pending'  ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                <option value="reviewed" {{ $joinRequest->status == 'reviewed' ? 'selected' : '' }}>{{ __('Reviewed') }}</option>
                                                <option value="approved" {{ $joinRequest->status == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                                                <option value="rejected" {{ $joinRequest->status == 'rejected' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Admin Notes') }}</label>
                                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="{{ __('Add notes about this request...') }}">{{ $joinRequest->admin_notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                                        <a href="{{ route('admin.lawyer-join-requests.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                        <button type="button" class="btn btn-danger" onclick="deleteData({{ $joinRequest->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                $("#deleteForm").attr("action", '{{ url("/admin/lawyer-join-requests/") }}' + "/" + id)
            }
        </script>
    @endpush
@endsection
