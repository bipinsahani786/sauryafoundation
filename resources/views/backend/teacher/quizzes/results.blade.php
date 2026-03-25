<x-dashboard.layout>
    <x-slot name="title">Quiz Analytics: {{ $quiz->title }}</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Examination Insights</h2>
                <p class="text-xs text-slate-400 font-bold italic">Deep analytics and student performance matrix for {{ $quiz->title }}.</p>
            </div>
            <a href="{{ route('teacher.quizzes.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-all">
                <i class="fas fa-arrow-left mr-1"></i> Back to Terminal
            </a>
        </div>

        <!-- Analytics Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Total Coverage</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-slate-900">{{ $attemptedStudents }}<span class="text-slate-300 text-sm">/{{ $totalStudents }}</span></h4>
                        <p class="text-[10px] text-slate-400 font-bold italic">Students Attempted</p>
                    </div>
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                        <i class="fas fa-users text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Class Average</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-emerald-600">{{ round($avgScore, 1) }}</h4>
                        <p class="text-[10px] text-slate-400 font-bold italic">Avg. Terminal Marks</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                        <i class="fas fa-chart-line text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Success Matrix</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-purple-600">{{ round($successRate) }}%</h4>
                        <p class="text-[10px] text-slate-400 font-bold italic">Terminal Pass Rate</p>
                    </div>
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                        <i class="fas fa-award text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Integrity Alerts</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-rose-600">{{ $breaches }}</h4>
                        <p class="text-[10px] text-slate-400 font-bold italic">Security Violations</p>
                    </div>
                    <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600">
                        <i class="fas fa-shield-virus text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Results -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Student Performance Matrix</h3>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full">Sorted by Rank</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Rank</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Student Identity</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Score / Total</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Efficiency</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Integrity</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Duration</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($attempts as $index => $attempt)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6">
                                    <span class="w-8 h-8 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center font-black text-xs group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900">{{ $attempt->student->name }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold italic">{{ $attempt->student->email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-900">{{ $attempt->score }}</span>
                                    <span class="text-[10px] text-slate-300 font-bold">/ {{ $attempt->total_marks }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    @php $percent = ($attempt->score / max(1, $attempt->total_marks)) * 100 @endphp
                                    <div class="flex items-center gap-3">
                                        <div class="w-16 h-1 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full {{ $percent >= 40 ? 'bg-emerald-500' : 'bg-rose-500' }}" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <span class="text-[10px] font-black {{ $percent >= 40 ? 'text-emerald-600' : 'text-rose-600' }}">{{ round($percent) }}%</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if($attempt->is_blocked)
                                        <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[8px] font-black uppercase tracking-widest border border-rose-100">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> BREACHED
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[8px] font-black uppercase tracking-widest border border-emerald-100">
                                            <i class="fas fa-check-circle mr-1"></i> SECURE
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                        {{ floor($attempt->time_taken_seconds / 60) }}m {{ $attempt->time_taken_seconds % 60 }}s
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center text-slate-400 font-bold italic text-xs">
                                    No terminal data recorded for this examination yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard.layout>
