@extends('layouts.app')
@section('title', 'Checkout')

@push('styles')
<style>
    .checkout-page { max-width: 700px; margin: 0 auto; padding: 6rem 2rem 4rem; }
    .checkout-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 400; color: var(--charcoal); margin-bottom: 0.5rem; }
    .checkout-sub { color: var(--warm-gray); font-size: 0.85rem; margin-bottom: 3rem; }

    .summary-card, .form-card {
        background: white;
        border: 1px solid var(--border);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .summary-card h3, .form-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--charcoal);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--border);
    }

    .summary-row:last-child { border: none; }
    .summary-row .lbl { color: var(--warm-gray); }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 500;
        padding-top: 1rem;
        border-top: 2px solid var(--terracotta);
        margin-top: 0.5rem;
    }

    .summary-total .amt { color: var(--terracotta); }

    .checkout-actions { display: flex; gap: 1rem; margin-top: 1.5rem; flex-wrap: wrap; }
</style>
@endpush

@section('content')
<div class="checkout-page">
    <h1 class="checkout-title">Confirm Order</h1>
    <p class="checkout-sub">Almost there — enter your table details below</p>

    <div class="summary-card">
        <h3>Order Summary</h3>
        @foreach($cart as $item)
        <div class="summary-row">
            <span><span style="color:var(--warm-gray)">{{ $item['quantity'] }}×</span> {{ $item['name'] }}</span>
            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
        </div>
        @endforeach
        <div class="summary-row"><span class="lbl">Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
        <div class="summary-row"><span class="lbl">Tax (8%)</span><span>${{ number_format($tax, 2) }}</span></div>
        <div class="summary-total">
            <span>Total</span>
            <span class="amt">${{ number_format($total, 2) }}</span>
        </div>
    </div>

    <form action="{{ route('order.place') }}" method="POST" class="form-card">
        @csrf
        <h3>Table Information</h3>
        <div class="form-group">
            <label class="form-label">Table Number *</label>
            <input type="number" name="table_number" class="form-input" required min="1" value="{{ old('table_number') }}" placeholder="e.g. 5">
            @error('table_number')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Your Name (optional)</label>
            <input type="text" name="customer_name" class="form-input" value="{{ old('customer_name') }}" placeholder="e.g. Maria Rossi">
        </div>
        <div class="form-group">
            <label class="form-label">Special Requests (optional)</label>
            <textarea name="notes" class="form-textarea" placeholder="Allergies, dietary needs, special occasions…">{{ old('notes') }}</textarea>
        </div>
        <div class="checkout-actions">
            <a href="{{ route('order.cart') }}" class="btn-outline-terra">← Back</a>
            <button type="submit" class="btn-terra">Continue to Payment →</button>
        </div>
    </form>
</div>
@endsection
