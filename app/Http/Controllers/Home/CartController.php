<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



    public function add_cart(Request $request)
    {
        try {
            if (!Auth::check()) {
                // Redirect to login if the user is not authenticated
                return redirect('/login');
            }
            if (Auth::check())
            {
                $user = Auth::user();

                // Check if the product is already in the cart for the current user
                $cart = Cart::where('user_id', $user->id)
                            ->where('product_id', $request->product_id)
                            ->first();

                if ($cart) {
                    // If product exists, increment the quantity
                    $cart->qty += $request->qty;
                    $cart->save();
                } else {
                    // If product does not exist, create a new cart entry
                    $cart = new Cart();
                    $cart->user_id = $user->id;
                    $cart->product_id = $request->product_id;
                    $cart->qty = $request->qty;
                    $cart->save();
                }

                // Get updated cart item count
                $cartItemCount = Cart::where('user_id', $user->id)->count();

            } else
            {
                // Handling for guest users (not logged in)
                $cart = session()->get('cart', []);
                $productExists = false;

                // Check if the product is already in the session cart
                foreach ($cart as &$cartItem) {
                    if ($cartItem['product_id'] == $request->product_id) {
                        // Increment the quantity if product exists in the session cart
                        $cartItem['qty'] += $request->qty;
                        $productExists = true;
                        break;
                    }
                }

                if (!$productExists) {
                    // If the product does not exist, add it to the session cart
                    $cart[] = [
                        'product_id' => $request->product_id,
                        'qty' => $request->qty,
                    ];
                }

                session()->put('cart', $cart);

                // Get updated cart item count for guest users
                $cartItemCount = count($cart);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cart_item' => $cart,
                'cartItemCount' => $cartItemCount
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error adding the product to the cart.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update_cart_item($id , Request $request)
    {
        $cart = Cart::find($id);

        $cart->qty = $request->qty;

        $cart->save();

        return response()->json($cart);
    }

    public function delete_cart_item($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

}
