<x-dashboard.layout>
    <x-slot name="title">Add New Banner</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Create Banner</h2>
        <p class="text-xs text-slate-400 font-medium">Add a new dynamic banner for the landing page.</p>
    </div>

    <div class="max-w-5xl">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label id="label_banner_title" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Banner Title</label>
                            <input type="text" name="title" id="banner_title" value="{{ old('title') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all font-bold" placeholder="Enter title">
                        </div>
                        <div>
                            <label id="label_banner_type" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Banner Destination (Page)</label>
                            <select name="type" id="banner_type" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all font-bold uppercase tracking-widest">
                                <optgroup label="Core Pages">
                                    <option value="home" {{ old('type') == 'home' ? 'selected' : '' }}>Public Home Page</option>
                                    <option value="student" {{ old('type') == 'student' ? 'selected' : '' }}>Student Dashboard</option>
                                </optgroup>
                                <optgroup label="Sectors / Industries">
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector->slug }}" {{ old('type') == $sector->slug ? 'selected' : '' }}>{{ $sector->title }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Description / Subtitle</label>
                        <textarea name="description" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="Enter banner description">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Banner Image</label>
                            <input type="file" name="image" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Display Order</label>
                            <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Target Link (Optional)</label>
                            <input type="text" name="link" value="{{ old('link') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. #apply or route name">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Target Class (For Student Dashboard)</label>
                            <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all font-bold">
                                <option value="">All Classes (Global Banner)</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-all group w-fit">
                        <input type="checkbox" name="is_global" value="1" checked class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer">
                        <div>
                            <span class="block text-xs font-black uppercase text-slate-900 leading-none">Global Banner (All Teachers)</span>
                            <span class="text-[9px] text-slate-500 font-bold italic">Available to all students (regardless of their teacher).</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.banners.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-200 transition-all">Cancel</a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all">Create Banner</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
