<x-dashboard.layout>
    <x-slot name="title">My Admit Cards</x-slot>

    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">My Admit Cards</h2>
        <p class="text-[10px] text-slate-400 font-medium italic">Download and print admit cards for your upcoming examinations.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($admitCards as $card)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col relative group">
                <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500"></div>
                <div class="p-6 flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-id-card text-lg"></i>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-1 bg-slate-100 text-slate-600 rounded uppercase tracking-widest">
                            Roll No: {{ $card->roll_no }}
                        </span>
                    </div>
                    
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight mb-2">{{ $card->exam_name }}</h3>
                    
                    <div class="space-y-3 mt-4 text-xs font-medium text-slate-600">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-calendar-alt mt-0.5 text-slate-400 w-4"></i>
                            <span>{{ $card->exam_date->format('d M, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-0.5 text-slate-400 w-4"></i>
                            <span>{{ $card->exam_center }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between items-center group-hover:bg-indigo-50 transition-colors">
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Action</span>
                    <a href="{{ route('student.admit-cards.pdf', $card) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all flex items-center gap-2">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 bg-white rounded-xl border border-slate-200 border-dashed text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-id-card-alt text-2xl"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">No Admit Cards Found</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto">You don't have any admit cards assigned to you at the moment. When the admin generates an admit card for your class, it will appear here automatically.</p>
            </div>
        @endforelse
    </div>
</x-dashboard.layout>
