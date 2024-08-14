<x-app-layout>
    <div class="max-w-screen-lg mx-auto px-4 md:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Supplier Details</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $supplier->name }}</h2>
            </div>
            <div class="mb-4">
                <p class="text-gray-600"><strong>Contact Number:</strong> {{ $supplier->contact_number }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $supplier->email }}</p>
                <p class="text-gray-600"><strong>Address:</strong> {{ $supplier->address }}</p>
            </div>
            <div class="flex gap-4 mt-6">
                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg shadow hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-150">
                    Edit
                </a>
                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150">
                        Delete
                    </button>
                </form>
                <a href="{{ route('suppliers.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-150">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
