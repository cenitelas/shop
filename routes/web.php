<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::middleware('auth')
    ->group(function () {

        Route::resource('categories', CategoryController::class)
            ->except('index');
        Route::get('categories', [CategoryController::class,'index'])
            ->name('categories.index');
        Route::resource('products', ProductController::class)
            ->except('index', 'show');
        Route::post('/products/addcart', [ProductController::class,'addCart'])
            ->name('product.addcart');
    });
Route::get('user', [App\Http\Controllers\UserController::class, 'index'])
    ->name('user.index');

Route::get('/{view}/sort/by/category/{category}', [ProductController::class,'sortByCategory'])
    ->name('products.sortByCategory');

Route::get('/{view}/sort/by/price/{type}', [ProductController::class,'sortByPrice'])
    ->name('products.sortByPrice');

Route::get('/search', [ProductController::class,'search'])
    ->name('products.search');

Route::get('products/{product}', [ProductController::class,'show'])
    ->name('products.show');
