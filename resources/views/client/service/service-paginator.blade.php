<div class="service-pagination-wrapper">
    <nav class="service-pagination-nav" aria-label="Service Pagination">
        <ul class="service-page-list">
            @if ($paginator->onFirstPage())
                <li class="service-nav-item service-nav-disabled">
                    <span class="service-nav-icon" aria-label="{{ __('Previous') }}">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="service-nav-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="service-nav-icon" aria-label="{{ __('Previous') }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="service-page-separator">
                        <span class="service-separator-dots">{{ $element }}</span>
                    </li>
                @elseif (is_array($element))
                    @foreach ($element as $key => $el)
                        <li class="service-page-item-wrapper">
                            @if ($key == $paginator->currentPage())
                                <span class="service-page-active-number" data-page="{{ $key }}">{{ $key }}</span>
                            @else
                                <a href="{{ $el }}" class="service-page-number" aria-label="{{ __('Page') }} {{ $key }}">{{ $key }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="service-nav-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="service-nav-icon" aria-label="{{ __('Next') }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="service-nav-item service-nav-disabled">
                    <span class="service-nav-icon" aria-label="{{ __('Next') }}">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>
