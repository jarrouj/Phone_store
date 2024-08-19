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

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">

                                @include('admin.product.add_product')

                            </div>
                        </div>
                    </div>

                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>All Products</h6>
                                    </div>



                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Image
                                                        </th>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Name
                                                        </th>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Category
                                                        </th>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Description
                                                        </th>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Price
                                                        </th>
                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @forelse ($product as $data)
                                                    <tr>
                                                        <td class="text-center">
                                                            <img src="/product/{{ $data->img }}" async class="d-block m-auto" width="50px" alt="">
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $data->name }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                @foreach ($categories as $category)
                                                                @if ($category->id == $data->category_id)
                                                                {{ $category->name }}
                                                                @endif
                                                                @endforeach
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($data->description)
                                                            <i class="fa fa-check text-success"></i>
                                                            @else
                                                            <i class="fa fa-times text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $data->price }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <a href="{{ url('admin/view_product', $data->id) }}" class="text-white btn btn-primary btn-sm font-weight-bold text-xs"
                                                                data-toggle="tooltip">
                                                                View
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            @include('admin.product.update_product')
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <a href="{{ url('admin/delete_product', $data->id) }}" class="text-white font-weight-bold text-xs btn btn-danger btn-sm"
                                                                data-toggle="tooltip" data-original-title="Edit product"
                                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                                Delete
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="16" class="text-center">
                                                            <p class="text-xs text-center text-danger font-weight-bold mb-0">
                                                                No Data !
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            {{ $product->render('admin.pagination') }}
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
