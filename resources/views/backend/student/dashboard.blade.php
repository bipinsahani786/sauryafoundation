<x-dashboard.layout>
    <x-slot name="title">Student Terminal</x-slot>

    <div class="mb-8">
        <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1 italic">Academic Dashboard</h2>
        <p class="text-xs text-slate-900 font-extrabold italic uppercase tracking-widest">Welcome back, <span class="text-indigo-600">{{ auth()->user()->name }}</span>.</p>
    </div>

    @if($banners->count() > 0)
        <!-- Dynamic Banners Section -->
        <div class="mb-10 relative group overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm" id="student_banner_container">
            <div class="flex transition-transform duration-500 ease-out" id="banner_slider">
                @foreach($banners as $banner)
                    <div class="min-w-full relative aspect-[21/9] md:aspect-[25/7] flex items-center overflow-hidden">
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
                        <button class="w-2 h-2 rounded-full @if($loop->first) bg-white @else bg-white/30 @endif transition-all" id="banner_dot_{{ $index }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:scale-105 transition-transform origin-left">{{ $stats['total_exams'] }}</h3>
            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1 italic">Available Tests</p>
        </div>
        
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:scale-105 transition-transform origin-left">{{ $stats['attempted_exams'] }}</h3>
            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1 italic">Exams Taken</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
            <h3 class="text-3xl font-black text-slate-900 group-hover:scale-105 transition-transform origin-left">{{ $stats['courses_enrolled'] }}</h3>
            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1 italic">Academy Courses</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-emerald-500/20 shadow-sm group hover:shadow-md transition-all">
            <h3 class="text-3xl font-black text-emerald-600 group-hover:scale-105 transition-transform origin-left">{{ $stats['lessons_completed'] }}</h3>
            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1 italic">Lessons Finished</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Upcoming Exams -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-900 text-[10px] uppercase tracking-[0.2em] italic">Active Assessments</h3>
                <a href="{{ route('student.exams') }}" class="text-[10px] font-black text-indigo-600 hover:text-indigo-800 tracking-widest uppercase transition-colors">Portal Access <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 font-black uppercase tracking-[0.3em] text-[8px]">
                        <tr>
                            <th class="px-8 py-4">Examination Identity</th>
                            <th class="px-8 py-4 text-center">Protocol Duration</th>
                            <th class="px-8 py-4 text-right">Access</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic">
                        @forelse($upcoming_exams as $exam)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6">
                                    <div class="font-black text-slate-900 text-sm mb-1">{{ $exam->title }}</div>
                                    <div class="text-[8px] text-slate-400 font-black uppercase tracking-widest">Validity: {{ $exam->expires_at?->format('d M, H:i') ?? 'LIFETIME ACCESS' }}</div>
                                </td>
                                <td class="px-8 py-6 text-center font-black text-slate-500 text-xs tracking-widest">{{ $exam->duration_minutes }} MINUTES</td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('student.exams.show', $exam->id) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-indigo-100 transition-all active:scale-95">
                                        Enter Terminal
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-16 text-center text-slate-400 italic font-black text-[10px] uppercase tracking-[0.3em]">No active protocols identified.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                        {{ substr(auth()->user()->teacher->name ?? 'C', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-black text-sm tracking-widest uppercase mb-1">{{ auth()->user()->teacher->name ?? 'Corporate Coach' }}</h4>
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
        </div>
    </div>
</x-dashboard.layout>
