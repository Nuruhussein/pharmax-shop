<x-app-layout>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">Expired Medicines</h1>

    @if($expired_medicines->isEmpty())
        <p class="text-red-500">No expired medicines found.</p>
    @else
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Medicine Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expired_medicines as $medicine)
                    <tr>
                        <td class="border px-4 py-2">{{ $medicine->name }}</td>
                        <td class="border px-4 py-2">{{ $medicine->quantity }}</td>
                        <td class="border px-4 py-2">{{ $medicine->expiry_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</x-app-layout>
