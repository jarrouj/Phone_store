<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// {{ Authentication Api }}
Route::post('/register' , [AuthController::class , 'register'])->name('registerApi')->middleware('web');
Route::post('/login' , [AuthController::class , 'login'])->name('loginApi')->middleware('web');


