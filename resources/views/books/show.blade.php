@extends('layouts.app')

@section('title', $book->title)

@section('styles')
<style>
    .book-details-container {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 400px 1fr;
        gap: 4rem;
        background: var(--bg-card);
        padding: 4rem;
        border-radius: 32px;
        border: 1px solid var(--glass-border);
    }

    .book-detail-image {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--glass-border);
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5);
    }

    .book-detail-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .book-detail-info h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .book-detail-author {
        font-size: 1.5rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .book-detail-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 2rem;
    }

    .book-detail-desc {
        color: var(--text-muted);
        line-height: 1.8;
        font-size: 1.1rem;
        margin-bottom: 3rem;
    }

    .book-detail-meta {
        display: flex;
        gap: 3rem;
        margin-bottom: 3rem;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        border: 1px solid var(--glass-border);
    }

    .meta-item h4 {
        color: var(--text-muted);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .meta-item p {
        font-size: 1.1rem;
        font-weight: 700;
    }

    @media (max-width: 992px) {
        .book-details-container {
            grid-template-columns: 1fr;
            padding: 2rem;
        }
        .book-detail-image {
            max-width: 400px;
            margin: 0 auto;
        }
    }
</style>
@endsection

@section('content')
<div class="book-details-container">
    <div class="book-detail-image">
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
    </div>
    <div class="book-detail-info">
        <div class="badge badge-primary" style="margin-bottom: 1.5rem;">{{ $book->category->name }}</div>
        <h1>{{ $book->title }}</h1>
        <p class="book-detail-author">by {{ $book->author }}</p>
        
        <div class="book-detail-price">${{ number_format($book->price, 2) }}</div>
        
        <div class="book-detail-meta">
            <div class="meta-item">
                <h4>Stock Available</h4>
                <p>{{ $book->stock }} units</p>
            </div>
            <div class="meta-item">
                <h4>Condition</h4>
                <p>Brand New</p>
            </div>
            <div class="meta-item">
                <h4>Shipping</h4>
                <p>Worldwide</p>
            </div>
        </div>

        <div class="book-detail-desc">
            {{ $book->description }}
        </div>

        <div style="display: flex; gap: 1rem;">
            <form action="{{ route('cart.add', $book->id) }}" method="POST" style="flex-grow: 1;">
                @csrf
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1.25rem;" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </form>
            <a href="{{ route('home') }}" class="btn btn-outline" style="padding: 1.25rem;">
                Back to Library
            </a>
        </div>
    </div>
</div>
@endsection
