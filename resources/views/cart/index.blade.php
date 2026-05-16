@extends('layouts.app')

@section('title', 'Your Shopping Cart')

@section('styles')
<style>
    .cart-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .cart-item {
        background: var(--bg-card);
        padding: 1.5rem;
        border-radius: 20px;
        border: 1px solid var(--glass-border);
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .item-image {
        width: 100px;
        height: 140px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-info {
        flex-grow: 1;
    }

    .item-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: white;
    }

    .item-author {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .item-controls {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        background: rgba(15, 23, 42, 0.6);
        border-radius: 10px;
        border: 1px solid var(--glass-border);
        padding: 0.25rem;
    }

    .quantity-control input {
        width: 50px;
        text-align: center;
        background: transparent;
        border: none;
        color: white;
        font-weight: 600;
        outline: none;
    }

    .item-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .summary-card {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--glass-border);
    }

    .summary-total {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        border-bottom: none;
    }

    @media (max-width: 992px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
        .summary-card {
            position: static;
        }
    }
</style>
@endsection

@section('content')
<div class="cart-container">
    <h1 style="margin-bottom: 3rem; font-size: 2.5rem;">Your Cart</h1>

    @if($cartItems->isEmpty())
        <div style="text-align: center; padding: 5rem 0;" class="glass-card">
            <i class="fas fa-shopping-basket" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 2rem;"></i>
            <h2 style="color: var(--text-muted);">Your cart is empty</h2>
            <p style="color: var(--text-muted); margin-top: 1rem;">Looks like you haven't added any books to your cart yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 2.5rem;">Start Shopping</a>
        </div>
    @else
        <div class="cart-grid">
            <div class="cart-items">
                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ asset('storage/' . $item->book->image) }}" alt="{{ $item->book->title }}">
                        </div>
                        <div class="item-info">
                            <h3 class="item-title">{{ $item->book->title }}</h3>
                            <p class="item-author">by {{ $item->book->author }}</p>

                            <div class="item-controls">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-control">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock }}" onchange="this.form.submit()">
                                </form>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; font-size: 0.9rem; font-weight: 600;">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="item-price">
                            ${{ number_format($item->book->price * $item->quantity, 2) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="summary-card glass-card">
                <h3 style="margin-bottom: 2rem;">Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <form action="{{ route('orders.store') }}" method="POST" style="margin-top: 2rem;">
                    @csrf
                    <div class="form-group">
                        <label for="address">Delivery Address</label>
                        <textarea name="address" id="address" class="form-control" required placeholder="Enter your full delivery address..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="cod">Payment at Delivery (COD)</option>
                            <option value="transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1.25rem;">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
