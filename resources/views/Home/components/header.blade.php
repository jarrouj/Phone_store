<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img src="home/assets/images/main-logo.png" class="logo">
        </a>
        <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="navbar-icon">
            <use xlink:href="#navbar-icon"></use>
          </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
          <div class="offcanvas-header px-4 pb-0">
            <a class="navbar-brand" href="index.html">
              <img src="home/assets/images/main-logo.png" class="logo">
            </a>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
          </div>
          <div class="offcanvas-body">
            <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link me-4 active" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="#company-services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="#mobile-products">Products</a>
              </li>

              <li class="nav-item">
                <a class="nav-link me-4" href="#yearly-sale">Sale</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="#latest-blog">Blog</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="about.html" class="dropdown-item">About</a>
                  </li>
                  <li>
                    <a href="blog.html" class="dropdown-item">Blog</a>
                  </li>
                  <li>
                    <a href="shop.html" class="dropdown-item">Shop</a>
                  </li>
                  <li>
                    <a href="cart.html" class="dropdown-item">Cart</a>
                  </li>
                  <li>
                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                  </li>
                  <li>
                    <a href="single-post.html" class="dropdown-item">Single Post</a>
                  </li>
                  <li>
                    <a href="single-product.html" class="dropdown-item">Single Product</a>
                  </li>
                  <li>
                    <a href="contact.html" class="dropdown-item">Contact</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <div class="user-items ps-5">
                    <ul class="d-flex justify-content-end list-unstyled">
                        <li class="search-item pe-3">
                            <a href="#" class="search-button">
                                <i class="bi bi-search" style="font-size: 15px; color: black;"></i> <!-- Search icon -->
                            </a>
                        </li>
                        {{-- <li class="cart-item pe-3">
                            <a href="{{ url('/shop-now') }}" class="cart-button">
                                <i class="bi bi-cart" style="font-size: 24px; color: black;"></i> <!-- Cart icon -->
                            </a>
                        </li> --}}
                        <!-- Add other items here -->
                    </ul>
                </div>
            </li>


                    <li class="pe-3">
                        @if(session('token') !== null)
                            <!-- Dropdown for authenticated users -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-fill" style="font-size: 18px; color: black;"></i> <!-- Person icon -->
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/api/logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <!-- Logout form -->
                                        <form id="logout-form" action="{{ url('/api/logout') }}" method="GET" style="display: none;">
                                            @csrf
                                            @php
                                                // session()->forget('token'); // Clear the session token when logging out
                                            @endphp
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <!-- Link for unauthenticated users -->
                            <a href="{{ route('login') }}">
                                <i class="bi bi-person-fill" style="font-size: 18px; color: black;"></i> <!-- Person icon -->
                            </a>
                        @endif
                    </li>





                    <li class="cart-icon" style="position: relative;">
                        <a href="{{ url('/cart') }}">
                            <i class="bi bi-cart-fill" style="font-size: 18px; color: black; z-index: 999;"></i> <!-- Adjusted size -->
                            <span id="cartItemCount" class="cart-badge" style="
                                position: absolute;
                                top: -10px; /* Adjust as needed */
                                right: -10px; /* Adjust as needed */
                                background-color: red; /* Red background for the badge */
                                color: white; /* White text color */
                                border-radius: 50%; /* Circular shape */
                                width: 18px; /* Adjusted width of the badge */
                                height: 18px; /* Adjusted height of the badge */
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 10px; /* Adjusted font size of the number */
                            ">{{ $cartItemCount }}</span> <!-- Badge for item count -->
                        </a>
                    </li>


                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
