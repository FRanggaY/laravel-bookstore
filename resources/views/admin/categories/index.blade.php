@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('admin_content')
<div style="margin-bottom: 2.5rem;">
    <h2 style="font-size: 2.2rem; font-weight: 800;">Categories</h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 3rem;">
    <!-- Form Side -->
    <div>
        <div class="glass-card" style="padding: 2rem; position: sticky; top: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">
                {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
            </h3>

            <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="{{ isset($category) ? $category->name : old('name') }}" required placeholder="Category Name (e.g. Fiction)">
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                        {{ isset($category) ? 'Update' : 'Save Category' }}
                    </button>
                    @if(isset($category))
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Table Side -->
    <div>
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Total Books</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $item)
                        <tr style="{{ isset($category) && $category->id == $item->id ? 'background: rgba(99, 102, 241, 0.05);' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td style="font-weight: 700;">{{ $item->name }}</td>
                            <td>
                                <span style="color: var(--text-muted);">{{ $item->books_count ?? $item->books()->count() }}</span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('admin.categories.edit', $item->id) }}" class="btn btn-outline btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this category and all associated books?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm" style="color: var(--danger);" title="Delete">
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
    </div>
</div>
@endsection
