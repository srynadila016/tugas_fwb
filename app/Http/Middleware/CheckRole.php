<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $user = Auth::user();

        // Periksa apakah peran pengguna ada di daftar peran yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Jika tidak diizinkan, kembalikan response 403 (Forbidden)
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses yang diperlukan.');
        }

        return $next($request);
    }
}