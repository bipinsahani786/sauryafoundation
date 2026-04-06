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
}

