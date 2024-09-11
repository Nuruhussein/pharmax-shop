<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6">
        <!-- Invoice Header -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Invoice Details</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-lg font-medium text-gray-700"><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
                    <p class="text-lg font-medium text-gray-700"><strong>Sale ID:</strong> {{ $invoice->sale_id }}</p>
                </div>
                <div>
                    <p class="text-lg font-medium text-gray-700"><strong>Total Amount:</strong> ${{ number_format($invoice->total_amount, 2) }}</p>
                </div>
            </div>

            <!-- Sale Details -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Sale Details</h2>

                <p class="text-lg font-medium text-gray-700"><strong>Medicine:</strong> {{ $invoice->sale->medicine->name }}</p>
                <p class="text-lg font-medium text-gray-700"><strong>Quantity:</strong> {{ $invoice->sale->quantity }}</p>
                <p class="text-lg font-medium text-gray-700"><strong>Sale Price:</strong> ${{ number_format($invoice->sale->sale_price, 2) }}</p>
                <p class="text-lg font-medium text-gray-700"><strong>Sale Date:</strong> {{ $invoice->sale->sale_date }}</p>
            </div>
        </div>

        <!-- Back to Sales Link -->
        <div class=" mt-6 text-center">
            <a href="{{ route('sales.index') }}" class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md transition duration-150 ease-in-out">Back to Sales</a>
        </div>
    </div>
</x-app-layout>
