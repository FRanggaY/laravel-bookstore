@extends('layouts.app')

@section('title', 'Order History')

@section('styles')
<style>
    .history-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .order-list {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .order-card {
        background: var(--bg-card);
        border-radius: 24px;
        border: 1px solid var(--glass-border);
        overflow: hidden;
    }

    .order-header {
        padding: 1.5rem 2.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid var(--glass-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-id {
        font-weight: 700;
        color: var(--text-muted);
    }

    .order-body {
        padding: 2.5rem;
        display: grid;
        grid-template-columns: 100px 1fr auto;
        gap: 2rem;
        align-items: center;
    }

    .order-image {
        width: 100px;
        height: 140px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--glass-border);
    }

    .order-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .order-details h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .order-details p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .order-meta {
        text-align: right;
    }

    .order-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 99px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending { background: rgba(245, 158, 11, 0.2); color: #fcd34d; }
    .status-confirmed { background: rgba(34, 197, 94, 0.2); color: #86efac; }
    .status-rejected { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }
    .status-delivered { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; }

    @media (max-width: 768px) {
        .order-body {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .order-image {
            margin: 0 auto;
        }
        .order-meta {
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="history-container">
    <h1 style="margin-bottom: 3rem; font-size: 2.5rem;">Your Orders</h1>

    @if($orders->isEmpty())
        <div style="text-align: center; padding: 5rem 0;" class="glass-card">
            <i class="fas fa-box-open" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 2rem;"></i>
            <h2 style="color: var(--text-muted);">No orders found</h2>
            <p style="color: var(--text-muted); margin-top: 1rem;">You haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 2.5rem;">Browse Books</a>
        </div>
    @else
        <div class="order-list">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">ORDER #{{ $order->id }}</div>
                        <div class="order-date">{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</div>
                    </div>
                    <div class="order-body">
                        <div class="order-image">
                            <img src="{{ asset('storage/' . $order->book->image) }}" alt="{{ $order->book->title }}">
                        </div>
                        <div class="order-details">
                            <h3>{{ $order->book->title }}</h3>
                            <p>Quantity: {{ $order->quantity }}</p>
                            <p>Payment Method: <span style="text-transform: uppercase;">{{ $order->payment_method }}</span></p>
                            <p>Delivery to: {{ $order->address }}</p>
                        </div>
                        <div class="order-meta">
                            <div class="order-price">${{ number_format($order->total_price, 2) }}</div>
                            <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                            
                            @if($order->payment_method === 'transfer' && !$order->payment_proof)
                                <div style="margin-top: 1.5rem;">
                                    <a href="{{ route('orders.payment', $order->id) }}" class="btn btn-primary btn-sm" style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                                        Upload Proof
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
