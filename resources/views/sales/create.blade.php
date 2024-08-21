<x-app-layout>
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Record a New Sale</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="medicine_id" class="block text-gray-700">Medicine</label>
            <select name="medicine_id" id="medicine_id" class="block w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Select Medicine</option>
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}" data-price="{{ $medicine->price }}">{{ $medicine->name }}</option>
                @endforeach
            </select>
            @error('medicine_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="block w-full border border-gray-300 rounded px-3 py-2" min="1">
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="sale_price" class="block text-gray-700">Sale Price</label>
            <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" class="block w-full border border-gray-300 rounded px-3 py-2" step="0.01" >
            @error('sale_price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="sale_date" class="block text-gray-700">Sale Date</label>
            <input type="date" name="sale_date" id="sale_date" value="{{ old('sale_date') }}" class="block w-full border border-gray-300 rounded px-3 py-2">
            @error('sale_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Record Sale</button>
            <a href="{{ route('sales.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</a>
        </div>
    </form>
</div>

<script>
document.getElementById('medicine_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var price = selectedOption.getAttribute('data-price');
    document.getElementById('sale_price').value = price;
});
</script>

</x-app-layout>
