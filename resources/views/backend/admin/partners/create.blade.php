<x-dashboard.layout>
    <x-slot name="title">Add New Partner</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Add New Partner</h2>
        <p class="text-xs text-slate-400 font-medium italic">Upload a new partner or sponsor logo.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Partner Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-medium text-slate-900 placeholder:text-slate-400 placeholder:italic"
                        placeholder="e.g. MSJ College of Professional Education">
                    @error('name') <p class="mt-1 text-xs text-red-500 font-medium italic">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Partner Logo <span class="text-red-500">*</span></label>
                    <input type="file" name="image" required accept="image/*"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-medium text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-2 text-[10px] text-slate-400 font-medium italic">Recommended size: 300x150 pixels (PNG with transparent background preferred).</p>
                    @error('image') <p class="mt-1 text-xs text-red-500 font-medium italic">{{ $message }}</p> @enderror
                </div>

                <!-- Order -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-medium text-slate-900">
                    <p class="mt-2 text-[10px] text-slate-400 font-medium italic">Lower numbers appear first.</p>
                    @error('order') <p class="mt-1 text-xs text-red-500 font-medium italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.partners.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-200 transition-all uppercase tracking-widest">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase tracking-widest">
                    <i class="fas fa-save mr-1"></i> Save Partner
                </button>
            </div>
        </form>
    </div>
</x-dashboard.layout>
