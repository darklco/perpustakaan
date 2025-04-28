<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }
    
        return redirect('/')->with('error', 'Akses ditolak!');
    }
}
