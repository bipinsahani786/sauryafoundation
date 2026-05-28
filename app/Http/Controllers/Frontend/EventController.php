<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::active()
            ->where('category', 'event')
            ->where('status', 'upcoming')
            ->orderBy('event_date')
            ->get();

        $workshops = Event::active()
            ->where('category', 'workshop')
            ->orderBy('event_date')
            ->get();

        $campaigns = Event::active()
            ->where('category', 'campaign')
            ->orderBy('order')
            ->get();

        return view('frontend.pages.events', compact('upcomingEvents', 'workshops', 'campaigns'));
    }
}
