@extends('admin.master_layout')
@section('title')
    <title>{{ __('Consultation Appointment Details') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Consultation Appointment Details') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Consultation Appointments') => route('admin.consultation-appointments.index'),
                __('Consultation Appointment Details') => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Client Information')" />
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>{{ __('Name') }}</td>
                                            <td>
                                                @if($appointment->user_id)
                                                    <a href="{{ route('admin.customer-show', $appointment->user_id) }}">
                                                        {{ $appointment->client_name ?? $appointment?->user?->name }}
                                                    </a>
                                                @else
                                                    {{ $appointment->client_name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td><a href="mailto:{{ $appointment->client_email ?? $appointment?->user?->email }}">{{ $appointment->client_email ?? $appointment?->user?->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Phone') }}</td>
                                            <td><a href="tel:{{ $appointment->client_phone ?? $appointment?->user?->details?->phone }}">{{ $appointment->client_phone ?? $appointment?->user?->details?->phone }}</a></td>
                                        </tr>
                                        @if($appointment->client_city)
                                            <tr>
                                                <td>{{ __('City') }}</td>
                                                <td>{{ $appointment->client_city }}</td>
                                            </tr>
                                        @endif
                                        @if($appointment->client_country)
                                            <tr>
                                                <td>{{ __('Country') }}</td>
                                                <td>{{ $appointment->client_country }}</td>
                                            </tr>
                                        @endif
                                        @if($appointment->client_address)
                                            <tr>
                                                <td>{{ __('Address') }}</td>
                                                <td>{{ $appointment->client_address }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Appointment Information')" />
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>{{ __('Lawyer') }}</td>
                                            <td>{{ $appointment->lawyer?->translation?->name ?? $appointment->lawyer?->name ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Department') }}</td>
                                            <td>{{ $appointment->department?->translation?->name ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Date') }}</td>
                                            <td>{{ formattedDate($appointment->appointment_date) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Time') }}</td>
                                            <td>{{ $appointment->appointment_time }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Case Type') }}</td>
                                            <td>{{ $appointment->case_type ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Status') }}</td>
                                            <td>
                                                @if($appointment->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($appointment->status == 'confirmed')
                                                    <span class="badge bg-info">{{ __('Confirmed') }}</span>
                                                @elseif($appointment->status == 'cancelled')
                                                    <span class="badge bg-danger">{{ __('Cancelled') }}</span>
                                                @elseif($appointment->status == 'completed')
                                                    <span class="badge bg-success">{{ __('Completed') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $appointment->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if($appointment->admin)
                                            <tr>
                                                <td>{{ __('Assigned Admin') }}</td>
                                                <td>{{ $appointment->admin->name }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{{ __('Created At') }}</td>
                                            <td>{{ formattedDateTime($appointment->created_at) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Case Details')" />
                            </div>
                            <div class="card-body">
                                <p><strong>{{ __('Case Details') }}:</strong></p>
                                <p>{!! nl2br(e($appointment->case_details)) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Problem Description')" />
                            </div>
                            <div class="card-body">
                                <p><strong>{{ __('Problem Description') }}:</strong></p>
                                <p>{!! nl2br(e($appointment->problem_description)) !!}</p>
                            </div>
                        </div>
                    </div>
                    @if($appointment->additional_info)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <x-admin.form-title :text="__('Additional Information')" />
                                </div>
                                <div class="card-body">
                                    <p>{!! nl2br(e($appointment->additional_info)) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($appointment->admin_notes)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <x-admin.form-title :text="__('Admin Notes')" />
                                </div>
                                <div class="card-body">
                                    <p>{!! nl2br(e($appointment->admin_notes)) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <x-admin.form-title :text="__('Update Appointment Status')" />
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.consultation-appointments.update-status', $appointment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>{{ __('Admin Notes') }}</label>
                                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="{{ __('Add notes about this appointment...') }}">{{ $appointment->admin_notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                                        <a href="{{ route('admin.consultation-appointments.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                        <button type="button" class="btn btn-danger" onclick="deleteData({{ $appointment->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                $("#deleteForm").attr("action", '{{ url("/admin/consultation-appointments/") }}' + "/" + id)
            }
        </script>
    @endpush
@endsection

