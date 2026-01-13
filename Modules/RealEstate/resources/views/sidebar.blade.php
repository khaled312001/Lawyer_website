<li class="nav-item dropdown {{ isRoute(['admin.real-estate.*'], 'active') }}">
    <a href="#" class="nav-link has-dropdown">
        <i class="fas fa-building"></i>
        <span>{{ __('Real Estate') }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ isRoute(['admin.real-estate.index', 'admin.real-estate.create', 'admin.real-estate.edit'], 'active') }}">
            <a class="nav-link" href="{{ route('admin.real-estate.index') }}">
                {{ __('Properties') }}
            </a>
        </li>
        <li class="{{ isRoute(['admin.real-estate.inquiries.*'], 'active') }}">
            <a class="nav-link" href="{{ route('admin.real-estate.inquiries.index') }}">
                {{ __('Inquiries') }}
            </a>
        </li>
    </ul>
</li>