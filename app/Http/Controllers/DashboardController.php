<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalMedicines = Medicine::count();
   
        $totalSuppliers = Supplier::count();
        $expiringSoon = Medicine::where('expiry_date', '<', Carbon::now()->addDays(30))->count();
    
        if( ! $request->input('query'))
      $medicines = Medicine::with(['category', 'supplier'])->get();
    
    $query = $request->input('query');
   $medicines = Medicine::where('name', 'LIKE', "%{$query}%")->get();
        return view('dashboard', compact('totalMedicines', 'totalSuppliers', 'expiringSoon','medicines'));
    }}
   
  
