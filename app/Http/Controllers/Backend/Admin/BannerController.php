<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->paginate(10);
        return view('backend.admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $sectors = \App\Models\HomeSector::where('is_active', true)->whereNotNull('slug')->get();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.banners.create', compact('sectors', 'classes'));
    }

    public function show(Banner $banner)
    {
        return redirect()->route('admin.banners.edit', $banner);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string',
            'order' => 'integer',
            'class_id' => 'nullable|exists:student_classes,id',
            'is_global' => 'nullable|boolean',
        ]);

        $validated['is_global'] = $request->has('is_global');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $validated['image_path'] = $path;
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $sectors = \App\Models\HomeSector::where('is_active', true)->whereNotNull('slug')->get();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.banners.edit', compact('banner', 'sectors', 'classes'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'class_id' => 'nullable|exists:student_classes,id',
            'is_global' => 'nullable|boolean',
        ]);

        $validated['is_global'] = $request->has('is_global');

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $path = $request->file('image')->store('banners', 'public');
            $validated['image_path'] = $path;
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        $banner->delete();
        return back()->with('success', 'Banner deleted successfully.');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->update([
            'is_active' => !$banner->is_active
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
