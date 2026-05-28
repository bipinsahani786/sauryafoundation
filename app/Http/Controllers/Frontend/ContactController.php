<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::getAll();
        return view('frontend.pages.contact', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'subject'   => 'nullable|string|max:255',
            'message'   => 'required|string|min:10',
        ]);

        ContactMessage::create($validated);

        return back()->with('contact_success', 'Thank you! Your message has been sent. We\'ll get back to you within 24 hours.');
    }
}
