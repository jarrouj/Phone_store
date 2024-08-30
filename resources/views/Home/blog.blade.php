<section id="latest-blog" class="padding-large">
    <div class="container">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark text-uppercase">Latest Posts</h2>
          <div class="btn-right">
            <a href="blog.html" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
          </div>
        </div>
        <div class="post-grid d-flex flex-wrap justify-content-between">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-sm-12">
                <div class="card border-none me-3">
                  <div class="card-image">
                    <img src="blog/{{ $blog->img }}" alt="{{ $blog->img }}" class="img-fluid">
                  </div>
                </div>
                <div class="card-body text-uppercase">
                  <div class="card-meta text-muted">
                    <span class="meta-date">{{ $blog->created_at->format('M d, Y') }}</span>
                    <span class="meta-category">- {{ $blog->title }}</span>
                  </div>
                  <h3 class="card-title">
                    <a href="#">{{ $blog->description }}</a>
                  </h3>
                </div>
              </div>
            @endforeach


        </div>
      </div>
    </div>
  </section>
