<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Medicine Details</h1>
        <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
            <div class="border-b border-gray-200">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $medicine->name }}</h2>
                </div>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p class="text-gray-700"><strong>Category:</strong> {{ $medicine->category->name }}</p>
                    <p class="text-gray-700"><strong>Supplier:</strong> {{ $medicine->supplier->name }}</p>
                    <p class="text-gray-700"><strong>Quantity:</strong> {{ $medicine->quantity }}</p>
                    <p class="text-gray-700"><strong>Expiry Date:</strong> {{ $medicine->expiry_date }}</p>
                </div>
            </div>
            <div class="flex justify-end space-x-4 border-t border-gray-200 bg-gray-50 px-4 py-4 sm:px-6">
                <a href="{{ route('medicines.edit', $medicine->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-medium rounded-md shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 transition duration-150">
                    Edit
                </a>
                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-md shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition duration-150">
                        Delete
                    </button>
                </form>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-md shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-150">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
