<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AutoLogout
{
    public function handle($request, Closure $next)
    {
        // Jika pengguna sudah masuk dan belum melewati timeout
        if (Auth::check() && time() - session('last_activity') > config('session.lifetime') * 60) {
            Auth::logout(); // Otomatis keluar pengguna
            return redirect('/login')->with('timeout', 'Sesi Anda telah berakhir karena tidak ada aktivitas selama ' . config('session.lifetime') . ' menit.');
        }

        session(['last_activity' => time()]); // Perbarui waktu aktivitas terakhir

        return $next($request);
    }
}
