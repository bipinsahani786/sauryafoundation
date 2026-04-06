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
        if (session()->has('impersonate_id') && session()->has('admin_id')) {
            $admin = User::find(session('admin_id'));
            
            // Allow impersonation only if the original user was a SuperAdmin
            if ($admin && $admin->isSuperAdmin()) {
                $user = User::find(session('impersonate_id'));
                if ($user) {
                    Auth::setUser($user);
                }
            } else {
                // If the session is compromised or the admin is no longer a superadmin
                session()->forget(['impersonate_id', 'admin_id']);
            }
        }

        return $next($request);
    }
}
