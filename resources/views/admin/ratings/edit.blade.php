@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Rating') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Edit Rating') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Rating List') => route('admin.rating.index'),
                __('Edit Rating') => '#',
            ]" />
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.rating.update', $rating->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lawyer_id">{{ __('Lawyer') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="lawyer_id" id="lawyer_id" class="form-control" required>
                                                    <option value="">{{ __('Select Lawyer') }}</option>
                                                    @foreach ($lawyers as $lawyer)
                                                        <option value="{{ $lawyer->id }}"
                                                            {{ old('lawyer_id', $rating->lawyer_id) == $lawyer->id ? 'selected' : '' }}>
                                                            {{ $lawyer->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('lawyer_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_id">{{ __('Client') }} <span
                                                        class="text-muted">({{ __('Optional') }})</span></label>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="">{{ __('Select Client') }}</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            {{ old('user_id', $rating->user_id) == $client->id ? 'selected' : '' }}>
                                                            {{ $client->name }} ({{ $client->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rating">{{ __('Rating') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="rating" id="rating" class="form-control" required>
                                                    <option value="">{{ __('Select Rating') }}</option>
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ old('rating', $rating->rating) == $i ? 'selected' : '' }}>
                                                            {{ $i }} {{ __('Stars') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('rating')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="1"
                                                        {{ old('status', $rating->status) == 1 ? 'selected' : '' }}>
                                                        {{ __('Active') }}
                                                    </option>
                                                    <option value="0"
                                                        {{ old('status', $rating->status) == 0 ? 'selected' : '' }}>
                                                        {{ __('Inactive') }}
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">{{ __('Comment') }}</label>
                                                <textarea name="comment" id="comment" class="form-control" rows="4"
                                                    placeholder="{{ __('Enter comment (optional)') }}">{{ old('comment', $rating->comment) }}</textarea>
                                                @error('comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <x-admin.button type="submit" :text="__('Update')" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

