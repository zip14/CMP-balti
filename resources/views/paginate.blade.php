@if ($paginator->hasPages())

    <ul>
        @if ($paginator->onFirstPage())

            <li class="disabled"> <span>&lt;</span>Precedenta</li>

        @else

            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt; Precedenta</a></li>

        @endif
        @foreach ($elements as $element)
            @if (is_string($element))

                <li class="disabled"><span>{{ $element }}</span></li>

            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())

                        <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>

                    @else

                        <li><a href="{{ $url }}">{{ $page }}</a></li>

                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())

            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Următoare &gt;</a></li>

        @else

            <li class="disabled">Următoare <span>&gt;</span></li>

        @endif
    </ul>


@endif