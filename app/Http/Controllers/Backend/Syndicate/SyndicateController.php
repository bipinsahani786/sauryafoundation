<?php

namespace App\Http\Controllers\Backend\Syndicate;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SyndicateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mySubscriptions = PlanSubscription::where('user_id', $user->id)
            ->with('plan')
            ->latest()
            ->get();
            
        return view('backend.syndicate.dashboard', compact('mySubscriptions'));
    }

    public function plans()
    {
        $plans = Plan::where('status', 'active')->latest()->get();
        return view('backend.syndicate.plans', compact('plans'));
    }

    public function joinForm(Plan $plan)
    {
        return view('backend.syndicate.join_plan', compact('plan'));
    }

    public function submitJoin(Request $request, Plan $plan)
    {
        $request->validate([
            'amount' => 'required|numeric|min:' . $plan->min_investment,
            'payment_screenshot' => 'required|image|max:2048',
        ]);

        $path = $request->file('payment_screenshot')->store('payments', 'public');

        PlanSubscription::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'amount' => $request->amount,
            'payment_screenshot' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('syndicate.dashboard')->with('success', 'Application submitted! Waiting for Admin approval.');
    }

    public function wallet()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(20);
        $topupRequests = \App\Models\WalletTopupRequest::where('user_id', Auth::id())->latest()->get();
        return view('backend.syndicate.wallet.index', compact('transactions', 'topupRequests'));
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

        return redirect()->route('syndicate.wallet')->with('success', 'Top-up request submitted successfully.');
    }
}
