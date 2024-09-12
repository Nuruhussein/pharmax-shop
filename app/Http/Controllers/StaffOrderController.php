<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Medicine;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffOrderController extends Controller
{
    /**
     * Display a list of all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->input('query'))
       { $query = $request->input('query');
        // Fetch all orders for staff
       $order = Order::where('order_code', $query)->first();

        // If order is found, redirect to the show page
        if ($order) {
            return redirect()->route('staff.orders.show', $order->order_code);
        }
         return redirect()->back()->with('error', 'Order not found.');
    }

        $orders = Order::with('doctor')->get();
        return view('orders.staff.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param  string  $orderCode
     * @return \Illuminate\Http\Response
     */
    public function show($orderCode)
    {
        // Find the order by its code
        $order = Order::where('order_code', $orderCode)->with('items.medicine')->firstOrFail();
        return view('orders.staff.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $orderCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderCode)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processed,completed',
        ]);

        // Find the order by its code
        $order = Order::where('order_code', $orderCode)->with('items.medicine')->firstOrFail();

        // Update the status
        $order->update(['status' => $request->input('status')]);

        // If the status is set to 'completed', reduce the medicine quantities
        if ($request->input('status') === 'completed') {
            foreach ($order->items as $item) {
                $medicine = $item->medicine;

                // Ensure that there is enough stock before deducting
                if ($medicine->quantity >= $item->quantity) {
                    // Reduce the medicine quantity
                    $medicine->decrement('quantity', $item->quantity);
                } else {
                    // Handle the case where there's not enough stock
                    return redirect()->back()->with('error', "Not enough stock for medicine: {$medicine->name}");
                }
            }
        }

        return redirect()->route('staff.orders.show', $order->order_code)->with('success', 'Order status updated successfully and stock adjusted.');
    }
}
