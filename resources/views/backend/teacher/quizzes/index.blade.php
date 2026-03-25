<x-dashboard.layout>
    <x-slot name="title">Exam Management</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Examinations</h2>
            <p class="text-xs text-slate-400 font-bold italic">Create and manage your coaching assessments.</p>
        </div>
        <a href="{{ route('teacher.quizzes.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
            <i class="fas fa-plus"></i> Create New Exam
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <table class="w-full text-left table-standard">
            <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">
                <tr>
                    <th class="px-6 py-4">Examination Title</th>
                    <th class="px-6 py-4">Schedule</th>
                    <th class="px-6 py-4 text-center">Questions</th>
                    <th class="px-6 py-4 text-center">Pricing</th>
                    <th class="px-6 py-4 text-right">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 italic transition-all font-medium">
                @forelse($quizzes as $quiz)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 text-xs">{{ $quiz->title }}</div>
                            <div class="text-[9px] text-slate-400 truncate max-w-xs">{{ $quiz->description ?? 'No description provided.' }}</div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">
                            @if($quiz->start_time)
                                <div class="font-bold">{{ $quiz->start_time->format('M d, H:i') }}</div>
                                <div class="text-[9px] text-slate-400 tracking-tighter uppercase">To {{ $quiz->end_time ? $quiz->end_time->format('M d, H:i') : 'Unlimited' }}</div>
                            @else
                                <span class="text-slate-400">Not scheduled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-900">{{ $quiz->questions()->count() }}</td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600">₹{{ number_format($quiz->price) }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($quiz->status == 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-slate-50 text-slate-500 border-slate-100') }}">
                                {{ $quiz->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('teacher.quizzes.results', $quiz->id) }}" class="w-7 h-7 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all" title="View Results">
                                    <i class="fas fa-chart-bar"></i>
                                </a>
                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="w-7 h-7 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all" title="Edit Questions">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Delete this exam?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-7 h-7 bg-red-50 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-600 hover:text-white transition-all">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium italic">No examinations established yet.</td>
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
