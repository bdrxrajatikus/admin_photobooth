<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voucher;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total voucher
        $totalVoucher = Voucher::count();
        
        // Inisialisasi totalRevenue dengan nilai awal 0
        $totalRevenue = Transaction::sum('final_price');
    
    
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Welcome to the Dashboard',
            'totalVoucher' => $totalVoucher,
            'totalRevenue' => $totalRevenue,
        ];
    
        $title = 'Dashboard';
        return view('dashboards.index', compact('data', 'title'));
    }
    
    
    public function getTotalVoucher(Request $request)
    {
        $filter = $request->input('filter');

        // Mengambil total voucher sesuai dengan filter yang diterima
        if ($filter === 'today') {
            $totalVoucher = Voucher::whereDate('created_at', today())->count();
        } elseif ($filter === 'month') {
            $totalVoucher = Voucher::whereMonth('created_at', now())->count();
        } elseif ($filter === 'year') {
            $totalVoucher = Voucher::whereYear('created_at', now())->count();
        } else {
            $totalVoucher = Voucher::count();
        }

        // Mengirim data total voucher ke client dalam format JSON
        return response()->json(['success' => true, 'totalVoucher' => $totalVoucher]);
    }

    public function getTotalRevenue(Request $request)
    {
        $filter = $request->input('filter');

        $query = Transaction::query();

        // Filter transaksi berdasarkan tanggal
        if ($filter === 'today') {
            $query->whereDate('transaction_date', today());
        } elseif ($filter === 'month') {
            $query->whereMonth('transaction_date', now());
        } elseif ($filter === 'year') {
            $query->whereYear('transaction_date', now());
        }

        // Mengambil total nominal transaksi
        $totalRevenue = $query->sum('final_price');

        // Format total nominal transaksi menjadi rupiah
        $totalRevenueFormatted = 'Rp ' . number_format($totalRevenue, 0, ',', '.');

        // Mengirim data total nominal transaksi ke client dalam format JSON
        return response()->json(['success' => true, 'totalRevenue' => $totalRevenueFormatted]);
    }
}
