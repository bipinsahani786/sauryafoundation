<x-dashboard.layout>
    <x-slot name="title">Progress: {{ $student->name }} | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm" x-data="{ creditModal: false, amount: 1 }">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-[1.5rem] bg-indigo-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-indigo-100">
                    {{ substr($student->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $student->name }}</h1>
                    <p class="text-slate-500 text-sm font-medium">{{ $student->email }}</p>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 font-black text-[9px] uppercase tracking-widest italic">
                        <i class="fas fa-wallet text-[8px]"></i> ₹{{ number_format($student->wallet_balance, 2) }}
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-8">
                <div class="text-center">
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 text-left">Academic Health</span>
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-32 bg-slate-100 rounded-full overflow-hidden">
                            @php 
                                $totalContent = $enrolledCourses->flatMap->subjects->flatMap->topics->flatMap->contents->count();
                                $completedCount = count($completions);
                                $percent = $totalContent > 0 ? ($completedCount / $totalContent) * 100 : 0;
                            @endphp
                            <div class="h-full bg-emerald-500" style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="text-sm font-black text-slate-900">{{ round($percent) }}%</span>
                    </div>
                </div>
                <button @click="creditModal = true" class="text-emerald-600 hover:bg-emerald-600 hover:text-white font-black uppercase tracking-widest text-[9px] border border-emerald-100 px-4 py-3 rounded-xl transition-all shadow-sm active:scale-95 bg-emerald-50 group flex items-center gap-2">
                    <i class="fas fa-hand-holding-dollar group-hover:scale-110 transition-transform text-xs"></i> Add Credit
                </button>
            </div>

            <!-- Credit Wallet Modal -->
            <div x-show="creditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                <div @click.away="creditModal = false" class="bg-white rounded-[2rem] w-full max-w-md p-8 shadow-2xl border border-slate-200 text-left">
                    <div class="mb-4 flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 italic tracking-tighter uppercase mb-1">Credit Wallet</h3>
                            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em]">Add money to <span class="text-indigo-600">{{ $student->name }}</span>'s balance.</p>
                        </div>
                        <button @click="creditModal = false" class="w-7 h-7 rounded-full bg-slate-50 text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center"><i class="fas fa-times text-xs"></i></button>
                    </div>

                    <div class="mb-4 p-4 {{ auth()->user()->wallet_balance < 1 ? 'bg-red-50 border-red-100' : 'bg-indigo-50 border-indigo-100' }} border rounded-2xl flex items-center justify-between shadow-sm relative overflow-hidden group">
                        @if(auth()->user()->wallet_balance < 1)
                            <div class="absolute inset-0 bg-red-100/10 pointer-events-none group-hover:bg-red-100/20 transition-all"></div>
                        @endif
                        <div>
                            <p class="text-[8px] font-black {{ auth()->user()->wallet_balance < 1 ? 'text-red-500' : 'text-indigo-600' }} uppercase tracking-[0.3em] mb-0.5 italic">Professional Balance</p>
                            <p class="text-xl font-black {{ auth()->user()->wallet_balance < 1 ? 'text-red-600' : 'text-indigo-900' }} tracking-tighter italic">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</p>
                        </div>
                        @if(auth()->user()->wallet_balance < 1)
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-red-600 text-white rounded-lg text-[8px] font-black uppercase tracking-widest shadow-lg shadow-red-200">
                                <i class="fas fa-triangle-exclamation"></i> Low Funds
                            </div>
                        @else
                            <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center text-lg shadow-lg shadow-indigo-100">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('teacher.students.add-money', $student) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Transfer Volume (₹)</label>
                            <div class="relative group">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-lg italic group-hover:text-indigo-600 transition-colors">₹</span>
                                <input type="number" 
                                    name="amount" 
                                    x-model="amount"
                                    step="0.01" 
                                    min="1" 
                                    max="{{ auth()->user()->wallet_balance }}" 
                                    placeholder="0.00" 
                                    class="w-full bg-slate-50 border-2 {{ auth()->user()->wallet_balance < 1 ? 'border-red-50/50 bg-red-50/10 opacity-50 cursor-not-allowed' : 'border-slate-100 focus:border-indigo-600 focus:bg-white' }} rounded-2xl px-12 py-4 text-xl font-black tracking-tighter outline-none transition-all placeholder:text-slate-200 italic" 
                                    {{ auth()->user()->wallet_balance < 1 ? 'disabled' : 'required' }}>
                            </div>
                            <div class="flex justify-between items-center ml-4">
                                <p class="text-[8px] text-slate-400 italic font-black uppercase tracking-wider">* Institutional protocol active.</p>
                                @if(auth()->user()->wallet_balance > 0)
                                    <p class="text-[8px] font-black uppercase tracking-widest transition-colors italic" :class="amount > {{ auth()->user()->wallet_balance }} ? 'text-red-500' : 'text-emerald-500'">
                                        <span x-text="amount > {{ auth()->user()->wallet_balance }} ? 'EXCEEDS BALANCE' : 'READY TO SETTLE'"></span>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="pt-2">
                            @if(auth()->user()->wallet_balance < 1)
                                <button type="button" class="w-full bg-slate-100 text-slate-400 font-black py-4 rounded-2xl text-[9px] uppercase tracking-[0.3em] italic cursor-not-allowed shadow-inner transition-all border border-slate-200">
                                    Protocol Blocked
                                </button>
                            @else
                                <button type="submit" 
                                    class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl text-[9px] uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl active:scale-95 group overflow-hidden relative"
                                    :disabled="amount > {{ auth()->user()->wallet_balance }} || amount < 1"
                                    :class="amount > {{ auth()->user()->wallet_balance }} || amount < 1 ? 'opacity-50 cursor-not-allowed grayscale' : ''">
                                    Authorize Transaction <i class="fas fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Exam History -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
            <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-2">
                Exam History 
                <span class="text-[10px] text-slate-400 font-bold tracking-[0.2em] uppercase">Security Monitoring Active</span>
            </h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Examination</th>
                            <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date / Time</th>
                            <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Score Result</th>
                            <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Integrity Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($quizAttempts as $attempt)
                            <tr class="group">
                                <td class="py-5">
                                    <p class="text-sm font-black text-slate-900">{{ $attempt->quiz->title }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Duration: {{ $attempt->quiz->duration_minutes }} Min</p>
                                </td>
                                <td class="py-5">
                                    <p class="text-xs font-bold text-slate-700">{{ $attempt->created_at->format('d M, Y') }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">{{ $attempt->created_at->format('h:i A') }}</p>
                                </td>
                                <td class="py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-black text-slate-900">{{ $attempt->score }}<span class="text-slate-400 text-[10px]">/{{ $attempt->total_marks }}</span></span>
                                        <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase {{ $attempt->score >= ($attempt->total_marks * 0.4) ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                            {{ round(($attempt->score / max(1, $attempt->total_marks)) * 100) }}%
                                        </span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    @if($attempt->is_blocked)
                                        <div class="flex flex-col gap-1">
                                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-[8px] font-black uppercase tracking-widest w-fit flex items-center gap-1.5">
                                                <i class="fas fa-exclamation-triangle"></i> Security Breach
                                            </span>
                                            <p class="text-[8px] text-red-400 font-bold italic line-clamp-1">Ref: {{ $attempt->block_reason }}</p>
                                        </div>
                                    @else
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[8px] font-black uppercase tracking-widest w-fit flex items-center gap-1.5">
                                            <i class="fas fa-check-circle"></i> Clean Session
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-400 text-xs italic font-bold">No examination attempts logged for this student.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Course Progress -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($enrolledCourses as $course)
                <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm">
                    <div class="p-8 bg-slate-50/50 border-b border-slate-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-black text-slate-900">{{ $course->title }}</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Enrollment Date: {{ $course->pivot->enrolled_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="p-8 space-y-8">
                        @foreach($course->subjects as $subject)
                            <div class="space-y-4">
                                <h4 class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em] ml-2 italic">{{ $subject->title }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($subject->topics as $topic)
                                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                                            <h5 class="text-xs font-black text-slate-800 mb-3">{{ $topic->title }}</h5>
                                            <div class="space-y-2">
                                                @foreach($topic->contents as $content)
                                                    @php $isDone = in_array($content->id, $completions) @endphp
                                                    <div class="flex items-center gap-3 text-[10px] font-bold">
                                                        <div class="w-4 h-4 rounded-full border {{ $isDone ? 'bg-emerald-500 border-emerald-500' : 'border-slate-300' }} flex items-center justify-center shrink-0">
                                                            @if($isDone) <i class="fas fa-check text-[7px] text-white"></i> @endif
                                                        </div>
                                                        <span class="{{ $isDone ? 'text-slate-900' : 'text-slate-400' }} truncate">{{ $content->title }}</span>
                                                        <i class="fas {{ $content->type === 'video' ? 'fa-play-circle' : ($content->type === 'test' ? 'fa-vial' : 'fa-file-alt') }} ml-auto opacity-30"></i>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="py-20 text-center bg-white rounded-[2.5rem] border border-slate-100">
                    <i class="fas fa-user-clock text-4xl text-slate-200 mb-4"></i>
                    <h3 class="text-slate-900 font-bold">No Course Enrollment</h3>
                    <p class="text-slate-500 text-sm">This student hasn't enrolled in any academy courses yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard.layout>
