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
        $topupRequests = \App\Models\WalletTopupRequest::where('user_id', $user->id)->latest()->get();
        return view('backend.sales_agent.wallet.index', compact('transactions', 'payoutRequests', 'topupRequests'));
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

        return redirect()->route('sales-agent.wallet')->with('success', 'Top-up request submitted successfully.');
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
