<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
      <div class="row">
        @foreach ($categories as $category)
        @php
            // Get products that belongs to this category
            $categoryProducts = $products->where('category_id', $category->id);
        @endphp

        @if ($categoryProducts->isNotEmpty()) <!-- Check if the category has products -->
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">{{ $category->name }}</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>


                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($categoryProducts as $product)
                        <div class="swiper-slide">
                            <div class="product-card position-relative">
                                <div class="image-holder">
                                    <img src="/product/{{ $product->img }}" alt="product-item" class="img-fluid">
                                </div>
                                <div class="cart-concern position-absolute">
                                    <div class="cart-button d-flex">
                                        <button type="button" class="btn btn-medium btn-black add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart
                                            <svg class="cart-outline">
                                                <use xlink:href="#cart-outline"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                    <h3 class="card-title text-uppercase">
                                        <a href="#">{{ $product->name }}</a>
                                    </h3>
                                    <span class="item-price text-primary">${{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

        @endif
    @endforeach


      </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
  </section>





<script>
    $(document).ready(function() {
        $('.add-to-cart-btn').on('click', function(e) {
            e.preventDefault();

            let productId = $(this).data('product-id');
            let quantity = 1;

            $.ajax({
                url: '{{ url('/api/add_cart') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    qty: quantity
                },
                success: function() {
                    // Increment cart item count directly
                    let currentCount = parseInt($('#cartItemCount').text()) || 0;
                    $('#cartItemCount').text(currentCount + 1);
                },
                error: function(xhr, status, error) {
                   // Increment cart item count directly
                   let currentCount = parseInt($('#cartItemCount').text()) || 0;
                    $('#cartItemCount').text(currentCount + 1);
                }
            });
        });
    });
</script>

