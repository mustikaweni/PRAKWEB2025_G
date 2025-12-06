<?php
// File: app/Http/Controllers/DashboardCategoryController.php

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        // Ambil semua kategori, tambahkan pagination jika kategori banyak
        $categories = Category::paginate(10); 
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);
        
        $validatedData['slug'] = Str::slug($request->name);
        
        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        // Hanya validasi unique jika nama berubah
        if ($request->name != $category->name) {
            $rules['name'] = 'required|max:255|unique:categories';
        }

        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::slug($request->name);
        
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
?>