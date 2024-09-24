<?php


namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Medicine;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items.medicine')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        
      $medicines = Medicine::where('expiry_date', '>', now())->get();
        return view('sales.create', compact('medicines'));
    }

  public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'items.*.medicine_id' => 'required|exists:medicines,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.sale_price' => 'required|numeric|min:0',
        'sale_date' => 'required|date',
        'order_id' => 'nullable|exists:orders,id',
        'status' => 'in:pending,approved',
        'user_id' => 'nullable|exists:users,id'
    ]);

    if (!$request->has('items') || !is_array($request->input('items'))) {
        return redirect()->back()->with('error', 'No sales items provided.');
    }

    $totalAmount = 0;
    $items = $request->input('items');

    // First, check if there is enough stock for all items
    foreach ($items as $itemData) {
        $medicine = Medicine::find($itemData['medicine_id']);
        if ($medicine->quantity < $itemData['quantity']) {
            return redirect()->back()->with('error', "Not enough stock for medicine: {$medicine->name}");
        }
    }

    // Create the sale
    $sale = Sale::create([
        'order_id' => $request->input('order_id'),
        'user_id' => $request->input('user_id', null),
        'total_amount' => 0,
        'sale_date' => $request->input('sale_date'),
        'status' => $request->input('status', 'pending'),
    ]);

    // Handle the sale items and adjust stock if approved
    foreach ($items as $itemData) {
        $medicine = Medicine::find($itemData['medicine_id']);

        SaleItem::create([
            'sale_id' => $sale->id,
            'medicine_id' => $itemData['medicine_id'],
            'quantity' => $itemData['quantity'],
            'sale_price' => $itemData['sale_price'],
        ]);

        $totalAmount += $itemData['quantity'] * $itemData['sale_price'];
        
        // Adjust stock if sale is approved
        if ($sale->status === 'approved') {
            $medicine->decrement('quantity', $itemData['quantity']);
        }
    }

    // Update total amount of sale
    $sale->update(['total_amount' => $totalAmount]);

    return redirect()->route('sales.index')->with('toast', 'Medicine successfully added.');
}


    public function approve(Sale $sale)
    {
        if ($sale->status !== 'approved') {
            $sale->status = 'approved';
            $sale->save();

            // Adjust stock for approved sale
            foreach ($sale->items as $item) {
                $medicine = $item->medicine;
                if ($medicine->quantity >= $item->quantity) {
                    $medicine->decrement('quantity', $item->quantity);
                } else {
                    return redirect()->back()->with('error', "Not enough stock for medicine: {$medicine->name}");
                }
            }

            return redirect()->route('sales.index')->with('success', 'Sale approved and stock updated.');
        }

        return redirect()->route('sales.index')->with('error', 'Sale is already approved.');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

public function destroy(Request $request, Sale $sale)
{
    $restoreStock = $request->query('restore_stock', 'false') === 'true';

    if ($restoreStock) {
        // Restore medicine quantity
        foreach ($sale->items as $item) {
            $medicine = $item->medicine;
            $medicine->increment('quantity', $item->quantity);
        }
    }

    // Delete the sale
    $sale->delete();

    return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.' . ($restoreStock ? ' Stock has been restored.' : ''));
}



    public function edit($id)
    {
        $sale = Sale::with('items.medicine')->findOrFail($id);
        $medicines = Medicine::all();

        return view('sales.edit', compact('sale', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'order_id' => 'nullable|string',
            'items' => 'required|array',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.sale_price' => 'required|numeric|min:0',
        ]);

        $sale = Sale::findOrFail($id);

        // Restore stock for previously recorded items
        foreach ($sale->items as $item) {
            $medicine = $item->medicine;
            $medicine->increment('quantity', $item->quantity); // Restore stock
        }

        $sale->sale_date = $request->sale_date;
        $sale->order_id = $request->order_id;

        $totalAmount = 0;

        // Update or create sale items and adjust stock if sale is approved
        foreach ($request->items as $itemData) {
            $medicine = Medicine::find($itemData['medicine_id']);

            $saleItem = $sale->items()->updateOrCreate(
                ['medicine_id' => $itemData['medicine_id']],
                ['quantity' => $itemData['quantity'], 'sale_price' => $itemData['sale_price']]
            );

            $totalAmount += $itemData['quantity'] * $itemData['sale_price'];

            // If sale is approved, update stock
            if ($sale->status === 'approved') {
                if ($medicine->quantity >= $itemData['quantity']) {
                    $medicine->decrement('quantity', $itemData['quantity']);
                } else {
                    return redirect()->back()->with('error', "Not enough stock for medicine: {$medicine->name}");
                }
            }
        }

        $sale->total_amount = $totalAmount;
        $sale->save();

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }
}
