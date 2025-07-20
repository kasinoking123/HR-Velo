<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\VarDumper;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki role admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            // Jika bukan admin, redirect dengan pesan error
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
    

}
