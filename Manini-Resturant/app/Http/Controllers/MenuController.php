<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::with(['items' => function ($q) {
            $q->where('available', true)->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        return view('menu.index', compact('categories'));
    }

    public function category($slug)
    {
        $categories = MenuCategory::with(['items' => function ($q) {
            $q->where('available', true)->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        $current = $categories->firstWhere('slug', $slug);

        return view('menu.index', compact('categories', 'current'));
    }
}
