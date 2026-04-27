<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = MenuItem::with('category')
            ->where('featured', true)
            ->where('available', true)
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('approved', true)
            ->latest()
            ->take(3)
            ->get();

        $stats = [
            'years'     => 37,
            'dishes'    => 120,
            'customers' => 50000,
            'chefs'     => 8,
        ];

        return view('home.index', compact('featuredItems', 'testimonials', 'stats'));
    }
}
