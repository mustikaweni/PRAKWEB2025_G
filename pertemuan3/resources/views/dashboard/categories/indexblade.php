<x-dashboard-layout>
    <x-slot:title>Categories - Dashboard</x-slot:title>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Categories</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + New Category
        </a>
    </div>

    {{-- Gunakan Success Alert yang sama dengan index Post --}}
    @if(session('success'))
        {{-- ... (Kode Success Alert) ... --}}
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Slug</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $category->name }}</td>
                    <td class="px-6 py-4">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        
                        {{-- Form Delete --}}
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
</x-dashboard-layout>