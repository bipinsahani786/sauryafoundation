<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(10);
        return view('backend.admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('backend.admin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sector' => 'required|string',
            'min_investment' => 'required|numeric',
            'target_irr' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        return view('backend.admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sector' => 'required|string',
            'min_investment' => 'required|numeric',
            'target_irr' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $plan->update($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return back()->with('success', 'Plan deleted successfully.');
    }

    public function toggleStatus(Plan $plan)
    {
        $plan->update([
            'status' => $plan->status == 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
