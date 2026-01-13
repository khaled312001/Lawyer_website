<?php

namespace Modules\RealEstate\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'property_type' => 'required|string|in:apartment,villa,office,land,shop,warehouse',
            'listing_type' => 'required|string|in:sale,rent',
            'city' => 'required|string|max:100',
            'district' => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bedrooms' => 'nullable|integer|min:0|max:50',
            'bathrooms' => 'nullable|integer|min:0|max:50',
            'area' => 'required|numeric|min:1|max:999999',
            'floor' => 'nullable|integer|min:0|max:200',
            'total_floors' => 'nullable|integer|min:1|max:200',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0|max:999999999',
            'currency' => 'required|string|size:3|in:USD,EUR,EGP,SAR',
            'price_per_sqm' => 'nullable|numeric|min:0|max:999999',
            'features' => 'nullable|array',
            'features.*' => 'string|max:100',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'status' => 'required|string|in:active,inactive,sold,rented',
            'featured' => 'boolean',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|array',
            'seo_keywords.*' => 'string|max:50',
        ];

        // Add image validation for create
        if ($this->isMethod('post')) {
            $rules['images'] = 'nullable|array|max:20';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['featured_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // Add image validation for update (optional)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['images'] = 'nullable|array|max:20';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['featured_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // Add translation validation for all languages
        $languages = allLanguages();
        foreach ($languages as $language) {
            $rules[$language->code . '_title'] = 'required|string|max:255';
            $rules[$language->code . '_description'] = 'required|string|max:5000';
            $rules[$language->code . '_seo_title'] = 'nullable|string|max:255';
            $rules[$language->code . '_seo_description'] = 'nullable|string|max:500';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'property_type' => __('Property Type'),
            'listing_type' => __('Listing Type'),
            'city' => __('City'),
            'district' => __('District'),
            'neighborhood' => __('Neighborhood'),
            'address' => __('Address'),
            'latitude' => __('Latitude'),
            'longitude' => __('Longitude'),
            'bedrooms' => __('Bedrooms'),
            'bathrooms' => __('Bathrooms'),
            'area' => __('Area'),
            'floor' => __('Floor'),
            'total_floors' => __('Total Floors'),
            'year_built' => __('Year Built'),
            'price' => __('Price'),
            'currency' => __('Currency'),
            'price_per_sqm' => __('Price per Square Meter'),
            'features' => __('Features'),
            'amenities' => __('Amenities'),
            'status' => __('Status'),
            'featured' => __('Featured'),
            'contact_name' => __('Contact Name'),
            'contact_phone' => __('Contact Phone'),
            'contact_email' => __('Contact Email'),
            'seo_title' => __('SEO Title'),
            'seo_description' => __('SEO Description'),
            'seo_keywords' => __('SEO Keywords'),
            'images' => __('Images'),
            'featured_image' => __('Featured Image'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'images.max' => __('You can upload a maximum of 20 images.'),
            'images.*.max' => __('Each image must not exceed 2MB.'),
            'images.*.mimes' => __('Images must be in JPEG, PNG, JPG, GIF, or WebP format.'),
            'featured_image.max' => __('Featured image must not exceed 2MB.'),
            'featured_image.mimes' => __('Featured image must be in JPEG, PNG, JPG, GIF, or WebP format.'),
        ];
    }
}