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
    public function index()
    {
        $stats = [
            'total_applications' => SyndicateApplication::count(),
            'total_members' => User::where('role', 'syndicate')->count(),
            'active_plans' => Plan::where('status', 'active')->count(),
            'pending_subscriptions' => PlanSubscription::where('status', 'pending')->count(),
        ];
        return view('backend.admin.dashboard', compact('stats'));
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
        $agent = $payout->user;
        $superadmin = auth()->user();

        if ($agent->wallet_balance < $payout->amount) {
            return back()->withErrors(['payout' => 'Agent has insufficient balance.']);
        }

        if ($superadmin->wallet_balance < $payout->amount) {
            return back()->withErrors(['payout' => 'Superadmin has insufficient balance.']);
        }

        \DB::transaction(function () use ($payout, $agent, $superadmin, $request) {
            // Deduct from Agent
            $agent->withdraw(
                $payout->amount,
                'payout_request',
                $payout->id,
                "Payout of ₹{$payout->amount} approved."
            );

            // Deduct from Superadmin
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

        return back()->with('success', 'Payout approved and funds disbursed.');
    }
}
