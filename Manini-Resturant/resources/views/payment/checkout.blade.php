@extends('layouts.app')
@section('title', 'Payment')

@push('styles')
<style>
    .payment-page { max-width: 700px; margin: 0 auto; padding: 6rem 2rem 4rem; }
    .payment-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 400; color: var(--charcoal); margin-bottom: 0.5rem; }
    .payment-sub { color: var(--warm-gray); font-size: 0.85rem; margin-bottom: 3rem; }

    .card-box { background: white; border: 1px solid var(--border); padding: 2rem; margin-bottom: 1.5rem; }
    .card-box h3 { font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 500; color: var(--charcoal); margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }

    .summary-row { display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.85rem; border-bottom: 1px solid var(--border); }
    .summary-row .lbl { color: var(--warm-gray); }
    .summary-total { display: flex; justify-content: space-between; font-family: 'Playfair Display', serif; font-size: 1.3rem; padding-top: 1rem; border-top: 2px solid var(--terracotta); margin-top: 0.5rem; }
    .summary-total .amt { color: var(--terracotta); }

    .payment-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; }
    .method-card { background: white; border: 2px solid var(--border); padding: 1.75rem; text-align: center; cursor: pointer; transition: all 0.3s; border-radius: 2px; }
    .method-card:hover, .method-card.selected { border-color: var(--terracotta); background: #fdf7f3; }
    .method-card .ico { font-size: 2.5rem; margin-bottom: 0.75rem; display: block; }
    .method-card h4 { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 500; color: var(--charcoal); margin-bottom: 0.35rem; }
    .method-card p { font-size: 0.75rem; color: var(--warm-gray); }

    #qr-form { display: none; }
    #cash-form { display: none; }

    .qr-box { text-align: center; padding: 1rem 0; }
    .qr-box img { width: 240px; height: 240px; margin: 0 auto 1.5rem; display: block; border: 6px solid #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .qr-amount { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--terracotta); margin-bottom: 0.25rem; }
    .qr-ref { font-size: 0.75rem; color: var(--warm-gray); margin-bottom: 1.5rem; letter-spacing: 0.1em; }

    .qr-steps { display: flex; justify-content: center; gap: 2rem; margin-bottom: 2rem; flex-wrap: wrap; }
    .qr-step { text-align: center; max-width: 110px; }
    .qr-step .num { width: 30px; height: 30px; background: var(--terracotta); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; margin: 0 auto 0.5rem; }
    .qr-step p { font-size: 0.72rem; color: var(--warm-gray); line-height: 1.5; }

    .khqr-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: #E8003D; color: white; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; margin-bottom: 1.5rem; }
</style>
@endpush

@section('content')
<div class="payment-page">
    <h1 class="payment-title">Payment</h1>
    <p class="payment-sub">Order {{ $order->order_number }} · Table {{ $order->table_number }}</p>

    <div class="card-box">
        <h3>Order Summary</h3>
        @foreach($order->items as $item)
        <div class="summary-row">
            <span><span style="color:var(--warm-gray)">{{ $item->quantity }}×</span> {{ $item->item_name }}</span>
            <span>${{ number_format($item->subtotal, 2) }}</span>
        </div>
        @endforeach
        <div class="summary-row"><span class="lbl">Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
        <div class="summary-row"><span class="lbl">Tax (8%)</span><span>${{ number_format($order->tax, 2) }}</span></div>
        <div class="summary-total"><span>Total</span><span class="amt">${{ number_format($order->total, 2) }}</span></div>
    </div>

    <h3 style="font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:500;color:var(--charcoal);margin-bottom:1rem">Choose Payment Method</h3>

    <div class="payment-methods">
        <div class="method-card" onclick="selectMethod('qr')" id="m-qr">
            <span class="ico">📱</span>
            <h4>KHQR Pay</h4>
            <p>Scan with Bakong or any banking app</p>
        </div>
        <div class="method-card" onclick="selectMethod('cash')" id="m-cash">
            <span class="ico">💵</span>
            <h4>Pay at Table</h4>
            <p>Cash or card when staff arrives</p>
        </div>
    </div>

    {{-- KHQR PAYMENT --}}
    <div id="qr-form" class="card-box">
        <h3>Scan to Pay</h3>
        <div class="qr-box">
            <div class="khqr-badge">🏦 KHQR · Bakong</div>
            <div class="qr-amount">${{ number_format($order->total, 2) }}</div>
            <div class="qr-ref">Ref: {{ $order->order_number }}</div>
            <img id="qr-img" src="" alt="KHQR Code">

            <div class="qr-steps">
                <div class="qr-step">
                    <div class="num">1</div>
                    <p>Open your banking app</p>
                </div>
                <div class="qr-step">
                    <div class="num">2</div>
                    <p>Tap Scan QR or KHQR</p>
                </div>
                <div class="qr-step">
                    <div class="num">3</div>
                    <p>Scan and confirm payment</p>
                </div>
                <div class="qr-step">
                    <div class="num">4</div>
                    <p>Click Confirm below</p>
                </div>
            </div>
        </div>

        <form action="{{ route('payment.qr.confirm', $order) }}" method="POST">
            @csrf
            <button type="submit" class="btn-terra" style="width:100%;padding:1rem">
                ✓ I Have Completed Payment
            </button>
        </form>
    </div>

    {{-- CASH PAYMENT --}}
    <div id="cash-form">
        <form action="{{ route('payment.cash', $order) }}" method="POST">
            @csrf
            <button type="submit" class="btn-terra" style="width:100%;padding:1rem">
                Confirm — I'll Pay at the Table
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
function selectMethod(method) {
    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('m-' + method).classList.add('selected');
    document.getElementById('qr-form').style.display  = method === 'qr'   ? 'block' : 'none';
    document.getElementById('cash-form').style.display = method === 'cash' ? 'block' : 'none';

    if (method === 'qr') {
        generateQR();
    }
}

function generateQR() {
    const amount  = '{{ number_format($order->total, 2) }}';
    const ref     = '{{ $order->order_number }}';
    const merchant = 'Manini Restaurant';

    // KHQR-style payment string
    const qrData = `00020101021229370013${merchant}5204581253031165802KH5913${merchant}6010Phnom Penh62180514${ref}6304`;

    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=${encodeURIComponent(qrData)}&color=E8003D&bgcolor=ffffff&margin=10`;
    document.getElementById('qr-img').src = qrUrl;
}
</script>
@endpush
@endsection