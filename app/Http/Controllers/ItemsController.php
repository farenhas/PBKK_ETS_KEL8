<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

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
            ->paginate(20);

        return view('items.index', compact('items', 'search'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $suppliers = \App\Models\Supplier::all();

        return view('items.create', compact('suppliers'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
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
