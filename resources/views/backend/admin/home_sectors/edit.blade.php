<x-dashboard.layout>
    <x-slot name="title">Edit Sector</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Edit Landing Page Sector</h2>
        <p class="text-xs text-slate-400 font-medium">Update the investment sector card details.</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.home-sectors.update', $homeSector->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Sector Title</label>
                            <input type="text" name="title" value="{{ old('title', $homeSector->title) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. Marriage Halls & Banquets">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Slug (URL Name)</label>
                            <input type="text" name="slug" value="{{ old('slug', $homeSector->slug) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. marriage-halls">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Icon (FontAwesome Class)</label>
                        <input type="text" name="icon" value="{{ old('icon', $homeSector->icon) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. fas fa-hotel">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Short Description</label>
                        <textarea name="description" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="Briefly describe the sector">{{ old('description', $homeSector->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Full Page Content (HTML/Text)</label>
                        <textarea name="content" rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="Detailed content for the sector page">{{ old('content', $homeSector->content) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Sector Image (Leave blank to keep current)</label>
                            <input type="file" name="image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                            @if($homeSector->image_path)
                                <div class="mt-2 text-[10px] text-slate-400">Current: {{ $homeSector->image_path }}</div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tag Label (Optional)</label>
                            <input type="text" name="tag" value="{{ old('tag', $homeSector->tag) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. Yield Focused">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <div class="col-span-2 mb-2">
                            <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Sector Stats (Optional)</h4>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Target Yield (%)</label>
                            <input type="text" name="stats[yield]" value="{{ old('stats.yield', $homeSector->stats['yield'] ?? '21.5%') }}" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 outline-none transition-all" placeholder="e.g. 21.5%">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Asset Class</label>
                            <input type="text" name="stats[asset_class]" value="{{ old('stats.asset_class', $homeSector->stats['asset_class'] ?? 'Institutional') }}" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 outline-none transition-all" placeholder="e.g. Institutional">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Transparency</label>
                            <input type="text" name="stats[transparency]" value="{{ old('stats.transparency', $homeSector->stats['transparency'] ?? '100%') }}" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 outline-none transition-all" placeholder="e.g. 100%">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Exit Window</label>
                            <input type="text" name="stats[exit_window]" value="{{ old('stats.exit_window', $homeSector->stats['exit_window'] ?? 'T+5 Yr') }}" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 outline-none transition-all" placeholder="e.g. T+5 Yr">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Target Link (or Route)</label>
                            <input type="text" name="link" value="{{ old('link', $homeSector->link) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. sectors.marriage-halls">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Display Order</label>
                            <input type="number" name="order" value="{{ old('order', $homeSector->order) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.home-sectors.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-200 transition-all">Cancel</a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all">Update Sector</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
