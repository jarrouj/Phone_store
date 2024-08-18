<section id="billboard" class="position-relative overflow-hidden bg-light-blue">
    <div class="swiper main-swiper">
      <div class="swiper-wrapper">
          @foreach ($landings as $landing)
          <div class="swiper-slide">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-md-6">
                    <div class="banner-content">
                      <h1 class="display-2 text-uppercase text-dark pb-5">{{ $landing->title }}</h1>
                      <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="image-holder">
                      <img src="landing/{{ $landing->img }}" alt="banner">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach


      </div>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-prev">
      <svg class="chevron-left">
        <use xlink:href="#chevron-left" />
      </svg>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-next">
      <svg class="chevron-right">
        <use xlink:href="#chevron-right" />
      </svg>
    </div>
  </section>
