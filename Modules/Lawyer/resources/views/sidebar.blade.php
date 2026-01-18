    <li
        class="nav-item dropdown {{ isRoute(['admin.lawyer.*', 'admin.department.*', 'admin.department.gallery', 'admin.department.videos', 'admin.faq.by.department', 'admin.location.index', 'admin.leave.*'], 'active') }}">
        <a href="javascript:void()" class="nav-link has-dropdown">
            <i class="fas fa-gavel"></i>
            <span>{{ __('Lawyer') }}</span>
        </a>

        <ul class="dropdown-menu">
            @if (checkAdminHasPermission('department.view'))
                <li
                    class="{{ isRoute(['admin.department.*', 'admin.department.gallery', 'admin.department.videos', 'admin.faq.by.department'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.department.index') }}">
                        <i class="fas fa-building"></i>
                        <span>{{ __('Department') }}</span>
                    </a>
                </li>
                <li
                    class="{{ isRoute('admin.department.homepage-management', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.department.homepage-management') }}">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Homepage Departments') }}</span>
                    </a>
                </li>
            @endif
            @if (checkAdminHasPermission('location.view'))
                <li class="{{ isRoute('admin.location.index', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.location.index', ['code' => getSessionLanguage()]) }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ __('Location') }}</span>
                    </a>
                </li>
            @endif
            @if (checkAdminHasPermission('lawyer.view'))
                <li class="{{ isRoute('admin.lawyer.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.lawyer.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span>{{ __('Lawyer') }}</span>
                    </a>
                </li>
            @endif
            @if (checkAdminHasPermission('leave.management'))
                <li class="{{ isRoute('admin.leave.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.leave.index') }}">
                        <i class="fas fa-calendar-times"></i>
                        <span>{{ __('Leave') }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
