<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
                <p class="text-gray-600 mt-1">Manage your categories and view their details.</p>
                @if(Auth::user()->role == 'admin')
            </div>
            <!-- Trigger Button to Open Modal -->
            <button id="openModalBtn" class="inline-block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-500 active:bg-indigo-700 duration-150">
                Add Category
            </button>
        </div>
        @endif

        <!-- Modal (Hidden by Default) -->
        <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal content -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Category</h1>
                        
                        <!-- Form for Adding New Category -->
                        <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input type="text" name="name" id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                            </div>

                            <div class="space-y-2">
                                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                                <input type="file" name="photo" id="photo" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <button type="submit" class="inline-block px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add Category</button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button id="closeModalBtn" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table for Categories -->
        <div class="mt-8 shadow-sm border rounded-lg overflow-x-auto">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 font-medium border-b">
                    <tr>
                        <th class="py-3 px-6">Photo</th>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Number of Products</th>
                        <th class="py-3 px-6">Related Medicine</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->photo)
                                    <img src="{{ Storage::url($category->photo) }}" alt="{{ $category->name }}" width="100">
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->medicines_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('categories.show', $category->id) }}"
                                   class="py-2 px-3 text-blue-600 hover:text-blue-500 duration-150 hover:bg-gray-50 rounded-lg">
                                    View associated medicines
                                </a>
                            </td>
                            <td class="text-right px-6 whitespace-nowrap">
                                <a href="{{ route('categories.detail', $category->id) }}"
                                   class="py-2 px-3 text-green-600 hover:text-green-500 duration-150 hover:bg-gray-50 rounded-lg">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="py-2 px-3 text-yellow-600 hover:text-yellow-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="py-2 px-3 text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
</x-app-layout>
