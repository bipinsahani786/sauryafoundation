<x-dashboard.layout>
    <x-slot name="title">Home Banners</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Platform Banners</h2>
            <p class="text-xs text-slate-400 font-medium italic font-medium">Manage banners for individual pages and sectors across the platform.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all shadow-indigo-100 uppercase tracking-widest font-black">
            <i class="fas fa-plus mr-1"></i> Add New Banner
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Image</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Banner Details</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Destination</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Order</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($banners as $banner)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $banner->image_path) }}" class="w-20 h-12 object-cover rounded-md border border-slate-200 shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-900 font-bold text-sm">{{ $banner->title }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5 max-w-xs truncate italic font-medium">{{ $banner->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ 
                                    $banner->type === 'home' ? 'bg-indigo-50 text-indigo-600' : (
                                    $banner->type === 'student' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600')
                                }}">
                                    {{ str_replace('-', ' ', $banner->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900 font-bold">
                                {{ $banner->order }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $banner->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $banner->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $banner->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.banners.toggle-status', $banner->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $banner->is_active ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $banner->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">No banners available. Click "Add New Banner" to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($banners->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $banners->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
