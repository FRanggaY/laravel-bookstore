@extends('layouts.admin')

@section('title', 'Registered Users')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h2>Registered Users</h2>
        <p style="color: var(--text-muted);">List of all users registered in the system.</p>
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="font-weight: 700;">{{ $user->fullname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-primary' : 'badge-outline' }}" style="border: 1px solid var(--glass-border);">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td style="color: var(--text-muted); font-size: 0.9rem;">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
