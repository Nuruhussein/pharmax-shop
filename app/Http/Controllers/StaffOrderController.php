<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class StaffOrderController extends Controller
{
    /**
     * Display a list of all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('query')) {
            $query = $request->input('query');
            // Fetch the order
            $order = Order::where('order_code', $query)->first();

            // If order is found, redirect to the show page
            if ($order) {
                return redirect()->route('staff.orders.show', $order->order_code);
            }
            return redirect()->back()->with('error', 'Order not found.');
        }

        $orders = Order::with('user')->latest()->paginate(10);
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
        'status' => 'required|string|in:pending,cancelled,completed',
    ]);

    // Find the order by its code
    $order = Order::where('order_code', $orderCode)->with('items.medicine')->firstOrFail();

    // Update the status of the order
    $order->update(['status' => $request->input('status')]);

    // Handle status transitions
    if ($request->input('status') === 'completed') {
        // Create a sale record linked to the order
        $sale = Sale::updateOrCreate(
            ['order_id' => $order->id],
            [
                'sale_date' => now(),
                'total_amount' => $order->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
                 'order->user->name' => $order->user->name,
                'status' => 'pending', // You can set the initial status of the sale here
            ]
        );

        // Process each item in the order
        foreach ($order->items as $item) {
            SaleItem::updateOrCreate(
                [
                    'sale_id' => $sale->id,
                    'medicine_id' => $item->medicine_id,
                ],
                [
                    'quantity' => $item->quantity,
                    'sale_price' => $item->price,
                ]
            );
        }
    } elseif ($request->input('status') === 'cancelled') {
        // Find the related sale
        $sale = Sale::where('order_id', $order->id)->first() ;

        // If the sale exists and is approved, restore the stock
        if ($sale && $sale->status === 'approved') {
            foreach ($order->items as $item) {
                // Restore the stock of the medicine
                $medicine = Medicine::find($item->medicine_id);
                $medicine->quantity = $medicine->quantity + $item->quantity;
                $medicine->save();
            }
               Sale::where('order_id', $order->id)->delete();
            }
            // If the sale is pending, delete the sale record
            if ($sale && $sale->status === 'pending') {
                Sale::where('order_id', $order->id)->delete();
            }
            
        } 

    return redirect()->route('staff.orders.index', $order->order_code)->with('success', 'Order status updated successfully.');
}



    /**
     * Delete an order.
     *
     * @param  string  $orderCode
     * @return \Illuminate\Http\Response
     */
    public function destroy($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        // First, delete all related order items
        $order->items()->delete();  // Assuming the relationship is named 'items'

        // Delete the order
        $order->delete();

        return redirect()->route('staff.orders.index')->with('success', 'Order deleted successfully');
    }
}
