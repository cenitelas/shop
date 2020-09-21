@extends('layouts.app')

@section('content')
<div>
    <div class="dropdown list-group w-75">
        <a id="categories" class="text-black-50 dropdown-toggle list-group-item w-25" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Категории
        </a>
        <div class="dropdown-menu dropdown-menu-left w-25" aria-labelledby="categories">
            @foreach($categories as $category)
                <a class="dropdown-item text-black-50 " href="#">
                    {{$category->name}}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
