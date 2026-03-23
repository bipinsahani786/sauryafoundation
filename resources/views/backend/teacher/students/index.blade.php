<x-dashboard.layout>
    <x-slot name="title">Student Management</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">My Students</h2>
            <p class="text-xs text-slate-400 font-bold italic">Manage enrollments for your coaching group.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">
                    <tr>
                        <th class="px-6 py-4">Student Identity</th>
                        <th class="px-6 py-4">Contact Detail</th>
                        <th class="px-6 py-4 text-center">Enrollment Date</th>
                        <th class="px-6 py-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic transition-all font-medium">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xs">{{ substr($student->name, 0, 1) }}</div>
                                    <span class="text-slate-900 font-bold text-xs">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-bold">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-center text-slate-400 font-bold uppercase tracking-tighter">
                                {{ $student->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-3">
                                <a href="{{ route('teacher.students.progress', $student->id) }}" class="text-indigo-600 hover:text-indigo-800 font-black uppercase tracking-widest text-[8px] border border-indigo-100 px-2 py-1 rounded bg-indigo-50 transition-all">
                                    <i class="fas fa-chart-line mr-1"></i> Tracking
                                </a>
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                    {{ $student->status == 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium italic">No students admitted yet. Use the "Fast Admission" tool on your dashboard.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
