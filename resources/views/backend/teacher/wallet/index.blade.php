<x-dashboard.layout>
    <x-slot name="title">Teacher Wallet & Transactions</x-slot>

    <div class="mb-4">
        <h1 class="text-2xl font-bold italic tracking-tighter uppercase">Wallet Dashboard</h1>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Track your professional earnings and payout history.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex justify-between items-center bg-gradient-to-br from-indigo-600 to-indigo-800 text-white border-none shadow-indigo-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fas fa-wallet text-8xl"></i>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80 mb-2 italic">Professional Balance</p>
                <h3 class="text-5xl font-black tracking-tighter">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</h3>
            </div>
            <div class="flex flex-col gap-2 relative z-10">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-2xl backdrop-blur-sm border border-white/10 mb-2">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <a href="{{ route('teacher.wallet.topup') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-lg active:scale-95 text-center">
                    <i class="fas fa-plus-circle mr-1"></i> Add Money
                </a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-center gap-4" x-data="{ payoutModal: false }">
            <div class="flex justify-between items-center">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">KYC Status (Bank Verification)</p>
                <span class="px-3 py-1 
                    {{ auth()->user()->kyc_status === 'verified' ? 'bg-emerald-50 text-emerald-600' : (auth()->user()->kyc_status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }} 
                    rounded-full font-black text-[9px] uppercase tracking-wider border {{ auth()->user()->kyc_status === 'verified' ? 'border-emerald-100' : (auth()->user()->kyc_status === 'pending' ? 'border-amber-100' : 'border-red-100') }}">
                    {{ auth()->user()->kyc_status }}
                </span>
            </div>
            
            @if(auth()->user()->isKycVerified())
                @if(auth()->user()->wallet_balance > 0)
                    <button @click="payoutModal = true" class="w-full py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl hover:bg-indigo-600 transition-all active:scale-95">Request Withdrawal</button>
                @else
                    <button class="w-full py-4 bg-slate-100 text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] cursor-not-allowed italic" title="You need at least ₹1.00 balance to request payout">Insufficient Balance</button>
                @endif
            @else
                <a href="{{ route('teacher.kyc') }}" class="w-full py-4 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-sm hover:bg-indigo-600 hover:text-white text-center transition-all active:scale-95">
                    {{ auth()->user()->kyc_status === 'unsubmitted' ? 'Initialize Bank Verification' : 'Await KYC Verification' }}
                </a>
            @endif

            <!-- Payout Request Modal -->
            <div x-show="payoutModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                <div @click.away="payoutModal = false" class="bg-white rounded-[2.5rem] w-full max-w-md p-10 shadow-2xl border border-slate-200">
                    <div class="mb-8 flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 italic tracking-tighter uppercase">Request Payout</h3>
                            <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Maximum: ₹{{ number_format(auth()->user()->wallet_balance, 2) }}</p>
                        </div>
                        <button @click="payoutModal = false" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center"><i class="fas fa-times"></i></button>
                    </div>

                    <form action="{{ route('teacher.payout.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-3">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Withdrawal Amount (₹)</label>
                            <div class="relative group">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-black text-lg">₹</span>
                                <input type="number" name="amount" step="0.01" min="1" max="{{ max(1, auth()->user()->wallet_balance ?? 0) }}" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-12 py-5 text-xl font-black focus:border-indigo-600 focus:bg-white outline-none transition-all placeholder:text-slate-200" required>
                            </div>
                            <p class="text-[9px] text-slate-400 italic ml-4 font-black uppercase tracking-wider">* Funds will be settled to linked bank account.</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.3em] hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-95">
                                Authorize Request <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-10">
        <!-- Payout History -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[10px] italic">Settlement Log</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-standard">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-8 py-4">Submission Date</th>
                            <th class="px-8 py-4">Financial Value</th>
                            <th class="px-8 py-4">Protocol Status</th>
                            <th class="px-8 py-4">Administrative Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic">
                        @forelse($payoutRequests as $payout)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 text-xs font-bold text-slate-500">{{ $payout->created_at->format('M d, Y - H:i') }}</td>
                                <td class="px-8 py-6 font-black text-slate-900 text-sm">₹{{ number_format($payout->amount, 2) }}</td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 
                                        {{ $payout->status === 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($payout->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-red-50 text-red-600 border-red-100') }} 
                                        rounded-full font-black text-[8px] uppercase tracking-wider border">
                                        {{ $payout->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $payout->remarks ?? '---' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center text-slate-400 font-black italic uppercase tracking-[0.3em] text-[10px]">No active payout markers identified.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top-up Requests -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[10px] italic">Recharge Transmissions</h3>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Manual Wallet Credits</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-standard">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-8 py-4">Request Date</th>
                            <th class="px-8 py-4">UTR Number</th>
                            <th class="px-8 py-4">Amount</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4">Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic">
                        @forelse($topupRequests as $request)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6 text-xs text-slate-500 font-bold">{{ $request->created_at->format('M d, Y - H:i') }}</td>
                                <td class="px-8 py-6">
                                    <span class="bg-slate-100 px-3 py-1 rounded-lg text-slate-600 font-black text-[9px] uppercase tracking-tighter">{{ $request->utr_number }}</span>
                                </td>
                                <td class="px-8 py-6 font-black text-slate-900 text-sm">₹{{ number_format($request->amount, 2) }}</td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 
                                        {{ $request->status === 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($request->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-red-50 text-red-600 border-red-100') }} 
                                        rounded-full font-black text-[8px] uppercase tracking-widest border">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $request->admin_note ?? '---' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-slate-400 font-black italic uppercase tracking-[0.3em] text-[10px]">No wallet recharge sequences detected.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transactions History -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-black text-slate-900 uppercase tracking-[0.2em] text-[10px] italic">Ledger Entries</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-standard">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-8 py-4">Timestamp</th>
                            <th class="px-8 py-4 text-center">Reference ID</th>
                            <th class="px-8 py-4">Description</th>
                            <th class="px-8 py-4 text-center">Vector</th>
                            <th class="px-8 py-4">Volume</th>
                            <th class="px-8 py-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6 text-xs text-slate-500 font-bold">{{ $transaction->created_at->format('d/m/y H:i') }}</td>
                                <td class="px-8 py-6 text-center">
                                    <span class="bg-slate-100 px-3 py-1 rounded-lg text-slate-600 font-black text-[9px] uppercase tracking-tighter">#{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6 text-xs font-black text-slate-700 uppercase tracking-tight">{{ $transaction->description }}</td>
                                <td class="px-8 py-6 text-center">
                                    <span class="font-black text-[9px] uppercase tracking-widest {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $transaction->type }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 font-black text-slate-900 text-sm">₹{{ number_format($transaction->amount, 2) }}</td>
                                <td class="px-8 py-6 text-right">
                                    <span class="px-3 py-1 {{ $transaction->status === 'completed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }} rounded-full font-black text-[8px] uppercase tracking-widest border">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center text-slate-400 font-black italic uppercase tracking-[0.3em] text-[10px]">The ledger remains unwritten.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 italic font-medium">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
