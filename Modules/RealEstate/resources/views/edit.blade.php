@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Real Estate Property') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Edit Real Estate Property') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Real Estate Properties') => route('admin.real-estate.index'),
                __('Edit Property') => '#',
            ]" />
            <div class="section-body row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h5 class="m-0 service_card">{{ __('Available Translations') }}</h5>
                            @adminCan('real_estate.translate')
                                @if ($code !== $languages->first()->code)
                                    <x-admin.button onclick="translateAll()" id="translate-btn" text="{{ __('Translate') }}" />
                                @endif
                            @endadminCan
                        </div>
                        <div class="card-body">
                            <div class="lang_list_top">
                                <ul class="lang_list">
                                    @foreach ($languages = allLanguages() as $language)
                                        <li><a id="{{ request('code') == $language->code ? 'selected-language' : '' }}"
                                                href="{{ route('admin.real-estate.edit', ['real_estate' => $realEstate->id, 'code' => $language->code]) }}"><i
                                                    class="fas {{ request('code') == $language->code ? 'fa-eye' : 'fa-edit' }}"></i>
                                                {{ $language->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-2 alert alert-danger" role="alert">
                                @php
                                    $current_language = $languages->where('code', request()->get('code'))->first();
                                @endphp
                                <p>{{ __('Your editing mode') }}:<b> {{ $current_language?->name }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <x-admin.back-button :href="route('admin.real-estate.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.real-estate.update', [
                                    'real_estate' => $realEstate->id,
                                    'code' => $code,
                                ]) }}" method="POST" enctype="multipart/form-data" id="realEstateForm">
                                    @csrf
                                    @method('PUT')
                                    <ul class="nav nav-tabs" id="propertyTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">{{ __('Basic Information') }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button" role="tab" aria-controls="location" aria-selected="false">{{ __('Location') }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">{{ __('Property Details') }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial-tab" data-bs-toggle="tab" data-bs-target="#financial" type="button" role="tab" aria-controls="financial" aria-selected="false">{{ __('Financial') }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab" aria-controls="features" aria-selected="false">{{ __('Features & Media') }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">{{ __('Contact & SEO') }}</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-4" id="propertyTabsContent">
                                        {{-- Basic Information Tab --}}
                                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-input id="en_title" name="en_title" label="{{ __('Title (English)') }}" placeholder="{{ __('Enter property title') }}" value="{{ $realEstate?->getTranslation('en')?->title ?? old('en_title') }}" required="true"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-input id="ar_title" name="ar_title" label="{{ __('Title (Arabic)') }}" placeholder="{{ __('أدخل عنوان العقار') }}" value="{{ $realEstate?->getTranslation('ar')?->title ?? old('ar_title') }}" required="true"/>
                                                </div>
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-select name="property_type" id="property_type" label="{{ __('Property Type') }}" required="true">
                                                            <x-admin.select-option value="" text="{{ __('Select Property Type') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'apartment'" value="apartment" text="{{ __('Apartment') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'villa'" value="villa" text="{{ __('Villa') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'office'" value="office" text="{{ __('Office') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'land'" value="land" text="{{ __('Land') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'shop'" value="shop" text="{{ __('Shop') }}" />
                                                            <x-admin.select-option :selected="(old('property_type') ?? $realEstate->property_type) == 'warehouse'" value="warehouse" text="{{ __('Warehouse') }}" />
                                                        </x-admin.form-select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-select name="listing_type" id="listing_type" label="{{ __('Listing Type') }}" required="true">
                                                            <x-admin.select-option value="" text="{{ __('Select Listing Type') }}" />
                                                            <x-admin.select-option :selected="(old('listing_type') ?? $realEstate->listing_type) == 'sale'" value="sale" text="{{ __('For Sale') }}" />
                                                            <x-admin.select-option :selected="(old('listing_type') ?? $realEstate->listing_type) == 'rent'" value="rent" text="{{ __('For Rent') }}" />
                                                        </x-admin.form-select>
                                                    </div>
                                                @endif
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-textarea id="en_description" name="en_description" label="{{ __('Description (English)') }}" placeholder="{{ __('Enter property description') }}" value="{{ $realEstate?->getTranslation('en')?->description ?? old('en_description') }}" required="true" rows="4"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-textarea id="ar_description" name="ar_description" label="{{ __('Description (Arabic)') }}" placeholder="{{ __('أدخل وصف العقار') }}" value="{{ $realEstate?->getTranslation('ar')?->description ?? old('ar_description') }}" required="true" rows="4"/>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Location Tab --}}
                                        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                            <div class="row">
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="city" label="{{ __('City') }}" placeholder="{{ __('Enter city') }}" value="{{ old('city', $realEstate->city) }}" required="true"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="district" label="{{ __('District/Region') }}" placeholder="{{ __('Enter district') }}" value="{{ old('district', $realEstate->district) }}"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="neighborhood" label="{{ __('Neighborhood') }}" placeholder="{{ __('Enter neighborhood') }}" value="{{ old('neighborhood', $realEstate->neighborhood) }}"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-textarea name="address" label="{{ __('Full Address') }}" placeholder="{{ __('Enter complete address') }}" value="{{ old('address', $realEstate->address) }}" required="true" rows="3"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="latitude" label="{{ __('Latitude') }}" placeholder="{{ __('e.g. 30.0444') }}" value="{{ old('latitude', $realEstate->latitude) }}" type="number" step="any"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="longitude" label="{{ __('Longitude') }}" placeholder="{{ __('e.g. 31.2357') }}" value="{{ old('longitude', $realEstate->longitude) }}" type="number" step="any"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Property Details Tab --}}
                                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                            <div class="row">
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="bedrooms" label="{{ __('Bedrooms') }}" placeholder="{{ __('Number of bedrooms') }}" value="{{ old('bedrooms', $realEstate->bedrooms) }}" type="number" min="0"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="bathrooms" label="{{ __('Bathrooms') }}" placeholder="{{ __('Number of bathrooms') }}" value="{{ old('bathrooms', $realEstate->bathrooms) }}" type="number" min="0"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="area" label="{{ __('Area (m²)') }}" placeholder="{{ __('Property area') }}" value="{{ old('area', $realEstate->area) }}" type="number" step="any" required="true"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="floor" label="{{ __('Floor') }}" placeholder="{{ __('Floor number') }}" value="{{ old('floor', $realEstate->floor) }}" type="number"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="total_floors" label="{{ __('Total Floors') }}" placeholder="{{ __('Building total floors') }}" value="{{ old('total_floors', $realEstate->total_floors) }}" type="number" min="1"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <x-admin.form-input name="year_built" label="{{ __('Year Built') }}" placeholder="{{ __('Construction year') }}" value="{{ old('year_built', $realEstate->year_built) }}" type="number" min="1800" max="{{ date('Y') + 1 }}"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Financial Tab --}}
                                        <div class="tab-pane fade" id="financial" role="tabpanel" aria-labelledby="financial-tab">
                                            <div class="row">
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="price" label="{{ __('Price') }}" placeholder="{{ __('Property price') }}" value="{{ old('price', $realEstate->price) }}" type="number" step="any" required="true"/>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <x-admin.form-select name="currency" id="currency" label="{{ __('Currency') }}" required="true">
                                                            <x-admin.select-option :selected="(old('currency') ?? $realEstate->currency) == 'USD'" value="USD" text="USD ($)" />
                                                            <x-admin.select-option :selected="(old('currency') ?? $realEstate->currency) == 'EUR'" value="EUR" text="EUR (€)" />
                                                            <x-admin.select-option :selected="(old('currency') ?? $realEstate->currency) == 'EGP'" value="EGP" text="EGP (ج.م)" />
                                                            <x-admin.select-option :selected="(old('currency') ?? $realEstate->currency) == 'SAR'" value="SAR" text="SAR (ر.س)" />
                                                        </x-admin.form-select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <x-admin.form-input name="price_per_sqm" label="{{ __('Price per m²') }}" placeholder="{{ __('Optional') }}" value="{{ old('price_per_sqm', $realEstate->price_per_sqm) }}" type="number" step="any"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Features & Media Tab --}}
                                        <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                                            <div class="row">
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-12">
                                                        <label>{{ __('Features') }}</label>
                                                        <div class="row">
                                                            @php $features = old('features', $realEstate->features ?? []); @endphp
                                                            @foreach(['parking', 'garden', 'pool', 'gym', 'security', 'elevator', 'furnished', 'balcony', 'terrace', 'storage'] as $feature)
                                                                <div class="col-md-3 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="features[]" value="{{ $feature }}" id="feature_{{ $feature }}" {{ in_array($feature, $features) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="feature_{{ $feature }}">
                                                                            {{ __(ucfirst($feature)) }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>{{ __('Amenities') }}</label>
                                                        <div class="row">
                                                            @php $amenities = old('amenities', $realEstate->amenities ?? []); @endphp
                                                            @foreach(['wifi', 'ac', 'heating', 'laundry', 'dishwasher', 'microwave', 'fridge', 'washing_machine'] as $amenity)
                                                                <div class="col-md-3 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" id="amenity_{{ $amenity }}" {{ in_array($amenity, $amenities) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="amenity_{{ $amenity }}">
                                                                            {{ __(ucfirst(str_replace('_', ' ', $amenity))) }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-file name="featured_image" label="{{ __('Featured Image') }}" accept="image/*" />
                                                        @if($realEstate->featured_image)
                                                            <div class="mt-2">
                                                                <img src="{{ $realEstate->main_image_url }}" alt="Current featured image" class="img-thumbnail" style="max-width: 200px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-file name="images[]" label="{{ __('Gallery Images') }}" accept="image/*" multiple />
                                                        <small class="text-muted">{{ __('You can select multiple images (max 20)') }}</small>
                                                        @if($realEstate->images && count($realEstate->images) > 0)
                                                            <div class="mt-2">
                                                                <small class="text-muted">{{ __('Current images:') }} {{ count($realEstate->images) }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Contact & SEO Tab --}}
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="row">
                                                @if ($code == $languages->first()->code)
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="contact_name" label="{{ __('Contact Name') }}" placeholder="{{ __('Property owner/agent name') }}" value="{{ old('contact_name', $realEstate->contact_name) }}" required="true"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="contact_phone" label="{{ __('Contact Phone') }}" placeholder="{{ __('Phone number') }}" value="{{ old('contact_phone', $realEstate->contact_phone) }}" required="true"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-input name="contact_email" label="{{ __('Contact Email') }}" placeholder="{{ __('Email address (optional)') }}" value="{{ old('contact_email', $realEstate->contact_email) }}" type="email"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <x-admin.form-select name="status" id="status" label="{{ __('Status') }}" required="true">
                                                            <x-admin.select-option :selected="(old('status') ?? $realEstate->status) == 'active'" value="active" text="{{ __('Active') }}" />
                                                            <x-admin.select-option :selected="(old('status') ?? $realEstate->status) == 'inactive'" value="inactive" text="{{ __('Inactive') }}" />
                                                            <x-admin.select-option :selected="(old('status') ?? $realEstate->status) == 'sold'" value="sold" text="{{ __('Sold') }}" />
                                                            <x-admin.select-option :selected="(old('status') ?? $realEstate->status) == 'rented'" value="rented" text="{{ __('Rented') }}" />
                                                        </x-admin.form-select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <x-admin.form-switch name="featured" label="{{ __('Featured Property') }}" :checked="old('featured', $realEstate->featured) == 1"/>
                                                    </div>
                                                @endif
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-input name="en_seo_title" label="{{ __('SEO Title (English)') }}" placeholder="{{ __('SEO title for search engines') }}" value="{{ $realEstate?->getTranslation('en')?->seo_title ?? old('en_seo_title') }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-input name="ar_seo_title" label="{{ __('SEO Title (Arabic)') }}" placeholder="{{ __('عنوان SEO لمحركات البحث') }}" value="{{ $realEstate?->getTranslation('ar')?->seo_title ?? old('ar_seo_title') }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-textarea name="en_seo_description" label="{{ __('SEO Description (English)') }}" placeholder="{{ __('SEO description for search engines') }}" value="{{ $realEstate?->getTranslation('en')?->seo_description ?? old('en_seo_description') }}" rows="3"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-admin.form-textarea name="ar_seo_description" label="{{ __('SEO Description (Arabic)') }}" placeholder="{{ __('وصف SEO لمحركات البحث') }}" value="{{ $realEstate?->getTranslation('ar')?->seo_description ?? old('ar_seo_description') }}" rows="3"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <x-admin.save-button :text="__('Update Property')" />
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

@push('js')
<script>
(function($) {
    "use strict";
    $(document).ready(function() {
        // Tab navigation
        $('.nav-tabs .nav-link').on('click', function() {
            var target = $(this).data('bs-target');
            $('.tab-pane').removeClass('show active');
            $(target).addClass('show active');
        });
    });
})(jQuery);
</script>
@endpush