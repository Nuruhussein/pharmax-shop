<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">All Orders</h1>
    <div class="flex flex-col justify-center items-center mx-2 my-4 px-4 py-8">
        <h1 class="text-2xl text-gray-700 m-6">Enter order code</h1>
        <form action="{{ route('staff.orders.index') }}" method="GET" class="flex space-x-4">
            <!-- Search Input -->
            <div class="flex flex-col justify-center items-center">
                <input type="text" name="query" placeholder="Search for medicine..."
                       class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit" class="flex mt-2 items-center px-1">
                    <i class="fas fa-search text-blue-500 text-3xl"></i>
                </button>
            </div>
        </form>
    </div>
 @if (session('success'))
        <div class="alert alert-success text-blue-500">
            {{ session('success') }}
        </div>
    @endif
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">user</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                       <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
    {{ $order->status == 'pending' ? 'text-yellow-500' : 
       ($order->status == 'cancelled' ? 'text-red-600' : 
       ($order->status == 'completed' ? 'text-green-600' : '')) }}
">
    {{ $order->status }}
</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $order->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('staff.orders.show', $order->order_code) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                            <!-- Delete Order -->
                            <form action="{{ route('staff.orders.destroy', $order->order_code) }}" method="POST" class="inline ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this order?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>

   
</div>
</x-app-layout>
