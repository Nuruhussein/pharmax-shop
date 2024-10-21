<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $request->file('photo') ? $request->file('photo')->store('news', 'public') : null;

        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('news.create')->with('success', 'News posted successfully.');
    }
}