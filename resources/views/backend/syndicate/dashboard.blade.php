<x-dashboard.layout>
    <x-slot name="title">Portfolio</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-indigo-600 p-6 rounded-xl shadow-lg shadow-indigo-100 text-white flex flex-col justify-center">
            <h3 class="text-indigo-200 text-[10px] font-bold uppercase tracking-wider mb-1">Total Invested</h3>
            <p class="text-2xl font-bold leading-none mb-4">₹{{ number_format($mySubscriptions->where('status', 'approved')->sum('amount')) }}</p>
            <div class="flex items-center gap-3 text-[10px]">
                <div class="bg-white/10 px-2 py-0.5 rounded border border-white/10">
                    <span class="font-bold">{{ $mySubscriptions->where('status', 'approved')->count() }} Plans</span>
                </div>
                <div class="bg-white/10 px-2 py-0.5 rounded border border-white/10">
                    <span class="font-bold">18.5% Profit</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-center">
            <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-4">Allocation</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center text-[10px] font-bold">
                    <span class="text-slate-700">Education</span>
                    <span class="text-slate-400 uppercase tracking-tighter">45% Weight</span>
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                    <div class="h-full bg-indigo-500" style="width: 45%"></div>
                </div>
                <div class="flex justify-between items-center text-[10px] font-bold pt-1">
                    <span class="text-slate-700">Marriage Halls</span>
                    <span class="text-slate-400 uppercase tracking-tighter">55% Weight</span>
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                    <div class="h-full bg-emerald-500" style="width: 55%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-xs">
        <div class="p-3 border-b border-slate-100 flex justify-between items-center">
            <h4 class="font-bold text-slate-900 uppercase text-[10px] tracking-wider">My Investments</h4>
            <a href="{{ route('syndicate.plans') }}" class="text-[9px] font-bold text-indigo-600 uppercase hover:underline">New Plan</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-[9px] uppercase text-slate-400 font-bold tracking-wider">
                    <tr>
                        <th class="px-4 py-2 border-b">Plan</th>
                        <th class="px-4 py-2 border-b text-center">Date</th>
                        <th class="px-4 py-2 border-b text-right">Amount</th>
                        <th class="px-4 py-2 border-b text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 italic">
                    @forelse($mySubscriptions as $sub)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-2">
                                <p class="text-slate-900 font-bold">{{ $sub->plan->title }}</p>
                                <p class="text-[9px] text-slate-400 italic">{{ $sub->plan->sector }}</p>
                            </td>
                            <td class="px-4 py-2 text-center text-slate-500">{{ $sub->created_at->format('d M y') }}</td>
                            <td class="px-4 py-2 text-right font-bold text-slate-900">₹{{ number_format($sub->amount) }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                    {{ $sub->status == 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($sub->status == 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-red-50 text-red-600 border-red-100') }}">
                                    {{ $sub->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-slate-400 italic">No plans yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.layout>
