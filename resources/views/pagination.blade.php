@if ($paginator->lastPage() > 1)
    <p class="m-0 text-muted">Showing <span>{{($paginator->currentPage()-1)* $paginator->perPage()+($paginator->total() ? 1:0)}}</span> to <span>{{($paginator->currentPage()-1)*$paginator->perPage()+count($paginator)}}</span> of <span>{{$paginator->total()}}</span> entries
    </p>
    <ul class="pagination m-0 ms-auto">
        <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" /></svg>
            </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endfor
        <li class="page-item {{ !$paginator->hasMorePages() ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" /></svg>
            </a>
        </li>
    </ul>
@endif
