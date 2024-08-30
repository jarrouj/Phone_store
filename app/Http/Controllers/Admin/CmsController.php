<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class CmsController extends Controller
{
    public function index()
    {

        //charts data
        $revenueData = Order::selectRaw('SUM(total_usd) as revenue, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();

        $orderData = Order::selectRaw('COUNT(*) as order_count, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('order_count', 'month')
            ->toArray();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        $revenues = [];
        $labels = [];
        $orderCounts = [];

        foreach ($months as $monthNum => $monthName) {
            $labels[] = $monthName;
            $revenues[] = $revenueData[$monthNum] ?? 0; // 0 if no revenue for the month
        }

        foreach ($months as $monthNum => $monthName) {
            $orderCounts[] = $orderData[$monthNum] ?? 0; // 0 if no orders for the month
        }

        //dashboard cards
        $number_of_users             = User::count();
        $number_of_orders_today      = Order::where('created_at' , Carbon::today())->count();
        $number_of_orders_incomplete = Order::where('confirm' , null)->count();
        $number_of_products          = Product::count();
        $user                        = User::all();


        return view('Admin.home', compact('user',
                                          'labels',
                                          'revenues' ,
                                          'orderCounts' ,
                                          'number_of_users' ,
                                          'number_of_products' ,
                                          'number_of_orders_today' ,
                                          'number_of_orders_incomplete'));
    }
}
