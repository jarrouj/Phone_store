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

                                @include('admin.landing.add_landing')

                            </div>
                        </div>
                    </div>

                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>All landings</h6>
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
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Title
                                                    </th>

                                                    <th class="text-secondary opacity-7"></th>
                                                    <th class="text-secondary opacity-7"></th>
                                                    <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @forelse ($landing as $data)
                                                        <tr>
                                                            <td >
                                                                <img src="/landing/{{ $data->img }}" async class="d-block m-auto" width="50px" alt="">

                                                        </td>


                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $data->title }}
                                                            </p>
                                                        </td>

                                                        <td class="text-secondary opacity-7"></td>
                                                        <td class="text-secondary opacity-7"></td>
                                                        <td class="text-secondary opacity-7"></td>

                                                            <td class="align-middle">
                                                                @include('admin.landing.update_landing')
                                                              </td>

                                                            <td class="align-middle">
                                                                <a href="{{ url('admin/delete_landing', $data->id) }}"
                                                                    class="text-white font-weight-bold text-xs btn btn-danger btn-sm"
                                                                    data-toggle="tooltip" data-original-title="Edit landing"
                                                                    onclick="return confirm('Are you sure you want to delete this landing?')">
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
                                            {{ $landing->render('admin.pagination') }}
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
