<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Penting untuk operasi file system

class DashboardPostController extends Controller
{
    // READ (Index)
    public function index()
    {
        // Ambil semua postingan yang dimiliki oleh user yang sedang login
        $posts = Post::where('user_id', auth()->user()->id);

        // Logika Search (Query Scope sederhana)
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('dashboard.index', [
            'posts' => $posts->paginate(5)->withQueryString()
        ]);
    }

    // READ (Show)
    public function show(Post $post)
    {
        return view('dashboard.show', compact('post'));
    }

    // CREATE (Form)
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.create', compact('categories'));
    }

    // CREATE (Store Logic)
    public function store(Request $request)
    {
        // 1. Validasi Input dan File
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan file image
        ], 
        [ 
            // Custom Messages (disederhanakan untuk brevity)
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        ]);
        
        // 2. Failure Handling
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); 
        }

        $validatedData = $validator->validated();

        // 3. Logika File Upload
        $imagePath = null;
        if ($request->file('image')) {
            // Menggunakan store() untuk menyimpan file ke disk 'public' di folder 'post-images'
            $imagePath = $request->file('image')->store('post-images', 'public'); 
        }

        // 4. Generate Slug Unik
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // 5. Create Record di Database
        Post::create([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'category_id' => $validatedData['category_id'],
            'excerpt' => $validatedData['excerpt'],
            'body' => $validatedData['body'],
            'user_id' => auth()->user()->id,
            'image' => $imagePath, // Menyimpan path file
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }
    
    // UPDATE (Form)
    public function edit(Post $post)
    {
        // Policy: Pastikan hanya pemilik post yang bisa mengedit
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }
        
        $categories = Category::all();
        
        return view('dashboard.edit', compact('post', 'categories'));
    }

    // UPDATE (Logic)
    public function update(Request $request, Post $post)
    {
        // Policy: Pastikan hanya pemilik post yang bisa mengupdate
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }
        
        // 1. Definisikan Aturan Validasi
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required',
            'body' => 'required',
            // Gambar bersifat nullable karena bisa saja user tidak ingin mengubahnya
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];

        // Validasi Title unik/slug hanya jika Title diubah
        if ($request->title != $post->title) {
            $rules['title'] = 'required|max:255'; 
        } else {
            $rules['title'] = 'required|max:255';
        }

        $validatedData = $request->validate($rules);
        
        // 2. Logika Update Gambar
        if ($request->file('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        // 3. Generate Slug baru jika title berubah
        if ($request->title != $post->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            // Cek keunikan slug, kecuali ID post saat ini
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $validatedData['slug'] = $slug;
        }

        // 4. Update Record
        $post->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Post updated successfully!');
    }

    // DELETE (Destroy)
   // File: app/Http/Controllers/DashboardPostController.php

public function destroy(Post $post)
{
    // Pastikan hanya pemilik post yang bisa menghapus
    if ($post->user_id !== auth()->user()->id) {
        abort(403);
    }
    
    // Hapus gambar dari storage jika ada
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }
    
    // Hapus record dari database
    Post::destroy($post->id);

    return redirect()->route('dashboard.index')->with('success', 'Post deleted successfully!');
}
}