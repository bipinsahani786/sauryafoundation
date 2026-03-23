<x-dashboard.layout>
    <x-slot name="title">Teacher Terminal</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">Coaching Dashboard</h2>
        <p class="text-xs text-slate-400 font-bold italic">Welcome back, Professor {{ auth()->user()->name }}.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $stats['total_students'] }}</h3>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Active Students</p>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $stats['total_quizzes'] }}</h3>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Total Exams</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $stats['pending_approvals'] }}</h3>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Pending Verification</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Quizzes -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-black text-slate-900 text-sm uppercase tracking-tight">Recent Examinations</h3>
                <a href="{{ route('teacher.quizzes.index') }}" class="text-[10px] font-bold text-indigo-600 hover:underline tracking-widest uppercase">View All</a>
            </div>
            <div class="p-0">
                <table class="w-full text-left text-[10px]">
                    <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">
                        <tr>
                            <th class="px-6 py-3">Exam Title</th>
                            <th class="px-6 py-3 text-center">Price</th>
                            <th class="px-6 py-3 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic transition-all">
                        @forelse($recent_quizzes as $quiz)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-900">{{ $quiz->title }}</td>
                                <td class="px-6 py-4 text-center font-bold text-emerald-600">₹{{ number_format($quiz->price) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                        {{ $quiz->status == 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : ($quiz->status == 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-slate-50 text-slate-500 border-slate-100') }}">
                                        {{ $quiz->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic font-medium">No examinations created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-6">
            <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-200">
                <h3 class="font-black text-lg mb-2 tracking-tighter">Fast Admission</h3>
                <p class="text-xs text-indigo-100 mb-4 font-medium italic opacity-80">Quickly enroll a new student into your coaching terminal.</p>
                <form action="{{ route('teacher.students.add') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="name" placeholder="Full Name" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder:text-white/40 focus:bg-white/20 outline-none transition-all font-bold" required>
                    <input type="email" name="email" placeholder="Email Address" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder:text-white/40 focus:bg-white/20 outline-none transition-all font-bold" required>
                    <input type="password" name="password" placeholder="Temporary Password" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder:text-white/40 focus:bg-white/20 outline-none transition-all font-bold" required>
                    <button type="submit" class="w-full bg-white text-indigo-600 font-black py-2.5 rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-xl">
                        Admit Student
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.layout>
