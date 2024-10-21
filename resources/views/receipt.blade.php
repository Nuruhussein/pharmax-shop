<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .card-container {
            width: 20rem;
            border-radius: 0.5rem;
            background-color: #ffffff;
            padding: 1.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            color: #333;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 4rem;
            padding: 1rem 0;
        }

        .business-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            color: #1f2937;
        }

        .business-info h4 {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1e3a8a;
        }

        .business-info p {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .order-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.5rem 0;
        }

        .order-details p {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #4b5563;
        }

        .order-details span {
            color: #374151;
        }

        .product-list {
            padding: 1.5rem 0;
            font-size: 0.9rem;
        }

        .product-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-list th, .product-list td {
            padding: 0.5rem 0;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-list th {
            font-weight: 600;
            color: #1f2937;
        }

        .product-list td {
            color: #6b7280;
        }

        .footer {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
            padding-top: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="card-container">
    <img src="https://th.bing.com/th/id/R.47b05b1a9609e27246898478bc3dc5ad?rik=EYTJ7VM4PKfc4Q&pid=ImgRaw&r=0" alt="chippz" class="logo" />
    <div class="business-info">
        <h4>Business Name</h4>
        <p>Some address goes here</p>
    </div>

    <div class="order-details">
        <p><span>Order Reference:</span> <span>{{ $order->order_code }}</span></p>
        <p><span>Total Amount:</span> <span>{{ number_format($order->total_amount, 2) }} ETB</span></p>
        <p><span>Payment Status:</span> <span>{{ $order->status }}</span></p>
        <p><span>Customer:</span> <span>{{ Auth::user()->name }}</span></p>
        <p><span>Email:</span> <span>{{ Auth::user()->email }}</span></p>
    </div>

    <div class="product-list">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>QTY</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->medicine->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} ETB</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>info@example.com</p>
        <p>+234XXXXXXXX</p>
    </div>
</div>
</body>
</html>
