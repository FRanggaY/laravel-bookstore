@extends('layouts.admin')

@section('title', 'Manage Books')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h2>Manage Books</h2>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary" style="margin-top: 0.5rem;">
        <i class="fas fa-plus"></i> Add New Book
    </a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title & Author</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="" style="width: 50px; height: 70px; object-fit: cover; border-radius: 6px;">
                    </td>
                    <td>
                        <div style="font-weight: 700;">{{ $book->title }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $book->author }}</div>
                    </td>
                    <td>
                        <span class="badge badge-primary">{{ $book->category->name }}</span>
                    </td>
                    <td style="color: var(--primary); font-weight: 700;">${{ number_format($book->price, 2) }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-sm" style="color: var(--danger);">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
