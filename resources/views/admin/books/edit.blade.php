@extends('layouts.admin')

@section('title', 'Edit Book')

@section('admin_content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h2 style="font-size: 2.2rem; font-weight: 800;">Edit Book</h2>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Update <strong>{{ $book->title }}</strong></p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="glass-card" style="padding: 3rem;">
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <input type="text" name="title" class="form-control" required value="{{ $book->title }}" placeholder="Book Title">
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <input type="text" name="author" class="form-control" required value="{{ $book->author }}" placeholder="Author">
                </div>
                <div class="form-group">
                    <select name="category_id" class="form-control" required style="appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2394a3b8%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1.25rem center; background-size: 0.65rem auto; padding-right: 3rem;">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <input type="number" name="price" class="form-control" required step="0.01" value="{{ $book->price }}" placeholder="Price">
                </div>
                <div class="form-group">
                    <input type="number" name="stock" class="form-control" required value="{{ $book->stock }}" placeholder="Stock">
                </div>
            </div>

            <div class="form-group">
                <textarea name="description" class="form-control" required style="min-height: 150px; padding: 1.25rem;">{{ $book->description }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr auto; gap: 2rem; margin-bottom: 3rem; align-items: end;">
                <div class="form-group" style="margin-bottom: 0;">
                    <div style="border: 2px dashed var(--glass-border); border-radius: 14px; padding: 1.5rem; background: rgba(255,255,255,0.02);">
                        <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" style="border: none; background: transparent; padding: 0;">
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.5rem;">Update Cover Image</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 2rem; align-items: center;">
                    <div style="text-align: center;">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="" style="width: 70px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid var(--glass-border); opacity: 0.5;">
                        <p style="font-size: 0.6rem; color: var(--text-muted); margin-top: 0.25rem;">Current</p>
                    </div>
                    
                    <div id="imagePreview" style="display: none; text-align: center;">
                        <img id="previewImg" src="#" alt="" style="width: 70px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid var(--primary);">
                        <p style="font-size: 0.6rem; color: var(--primary); margin-top: 0.25rem; font-weight: 700;">New</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.25rem; justify-content: center; font-size: 1.1rem; border-radius: 14px;">
                Update Book
            </button>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = document.getElementById('previewImg');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection
@endsection
