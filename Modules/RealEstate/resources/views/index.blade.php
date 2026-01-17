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
                            <div class="card-body p-0">
                                <div class="real-estate-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="3%">{{ __('SN') }}</th>
                                                    <th width="22%">{{ __('Property') }}</th>
                                                    <th width="10%">{{ __('Type') }}</th>
                                                    <th width="10%">{{ __('Price') }}</th>
                                                    <th width="8%">{{ __('Area') }}</th>
                                                    <th width="10%">{{ __('Location') }}</th>
                                                    <th width="8%">{{ __('Featured') }}</th>
                                                    <th width="8%">{{ __('Status') }}</th>
                                                    <th width="11%">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($realEstates as $realEstate)
                                                    <tr>
                                                        <td>
                                                            <span style="display: inline-block; width: 30px; height: 30px; line-height: 30px; text-align: center; background: linear-gradient(135deg, #6777ef 0%, #764ba2 100%); color: #fff; border-radius: 50%; font-weight: 600; font-size: 13px;">
                                                                {{ $loop->index + 1 }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="property-info-cell">
                                                                <div class="avatar">
                                                                    <img src="{{ $realEstate->main_image_url }}" alt="{{ $realEstate->title }}" onerror="this.src='{{ asset('uploads/website-images/default-property.png') }}'">
                                                                </div>
                                                                <div class="property-details">
                                                                    <div class="property-title">{{ Str::limit($realEstate->title, 35) }}</div>
                                                                    <div class="property-meta">
                                                                        <span class="badge badge-primary">{{ $realEstate->property_type_label }}</span>
                                                                        <span class="badge badge-info">{{ $realEstate->listing_type_label }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="property-type-badge {{ strtolower($realEstate->property_type) }}">
                                                                {{ $realEstate->property_type_label }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="property-price">{{ $realEstate->formatted_price }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="property-area">{{ $realEstate->formatted_area }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="property-location">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                <span>{{ Str::limit($realEstate->location_string, 25) }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input onchange="changeFeatured({{ $realEstate->id }})"
                                                                id="featured_toggle_{{ $realEstate->id }}" type="checkbox"
                                                                {{ $realEstate->featured ? 'checked' : '' }} data-toggle="toggle"
                                                                data-onlabel="{{ __('Yes') }}"
                                                                data-offlabel="{{ __('No') }}" data-onstyle="success"
                                                                data-offstyle="secondary" data-size="small">
                                                        </td>
                                                        <td>
                                                            <input onchange="changeStatus({{ $realEstate->id }})"
                                                                id="status_toggle_{{ $realEstate->id }}" type="checkbox"
                                                                {{ $realEstate->status === 'active' ? 'checked' : '' }} data-toggle="toggle"
                                                                data-onlabel="{{ __('Active') }}"
                                                                data-offlabel="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger" data-size="small">
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <x-admin.edit-button :href="route('admin.real-estate.edit', [
                                                                    'real_estate' => $realEstate->id,
                                                                    'code' => getSessionLanguage(),
                                                                ])" />
                                                                <x-admin.delete-button :id="$realEstate->id" onclick="deleteData" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9">
                                                            <div class="empty-state">
                                                                <i class="fas fa-building"></i>
                                                                <h4>{{ __('No Properties Found') }}</h4>
                                                                <p>{{ __('No real estate properties found matching your criteria.') }}</p>
                                                                <a href="{{ route('admin.real-estate.create') }}" class="btn btn-primary">
                                                                    <i class="fas fa-plus"></i> {{ __('Add New Property') }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if (request()->get('par-page') !== 'all' && $realEstates->hasPages())
                                    <div class="pagination-wrapper">
                                        <div class="float-right">
                                            {{ $realEstates->onEachSide(0)->links() }}
                                        </div>
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

@push('css')
<style>
    /* Enhanced Real Estate Table Design */
    .real-estate-table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .real-estate-table-wrapper .table {
        margin-bottom: 0;
        background: #fff;
    }

    .real-estate-table-wrapper .table thead {
        background: linear-gradient(135deg, #6777ef 0%, #764ba2 100%);
        color: #fff;
    }

    .real-estate-table-wrapper .table thead th {
        padding: 16px 12px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        white-space: nowrap;
        vertical-align: middle;
    }

    .real-estate-table-wrapper .table thead th:first-child {
        border-top-left-radius: 12px;
        padding-left: 20px;
    }

    .real-estate-table-wrapper .table thead th:last-child {
        border-top-right-radius: 12px;
        padding-right: 20px;
    }

    .real-estate-table-wrapper .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .real-estate-table-wrapper .table tbody tr:hover {
        background: #f8f9ff;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(103, 119, 239, 0.1);
    }

    .real-estate-table-wrapper .table tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
    }

    .real-estate-table-wrapper .table tbody td:first-child {
        padding-left: 20px;
        font-weight: 600;
        color: #6777ef;
    }

    .real-estate-table-wrapper .table tbody td:last-child {
        padding-right: 20px;
    }

    /* Property Image & Info */
    .property-info-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .property-info-cell .avatar {
        width: 60px;
        height: 60px;
        min-width: 60px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .real-estate-table-wrapper .table tbody tr:hover .property-info-cell .avatar {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(103, 119, 239, 0.2);
    }

    .property-info-cell .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-info-cell .property-details {
        flex: 1;
        min-width: 0;
    }

    .property-info-cell .property-details .property-title {
        font-weight: 600;
        font-size: 15px;
        color: #2c3e50;
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .property-info-cell .property-details .property-meta {
        font-size: 12px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .property-info-cell .property-details .property-meta .badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    /* Type Badge */
    .property-type-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .property-type-badge.apartment {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .property-type-badge.villa {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: #fff;
    }

    .property-type-badge.office {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: #fff;
    }

    .property-type-badge.land {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: #fff;
    }

    .property-type-badge.shop {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: #fff;
    }

    .property-type-badge.warehouse {
        background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        color: #fff;
    }

    /* Price Styling */
    .property-price {
        font-weight: 700;
        font-size: 15px;
        color: #28a745;
        white-space: nowrap;
    }

    /* Area Styling */
    .property-area {
        font-weight: 600;
        font-size: 14px;
        color: #495057;
    }

    /* Location Styling */
    .property-location {
        font-size: 13px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .property-location i {
        color: #6777ef;
        font-size: 12px;
    }

    /* Toggle Switches */
    .real-estate-table-wrapper .toggle {
        min-width: 60px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .action-buttons .btn {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
    }

    .action-buttons .btn i {
        font-size: 14px;
    }

    .action-buttons .btn-warning {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: #fff !important;
        border: none !important;
    }

    .action-buttons .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
    }

    .action-buttons .btn-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
        color: #fff !important;
        border: none !important;
    }

    .action-buttons .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%) !important;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge.active {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .status-badge.sold {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.rented {
        background: #d1ecf1;
        color: #0c5460;
    }

    /* Featured Badge */
    .featured-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .featured-badge.featured {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: #fff;
    }

    .featured-badge.not-featured {
        background: #e9ecef;
        color: #6c757d;
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        color: #6c757d;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #adb5bd;
        margin-bottom: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .real-estate-table-wrapper {
            border-radius: 8px;
        }

        .real-estate-table-wrapper .table thead th {
            padding: 12px 8px;
            font-size: 12px;
        }

        .real-estate-table-wrapper .table tbody td {
            padding: 12px 8px;
        }

        .property-info-cell {
            gap: 8px;
        }

        .property-info-cell .avatar {
            width: 50px;
            height: 50px;
            min-width: 50px;
        }

        .property-info-cell .property-details .property-title {
            font-size: 13px;
        }

        .property-info-cell .property-details .property-meta {
            font-size: 11px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }

        .action-buttons .btn {
            width: 100%;
            font-size: 12px;
            padding: 5px 10px;
        }
    }

    /* Card Header Enhancement */
    .card-header {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border-bottom: 2px solid #e9ecef;
        padding: 20px;
    }

    /* Pagination Enhancement */
    .pagination-wrapper {
        padding: 20px;
        background: #f8f9ff;
        border-top: 1px solid #e9ecef;
    }
</style>
@endpush

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