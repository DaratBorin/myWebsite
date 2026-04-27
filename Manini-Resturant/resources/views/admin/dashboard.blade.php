<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Manini</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Jost',sans-serif; background:#F8F4ED; color:#2D2416; font-weight:300; }

        .admin-layout { display:flex; min-height:100vh; }

        .sidebar {
            width:240px; background:#1A1208; color:white;
            display:flex; flex-direction:column;
            position:fixed; top:0; left:0; bottom:0;
            z-index:100;
        }

        .sidebar-logo {
            font-family:'Cormorant Garamond',serif;
            font-size:1.6rem; color:#C9A84C;
            padding:1.5rem; border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .sidebar-logo small {
            display:block; font-family:'Jost',sans-serif;
            font-size:0.55rem; letter-spacing:0.3em;
            text-transform:uppercase; color:rgba(255,255,255,0.35);
            margin-top:2px;
        }

        .sidebar-section {
            font-size:0.6rem; font-weight:600;
            letter-spacing:0.3em; text-transform:uppercase;
            color:rgba(255,255,255,0.25); padding:1.5rem 1.5rem 0.5rem;
        }

        .sidebar-link {
            display:flex; align-items:center; gap:0.75rem;
            padding:0.75rem 1.5rem; color:rgba(255,255,255,0.55);
            text-decoration:none; font-size:0.82rem;
            transition:all 0.2s;
        }

        .sidebar-link:hover, .sidebar-link.active {
            color:white; background:rgba(201,168,76,0.1);
            border-left:2px solid #C9A84C;
        }

        .sidebar-bottom { margin-top:auto; padding:1.5rem; border-top:1px solid rgba(255,255,255,0.08); flex-shrink:0; }
        .sidebar-bottom form { display:block; }
        .sidebar-bottom button { background:none; border:none; color:rgba(255,255,255,0.4); font-size:0.78rem; cursor:pointer; font-family:'Jost',sans-serif; padding:0; transition:color 0.2s; }
        .sidebar-bottom button:hover { color:white; }


        .main { margin-left:240px; flex:1; }

        .topbar {
            background:white; padding:1rem 2rem;
            border-bottom:1px solid #E8DDD0;
            display:flex; align-items:center;
            justify-content:space-between;
        }

        .topbar-title { font-size:0.72rem; color:#8A7D6B; letter-spacing:0.1em; }
        .topbar-title span { color:#2D2416; font-weight:500; }

        .content { padding:2rem; }

        .page-head {
            display:flex; justify-content:space-between;
            align-items:flex-start; margin-bottom:2rem;
        }

        .page-head h1 {
            font-family:'Cormorant Garamond',serif;
            font-size:2rem; font-weight:400; color:#1A1208;
        }

        .page-head .subtitle { font-size:0.82rem; color:#8A7D6B; margin-top:0.25rem; }

        .stats-grid {
            display:grid; grid-template-columns:repeat(4,1fr);
            gap:1.5rem; margin-bottom:2rem;
        }

        .stat-card {
            background:white; padding:1.5rem;
            border:1px solid rgba(201,168,76,0.2);
            border-top:3px solid #C9A84C;
        }

        .stat-label {
            font-size:0.68rem; font-weight:600;
            letter-spacing:0.2em; text-transform:uppercase;
            color:#8A7D6B; margin-bottom:0.5rem;
        }

        .stat-value {
            font-family:'Cormorant Garamond',serif;
            font-size:2.2rem; font-weight:400; color:#C9A84C;
            line-height:1;
        }

        .cards-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }

        .card { background:white; border:1px solid rgba(201,168,76,0.2); }

        .card-header {
            padding:1.25rem 1.5rem;
            border-bottom:1px solid rgba(201,168,76,0.15);
            display:flex; justify-content:space-between; align-items:center;
        }

        .card-header h3 {
            font-family:'Cormorant Garamond',serif;
            font-size:1.1rem; font-weight:500; color:#1A1208;
        }

        .card-body { padding:1.5rem; }

        table { width:100%; border-collapse:collapse; }
        th { padding:0.6rem 0.75rem; text-align:left; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; color:#8A7D6B; border-bottom:1px solid #E8DDD0; }
        td { padding:0.75rem; font-size:0.82rem; border-bottom:1px solid #F8F4ED; }

        .badge {
            padding:0.2rem 0.6rem; font-size:0.65rem;
            font-weight:600; letter-spacing:0.08em;
            text-transform:uppercase; border-radius:20px;
        }

        .badge-pending  { background:#fff3cd; color:#856404; }
        .badge-paid     { background:#d4edda; color:#155724; }
        .badge-confirmed{ background:#d1ecf1; color:#0c5460; }
        .badge-completed{ background:#d4edda; color:#155724; }

        .action-btn {
            display:inline-flex; align-items:center; gap:0.4rem;
            padding:0.45rem 1rem; font-size:0.72rem; font-weight:500;
            letter-spacing:0.08em; text-transform:uppercase;
            text-decoration:none; border:none; cursor:pointer;
            transition:all 0.2s; border-radius:2px;
        }

        .btn-primary { background:#F8F4ED; color:#2D2416; border:1px solid #E8DDD0; }
        .btn-primary:hover { background:#E8DDD0; }
        .btn-gold { background:#C9A84C; color:#1A1208; }
        .btn-gold:hover { background:#B8963E; }

        .var { --muted: #8A7D6B; --border: rgba(201,168,76,0.2); }
    </style>
</head>
<body>
<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            Manini
            <small>Admin Panel</small>
        </div>

        <div class="sidebar-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">📊 Dashboard</a>

        <div class="sidebar-section">Reservations</div>
        <a href="{{ route('admin.reservations.index') }}" class="sidebar-link">📅 Reservations</a>

        <div class="sidebar-section">Orders</div>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link">🧾 Orders</a>
        <a href="{{ route('admin.payments.index') }}" class="sidebar-link">💳 Payments</a>

        <div class="sidebar-section">Menu</div>
        <a href="{{ route('admin.menu-items.index') }}" class="sidebar-link">🍽️ Menu Items</a>

        <div class="sidebar-section">Messages</div>
        <a href="{{ route('admin.enquiries.index') }}" class="sidebar-link">✉️ Enquiries</a>
        <a href="{{ route('admin.feedback.index') }}" class="sidebar-link">💬 Feedback</a>


        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link">🚪 Log Out</button>
            </form>
        </div>

    </aside>

    {{-- MAIN --}}
    <main class="main">
        <div class="topbar">
            <div class="topbar-title">Admin › <span>Dashboard</span></div>
            <a href="{{ route('reservations.create') }}" class="action-btn btn-gold">+ New Booking</a>
        </div>

        <div class="content">
            <div class="page-head">
                <div>
                    <h1>Dashboard</h1>
                    <div class="subtitle">Welcome to Manini Admin Panel</div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-value">{{ $stats['total_orders'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending Orders</div>
                    <div class="stat-value">{{ $stats['pending_orders'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Revenue</div>
                    <div class="stat-value">${{ number_format($stats['total_revenue'], 2) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Reservations</div>
                    <div class="stat-value">{{ $stats['total_reservations'] }}</div>
                </div>
            </div>

            {{-- Recent --}}
            <div class="cards-grid">
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Orders</h3>
                        <a href="{{ route('admin.orders.index') }}" class="action-btn btn-primary">View All</a>
                    </div>
                    <div class="card-body" style="padding:0">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Table</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td><code style="font-size:0.72rem">{{ $order->order_number }}</code></td>
                                    <td>T{{ $order->table_number }}</td>
                                    <td style="color:#C9A84C">{{ $order->formatted_total }}</td>
                                    <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="4" style="text-align:center;color:#8A7D6B;padding:2rem">No orders yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Recent Payments</h3>
                        <a href="{{ route('admin.payments.index') }}" class="action-btn btn-primary">View All</a>
                    </div>
                    <div class="card-body" style="padding:0">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPayments as $payment)
                                <tr>
                                    <td><code style="font-size:0.72rem">{{ $payment->order->order_number ?? '—' }}</code></td>
                                    <td style="color:#C9A84C">{{ $payment->formatted_amount }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td><span class="badge badge-{{ $payment->payment_status }}">{{ ucfirst($payment->payment_status) }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="4" style="text-align:center;color:#8A7D6B;padding:2rem">No payments yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>