<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyndicateApplication;
use App\Models\PlanSubscription;
use App\Models\Plan;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->get('range', 'all');
        $fromDate = match($range) {
            'today' => now()->startOfDay(),
            'yesterday' => now()->subDay()->startOfDay(),
            'week' => now()->subDays(7)->startOfDay(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => null,
        };

        $toDate = match($range) {
            'yesterday' => now()->subDay()->endOfDay(),
            default => now()->endOfDay(),
        };

        $queryFilter = function ($query) use ($fromDate, $toDate) {
            if ($fromDate) $query->whereBetween('created_at', [$fromDate, $toDate]);
        };

        // Financial Stats
        $planRevenue = PlanSubscription::where('status', 'approved')->where($queryFilter)->sum('amount');
        $quizRevenue = \App\Models\QuizEnrollment::where('status', 'active')->where($queryFilter)->sum('paid_amount');
        $totalRevenue = $planRevenue + $quizRevenue;
        
        $commissionTotal = \App\Models\Commission::where($queryFilter)->sum('amount');
        $netProfit = $totalRevenue - $commissionTotal;

        $pendingPayouts = \App\Models\PayoutRequest::where('status', 'pending')->where($queryFilter)->sum('amount');

        // User Stats
        $usersBase = User::where($queryFilter);
        $totalTeachers = (clone $usersBase)->where('role', 'teacher')->count();
        $totalAgents = (clone $usersBase)->where('role', 'sales_agent')->count();
        $totalStudents = (clone $usersBase)->where('role', 'student')->count();
        $totalSyndicate = (clone $usersBase)->where('role', 'syndicate')->count();

        // Lead Stats
        $pendingLeads = SyndicateApplication::where($queryFilter)->count();

        // Chart Data (Simple daily revenue for the last 30 days)
        $chartDates = [];
        $chartRevenue = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayPlan = PlanSubscription::where('status', 'approved')->whereDate('created_at', $date)->sum('amount');
            $dayQuiz = \App\Models\QuizEnrollment::where('status', 'active')->whereDate('created_at', $date)->sum('paid_amount');
            
            $chartDates[] = now()->subDays($i)->format('d M');
            $chartRevenue[] = $dayPlan + $dayQuiz;
        }

        $stats = [
            'range' => $range,
            'total_revenue' => $totalRevenue,
            'net_profit' => $netProfit,
            'pending_payouts' => $pendingPayouts,
            'pending_leads' => $pendingLeads,
            'teachers' => $totalTeachers,
            'agents' => $totalAgents,
            'students' => $totalStudents,
            'members' => $totalSyndicate,
            'active_plans' => Plan::where('status', 'active')->count(),
            'pending_subscriptions' => PlanSubscription::where('status', 'pending')->count(),
            'chart_labels' => $chartDates,
            'chart_data' => $chartRevenue,
            'user_mix' => [$totalTeachers, $totalAgents, $totalStudents, $totalSyndicate]
        ];

        $recentleads = SyndicateApplication::latest()->take(5)->get();
        $recentTransactions = \App\Models\Transaction::with('user')->latest()->take(10)->get();

        return view('backend.admin.dashboard', compact('stats', 'recentleads', 'recentTransactions'));
    }

    public function docs()
    {
        return view('backend.admin.docs');
    }

    public function applications()
    {
        $applications = SyndicateApplication::latest()->paginate(20);
        return view('backend.admin.applications.index', compact('applications'));
    }

    public function subscriptions()
    {
        $subscriptions = PlanSubscription::with(['user', 'plan'])->latest()->paginate(20);
        return view('backend.admin.subscriptions.index', compact('subscriptions'));
    }

    public function approveSubscription(Request $request, PlanSubscription $subscription)
    {
        $subscription->update([
            'status' => 'approved',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Subscription approved successfully.');
    }

    public function quizzes()
    {
        $quizzes = Quiz::where('price', '>', 0)->latest()->paginate(10);
        return view('backend.admin.quizzes.approvals', compact('quizzes'));
    }

    public function approveQuiz(Quiz $quiz)
    {
        $quiz->update(['status' => 'published']);
        return back()->with('success', 'Quiz approved and published.');
    }

    public function payouts()
    {
        $pendingKyc = User::where('kyc_status', 'pending')->latest()->get();
        $payoutRequests = \App\Models\PayoutRequest::with('user')->where('status', 'pending')->latest()->get();
        return view('backend.admin.payouts.index', compact('pendingKyc', 'payoutRequests'));
    }

    public function verifyKyc(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'notes' => 'nullable|string'
        ]);

        $user->update([
            'kyc_status' => $request->status,
            'kyc_notes' => $request->notes
        ]);

        return back()->with('success', 'KYC status updated successfully.');
    }

    public function approvePayout(Request $request, \App\Models\PayoutRequest $payout)
    {
        $superadmin = auth()->user();

        try {
            \DB::transaction(function () use ($payout, $superadmin, $request) {
                // Lock records for update
                $agent = User::lockForUpdate()->find($payout->user_id);
                $superadmin = User::lockForUpdate()->find($superadmin->id);

                if ($agent->wallet_balance < $payout->amount) {
                    throw new \Exception("Agent {$agent->name} has insufficient balance.");
                }

                if ($superadmin->wallet_balance < $payout->amount) {
                    throw new \Exception("Superadmin has insufficient balance.");
                }

                // Deduct from Agent (Payout requested)
                $agent->withdraw(
                    $payout->amount,
                    'payout_request',
                    $payout->id,
                    "Payout of ₹{$payout->amount} approved."
                );

                // Deduct from Superadmin (Treasury payout)
                $superadmin->withdraw(
                    $payout->amount,
                    'payout_disbursement',
                    $payout->id,
                    "Disbursed payout to {$agent->name} (#{$payout->id})"
                );

                $payout->update([
                    'status' => 'approved',
                    'admin_id' => $superadmin->id,
                    'remarks' => $request->remarks
                ]);
            });
        } catch (\Exception $e) {
            return back()->withErrors(['payout' => 'Payout failed: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Payout approved and funds disbursed.');
    }
}
