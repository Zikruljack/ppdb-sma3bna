<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PpdbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // pisahkan session pendaftar ppdb dengan user dashboard
        if (auth()->check() && auth()->user()->role == 'ppdb') {
            return redirect()->route('ppdb.account');
        }else{
            return redirect()->route('landing.page');
        }
        return $next($request);
    }
}
