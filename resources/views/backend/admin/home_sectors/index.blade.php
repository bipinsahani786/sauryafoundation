<x-dashboard.layout>
    <x-slot name="title">Home Sectors</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Home Sectors</h2>
            <p class="text-xs text-slate-400 font-medium">Manage the dynamic sectors displayed on the landing page.</p>
        </div>
        <a href="{{ route('admin.home-sectors.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all">
            <i class="fas fa-plus mr-1"></i> Add New Sector
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Image / Icon</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Sector Details</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Slug</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Tag</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Order</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($sectors as $sector)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $sector->image_path) }}" class="w-16 h-12 object-cover rounded-md border border-slate-200 shadow-sm">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                                        <i class="{{ $sector->icon ?? 'fas fa-chart-line' }}"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-900 font-bold text-sm">{{ $sector->title }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5 max-w-xs truncate">{{ $sector->description }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-600 text-[10px] uppercase tracking-wider">
                                /{{ $sector->slug }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                @if($sector->tag)
                                    <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 rounded-md font-bold text-[10px] uppercase border border-indigo-100">{{ $sector->tag }}</span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $sector->order }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $sector->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $sector->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $sector->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.home-sectors.toggle-status', $sector->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $sector->is_active ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $sector->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.home-sectors.edit', $sector->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.home-sectors.destroy', $sector->id) }}" method="POST" onsubmit="return confirm('Delete this sector permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium italic">No sectors available. Click "Add New Sector" to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sectors->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $sectors->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
