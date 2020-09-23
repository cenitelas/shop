<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        if(auth()->user()->role->name==="admin")
            $orders = Order::query()->paginate(8);
        else
            $orders = auth()->user()->orders()->paginate(8);
        foreach ($orders as $order){
            $order->products = Cart::all()->where('order_id',$order->id)->map(function ($item){return $item->product->name;});
        }
        return view('orders.index', [
            'orders' => $orders
        ]);
    }


    public function store(Request $request)
    {
        if(isset($request['carts'])){
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->sum = 0;
            $order->confirm = false;
            $order->save();

            foreach ($request['carts'] as $cart){
                $cart = auth()->user()->carts->where('id',$cart)->first();
                $cart->order_id = $order->id;
                $order->sum+=$cart->product->price;
                $cart->save();
            }
            $order->save();
        }
        return redirect(route('orders.index'));
    }

    public function update(Request $request, Order $order)
    {
        $order->confirm=true;
        $order->save();
        return redirect(route('orders.index'));
    }

    public function destroy(Order $order)
    {
        //
    }
}
