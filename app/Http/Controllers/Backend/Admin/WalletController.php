<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('backend.admin.wallet.index', compact('user', 'transactions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:credit,debit',
            'description' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $targetUser = User::findOrFail($validated['user_id']);
            $adminUser = auth()->user();

            if ($validated['type'] === 'credit') {
                $targetUser->deposit(
                    $validated['amount'],
                    'admin_manual_credit',
                    $adminUser->id,
                    $validated['description']
                );
                $message = "₹{$validated['amount']} credited to {$targetUser->name} successfully.";
            } else {
                // Check if user has enough balance for debit
                if ($targetUser->wallet_balance < $validated['amount']) {
                    throw new \Exception("User has insufficient balance for debit.");
                }
                $targetUser->withdraw(
                    $validated['amount'],
                    'admin_manual_debit',
                    $adminUser->id,
                    $validated['description']
                );
                $message = "₹{$validated['amount']} debited from {$targetUser->name} successfully.";
            }

            DB::commit();
            return back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Search users for AJAX dropdown (optional enhancement)
     */
    public function searchUsers(Request $request)
    {
        $query = $request->get('q');
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'email']);

        return response()->json($users);
    }
}
