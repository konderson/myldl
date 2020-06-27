
@if ($paginator->hasPages())
    
<ul class="pagination">
        @if ($paginator->onFirstPage())
            
<li class="disabled"><a><span style="color:#fff">Предведущая</span></a></li>

        @else
            
<li><a class="pclick" href="{{ $paginator->previousPageUrl() }}" rel="prev">Предведущая</a></li>

        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                
<li class="disabled"><span>{{ $element }}</span></li>

            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        
<li class="active"><span>{{ $page }}</span></li>

                    @else
                        
<li><a  class="pclick" href="{{ $url }}">{{ $page }}</a></li>

                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            
<li><a  class="pclick" href="{{ $paginator->nextPageUrl() }}" rel="next">Следующая</a></li>

        @else
            
<li class="disabled"><a><span style="color:#fff">Следующая</span></a></li>

        @endif
    </ul>


@endif