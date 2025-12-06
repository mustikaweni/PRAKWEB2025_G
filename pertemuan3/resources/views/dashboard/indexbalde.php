<?php 
class DashboardPostController extends Controller
{
public function index()
{
    // menggunakan user id dari user yang sedang login
    $posts = Post::where('user_id', auth()->user()->id);

    // fitur search
    if (request('search')) {
        $posts->where('title', 'like', '%' . request('search') . '%');
    }

    // menampilkan 5 data per halaman dengan pagination
    return view('dashboard.index', [
        'posts' => $posts->paginate(5)->withQueryString()
    ]);
}
}

?>

    <x-dashboard-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome, {{ auth()->user()->name }}</h1>
    @include('components.table')
</x-dashboard-layout>

{{-- Success Alert --}}
    @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-fg-success-strong rounded-base bg-success-soft border border-success-subtle" role="alert">
        <svg class="w-4 h-4 me-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 12L8 14L4 10m4-4L6 8L2 4m4 4L2 12m10-8L8 8L4 4m16 8L14 18L10 14m8-4L14 14L10 10m8 4L14 8L10 12"/>
        </svg>
        <p class="flex-1 text-sm font-medium me-1">Success!</p>
        <span class="flex-1 text-sm font-medium me-1">{{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" class="ms-auto -mx-1.5 -my-1.5 bg-success-soft text-fg-success-strong rounded-base focus:ring-2 focus:ring-success-subtle p-1.5 hover:bg-success-medium inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif