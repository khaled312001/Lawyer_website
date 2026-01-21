@props([
    'div_id' => 'image-preview',
    'label_id' => 'image-label',
    'input_id' => 'image-upload',
    'name' => 'image',
    'label' => __('Thumbnail Image'),
    'button_label' => __('Upload Image'),
    'required' => true,
    'image' => null,
    'recommended' => null,
    'recommended_class' => null,
])

@php
    // Ensure image path is valid
    $imageUrl = null;
    if ($image) {
        // Check if it's already a full URL
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            $imageUrl = $image;
        } else {
            // Check if file exists
            $imagePath = public_path($image);
            if (file_exists($imagePath)) {
                $imageUrl = asset($image);
            } else {
                // Try with storage path
                $storagePath = storage_path('app/public/' . $image);
                if (file_exists($storagePath)) {
                    $imageUrl = asset('storage/' . $image);
                }
            }
        }
    }
@endphp

<label>{{ $label }} @if($required)<span class="text-danger">*</span> @endif @if($recommended)<code class="{{$recommended_class}}">({{ __('Recommended') }}: {{$recommended}} PX)</code>@endif</label>
<div id="{{ $div_id }}" {{ $attributes->merge(['class' => 'image-preview']) }}
    @if ($imageUrl) style="background-image: url({{ $imageUrl }});" @endif>
    <label for="{{ $input_id }}" id="{{ $label_id }}">{{ $button_label }}</label>
    <input type="file" name="{{ $name }}" id="{{ $input_id }}" accept="image/*">
</div>
@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror