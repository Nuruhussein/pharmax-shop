<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['medicine', 'supplier'])->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $medicines = Medicine::all();
        $suppliers = Supplier::all();
        return view('purchases.create', compact('medicines', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::create($request->all());

        // Update stock quantity in medicines table
        $medicine = Medicine::find($request->medicine_id);
        $medicine->quantity += $request->quantity;
        $medicine->save();

        return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully.');
    }

    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $medicines = Medicine::all();
        $suppliers = Supplier::all();
        return view('purchases.edit', compact('purchase', 'medicines', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::findOrFail($id);

        // Adjust stock quantity in medicines table before updating
        $oldQuantity = $purchase->quantity;
        $medicine = Medicine::find($purchase->medicine_id);
        $medicine->quantity -= $oldQuantity;
        $medicine->save();

        $purchase->update($request->all());

        // Adjust stock quantity after update
        $medicine = Medicine::find($request->medicine_id);
        $medicine->quantity += $request->quantity;
        $medicine->save();

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);

        // Adjust stock quantity in medicines table before deletion
        $medicine = Medicine::find($purchase->medicine_id);
        $medicine->quantity -= $purchase->quantity;
        $medicine->save();

        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
