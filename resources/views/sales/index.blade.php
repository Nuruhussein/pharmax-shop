<x-app-layout>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Sales Records</h1>

    @if(session('success'))
        <div class=" text-green-600  p-4  mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($sales->isEmpty())
        <p class="text-gray-600">No sales recorded yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="bg-gradient-to-r from-gray-700 to-gray-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left border-b">#</th>
                        <th class="py-3 px-6 text-left border-b">Medicine Name</th>
                        <th class="py-3 px-6 text-left border-b">Quantity Sold</th>
                        <th class="py-3 px-6 text-left border-b">Sale Price</th>
                        <th class="py-3 px-6 text-left border-b">Sale Date</th>
                        <th class="py-3 px-6 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach($sales as $sale)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="border px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                            <td class="border px-6 py-4 text-gray-800">{{ $sale->medicine->name }}</td>
                            <td class="border px-6 py-4 text-gray-800">{{ $sale->quantity }}</td>
                            <td class="border px-6 py-4 text-gray-800">${{ number_format($sale->sale_price, 2) }}</td>
                            <td class="border px-6 py-4 text-gray-800">{{ $sale->sale_date }}</td>
                            <td class="border px-6 py-4 flex items-center space-x-2">
                                <a href="{{ route('sales.edit', $sale->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this purchase?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

  
</div>
</x-app-layout>
