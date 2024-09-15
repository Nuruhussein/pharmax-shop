<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Sale Details</h1>

        <!-- Sale Details Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full bg-white">
                <thead class="bg-gradient-to-r from-gray-700 to-gray-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left border-b">Medicine</th>
                        <th class="py-3 px-6 text-left border-b">Quantity</th>
                        <th class="py-3 px-6 text-left border-b">Sale Price</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($sale->items as $item)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="border px-6 py-4 text-gray-800">{{ $item->medicine->name }}</td>
                            <td class="border px-6 py-4 text-gray-800">{{ $item->quantity }}</td>
                            <td class="border px-6 py-4 text-gray-800">${{ number_format($item->sale_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Amount -->
        <div class="mt-6 p-4 bg-white shadow-lg rounded-lg border border-gray-200">
            <p class="text-lg font-semibold text-gray-800">Total Amount: ${{ number_format($sale->total_amount, 2) }}</p>
        </div>

        <!-- Back to Sales List Button -->
        <div class="mt-6">
            <a href="{{ route('sales.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Back to Sales List
            </a>
        </div>
    </div>
</x-app-layout>
