@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3">
            Категории
        </h1>

            @can('create', App\Models\Category::class)
                <a href="{{ route('categories.create') }}" class="btn btn-success ml-auto">
                    Добавить категорию
                </a>
            @endcan
    </div>

    @if($categories->isNotEmpty())

        <div class="row">

            @foreach($categories as $category)
                <div class="col-md-3">
                    <div class="card card-body">

                        <div class="text-center">
                            {{ $category->name }}
                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            @can('update', $category)
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="mt-3 btn btn-primary btn-sm mr-2">
                                    Редактировать
                                </a>
                            @endcan
                            @can('delete', $category)
                                <form class="mt-3" action="{{ route('categories.destroy', $category) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-danger">
                                        Удалить
                                    </button>
                                </form>
                            @endcan
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    @else
        <div class="alert alert-secondary">
            Категорий нет.
        </div>
    @endif

@endsection
