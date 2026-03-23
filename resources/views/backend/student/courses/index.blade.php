<x-dashboard.layout>
    <x-slot name="title">Academy | Shaurya Syndicate</x-slot>

    <div class="space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Learning Academy</h1>
                <p class="text-slate-500 text-sm font-medium">Explore professional courses and upgrade your skills.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-6 shadow-sm hover:shadow-xl transition-all group overflow-hidden">
                    <div class="aspect-video bg-slate-100 rounded-2xl mb-4 relative overflow-hidden">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fas fa-graduation-cap text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-600">
                                {{ $course->teacher->name }}
                            </span>
                        </div>
                    </div>

                    <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $course->title }}</h3>
                    <p class="text-slate-500 text-xs font-medium line-clamp-2 mb-6">{{ $course->description }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                        <span class="text-lg font-black text-slate-900">
                            @if($course->price > 0)
                                ₹{{ $course->price }}
                            @else
                                <span class="text-emerald-500">FREE</span>
                            @endif
                        </span>
                        
                        @if(in_array($course->id, $enrolledIds))
                            <a href="{{ route('student.courses.show', $course) }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-slate-800 transition-all">
                                Open Course <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        @else
                            <a href="{{ route('student.courses.show', $course) }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                View Details
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard.layout>
