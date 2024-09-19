<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Order Receipt</h1>
        <div class="mb-4">
            <p class="text-gray-700"><strong>Order Reference:</strong> {{ $order->order_code }}</p>
            <p class="text-gray-700"><strong>Total Amount:</strong> {{ number_format($order->total_amount, 2) }} ETB</p>
            <p class="text-gray-700"><strong>Payment Status:</strong> {{ $order->status }}</p>
            <p class="text-gray-700"><strong>Customer Name:</strong> {{ $order->user->name }}</p>
            <p class="text-gray-700"><strong>Customer Email:</strong> {{ $order->user->email }}</p>
        </div>
        <!-- Add more details as needed -->
    </div>
</body>
</html>
