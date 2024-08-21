<x-app-layout>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Sale</h1>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="medicine_id" class="block text-gray-700 font-medium mb-2">Medicine</label>
            <select name="medicine_id" id="medicine_id" class="form-select block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}" {{ $medicine->id == $sale->medicine_id ? 'selected' : '' }}>
                        {{ $medicine->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity Sold</label>
            <input type="number" name="quantity" id="quantity" class="form-input block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('quantity', $sale->quantity) }}">
        </div>

        <div class="mb-4">
            <label for="sale_price" class="block text-gray-700 font-medium mb-2">Sale Price</label>
            <input type="text" name="sale_price" id="sale_price" class="form-input block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('sale_price', $sale->sale_price) }}">
        </div>

        <div class="mb-4">
            <label for="sale_date" class="block text-gray-700 font-medium mb-2">Sale Date</label>
            <input type="date" name="sale_date" id="sale_date" class="form-input block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('sale_date', $sale->sale_date) }}">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('sales.index') }}" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                <i class="fas fa-save mr-2"></i> Update Sale
            </button>
        </div>
    </form>
</div>
</x-app-layout>
