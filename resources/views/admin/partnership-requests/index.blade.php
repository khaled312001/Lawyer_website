@extends('admin.master_layout')
@section('title')
    <title>{{ __('Partnership Requests') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Partnership Requests') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Partnership Requests') => '#',
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
                                            <x-admin.form-input name="search" placeholder="{{ __('Search by name, email, or company') }}"
                                                value="{{ request('search') }}" />
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == 'pending'" value="pending"
                                                    text="{{ __('Pending') }}" />
                                                <x-admin.select-option :selected="request('status') == 'reviewed'" value="reviewed"
                                                    text="{{ __('Reviewed') }}" />
                                                <x-admin.select-option :selected="request('status') == 'approved'" value="approved"
                                                    text="{{ __('Approved') }}" />
                                                <x-admin.select-option :selected="request('status') == 'rejected'" value="rejected"
                                                    text="{{ __('Rejected') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="partnership_type" id="partnership_type" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Partnership Type') }}" />
                                                <x-admin.select-option :selected="request('partnership_type') == 'law_firm'" value="law_firm"
                                                    text="{{ __('Law Firm') }}" />
                                                <x-admin.select-option :selected="request('partnership_type') == 'legal_tech'" value="legal_tech"
                                                    text="{{ __('Legal Tech Company') }}" />
                                                <x-admin.select-option :selected="request('partnership_type') == 'business'" value="business"
                                                    text="{{ __('Business Partner') }}" />
                                                <x-admin.select-option :selected="request('partnership_type') == 'other'" value="other"
                                                    text="{{ __('Other') }}" />
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
                                                name="per-page" id="per-page" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Per Page') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '5'" value="5"
                                                    text="{{ __('5') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '10'" value="10"
                                                    text="{{ __('10') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '25'" value="25"
                                                    text="{{ __('25') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '50'" value="50"
                                                    text="{{ __('50') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '100'" value="100"
                                                    text="{{ __('100') }}" />
                                                <x-admin.select-option :selected="request('per-page') == 'all'" value="all"
                                                    text="{{ __('All') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <button class="btn btn-primary w-100" type="submit"><i
                                                    class="fas fa-search"></i> {{ __('Search') }}</button>
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
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Company') }}</th>
                                            <th>{{ __('Partnership Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @forelse ($partnershipRequests as $index => $request)
                                            <tr>
                                                <td>{{ $partnershipRequests->firstItem() + $index }}</td>
                                                <td>{{ $request->name }}</td>
                                                <td><a href="mailto:{{ $request->email }}">{{ $request->email }}</a></td>
                                                <td>{{ $request->company ?? __('N/A') }}</td>
                                                <td>
                                                    @if($request->partnership_type == 'law_firm')
                                                        <span class="badge bg-info">{{ __('Law Firm') }}</span>
                                                    @elseif($request->partnership_type == 'legal_tech')
                                                        <span class="badge bg-primary">{{ __('Legal Tech Company') }}</span>
                                                    @elseif($request->partnership_type == 'business')
                                                        <span class="badge bg-success">{{ __('Business Partner') }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ __('Other') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($request->status == 'pending')
                                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                    @elseif($request->status == 'reviewed')
                                                        <span class="badge bg-info">{{ __('Reviewed') }}</span>
                                                    @elseif($request->status == 'approved')
                                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                                    @elseif($request->status == 'rejected')
                                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $request->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ formattedDateTime($request->created_at) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.partnership-requests.show', $request->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $request->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <x-empty-table :name="__('Partnership Request')" route="" create="no"
                                                :message="__('No data found!')" colspan="8" />
                                        @endforelse
                                    </table>
                                </div>
                                @if (request()->get('per-page') !== 'all')
                                    <div class="float-right">
                                        {{ $partnershipRequests->onEachSide(0)->links() }}
                                    </div>
                                @endif
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

