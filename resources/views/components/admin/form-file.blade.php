@props([
    'id' => '',
    'name' => '',
    'label' => null,
    'accept' => '*/*',
    'required' => false,
    'error' => true,
])

@if ($label)
    <label for="{{ $id }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
@endif
<input type="file" id="{{ $id }}" name="{{ $name }}" accept="{{ $accept }}" {{ $attributes->merge(['class' => 'form-control']) }}>
@if($attributes->has('multiple'))
    <small class="form-text text-muted">{{ __('You can select multiple files') }}</small>
@endif
@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror