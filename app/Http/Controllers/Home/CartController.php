<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function show_cart()
    {
        $product = 'hello';
        dd($product);
        return view('welcome');
    }


    public function add_cart(Request $request)
    {
        try {
            if (Auth::check()) {
                $cart = new Cart();
                $user = Auth::user();

                $cart->user_id = $user->id;
                $cart->product_id = $request->product_id;
                $cart->qty = $request->qty;

                $cart->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product added to cart successfully!',
                    'cart_item' => $cart
                ], 200);
            } else {
                $cartItem = [
                    'product_id' => $request->product_id,
                    'qty' => $request->qty,
                ];


                $cart = session()->get('cart', []);


                $cart[] = $cartItem;

                session()->put('cart', $cart);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product added to cart successfully!',
                    'cart_item' => $cartItem
                ], 200);
            }

            // Get updated cart item count
           $cartItemCount = $user ? Cart::where('user_id', $user->id)->count() : count(session('cart', []));
           return response()->json(['cartItemCount' => $cartItemCount]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error adding the product to the cart.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
