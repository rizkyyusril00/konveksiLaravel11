<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as RedirectIfAuthenticatedMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends RedirectIfAuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/');
        } elseif (Auth::guard('user')->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
