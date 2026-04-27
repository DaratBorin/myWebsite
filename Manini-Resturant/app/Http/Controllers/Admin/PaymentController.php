<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments     = Payment::with('order')->latest()->paginate(20);
        $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');
        $pendingCount = Payment::where('payment_status', 'pending')->count();
        $paidCount    = Payment::where('payment_status', 'paid')->count();
        return view('admin.payments.index', compact('payments', 'totalRevenue', 'pendingCount', 'paidCount'));
    }

    public function markPaid(Payment $payment)
    {
        $payment->update(['payment_status' => 'paid', 'paid_at' => now()]);
        $payment->order->update(['status' => 'completed']);
        return back()->with('success', 'Payment marked as paid.');
    }
}
