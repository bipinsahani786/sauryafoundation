<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyndicateApplication;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function process()
    {
        return view('frontend.process');
    }

    public function returns()
    {
        return view('frontend.returns');
    }

    public function marriageHalls()
    {
        return view('frontend.marriage-halls');
    }

    public function education()
    {
        return view('frontend.education');
    }

    public function coaching()
    {
        return view('frontend.coaching');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'sector' => 'required|string',
        ]);

        SyndicateApplication::create($validated);

        return back()->with('success', 'Application submitted successfully! Our experts will contact you soon.');
    }
}
