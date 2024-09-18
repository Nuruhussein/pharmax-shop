<x-app-layout>
    <div class="max-w-screen-md mx-auto px-4 md:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $category->name }}</h1>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-medium mb-2">Description</label>
            <p class="text-gray-600">{{ $category->description }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-medium mb-2">Photo</label>
            @if($category->photo)
                <img src="{{ Storage::url($category->photo) }}" alt="{{ $category->name }}" class="rounded-lg shadow-md">
            @else
                <p class="text-gray-600">No photo available</p>
            @endif
        </div>
        <a href="{{ route('categories.index') }}"
           class="px-4 py-2 bg-gray-600 text-white font-medium rounded-lg shadow hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 duration-150">
            Back to Categories
        </a>
    </div>
</x-app-layout>
