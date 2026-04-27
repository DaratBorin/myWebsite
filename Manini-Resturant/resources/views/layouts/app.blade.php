<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manini — Authentic Italian dining in the heart of New York. Fresh pasta, wood-fired dishes, and the finest Italian wines.">
    <title>@yield('title', 'Manini') — Authentic Italian Dining</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Lato:wght@300;400;700&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ivory:      #FAF7F2;
            --cream:      #F2EDE4;
            --parchment:  #E8DDD0;
            --terracotta: #C4622D;
            --terra-dark: #9B4A1F;
            --terra-light:#E8845A;
            --olive:      #5C6B3A;
            --wine:       #722F37;
            --charcoal:   #2C2C2C;
            --warm-gray:  #6B6560;
            --gold:       #B8963E;
            --border:     rgba(196, 98, 45, 0.2);
            --shadow:     0 4px 30px rgba(44,44,44,0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--ivory);
            color: var(--charcoal);
            font-weight: 300;
            line-height: 1.8;
            overflow-x: hidden;
        }

        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 0 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            transition: all 0.4s ease;
            background: rgba(44,44,44,0.85);
        }

        .nav.scrolled {
            background: var(--charcoal);
            height: 65px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }

        .nav-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            color: var(--terra-light);
            text-decoration: none;
            line-height: 1;
        }

        .nav-logo small {
            display: block;
            font-family: 'Lato', sans-serif;
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--terra-light); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-cart {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 1.3rem;
            position: relative;
            transition: color 0.3s;
        }

        .nav-cart:hover { color: var(--terra-light); }

        .cart-badge {
            position: absolute;
            top: -6px; right: -8px;
            background: var(--terracotta);
            color: white;
            font-size: 0.55rem;
            font-weight: 700;
            width: 17px; height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-reserve {
            background: var(--terracotta);
            color: white;
            padding: 0.55rem 1.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 2px;
        }

        .nav-reserve:hover { background: var(--terra-dark); }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: white;
            transition: all 0.3s;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            inset: 0;
            background: var(--charcoal);
            z-index: 999;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2.5rem;
        }

        .mobile-menu.open { display: flex; }

        .mobile-menu a {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .mobile-menu a:hover { color: var(--terra-light); }

        .mobile-close {
            position: absolute;
            top: 24px; right: 28px;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        .page-header {
            background: var(--charcoal);
            padding: 140px 4rem 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23C4622D' fill-opacity='0.04'%3E%3Cpath d='M40 0L80 40L40 80L0 40Z'/%3E%3C/g%3E%3C/svg%3E");
        }

        .page-header-tag {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--terracotta);
            margin-bottom: 1rem;
            position: relative;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 400;
            color: white;
            line-height: 1.1;
            position: relative;
        }

        .flash {
            padding: 1rem 4rem;
            text-align: center;
            font-size: 0.85rem;
        }
        .flash.success { background: #d4edda; color: #155724; }
        .flash.error   { background: #f8d7da; color: #721c24; }

        .btn-terra {
            display: inline-block;
            padding: 0.9rem 2.5rem;
            background: var(--terracotta);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 2px;
        }

        .btn-terra:hover { background: var(--terra-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(196,98,45,0.3); }

        .btn-outline-terra {
            display: inline-block;
            padding: 0.85rem 2.5rem;
            border: 2px solid var(--terracotta);
            color: var(--terracotta);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 2px;
        }

        .btn-outline-terra:hover { background: var(--terracotta); color: white; }

        .section-tag {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--terracotta);
            display: block;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 400;
            color: var(--charcoal);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .section-title em { color: var(--terracotta); font-style: italic; }

        .section-divider {
            width: 50px;
            height: 3px;
            background: var(--terracotta);
            margin: 1.5rem 0;
        }

        .section-divider.center { margin: 1.5rem auto; }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 4rem;
        }

        footer {
            background: var(--charcoal);
            color: rgba(255,255,255,0.6);
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            padding: 5rem 4rem;
            max-width: 1280px;
            margin: 0 auto;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--terra-light);
            display: block;
            margin-bottom: 1rem;
            text-decoration: none;
        }

        .footer-desc {
            font-size: 0.85rem;
            line-height: 1.8;
            max-width: 280px;
            color: rgba(255,255,255,0.45);
        }

        .footer-col h5 {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--terracotta);
            margin-bottom: 1.5rem;
        }

        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.6rem; font-size: 0.85rem; }
        .footer-col ul li a { color: rgba(255,255,255,0.45); text-decoration: none; transition: color 0.3s; }
        .footer-col ul li a:hover { color: var(--terra-light); }

        .footer-hours-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-size: 0.82rem;
            color: rgba(255,255,255,0.45);
        }

        .footer-hours-row .time { color: rgba(255,255,255,0.7); }

        .footer-bottom {
            text-align: center;
            padding: 1.5rem 4rem;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.25);
            letter-spacing: 0.08em;
        }

        .form-group { margin-bottom: 1.5rem; }

        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 0.5rem;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid var(--parchment);
            background: white;
            font-family: 'Lato', sans-serif;
            font-size: 0.9rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color 0.3s;
            border-radius: 2px;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--terracotta); }
        .form-textarea { resize: vertical; min-height: 120px; }

        .field-error {
            display: block;
            font-size: 0.75rem;
            color: #c0392b;
            margin-top: 0.3rem;
        }

        @media (max-width: 900px) {
            .nav { padding: 0 1.5rem; }
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .container { padding: 0 1.5rem; }
            .footer-top { grid-template-columns: 1fr; gap: 2rem; padding: 3rem 1.5rem; }
            .page-header { padding: 120px 1.5rem 60px; }
        }
    </style>

    @stack('styles')
</head>
<body>

<nav class="nav" id="mainNav">
    <a href="{{ route('home') }}" class="nav-logo">
        Manini
        <small>Fine Italian Dining · Est. 2009</small>
    </a>

    <ul class="nav-links">
        <li><a href="{{ route('home') }}"    class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('menu') }}"    class="{{ request()->routeIs('menu*') ? 'active' : '' }}">Menu</a></li>
        <li><a href="{{ route('about') }}"   class="{{ request()->routeIs('about') ? 'active' : '' }}">Our Story</a></li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
    </ul>

    <div class="nav-right">
        @php $cartCount = collect(session()->get('cart', []))->sum('quantity'); @endphp
        <a href="{{ route('order.cart') }}" class="nav-cart">
            🛒
            @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
            @endif
        </a>
        <a href="{{ route('reservations.create') }}" class="nav-reserve">Reserve</a>
        <div class="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <button class="mobile-close" onclick="toggleMenu()">✕</button>
    <a href="{{ route('home') }}"    onclick="toggleMenu()">Home</a>
    <a href="{{ route('menu') }}"    onclick="toggleMenu()">Menu</a>
    <a href="{{ route('about') }}"   onclick="toggleMenu()">Our Story</a>
    <a href="{{ route('contact') }}" onclick="toggleMenu()">Contact</a>
    <a href="{{ route('order.cart') }}" onclick="toggleMenu()">🛒 My Order</a>
    <a href="{{ route('reservations.create') }}" onclick="toggleMenu()">Reserve a Table</a>
</div>

@if(session('success') || session('error'))
<div id="toast" style="position:fixed;top:90px;left:50%;transform:translateX(-50%);z-index:9999;padding:0.85rem 2rem;border-radius:4px;font-size:0.85rem;font-family:'Lato',sans-serif;box-shadow:0 4px 20px rgba(0,0,0,0.15);transition:opacity 0.5s;
{{ session('success') ? 'background:#d4edda;color:#155724;border:1px solid #c3e6cb;' : 'background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;' }}">
    {{ session('success') ?? session('error') }}
</div>
<script>
    setTimeout(() => {
        const t = document.getElementById('toast');
        if (t) { t.style.opacity = '0'; setTimeout(() => t.remove(), 500); }
    }, 3000);
</script>
@endif

@yield('content')

<footer>
    <div class="footer-top">
        <div>
            <a href="{{ route('home') }}" class="footer-logo">Manini</a>
            <p class="footer-desc">Bringing the soul of Italy to New York since 2009. Family recipes, seasonal ingredients, and a passion for genuine hospitality.</p>
        </div>
        <div class="footer-col">
            <h5>Navigate</h5>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('about') }}">Our Story</a></li>
                <li><a href="{{ route('reservations.create') }}">Reservations</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Hours</h5>
            <div class="footer-hours-row"><span>Mon–Tue</span><span class="time">Closed</span></div>
            <div class="footer-hours-row"><span>Wed–Thu</span><span class="time">5–10 PM</span></div>
            <div class="footer-hours-row"><span>Friday</span><span class="time">5–11 PM</span></div>
            <div class="footer-hours-row"><span>Saturday</span><span class="time">12–11 PM</span></div>
            <div class="footer-hours-row"><span>Sunday</span><span class="time">12–9 PM</span></div>
        </div>
        <div class="footer-col">
            <h5>Find Us</h5>
            <ul>
                <li><a href="#">123 Gourmet Avenue</a></li>
                <li><a href="#">New York, NY 10012</a></li>
                <li style="margin-top:1rem"><a href="tel:+12125551234">+1 (212) 555-1234</a></li>
                <li><a href="mailto:info@manini.com">info@manini.com</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        © {{ date('Y') }} Manini. All rights reserved. · Little Italy, New York
    </div>
</footer>

<script>
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 60));
    if (window.scrollY > 60) nav.classList.add('scrolled');
    function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('open'); }
</script>

@stack('scripts')
</body>
</html>