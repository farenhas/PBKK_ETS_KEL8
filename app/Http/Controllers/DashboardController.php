<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();

        $lowStockItems = Item::where('quantity', '<', 10)->count();

        $itemsByCategory = Item::selectRaw('category_id, count(*) as count')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $itemsBySupplier = Item::selectRaw('supplier_id, count(*) as count')
            ->groupBy('supplier_id')
            ->with('supplier')
            ->get();

        $categories = $itemsByCategory->pluck('category.name');
        $categoryCounts = $itemsByCategory->pluck('count');

        $suppliers = $itemsBySupplier->pluck('supplier.name');
        $supplierCounts = $itemsBySupplier->pluck('count');

        return view('dashboard', compact(
            'totalItems', 
            'lowStockItems', 
            'itemsByCategory', 
            'itemsBySupplier', 
            'categories', 
            'categoryCounts', 
            'suppliers', 
            'supplierCounts'
        ));
    }
}
