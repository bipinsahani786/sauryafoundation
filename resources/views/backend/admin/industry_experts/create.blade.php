<x-dashboard.layout>
    <x-slot name="title">Add New Industry Expert</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.industry-experts.index') }}" class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-all uppercase tracking-widest flex items-center gap-2 mb-4">
            <i class="fas fa-arrow-left"></i> Back to Experts
        </a>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em]">Add New Expert profile</h2>
        <p class="text-xs text-slate-400 font-medium italic">Create a new professional profile to display on the experts section.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <form action="{{ route('admin.industry-experts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Expert Name</label>
                        <input type="text" name="name" placeholder="Vikram Rao" value="{{ old('name') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Designation</label>
                        <input type="text" name="designation" placeholder="Chief Investment Officer" value="{{ old('designation') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Professional Bio</label>
                    <textarea name="bio" rows="4" placeholder="Brief professional background..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic leading-relaxed" required>{{ old('bio') }}</textarea>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" placeholder="https://linkedin.com/in/..." value="{{ old('linkedin_url') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Profile Image</label>
                        <input type="file" name="image" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-400 text-[10px] font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 font-black"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mark as Active</span>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">Save Expert Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
