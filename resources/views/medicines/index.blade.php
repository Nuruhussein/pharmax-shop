@if (request()->is('medicines*'))
<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 py-8 md:px-6 md:py-12"> <!-- Adjusted paddings -->
        <div class="items-start justify-between md:flex">
            <div class="max-w-md"> <!-- Adjusted max width -->
                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                    Medicines List
                </h3>
                <p class="text-gray-600 mt-1"> <!-- Adjusted margin-top -->
                    Manage your medicines and view details.
                </p>
            </div>
            <div class="mt-4 md:mt-0"> <!-- Adjusted margin-top -->
                <form action="{{ route('medicines.index') }}" method="GET" class="flex space-x-4">
                    <!-- Search Input -->
                    <div class="flex">
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for medicine..."
                               class="px-4 py-2 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <button type="submit" class="flex items-center px-1">
                            <i class="fas fa-search text-gray-500"></i>
                        </button>
                    </div>
                    <!-- Category Dropdown with Auto-Submit -->
                    <div>
                        <select name="category" class="px-3 py-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="this.form.submit()"> <!-- Adjusted paddings -->
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

        <div class="mt-8 shadow-sm border rounded-lg overflow-x-auto"> <!-- Adjusted margin-top -->
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b">
                    <tr>
                        <th class="py-2 px-4">Name</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Category</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Supplier</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Quantity</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Expiry Date</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Price</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4">Status</th> <!-- Adjusted paddings -->
                        <th class="py-2 px-4"></th> <!-- Adjusted paddings -->
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y">
                    @foreach ($medicines as $medicine)
                        @php
                            $expiryDate = \Carbon\Carbon::parse($medicine->expiry_date);
                            $today = \Carbon\Carbon::now();
                            $isExpired = $expiryDate->isPast();
                            $isExpiringSoon = $expiryDate->diffInDays($today) <= 30 && !$isExpired;
                        @endphp
                        <tr class="{{ $isExpired ? 'bg-red-100 text-red-800' : ($isExpiringSoon ? 'bg-blue-100 text-blue-800' : '') }}">
                            <td class="px-4 py-2 whitespace-nowrap flex"> <!-- Adjusted paddings -->
                                <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" class="w-8 h-8 rounded-full mr-2 object-cover"> <!-- Adjusted margin-right -->
                                {{ $medicine->name }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $medicine->category->name ?? 'N/A' }}</td> <!-- Adjusted paddings -->
                            <td class="px-4 py-2 whitespace-nowrap">{{ $medicine->supplier->name ?? 'N/A' }}</td> <!-- Adjusted paddings -->
                            <td class="px-4 py-2 whitespace-nowrap">{{ $medicine->quantity }}</td> <!-- Adjusted paddings -->
                            <td class="px-4 py-2 whitespace-nowrap">{{ $medicine->expiry_date }}</td> <!-- Adjusted paddings -->
                            <td class="px-4 py-2 whitespace-nowrap">${{ number_format($medicine->price, 2) }}</td> <!-- Adjusted paddings -->
                            <td class="px-4 py-2 whitespace-nowrap">
                                @if($isExpired)
                                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">Expired</span>
                                @elseif($isExpiringSoon)
                                    <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">Expiring Soon</span>
                                @else
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Available</span>
                                @endif
                            </td>
                            <td class="text-right px-4 whitespace-nowrap"> <!-- Adjusted paddings -->
                                <a href="{{ route('medicines.show', $medicine->id) }}" class="py-2 px-2 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">View</a> <!-- Adjusted paddings -->
                                @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('medicines.edit', $medicine->id) }}" class="py-2 px-2 font-medium text-indigo-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">Edit</a> <!-- Adjusted paddings -->
                                    <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-2 px-2 font-medium text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this medicine?');"> <!-- Adjusted paddings -->
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
        <div class="mt-4"> <!-- Adjusted margin-top -->
            {{ $medicines->links() }}
        </div>

        @if (session('success'))
            <div class="alert alert-success text-blue-500 mt-4"> <!-- Adjusted margin-top -->
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
                                    <button type="submit" class="py-2 px-3 font-medium text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this medicine?');">
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
        <div class="alert alert-success text-blue-500">
            {{ session('success') }}
        </div>
    @endif
</div>
@endif
