<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\FrontendController as Front;

use App\Http\Controllers\DashboardController as Dash;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;

use  App\Http\Controllers\CartController;
use  App\Http\Controllers\CheckoutController;

// customer
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\WishlistController;



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

Route::get('/',[Front::class,'welcome'])->name ('welcome');
Route::get('/shop',[front::class,'shop'])->name ('shop');

Auth::routes();
Route::middleware('auth:web')->group(function () {
    Route::get('dashboard', [Dash::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('order', OrderController::class);

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');



// Customer Authentication Routes
    Route::prefix('customer_panel')->group(function () {
        Route::get('login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
        Route::post('login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
        Route::get('register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
        Route::post('register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
        Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

        // Protected customer routes
        Route::middleware('auth:customer')->group(function () {
            Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('customer_panel.dashboard');
            Route:: resource('order',CustomerOrderController::class, ['as' => 'customer_panel']);
            Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
            Route::post('wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
            Route::delete('wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
            Route::get('wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

            Route::get('cart',[CartController::class,'viewCart'])->name('cart.view');
            Route::post('cart/add',[CartController::class,'addToCart'])->name('cart.add');
            Route::post('cart/update',[CartController::class,'updateCart'])->name('cart.update');
            Route::get('cart/remove/{id}',[CartController::class,'removeFromCart'])->name('cart.remove');
            Route::post('cart/check_coupon',[CartController::class,'checkCoupon'])->name('cart.check_coupon');
            Route::get('cart/count', [CartController::class, 'count'])->name('cart.count');
            Route::get('checkout',[CheckoutController::class,'checkout'])->name('checkout');
            Route::post('checkout/place_order',[CheckoutController::class,'placeOrder'])->name('checkout.place_order');

            
        });
        });


        