<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // List all items
    public function index()
    {
        $items = Item::latest()->get();
        return view('admin.items.index', compact('items'));
    }

    // Show form to create new item
    public function create()
    {
        return view('admin.items.create');
    }

    // Store new item
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
        ]);

        Item::create($request->only(['item_name', 'item_description']));

        return redirect()->route('admin.items.index')->with('success', 'Item added successfully.');
    }

    // Show form to edit existing item
    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    // Update item
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
        ]);

        $item->update($request->only(['item_name', 'item_description']));

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }

    // Delete item
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}
