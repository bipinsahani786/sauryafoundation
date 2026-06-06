<x-dashboard.layout>
    <x-slot name="title">Manage Admit Cards</x-slot>

    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Admit Cards</h2>
            <p class="text-[10px] text-slate-400 font-medium italic">Generate and manage examination admit cards for students.</p>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-3">
            <form action="{{ route('admin.admit-cards.index') }}" method="GET" class="relative w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search roll no, exam, student..." class="w-full md:w-64 pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm transition-all">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                @if(request('search'))
                    <a href="{{ route('admin.admit-cards.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500" title="Clear Search"><i class="fas fa-times"></i></a>
                @endif
            </form>

            <a href="{{ route('admin.admit-cards.bulk-create') }}" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-slate-800 transition-all whitespace-nowrap">
                <i class="fas fa-users mr-1"></i> Bulk Generate
            </a>
            <a href="{{ route('admin.admit-cards.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all whitespace-nowrap">
                <i class="fas fa-plus mr-1"></i> Generate Admit Card
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                    <tr>
                        <th class="px-4 py-3 bg-slate-50 border-b">Roll No</th>
                        <th class="px-4 py-3 bg-slate-50 border-b">Student</th>
                        <th class="px-4 py-3 bg-slate-50 border-b">Exam Name</th>
                        <th class="px-4 py-3 bg-slate-50 border-b">Center</th>
                        <th class="px-4 py-3 bg-slate-50 border-b">Date</th>
                        <th class="px-4 py-3 bg-slate-50 border-b text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($admitCards as $card)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 font-bold text-indigo-600">{{ $card->roll_no }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    @if($card->user->profile_photo_path)
                                        <img src="{{ asset('storage/'.$card->user->profile_photo_path) }}" class="w-6 h-6 rounded-full object-cover">
                                    @else
                                        <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-[8px]">{{ substr($card->user->name, 0, 1) }}</div>
                                    @endif
                                    <div>
                                        <p class="text-slate-900 font-bold not-italic">{{ $card->user->name }}</p>
                                        <p class="text-[9px] text-slate-400">{{ $card->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-700">{{ $card->exam_name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $card->exam_center }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $card->exam_date->format('d M, Y h:i A') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.admit-cards.show', $card) }}" class="p-1.5 text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-md transition-colors" title="View / Print">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <a href="{{ route('admin.admit-cards.pdf', $card) }}" class="p-1.5 text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-md transition-colors" title="Download PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <form action="{{ route('admin.admit-cards.destroy', $card) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admit card?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No admit cards found. Generate one to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($admitCards->hasPages())
            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">
                {{ $admitCards->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
