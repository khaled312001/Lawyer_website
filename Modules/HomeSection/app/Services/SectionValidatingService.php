<?php

namespace Modules\HomeSection\app\Services;

class SectionValidatingService {
    public function validateSectionStatusOnly($request, $columnName): array {
        $rules = [
            'code'      => 'required|string|exists:languages,code',
            $columnName => 'required',
        ];

        $messages = [
            'code.required' => __('The language code is required.'),
            'code.string'   => __('The language code must be a string.'),
            'code.exists'   => __('The selected language code is invalid.'),
            "$columnName.required"   => __('How many field is required'),
        ];

        return [$rules, $messages];
    }

    public function validateSection($request, $howMany, $status, $firstHeading, $secondHeading, $description): array {
        $rules = [
            'code'         => 'required|string|exists:languages,code',
            $howMany       => 'nullable',
            $status        => 'nullable',
            $firstHeading  => 'required|string|max:100',
            $secondHeading => 'required|string|max:100',
            $description   => 'required|string',
        ];
        if ($request->code == allLanguages()?->first()?->code) {
            $rules[$howMany] = 'required';
        }

        $messages = [
            'code.required'           => __('The language code is required.'),
            'code.string'             => __('The language code must be a string.'),
            'code.exists'             => __('The selected language code is invalid.'),

            "$firstHeading.required"  => __('First heading is required.'),
            "$firstHeading.string"    => __('First heading must be a string.'),
            "$firstHeading.max"       => __('First heading must not exceed 100 characters.'),

            "$secondHeading.required" => __('Second subheading is required.'),
            "$secondHeading.string"   => __('Second subheading must be a string.'),
            "$secondHeading.max"      => __('Second subheading must not exceed 100 characters.'),
            "$description.required"   => __('Description is required.'),
            "$howMany.required"   => __('How many field is required'),
        ];

        return [$rules, $messages];
    }

    public function validateHeroSection($request): array {
        $rules = [
            'code' => 'required|string|exists:languages,code',
            'hero_title' => 'required|string|max:200',
            'hero_description' => 'required|string|max:500',
            'hero_feature_1_title' => 'required|string|max:100',
            'hero_feature_1_description' => 'required|string|max:200',
            'hero_feature_2_title' => 'required|string|max:100',
            'hero_feature_2_description' => 'required|string|max:200',
            'hero_feature_3_title' => 'required|string|max:100',
            'hero_feature_3_description' => 'required|string|max:200',
            'hero_search_title' => 'required|string|max:100',
            'hero_search_subtitle' => 'required|string|max:300',
        ];

        if ($request->code == allLanguages()?->first()?->code) {
            $rules['hero_badge_text'] = 'required|string|max:100';
            $rules['hero_status'] = 'nullable';
        }

        $messages = [
            'code.required' => __('The language code is required.'),
            'code.string' => __('The language code must be a string.'),
            'code.exists' => __('The selected language code is invalid.'),
            'hero_title.required' => __('Hero title is required.'),
            'hero_title.max' => __('Hero title must not exceed 200 characters.'),
            'hero_description.required' => __('Hero description is required.'),
            'hero_description.max' => __('Hero description must not exceed 500 characters.'),
            'hero_feature_1_title.required' => __('Feature 1 title is required.'),
            'hero_feature_1_description.required' => __('Feature 1 description is required.'),
            'hero_feature_2_title.required' => __('Feature 2 title is required.'),
            'hero_feature_2_description.required' => __('Feature 2 description is required.'),
            'hero_feature_3_title.required' => __('Feature 3 title is required.'),
            'hero_feature_3_description.required' => __('Feature 3 description is required.'),
            'hero_search_title.required' => __('Search title is required.'),
            'hero_search_subtitle.required' => __('Search subtitle is required.'),
            'hero_badge_text.required' => __('Hero badge text is required.'),
        ];

        return [$rules, $messages];
    }
}
