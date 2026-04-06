<x-dashboard.layout>
    <x-slot name="title">Exam Center | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-10 italic">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Examination Terminal</h1>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em] leading-loose">Draft, Publish, and Monitor Coaching Assessments.</p>
            </div>
            <a href="{{ route('teacher.quizzes.create') }}" class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-2xl shadow-indigo-100">
                <i class="fas fa-plus"></i> Initialize New Exam
            </a>
        </div>

        <!-- summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-6">
                <div class="w-14 h-14 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-vial"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $quizzes->count() }}</h3>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total Pipelines</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-6">
                <div class="w-14 h-14 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $quizzes->where('status', 'published')->count() }}</h3>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Published Exams</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-6">
                <div class="w-14 h-14 rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $quizzes->where('status', 'pending')->count() }}</h3>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Draft / Pending</p>
                </div>
            </div>
        </div>

        @php
            $rootQuizzes = $quizzes->where('parent_id', null);
            $contestRoots = $rootQuizzes->where('is_contest', true);
            $standaloneQuizzes = $rootQuizzes->where('is_contest', false);
        @endphp

        @if($quizzes->count() === 0)
            <div class="bg-white rounded-[3rem] border border-slate-200 shadow-sm p-24 text-center">
                <div class="w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-8 text-slate-300">
                    <i class="fas fa-vial text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-3">No Examinations Found</h3>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest max-w-sm mx-auto leading-relaxed opacity-70">
                    You haven't initiated any assessment pipelines yet. Start by creating a new exam or contest.
                </p>
            </div>
        @endif

        <!-- Contest Sections -->
        @foreach($contestRoots as $root)
            <div class="bg-white rounded-[3rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="bg-slate-50/50 p-8 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-[1.5rem] bg-indigo-600 text-white flex items-center justify-center shadow-xl shadow-indigo-100">
                            <i class="fas fa-sitemap text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 mb-1">Contest Pipeline Identity</h4>
                            <p class="text-xl font-black text-slate-900 tracking-tight">{{ $root->title }}</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">
                                <th class="px-8 pb-4">Level status</th>
                                <th class="px-8 pb-4">Examination</th>
                                <th class="px-8 pb-4 text-center">Stats</th>
                                <th class="px-8 pb-4 text-center">Config</th>
                                <th class="px-8 pb-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $hierarchy = collect([$root])->concat(\App\Models\Quiz::where('parent_id', $root->id)->orderBy('level_number')->get());
                            @endphp
                            @foreach($hierarchy as $quiz)
                                <tr class="group hover:bg-slate-50/50 transition-all font-bold">
                                    <td class="px-8 py-5 bg-slate-50/30 first:rounded-l-[1.5rem] border-y border-l border-slate-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-2xl {{ $quiz->level_number == 1 ? 'bg-purple-600' : ($quiz->level_number > 1 ? 'bg-emerald-600' : 'bg-slate-900') }} text-white flex items-center justify-center font-black text-[10px] shadow-lg">
                                                L{{ $quiz->level_number ?? 1 }}
                                            </div>
                                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase border {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                                                {{ $quiz->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 bg-slate-50/30 border-y border-slate-100">
                                        <div class="text-xs font-black text-slate-900 tracking-widest uppercase italic group-hover:text-indigo-600 transition-colors">{{ $quiz->title }}</div>
                                        <div class="text-[9px] text-slate-400 font-black italic line-clamp-1 mt-1 opacity-70">{{ $quiz->description ?? 'Multi-stage assessment level.' }}</div>
                                    </td>
                                    <td class="px-8 py-5 bg-slate-50/30 border-y border-slate-100 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <span class="text-sm font-black text-indigo-600 italic tracking-tighter">{{ $quiz->enrollments_count }}</span>
                                            <p class="text-[7px] text-slate-400 font-black uppercase tracking-[0.2em] leading-none mt-1">Enrollments</p>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 bg-slate-50/30 border-y border-slate-100 text-center">
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="text-[9px] font-black text-slate-900 tracking-widest">₹{{ number_format($quiz->price) }}</div>
                                            <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest italic opacity-70">{{ $quiz->duration_minutes }} Mins</div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 bg-slate-50/30 last:rounded-r-[1.5rem] border-y border-r border-slate-100 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('teacher.quizzes.results', $quiz->id) }}" class="w-10 h-10 bg-white border border-slate-200 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm" title="Analyze Results">
                                                <i class="fas fa-chart-bar text-xs"></i>
                                            </a>
                                            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-indigo-600 transition-all shadow-lg" title="Manage Questions">
                                                <i class="fas fa-list-check text-xs"></i>
                                            </a>
                                            
                                            <div class="w-px h-10 bg-slate-100 mx-1"></div>

                                            @if($quiz->status !== 'published')
                                                <form action="{{ route('teacher.quizzes.publish', $quiz->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-emerald-50" title="Publish">
                                                        <i class="fas fa-paper-plane text-xs"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('teacher.quizzes.unpublish', $quiz->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-amber-50" title="Unpublish">
                                                        <i class="fas fa-eye-slash text-xs"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}" class="w-10 h-10 bg-white border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm" title="Edit Settings">
                                                <i class="fas fa-cog text-xs"></i>
                                            </a>
                                            
                                            <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Archival permanent. Proceed?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-10 h-10 bg-white border border-slate-200 text-rose-400 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm" title="Delete">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <!-- Standalone Assessments -->
        @if($standaloneQuizzes->count() > 0)
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="h-px flex-1 bg-slate-200"></div>
                    <div class="bg-indigo-50 px-6 py-2 rounded-full border border-indigo-100 flex items-center gap-3">
                        <i class="fas fa-file-alt text-indigo-400 text-xs"></i>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 italic">Standalone Terminal Assets</span>
                    </div>
                    <div class="h-px flex-1 bg-slate-200"></div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 pb-10">
                    @foreach($standaloneQuizzes as $quiz)
                        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-50/50 transition-all group overflow-hidden flex flex-col">
                            <div class="p-8 flex-1">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-indigo-600 border border-slate-100 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        <i class="fas fa-vial text-lg"></i>
                                    </div>
                                    <span class="px-4 py-1.5 rounded-full text-[8px] font-black uppercase border {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                                        {{ $quiz->status }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 tracking-widest uppercase italic mb-2 line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $quiz->title }}</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest line-clamp-2 italic mb-6 leading-relaxed opacity-70">
                                    {{ $quiz->description ?? 'No resource abstract available for this terminal asset.' }}
                                </p>
                                
                                <div class="grid grid-cols-3 gap-4 border-t border-slate-50 pt-6">
                                    <div class="text-center">
                                        <p class="text-sm font-black text-slate-900 tracking-tighter italic">₹{{ number_format($quiz->price) }}</p>
                                        <p class="text-[7px] text-slate-400 font-black uppercase tracking-widest">Entry</p>
                                    </div>
                                    <div class="text-center border-x border-slate-100">
                                        <p class="text-sm font-black text-slate-900 tracking-tighter italic">{{ $quiz->duration_minutes }}m</p>
                                        <p class="text-[7px] text-slate-400 font-black uppercase tracking-widest">Window</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm font-black text-slate-900 tracking-tighter italic">{{ $quiz->questions_count ?? $quiz->questions->count() }}</p>
                                        <p class="text-[7px] text-slate-400 font-black uppercase tracking-widest">Questions</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 p-6 border-t border-slate-100 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex gap-2">
                                        <a href="{{ route('teacher.quizzes.results', $quiz->id) }}" class="w-10 h-10 bg-white border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all shadow-sm" title="Results">
                                            <i class="fas fa-chart-line text-xs"></i>
                                        </a>
                                        <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}" class="w-10 h-10 bg-white border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm" title="Settings">
                                            <i class="fas fa-cog text-xs"></i>
                                        </a>
                                        <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Permanently archival?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-white border border-slate-200 text-rose-400 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm" title="Delete">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>

                                    @if($quiz->status !== 'published')
                                        <form action="{{ route('teacher.quizzes.publish', $quiz->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-emerald-50" title="Publish Now">
                                                <i class="fas fa-paper-plane text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('teacher.quizzes.unpublish', $quiz->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-amber-50" title="Unpublish">
                                                <i class="fas fa-eye-slash text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                
                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg flex items-center justify-center gap-2 group">
                                    Terminal Management <i class="fas fa-list-check group-hover:rotate-12 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-dashboard.layout>
