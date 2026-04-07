<x-dashboard.layout>
    <x-slot name="title">System Audit Vault</x-slot>

    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight italic">Activity Log Terminal</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Immutable record of all data transformations and administrative actions</p>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-[2rem] border border-slate-200 mb-8 shadow-sm">
        <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-[8px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-1">Event Type</label>
                <select name="event" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-2 text-[10px] font-bold outline-none focus:border-indigo-600 transition-all">
                    <option value="">All Events</option>
                    <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Creation</option>
                    <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Update</option>
                    <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Deletion</option>
                </select>
            </div>
            <div>
                <label class="text-[8px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-1">Model Name</label>
                <input type="text" name="subject_type" value="{{ request('subject_type') }}" placeholder="e.g. User, Course" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-2 text-[10px] font-bold outline-none focus:border-indigo-600 transition-all">
            </div>
            <div>
                <label class="text-[8px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-1">&nbsp;</label>
                <div class="flex gap-2">
                    <button type="submit" class="bg-slate-900 text-white px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg flex-1">Filter</button>
                    <a href="{{ route('admin.activity-logs.index') }}" class="bg-slate-100 text-slate-400 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center justify-center"><i class="fas fa-redo-alt"></i></a>
                </div>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        @forelse($logs as $log)
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group">
                <div class="p-6 md:p-8 flex flex-col md:flex-row md:items-start gap-6">
                    <!-- Action Badge & Meta -->
                    <div class="flex-shrink-0 flex flex-col items-center w-24">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-3 shadow-inner border border-slate-100 {{ $log->event === 'created' ? 'bg-emerald-50 text-emerald-600' : ($log->event === 'updated' ? 'bg-indigo-50 text-indigo-600' : 'bg-red-50 text-red-600') }}">
                            <i class="fas {{ $log->event === 'created' ? 'fa-plus' : ($log->event === 'updated' ? 'fa-pen' : 'fa-trash') }} text-xs"></i>
                        </div>
                        <span class="text-[8px] font-black uppercase tracking-widest {{ $log->event === 'created' ? 'text-emerald-500' : ($log->event === 'updated' ? 'text-indigo-500' : 'text-red-500') }}">
                            {{ $log->event }}
                        </span>
                        <p class="text-[8px] text-slate-400 font-bold mt-2 font-mono">{{ $log->created_at->format('H:i:s') }}</p>
                    </div>

                    <!-- Content -->
                    <div class="flex-grow">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                            <div>
                                <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-tight mb-1">
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 rounded bg-slate-100 flex items-center justify-center text-[8px]"><i class="fas fa-user text-slate-400"></i></div>
                                        <span class="text-[9px] font-black text-slate-600 uppercase tracking-tighter">{{ $log->user->name ?? 'SYSTEM' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 rounded bg-slate-100 flex items-center justify-center text-[8px]"><i class="fas fa-network-wired text-slate-400"></i></div>
                                        <span class="text-[9px] font-black text-slate-400 tracking-widest">{{ $log->ip_address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">{{ $log->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>

                        <!-- Delta Visualization -->
                        <div class="bg-slate-50/50 rounded-2xl border border-slate-50 p-4">
                            @if($log->event === 'updated')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[7px] font-black text-red-400 uppercase tracking-widest mb-2 px-2">Original State</p>
                                        <div class="space-y-1">
                                            @foreach($log->old_values as $key => $val)
                                                <div class="flex justify-between bg-white/50 px-3 py-1.5 rounded-lg border border-slate-100">
                                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">{{ $key }}</span>
                                                    <span class="text-[9px] font-bold text-slate-600 italic truncate ml-4">{{ is_array($val) ? '[DATA]' : (strlen($val) > 20 ? substr($val, 0, 20).'...' : $val) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-[7px] font-black text-emerald-500 uppercase tracking-widest mb-2 px-2">Transformed State</p>
                                        <div class="space-y-1">
                                            @foreach($log->new_values as $key => $val)
                                                <div class="flex justify-between bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                                                    <span class="text-[8px] font-black text-indigo-400 uppercase tracking-tighter">{{ $key }}</span>
                                                    <span class="text-[9px] font-black text-slate-900 truncate ml-4">{{ is_array($val) ? '[DATA]' : (strlen($val) > 20 ? substr($val, 0, 20).'...' : $val) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @elseif($log->event === 'created')
                                <div class="p-2">
                                    <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-3">Model Attributes Created</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($log->new_values as $key => $val)
                                            <div class="bg-white px-3 py-1.5 rounded-lg border border-slate-100 flex items-center gap-2">
                                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ $key }}:</span>
                                                <span class="text-[9px] font-bold text-slate-600">{{ is_array($val) ? '[...]' : (strlen($val) > 20 ? substr($val, 0, 20).'...' : $val) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center gap-4 p-4 text-red-500/50 italic text-[10px] font-bold">
                                    <i class="fas fa-dumpster-fire text-lg"></i>
                                    <span>Subject records permanently removed from active table. Reference ID: #{{ $log->subject_id }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 bg-white rounded-[3rem] text-center border-2 border-dashed border-slate-100">
                <i class="fas fa-ghost text-slate-200 text-5xl mb-6"></i>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.3em]">No activity signals captured</p>
            </div>
        @endforelse
    </div>

    @if($logs->hasPages())
        <div class="mt-10">
            {{ $logs->links() }}
        </div>
    @endif
</x-dashboard.layout>
