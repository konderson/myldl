
@if ($paginator->hasPages())
    

        @if ($paginator->onFirstPage())
            
<a  class="disabled"  ><span style="color:#fff">Предведущая</span></a>

        @else
            
<a class="pclick" href="{{ $paginator->previousPageUrl() }}" rel="prev">Предведущая</a>

        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                
<span class="disabled">{{ $element }}</span>

            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        
<a class="number current"><span>{{ $page }}</span></a>

                    @else
                        
<a  data-ci-pagination-page="2" href="{{ $url }}">{{ $page }}</a>

                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            
<a  class="pclick" href="{{ $paginator->nextPageUrl() }}" rel="next">Следующая</a>

        @else
            
<a class="disabled"><span style="color:#fff">Следующая</span></a>

        @endif
    


@endif