<x-dashboard.layout>
    <x-slot name="title">Testimonials</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em] mb-1">Testimonials</h2>
            <p class="text-xs text-slate-400 font-medium italic">Manage customer reviews and feedback.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
            <i class="fas fa-plus mr-1"></i> Add New review
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">User</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Review Content</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Rating</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($testimonials as $testimonial)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/default-avatar.png') }}" class="w-10 h-10 object-cover rounded-xl border border-slate-200 shadow-sm">
                                    <div>
                                        <p class="text-slate-900 font-bold text-sm">{{ $testimonial->name }}</p>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-widest">{{ $testimonial->designation }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-600 text-xs line-clamp-2 max-w-xs leading-relaxed">"{{ $testimonial->content }}"</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-0.5 text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-slate-200' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $testimonial->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $testimonial->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $testimonial->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2 text-right">
                                    <form action="{{ route('admin.testimonials.toggle-status', $testimonial->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $testimonial->is_active ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $testimonial->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">No testimonials available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($testimonials->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
