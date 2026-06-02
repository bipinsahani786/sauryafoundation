<x-dashboard.layout>
    <x-slot name="title">Global Course Management</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight italic uppercase">Global Academy</h1>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest leading-loose italic">Manage curriculum across the entire platform terminal.</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-xl shadow-indigo-100 italic">
                <i class="fas fa-plus"></i> New Global Syllabus
            </a>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
                <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm hover:shadow-2xl transition-all group flex flex-col h-full relative overflow-hidden">
                    @if($course->is_global || $course->studentClass)
                        <div class="absolute top-0 right-0 flex gap-1">
                            @if($course->is_global)
                                <span class="bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest pl-5 pr-8 py-2 rounded-bl-2xl shadow-lg">GLOBAL</span>
                            @endif
                            @if($course->studentClass)
                                <span class="bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest pl-5 pr-8 py-2 rounded-bl-2xl shadow-lg">{{ $course->studentClass->name }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm mb-4">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-1 tracking-tight italic">{{ $course->title }}</h3>
                        <p class="text-slate-400 text-[10px] font-extrabold uppercase tracking-widest italic mb-2">BY {{ $course->teacher->name ?? 'ADMIN' }}</p>
                        <p class="text-slate-500 text-xs font-bold italic line-clamp-2 leading-relaxed">{{ $course->description }}</p>
                    </div>

                    <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex gap-6">
                            <div class="flex flex-col">
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest italic">Students</span>
                                <span class="text-sm font-black text-indigo-600 italic">{{ $course->students_count }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest italic">Status</span>
                                <span class="text-[9px] font-black uppercase tracking-widest italic {{ $course->status == 'published' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $course->status }}</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                             <a href="{{ route('admin.courses.show', $course) }}" class="w-10 h-10 bg-slate-50 text-slate-400 hover:bg-slate-900 hover:text-white rounded-xl flex items-center justify-center transition-all">
                                <i class="fas fa-cog text-xs"></i>
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this global course?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-rose-50 text-rose-400 hover:bg-rose-600 hover:text-white rounded-xl flex items-center justify-center transition-all">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-slate-200 rounded-[3rem] bg-slate-50/50">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300 shadow-sm">
                        <i class="fas fa-university text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-tighter italic mb-2">Academy Terminals Offline</h3>
                    <p class="text-xs text-slate-400 font-bold italic uppercase tracking-widest">Deploy your first global syllabus to begin.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard.layout>
