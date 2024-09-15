<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine; 
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {

            // Total Sales and Purchases
        $totalSales = Sale::sum('total_amount');
        $totalPurchases = Purchase::sum('purchase_price');
        // Medicine Distribution by Category
        $salesData = Sale::select(
            DB::raw('MONTH(sale_date) as month'),
            DB::raw('SUM(total_amount) as total_sales')
        )
        ->groupBy('month')
        ->get();

        // Convert numeric months to full month names
        $labels = $salesData->pluck('month')->map(function ($month) {
            return date("F", mktime(0, 0, 0, $month, 1)); // Converts month number to month name
        });

        $chartData = $salesData->pluck('total_sales');

        // Medicine Distribution by Category
        $medicineDistribution = Medicine::select('categories.name as category_name', DB::raw('SUM(medicines.quantity) as total_quantity'))
                                        ->join('categories', 'medicines.category_id', '=', 'categories.id')
                                        ->groupBy('categories.name')
                                        ->get();

        return view('charts.index', compact('medicineDistribution', 'labels', 'chartData','totalSales', 'totalPurchases'));
    }
}
