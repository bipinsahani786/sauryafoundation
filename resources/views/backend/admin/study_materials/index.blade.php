<x-dashboard.layout>
    <x-slot name="title">Global Study Materials | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight italic uppercase">Central Resource Hub</h1>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest leading-loose italic">Manage global study notes and academic documents for all terminals.</p>
            </div>
            <a href="{{ route('admin.study-materials.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-xl shadow-indigo-100 italic">
                <i class="fas fa-plus"></i> Upload New Resource
            </a>
        </div>

        <!-- Materials Table -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-8 italic">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] italic">
                            <th class="px-6 pb-4">Resource</th>
                            <th class="px-6 pb-4">Category</th>
                            <th class="px-6 pb-4">Class</th>
                            <th class="px-6 pb-4">Status</th>
                            <th class="px-6 pb-4">Uploaded At</th>
                            <th class="px-6 pb-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                        <tr class="group hover:bg-slate-50/50 transition-all">
                            <td class="px-6 py-4 bg-slate-50/50 rounded-l-[1.5rem] border-y border-l border-slate-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-indigo-600 shadow-sm group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all">
                                        <i class="fas {{ $material->category == 'pdf' ? 'fa-file-pdf' : 'fa-file-alt' }} text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-black text-slate-900 tracking-tight">{{ $material->title }}</h3>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">SECURE LINK LOCKED</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-slate-50/50 border-y border-slate-100">
                                <span class="px-4 py-1.5 rounded-full bg-white border border-slate-200 text-[10px] font-black uppercase tracking-widest text-slate-600 shadow-sm">
                                    {{ $material->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-slate-50/50 border-y border-slate-100">
                                <span class="text-[10px] font-black uppercase tracking-widest {{ $material->class_id ? 'text-indigo-600' : 'text-slate-400' }}">
                                    {{ $material->class_id ? $material->studentClass->name : 'ALL CLASSES (GLOBAL)' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-slate-50/50 border-y border-slate-100 font-bold">
                                <form action="{{ route('admin.study-materials.toggle-status', $material) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 {{ $material->status === 'active' ? 'text-emerald-600' : 'text-rose-500' }} text-[10px] font-black uppercase tracking-widest">
                                        <div class="w-2 h-2 rounded-full {{ $material->status === 'active' ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></div>
                                        {{ $material->status }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 bg-slate-50/50 border-y border-slate-100 text-[10px] font-bold text-slate-400">
                                {{ $material->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 bg-slate-50/50 rounded-r-[1.5rem] border-y border-r border-slate-100 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.study-materials.edit', $material) }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.study-materials.destroy', $material) }}" method="POST" onsubmit="return confirm('Archive this resource terminal?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-rose-400 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-20 text-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                                    <i class="fas fa-folder-open text-3xl"></i>
                                </div>
                                <h3 class="text-slate-900 font-black uppercase tracking-tight italic mb-2">Vault Empty</h3>
                                <p class="text-slate-400 text-xs font-bold italic uppercase tracking-widest">No global study materials published yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($materials->hasPages())
            <div class="mt-8 border-t border-slate-100 pt-8">
                {{ $materials->links() }}
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
