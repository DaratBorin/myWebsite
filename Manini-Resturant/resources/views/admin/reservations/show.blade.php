@extends('admin.layout')
@section('title', 'Reservation — ' . $reservation->first_name)
@section('breadcrumb', 'Reservations › View')

@section('content')
<div class="page-head">
    <div>
        <h1>{{ $reservation->first_name }} {{ $reservation->last_name }}</h1>
        <div class="subtitle">Reservation #{{ $reservation->id }} · {{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</div>
    </div>
    <a href="{{ route('admin.reservations.index') }}" class="action-btn btn-primary">← Back</a>
</div>

<div style="max-width:700px">
    <div class="card">
        <div class="card-header"><h3>Reservation Details</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:0.75rem">
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Name</span>
                <span>{{ $reservation->first_name }} {{ $reservation->last_name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Email</span>
                <span>{{ $reservation->email }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Phone</span>
                <span>{{ $reservation->phone }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Date</span>
                <span>{{ \Carbon\Carbon::parse($reservation->date)->format('l, F j, Y') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Time</span>
                <span>{{ \Carbon\Carbon::parse($reservation->time)->format('g:i A') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Guests</span>
                <span>{{ $reservation->guests }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Occasion</span>
                <span>{{ $reservation->occasion ?? '—' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0;border-bottom:1px solid #F8F4ED">
                <span style="color:#8A7D6B">Notes</span>
                <span>{{ $reservation->notes ?? '—' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;padding:0.5rem 0">
                <span style="color:#8A7D6B">Status</span>
                <span class="badge badge-{{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>Update Status</h3></div>
        <div class="card-body">
            <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST" style="display:flex;gap:0.75rem;align-items:center">
                @csrf @method('PATCH')
                <select name="status" class="form-select" style="flex:1">
                    @foreach(['pending','confirmed','completed','cancelled'] as $s)
                    <option value="{{ $s }}" {{ $reservation->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="action-btn btn-gold">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection