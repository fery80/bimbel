<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSiswa
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'siswa') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
