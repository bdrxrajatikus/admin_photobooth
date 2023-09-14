<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;


class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total voucher
        $totalVoucher = Voucher::count();
    
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Welcome to the Dashboard',
            'totalVoucher' => $totalVoucher,
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
}
