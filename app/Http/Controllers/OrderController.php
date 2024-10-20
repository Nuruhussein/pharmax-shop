<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Medicine;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $medicines = Medicine::where('expiry_date', '>', now())->get();
        
        // Fetch users with role 'customer'
        $customers = User::where('role', 'customer')->get();

        return view('orders.create', compact('medicines', 'customers'));
    }

public function store(Request $request)
{
    $request->validate([
        'user_name' => 'required|string|max:255',
        'card_number' => 'required|string|max:255',
        'medicines' => 'required|array',
        'medicines.*.id' => 'required|exists:medicines,id',
        'medicines.*.quantity' => 'required|integer|min:1',
    ]);

    $orderCode = strtoupper(uniqid('ORD'));

    // Create the order
    $order = Order::create([
        'user_id' => Auth::id(),
        'user_name' => $request->user_name, // Store user name
        'card_number' => $request->card_number, // Store card number
        'order_code' => $orderCode,
        'status' => 'pending',
        'total_amount' => 0, // Initialize the total amount
    ]);

    $totalAmount = 0;

    foreach ($request->input('medicines') as $medicineData) {
        $medicine = Medicine::findOrFail($medicineData['id']);
        
        // Check for sufficient quantity
        if ($medicine->quantity < $medicineData['quantity']) {
            return redirect()->back()->with('error', 'Insufficient stock for ' . $medicine->name . '. Available quantity: ' . $medicine->quantity);
        }

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