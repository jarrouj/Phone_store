<?php

namespace App\Http\Controllers\Home;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Landing;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $categories = Category::all();


        return view('Home.cart', compact('cartItemCount', 'cartItems', 'products' , 'categories'));
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


        return view('Home.home', compact('landings', 'blogs', 'testimonials', 'categories', 'products', 'cartItemCount'));
    }

    public function my_order()
    {
        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }

        // Retrieve the orders for the authenticated user, ordered by the latest first
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $orderProducts = OrderProduct::whereIn('order_id', $orders->pluck('id'))->get();

        // Retrieve the products associated with the order products
        $products = Product::whereIn('id', $orderProducts->pluck('product_id'))->get();

        // Map the orders with their related products and quantities
        $ordersData = $orders->map(function ($order) use ($orderProducts, $products) {
            $relatedOrderProducts = $orderProducts->where('order_id', $order->id);

            $productData = $relatedOrderProducts->map(function ($orderProduct) use ($products) {
                $product = $products->where('id', $orderProduct->product_id)->first();
                return [
                    'product' => $product,
                    'qty' => $orderProduct->qty,
                    'total' => $product->price * $orderProduct->qty,
                ];
            });

            return [
                'order' => $order,
                'products' => $productData,
            ];
        });

        return view('Home.pages.order', ['ordersData' => $ordersData], compact('cartItemCount'));
    }

    public function show_product()
    {
        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }

        $categories = Category::all();

        return view('Home.pages.products' , compact('cartItemCount' , 'categories'));
    }

    public function search(Request $request)
    {
        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }

        $query = $request->input('query');

        // Search for products by name
        $products = Product::where('name', 'LIKE',  "%$query%")->get();

        return view('Home.pages.products', compact('products' , 'cartItemCount'));
    }

}
