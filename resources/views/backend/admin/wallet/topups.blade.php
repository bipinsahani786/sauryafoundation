<x-dashboard.layout>
    <x-slot name="title">Wallet Top-up Management</x-slot>

    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase italic">Top-up Verifications</h2>
        <p class="text-xs text-slate-400 font-bold italic uppercase tracking-widest mt-1">Review and reconcile manual financial transfers.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden" x-data="{ showImage: null }">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5">Initiated</th>
                        <th class="px-8 py-5">Requester</th>
                        <th class="px-8 py-5">Financial Value</th>
                        <th class="px-8 py-5">UTR/Reference ID</th>
                        <th class="px-8 py-5 text-center">Visual Proof</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic">
                    @forelse($requests as $request)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="px-8 py-6 text-[10px] font-bold text-slate-400">{{ $request->created_at->format('M d, Y') }}<br>{{ $request->created_at->format('H:i') }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-black text-[10px] text-slate-600 border border-slate-200">
                                        {{ substr($request->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-black text-slate-900 uppercase tracking-tighter">{{ $request->user->name }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">{{ $request->user->role }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 font-black text-slate-900 text-base">₹{{ number_format($request->amount, 2) }}</td>
                            <td class="px-8 py-6">
                                <span class="bg-slate-100 px-3 py-1 rounded-lg text-slate-600 font-black text-[10px] uppercase tracking-tighter border border-slate-200 select-all">{{ $request->utr_number }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <button @click="showImage = '{{ asset('storage/' . $request->proof_image) }}'" class="text-indigo-600 hover:text-indigo-800 transition-all group">
                                    <i class="fas fa-image text-xl group-hover:scale-110"></i>
                                </button>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 
                                    {{ $request->status === 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($request->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-red-50 text-red-600 border-red-100') }} 
                                    rounded-full font-black text-[8px] uppercase tracking-widest border">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($request->status === 'pending')
                                    <div class="flex justify-end gap-2" x-data="{ rejecting: false }">
                                        <form action="{{ route('admin.wallet.topup.approve', $request) }}" method="POST" onsubmit="return confirm('Ensure transfer arrival in bank before approving.')">
                                            @csrf
                                            <button type="submit" class="bg-emerald-50 text-emerald-600 p-2 rounded-xl border border-emerald-100 hover:bg-emerald-600 hover:text-white transition-all shadow-sm" title="Approve Verification">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        <button @click="rejecting = true" class="bg-red-50 text-red-600 p-2 rounded-xl border border-red-100 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Reject Transmission">
                                            <i class="fas fa-times"></i>
                                        </button>

                                        <!-- Rejection Dialog -->
                                        <div x-show="rejecting" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                                            <div @click.away="rejecting = false" class="bg-white rounded-[2.5rem] w-full max-w-sm p-10 shadow-2xl border border-slate-200 text-left">
                                                <h3 class="text-2xl font-black text-slate-900 italic tracking-tighter uppercase mb-6">Reject Transfer</h3>
                                                <form action="{{ route('admin.wallet.topup.reject', $request) }}" method="POST" class="space-y-6">
                                                    @csrf
                                                    <div class="space-y-2">
                                                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Rejection Reason</label>
                                                        <textarea name="admin_note" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-red-500 outline-none transition-all placeholder:text-slate-200 uppercase tracking-tight" placeholder="UTR UNVERIFIED / DUPLICATE REQUEST" required></textarea>
                                                    </div>
                                                    <button type="submit" class="w-full bg-red-600 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.3em] hover:bg-slate-900 transition-all shadow-xl shadow-red-100 active:scale-95">
                                                        Finalize Rejection
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest">{{ $request->admin_note ?? '---' }}</p>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-20 text-center text-slate-300 font-black italic uppercase tracking-[0.3em] text-[10px]">No pending verification sequences identified.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($requests->hasPages())
            <div class="p-8 border-t border-slate-50 bg-slate-50/50">
                {{ $requests->links() }}
            </div>
        @endif

        <!-- Image Preview Modal -->
        <div x-show="showImage" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-8 bg-slate-900/90 backdrop-blur-lg" @click="showImage = null">
            <div class="relative max-w-4xl max-h-full">
                <img :src="showImage" class="rounded-3xl shadow-2xl border-4 border-white/20">
                <button class="absolute -top-4 -right-4 w-12 h-12 bg-white text-slate-900 rounded-full shadow-2xl flex items-center justify-center text-xl hover:bg-slate-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</x-dashboard.layout>
