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
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        {{-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register</h5>
                        </div>
                        @if ($errors->any())
                            <div>
                                <ul class="mt-3 list-disc text-danger list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('registerApi') }}">
                                @csrf

                                <div class="mb-3">
                                    <input type="text" id="name" class="form-control" placeholder="Full Name"
                                        aria-label="Full Name" name="name" :value="old('name')" required autofocus
                                        autocomplete="name" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <input type="text" id="name" class="form-control" placeholder="Last Name"
                                        aria-label="Last Name" name="l_name" :value="old('l_name')" required autofocus
                                        autocomplete="l_name" required>
                                </div> --}}

                                <div class="mb-3">
                                    <input type="number" id="phone" class="form-control" placeholder="Phone Number"
                                        aria-label="phone" name="phone" :value="old('phone')" required autofocus
                                        autocomplete="phone" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" id="name" class="form-control" placeholder="Address"
                                        aria-label="Address" name="address" :value="old('address')" required autofocus
                                        autocomplete="address" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" id="email" class="form-control" placeholder="Email"
                                        aria-label="Email" name="email" :value="old('email')" required
                                        autocomplete="username" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password"
                                        aria-label="Password" name="password" id="password" required
                                        autocomplete="new-password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password Confirmation"
                                        aria-label="Password_confirmation" name="password_confirmation"
                                        id="password_confirmation" required autocomplete="new-password" required>
                                </div>
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                            and Conditions</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                        up</button>
                                </div>

                            </form>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-0 text-sm mx-auto mt-3">
                                    Already have an account?
                                    <a href="{{ route('login') }}"
                                        class="text-primary text-gradient font-weight-bold">Login</a>
                                </p>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <div class="line"></div>
                                <div class="media-options mt-2">
                                    <a href="/auth/google/redirect" class="btn btn-google">
                                        <i class="fab fa-google google-icon"></i>
                                        Register with Google
                                    </a>
                                </div>
                                <div class="media-options mt-2">
                                    <a href="/auth/github/redirect" class="btn btn-github">
                                        <i class="fab fa-github github-icon"></i>
                                        Register with GitHub
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    {{-- <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Company
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        About Us
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Team
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Products
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Blog
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Pricing
                    </a>
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Soft by Creative Tim.
                    </p>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

        <!-- FontAwesome Icons (for Google and GitHub logos) -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('auth/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('auth/js/plugins/smooth-scrollbar.min.js') }}"></script>
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
    <script src="{{ asset('auth/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>

</html>
