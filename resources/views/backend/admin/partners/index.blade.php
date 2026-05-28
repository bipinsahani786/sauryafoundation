<x-dashboard.layout>
    <x-slot name="title">Partners & Sponsors</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Partners & Sponsors</h2>
            <p class="text-xs text-slate-400 font-medium italic">Manage partner and sponsor logos displayed on the landing page.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all shadow-indigo-100 uppercase tracking-widest font-black">
            <i class="fas fa-plus mr-1"></i> Add New Partner
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Logo</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Name</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Order</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($partners as $partner)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $partner->image_path) }}" class="w-20 h-12 object-contain rounded-md border border-slate-200 shadow-sm bg-white p-1">
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-900 font-bold text-sm">{{ $partner->name }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $partner->order }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $partner->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $partner->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $partner->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.partners.toggle-status', $partner->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $partner->is_active ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $partner->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Delete this partner permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">No partners available. Click "Add New Partner" to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($partners->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $partners->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
