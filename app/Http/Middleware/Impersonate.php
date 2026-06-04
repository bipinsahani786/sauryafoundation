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
            
            \Illuminate\Support\Facades\Log::info('Impersonate Middleware: session has keys', [
                'admin_id' => session('admin_id'),
                'impersonate_id' => session('impersonate_id'),
                'admin_found' => $admin ? true : false,
                'admin_role' => $admin ? $admin->role : null,
            ]);

            // Allow impersonation if the original user was a SuperAdmin or a Teacher
            if ($admin && ($admin->isSuperAdmin() || $admin->role === 'admin' || $admin->role === 'teacher')) {
                $user = User::find(session('impersonate_id'));
                \Illuminate\Support\Facades\Log::info('Impersonate Middleware: admin authorized', [
                    'user_found' => $user ? true : false,
                    'user_role' => $user ? $user->role : null,
                ]);

                if ($user) {
                    if ($admin->role === 'teacher' && $user->teacher_id !== $admin->id) {
                        \Illuminate\Support\Facades\Log::info('Impersonate Middleware: cleared session because teacher/student mismatch');
                        session()->forget(['impersonate_id', 'admin_id']);
                    } else {
                        \Illuminate\Support\Facades\Log::info('Impersonate Middleware: setting user to ' . $user->id);
                        Auth::setUser($user);
                    }
                }
            } else {
                // If the session is compromised or the admin is no longer a superadmin/teacher
                \Illuminate\Support\Facades\Log::info('Impersonate Middleware: cleared session because admin unauthorized or not found');
                session()->forget(['impersonate_id', 'admin_id']);
            }
        }

        return $next($request);
    }
}

