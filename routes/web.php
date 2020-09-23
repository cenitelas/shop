<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware('auth')
    ->group(function () {

        Route::resource('categories', CategoryController::class)
            ->except('index');
        Route::get('categories', [CategoryController::class,'index'])
            ->name('categories.index');
        Route::resource('carts', CartController::class)
            ->except('index');
        Route::get('carts', [CartController::class,'index'])
            ->name('carts.index');
        Route::resource('orders',OrderController::class)
            ->except('index');
        Route::get('orders', [OrderController::class,'index'])
            ->name('orders.index');
        Route::resource('products', ProductController::class)
            ->except('index', 'show');
    });
Route::get('user', [App\Http\Controllers\UserController::class, 'index'])
    ->name('user.index');

Route::get('/{view}/sort/by/category/{category}', [ProductController::class,'sortByCategory'])
    ->name('products.sortByCategory');

Route::get('/{view}/sort/by/price/{type}', [ProductController::class,'sortByPrice'])
    ->name('products.sortByPrice');

Route::get('/search', [ProductController::class,'search'])
    ->name('products.search');

Route::get('/about', [HomeController::class,'about'])
    ->name('home.about');

Route::get('products/{product}', [ProductController::class,'show'])
    ->name('products.show');
