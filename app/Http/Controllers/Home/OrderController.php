<?php

namespace App\Http\Controllers\Home;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show_order()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }

        $products = Product::all();

        $total_amount = 0;

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            if ($product) {
                $total_amount += $product->price * $cartItem->qty;
            }
        }

        return view('Home.order', compact('cartItemCount', 'cartItems', 'products', 'total_amount'));
    }


}
