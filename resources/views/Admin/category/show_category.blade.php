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
                                    <p for="" class="text-center form-label">Search Names, Emails or Phone
                                        Number
                                    </p>

                                    <div class="d-flex justify-content-center">

                                        <div class="input-group mb-3 w-75">

                                            <input type="text" name="query" class="form-control"
                                                placeholder="example@gmail.com" style="height: 41px "
                                                id="searchInput">

                                            <button class="btn btn-dark" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>

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
                                                <tbody id="tbody">
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
      @include('Admin.components.js')
    </body>
</html>
