<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $lowStockQuery = Product::whereColumn('current_stock', '<=', 'minimum_stock');

        $stats = [
            'products' => Product::count(),
            'suppliers' => Supplier::count(),
            'purchase_orders' => PurchaseOrder::count(),
            'low_stock' => (clone $lowStockQuery)->count(),
        ];

        $lowStock = (clone $lowStockQuery)
            ->with('category')
            ->orderBy('current_stock')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'lowStock'));
    }
}