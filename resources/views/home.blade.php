@extends('layouts.app')

@section('content')
    <div class="col-md-110">
        <div class="d-flex justify-content-center align-items-center h-50">
            <div class="dropdown list-group w-25">
                <a id="categories" class="text-black-50 dropdown-toggle list-group-item w-100" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ $sort ?? 'Категории' }}
                </a>
                <div class="dropdown-menu dropdown-menu-left w-100" aria-labelledby="categories">
                    @foreach($categories as $category)
                        <a class="dropdown-item text-black-50 " href="{{route("products.sortByCategory",["home",$category])}}">
                            {{$category->name}}
                        </a>
                    @endforeach
                    <a class="dropdown-item text-black-50 " href="{{route("home.index")}}">
                        Все
                    </a>
                </div>
            </div>
            <div class="dropdown list-group w-25">
                <a id="price" class="text-black-50 dropdown-toggle list-group-item" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Цена
                </a>
                <div class="dropdown-menu dropdown-menu-left w-100" aria-labelledby="price">
                    <a class="dropdown-item text-black-50 " href="{{route("home.index")}}">
                        Новинки
                    </a>
                    <a class="dropdown-item text-black-50 " href="{{route("products.sortByPrice",["home","desc"])}}">
                        Цена по убыванию
                    </a>
                    <a class="dropdown-item text-black-50 " href="{{route("products.sortByPrice",["home","asc"])}}">
                        Цена по возрастанию
                    </a>

                </div>
            </div>
            <form method="get" action="{{route("products.search")}}" class="pl-5 w-50 d-flex align-self-end ml-auto align-items-center">
                <input type="hidden" name="view" id="view" value="home">
                <div class="form-group w-75">
                    <input placeholder="Найти..." name="search" id="search" class="form-control mt-3 p-4" value="{{$search ?? ''}}"/>
                </div>
                <button class="btn btn-outline-dark h-25 ml-2">Поиск</button>
            </form>
        </div>
        <hr/>
        @include('components.products-list')
        <hr/>
    </div>
    <div class="col-md-3">
    </div>

@endsection
