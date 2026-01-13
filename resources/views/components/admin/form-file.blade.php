@props([
    'id' => null,
    'name' => '',
    'label' => null,
    'accept' => '*/*',
    'multiple' => false,
    'required' => false,
])

@php
    $inputId = $id ?? $name;
@endphp

@if ($label)
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
@endif
<input type="file" id="{{ $inputId }}" name="{{ $name }}" accept="{{ $accept }}" {{ $multiple ? 'multiple' : '' }} {{ $attributes->merge(['class' => 'form-control']) }}>
@if($multiple)
    <small class="form-text text-muted">{{ __('You can select multiple files') }}</small>
@endif
@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror