@extends('admin.master_layout')
@section('title')
    <title>{{ __('Real Estate Inquiries') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Real Estate Inquiries') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Real Estate') => '#',
                __('Inquiries') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ route('admin.real-estate.inquiries.index') }}" method="GET"
                                    onchange="$(this).trigger('submit')" class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3 mb-md-0">
                                            <div class="input-group">
                                                <x-admin.form-input name="keyword" placeholder="{{ __('Search by name, email, phone...') }}"
                                                    value="{{ request()->get('keyword') }}" />
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('All Status') }}" />
                                                <x-admin.select-option :selected="request('status') == 'new'" value="new" text="{{ __('New') }}" />
                                                <x-admin.select-option :selected="request('status') == 'pending'" value="pending" text="{{ __('Pending') }}" />
                                                <x-admin.select-option :selected="request('status') == 'contacted'" value="contacted" text="{{ __('Contacted') }}" />
                                                <x-admin.select-option :selected="request('status') == 'closed'" value="closed" text="{{ __('Closed') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-3 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="property_id" id="property_id" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('All Properties') }}" />
                                                @foreach($properties as $property)
                                                    <x-admin.select-option :selected="request('property_id') == $property->id" :value="$property->id" :text="Str::limit($property->title, 40)" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="par-page" id="par-page" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Per Page') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '5'" value="5" text="{{ __('5') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '10'" value="10" text="{{ __('10') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '25'" value="25" text="{{ __('25') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '50'" value="50" text="{{ __('50') }}" />
                                                <x-admin.select-option :selected="request('par-page') == '100'" value="100" text="{{ __('100') }}" />
                                                <x-admin.select-option :selected="request('par-page') == 'all'" value="all" text="{{ __('All') }}" />
                                            </x-admin.form-select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Real Estate Inquiries') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="3%">{{ __('SN') }}</th>
                                                <th width="15%">{{ __('Client') }}</th>
                                                <th width="20%">{{ __('Property') }}</th>
                                                <th width="15%">{{ __('Contact') }}</th>
                                                <th width="8%">{{ __('Status') }}</th>
                                                <th width="10%">{{ __('Date') }}</th>
                                                <th width="10%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($inquiries as $inquiry)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <div>
                                                            <div class="font-weight-bold">{{ $inquiry->name }}</div>
                                                            <small class="text-muted">{{ $inquiry->email }}</small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">{{ Str::limit($inquiry->realEstate?->title ?? 'N/A', 30) }}</div>
                                                        <small class="text-muted">{{ $inquiry->realEstate?->location_string ?? '' }}</small>
                                                    </td>
                                                    <td>
                                                        <div>{{ $inquiry->phone }}</div>
                                                        @if($inquiry->preferred_contact_method === 'email')
                                                            <small class="text-primary">{{ __('Email preferred') }}</small>
                                                        @else
                                                            <small class="text-primary">{{ __('Phone preferred') }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select onchange="changeStatus({{ $inquiry->id }}, this.value)" class="form-select form-select-sm">
                                                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                                            <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                            <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>{{ __('Contacted') }}</option>
                                                            <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                                                        </select>
                                                    </td>
                                                    <td>{{ formattedDate($inquiry->created_at) }}</td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.real-estate.inquiries.show', $inquiry->id)" />
                                                        <x-admin.delete-button :id="$inquiry->id" onclick="deleteData" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Inquiry')" route="" create="no"
                                                    :message="__('No inquiries found!')" colspan="7" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if (request()->get('par-page') !== 'all')
                                    <div class="float-right">
                                        {{ $inquiries->onEachSide(0)->links() }}
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
@endsection

@push('js')
<script>
function changeStatus(id, status) {
    $.ajax({
        url: "{{ route('admin.real-estate.inquiries.status-update', ':id') }}".replace(':id', id),
        type: 'PUT',
        data: {
            status: status,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            toastr.success(response.message);
        },
        error: function(xhr) {
            toastr.error('{{ __("Something went wrong!") }}');
        }
    });
}

function deleteData(id) {
    $('#deleteForm').attr('action', "{{ route('admin.real-estate.inquiries.destroy', ':id') }}".replace(':id', id));
    $('#deleteModal').modal('show');
}
</script>
@endpush