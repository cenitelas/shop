@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3">
            Корзина
        </h1>
    </div>

    @if($carts->isNotEmpty())

        <div class="row">

            @foreach($carts as $cart)
                <div class="col-md-4 mb-3">
                    <div class="card card-body d-flex flex-column">
                            @include('components.product-view',['product'=>$cart->product, 'cart'=>true])
                        <div class="d-flex align-items-center justify-content-center">
                            @auth
                                <form class="mt-3" action="{{ route('carts.destroy', $cart) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-danger">
                                        Удалить
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
        <div class="card card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Общая стоимость: {{$sum}} тг</h1>
                @auth
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        @foreach($carts as $cart)
                            <input type="hidden" name="carts[]" id="{{$cart->id}}" value="{{$cart->id}}">
                        @endforeach
                        <button class="btn btn-lg btn-success">
                            Оформить заказ
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-secondary">
            Корзина пустая.
        </div>
    @endif

@endsection
