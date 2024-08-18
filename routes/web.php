<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserActivity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LandingController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('/', [HomeController::class , 'index']);

// {{ Authentication }}
Route::get('/login', [AuthController::class , 'login_page'])->name('login');
Route::get('/register', [AuthController::class , 'register_page'])->name('register');
Route::get('/auth/{provider}/redirect', [AuthController::class , 'redirect']);
Route::get('/auth/{provider}/callback', [AuthController::class , 'callback']);




Route::prefix('/admin')->middleware(Authenticate::class , UserActivity::class)->group(function () {

    Route::get('/', [CmsController::class , 'index']);

    // {{ User }}
    Route::get('/show_user', [UserController::class , 'show_users']);
    Route::get('/update_user/{id}', [UserController::class , 'update_user']);
    Route::post('/update_user_confirmation/{id}', [UserController::class , 'update_user_confirmation']);
    Route::get('/delete_user/{id}', [UserController::class , 'delete_user']);
    Route::post('/search_user', [UserController::class, 'search_user']);

    // {{ Blog }}
    Route::get('/show_blog', [BlogController::class , 'show_blog']);
    Route::post('/add_blog', [BlogController::class , 'add_blog']);
    Route::post('/update_blog/{id}' , [BlogController::class , 'update_blog']);
    Route::get('/delete_blog/{id}' , [BlogController::class , 'delete_blog']);

    //{{ Landing }}
    Route::get('/show_landing', [LandingController::class , 'show_landing']);
    Route::post('/add_landing', [LandingController::class , 'add_landing']);
    Route::post('/update_landing/{id}' , [LandingController::class , 'update_landing']);
    Route::get('/delete_landing/{id}' , [LandingController::class , 'delete_landing']);

    // {{ Testimonial }}
    Route::get('/show_testimonial', [TestimonialController::class , 'show_testimonial']);
    Route::post('/add_testimonial', [TestimonialController::class , 'add_testimonial']);
    Route::post('/update_testimonial/{id}' , [TestimonialController::class , 'update_testimonial']);
    Route::get('/delete_testimonial/{id}' , [TestimonialController::class , 'delete_testimonial']);


});
