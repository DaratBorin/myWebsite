@extends('layouts.app')
@section('title', 'Our Story — Manini')

@push('styles')
<style>
    .about-hero {
        background: var(--charcoal);
        padding: 140px 4rem 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(196,98,45,0.12) 0%, transparent 70%);
    }

    .about-section {
        padding: 6rem 4rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    .about-grid.reverse { direction: rtl; }
    .about-grid.reverse > * { direction: ltr; }

    .about-visual {
        background: linear-gradient(135deg, var(--terracotta), var(--terra-dark));
        aspect-ratio: 4/3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        border-radius: 4px;
        position: relative;
        overflow: hidden;
    }

    .about-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(-45deg, transparent 0, transparent 15px, rgba(255,255,255,0.04) 15px, rgba(255,255,255,0.04) 16px);
    }

    .about-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 400;
        color: var(--charcoal);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .about-text h2 em { color: var(--terracotta); }

    .about-text p {
        color: var(--warm-gray);
        font-size: 0.9rem;
        line-height: 1.9;
        margin-bottom: 1rem;
    }

    .team-section {
        background: var(--cream);
        padding: 6rem 4rem;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
        max-width: 1000px;
        margin: 4rem auto 0;
    }

    .team-card {
        text-align: center;
        padding: 2.5rem 2rem;
        background: var(--ivory);
        border: 1px solid var(--border);
    }

    .team-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--terracotta), var(--wine));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: white;
        margin: 0 auto 1.5rem;
    }

    .team-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--charcoal);
        margin-bottom: 0.25rem;
    }

    .team-role {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: 1rem;
    }

    .team-bio { font-size: 0.8rem; color: var(--warm-gray); line-height: 1.7; }

    .awards-section {
        padding: 6rem 4rem;
        background: var(--charcoal);
        text-align: center;
    }

    .awards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1000px;
        margin: 4rem auto 0;
    }

    .award-card {
        padding: 2rem 1.5rem;
        border: 1px solid rgba(255,255,255,0.08);
        transition: border-color 0.3s;
    }

    .award-card:hover { border-color: var(--terracotta); }

    .award-icon { font-size: 2.5rem; margin-bottom: 1rem; display: block; }

    .award-title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-weight: 500;
        color: white;
        margin-bottom: 0.35rem;
    }

    .award-year { font-size: 0.72rem; color: var(--terracotta); font-weight: 700; }

    @media (max-width: 900px) {
        .about-grid, .about-grid.reverse { grid-template-columns: 1fr; gap: 3rem; direction: ltr; }
        .team-grid { grid-template-columns: 1fr; }
        .awards-grid { grid-template-columns: repeat(2, 1fr); }
        .about-section, .team-section, .awards-section { padding: 4rem 1.5rem; }
    }
</style>
@endpush

@section('content')

<div class="about-hero">
    <p class="page-header-tag" style="position:relative">Manini · Since 1987</p>
    <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2.5rem,6vw,5rem);font-weight:400;color:white;line-height:1.1;position:relative">Our <em style="color:var(--terra-light);font-style:italic">Story</em></h1>
</div>

{{-- Origin --}}
<section class="about-section">
    <div class="about-grid">
        <div class="about-visual">🍝</div>
        <div class="about-text">
            <span class="section-tag">How It Began</span>
            <h2>A Dream from <em>Naples</em></h2>
            <div class="section-divider"></div>
            <p>In 1987, Rosa and Giovanni Russo packed their most prized possessions — three handwritten recipe notebooks, a set of copper pans, and an unshakeable belief in the power of good food — and boarded a flight to New York.</p>
            <p>They found a 600-square-foot space on Mulberry Street in Little Italy, painted it terracotta red, hung a string of lights, and opened Manini on a rainy Tuesday in November.</p>
            <p>That first week, they served 12 covers. By December, there was a waiting list.</p>
        </div>
    </div>
</section>

{{-- Philosophy --}}
<section style="background:var(--cream);padding:6rem 4rem">
    <div style="max-width:1200px;margin:0 auto">
        <div class="about-grid reverse">
            <div class="about-text">
                <span class="section-tag">Our Philosophy</span>
                <h2>Simple Ingredients,<br><em>Extraordinary</em> Care</h2>
                <div class="section-divider"></div>
                <p>We don't believe in complicated techniques or exotic ingredients. We believe in finding the best tomatoes, the freshest pasta, the most fragrant basil — and letting them speak for themselves.</p>
                <p>Every sauce on our menu has been made the same way for over three decades. Not because we lack imagination, but because when something is perfect, you leave it alone.</p>
                <p>Our pasta is made by hand each morning. Our bread is baked before the kitchen opens. Our olive oil comes from a single family estate in Calabria that the Russos have used since day one.</p>
            </div>
            <div class="about-visual">🫙</div>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="team-section">
    <div style="text-align:center">
        <span class="section-tag">The People Behind the Food</span>
        <h2 class="section-title">Meet Our <em>Team</em></h2>
        <div class="section-divider center"></div>
    </div>
    <div class="team-grid">
        <div class="team-card">
            <div class="team-avatar">M</div>
            <div class="team-name">Marco Russo</div>
            <div class="team-role">Executive Chef</div>
            <p class="team-bio">Rosa's grandson. Trained in Rome and Lyon before returning to take over the kitchen. Keeps every recipe exactly as written in Nonna's notebooks.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">G</div>
            <div class="team-name">Gianluca De Luca</div>
            <div class="team-role">Head Sommelier</div>
            <p class="team-bio">Managing our cellar since 2001. Personally sources wines from small producers across Italy on his annual summer trip.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">S</div>
            <div class="team-name">Sofia Martinelli</div>
            <div class="team-role">Front of House</div>
            <p class="team-bio">Has been greeting guests at the door for 18 years. Remembers the name — and the preferred table — of nearly every regular.</p>
        </div>
    </div>
</section>

{{-- Awards --}}
<section class="awards-section">
    <span class="section-tag" style="color:var(--terracotta)">Recognition</span>
    <h2 style="font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3rem);font-weight:400;color:white;margin-top:0.5rem">Awards & <em style="color:var(--terra-light)">Honours</em></h2>
    <div class="awards-grid">
        <div class="award-card">
            <span class="award-icon">🏆</span>
            <div class="award-title">Best Italian Restaurant NYC</div>
            <div class="award-year">Zagat Guide · 2023</div>
        </div>
        <div class="award-card">
            <span class="award-icon">⭐</span>
            <div class="award-title">Bib Gourmand</div>
            <div class="award-year">Michelin Guide · 2022</div>
        </div>
        <div class="award-card">
            <span class="award-icon">🍷</span>
            <div class="award-title">Wine Spectator Award</div>
            <div class="award-year">Excellence · 2021</div>
        </div>
        <div class="award-card">
            <span class="award-icon">🌿</span>
            <div class="award-title">Sustainable Restaurant</div>
            <div class="award-year">Green Tables · 2023</div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="padding:6rem 4rem;text-align:center;background:var(--ivory)">
    <span class="section-tag">Come Visit Us</span>
    <h2 class="section-title">Experience the Story <em>Yourself</em></h2>
    <div class="section-divider center"></div>
    <p style="color:var(--warm-gray);font-size:0.9rem;max-width:500px;margin:0 auto 2.5rem">Every plate tells a story. Every visit becomes a memory. We'd love to welcome you to our table.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('reservations.create') }}" class="btn-terra">Reserve a Table</a>
        <a href="{{ route('menu') }}" class="btn-outline-terra">View Our Menu</a>
    </div>
</section>

@endsection
