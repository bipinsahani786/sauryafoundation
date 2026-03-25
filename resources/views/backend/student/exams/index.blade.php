<x-dashboard.layout>
    <x-slot name="title">Exam Portal</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Assessment Portal</h2>
            <p class="text-xs text-slate-400 font-bold italic">Select an available examination to begin your verification.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($quizzes as $quiz)
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group overflow-hidden relative">
                <!-- Status Badge -->
                @php
                    $attemptsUsed = $quiz->quiz_attempts_count ?? 0;
                    $isBlocked = $quiz->attempts()->where('student_id', auth()->id())->where('is_blocked', true)->exists();
                    $isCompleted = $quiz->attempts()->where('student_id', auth()->id())->where('status', 'completed')->exists();
                @endphp

                @if($isBlocked)
                    <div class="absolute -right-8 top-6 bg-red-600 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">
                        BLOCKED
                    </div>
                @elseif($attemptsUsed >= $quiz->attempts_limit && $quiz->attempts_limit > 0)
                    <div class="absolute -right-8 top-6 bg-slate-400 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">
                        MAX ATTEMPTS
                    </div>
                @else
                    <div class="absolute -right-8 top-6 bg-emerald-500 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">
                        AVAILABLE
                    </div>
                @endif

                <div class="mb-6">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-inner border border-slate-100">
                        <i class="fas fa-file-alt text-lg"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tighter leading-tight mb-2">{{ $quiz->title }}</h3>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-0.5 bg-slate-100 text-[8px] font-black uppercase tracking-widest text-slate-500 rounded-md">Attempts: {{ $attemptsUsed }} / {{ $quiz->attempts_limit ?: '∞' }}</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-bold italic line-clamp-2">{{ $quiz->description ?? 'Secure academic verification assessment.' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1 leading-none">Duration</p>
                        <p class="text-xs font-black text-slate-900">{{ $quiz->duration_minutes }} Min</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1 leading-none">Pricing</p>
                        <p class="text-xs font-black text-emerald-600">₹{{ number_format($quiz->price) }}</p>
                    </div>
                </div>

                @if($isBlocked)
                    <div class="w-full text-center bg-slate-100 text-slate-400 py-4 rounded-3xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed border border-slate-200">
                        Access Revoked <i class="fas fa-lock ml-1"></i>
                    </div>
                @elseif($attemptsUsed >= $quiz->attempts_limit && $quiz->attempts_limit > 0)
                    <a href="{{ route('student.results.show', $quiz->attempts()->where('student_id', auth()->id())->latest()->first()->id) }}" class="block w-full text-center bg-indigo-50 text-indigo-600 py-4 rounded-3xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-100 transition-all border border-indigo-100">
                        View Last Result <i class="fas fa-poll ml-1"></i>
                    </a>
                @else
                    <a href="{{ route('student.exams.show', $quiz->id) }}" class="block w-full text-center bg-slate-900 text-white py-4 rounded-3xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-100 group-hover:shadow-indigo-100">
                        Access Terminal <i class="fas fa-terminal ml-1 opacity-50"></i>
                    </a>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-200 mx-auto mb-6">
                    <i class="fas fa-frown-open text-3xl"></i>
                </div>
                <h4 class="text-slate-900 font-black text-sm uppercase tracking-tighter">No Access Granted</h4>
                <p class="text-xs text-slate-400 italic">No examinations are currently published by your coach.</p>
            </div>
        @endforelse
    </div>

    @if($quizzes->hasPages())
        <div class="mt-12">
            {{ $quizzes->links() }}
        </div>
    @endif
</x-dashboard.layout>
