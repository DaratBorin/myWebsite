@extends('layouts.app')
@section('title', 'Reserve a Table — Manini')

@push('styles')
<style>
    .reservations-wrap {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 5rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 6rem 4rem;
        align-items: start;
    }

    .reservations-info h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 400;
        color: var(--charcoal);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .reservations-info h2 em { color: var(--terracotta); }
    .reservations-info p { color: var(--warm-gray); font-size: 0.88rem; line-height: 1.9; margin-bottom: 2rem; }

    .res-detail {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding: 1.25rem;
        background: var(--cream);
        border-left: 3px solid var(--terracotta);
    }

    .res-detail-icon { font-size: 1.5rem; flex-shrink: 0; }
    .res-detail-title { font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 0.25rem; }
    .res-detail-text { font-size: 0.82rem; color: var(--warm-gray); line-height: 1.6; }

    .form-card {
        background: white;
        border: 1px solid var(--border);
        padding: 2.5rem;
    }

    .form-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--charcoal);
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    @media (max-width: 900px) {
        .reservations-wrap { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 1.5rem; }
        .form-grid-2 { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <p class="page-header-tag">Book Your Table</p>
    <h1>Make a <em style="font-style:italic;color:var(--terra-light)">Reservation</em></h1>
</div>

<div class="reservations-wrap">
    <div class="reservations-info">
        <span class="section-tag">Plan Your Visit</span>
        <h2>A Table<br><em>Awaits You</em></h2>
        <div class="section-divider"></div>
        <p>We'd love to welcome you. Whether it's a quiet dinner for two or a celebration with family, we'll make sure every detail is perfect.</p>

        <div class="res-detail">
            <span class="res-detail-icon">🕐</span>
            <div>
                <div class="res-detail-title">Dining Hours</div>
                <div class="res-detail-text">Wed–Thu 5–10 PM · Fri 5–11 PM<br>Sat 12–11 PM · Sun 12–9 PM</div>
            </div>
        </div>
        <div class="res-detail">
            <span class="res-detail-icon">👥</span>
            <div>
                <div class="res-detail-title">Large Parties</div>
                <div class="res-detail-text">For groups of 8 or more, please call us directly at +1 (212) 555-1234.</div>
            </div>
        </div>
        <div class="res-detail">
            <span class="res-detail-icon">🎂</span>
            <div>
                <div class="res-detail-title">Special Occasions</div>
                <div class="res-detail-text">Birthdays, anniversaries, proposals — mention it in your notes and we'll make it memorable.</div>
            </div>
        </div>
    </div>

    <div class="form-card">
        <h3>Reserve Your Table</h3>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">First Name *</label>
                    <input type="text" name="first_name" class="form-input" required value="{{ old('first_name') }}">
                    @error('first_name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Last Name *</label>
                    <input type="text" name="last_name" class="form-input" required value="{{ old('last_name') }}">
                    @error('last_name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Phone *</label>
                    <input type="tel" name="phone" class="form-input" required value="{{ old('phone') }}">
                    @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Date *</label>
                    <input type="date" name="date" class="form-input" required value="{{ old('date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    @error('date')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Time *</label>
                    <select name="time" class="form-select" required>
                        <option value="">Select time</option>
                        @foreach(['17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30'] as $t)
                        <option value="{{ $t }}" {{ old('time')===$t?'selected':'' }}>{{ date('g:i A', strtotime($t)) }}</option>
                        @endforeach
                    </select>
                    @error('time')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Guests *</label>
                    <select name="guests" class="form-select" required>
                        @for($i=1;$i<=8;$i++)
                        <option value="{{ $i }}" {{ old('guests')==$i?'selected':'' }}>{{ $i }} {{ $i===1?'Guest':'Guests' }}</option>
                        @endfor
                    </select>
                    @error('guests')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Occasion</label>
                    <select name="occasion" class="form-select">
                        <option value="">None / Not specified</option>
                        <option value="birthday" {{ old('occasion')==='birthday'?'selected':'' }}>Birthday</option>
                        <option value="anniversary" {{ old('occasion')==='anniversary'?'selected':'' }}>Anniversary</option>
                        <option value="proposal" {{ old('occasion')==='proposal'?'selected':'' }}>Proposal</option>
                        <option value="business" {{ old('occasion')==='business'?'selected':'' }}>Business Dinner</option>
                        <option value="other" {{ old('occasion')==='other'?'selected':'' }}>Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Special Requests</label>
                <textarea name="notes" class="form-textarea" style="min-height:80px" placeholder="Allergies, dietary requirements, seating preferences…">{{ old('notes') }}</textarea>
            </div>
            <button type="submit" class="btn-terra" style="width:100%;padding:1rem;font-size:0.8rem">Confirm Reservation</button>
        </form>
    </div>
</div>

@endsection
