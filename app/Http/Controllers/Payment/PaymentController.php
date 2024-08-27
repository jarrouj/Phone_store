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
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaymentController extends Controller
{

    //stripe

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
                return redirect('/cancel');
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

            return redirect('/order-success');

        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/cancel');
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
        $order->order_number = mt_rand(100000, 999999); // generates a random 6-digit number
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

    //paypal

    public function paypal(Request $request , $amount)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                 "return_url" => route('success'),
                 "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                       "currency_code" => "USD",
                       "value" => $amount
                    ]
                ]
            ]
        ]);

        // Check if the response is valid and contains the expected data
        if (isset($response['id']) && !empty($response['id']) && isset($response['links'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->qty);
                    $this->Order($amount);
                    return redirect()->away($link['href']);
                }
            }
            // If no approve link found, redirect to cancel
            return redirect()->route('cancel');
        }

        // If response is not valid, redirect to cancel
        return redirect()->route('cancel');
    }


    public function success(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        return redirect('/order-success');
    }

    //cash on delivery
    public function cash_on_delivery($amount)
    {
        try {
            $this->Order($amount);

            return redirect('/order-success');
        } catch (\Exception $e) {

            return redirect('/cancel');
        }
    }


    public function cancel()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $cartItemCount = 0;
        }



        return view('404' , compact('cartItemCount', 'cartItems'));
    }

    public function order_success()
    {
        return view('order_success');
    }

}
