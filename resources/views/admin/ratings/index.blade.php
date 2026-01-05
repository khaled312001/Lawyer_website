@extends('admin.master_layout')
@section('title')
    <title>{{ __('Rating List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Rating List') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Rating List') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ route('admin.rating.index') }}" method="GET"
                                    onchange="$(this).trigger('submit')" class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="lawyer_id" id="lawyer_id" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Lawyer') }}" />
                                                @foreach ($lawyers as $lawyer)
                                                    <x-admin.select-option :selected="request('lawyer_id') == $lawyer->id"
                                                        :value="$lawyer->id" :text="$lawyer->name" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="rating" id="rating" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Rating') }}" />
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <x-admin.select-option :selected="request('rating') == $i" :value="$i"
                                                        :text="$i . ' ' . __('Stars')" />
                                                @endfor
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="type" id="type" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('All Types') }}" />
                                                <x-admin.select-option :selected="request('type') == 'client'" value="client"
                                                    text="{{ __('Client Ratings') }}" />
                                                <x-admin.select-option :selected="request('type') == 'admin'" value="admin"
                                                    text="{{ __('Admin Ratings') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == '1'" value="1"
                                                    text="{{ __('Active') }}" />
                                                <x-admin.select-option :selected="request('status') == '0'" value="0"
                                                    text="{{ __('Inactive') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="order_by" id="order_by" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Order By') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '1'" value="1"
                                                    text="{{ __('ASC') }}" />
                                                <x-admin.select-option :selected="request('order_by') == '0'" value="0"
                                                    text="{{ __('DESC') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-1 form-group mb-3 mb-md-0">
                                            <button class="btn btn-primary w-100" type="submit"><i
                                                    class="fas fa-search"></i></button>
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
                                    <x-admin.add-button :href="route('admin.rating.create')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th width="15%">{{ __('Lawyer') }}</th>
                                                <th width="15%">{{ __('Client/Admin') }}</th>
                                                <th width="10%">{{ __('Rating') }}</th>
                                                <th width="25%">{{ __('Comment') }}</th>
                                                <th width="10%">{{ __('Type') }}</th>
                                                <th width="10%">{{ __('Status') }}</th>
                                                <th width="10%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ratings as $rating)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $rating->lawyer->name ?? __('N/A') }}</td>
                                                    <td>
                                                        @if ($rating->user)
                                                            {{ $rating->user->name }}
                                                        @elseif ($rating->is_admin_created)
                                                            {{ __('Admin') }}
                                                        @else
                                                            {{ __('N/A') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            <span class="ms-1">{{ $rating->rating }}/5</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $rating->comment ? \Illuminate\Support\Str::limit($rating->comment, 50) : __('No comment') }}</td>
                                                    <td>
                                                        @if ($rating->is_admin_created)
                                                            <span class="badge bg-info">{{ __('Admin') }}</span>
                                                        @else
                                                            <span class="badge bg-success">{{ __('Client') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input onchange="changeStatus({{ $rating->id }})"
                                                            id="status_toggle" type="checkbox"
                                                            {{ $rating->status ? 'checked' : '' }} data-toggle="toggle"
                                                            data-onlabel="{{ __('Active') }}"
                                                            data-offlabel="{{ __('Inactive') }}" data-onstyle="success"
                                                            data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.rating.edit', $rating->id)" />
                                                        <x-admin.delete-button :id="$rating->id" onclick="deleteData" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Rating')" route="admin.rating.create" create="yes"
                                                    :message="__('No data found!')" colspan="8" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if (request()->get('par-page') !== 'all')
                                    <div class="float-right">
                                        {{ $ratings->onEachSide(0)->links() }}
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
    <script>
        function changeStatus(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo === 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                url: `{{ url('/admin/rating-status/') }}/${id}`,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function deleteData(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo === 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $("#deleteForm").attr("action", '{{ url('admin/rating/') }}/' + id)
        }
    </script>
@endsection

