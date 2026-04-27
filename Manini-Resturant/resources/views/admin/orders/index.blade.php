@extends('admin.layout')
@section('title', 'Orders')
@section('breadcrumb', 'Orders')

@section('content')

<div class="page-head">
    <div>
        <h1>Orders</h1>
        <div class="subtitle">{{ $orders->total() }} total orders</div>
    </div>
</div>

{{-- Quick Stats --}}
@php
    $pending   = $orders->getCollection()->where('status', 'pending')->count();
    $confirmed = $orders->getCollection()->where('status', 'confirmed')->count();
@endphp

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:2rem">
    @php
        $allOrders = \App\Models\Order::select('status')->get();
        $statuses  = ['pending'=>'#f39c12','confirmed'=>'#3498db','preparing'=>'#9b59b6','completed'=>'#27ae60'];
    @endphp
    @foreach($statuses as $s => $color)
    <div class="card" style="padding:1.25rem;border-top:3px solid {{ $color }}">
        <div style="font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem">{{ ucfirst($s) }}</div>
        <div style="font-size:1.8rem;font-family:'Cormorant Garamond',serif;color:{{ $color }}">{{ $allOrders->where('status',$s)->count() }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:2px solid var(--border)">
                @foreach(['Order','Table','Customer','Items','Total','Status','Payment','Actions'] as $h)
                <th style="padding:0.9rem 1rem;text-align:{{ $h === 'Actions' ? 'center' : 'left' }};font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);white-space:nowrap">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr style="border-bottom:1px solid var(--border);transition:background 0.2s" onmouseover="this.style.background='#fafaf8'" onmouseout="this.style.background=''">
                <td style="padding:0.9rem 1rem">
                    <code style="font-size:0.72rem;background:#f0ebe0;padding:0.2rem 0.5rem;border-radius:3px">{{ $order->order_number }}</code>
                    <div style="font-size:0.7rem;color:var(--muted);margin-top:0.2rem">{{ $order->created_at->format('M d, g:i A') }}</div>
                </td>
                <td style="padding:0.9rem 1rem;font-weight:600">T{{ $order->table_number }}</td>
                <td style="padding:0.9rem 1rem;font-size:0.85rem">{{ $order->customer_name ?? '—' }}</td>
                <td style="padding:0.9rem 1rem;font-size:0.85rem">{{ $order->items->count() }}</td>
                <td style="padding:0.9rem 1rem;font-size:1rem;color:#C9A84C;font-weight:500">{{ $order->formatted_total }}</td>
                <td style="padding:0.9rem 1rem">
                    @php $sc=['pending'=>'#f39c12','confirmed'=>'#3498db','preparing'=>'#9b59b6','ready'=>'#27ae60','completed'=>'#2ecc71','cancelled'=>'#e74c3c'];$c=$sc[$order->status]??'#999'; @endphp
                    <span style="background:{{ $c }}18;color:{{ $c }};padding:0.2rem 0.65rem;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;border:1px solid {{ $c }}40">{{ ucfirst($order->status) }}</span>
                </td>
                <td style="padding:0.9rem 1rem">
                    @if($order->payment)
                        @if($order->payment->payment_status==='paid')
                        <span style="color:#27ae60;font-size:0.8rem;font-weight:700">✓ Paid</span>
                        @else
                        <span style="color:#f39c12;font-size:0.75rem">{{ ucfirst($order->payment->payment_method) }} pending</span>
                        @endif
                    @else
                    <span style="color:var(--muted);font-size:0.75rem">—</span>
                    @endif
                </td>
                <td style="padding:0.9rem 1rem;text-align:center">
                    <div style="display:inline-flex;gap:0.5rem;align-items:center">
                        <a href="{{ route('admin.orders.show', $order) }}" class="action-btn btn-primary" style="padding:0.3rem 0.7rem;font-size:0.7rem">View</a>
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                            @csrf @method('PATCH')
                            @php
                                $statuses = ['pending','confirmed','preparing','ready','completed','cancelled'];
                                $current  = array_search($order->status, $statuses);
                                $next     = $statuses[($current + 1) % count($statuses)];
                            @endphp
                            <input type="hidden" name="status" value="{{ $next }}">
                            <button type="submit" class="action-btn btn-primary">
                                {{ ucfirst($next) }}
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="padding:3rem;text-align:center;color:var(--muted)">No orders yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $orders->links() }}</div>

@endsection
