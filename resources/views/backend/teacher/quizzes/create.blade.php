<x-dashboard.layout>
    <x-slot name="title">Draft New Examination</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">Examination Settings</h2>
        <p class="text-xs text-slate-400 font-bold italic">Define the core parameters of your assessment.</p>
    </div>

    <form action="{{ route('teacher.quizzes.store') }}" method="POST">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Examination Title</label>
                        <input type="text" name="title" placeholder="e.g. Advanced Mathematics Quiz" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 placeholder:text-slate-300 focus:border-indigo-600 outline-none transition-all font-bold" required>
                    </div>
                    
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Description</label>
                        <textarea name="description" rows="4" placeholder="Brief overview of the exam..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 placeholder:text-slate-300 focus:border-indigo-600 outline-none transition-all font-bold"></textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pricing (INR)</label>
                            <input type="number" name="price" value="0" step="0.01" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                            <p class="text-[8px] text-amber-600 font-bold italic mt-1">* Non-zero prices require Admin approval.</p>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Duration (Mins)</label>
                            <input type="number" name="duration_minutes" value="60" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Start Window</label>
                            <input type="datetime-local" name="start_time" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">End Window</label>
                            <input type="datetime-local" name="end_time" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Attempts Limit</label>
                        <input type="number" name="attempts_limit" value="1" min="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                        <p class="text-[8px] text-slate-400 font-bold italic mt-1">* 0 means unlimited attempts.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100">
                    Create & Add Questions <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>
        </div>
    </form>
</x-dashboard.layout>
