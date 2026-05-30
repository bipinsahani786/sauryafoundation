<x-dashboard.layout>
    <x-slot name="title">Admit Card: {{ $admitCard->roll_no }}</x-slot>

    <!-- Action Buttons (Hidden on Print) -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 print:hidden">
        <div>
            <a href="{{ route('admin.admit-cards.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors block mb-2">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Admit Card Preview</h2>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.admit-cards.pdf', $admitCard) }}" class="px-4 py-2 bg-white text-indigo-600 border border-slate-200 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-50 transition-all">
                <i class="fas fa-file-pdf mr-1"></i> Download PDF
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
                <i class="fas fa-print mr-1"></i> Print
            </button>
        </div>
    </div>

    <!-- Printable Admit Card Area -->
    <div class="flex justify-center">
        <div id="printable-area" class="w-full max-w-3xl bg-white border-2 border-slate-900 p-8 shadow-sm">
            
            <!-- Header -->
            <div class="flex items-center justify-between border-b-2 border-slate-900 pb-6 mb-6">
                <div class="flex items-center gap-4">
                    @if(isset($siteSettings['site_logo']))
                        <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" class="h-16 object-contain">
                    @else
                        <div class="w-16 h-16 bg-slate-900 text-white flex items-center justify-center rounded-lg text-2xl">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-black uppercase tracking-tight text-slate-900">{{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</h1>
                        <p class="text-xs font-bold text-slate-600 uppercase tracking-widest">Official Examination Admit Card</p>
                    </div>
                </div>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-lg font-black uppercase tracking-widest text-indigo-700 bg-indigo-50 inline-block px-4 py-1 border border-indigo-200 rounded">{{ $admitCard->exam_name }}</h2>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                
                <!-- Left Details -->
                <div class="col-span-2 space-y-4">
                    <div class="flex">
                        <span class="w-40 text-xs font-bold text-slate-500 uppercase tracking-wider">Candidate Name</span>
                        <span class="text-sm font-black text-slate-900 uppercase">{{ $admitCard->user->name }}</span>
                    </div>
                    @if($admitCard->student_class)
                    <div class="flex">
                        <span class="w-40 text-xs font-bold text-slate-500 uppercase tracking-wider">Class</span>
                        <span class="text-sm font-bold text-slate-900 uppercase">{{ $admitCard->student_class }}</span>
                    </div>
                    @endif
                    <div class="flex">
                        <span class="w-40 text-xs font-bold text-slate-500 uppercase tracking-wider">Roll Number</span>
                        <span class="text-sm font-black text-slate-900 uppercase">{{ $admitCard->roll_no }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs font-bold text-slate-500 uppercase tracking-wider">Exam Date & Time</span>
                        <span class="text-sm font-black text-slate-900 uppercase">{{ $admitCard->exam_date->format('d F Y, h:i A') }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs font-bold text-slate-500 uppercase tracking-wider">Examination Center</span>
                        <span class="text-sm font-bold text-slate-900">{{ $admitCard->exam_center }}</span>
                    </div>
                </div>

                <!-- Right Photo Area -->
                <div class="col-span-1 flex flex-col items-center justify-start border-l-2 border-slate-100 pl-6">
                    <div class="w-28 h-32 border-2 border-slate-300 border-dashed rounded flex flex-col items-center justify-center bg-slate-50 mb-2 overflow-hidden">
                        @if($admitCard->user->profile_photo_path)
                            <img src="{{ asset('storage/'.$admitCard->user->profile_photo_path) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-3xl text-slate-300 mb-2"></i>
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest text-center px-2">Paste recent passport photo</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            @if($admitCard->instructions)
            <div class="border-t-2 border-slate-900 pt-6 mt-6">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-3"><i class="fas fa-info-circle mr-1"></i> Important Instructions</h3>
                <div class="text-xs font-medium text-slate-700 whitespace-pre-line leading-relaxed">
                    {{ $admitCard->instructions }}
                </div>
            </div>
            @endif

            <!-- Signatures -->
            <div class="mt-16 flex justify-between items-end px-8">
                <div class="text-center">
                    <div class="border-b border-slate-400 w-40 mb-2"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Candidate Signature</p>
                </div>
                <div class="text-center">
                    <div class="border-b border-slate-400 w-40 mb-2 flex justify-center pb-2">
                        <!-- Add digital signature image if available -->
                        <span class="font-black italic text-slate-300 text-xs uppercase">Authorized</span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Authorized Signatory</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            body { background-color: white !important; }
            .print\:hidden { display: none !important; }
            #printable-area { border: 2px solid #000 !important; box-shadow: none !important; max-width: 100% !important; margin: 0 !important; padding: 20px !important; }
        }
    </style>
</x-dashboard.layout>
