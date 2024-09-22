@extends('layouts.commerce')

@section('content')
<div class="p-4 bg-white rounded-lg shadow-lg">
    <div class="mt-20 overflow-x-auto">
        <table id="cart" class="min-w-full divide-y divide-gray-200 max-w-5xl mx-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width:40%">Medicine</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width:15%">Price</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width:10%">Quantity</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider text-center" style="width:25%">Subtotal</th>
                    <th class="px-4 py-2" style="width:10%"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php $total = 0 @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php 
                            $price = $details['price'] ?? 0;
                            $quantity = $details['quantity'] ?? 1;
                            $subtotal = $price * $quantity;
                            $total += $subtotal;
                        @endphp
                        <tr data-id="{{ $id }}" class="hover:bg-gray-50">
                            <td data-th="medicine" class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('storage/' . ($details['image'] ?? '')) }}" class="w-16 h-16 object-cover rounded-md" alt="{{ $details['name'] ?? 'Medicine' }}" />
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $details['name'] ?? 'Unknown Medicine' }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price" class="px-4 py-2 whitespace-nowrap text-sm text-gray-600">${{ number_format($price, 2) }}</td>
                            <td data-th="Quantity" class="px-4 py-2 whitespace-nowrap">
                                <input type="number" value="{{ $quantity }}" class="form-input mt-1 block w-16 sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 cart_update" min="1" />
                            </td>
                            <td data-th="Subtotal" class="px-4 py-2 whitespace-nowrap text-sm text-gray-600 text-center">${{ number_format($subtotal, 2) }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-red-600 hover:text-red-800 focus:outline-none cart_remove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="px-4 py-4 text-right text-lg font-semibold text-gray-900">
                        <strong>Total: <span id="total" class="pl-4">${{ number_format($total, 2) }}</span></strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="px-4 py-4 text-right">
                        <a href="{{ url('/ecommerce') }}" class="inline-flex items-center px-3 py-2 border border-transparent rounded-md bg-gradient-to-r from-white to-gray-100 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fa fa-arrow-left"></i> Continue Shopping
                        </a>
                        <form action="{{ route('checkout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center mx-4 px-3 py-2 border border-transparent rounded-md shadow-sm bg-gradient-to-r from-white to-blue-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <i class="fa fa-money"></i> Checkout
                            </button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    // Update Cart Quantity
    $(".cart_update").change(function (e) {
        e.preventDefault();

        var ele = $(this);
        var quantity = ele.val();
        var price = parseFloat(ele.closest("tr").find("td[data-th='Price']").text().replace('$', ''));
        var subtotal = price * quantity;

        // Update the subtotal
        ele.closest("tr").find("td[data-th='Subtotal']").text("$" + subtotal.toFixed(2));

        // Update total price
        updateTotal();

        // Send the AJAX request to update quantity in backend
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "PATCH",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: quantity
            },
            success: function (response) {
                // Handle success response if needed
            }
        });
    });

    // Remove Cart Item
    $(".cart_remove").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to remove this item?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload(); // Reload to reflect the changes
                }
            });
        }
    });

    // Update the total price dynamically
    function updateTotal() {
        var total = 0;
        $("tbody tr").each(function () {
            var subtotal = parseFloat($(this).find("td[data-th='Subtotal']").text().replace('$', ''));
            total += subtotal;
        });
        $("#total").text("$" + total.toFixed(2));
    }
</script>
@endsection
