<x-dashboard.layout>
    <x-slot name="title">Student Wallet & Ledger</x-slot>

    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 italic tracking-tighter uppercase mb-2">My Wallet</h1>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Monitor your account balance and activity logs.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="md:col-span-1 bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm flex flex-col justify-center items-center bg-gradient-to-br from-indigo-600 to-indigo-800 text-white border-none shadow-indigo-100 relative group overflow-hidden">
            <div class="absolute -top-10 -right-10 opacity-10 group-hover:opacity-20 transition-all duration-700">
                <i class="fas fa-wallet text-[14rem]"></i>
            </div>
            <div class="text-center relative z-10 w-full">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-80 mb-4 italic">Available Balance</p>
                <h3 class="text-6xl font-black tracking-tighter mb-8">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</h3>
                <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full border border-white/20 bg-white/10 backdrop-blur-md text-[10px] font-black uppercase tracking-widest italic">
                    <i class="fas fa-shield-halved text-white/60"></i> Secure Syndicate Wallet
                </div>
            </div>
        </div>

        <div class="md:col-span-2 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10 flex flex-col justify-center">
            <h4 class="text-xl font-black italic tracking-tighter uppercase mb-4 text-slate-900 px-4">Financial Protocol</h4>
            <div class="grid grid-cols-2 gap-6 p-4">
                <div class="space-y-2">
                    <div class="flex items-center gap-3 text-emerald-600">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center border border-emerald-100 text-sm"><i class="fas fa-arrow-down"></i></div>
                        <p class="text-[10px] font-black uppercase tracking-widest">Rewards & Credits</p>
                    </div>
                    <p class="text-xs font-bold italic text-slate-500 leading-relaxed pl-11">Automatically credited for referral activities and successful academy benchmarks.</p>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-3 text-red-500">
                        <div class="w-8 h-8 rounded-xl bg-red-50 flex items-center justify-center border border-red-100 text-sm"><i class="fas fa-arrow-up"></i></div>
                        <p class="text-[10px] font-black uppercase tracking-widest">Protocol Debits</p>
                    </div>
                    <p class="text-xs font-bold italic text-slate-500 leading-relaxed pl-11">Applied for premium content access, course enrollments, and exclusive test resources.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ledger Index -->
    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden mb-10">
        <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[12px] italic">Activity History (Ledger)</h3>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">System Generated Updates</div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-10 py-5">Date Sequence</th>
                        <th class="px-10 py-5">Identifier</th>
                        <th class="px-10 py-5">Event Description</th>
                        <th class="px-10 py-5 text-center">Protocol Type</th>
                        <th class="px-10 py-5 text-right">Value Adjustment</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-50 transition-all translate-x-0 hover:translate-x-1 group">
                            <td class="px-10 py-7 text-xs text-slate-500 font-bold">{{ $transaction->created_at->format('M d, Y - H:i') }}</td>
                            <td class="px-10 py-7">
                                <span class="bg-slate-100 group-hover:bg-indigo-50 px-4 py-2 rounded-xl text-slate-600 group-hover:text-indigo-600 font-black text-[9px] uppercase tracking-tighter transition-all shadow-sm shadow-slate-200 underline decoration-slate-200 decoration-2 underline-offset-2">#{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-10 py-7 text-xs font-black text-slate-800 uppercase tracking-tight leading-relaxed">{{ $transaction->description }}</td>
                            <td class="px-10 py-7 text-center">
                                <span class="font-black text-[9px] uppercase tracking-widest px-3 py-1 rounded-full border {{ $transaction->type === 'credit' ? 'text-emerald-600 bg-emerald-50 border-emerald-100' : 'text-red-500 bg-red-50 border-red-100' }}">
                                    {{ $transaction->type }}
                                </span>
                            </td>
                            <td class="px-10 py-7 text-right font-black text-slate-900 text-lg tracking-tighter">
                                {{ $transaction->type === 'credit' ? '+' : '-' }} ₹{{ number_format($transaction->amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-10 py-24 text-center text-slate-400 font-black italic uppercase tracking-[0.4em] text-[12px] opacity-40">Your financial footprint is silent.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
            <div class="px-10 py-8 bg-slate-50 border-t border-slate-100 flex justify-center italic text-xs font-black uppercase tracking-widest">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

</x-dashboard.layout>
