<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyndicateApplication;
use App\Models\Banner;
use App\Models\HomeSector;
use App\Models\Testimonial;
use App\Models\IndustryExpert;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->where('type', 'home')->orderBy('order')->get();
        $sectors = HomeSector::where('is_active', true)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('order')
            ->get();
        $experts = IndustryExpert::active()->get();
        $testimonials = Testimonial::active()->get();
        
        return view('frontend.index', compact('banners', 'sectors', 'experts', 'testimonials'));
    }

    public function about()
    {
        $experts = IndustryExpert::active()->get();
        return view('frontend.about', compact('experts'));
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
        $banners = Banner::where('is_active', true)->where('type', 'marriage-halls')->orderBy('order')->get();
        return view('frontend.marriage-halls', compact('banners'));
    }

    public function education()
    {
        $banners = Banner::where('is_active', true)->where('type', 'education')->orderBy('order')->get();
        return view('frontend.education', compact('banners'));
    }

    public function coaching()
    {
        $banners = Banner::where('is_active', true)->where('type', 'coaching')->orderBy('order')->get();
        return view('frontend.coaching', compact('banners'));
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function sectorDetail($slug)
    {
        $sector = HomeSector::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Check if a specific view exists for this sector (e.g., frontend.marriage-halls)
        $viewName = 'frontend.' . $slug;
        if (view()->exists($viewName)) {
            return view($viewName, compact('sector'));
        }

        return view('frontend.sector-show', compact('sector'));
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'type' => 'required|string|in:Member,Volunteer,Syndicate',
            'city' => 'nullable|string|max:100',
            'sector' => 'required|string|max:100',
            'message' => 'nullable|string',
        ]);

        SyndicateApplication::create($validated);

        return back()->with('success', 'Application submitted successfully! Our experts will contact you soon.');
    }
}
