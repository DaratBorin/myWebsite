@extends('admin.layout')
@section('title', 'Reservations')
@section('breadcrumb', 'Reservations')

@section('content')
<div class="page-head">
    <div>
        <h1>Reservations</h1>
        <div class="subtitle">{{ $reservations->total() }} total reservations</div>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table>
        <thead>
            <tr>
                <th>Guest</th>
                <th>Date & Time</th>
                <th>Guests</th>
                <th>Occasion</th>
                <th>Status</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $r)
            <tr>
                <td>
                    <div style="font-weight:500">{{ $r->first_name }} {{ $r->last_name }}</div>
                    <div style="font-size:0.75rem;color:#8A7D6B">{{ $r->email }}</div>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($r->date)->format('M d, Y') }}<br>
                    <span style="color:#8A7D6B;font-size:0.78rem">{{ \Carbon\Carbon::parse($r->time)->format('g:i A') }}</span>
                </td>
                <td>{{ $r->guests }}</td>
                <td>{{ $r->occasion ?? '—' }}</td>
                <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                <td style="text-align:center">
                    <div style="display:inline-flex;gap:0.5rem">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="action-btn btn-primary">View</a>
                        <form action="{{ route('admin.reservations.status', $r) }}" method="POST">
                            @csrf @method('PATCH')
                            @php
                                $statuses = ['pending','confirmed','completed','cancelled'];
                                $current  = array_search($r->status, $statuses);
                                $next     = $statuses[($current + 1) % count($statuses)];
                            @endphp
                            <input type="hidden" name="status" value="{{ $next }}">
                            <button type="submit" class="action-btn btn-primary">{{ ucfirst($next) }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:3rem;color:#8A7D6B">No reservations yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $reservations->links() }}</div>
@endsection