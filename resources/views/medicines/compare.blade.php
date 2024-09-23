{{-- <x-app-layout>


<div class="container mt-4">
    <h1>Compare Prices for {{ $medicine->name }}</h1>
    <p>Category: {{ $medicine->category->name }}</p>
    <p>Supplier: {{ $medicine->supplier->name }}</p>
    <p>Price: ${{ number_format($medicine->price, 2) }}</p>

    <h2>Other Suppliers Offering {{ $medicine->name }}</h2>

    @if($similarMedicines->isEmpty())
        <p>No other suppliers found for this medicine.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($similarMedicines as $similarMedicine)
                <tr>
                    <td>{{ $similarMedicine->supplier->name }}</td>
                    <td>${{ number_format($similarMedicine->price, 2) }}</td>
                    <td>{{ $similarMedicine->quantity }}</td>
                    <td>{{ $similarMedicine->expiry_date->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('medicines.show', $similarMedicine->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Back to Medicines List</a>
</div>
</x-app-layout> --}}