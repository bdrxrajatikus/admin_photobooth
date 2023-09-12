<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data yang dapat Anda kirimkan ke view
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Welcome to the Dashboard',
        ];
    
        return view('dashboards.index', compact('data'));
    }
}
