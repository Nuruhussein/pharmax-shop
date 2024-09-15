<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Sale</h1>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Edit Sale Form -->
        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="sale_date" class="block text-gray-700">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date" value="{{ old('sale_date', $sale->sale_date) }}" class="block w-full border border-gray-300 rounded px-3 py-2" required>
                @error('sale_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="order_id" class="block text-gray-700">Order ID (Optional)</label>
                <input type="text" name="order_id" id="order_id" value="{{ old('order_id', $sale->order_id) }}" class="block w-full border border-gray-300 rounded px-3 py-2">
                @error('order_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Items Section -->
            <div id="items">
                <h3 class="text-lg font-semibold mb-4">Items</h3>
                @foreach ($sale->items as $item)
                    <div class="mb-4">
                        <!-- Medicine Name (Readonly) -->
                        <label class="block text-gray-700">Medicine</label>
                        <input type="hidden" name="items[{{ $loop->index }}][medicine_id]" value="{{ $item->medicine_id }}">
                        <input type="text" value="{{ $item->medicine->name }}" class="block w-full border border-gray-300 rounded px-3 py-2" readonly>

                        <!-- Quantity -->
                        <label for="quantity_{{ $loop->index }}" class="block text-gray-700 mt-2">Quantity</label>
                        <input type="number" name="items[{{ $loop->index }}][quantity]" id="quantity_{{ $loop->index }}" value="{{ $item->quantity }}" class="block w-full border border-gray-300 rounded px-3 py-2" min="1" required>
                        
                        <!-- Sale Price -->
                        <label for="sale_price_{{ $loop->index }}" class="block text-gray-700 mt-2">Sale Price</label>
                        <input type="number" name="items[{{ $loop->index }}][sale_price]" id="sale_price_{{ $loop->index }}" value="{{ $item->sale_price }}" class="block w-full border border-gray-300 rounded px-3 py-2" step="0.01" required>
                    </div>
                @endforeach
            </div>

            <!-- Add More Items Button -->
            <div class="mb-4">
                <button type="button" id="add-item" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add New Item</button>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Sale</button>
                <a href="{{ route('sales.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Adding new items dynamically (simplified)
        const addItemButton = document.getElementById('add-item');
        const itemsContainer = document.getElementById('items');
        let itemCount = {{ count($sale->items) }};

        addItemButton.addEventListener('click', function () {
            const newItem = `
                <div class="mb-4">
                    <label class="block text-gray-700">Medicine</label>
                    <select name="items[${itemCount}][medicine_id]" class="block w-full border border-gray-300 rounded px-3 py-2" required>
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                        @endforeach
                    </select>

                    <label for="quantity_${itemCount}" class="block text-gray-700 mt-2">Quantity</label>
                    <input type="number" name="items[${itemCount}][quantity]" id="quantity_${itemCount}" class="block w-full border border-gray-300 rounded px-3 py-2" min="1" required>

                    <label for="sale_price_${itemCount}" class="block text-gray-700 mt-2">Sale Price</label>
                    <input type="number" name="items[${itemCount}][sale_price]" id="sale_price_${itemCount}" class="block w-full border border-gray-300 rounded px-3 py-2" step="0.01" required>
                </div>
            `;

            itemsContainer.insertAdjacentHTML('beforeend', newItem);
            itemCount++;
        });
    </script>
</x-app-layout>
