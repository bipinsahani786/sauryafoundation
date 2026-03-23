<x-dashboard.layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-7 h-7 rounded bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <i class="fas fa-users text-xs"></i>
                </div>
                <h3 class="text-slate-500 text-[10px] font-bold uppercase tracking-wider">Leads</h3>
            </div>
            <p class="text-xl font-bold text-slate-900">{{ $stats['total_applications'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-7 h-7 rounded bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <i class="fas fa-user-check text-xs"></i>
                </div>
                <h3 class="text-slate-500 text-[10px] font-bold uppercase tracking-wider">Members</h3>
            </div>
            <p class="text-xl font-bold text-slate-900">{{ $stats['total_members'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-7 h-7 rounded bg-purple-50 flex items-center justify-center text-purple-600">
                    <i class="fas fa-box text-xs"></i>
                </div>
                <h3 class="text-slate-500 text-[10px] font-bold uppercase tracking-wider">Plans</h3>
            </div>
            <p class="text-xl font-bold text-slate-900">{{ $stats['active_plans'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-7 h-7 rounded bg-amber-50 flex items-center justify-center text-amber-600">
                    <i class="fas fa-clock text-xs"></i>
                </div>
                <h3 class="text-slate-500 text-[10px] font-bold uppercase tracking-wider">Payments</h3>
            </div>
            <p class="text-xl font-bold text-slate-900">{{ $stats['pending_subscriptions'] }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-xs">
            <div class="p-3 border-b border-slate-100 flex justify-between items-center">
                <h4 class="font-bold text-slate-900 uppercase text-[10px] tracking-wider">Recent Leads</h4>
                <a href="{{ route('admin.applications') }}" class="text-[9px] font-bold text-indigo-600 uppercase hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase text-slate-400 font-bold tracking-wider">
                        <tr>
                            <th class="px-4 py-2 border-b">Name</th>
                            <th class="px-4 py-2 border-b">Sector</th>
                            <th class="px-4 py-2 border-b">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 italic">
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-2 font-bold">Bipin Kumar</td>
                            <td class="px-4 py-2 text-slate-500">Education</td>
                            <td class="px-4 py-2 text-slate-400">Today</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-2 font-bold">Rahul Singh</td>
                            <td class="px-4 py-2 text-slate-500">Marriage Hall</td>
                            <td class="px-4 py-2 text-slate-400">Yesterday</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 overflow-hidden">
             <h4 class="font-bold text-slate-900 uppercase text-[10px] tracking-wider mb-4">Latest Events</h4>
             <div class="space-y-3">
                <div class="flex items-start gap-2.5">
                    <div class="w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-[9px]"><i class="fas fa-plus"></i></div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold text-slate-900">Plan added</p>
                        <p class="text-[10px] text-slate-400 italic truncate">Marraige Hall Sikar live.</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5">
                    <div class="w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 text-[9px]"><i class="fas fa-check"></i></div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold text-slate-900">Payment OK</p>
                        <p class="text-[10px] text-slate-400 italic truncate">₹5L verified for Amit.</p>
                    </div>
                </div>
             </div>
        </div>
    </div>
</x-dashboard.layout>
