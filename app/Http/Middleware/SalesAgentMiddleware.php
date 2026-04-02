<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesAgentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->isSalesAgent() && !auth()->user()->isAdmin())) {
            return redirect('/login')->withErrors(['error' => 'Unauthorized access.']);
        }
        return $next($request);
    }
}
