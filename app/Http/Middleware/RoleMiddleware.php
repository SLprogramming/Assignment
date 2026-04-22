<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($request->is('admin/*')) {
                return redirect('/admin/login')->withErrors(['email' => 'Access denied. Administrator permissions required.']);
            }
            return redirect('/login')->withErrors(['email' => 'Access denied. You do not have the required permissions.']);
        }

        return $next($request);
    }
}
