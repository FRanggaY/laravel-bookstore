@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-container">
    <div class="glass-card" style="text-align: center;">
        <div style="margin-bottom: 2.5rem;">
            <i class="fas fa-user-plus" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h2 style="font-size: 2.2rem; font-weight: 800;">Join BookStore</h2>
            <p style="color: var(--text-muted);">Create your account to start reading</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}" required placeholder="Full Name">
            </div>

            <div class="form-group">
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required placeholder="Username">
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Email Address">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.1rem; justify-content: center; font-size: 1rem;">
                Create Account
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--glass-border);">
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Sign in here</a>
            </p>
        </div>
    </div>
</div>
@endsection
