<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('livewire/*')) {
            return $next($request);
        }

        if (!Auth::check() && !$request->is('login') && !$request->is('admin/login')) {
            session(['url.intended' => $request->fullUrl()]);
        }

        if (Auth::check() && Route::is('login')) {
            return redirect()->intended(route('front.index'));
        }

        return $next($request);
    }
}
