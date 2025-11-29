<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim data ke view
        return view('categories.index', compact('categories'));
    }
}
