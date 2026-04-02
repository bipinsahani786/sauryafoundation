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
        
        return view('backend.teacher.dashboard', compact('stats', 'recent_quizzes'));
    }

    public function students()
    {
        $students = auth()->user()->students()->latest()->paginate(20);
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
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'class_id' => $validated['class_id'],
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
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'class_id' => $validated['class_id'],
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
        $teacher = auth()->user();

        if ($teacher->wallet_balance < $amount) {
            return back()->withErrors(['amount' => 'Insufficient wallet balance.']);
        }

        try {
            DB::beginTransaction();

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

            DB::commit();
            return back()->with('success', "₹{$amount} credited to student wallet successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function wallet()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->latest()->paginate(20);
        $payoutRequests = $user->payoutRequests()->latest()->get();
        return view('backend.teacher.wallet.index', compact('transactions', 'payoutRequests'));
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
            'amount' => 'required|numeric|min:1|max:' . $user->wallet_balance,
        ]);

        \App\Models\PayoutRequest::create([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Payout request submitted successfully.');
    }
}

