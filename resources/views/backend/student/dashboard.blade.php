<x-dashboard.layout>
    <x-slot name="title">Student Terminal</x-slot>

    <div class="mb-8">
        <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1 italic">Academic Dashboard</h2>
        <p class="text-lg md:text-xl text-slate-900 font-black italic uppercase tracking-widest">
            Welcome back, <span class="text-indigo-600">{{ ($studentUser ?? auth()->user())->name }}</span> 
            <span class="text-slate-300 mx-2">|</span> 
            <span class="text-emerald-600">{{ ($studentUser ?? auth()->user())->studentClass?->name ?? 'Global Scholar' }}</span>.
        </p>
    </div>

    @if($banners->count() > 0)
        <!-- Dynamic Banners Section -->
        <div class="mb-10 relative group overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm" id="student_banner_container" x-data="{ current: 0, total: {{ $banners->count() }} }" x-init="if(total > 1) { setInterval(() => { current = (current + 1) % total }, 5000) }">
            <div class="flex transition-transform duration-700 ease-in-out" id="banner_slider" :style="`transform: translateX(-${current * 100}%)`">
                @foreach($banners as $banner)
                    <div class="min-w-full relative aspect-[21/9] md:aspect-[25/7] flex items-center overflow-hidden flex-shrink-0">
                        <!-- Image Overlay Background -->
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" class="w-full h-full object-cover opacity-80" alt="{{ $banner->title }}" id="banner_img_{{ $banner->id }}">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/40 to-transparent"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="relative z-10 px-8 md:px-12 max-w-2xl">
                            <h3 class="text-2xl md:text-4xl font-black text-white mb-3 tracking-tighter leading-tight uppercase italic" id="banner_title_{{ $banner->id }}">
                                {{ $banner->title }}
                            </h3>
                            <p class="text-xs md:text-sm text-slate-200 font-medium mb-6 opacity-90 max-w-md italic leading-relaxed" id="banner_desc_{{ $banner->id }}">
                                {{ $banner->description }}
                            </p>
                            @if($banner->link)
                                <a href="{{ $banner->link }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all shadow-xl shadow-slate-900/20 active:scale-95" id="banner_link_{{ $banner->id }}">
                                    Explore Now <i class="fas fa-chevron-right text-[8px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($banners->count() > 1)
                <!-- Navigation Dots -->
                <div class="absolute bottom-6 right-10 flex gap-2 z-20">
                    @foreach($banners as $index => $banner)
                        <button class="h-2 rounded-full transition-all duration-300" :class="current === {{ $index }} ? 'bg-white w-6' : 'bg-white/30 w-2'" @click="current = {{ $index }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <a href="{{ route('student.exams') }}" class="block bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md hover:-translate-y-1 hover:border-indigo-200 transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 group-hover:scale-105 transition-transform origin-left">{{ $stats['total_exams'] }}</h3>
            <p class="text-[9px] text-slate-400 group-hover:text-indigo-400 font-black uppercase tracking-[0.2em] mt-1 italic transition-colors">Available Tests</p>
        </a>
        
        <a href="{{ route('student.exams') }}" class="block bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md hover:-translate-y-1 hover:border-indigo-200 transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 group-hover:scale-105 transition-transform origin-left">{{ $stats['attempted_exams'] }}</h3>
            <p class="text-[9px] text-slate-400 group-hover:text-indigo-400 font-black uppercase tracking-[0.2em] mt-1 italic transition-colors">Exams Taken</p>
        </a>

        <a href="{{ route('student.courses.index') }}" class="block bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md hover:-translate-y-1 hover:border-indigo-200 transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 group-hover:scale-105 transition-transform origin-left">{{ $stats['courses_enrolled'] }}</h3>
            <p class="text-[9px] text-slate-400 group-hover:text-indigo-400 font-black uppercase tracking-[0.2em] mt-1 italic transition-colors">Academy Courses</p>
        </a>

        <a href="{{ route('student.courses.index') }}" class="block bg-white p-8 rounded-3xl border border-emerald-500/20 shadow-sm group hover:shadow-md hover:-translate-y-1 hover:border-emerald-200 transition-all">
            <h3 class="text-3xl font-black text-emerald-600 group-hover:scale-105 transition-transform origin-left">{{ $stats['lessons_completed'] }}</h3>
            <p class="text-[9px] text-slate-400 group-hover:text-emerald-500 font-black uppercase tracking-[0.2em] mt-1 italic transition-colors">Lessons Finished</p>
        </a>
    </div>

    <!-- Resource Vault Folders -->
    <div class="mb-10">
        <h3 class="font-black text-slate-900 text-[10px] uppercase tracking-[0.2em] italic mb-4 ml-2">My Library Vault</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            
            <!-- Folder: Tests -->
            <a href="{{ route('student.exams') }}" class="block bg-amber-50 hover:bg-amber-100 p-6 rounded-[2rem] border border-amber-200 transition-all group shadow-sm">
                <i class="fas fa-folder text-4xl text-amber-500 mb-4 group-hover:scale-110 transition-transform origin-bottom-left drop-shadow-sm"></i>
                <h4 class="text-xs font-black text-amber-900 uppercase tracking-widest truncate">Test Series</h4>
                <p class="text-[9px] text-amber-700/70 font-bold uppercase tracking-widest mt-1">{{ $stats['total_exams'] }} Exams</p>
            </a>

            <!-- Folder: PDFs -->
            <a href="{{ route('student.study-materials.index', ['category' => 'pdf']) }}" class="block bg-rose-50 hover:bg-rose-100 p-6 rounded-[2rem] border border-rose-200 transition-all group shadow-sm">
                <i class="fas fa-folder text-4xl text-rose-500 mb-4 group-hover:scale-110 transition-transform origin-bottom-left drop-shadow-sm"></i>
                <h4 class="text-xs font-black text-rose-900 uppercase tracking-widest truncate">PDF Notes</h4>
                <p class="text-[9px] text-rose-700/70 font-bold uppercase tracking-widest mt-1">Readings</p>
            </a>

            <!-- Folder: Study Material -->
            <a href="{{ route('student.study-materials.index') }}" class="block bg-indigo-50 hover:bg-indigo-100 p-6 rounded-[2rem] border border-indigo-200 transition-all group shadow-sm">
                <i class="fas fa-folder text-4xl text-indigo-500 mb-4 group-hover:scale-110 transition-transform origin-bottom-left drop-shadow-sm"></i>
                <h4 class="text-xs font-black text-indigo-900 uppercase tracking-widest truncate">Study Material</h4>
                <p class="text-[9px] text-indigo-700/70 font-bold uppercase tracking-widest mt-1">All Resources</p>
            </a>

            <!-- Folder: Courses -->
            <a href="{{ route('student.courses.index') }}" class="block bg-emerald-50 hover:bg-emerald-100 p-6 rounded-[2rem] border border-emerald-200 transition-all group shadow-sm">
                <i class="fas fa-folder text-4xl text-emerald-500 mb-4 group-hover:scale-110 transition-transform origin-bottom-left drop-shadow-sm"></i>
                <h4 class="text-xs font-black text-emerald-900 uppercase tracking-widest truncate">Courses</h4>
                <p class="text-[9px] text-emerald-700/70 font-bold uppercase tracking-widest mt-1">{{ $stats['courses_enrolled'] }} Enrolled</p>
            </a>

            <!-- Folder: Video Lectures -->
            <a href="{{ route('student.study-materials.index', ['category' => 'video']) }}" class="block bg-sky-50 hover:bg-sky-100 p-6 rounded-[2rem] border border-sky-200 transition-all group shadow-sm">
                <i class="fas fa-folder text-4xl text-sky-500 mb-4 group-hover:scale-110 transition-transform origin-bottom-left drop-shadow-sm"></i>
                <h4 class="text-xs font-black text-sky-900 uppercase tracking-widest truncate">Video Classes</h4>
                <p class="text-[9px] text-sky-700/70 font-bold uppercase tracking-widest mt-1">Recordings</p>
            </a>
            
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Upcoming Exams -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-900 text-[10px] uppercase tracking-[0.2em] italic">Active Assessments</h3>
                <a href="{{ route('student.exams') }}" class="text-[10px] font-black text-indigo-600 hover:text-indigo-800 tracking-widest uppercase transition-colors">Portal Access <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($upcoming_exams as $exam)
                        <div class="bg-slate-50 rounded-[1.5rem] p-6 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 transition-all group flex flex-col justify-between shadow-sm hover:shadow-md">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-indigo-500 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all group-hover:scale-110">
                                    <i class="fas fa-file-signature text-xl"></i>
                                </div>
                                <span class="text-[9px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-100 px-3 py-1 rounded-lg">{{ $exam->duration_minutes }} MINS</span>
                            </div>
                            
                            <div class="mb-6">
                                <h4 class="font-black text-slate-900 text-base mb-1 group-hover:text-indigo-600 transition-colors">{{ $exam->title }}</h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest italic">
                                    Validity: {{ $exam->expires_at?->format('d M, H:i') ?? 'LIFETIME ACCESS' }}
                                </p>
                            </div>
                            
                            <a href="{{ route('student.exams.show', $exam->id) }}" class="w-full block text-center bg-indigo-600 hover:bg-indigo-800 text-white py-3.5 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-md hover:shadow-lg active:scale-95">
                                Enter Terminal
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full py-16 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 text-center">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-300 shadow-sm">
                                <i class="fas fa-folder-open text-2xl"></i>
                            </div>
                            <p class="text-slate-400 italic font-black text-[10px] uppercase tracking-[0.3em]">No active protocols identified.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Coach Card -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-user-ninja text-8xl"></i>
                </div>
                <div class="flex items-center gap-5 mb-8 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl font-black text-white border border-white/20 shadow-inner">
                        {{ substr(($studentUser ?? auth()->user())->teacher?->name ?? 'C', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-black text-sm tracking-widest uppercase mb-1">{{ ($studentUser ?? auth()->user())->teacher?->name ?? 'Corporate Coach' }}</h4>
                        <p class="text-[8px] text-indigo-100 font-black uppercase tracking-[0.2em] leading-none">Primary Instructor</p>
                    </div>
                </div>
                <div class="space-y-6 relative z-10">
                    <div class="p-5 bg-white/10 rounded-2xl border border-white/10 backdrop-blur-md">
                       <p class="text-[8px] text-indigo-100 font-black uppercase tracking-widest mb-2 italic">Direct Directive</p>
                       <p class="text-xs font-bold italic text-white/90 leading-relaxed">"Consistency is the catalyst of mastery. Terminate your pending assessments with precision."</p>
                    </div>
                </div>
            </div>

            <!-- Recent Study Materials Widget -->
            <div class="mt-10 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden italic">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-black text-slate-900 text-[10px] uppercase tracking-[0.2em]">Latest Resources</h3>
                    <a href="{{ route('student.study-materials.index') }}" class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">Vault <i class="fas fa-chevron-right ml-1"></i></a>
                </div>
                <div class="p-2">
                    @forelse($recent_materials as $material)
                        <a href="{{ route('student.study-materials.download', $material) }}" class="flex items-center gap-4 p-4 hover:bg-slate-50 rounded-2xl transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                <i class="fas {{ $material->category == 'pdf' ? 'fa-file-pdf' : 'fa-file-alt' }} text-xs"></i>
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="text-[11px] font-black text-slate-900 truncate uppercase tracking-tight">{{ $material->title }}</div>
                                <div class="text-[8px] text-slate-400 font-bold uppercase tracking-widest">{{ $material->created_at->diffForHumans() }}</div>
                            </div>
                            <i class="fas fa-download text-[8px] text-slate-300 group-hover:text-indigo-600 transition-colors"></i>
                        </a>
                    @empty
                        <div class="p-8 text-center text-[10px] font-black text-slate-300 uppercase tracking-widest italic">No notes uploaded.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
