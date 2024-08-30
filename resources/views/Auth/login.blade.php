<!DOCTYPE html>
<html lang="en">

<head>
    @include('Auth.components.css')
    <style>
        .line {
            position: relative;
            height: 1px;
            width: 100%;
            margin: 15px 0;
            background-color: #d4d4d4;
        }

        .line::before {
            content: 'Or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FFF;
            color: #8b8b8b;
            padding: 0 15px;
        }

        .media-options {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            text-decoration: none;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .btn-google {
            background-color: #db4437;
        }

        .google-icon {
            margin-right: 10px;
        }

        .btn-github {
            background-color: #333;
        }

        .github-icon {
            margin-right: 10px;
        }

        .mt-2 {
            margin-top: 10px;
        }
    </style>
</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    {{-- <p class="mb-0">Enter your email and password to sign in</p> --}}
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <p class="text-danger fs-6">{{ session('status') }}</p>
                                    @endif
                                    <form action="{{ route('loginApi') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg" placeholder="Email"
                                                aria-label="Email" :value="old('email')" required autofocus
                                                autocomplete="username">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg" required
                                                autocomplete="current-password" placeholder="Password"
                                                aria-label="Password">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="remember_me">{{ __('Remember me')
                                                }}</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">{{ __('Log in')
                                                }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-0 text-sm mx-auto mt-3">
                                        Don't have an account?
                                        <a href="{{ route('register') }}"
                                            class="text-primary text-gradient font-weight-bold">Register</a>
                                    </p>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <div class="line"></div>
                                    <div class="media-options mt-2">
                                        <a href="/auth/google/redirect" class="btn btn-google">
                                            <i class="fab fa-google google-icon"></i>
                                            Login with Google
                                        </a>
                                    </div>
                                    <div class="media-options mt-2">
                                        <a href="/auth/github/redirect" class="btn btn-github">
                                            <i class="fab fa-github github-icon"></i>
                                            Login with GitHub
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
