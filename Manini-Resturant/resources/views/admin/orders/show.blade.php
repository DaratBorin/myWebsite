@extends('admin.layout')
@section('title', 'Order #' . $order->order_number)
@section('breadcrumb', 'Orders › Detail')

@section('content')

<div class="page-head">
    <div>
        <h1>Order <code style="font-size:1rem;background:#f0ebe0;padding:0.2rem 0.6rem;border-radius:3px">{{ $order->order_number }}</code></h1>
        <div class="subtitle">Table {{ $order->table_number }} · {{ $order->created_at->format('M d, Y g:i A') }}</div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="action-btn btn-primary">← Back</a>
</div>

<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:1.5rem;align-items:start">

    <div class="card">
        <div class="card-header"><h3>Items Ordered</h3></div>
        <div class="card-body">
            @foreach($order->items as $item)
            <div style="display:flex;justify-content:space-between;align-items:flex-start;padding:0.85rem 0;border-bottom:1px solid var(--border)">
                <div>
                    <div style="font-weight:500;font-size:0.9rem">{{ $item->quantity }}× {{ $item->item_name }}</div>
                    <div style="font-size:0.72rem;color:var(--muted)">${{ number_format($item->item_price,2) }} each</div>
                </div>
                <div style="color:#C9A84C;font-size:1rem;font-weight:500">${{ number_format($item->subtotal,2) }}</div>
            </div>
            @endforeach
            <div style="margin-top:1rem">
                <div style="display:flex;justify-content:space-between;padding:0.4rem 0;font-size:0.85rem;color:var(--muted)"><span>Subtotal</span><span>${{ number_format($order->subtotal,2) }}</span></div>
                <div style="display:flex;justify-content:space-between;padding:0.4rem 0;font-size:0.85rem;color:var(--muted)"><span>Tax (8%)</span><span>${{ number_format($order->tax,2) }}</span></div>
                <div style="display:flex;justify-content:space-between;padding:0.75rem 0;font-size:1.2rem;font-weight:600;border-top:2px solid #C9A84C;margin-top:0.5rem">
                    <span>Total</span><span style="color:#C9A84C">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:1.25rem">

        <div class="card">
            <div class="card-header"><h3>Details</h3></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:0.6rem">
                <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Customer</span><span>{{ $order->customer_name ?? '—' }}</span></div>
                <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Table</span><span>Table {{ $order->table_number }}</span></div>
                <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Placed</span><span>{{ $order->created_at->format('g:i A') }}</span></div>
                @if($order->notes)
                <div style="font-size:0.82rem;padding-top:0.5rem;border-top:1px solid var(--border)">
                    <span style="color:var(--muted)">Notes:</span> {{ $order->notes }}
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Update Status</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select" style="margin-bottom:1rem">
                        @foreach(['pending','confirmed','preparing','ready','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="action-btn btn-gold" style="width:100%;justify-content:center">Update</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Payment</h3></div>
            <div class="card-body">
                @if($order->payment)
                <div style="display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1rem">
                    <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Method</span><span>{{ ucfirst($order->payment->payment_method) }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Amount</span><span>{{ $order->payment->formatted_amount }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:0.85rem"><span style="color:var(--muted)">Status</span>
                        <span style="color:{{ $order->payment->payment_status==='paid'?'#27ae60':'#f39c12' }};font-weight:600">{{ ucfirst($order->payment->payment_status) }}</span>
                    </div>
                </div>
                @if($order->payment->payment_status !== 'paid')
                <form action="{{ route('admin.payments.markPaid', $order->payment) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="action-btn btn-gold" style="width:100%;justify-content:center">Mark as Paid</button>
                </form>
                @else
                <div style="text-align:center;color:#27ae60;font-size:0.82rem">✓ Paid {{ $order->payment->paid_at?->format('M d, g:i A') }}</div>
                @endif
                @else
                <p style="color:var(--muted);font-size:0.82rem;text-align:center">No payment yet</p>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
