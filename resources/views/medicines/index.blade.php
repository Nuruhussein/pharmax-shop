
@if (request()->is('medicines*'))
<x-app-layout>
<div class="max-w-screen-xl mx-auto px-4 py-16 md:px-8">
    <div class="items-start justify-between md:flex">
        <div class="max-w-lg">
            <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                Medicines List
            </h3>
            <p class="text-gray-600 mt-2">
                Manage your medicines and view details.
            </p>
        </div>
        <div class="mt-3 md:mt-0">
            <form action="{{ route('medicines.index') }}" method="GET" class="flex space-x-4">
                <!-- Search Input -->
                <div class="flex">
                    <input type="text" name="query" placeholder="Search for medicine..."
                           class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="submit" class="flex items-center px-1">
                        <i class="fas fa-search text-gray-500"></i>
                    </button>
                </div>
                <!-- Category Dropdown with Auto-Submit -->
                <div>
                    <select name="category" class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="this.form.submit()">
                        <option value="">Filter by Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-12 shadow-sm border rounded-lg overflow-x-auto">
        <table class="w-full table-auto text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                <tr>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6">Category</th>
                    <th class="py-3 px-6">Supplier</th>
                    <th class="py-3 px-6">Quantity</th>
                    <th class="py-3 px-6">Expiry Date</th>
                    <th class="py-3 px-6">Price</th>
                    <th class="py-3 px-6"></th>
                </tr>
            </thead>
            <tbody class="text-gray-600 divide-y">
                @foreach ($medicines as $medicine)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap flex">
                            <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" class="w-8 h-8 rounded-full mr-3 object-cover">
                            {{ $medicine->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->supplier->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->expiry_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($medicine->price, 2) }}</td>
                        <td class="text-right px-6 whitespace-nowrap">
                            <a href="{{ route('medicines.show', $medicine->id) }}" class="py-2 px-3 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">View</a>
                            @if(Auth::user()->role == 'admin')
                                <a href="{{ route('medicines.edit', $medicine->id) }}" class="py-2 px-3 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">Edit</a>
                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-3 font-medium text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $medicines->links() }}
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
</x-app-layout>

    @else
    <div class="max-w-screen-xl mx-auto px-4 py-16 md:px-8">
    <div class="items-start justify-between md:flex">
        <div class="max-w-lg">
            <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                Medicines List
            </h3>
            <p class="text-gray-600 mt-2">
                Manage your medicines and view details.
            </p>
        </div>
        <div class="mt-3 md:mt-0">
            <form action="{{ route('dashboard') }}" method="GET" class="flex space-x-4">
                <!-- Search Input -->
                <div class="flex">
                    <input type="text" name="query" placeholder="Search for medicine..."
                           class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="submit" class="flex items-center px-1">
                        <i class="fas fa-search text-gray-500"></i>
                    </button>
                </div>
                <!-- Category Dropdown with Auto-Submit -->
                <div>
                    <select name="category" class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="this.form.submit()">
                        <option value="">Filter by Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-12 shadow-sm border rounded-lg overflow-x-auto">
        <table class="w-full table-auto text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                <tr>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6">Category</th>
                    <th class="py-3 px-6">Supplier</th>
                    <th class="py-3 px-6">Quantity</th>
                    <th class="py-3 px-6">Expiry Date</th>
                    <th class="py-3 px-6">Price</th>
                    <th class="py-3 px-6"></th>
                </tr>
            </thead>
            <tbody class="text-gray-600 divide-y">
                @foreach ($medicines as $medicine)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap flex">
                            <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" class="w-8 h-8 rounded-full mr-3 object-cover">
                            {{ $medicine->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->supplier->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->expiry_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($medicine->price, 2) }}</td>
                        <td class="text-right px-6 whitespace-nowrap">
                            <a href="{{ route('medicines.show', $medicine->id) }}" class="py-2 px-3 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">View</a>
                            @if(Auth::user()->role == 'admin')
                                <a href="{{ route('medicines.edit', $medicine->id) }}" class="py-2 px-3 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">Edit</a>
                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-3 font-medium text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $medicines->links() }}
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
@endif