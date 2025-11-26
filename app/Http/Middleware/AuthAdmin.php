<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Jika route login, biarkan lewat
        if ($request->routeIs('login') || $request->routeIs('login.post')) {
            return $next($request);
        }

        // Kalau user login dan role admin → lanjut
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Kalau gagal → redirect ke login
        return redirect()->route('login')->with('error', 'Silahkan login sebagai admin.');
    }
}
