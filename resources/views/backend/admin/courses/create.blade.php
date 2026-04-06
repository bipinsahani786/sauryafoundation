<x-dashboard.layout>
    <x-slot name="title">Global Syllabus Deployment</x-slot>

    <div class="mb-10 flex items-center gap-6">
        <a href="{{ route('admin.courses.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Launch Global Plan</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] italic leading-loose">Draft a new curriculum for universal platform students.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-12">
                <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-8 italic">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Course Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Master Class: Advanced Logic" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic" required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Project Summary</label>
                        <textarea name="description" rows="4" placeholder="Detailed syllabus or learning objectives..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Price Terminal (₹)</label>
                            <input type="number" name="price" value="{{ old('price', 0) }}" min="0" step="0.01" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Class Target</label>
                            <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic" id="class_id_select">
                                <option value="" selected>None (Global Mode Only)</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-[8px] text-slate-400 font-bold ml-2">Ignored if "Universal Global" is active.</p>
                        </div>
                    </div>

                    <div class="p-6 bg-indigo-50 border border-indigo-100 rounded-3xl flex items-center justify-between">
                         <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black uppercase text-indigo-600 tracking-widest italic">Universal Global Access</h4>
                                <p class="text-[9px] text-slate-400 font-bold italic leading-none">Show this course to ALL students regardless of teacher or class.</p>
                            </div>
                         </div>
                         <div class="relative inline-flex items-center cursor-pointer" x-data="{ active: true }">
                             <input type="checkbox" name="is_global" value="1" class="sr-only peer" checked id="is_global_checkbox" @change="active = !active">
                             <div @click="$refs.check.click()" class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                         </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-12 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic group active:scale-95">
                            Deploy Global Course <i class="fas fa-rocket ml-2 text-[8px] group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden h-fit">
                <div class="absolute -top-10 -right-10 opacity-10">
                    <i class="fas fa-lock-open text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Admin Protocol</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-slate-400">
                    <p class="text-indigo-400">1. Global courses bypass traditional teacher-specific tracking.</p>
                    <p>2. Ideal for flagship assessments, common curriculum, or foundation programs.</p>
                    <p>3. Once published, you can still monitor all student progress from the Main Analytics dashboard.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
