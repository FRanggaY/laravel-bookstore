<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \App\Models\Category::withCount('books')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        \App\Models\Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $categories = \App\Models\Category::withCount('books')->get();
        return view('admin.categories.index', compact('category', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = \App\Models\Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
