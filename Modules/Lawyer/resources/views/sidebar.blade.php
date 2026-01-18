    <li
        class="nav-item dropdown {{ isRoute(['admin.lawyer.*', 'admin.leave.*'], 'active') }}">
        <a href="javascript:void()" class="nav-link has-dropdown">
            <i class="fas fa-gavel"></i>
            <span>{{ __('Lawyer') }}</span>
        </a>

        <ul class="dropdown-menu">
            {{-- إدارة المحامين --}}
            @if (checkAdminHasPermission('lawyer.view'))
                <li class="{{ isRoute('admin.lawyer.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.lawyer.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span>{{ __('Lawyer') }}</span>
                    </a>
                </li>
            @endif
            
            {{-- إدارة الإجازات --}}
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
