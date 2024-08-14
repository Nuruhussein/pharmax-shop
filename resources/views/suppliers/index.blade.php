<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between mb-8">
            <div class="max-w-lg">
                <h3 class="text-gray-800 text-2xl font-bold">Suppliers List</h3>
                <p class="text-gray-600 mt-2">
                    Manage your suppliers and view details.
                </p>
            </div>
            @if(Auth::user()->role == 'admin') 
            <a href="{{ route('suppliers.create') }}"
               class="inline-flex items-center px-4 py-2 text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-500 active:bg-indigo-700 transition duration-150 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Supplier
            </a>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Contact Number</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Email</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Address</th>
                        <th class="py-3 px-4 text-right text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="py-4 px-4 text-sm">{{ $supplier->name }}</td>
                            <td class="py-4 px-4 text-sm">{{ $supplier->contact_number }}</td>
                            <td class="py-4 px-4 text-sm">{{ $supplier->email }}</td>
                            <td class="py-4 px-4 text-sm">{{ $supplier->address }}</td>
                            <td class="py-4 px-4 text-right text-sm">
                                <a href="{{ route('suppliers.show', $supplier->id) }}"
                                   class="text-blue-600 hover:text-blue-500 transition duration-150 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15l3 3 7-7-3-3-7 7z"></path>
                                    </svg>
                                    View
                                </a>
                                @if(Auth::user()->role == 'admin') <!-- Show actions only if the user is admin -->
                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                   class="ml-3 text-yellow-600 hover:text-yellow-500 transition duration-150 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 11l2 2m0 0l-2 2m2-2H6m0 0l2-2M9 4H4a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="ml-3 text-red-600 hover:text-red-500 transition duration-150 inline-flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 19H18M10 19V5m1 14h6a2 2 0 002-2v-8a2 2 0 00-2-2H10a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
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
