<x-dashboard.layout>
    <x-slot name="title">Update Student Material | Shaurya Narayan Foundation</x-slot>

    <div class="mb-10 flex items-center gap-6 italic">
        <a href="{{ route('teacher.study-materials.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Update Study Node</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] leading-loose">Modify academic documents for specific classes or your student terminal set.</p>
        </div>
    </div>

    <div x-data="{ isGlobal: {{ $studyMaterial->is_global ? 'true' : 'false' }} }" class="grid lg:grid-cols-3 gap-10 italic">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-12">
                <form action="{{ route('teacher.study-materials.update', $studyMaterial) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Document Title</label>
                        <input type="text" name="title" value="{{ old('title', $studyMaterial->title) }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 uppercase italic" required>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Resource Category</label>
                            <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic" required>
                                <option value="note" {{ $studyMaterial->category == 'note' ? 'selected' : '' }}>TEXT NOTE / STUDY GUIDE</option>
                                <option value="pdf" {{ $studyMaterial->category == 'pdf' ? 'selected' : '' }}>PDF DOCUMENT</option>
                                <option value="book" {{ $studyMaterial->category == 'book' ? 'selected' : '' }}>E-BOOK</option>
                                <option value="other" {{ $studyMaterial->category == 'other' ? 'selected' : '' }}>OTHER TERMINAL RESOURCE</option>
                            </select>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Target Visibility</label>
                            <div class="flex items-center gap-4 bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" name="is_global" id="is_global" value="1" x-model="isGlobal" {{ old('is_global', $studyMaterial->is_global) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:text-indigo-600 transition-colors">Global for my students</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2" x-show="!isGlobal" x-transition>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Target Academic Class</label>
                        <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic">
                            <option value="">-- SELECT TARGET CLASS --</option>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}" {{ $studyMaterial->class_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Resource Abstract</label>
                        <textarea name="description" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic">{{ old('description', $studyMaterial->description) }}</textarea>
                    </div>

                    <div class="p-10 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 text-center hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group overflow-hidden relative">
                         <label class="cursor-pointer">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-slate-300 shadow-sm transition-transform group-hover:scale-110">
                                <i class="fas fa-sync text-3xl"></i>
                            </div>
                            <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors uppercase">Synchronize Secure Binary Node</span>
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-widest mt-2 block opacity-50 uppercase">Leave empty to keep current file: {{ basename($studyMaterial->file_path) }}</span>
                            <input type="file" name="file" class="hidden" onchange="const name = this.files[0] ? this.files[0].name.substring(0, 30) + '...' : 'REPLACEMENT LOADED'; this.nextElementSibling.innerText = name">
                            <span class="text-[9px] font-black text-slate-900 uppercase tracking-widest mt-4 block"></span>
                         </label>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-12 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic group active:scale-95">
                            Update Study Node <i class="fas fa-save ml-2 text-[8px] group-hover:scale-125 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden h-fit">
                <div class="absolute -bottom-10 -left-10 opacity-10">
                    <i class="fas fa-user-lock text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Teacher Compliance</h4>
                <div class="space-y-6 relative z-10 font-bold text-sm leading-relaxed text-indigo-100">
                    <p>1. Your student terminal set can only see materials you explicitly assign or mark as global.</p>
                    <p>2. Files are stored in a secure terminal vault, bypassing direct web indexers.</p>
                    <p>3. Replacing a node replaces it for all students instantly.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
