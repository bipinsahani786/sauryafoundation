<x-dashboard.layout>
    <x-slot name="title">Academic Class Management</x-slot>

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Academic Classes</h2>
            <p class="text-xs text-slate-400 font-bold italic">Manage student grades and batches globally.</p>
        </div>
        <a href="{{ route('admin.student-classes.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
            <i class="fas fa-plus"></i> New Class Category
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($classes as $class)
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-xl transition-all relative">
                <div class="p-8 border-b border-slate-100 bg-white relative">
                    <div class="absolute top-6 right-6">
                        <form action="{{ route('admin.student-classes.toggle-status', $class->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-2 py-1 rounded {{ $class->status == 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-[8px] font-black uppercase tracking-widest border {{ $class->status == 'active' ? 'border-emerald-100' : 'border-rose-100' }}">
                                {{ $class->status }}
                            </button>
                        </form>
                    </div>
                    
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                        <i class="fas fa-school text-lg"></i>
                    </div>

                    <h3 class="font-black text-slate-900 text-lg mb-1 tracking-tighter">{{ $class->name }}</h3>
                    <p class="text-[9px] text-slate-400 font-bold italic uppercase tracking-widest">{{ $class->slug }}</p>
                </div>

                <div class="p-8 grid grid-cols-2 gap-4 bg-white border-b border-slate-50">
                    <div>
                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Students</div>
                        <div class="text-indigo-600 font-black text-sm italic">{{ $class->students_count }}</div>
                    </div>
                    <div>
                        <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Quizzes</div>
                        <div class="text-slate-900 font-black text-sm italic">{{ $class->quizzes_count }}</div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50 flex gap-2 mt-auto">
                    <a href="{{ route('admin.student-classes.edit', $class->id) }}" class="flex-1 text-center bg-white border border-slate-200 text-slate-700 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.student-classes.destroy', $class->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Deeply sure? This action is permanent.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-center bg-rose-50 text-rose-600 border border-rose-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full border-2 border-dashed border-slate-200 rounded-3xl p-20 text-center">
                <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-layer-group text-3xl"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest mb-2">No Academic Classes Found</h3>
                <p class="text-xs text-slate-500 font-medium italic">Define your first class category to start organizing content.</p>
            </div>
        @endforelse
    </div>
</x-dashboard.layout>
