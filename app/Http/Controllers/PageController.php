<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($pageName)
    {
        $title = ''; // Set judul halaman default
    
        if ($pageName === 'dashboard') {
            $title = 'Dashboard';
        } elseif ($pageName === 'users') {
            $title = 'Users';
        } elseif ($pageName === 'vouchers') {
            $title = 'Vouchers';
        } elseif ($pageName === 'templates') {
            $title = 'Templates';
        }
    
        $data = [
            'title' => $title,
            'subtitle' => 'Welcome to ' . $title,
        ];
    
        return view('master', $data);
    }
    
}
