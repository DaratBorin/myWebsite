@extends('admin.layout')
@section('title', 'Payments')
@section('breadcrumb', 'Payments')

@section('content')

<div class="page-head">
    <div>
        <h1>Payment Records</h1>
        <div class="subtitle">{{ $payments->total() }} total payments</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:2rem">
    <div class="card" style="padding:1.5rem;border-top:3px solid #C9A84C">
        <div style="font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem">Total Revenue</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;color:#C9A84C">${{ number_format($totalRevenue, 2) }}</div>
    </div>
    <div class="card" style="padding:1.5rem;border-top:3px solid #27ae60">
        <div style="font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem">Paid</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;color:#27ae60">{{ $paidCount }}</div>
    </div>
    <div class="card" style="padding:1.5rem;border-top:3px solid #f39c12">
        <div style="font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem">Pending</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;color:#f39c12">{{ $pendingCount }}</div>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:2px solid var(--border)">
                @foreach(['Order','Table','Amount','Method','Status','Date','Action'] as $h)
                <th style="padding:0.9rem 1rem;text-align:left;font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted)">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr style="border-bottom:1px solid var(--border)">
                <td style="padding:0.9rem 1rem">
                    <code style="font-size:0.72rem;background:#f0ebe0;padding:0.2rem 0.5rem;border-radius:3px">{{ $payment->order->order_number ?? '—' }}</code>
                </td>
                <td style="padding:0.9rem 1rem;font-weight:600">T{{ $payment->order->table_number ?? '—' }}</td>
                <td style="padding:0.9rem 1rem;color:#C9A84C;font-size:1rem;font-weight:500">{{ $payment->formatted_amount }}</td>
                <td style="padding:0.9rem 1rem;font-size:0.85rem">
                    {{ $payment->payment_method === 'stripe' ? '💳' : '💵' }} {{ ucfirst($payment->payment_method) }}
                </td>
                <td style="padding:0.9rem 1rem">
                    @if($payment->payment_status === 'paid')
                    <span style="background:#2ecc7120;color:#27ae60;padding:0.2rem 0.65rem;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;border:1px solid #27ae6040">Paid</span>
                    @else
                    <span style="background:#f39c1220;color:#f39c12;padding:0.2rem 0.65rem;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;border:1px solid #f39c1240">Pending</span>
                    @endif
                </td>
                <td style="padding:0.9rem 1rem;font-size:0.78rem;color:var(--muted)">
                    {{ ($payment->paid_at ?? $payment->created_at)->format('M d, g:i A') }}
                </td>
                <td style="padding:0.9rem 1rem">
                    @if($payment->payment_status !== 'paid')
                    <form action="{{ route('admin.payments.markPaid', $payment) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="action-btn btn-gold" style="padding:0.3rem 0.7rem;font-size:0.7rem">Mark Paid</button>
                    </form>
                    @else
                    <span style="color:#27ae60;font-size:0.8rem">✓ Complete</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="padding:3rem;text-align:center;color:var(--muted)">No payments yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $payments->links() }}</div>

@endsection
