<x-dashboard.layout>
    <x-slot name="title">{{ $course->title }} | Academy</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white rounded-[3rem] border border-slate-100 overflow-hidden shadow-sm">
            <div class="aspect-video bg-slate-900 relative">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail }}" class="w-full h-full object-cover opacity-60">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent flex flex-col justify-end p-12">
                    <span class="inline-block px-3 py-1 bg-indigo-600 text-white rounded-full text-[9px] font-black uppercase tracking-widest mb-4 w-fit">New Course</span>
                    <h1 class="text-4xl font-black text-white tracking-tight mb-2">{{ $course->title }}</h1>
                    <p class="text-slate-300 font-medium max-w-2xl">{{ $course->description }}</p>
                </div>
            </div>

            <div class="p-12 grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="md:col-span-2 space-y-8">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 mb-4">Course Syllabus</h3>
                        <div class="space-y-4">
                            @foreach($course->subjects as $subject)
                                <div class="space-y-2">
                                    <h4 class="text-xs font-black text-indigo-600 uppercase tracking-widest ml-1">{{ $subject->title }}</h4>
                                    <div class="space-y-1">
                                        @foreach($subject->topics as $topic)
                                            <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                                <div class="w-2 h-2 bg-slate-300 rounded-full"></div>
                                                <span class="text-sm font-bold text-slate-700">{{ $topic->title }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 sticky top-8">
                        <div class="mb-6">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Enrollment Fee</span>
                            <span class="text-3xl font-black text-slate-900">
                                @if($course->price > 0)
                                    ₹{{ $course->price }}
                                @else
                                    FREE
                                @endif
                            </span>
                        </div>

                        <form action="{{ route('student.courses.enroll', $course) }}" method="POST" class="space-y-3">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                Start Learning Now
                            </button>
                            <p class="text-center text-[10px] text-slate-400 font-medium">Immediate access to all materials.</p>
                        </form>
                        
                        <div class="mt-8 pt-6 border-t border-slate-200 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->teacher->name) }}&background=6366f1&color=fff" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Instructor</span>
                                <p class="text-xs font-bold text-slate-900">{{ $course->teacher->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
