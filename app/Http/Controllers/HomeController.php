<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('author', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('home', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function about()
    {
        return view('about');
    }
}
