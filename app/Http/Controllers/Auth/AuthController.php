<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->status === 'inactive') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact support.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            
            if ($user->isSalesAgent()) {
                return redirect()->intended('/sales-agent/dashboard');
            }
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            }
            if ($user->isTeacher()) {
                return redirect()->intended('/teacher/dashboard');
            }
            if ($user->isStudent()) {
                return redirect()->intended('/student/dashboard');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('auth.register', compact('classes'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:syndicate,teacher,sales_agent,student',
            'class_id' => 'required_if:role,student|nullable|exists:student_classes,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'class_id' => $validated['class_id'] ?? null,
            'status' => 'active',
        ]);

        Auth::login($user);

        if ($user->isTeacher()) {
            return redirect('/teacher/dashboard');
        }
        if ($user->isStudent()) {
            return redirect('/student/dashboard');
        }
        if ($user->isSalesAgent()) {
            return redirect('/sales-agent/dashboard');
        }
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
