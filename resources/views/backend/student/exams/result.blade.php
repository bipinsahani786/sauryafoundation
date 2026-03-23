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

                <div class="flex justify-center gap-4">
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
