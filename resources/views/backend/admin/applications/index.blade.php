<x-dashboard.layout>
    <x-slot name="title">User Leads</x-slot>

    <div class="mb-4">
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Leads</h2>
        <p class="text-[10px] text-slate-400 font-medium italic">Recent inquiries from the frontend.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                    <tr>
                        <th class="px-4 py-2 bg-slate-50 border-b">Name</th>
                        <th class="px-4 py-2 bg-slate-50 border-b">Contact</th>
                        <th class="px-4 py-2 bg-slate-50 border-b">Sector</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Date</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($applications as $app)
                        <tr class="hover:bg-slate-50/50 transition-all font-medium">
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-600 font-bold text-[9px]">{{ substr($app->name, 0, 1) }}</div>
                                    <span class="text-slate-900 font-bold text-xs">{{ $app->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <p class="text-slate-700 font-bold">{{ $app->email }}</p>
                                <p class="text-[9px] text-slate-400">{{ $app->phone }}</p>
                            </td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-[8px] font-bold uppercase border border-indigo-100">{{ $app->sector }}</span>
                            </td>
                            <td class="px-4 py-2 text-center text-slate-500 font-bold uppercase">
                                {{ $app->created_at->format('d M y') }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                <button class="p-1.5 border border-slate-100 rounded hover:bg-white text-slate-400 hover:text-indigo-600 transition-all"><i class="fas fa-ellipsis-h text-[10px]"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-400 italic">No new leads.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.layout>
