<x-dashboard.layout>
    <x-slot name="title">Study Materials Vault | Shaurya Narayan Foundation</x-slot>

    <div class="space-y-10 italic">
        <div class="mb-2">
            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                <i class="fas fa-arrow-left"></i> Return to Dashboard
            </a>
        </div>
        <!-- Header -->
        <div class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-12 text-white shadow-2xl border border-slate-800 group">
             <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-600/20 blur-[100px] rounded-full group-hover:bg-indigo-600/30 transition-all duration-1000"></div>
             <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-purple-600/10 blur-[100px] rounded-full group-hover:bg-purple-600/20 transition-all duration-1000"></div>
             
             <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6 pointer-events-none">
                <div>
                    <h1 class="text-4xl font-black tracking-tighter uppercase mb-2 group-hover:scale-105 transition-transform origin-left duration-500">Knowledge Terminal</h1>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-[0.4em] italic opacity-80 leading-relaxed">Secure access to academic resources, study notes, and research nodes.</p>
                </div>
                <div class="flex items-center gap-4 group/stats pointer-events-auto">
                    <div class="bg-white/5 border border-white/10 rounded-2xl px-6 py-4 backdrop-blur-xl group-hover/stats:border-indigo-500/30 transition-all">
                        <span class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-1">Available Resources</span>
                        <div class="text-2xl font-black tracking-tight text-white italic group-hover/stats:scale-110 transition-transform origin-left">{{ $materials->total() }}</div>
                    </div>
                </div>
             </div>
        </div>

        <!-- Materials Grid -->
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-6">
            @forelse($materials as $material)
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all p-6 group relative overflow-hidden flex flex-col h-full border-b-4 border-b-indigo-600">
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-110 group-hover:bg-indigo-50 transition-all"></div>
                
                <div class="relative z-10 space-y-4 flex-grow">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-[1rem] bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all shadow-sm">
                            <i class="fas {{ $material->category == 'pdf' ? 'fa-file-pdf' : 'fa-file-alt' }} text-lg"></i>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 italic bg-slate-50 px-3 py-1.5 rounded-full border border-slate-100 group-hover:bg-white group-hover:text-indigo-600 group-hover:border-indigo-100 transition-all">
                            {{ $material->category }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase leading-tight mb-2 group-hover:text-indigo-600 transition-colors italic">{{ $material->title }}</h3>
                        <p class="text-xs text-slate-500 font-bold leading-relaxed line-clamp-2 italic">
                            {{ $material->description ?: 'No additional documentation provided for this resource terminal.' }}
                        </p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-slate-50">
                        <div class="flex items-center justify-between text-[9px] font-black uppercase tracking-widest italic leading-relaxed text-slate-400">
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-user-circle text-indigo-100 group-hover:text-indigo-600 transition-colors"></i>
                                {{ $material->teacher_id ? 'T: ' . $material->teacher->name : 'CENTRAL BASE' }}
                            </span>
                            <span>{{ $material->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 pt-5 mt-auto">
                    <a href="{{ route('student.study-materials.download', $material) }}" class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white font-black text-[9px] uppercase tracking-[0.2em] py-3.5 rounded-xl transition-all shadow-md shadow-slate-900/10 hover:shadow-indigo-600/20 italic group/btn active:scale-95">
                        Initialize Secure Download <i class="fas fa-download text-[7px] group-hover/btn:translate-y-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200 text-center italic">
                <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-slate-200 shadow-sm">
                    <i class="fas fa-file-invoice text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase italic mb-2">Vault Unpopulated</h3>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] leading-relaxed">No study resources found for your terminal at this moment.</p>
            </div>
            @endforelse
        </div>

        @if(isset($lmsFiles) && $lmsFiles->count() > 0)
        <div class="mt-16">
            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase italic mb-6">Academy (LMS) Resources</h2>
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-6">
                @foreach($lmsFiles as $lmsMaterial)
                <div class="bg-indigo-50 rounded-[2rem] border border-indigo-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all p-6 group relative overflow-hidden flex flex-col h-full border-b-4 border-b-indigo-600">
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-white rounded-full group-hover:scale-110 transition-all opacity-50"></div>
                    
                    <div class="relative z-10 space-y-4 flex-grow">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-[1rem] bg-white border border-indigo-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all shadow-sm">
                                <i class="fas {{ $lmsMaterial->type == 'video' ? 'fa-play-circle' : 'fa-file-pdf' }} text-lg"></i>
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-indigo-600 italic bg-white px-3 py-1.5 rounded-full border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all">
                                ACADEMY LMS
                            </span>
                        </div>

                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase leading-tight mb-2 group-hover:text-indigo-600 transition-colors italic">{{ $lmsMaterial->title }}</h3>
                            <p class="text-xs text-slate-500 font-bold leading-relaxed line-clamp-2 italic">
                                Course: {{ $lmsMaterial->topic->subject->course->title ?? 'Unknown' }}<br>
                                Topic: {{ $lmsMaterial->topic->title ?? 'Unknown' }}
                            </p>
                        </div>
                    </div>

                    <div class="relative z-10 pt-5 mt-auto">
                        @if($lmsMaterial->type == 'video')
                            <a href="{{ route('student.courses.viewer', $lmsMaterial->topic->subject->course_id) }}?content={{ $lmsMaterial->id }}" class="w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-[9px] uppercase tracking-[0.2em] py-3.5 rounded-xl transition-all shadow-md shadow-indigo-600/20 italic group/btn active:scale-95">
                                Watch Video <i class="fas fa-play text-[7px] group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $lmsMaterial->attachment_path) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-[9px] uppercase tracking-[0.2em] py-3.5 rounded-xl transition-all shadow-md shadow-indigo-600/20 italic group/btn active:scale-95">
                                Download Document <i class="fas fa-download text-[7px] group-hover/btn:translate-y-1 transition-transform"></i>
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($materials->hasPages())
        <div class="mt-12 bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm italic">
            {{ $materials->links() }}
        </div>
        @endif
    </div>
</x-dashboard.layout>
