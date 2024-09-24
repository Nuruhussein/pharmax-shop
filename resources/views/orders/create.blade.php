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
                            <select name="medicines[0][id]" class="form-select block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 medicine-dropdown">
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

                <!-- Buttons -->
                <div class="flex justify-end mr-8 items-center space-x-4">
                    <button type="submit"  class="w-48 py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Place Order
                    </button>
                    <a href="{{ url()->previous() }}"  class="w-48 py-3 px-6 bg-gray-800 text-center text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            let medicineIndex = 1;

            // Initialize Select2 for existing medicine dropdown
            $('.medicine-dropdown').select2({
                placeholder: 'Search for medicine',
                allowClear: true
            });

            // Function to add a new medicine row
            $('#add-medicine').on('click', function() {
                const container = $('#medicines-container');
                const newMedicineItem = $(`
                    <div class="medicine-item flex items-center space-x-4 border border-gray-300 rounded-md p-4 shadow-sm bg-gray-50">
                        <select name="medicines[${medicineIndex}][id]" class="form-select block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 medicine-dropdown">
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
                    </div>
                `);

                container.append(newMedicineItem);

                $('.medicine-dropdown').last().select2({
                    placeholder: 'Search for medicine',
                    allowClear: true
                });

                medicineIndex++;
            });

            // Remove medicine item
            $('#medicines-container').on('click', '.remove-medicine', function() {
                $(this).closest('.medicine-item').remove();
            });
        });
    </script>
</x-app-layout>
