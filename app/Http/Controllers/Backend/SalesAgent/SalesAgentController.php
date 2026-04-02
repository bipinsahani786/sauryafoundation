<?php

namespace App\Http\Controllers\Backend\SalesAgent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Transaction;

class SalesAgentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $stats = [
            'total_merchants' => $user->referrals()->where('role', 'teacher')->count(),
            'wallet_balance' => $user->wallet_balance,
            'recent_transactions' => $user->transactions()->latest()->take(5)->get(),
        ];

        return view('backend.sales_agent.dashboard', compact('stats'));
    }

    public function merchants()
    {
        $merchants = auth()->user()->referrals()->where('role', 'teacher')->latest()->paginate(15);
        return view('backend.sales_agent.merchants.index', compact('merchants'));
    }

    public function storeMerchant(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => 'teacher',
            'referred_by' => auth()->id(),
            'status' => 'active',
        ]);

        return back()->with('success', 'Coaching center enrolled successfully.');
    }

    public function wallet()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->latest()->paginate(20);
        $payoutRequests = $user->payoutRequests()->latest()->get();
        return view('backend.sales_agent.wallet.index', compact('transactions', 'payoutRequests'));
    }

    public function kyc()
    {
        return view('backend.sales_agent.kyc.index', ['user' => auth()->user()]);
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

        return redirect()->route('sales-agent.wallet')->with('success', 'Bank details submitted for verification.');
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
