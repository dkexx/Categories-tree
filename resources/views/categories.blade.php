@include ('partials.header')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success')}}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="page-header col-sm-12">
                <br>
                <h2 class="display-4 text-center">Iterative way</h2>
                <br>
            </div>
            <div class="col-sm-12">
                @foreach($categories as $category)
                    @if(!empty($category->child))
                        @include('partials.category_iterative_list',['root_category' => $category])
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header col-sm-12">
                <br>
                <h2 class="display-4 text-center">Recursive way</h2>
                <br>
            </div>
            <div class="col-sm-12">
                <ul id="categories1-recursive" class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item-light">
                            {{ $category->name }}
                            @if(!empty($category->child))
                                @include('partials.category_recursive_list',['childs' => $category->child])
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <br>
                <br>
                <h2 class="display-4 text-center">Add New Category</h2>
                <br>
            </div>
            <form method="POST" action="/">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif
                <div class="form-group">
                    <label for="parent">Parent category</label>
                    <select class="form-control" id="parent" name="parent">
                        <option value="">--</option>
                        @if(!empty($categories))
                            @include('partials.category_select',['categories' => $categories])
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary btn-block">Create</button>
            </form>
        </div>
    </div>
</div>
@include ('partials.footer')