<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Edit Purchase</h1>

    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="medicine_id" class="block text-gray-700 text-sm font-bold mb-2">Medicine</label>
            <select name="medicine_id" id="medicine_id" class="block w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}" {{ $medicine->id == $purchase->medicine_id ? 'selected' : '' }}>
                        {{ $medicine->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="supplier_id" class="block text-gray-700 text-sm font-bold mb-2">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="block w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="block w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $purchase->quantity }}">
        </div>

        <div class="mb-4">
            <label for="purchase_price" class="block text-gray-700 text-sm font-bold mb-2">Purchase Price</label>
            <input type="text" name="purchase_price" id="purchase_price" class="block w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $purchase->purchase_price }}">
        </div>

        <div class="mb-4">
            <label for="purchase_date" class="block text-gray-700 text-sm font-bold mb-2">Purchase Date</label>
            <input type="date" name="purchase_date" id="purchase_date" class="block w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $purchase->purchase_date }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
            Update Purchase
        </button>
    </form>
</div>
</x-app-layout>
