<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Vegyfood;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/



Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin.add-product');
});

Route::get('/addProduct', function () {
    return view('admin.add-product');
});

Route::post('/add', [Vegyfood::class,'addProduct']);

Route::get('/product', [Vegyfood::class,'showProducts']);

Route::get('/account', function () {
    return view('admin/accounts');
});


Route::get('/my-orders', function () {
    return view('my-orders');
})->name('my-orders');

Route::POST('/billSubmit', [Vegyfood::class,'billSubmit']);

Route::get('/products/{cat}', [Vegyfood::class,'index']);



Route::get('/about', function () {
    return view('about');
});

Route::get('/logout', [Vegyfood::class,'logout']);

Route::post('/addCart', [Vegyfood::class,'addCart']);

Route::get('/product-single/{id}', [Vegyfood::class,'product_single']);

Route::get('/blog-single', function () {
    return view('blog-single');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/product-single', function () {
    return view('product-single');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/subscribe', [Vegyfood::class,'subscribe']);
