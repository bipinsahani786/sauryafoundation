<x-dashboard.layout>
    <x-slot name="title">Industry Experts</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em] mb-1">Industry Experts</h2>
            <p class="text-xs text-slate-400 font-medium italic">Manage the expert profiles displayed on the homepage.</p>
        </div>
        <a href="{{ route('admin.industry-experts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
            <i class="fas fa-plus mr-1"></i> Add New Expert
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Expert</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Bio Snippet</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider text-center">Order</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($experts as $expert)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $expert->image) }}" class="w-12 h-12 object-cover rounded-full border-2 border-slate-100 shadow-sm">
                                    <div>
                                        <p class="text-slate-900 font-bold text-sm">{{ $expert->name }}</p>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-widest">{{ $expert->designation }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-600 text-xs line-clamp-2 max-w-xs leading-relaxed italic">{{ $expert->bio }}</p>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-slate-900">
                                {{ $expert->order }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $expert->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $expert->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $expert->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2 text-right">
                                    <form action="{{ route('admin.industry-experts.toggle-status', $expert->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $expert->is_active ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $expert->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.industry-experts.edit', $expert->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.industry-experts.destroy', $expert->id) }}" method="POST" onsubmit="return confirm('Delete this expert profile permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @if($expert->linkedin_url)
                                        <a href="{{ $expert->linkedin_url }}" target="_blank" class="p-2 bg-indigo-50 border border-indigo-100 rounded-lg text-indigo-600 hover:bg-indigo-100 transition-all"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">No expert profiles available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($experts->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $experts->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
