<x-dashboard.layout>
    <x-slot name="title">All Investment Plans</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Investment Plans</h2>
            <p class="text-xs text-slate-400 font-medium">Manage all active and inactive plans from here.</p>
        </div>
        <a href="{{ route('admin.plans.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold shadow-sm hover:bg-indigo-700 transition-all">
            <i class="fas fa-plus mr-1"></i> Add New Plan
        </a>
    </div>

    <!-- Plans Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs table-standard">
                <thead>
                    <tr>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Plan Details</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Category</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Min. Amount</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Profit Target</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Status</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($plans as $plan)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-slate-900 font-bold text-sm">{{ $plan->title }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5 max-w-xs truncate">{{ $plan->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-md font-bold text-[10px] uppercase border border-slate-200">{{ $plan->sector }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                ₹{{ number_format($plan->min_investment) }}
                            </td>
                            <td class="px-6 py-4 font-bold text-indigo-600">
                                {{ $plan->target_irr }}%
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 {{ $plan->status == 'active' ? 'text-emerald-600' : 'text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $plan->status == 'active' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="font-bold text-[10px] uppercase tracking-wider">{{ $plan->status }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.plans.toggle-status', $plan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $plan->status == 'active' ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100' }} border rounded-lg transition-all" title="Toggle Status">
                                            <i class="fas {{ $plan->status == 'active' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.plans.edit', $plan->id) }}" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-white transition-all"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Delete this plan permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500 hover:text-red-600 hover:bg-white transition-all"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium italic">No plans available. Click "Add New Plan" to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($plans->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $plans->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
