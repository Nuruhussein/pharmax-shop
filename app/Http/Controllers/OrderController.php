<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
     $medicines = Medicine::where('expiry_date', '>', now())->get();
        return view('orders.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicines' => 'required|array',
            'medicines.*.id' => 'required|exists:medicines,id',
            'medicines.*.quantity' => 'required|integer|min:1',
        ]);

        $orderCode = strtoupper(uniqid('ORD'));

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => $orderCode,
            'status' => 'pending',
            'total_amount' => 0, // Initialize the total amount
        ]);

        $totalAmount = 0;

        foreach ($request->input('medicines') as $medicineData) {
            $medicine = Medicine::findOrFail($medicineData['id']);
            $price = $medicine->price; // Assuming each medicine has a price

            OrderItem::create([
                'order_id' => $order->id,
                'medicine_id' => $medicineData['id'],
                'quantity' => $medicineData['quantity'],
                'price' => $price,
            ]);

            $totalAmount += $medicineData['quantity'] * $price;
        }

        // Update the total amount
        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully. Code: ' . $orderCode);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->get();
        return view('orders.index', compact('orders'));
    }

    public function show($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();
        return view('orders.show', compact('order'));
    }
}
