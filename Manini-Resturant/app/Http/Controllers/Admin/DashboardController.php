<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\MenuItem;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'       => Order::count(),
            'pending_orders'     => Order::where('status', 'pending')->count(),
            'total_reservations' => Reservation::count(),
            'today_reservations' => Reservation::whereDate('date', today())->count(),
            'total_revenue'      => Payment::where('payment_status', 'paid')->sum('amount'),
            'pending_payments'   => Payment::where('payment_status', 'pending')->count(),
            'total_menu_items'   => MenuItem::count(),
        ];

        $recentOrders   = Order::with('payment')->latest()->take(5)->get();
        $recentPayments = Payment::with('order')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentPayments'));
    }
}