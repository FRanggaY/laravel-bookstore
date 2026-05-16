@extends('layouts.admin')

@section('title', 'Add Contact')

@section('admin_content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h2 style="font-size: 2.2rem; font-weight: 800;">Contact</h2>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Record customer feedback.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="glass-card" style="padding: 3rem;">
        <form action="{{ route('admin.contacts.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" required placeholder="Customer Name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" required placeholder="Customer Email">
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="subject" class="form-control" required placeholder="Subject / Topic">
            </div>

            <div class="form-group">
                <textarea name="message" class="form-control" required style="min-height: 200px; padding: 1.25rem;" placeholder="Message Content..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.25rem; justify-content: center; font-size: 1.1rem; border-radius: 14px;">
                Save Entry
            </button>
        </form>
    </div>
</div>
@endsection
