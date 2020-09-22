<?php
$product = $product ?? null;
?>

@extends('layouts.app')

@section('content')

    <h1 class="h3">{{ $product ? "Редактирование $product->name" : 'Новый продукт' }}</h1>

    <div class="row">

        <div class="col-md-5">

            <form enctype="multipart/form-data" action="{{ $product ? route('products.update', $product) : route('products.store') }}"
                  class="card card-body" method="post">
                @csrf @if($product) @method('put') @endif

                <div class="form-group">
                    <label for="name">Наименование товара</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $product->name ?? null) }}"
                           class="form-control @error('name') is-invalid @enderror "
                           placeholder="Наименование товара...">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Изображение товара</label>

                    <div class="custom-file">
                        <input accept=".jpg,.jpeg,.png,.webp" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                        <label class="custom-file-label" for="image">Выберите изображение...</label>
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        @foreach($categories as $category)
                            <option {{ old('category_id', $product->category_id ?? null) == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Стоимоть товара</label>
                    <input class="form-control"
                              name="price"
                              id="price"
                              type="number"
                              placeholder="Стоимоть товара..."
                              value="{{ old('price', $product->price ?? null) }}"
                    />
                </div>

                <div class="form-group">
                    <label for="description">Описание товара</label>
                    <textarea class="form-control"
                              name="description"
                              id="description"
                              rows="10"
                              placeholder="Описание товара...">{{ old('description', $product->description ?? null) }}</textarea>
                </div>

                <button class="btn btn-success">{{ $product ? 'Обновить' : 'Добавить' }}</button>

            </form>

        </div>

    </div>

@endsection
