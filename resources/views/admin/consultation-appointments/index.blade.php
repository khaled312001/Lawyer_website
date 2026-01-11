@extends('admin.master_layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ $title }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                $title => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ url()->current() }}" method="GET" class="card-body"
                                    id="search_filter_form">
                                    <div class="row">
                                        <div class="col-md-3 form-group mb-3 mb-md-0">
                                            <div class="input-group">
                                                <x-admin.form-input class="datepicker-two" name="from_date"
                                                    placeholder="{{ __('From Date') }}" value="{{ request('from_date') }}"
                                                    autocomplete="off" />
                                                <x-admin.form-input class="datepicker-two" name="to_date"
                                                    placeholder="{{ __('To Date') }}" value="{{ request('to_date') }}"
                                                    autocomplete="off" />
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="client" id="client" class="select2">
                                                <x-admin.select-option value="" text="{{ __('Select Client') }}" />
                                                @foreach ($clients as $client)
                                                    <x-admin.select-option :selected="$client->id == request('client')" value="{{ $client?->id }}"
                                                        text="{{ $client?->name }} - ({{ $client?->email }})" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="department_id" id="department_id" class="select2">
                                                <x-admin.select-option value="" text="{{ __('Select Department') }}" />
                                                @foreach ($departments as $department)
                                                    <x-admin.select-option :selected="$department->id == request('department_id')" value="{{ $department?->id }}"
                                                        text="{{ $department?->translation?->name ?? __('Department') }}" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == 'pending'" value="pending"
                                                    text="{{ __('Pending') }}" />
                                                <x-admin.select-option :selected="request('status') == 'confirmed'" value="confirmed"
                                                    text="{{ __('Confirmed') }}" />
                                                <x-admin.select-option :selected="request('status') == 'cancelled'" value="cancelled"
                                                    text="{{ __('Cancelled') }}" />
                                                <x-admin.select-option :selected="request('status') == 'completed'" value="completed"
                                                    text="{{ __('Completed') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-1 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="order_by" id="order_by" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Order By') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '1'" value="1"
                                                    text="{{ __('ASC') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '0'" value="0"
                                                    text="{{ __('DESC') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="par-page" id="par-page" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Per Page') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '5'" value="5"
                                                    text="{{ __('5') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '10'" value="10"
                                                    text="{{ __('10') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '25'" value="25"
                                                    text="{{ __('25') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '50'" value="50"
                                                    text="{{ __('50') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '100'" value="100"
                                                    text="{{ __('100') }}" />
                                                <x-admin.select-option :selected="request('par-page') == 'all'" value="all"
                                                    text="{{ __('All') }}" />
                                            </x-admin.form-select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('SN') }}</th>
                                            <th>{{ __('Client Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Lawyer') }}</th>
                                            <th>{{ __('Department') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Time') }}</th>
                                            <th>{{ __('Case Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @forelse ($appointments as $index => $appointment)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>
                                                    @if($appointment->user_id)
                                                        <a href="{{ route('admin.customer-show', $appointment->user_id) }}">
                                                            {{ $appointment->client_name ?? $appointment?->user?->name }}
                                                        </a>
                                                    @else
                                                        {{ $appointment->client_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $appointment->client_email ?? $appointment?->user?->email }}</td>
                                                <td>{{ $appointment->client_phone ?? $appointment?->user?->details?->phone }}</td>
                                                <td>{{ $appointment->lawyer?->translation?->name ?? $appointment->lawyer?->name ?? __('N/A') }}</td>
                                                <td>{{ $appointment->department?->translation?->name ?? __('N/A') }}</td>
                                                <td>{{ formattedDate($appointment->appointment_date) }}</td>
                                                <td>{{ $appointment->appointment_time }}</td>
                                                <td>{{ $appointment->case_type ?? __('N/A') }}</td>
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
                                                <td>
                                                    <a href="{{ route('admin.consultation-appointments.show', $appointment->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <x-empty-table :name="__('Consultation Appointment')" route="" create="no"
                                                :message="__('No data found!')" colspan="11" />
                                        @endforelse
                                    </table>
                                </div>
                                @if (request()->get('par-page') !== 'all')
                                    <div class="float-right">
                                        {{ $appointments->onEachSide(0)->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

