<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Purchase Records</h1>

     @if(session('success'))
        <div class=" text-green-600  p-4  mb-6">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('purchases.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
        <i class="fas fa-plus mr-2"></i> Add New Purchase
    </a>

    <div class="mt-8 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-400 text-white">
                <tr>
                    <th class="py-3 px-4 text-left border-b">Medicine</th>
                    <th class="py-3 px-4 text-left border-b">Supplier</th>
                    <th class="py-3 px-4 text-left border-b">Quantity</th>
                    <th class="py-3 px-4 text-left border-b">Purchase Price</th>
                    <th class="py-3 px-4 text-left border-b">Purchase Date</th>
                    <th class="py-3 px-4 text-left border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100">
                @foreach($purchases as $purchase)
                    <tr>
                        <td class="py-3 px-4 border-b text-gray-800">{{ $purchase->medicine->name }}</td>
                        <td class="py-3 px-4 border-b text-gray-800">{{ $purchase->supplier->name }}</td>
                        <td class="py-3 px-4 border-b text-gray-800">{{ $purchase->quantity }}</td>
                        <td class="py-3 px-4 border-b text-gray-800">${{ number_format($purchase->purchase_price, 2) }}</td>
                        <td class="py-3 px-4 border-b text-gray-800">{{ $purchase->purchase_date }}</td>
                        <td class="py-3 px-4 border-b text-gray-800">
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300 ease-in-out">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                  <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this purchase?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 ml-4 text-white px-3 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300 ease-in-out">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
