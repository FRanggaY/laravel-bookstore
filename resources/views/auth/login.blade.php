@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-container">
    <div class="glass-card" style="text-align: center;">
        <div style="margin-bottom: 2.5rem;">
            <i class="fas fa-book-reader" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h2 style="font-size: 2.2rem; font-weight: 800;">Welcome Back</h2>
            <p style="color: var(--text-muted);">Sign in to continue reading</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <i class="fas fa-user" style="position: absolute; left: 1.25rem; top: 1.1rem; color: var(--text-muted);"></i>
                <input type="text" name="username" class="form-control" style="padding-left: 3.5rem;" value="{{ old('username') }}" required autofocus placeholder="Username">
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <i class="fas fa-lock" style="position: absolute; left: 1.25rem; top: 1.1rem; color: var(--text-muted);"></i>
                <input type="password" name="password" class="form-control" style="padding-left: 3.5rem;" required placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.1rem; justify-content: center; font-size: 1rem;">
                Sign In
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--glass-border);">
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                New reader? <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Join BookStore</a>
            </p>
        </div>
    </div>
</div>
@endsection
