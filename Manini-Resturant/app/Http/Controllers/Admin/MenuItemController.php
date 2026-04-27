<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('category')->orderBy('category_id')->paginate(20);
        $categories = MenuCategory::orderBy('sort_order')->get();
        return view('admin.menu-items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = MenuCategory::orderBy('sort_order')->get();
        return view('admin.menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:menu_categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $validated['featured']    = $request->boolean('featured');
        $validated['available']   = $request->boolean('available');
        $validated['vegetarian']  = $request->boolean('vegetarian');
        $validated['vegan']       = $request->boolean('vegan');
        $validated['gluten_free'] = $request->boolean('gluten_free');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu', 'public');
        }

        MenuItem::create($validated);
        return redirect()->route('admin.menu-items.index')->with('success', 'Item created.');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = MenuCategory::orderBy('sort_order')->get();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:menu_categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $validated['featured']    = $request->boolean('featured');
        $validated['available']   = $request->boolean('available');
        $validated['vegetarian']  = $request->boolean('vegetarian');
        $validated['vegan']       = $request->boolean('vegan');
        $validated['gluten_free'] = $request->boolean('gluten_free');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu', 'public');
        }

        $menuItem->update($validated);
        return redirect()->route('admin.menu-items.index')->with('success', 'Item updated.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('admin.menu-items.index')->with('success', 'Item deleted.');
    }

    public function toggleAvailability(MenuItem $menuItem)
    {
        $menuItem->update(['available' => !$menuItem->available]);
        return back()->with('success', 'Availability updated.');
    }
}