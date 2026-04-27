@extends('layouts.app')
@section('title', 'Your Order')

@push('styles')
<style>
    .cart-page { max-width: 800px; margin: 0 auto; padding: 6rem 2rem 4rem; }
    .cart-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 400; color: var(--charcoal); margin-bottom: 0.5rem; }
    .cart-sub { color: var(--warm-gray); font-size: 0.85rem; margin-bottom: 3rem; }
    .cart-empty { text-align: center; padding: 5rem 2rem; }
    .cart-empty h2 { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 400; margin-bottom: 1rem; }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .cart-item-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 500; flex: 1; }

    .qty-wrap { display: flex; align-items: center; border: 1px solid var(--border); border-radius: 2px; overflow: hidden; }

    .qty-btn {
        background: none;
        border: none;
        color: var(--terracotta);
        font-size: 1.2rem;
        width: 34px; height: 34px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .qty-btn:hover { background: var(--cream); }
    .qty-num { width: 30px; text-align: center; font-size: 0.9rem; }

    .cart-item-price { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--terracotta); min-width: 80px; text-align: right; }

    .remove-btn { background: none; border: none; color: var(--warm-gray); cursor: pointer; font-size: 1.1rem; transition: color 0.2s; }
    .remove-btn:hover { color: #c0392b; }

    .cart-total { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 0; margin-top: 1rem; border-top: 2px solid var(--terracotta); }
    .cart-total-label { font-family: 'Playfair Display', serif; font-size: 1.3rem; }
    .cart-total-amount { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--terracotta); }

    .cart-actions { display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap; }
</style>
@endpush

@section('content')
<div class="cart-page">
    <h1 class="cart-title">Your Order</h1>
    <p class="cart-sub">Review before placing your order</p>

    @if(empty($cart))
    <div class="cart-empty">
        <div style="font-size:4rem;margin-bottom:1rem">🛒</div>
        <h2>Your order is empty</h2>
        <p style="color:var(--warm-gray);margin-bottom:2rem">Browse our menu and add some dishes</p>
        <a href="{{ route('menu') }}" class="btn-terra">View Menu</a>
    </div>
    @else
        @foreach($cart as $item)
        <div class="cart-item">
            <div class="cart-item-name">{{ $item['name'] }}</div>

            <div class="qty-wrap">
                <form action="{{ route('order.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_item_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                    <button type="submit" class="qty-btn">−</button>
                </form>
                <span class="qty-num">{{ $item['quantity'] }}</span>
                <form action="{{ route('order.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_item_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                    <button type="submit" class="qty-btn">+</button>
                </form>
            </div>

            <div class="cart-item-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>

            <form action="{{ route('order.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_item_id" value="{{ $item['id'] }}">
                <button type="submit" class="remove-btn">✕</button>
            </form>
        </div>
        @endforeach

        <div class="cart-total">
            <span class="cart-total-label">Subtotal</span>
            <span class="cart-total-amount">${{ number_format($total, 2) }}</span>
        </div>

        <div class="cart-actions">
            <a href="{{ route('menu') }}" class="btn-outline-terra">← Add More</a>
            <a href="{{ route('order.checkout') }}" class="btn-terra">Proceed to Checkout →</a>
        </div>
    @endif
</div>
@endsection
