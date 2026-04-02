<x-dashboard.layout>
    <x-slot name="title">Payouts & KYC Management</x-slot>

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Payouts & KYC</h2>
        <p class="text-sm text-slate-400 font-medium italic">Manage bank verification and payout requests from sales agents.</p>
    </div>

    <div class="space-y-12">
        <!-- KYC Requests Section -->
        <section>
            <div class="mb-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Pending Bank Verifications (KYC)</h3>
                <p class="text-[10px] text-slate-500 font-bold italic">Verify agent bank details before they can request payouts.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs table-standard">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-6 py-4">Agent Name</th>
                                <th class="px-6 py-4">Bank Details</th>
                                <th class="px-6 py-4">Submitted On</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 italic font-medium">
                            @forelse($pendingKyc as $user)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center font-black text-slate-500 uppercase">{{ substr($user->name, 0, 1) }}</div>
                                            <div>
                                                <p class="text-slate-900 font-bold not-italic">{{ $user->name }}</p>
                                                <p class="text-slate-400 text-[10px]">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-900 font-bold not-italic">{{ $user->bank_name }}</div>
                                        <div class="text-slate-500">A/c: {{ $user->account_no }}</div>
                                        <div class="text-slate-400 text-[10px] uppercase font-black tracking-widest">IFSC: {{ $user->ifsc_code }}</div>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2" x-data="{ actionModal: false }">
                                            <button @click="actionModal = true" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all">Review KYC</button>
                                            
                                            <!-- KYC Action Modal -->
                                            <div x-show="actionModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm text-left">
                                                <div @click.away="actionModal = false" class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-slate-200">
                                                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-tighter mb-4">Verify KYC: {{ $user->name }}</h3>
                                                    <form action="{{ route('admin.kyc.verify', $user->id) }}" method="POST" class="space-y-4">
                                                        @csrf
                                                        <div class="space-y-1.5">
                                                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Update Status</label>
                                                            <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all font-bold">
                                                                <option value="verified">Verify Details</option>
                                                                <option value="rejected">Reject Details</option>
                                                            </select>
                                                        </div>
                                                        <div class="space-y-1.5">
                                                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Internal/Public Notes</label>
                                                            <textarea name="notes" placeholder="Reasons for rejection if any..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all h-24" required></textarea>
                                                        </div>
                                                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all">Submit Verification</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium italic">All caught up! No pending bank verifications.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Payout Requests Section -->
        <section>
            <div class="mb-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Pending Payout Requests</h3>
                <p class="text-[10px] text-slate-500 font-bold italic italic">Approve fund disbursements to vetted agents.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs table-standard">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-6 py-4">Requested By</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Request Date</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 italic font-medium">
                            @forelse($payoutRequests as $payout)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black">#</div>
                                            <div>
                                                <p class="text-slate-900 font-bold not-italic">{{ $payout->user->name }}</p>
                                                <p class="text-slate-400 text-[10px]">Balance: ₹{{ number_format($payout->user->wallet_balance, 2) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-lg font-black text-slate-900 not-italic tracking-tighter">₹{{ number_format($payout->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4">{{ $payout->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2" x-data="{ payoutModal: false }">
                                            <button @click="payoutModal = true" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-sm">Approve Payout</button>
                                            
                                            <!-- Payout Approval Modal -->
                                            <div x-show="payoutModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm text-left">
                                                <div @click.away="payoutModal = false" class="bg-white rounded-3xl w-full max-w-sm p-8 shadow-2xl border border-slate-200">
                                                    <div class="mb-6 text-center">
                                                        <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                                                            <i class="fas fa-money-bill-transfer"></i>
                                                        </div>
                                                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Confirm Payout</h3>
                                                        <p class="text-xs text-slate-400 font-bold italic">This will deduct ₹{{ number_format($payout->amount, 2) }} from the Agent's and Superadmin's wallet.</p>
                                                    </div>

                                                    <form action="{{ route('admin.payout.approve', $payout->id) }}" method="POST" class="space-y-4">
                                                        @csrf
                                                        <div class="space-y-1.5 text-left">
                                                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Admin Remarks (Optional)</label>
                                                            <textarea name="remarks" placeholder="Transaction ID, Payout reference..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all"></textarea>
                                                        </div>
                                                        <button type="submit" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">Disburse Funds <i class="fas fa-check ml-1"></i></button>
                                                        <button type="button" @click="payoutModal = false" class="w-full text-slate-400 font-black py-2 rounded-2xl text-[9px] uppercase tracking-widest hover:text-slate-600 transition-all">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium italic">No pending payout requests at the moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-dashboard.layout>
