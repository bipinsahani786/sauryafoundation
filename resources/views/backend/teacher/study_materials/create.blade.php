<x-dashboard.layout>
    <x-slot name="title">Upload Student Material | Shaurya Narayan Foundation</x-slot>

    <div class="mb-10 flex items-center gap-6 italic">
        <a href="{{ route('teacher.study-materials.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Deploy Study Node</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] leading-loose">Upload academic documents for specific classes or all your students.</p>
        </div>
    </div>

    <div x-data="{ isGlobal: false }" class="grid lg:grid-cols-3 gap-10 italic">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-12">
                <form action="{{ route('teacher.study-materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Document Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. SEMESTER 1 - PHYSICS NOTES" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 uppercase italic" required>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Resource Category</label>
                            <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic" required>
                                <option value="note">TEXT NOTE / STUDY GUIDE</option>
                                <option value="pdf">PDF DOCUMENT</option>
                                <option value="book">E-BOOK</option>
                                <option value="other">OTHER TERMINAL RESOURCE</option>
                            </select>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Target Visibility</label>
                            <div class="flex items-center gap-4 bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" name="is_global" id="is_global" value="1" {{ old('is_global') ? 'checked' : '' }} x-model="isGlobal" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:text-indigo-600 transition-colors">Global for my students</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2" x-show="!isGlobal" x-transition>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Target Academic Class</label>
                        <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic">
                            <option value="">-- SELECT TARGET CLASS --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Resource Abstract</label>
                        <textarea name="description" rows="4" placeholder="Resource abstract or learning objectives..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic">{{ old('description') }}</textarea>
                    </div>

                    <div class="p-10 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 text-center hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group overflow-hidden relative">
                         <label class="cursor-pointer">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-slate-300 shadow-sm transition-transform group-hover:scale-110">
                                <i class="fas fa-file-export text-3xl"></i>
                            </div>
                            <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors uppercase">Attach Source Binary Node</span>
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-widest mt-2 block opacity-50 uppercase">PDF, DOC, DOCX, TXT, IMAGE (MAX 20MB)</span>
                            <input type="file" name="file" class="hidden" required onchange="const name = this.files[0] ? this.files[0].name.substring(0, 30) + '...' : 'SECURE NODE LOADED'; this.nextElementSibling.innerText = name">
                            <span class="text-[9px] font-black text-slate-900 uppercase tracking-widest mt-4 block"></span>
                         </label>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-12 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic group active:scale-95">
                            Commit Study Node <i class="fas fa-check-circle ml-2 text-[8px] group-hover:scale-125 transition-transform"></i>
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
                    <p>1. Your students can only see materials you explicitly assign to their class or mark as global.</p>
                    <p>2. Files are stored in a secure terminal vault, not publicly indexed.</p>
                    <p>3. Students can view/download resources through a secure, permissioned gateway.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
