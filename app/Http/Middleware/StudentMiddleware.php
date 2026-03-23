<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isStudent()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access to student terminal.');
    }
}
