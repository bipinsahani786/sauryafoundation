<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyndicateApplication;
use App\Models\PlanSubscription;
use App\Models\Plan;
use App\Models\User;
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

    public function rejectSubscription(Request $request, PlanSubscription $subscription)
    {
        $subscription->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Subscription rejected successfully.');
    }
}
