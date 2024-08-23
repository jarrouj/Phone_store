<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Landing;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show_cart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }
        $products = Product::all();

        return view('Home.cart' ,compact('cartItemCount' , 'cartItems' , 'products'));
    }

    public function index()
    {
        $landings     = Landing::all();
        $blogs        = Blog::all();
        $testimonials = Testimonial::all();
        $categories   = Category::all();
        $products     = Product::all();
        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }

        return view('Home.home' , compact('landings' , 'blogs' , 'testimonials' , 'categories' , 'products' , 'cartItemCount'));
    }


}
