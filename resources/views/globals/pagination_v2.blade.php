<style type="text/css">
    ul.pagination li
    {
        cursor:pointer;
    }
</style>
@if ($paginator->hasPages())
    <ul class="pagination pagination-sm no-margin pull-right">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="pagination">&laquo;</span></li>
        @else
            <li><a data-href="{{ $paginator->previousPageUrl() }}" class="pagination" rel="prev">&laquo;</a></li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a class="pagination" data-href="{{ $paginator->url(1) }}" >1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li class="disabled hidden-xs"><span class="pagination">...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active "><span class="pagination">{{ $i }}</span></li>
                @else
                    <li><a class="pagination" data-href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="disabled hidden-xs "><span class="pagination">...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a class="pagination" data-href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="pagination" data-href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled "><span class="pagination">&raquo;</span></li>
        @endif
    </ul>
@endif