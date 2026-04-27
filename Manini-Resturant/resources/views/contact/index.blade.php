@extends('layouts.app')
@section('title', 'Contact — Manini')

@push('styles')
<style>
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 5rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 6rem 4rem;
        align-items: start;
    }

    .contact-info h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 400;
        color: var(--charcoal);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .contact-info h2 em { color: var(--terracotta); }
    .contact-info p { color: var(--warm-gray); font-size: 0.88rem; line-height: 1.9; margin-bottom: 2.5rem; }

    .info-item {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .info-icon {
        width: 48px; height: 48px;
        background: var(--cream);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        border-radius: 2px;
    }

    .info-label {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: 0.3rem;
    }

    .info-value { font-size: 0.88rem; color: var(--charcoal); line-height: 1.6; }
    .info-value a { color: var(--charcoal); text-decoration: none; }
    .info-value a:hover { color: var(--terracotta); }

    .contact-form-card {
        background: white;
        border: 1px solid var(--border);
        padding: 2.5rem;
    }

    .contact-form-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--charcoal);
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    .form-type-tabs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        margin-bottom: 2rem;
        border: 1px solid var(--border);
        border-radius: 2px;
        overflow: hidden;
    }

    .form-tab {
        padding: 0.85rem;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s;
        background: var(--cream);
        color: var(--warm-gray);
        border: none;
        border-right: 1px solid var(--border);
    }

    .form-tab:last-child { border-right: none; }
    .form-tab.active { background: var(--terracotta); color: white; }
    .form-tab:hover:not(.active) { background: var(--parchment); }

    .star-rating { display:flex; justify-content:center; gap:0.5rem; margin-bottom:0.5rem; }
    .star { font-size:2.5rem; color:#E8DDD0; cursor:pointer; transition:color 0.15s; line-height:1; }
    .star.lit { color:#C4622D; }

    .tab-section { display: none; }
    .tab-section.active { display: block; }

    .section-divider-sm {
        width: 40px;
        height: 2px;
        background: var(--terracotta);
        margin: 0.75rem 0 1.5rem;
    }

    @media (max-width: 900px) {
        .contact-grid { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 1.5rem; }
        .form-grid-2 { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <p class="page-header-tag">Get in Touch</p>
    <h1>Contact <em style="font-style:italic;color:var(--terra-light)">Us</em></h1>
</div>

<div class="contact-grid">

    {{-- LEFT: CONTACT INFO --}}
    <div class="contact-info">
        <span class="section-tag">We'd Love to Hear from You</span>
        <h2>Visit, Call,<br>or <em>Write</em></h2>
        <div class="section-divider"></div>
        <p>Whether you have a question about our menu, need help with a reservation, or want to share your dining experience — we're here for you.</p>

        <div class="info-item">
            <div class="info-icon">📍</div>
            <div>
                <div class="info-label">Address</div>
                <div class="info-value">123 Gourmet Avenue<br>New York, NY 10001</div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">📞</div>
            <div>
                <div class="info-label">Phone</div>
                <div class="info-value"><a href="tel:+12125551234">+1 (212) 555-1234</a></div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">✉️</div>
            <div>
                <div class="info-label">Email</div>
                <div class="info-value"><a href="mailto:info@manini.com">info@manini.com</a></div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">🕐</div>
            <div>
                <div class="info-label">Hours</div>
                <div class="info-value">
                    Mon–Tue: Closed<br>
                    Wed–Thu: 5 PM – 10 PM<br>
                    Fri: 5 PM – 11 PM<br>
                    Sat: 12 PM – 11 PM<br>
                    Sun: 12 PM – 9 PM
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: COMBINED FORM --}}
    <div class="contact-form-card">
        <h3>Send Us a Message</h3>

        @if(session('success'))
        <div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;padding:1rem 1.25rem;border-radius:2px;margin-bottom:1.5rem;font-size:0.85rem">
            ✅ {{ session('success') }}
        </div>
        @endif

        @if(session('feedback_success'))
        <div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;padding:1rem 1.25rem;border-radius:2px;margin-bottom:1.5rem;font-size:0.85rem">
            ✅ {{ session('feedback_success') }}
        </div>
        @endif

        {{-- TABS --}}
        <div class="form-type-tabs">
            <button class="form-tab active" onclick="switchTab('enquiry', this)">✉️ Enquiry</button>
            <button class="form-tab" onclick="switchTab('feedback', this)">⭐ Feedback</button>
        </div>

        {{-- ENQUIRY FORM --}}
        <div class="tab-section active" id="tab-enquiry">
            <form action="{{ route('contact.send') }}" method="POST">
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
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <select name="subject" class="form-select">
                        <option value="">Select a topic</option>
                        <option value="reservation">Reservation Enquiry</option>
                        <option value="private">Private Dining / Events</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Message *</label>
                    <textarea name="message" class="form-textarea" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                    @error('message')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn-terra" style="width:100%;padding:1rem;font-size:0.8rem">Send Message</button>
            </form>
        </div>

        {{-- FEEDBACK FORM --}}
        <div class="tab-section" id="tab-feedback">
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                {{-- STAR RATING --}}
                <div class="form-group" style="text-align:center;margin-bottom:1.5rem">
                    <label class="form-label" style="display:block;text-align:center;margin-bottom:0.75rem">Your Rating *</label>
                    <div class="star-rating" id="starRating">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}" onclick="setRating({{ $i }})" onmouseover="hoverRating({{ $i }})" onmouseout="resetHover()">★</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="0">
                    @error('rating')<span class="field-error" style="display:block;text-align:center">{{ $message }}</span>@enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-input" required value="{{ old('name') }}">
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email (optional)</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-select">
                        <option value="general">General Experience</option>
                        <option value="food">Food & Menu</option>
                        <option value="service">Service & Staff</option>
                        <option value="ambiance">Ambiance & Setting</option>
                        <option value="suggestion">Suggestion</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Your Feedback *</label>
                    <textarea name="message" class="form-textarea" required placeholder="Tell us what you think...">{{ old('message') }}</textarea>
                    @error('message')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn-terra" style="width:100%;padding:1rem;font-size:0.8rem">Submit Feedback</button>
            </form>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
let currentRating = 0;

function switchTab(tab, btn) {
    document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.form-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}

function setRating(val) {
    currentRating = val;
    document.getElementById('ratingInput').value = val;
    updateStars(val);
}

function hoverRating(val) {
    updateStars(val);
}

function resetHover() {
    updateStars(currentRating);
}

function updateStars(val) {
    document.querySelectorAll('.star').forEach((s, i) => {
        s.classList.toggle('lit', i < val);
    });
}
</script>
@endpush