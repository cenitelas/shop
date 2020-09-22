@extends('layouts.app')
@section('content')
    <div class="row">
    <div class="col-8">
        @if($product->image_path)
            <img width="100%" class="img-fluid" src="{{Storage::url($product->image_path)}}" alt="{{ $product->name }}"/>
        @endif
    </div>
    <div class="col-4 border p-4 rounded shadow">
        <div class="d-flex flex-column justify-content-between align-items-center">
            <h1 class="h3 mb-0">{{$product->name}}</h1>
            <div class="d-flex align-items-center justify-content-center mt-5">
                @auth
                    @if(auth()->user()->role->name==='admin')
                    @can('update',$product)
                        <a href="{{ route('products.edit',$product)}}" class="btn btn-warning">
                            Редактировать
                        </a>
                    @endcan
                    @can('delete',$product)
                        <form action="{{route('products.destroy',$product)}}" method="post">
                            @csrf @method('delete')
                            <button class="ml-2 btn btn-danger">
                                Удалить
                            </button>
                        </form>
                    @endcan
                    @else
                        <li class="nav-link">
                            <a id="add" data-id="{{ $product->id }}" href="#" class="btn btn-outline-success">
                                Добавить в корзину
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                @endif
            </div>
        </div>
        <div class="h2 mt-5 font-weight-bolder text-center" style="color: #444">
            Стоимость: {{$product->price}} тг
        </div>
        <div class="mt-5">
            Категория: {{$product->category->name}}
        </div>
        <div class="mt-3">
            Добавлено: {{$product->created_at->diffForHumans()}}
        </div>
    </div>
    </div>
    <h1 class="h3 mt-5 mb-3">Описание:</h1>
    <div class="card card-body lead ">
        {!!   nl2br($product->description) !!}
    </div>
@endsection
