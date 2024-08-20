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

                                @include('admin.category.add_category')

                            </div>
                        </div>
                    </div>

                      {{-- Search --}}
                      <div class="row">
                        <div class="col-12">
                            <div class="d-block w-50 m-auto">
                                <form action="{{ url('/admin/search_category') }}" method="GET">
                                    @csrf
                                    <p for="" class="text-center form-label">Search Category
                                    </p>

                                    <div class="d-flex justify-content-center">

                                        <div class="input-group mb-3 w-75">

                                            <input type="text" name="query" class="form-control"
                                                placeholder="Product name" style="height: 41px "
                                                id="searchInput">

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
                                        <h6>All Categories</h6>
                                    </div>



                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>


                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Category Name
                                                        </th>



                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="categoryTable">
                                                    @forelse ($category as $data)


                                                            <td class="text-center align-middle">
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ $data->name }}
                                                                </p>
                                                            </td>


                                                            <td class="align-middle">
                                                                @include('admin.category.update_category')
                                                              </td>

                                                              <td class="align-middle">
                                                                <a href="javascript:void(0);"
                                                                   class="text-white font-weight-bold text-xs btn btn-danger btn-sm"
                                                                   data-toggle="tooltip" data-original-title="Delete category"
                                                                   onclick="confirmDelete({{ $data->id }})">
                                                                   Delete
                                                                   <i class="bi bi-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="16">
                                                                <p class="text-xs text-center text-danger font-weight-bold mb-0">
                                                                    No Data !
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            {{ $category->render('admin.pagination') }}
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
                    var searchInput = $(this).val();
                    $.ajax({
                        url: '{{ url('admin/search_category') }}',
                        type: 'GET',
                        data: { query: searchInput },
                        success: function(response) {
                            let productsHtml = '';
                            response.forEach(function(product) {
                                productsHtml += `
                                    <tr class="text-center">
                                        <td><p class="text-xs font-weight-bold mb-0">${product.name}</p></td>

                                        <td class="align-middle">
                                            <a type="button"   class="text-white btn btn-success btn-sm font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModal${product.id}">

    Edit
    <i class="bi bi-pencil"></i>

    </a>

    <div class="modal fade" id="exampleModal${product.id}" tabindex="-1"
    aria-labelledby="exampleModal${product.id}Label${product.id}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal${product.id}Label${product.id}">
                    Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/update_category/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">


                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">

                           Category Name
                        </label>
                        <input type="text" name="name" class="form-control" required value="{{ $data->name }}" placeholder="Name...">
                    </div>



                </div>


                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Update
                        <i class="bi bi-pencil"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
    </div>

                                        </td>

                                        <td class="align-middle">
                                            <a href="/admin/delete_category/${product.id}" class="text-white btn btn-danger btn-sm font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete category" onclick="return confirm('Are you sure you want to delete this category item?')">
                                                Delete
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>`;
                            });

                            if (response.length === 0) {
                                productsHtml += `
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-xs text-center text-danger font-weight-bold mb-0">No Data Found!</p>
                                        </td>
                                    </tr>`;
                            }

                            $('#categoryTable').html(productsHtml);
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
