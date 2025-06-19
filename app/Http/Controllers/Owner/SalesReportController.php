<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Statistik penjualan
        $totalSales = Transaction::where('status', 'completed')->sum('total_price');
        $totalTransactions = Transaction::where('status', 'completed')->count();
        $averageOrderValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
        $productSales = DB::table('transaction_items')
                            ->select('products.name', DB::raw('SUM(transaction_items.quantity) as total_quantity_sold'))
                            ->join('products', 'transaction_items.product_id', '=', 'products.id')
                            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
                            ->where('transactions.status', 'completed')
                            ->groupBy('products.name')
                            ->orderByDesc('total_quantity_sold')
                            ->get();

        return view('owner.reports.sales', compact('totalSales', 'totalTransactions', 'averageOrderValue', 'productSales'));
    }
}