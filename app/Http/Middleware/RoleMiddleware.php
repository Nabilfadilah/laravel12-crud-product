<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Middleware untuk membatasi akses berdasarkan role user
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user(); // ambil user yang sedang login

        // jika tidak login atau role user tidak ada di daftar role yang diizinkan 
        if (!$user || !in_array($user->role, $roles)) {
            abort(403); // tampilkan forbidden jika tidak sesuai
        }

        return $next($request); // lanjutkan ke proses berikutnya
    }
}
