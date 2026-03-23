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
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Authorized</span>
                    </div>
                    
                    <form action="{{ route('student.exams.start', $quiz->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-indigo-600 text-white px-12 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100">
                            Initialize Engine <i class="fas fa-bolt ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <p class="text-center mt-12 text-[9px] text-slate-400 font-bold uppercase tracking-widest animate-pulse italic">Security Proctoring Active <i class="fas fa-circle text-[6px] text-red-500 ml-1"></i></p>
    </div>
</x-dashboard.layout>
