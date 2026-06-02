<x-dashboard.layout>
    <x-slot name="title">Course Management | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Academic Courses</h1>
                <p class="text-slate-500 text-sm font-medium">Manage your curriculum and student enrollment.</p>
            </div>
            <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-200">
                <i class="fas fa-plus"></i> Launch New Course
            </a>
        </div>

        <!-- Course Grid -->
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-5">
            @forelse($courses as $course)
                <div class="bg-white rounded-[2rem] border border-slate-100 p-5 shadow-sm hover:shadow-xl transition-all group flex flex-col h-full">
                    <div class="relative h-32 rounded-[1.5rem] bg-slate-100 mb-4 overflow-hidden shrink-0 border border-slate-100">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fas fa-book-open text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest shadow-sm {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-amber-100 text-amber-700 border border-amber-200' }}">
                                {{ $course->status }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-sm font-black text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors line-clamp-1">{{ $course->title }}</h3>
                        <p class="text-slate-500 text-[10px] font-medium line-clamp-2 mb-4">{{ $course->description }}</p>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-slate-50 mt-auto">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Students</span>
                            <span class="text-xs font-bold text-slate-900">{{ $course->students_count }}</span>
                        </div>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="px-3 py-2 bg-slate-50 text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-all text-xs font-bold border border-slate-100">
                            Manage <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fas fa-graduation-cap text-2xl"></i>
                    </div>
                    <h3 class="text-slate-900 font-bold">No Courses Yet</h3>
                    <p class="text-slate-500 text-sm">Create your first course to start teaching.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard.layout>
