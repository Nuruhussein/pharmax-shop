<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the latest 3 products
        // $products = Product::latest()->take(3)->get();
          // $products = Product::all();
        // Fetch the latest 3 categories
        // $categories = Category::latest()->take(3)->get();
         $categories = Category::latest()->paginate(3);
        $allCategories =Category::all();
          $query = Medicine::query();

    if ($request->query('category')) {
        $categoryId = $request->query('category');
        $query->where('category_id', $categoryId);
    }

    if ($request->query('sort')) {
        if ($request->query('sort') == 'ascPrice') {
            $query->orderBy('price', 'asc');
        } elseif ($request->query('sort') == 'descPrice') {
            $query->orderBy('price', 'desc');
        }
    }

    $medicines = $query->paginate(12); // Paginate results

          if ($request->ajax()) {
            return view('ecommerce.partials.medicines', compact('medicines'))->render();
        }
        // Return the data to the view
        return view('ecommerce.index', compact('medicines', 'categories','allCategories'));
    }


    //   public function filterByCategory($categoryId)
    // {
    //     $categories = Category::all();
    //     $products = Product::where('category_id', $categoryId)->get();
    //     return view('products.index', compact('categories', 'products'));
    // }
}