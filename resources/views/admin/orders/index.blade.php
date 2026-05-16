@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h2>Manage Orders</h2>
        <p style="color: var(--text-muted);">Monitor and update user orders.</p>
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Book</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td style="font-weight: 700;">#{{ $order->id }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $order->user->fullname }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->user->email }}</div>
                    </td>
                    <td>{{ $order->book->title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td style="color: var(--primary); font-weight: 700;">${{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <div style="font-size: 0.8rem; text-transform: uppercase;">{{ $order->payment_method }}</div>
                        @if($order->payment_proof)
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" style="font-size: 0.7rem; color: var(--accent);">View Proof</a>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">{{ $order->status }}</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control" style="padding: 0.4rem; font-size: 0.8rem; min-width: 120px;" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
