<!-- resources/views/layouts/dashboard.blade.php -->
<x-app-layout>
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Medicines -->
            <div class="bg-gray-50 shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-indigo-500">
                <h3 class="text-lg font-semibold text-gray-700">
                    <i class="fas fa-pills text-indigo-500"></i> Total Medicines
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $totalMedicines }}</p>
                <p class="mt-2 text-gray-500">Total number of medicines in inventory.</p>
            </div>

            <!-- Card 2: Total Suppliers -->
            <div class="bg-gray-50  shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-green-500">
                <h3 class="text-lg font-semibold text-gray-700">
                    <i class="fas fa-truck text-green-500"></i> Total Suppliers
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $totalSuppliers }}</p>
                <p class="mt-2 text-gray-500">Number of active suppliers.</p>
            </div>

            <!-- Card 3: Total Price -->
            @notRole('staff')
            <div class="bg-gray-50  shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-teal-500">
                <h3 class="text-lg font-semibold text-gray-700">
                    <i class="fas fa-usd text-teal-500"></i> Total Price
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $totalprice }} <i class="fas fa-usd text-teal-300"></i></p>
                <p class="mt-2 text-gray-500">Total value of inventory.</p>
            </div>
  @endnotRole
            <!-- Card 4: Total Sales -->
            <div class="bg-gray-50 shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-purple-500">
                <h3 class="text-lg font-semibold text-gray-700">
                    <i class="fas fa-usd text-purple-500"></i> Total Sales
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $totalsales }} <i class="fas fa-usd text-purple-300"></i></p>
                <p class="mt-2 text-gray-500">Total sales revenue.</p>
            </div>

            <!-- Card 5: Expiring Soon Medicines -->
            <div class="bg-gray-50  shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-red-300">
                <h3 class="text-lg font-semibold text-gray-700">
                    <i class="fas fa-exclamation-circle text-red-500"></i> Expiring Soon
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $expiringSoon }}</p>
                <p class="mt-2 text-gray-500">Medicines that are nearing their expiry date.</p>
            </div>
             
            {{-- card six --}}
            <div class="bg-gray-50  shadow-lg hover:shadow-xl rounded-lg p-6 border-t-4 border-red-500">
                <h3 class="text-lg font-semibold text-gray-700">
                   <i class="fas fa-ban text-red-700"></i> Expired Medicines
                </h3>
                <p class="mt-2 text-3xl font-bold text-gray-800">{{ $expiredMedicinesCount }}</p>
                <p class="mt-2 text-gray-500">Medicines that have expired.</p>
                <a href="{{ route('medicines.expired') }}" class="mt-2 inline-block text-red-600 hover:underline">View Details</a>
            </div>
        </div>
          @notRole('staff')
        @include('medicines.index')
        @endnotRole
    </div>
</x-app-layout>
