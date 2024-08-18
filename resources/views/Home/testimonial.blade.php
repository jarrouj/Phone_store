<section id="testimonials" class="position-relative">
    <div class="container">
      <div class="row">
        <div class="review-content position-relative">
          <div class="swiper-icon swiper-arrow swiper-arrow-prev position-absolute d-flex align-items-center">
            <svg class="chevron-left">
              <use xlink:href="#chevron-left" />
            </svg>
          </div>
          <div class="swiper testimonial-swiper">
            <div class="quotation text-center">
              <svg class="quote">
                <use xlink:href="#quote" />
              </svg>
            </div>
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)

                @endforeach
              <div class="swiper-slide text-center d-flex justify-content-center">
                <div class="review-item col-md-10">
                  <i class="icon icon-review"></i>
                  <blockquote>“{{ $testimonial->text }}”</blockquote>
                  {{-- <div class="rating">
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-half">
                      <use xlink:href="#star-half"></use>
                    </svg>
                    <svg class="star star-empty">
                      <use xlink:href="#star-empty"></use>
                    </svg>
                  </div> --}}
                  <div class="author-detail">
                    <div class="name text-dark text-uppercase pt-2">{{ $testimonial->title }}</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </section>
