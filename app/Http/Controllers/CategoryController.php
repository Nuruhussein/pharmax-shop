<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
     $categories = Category::withCount('medicines')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('photo')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/categories', $imageName);
            $validatedData['photo'] = 'categories/' . $imageName;
        }

        // Create the category
        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
   public function detail(Category $category)
    {
        return view('categories.detail', compact('category'));
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('photo')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/categories', $imageName);
            $validatedData['photo'] = 'categories/' . $imageName;
        }

        // Update the category
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}