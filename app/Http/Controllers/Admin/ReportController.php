<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function sales(Request $request)
    {
        $query = Sale::with('cashier');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sales = $query->latest()->paginate(20);
        
        // Summary stats based on filtered query (cloned to avoid pagination interfering)
        $statsQuery = clone $query;
        $totalSales = (float) $statsQuery->sum('total_amount');
        $totalTransactions = $statsQuery->count();
        $averageSale = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
        
        $todaySales = Sale::whereDate('created_at', today())->sum('total_amount') ?? 0;

        // Daily sales chart data (last 7 days)
        $dailySales = Sale::select(
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('SUM(total_amount) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        return view('admin.reports.sales', compact('sales', 'totalSales', 'todaySales', 'totalTransactions', 'averageSale', 'dailySales'));
    }

    public function products()
    {
        $products = Product::with('category')->paginate(20);
        return view('admin.reports.products', compact('products'));
    }

    public function categories()
    {
        $categories = Category::withCount('products')->paginate(20);
        return view('admin.reports.categories', compact('categories'));
    }

    public function suppliers()
    {
        $suppliers = Supplier::withCount('products')->paginate(20);
        return view('admin.reports.suppliers', compact('suppliers'));
    }

    public function inventory()
    {
        $products = Product::with('stock')->paginate(20);
        return view('admin.reports.inventory', compact('products'));
    }

    public function profitLoss()
    {
        return view('admin.reports.profit-loss');
    }

    public function export($type, $format)
    {
        // Export functionality
        return back()->with('info', 'Export feature coming soon!');
    }
}