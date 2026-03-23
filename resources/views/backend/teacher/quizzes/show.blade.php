<x-dashboard.layout>
    <x-slot name="title">Question Terminal</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $quiz->title }}</h2>
            <div class="flex gap-4 mt-1">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest flex items-center gap-1">
                    <i class="fas fa-clock text-indigo-500"></i> {{ $quiz->duration_minutes }} Mins
                </p>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest flex items-center gap-1">
                    <i class="fas fa-coins text-emerald-500"></i> ₹{{ number_format($quiz->price) }}
                </p>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest flex items-center gap-1">
                    <i class="fas fa-list-ol text-purple-500"></i> {{ $questions->count() }} Questions
                </p>
            </div>
        </div>
        <div class="bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
           <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400">Security Check:</span>
           <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
               {{ $quiz->status }}
           </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add Question Form -->
        <div class="lg:col-span-1">
            <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-xl shadow-indigo-100 sticky top-8">
                <h3 class="font-black text-lg mb-1 tracking-tighter">Draft Question</h3>
                <p class="text-[10px] text-indigo-100 mb-6 font-medium italic opacity-80 uppercase tracking-widest leading-relaxed">Insert multiple-choice data below.</p>
                
                <form action="{{ route('teacher.quizzes.add-question', $quiz->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[8px] font-black text-white/60 uppercase tracking-widest ml-1">Question Body</label>
                        <textarea name="question_text" rows="3" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder:text-white/40 focus:bg-white/20 outline-none transition-all font-bold" required></textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[8px] font-black text-white/60 uppercase tracking-widest ml-1">Options Hub</label>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-black w-4">A.</span>
                                <input type="text" name="option_0" placeholder="Alpha Option" class="flex-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-[10px] text-white placeholder:text-white/40 outline-none transition-all" required>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-black w-4">B.</span>
                                <input type="text" name="option_1" placeholder="Beta Option" class="flex-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-[10px] text-white placeholder:text-white/40 outline-none transition-all" required>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-black w-4">C.</span>
                                <input type="text" name="option_2" placeholder="Gamma Option" class="flex-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-[10px] text-white placeholder:text-white/40 outline-none transition-all" required>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-black w-4">D.</span>
                                <input type="text" name="option_3" placeholder="Delta Option" class="flex-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-[10px] text-white placeholder:text-white/40 outline-none transition-all" required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[8px] font-black text-white/60 uppercase tracking-widest ml-1">Key Index</label>
                            <select name="correct_option" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white outline-none transition-all font-bold appearance-none">
                                <option value="0" class="text-slate-900">Index A</option>
                                <option value="1" class="text-slate-900">Index B</option>
                                <option value="2" class="text-slate-900">Index C</option>
                                <option value="3" class="text-slate-900">Index D</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[8px] font-black text-white/60 uppercase tracking-widest ml-1">Marks Value</label>
                            <input type="number" name="marks" value="1" min="1" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white outline-none transition-all font-bold">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-white text-indigo-600 font-black py-4 rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-xl mt-2">
                        Deploy Question <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Questions List -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="font-black text-slate-900 text-sm uppercase tracking-tight mb-4 flex items-center gap-2">
                Deployed Database 
                <span class="text-[10px] text-slate-400 font-bold tracking-[0.2em]">Total {{ $questions->count() }}</span>
            </h3>
            
            @forelse($questions as $index => $question)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm group">
                    <div class="flex justify-between items-start mb-4">
                        <span class="w-6 h-6 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-black text-[10px]">{{ $index + 1 }}</span>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
                            <button class="text-slate-400 hover:text-red-600 transition-colors"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-slate-900 mb-6 italic">"{{ $question->question_text }}"</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($question->options as $o_index => $option)
                            <div class="px-4 py-3 rounded-xl border flex items-center justify-between text-[10px] font-bold 
                                {{ $question->correct_option == $o_index ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-slate-50 border-slate-100 text-slate-500' }}">
                                <span>{{ chr(65 + $o_index) }}. {{ $option }}</span>
                                @if($question->correct_option == $o_index)
                                    <i class="fas fa-check-circle text-emerald-500"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-16 text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl border border-slate-200 flex items-center justify-center text-slate-300 mx-auto mb-4 animate-pulse">
                        <i class="fas fa-layer-group text-2xl"></i>
                    </div>
                    <h4 class="text-slate-900 font-black text-sm uppercase tracking-tighter">Database Empty</h4>
                    <p class="text-xs text-slate-400 italic">No questions have been deployed to this exam terminal.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard.layout>
