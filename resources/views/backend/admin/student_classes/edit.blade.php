<x-dashboard.layout>
    <x-slot name="title">Edit Academic Class: {{ $studentClass->name }}</x-slot>

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Update Class Designation</h2>
            <p class="text-xs text-slate-400 font-bold italic">Modify the parameters of this academic category.</p>
        </div>
        <a href="{{ route('admin.student-classes.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Back to Terminal
        </a>
    </div>

    <form action="{{ route('admin.student-classes.update', $studentClass->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10 max-w-2xl">
            <div class="space-y-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Class Designation Name</label>
                    <input type="text" name="name" value="{{ $studentClass->name }}" placeholder="e.g. Class 10, SSC, UPSC Level 1" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-xs font-bold text-slate-900 focus:border-indigo-600 outline-none placeholder:text-slate-300" required>
                    @error('name')
                        <p class="text-rose-500 text-[9px] font-bold mt-1 ml-1 italic">* {{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Lifecycle Status</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer hover:border-indigo-600 transition-all group">
                            <input type="radio" name="status" value="active" {{ $studentClass->status == 'active' ? 'checked' : '' }} class="w-4 h-4 rounded-full border-slate-300 text-indigo-600 focus:ring-indigo-600">
                            <div>
                                <span class="block text-[10px] font-black uppercase text-slate-900 leading-none">Active</span>
                                <span class="text-[8px] text-slate-400 font-bold italic">Visible to all students.</span>
                            </div>
                        </label>
                        <label class="relative flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer hover:border-rose-600 transition-all group">
                            <input type="radio" name="status" value="inactive" {{ $studentClass->status == 'inactive' ? 'checked' : '' }} class="w-4 h-4 rounded-full border-slate-300 text-rose-600 focus:ring-rose-600">
                            <div>
                                <span class="block text-[10px] font-black uppercase text-slate-900 leading-none">Inactive</span>
                                <span class="text-[8px] text-slate-400 font-bold italic">Hidden from portals.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-100">
                        Update & Save Changes <i class="fas fa-save ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-dashboard.layout>
