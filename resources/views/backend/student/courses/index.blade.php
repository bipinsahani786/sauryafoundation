<x-dashboard.layout>
    <x-slot name="title">Academy | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-8">
        <div class="mb-2">
            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                <i class="fas fa-arrow-left"></i> Return to Dashboard
            </a>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Learning Academy</h1>
                <p class="text-slate-500 text-sm font-medium">Explore professional courses and upgrade your skills.</p>
            </div>
        </div>

        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-5">
            @foreach($courses as $course)
                <div class="bg-white rounded-[2rem] border border-slate-100 p-5 shadow-sm hover:shadow-xl transition-all group overflow-hidden flex flex-col h-full">
                    <div class="h-32 bg-slate-50 rounded-[1.5rem] mb-4 relative overflow-hidden shrink-0 border border-slate-100">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-indigo-100">
                                <i class="fas fa-graduation-cap text-4xl group-hover:scale-110 transition-transform"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[8px] font-black uppercase tracking-widest text-indigo-600 shadow-sm border border-white/20">
                                {{ $course->teacher->name }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-sm font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors line-clamp-1">{{ $course->title }}</h3>
                        <p class="text-slate-500 text-[10px] font-medium line-clamp-2 mb-4">{{ $course->description }}</p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-50 mt-auto">
                        <span class="text-sm font-black text-slate-900">
                            @if($course->price > 0)
                                ₹{{ $course->price }}
                            @else
                                <span class="text-emerald-500">FREE</span>
                            @endif
                        </span>
                        
                        @if(in_array($course->id, $enrolledIds))
                            <a href="{{ route('student.courses.show', $course) }}" class="inline-flex items-center justify-center gap-1.5 bg-slate-900 text-white px-4 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-widest hover:bg-slate-800 transition-all">
                                Open <i class="fas fa-arrow-right text-[8px]"></i>
                            </a>
                        @else
                            <a href="{{ route('student.courses.show', $course) }}" class="inline-flex items-center justify-center gap-1.5 bg-indigo-600 text-white px-4 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-md shadow-indigo-100">
                                View Details
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard.layout>
