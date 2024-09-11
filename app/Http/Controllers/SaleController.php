<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('medicine')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $medicines = Medicine::all();
        return view('sales.create', compact('medicines'));
    }

   
public function store(Request $request)
{
    $request->validate([
        'medicine_id' => 'required|exists:medicines,id',
        'quantity' => 'required|integer',
        'sale_price' => 'required|numeric',
        'sale_date' => 'required|date',
    ]);

    $medicine = Medicine::find($request->medicine_id);
    
    if ($medicine->quantity < $request->quantity) {
        return redirect()->back()->with('error', 'Not enough stock available.');
    }

    DB::transaction(function() use ($request, $medicine) {
        $sale = Sale::create($request->all());

        // Update stock quantity in medicines table
        $medicine->quantity -= $request->quantity;
        $medicine->save();

        // Create invoice for the sale
        Invoice::create([
            'sale_id' => $sale->id,
            'total_amount' => $request->quantity * $request->sale_price,
            'invoice_date' => now(),
        ]);
    });

    return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
}

public function showInvoice(Invoice $invoice)
{
    return view('invoices.show', compact('invoice'));
}

    public function edit(Sale $sale)
    {
        $medicines = Medicine::all();
        return view('sales.edit', compact('sale', 'medicines'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer',
            'sale_price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        // Find the original medicine and adjust its stock
        $originalMedicine = Medicine::find($sale->medicine_id);
        $originalMedicine->quantity += $sale->quantity; // Return original quantity

        $medicine = Medicine::find($request->medicine_id);
        
        if ($medicine->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        // Update the sale
        $sale->update($request->all());

        // Update stock quantity in medicines table
        $medicine->quantity -= $request->quantity;
        $medicine->save();
        $originalMedicine->save(); // Save the original medicine

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        // Find the medicine and adjust its stock
        $medicine = Medicine::find($sale->medicine_id);
        $medicine->quantity += $sale->quantity;
        $medicine->save();

        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
