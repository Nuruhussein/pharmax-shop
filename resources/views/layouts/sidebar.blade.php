<div class="flex flex-col w-64  min-h-screen sticky bg-gray-900">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 bg-gray-800">
        @if(Auth::user()->role == 'staff') 
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white">
                <i class="fas fa-user-tie mr-2"></i> Staff Dashboard
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white">
                <i class="fas fa-cogs mr-2"></i> Admin Dashboard
            </a>
        @endif
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 mt-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('dashboard') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('suppliers.index') }}" 
                   class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('suppliers.index') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-truck mr-3"></i> Suppliers
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" 
                   class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('categories.index') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-tags mr-3"></i> Categories
                </a>
            </li>
            @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('staff.index') }}" 
                       class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('staff.index') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                        <i class="fas fa-users mr-3"></i> Manage Staff
                    </a>
                </li>
                <!-- Medicines Dropdown -->
                <li class="relative">
                    <button class="flex items-center justify-between w-full py-3 px-6 text-lg text-gray-300 hover:text-white rounded-lg transition duration-150 ease-in-out focus:outline-none focus:bg-gray-900"
                            onclick="toggleDropdown('medicine')">
                        <span class="flex items-center">
                            <i class="fas fa-pills mr-3"></i> Medicines
                        </span>
                        <i id="medicineDropdownArrow" class="fas fa-chevron-right transition-transform duration-300 ease-in-out"></i>
                    </button>
                    <ul id="medicineDropdownMenu" class="hidden mt-2 space-y-2 rounded-lg shadow-md origin-top transform ml-5 transition-all duration-300 ease-in-out">
                        <li>
                            <a href="{{ route('medicines.index') }}" 
                               class="block py-3 px-6 text-lg text-gray-300 hover:text-white focus:bg-gray-700 hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                                Show Medicines
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('medicines.create') }}" 
                               class="block py-3 px-6 text-lg text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                                Add Medicine
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Purchases Dropdown -->
                <li class="relative">
                    <button class="flex items-center justify-between w-full py-3 px-6 text-lg text-gray-300 hover:text-white rounded-lg transition duration-150 ease-in-out focus:outline-none focus:bg-gray-900"
                            onclick="toggleDropdown('purchase')">
                        <span class="flex items-center">
                            <i class="fas fa-shopping-cart mr-3"></i> Purchases
                        </span>
                        <i id="purchaseDropdownArrow" class="fas fa-chevron-right transition-transform duration-300 ease-in-out"></i>
                    </button>
                    <ul id="purchaseDropdownMenu" class="hidden mt-2 space-y-2 rounded-lg shadow-md origin-top transform ml-5 transition-all duration-300 ease-in-out">
                        <li>
                            <a href="{{ route('purchases.index') }}" 
                               class="block py-3 px-6 text-lg text-gray-300 hover:text-white focus:bg-gray-700 hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                                Show Purchases
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('purchases.create') }}" 
                               class="block py-3 px-6 text-lg text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                                Add Purchase
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- Sales Dropdown -->
            <li class="relative">
                <button class="flex items-center justify-between w-full py-3 px-6 text-lg text-gray-300 hover:text-white rounded-lg transition duration-150 ease-in-out focus:outline-none focus:bg-gray-900"
                        onclick="toggleDropdown('sales')">
                    <span class="flex items-center">
                        <i class="fas fa-dollar-sign mr-3"></i> Sales
                    </span>
                    <i id="salesDropdownArrow" class="fas fa-chevron-right transition-transform duration-300 ease-in-out"></i>
                </button>
                <ul id="salesDropdownMenu" class="hidden mt-2 space-y-2 rounded-lg shadow-md origin-top transform ml-5 transition-all duration-300 ease-in-out">
                    <li>
                        <a href="{{ route('sales.index') }}" 
                           class="block py-3 px-6 text-lg text-gray-300 hover:text-white focus:bg-gray-700 hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                            Show Sales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales.create') }}" 
                           class="block py-3 px-6 text-lg text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                            Add Sale
                        </a>
                    </li>
                </ul>
            </li>
              <li>
                <a href="{{ route('charts.index') }}" 
                   class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('charts.index') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                      <i class="fas fa-chart-line mr-3"></i> </i> charts
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer Navigation -->
    <div class="mt-auto p-4 border-t border-gray-700">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('profile.edit') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-user mr-3"></i> Profile
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center py-3 px-6">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-lg text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<script>
    // Initialize dropdown states based on localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = ['medicine', 'sales', 'purchase'];
        dropdowns.forEach(type => {
            const menu = document.getElementById(`${type}DropdownMenu`);
            const arrow = document.getElementById(`${type}DropdownArrow`);
            const state = localStorage.getItem(`${type}DropdownState`);

            if (state === 'open') {
                menu.classList.remove('hidden');
                arrow.classList.add('rotate-90');
            }
        });
    });

    function toggleDropdown(type) {
        const menu = document.getElementById(`${type}DropdownMenu`);
        const arrow = document.getElementById(`${type}DropdownArrow`);

        // Toggle dropdown visibility
        menu.classList.toggle('hidden');

        // Animate arrow rotation
        arrow.classList.toggle('rotate-90');

        // Save the state in localStorage
        if (menu.classList.contains('hidden')) {
            localStorage.setItem(`${type}DropdownState`, 'closed');
        } else {
            localStorage.setItem(`${type}DropdownState`, 'open');
        }
    }
</script>
