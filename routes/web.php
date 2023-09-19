<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
route::get('redirect', [HomeController::class, 'redirect']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('add_to_cart/{id}', [ProductController::class, 'addToCart'])->name('add_to_cart');
    Route::patch('update_cart', [ProductController::class, 'update'])->name('update_cart');
    Route::delete('remove_from_cart', [ProductController::class, 'REMOVE'])->name('remove_from_cart');
});

Route::middleware('auth.admin')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('dashboard/products', DashboardProductController::class);
});
