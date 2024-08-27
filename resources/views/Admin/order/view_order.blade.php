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

                    <a href="{{ url('/admin/show_order') }}" class="btn btn-dark mt-3 ms-3">
                        <i class="bi bi-arrow-left"></i>
                        back
                    </a>

                    <div class="card-body px-auto pt-0 pb-2">

                        <div class="mt-4 row">
                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->name }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->email }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->phone }}</p>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="mt-4 row justify-content-center">
                        <div class="col-4"></div>
                        <div class="col-4 col-md-2">
                            <div class="mb-3 text-center">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <p class="text-xs font-weight-bold mb-0">{{ $order->address }}</p>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>


                    <div class="card-body px-auto pt-0 pb-2">

                        <div class="mt-4 row">
                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Paid</label>
                                    <p class=" font-weight-bold mb-0">
                                        @if($order->paid == 1)
                                        <span class="badge badge-sm bg-success ">Paid</span>
                                        @else
                                        <span class="badge badge-sm bg-danger ">Not Paid</span>
                                        @endif
                                     </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Method</label>
                                    <p class=" font-weight-bold mb-0">
                                        @if($order->method == 1)
                                        <span class="badge badge-sm bg-success ">Cash</span>
                                        @else
                                        <span class="badge badge-sm bg-success ">Points</span>
                                        @endif
                                     </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Delivered</label>
                                    <p class=" font-weight-bold mb-0">
                                        @if($order->delivered == 1)
                                        <span class="badge badge-sm bg-success ">Delivered</span>
                                        @else
                                        <span class="badge badge-sm bg-danger ">Not Delivered</span>
                                        @endif
                                     </p>
                                </div>
                            </div>



                        </div>


                    </div>



                    <div class="card-body px-auto pt-0 pb-2">

                        <div class="mt-4 row">
                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Registered</label>
                                    <p class=" font-weight-bold mb-0">
                                        @if($order->registered == 1)
                                        <span class="badge badge-sm bg-success ">Registered</span>
                                        @else
                                        <span class="badge badge-sm bg-danger ">Not Registered</span>
                                        @endif
                                     </p>
                                    </div>
                            </div>

                            <div class="col-md-4">
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Promo</label>
                                    <p class=" font-weight-bold mb-0">
                                        @if($order->promo != null)
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->promo }}</p>
                                        @else
                                        <i class="fa fa-times text-danger"></i>
                                        @endif
                                     </p>
                                    </div>
                            </div>



                        </div>


                    </div>



                    <div class="card-body px-auto pt-0 pb-2">

                        <div class="mt-4 row">
                            <div class="col-md-6">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Total (LBP)</label>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->total_lbp }} </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 text-center">
                                    <label for="exampleFormControlInput1" class="form-label">Total (USD)</label>
                                    <p class="text-xs font-weight-bold mb-0">${{ $order->total_usd }} </p>
                                </div>
                            </div>





                        </div>


                    </div>


                        {{-- Images --}}
                        <div class="mt-4 row">

                            <div class="col-12">
                                <label for="exampleInputPassword1" class="form-label ">
                                    <h6 class="ms-3">Products</h6>
                                </label>

                                <div class="mb-3">
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr class="text-center">

                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                                            Image
                                                        </th>

                                                        <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                                        Product Name
                                                    </th>



                                                    <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                                    Quantity
                                                    </th>

                                                    <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                                    Price
                                                    </th>



                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($products as $data)
                                                        <tr class="text-center">

                                                            <td>
                                                             <img src="/product/{{ $data['product']->img }}" width="100px" />
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $data['product']->name }}
                                                                </p>
                                                            </td>

                                                            @foreach($products as $item)
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $item['qty'] }}
                                                                </p>
                                                            </td>
                                                        @endforeach

                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    ${{ $data['product']->price }}
                                                                </p>
                                                            </td>




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
                                            {{-- {{ $productImage->render('admin.pagination') }} --}}
                                        </div>
                                    </div>
                                </div>
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
