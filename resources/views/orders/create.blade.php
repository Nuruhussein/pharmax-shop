<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6 text-blue-500">Hello Doctor {{ Auth::user()->name }}</h1>
        <h2 class="text-2xl font-semibold mb-8 text-gray-800">Please Place Your Order</h2>
        <form action="{{ route('orders.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
            @csrf
            <div class="space-y-6">
                <div class="form-group">
                    <label for="medicines" class="block text-lg font-semibold text-gray-700 mb-2">Medicines</label>
                    <div id="medicines-container" class="space-y-4">
                        <div class="medicine-item flex items-center space-x-4 border border-gray-300 rounded-md p-4 shadow-sm bg-gray-50">
                            <select name="medicines[0][id]" class="form-select block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }} - ${{ $medicine->price }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="medicines[0][quantity]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Quantity">
                            <button type="button" class="remove-medicine text-red-500 hover:text-red-700 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-medicine" class="mt-4 flex items-center text-indigo-600 hover:text-indigo-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Add More Medicines
                    </button>
                </div>
                
                <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Place Order
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let medicineIndex = 1;

            document.getElementById('add-medicine').addEventListener('click', function() {
                const container = document.getElementById('medicines-container');
                const newMedicineItem = document.createElement('div');
                newMedicineItem.className = 'medicine-item flex items-center space-x-4 border border-gray-300 rounded-md p-4 shadow-sm bg-gray-50';

                newMedicineItem.innerHTML = `
                    <select name="medicines[${medicineIndex}][id]" class="form-select block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Select Medicine</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }} - ${{ $medicine->price }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="medicines[${medicineIndex}][quantity]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Quantity">
                    <button type="button" class="remove-medicine text-red-500 hover:text-red-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;

                container.appendChild(newMedicineItem);
                medicineIndex++;
            });

            document.getElementById('medicines-container').addEventListener('click', function(event) {
                if (event.target.closest('.remove-medicine')) {
                    event.target.closest('.medicine-item').remove();
                }
            });
        });
    </script>
</x-app-layout>
