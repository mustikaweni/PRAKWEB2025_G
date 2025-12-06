{{-- File: resources/views/dashboard/edit.blade.php --}}

<x-dashboard-layout>
    <x-slot:title>
        Edit Post - Dashboard
    </x-slot:title>

    <div class="div class="max-w-4xl mx-auto"">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Post: {{ $post->title }}</h1>
        </div>

        {{-- Form Card --}}
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            {{-- Form Header --}}
            <div class="flex items-center justify-between border-b-default pb-4 md:pb-5 mb-4 md:mb-6">
                <h3 class="text-lg font-medium text-heading">
                    Post Information
                </h3>
            </div>
            
            {{-- Import Form Component --}}
            <x-posts.form :categories="$categories" :post="$post" />
        </div>
    </div>
</x-dashboard-layout>