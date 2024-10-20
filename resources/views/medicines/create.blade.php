<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Add Medicine</h1>

        <form action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Medicine Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Medicine Name</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div class="mb-4">
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select id="supplier_id" name="supplier_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Expiry Date -->
                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" required step="0.01"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Optional Description -->
                <div class="mb-4 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                    <textarea id="description" name="description" rows="4" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter additional details about the medicine (optional)"></textarea>
                </div>
            </div>
            
            <button type="submit"
                class="mt-6 inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-50 transition duration-150">
                Add Medicine
            </button>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Toastr CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            // Check for success message
            @if (session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    positionClass: "toast-top-center",
                    timeOut: 3000,
                    fadeOut: 1000
                });
            @endif

            // Check for error message
            @if (session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    positionClass: "toast-top-center",
                    timeOut: 3000,
                    fadeOut: 1000
                });
            @endif
        });
    </script>
</x-app-layout>
