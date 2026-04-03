<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSectorController extends Controller
{
    public function index()
    {
        $sectors = HomeSector::orderBy('order')->paginate(10);
        return view('backend.admin.home_sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('backend.admin.home_sectors.create');
    }

    public function show(HomeSector $homeSector)
    {
        return redirect()->route('admin.home-sectors.edit', $homeSector);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:home_sectors,slug',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string',
            'tag' => 'nullable|string|max:50',
            'order' => 'integer',
            'stats' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('home_sectors', 'public');
            $validated['image_path'] = $path;
        }

        HomeSector::create($validated);

        return redirect()->route('admin.home-sectors.index')->with('success', 'Sector created successfully.');
    }

    public function edit(HomeSector $homeSector)
    {
        return view('backend.admin.home_sectors.edit', compact('homeSector'));
    }

    public function update(Request $request, HomeSector $homeSector)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:home_sectors,slug,' . $homeSector->id,
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string',
            'tag' => 'nullable|string|max:50',
            'order' => 'integer',
            'is_active' => 'boolean',
            'stats' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            if ($homeSector->image_path) {
                Storage::disk('public')->delete($homeSector->image_path);
            }
            $path = $request->file('image')->store('home_sectors', 'public');
            $validated['image_path'] = $path;
        }

        $homeSector->update($validated);

        return redirect()->route('admin.home-sectors.index')->with('success', 'Sector updated successfully.');
    }

    public function destroy(HomeSector $homeSector)
    {
        if ($homeSector->image_path) {
            Storage::disk('public')->delete($homeSector->image_path);
        }
        $homeSector->delete();
        return back()->with('success', 'Sector deleted successfully.');
    }

    public function toggleStatus(HomeSector $homeSector)
    {
        $homeSector->update([
            'is_active' => !$homeSector->is_active
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
