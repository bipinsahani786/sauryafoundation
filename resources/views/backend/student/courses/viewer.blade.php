<x-dashboard.layout>
    <x-slot name="title">{{ $course->title }} | Learning Terminal</x-slot>

    <div class="fixed inset-0 bg-white z-[100] flex flex-col md:flex-row overflow-hidden text-slate-900">
        <!-- Syllabus Sidebar -->
        <div class="w-full md:w-80 bg-slate-50 border-r border-slate-200 flex flex-col h-full shrink-0 shadow-xl z-20">
            <div class="p-6 border-b border-slate-200">
                <a href="{{ route('student.courses') }}" class="text-[10px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors mb-4 inline-block">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Academy
                </a>
                <h1 class="text-sm font-black text-slate-900 tracking-tight truncate">{{ $course->title }}</h1>
                <div class="mt-2 h-1.5 w-full bg-slate-200 rounded-full overflow-hidden">
                    @php 
                        $totalContent = $course->subjects->flatMap->topics->flatMap->contents->count();
                        $completedContent = auth()->user()->contentCompletions()->whereIn('content_id', $course->subjects->flatMap->topics->flatMap->contents->pluck('id'))->count();
                        $progress = $totalContent > 0 ? round(($completedContent / $totalContent) * 100) : 0;
                    @endphp 
                    <div class="h-full bg-indigo-600 transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex justify-between mt-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">
                    <span class="text-indigo-600">{{ $progress }}% Complete</span>
                    <span>{{ $completedContent }}/{{ $totalContent }} Lessons</span>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                <div class="space-y-6">
                    @foreach($course->subjects as $subject)
                        <div class="space-y-2">
                            <h3 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] px-2 italic">{{ $subject->title }}</h3>
                            <div class="space-y-1">
                                @foreach($subject->topics as $topic)
                                    <div x-data="{ open: true }">
                                        <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-xl text-xs font-bold text-slate-900 hover:bg-slate-100 transition-all">
                                            <span>{{ $topic->title }}</span>
                                            <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                        </button>
                                        <div x-show="open" x-cloak class="mt-1 space-y-1">
                                            @foreach($topic->contents as $content)
                                                @php $isCompleted = $content->isCompletedBy(Auth::id()) @endphp
                                                <button 
                                                    class="w-full flex items-center gap-3 pl-8 pr-4 py-2 text-[11px] font-medium transition-all group {{ (isset($activeContent) && $activeContent->id === $content->id) ? 'text-indigo-600 bg-indigo-50' : 'text-slate-500 hover:text-indigo-600 hover:bg-white' }}"
                                                    @click="window.location.href='?content={{ $content->id }}'"
                                                >
                                                    <div class="w-4 h-4 rounded-full border {{ $isCompleted ? 'bg-emerald-500 border-emerald-500' : 'border-slate-300' }} flex items-center justify-center shrink-0">
                                                        @if($isCompleted)
                                                            <i class="fas fa-check text-[7px] text-white"></i>
                                                        @endif
                                                    </div>
                                                    <span class="truncate">{{ $content->title }}</span>
                                                    <i class="fas {{ $content->type === 'video' ? 'fa-play-circle' : ($content->type === 'test' ? 'fa-vial' : 'fa-file-alt') }} ml-auto opacity-40"></i>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Content Viewer -->
        <div class="flex-1 flex flex-col h-full bg-white text-slate-900 relative">
            @php
                $activeContentId = request()->query('content');
                $activeContent = $activeContentId ? $course->subjects->flatMap->topics->flatMap->contents->where('id', $activeContentId)->first() : $course->subjects->first()->topics->first()->contents->first();
            @endphp

            @if($activeContent)
                <div class="flex-1 overflow-y-auto p-8 md:p-12 custom-scrollbar">
                    <div class="max-w-4xl mx-auto space-y-8">
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-[9px] font-black uppercase tracking-widest border border-indigo-100">
                                    {{ strtoupper($activeContent->type) }}
                                </span>
                                <span class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">
                                    Topic: {{ $activeContent->topic->title }}
                                </span>
                            </div>
                            <h2 class="text-xl md:text-2xl font-black tracking-tight text-slate-900">{{ $activeContent->title }}</h2>
                        </div>

                        @if($activeContent->type === 'video')
                            <div class="aspect-video rounded-3xl overflow-hidden bg-black border-8 border-slate-50 shadow-2xl">
                                @php
                                    $url = $activeContent->body;
                                    $videoId = '';
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                                        $videoId = $match[1];
                                    }
                                @endphp
                                @if($videoId)
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 font-bold italic">Invalid Video Link</div>
                                @endif
                            </div>
                        @elseif($activeContent->type === 'note')
                            <div class="prose prose-slate prose-indigo max-w-none text-slate-700 leading-relaxed text-lg bg-slate-50 p-8 rounded-[2rem] border border-slate-100">
                                {!! nl2br(e($activeContent->body)) !!}
                            </div>
                        @elseif($activeContent->type === 'test')
                            <div class="bg-slate-50 rounded-[2.5rem] border border-slate-200 p-12 text-center space-y-6">
                                <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-4 border border-indigo-100">
                                    <i class="fas fa-vial text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-slate-900">Assessment Required</h3>
                                    <p class="text-slate-500 font-medium max-w-md mx-auto mt-2">Complete this quiz to validate your understanding of {{ $activeContent->topic->title }}.</p>
                                </div>
                                <a href="{{ route('student.exams.show', $activeContent->quiz_id) }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-lg shadow-indigo-100">
                                    Enter Test Engine <i class="fas fa-external-link-alt text-[10px] ml-1"></i>
                                </a>
                            </div>
                        @endif

                        @if($activeContent->attachment_path)
                            <div class="mt-8 p-6 bg-indigo-50 border-2 border-dashed border-indigo-100 rounded-3xl flex items-center justify-between group hover:bg-indigo-100/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-indigo-100">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Download Resources</h4>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Official Study Material & Handouts</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $activeContent->attachment_path) }}" target="_blank" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-100">
                                    <i class="fas fa-download mr-1"></i> Get PDF
                                </a>
                            </div>
                        @endif

                        <!-- Completion Action -->
                        <div class="pt-12 border-t border-slate-100 flex justify-center" x-data="{ completing: false, isDone: {{ $activeContent->isCompletedBy(Auth::id()) ? 'true' : 'false' }} }">
                            <template x-if="!isDone">
                                <button 
                                    @click="completing = true; fetch('{{ route('student.contents.complete', $activeContent) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(() => { isDone = true; completing = false; window.location.reload(); })"
                                    class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-xl shadow-emerald-100 disabled:opacity-50"
                                    :disabled="completing"
                                >
                                    <i class="fas" :class="completing ? 'fa-spinner fa-spin' : 'fa-check-circle'"></i> 
                                    <span x-text="completing ? 'Validating...' : 'Mark as Completed'"></span>
                                </button>
                            </template>
                            <template x-if="isDone">
                                <div class="flex flex-col items-center gap-3 animate-in fade-in zoom-in duration-500">
                                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl border border-emerald-100">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em]">Lesson Completed</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-12 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mb-6 border border-slate-100">
                        <i class="fas fa-compass text-3xl animate-pulse"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">Ready to Begin?</h3>
                    <p class="text-slate-400 font-medium max-w-xs mt-2 italic text-sm">Select a lesson from the syllabus sidebar to initiate your session.</p>
                </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
