@extends('admin.master_layout')
@section('title')
    <title>{{ __('Lawyer List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Lawyer List') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Lawyer List') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Search filter --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="{{ route('admin.lawyer.index') }}" method="GET"
                                    onchange="$(this).trigger('submit')" class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3 mb-md-0">
                                            <div class="input-group">
                                                <x-admin.form-input name="keyword" placeholder="{{ __('Search') }}"
                                                    value="{{ request()->get('keyword') }}" />
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="show_homepage" id="show_homepage"
                                                class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Show Homepage') }}" />
                                                <x-admin.select-option :selected="request('show_homepage') == '1'" value="1"
                                                    text="{{ __('Yes') }}" />
                                                <x-admin.select-option :selected="request('show_homepage') == '0'" value="0"
                                                    text="{{ __('No') }}" />
                                            </x-admin.form-select>
                                        </div>
                                        <div class="col-md-2 form-group mb-3 mb-md-0">
                                            <x-admin.form-select name="status" id="status" class="form-select">
                                                <x-admin.select-option value="" text="{{ __('Select Status') }}" />
                                                <x-admin.select-option :selected="request('status') == '1'" value="1"
                                                    text="{{ __('Yes') }}" />
                                                <x-admin.select-option :selected="request('status') == '0'" value="0"
                                                    text="{{ __('No') }}" />
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
                                    @adminCan('lawyer.update')
                                        @if ($lawyers->where('email_verified_at', null)->count())
                                            <x-admin.button variant="success" class="me-2" data-bs-toggle="modal"
                                                data-bs-target="#verifyModal" :text="__('Send Verify Link to All')" />
                                        @endif
                                    @endadminCan
                                    @adminCan('rating.create')
                                        <x-admin.button variant="info" class="me-2" data-bs-toggle="modal"
                                            data-bs-target="#fakeReviewModal" :text="__('Add Fake Review')" />
                                    @endadminCan
                                    <form action="{{ route('admin.rating.add-high-ratings-to-all') }}" method="POST" class="d-inline-block me-2" onsubmit="return confirm('{{ __('Are you sure you want to add high ratings (5-10 reviews per lawyer with 4-5 stars) to all lawyers?') }}');">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-star"></i> {{ __('Add High Ratings to All Lawyers') }}
                                        </button>
                                    </form>
                                    <x-admin.add-button :href="route('admin.lawyer.create')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th width="15%">{{ __('Name') }}</th>
                                                <th width="10%">{{ __('Department') }}</th>
                                                <th width="10%">{{ __('Location') }}</th>
                                                <th width="10%">{{ __('Show Homepage') }}</th>
                                                <th width="15%">{{ __('Status') }}</th>
                                                <th width="15%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lawyers as $lawyer)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lawyer->name }}</td>
                                                    <td>{{ $lawyer?->department?->name }}</td>
                                                    <td>{{ $lawyer?->location?->name }}</td>

                                                    <td>
                                                        @if ($lawyer->show_homepage == 1)
                                                            <span class="badge bg-success">{{ __('Yes') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('No') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($lawyer?->email_verified_at)
                                                            <input onchange="changeStatus({{ $lawyer->id }})"
                                                                id="status_toggle" type="checkbox"
                                                                {{ $lawyer->status ? 'checked' : '' }} data-toggle="toggle"
                                                                data-onlabel="{{ __('Active') }}"
                                                                data-offlabel="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger">
                                                        @else
                                                            <span class="badge bg-warning">{{ __('Not verified') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.lawyer.edit', [
                                                            'lawyer' => $lawyer->id,
                                                            'code' => getSessionLanguage(),
                                                        ])" />
                                                        @adminCan('rating.create')
                                                            <button type="button" class="btn btn-sm btn-info me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#fakeReviewModal{{ $lawyer->id }}"
                                                                title="{{ __('Add Fake Review') }}">
                                                                <i class="fas fa-star"></i>
                                                            </button>
                                                        @endadminCan
                                                        <x-admin.delete-button :id="$lawyer->id" onclick="deleteData" />
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Lawyer')" route="admin.lawyer.create" create="yes"
                                                    :message="__('No data found!')" colspan="7" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if (request()->get('par-page') !== 'all')
                                    <div class="float-right">
                                        {{ $lawyers->onEachSide(0)->links() }}
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
    @adminCan('lawyer.update')
        @if ($lawyers->where('email_verified_at', null)->count())
            <!-- Start Verify modal -->
            <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Send verify link to Lawyer mail') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <p>{{ __('Are you sure want to send verify link to lawyer mail?') }}</p>

                                <form action="{{ route('admin.lawyer-send-verify-mail-to-all', $lawyer->id) }}"
                                    method="POST">
                                    @csrf

                            </div>
                        </div>
                        <div class="modal-footer">
                            <x-admin.button variant="danger" data-bs-dismiss="modal" text="{{ __('Close') }}" />
                            <x-admin.button type="submit" text="{{ __('Send Mail') }}" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Verify modal -->
        @endif
    @endadminCan

    @adminCan('rating.create')
        <!-- Fake Review Modal for All Lawyers -->
        <div class="modal fade" id="fakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="fakeReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fakeReviewModalLabel">{{ __('Add Fake Review') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.rating.fake-review', 0) }}" method="POST" id="fakeReviewForm">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label>{{ __('Select Lawyer') }}</label>
                                <select name="lawyer_id" class="form-select" required>
                                    <option value="">{{ __('Select Lawyer') }}</option>
                                    @foreach ($lawyers as $lawyer)
                                        <option value="{{ $lawyer->id }}">{{ $lawyer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ __('Rating') }} (1-5)</label>
                                <select name="rating" class="form-select" required>
                                    <option value="5" selected>5 ⭐</option>
                                    <option value="4">4 ⭐</option>
                                    <option value="3">3 ⭐</option>
                                    <option value="2">2 ⭐</option>
                                    <option value="1">1 ⭐</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ __('Comment') }} ({{ __('Optional') }})</label>
                                <textarea name="comment" class="form-control" rows="3" placeholder="{{ __('Leave empty for random comment') }}"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add Review') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Individual Fake Review Modals for Each Lawyer -->
        @foreach ($lawyers as $lawyer)
            <div class="modal fade" id="fakeReviewModal{{ $lawyer->id }}" tabindex="-1" role="dialog" aria-labelledby="fakeReviewModalLabel{{ $lawyer->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fakeReviewModalLabel{{ $lawyer->id }}">{{ __('Add Fake Review for') }}: {{ $lawyer->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.rating.fake-review', $lawyer->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label>{{ __('Rating') }} (1-5)</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="5" selected>5 ⭐</option>
                                        <option value="4">4 ⭐</option>
                                        <option value="3">3 ⭐</option>
                                        <option value="2">2 ⭐</option>
                                        <option value="1">1 ⭐</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>{{ __('Comment') }} ({{ __('Optional') }})</label>
                                    <textarea name="comment" class="form-control" rows="3" placeholder="{{ __('Leave empty for random comment') }}"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Add Review') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endadminCan
@endsection

@push('js')
    <script>
        "use strict"

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('/admin/lawyer/') }}' + "/" + id)
        }

        // Update fake review form action when lawyer is selected
        $(document).ready(function() {
            $('#fakeReviewForm select[name="lawyer_id"]').on('change', function() {
                var lawyerId = $(this).val();
                if (lawyerId) {
                    $('#fakeReviewForm').attr('action', '{{ url('/admin/ratings/lawyer/') }}/' + lawyerId + '/fake-review');
                }
            });
        });
        "use strict"

        function changeStatus(id) {
            var isDemo = "{{ env('APP_MODE') ?? 'LIVE' }}"
            if (isDemo == 'DEMO') {
                toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                url: "{{ url('/admin/lawyer/status-update') }}" + "/" + id,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>
@endpush

@push('css')
    <style>
        .dd-custom-css {
            position: absolute;
            will-change: transform;
            top: 0px;
            left: 0px;
            transform: translate3d(0px, -131px, 0px);
        }

        .max-h-400 {
            min-height: 400px;
        }
    </style>
@endpush
