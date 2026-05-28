<x-dashboard.layout>
    <x-slot name="title">Manage Applications</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Applications</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Review Get Involved submissions</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-8 py-4">Applicant</th>
                        <th class="px-8 py-4">Type</th>
                        <th class="px-8 py-4">Contact</th>
                        <th class="px-8 py-4">Message</th>
                        <th class="px-8 py-4">Date</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($applications as $app)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <p class="text-sm font-bold text-slate-900">{{ $app->first_name }} {{ $app->last_name }}</p>
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    @if($app->type == 'volunteer') bg-green-100 text-green-700
                                    @elseif($app->type == 'internship') bg-blue-100 text-blue-700
                                    @elseif($app->type == 'partner') bg-teal-100 text-teal-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    {{ $app->type }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs text-slate-600 mb-1"><i class="fas fa-envelope w-4"></i> {{ $app->email }}</p>
                                <p class="text-xs text-slate-600"><i class="fas fa-phone w-4"></i> {{ $app->phone }}</p>
                            </td>
                            <td class="px-8 py-4 max-w-[200px] truncate" title="{{ $app->message }}">
                                <p class="text-xs text-slate-500">{{ Str::limit($app->message, 50) }}</p>
                                @if($app->resume_path)
                                    <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="text-[10px] text-blue-600 hover:underline mt-1 inline-block font-bold">
                                        <i class="fas fa-file-pdf"></i> View Resume
                                    </a>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-xs text-slate-500 font-medium">
                                {{ $app->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    @if($app->status == 'pending') bg-amber-100 text-amber-700
                                    @elseif($app->status == 'reviewed') bg-indigo-100 text-indigo-700
                                    @elseif($app->status == 'accepted') bg-emerald-100 text-emerald-700
                                    @else bg-rose-100 text-rose-700 @endif">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button @click="open = !open" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors rounded-xl hover:bg-indigo-50">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-cloak
                                         class="origin-top-right absolute right-0 mt-2 w-40 rounded-2xl shadow-xl bg-white border border-slate-100 ring-1 ring-black ring-opacity-5 z-10 overflow-hidden">
                                        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-amber-600 transition-colors">Mark Pending</button>
                                        </form>
                                        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="reviewed">
                                            <button type="submit" class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">Mark Reviewed</button>
                                        </form>
                                        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-emerald-600 transition-colors">Mark Accepted</button>
                                        </form>
                                        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-rose-600 transition-colors border-t border-slate-50">Mark Rejected</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-12 text-center text-slate-400">
                                <div class="w-16 h-16 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-inbox text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-sm font-bold">No applications found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($applications->hasPages())
            <div class="p-6 border-t border-slate-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
