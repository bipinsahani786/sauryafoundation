<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\StudentClass;

class TeacherController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => auth()->user()->students()->count(),
            'total_quizzes' => Quiz::where('teacher_id', auth()->id())->count(),
            'pending_approvals' => Quiz::where('teacher_id', auth()->id())->where('status', 'pending')->count(),
        ];
        
        $recent_quizzes = Quiz::where('teacher_id', auth()->id())->latest()->take(5)->get();
        $classes = StudentClass::where('status', 'active')->get();
        
        return view('backend.teacher.dashboard', compact('stats', 'recent_quizzes', 'classes'));
    }

    public function students(Request $request)
    {
        $query = auth()->user()->students()->latest();
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('mobile_number', 'like', '%' . $searchTerm . '%')
                  ->orWhere('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $students = $query->paginate(20)->withQueryString();
        return view('backend.teacher.students.index', compact('students'));
    }

    public function createStudent()
    {
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.students.create', compact('classes'));
    }

    public function addStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'class_id' => 'required|exists:student_classes,id',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'blood_group' => 'nullable|string|max:10',
            'aadhaar_number' => 'nullable|string|max:20',
            'category' => 'nullable|string|in:General,OBC,SC,ST',
            'mobile_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'alternate_contact' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'block' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:20',
            'coaching_or_school' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'class_id' => $validated['class_id'],
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
            'aadhaar_number' => $validated['aadhaar_number'] ?? null,
            'category' => $validated['category'] ?? null,
            'mobile_number' => $validated['mobile_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'father_name' => $validated['father_name'] ?? null,
            'mother_name' => $validated['mother_name'] ?? null,
            'guardian_name' => $validated['guardian_name'] ?? null,
            'alternate_contact' => $validated['alternate_contact'] ?? null,
            'state' => $validated['state'] ?? null,
            'district' => $validated['district'] ?? null,
            'block' => $validated['block'] ?? null,
            'pin_code' => $validated['pin_code'] ?? null,
            'coaching_or_school' => $validated['coaching_or_school'] ?? null,
            'role' => 'student',
            'teacher_id' => auth()->id(),
            'referred_by' => auth()->id(),
            'status' => 'active',
        ]);

        return redirect()->route('teacher.students')->with('success', 'Student admitted successfully.');
    }

    public function editStudent(User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.students.edit', compact('student', 'classes'));
    }

    public function updateStudent(Request $request, User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
            'class_id' => 'required|exists:student_classes,id',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'blood_group' => 'nullable|string|max:10',
            'aadhaar_number' => 'nullable|string|max:20',
            'category' => 'nullable|string|in:General,OBC,SC,ST',
            'mobile_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'alternate_contact' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'block' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:20',
            'coaching_or_school' => 'nullable|string|max:255',
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'class_id' => $validated['class_id'],
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
            'aadhaar_number' => $validated['aadhaar_number'] ?? null,
            'category' => $validated['category'] ?? null,
            'mobile_number' => $validated['mobile_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'father_name' => $validated['father_name'] ?? null,
            'mother_name' => $validated['mother_name'] ?? null,
            'guardian_name' => $validated['guardian_name'] ?? null,
            'alternate_contact' => $validated['alternate_contact'] ?? null,
            'state' => $validated['state'] ?? null,
            'district' => $validated['district'] ?? null,
            'block' => $validated['block'] ?? null,
            'pin_code' => $validated['pin_code'] ?? null,
            'coaching_or_school' => $validated['coaching_or_school'] ?? null,
        ]);

        return redirect()->route('teacher.students')->with('success', 'Student details updated/promoted successfully.');
    }

    public function addMoney(Request $request, User $student)
    {
        if ($student->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized access to student.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $validated['amount'];

        try {
            DB::transaction(function () use ($student, $amount) {
                // Lock the teacher record to prevent concurrent withdrawal issues
                $teacher = User::lockForUpdate()->find(auth()->id());

                if ($teacher->wallet_balance < $amount) {
                    throw new \Exception('Insufficient wallet balance.');
                }

                // Deduct from teacher
                $teacher->withdraw(
                    $amount, 
                    'student_wallet_credit', 
                    $student->id, 
                    "Wallet credit to student: {$student->name}"
                );

                // Credit to student
                $student->deposit(
                    $amount, 
                    'teacher_wallet_credit', 
                    $teacher->id, 
                    "Wallet credit from teacher: {$teacher->name}"
                );
            });

            return back()->with('success', "₹{$amount} credited to student wallet successfully.");
        } catch (\Exception $e) {
            return back()->withErrors(['amount' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    public function studentProgress(User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);
        
        $enrolledCourses = $student->enrolledCourses()->with('subjects.topics.contents.quiz')->get();
        $completions = $student->contentCompletions()->pluck('content_id')->toArray();
        $quizAttempts = $student->quizAttempts()->with('quiz')->latest()->get();
        
        return view('backend.teacher.students.progress', compact('student', 'enrolledCourses', 'completions', 'quizAttempts'));
    }

    public function studentDashboardView(User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);
        
        $user = $student;
        
        $stats = [
            'total_exams' => \App\Models\Quiz::where('status', 'published')
                ->where(function($q) use ($user) {
                    $q->where(function($classQuery) use ($user) {
                        $classQuery->whereHas('studentClasses', function($sq) use ($user) {
                            $sq->where('student_classes.id', $user->class_id);
                        })->orWhereDoesntHave('studentClasses');
                    })->where(function($teacherQuery) use ($user) {
                        $teacherQuery->where('is_global', true)
                                     ->orWhere('teacher_id', $user->teacher_id);
                    });
                })
                ->count(),
            'attempted_exams' => $user->quizAttempts()->count(),
            'average_score' => $user->quizAttempts()->avg('score') ?? 0,
            'courses_enrolled' => $user->enrolledCourses()->count(),
            'lessons_completed' => $user->contentCompletions()->count(),
        ];

        $upcoming_exams = \App\Models\Quiz::where('status', 'published')
            ->where(function($q) use ($user) {
                $q->where(function($classQuery) use ($user) {
                    $classQuery->whereHas('studentClasses', function($sq) use ($user) {
                        $sq->where('student_classes.id', $user->class_id);
                    })->orWhereDoesntHave('studentClasses');
                })->where(function($teacherQuery) use ($user) {
                    $teacherQuery->where('is_global', true)
                                 ->orWhere('teacher_id', $user->teacher_id);
                });
            })
            ->where('expires_at', '>', now())
            ->latest()
            ->take(5)
            ->get();

        $banners = \App\Models\Banner::where('is_active', true)->where('type', 'student')->orderBy('order')->get();
        $recent_materials = \App\Models\StudyMaterial::forStudent($user)->latest()->take(5)->get();

        $studentUser = $user;
        return view('backend.student.dashboard', compact('stats', 'upcoming_exams', 'banners', 'recent_materials', 'studentUser'));
    }

    public function wallet()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->latest()->paginate(20);
        $payoutRequests = $user->payoutRequests()->latest()->get();
        $topupRequests = \App\Models\WalletTopupRequest::where('user_id', $user->id)->latest()->get();
        
        return view('backend.teacher.wallet.index', compact('transactions', 'payoutRequests', 'topupRequests'));
    }

    public function topup()
    {
        $settings = \App\Models\Setting::getAll();
        return view('backend.common.wallet.topup', compact('settings'));
    }

    public function submitTopup(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'utr_number' => 'required|string|unique:wallet_topup_requests,utr_number',
            'proof_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('proof_image')->store('topups', 'public');

        \App\Models\WalletTopupRequest::create([
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'utr_number' => $validated['utr_number'],
            'proof_image' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('teacher.wallet')->with('success', 'Top-up request submitted successfully. Wait for admin approval.');
    }

    public function kyc()
    {
        return view('backend.teacher.kyc.index', ['user' => auth()->user()]);
    }

    public function submitKyc(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_no' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:20',
            'account_holder_name' => 'required|string|max:255',
        ]);

        auth()->user()->update(array_merge($validated, [
            'kyc_status' => 'pending'
        ]));

        return redirect()->route('teacher.wallet')->with('success', 'Bank details submitted for verification.');
    }


    public function submitPayoutRequest(Request $request)
    {
        $user = auth()->user();

        if (!$user->isKycVerified()) {
            return back()->withErrors(['payout' => 'Verify your bank details (KYC) first.']);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            DB::transaction(function () use ($user, $validated) {
                // Lock the user to check balance accurately
                $lockedUser = User::lockForUpdate()->find($user->id);

                if ($lockedUser->wallet_balance < $validated['amount']) {
                    throw new \Exception('Insufficient wallet balance for this request.');
                }

                \App\Models\PayoutRequest::create([
                    'user_id' => $lockedUser->id,
                    'amount' => $validated['amount'],
                    'status' => 'pending',
                ]);
            });
        } catch (\Exception $e) {
            return back()->withErrors(['payout' => 'Request failed: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Payout request submitted successfully.');
    }

    public function impersonate(User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);

        session([
            'impersonate_id' => $student->id,
            'admin_id' => auth()->id()
        ]);
        
        return redirect()->route('student.dashboard')->with('success', "Now viewing as {$student->name}. You have full access to all resources.");
    }
}


