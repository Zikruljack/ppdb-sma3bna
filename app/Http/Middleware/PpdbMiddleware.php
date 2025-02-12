<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PpdbUser;

class PpdbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming you have a way to identify the user, e.g., via a user ID in the request
        $userId = $request->user()->id;

        // Check if the user exists in the ppdbuser table
        if (!PpdbUser::where('user_id', $userId)->exists()) {
            // If the user does not exist in the ppdbuser table, return a forbidden response
            return response('Forbidden', 403);
        }

        // If the user exists, allow the request to proceed
        return $next($request);
    }
}
