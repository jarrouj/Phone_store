
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
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">




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
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordersData as $orderData)
                                @php
                                    $order = $orderData['order'];
                                    $products = $orderData['products'];
                                @endphp

                                <tr>
                                    <td colspan="6" class="order-header">
                                        <strong style="color: red">Order #{{ $order->order_number }}</strong>
                                    </td>
                                </tr>

                                @foreach($products as $productData)
                                    @php
                                        $product = $productData['product'];
                                        $qty = $productData['qty'];
                                        $total = $productData['total'];
                                    @endphp

                                    <tr>

                                        <td class="product-thumbnail">
                                            <img src="product/{{ $product->img }}" alt="{{ $product->name }}" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $product->name }}</h2>
                                        </td>
                                        <td>{{ $qty }}</td>
                                        <td class="product-price">${{ number_format($product->price, 2) }}</td>
                                        <td class="item-total">${{ number_format($total, 2) }}</td>
                                    </tr>
                                @endforeach

                                <!-- Optional: Display Order Total -->
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Order Total:</strong></td>
                                    <td><strong>${{ number_format($products->sum('total'), 2) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                  </div>
                </form>
              </div>


            </div>
          </div>


		<!-- Start Footer Section -->
		@include('Home.components.footer')
		<!-- End Footer Section -->


        <script src="{{ asset('home/assets/js/jquery-1.11.0.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
		<script src="{{ asset('cart-page/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{ asset('cart-page/js/tiny-slider.js')}}"></script>
		<script src="{{ asset('cart-page/js/custom.js')}}"></script>
	</body>

</html>
