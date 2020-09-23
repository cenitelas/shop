@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3">
            Заказы
        </h1>

    </div>

    @if($orders->isNotEmpty())

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr class="text-center">
                @if(auth()->user()->role->name==="admin")
                    <th scope="col">Пользователь</th>
                @endif
                <th scope="col">Продукты</th>
                <th scope="col">Сумма</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата заявки</th>
                @if(auth()->user()->role->name==="admin")
                    <th scope="col">Операции</th>
                @endif
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($orders as $order)
                <tr>
                    @if(auth()->user()->role->name==="admin")
                        <td>{{$order->user->name}}</td>
                    @endif
                <td class="w-50">
                    @if(isset($order->products))
                        {{implode(', ',$order->products->toArray())}}
                    @endif
                </td>
                <td>{{$order->sum}} </td>
                <td>@if($order->confirm) <span class="text-success">Сформирован</span> @else <span class="text-danger">Формируется</span>@endif</td>
                <td>{{$order->created_at}}</td>

                    @if(auth()->user()->role->name==="admin")
                        <td>
                            @if(!$order->confirm)
                            <form action="{{ route('orders.update', $order) }}" method="post">
                                @csrf @method('PATCH')
                                <input type="hidden" name="confirm" id="confirm" value="1">
                                <button class="btn btn-sm btn-success">
                                    Оформить
                                </button>
                            </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center align-items-center">
            {{ $orders->links("pagination::bootstrap-4") }}
        </div>
    @else
        <div class="alert alert-secondary">
            Заказов нет.
        </div>
    @endif

@endsection
