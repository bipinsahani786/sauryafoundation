<x-dashboard.layout>
    <x-slot name="title">Create Course | Shaurya Syndicate</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Launch New Course</h1>
                <p class="text-slate-500 text-sm font-medium">Define the core identity of your educational program.</p>
            </div>

            <form action="{{ route('teacher.courses.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Course Title</label>
                    <input type="text" name="title" placeholder="e.g., Advanced Mathematics 2024" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Description</label>
                    <textarea name="description" rows="4" placeholder="Briefly describe what students will learn..." class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-medium outline-none focus:border-indigo-600 transition-all"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Enrollment Price (₹)</label>
                        <input type="number" name="price" value="0" min="0" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all" required>
                        <p class="text-[10px] text-slate-400 font-medium">Set to 0 for free access.</p>
                    </div>
                </div>

                <div class="pt-4 flex items-center border-t border-slate-50 mt-8 gap-4">
                    <a href="{{ route('teacher.courses.index') }}" class="flex-1 text-center py-4 text-slate-500 font-bold text-sm hover:text-slate-700 transition-colors">Discard</a>
                    <button type="submit" class="flex-[2] bg-indigo-600 text-white font-black py-4 rounded-2xl text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Create & Continue <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
