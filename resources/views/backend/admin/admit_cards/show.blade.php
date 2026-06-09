<x-dashboard.layout>
    <x-slot name="title">Admit Card: {{ $admitCard->roll_no }}</x-slot>

    <!-- Action Buttons -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.admit-cards.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors block mb-2">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Admit Card Preview</h2>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.admit-cards.pdf', $admitCard) }}" target="_blank" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
                <i class="fas fa-external-link-alt mr-1"></i> Open Full Page
            </a>
        </div>
    </div>

    <!-- Iframe Preview Area -->
    <div class="flex justify-center w-full pb-10">
        <div class="w-full max-w-[1150px] bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden relative" style="height: 900px;">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-50 z-0 text-slate-400 gap-3">
                <i class="fas fa-spinner fa-spin text-3xl"></i>
                <span class="text-xs font-bold tracking-widest uppercase">Loading Preview...</span>
            </div>
            <iframe src="{{ route('admin.admit-cards.pdf', $admitCard) }}" class="w-full h-full border-0 relative z-10" onload="this.previousElementSibling.style.display='none'"></iframe>
        </div>
    </div>
</x-dashboard.layout>
