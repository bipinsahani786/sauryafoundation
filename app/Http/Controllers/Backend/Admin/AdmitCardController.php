<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdmitCard;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmitCardController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmitCard::with('user')->latest();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('roll_no', 'like', "%{$search}%")
                  ->orWhere('exam_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        }
        
        $admitCards = $query->paginate(20)->withQueryString();
        
        return view('backend.admin.admit_cards.index', compact('admitCards'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->select('id', 'name', 'email')->get();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        
        // Generate a random roll number for suggestion
        $suggestedRollNo = 'R' . date('Y') . strtoupper(substr(uniqid(), -5));
        
        return view('backend.admin.admit_cards.create', compact('students', 'classes', 'suggestedRollNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_class' => 'nullable|string|max:255',
            'exam_name' => 'required|string|max:255',
            'roll_no' => 'required|string|max:255|unique:admit_cards',
            'exam_center' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'instructions' => 'nullable|string'
        ]);

        AdmitCard::create($validated);

        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card generated successfully.');
    }

    public function show(AdmitCard $admitCard)
    {
        // Load the relationship
        $admitCard->load('user');
        $siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
        
        return view('backend.admin.admit_cards.show', compact('admitCard', 'siteSettings'));
    }

    public function downloadPdf(AdmitCard $admitCard)
    {
        $admitCard->load('user');
        $siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
        
        // Pass data to a stripped-down PDF view
        $pdf = Pdf::loadView('backend.admin.admit_cards.pdf', compact('admitCard', 'siteSettings'));
        
        return $pdf->download('Admit_Card_' . $admitCard->roll_no . '.pdf');
    }

    public function destroy(AdmitCard $admitCard)
    {
        $admitCard->delete();
        
        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card deleted successfully.');
    }
}
