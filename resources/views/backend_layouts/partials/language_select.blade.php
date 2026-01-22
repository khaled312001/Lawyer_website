@if (Module::isEnabled('Language') && Route::has('set-language') && allLanguages()?->where('status', 1)->count() > 1)
    <li class="setLanguageHeader dropdown border rounded-2"><a href="javascript:;" data-bs-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="display: flex; align-items: center; justify-content: center; text-align: center;">
            <div class="d-sm-none d-md-inline-block" style="text-align: center; width: 100%;">
                {{ allLanguages()?->firstWhere('code', getSessionLanguage())?->name ?? __('Select language') }}
            </div>
        </a>
        <div class="dropdown-menu py-0 dropdown-menu-left">
            @forelse (allLanguages()?->where('status', 1) as $language)
                <a href="{{ getSessionLanguage() == $language->code ? 'javascript:;' : route('set-language', ['code' => $language->code]) }}"
                    class="dropdown-item has-icon {{ getSessionLanguage() == $language->code ? 'bg-light' : '' }}" style="text-align: center;">
                    {{ $language->name }}
                </a>
            @empty
                <a href="javascript:;"
                    class="dropdown-item has-icon {{ getSessionLanguage() == 'en' ? 'bg-light' : '' }}" style="text-align: center;">
                    {{ __('English') }}
                </a>
            @endforelse
        </div>
    </li>
@endif
