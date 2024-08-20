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

                {{-- Search --}}
                <div class="row">
                    <div class="col-12">
                        <div class="d-block w-50 m-auto">
                            <form action="{{ url('/admin/search_product') }}" method="GET">
                                @csrf
                                <p for="" class="text-center form-label">Search Product
                                </p>

                                <div class="d-flex justify-content-center">

                                    <div class="input-group mb-3 w-75">

                                        <input type="text" name="query" class="form-control" placeholder="Product name"
                                            style="height: 41px " id="searchInput">

                                    </div>

                                </div>

                            </form>
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
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Image
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Name
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Category
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Description
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Price
                                                    </th>
                                                    <th class="text-secondary opacity-7"></th>
                                                    <th class="text-secondary opacity-7"></th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="productTable">
                                                @forelse ($product as $data)
                                                <tr>
                                                    <td class="text-center">
                                                        <img src="/product/{{ $data->img }}" async
                                                            class="d-block m-auto" width="50px" alt="">
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
                                                        <a href="{{ url('admin/view_product', $data->id) }}"
                                                            class="text-white btn btn-primary btn-sm font-weight-bold text-xs"
                                                            data-toggle="tooltip">
                                                            View
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @include('admin.product.update_product')
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <a href="{{ url('admin/delete_product', $data->id) }}"
                                                            class="text-white font-weight-bold text-xs btn btn-danger btn-sm"
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
                                                        <p
                                                            class="text-xs text-center text-danger font-weight-bold mb-0">
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

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchInput = $(this).val().trim();

                $.ajax({
                    url: '{{ url('admin/search_product') }}',
                    type: 'GET',
                    data: { query: searchInput },
                    success: function(response) {
                        let productsHtml = '';
                        const categories = response.categories;

                        response.products.forEach(function(product) {
                            productsHtml += `
                                <tr class="text-center">
                                    <td>
                                        <img src="/product/${product.img}" alt="Product Image" width="50px">
                                    </td>
                                    <td><p class="text-xs font-weight-bold mb-0">${product.name}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">${product.category_name}</p></td>
                                    <td>${product.description ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'}</td>
                                    <td><p class="text-xs font-weight-bold mb-0">${product.price}</p></td>
                                         <td class="align-middle">
                                    <a href="{{ url('admin/view_product') }}/${product.id}" class="text-white btn btn-primary btn-sm font-weight-bold text-xs" data-bs-toggle="tooltip" title="View Product">View <i class="bi bi-eye"></i></a>
                                </td>

                                    <td class="align-middle">
                                        <a href="#" class="text-white btn btn-success btn-sm font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModal${product.id}">Edit <i class="bi bi-pencil"></i></a>

                                        <!-- Edit Modal HTML -->
                                        <div class="modal fade" id="exampleModal${product.id}" tabindex="-1" aria-labelledby="exampleModal${product.id}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModal${product.id}Label">Edit Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('/admin/update_product') }}/${product.id}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                              <div class="mb-3">
                                                            <label for="productImage" class="form-label">Product Image</label><br />
                                                             <img src="/product/${product.img}" alt="Current Image" width="100px"><br /><br />
                                                            <input type="file" name="img" class="form-control">

                                                        </div>

                                                            <div class="mb-3">
                                                                <label for="productName" class="form-label">Product Name</label>
                                                                <input type="text" name="name" class="form-control" required value="${product.name}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productCategory" class="form-label">Category</label>
                                                                <select name="category_id" class="form-select">
                                                                    ${categories.map(category => `
                                                                        <option value="${category.id}" ${category.id == product.category_id ? 'selected' : ''}>${category.name}</option>
                                                                    `).join('')}
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productDescription" class="form-label">Description</label>
                                                                <textarea name="description" class="form-control">${product.description}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productPrice" class="form-label">Price</label>
                                                                <input type="number" name="price" class="form-control" required value="${product.price}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-dark">Update <i class="bi bi-pencil"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a href="/admin/delete_product/${product.id}" class="text-white btn btn-danger btn-sm font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete product" onclick="return confirm('Are you sure you want to delete this product?')">Delete <i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>`;
                        });

                        if (response.products.length === 0) {
                            productsHtml += `
                                <tr>
                                    <td colspan="8">
                                        <p class="text-xs text-center text-danger font-weight-bold mb-0">No Data Found!</p>
                                    </td>
                                </tr>`;
                        }

                        $('#productTable').html(productsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                        console.log(xhr);
                    }
                });
            });
        });
    </script>

    @include('Admin.components.js')
</body>

</html>
