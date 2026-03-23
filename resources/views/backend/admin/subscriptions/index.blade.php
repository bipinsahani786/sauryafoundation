<x-dashboard.layout>
    <x-slot name="title">Payments</x-slot>

    <div class="mb-4">
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Verify Payments</h2>
        <p class="text-[10px] text-slate-400 font-medium italic">Pending capital verification requests.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                    <tr>
                        <th class="px-4 py-2 bg-slate-50 border-b">User</th>
                        <th class="px-4 py-2 bg-slate-50 border-b">Plan & Amount</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Receipt</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Status</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($subscriptions as $sub)
                        <tr class="hover:bg-slate-50/50 transition-all font-medium">
                            <td class="px-4 py-2">
                                <p class="text-slate-900 font-bold text-xs">{{ $sub->user->name }}</p>
                                <p class="text-slate-400 italic">{{ $sub->user->email }}</p>
                            </td>
                            <td class="px-4 py-2">
                                <p class="text-slate-900 font-bold">₹{{ number_format($sub->amount) }}</p>
                                <p class="text-indigo-600 font-bold italic">{{ $sub->plan->title }}</p>
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if($sub->payment_screenshot)
                                    <a href="{{ asset('storage/' . $sub->payment_screenshot) }}" target="_blank" class="inline-flex items-center gap-1.5 text-indigo-600 hover:underline">
                                        <i class="fas fa-image text-[9px]"></i> <span>View</span>
                                    </a>
                                @else
                                    <span class="text-red-500 font-bold uppercase text-[8px]">Missing</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                    {{ $sub->status == 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($sub->status == 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-red-50 text-red-600 border-red-100') }}">
                                    {{ $sub->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right">
                                @if($sub->status == 'pending')
                                    <div x-data="{ open: false, adminNote: '' }">
                                        <button @click="open = true" class="px-3 py-1 bg-slate-900 text-white rounded text-[9px] font-bold uppercase tracking-wider hover:bg-indigo-600 transition-all shadow-sm">Verify</button>
                                        
                                        <!-- Verification Modal -->
                                        <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-transition.opacity>
                                            <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl border border-slate-200 text-left" @click.away="open = false">
                                                <h4 class="text-base font-bold text-slate-900 mb-0.5 uppercase tracking-tighter">Verify Receipt</h4>
                                                <p class="text-[10px] text-slate-400 italic mb-4">₹{{ number_format($sub->amount) }} | {{ $sub->user->name }}</p>
                                                
                                                <div class="aspect-video w-full rounded border border-slate-100 overflow-hidden mb-4 shadow-inner">
                                                    <img src="{{ asset('storage/' . $sub->payment_screenshot) }}" class="w-full h-full object-cover">
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="text-[9px] font-bold text-slate-500 uppercase mb-1 block tracking-widest">Internal Note (Ref ID, etc.)</label>
                                                    <textarea x-model="adminNote" class="w-full bg-slate-50 border border-slate-200 rounded p-3 text-xs font-medium outline-none focus:border-indigo-500 focus:bg-white transition-all shadow-inner" rows="2" placeholder="Enter optional notes here..."></textarea>
                                                </div>

                                                <div class="flex gap-2">
                                                    <!-- Approve Form -->
                                                    <form action="{{ route('admin.subscriptions.approve', $sub->id) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        <input type="hidden" name="admin_note" :value="adminNote">
                                                        <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-sm">Approve</button>
                                                    </form>
                                                    
                                                    <!-- Reject Form -->
                                                    <form action="{{ route('admin.subscriptions.reject', $sub->id) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        <input type="hidden" name="admin_note" :value="adminNote">
                                                        <button type="submit" class="w-full bg-red-50 text-red-500 border border-red-100 py-2 rounded font-bold text-xs uppercase tracking-widest hover:bg-red-100 transition-all">Reject</button>
                                                    </form>
                                                </div>
                                                
                                                <button type="button" @click="open = false" class="w-full mt-4 py-2 text-slate-400 font-bold text-[9px] uppercase tracking-widest hover:text-slate-600 transition-all">Close Terminal</button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-[9px] font-bold flex items-center justify-end gap-1 uppercase tracking-tighter">
                                        @if($sub->status == 'approved')
                                            <i class="fas fa-check-double text-emerald-500"></i> Approved
                                        @else
                                            <i class="fas fa-times-circle text-red-500"></i> Rejected
                                        @endif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-400 italic">No pending payments.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.layout>
