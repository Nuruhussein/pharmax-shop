<x-app-layout>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6 text-blue-500">Create Sale</h1>

        <!-- Display success or error messages -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Sale Creation Form -->
        <form id="saleForm" action="{{ route('sales.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
            @csrf

            <div class="space-y-6">
                <!-- Sale Date Input -->
                <div class="mb-4">
                    <label for="sale_date" class="block text-lg font-semibold text-gray-700 mb-2">Sale Date</label>
                    <input type="date" name="sale_date" id="sale_date" class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                </div>

                <!-- Order ID Input -->
                <div class="mb-4">
                    <label for="order_id" class="block text-lg font-semibold text-gray-700 mb-2">Order ID (Optional)</label>
                    <input type="text" name="order_id" id="order_id" class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </div>

                <!-- Add More Items Button and JavaScript Section -->
                <div id="items-container" class="space-y-4">
                    <div class="flex justify-between mt-8 pt-8 items-center">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">Add Items</h2>
                        <button type="button" id="add-item" class="flex items-center text-indigo-600 hover:text-indigo-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Add More Items
                        </button>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center space-x-4 border border-gray-300 rounded-md p-4 shadow-sm bg-gray-50">
                            <select name="items[0][medicine_id]" class="form-select select2 block w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }} - ${{ $medicine->price }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="items[0][quantity]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Quantity" min="1" required>
                            <input type="number" name="items[0][sale_price]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Sale Price" step="0.01" required>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 gap-4 flex flex-row-reverse">
                    <button type="submit" class="w-48 py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Create Sale
                    </button>
                    <a href="{{ route('sales.index') }}" class="w-48 py-3 px-6 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Include jQuery (required for Select2 and Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include Toastr CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Select2 on the first dropdown
            $('.select2').select2({
                placeholder: 'Search for a medicine',
                allowClear: true
            });

            let itemIndex = 1; // Start after the first item

            function createItemHtml(index) {
                return `
                    <div class="flex items-center space-x-4 border border-gray-300 rounded-md p-4 shadow-sm bg-gray-50">
                        <select name="items[${index}][medicine_id]" class="form-select select2 block w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">Select Medicine</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }} - ${{ $medicine->price }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="items[${index}][quantity]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Quantity" min="1" required>
                        <input type="number" name="items[${index}][sale_price]" class="form-input block w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Sale Price" step="0.01" required>
                        <button type="button" class="remove-item text-red-500 hover:text-red-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
            }

            // Add more items dynamically
            $('#add-item').click(function () {
                const container = $('#items-container');
                container.append(createItemHtml(itemIndex));

                // Initialize Select2 for the newly added dropdown
                $(`select[name="items[${itemIndex}][medicine_id]"]`).select2({
                    placeholder: 'Search for a medicine',
                    allowClear: true
                });

                // Show toast message
                toastr.success('Item added successfully!');

                itemIndex++;
            });

            // Remove an item
            $('#items-container').on('click', '.remove-item', function () {
                $(this).closest('.flex').remove();
                toastr.info('Item removed.');
            });

            // Form validation
            $('#saleForm').submit(function (event) {
                let valid = true;
                $('#items-container .flex').each(function () {
                    const quantity = $(this).find('input[name*="[quantity]"]').val();
                    const salePrice = $(this).find('input[name*="[sale_price]"]').val();

                    if (!quantity || !salePrice) {
                        valid = false;
                    }
                });

                if (!valid) {
                    event.preventDefault(); // Prevent form submission
                    alert('Please provide both quantity and sale price for each item.');
                }
            });
        });
    </script>

</x-app-layout>
