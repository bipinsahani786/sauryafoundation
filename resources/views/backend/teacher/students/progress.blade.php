<x-dashboard.layout>
    <x-slot name="title">Progress: {{ $student->name }} | Shaurya Syndicate</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-[1.5rem] bg-indigo-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-indigo-100">
                    {{ substr($student->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $student->name }}</h1>
                    <p class="text-slate-500 text-sm font-medium">{{ $student->email }}</p>
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
