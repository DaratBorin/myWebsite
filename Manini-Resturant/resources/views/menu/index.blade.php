@extends('layouts.app')
@section('title', 'Menu — Manini')

@push('styles')
<style>
    .menu-nav {
        background: var(--charcoal);
        padding: 0 4rem;
        display: flex;
        align-items: center;
        overflow-x: auto;
        border-top: 1px solid rgba(255,255,255,0.08);
        gap: 0;
        position: sticky;
        top: 65px;
        z-index: 100;
    }

    .menu-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1.1rem 1.6rem;
        color: rgba(255,255,255,0.45);
        text-decoration: none;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }

    .menu-tab:hover,
    .menu-tab.active { color: var(--terra-light); border-bottom-color: var(--terracotta); }

    .menu-section { padding: 5rem 4rem; max-width: 1280px; margin: 0 auto; }
    .menu-section + .menu-section { padding-top: 0; }

    .menu-section-head {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--border);
    }

    .menu-section-icon { font-size: 2rem; }

    .menu-section-head h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 400;
        color: var(--charcoal);
    }

    .menu-section-desc {
        font-style: italic;
        font-size: 0.82rem;
        color: var(--warm-gray);
        margin-left: auto;
    }

    .items-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .menu-item {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        padding: 1.5rem;
        background: white;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }

    .menu-item:hover { border-color: var(--terracotta); box-shadow: var(--shadow); }

    .menu-item-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 2px;
        flex-shrink: 0;
        background: var(--parchment);
    }

    .menu-item-img-placeholder {
        width: 90px;
        height: 90px;
        background: var(--cream);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
        border-radius: 2px;
    }

    .menu-item-body { flex: 1; }

    .menu-item-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--charcoal);
        margin-bottom: 0.35rem;
    }

    .menu-item-desc { font-size: 0.78rem; color: var(--warm-gray); line-height: 1.6; margin-bottom: 0.75rem; }

    .menu-item-tags { display: flex; flex-wrap: wrap; gap: 0.3rem; }

    .tag {
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.2rem 0.5rem;
        border-radius: 2px;
        border: 1px solid;
    }

    .tag-v   { border-color: #5c8a5c; color: #3d6b3d; background: #f0f7f0; }
    .tag-veg { border-color: #3d6b3d; color: #2a5c2a; background: #eaf5ea; }
    .tag-gf  { border-color: var(--terracotta); color: var(--terra-dark); background: #fdf0ea; }
    .tag-hot { border-color: #c0392b; color: #a93226; background: #fdf0f0; }

    .menu-item-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    .menu-item-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--terracotta);
        white-space: nowrap;
    }

    .add-btn {
        background: var(--terracotta);
        color: white;
        border: none;
        padding: 0.35rem 0.9rem;
        font-family: 'Lato', sans-serif;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s;
        border-radius: 2px;
    }

    .add-btn:hover { background: var(--terra-dark); }

    .allergen-note {
        text-align: center;
        padding: 2rem 4rem 5rem;
        font-size: 0.75rem;
        color: var(--warm-gray);
        font-style: italic;
        max-width: 800px;
        margin: 0 auto;
    }

    @media (max-width: 900px) {
        .items-grid { grid-template-columns: 1fr; }
        .menu-section { padding: 3rem 1.5rem; }
        .menu-nav { padding: 0 1.5rem; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <p class="page-header-tag">Manini · Menu</p>
    <h1>Our Menu</h1>
</div>

<nav class="menu-nav">
    <a href="{{ route('menu') }}" class="menu-tab active">All</a>
    @foreach($categories as $cat)
    <a href="{{ route('menu.category', $cat->slug) }}" class="menu-tab">{{ $cat->icon }} {{ $cat->name }}</a>
    @endforeach
</nav>

@foreach($categories as $category)
    @if($category->items->isNotEmpty())
    <div class="menu-section" id="{{ $category->slug }}">
        <div class="menu-section-head">
            <span class="menu-section-icon">{{ $category->icon }}</span>
            <h2>{{ $category->name }}</h2>
            @if($category->description)
            <span class="menu-section-desc">{{ $category->description }}</span>
            @endif
        </div>
        <div class="items-grid">
            @foreach($category->items as $item)
            <div class="menu-item">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="menu-item-img">
                @else
                <div class="menu-item-img-placeholder">{{ $category->icon ?? '🍽️' }}</div>
                @endif

                <div class="menu-item-body">
                    <div class="menu-item-name">{{ $item->name }}</div>
                    @if($item->description)
                    <div class="menu-item-desc">{{ $item->description }}</div>
                    @endif
                    <div class="menu-item-tags">
                        @if($item->vegetarian) <span class="tag tag-v">Vegetarian</span> @endif
                        @if($item->vegan)      <span class="tag tag-veg">Vegan</span>     @endif
                        @if($item->gluten_free)<span class="tag tag-gf">Gluten Free</span>@endif
                        @if($item->spicy_level > 0)<span class="tag tag-hot">{{ str_repeat('🌶', $item->spicy_level) }}</span>@endif
                    </div>
                </div>

                <div class="menu-item-right">
                    <div class="menu-item-price">{{ $item->formatted_price }}</div>
                    <form action="{{ route('order.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-btn">+ Add</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
@endforeach

<p class="allergen-note">
    Please inform your server of any allergies or dietary requirements before ordering. All prices in USD, exclude tax and gratuity. Our kitchen handles nuts, gluten, dairy, eggs, and shellfish.
</p>

@endsection
