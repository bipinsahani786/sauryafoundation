<x-dashboard.layout>
    <x-slot name="title">Examination Protocol</x-slot>

    <div class="max-w-3xl mx-auto py-12">
        <div class="bg-white rounded-[3rem] border border-slate-200 shadow-2xl overflow-hidden relative">
            <!-- Header Section -->
            <div class="bg-indigo-600 p-12 text-white relative">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <i class="fas fa-shield-alt text-[120px]"></i>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-black tracking-tighter mb-4 leading-none">{{ $quiz->title }}</h2>
                    <div class="flex gap-6">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock opacity-60"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">{{ $quiz->duration_minutes }} Minutes</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-question-circle opacity-60"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">{{ $quiz->questions->count() }} Questions</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-12">
                <div class="mb-10">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 mb-3 ml-1">Terminal Instructions</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4 items-start group">
                            <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-[10px] shadow-sm flex-shrink-0">1</div>
                            <p class="text-xs text-slate-600 font-medium italic">Ensure a stable network connection before initializing the terminal.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-6 h-6 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-black text-[10px] shadow-sm flex-shrink-0">2</div>
                            <p class="text-xs text-slate-600 font-medium italic">Terminal will transition to <span class="text-red-600 font-bold">Fullscreen Mode</span>. Exiting fullscreen or switching tabs will trigger security flags.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-6 h-6 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-[10px] shadow-sm flex-shrink-0">3</div>
                            <p class="text-xs text-slate-600 font-medium italic">Automatic submission will trigger upon timer expiration.</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex items-center justify-between">
                    <div>
                        <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Access Status</p>
                        @php
                            $isUpcoming = $quiz->start_time && $quiz->start_time->isFuture();
                            $isExpired = $quiz->end_time && $quiz->end_time->isPast();
                            $isLive = !$isUpcoming && !$isExpired;
                        @endphp

                        @if($isExpired)
                            <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">Window Closed</span>
                        @elseif($isUpcoming)
                            <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Awaiting Launch</span>
                        @else
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Authorized</span>
                        @endif
                    </div>
                    
                    @if($isBlocked)
                        <button disabled class="bg-red-100 text-red-600 px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] cursor-not-allowed border border-red-200">
                            Security Block <i class="fas fa-lock ml-2"></i>
                        </button>
                    @elseif($hasCompleted || (isset($lastAttempt) && auth()->user()->quizAttempts()->where('quiz_id', $quiz->id)->where('status', 'completed')->count() >= $quiz->attempts_limit && $quiz->attempts_limit > 0 && !$quiz->is_practice_set))
                        <a href="{{ route('student.results.show', $lastAttempt->id) }}" class="bg-indigo-600 text-white px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 block text-center">
                            View Result <i class="fas fa-poll ml-2"></i>
                        </a>
                    @elseif(!$isExpired)
                        @if(!$isEnrolled)
                            <form action="{{ route('student.exams.enroll', $quiz->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-emerald-600 text-white px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-900 transition-all shadow-xl shadow-emerald-100 flex flex-col items-center">
                                    <span>Enroll Now <i class="fas fa-shopping-cart ml-2"></i></span>
                                    @if($quiz->price > 0)
                                        <span class="text-[8px] opacity-80 mt-1 whitespace-nowrap">Amount: ₹{{ number_format($quiz->price) }}</span>
                                    @else
                                        <span class="text-[8px] opacity-80 mt-1 uppercase tracking-[0.2em]">Free Access</span>
                                    @endif
                                </button>
                            </form>
                        @elseif($isLive || !$quiz->start_time)
                            <form action="{{ route('student.exams.start', $quiz->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-indigo-600 text-white px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100">
                                    Initialize Engine <i class="fas fa-bolt ml-2"></i>
                                </button>
                            </form>
                        @else
                            <button disabled class="bg-amber-100 text-amber-600 px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] cursor-not-allowed border border-amber-200">
                                Awaiting Launch <i class="fas fa-clock ml-2"></i>
                            </button>
                        @endif
                    @else
                        <button disabled class="bg-slate-100 text-slate-400 px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] cursor-not-allowed border border-slate-200">
                            Terminal Locked <i class="fas fa-lock ml-2"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <p class="text-center mt-12 text-[9px] text-slate-400 font-bold uppercase tracking-widest animate-pulse italic">Security Proctoring Active <i class="fas fa-circle text-[6px] text-red-500 ml-1"></i></p>
    </div>
</x-dashboard.layout>
