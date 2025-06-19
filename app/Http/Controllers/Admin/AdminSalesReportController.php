<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Laporan penjualan bisa disesuaikan dengan kebutuhan admin
        $totalSales = Transaction::where('status', 'completed')->sum('total_price');
        $totalTransactions = Transaction::where('status', 'completed')->count();
        $averageOrderValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        $dailySales = Transaction::select(
                                    DB::raw('DATE(created_at) as date'),
                                    DB::raw('SUM(total_price) as total')
                                )
                                ->where('status', 'completed')
                                ->groupBy('date')
                                ->orderBy('date')
                                ->get();

        return view('admin.reports.sales', compact('totalSales', 'totalTransactions', 'averageOrderValue', 'dailySales'));
    }
}