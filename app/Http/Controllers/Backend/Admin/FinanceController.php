<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function ledger(Request $request)
    {
        $range = $request->get('range', 'all');
        $fromDate = match($range) {
            'today' => now()->startOfDay(),
            'week' => now()->subDays(7)->startOfDay(),
            'month' => now()->startOfMonth(),
            default => null,
        };

        $queryFilter = function ($query) use ($fromDate) {
            if ($fromDate) $query->where('created_at', '>=', $fromDate);
        };

        // Tab selection
        $activeTab = $request->get('tab', 'revenue');

        if ($activeTab === 'revenue') {
            $data = Commission::with(['user', 'student', 'quizEnrollment', 'course'])
                ->where($queryFilter)
                ->latest()
                ->paginate(20)
                ->withQueryString();
        } else {
            $data = Transaction::with('user')
                ->where($queryFilter)
                ->latest()
                ->paginate(20)
                ->withQueryString();
        }

        // Summary Stats
        $stats = [
            'gross_revenue' => Commission::where('type', 'admin')->where($queryFilter)->sum('total_amount'),
            'teacher_payouts' => Commission::where('type', 'teacher')->where($queryFilter)->sum('amount'),
            'agent_payouts' => Commission::where('type', 'sales_agent')->where($queryFilter)->sum('amount'),
            'net_retained' => Commission::where('type', 'admin')->where($queryFilter)->sum('amount'),
            'active_tab' => $activeTab,
            'range' => $range
        ];

        return view('backend.admin.finance.ledger', compact('data', 'stats'));
    }
}
