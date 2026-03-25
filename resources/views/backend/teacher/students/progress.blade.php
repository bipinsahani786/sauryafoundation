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
