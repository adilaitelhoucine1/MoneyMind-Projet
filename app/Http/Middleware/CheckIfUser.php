<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            Log::info('User is authenticated');
            Log::info('User ID: ' . Auth::id());
            Log::info('User role: ' . (Auth::user()->role ?? 'null'));
            
            if (Auth::user()->role === 'user') {
                Log::info('Role matches "user", proceeding to dashboard');
                return $next($request);
            } else {
                Log::info('Role does not match "user", redirecting');
            }
        } else {
            Log::info('User is not authenticated, redirecting');
        }
        
        return redirect('/')->with('error', 'Vous n\'avez pas accès à ce tableau de bord.');
    }
}
