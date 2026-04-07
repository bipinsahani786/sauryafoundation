<x-dashboard.layout>
    <x-slot name="title">Edit Question | {{ $quiz->title }}</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all shadow-sm">
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Modify Question</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Refining assessment data for {{ $quiz->title }}</p>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-100">
            <form action="{{ route('teacher.questions.update', $question->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-indigo-100 uppercase tracking-widest ml-1 opacity-60">Question Statement</label>
                    <textarea name="question_text" rows="4" class="w-full bg-white/10 border border-white/20 rounded-[1.5rem] px-6 py-4 text-sm text-white placeholder:text-white/40 focus:bg-white/20 outline-none transition-all font-bold" required>{{ $question->question_text }}</textarea>
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-indigo-100 uppercase tracking-widest ml-1 opacity-60">Options Distribution</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10 focus-within:border-white/40 transition-all">
                            <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-[10px] font-black">A</span>
                            <input type="text" name="option_0" value="{{ $question->options[0] }}" class="flex-1 bg-transparent border-none text-xs text-white placeholder:text-white/30 outline-none font-bold" required>
                        </div>
                        <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10 focus-within:border-white/40 transition-all">
                            <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-[10px] font-black">B</span>
                            <input type="text" name="option_1" value="{{ $question->options[1] }}" class="flex-1 bg-transparent border-none text-xs text-white placeholder:text-white/30 outline-none font-bold" required>
                        </div>
                        <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10 focus-within:border-white/40 transition-all">
                            <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-[10px] font-black">C</span>
                            <input type="text" name="option_2" value="{{ $question->options[2] }}" class="flex-1 bg-transparent border-none text-xs text-white placeholder:text-white/30 outline-none font-bold" required>
                        </div>
                        <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10 focus-within:border-white/40 transition-all">
                            <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-[10px] font-black">D</span>
                            <input type="text" name="option_3" value="{{ $question->options[3] }}" class="flex-1 bg-transparent border-none text-xs text-white placeholder:text-white/30 outline-none font-bold" required>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-white/10">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-indigo-100 uppercase tracking-widest ml-1 opacity-60">Correct Answer Index</label>
                        <div class="relative">
                            <select name="correct_option" class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-xs text-white outline-none transition-all font-black appearance-none">
                                <option value="0" class="text-slate-900" {{ $question->correct_option == 0 ? 'selected' : '' }}>Index A (Option 0)</option>
                                <option value="1" class="text-slate-900" {{ $question->correct_option == 1 ? 'selected' : '' }}>Index B (Option 1)</option>
                                <option value="2" class="text-slate-900" {{ $question->correct_option == 2 ? 'selected' : '' }}>Index C (Option 2)</option>
                                <option value="3" class="text-slate-900" {{ $question->correct_option == 3 ? 'selected' : '' }}>Index D (Option 3)</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-indigo-100 uppercase tracking-widest ml-1 opacity-60">Question Weightage (Marks)</label>
                        <input type="number" name="marks" value="{{ $question->marks }}" min="1" class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-xs text-white outline-none transition-all font-black">
                    </div>
                </div>

                <div class="flex gap-4 pt-6">
                    <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="flex-1 text-center py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-indigo-100 hover:text-white transition-colors">Discard Changes</a>
                    <button type="submit" class="flex-[2] bg-white text-indigo-600 font-black py-5 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-2xl shadow-indigo-900/20">
                        Commit Update <i class="fas fa-check-circle ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
