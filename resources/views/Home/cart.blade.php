
<!doctype html>
<html lang="en">
<head>
@include('Home.components.css')
{{-- <link href="{{ asset('cart-page/style.css')}}" rel="stylesheet"> --}}

<style>
    .untree_co-section {
  padding: 7rem 0; }

 .form-control {
  height: 50px;
  border-radius: 10px;
  font-family: "Inter", sans-serif; }
  .form-control:active, .form-control:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #3b5d50;
    -webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2); }
  .form-control::-webkit-input-placeholder {
    font-size: 14px; }
  .form-control::-moz-placeholder {
    font-size: 14px; }
  .form-control:-ms-input-placeholder {
    font-size: 14px; }
  .form-control:-moz-placeholder {
    font-size: 14px; }

    .site-blocks-table {
  overflow: auto; }
  .site-blocks-table .product-thumbnail {
    width: 200px; }
  .site-blocks-table .btn {
    padding: 2px 10px; }
  .site-blocks-table thead th {
    padding: 30px;
    text-align: center;
    border-width: 0px !important;
    vertical-align: middle;
    color: rgba(0, 0, 0, 0.8);
    font-size: 18px; }
  .site-blocks-table td {
    padding: 20px;
    text-align: center;
    vertical-align: middle;
    color: rgba(0, 0, 0, 0.8); }
  .site-blocks-table tbody tr:first-child td {
    border-top: 1px solid #3b5d50 !important; }
  .site-blocks-table .btn {
    background: none !important;
    color: #000000;
    border: none;
    height: auto !important; }

 .site-block-order-table th {
  border-top: none !important;
  border-bottom-width: 1px !important; }

 .site-block-order-table td, .site-block-order-table th {
  color: #000000; }

 .couponcode-wrap input {
  border-radius: 10px !important; }

 .text-primary {
  color: #3b5d50 !important; }

 .thankyou-icon {
  position: relative;
  color: #3b5d50; }
  .thankyou-icon:before {
    position: absolute;
    content: "";
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(59, 93, 80, 0.2); }



</style>

	<body>

		<!-- Start Header/Navigation -->
	@include('Home.components.header')
		<!-- End Header/Navigation -->


        @php
            $total_amount = 0;
        @endphp



		<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cartItems as $cartItem)
                        @foreach ($products as $product)
                        @if($cartItem->product_id == $product->id)
                        <tr data-id="{{ $cartItem->id }}">
                            <td class="product-thumbnail">
                              <img src="product/{{ $product->img }}" alt="{{ $product->img }}" class="img-fluid">
                            </td>
                            <td class="product-name">
                              <h2 class="h5 text-black">{{ $product->name }}</h2>
                            </td>
                            <td class="product-price" data-price="{{ $product->price }}">${{ $product->price }}</td>
                            <td>
                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-black decrease" type="button" style="outline: none; box-shadow: none; background: none;">&minus;</button>
                                    </div>
                                    <input type="text" class="form-control text-center quantity-amount" value="{{ $cartItem->qty }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-black increase" type="button" style="outline: none; box-shadow: none; background: none;">&plus;</button>
                                    </div>
                                </div>
                            </td>

                            <td class="item-total" data-id="{{ $cartItem->id }}" data-price="{{ $product->price }}">${{ $product->price * $cartItem->qty }}</td>

                            <td><a href="{{ url('/api/delete_cart_item' , ['id' => $cartItem->id ]) }}" class="btn btn-black btn-sm">X</a></td>
                          </tr>
                          @php
                              $total_amount += $product->price * $cartItem->qty
                          @endphp
                        @endif
                        @endforeach

                        @endforeach



                      </tbody>
                    </table>
                  </div>
                </form>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">

                    <div class="col-md-6">
                      <a href="{{ url('/') }}" class="btn btn-black btn-sm btn-block">Continue Shopping</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-black h4" for="coupon">Coupon</label>
                      <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-black">Apply Coupon</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      {{-- <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div> --}}
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black total-amount">${{ $total_amount }}</strong>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='/checkout-page'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


		<!-- Start Footer Section -->
		@include('Home.components.footer')
		<!-- End Footer Section -->

        <script>
 $(document).ready(function() {
    // Decrease quantity
    $('.decrease').click(function() {
        var quantityInput = $(this).closest('.quantity-container').find('.quantity-amount');
        var newQty = parseInt(quantityInput.val());
        if (newQty >= 1) { // Ensure quantity doesn't go below 1
            quantityInput.val(newQty);
            updateCart($(this).closest('tr').data('id'), newQty, $(this));
        }
    });

    // Increase quantity
    $('.increase').click(function() {
        var quantityInput = $(this).closest('.quantity-container').find('.quantity-amount');
        var newQty = parseInt(quantityInput.val());
        quantityInput.val(newQty);
        updateCart($(this).closest('tr').data('id'), newQty, $(this));
    });

    // Update qty cart items with ajax
    function updateCart(cartId, newQty, element) {
        var row = element.closest('tr');
        var price = parseFloat(row.find('.product-price').data('price'));
        var itemTotal = price * newQty;

        // Update item total in the table
        row.find('.item-total').text('$' + itemTotal.toFixed(2));

        // Update overall cart total
        var totalAmount = 0;
        $('.item-total').each(function() {
            totalAmount += parseFloat($(this).text().replace('$', ''));
        });
        $('.total-amount').text('$' + totalAmount.toFixed(2));

        // Send update request to server
        $.ajax({
            url: `/api/update_cart_item/${cartId}`,
            type: 'POST',
            data: {
                qty: newQty,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Cart updated successfully:', response);
                // You may want to handle server response here if needed
            },
            error: function(error) {
                console.log('Error updating cart:', error);
            }
        });
    }
});

        </script>

		<script src="cart-page/js/bootstrap.bundle.min.js"></script>
		<script src="cart-page/js/tiny-slider.js"></script>
		<script src="cart-page/js/custom.js"></script>
	</body>

</html>
