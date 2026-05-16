@extends('layouts.admin')

@section('title', 'Dashboard')

@section('extra_admin_styles')
<style>
    .activity-item {
        display: grid;
        grid-template-columns: auto 1fr auto auto;
        align-items: center;
        gap: 1.5rem;
        padding: 1.25rem;
        border-radius: 16px;
        transition: 0.3s;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: rgba(255, 255, 255, 0.03);
        transform: translateX(5px);
    }

    .customer-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0.05));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--primary);
        font-size: 1.1rem;
        border: 1px solid rgba(99, 102, 241, 0.2);
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-pending { background: rgba(245, 158, 11, 0.1); color: #fcd34d; }
    .status-pending::before { background: #f59e0b; }

    .status-confirmed { background: rgba(34, 197, 94, 0.1); color: #86efac; }
    .status-confirmed::before { background: #22c55e; }

    .status-delivered { background: rgba(99, 102, 241, 0.1); color: #a5b4fc; }
    .status-delivered::before { background: #6366f1; }

    .status-rejected { background: rgba(239, 68, 68, 0.1); color: #fca5a5; }
    .status-rejected::before { background: #ef4444; }

    @media (max-width: 640px) {
        .activity-item {
            grid-template-columns: auto 1fr;
            gap: 1rem;
        }
        .activity-status, .activity-amount {
            grid-column: 2;
            justify-self: start;
        }
    }
</style>
@endsection

@section('admin_content')
<div style="margin-bottom: 3rem;">
    <h2 style="font-size: 2.2rem; font-weight: 800; letter-spacing: -0.02em;">Dashboard</h2>
    <p style="color: var(--text-muted); font-size: 1.1rem; margin-top: 0.5rem;">Welcome back! Here's an overview of your bookstore.</p>
</div>

<!-- Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 4rem;">
    <div class="glass-card" style="padding: 2rem; position: relative; overflow: hidden;">
        <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem;">Total Revenue</div>
        <div style="font-size: 2.2rem; font-weight: 800; color: var(--success);">${{ number_format($stats['total_revenue'], 2) }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.03; transform: rotate(-15deg);"><i class="fas fa-dollar-sign"></i></div>
    </div>

    <div class="glass-card" style="padding: 2rem; position: relative; overflow: hidden;">
        <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem;">Available Books</div>
        <div style="font-size: 2.2rem; font-weight: 800;">{{ $stats['books'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.03; transform: rotate(-15deg);"><i class="fas fa-book"></i></div>
    </div>

    <div class="glass-card" style="padding: 2rem; position: relative; overflow: hidden;">
        <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem;">Total Orders</div>
        <div style="font-size: 2.2rem; font-weight: 800;">{{ $stats['orders'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.03; transform: rotate(-15deg);"><i class="fas fa-shopping-cart"></i></div>
    </div>

    <div class="glass-card" style="padding: 2rem; position: relative; overflow: hidden;">
        <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem;">New Messages</div>
        <div style="font-size: 2.2rem; font-weight: 800; color: var(--danger);">{{ $stats['pending_messages'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.03; transform: rotate(-15deg);"><i class="fas fa-envelope"></i></div>
    </div>
</div>
@endsection
