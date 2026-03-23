<x-dashboard.layout>
    <x-slot name="title">{{ isset($plan) ? 'Edit Plan' : 'Add Plan' }}</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.plans.index') }}" class="text-indigo-600 text-[10px] font-bold uppercase flex items-center gap-1.5 hover:underline mb-2"><i class="fas fa-arrow-left"></i> Back to Plans</a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">{{ isset($plan) ? 'Update Investment Plan' : 'Create New Investment Plan' }}</h2>
        <p class="text-xs text-slate-400 font-medium">Enter the details below to {{ isset($plan) ? 'update' : 'create' }} the plan.</p>
    </div>

    <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm w-full">
        <form action="{{ isset($plan) ? route('admin.plans.update', $plan->id) : route('admin.plans.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            @if(isset($plan)) @method('PUT') @endif
            
            <div class="col-span-1 md:col-span-2 space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Plan Title</label>
                <input type="text" name="title" value="{{ $plan->title ?? '' }}" placeholder="Enter Plan Name" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold placeholder:text-slate-300 focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" required>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Category / Sector</label>
                <select name="sector" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" required>
                    <option value="Marriage Halls" {{ (isset($plan) && $plan->sector == 'Marriage Halls') ? 'selected' : '' }}>Marriage Halls</option>
                    <option value="Education" {{ (isset($plan) && $plan->sector == 'Education') ? 'selected' : '' }}>Education</option>
                    <option value="Coaching" {{ (isset($plan) && $plan->sector == 'Coaching') ? 'selected' : '' }}>Coaching</option>
                    <option value="Real Estate" {{ (isset($plan) && $plan->sector == 'Real Estate') ? 'selected' : '' }}>Real Estate</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Status</label>
                <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" required>
                    <option value="active" {{ (isset($plan) && $plan->status == 'active') ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ (isset($plan) && $plan->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Min. Amount (₹)</label>
                <input type="number" name="min_investment" value="{{ isset($plan) ? (int)$plan->min_investment : '' }}" placeholder="500000" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-bold placeholder:text-slate-300 focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" required>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Profit Target (%)</label>
                <input type="number" step="0.01" name="target_irr" value="{{ $plan->target_irr ?? '' }}" placeholder="18.5" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-bold placeholder:text-slate-300 focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" required>
            </div>

            <div class="col-span-1 md:col-span-2 space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block ml-1">Plan Description</label>
                <textarea name="description" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-medium placeholder:text-slate-300 focus:border-indigo-500 focus:bg-white outline-none transition-all shadow-sm" placeholder="Write details about the plan here...">{{ $plan->description ?? '' }}</textarea>
            </div>

            <div class="col-span-1 md:col-span-2 pt-2 flex gap-2 child:transition-all">
                <button type="submit" class="flex-1 bg-indigo-600 text-white font-bold py-2.5 rounded-lg text-xs hover:bg-indigo-700 shadow-sm active:scale-[0.98]">
                    {{ isset($plan) ? 'Update Plan' : 'Save Plan' }}
                </button>
                <a href="{{ route('admin.plans.index') }}" class="px-6 py-2.5 bg-slate-100 text-slate-500 border border-slate-200 rounded-lg text-xs font-bold hover:bg-slate-200 text-center">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard.layout>
