@extends('layouts.admin')

@section('title', 'Sales Reports')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h2>Sales Reports</h2>
        <p style="color: var(--text-muted);">In-depth analysis of your bookstore's performance.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 3rem;">
    <div class="glass-card" style="padding: 2rem; border-left: 4px solid var(--success);">
        <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Total Revenue</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--success);">${{ number_format($total_revenue, 2) }}</div>
    </div>
    <div class="glass-card" style="padding: 2rem; border-left: 4px solid var(--primary);">
        <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Total Orders</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">{{ $total_orders }}</div>
    </div>
</div>

<div class="glass-card" style="padding: 2.5rem;">
    <h3 style="margin-bottom: 2rem;">Sales Breakdown by Book</h3>
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Category</th>
                    <th>Copies Sold</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td style="font-weight: 700;">{{ $book->title }}</td>
                    <td><span class="badge badge-primary">{{ $book->category->name }}</span></td>
                    <td>{{ $book->orders_count }}</td>
                    <td style="color: var(--primary); font-weight: 700;">${{ number_format($book->orders_sum_total_price ?? 0, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
