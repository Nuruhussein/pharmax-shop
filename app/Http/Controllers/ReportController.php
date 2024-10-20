<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function report($type)
    {
       
        $sales = collect();
        $title = "Sales Report";
        $now = Carbon::now();
        
       
        switch ($type) {
            case 'daily':
                // Fetch approved sales for today
                $sales = Sale::where('status', 'approved')
                    ->whereDate('sale_date', Carbon::today())
                    ->get();
                $title = "Daily Sales Report";
                break;

            case 'weekly':
               
                $sales = Sale::where('status', 'approved')
                    ->whereBetween('sale_date', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek(),
                    ])->get();
                $title = "Weekly Sales Report";
                break;

            case 'monthly':
             
                $sales = Sale::where('status', 'approved')
                    ->whereBetween('sale_date', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth(),
                    ])->get();
                $title = "Monthly Sales Report";
                break;

            case 'yearly':
              
                $sales = Sale::where('status', 'approved')
                    ->whereBetween('sale_date', [
                        Carbon::now()->startOfYear(),
                        Carbon::now()->endOfYear(),
                    ])->get();
                $title = "Yearly Sales Report";
                break;

            default:
                $title = "Invalid Report Type";
        }

        return view('reports.index', compact('sales', 'title'));
    }
}
