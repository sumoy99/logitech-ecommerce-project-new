@if ($paginator->hasPages())
  <ul class="pagination ci-pagination ci-pagination-1">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="page-item disabled"><span class="page-link previous">...</span></li>
    @else
      <li class="page-item">
        <a class="page-link previous" href="{{ $paginator->previousPageUrl() }}">
          {{-- Your SVG left arrow --}}
        </a>
      </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="page-item"><a class="page-link active" href="#">{{ $page }}</a></li>
          @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item">
        <a class="page-link next" href="{{ $paginator->nextPageUrl() }}">
          {{-- Your SVG right arrow --}}
        </a>
      </li>
    @else
      <li class="page-item disabled"><span class="page-link next">...</span></li>
    @endif

  </ul>
@endif
