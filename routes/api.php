<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// {{ Authentication Api }}
Route::post('/register' , [AuthController::class , 'register'])->name('registerApi')->middleware('web' , StartSession::class);
Route::post('/login' , [AuthController::class , 'login'])->name('loginApi')->middleware('web' , StartSession::class);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('web' , StartSession::class);


// {{ Cart }}
Route::post('/add_cart' , [CartController::class , 'add_cart'])->middleware('web');
Route::get('/delete_cart_item/{id}' , [CartController::class , 'delete_cart_item'])->middleware('web');
Route::post('/update_cart_item/{id}' , [CartController::class , 'update_cart_item'])->middleware('web');




// {{ Stripe Payment }}
Route::post('/stripe_payment/{amount}' , [PaymentController::class , 'makePayment'])->middleware('web');
Route::get('/check' , [PaymentController::class , 'getData']);
