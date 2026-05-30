<x-dashboard.layout>
    <x-slot name="title">Enrolled Coaching Centers</x-slot>

    <div x-data="{ open: false }">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em] mb-1">Enrolled coaching Centers</h2>
                <p class="text-xs text-slate-400 font-medium italic">Manage the list of coaching centers you've enrolled.</p>
            </div>
            <button @click="open = true" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
                <i class="fas fa-plus mr-1"></i> Enroll New Coaching
            </button>
        </div>

        <!-- Enrollment Modal -->
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
            <div @click.away="open = false" class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-slate-200">
                <div class="mb-6 flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Enroll Coaching</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">New Merchant Access</p>
                    </div>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
                </div>

                <form action="{{ route('sales-agent.merchants.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Merchant Name</label>
                        <input type="text" name="name" placeholder="John Doe" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Coaching Name</label>
                        <input type="text" name="coaching_or_school" placeholder="ABC Coaching Center" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Mobile Number</label>
                            <input type="text" name="mobile_number" placeholder="9876543210" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Village / Address</label>
                            <input type="text" name="address" placeholder="Village Name or Address" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Block</label>
                            <input type="text" name="block" placeholder="Block Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">District</label>
                            <input type="text" name="district" placeholder="District Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">State</label>
                            <input type="text" name="state" placeholder="State Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Merchant Email</label>
                        <input type="email" name="email" placeholder="merchant@coaching.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Create Password</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                            Enroll Merchant <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Coaching Center Name</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Email</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider text-right">Registered On</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($merchants as $merchant)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black">
                                        {{ substr($merchant->name, 0, 1) }}
                                    </div>
                                    <p class="text-slate-900 font-bold text-sm">{{ $merchant->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $merchant->email }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full font-bold text-[10px] uppercase tracking-wider">Active</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                {{ $merchant->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium italic">No coaching centers enrolled yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($merchants->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 italic font-medium">
                {{ $merchants->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
