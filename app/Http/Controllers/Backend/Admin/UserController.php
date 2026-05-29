<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = User::when($search, function($q) use ($search) {
            $q->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        })->latest();

        $admins = (clone $query)->whereIn('role', ['admin', 'superadmin'])->paginate(10, ['*'], 'admins_page');
        $teachers = (clone $query)->where('role', 'teacher')->paginate(10, ['*'], 'teachers_page');
        $students = (clone $query)->where('role', 'student')->paginate(10, ['*'], 'students_page');
        $syndicates = (clone $query)->where('role', 'syndicate')->paginate(10, ['*'], 'syndicates_page');
        $salesAgents = (clone $query)->where('role', 'sales_agent')->paginate(10, ['*'], 'sales_agents_page');

        return view('backend.admin.users.index', compact('admins', 'teachers', 'students', 'syndicates', 'salesAgents', 'search'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('backend.admin.users.create', compact('permissions'));
    }

    public function show(User $user)
    {
        return redirect()->route('admin.users.edit', $user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,syndicate,sales_agent,teacher,student'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'commission_percent' => $request->commission_percent ?? 0,
        ]);

        if ($request->role === 'admin' && $request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        return view('backend.admin.users.create', compact('user', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,syndicate,sales_agent,teacher,student'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'commission_percent' => $request->commission_percent ?? 0,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Password::defaults()],
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->role === 'admin') {
            $user->permissions()->sync($request->permissions ?? []);
        } else {
            $user->permissions()->detach();
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete yourself.']);
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot deactivate yourself.']);
        }

        $user->update([
            'status' => $user->status == 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'User status updated successfully.');
    }

    public function impersonate(User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot impersonate yourself.');
        }

        session([
            'impersonate_id' => $user->id,
            'admin_id' => auth()->id()
        ]);
        
        // Redirect to the user's dashboard based on their role
        $route = match($user->role) {
            'admin', 'superadmin' => 'admin.dashboard',
            'teacher' => 'teacher.dashboard',
            'sales_agent' => 'sales-agent.dashboard',
            'student' => 'student.dashboard',
            default => 'syndicate.dashboard',
        };

        return redirect()->route($route)->with('success', "Now viewing as {$user->name}");
    }

    public function stopImpersonating()
    {
        session()->forget(['impersonate_id', 'admin_id']);
        return redirect()->route('admin.users.index')->with('success', 'Returned to Admin session.');
    }
}
