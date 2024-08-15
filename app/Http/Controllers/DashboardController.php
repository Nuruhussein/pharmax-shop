<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Category; // Import the Category model
use Carbon\Carbon;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get counts for total medicines and suppliers
        $totalMedicines = Medicine::count();
        $totalSuppliers = Supplier::count();

        // Get count of medicines expiring soon
        $expiringSoon = Medicine::where('expiry_date', '<', Carbon::now()->addDays(30))->count();
       
      

        // Fetch all categories to populate the dropdown
        $categories = Category::all();

        // Initialize query for medicines
        $medicinesQuery = Medicine::with(['category', 'supplier']);

        // Check if there's a search query
        if ($request->input('query')) {
            $query = $request->input('query');
            $medicinesQuery->where('name', 'LIKE', "%{$query}%");
        }

        // Check if there's a category filter
        if ($request->input('category')) {
            $category = $request->input('category');
            $medicinesQuery->where('category_id',$category);
        }

        // Get the filtered or unfiltered list of medicines
        $medicines = $medicinesQuery->paginate(3);
  // Calculate total price based on quantity and price for each medicine
    $totalprice = $medicines->reduce(function ($carry, $medicine) {
        return $carry + ($medicine->price * $medicine->quantity);
    }, 0);

        // Pass the data to the view
        return view('dashboard', compact('totalMedicines', 'totalSuppliers', 'expiringSoon', 'medicines', 'categories','totalprice'));
    }
}