<ul>
    @foreach($childs as $child)
        <li class="list-group-item-light">
            {{ $child->name }}
            @if(!empty($child->child))
                @include('partials.category_recursive_list',['childs' => $child->child])
            @endif
        </li>
    @endforeach
</ul>