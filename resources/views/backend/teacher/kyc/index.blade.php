<x-dashboard.layout>
    <x-slot name="title">Teacher Bank Verification (KYC)</x-slot>

    <div class="mb-10">
        <h1 class="text-3xl font-black text-slate-900 italic tracking-tighter uppercase mb-2">KYC Verification</h1>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Submit your official bank details for financial settlements.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10">
                <form action="{{ route('teacher.kyc.submit') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Bank Institution Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name', auth()->user()->bank_name) }}" placeholder="e.g. HDFC Bank" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all outline-none italic" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Official Account Number</label>
                            <input type="text" name="account_no" value="{{ old('account_no', auth()->user()->account_no) }}" placeholder="e.g. 501004523901" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all outline-none italic" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">IFSC / Branch Code</label>
                            <input type="text" name="ifsc_code" value="{{ old('ifsc_code', auth()->user()->ifsc_code) }}" placeholder="e.g. HDFC0001234" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all outline-none italic" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Account Holder Identity</label>
                            <input type="text" name="account_holder_name" value="{{ old('account_holder_name', auth()->user()->account_holder_name) }}" placeholder="Full name as per bank records" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all outline-none italic" required>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-500 shadow-sm animate-pulse">
                                <i class="fas fa-shield-alt text-lg"></i>
                            </div>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest italic">Verification status: <span class="text-indigo-600">{{ auth()->user()->kyc_status }}</span></p>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-10 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-95 group">
                            Submit Credentials <i class="fas fa-chevron-right ml-2 text-[8px] group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-university text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Compliance Protocol</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-indigo-100/90">
                    <p>1. Ensure all details exactly match your bank passbook/records.</p>
                    <p>2. Verification typically requires 24-48 business hours by the administrative branch.</p>
                    <p>3. Once verified, payout requests will be enabled on your dashboard instantly.</p>
                    <p>4. Secure channel: All banking data is encrypted and handled under strict compliance protocol.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
