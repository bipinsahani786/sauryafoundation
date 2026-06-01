<x-dashboard.layout>
    <x-slot name="title">Draft New Examination</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">Examination Settings</h2>
        <p class="text-xs text-slate-400 font-bold italic">Define the core parameters of your assessment.</p>
    </div>

    <form action="{{ route('admin.quizzes.store') }}" method="POST">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Examination Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Advanced Mathematics Quiz" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 placeholder:text-slate-300 focus:border-indigo-600 outline-none transition-all font-bold" required>
                    </div>
                    
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Description</label>
                        <textarea name="description" rows="4" placeholder="Brief overview of the exam..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 placeholder:text-slate-300 focus:border-indigo-600 outline-none transition-all font-bold">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pricing (INR)</label>
                            <input type="number" name="price" value="{{ old('price', 0) }}" step="0.01" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                            <p class="text-[8px] text-amber-600 font-bold italic mt-1">* Non-zero prices require Admin approval.</p>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Duration (Mins)</label>
                            <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 60) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Start Window</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">End Window</label>
                            <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Attempts Limit</label>
                        <input type="number" name="attempts_limit" value="{{ old('attempts_limit', 1) }}" min="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 text-xs text-slate-900 focus:border-indigo-600 outline-none transition-all font-bold" required>
                        <p class="text-[8px] text-slate-400 font-bold italic mt-1">* 0 means unlimited attempts.</p>
                    </div>
                </div>
            </div>

            <div x-data="{ isGlobal: {{ old('is_global') ? 'true' : 'false' }}, isContest: {{ old('is_contest') ? 'true' : 'false' }} }" class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Global Checkbox -->
                    <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-all group">
                        <input type="checkbox" name="is_global" value="1" x-model="isGlobal" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                        <div>
                            <span class="block text-xs font-black uppercase text-slate-900 leading-none">Global Exam (All Teachers)</span>
                            <span class="text-[9px] text-slate-500 font-bold italic">Available to all students (regardless of their teacher).</span>
                        </div>
                    </label>
                    
                    <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-emerald-600 transition-all group shadow-sm">
                        <input type="checkbox" name="is_practice_set" value="1" {{ old('is_practice_set') ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600">
                        <div>
                            <span class="block text-xs font-black uppercase text-slate-900 leading-none">Practice Set Mode</span>
                            <span class="text-[9px] text-slate-500 font-bold italic">Shuffled questions, grows daily, unlimited attempts.</span>
                        </div>
                    </label>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4 italic ml-1">Target Classes (Leave empty for ALL classes)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4">
                        @foreach($classes as $class)
                            <label class="relative flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-all group">
                                <input type="checkbox" name="class_ids[]" value="{{ $class->id }}" {{ in_array($class->id, old('class_ids', [])) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="text-[10px] font-black uppercase text-slate-600 group-hover:text-indigo-600 transition-colors">{{ $class->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Multi-Level Contest Configuration -->
                <div class="space-y-6 pt-6 border-t border-slate-200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-1 rounded-full bg-purple-600"></div>
                        <h3 class="text-[12px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Multi-Level Contest Logic</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-purple-600 transition-all group shadow-sm">
                            <input type="checkbox" name="is_contest" value="1" x-model="isContest" class="w-5 h-5 rounded border-slate-300 text-purple-600 focus:ring-purple-600">
                            <div>
                                <span class="block text-xs font-black uppercase text-slate-900 leading-none">Root Contest Parent</span>
                                <span class="text-[9px] text-slate-500 font-bold italic">This is Level 1. It manages subsequent promotions.</span>
                            </div>
                        </label>

                        <div x-show="!isContest" class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Parent Contest (Level 1)</label>
                            <select name="parent_id" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-900 focus:border-indigo-600 outline-none">
                                <option value="">Standalone (No Parent)</option>
                                @foreach($parentQuizzes as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title }} (ROOT)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Current Level Number</label>
                            <input type="number" name="level_number" min="1" max="10" placeholder="e.g. 1" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-900 focus:border-indigo-600 outline-none transition-all" value="{{ old('level_number', 1) }}">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Promotion % to Next Level</label>
                            <input type="number" name="promotion_percentage" min="0" max="100" placeholder="e.g. 50" value="{{ old('promotion_percentage') }}" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-900 focus:border-indigo-600 outline-none transition-all">
                            <span class="text-[8px] text-slate-400 font-bold italic">Set 0 for the final level (Level 4).</span>
                        </div>

                        <div x-show="isContest" class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Winners to Select</label>
                            <input type="number" name="winner_count" min="1" placeholder="e.g. 3" value="{{ old('winner_count') }}" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-900 focus:border-indigo-600 outline-none transition-all">
                        </div>
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
