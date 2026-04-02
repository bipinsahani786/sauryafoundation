<x-dashboard.layout>
    <x-slot name="title">Wallet & Transactions</x-slot>

    <div class="mb-4">
        <h1 class="text-2xl font-bold">Wallet Dashboard</h1>
        <p class="text-gray-600">Track your earnings and payout history.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex justify-between items-center bg-gradient-to-br from-indigo-600 to-indigo-700 text-white border-none shadow-indigo-200">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60 mb-2">Current Balance</p>
                <h3 class="text-4xl font-black">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</h3>
            </div>
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-3xl">
                <i class="fas fa-wallet"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-center gap-4" x-data="{ payoutModal: false }">
            <div class="flex justify-between items-center">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">KYC Status</p>
                <span class="px-3 py-1 
                    {{ auth()->user()->kyc_status === 'verified' ? 'bg-emerald-50 text-emerald-600' : (auth()->user()->kyc_status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }} 
                    rounded-full font-bold text-[9px] uppercase tracking-wider">
                    {{ auth()->user()->kyc_status }}
                </span>
            </div>
            
            @if(auth()->user()->isKycVerified())
                @if(auth()->user()->wallet_balance > 0)
                    <button @click="payoutModal = true" class="w-full py-4 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg hover:bg-slate-800 transition-all">Request Payout</button>
                @else
                    <button class="w-full py-4 bg-slate-200 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] cursor-not-allowed" title="You need at least ₹1.00 balance to request payout">Request Payout</button>
                @endif
            @else
                <a href="{{ route('sales-agent.kyc') }}" class="w-full py-4 bg-amber-500 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg hover:bg-amber-600 text-center transition-all">
                    {{ auth()->user()->kyc_status === 'unsubmitted' ? 'Complete KYC to Payout' : 'KYC Verification Pending' }}
                </a>
            @endif

            <!-- Payout Request Modal -->
            <div x-show="payoutModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                <div @click.away="payoutModal = false" class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-slate-200">
                    <div class="mb-6 flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Request Payout</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Available: ₹{{ number_format(auth()->user()->wallet_balance, 2) }}</p>
                        </div>
                        <button @click="payoutModal = false" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
                    </div>

                    <form action="{{ route('sales-agent.payout.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Payout Amount</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">₹</span>
                                <input type="number" name="amount" step="0.01" min="1" max="{{ max(1, auth()->user()->wallet_balance ?? 0) }}" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-8 py-3 text-sm focus:border-indigo-600 outline-none transition-all font-bold" required>
                            </div>
                            <p class="text-[9px] text-slate-400 italic ml-3">* Minimum withdrawal is ₹1.00.</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                Confirm Request <i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 mb-8">
        <!-- Payout Requests History -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs">Payout History</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs table-standard">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Requested On</th>
                            <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Amount</th>
                            <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                            <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Admin Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic font-medium">
                        @forelse($payoutRequests as $payout)
                            <tr>
                                <td class="px-6 py-4">{{ $payout->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 font-bold text-slate-900">₹{{ number_format($payout->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 
                                        {{ $payout->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($payout->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }} 
                                        rounded-full font-bold text-[9px] uppercase tracking-wider">
                                        {{ $payout->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $payout->remarks ?? '---' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium italic">No payout requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs">Full Transaction History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Date</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Transaction ID</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Description</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Type</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Amount</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4"><span class="bg-slate-50 px-2 py-1 rounded-md text-slate-500">#TRX-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</span></td>
                            <td class="px-6 py-4">{{ $transaction->description }}</td>
                            <td class="px-6 py-4 uppercase font-bold {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-red-500' }}">
                                {{ $transaction->type }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">₹{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 {{ $transaction->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }} rounded-full font-bold text-[9px] uppercase tracking-wider">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium italic">Your transaction history is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 italic font-medium">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
