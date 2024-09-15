<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Sales Records</h1>

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

        @if($sales->isEmpty())
            <p class="text-gray-600">No sales recorded yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-gray-700 to-gray-500 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left border-b">#</th>
                            <th class="py-3 px-6 text-left border-b">Sale Date</th>
                            <th class="py-3 px-6 text-left border-b">Total Amount</th>
                            <th class="py-3 px-6 text-left border-b">Order ID</th>
                            <th class="py-3 px-6 text-left border-b">User</th>
                            <th class="py-3 px-6 text-left border-b">Status</th>
                            <th class="py-3 px-6 text-left border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        @foreach($sales as $sale)
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="border px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                                <td class="border px-6 py-4 text-gray-800">{{ $sale->sale_date }}</td>
                                <td class="border px-6 py-4 text-gray-800">${{ number_format($sale->total_amount, 2) }}</td>
                                <td class="border px-6 py-4 text-gray-800">{{ $sale->order_id ?? 'N/A' }}</td>
                              
                                <td class="border px-6 py-4 text-gray-800">{{ $sale->user->name ?? 'N/A' }}</td>
                                  <td class="border px-6 py-4 text-gray-800">
                                    <span class="{{ $sale->status === 'approved' ? 'text-green-500' : 'text-yellow-500' }}">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </td>
                                <td class="border px-6 py-4 flex items-center space-x-2">
                                    @if($sale->status !== 'approved')
                                        <form action="{{ route('sales.approve', $sale->id) }}" method="POST" class="inline relative group">
                                            @csrf
                                            @method('PATCH')
                                            <button 
                                                type="submit" 
                                                class="relative text-white bg-red-500 w-6 h-6 mr-2 rounded-full flex items-center justify-center hover:bg-red-600 transition duration-150 ease-in-out"
                                                onclick="return confirm('Are you sure you want to approve this sale?');"
                                                aria-label="Approve"
                                            >
                                                <i class="fas fa-check"></i>
                                                <!-- Tooltip -->
                                                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block text-xs text-gray-700 bg-white rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    Approve
                                                </span>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('sales.show', $sale->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="text-yellow-600 hover:text-yellow-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline" onsubmit="return confirmDelete(this);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                            <i class="fas fa-trash"></i> Delete
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
                {{ $sales->links() }}
            </div>
        @endif

        <!-- Link to Create New Sale -->
        <div class="mt-6">
            <a href="{{ route('sales.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                <i class="fas fa-plus"></i> Create New Sale
            </a>
        </div>
    </div>

    <!-- JavaScript for handling confirmation and stock restoration -->
    <script>
        function confirmDelete(form) {
            if (confirm('Are you sure you want to delete this sale? This action will remove the sale record.')) {
                const restoreStock = confirm('Do you want to restore the stock?');
                if (restoreStock) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'restore_stock';
                    input.value = '1';
                    form.appendChild(input);
                }
                form.submit();
            }
            return false;
        }
    </script>
</x-app-layout>
