@extends('layouts.app')
@section('title', 'Manini — Authentic Italian Dining New York')

@push('styles')
<style>
    /* HERO */
    .hero {
        height: 100vh;
        min-height: 700px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        background: var(--charcoal);
        padding-top: 80px;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(196,98,45,0.15) 0%, transparent 50%),
            linear-gradient(to bottom, rgba(44,44,44,0.4) 0%, rgba(44,44,44,0.7) 100%),
            repeating-linear-gradient(45deg, transparent 0, transparent 40px, rgba(196,98,45,0.02) 40px, rgba(196,98,45,0.02) 41px);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        padding: 0 2rem;
        animation: fadeUp 1.2s ease forwards;
        text-align: center;
        margin: 0 auto;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .hero-tag {
        text-align: center;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: var(--terra-light);
        margin-bottom: 1.5rem;
        animation: fadeUp 1.2s ease 0.2s both;
        display: block;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3.5rem, 9vw, 7rem);
        font-weight: 400;
        color: white;
        line-height: 1;
        margin-bottom: 1rem;
        animation: fadeUp 1.2s ease 0.3s both;
    }

    .hero-title em {
        font-style: italic;
        color: var(--terra-light);
    }

    .hero-subtitle {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1rem, 2.5vw, 1.35rem);
        font-style: italic;
        color: rgba(255,255,255,0.65);
        margin-bottom: 2.5rem;
        animation: fadeUp 1.2s ease 0.5s both;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeUp 1.2s ease 0.7s both;
    }

    .hero-stats {
        display: flex;
        gap: 3rem;
        justify-content: center;
        margin-top: 5rem;
        padding-top: 3rem;
        border-top: 1px solid rgba(255,255,255,0.1);
        animation: fadeUp 1.2s ease 0.9s both;
    }

    .hero-stat { text-align: center; }

    .hero-stat .num {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 400;
        color: var(--terra-light);
        line-height: 1;
        display: block;
    }

    .hero-stat .lbl {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.4);
        margin-top: 0.3rem;
        display: block;
    }

    .hero-scroll {
        position: absolute;
        bottom: 2.5rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255,255,255,0.35);
        font-size: 0.6rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
    }

    .hero-scroll::after {
        content: '';
        width: 1px;
        height: 50px;
        background: linear-gradient(to bottom, var(--terracotta), transparent);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* RIBBON */
    .ribbon {
        background: var(--terracotta);
        padding: 1.2rem 4rem;
        text-align: center;
    }

    .ribbon p {
        font-family: 'Playfair Display', serif;
        font-size: clamp(0.95rem, 2vw, 1.2rem);
        font-style: italic;
        color: white;
        letter-spacing: 0.02em;
    }

    /* WHY US */
    .why-section {
        padding: 7rem 4rem;
        background: var(--cream);
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2.5rem;
        max-width: 1200px;
        margin: 4rem auto 0;
    }

    .why-card {
        text-align: center;
        padding: 2.5rem 1.5rem;
        background: var(--ivory);
        border: 1px solid var(--border);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .why-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: var(--terracotta);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .why-card:hover { transform: translateY(-6px); box-shadow: var(--shadow); }
    .why-card:hover::after { transform: scaleX(1); }

    .why-icon { font-size: 2.5rem; margin-bottom: 1.2rem; display: block; }

    .why-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--charcoal);
        margin-bottom: 0.75rem;
    }

    .why-card p { font-size: 0.82rem; color: var(--warm-gray); line-height: 1.7; }

    /* FEATURED MENU */
    .featured-section {
        padding: 7rem 4rem;
        background: var(--ivory);
    }

    .featured-section .section-title { text-align: center; }
    .featured-section .section-divider { margin: 1.5rem auto; }

    .dishes-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 4rem auto 0;
    }

    .dish-card {
        background: white;
        border: 1px solid var(--border);
        transition: all 0.4s ease;
        overflow: hidden;
    }

    .dish-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); }

    .dish-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        background: var(--parchment);
    }

    .dish-img-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, var(--parchment), var(--cream));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .dish-body { padding: 1.75rem; }

    .dish-cat {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: 0.5rem;
    }

    .dish-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 500;
        color: var(--charcoal);
        margin-bottom: 0.5rem;
    }

    .dish-desc { font-size: 0.8rem; color: var(--warm-gray); line-height: 1.6; margin-bottom: 1.25rem; }

    .dish-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dish-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        color: var(--terracotta);
        font-weight: 500;
    }

    /* STORY */
    .story-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }

    .story-visual {
        background: linear-gradient(135deg, var(--terracotta), var(--terra-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5rem;
        position: relative;
        overflow: hidden;
    }

    .story-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            -45deg,
            transparent 0, transparent 20px,
            rgba(255,255,255,0.03) 20px, rgba(255,255,255,0.03) 21px
        );
    }

    .story-quote-box { position: relative; z-index: 1; text-align: center; }

    .story-quote {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.3rem, 2.5vw, 2rem);
        font-style: italic;
        font-weight: 400;
        color: white;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .story-quote-marks {
        font-family: 'Playfair Display', serif;
        font-size: 6rem;
        color: rgba(255,255,255,0.15);
        line-height: 0;
        margin-bottom: 1rem;
        display: block;
    }

    .story-attr {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.6);
    }

    .story-content {
        background: var(--charcoal);
        display: flex;
        align-items: center;
        padding: 5rem;
    }

    .story-content-inner { max-width: 480px; }

    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 400;
        color: white;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .story-content h2 em { color: var(--terra-light); }

    .story-content p {
        color: rgba(255,255,255,0.55);
        font-size: 0.9rem;
        line-height: 1.9;
        margin-bottom: 1rem;
    }

    /* TESTIMONIALS */
    .testimonials-section {
        padding: 7rem 4rem;
        background: var(--cream);
    }

    .testimonials-section .section-title { text-align: center; }
    .testimonials-section .section-divider { margin: 1.5rem auto; }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 4rem auto 0;
    }

    .testimonial {
        background: var(--ivory);
        padding: 2.5rem;
        border: 1px solid var(--border);
        position: relative;
    }

    .testimonial::before {
        content: '"';
        position: absolute;
        top: 1rem; left: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-size: 5rem;
        color: var(--terracotta);
        opacity: 0.15;
        line-height: 1;
    }

    .testimonial-stars { color: var(--gold); font-size: 0.9rem; margin-bottom: 1rem; letter-spacing: 0.1em; }

    .testimonial-text {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-style: italic;
        color: var(--charcoal);
        line-height: 1.8;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .testimonial-avatar {
        width: 42px; height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--terracotta), var(--wine));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: white;
        flex-shrink: 0;
    }

    .testimonial-name { font-size: 0.85rem; font-weight: 700; color: var(--charcoal); }
    .testimonial-source { font-size: 0.72rem; color: var(--warm-gray); }

    /* CTA */
    .cta-section {
        background: var(--charcoal);
        padding: 7rem 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(196,98,45,0.1) 0%, transparent 70%);
    }

    .cta-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 4rem);
        font-weight: 400;
        color: white;
        margin-bottom: 1rem;
        position: relative;
    }

    .cta-section h2 em { color: var(--terra-light); }

    .cta-section p {
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
        max-width: 500px;
        margin: 0 auto 2.5rem;
        position: relative;
    }

    @media (max-width: 1024px) {
        .why-grid { grid-template-columns: repeat(2, 1fr); }
        .dishes-grid { grid-template-columns: repeat(2, 1fr); }
        .story-section { grid-template-columns: 1fr; }
        .testimonials-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
        .why-section, .featured-section, .testimonials-section, .cta-section { padding: 4rem 1.5rem; }
        .why-grid { grid-template-columns: 1fr; }
        .dishes-grid { grid-template-columns: 1fr; }
        .hero-stats { gap: 1.5rem; flex-wrap: wrap; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <h1 class="hero-title">Mangiare è<br><em>Arte</em></h1>
        <p class="hero-subtitle">Where generations of Italian tradition meet the finest<br>ingredients — cooked with love, served with soul.</p>
        <div class="hero-actions">
            <a href="{{ route('reservations.create') }}" class="btn-terra">Reserve a Table</a>
            <a href="{{ route('menu') }}" class="btn-outline-terra" style="border-color:rgba(255,255,255,0.5);color:white">Explore the Menu</a>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <span class="num">37+</span>
                <span class="lbl">Years Open</span>
            </div>
            <div class="hero-stat">
                <span class="num">120+</span>
                <span class="lbl">Dishes & Wines</span>
            </div>
            <div class="hero-stat">
                <span class="num">50K+</span>
                <span class="lbl">Happy Guests</span>
            </div>
            <div class="hero-stat">
                <span class="num">4</span>
                <span class="lbl">Awards Won</span>
            </div>
        </div>
    </div>
    <div class="hero-scroll">Scroll</div>
</section>

{{-- RIBBON --}}
<div class="ribbon">
    <p>"La cucina è fatta di amore, di tradizione e di buona compagnia."</p>
</div>

{{-- WHY US --}}
<section class="why-section">
    <div style="text-align:center">
        <span class="section-tag">Why Manini</span>
        <h2 class="section-title">A Dining Experience<br>Like <em>No Other</em></h2>
        <div class="section-divider center"></div>
    </div>
    <div class="why-grid">
        <div class="why-card">
            <span class="why-icon">🧾</span>
            <h3>Family Recipes</h3>
            <p>Every sauce, every pasta, every dessert follows recipes passed down through three generations of the Russo family.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">🌿</span>
            <h3>Fresh Daily</h3>
            <p>Ingredients sourced each morning from local farms and direct importers in Calabria, Tuscany, and Sicily.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">🍷</span>
            <h3>300+ Wines</h3>
            <p>Our cellar holds over 300 Italian labels, personally curated by Sommelier Gianluca De Luca since 2001.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">🕯️</span>
            <h3>Intimate Setting</h3>
            <p>Just 60 seats in our candlelit dining room. Every table deserves — and receives — our full attention.</p>
        </div>
    </div>
</section>

{{-- FEATURED MENU --}}
@if($featuredItems->isNotEmpty())
<section class="featured-section">
    <span class="section-tag" style="text-align:center;display:block">Chef's Selections</span>
    <h2 class="section-title" style="text-align:center">Tonight's <em>Highlights</em></h2>
    <div class="section-divider center"></div>

    <div class="dishes-grid">
        @foreach($featuredItems as $item)
        <div class="dish-card">
            @if($item->image)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="dish-img">
            @else
            <div class="dish-img-placeholder">
                @switch($item->category->slug ?? '')
                    @case('pasta') 🍝 @break
                    @case('antipasti') 🥗 @break
                    @case('secondi') 🥩 @break
                    @case('dessert') 🍮 @break
                    @case('wine') 🍷 @break
                    @default 🍽️
                @endswitch
            </div>
            @endif
            <div class="dish-body">
                <div class="dish-cat">{{ $item->category->name ?? '' }}</div>
                <div class="dish-name">{{ $item->name }}</div>
                @if($item->description)
                <div class="dish-desc">{{ Str::limit($item->description, 100) }}</div>
                @endif
                <div class="dish-footer">
                    <span class="dish-price">{{ $item->formatted_price }}</span>
                    <form action="{{ route('order.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-terra" style="padding:0.45rem 1.1rem;font-size:0.68rem">+ Order</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="text-align:center;margin-top:3rem">
        <a href="{{ route('menu') }}" class="btn-outline-terra">View Full Menu</a>
    </div>
</section>
@endif

{{-- STORY --}}
<section class="story-section">
    <div class="story-visual">
        <div class="story-quote-box">
            <span class="story-quote-marks">"</span>
            <p class="story-quote">We don't just cook food. We cook memories, we cook love, we cook the Italy we left behind.</p>
            <span class="story-attr">— Nonna Rosa Russo, Founder</span>
        </div>
    </div>
    <div class="story-content">
        <div class="story-content-inner">
            <span class="section-tag">Our Story</span>
            <h2>From Naples<br>to <em>New York</em></h2>
            <p>In 1987, Rosa and Giovanni Russo left their small trattoria in Naples with nothing but their recipes, their knives, and a dream. They found a tiny space on Mulberry Street and opened Manini.</p>
            <p>Thirty-seven years later, their grandchildren still cook from the same notebooks. The dining room is fuller, the wine list is longer — but the soul remains the same.</p>
            <br>
            <a href="{{ route('about') }}" class="btn-outline-terra" style="border-color:rgba(255,255,255,0.4);color:rgba(255,255,255,0.8)">Read Our Story</a>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
@if($testimonials->isNotEmpty())
<section class="testimonials-section">
    <span class="section-tag" style="text-align:center;display:block">Guest Reviews</span>
    <h2 class="section-title" style="text-align:center">What Our Guests <em>Say</em></h2>
    <div class="section-divider center"></div>
    <div class="testimonials-grid">
        @foreach($testimonials as $t)
        <div class="testimonial">
            <div class="testimonial-stars">{{ str_repeat('★', $t->rating) }}</div>
            <p class="testimonial-text">{{ $t->content }}</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar">{{ substr($t->name, 0, 1) }}</div>
                <div>
                    <div class="testimonial-name">{{ $t->name }}</div>
                    <div class="testimonial-source">via {{ $t->source }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <h2>Join Us for an<br><em>Unforgettable</em> Evening</h2>
    <p>Whether it's a romantic dinner, a family celebration, or a business lunch — we'll make it memorable.</p>
    <a href="{{ route('reservations.create') }}" class="btn-terra" style="font-size:0.8rem;padding:1rem 3rem">Make a Reservation</a>
</section>

@endsection
