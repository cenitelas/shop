@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center h-50">
    <div class="dropdown list-group w-25">
        <a id="categories" class="text-black-50 dropdown-toggle list-group-item w-100" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Категории
        </a>
        <div class="dropdown-menu dropdown-menu-left w-100" aria-labelledby="categories">
            @foreach($categories as $category)
                <a class="dropdown-item text-black-50 " href="#">
                    {{$category->name}}
                </a>
            @endforeach
                <a class="dropdown-item text-black-50 " href="#">
                    Все
                </a>
        </div>
    </div>
    <div class="dropdown list-group w-25">
        <a id="price" class="text-black-50 dropdown-toggle list-group-item" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Цена
        </a>
        <div class="dropdown-menu dropdown-menu-left w-100" aria-labelledby="price">
                <a class="dropdown-item text-black-50 " href="#">
                    Новинки
                </a>
                <a class="dropdown-item text-black-50 " href="#">
                    Цена по убыванию
                </a>
                <a class="dropdown-item text-black-50 " href="#">
                    Цена по возрастанию
                </a>

        </div>
    </div>
    <form class="w-25 d-flex align-self-end ml-auto align-items-center">
        <div class="form-group">
            <input class="form-control mt-3">
        </div>
        <button class="btn btn-outline-dark h-25 ml-3">Поиск</button>
    </form>
</div>
@endsection
