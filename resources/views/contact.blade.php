@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 3rem; font-weight: 800;">Get in Touch</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; margin-top: 0.5rem;">Lorem ipsum dolor sit amet..</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 3rem;">
        <div>
            <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem;">Contact Info</h3>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--primary); font-size: 1.2rem;"></i>
                        <div>
                            <p style="font-weight: 600;">Location</p>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">Indonesia</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-envelope" style="color: var(--primary); font-size: 1.2rem;"></i>
                        <div>
                            <p style="font-weight: 600;">Email</p>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">support@bookstore.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ Auth::check() ? Auth::user()->fullname : old('name') }}" required {{ Auth::check() ? 'readonly' : '' }}>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required {{ Auth::check() ? 'readonly' : '' }}>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" style="min-height: 150px; padding: 1.1rem;" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.1rem; justify-content: center;">
                    Send Message <i class="fas fa-paper-plane" style="margin-left: 0.5rem;"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
