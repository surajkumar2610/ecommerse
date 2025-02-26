<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProductsController::class, "index"])->name("home");

Route::get("login", [AuthController::class, "login"])->name("login");
Route::get("register", [AuthController::class, "register"])->name("register");
Route::post("login", [AuthController::class, "loginPost"])->name("login.post");
Route::post("register", [AuthController::class, "registerPost"])->name("register.post");

Route::get("logout", [AuthController::class, "logout"])->name("logout");

Route::get("/products/{slug}", [ProductsController::class, "details"])->name("products.details");

Route::middleware("auth")->group(function(){
    Route::get("/cart/{id}", [ProductsController::class, "addToCart"])->name("cart.add");
    Route::get("/cart", [ProductsController::class, "showcart"])->name("cart.show");

    Route::get("/checkout", [OrderController::class, "showcheckout"])->name("checkout.show");
    Route::post("/checkout", [OrderController::class, "checkoutPost"])->name("checkout.post");
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::post('/cart/update', [ProductsController::class, 'updateCart'])->name('cart.update');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});