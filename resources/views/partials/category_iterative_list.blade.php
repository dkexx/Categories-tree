@php $stack = array(array($root_category->toArray()))
@endphp
<ul class="list-group">
    @while (count($stack))
        @php $category = array_shift($stack[count($stack)-1]);
        @endphp
        <li class="list-group-item-light">
            {{$category['name']}}
        </li>
        <ul>
            @php $stack[] = $category['child']->toArray()
            @endphp
            @while (count($stack) && count($stack[count($stack)-1]) == 0)
        </ul>
        @php array_pop($stack)
        @endphp
    @endwhile
    @endwhile
</ul>