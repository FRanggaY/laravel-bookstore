@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div style="max-width: 800px; margin: 2rem auto;">
    <div class="glass-card" style="text-align: center; padding: 4rem 2rem;">
        <i class="fas fa-info-circle" style="font-size: 4rem; color: var(--primary); margin-bottom: 2rem;"></i>
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 1.5rem;">About BookStore</h1>
        <p style="font-size: 1.2rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem;">
            BookStore in <strong>2026</strong>.
        </p>
        <p style="font-size: 1.1rem; color: var(--text-muted); line-height: 1.8;">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste earum saepe recusandae eos quae obcaecati dolorum ea cumque modi dolorem quisquam natus doloremque, corporis non nulla error enim autem assumenda.
        </p>
    </div>
</div>
@endsection
