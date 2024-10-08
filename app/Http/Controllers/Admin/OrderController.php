<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function show_order()
    {
        $order = Order::latest()->paginate(10);
        $users = User::all();

        return view('Admin.order.show_order', compact('order', 'users'));
    }

    public function update_order($id)
    {
        $order = Order::find($id);
        $user  = User::all();

        return view('Admin.order.update_order', compact('order', 'user'));
    }

    public function update_order_confirm($id, Request $request)
    {
        $order = Order::find($id);

        $order->paid       = $request->paid;
        $order->method     = $request->method;
        $order->delivered  = $request->delivered;
        $order->registered = $request->registered;

        $order->save();

        return redirect('/admin/show_order')->with('message', 'Order Updated Successfully');
    }

    public function view_order($id)
    {
        $order = Order::find($id);


        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        $productsWithoutQty = Product::whereIn('id', $orderProducts->pluck('product_id'))->get();

        $products = $productsWithoutQty->map(function ($product) use ($orderProducts) {
            $orderProduct = $orderProducts->firstWhere('product_id', $product->id);
            return [
                'product' => $product,
                'qty' => $orderProduct ? $orderProduct->qty : 0, // Get the qty from OrderProduct
            ];
        });

        return view('admin.order.view_order', compact('order', 'orderProducts', 'products'));
    }

    public function delete_order($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->back()->with('message', 'Order Deleted');
    }


    public function update_status(Request $request, $id)
    {
        $order = Order::find($id);
        $orderProducts = OrderProduct::find($order->id);

        if ($order->confirm === null) {

            $order->confirm = $request->conf;
            $order->save();

            $message = $request->conf == 1 ? 'Order Confirmed' : 'Order Canceled';

            // if ($request->conf == 1) {

            //     $transaction = new Transaction();

            //     $transaction->user_id = $order->user_id;
            //     $transaction->f_name  = $order->f_name;
            //     $transaction->l_name  = $order->l_name;
            //     $transaction->email   = $order->email;
            //     $transaction->phone   = $order->phone;
            //     $transaction->addsub  = $order->method; //if method= 1 then cash =>we add the pts else the client paid with points then we remove points
            //     $transaction->points += $order->total_pts;


            //     $transaction->save();
            // }

            Mail::to($order->email)->send(new OrderConfirmation($order, $orderProducts));

            return redirect()->back()->with('message', $message);
        } else {
            return response()->json(['fail' => false, 'message' => 'Confirmation cannot be updated']);
        }
    }

    public function search_order(Request $request)
{
    $query = $request->get('query');
    $filter = $request->input('filter');

    // Start with the query builder
    $orderQuery = Order::where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('id', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('phone', 'like', "%$query%")
            ->orWhere('username', 'like', "%$query%")
            ->orWhere('order_number', 'like', "%$query%");
    });

    // Apply filter based on the selected time range
    if ($filter) {
        switch ($filter) {
            case 'today':
                $orderQuery->whereDate('created_at', Carbon::today());
                break;
            case 'yesterday':
                $orderQuery->whereDate('created_at', Carbon::yesterday());
                break;
            case 'week':
                $orderQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $orderQuery->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'year':
                $orderQuery->whereYear('created_at', Carbon::now()->year);
                break;
        }
    }

    // Execute the query
    $orders = $orderQuery->get();

    return response()->json($orders);
}

//     public function filter_order(Request $request)
// {
//     $query = $request->input('query');
//     $filter = $request->input('filter');

//     $ordersQuery = Order::query();

//     if ($query) {
//         // Apply search query if provided
//         $ordersQuery->where(function ($query) use ($query) {
//             $query->where('order_number', 'LIKE', "%$query%")
//                   ->orWhere('username', 'LIKE', "%$query%")
//                   ->orWhere('email', 'LIKE', "%$query%")
//                   ->orWhere('phone', 'LIKE', "%$query%");
//         });
//     }

//     if ($filter) {
//         // Apply filter based on the selected time range
//         switch ($filter) {
//             case 'today':
//                 $ordersQuery->whereDate('created_at', Carbon::today());
//                 break;
//             case 'yesterday':
//                 $ordersQuery->whereDate('created_at', Carbon::yesterday());
//                 break;
//             case 'week':
//                 $ordersQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
//                 break;
//             case 'month':
//                 $ordersQuery->whereMonth('created_at', Carbon::now()->month);
//                 break;
//             case 'year':
//                 $ordersQuery->whereYear('created_at', Carbon::now()->year);
//                 break;
//         }
//     }

//     $orders = $ordersQuery->get();

//     return response()->json($orders);
// }
}
