<!DOCTYPE html>
<html lang="en">
    <head>
   @include('Admin.components.css')
    </head>
    <body class="sb-nav-fixed">
       @include('Admin.components.navbar')
        <div id="layoutSidenav">
            @include('Admin.components.sidebar')
            <div id="layoutSidenav_content">
                <main>


                    <a href="{{ url('/admin/show_product') }}" class="btn btn-dark mt-3 ms-3">
                        <i class="bi bi-arrow-left"></i>
                        back
                    </a>
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0 ">

                                        <h6>View Product</h6>
                                    </div>
                                    <div class="card-body px-auto pt-0 pb-2">

                                        <div class="mt-4 row">
                                            <div class="col-md-6">
                                                <div class="mb-3 text-center">
                                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product->name }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3 text-center">
                                                    <label for="categorySelect" class="form-label">Category</label>
                                                    @foreach($category as $category)
                                                        @if($category->id == $product->category_id)
                                                            <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>


                                        </div>


                                    </div>

                                    <div class="mt-4 row justify-content-center">
                                        <div class="col-4"></div>
                                        <div class="col-4 col-md-2">
                                            <div class="mb-3 text-center">
                                                <label for="exampleInputPassword1" class="form-label">
                                                    Description
                                                </label>
                                                <p class="form-control-plaintext">{{ $product->description }}</p>
                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>


                                    <div class="mt-4 row justify-content-center">
                                        <div class="col-4"></div>
                                        <div class="col-4 col-md-2">
                                            <div class="mb-3 text-center">
                                                <label for="exampleInputPassword1" class="form-label">
                                                    Images
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4"></div>



                                    </div>




                                    <div class="mt-4 row justify-content-center">
                                        <div class="col-4"></div>
                                        <div class="col-4 col-md-2">
                                            <div class="mb-3 text-center">
                                                <img src="/product/{{ $product->img }}" width="100px" />

                                            </div>
                                        </div>
                                        <div class="col-4"></div>



                                    </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                </main>
               @include('Admin.components.footer')
            </div>
        </div>
      @include('Admin.components.js')
    </body>
</html>
