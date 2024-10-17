<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $lowStock = $request->input('low_stock', false);
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $items = Item::with(['supplier', 'category'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('supplier', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($lowStock, function ($query) {
                return $query->where('quantity', '<', 10);
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate(20)
            ->appends(['search' => $search, 'sort_by' => $sortBy, 'sort_direction' => $sortDirection, 'low_stock' => $lowStock]);

        return view('items.index', compact('items', 'search', 'sortBy', 'sortDirection', 'lowStock'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('items.create', compact('suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item added successfully');
    }

    public function edit(Item $item)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('items.edit', compact('item', 'suppliers', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }


    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
