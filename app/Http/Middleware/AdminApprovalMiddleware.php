<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            // Memeriksa apakah pengguna memiliki role 1 (Admin Approval)
            if (Auth::user()->role == 1) {
                return $next($request);
            } else {
                // Logout pengguna jika role tidak sesuai dan arahkan ke halaman login dengan pesan error
                Auth::logout();
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        // Jika tidak terautentikasi, arahkan ke halaman login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}
