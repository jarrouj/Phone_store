<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserActivity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LandingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Home\OrderController as HomeOrderController;
use App\Http\Controllers\Payment\PaymentController;


Route::get('/', [HomeController::class , 'index']);

// {{ Authentication }}
Route::get('/login', [AuthController::class , 'login_page'])->name('login')->middleware(Authenticate::class);
Route::get('/register', [AuthController::class , 'register_page'])->name('register')->middleware(Authenticate::class);
Route::get('/auth/{provider}/redirect', [AuthController::class , 'redirect'])->middleware('web');
Route::get('/auth/{provider}/callback', [AuthController::class , 'callback'])->middleware('web');

//{{ Cart }}
Route::get('/cart', [HomeController::class , 'show_cart']);

// {{ Order }}
Route::get('/checkout-page', [HomeOrderController::class , 'show_order']);

//{{ User Product }}
Route::get('/products', [HomeController::class , 'show_product']);
Route::get('/products/search', [HomeController::class, 'search'])->name('product.search');


//{{ Payments }}
Route::post('/paypal/{amount}', [PaymentController::class , 'paypal'])->name('paypal');
Route::get('/cash_on_delivery/{amount}', [PaymentController::class , 'cash_on_delivery']);
Route::get('/success', [PaymentController::class , 'success'])->name('success');
Route::get('/cancel', [PaymentController::class , 'cancel'])->name('cancel');
Route::get('/order-success', [PaymentController::class , 'order_success']);

Route::get('/my-order' , [HomeController::class , 'my_order'])->middleware('web');


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
    Route::get('/view_product/{id}' , [ProductController::class , 'view_product']);
    Route::get('/search_product', [ProductController::class, 'search_product']);

    // {{ Order }}
    Route::get('/show_order', [OrderController::class , 'show_order']);
    Route::get('/update_order/{id}' , [OrderController::class , 'update_order']);
    Route::post('/update_order_confirm/{id}' , [OrderController::class , 'update_order_confirm']);
    Route::get('/delete_order/{id}' , [OrderController::class , 'delete_order']);
    Route::get('/view_order/{id}' , [OrderController::class , 'view_order']);
    Route::get('/search_order', [OrderController::class, 'search_order']);
    Route::post('/update-status/{id}',[OrderController::class,'update_status'])->name('update-status');

});
