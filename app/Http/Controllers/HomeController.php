<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'menu')->orderBy('sort_order')->get();
        $featured = MenuItem::with('category')
            ->where('is_featured', true)
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('categories', 'featured'));
    }
}