@extends('layouts.app')

@section('styles')
<style>
    .admin-nav {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 0.5rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .admin-nav::-webkit-scrollbar {
        display: none;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem 1.5rem;
        color: var(--text-muted);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .nav-item i {
        font-size: 1rem;
        opacity: 0.7;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-main);
    }

    .nav-item.active {
        background: var(--primary);
        color: white;
        box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.5);
    }

    .nav-item.active i {
        opacity: 1;
    }

    .admin-content-wrapper {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Standard Table for all admin pages */
    .table-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        overflow: hidden;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        background: rgba(255, 255, 255, 0.02);
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        border-bottom: 1px solid var(--glass-border);
    }

    .admin-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--glass-border);
        font-size: 0.95rem;
    }

    .admin-table tr:last-child td {
        border-bottom: none;
    }

    .admin-table tr:hover td {
        background: rgba(255, 255, 255, 0.01);
    }

    @media (max-width: 768px) {
        .admin-nav {
            padding: 0.4rem;
        }
        .nav-item {
            padding: 0.7rem 1.1rem;
            font-size: 0.85rem;
        }
    }
</style>
@yield('extra_admin_styles')
@endsection

@section('content')
<div class="admin-nav">
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-pie"></i> Overview
    </a>
    <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i> Categories
    </a>
    <a href="{{ route('admin.books.index') }}" class="nav-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
        <i class="fas fa-book"></i> Books
    </a>
    <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-receipt"></i> Orders
    </a>
    <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-user-shield"></i> Users
    </a>
    <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
        <i class="fas fa-inbox"></i> Messages
    </a>
</div>

<div class="admin-content-wrapper">
    @yield('admin_content')
</div>
@endsection
