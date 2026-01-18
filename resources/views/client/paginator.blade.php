<div class="row">
    <div class="col-12">
        <div class="pagination">
            <ul class="page-numbers">
                @if ($paginator->onFirstPage())
                    <li class="disabled">
                        <span aria-label="{{ __('Previous') }}"><i class="fas fa-long-arrow-alt-left"></i></span>
                    </li>
                @else
                    <li>
                        <a aria-label="{{ __('Previous') }}" href="{{ $paginator->previousPageUrl() }}" class="page-nav-btn">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled">
                            <span>{{ $element }}</span>
                        </li>
                    @elseif (is_array($element))
                        @foreach ($element as $key => $el)
                            <li>
                                @if ($key == $paginator->currentPage())
                                    <span class="page-current">{{ $key }}</span>
                                @else
                                    <a aria-label="{{ __('Page') }} {{ $key }}" href="{{ $el }}" class="page-link">{{ $key }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li>
                        <a aria-label="{{ __('Next') }}" href="{{ $paginator->nextPageUrl() }}" class="page-nav-btn">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </li>
                @else
                    <li class="disabled">
                        <span aria-label="{{ __('Next') }}"><i class="fas fa-long-arrow-alt-right"></i></span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
