<x-dashboard.layout>
    <x-slot name="title">Exam Verification</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Paid Exam Approvals</h2>
            <p class="text-xs text-slate-400 font-bold italic">Verify and authorize monetized assessments from teachers.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <table class="w-full text-left table-standard">
            <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">
                <tr>
                    <th class="px-6 py-4">Examination / Teacher</th>
                    <th class="px-6 py-4 text-center">Price</th>
                    <th class="px-6 py-4 text-center">Questions</th>
                    <th class="px-6 py-4 text-right">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 italic transition-all font-medium">
                @forelse($quizzes as $quiz)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 text-xs">{{ $quiz->title }}</div>
                            <div class="text-[9px] text-indigo-600 font-black uppercase tracking-widest">By Profile: {{ $quiz->teacher->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600 italic">₹{{ number_format($quiz->price) }}</td>
                        <td class="px-6 py-4 text-center font-bold text-slate-900">{{ $quiz->questions()->count() }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($quiz->status == 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-slate-50 text-slate-500 border-slate-100') }}">
                                {{ $quiz->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($quiz->status == 'pending')
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.quizzes.approve', $quiz->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-[8px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-emerald-100">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.quizzes.reject', $quiz->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-[8px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-red-100">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-slate-300 italic">No Action Needed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">No pending monetized assessments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($quizzes->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $quizzes->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
