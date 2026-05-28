<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CharityDonation;

class CharityController extends Controller
{
    public function index()
    {
        $donations = CharityDonation::orderBy('created_at', 'desc')->paginate(15);
        $totalRaised = CharityDonation::where('status', 'approved')->sum('amount');
        $siteSettings = \App\Models\Setting::getAll();
        
        return view('backend.admin.charity.index', compact('donations', 'totalRaised', 'siteSettings'));
    }

    public function update(Request $request, CharityDonation $charityDonation)
    {
        $status = $request->input('status');
        if (in_array($status, ['approved', 'rejected'])) {
            $charityDonation->update(['status' => $status]);
            return back()->with('success', 'Donation ' . $status . ' successfully.');
        }
        return back()->withErrors(['status' => 'Invalid status.']);
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $oldValue = \App\Models\Setting::where('key', $key)->first()?->value;
                if ($oldValue && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldValue)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldValue);
                }
                $value = $request->file($key)->store('settings', 'public');
            }

            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Charity settings updated successfully.');
    }
}
