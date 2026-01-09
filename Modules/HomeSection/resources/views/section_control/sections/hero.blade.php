<div class="tab-pane fade" id="hero_tab" role="tabpanel">
    <form action="{{ route('admin.section-control.update', ['code' => $code]) }}" method="POST">
        @csrf
        @method('PUT')
        <x-admin.form-input type="hidden" name="tab" value="hero_section" />
        
        @if ($code == $languages->first()->code)
        <div class="form-group">
            <x-admin.form-input id="hero_badge_text" name="hero_badge_text" label="{{ __('Hero Badge Text') }}" 
                value="{{ $section_control?->hero_badge_text ?? __('Legal Excellence Since') }}" required="true"/>
        </div>
        <div class="form-group">
            <x-admin.form-switch name="hero_status" label="{{ __('Status') }}" :checked="$section_control?->hero_status == 1" />
        </div>
        @endif

        <div class="form-group">
            <x-admin.form-input data-translate="true" id="hero_title" name="hero_title" label="{{ __('Hero Title') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_title ?? __('Our Law Firm') }}" required="true"/>
        </div>

        <div class="form-group">
            <x-admin.form-textarea data-translate="true" id="hero_description" name="hero_description" label="{{ __('Hero Description') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_description ?? __('Your trusted partner for comprehensive legal solutions. We provide expert legal services with integrity, professionalism, and dedication to achieving the best outcomes for our clients.') }}" maxlength="500" required="true"/>
        </div>

        <h5 class="mt-4 mb-3">{{ __('Hero Features') }}</h5>

        <div class="form-group">
            <x-admin.form-input data-translate="true" id="hero_feature_1_title" name="hero_feature_1_title" label="{{ __('Feature 1 Title') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_1_title ?? __('Expert Legal Team') }}" required="true"/>
        </div>
        <div class="form-group">
            <x-admin.form-textarea data-translate="true" id="hero_feature_1_description" name="hero_feature_1_description" label="{{ __('Feature 1 Description') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_1_description ?? __('Experienced professionals dedicated to your success') }}" maxlength="200" required="true"/>
        </div>

        <div class="form-group">
            <x-admin.form-input data-translate="true" id="hero_feature_2_title" name="hero_feature_2_title" label="{{ __('Feature 2 Title') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_2_title ?? __('Trusted Service') }}" required="true"/>
        </div>
        <div class="form-group">
            <x-admin.form-textarea data-translate="true" id="hero_feature_2_description" name="hero_feature_2_description" label="{{ __('Feature 2 Description') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_2_description ?? __('Reliable and transparent legal solutions') }}" maxlength="200" required="true"/>
        </div>

        <div class="form-group">
            <x-admin.form-input data-translate="true" id="hero_feature_3_title" name="hero_feature_3_title" label="{{ __('Feature 3 Title') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_3_title ?? __('24/7 Support') }}" required="true"/>
        </div>
        <div class="form-group">
            <x-admin.form-textarea data-translate="true" id="hero_feature_3_description" name="hero_feature_3_description" label="{{ __('Feature 3 Description') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_feature_3_description ?? __('Always available to assist you') }}" maxlength="200" required="true"/>
        </div>

        <h5 class="mt-4 mb-3">{{ __('Search Section') }}</h5>

        <div class="form-group">
            <x-admin.form-input data-translate="true" id="hero_search_title" name="hero_search_title" label="{{ __('Search Title') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_search_title ?? __('Find Legal Services') }}" required="true"/>
        </div>
        <div class="form-group">
            <x-admin.form-textarea data-translate="true" id="hero_search_subtitle" name="hero_search_subtitle" label="{{ __('Search Subtitle') }}" 
                value="{{ $section_control?->getTranslation($code)?->hero_search_subtitle ?? __('Search by location and department to find the right legal assistance') }}" maxlength="300" required="true"/>
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>

