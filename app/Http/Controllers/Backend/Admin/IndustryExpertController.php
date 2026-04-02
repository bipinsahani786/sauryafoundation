<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndustryExpert;
use Illuminate\Support\Facades\Storage;

class IndustryExpertController extends Controller
{
    public function index()
    {
        $experts = IndustryExpert::orderBy('order', 'asc')->paginate(10);
        return view('backend.admin.industry_experts.index', compact('experts'));
    }

    public function create()
    {
        return view('backend.admin.industry_experts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('experts', 'public');
        }

        IndustryExpert::create($data);

        return redirect()->route('admin.industry-experts.index')->with('success', 'Expert created successfully.');
    }

    public function edit(IndustryExpert $industryExpert)
    {
        return view('backend.admin.industry_experts.edit', compact('industryExpert'));
    }

    public function update(Request $request, IndustryExpert $industryExpert)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($industryExpert->image) {
                Storage::disk('public')->delete($industryExpert->image);
            }
            $data['image'] = $request->file('image')->store('experts', 'public');
        }

        $industryExpert->update($data);

        return redirect()->route('admin.industry-experts.index')->with('success', 'Expert updated successfully.');
    }

    public function destroy(IndustryExpert $industryExpert)
    {
        if ($industryExpert->image) {
            Storage::disk('public')->delete($industryExpert->image);
        }
        $industryExpert->delete();

        return redirect()->route('admin.industry-experts.index')->with('success', 'Expert deleted successfully.');
    }

    public function toggleStatus(IndustryExpert $industryExpert)
    {
        $industryExpert->update(['is_active' => !$industryExpert->is_active]);
        return back()->with('success', 'Status updated successfully.');
    }
}
