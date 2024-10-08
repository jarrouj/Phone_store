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

                    <a href="{{ url('/admin/show_user') }}" class="btn btn-dark mt-3 ms-3">
                        <i class="bi bi-arrow-left"></i>
                        back
                    </a>

                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0 ">

                                        <h6>Edit User {{ $user->name }}</h6>
                                    </div>
                                    <div class="card-body px-auto pt-0 pb-2">
                                        <form action="{{ url('/admin/update_user_confirmation', $user->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mt-4 row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Full Name</label>
                                                        <input type="text" name="name" value="{{ $user->name }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                        <input type="email" name="email" value="{{ $user->email }}"
                                                            class="form-control" aria-describedby="emailHelp" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Usertype</label>
                                                        <select class="form-select" name="usertype">
                                                            <option value="0" {{ $user->usertype == '0' ? 'selected' : '' }}>
                                                                Customer
                                                            </option>
                                                            <option value="1" {{ $user->usertype == '1' ? 'selected' : '' }}>
                                                                Admin
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn mt-3 btn-dark">Submit</button>
                                            </div>
                                        </form>
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
