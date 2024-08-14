<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
   
    public function index()
    {
        $medicines = Medicine::with(['category', 'supplier'])->get();
        return view('medicines.index', compact('medicines'));
    }
  public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('medicines.create', compact('categories', 'suppliers'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'expiry_date' => 'required|date',
        ]);

        Medicine::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Medicine added successfully.');
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        
        return view('medicines.edit', compact('categories', 'suppliers','medicine'));
    }

    public function update(Request $request, Medicine $medicine)    //$medicine is an instance of Medicine
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'expiry_date' => 'required|date',
        ]);

        $medicine->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Medicine updated successfully.');
    }

  public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('dashboard')->with('success', 'Medicine deleted successfully.');
    }
     public function show(Medicine $medicine)  //object yetegegnechwa
    {
       $medicines = $medicine::with(['category', 'supplier'])->get();
        return view('medicines.show', compact('medicine'));
    }
    
      public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for medicines that match the query in the name field
        $medicines = Medicine::where('name', 'LIKE', "%{$query}%")->get();

        // Return the search results to the index view
        return view('medicines.index', compact('medicines'));
    }
}
