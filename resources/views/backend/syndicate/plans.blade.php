<x-dashboard.layout>
    <x-slot name="title">Plans</x-slot>

    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Available Plans</h2>
        <p class="text-[11px] text-slate-400 font-medium">Choose a plan below to start participating.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse($plans as $plan)
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-indigo-400 transition-all group">
                <div class="mb-3">
                    <span class="px-2 py-0.5 bg-slate-100 text-slate-500 rounded text-[9px] font-bold uppercase border border-slate-200">{{ $plan->sector }}</span>
                </div>

                <h4 class="text-sm font-bold text-slate-900 mb-1 truncate group-hover:text-indigo-600">{{ $plan->title }}</h4>
                <p class="text-slate-400 text-[10px] mb-4 line-clamp-2 italic leading-relaxed">"{{ $plan->description }}"</p>

                <div class="grid grid-cols-2 gap-2 mb-4">
                    <div class="p-2 bg-slate-50 rounded border border-slate-100 text-center">
                        <p class="text-[8px] uppercase font-bold text-slate-400">Min Amt</p>
                        <p class="text-slate-900 font-bold text-[11px]">₹{{ number_format($plan->min_investment/1000, 0) }}K</p>
                    </div>
                    <div class="p-2 bg-emerald-50 rounded border border-emerald-100 text-center">
                        <p class="text-[8px] uppercase font-bold text-emerald-400">Profit</p>
                        <p class="text-emerald-700 font-bold text-[11px]">{{ $plan->target_irr }}%</p>
                    </div>
                </div>

                <a href="{{ route('syndicate.plans.join', $plan->id) }}" class="block w-full text-center bg-slate-900 text-white font-bold py-2.5 rounded-lg text-[10px] uppercase tracking-wider hover:bg-indigo-600 transition-all shadow-sm">
                    Join Now
                </a>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-slate-200">
                <p class="text-slate-400 italic text-xs">No active plans found.</p>
            </div>
        @endforelse
    </div>
</x-dashboard.layout>
