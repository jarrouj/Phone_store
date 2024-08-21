<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
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
