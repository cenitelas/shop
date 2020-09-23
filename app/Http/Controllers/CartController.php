<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts->filter(function ($value, $key) {
            return !$value->order_id;
        });
        $sum = $carts->sum(function ($cart){
           return $cart->product->price;
        });
        return view('carts.index', [
            'carts' => $carts,
            'sum'=>$sum ?? 0
        ]);
    }

    public function store(Request $request)
    {
        if(Cart::all()
            ->where('product_id', $request['product_id'])
            ->where('user_id',auth()->user()->id)
            ->where('order_id',null)
            ->first())
                return response()->json(['status' => false], 200);

        $data = $this->validated();
        auth()->user()->carts()->create($data);

        return response()->json(['status' => true], 200);
    }

    public function destroy(Cart $cart)
    {
        //$this->authorize('delete', $cart);
        $cart->delete();
        return back();
    }

    protected function validated() {
        return request()->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    }
}
