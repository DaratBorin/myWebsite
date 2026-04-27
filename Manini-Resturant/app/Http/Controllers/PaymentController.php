<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function checkout(Order $order)
    {
        if ($order->payment && $order->payment->payment_status === 'paid') {
            return redirect()->route('order.confirmation', $order);
        }
        $order->load('items');
        return view('payment.checkout', compact('order'));
    }

    public function processStripe(Request $request, Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $intent = PaymentIntent::create([
            'amount'   => (int)($order->total * 100),
            'currency' => 'usd',
            'metadata' => ['order_id' => $order->id],
        ]);
        return response()->json(['client_secret' => $intent->client_secret]);
    }

    public function confirmStripe(Request $request, Order $order)
    {
        Payment::create([
            'order_id'              => $order->id,
            'payment_method'        => 'stripe',
            'payment_status'        => 'paid',
            'amount'                => $order->total,
            'stripe_payment_intent' => $request->payment_intent,
            'paid_at'               => now(),
        ]);
        $order->update(['status' => 'confirmed']);
        return redirect()->route('order.confirmation', $order)->with('success', 'Payment confirmed!');
    }

    public function confirmQR(Order $order)
    {
        Payment::create([
            'order_id'       => $order->id,
            'payment_method' => 'khqr',
            'payment_status' => 'paid',
            'amount'         => $order->total,
            'paid_at'        => now(),
        ]);
        $order->update(['status' => 'confirmed']);
        return redirect()->route('order.confirmation', $order)->with('success', 'Payment received via KHQR!');
    }

    public function processCash(Order $order)
    {
        Payment::create([
            'order_id'       => $order->id,
            'payment_method' => 'cash',
            'payment_status' => 'pending',
            'amount'         => $order->total,
        ]);
        $order->update(['status' => 'confirmed']);
        return redirect()->route('order.confirmation', $order)->with('success', 'Order placed! Pay at table.');
    }
}
