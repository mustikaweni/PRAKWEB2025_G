{{-- File: resources/views/dashboard/partials/table.blade.php --}}

<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
    <table class="w-full text-sm text-left rtl:text-right text-body">
        <thead class="text-xs text-sm text-body-light bg-neutral-secondary-soft border-b border-default-medium rounded-base border-default">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium">No</th>
                {{-- Tambahkan table head Image --}}
                <th scope="col" class="px-6 py-3 font-medium">Image</th>
                <th scope="col" class="px-6 py-3 font-medium">Title</th>
                <th scope="col" class="px-6 py-3 font-medium">Category</th>
                <th scope="col" class="px-6 py-3 font-medium">Published At</th>
                <th scope="col" class="px-6 py-3 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr scope="row" class="bg-neutral-primary border-b border-default">
                <td class="px-6 py-4">
                    {{-- Menghitung index untuk pagination --}}
                    {{ ($posts->firstItem() + $loop->index) }}
                </td>
                
                {{-- Tambahkan table data Image Preview --}}
                <td class="px-6 py-4">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-16 h-16 rounded-base object-cover"/>
                    @else
                        {{-- Placeholder jika tidak ada gambar --}}
                        <img src="{{ asset('images/preview.jpg') }}" alt="Image preview" class="w-16 h-16 rounded-base object-cover border border-default-bg-gray-100"/>
                    @endif
                </td>

                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                    {{ $post->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->category?->name ?? 'Uncategorized' }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->created_at->format('d M Y') }}
                </td>
                
                {{-- Kolom Actions (View, Edit, Delete) --}}
                <td class="px-6 py-4">
                    {{-- 1. View Button --}}
                    <a href="{{ route('dashboard.show', $post->slug) }}" class="text-blue-600 hover:underline mr-2">View</a>
                    
                    {{-- 2. Edit Button --}}
                    <a href="{{ route('dashboard.edit', $post->slug) }}" class="text-yellow-600 hover:underline mr-2">Edit</a> 
                    
                    {{-- 3. Delete Button (Menggunakan Form dengan Method DELETE) --}}
                    <form action="{{ route('dashboard.destroy', $post->slug) }}" method="POST" class="inline">
                        @csrf
                        @method('delete')
                        <button 
                            type="submit" 
                            onclick="return confirm('Are you sure you want to delete this post?')" 
                            class="text-red-600 hover:underline"
                        >
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    No posts yet. <a href="{{ route('dashboard.create') }}" class="text-text-blue-600 hover:underline">Create one</a>!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Tambahkan Pagination di bawah tabel --}}
@if($posts->hasPages())
    <div class="div border-t border-gray-200 pt-4 mt-4">
        {{ $posts->links() }}
    </div>
@endif