<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class PpdbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //Check if user role siswa, then cant use this url, redirect to url/ppdb/login
        //set unauthorized

        $user = auth()->user();
        if ($user && $user->hasRole('siswa')) {
            return redirect()->route('ppdb.login');
        }

        // If the user exists, allow the request to proceed
        return $next($request);
    }
}
