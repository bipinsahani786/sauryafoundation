<x-dashboard.layout>
    <x-slot name="title">Admit New Student</x-slot>

    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Student Admission</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] italic">Enroll a new scholar into your professional coaching group.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10">
                <form action="{{ route('teacher.students.add') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Rahul Sharma" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Primary Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="rahul@example.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Student Grade (Class)</label>
                            <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic appearance-none" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Terminal Password</label>
                            <input type="password" name="password" placeholder="Min. 8 characters" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shadow-sm">
                                <i class="fas fa-user-plus text-lg"></i>
                            </div>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest italic">Instant Enrollment Mode Active</p>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-10 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-95 group">
                            Finalize Admission <i class="fas fa-chevron-right ml-2 text-[8px] group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-user-graduate text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Admission Protocol</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-indigo-100/90">
                    <p>1. New students are automatically assigned to your tracking terminal.</p>
                    <p>2. Credentials provided here will allow students to access the Test Portal instantly.</p>
                    <p>3. You can manage their learning path and verify their exam scores from the Academy section.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
