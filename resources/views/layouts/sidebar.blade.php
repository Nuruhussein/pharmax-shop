<div class="flex flex-col w-64 h-screen bg-gray-900">
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
                <li>
                    <a href="{{ route('medicines.create') }}" 
                       class="flex items-center py-3 px-6 text-lg {{ Request::routeIs('medicines.create') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                        <i class="fas fa-pills mr-3"></i> Add Medicine
                    </a>
                </li>
            @endif
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
