<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Order Details</h1>

        <div class="flex space-x-8">
            <!-- Order Information -->
            <div class="flex-1 bg-white p-8 rounded-lg shadow-lg mb-8">
                <div class="flex justify-between">
                    <p class="text-xl font-bold text-gray-600">Order Code: <span class="text-indigo-600">{{ $order->order_code }}</span></p>
                    <p class="text-xl font-bold text-gray-600">Total Amount: <span class="text-green-600">${{ $order->total_amount }}</span></p>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="flex-1 bg-white p-8 rounded-lg shadow-lg mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Items</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medicine</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->medicine->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">${{ $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Status Update -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <form action="{{ route('staff.orders.update', $order->order_code) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6 w-2/4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                {{-- <button type="submit" class="w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">Update Status</button> --}}
             <div class="mt-6 gap-4 flex flex-row-reverse">
                     <a href="{{ route('staff.orders.index') }}" class="w-48 py-3 px-6 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Cancel
                    </a>
                     <button type="submit" class="w-48 py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Update status
                    </button>
                  
                </div>
            </form>
            
       
        </div>

        <!-- Cancel Button -->
        
    </div>
</x-app-layout>
