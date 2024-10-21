<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;


class EcommerceController extends Controller
{
   public function index(Request $request)
    {
        $medicines = Medicine::where('expiry_date', '>', now())->paginate(6);
        $categories = Category::with(['medicines' => function($query) {
            $query->where('expiry_date', '>', now())->take(4); 
        }])->latest()->paginate(3);

        $news = News::latest()->take(5)->get(); // Fetch latest 5 news

        return view('ecommerce.index', compact('medicines', 'categories', 'news'));
    }

    public function newsIndex()
    {
        $news = News::all();
        return view('ecommerce.news.index', compact('news'));
    }
 public function show(Category $category)
    {
        return view('ecommerce.category.show', compact('category'));
    }


 public function shop(Request $request)
    {
        //   $categories = Category::latest()->paginate(3);
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

    $medicines = $query->get(); // Paginate results

          if ($request->ajax()) {
            return view('ecommerce.partials.medicines', compact('medicines'))->render();
        }
        return view('ecommerce.shop.index',compact('medicines', 'allCategories'));
    }

 
 public function about(Category $category)
    {
        return view('ecommerce.components.aboutus');
    }

    
}