<x-dashboard.layout>
    <x-slot name="title">Join Plan</x-slot>

    <div class="mb-6">
        <a href="{{ route('syndicate.plans') }}" class="text-indigo-600 text-[10px] font-bold uppercase flex items-center gap-1 hover:underline mb-1"><i class="fas fa-arrow-left"></i> Back to Plans</a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Join Investment Plan</h2>
        <p class="text-xs text-slate-400 italic font-medium">Plan: <strong>{{ $plan->title }}</strong></p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6 w-full">
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <form action="{{ route('syndicate.plans.submit', $plan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                                        
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Investment Amount (₹)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-900 font-bold text-lg">₹</span>
                            <input type="number" name="amount" min="{{ $plan->min_investment }}" step="1000" placeholder="Min: ₹{{ number_format($plan->min_investment) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-9 pr-4 py-3 text-slate-900 text-lg font-bold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Upload Receipt</label>
                        <div x-data="{ fileName: null }">
                            <input type="file" name="payment_screenshot" class="hidden" id="proof_upload" accept="image/*" @change="fileName = $event.target.files[0].name" required>
                            <label for="proof_upload" class="flex flex-col items-center justify-center w-full min-h-[10rem] bg-slate-50 border border-dashed border-slate-200 rounded-lg cursor-pointer hover:bg-white hover:border-indigo-400 transition-all shadow-sm group">
                                <template x-if="!fileName">
                                    <div class="text-center p-4">
                                        <i class="fas fa-upload text-indigo-500 mb-2"></i>
                                        <p class="text-slate-900 font-bold text-xs uppercase">Select receipt</p>
                                    </div>
                                </template>
                                <template x-if="fileName">
                                    <div class="text-center p-4">
                                        <i class="fas fa-file-image text-emerald-600 mb-2"></i>
                                        <p class="text-emerald-700 font-bold text-xs truncate max-w-[200px]" x-text="fileName"></p>
                                    </div>
                                </template>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-lg text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-md">
                        Join Plan Now
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-indigo-600 p-6 rounded-xl shadow-lg shadow-indigo-100 text-white">
                <h5 class="text-indigo-200 font-bold uppercase text-[9px] tracking-wider mb-4">Steps to Pay</h5>
                <ul class="space-y-4">
                    <li class="flex gap-3">
                        <span class="w-5 h-5 rounded bg-white/10 flex items-center justify-center text-[9px] font-bold shrink-0 border border-white/20">1</span>
                        <p class="text-[10px] text-indigo-50 font-medium opacity-90 leading-tight">Pay amount via Bank Transfer/UPI.</p>
                    </li>
                    <li class="flex gap-3">
                        <span class="w-5 h-5 rounded bg-white/10 flex items-center justify-center text-[9px] font-bold shrink-0 border border-white/20">2</span>
                        <p class="text-[10px] text-indigo-50 font-medium opacity-90 leading-tight">Take a screenshot of payment.</p>
                    </li>
                    <li class="flex gap-3">
                        <span class="w-5 h-5 rounded bg-white/10 flex items-center justify-center text-[9px] font-bold shrink-0 border border-white/20">3</span>
                        <p class="text-[10px] text-indigo-50 font-medium opacity-90 leading-tight">Upload and click Join Plan Now.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-dashboard.layout>
