<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', auth()->id())->latest()->paginate(10);
        return view('backend.teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('backend.teacher.quizzes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'attempts_limit' => 'required|integer|min:0',
        ]);

        $status = $validated['price'] > 0 ? 'pending' : 'published';

        $quiz = Quiz::create(array_merge($validated, [
            'teacher_id' => auth()->id(),
            'status' => $status,
            'expires_at' => $validated['end_time'] ?? null,
        ]));

        return redirect()->route('teacher.quizzes.show', $quiz->id)->with('success', 'Quiz created successfully. Now add questions.');
    }

    public function show(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) abort(403);
        $questions = $quiz->questions;
        return view('backend.teacher.quizzes.show', compact('quiz', 'questions'));
    }

    public function addQuestion(Request $request, Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_0' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'correct_option' => 'required|integer|between:0,3',
            'marks' => 'required|integer|min:1',
        ]);

        $quiz->questions()->create([
            'question_text' => $validated['question_text'],
            'options' => [
                $validated['option_0'],
                $validated['option_1'],
                $validated['option_2'],
                $validated['option_3'],
            ],
            'correct_option' => $validated['correct_option'],
            'marks' => $validated['marks'],
        ]);

        return back()->with('success', 'Question added.');
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) abort(403);
        $quiz->delete();
        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz deleted.');
    }
}
