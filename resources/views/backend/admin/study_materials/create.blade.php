<x-dashboard.layout>
    <x-slot name="title">Upload Global Resource | Shaurya Narayan Foundation</x-slot>

    <div class="mb-10 flex items-center gap-6">
        <a href="{{ route('admin.study-materials.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Launch Global Note</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] italic leading-loose">Deploy a new academic resource for universal platform terminals.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-12 italic">
                <form action="{{ route('admin.study-materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Resource Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. CORE QUANTITATIVE VOL 1" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic uppercase" required>
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
                             <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Target Class (Optional)</label>
                             <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic">
                                 <option value="">-- ALL CLASSES (GLOBAL) --</option>
                                 @foreach($classes as $class)
                                     <option value="{{ $class->id }}" @if(old('class_id') == $class->id) selected @endif>{{ $class->name }}</option>
                                 @endforeach
                             </select>
                             <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest ml-4 mt-1">Leave empty to make it available to everyone</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Brief Documentation</label>
                        <textarea name="description" rows="4" placeholder="Resource abstract or learning objectives..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic">{{ old('description') }}</textarea>
                    </div>

                    <div class="p-10 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 text-center hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group overflow-hidden relative">
                         <label class="cursor-pointer">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-slate-300 shadow-sm transition-transform group-hover:scale-110">
                                <i class="fas fa-cloud-upload-alt text-3xl"></i>
                            </div>
                            <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors italic">Attach Secure Binary Node</span>
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-widest mt-2 block opacity-50">PDF, DOC, DOCX, TXT, IMAGE (MAX 20MB)</span>
                            <input type="file" name="file" class="hidden" required onchange="const name = this.files[0] ? this.files[0].name.substring(0, 30) + '...' : 'SECURE NODE LOADED'; this.nextElementSibling.innerText = name">
                            <span class="text-[9px] font-black text-slate-900 uppercase tracking-widest mt-4 block italic"></span>
                         </label>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-12 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic group active:scale-95">
                            Establish Global Resource <i class="fas fa-rocket ml-2 text-[8px] group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden h-fit italic">
                <div class="absolute -top-10 -right-10 opacity-10">
                    <i class="fas fa-shield-alt text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Security Protocol</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-slate-400">
                    <p class="text-indigo-400">1. All files are encrypted and stored in a private vault, bypassing public web access.</p>
                    <p>2. Global resources are visible to every student terminal on the platform.</p>
                    <p>3. Direct links are randomized to prevent unauthorized deep-linking or scraping.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
