<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletTopupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletTopupController extends Controller
{
    public function index()
    {
        $requests = WalletTopupRequest::with('user')->latest()->paginate(20);
        return view('backend.admin.wallet.topups', compact('requests'));
    }

    public function approve(WalletTopupRequest $topupRequest)
    {
        if ($topupRequest->status !== 'pending') {
            return back()->with('error', 'Request is already processed.');
        }

        try {
            DB::beginTransaction();

            $topupRequest->update([
                'status' => 'approved',
                'admin_note' => 'Approved by ' . auth()->user()->name
            ]);

            $topupRequest->user->deposit(
                $topupRequest->amount,
                'wallet_topup',
                $topupRequest->id,
                "Wallet top-up (UTR: {$topupRequest->utr_number})"
            );

            DB::commit();
            return back()->with('success', 'Top-up request approved and wallet credited.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to approve: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, WalletTopupRequest $topupRequest)
    {
        if ($topupRequest->status !== 'pending') {
            return back()->with('error', 'Request is already processed.');
        }

        $request->validate([
            'admin_note' => 'required|string|max:255'
        ]);

        $topupRequest->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Top-up request rejected.');
    }
}
