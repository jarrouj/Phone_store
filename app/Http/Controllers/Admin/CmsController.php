<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function index()
    {
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



        return view('Admin.home', compact('labels', 'revenues' , 'orderCounts'));
    }
}
