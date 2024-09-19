@extends('layouts.commerce')

@section('content')
<div class="flex flex-col h-screen w-full items-center justify-center bg-gray-600">
    <div class="w-80 rounded bg-gray-50 px-6 pt-8 shadow-lg">
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="chippz" class="mx-auto w-16 py-4" />
        <div class="flex flex-col justify-center items-center gap-2">
            <h4 class="font-semibold">Business Name</h4>
            <p class="text-xs">Some address goes here</p>
        </div>
        <div class="flex flex-col gap-3 border-b py-6 text-xs">
            <p class="flex justify-between">
                <span class="text-gray-400">Order Reference:</span>
                <span>{{ $order->order_code }}</span>
            </p>
            <p class="flex justify-between">
                <span class="text-gray-400">Total Amount:</span>
                <span>{{ number_format($order->total_amount, 2) }} ETB</span>
            </p>
            <p class="flex justify-between">
                <span class="text-gray-400">Payment Status:</span>
                <span>{{ $order->status }}</span>
            </p>
            <p class="flex justify-between">
                <span class="text-gray-400">Customer:</span>
                <span>{{ Auth::user()->name }}</span>
            </p>
            <p class="flex justify-between">
                <span class="text-gray-400">Email:</span>
                <span>{{ Auth::user()->email }}</span>
            </p>
        </div>
        <div class="flex flex-col gap-3 pb-6 pt-2 text-xs">
            <table class="w-full text-left">
                <thead>
                    <tr class="flex">
                        <th class="w-full py-2">Product</th>
                        <th class="min-w-[44px] py-2">QTY</th>
                        <th class="min-w-[44px] py-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr class="flex">
                        <td class="flex-1 py-1">{{ $item->medicine->name }}</td>
                        <td class="min-w-[44px]">{{ $item->quantity }}</td>
                        <td class="min-w-[44px]">{{ $item->price }} ETB</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="border-b border-dashed"></div>
            <div class="py-4 justify-center items-center flex flex-col gap-2">
                <p class="flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21.3 12.23h-3.48c-.98 0-1.85.54-2.29 1.42l-.84 1.66c-.2.4-.6.65-1.04.65h-3.28c-.31 0-.75-.07-1.04-.65l-.84-1.65a2.567 2.567 0 0 0-2.29-1.42H2.7c-.39 0-.7.31-.7.7v3.26C2 19.83 4.18 22 7.82 22h8.38c3.43 0 5.54-1.88 5.8-5.22v-3.85c0-.38-.31-.7-.7-.7ZM12.75 2c0-.41-.34-.75-.75-.75s-.75.34-.75.75v2h1.5V2Z" fill="#000"></path><path d="M22 9.81v1.04a2.06 2.06 0 0 0-.7-.12h-3.48c-1.55 0-2.94.86-3.63 2.24l-.75 1.48h-2.86l-.75-1.47a4.026 4.026 0 0 0-3.63-2.25H2.7c-.24 0-.48.04-.7.12V9.81C2 6.17 4.17 4 7.81 4h3.44v3.19l-.72-.72a.754.754 0 0 0-1.06 0c-.29.29-.29.77 0 1.06l2 2c.01.01.02.01.02.02a.753.753 0 0 0 .51.2c.1 0 .19-.02.28-.06.09-.03.18-.09.25-.16l2-2c.29-.29.29-.77 0-1.06a.754.754 0 0 0-1.06 0l-.72.72V4h3.44C19.83 4 22 6.17 22 9.81Z" fill="#000"></path></svg> info@example.com</p>
                <p class="flex gap-2"> +234XXXXXXXX</p>
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-6 gap-4">
    <a href="{{ route('cart.payment.receipt', $order->order_code) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Download Receipt</a>
    <a href="{{ route('ecommerce.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Return to Home</a>
</div>
</div>

@endsection
