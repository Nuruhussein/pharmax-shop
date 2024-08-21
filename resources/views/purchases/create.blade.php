<x-app-layout>
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Add New Purchase</h1>

    <form action="{{ route('purchases.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label for="medicine_id" class="block text-gray-700">Medicine</label>
            <select id="medicine_id" name="medicine_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Medicine</option>
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                @endforeach
            </select>
            @error('medicine_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="supplier_id" class="block text-gray-700">Supplier</label>
            <select id="supplier_id" name="supplier_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('quantity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="purchase_price" class="block text-gray-700">Purchase Price</label>
            <input type="number" step="0.01" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('purchase_price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="purchase_date" class="block text-gray-700">Purchase Date</label>
            <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('purchase_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Save Purchase
        </button>
    </form>
</div>
</x-app-layout>
