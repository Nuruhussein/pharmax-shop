<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $category->name }} Category</h1>
                <h3 class="text-lg font-semibold text-gray-700 mt-2">Medicines in this Category:</h3>
            </div>
            <a href="{{ route('categories.index') }}"
               class="inline-block px-4 py-2 bg-gray-600 text-white font-medium rounded-lg shadow hover:bg-gray-500 active:bg-gray-700 duration-150">
                Back to Categories
            </a>
        </div>
        <div class="shadow-sm border rounded-lg overflow-x-auto">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                    <tr>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Supplier</th>
                        <th class="py-3 px-6">Quantity</th>
                        <th class="py-3 px-6">Expiry Date</th>
                        <th class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y">
                    @if ($category->medicines->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-4">No medicines in this category.</td>
                        </tr>
                    @else
                        @foreach ($category->medicines as $medicine)
                            <tr>
                                <td class="px-6 py-4">{{ $medicine->name }}</td>
                                <td class="px-6 py-4">{{ $medicine->supplier->name }}</td>
                                <td class="px-6 py-4">{{ $medicine->quantity }}</td>
                                <td class="px-6 py-4">{{ $medicine->expiry_date }}</td>
                                <td class="text-right px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('medicines.show', $medicine->id) }}"
                                       class="py-2 px-3 text-blue-600 hover:text-blue-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        View
                                    </a>
                                    <a href="{{ route('medicines.edit', $medicine->id) }}"
                                       class="py-2 px-3 text-yellow-600 hover:text-yellow-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        Edit
                                    </a>
                                    <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="py-2 px-3 text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
