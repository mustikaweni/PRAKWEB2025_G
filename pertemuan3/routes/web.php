<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\DashboardPostController; 
use App\Http\Controllers\DashboardCategoryController; // <--- BARIS WAJIB TAMBAHAN
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Routes yang tidak butuh autentikasi)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Route Register & Login (hanya untuk yang belum login)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login'); // Rute Login Display
Route::post('/login', [LoginController::class, 'login'])->middleware('guest'); // Rute Login Process

// Route Logout (hanya untuk yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected/Auth Routes
|--------------------------------------------------------------------------
*/

// Rute Postingan Publik (Hanya bisa diakses jika sudah login)
Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware('auth')->name('posts.show');
Route::get('/categories', [CategoryController::class, 'index']); // Kategori biasanya publik, tetapi di sini Anda tidak melindunginya

// Rute Dashboard (CRUD Post Milik User)
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    // Index - Menampilkan semua posts milik user
    Route::get('/', [DashboardPostController::class, 'index'])->name('dashboard.index');
    // Create - Form untuk membuat post baru
    Route::get('/create', [DashboardPostController::class, 'create'])->name('dashboard.create');
    // Store - Menyimpan post baru
    Route::post('/', [DashboardPostController::class, 'store'])->name('dashboard.store');
    // Show - Menampilkan detail post berdasarkan slug
    Route::get('/{post:slug}', [DashboardPostController::class, 'show'])->name('dashboard.show');
    
    // Rute Tambahan untuk Update & Delete Post (harus di dalam group dashboard/auth)
    Route::get('/{post:slug}/edit', [DashboardPostController::class, 'edit'])->name('dashboard.edit');
    Route::put('/{post:slug}', [DashboardPostController::class, 'update'])->name('dashboard.update');
    Route::delete('/{post:slug}', [DashboardPostController::class, 'destroy'])->name('dashboard.destroy');


    // CRUD Category <--- TEMPAT MENAMBAHKAN RESOURCE CATEGORY
    Route::resource('categories', DashboardCategoryController::class)
        ->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);
});