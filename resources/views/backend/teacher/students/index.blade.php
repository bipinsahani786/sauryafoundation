<x-dashboard.layout>
    <x-slot name="title">Student Management</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">My Students</h2>
            <p class="text-xs text-slate-400 font-bold italic">Manage enrollments for your coaching group.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden text-[10px]" x-data="{ creditModal: false, selectedStudent: null, studentName: '' }">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">
                    <tr>
                        <th class="px-8 py-5">Student Identity</th>
                        <th class="px-8 py-5">Contact Detail</th>
                        <th class="px-8 py-5 text-center">Assigned Class</th>
                        <th class="px-8 py-5 text-center">Wallet Status</th>
                        <th class="px-8 py-5 text-center">Enrollment Date</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic transition-all font-medium">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-sm shadow-sm">{{ substr($student->name, 0, 1) }}</div>
                                    <span class="text-slate-900 font-bold text-xs uppercase tracking-tight">{{ $student->name }}</span>
                                    <span class="px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-600 text-[8px] font-black italic border border-indigo-100 uppercase tracking-widest">{{ $student->studentClass->name ?? 'Unassigned' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-slate-600 font-bold uppercase tracking-tight text-[11px]">{{ $student->email }}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-slate-900 font-black italic uppercase tracking-widest text-[10px]">{{ $student->studentClass->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 font-black text-[9px] uppercase tracking-widest italic">
                                    <i class="fas fa-wallet text-[8px]"></i> ₹{{ number_format($student->wallet_balance, 2) }}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                                {{ $student->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('teacher.students.edit', $student) }}" class="text-slate-400 hover:bg-slate-900 hover:text-white font-black uppercase tracking-widest text-[8px] border border-slate-100 px-3 py-2 rounded-xl transition-all shadow-sm active:scale-95 bg-slate-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button @click="creditModal = true; selectedStudent = {{ $student->id }}; studentName = '{{ $student->name }}'" class="text-emerald-600 hover:bg-emerald-600 hover:text-white font-black uppercase tracking-widest text-[8px] border border-emerald-100 px-3 py-2 rounded-xl transition-all shadow-sm active:scale-95 bg-emerald-50 group">
                                        <i class="fas fa-hand-holding-dollar mr-1 group-hover:scale-110 transition-transform"></i> Credit Wallet
                                    </button>
                                    <a href="{{ route('teacher.students.progress', $student->id) }}" class="text-indigo-600 hover:bg-indigo-600 hover:text-white font-black uppercase tracking-widest text-[8px] border border-indigo-100 px-3 py-2 rounded-xl transition-all shadow-sm active:scale-95 bg-indigo-50 group">
                                        <i class="fas fa-chart-line mr-1 group-hover:scale-110 transition-transform"></i> Tracking
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-slate-400 font-black italic uppercase tracking-[0.3em] text-[10px]">No scholars admitted yet. Use the "Quick Admission" tool.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Credit Wallet Modal -->
        <div x-show="creditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
            <div @click.away="creditModal = false" class="bg-white rounded-[2rem] w-full max-w-md p-8 shadow-2xl border border-slate-200">
                <div class="mb-4 flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 italic tracking-tighter uppercase mb-1">Credit Wallet</h3>
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em]">Add money to <span class="text-indigo-600" x-text="studentName"></span>'s balance.</p>
                    </div>
                    <button @click="creditModal = false" class="w-7 h-7 rounded-full bg-slate-50 text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center"><i class="fas fa-times text-xs"></i></button>
                </div>

                <div class="mb-4 p-4 {{ auth()->user()->wallet_balance < 1 ? 'bg-red-50 border-red-100' : 'bg-indigo-50 border-indigo-100' }} border rounded-2xl flex items-center justify-between shadow-sm relative overflow-hidden group">
                    @if(auth()->user()->wallet_balance < 1)
                        <div class="absolute inset-0 bg-red-100/10 pointer-events-none group-hover:bg-red-100/20 transition-all"></div>
                    @endif
                    <div>
                        <p class="text-[8px] font-black {{ auth()->user()->wallet_balance < 1 ? 'text-red-500' : 'text-indigo-600' }} uppercase tracking-[0.3em] mb-0.5 italic">Professional Balance</p>
                        <p class="text-xl font-black {{ auth()->user()->wallet_balance < 1 ? 'text-red-600' : 'text-indigo-900' }} tracking-tighter italic">₹{{ number_format(auth()->user()->wallet_balance, 2) }}</p>
                    </div>
                    @if(auth()->user()->wallet_balance < 1)
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-red-600 text-white rounded-lg text-[8px] font-black uppercase tracking-widest shadow-lg shadow-red-200">
                            <i class="fas fa-triangle-exclamation"></i> Low Funds
                        </div>
                    @else
                        <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center text-lg shadow-lg shadow-indigo-100">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                    @endif
                </div>

                @if(auth()->user()->wallet_balance < 1)
                    <div class="mb-4 p-4 bg-red-50 border border-red-100 rounded-xl flex items-start gap-3">
                        <i class="fas fa-info-circle text-red-400 mt-0.5 text-xs"></i>
                        <div>
                            <p class="text-[9px] font-black text-red-700 uppercase tracking-widest mb-0.5 italic">Note</p>
                            <p class="text-[10px] font-bold text-red-500/80 leading-snug italic uppercase opacity-80">Insufficient funds. Please fund your wallet to proceed.</p>
                        </div>
                    </div>
                @endif

                <form :action="'{{ route('teacher.students.add-money', ['student' => 'STUDENT_ID']) }}'.replace('STUDENT_ID', selectedStudent)" method="POST" class="space-y-4" x-data="{ amount: 1 }">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Transfer Volume (₹)</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-lg italic group-hover:text-indigo-600 transition-colors">₹</span>
                            <input type="number" 
                                name="amount" 
                                x-model="amount"
                                step="0.01" 
                                min="1" 
                                max="{{ auth()->user()->wallet_balance }}" 
                                placeholder="0.00" 
                                class="w-full bg-slate-50 border-2 {{ auth()->user()->wallet_balance < 1 ? 'border-red-50/50 bg-red-50/10 opacity-50 cursor-not-allowed' : 'border-slate-100 focus:border-indigo-600 focus:bg-white' }} rounded-2xl px-12 py-4 text-xl font-black tracking-tighter outline-none transition-all placeholder:text-slate-200 italic" 
                                {{ auth()->user()->wallet_balance < 1 ? 'disabled' : 'required' }}>
                        </div>
                        <div class="flex justify-between items-center ml-4">
                            <p class="text-[8px] text-slate-400 italic font-black uppercase tracking-wider">* Institutional protocol active.</p>
                            @if(auth()->user()->wallet_balance > 0)
                                <p class="text-[8px] font-black uppercase tracking-widest transition-colors italic" :class="amount > {{ auth()->user()->wallet_balance }} ? 'text-red-500' : 'text-emerald-500'">
                                    <span x-text="amount > {{ auth()->user()->wallet_balance }} ? 'EXCEEDS BALANCE' : 'READY TO SETTLE'"></span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="pt-2">
                        @if(auth()->user()->wallet_balance < 1)
                            <button type="button" class="w-full bg-slate-100 text-slate-400 font-black py-4 rounded-2xl text-[9px] uppercase tracking-[0.3em] italic cursor-not-allowed shadow-inner transition-all border border-slate-200">
                                Protocol Blocked
                            </button>
                        @else
                            <button type="submit" 
                                class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl text-[9px] uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl active:scale-95 group overflow-hidden relative"
                                :disabled="amount > {{ auth()->user()->wallet_balance }} || amount < 1"
                                :class="amount > {{ auth()->user()->wallet_balance }} || amount < 1 ? 'opacity-50 cursor-not-allowed grayscale' : ''">
                                Authorize Transaction <i class="fas fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @if($students->hasPages())
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
