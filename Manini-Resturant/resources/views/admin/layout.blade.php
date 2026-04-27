<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Manini</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Jost',sans-serif; background:#F8F4ED; color:#2D2416; font-weight:300; }
        .admin-wrap { display:flex; min-height:100vh; }
        .sidebar { width:240px; background:#1A1208; color:white; display:flex; flex-direction:column; position:fixed; top:0; left:0; bottom:0; z-index:100; overflow-y:auto; }
        .sidebar-logo { font-family:'Cormorant Garamond',serif; font-size:1.6rem; color:#C9A84C; padding:1.5rem; border-bottom:1px solid rgba(255,255,255,0.08); }
        .sidebar-logo small { display:block; font-family:'Jost',sans-serif; font-size:0.55rem; letter-spacing:0.3em; text-transform:uppercase; color:rgba(255,255,255,0.35); margin-top:2px; }
        .sidebar-section { font-size:0.6rem; font-weight:600; letter-spacing:0.3em; text-transform:uppercase; color:rgba(255,255,255,0.25); padding:1.5rem 1.5rem 0.5rem; }
        .sidebar-link { display:flex; align-items:center; gap:0.75rem; padding:0.75rem 1.5rem; color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.82rem; transition:all 0.2s; border-left:2px solid transparent; }
        .sidebar-link:hover, .sidebar-link.active { color:white; background:rgba(201,168,76,0.1); border-left-color:#C9A84C; }
        .sidebar-bottom { margin-top:auto; padding:1.5rem; border-top:1px solid rgba(255,255,255,0.08); flex-shrink:0; }
        .sidebar-bottom form { display:block; }
        .sidebar-bottom button { background:none; border:none; color:rgba(255,255,255,0.4); font-size:0.78rem; cursor:pointer; font-family:'Jost',sans-serif; padding:0; transition:color 0.2s; }
        .sidebar-bottom button:hover { color:white; }
        .main { margin-left:240px; flex:1; min-height:100vh; }
        .topbar { background:white; padding:1rem 2rem; border-bottom:1px solid #E8DDD0; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:50; }
        .topbar-breadcrumb { font-size:0.72rem; color:#8A7D6B; }
        .topbar-breadcrumb span { color:#2D2416; font-weight:500; }
        .content { padding:2rem; }
        .page-head { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:2rem; }
        .page-head h1 { font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:400; color:#1A1208; }
        .page-head .subtitle { font-size:0.82rem; color:#8A7D6B; margin-top:0.25rem; }
        .card { background:white; border:1px solid rgba(201,168,76,0.2); margin-bottom:1.5rem; }
        .card-header { padding:1.25rem 1.5rem; border-bottom:1px solid rgba(201,168,76,0.15); display:flex; justify-content:space-between; align-items:center; }
        .card-header h3 { font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:500; color:#1A1208; }
        .card-body { padding:1.5rem; }
        table { width:100%; border-collapse:collapse; }
        th { padding:0.75rem 1rem; text-align:left; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; color:#8A7D6B; border-bottom:2px solid #E8DDD0; white-space:nowrap; }
        td { padding:0.85rem 1rem; font-size:0.82rem; border-bottom:1px solid #F8F4ED; vertical-align:middle; }
        tr:hover td { background:#fdfaf6; }
        .badge { padding:0.2rem 0.65rem; font-size:0.65rem; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; border-radius:20px; }
        .badge-pending    { background:#fff3cd; color:#856404; }
        .badge-confirmed  { background:#d1ecf1; color:#0c5460; }
        .badge-preparing  { background:#e2d9f3; color:#6f42c1; }
        .badge-ready      { background:#d4edda; color:#155724; }
        .badge-completed  { background:#d4edda; color:#155724; }
        .badge-cancelled  { background:#f8d7da; color:#721c24; }
        .badge-paid       { background:#d4edda; color:#155724; }
        .badge-cash       { background:#fff3cd; color:#856404; }
        .action-btn { display:inline-flex; align-items:center; gap:0.4rem; padding:0.35rem 0.75rem; font-size:0.68rem; font-weight:500; letter-spacing:0.06em; text-transform:uppercase; text-decoration:none; border:none; cursor:pointer; transition:all 0.2s; border-radius:2px; height:30px; }
        .btn-primary { background:#F8F4ED; color:#2D2416; border:1px solid #E8DDD0; }
        .btn-primary:hover { background:#E8DDD0; }
        .btn-gold { background:#C9A84C; color:#1A1208; }
        .btn-gold:hover { background:#B8963E; }
        .btn-danger { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
        .btn-danger:hover { background:#f5c6cb; }
        .form-select { padding:0.5rem 0.75rem; border:1px solid #E8DDD0; background:white; font-family:'Jost',sans-serif; font-size:0.82rem; color:#2D2416; border-radius:2px; outline:none; }
        .form-select:focus { border-color:#C9A84C; }
        .form-input { width:100%; padding:0.75rem 1rem; border:1px solid #E8DDD0; background:white; font-family:'Jost',sans-serif; font-size:0.88rem; color:#2D2416; border-radius:2px; outline:none; transition:border-color 0.2s; }
        .form-input:focus { border-color:#C9A84C; }
        .form-label { display:block; font-size:0.68rem; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:#8A7D6B; margin-bottom:0.4rem; }
        .form-group { margin-bottom:1.25rem; }
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        .flash { padding:0.85rem 1.25rem; margin-bottom:1.5rem; border-radius:2px; font-size:0.82rem; }
        .flash.success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
        .flash.error   { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
        .muted { color:#8A7D6B; }
        @media(max-width:900px) { .sidebar { transform:translateX(-100%); } .main { margin-left:0; } }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-wrap">
    <aside class="sidebar">
        <div class="sidebar-logo">Manini<small>Admin Panel</small></div>

        <div class="sidebar-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a>

        <div class="sidebar-section">Reservations</div>
        <a href="{{ route('admin.reservations.index') }}" class="sidebar-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">📅 Reservations</a>

        <div class="sidebar-section">Orders</div>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">🧾 Orders</a>
        <a href="{{ route('admin.payments.index') }}" class="sidebar-link {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">💳 Payments</a>

        <div class="sidebar-section">Menu</div>
        <a href="{{ route('admin.menu-items.index') }}" class="sidebar-link {{ request()->routeIs('admin.menu-items*') ? 'active' : '' }}">🍽️ Menu Items</a>

        <div class="sidebar-section">Messages</div>
        <a href="{{ route('admin.enquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">✉️ Enquiries</a>
        <a href="{{ route('admin.feedback.index') }}" class="sidebar-link {{ request()->routeIs('admin.feedback*') ? 'active' : '' }}">💬 Feedback</a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">🚪 Log Out</button>
            </form>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="topbar-breadcrumb">Admin › <span>@yield('breadcrumb', 'Dashboard')</span></div>
            <a href="{{ route('reservations.create') }}" class="action-btn btn-gold">+ New Booking</a>
        </div>

        @if(session('success'))
        <div style="padding:0 2rem;margin-top:1rem">
            <div class="flash success">{{ session('success') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div style="padding:0 2rem;margin-top:1rem">
            <div class="flash error">{{ session('error') }}</div>
        </div>
        @endif

        <div class="content">
            @yield('content')
        </div>
    </main>
</div>
@stack('scripts')
</body>
</html>