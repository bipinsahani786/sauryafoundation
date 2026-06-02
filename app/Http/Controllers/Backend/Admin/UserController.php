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
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('district', 'like', "%{$search}%")
                      ->orWhere('block', 'like', "%{$search}%")
                      ->orWhereRaw("CONCAT(district, ' ', block) LIKE ?", ["%{$search}%"])
                      ->orWhereRaw("CONCAT(block, ' ', district) LIKE ?", ["%{$search}%"])
                      ->orWhereHas('studentClass', function($classQuery) use ($search) {
                          $classQuery->where('name', 'like', "%{$search}%");
                      });
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
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.users.create', compact('permissions', 'classes'));
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
            'class_id' => ['nullable', 'required_if:role,student', 'exists:student_classes,id'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'aadhaar_number' => ['nullable', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:50'],
            'mobile_number' => ['nullable', 'string', 'max:20', 'required_if:role,teacher,sales_agent,syndicate'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'alternate_contact' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'required_if:role,teacher,sales_agent,syndicate'],
            'block' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'district' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'state' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'pin_code' => ['nullable', 'string', 'max:20'],
            'coaching_or_school' => ['nullable', 'string', 'max:255'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'class_id' => $request->role === 'student' ? $request->class_id : null,
            'commission_percent' => $request->commission_percent ?? 0,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'block' => $request->block,
            'district' => $request->district,
            'state' => $request->state,
            'coaching_or_school' => $request->coaching_or_school,
        ];

        if ($request->role === 'student') {
            $userData = array_merge($userData, [
                'dob' => $request->dob,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'aadhaar_number' => $request->aadhaar_number,
                'category' => $request->category,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'guardian_name' => $request->guardian_name,
                'alternate_contact' => $request->alternate_contact,
                'pin_code' => $request->pin_code,
            ]);
        }

        $user = User::create($userData);

        if ($request->role === 'admin' && $request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.users.create', compact('user', 'permissions', 'classes'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,syndicate,sales_agent,teacher,student'],
            'class_id' => ['nullable', 'required_if:role,student', 'exists:student_classes,id'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'aadhaar_number' => ['nullable', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:50'],
            'mobile_number' => ['nullable', 'string', 'max:20', 'required_if:role,teacher,sales_agent,syndicate'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'alternate_contact' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'required_if:role,teacher,sales_agent,syndicate'],
            'block' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'district' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'state' => ['nullable', 'string', 'max:255', 'required_if:role,teacher,sales_agent,syndicate'],
            'pin_code' => ['nullable', 'string', 'max:20'],
            'coaching_or_school' => ['nullable', 'string', 'max:255'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'class_id' => $request->role === 'student' ? $request->class_id : null,
            'commission_percent' => $request->commission_percent ?? 0,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'block' => $request->block,
            'district' => $request->district,
            'state' => $request->state,
            'coaching_or_school' => $request->coaching_or_school,
        ];

        if ($request->role === 'student') {
            $userData = array_merge($userData, [
                'dob' => $request->dob,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'aadhaar_number' => $request->aadhaar_number,
                'category' => $request->category,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'guardian_name' => $request->guardian_name,
                'alternate_contact' => $request->alternate_contact,
                'pin_code' => $request->pin_code,
            ]);
        }

        $user->update($userData);

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

    public function exportCsv(Request $request)
    {
        $role = $request->query('role');
        $query = User::query();
        
        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->get();

        $filename = "users_export_" . ($role ?? 'all') . "_" . date('Ymd_His') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Name', 'Email', 'Mobile', 'Role', 'Status', 'Joined Date', 'Assigned Class / Org'];

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $classOrOrg = $user->role === 'student' ? ($user->studentClass?->name ?? 'N/A') : ($user->coaching_or_school ?? 'N/A');
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->mobile_number ?? '-',
                    ucwords(str_replace('_', ' ', $user->role)),
                    ucfirst($user->status),
                    $user->created_at->format('Y-m-d H:i:s'),
                    $classOrOrg
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $role = $request->query('role');
        $query = User::query();
        
        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('backend.admin.users.pdf', compact('users', 'role'));
        
        return $pdf->download("users_export_" . ($role ?? 'all') . "_" . date('Ymd_His') . ".pdf");
    }
}
