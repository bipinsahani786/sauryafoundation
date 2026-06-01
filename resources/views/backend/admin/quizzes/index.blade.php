<x-dashboard.layout>
    <x-slot name="title">Manage global exams</x-slot>

    <div class="mb-6 flex justify-between items-center bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Global / Class Exams</h2>
            <p class="text-xs text-slate-400 font-bold mt-1">Manage global assessments and multi-level contests you created.</p>
        </div>
        <a href="{{ route('admin.quizzes.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-indigo-200">
            Create Exam
        </a>
    </div>

    <div class="space-y-12">
        @php
            $rootQuizzes = $quizzes->where('parent_id', null);
            $standaloneQuizzes = $quizzes->where('parent_id', null)->filter(function($q) { return !$q->is_contest; });
            $contestRoots = $rootQuizzes->where('is_contest', true);
        @endphp

        <!-- Contest Pipelines -->
        @foreach($contestRoots as $root)
            <div class="space-y-6">
                <div class="bg-indigo-50/50 p-4 rounded-2xl border border-indigo-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow-lg">
                            <i class="fas fa-sitemap text-xs"></i>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-indigo-600">Contest Pipeline</h4>
                            <p class="text-xs font-bold text-slate-900">{{ $root->title }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                         <span class="px-3 py-1 bg-white border border-indigo-100 rounded-full text-[8px] font-black text-indigo-600 uppercase tracking-widest">
                            MASTER ROOT
                         </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @php
                        $hierarchy = collect([$root])->concat(\App\Models\Quiz::where('parent_id', $root->id)->orderBy('level_number')->get());
                    @endphp

                    @foreach($hierarchy as $quiz)
                        <div class="bg-white rounded-[2.5rem] border {{ $quiz->id == $root->id ? 'border-indigo-200 ring-4 ring-indigo-50' : 'border-slate-200' }} shadow-sm overflow-hidden flex flex-col group hover:shadow-xl transition-all relative">
                            <div class="p-8 border-b border-slate-100 bg-white relative">
                                <div class="absolute top-6 right-6 flex flex-col gap-1 items-end">
                                    <span class="px-2 py-1 rounded {{ $quiz->level_number == 1 ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }} text-[8px] font-black uppercase tracking-widest leading-none">
                                        LEVEL {{ $quiz->level_number ?? 1 }}
                                    </span>
                                    @if($quiz->status == 'published')
                                        <span class="px-2 py-1 rounded bg-emerald-50 text-emerald-600 text-[6px] font-black uppercase tracking-widest leading-none border border-emerald-100">Live</span>
                                    @endif
                                </div>
                                
                                <h3 class="font-black text-slate-900 text-lg mb-1 pr-20 tracking-tighter">{{ $quiz->title }}</h3>
                                <p class="text-[10px] text-slate-400 font-bold italic line-clamp-1 mb-4">{{ $quiz->description ?? 'Multi-stage assessment.' }}</p>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Starts</div>
                                        <div class="text-xs font-black text-indigo-600">{{ $quiz->start_time ? $quiz->start_time->format('d M Y, h:i A') : 'Immediate' }}</div>
                                    </div>
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Ends</div>
                                        <div class="text-xs font-black text-rose-600">{{ $quiz->end_time ? $quiz->end_time->format('d M Y, h:i A') : 'No Expiry' }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-8 grid grid-cols-2 gap-6 bg-white border-b border-slate-50">
                                <div>
                                    <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Pass %</div>
                                    <div class="text-indigo-600 font-black text-sm italic">{{ $quiz->promotion_percentage ?? 'Winner' }}%</div>
                                </div>
                                <div>
                                    <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Price</div>
                                    <div class="text-slate-900 font-black text-sm italic">₹{{ number_format($quiz->price) }}</div>
                                </div>
                            </div>

                            <div class="p-6 bg-slate-50 flex flex-wrap gap-2 mt-auto">
                                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="flex-1 text-center bg-white border border-slate-200 text-slate-700 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                    Edit
                                </a>
                                @if($quiz->status == 'pending')
                                    <form action="{{ route('admin.quizzes.publish', $quiz->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-emerald-50 text-emerald-600 border border-emerald-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                            Publish
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.quizzes.unpublish', $quiz->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-amber-50 text-amber-600 border border-amber-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                            Unpublish
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.quizzes.show', $quiz->id) }}" class="flex-1 text-center bg-white border border-slate-200 text-slate-700 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                    Ques ({{ $quiz->questions_count ?? $quiz->questions()->count() }})
                                </a>
                                <a href="{{ route('admin.quizzes.results', $quiz->id) }}" class="w-full text-center bg-indigo-600 text-white px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100">
                                    Manage Results & Promotion
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Standalone Quizzes -->
        @if($standaloneQuizzes->count() > 0)
            <div class="space-y-6 pt-12 border-t border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                        <i class="fas fa-file-alt text-xs"></i>
                    </div>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400 italic">Standalone Assessments</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($standaloneQuizzes as $quiz)
                        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-xl transition-all h-full">
                            <div class="p-8 border-b border-slate-100 bg-white">
                                <h3 class="font-black text-slate-900 text-lg mb-1 tracking-tighter">{{ $quiz->title }}</h3>
                                <p class="text-[10px] text-slate-400 font-bold italic line-clamp-1 mb-4">{{ $quiz->description ?? 'Regular examination.' }}</p>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Starts</div>
                                        <div class="text-xs font-black text-indigo-600">{{ $quiz->start_time ? $quiz->start_time->format('d M Y, h:i A') : 'Immediate' }}</div>
                                    </div>
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Ends</div>
                                        <div class="text-xs font-black text-rose-600">{{ $quiz->end_time ? $quiz->end_time->format('d M Y, h:i A') : 'No Expiry' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-50 mt-auto flex flex-wrap gap-2">
                                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="flex-1 text-center bg-white border border-slate-200 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">Edit</a>
                                @if($quiz->status == 'pending')
                                    <form action="{{ route('admin.quizzes.publish', $quiz->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-emerald-50 text-emerald-600 border border-emerald-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                            Publish
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.quizzes.unpublish', $quiz->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-amber-50 text-amber-600 border border-amber-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                            Unpublish
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.quizzes.show', $quiz->id) }}" class="flex-1 text-center bg-white border border-slate-200 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">Setup</a>
                                <a href="{{ route('admin.quizzes.results', $quiz->id) }}" class="w-full text-center bg-indigo-600 text-white px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100">Results</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
    <div class="mt-8">
        {{ $quizzes->links() }}
    </div>
</x-dashboard.layout>
