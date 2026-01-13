@extends('admin.master_layout')
@section('title')
    <title>{{ __('Real Estate Properties') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Real Estate Properties') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Real Estate Properties') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ route('admin.real-estate.index') }}" method="GET"
                                    onchange="$(this).trigger('submit')" class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 form-group mb-3 mb-md-0">
                                            <div class="input-group">
                                                <x-admin.form-input name="keyword" placeholder="{{ __('Search by title or description') }}"
                                                    value="{{ request()->get('keyword') }}" />
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="property_type" id="property_type" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Property Type') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'apartment'" value="apartment"
                                                    text="{{ __('Apartment') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'villa'" value="villa"
                                                    text="{{ __('Villa') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'office'" value="office"
                                                    text="{{ __('Office') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'land'" value="land"
                                                    text="{{ __('Land') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'shop'" value="shop"
                                                    text="{{ __('Shop') }}" />
                                                <x-admin.select-option :selected="request('property_type') == 'warehouse'" value="warehouse"
                                                    text="{{ __('Warehouse') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="listing_type" id="listing_type" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Listing Type') }}" />
                                                <x-admin.select-option :selected="request('listing_type') == 'sale'" value="sale"
                                                    text="{{ __('For Sale') }}" />
                                                <x-admin.select-option :selected="request('listing_type') == 'rent'" value="rent"
                                                    text="{{ __('For Rent') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == 'active'" value="active"
                                                    text="{{ __('Active') }}" />
                                                <x-admin.select-option :selected="request('status') == 'inactive'" value="inactive"
                                                    text="{{ __('Inactive') }}" />
                                                <x-admin.select-option :selected="request('status') == 'sold'" value="sold"
                                                    text="{{ __('Sold') }}" />
                                                <x-admin.select-option :selected="request('status') == 'rented'" value="rented"
                                                    text="{{ __('Rented') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-1 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="featured" id="featured" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Featured') }}" />
                                                <x-admin.select-option :selected="request('featured') == '1'" value="1"
                                                    text="{{ __('Yes') }}" />
                                                <x-admin.select-option :selected="request('featured') == '0'" value="0"
                                                    text="{{ __('No') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="par-page" id="par-page" class="form-select">
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

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <x-admin.add-button :href="route('admin.real-estate.create')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="3%">{{ __('SN') }}</th>
                                                <th width="20%">{{ __('Property') }}</th>
                                                <th width="10%">{{ __('Type') }}</th>
                                                <th width="8%">{{ __('Price') }}</th>
                                                <th width="8%">{{ __('Area') }}</th>
                                                <th width="8%">{{ __('Location') }}</th>
                                                <th width="6%">{{ __('Featured') }}</th>
                                                <th width="8%">{{ __('Status') }}</th>
                                                <th width="10%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($realEstates as $realEstate)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-3">
                                                                <img src="{{ $realEstate->main_image_url }}" alt="{{ $realEstate->title }}" class="rounded">
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold">{{ Str::limit($realEstate->title, 30) }}</div>
                                                                <small class="text-muted">{{ $realEstate->property_type_label }} • {{ $realEstate->listing_type_label }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $realEstate->property_type_label }}</td>
                                                    <td>{{ $realEstate->formatted_price }}</td>
                                                    <td>{{ $realEstate->formatted_area }}</td>
                                                    <td>{{ Str::limit($realEstate->location_string, 20) }}</td>
                                                    <td>
                                                        <input onchange="changeFeatured({{ $realEstate->id }})"
                                                            id="featured_toggle_{{ $realEstate->id }}" type="checkbox"
                                                            {{ $realEstate->featured ? 'checked' : '' }} data-toggle="toggle"
                                                            data-onlabel="{{ __('Yes') }}"
                                                            data-offlabel="{{ __('No') }}" data-onstyle="success"
                                                            data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <input onchange="changeStatus({{ $realEstate->id }})"
                                                            id="status_toggle_{{ $realEstate->id }}" type="checkbox"
                                                            {{ $realEstate->status === 'active' ? 'checked' : '' }} data-toggle="toggle"
                                                            data-onlabel="{{ __('Active') }}"
                                                            data-offlabel="{{ __('Inactive') }}" data-onstyle="success"
                                                            data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.real-estate.edit', [
                                                            'real_estate' => $realEstate->id,
                                                            'code' => getSessionLanguage(),
                                                        ])" />
                                                        <x-admin.delete-button :id="$realEstate->id" onclick="deleteData" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Real Estate Property')" route="admin.real-estate.create"
                                                    create="yes" :message="__('No properties found!')" colspan="9" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if (request()->get('par-page') !== 'all')
                                    <div class="float-right">
                                        {{ $realEstates->onEachSide(0)->links() }}
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
function changeStatus(id) {
    $.ajax({
        url: "{{ route('admin.real-estate.status-update', ':id') }}".replace(':id', id),
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            toastr.success(response.message);
        },
        error: function(xhr) {
            toastr.error('{{ __("Something went wrong!") }}');
        }
    });
}

function changeFeatured(id) {
    $.ajax({
        url: "{{ route('admin.real-estate.featured-update', ':id') }}".replace(':id', id),
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
    $('#deleteForm').attr('action', "{{ route('admin.real-estate.destroy', ':id') }}".replace(':id', id));
    $('#deleteModal').modal('show');
}
</script>
@endpush