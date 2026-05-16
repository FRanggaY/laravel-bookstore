@extends('layouts.admin')

@section('title', 'User Messages')

@section('admin_content')
<div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h2 style="font-size: 2.2rem; font-weight: 800;">User Messages</h2>
        <p style="color: var(--text-muted);">Manage inquiries and feedback from your customers.</p>
    </div>
    <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Data
    </a>
</div>

<div class="table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Subject</th>
                <th>Message Content</th>
                <th>Status</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>
                        <div style="font-weight: 700;">{{ $contact->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $contact->email }}</div>
                    </td>
                    <td style="font-weight: 600;">{{ $contact->subject }}</td>
                    <td>
                        <div style="max-width: 350px; font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">
                            {{ $contact->message }}
                        </div>
                        <div style="font-size: 0.75rem; color: var(--primary); margin-top: 0.5rem; font-weight: 600;">
                            <i class="far fa-clock"></i> {{ $contact->created_at->diffForHumans() }}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ $contact->status === 'pending' ? 'pending' : 'success' }}" style="background: {{ $contact->status === 'pending' ? 'rgba(245, 158, 11, 0.15)' : 'rgba(34, 197, 94, 0.15)' }}; color: {{ $contact->status === 'pending' ? '#fcd34d' : '#86efac' }};">
                            {{ $contact->status }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                            @if($contact->status === 'pending')
                                <form action="{{ route('admin.contacts.status', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline btn-sm" title="Mark as Resolved" style="color: var(--success); border-color: rgba(34, 197, 94, 0.3);">
                                        <i class="fas fa-check"></i> Resolve
                                    </button>
                                </form>
                            @else
                                <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; padding: 0.5rem 1rem;">
                                    <i class="fas fa-check-double"></i> Handled
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
