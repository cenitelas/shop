<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::middleware('auth')
    ->group(function () {

        Route::resource('categories', CategoryController::class)
            ->except('index');
        Route::get('categories', [CategoryController::class,'index'])
            ->name('categories.index');
    });
Route::get('user', [App\Http\Controllers\UserController::class, 'index'])
    ->name('user.index');
