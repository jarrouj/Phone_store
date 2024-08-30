<!DOCTYPE html>
<html lang="en">
    <head>
   @include('Admin.components.css')
    </head>
    <body class="sb-nav-fixed">
       @include('Admin.components.navbar')
        <div id="layoutSidenav">
            @include('Admin.components.sidebar')
            <div id="layoutSidenav_content" style="overflow-x: hidden;">
                <main>
                    {{-- Search --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="d-block w-50 m-auto">
                                <form action="{{ url('/admin/search_user') }}" method="GET">
                                    @csrf
                                    <p for="" class="text-center form-label">Search Names, Emails or Phone Number</p>

                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="input-group mb-3 w-75">
                                            <input type="text" name="text" class="form-control" placeholder="example@gmail.com" style="height: 41px" id="searchInput">

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <div class="col-md-4">
                                <div class="ms-md-5 mb-md-5 me-md-5"> <!-- Added margin-end (right) for medium devices and up -->
                                    <label for="filter-by" class="form-label">Filter By:</label>
                                    <div class="input-group">
                                        <select class="form-select" id="filter-by" name="filter">
                                            <option value="">-- Select --</option>
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="week">Past Week</option>
                                            <option value="month">Past Month</option>
                                            <option value="year">This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>All Orders</h6>
                                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Confirmation
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Order ID
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            User
                                        </th>


                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Address
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Email
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Phone
                                        </th>


                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Registered
                                        </th>


                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Paid
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Method
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Delivered
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Promo
                                        </th>



                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Total (LBP)
                                        </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            Total (USD)
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>

                                    </tr>
                                </thead>
                                <tbody id="SearchResults">
                                    @forelse ($order as $data)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex">
                                                    @if ($data->confirm === 0)
                                                        <form
                                                            action="{{ route('update-status', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" name="conf" value="0"
                                                                class="btn btn-danger btn-sm" disabled>
                                                                <i class="bi bi-x" style="font-size: 1rem;"></i>
                                                            </button>
                                                        </form>
                                                    @elseif ($data->confirm === 1)
                                                        <form
                                                            action="{{ route('update-status', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" name="conf" value="1"
                                                                class="btn btn-success btn-sm me-1" disabled>
                                                                <i class="bi bi-check" style="font-size: 1rem;"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form
                                                            action="{{ route('update-status', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" name="conf" value="1"
                                                                class="btn btn-success btn-sm me-1">
                                                                <i class="bi bi-check" style="font-size: 1rem;"></i>
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('update-status', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" name="conf" value="0"
                                                                class="btn btn-danger btn-sm">
                                                                <i class="bi bi-x" style="font-size: 1rem;"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>


                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    #{{ $data->order_number }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    @if ($data->user_id)
                                                        @foreach ($users as $user)
                                                            @if ($user->id == $data->user_id)
                                                                {{ $user->name }}
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $data->name }}
                                                        </p>
                                                    @endif
                                                </p>
                                            </td>

                                            <td>
                                                @if ($data->address !== null)
                                                    <i class="fa fa-check text-success"></i>
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                @endif
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $data->email }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $data->phone }}
                                                </p>
                                            </td>

                                            <td>
                                                @if ($data->registered == 1)
                                                    <span
                                                        class="badge badge-sm bg-success ">Registered</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger ">Not
                                                        Registered</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->paid == 1)
                                                    <span class="badge badge-sm bg-success ">Paid</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger ">Not Paid</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->method == 1)
                                                    <span class="badge badge-sm bg-success">Cash</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger ">Stripe/Paypal</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->delivered == 1)
                                                    <span
                                                        class="badge badge-sm bg-success ">Delivered</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger ">Not
                                                        Delivered</span>
                                                @endif
                                            </td>



                                            <td>
                                                @if ($data->promo != null)
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $data->promo }}
                                                    </p>
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                @endif
                                            </td>



                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $data->total_lbp }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    ${{ $data->total_usd }}
                                                </p>
                                            </td>

                                            <td class="align-middle">
                                                <a href="{{ url('admin/view_order', $data->id) }}"
                                                    class="text-white font-weight-bold text-xs btn btn-primary btn-sm"
                                                    data-toggle="tooltip">
                                                    View
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>



                                            <td class="align-middle">
                                                <a href="{{ url('admin/update_order/' . $data->id) }}"
                                                    class="text-white font-weight-bold text-xs btn btn-success btn-sm"
                                                    data-toggle="tooltip">
                                                    Update
                                                    <i class="bi bi-pen"></i>
                                                </a>
                                            </td>

                                            <td class="align-middle">
                                                <a href="{{ url('admin/delete_order', $data->id) }}"
                                                    class="text-white font-weight-bold text-xs btn btn-danger btn-sm"
                                                    data-toggle="tooltip" data-original-title="Edit order"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">
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
                            {{ $order->render('admin.pagination') }}
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
                // Search input event
                $('#searchInput').on('keyup', function() {
                    var searchInput = $('#searchInput').val();
                    searchOrders(searchInput);
                });

                // Filter dropdown change event
                $('#filter-by').on('change', function() {
                    var filterValue = $(this).val();
                    var searchInput = $('#searchInput').val(); // Get current search input value
                    searchOrders(searchInput, filterValue);
                });

                // Function to search and filter orders
                function searchOrders(query = '', filter = '') {
                    $.ajax({
                        url: '{{ url('admin/search_order') }}',
                        type: 'GET',
                        data: {
                            query: query,
                            filter: filter,
                        },
                        success: function(response) {
                            var ordersHtml = '';
                            response.forEach(function(order) {
                                var confirmBtnsHtml = '';
                                if (order.confirm === 0) {
                                    confirmBtnsHtml = `
                                        <form action="/update-status/${order.id}" method="POST">
                                            @csrf
                                            <button type="submit" name="conf" value="0" class="btn btn-danger btn-sm" disabled>
                                                <i class="bi bi-x" style="font-size: 1rem;"></i>
                                            </button>
                                        </form>`;
                                } else if (order.confirm === 1) {
                                    confirmBtnsHtml = `
                                        <form action="/update-status/${order.id}" method="POST">
                                            @csrf
                                            <button type="submit" name="conf" value="1" class="btn btn-success btn-sm me-1" disabled>
                                                <i class="bi bi-check" style="font-size: 1rem;"></i>
                                            </button>
                                        </form>`;
                                } else {
                                    confirmBtnsHtml = `
                                        <form action="/update-status/${order.id}" method="POST">
                                            @csrf
                                            <button type="submit" name="conf" value="1" class="btn btn-success btn-sm me-1">
                                                <i class="bi bi-check" style="font-size: 1rem;"></i>
                                            </button>
                                        </form>
                                        <form action="/update-status/${order.id}" method="POST">
                                            @csrf
                                            <button type="submit" name="conf" value="0" class="btn btn-danger btn-sm">
                                                <i class="bi bi-x" style="font-size: 1rem;"></i>
                                            </button>
                                        </form>`;
                                }

                                var addressIcon = order.address !== null ?
                                    '<i class="fa fa-check text-success"></i>' :
                                    '<i class="fa fa-times text-danger"></i>';
                                var registeredBadge = order.registered == 1 ?
                                    '<span class="badge badge-sm bg-success">Registered</span>' :
                                    '<span class="badge badge-sm bg-danger">Not Registered</span>';
                                var paidBadge = order.paid == 1 ?
                                    '<span class="badge badge-sm bg-success">Paid</span>' :
                                    '<span class="badge badge-sm bg-danger">Not Paid</span>';
                                var methodBadge = order.method == 1 ?
                                    '<span class="badge badge-sm bg-success">Cash</span>' :
                                    '<span class="badge badge-sm bg-danger">Points</span>';
                                var deliveredBadge = order.delivered == 1 ?
                                    '<span class="badge badge-sm bg-success">Delivered</span>' :
                                    '<span class="badge badge-sm bg-danger">Not Delivered</span>';

                                ordersHtml += `
                                    <tr class="text-center">
                                        <td>
                                            <div class="d-flex">
                                                ${confirmBtnsHtml}
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                #${order.order_number}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                ${order.username}
                                            </p>
                                        </td>
                                        <td>
                                            ${addressIcon}
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                ${order.email}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                ${order.phone}
                                            </p>
                                        </td>
                                        <td>
                                            ${registeredBadge}
                                        </td>
                                        <td>
                                            ${paidBadge}
                                        </td>
                                        <td>
                                            ${methodBadge}
                                        </td>
                                        <td>
                                            ${deliveredBadge}
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                              <i class="fa fa-times text-danger"></i> fix
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                ${order.total_usd}
                                            </p>
                                        </td>
                                       <td class="align-middle">
                                            <a href="/admin/view_order/${order.id}" class="text-white btn btn-primary btn-sm font-weight-bold text-xs" data-toggle="tooltip">
                                                View <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/update_order/${order.id}" class="text-white btn btn-success btn-sm font-weight-bold text-xs" data-toggle="tooltip">
                                                Update <i class="bi bi-pen"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/delete_order/${order.id}" class="text-white btn btn-danger btn-sm font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit order" onclick="return confirm('Are you sure you want to delete this order?')">
                                                Delete <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('#SearchResults').html(ordersHtml);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        </script>


      @include('Admin.components.js')
    </body>
</html>
