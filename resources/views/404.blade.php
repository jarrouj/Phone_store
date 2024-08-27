<!DOCTYPE html>
<html>

<head>
    @include('Home.components.css')
    <style>
.page-404 {
  padding: 150px 0;
}
.page-404 h3 {
  font-size: 200px;
  font-weight: 700;
  line-height: 1;
  margin-bottom: 0;
  color: #606da6;
  margin-bottom: 0;
}
.page-404 h4 {
  font-family: "Lato", sans-serif;
  font-style: italic;
  font-size: 36px;
  line-height: 1;
  margin-bottom: 50px;
  letter-spacing: 5px;
  text-transform: capitalize;
}
.page-404 p {
  color: #606da6;
  font-size: 18px;
  margin-bottom: 22px;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-weight: 700;
}
.page-404 a {
  position: relative;
  font-size: 13px;
  text-transform: uppercase;
  font-weight: 900;
  color: #000000;
  letter-spacing: 3px;
  margin-bottom: 51px;
  display: inline-block;
}
.page-404 a:before {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 1px;
  background-color: #000000;
  -webkit-transition: all 0.4s linear;
  -moz-transition: all 0.4s linear;
  -ms-transition: all 0.4s linear;
  -o-transition: all 0.4s linear;
  transition: all 0.4s linear;
}
.page-404 a:after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 1px;
  background-color: #606da6;
  -webkit-transition: all 0.4s linear;
  -moz-transition: all 0.4s linear;
  -ms-transition: all 0.4s linear;
  -o-transition: all 0.4s linear;
  transition: all 0.4s linear;
}
.page-404 a:hover {
  color: #606da6;
}
.page-404 a:hover:after {
  width: 100%;
}
.page-404 form {
  position: relative;
  margin: auto;
  width: 100%;
  max-width: 400px;
}
.page-404 form .form-control {
  height: 40px;
  border-radius: 40px;
  background-color: #ebebeb;
  border: none;
  padding: 0 25px;
  font-size: 15px;
  color: #a1a1a1;
  margin-bottom: 0;
}
.page-404 form button {
  position: absolute;
  top: 8px;
  right: 12px;
  font-size: 16px;
  color: #000000;
  border: none;
  background: transparent;
  cursor: pointer;
}
.page-404 form button:hover {
  color: #606da6;
}

@media only screen and (min-width: 320px) and (max-width: 479px) {
  .page-404 {
    padding-top: 150px !important;
    padding-bottom: 150px !important;
  }
  .page-404 h3 {
    font-size: 100px;
    margin-bottom: 30px;
  }
  .page-404 h4 {
    font-size: 22px;
    letter-spacing: 5px;
  }
}
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">



    @include('Home.components.header')
    <!--404
=============================================-->
    <section class="page-404 text-center mtop-20 bg-parallax">
        {{-- <div class="bg-section"><img src="404-img/banner-image.png" alt="background"></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3>404</h3>
                    <h4>Ohh! Something Went Wrong</h4>
                    <a href="{{ url('/') }}">PLEASE RETURN TO HOME PAGE</a>

                </div>
            </div><!-- .row end -->
        </div><!-- .cotainer end -->
    </section><!-- .page-404 end -->

    @include('Home.components.footer')

    <script src="home/assets/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="home/assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="home/assets/js/plugins.js"></script>
    <script type="text/javascript" src="home/assets/js/script.js"></script>
</body>

</html>
