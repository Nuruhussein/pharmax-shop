<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
                <p class="text-gray-600 mt-1">Manage your categories and view their details.</p>
             @if(Auth::user()->role == 'admin')  </div>
            <a href="{{ route('categories.create') }}"
               class="inline-block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-500 active:bg-indigo-700 duration-150">
                Add Category
            </a>
        </div>
        @endif
        <div class="mt-8 shadow-sm border rounded-lg overflow-x-auto">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                    <tr>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Number of Products</th>
                        <th class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->medicines_count }}</td>
                            <td class="text-right px-6 whitespace-nowrap">
                                <a href="{{ route('categories.show', $category->id) }}"
                                   class="py-2 px-3 text-blue-600 hover:text-blue-500 duration-150 hover:bg-gray-50 rounded-lg">
                                    View associated mediciness
                                </a>
                                 @if(Auth::user()->role == 'admin')  <a href="{{ route('categories.edit', $category->id) }}"
                                   class="py-2 px-3 text-yellow-600 hover:text-yellow-500 duration-150 hover:bg-gray-50 rounded-lg">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="py-2 px-3 text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        Delete
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
</x-app-layout>
