<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Order Details</h1>
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <p class="text-lg font-semibold"><strong>Order Code:</strong> {{ $order->order_code }}</p>
        <p class="text-lg font-semibold"><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Order Items</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-50">
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->medicine->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('staff.orders.update', $order->order_code) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                <select name="status" id="status" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Update Status</button>
        </form>
    </div>
        @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif
</div>
</x-app-layout>
