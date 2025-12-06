{{-- File: resources/views/components/posts/form.blade.php --}}

@props(['categories'])

<form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
        
        {{-- Title --}}
        <div class="col-span-2">
            <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title') }}" 
                class="block w-full p-3 py-2.5 bg-neutral-secondary-medium border {{ $errors->has('title') ? 'border-red-500' : 'border-default-medium' }} text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" 
                placeholder="Enter post title" 
                required
            />
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="col-span-2">
            <label for="category_id" class="block mb-2.5 text-sm font-medium text-heading">Category</label>
            <select name="category_id" id="category_id" class="block w-full p-3 py-2.5 bg-neutral-secondary-medium border {{ $errors->has('category_id') ? 'border-red-500' : 'border-default-medium' }} text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" required>
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Image Upload --}}
        <div class="col-span-2">
            <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Upload Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                accept="image/png, image/jpeg, image/jpg" 
                class="cursor-pointer bg-neutral-secondary-medium border {{ $errors->has('image') ? 'border-red-500' : 'border-default-medium' }} text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
            />
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Excerpt --}}
        <div class="col-span-2">
            <label for="excerpt" class="block mb-2.5 text-sm font-medium text-heading">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="block w-full p-3 bg-neutral-secondary-medium border {{ $errors->has('excerpt') ? 'border-red-500' : 'border-default-medium' }} text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Write a short excerpt or summary">{{ old('excerpt') }}</textarea>
            @error('excerpt')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Body --}}
        <div class="col-span-2">
            <label for="body" class="block mb-2.5 text-sm font-medium text-heading">Content</label>
            <textarea name="body" id="body" rows="8" class="block w-full p-3 bg-neutral-secondary-medium border {{ $errors->has('body') ? 'border-red-500' : 'border-default-medium' }} text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Write your post content here">{{ old('body') }}</textarea>
            @error('body')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Form Footer --}}
    <div class="div flex items-center space-x-4 border-t border-default pt-4 md:pt-6 mt-4 md:mt-6">
        <button type="submit" class="inline-flex items-center text-white bg-brand hover:bg-brand-strong box-border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
            Create Post
        </button>
        <a href="{{ route('dashboard.index') }}" class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
            Cancel
        </a>
    </div>
</form>