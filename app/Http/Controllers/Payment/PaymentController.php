<?php

namespace App\Http\Controllers\Payment;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $testCardNumbers = [
        '4242424242424242', // Visa
        '5555555555554444', // MasterCard
        '378282246310005',  // American Express
        '6011111111111117', // Discover
    ];

    public function makePayment(Request $request, $amount)
    {

        try {
            // Extract card details from the request
            $cardNumber = $request->input('cardNumber');
            $cvv = $request->input('cvv');
            $cardholderName = $request->input('cardholderName');
            $saveCard = $request->input('saveCard') ? 'true' : 'false';

            // Check if the card number is a valid test card number
            if (!in_array($cardNumber, $this->testCardNumbers)) {
                return response()->json(['error' => 'Invalid test card number.'], 400);
            }

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            \Stripe\Charge::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => 'usd',
                'source' => 'tok_visa', // Use a test token; actual card details are not passed to Stripe
                'description' => 'Payment for ' . $cardholderName,
                'metadata' => [
                    'save_card' => $saveCard
                ]
            ]);

           $this->Order($amount);

            return view('order_success');

        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function Order($amount)
    {
        $order = new Order();
        $user  = Auth::user();

        $order->user_id = $user->id;
        $order->username = $user->name;
        $order->address = 'ugfyut';
        $order->phone   = '7686';
        $order->email   = $user->email;
        $order->order_number  = 15;
        $order->paid    = 1;
        $order->method  = 1;
        // promo
        $order->total_usd = $amount;
        $order->save();

        $cartItems = Cart::where('user_id', $user->id)->get();
        foreach ($cartItems as $cartItem) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $cartItem->product_id,
                'qty'   =>     $cartItem->qty,
                'price'      => $cartItem->price,
            ]);
        }
        Cart::where('user_id', $user->id)->delete();

    }

}
