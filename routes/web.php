<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\FrontendController as front;

use App\Http\Controllers\DashboardController as dash;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;

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

Route::get('/',[front::class,'welcome'])->name ('welcome');

Auth::routes();
Route::middleware('auth:web')->group(function () {
    Route::get('dashboard', [dash::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('order', OrderController::class);

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
