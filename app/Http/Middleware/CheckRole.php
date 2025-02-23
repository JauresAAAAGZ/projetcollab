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
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access.');
        }

        // Get the authenticated user
        $user = Auth::user(); 

        // Check if the user's role matches the required role
        if ($user->role !== $role) {
            abort(403, 'Access denied.');
        }
        return $next($request);
    }

}
