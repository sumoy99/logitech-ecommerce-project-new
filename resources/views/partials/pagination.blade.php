<ul class="pagination-new tf-pagination-list justify-content-center">

    {{-- Previous Button --}}
    @if ($paginator->previousPageUrl())
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link animate-hover-btn">
                <span class="icon icon-arrow-left"></span>
            </a>
        </li>
    @endif

    {{-- Page Numbers --}}
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="{{ $paginator->currentPage() == $i ? 'active' : '' }}">
            <a href="{{ $paginator->url($i) }}" class="pagination-link {{ $paginator->currentPage() == $i ? '' : 'animate-hover-btn' }}">
                {{ $i }}
            </a>
        </li>
    @endfor

    {{-- Next Button --}}
    @if ($paginator->nextPageUrl())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link animate-hover-btn">
                <span class="icon icon-arrow-right"></span>
            </a>
        </li>
    @endif

</ul>
