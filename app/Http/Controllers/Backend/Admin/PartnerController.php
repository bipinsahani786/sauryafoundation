<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('order')->paginate(10);
        return view('backend.admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('backend.admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('partners', 'public');
            $validated['image_path'] = $path;
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('backend.admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($partner->image_path) {
                Storage::disk('public')->delete($partner->image_path);
            }
            $path = $request->file('image')->store('partners', 'public');
            $validated['image_path'] = $path;
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->image_path) {
            Storage::disk('public')->delete($partner->image_path);
        }
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully.');
    }

    public function toggleStatus(Partner $partner)
    {
        $partner->update([
            'is_active' => !$partner->is_active
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
