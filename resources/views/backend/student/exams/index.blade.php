<x-dashboard.layout>
    <x-slot name="title">Exam Portal</x-slot>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
            <i class="fas fa-arrow-left"></i> Return to Dashboard
        </a>
    </div>

    <!-- Banner/Header -->
    <div class="mb-10 bg-slate-900 rounded-[3rem] p-10 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-black tracking-tighter mb-2">Assessment Hub</h2>
            <p class="text-xs text-slate-400 font-bold italic max-w-md opacity-80 uppercase tracking-widest leading-loose">Secure academic verification terminal. Select your assessment stream below.</p>
        </div>
        <div class="absolute top-0 right-0 p-10 opacity-10">
            <i class="fas fa-microchip text-[120px]"></i>
        </div>
    </div>

    <!-- Live Assessments Section -->
    <div class="mb-12">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-1 rounded-full bg-indigo-600"></div>
            <h3 class="text-[12px] font-black uppercase tracking-[0.3em] text-slate-400 italic">Live Assessments & Events</h3>
        </div>

        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-6">
            @forelse($liveExams as $quiz)
                @php
                    $attemptsUsed = $quiz->quiz_attempts_count ?? 0;
                    $isBlocked = $quiz->attempts()->where('student_id', auth()->id())->where('is_blocked', true)->exists();
                    $isUpcoming = $quiz->start_time && $quiz->start_time->isFuture();
                    $isExpired = $quiz->end_time && $quiz->end_time->isPast();
                    $isLive = !$isUpcoming && !$isExpired;
                    $isEnrolled = auth()->user()->quizEnrollments()->where('quiz_id', $quiz->id)->exists();
                @endphp
                
                <div class="bg-white rounded-[2rem] p-6 border border-slate-200 shadow-sm transition-all group relative overflow-hidden flex flex-col h-full {{ $isExpired ? 'opacity-60 grayscale' : 'hover:shadow-xl hover:-translate-y-1' }}">
                    <!-- Status Badge -->
                    @if($isExpired)
                        <div class="absolute -right-8 top-6 bg-slate-500 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">EXPIRED</div>
                    @elseif($isUpcoming)
                        <div class="absolute -right-8 top-6 bg-amber-500 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">UPCOMING</div>
                    @elseif($isLive && !$isEnrolled)
                        <div class="absolute -right-8 top-6 bg-indigo-500 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">ENROLL NOW</div>
                    @elseif($isLive && $isEnrolled)
                        <div class="absolute -right-8 top-6 bg-emerald-500 text-white px-10 py-1 rotate-45 text-[8px] font-black uppercase tracking-widest shadow-lg">LIVE NOW</div>
                    @endif

                    <div class="flex-grow mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-indigo-600 border border-slate-100 shadow-inner group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="fas fa-broadcast-tower text-base"></i>
                            </div>
                        </div>
                        <h3 class="text-sm font-black text-slate-900 tracking-tighter leading-tight mb-1 line-clamp-1">{{ $quiz->title }}</h3>
                        <p class="text-[9px] text-slate-400 font-bold italic line-clamp-2">{{ $quiz->description ?? 'Scheduled contest assessment.' }}</p>
                    </div>

                    <div class="space-y-2 mb-6 mt-auto border-t border-slate-50 pt-4">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <span class="text-[8px] text-slate-400 font-black uppercase tracking-widest">Starts</span>
                            <span class="text-[10px] font-black text-slate-900">{{ $quiz->start_time->format('d M, H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <span class="text-[10px] font-black text-indigo-600">₹{{ number_format($quiz->price) }}</span>
                            <span class="text-[8px] font-black {{ $isEnrolled ? 'text-emerald-500' : 'text-slate-400' }} uppercase tracking-widest">{{ $isEnrolled ? 'Purchased' : 'Entry Fee' }}</span>
                        </div>
                    </div>

                    @if($isExpired)
                        <button disabled class="w-full text-center bg-slate-100 text-slate-400 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-200 cursor-not-allowed">
                            Time Expired
                        </button>
                    @elseif($isUpcoming && !$isEnrolled)
                        <a href="{{ route('student.exams.show', $quiz->id) }}" class="block w-full text-center bg-emerald-600 text-white py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-md">
                            Enroll Now <i class="fas fa-shopping-cart ml-1"></i>
                        </a>
                    @elseif($isUpcoming && $isEnrolled)
                        <button disabled class="w-full text-center bg-amber-50 text-amber-600 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest border border-amber-100 cursor-not-allowed">
                            Awaiting Launch <i class="fas fa-clock ml-1"></i>
                        </button>
                    @else
                        <a href="{{ route('student.exams.show', $quiz->id) }}" class="block w-full text-center {{ $isEnrolled ? 'bg-slate-900' : 'bg-emerald-600' }} text-white py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-md">
                            {{ $isEnrolled ? 'Enter Terminal' : 'Enroll Now' }} <i class="fas {{ $isEnrolled ? 'fa-bolt' : 'fa-shopping-cart' }} ml-1"></i>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-16 bg-slate-50 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">No Live Events Scheduled</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Practice Quizzes Section -->
    <div class="mb-12">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-1 rounded-full bg-emerald-500"></div>
            <h3 class="text-[12px] font-black uppercase tracking-[0.3em] text-slate-400 italic">Practice Terminals / Normal Quizzes</h3>
        </div>

        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-6">
            @forelse($practiceQuizzes as $quiz)
                @php
                    $attemptsUsed = $quiz->quiz_attempts_count ?? 0;
                    $isBlocked = $quiz->attempts()->where('student_id', auth()->id())->where('is_blocked', true)->exists();
                    $isEnrolled = auth()->user()->quizEnrollments()->where('quiz_id', $quiz->id)->exists();
                @endphp
                
                <div class="bg-white rounded-[2rem] p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group overflow-hidden relative flex flex-col h-full">
                    <div class="flex-grow mb-6">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-inner border border-slate-100">
                            <i class="fas fa-graduation-cap text-base"></i>
                        </div>
                        <h3 class="text-sm font-black text-slate-900 tracking-tighter leading-tight mb-2 line-clamp-1">{{ $quiz->title }}</h3>
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 {{ $quiz->is_practice_set ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }} text-[8px] font-black uppercase tracking-widest rounded-md">
                                {{ $quiz->is_practice_set ? 'Practice Set' : 'Normal Quiz' }}
                            </span>
                            <span class="px-2 py-0.5 bg-slate-100 text-[8px] font-black uppercase tracking-widest text-slate-500 rounded-md">
                                Attempts: {{ $attemptsUsed }} / {{ ($quiz->is_practice_set || $quiz->attempts_limit == 0) ? '∞' : $quiz->attempts_limit }}
                            </span>
                            <span class="px-2 py-0.5 bg-indigo-50 text-[8px] font-black uppercase tracking-widest text-indigo-600 rounded-md">
                                Total Questions: {{ $quiz->questions()->count() }}
                            </span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold italic line-clamp-2">{{ $quiz->description ?? 'Open skill assessment.' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mb-6 mt-auto border-t border-slate-50 pt-4">
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1 leading-none">Limit</p>
                            <p class="text-[10px] font-black text-slate-900">{{ $quiz->duration_minutes }} Min</p>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1 leading-none">Price</p>
                            <p class="text-[10px] font-black text-emerald-600">₹{{ number_format($quiz->price) }}</p>
                        </div>
                    </div>

                    @if($isBlocked)
                        <div class="w-full text-center bg-slate-100 text-slate-400 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest cursor-not-allowed border border-slate-200">
                            Security Block <i class="fas fa-lock ml-1 text-red-500"></i>
                        </div>
                    @elseif($attemptsUsed >= $quiz->attempts_limit && $quiz->attempts_limit > 0)
                        <a href="{{ route('student.results.show', $quiz->attempts()->where('student_id', auth()->id())->latest()->first()->id) }}" class="block w-full text-center bg-indigo-50 text-indigo-600 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-indigo-100 transition-all border border-indigo-100 shadow-sm">
                            View Result <i class="fas fa-poll ml-1"></i>
                        </a>
                    @else
                        <a href="{{ route('student.exams.show', $quiz->id) }}" class="block w-full text-center {{ $isEnrolled ? 'bg-slate-900 text-white' : 'bg-emerald-50 text-emerald-700' }} py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm border border-emerald-100">
                            {{ $isEnrolled ? 'Enter Terminal' : 'Enroll Now' }} <i class="fas {{ $isEnrolled ? 'fa-bolt' : 'fa-shopping-cart' }} ml-1"></i>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-16 bg-slate-50 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">No Practice Quizzes Available</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard.layout>
