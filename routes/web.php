<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserActivity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LandingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
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

    // {{ Service }}
    Route::get('/show_service', [ServiceController::class , 'show_service']);
    Route::post('/add_service', [ServiceController::class , 'add_service']);
    Route::post('/update_service/{id}' , [ServiceController::class , 'update_service']);
    Route::get('/delete_service/{id}' , [ServiceController::class , 'delete_service']);

    // {{ Category }}
    Route::get('/show_category', [CategoryController::class , 'show_category']);
    Route::post('/add_category', [CategoryController::class , 'add_category']);
    Route::post('/update_category/{id}' , [CategoryController::class , 'update_category']);
    Route::get('/delete_category/{id}' , [CategoryController::class , 'delete_category']);
    Route::get('/search_category', [CategoryController::class, 'search_category']);


    // {{ Product }}
    Route::get('/show_product', [ProductController::class , 'show_product']);
    Route::post('/add_product', [ProductController::class , 'add_product']);
    Route::post('/update_product/{id}' , [ProductController::class , 'update_product']);
    Route::get('/delete_product/{id}' , [ProductController::class , 'delete_product']);

});
