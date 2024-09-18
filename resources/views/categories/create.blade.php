<x-app-layout>
    <div class="max-w-screen-md mx-auto px-4 md:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Category Name</label>
                <input type="text" id="name" name="name"
                       class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       required>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                <textarea id="description" name="description"
                          class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <div class="mb-6">
                <label for="photo" class="block text-gray-700 text-sm font-medium mb-2">Photo</label>
                <input type="file" id="photo" name="photo"
                       class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 duration-150">
                Add Category
            </button>
        </form>
    </div>
</x-app-layout>
