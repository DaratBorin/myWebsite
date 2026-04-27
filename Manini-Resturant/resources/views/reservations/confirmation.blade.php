@extends('layouts.app')
@section('title', 'Reservation Confirmed')

@section('content')
<div style="max-width:600px;margin:0 auto;padding:6rem 2rem 4rem;text-align:center">
    <div style="font-size:4rem;margin-bottom:1.5rem">🎉</div>
    <h1 style="font-family:'Playfair Display',serif;font-size:3rem;font-weight:400;color:var(--charcoal);margin-bottom:0.5rem">See You Soon!</h1>
    <p style="color:var(--warm-gray);font-size:0.9rem;margin-bottom:3rem;line-height:1.7">Your reservation has been confirmed. We look forward to welcoming you to Manini.</p>

    <div style="background:white;border:1px solid var(--border);padding:2rem;text-align:left;margin-bottom:2rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:500;color:var(--charcoal);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border)">Reservation Details</h3>
        @if(isset($reservation))
        <div style="display:flex;justify-content:space-between;padding:0.5rem 0;font-size:0.85rem;border-bottom:1px solid var(--border)">
            <span style="color:var(--warm-gray)">Confirmation Code</span>
            <code style="font-size:0.8rem;background:#f0ebe0;padding:0.2rem 0.5rem;border-radius:3px">{{ $reservation->confirmation_code ?? 'TB-' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</code>
        </div>
        <div style="display:flex;justify-content:space-between;padding:0.5rem 0;font-size:0.85rem;border-bottom:1px solid var(--border)">
            <span style="color:var(--warm-gray)">Name</span>
            <span>{{ $reservation->first_name }} {{ $reservation->last_name }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;padding:0.5rem 0;font-size:0.85rem;border-bottom:1px solid var(--border)">
            <span style="color:var(--warm-gray)">Date</span>
            <span>{{ \Carbon\Carbon::parse($reservation->date)->format('l, F j, Y') }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;padding:0.5rem 0;font-size:0.85rem;border-bottom:1px solid var(--border)">
            <span style="color:var(--warm-gray)">Time</span>
            <span>{{ \Carbon\Carbon::parse($reservation->time)->format('g:i A') }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;padding:0.5rem 0;font-size:0.85rem">
            <span style="color:var(--warm-gray)">Guests</span>
            <span>{{ $reservation->guests }} {{ $reservation->guests === 1 ? 'Guest' : 'Guests' }}</span>
        </div>
        @endif
    </div>

    <p style="font-size:0.82rem;color:var(--warm-gray);margin-bottom:2rem">A confirmation has been sent to your email. If you need to modify or cancel, please call us at <a href="tel:+12125551234" style="color:var(--terracotta)">+1 (212) 555-1234</a>.</p>

    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('menu') }}" class="btn-outline-terra">Browse Menu</a>
        <a href="{{ route('home') }}" class="btn-terra">Back to Home</a>
    </div>
</div>
@endsection
