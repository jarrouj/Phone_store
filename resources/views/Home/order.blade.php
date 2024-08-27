
<!doctype html>
<html lang="en">
<head>
@include('Home.components.css')
{{-- <link href="{{ asset('cart-page/style.css')}}" rel="stylesheet"> --}}

<style>

/* body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgb(0, 0, 34);
    font-size: 0.8rem;
} */
.card{
    max-width: 1000px;
    margin: 2vh;
}
.card-top{
    padding: 0.7rem 5rem;
}
.card-top a{
    float: left;
    margin-top: 0.7rem;
}
#logo{
    font-family: 'Dancing Script';
    font-weight: bold;
    font-size: 1.6rem;
}
.card-body{
    padding: 0 5rem 5rem 5rem;
    /* background-image: url("https://i.imgur.com/4bg1e6u.jpg"); */
    background-size: cover;
    background-repeat: no-repeat;
}
@media(max-width:768px){
    .card-body{
        padding: 0 1rem 1rem 1rem;
        /* background-image: url("https://i.imgur.com/4bg1e6u.jpg"); */
        background-size: cover;
        background-repeat: no-repeat;
    }
    .card-top{
        padding: 0.7rem 1rem;
    }
}
.row{
    margin: 0;
}
.upper{
    padding: 1rem 0;
    justify-content: space-evenly;
}
#three{
    border-radius: 1rem;
        width: 22px;
    height: 22px;
    margin-right:3px;
    border: 1px solid blue;
    text-align: center;
    display: inline-block;
}
#payment{
    margin:0;
    color: blue;
}
.icons{
    margin-left: auto;
}
form span{
    color: rgb(179, 179, 179);
}
form{
    padding: 2vh 0;
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.header{
    font-size: 1.5rem;
}
.left{
    background-color: #ffffff;
    padding: 2vh;
}
.left img{
    width: 2rem;
}
.left .col-4{
    padding-left: 0;
}
.right .item{
    padding: 0.3rem 0;
}
.right{
    background-color: #ffffff;
    padding: 2vh;
}
.col-8{
    padding: 0 1vh;
}
.lower{
    line-height: 2;
}
.btn{
    background-color: rgb(23, 4, 189);
    border-color: rgb(23, 4, 189);
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin: 4vh 0 1.5vh 0;
    padding: 1.5vh;
    border-radius: 0;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none;
}
.btn:hover{
    color: white;
}
a{
    color: black;
}
a:hover{
    color: black;
    text-decoration: none;
}
input[type=checkbox]{
    width: unset;
    margin-bottom: unset;
}
#cvv{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575) , rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
#cvv:hover{

}

</style>

	<body>

		<!-- Start Header/Navigation -->
	{{-- @include('Home.components.header') --}}
		<!-- End Header/Navigation -->



   <div class="container" tyle="padding-top: 100px;">

            <div class="card-body" >
                <div class="row upper">
                    <span>
                        <a href="#" onclick="window.history.back();" class="text-decoration-none">
                            <i class="bi bi-arrow-left"></i>

                            Back
                        </a>

                    </span>
                </div>


                <div class="row">
                    <div class="col-md-7">
                        <div class="left border">
                            <div class="row">
                                <span class="header">Payment</span>
                                <div class="icons">
                                    <img src="https://img.icons8.com/color/48/000000/visa.png" onclick="selectPaymentMethod('card')" style="cursor: pointer;" />
                                    <img src="https://img.icons8.com/color/48/000000/paypal.png" onclick="selectPaymentMethod('paypal')" style="cursor: pointer;" />
                                    <img src="https://img.icons8.com/color/48/000000/cash-in-hand.png" onclick="selectPaymentMethod('cash')" style="cursor: pointer;" />
                                </div>
                            </div>

                            <!-- Payment Method Selection (hidden) -->
                            <div class="payment-method" style="display: none;">
                                <label>
                                    <input type="radio" name="paymentMethod" value="card" id="card-method" checked>
                                    Credit/Debit Card
                                </label>
                                <label>
                                    <input type="radio" name="paymentMethod" value="paypal" id="paypal-method">
                                    Pay with PayPal
                                </label>
                                <label>
                                    <input type="radio" name="paymentMethod" value="cash" id="cash-method">
                                    Cash on Delivery
                                </label>
                            </div>

                            <form id="payment-form" method="POST" action="{{ url('/api/stripe_payment/' . $total_amount) }}">
                                @csrf
                            <!-- Card Payment Details -->
                            <div id="card-payment-details" class="payment-details">
                                <span>Cardholder's name:</span>
                                <input type="text" id="cardholder-name" placeholder="Linda Williams" required name="cardholderName">

                                <span>Card Number:</span>
                                <input type="text" id="card-number" placeholder="Card Number" required name="cardNumber">

                                <span>Expiration Date:</span>
                                <input type="text" id="card-expiry" placeholder="MM/YY" required>

                                <span>CVV:</span>
                                <input type="text" id="card-cvc" placeholder="CVV" required name="cvv">

                                <input type="checkbox" id="save_card" class="align-left" name="saveCard">
                                <label for="save_card">Save card details to wallet</label>

                                <button type="submit" id="pay-with-card" class="btn">Pay</button>
                            </div>
                        </form>

                            <!-- PayPal Payment Button -->
                            <div id="paypal-payment-details" class="payment-details" style="display: none;">
                                <form id="paypal-form" action="{{ url('/paypal/' . $total_amount) }}" method="POST">
                                    @csrf
                                    <button type="button" id="pay-with-paypal" class="btn" onclick="submitPaypalForm()">Pay with PayPal</button>
                                </form>
                            </div>

                            <!-- Cash Payment Details (optional message or info) -->
                            <div id="cash-payment-details" class="payment-details" style="display: none;">
                                <p>You have selected Cash on Delivery. Please prepare the exact amount.</p>
                                <form  action="{{ url('/cash_on_delivery/' . $total_amount) }}" method="GET">
                                    @csrf
                                <button type="submit" id="pay-with-cash" class="btn">Pay on Delivery</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @php
                        $total_amount = 0;
                    @endphp
                    <div class="col-md-5">
                        <div class="right border">
                            <div class="header">Order Summary</div>
                            <p>{{ $cartItemCount }} items</p>
                            @foreach ($cartItems as $cartItem)
                                @foreach ($products as $product)
                                    @if ($cartItem->product_id == $product->id)
                                        <div class="row item">
                                            <div class="col-4 align-self-center"><img class="img-fluid" src="product/{{ $product->img }}"></div>
                                            <div class="col-8">
                                                <div class="row"><b>$ {{ $product->price }}</b></div>
                                                <div class="row text-muted">{{ $product->name }}</div>
                                                <div class="row">Qty:{{ $cartItem->qty }}</div>
                                            </div>
                                        </div>

                                        @php
                                            $total_amount += $product->price * $cartItem->qty;
                                        @endphp

                                    @endif
                                @endforeach
                            @endforeach

                            <hr>
                            <div class="row lower">
                                <div class="col text-left">Subtotal</div>
                                <div class="col text-right">$ {{ $total_amount }}</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Delivery</div>
                                <div class="col text-right">Free</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><b>Total to pay</b></div>
                                <div class="col text-right total-amount"><b>$ {{ $total_amount }}</b></div>
                            </div>
                            <p class="text-muted text-center">Complimentary Shipping & Returns</p>
                        </div>
                    </div>
                </div>


                <div id="error-message" class="text-danger"></div>

                <div id="error-message" class="text-danger"></div>
            </div>

         <div>

        </div>
   </div>


		<!-- Start Footer Section -->
		@include('Home.components.footer')
		<!-- End Footer Section -->


        <script src="https://js.stripe.com/v3/"></script>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var stripe = Stripe('pk_test_51PqbbK2Kns2q3peg0be7BM0WLtxZgtZnbtvjbCAo58gkXC6m7UL5DWMEcP0ipeiveC3tjCjpgC9HstVv1QuRCURk00Qtea0sMF'); // Replace with your live key
                var elements = stripe.elements();

                // Create instances of the card elements.
                var cardNumber = elements.create('cardNumber', {
                    placeholder: 'Card Number',
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        }
                    }
                });
                cardNumber.mount('#card-number');

                var cardExpiry = elements.create('cardExpiry', {
                    placeholder: 'MM/YY',
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        }
                    }
                });
                cardExpiry.mount('#card-expiry');

                var cardCvc = elements.create('cardCvc', {
                    placeholder: 'CVV',
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        }
                    }
                });
                cardCvc.mount('#card-cvc');

                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    // Create a token using the card elements
                    stripe.createToken(cardNumber).then(function(result) {
                        if (result.error) {
                            // Display error message
                            document.getElementById('error-message').textContent = result.error.message;
                        } else {
                            // Prepare form data
                            var formData = new FormData(form);
                            formData.append('stripeToken', result.token.id);

                            // Add the total amount to the form data
                            var totalAmountText = document.querySelector('.total-amount').textContent;
                            var totalAmount = parseFloat(totalAmountText.replace('$', '').trim()) * 100; // Convert to cents
                            formData.append('amount', totalAmount); // Append the amount

                            // Send the token and other data to your server
                            fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            }).then(response => response.json()).then(data => {
                                if (data.error) {
                                    document.getElementById('error-message').textContent = data.error;
                                } else {
                                    alert('Payment successful!');
                                    form.reset(); // Reset the form
                                }
                            }).catch(error => {
                                document.getElementById('error-message').textContent = 'An error occurred. Please try again.';
                            });
                        }
                    });
                });
            });
        </script> --}}


        <script>
            function selectPaymentMethod(method) {
                const cardDetails = document.getElementById('card-payment-details');
                const paypalDetails = document.getElementById('paypal-payment-details');
                const cashDetails = document.getElementById('cash-payment-details');

                // Hide all payment details
                cardDetails.style.display = 'none';
                paypalDetails.style.display = 'none';
                cashDetails.style.display = 'none';

                // Show selected payment details
                if (method === 'card') {
                    cardDetails.style.display = 'block';
                } else if (method === 'paypal') {
                    paypalDetails.style.display = 'block';
                } else if (method === 'cash') {
                    cashDetails.style.display = 'block';
                }
            }

            function submitPaypalForm() {
                document.getElementById('paypal-form').submit();
            }
        </script>
		<script src="cart-page/js/bootstrap.bundle.min.js"></script>
		<script src="cart-page/js/tiny-slider.js"></script>
		<script src="cart-page/js/custom.js"></script>
	</body>

</html>
