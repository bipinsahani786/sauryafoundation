<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isTeacher()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access to teacher terminal.');
    }
}
