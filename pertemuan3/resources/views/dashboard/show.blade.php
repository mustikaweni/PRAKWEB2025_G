{{-- File: resources/views/dashboard/show.blade.php --}}

<x-dashboard-layout>
    <x-slot:title>
        {{ $post->title }} - Dashboard
    </x-slot:title>

    <article class="max-w-4xl mx-auto">
        
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
            
            <div class="div flex items-center text-sm text-gray-600 mb-4">
                {{-- Meta Info --}}
                <span class="mr-4">By {{ $post->author->name ?? auth()->user()->name }}</span>
                <span class="mr-4">Category: {{ $post->category?->name ?? 'Uncategorized' }}</span>
                <span>{{ $post->created_at->format('d M Y') }}</span>
            </div>

            {{-- Tampilkan Gambar Postingan --}}
            @if($post->image)
                {{-- Perhatikan, menggunakan 'storage/' karena gambar diupload ke disk storage --}}
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg mb-6"/>
            @endif
        </header>

        {{-- Body Content --}}
        <div class="prose prose-lg max-w-none">
            <p class="text-xl text-gray-600 mb-6">{{ $post->excerpt }}</p>
            {{-- Menggunakan {!! !!} untuk render HTML yang aman --}}
            {!! nl2br(e($post->body)) !!}
        </div>

        {{-- Footer --}}
        <footer class="mt-8 pt-8 border-t border-gray-200">
            <a href="{{ route('dashboard.index') }}" class="inline-flex items-center text-text-blue-600 hover:text-blue-800 font-medium">
                &leftarrow; Back to Dashboard
            </a>
        </footer>

    </article>
</x-dashboard-layout>