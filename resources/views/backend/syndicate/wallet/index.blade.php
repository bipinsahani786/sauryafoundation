<x-dashboard.layout>
    <x-slot name="title">Syndicate Investor Wallet</x-slot>

    <div class="mb-10">
        <h1 class="text-3xl font-black text-slate-900 italic tracking-tighter uppercase mb-2">Investor Ledger</h1>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Track your syndicate dividends, capital movements, and transaction history.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12">
        <div class="bg-white p-12 rounded-[3.5rem] border border-slate-200 shadow-sm flex flex-col justify-center bg-gradient-to-br from-slate-900 to-indigo-950 text-white border-none shadow-slate-900/20 relative group overflow-hidden h-full min-h-[300px]">
            <div class="absolute -top-10 -right-10 opacity-10 group-hover:opacity-20 transition-all duration-700">
                <i class="fas fa-vault text-[16rem]"></i>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-60 mb-6 italic">Liquid Reserve Balance</p>
                <div class="flex items-baseline gap-2 mb-8">
                    <span class="text-3xl font-bold opacity-40 italic uppercase tracking-tighter">INR</span>
                    <h3 class="text-7xl font-black tracking-tighter">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</h3>
                </div>
                <div class="flex gap-4">
                    <div class="px-6 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-md text-[9px] font-black uppercase tracking-widest italic">
                        <i class="fas fa-circle-check text-emerald-400 mr-2"></i> Verified Investor
                    </div>
                    <a href="{{ route('syndicate.wallet.topup') }}" class="px-6 py-2 rounded-full bg-white text-indigo-950 text-[9px] font-black uppercase tracking-widest hover:bg-emerald-400 hover:text-white transition-all shadow-xl active:scale-95">
                        <i class="fas fa-plus-circle mr-2"></i> Add Capital
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] border border-slate-200 shadow-sm overflow-hidden p-12 flex flex-col justify-between h-full min-h-[300px]">
            <div>
                <h4 class="text-2xl font-black italic tracking-tighter uppercase mb-6 text-slate-900">Capital Overview</h4>
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center border border-indigo-100 text-indigo-600 text-lg shadow-sm">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Dividend Yields</p>
                            <p class="text-sm font-bold italic text-slate-600 leading-relaxed max-w-sm">Monthly profit distributions from your active syndicate plans are automatically credited here.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center border border-emerald-100 text-emerald-600 text-lg shadow-sm">
                            <i class="fas fa-money-bill-transfer"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Syndicate Transfers</p>
                            <p class="text-sm font-bold italic text-slate-600 leading-relaxed max-w-sm">Manage internal capital movements and reinvestment actions across the Shaurya network.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Investor Ledger -->
    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden mb-12">
        <div class="p-12 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[14px] italic mb-1">Syndicate Ledger</h3>
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest italic">Complete history of financial events and movements.</p>
            </div>
            <button class="bg-white border border-slate-200 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm hover:bg-slate-50 transition-colors">
                <i class="fas fa-download mr-2"></i> Export Ledger
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-12 py-6">Date Sequence</th>
                        <th class="px-12 py-6">Event Identity</th>
                        <th class="px-12 py-6">Event Context</th>
                        <th class="px-12 py-6 text-center">Vector</th>
                        <th class="px-12 py-6 text-right">Settlement Volume</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-50 transition-all group">
                            <td class="px-12 py-8 text-xs text-slate-500 font-bold tracking-tight">{{ $transaction->created_at->format('d M, Y - H:i') }}</td>
                            <td class="px-12 py-8">
                                <span class="bg-slate-50 group-hover:bg-indigo-50 px-4 py-2 rounded-xl text-slate-600 group-hover:text-indigo-600 font-black text-[10px] uppercase tracking-tighter transition-all shadow-sm shadow-slate-200">ID#{{ str_pad($transaction->id, 10, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-12 py-8 text-xs font-black text-slate-800 uppercase tracking-tight leading-relaxed max-w-md">{{ $transaction->description }}</td>
                            <td class="px-12 py-8 text-center">
                                <span class="font-black text-[9px] uppercase tracking-widest px-4 py-1 rounded-full border shadow-sm {{ $transaction->type === 'credit' ? 'text-emerald-600 bg-emerald-50 border-emerald-100' : 'text-red-500 bg-red-50 border-red-100' }}">
                                    {{ $transaction->type }}
                                </span>
                            </td>
                            <td class="px-12 py-8 text-right font-black text-slate-900 text-xl tracking-tighter">
                                {{ $transaction->type === 'credit' ? '+' : '-' }} ₹{{ number_format($transaction->amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-12 py-32 text-center text-slate-400 font-black italic uppercase tracking-[0.5em] text-[14px] opacity-30">The investor ledger is currently awaiting entries.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
            <div class="px-12 py-8 bg-slate-50 border-t border-slate-100 italic font-medium">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

    <!-- Recharge History -->
    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden mb-12 uppercase italic">
        <div class="p-12 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[14px] italic mb-1">Capital Infusion Log</h3>
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest italic">Manual Wallet Top-up Transmissions</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-12 py-6">Timestamp</th>
                        <th class="px-12 py-6">Reference (UTR)</th>
                        <th class="px-12 py-6">Value</th>
                        <th class="px-12 py-6">Status</th>
                        <th class="px-12 py-6">Admin Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-black">
                    @forelse($topupRequests as $request)
                        <tr class="hover:bg-slate-50 transition-all">
                            <td class="px-12 py-8 text-xs text-slate-400">{{ $request->created_at->format('M d, Y - H:i') }}</td>
                            <td class="px-12 py-8 text-xs text-slate-900 select-all">{{ $request->utr_number }}</td>
                            <td class="px-12 py-8 text-lg text-slate-900">₹{{ number_format($request->amount, 2) }}</td>
                            <td class="px-12 py-8">
                                <span class="px-6 py-2 rounded-full border shadow-sm text-[10px] uppercase tracking-widest
                                    {{ $request->status === 'approved' ? 'text-emerald-600 bg-emerald-50 border-emerald-100' : ($request->status === 'pending' ? 'text-amber-600 bg-amber-50 border-amber-100' : 'text-red-600 bg-red-50 border-red-100') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td class="px-12 py-8 text-[10px] text-slate-400 uppercase tracking-widest">{{ $request->admin_note ?? '---' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-12 py-32 text-center text-slate-400 font-black italic uppercase tracking-[0.5em] text-[14px] opacity-30">No capital infusion sequences detected.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-dashboard.layout>
