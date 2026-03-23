<x-dashboard.layout>
    <x-slot name="title">Exam Terminal: {{ $quiz->title }}</x-slot>

    <div id="exam-terminal" class="fixed inset-0 bg-slate-900 z-[9999] overflow-y-auto selection:bg-brand-accent selection:text-white" x-data="examEngine()">
        <!-- Top Navigation Bar -->
        <div class="sticky top-0 bg-slate-900/80 backdrop-blur-md border-b border-white/5 px-8 py-4 flex justify-between items-center z-50">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-brand-accent rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand-accent/20">
                    <i class="fas fa-microchip text-xs"></i>
                </div>
                <div>
                    <h3 class="text-[10px] font-black text-white uppercase tracking-[0.2em] leading-none mb-1">{{ $quiz->title }}</h3>
                    <p class="text-[8px] text-brand-accent font-bold uppercase tracking-widest leading-none">Proctoring Active • Secure Session</p>
                </div>
            </div>

            <div class="flex items-center gap-8">
                <!-- Progress Bar -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="w-48 h-1 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-brand-accent transition-all duration-500" :style="'width: ' + progress + '%'"></div>
                    </div>
                    <span class="text-[9px] font-black text-white/40 tracking-widest uppercase" x-text="Math.round(progress) + '%'">0%</span>
                </div>

                <!-- Timer -->
                <div class="flex items-center gap-3 px-6 py-2 bg-red-500/10 border border-red-500/20 rounded-full">
                    <i class="fas fa-clock text-red-500 text-[10px] animate-pulse"></i>
                    <span class="text-xs font-black text-white tracking-widest" x-text="formatTime(timeLeft)">00:00</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto py-12 px-6">
            <form id="quiz-form" action="{{ route('student.exams.submit', $quiz->id) }}" method="POST">
                @csrf
                <div class="space-y-12">
                    @foreach($questions as $index => $question)
                        <div class="question-card transition-all duration-700" data-question-id="{{ $question->id }}">
                            <div class="flex gap-6 items-start mb-8">
                                <span class="w-10 h-10 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center font-black text-xs text-brand-accent shadow-inner">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <h4 class="text-xl font-bold text-white leading-relaxed tracking-tight italic">"{{ $question->question_text }}"</h4>
                                    <p class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mt-2 italic">Select the accurate index result</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-16">
                                @foreach($question->options as $o_index => $option)
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $o_index }}" class="sr-only peer" @change="updateProgress()">
                                        <div class="p-6 bg-white/5 border border-white/5 rounded-3xl transition-all duration-300 peer-checked:bg-brand-accent peer-checked:border-brand-accent peer-checked:shadow-[0_0_30px_rgba(16,185,129,0.2)] group-hover:bg-white/10 flex items-center gap-4">
                                            <span class="w-6 h-6 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-[9px] font-black text-white/30 peer-checked:bg-white/20 peer-checked:text-white transition-all">
                                                {{ chr(65 + $o_index) }}
                                            </span>
                                            <span class="text-xs font-bold text-white group-hover:translate-x-1 transition-transform">{{ $option }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-20 pt-10 border-t border-white/5 flex justify-center">
                    <button type="submit" class="bg-brand-accent text-white px-16 py-5 rounded-full font-black text-xs uppercase tracking-[0.3em] hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-brand-accent/20">
                        Terminate Session & Submit <i class="fas fa-upload ml-2"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Overlay Alerts -->
        <div x-show="cheatingAlert" x-transition class="fixed inset-0 bg-red-600/95 z-[10000] flex items-center justify-center p-8 backdrop-blur-xl">
            <div class="text-center max-w-lg">
                <i class="fas fa-exclamation-triangle text-white text-6xl mb-8 animate-bounce"></i>
                <h2 class="text-4xl font-black text-white mb-4 tracking-tighter">SECURITY BREACH DETECTED</h2>
                <p class="text-red-100 font-bold italic mb-8">Navigation outside the terminal or tab switching is strictly prohibited. Your actions have been logged to the coaching database.</p>
                <button @click="resumeExam()" class="bg-white text-red-600 px-12 py-4 rounded-full font-black text-xs uppercase tracking-widest shadow-2xl">
                    Return to Terminal
                </button>
            </div>
        </div>
    </div>

    <script>
        function examEngine() {
            return {
                timeLeft: {{ $remainingSeconds }},
                totalQuestions: {{ $questions->count() }},
                answeredCount: 0,
                progress: 0,
                cheatingAlert: false,
                cheatingCount: 0,

                init() {
                    // Fullscreen Request
                    this.requestFullscreen();
                    
                    // Prevention
                    document.addEventListener('contextmenu', e => e.preventDefault());
                    document.addEventListener('keydown', e => {
                        if (e.ctrlKey && (e.key === 'c' || e.key === 'v' || e.key === 'u')) e.preventDefault();
                    });

                    // Tab Switch Detection
                    window.addEventListener('blur', () => {
                        this.cheatingAlert = true;
                        this.cheatingCount++;
                    });

                    // Timer logic
                    setInterval(() => {
                        if (this.timeLeft > 0) {
                            this.timeLeft--;
                        } else {
                            document.getElementById('quiz-form').submit();
                        }
                    }, 1000);
                },

                formatTime(seconds) {
                    const h = Math.floor(seconds / 3600);
                    const m = Math.floor((seconds % 3600) / 60);
                    const s = seconds % 60;
                    return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                },

                updateProgress() {
                    const answered = document.querySelectorAll('input[type="radio"]:checked').length;
                    this.progress = (answered / this.totalQuestions) * 100;
                },

                requestFullscreen() {
                    const el = document.documentElement;
                    if (el.requestFullscreen) el.requestFullscreen();
                    else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
                },

                resumeExam() {
                    this.cheatingAlert = false;
                    this.requestFullscreen();
                    
                    // Report breach to server
                    fetch(`{{ route('student.exams.report-breach', $quiz->id) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            reason: 'Security Warning: Window Blur / Tab Switch detected'
                        })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            console.log('Breach logged. Session will be terminated on next violation.');
                        }
                    });
                }
            }
        }
    </script>

    <style>
        #exam-terminal {
            scrollbar-width: thin;
            scrollbar-color: #10B981 rgba(255,255,255,0.05);
        }
        #exam-terminal::-webkit-scrollbar {
            width: 4px;
        }
        #exam-terminal::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }
        #exam-terminal::-webkit-scrollbar-thumb {
            background: #10B981;
            border-radius: 10px;
        }
    </style>
</x-dashboard.layout>
