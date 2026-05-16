@extends('layouts.app')

@section('title', 'Payment Confirmation')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div class="glass-card">
        <h1 style="margin-bottom: 2rem; font-size: 2rem; text-align: center;">Payment Confirmation</h1>

        <div style="background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem;">
            <p style="color: var(--text-muted); margin-bottom: 0.5rem;">Total Amount to Pay:</p>
            <h2 style="color: var(--primary); font-size: 2.5rem;">${{ number_format($order->total_price, 2) }}</h2>
        </div>

        <div style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem;">Bank Transfer Details</h3>
            <p style="color: var(--text-muted); line-height: 1.6;">
                Please transfer the total amount to the following account:<br>
                <strong>Bank Name:</strong> Global Bank<br>
                <strong>Account Number:</strong> 1234-5678-9012<br>
                <strong>Account Name:</strong> BookStore
            </p>
        </div>

        <form action="{{ route('orders.uploadProof', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="payment_proof">Upload Payment Proof (Image)</label>
                <input type="file" name="payment_proof" id="payment_proof" class="form-control" required accept="image/*">
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;">Max size: 2MB. Format: JPG, PNG.</p>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem;">
                Submit Payment Proof
            </button>
        </form>

        <a href="{{ route('orders.history') }}" style="display: block; text-align: center; margin-top: 1.5rem; color: var(--text-muted); text-decoration: none;">
            Cancel and Return to History
        </a>
    </div>
</div>
@endsection
