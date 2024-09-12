<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Your Orders</h1>
            <!-- Button to redirect to the Create Order page -->
            <a href="{{ route('orders.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H5a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create Order
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200 shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->order_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $order->total_amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <!-- Actions can go here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
