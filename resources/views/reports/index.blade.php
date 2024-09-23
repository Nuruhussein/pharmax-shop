<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="max-w-lg">
            <h2 class="text-gray-800 text-xl font-bold sm:text-2xl">{{ $title }}</h2>
            <p class="text-gray-600 mt-2">
                Here is the detailed report of sales.
            </p>
        </div>
        
        <div class="mt-12 shadow-sm border rounded-lg overflow-x-auto">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                    <tr class="divide-x">
                        <th class="py-3 px-6">Sale ID</th>
                        <th class="py-3 px-6">Total Amount</th>
                        <th class="py-3 px-6">Sale Date</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y">
                    @forelse($sales as $sale)
                        <tr class="divide-x">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $sale->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $sale->total_amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $sale->sale_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="{{ $sale->status === 'approved' ? 'text-green-500' : 'text-gray-500' }}">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('sales.show', $sale->id) }}" class="text-blue-600 hover:underline">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">No sales data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
