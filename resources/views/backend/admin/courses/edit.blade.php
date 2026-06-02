<x-dashboard.layout>
    <x-slot name="title">Edit Course - {{ $course->title }}</x-slot>

    <div class="mb-10 flex items-center gap-6">
        <a href="{{ route('admin.courses.show', $course) }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Update Course</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] italic leading-loose">Modify the curriculum heading and configuration.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-12">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-8 italic">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Course Title (Heading Name)</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" placeholder="e.g. Master Class: Advanced Logic" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic" required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Project Summary</label>
                        <textarea name="description" rows="4" placeholder="Detailed syllabus or learning objectives..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-300 italic">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Price Terminal (₹)</label>
                            <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" step="0.01" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Class Target</label>
                            <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all appearance-none italic" id="class_id_select" required>
                                <option value="" disabled>-- Select a Class --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id', $course->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-12 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic group active:scale-95">
                            Save Changes <i class="fas fa-check ml-2 text-[8px] group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden h-fit">
                <div class="absolute -top-10 -right-10 opacity-10">
                    <i class="fas fa-edit text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Edit Mode</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-slate-400">
                    <p class="text-indigo-400">1. Modify the heading name (Course Title) which appears in the main dashboard.</p>
                    <p>2. Keep descriptions clear and concise.</p>
                    <p>3. Changing the class target will not delete the existing subjects and topics, but make sure it aligns with the target audience.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
