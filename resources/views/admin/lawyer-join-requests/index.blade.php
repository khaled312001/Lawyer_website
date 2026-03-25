@extends('admin.master_layout')
@section('title')
    <title>{{ __('Lawyer Join Requests') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Lawyer Join Requests') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Lawyer Join Requests') => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ url()->current() }}" method="GET" class="card-body" id="search_filter_form">
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3 mb-md-0">
                                            <x-admin.form-input name="search" placeholder="{{ __('Search by name, email, or specialization') }}"
                                                value="{{ request('search') }}" />
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == 'pending'" value="pending" text="{{ __('Pending') }}" />
                                                <x-admin.select-option :selected="request('status') == 'reviewed'" value="reviewed" text="{{ __('Reviewed') }}" />
                                                <x-admin.select-option :selected="request('status') == 'approved'" value="approved" text="{{ __('Approved') }}" />
                                                <x-admin.select-option :selected="request('status') == 'rejected'" value="rejected" text="{{ __('Rejected') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="order_by" id="order_by" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Order By') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '1'" value="1" text="{{ __('ASC') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '0'" value="0" text="{{ __('DESC') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select onchange="$('#search_filter_form').trigger('submit');"
                                                name="per-page" id="per-page" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Per Page') }}" />
                                                <x-admin.select-option :selected="request('per-page') == '10'" value="10" text="10" />
                                                <x-admin.select-option :selected="request('per-page') == '25'" value="25" text="25" />
                                                <x-admin.select-option :selected="request('per-page') == '50'" value="50" text="50" />
                                                <x-admin.select-option :selected="request('per-page') == 'all'" value="all" text="{{ __('All') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <button class="btn btn-primary w-100" type="submit">
                                                <i class="fas fa-search"></i> {{ __('Search') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('SN') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Specialization') }}</th>
                                            <th>{{ __('Experience') }}</th>
                                            <th>{{ __('CV') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @forelse ($lawyerJoinRequests as $index => $item)
                                            <tr>
                                                <td>{{ is_object($lawyerJoinRequests) && method_exists($lawyerJoinRequests, 'firstItem') ? $lawyerJoinRequests->firstItem() + $index : $index + 1 }}</td>
                                                <td>{{ $item->lawyer_name }}</td>
                                                <td><a href="mailto:{{ $item->lawyer_email }}">{{ $item->lawyer_email }}</a></td>
                                                <td>{{ $item->specialization }}</td>
                                                <td>{{ $item->experience_years }} {{ __('yrs') }}</td>
                                                <td>
                                                    @if($item->cv_path)
                                                        <a href="{{ Storage::url($item->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-file-download"></i> {{ __('Download') }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 'pending')
                                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                    @elseif($item->status == 'reviewed')
                                                        <span class="badge bg-info">{{ __('Reviewed') }}</span>
                                                    @elseif($item->status == 'approved')
                                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                                    @elseif($item->status == 'rejected')
                                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $item->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ formattedDateTime($item->created_at) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.lawyer-join-requests.show', $item->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <x-empty-table :name="__('Lawyer Join Request')" route="" create="no"
                                                :message="__('No data found!')" colspan="9" />
                                        @endforelse
                                    </table>
                                </div>
                                @if (request()->get('per-page') !== 'all' && method_exists($lawyerJoinRequests, 'links'))
                                    <div class="float-right">
                                        {{ $lawyerJoinRequests->onEachSide(0)->links() }}
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
                $("#deleteForm").attr("action", '{{ url("/admin/lawyer-join-requests/") }}' + "/" + id)
            }
        </script>
    @endpush
@endsection
