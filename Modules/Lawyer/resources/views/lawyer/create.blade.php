@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Lawyer') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Create Lawyer') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Lawyer List') => route('admin.lawyer.index'),
                __('Create Lawyer') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <x-admin.back-button :href="route('admin.lawyer.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.lawyer.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-6">
                                            <x-admin.form-input id="name" name="name" label="{{ __('Name') }}"
                                                placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}"
                                                required="true" />
                                        </div>
                                        <div class="form-group col-lg-4  col-md-6">
                                            <x-admin.form-input id="phone" name="phone" label="{{ __('Phone') }}"
                                                placeholder="{{ __('Enter Phone') }}" value="{{ old('phone') }}"
                                                required="true" />
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6">
                                            <x-admin.form-input type="email" id="email" name="email"
                                                label="{{ __('Email') }}" placeholder="{{ __('Enter Email') }}"
                                                value="{{ old('email') }}" required="true" />
                                        </div>
                                        <div class="form-group col-lg-4  col-md-6">
                                            <x-admin.form-input type="password" id="password" name="password"
                                                label="{{ __('Password') }}" placeholder="{{ __('Enter Password') }}" required="true" />
                                        </div>
                                        <div class="form-group col-lg-4  col-md-6">
                                            <x-admin.form-input id="years_of_experience" name="years_of_experience" label="{{ __('Years of experience') }}"
                                                placeholder="{{ __('Enter Years of experience') }}" value="{{ old('years_of_experience') }}"
                                                required="true" />
                                        </div>
                                        <div class="form-group col-lg-4  col-md-6">
                                            <x-admin.form-input id="designations" name="designations"
                                                label="{{ __('Designations') }}"
                                                placeholder="{{ __('Enter Designations') }}"
                                                value="{{ old('designations') }}" required="true" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{ __('Departments') }} <span class="text-danger">*</span></label>
                                            <div class="row">
                                                @php $selectedDepartments = old('department_ids', []); @endphp
                                                @foreach ($departments as $department)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-check {{ app()->getLocale() === 'ar' ? 'form-check-reverse' : '' }}">
                                                            <input class="form-check-input" type="checkbox" name="department_ids[]" value="{{ $department->id }}" id="department_{{ $department->id }}" {{ in_array($department->id, $selectedDepartments) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="department_{{ $department->id }}">
                                                                {{ $department->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('department_ids')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <x-admin.form-textarea id="about" name="about"
                                                label="{{ __('About') }}"
                                                placeholder="{{ __('Enter About Information') }}"
                                                value="{{ old('about') }}" maxlength="2000" required="true" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-editor id="educations" name="educations"
                                                label="{{ __('Educations') }}" value="{!! old('educations') !!}"
                                                required="true" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <x-admin.form-editor id="experience" name="experience"
                                                label="{{ __('Experience') }}" value="{!! old('experience') !!}"
                                                required="true" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <x-admin.form-editor id="qualifications" name="qualifications"
                                                label="{{ __('Qualifications') }}" value="{!! old('qualifications') !!}"
                                                required="true" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-image-preview recommended="300X270" name="lawyer_image" label="{{__('Image')}}" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <x-admin.form-switch name="show_homepage"
                                                label="{{ __('Show on homepage') }}" :checked="old('show_homepage') == 1" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-switch name="status" label="{{ __('Status') }}"
                                                :checked="old('status') == Modules\Lawyer\app\Enums\LawyerStatus::ACTIVE->value" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-admin.save-button :text="__('Save')" />
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

@push('css')
<style>
.form-check-reverse {
    direction: rtl;
}
.form-check-reverse .form-check-input {
    margin-left: 0.25rem;
    margin-right: 0;
}
.form-check-reverse .form-check-label {
    margin-left: 0;
    margin-right: 0.25rem;
}
</style>
@endpush

@push('js')
    <script src="{{ asset('backend/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#name").on("keyup", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })
            });
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
@endpush
