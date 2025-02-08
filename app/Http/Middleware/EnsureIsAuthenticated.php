<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::check()) {
            session(['url.intended' => url()->current()]);
            $intendedUrl = session('url.intended', route('front.index'));



            if ($request->url() !== $intendedUrl) {
                return redirect()->intended($intendedUrl);
            }
        }

        return $next($request);
    }
}
