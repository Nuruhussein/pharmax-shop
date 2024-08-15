<!-- resources/views/layouts/dashboard.blade.php -->
<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Medicines -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-pills text-indigo-600"></i> Total Medicines
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-600">{{ $totalMedicines }}</p>
                <p class="mt-2 text-gray-500">Total number of medicines in inventory.</p>
            </div>

            <!-- Card 2: Total Suppliers -->
            {{-- <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-truck text-green-600"></i> Total Suppliers
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-600">{{ $totalSuppliers }}</p>
                <p class="mt-2 text-gray-500">Number of active suppliers.</p>
            </div> --}}
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-usd text-green-600"></i> Total price
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-600">{{ $totalprice }}<i class="fas fa-usd text-green-300"></i></p>
                <p class="mt-2 text-gray-500">total number of price.</p>
            </div>

            <!-- Card 3: Expiring Soon Medicines -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-exclamation-circle text-red-600"></i> Expiring Soon
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-600">{{ $expiringSoon }}</p>
                <p class="mt-2 text-gray-500">Medicines that are nearing their expiry date.</p>
            </div>
        </div>
          @include('medicines.index')

    </div>

</x-app-layout>
