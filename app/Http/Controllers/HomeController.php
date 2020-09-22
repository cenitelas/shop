<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->get();
        $products = Product::query()
            ->latest()
            ->paginate(6);

        return view('home',[
            'categories'=>$categories,
            'products'=>$products
        ]);
    }
}
