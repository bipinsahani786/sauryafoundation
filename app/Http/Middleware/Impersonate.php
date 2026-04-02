<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Impersonate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('impersonate_id')) {
            $user = User::find(session('impersonate_id'));
            if ($user) {
                // We don't actually Auth::login($user) because that would persist.
                // We just tell Laravel to treat THIS request as THIS user.
                Auth::setUser($user);
            }
        }

        return $next($request);
    }
}
