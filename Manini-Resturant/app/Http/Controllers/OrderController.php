<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cart()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        return view('order.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $item = MenuItem::findOrFail($request->menu_item_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$item->id] = [
                'id'       => $item->id,
                'name'     => $item->name,
                'price'    => $item->price,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', $item->name . ' added to your order.');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->menu_item_id;

        if ($request->quantity <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);
        return back();
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->menu_item_id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('menu')->with('error', 'Your order is empty.');
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $tax      = $subtotal * 0.08;
        $total    = $subtotal + $tax;
        return view('order.checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'table_number'  => 'required|integer|min:1',
            'customer_name' => 'nullable|string|max:255',
            'notes'         => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('menu')->with('error', 'Your order is empty.');

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $tax      = $subtotal * 0.08;
        $total    = $subtotal + $tax;

        $order = Order::create([
            'table_number'  => $request->table_number,
            'customer_name' => $request->customer_name,
            'notes'         => $request->notes,
            'subtotal'      => $subtotal,
            'tax'           => $tax,
            'total'         => $total,
            'status'        => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_item_id' => $item['id'],
                'item_name'    => $item['name'],
                'item_price'   => $item['price'],
                'quantity'     => $item['quantity'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('payment.checkout', $order);
    }

    public function confirmation(Order $order)
    {
        $order->load('items', 'payment');
        return view('order.confirmation', compact('order'));
    }
}
