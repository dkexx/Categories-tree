@foreach($categories as $category)
    <option value={{ $category->id }}>
        {{ $category->name }}
        @if(!empty($category->child))
            @include('partials.category_select',['categories' => $category->child])
        @endif
    </option>
@endforeach