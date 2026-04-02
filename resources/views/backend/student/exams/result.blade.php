<x-dashboard.layout>
    <x-slot name="title">Assessment Result</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <div class="bg-white rounded-[3rem] border border-slate-200 shadow-2xl overflow-hidden">
            <div class="p-12 text-center border-b border-slate-100 bg-slate-50/50">
                <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm border border-emerald-100">
                    <i class="fas fa-trophy text-3xl"></i>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-2 italic">Assessment Terminal Complete</h2>
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Transaction Log Verified • Score Aggregated</p>
            </div>

            <div class="p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="text-center p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-2 leading-none">Net Score</p>
                        <h4 class="text-4xl font-black text-indigo-600 tracking-tighter">{{ $attempt->score }}<span class="text-xs text-slate-400 ml-1">/ {{ $attempt->total_marks }}</span></h4>
                    </div>

                    <div class="text-center p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-2 leading-none">Accuracy Rate</p>
                        <h4 class="text-4xl font-black text-emerald-600 tracking-tighter">
                            {{ $attempt->total_marks > 0 ? round(($attempt->score / $attempt->total_marks) * 100) : 0 }}%
                        </h4>
                    </div>

                    <div class="text-center p-6 bg-slate-900 rounded-[2rem] border border-slate-800 shadow-xl shadow-slate-200">
                        <p class="text-[9px] text-slate-500 font-black uppercase tracking-widest mb-2 leading-none">Global Rank</p>
                        <h4 class="text-4xl font-black text-brand-accent tracking-tighter">#{{ $rank }}</h4>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Metadata Analytics</h5>
                        <span class="text-[9px] font-bold text-slate-400 italic">ID: {{ substr($attempt->id, 0, 8) }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-[10px] font-bold">
                        <div class="flex justify-between">
                            <span class="text-slate-400 uppercase tracking-tighter">Time Taken:</span>
                            <span class="text-slate-900 italic">{{ floor($attempt->time_taken_seconds / 60) }}m {{ $attempt->time_taken_seconds % 60 }}s</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 uppercase tracking-tighter">Timestamp:</span>
                            <span class="text-slate-900 italic">{{ $attempt->completed_at->format('d M, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-12 bg-slate-900 rounded-[3rem] p-10 overflow-hidden relative shadow-2xl">
                    <div class="absolute top-0 right-0 p-8 opacity-5">
                        <i class="fas fa-medal text-[100px]"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-1 rounded-full bg-brand-accent"></div>
                            <h3 class="text-[12px] font-black uppercase tracking-[0.3em] text-slate-400 italic">Assessment Leaderboard</h3>
                        </div>

                        <div class="space-y-4">
                            @php $pos = 1; @endphp
                            @foreach($leaderboard as $lb)
                                <div class="flex items-center justify-between p-5 bg-white/5 border border-white/5 rounded-3xl transition-all hover:bg-white/10 {{ $lb->student_id === auth()->id() ? 'border-brand-accent/50 bg-brand-accent/5 shadow-[0_0_30px_rgba(16,185,129,0.1)]' : '' }}">
                                    <div class="flex items-center gap-5">
                                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black text-xs {{ $pos <= 3 ? 'bg-brand-accent text-slate-900' : 'bg-white/10 text-white/40' }} shadow-lg">
                                            {{ $pos }}
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-black text-white uppercase tracking-tighter">{{ $lb->student->name }}</p>
                                            <p class="text-[8px] text-white/30 font-bold uppercase tracking-widest mt-0.5">Attempted {{ $lb->completed_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[12px] font-black text-brand-accent italic">{{ $lb->score }}<span class="text-[9px] text-white/20 ml-1">/{{ $lb->total_marks }}</span></p>
                                        <p class="text-[8px] text-white/40 font-black uppercase tracking-widest">{{ floor($lb->time_taken_seconds / 60) }}m {{ $lb->time_taken_seconds % 60 }}s</p>
                                    </div>
                                </div>
                                @php $pos++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-center gap-4 mt-12">
                    <a href="{{ route('student.exams') }}" class="px-8 py-3 bg-slate-100 text-slate-600 rounded-full font-black text-[9px] uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Portal Exit
                    </a>
                    <a href="{{ route('student.dashboard') }}" class="px-8 py-3 bg-indigo-600 text-white rounded-full font-black text-[9px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100">
                        Dashboard Return
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
