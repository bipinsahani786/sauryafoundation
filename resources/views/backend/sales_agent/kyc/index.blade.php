<x-dashboard.layout>
    <x-slot name="title">Bank Account Verification (KYC)</x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">KYC Verification</h2>
        <p class="text-sm text-slate-400 font-medium italic">Complete your bank details to enable payout requests.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
                @if($user->kyc_status === 'verified')
                    <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 text-emerald-700">
                        <i class="fas fa-check-circle text-3xl"></i>
                        <div>
                            <h4 class="font-black uppercase tracking-widest text-xs">KYC Verified</h4>
                            <p class="text-xs font-medium italic">Your bank account is verified. You can now request payouts.</p>
                        </div>
                    </div>
                @elseif($user->kyc_status === 'pending')
                    <div class="mb-8 p-6 bg-amber-50 border border-amber-100 rounded-2xl flex items-center gap-4 text-amber-700 font-bold">
                        <i class="fas fa-clock text-3xl"></i>
                        <div>
                            <h4 class="font-black uppercase tracking-widest text-xs">Verification Pending</h4>
                            <p class="text-xs font-medium italic italic">An admin is reviewing your details. This usually takes 24-48 hours.</p>
                        </div>
                    </div>
                @elseif($user->kyc_status === 'rejected')
                    <div class="mb-8 p-6 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-4 text-red-700">
                        <i class="fas fa-exclamation-triangle text-3xl"></i>
                        <div>
                            <h4 class="font-black uppercase tracking-widest text-xs">KYC Rejected</h4>
                            <p class="text-xs font-medium italic">{{ $user->kyc_notes ?? 'Please check your details and resubmit.' }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('sales-agent.kyc.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-3">Account Holder Name</label>
                            <input type="text" name="account_holder_name" value="{{ $user->account_holder_name }}" placeholder="As per bank records" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm focus:border-indigo-600 outline-none transition-all" {{ $user->kyc_status === 'verified' || $user->kyc_status === 'pending' ? 'disabled' : 'required' }}>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-3">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ $user->bank_name }}" placeholder="e.g. HDFC Bank" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm focus:border-indigo-600 outline-none transition-all" {{ $user->kyc_status === 'verified' || $user->kyc_status === 'pending' ? 'disabled' : 'required' }}>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-3">Account Number</label>
                            <input type="text" name="account_no" value="{{ $user->account_no }}" placeholder="Enter full account number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm focus:border-indigo-600 outline-none transition-all" {{ $user->kyc_status === 'verified' || $user->kyc_status === 'pending' ? 'disabled' : 'required' }}>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-3">IFSC Code</label>
                            <input type="text" name="ifsc_code" value="{{ $user->ifsc_code }}" placeholder="e.g. HDFC0001234" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm focus:border-indigo-600 outline-none transition-all uppercase" {{ $user->kyc_status === 'verified' || $user->kyc_status === 'pending' ? 'disabled' : 'required' }}>
                        </div>
                    </div>

                    @if($user->kyc_status === 'unsubmitted' || $user->kyc_status === 'rejected')
                        <div class="pt-4">
                            <button type="submit" class="w-full md:w-auto bg-slate-900 text-white font-black px-12 py-4 rounded-2xl text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-indigo-600 hover:-translate-y-1 transition-all">
                                Submit for Verification <i class="fas fa-chevron-right ml-2 opacity-50"></i>
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-indigo-600 p-8 rounded-3xl text-white shadow-xl shadow-indigo-100">
                <i class="fas fa-shield-check text-4xl mb-4 opacity-50"></i>
                <h3 class="text-xl font-black uppercase tracking-tighter mb-2">Why Verification?</h3>
                <p class="text-xs font-medium text-indigo-100 leading-relaxed italic">To ensure secure fund transfers and comply with financial regulations, we require a one-time verification of your bank account details before processing any payout requests.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 text-xl font-black">?</div>
                <div>
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Need help?</h4>
                    <a href="#" class="text-xs text-indigo-600 font-bold hover:underline">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
