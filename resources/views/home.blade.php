@extends('layouts.app')

@section('title', 'Welcome to BookStore')

@section('styles')
<style>
    .hero {
        text-align: center;
        padding: 4rem 0 6rem;
        background-image: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        background: linear-gradient(to right, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero p {
        font-size: 1.2rem;
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto 3rem;
        line-height: 1.6;
    }

    .search-bar {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        gap: 1rem;
        background: rgba(255, 255, 255, 0.05);
        padding: 0.5rem;
        border-radius: 16px;
        border: 1px solid var(--glass-border);
    }

    .search-bar input {
        flex: 1;
        background: transparent;
        border: none;
        color: white;
        padding: 0 1.5rem;
        font-size: 1rem;
        outline: none;
    }

    .filter-section {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 4rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 99px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--glass-border);
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
    }

    .filter-btn:hover, .filter-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
    }

    .book-card {
        background: var(--bg-card);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid var(--glass-border);
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: rgba(99, 102, 241, 0.4);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.6);
    }

    .book-image {
        height: 380px;
        position: relative;
        overflow: hidden;
    }

    .book-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .book-card:hover .book-image img {
        transform: scale(1.1);
    }

    .book-badge {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(8px);
        padding: 0.4rem 1rem;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--accent);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .book-info {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
    }

    .book-author {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .book-stock {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .book-actions {
        padding: 0 1.5rem 1.5rem;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 0.75rem;
    }
</style>
@endsection

@section('content')
<section class="hero">
    <h1>Lorem ipsum, dolor</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, laborum..</p>

    <form action="{{ route('home') }}" method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search by title, author, or keyword..." value="{{ request('search') }}">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</section>

<div class="filter-section">
    <a href="{{ route('home', ['search' => request('search')]) }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">All Categories</a>
    @foreach($categories as $category)
        <a href="{{ route('home', ['category' => $category->id, 'search' => request('search')]) }}"
           class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
            {{ $category->name }}
        </a>
    @endforeach
</div>

@if($books->isEmpty())
    <div style="text-align: center; padding: 5rem 0;">
        <i class="fas fa-search" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1.5rem;"></i>
        <h2 style="color: var(--text-muted);">No books found matching your criteria.</h2>
        <a href="{{ route('home') }}" class="btn btn-outline" style="margin-top: 1.5rem;">Clear Filters</a>
    </div>
@else
    <div class="book-grid">
        @foreach($books as $book)
            <div class="book-card">
                <div class="book-image">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                    <div class="book-badge">{{ $book->category->name }}</div>
                </div>
                <div class="book-info">
                    <h3 class="book-title">{{ $book->title }}</h3>
                    <p class="book-author">by {{ $book->author }}</p>
                    <div class="book-price">
                        ${{ number_format($book->price, 2) }}
                        <span class="book-stock">{{ $book->stock }} in stock</span>
                    </div>
                </div>
                <div class="book-actions">
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline">Details</a>
                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 4rem; display: flex; justify-content: center;">
        {{ $books->appends(request()->query())->links() }}
    </div>
@endif
@endsection
