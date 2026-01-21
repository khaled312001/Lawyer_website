@extends('admin.master_layout')
@section('title')
    <title>{{ __('Homepage Departments Management') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Homepage Departments Management') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Department') => route('admin.department.index'),
                __('Homepage Departments Management') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Settings Card --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Homepage Settings') }}</h4>
                            </div>
                            <div class="card-body">
                                <form id="homepageCountForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Number of Departments to Display') }}</label>
                                                <input type="number" name="count" class="form-control" 
                                                    value="{{ $sectionControl?->department_how_many ?? 6 }}" 
                                                    min="1" max="20" required>
                                                <small class="text-muted">{{ __('How many departments to show on homepage') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> {{ __('Update Count') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Departments List --}}
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Departments') }}</h4>
                                <p class="text-muted mb-0">{{ __('Select which departments appear on the homepage and drag to reorder') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="departmentsTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('Order') }}</th>
                                                <th width="10%">{{ __('Image') }}</th>
                                                <th width="25%">{{ __('Name') }}</th>
                                                <th width="15%">{{ __('Status') }}</th>
                                                <th width="15%">{{ __('Show on Homepage') }}</th>
                                                <th width="10%">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable">
                                            @foreach ($departments as $department)
                                                <tr data-id="{{ $department->id }}" class="department-row {{ $department->show_homepage ? 'table-success' : '' }}">
                                                    <td>
                                                        <i class="fas fa-grip-vertical text-muted" style="cursor: move;"></i>
                                                        <span class="order-number">{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset($department->thumbnail_image ?? 'client/images/default-image.jpg') }}" 
                                                            alt="{{ $department->name }}" 
                                                            class="img-thumbnail" 
                                                            style="width: 60px; height: 60px; object-fit: cover;"
                                                            onerror="this.src='{{ asset('client/images/default-image.jpg') }}'">
                                                    </td>
                                                    <td>
                                                        <strong>{{ $department->name ?? __('Untitled') }}</strong>
                                                        @if($department->translation)
                                                            <br>
                                                            <small class="text-muted">{{ Str::limit($department->translation->description ?? '', 50) }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input onchange="changeStatus({{ $department->id }})"
                                                            id="status_toggle_{{ $department->id }}" type="checkbox"
                                                            {{ $department->status == 1 ? 'checked' : '' }} 
                                                            data-toggle="toggle"
                                                            data-onlabel="{{ __('Active') }}"
                                                            data-offlabel="{{ __('Inactive') }}" 
                                                            data-onstyle="success"
                                                            data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <input onchange="changeHomepageStatus({{ $department->id }}, this.checked)"
                                                            id="homepage_toggle_{{ $department->id }}" type="checkbox"
                                                            {{ $department->show_homepage ? 'checked' : '' }} 
                                                            data-toggle="toggle"
                                                            data-onlabel="{{ __('Yes') }}"
                                                            data-offlabel="{{ __('No') }}" 
                                                            data-onstyle="success"
                                                            data-offstyle="secondary">
                                                    </td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.department.edit', [
                                                            'department' => $department->id,
                                                            'code' => getSessionLanguage(),
                                                        ])" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
<style>
    .department-row {
        cursor: move;
    }
    .department-row.ui-sortable-helper {
        background: #f8f9fa;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .table-success {
        background-color: #d4edda !important;
    }
    .order-number {
        font-weight: 600;
        color: #6777ef;
        margin-left: 8px;
    }
    #sortable tr {
        transition: background-color 0.3s ease;
    }
</style>
@endpush

@push('js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        // Make table rows sortable
        $("#sortable").sortable({
            handle: '.fa-grip-vertical',
            placeholder: "ui-state-highlight",
            axis: 'y',
            update: function(event, ui) {
                updateOrder();
            }
        });
        $("#sortable").disableSelection();

        // Update order numbers
        function updateOrderNumbers() {
            $('#sortable tr').each(function(index) {
                $(this).find('.order-number').text(index + 1);
            });
        }

        // Update order on server
        function updateOrder() {
            var order = [];
            $('#sortable tr').each(function() {
                order.push($(this).data('id'));
            });

            $.ajax({
                url: "{{ route('admin.department.homepage-order') }}",
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: order
                },
                success: function(response) {
                    toastr.success(response.message);
                    updateOrderNumbers();
                },
                error: function(xhr) {
                    toastr.error('{{ __("Something went wrong!") }}');
                }
            });
        }

        // Homepage count form
        $('#homepageCountForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            
            $.ajax({
                url: "{{ route('admin.department.homepage-count') }}",
                type: 'PUT',
                data: formData,
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error('{{ __("Something went wrong!") }}');
                }
            });
        });
    });

    function changeStatus(id) {
        $.ajax({
            url: "{{ route('admin.department.status-update', ':id') }}".replace(':id', id),
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

    function changeHomepageStatus(id, status) {
        $.ajax({
            url: "{{ route('admin.department.homepage-status', ':id') }}".replace(':id', id),
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                show_homepage: status ? 1 : 0
            },
            success: function(response) {
                toastr.success(response.message);
                // Update row background
                var row = $('#homepage_toggle_' + id).closest('tr');
                if (status) {
                    row.addClass('table-success');
                } else {
                    row.removeClass('table-success');
                }
            },
            error: function(xhr) {
                toastr.error('{{ __("Something went wrong!") }}');
                // Revert toggle
                $('#homepage_toggle_' + id).bootstrapToggle('toggle');
            }
        });
    }
</script>
@endpush
