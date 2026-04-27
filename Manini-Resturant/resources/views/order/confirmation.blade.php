@extends('layouts.app')
@section('title', 'Order Confirmed')

@push('styles')
<style>
    .confirmation-page { max-width: 700px; margin: 0 auto; padding: 6rem 2rem 4rem; }

    .confirm-header { text-align: center; margin-bottom: 3rem; }
    .confirm-icon { font-size: 4rem; margin-bottom: 1rem; display: block; }
    .confirm-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 400; color: var(--charcoal); margin-bottom: 0.5rem; }
    .confirm-sub { color: var(--warm-gray); font-size: 0.85rem; }

    .receipt {
        background: white;
        border: 1px solid var(--border);
        margin-bottom: 1.5rem;
    }

    .receipt-header {
        background: var(--charcoal);
        padding: 2rem;
        text-align: center;
        color: white;
    }

    .receipt-logo {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--terra-light);
        margin-bottom: 0.25rem;
    }

    .receipt-restaurant-info {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.5);
        letter-spacing: 0.1em;
        line-height: 1.8;
    }

    .receipt-body { padding: 2rem; }

    .receipt-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed var(--parchment);
    }

    .receipt-meta-item .label {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--warm-gray);
        margin-bottom: 0.25rem;
    }

    .receipt-meta-item .value {
        font-size: 0.88rem;
        color: var(--charcoal);
        font-weight: 500;
    }

    .receipt-items { margin-bottom: 1.5rem; }

    .receipt-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 0;
        border-bottom: 1px solid #F8F4ED;
        font-size: 0.85rem;
    }

    .receipt-item:last-child { border: none; }

    .receipt-item .item-name { color: var(--charcoal); }
    .receipt-item .item-qty { color: var(--warm-gray); font-size: 0.78rem; margin-right: 0.5rem; }
    .receipt-item .item-price { color: var(--charcoal); font-weight: 500; }

    .receipt-totals {
        border-top: 1px dashed var(--parchment);
        padding-top: 1rem;
    }

    .receipt-total-row {
        display: flex;
        justify-content: space-between;
        padding: 0.35rem 0;
        font-size: 0.85rem;
        color: var(--warm-gray);
    }

    .receipt-total-row.grand {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: var(--charcoal);
        border-top: 2px solid var(--terracotta);
        margin-top: 0.5rem;
        padding-top: 0.75rem;
    }

    .receipt-total-row.grand .amt { color: var(--terracotta); }

    .receipt-payment {
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f0faf4;
        border: 1px solid #c3e6cb;
        border-radius: 2px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.82rem;
        color: #155724;
    }

    .receipt-footer {
        text-align: center;
        padding: 1.5rem 2rem;
        border-top: 1px dashed var(--parchment);
        font-size: 0.72rem;
        color: var(--warm-gray);
        line-height: 1.8;
    }

    .receipt-barcode {
        text-align: center;
        margin: 1rem 0;
        letter-spacing: 0.3em;
        font-size: 0.65rem;
        color: var(--warm-gray);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .action-buttons a, .action-buttons button {
        flex: 1;
        text-align: center;
        padding: 0.9rem;
    }

    @media print {
        .no-print { display: none !important; }
        .confirmation-page { padding: 0; }
        .receipt { border: none; box-shadow: none; }
        body { background: white; }
        nav, footer { display: none !important; }
    }
</style>
@endpush

@section('content')
<div class="confirmation-page">

    <div class="confirm-header no-print">
        <span class="confirm-icon">✅</span>
        <h1 class="confirm-title">Order Confirmed!</h1>
        <p class="confirm-sub">Thank you for your order. Please keep this receipt for your records.</p>
    </div>

    {{-- RECEIPT --}}
    <div class="receipt" id="receipt">

        <div class="receipt-header">
            <div class="receipt-logo">Manini</div>
            <div class="receipt-restaurant-info">
                Fine Italian Dining · Est. 2009<br>
                123 Gourmet Avenue, New York, NY 10012<br>
                +1 (212) 555-1234 · info@manini.com
            </div>
        </div>

        <div class="receipt-body">

            <div class="receipt-meta">
                <div class="receipt-meta-item">
                    <div class="label">Order Number</div>
                    <div class="value">{{ $order->order_number }}</div>
                </div>
                <div class="receipt-meta-item">
                    <div class="label">Table</div>
                    <div class="value">Table {{ $order->table_number }}</div>
                </div>
                <div class="receipt-meta-item">
                    <div class="label">Date & Time</div>
                    <div class="value">{{ $order->created_at->format('M d, Y · g:i A') }}</div>
                </div>
                <div class="receipt-meta-item">
                    <div class="label">Status</div>
                    <div class="value" style="color:var(--terracotta);text-transform:capitalize">{{ ucfirst($order->status) }}</div>
                </div>
                @if($order->customer_name)
                <div class="receipt-meta-item">
                    <div class="label">Customer</div>
                    <div class="value">{{ $order->customer_name }}</div>
                </div>
                @endif
                @if($order->payment)
                <div class="receipt-meta-item">
                    <div class="label">Payment Method</div>
                    <div class="value" style="text-transform:uppercase">{{ $order->payment->payment_method }}</div>
                </div>
                @endif
            </div>

            {{-- ITEMS --}}
            <div class="receipt-items">
                @foreach($order->items as $item)
                <div class="receipt-item">
                    <span>
                        <span class="item-qty">{{ $item->quantity }}×</span>
                        <span class="item-name">{{ $item->item_name }}</span>
                    </span>
                    <span class="item-price">${{ number_format($item->subtotal, 2) }}</span>
                </div>
                @endforeach
            </div>

            {{-- TOTALS --}}
            <div class="receipt-totals">
                <div class="receipt-total-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="receipt-total-row">
                    <span>Tax (8%)</span>
                    <span>${{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="receipt-total-row grand">
                    <span>Total</span>
                    <span class="amt">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            {{-- PAYMENT STATUS --}}
            @if($order->payment)
            <div class="receipt-payment">
                @if($order->payment->payment_status === 'paid')
                    ✅ <span><strong>Paid</strong> via {{ strtoupper($order->payment->payment_method) }}
                    @if($order->payment->paid_at)
                        · {{ $order->payment->paid_at->format('M d, Y g:i A') }}
                    @endif
                    </span>
                @else
                    ⏳ <span><strong>Payment Pending</strong> — Please pay at the table</span>
                @endif
            </div>
            @endif

            @if($order->notes)
            <div style="margin-top:1rem;padding:0.75rem;background:#fffbf0;border:1px solid #f0e6c0;font-size:0.82rem;color:var(--warm-gray)">
                <strong>Notes:</strong> {{ $order->notes }}
            </div>
            @endif

        </div>

        <div class="receipt-barcode">
            {{ $order->order_number }}
        </div>

        <div class="receipt-footer">
            Thank you for dining with us at Manini.<br>
            We hope to see you again soon!<br>
            <strong style="color:var(--terracotta)">Buon Appetito!</strong>
        </div>

    </div>

    {{-- ACTION BUTTONS --}}
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn-outline-terra">
            🖨️ Print Receipt
        </button>
        <a href="{{ route('menu') }}" class="btn-terra">
            Order Again
        </a>
    </div>

</div>
@endsection