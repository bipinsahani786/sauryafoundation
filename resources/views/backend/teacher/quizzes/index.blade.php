<x-dashboard.layout>
    <x-slot name="title">Exam Management</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Examinations</h2>
            <p class="text-xs text-slate-400 font-bold italic">Create and manage your coaching assessments.</p>
        </div>
        <a href="{{ route('teacher.quizzes.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
            <i class="fas fa-plus"></i> Create New Exam
        </a>
    </div>

    <div class="space-y-12">
        @php
            $rootQuizzes = $quizzes->where('parent_id', null);
            $contestRoots = $rootQuizzes->where('is_contest', true);
            $standaloneQuizzes = $quizzes->where('parent_id', null)->where('is_contest', false)->where('level_number', '!=', 1);
        @endphp

        @foreach($contestRoots as $root)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="bg-indigo-50/50 p-6 border-b border-indigo-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-100">
                            <i class="fas fa-sitemap text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 mb-0.5">Contest Pipeline</h4>
                            <p class="text-sm font-black text-slate-900">{{ $root->title }}</p>
                        </div>
                    </div>
                </div>

                <table class="w-full text-left table-standard border-collapse">
                    <thead class="bg-slate-50/50 text-slate-400 font-black uppercase tracking-[0.2em] text-[8px] border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4">Level Status</th>
                            <th class="px-8 py-4">Examination Identity</th>
                            <th class="px-8 py-4 text-center">Enrolled</th>
                            <th class="px-8 py-4 text-center">Settings</th>
                            <th class="px-8 py-4 text-right">Terminal Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @php
                            $hierarchy = collect([$root])->concat(\App\Models\Quiz::where('parent_id', $root->id)->orderBy('level_number')->get());
                        @endphp
                        @foreach($hierarchy as $quiz)
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl {{ $quiz->level_number == 1 ? 'bg-purple-600' : 'bg-emerald-600' }} text-white flex items-center justify-center font-black text-[10px] shadow-lg shadow-indigo-100">
                                            L{{ $quiz->level_number ?? 1 }}
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase border {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                                            {{ $quiz->status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="font-black text-slate-900 text-xs tracking-tight group-hover:text-indigo-600 transition-colors">{{ $quiz->title }}</div>
                                    <div class="text-[9px] text-slate-400 font-bold italic line-clamp-1 mt-0.5">{{ $quiz->description ?? 'Multi-stage assessment level.' }}</div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-sm font-black text-indigo-600 italic tracking-tighter">{{ $quiz->enrollments_count }}</span>
                                    <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest leading-none mt-1">Students</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex flex-col items-center gap-1.5">
                                        <div class="text-[9px] font-black text-slate-900">₹{{ number_format($quiz->price) }}</div>
                                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest">{{ $quiz->duration_minutes }} Mins</div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('teacher.quizzes.results', $quiz->id) }}" class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm" title="Analyze Results & Promote">
                                            <i class="fas fa-trophy text-xs"></i>
                                        </a>
                                        <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}" class="w-9 h-9 bg-slate-50 text-slate-500 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm" title="Edit Settings">
                                            <i class="fas fa-cog text-xs"></i>
                                        </a>
                                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="w-9 h-9 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-indigo-600 transition-all shadow-lg" title="Manage Questions">
                                            <i class="fas fa-list-check text-xs"></i>
                                        </a>
                                        @if($quiz->status !== 'published')
                                            <form action="{{ route('teacher.quizzes.publish', $quiz->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-9 h-9 bg-emerald-600 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-emerald-100" title="Publish">
                                                    <i class="fas fa-paper-plane text-xs"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('teacher.quizzes.unpublish', $quiz->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-9 h-9 bg-amber-600 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-amber-100" title="Unpublish">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <!-- Standalone Standalone Quizzes -->
        @if($standaloneQuizzes->count() > 0)
            <div class="space-y-6">
                <div class="bg-slate-50/50 p-4 rounded-2xl border border-dashed border-slate-200 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200">
                        <i class="fas fa-file-alt text-[10px]"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 italic">Standalone Assessments</p>
                </div>
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-100">
                            @foreach($standaloneQuizzes as $quiz)
                                <tr class="hover:bg-slate-50 transition-all">
                                    <td class="px-8 py-4 font-black text-slate-900 text-xs">{{ $quiz->title }}</td>
                                    <td class="px-8 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}" class="text-[9px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">Edit</a>
                                            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-[9px] font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-700 transition-colors">Manage</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-dashboard.layout>
