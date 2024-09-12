<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">All Orders</h1>
    <div class="  flex justify-center items-center mx-2 my-4 px-4 py-8">
        <h1 class="text-2xl text-gray-700">Enter order code</h1>
     <form action="{{ route('staff.orders.index') }}" method="GET" class="flex space-x-4">
                    <!-- Search Input -->
                    <div class="flex">
                        <input type="text" name="query" placeholder="Search for medicine..."
                               class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <button type="submit" class="flex items-center px-1">
                            <i class="fas fa-search text-gray-500"></i>
                        </button>
                        
                    </div>
                    
     </form>
     
     </div>
         @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif
    <div class="overflow-x-auto mt-14">
        <table class="min-w-full bg-white divide-y divide-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->doctor->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $order->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('staff.orders.show', $order->order_code) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>
