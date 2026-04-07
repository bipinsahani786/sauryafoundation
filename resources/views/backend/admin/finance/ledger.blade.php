<x-dashboard.layout>
    <x-slot name="title">Grand Ledger | Financial Analytics</x-slot>

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight italic">Money Movement Protocol</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Real-time audit trail for all platform revenue streams</p>
        </div>
        
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.finance.ledger') }}" method="GET" class="flex items-center gap-2">
                <input type="hidden" name="tab" value="{{ $stats['active_tab'] }}">
                <select name="range" onchange="this.form.submit()" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-[10px] font-black uppercase tracking-widest outline-none focus:border-indigo-600 transition-all shadow-sm">
                    <option value="all" {{ $stats['range'] == 'all' ? 'selected' : '' }}>All Time</option>
                    <option value="today" {{ $stats['range'] == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ $stats['range'] == 'week' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="month" {{ $stats['range'] == 'month' ? 'selected' : '' }}>This Month</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Analytics Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-coins text-5xl"></i>
            </div>
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 leading-none">Gross Revenue</p>
            <h4 class="text-2xl font-black text-slate-900 tracking-tighter italic">₹{{ number_format($stats['gross_revenue'], 2) }}</h4>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-user-tie text-5xl text-indigo-600"></i>
            </div>
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 leading-none">Teacher Payouts</p>
            <h4 class="text-2xl font-black text-indigo-600 tracking-tighter italic">₹{{ number_format($stats['teacher_payouts'], 2) }}</h4>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-user-shield text-5xl text-amber-600"></i>
            </div>
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 leading-none">Agent Payouts</p>
            <h4 class="text-2xl font-black text-amber-600 tracking-tighter italic">₹{{ number_format($stats['agent_payouts'], 2) }}</h4>
        </div>

        <div class="bg-slate-900 p-8 rounded-[2.5rem] border border-slate-800 shadow-xl shadow-slate-200 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-vault text-5xl text-emerald-400"></i>
            </div>
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2 leading-none">Net Retained</p>
            <h4 class="text-2xl font-black text-emerald-400 tracking-tighter italic">₹{{ number_format($stats['net_retained'], 2) }}</h4>
        </div>
    </div>

    <!-- Ledger Tabs -->
    <div class="mb-6 flex gap-4 border-b border-slate-200 pb-px">
        <a href="{{ route('admin.finance.ledger', ['tab' => 'revenue', 'range' => $stats['range']]) }}" 
           class="px-6 py-4 text-[10px] font-black uppercase tracking-widest border-b-2 transition-all {{ $stats['active_tab'] === 'revenue' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
            <i class="fas fa-chart-line mr-2"></i> Revenue Distribution
        </a>
        <a href="{{ route('admin.finance.ledger', ['tab' => 'wallet', 'range' => $stats['range']]) }}" 
           class="px-6 py-4 text-[10px] font-black uppercase tracking-widest border-b-2 transition-all {{ $stats['active_tab'] === 'wallet' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
            <i class="fas fa-wallet mr-2"></i> Wallet Logs
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            @if($stats['active_tab'] === 'revenue')
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Student</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Asset</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Recipient</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Gross</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Commission</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Payout</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($data as $commission)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 text-[10px] font-bold text-slate-400 italic">{{ $commission->created_at->format('d M, Y H:i') }}</td>
                                <td class="px-8 py-5">
                                    <p class="text-[10px] font-black text-slate-900 uppercase tracking-tight">{{ $commission->student->name }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest">Student ID: #{{ $commission->student_id }}</p>
                                </td>
                                <td class="px-8 py-5 text-[10px] font-black text-slate-600 italic">
                                    {{ $commission->quizEnrollment ? $commission->quizEnrollment->quiz->title : ($commission->course ? $commission->course->title : 'N/A') }}
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full {{ $commission->type === 'admin' ? 'bg-emerald-500' : ($commission->type === 'teacher' ? 'bg-indigo-500' : 'bg-amber-500') }}"></span>
                                        <p class="text-[10px] font-black text-slate-900 uppercase tracking-tight">{{ $commission->user->name }}</p>
                                    </div>
                                    <p class="text-[8px] font-black uppercase tracking-widest mt-0.5 {{ $commission->type === 'admin' ? 'text-emerald-600' : ($commission->type === 'teacher' ? 'text-indigo-600' : 'text-amber-600') }}">
                                        {{ str_replace('_', ' ', $commission->type) }}
                                    </p>
                                </td>
                                <td class="px-8 py-5 text-[10px] font-bold text-slate-400 leading-none italic">₹{{ number_format($commission->total_amount, 2) }}</td>
                                <td class="px-8 py-5 text-[10px] font-black text-slate-900 leading-none">{{ $commission->commission_percent }}%</td>
                                <td class="px-8 py-5 text-[11px] font-black text-slate-900 leading-none">₹{{ number_format($commission->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-8 py-20 text-center">
                                    <i class="fas fa-inbox text-slate-200 text-5xl mb-4"></i>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No revenue logs discovered</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Target User</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Detail</th>
                            <th class="px-8 py-5 text-[9px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($data as $transaction)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 text-[10px] font-bold text-slate-400 italic font-mono">{{ $transaction->created_at->format('d M, Y H:i') }}</td>
                                <td class="px-8 py-5">
                                    <p class="text-[10px] font-black text-slate-900 uppercase tracking-tight">{{ $transaction->user->name }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest">{{ $transaction->user->role }}</p>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest {{ $transaction->type === 'credit' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                                        {{ $transaction->type }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-[10px] font-bold text-slate-600 italic leading-relaxed max-w-xs">{{ $transaction->description }}</td>
                                <td class="px-8 py-5 text-[11px] font-black {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $transaction->type === 'credit' ? '+' : '-' }} ₹{{ number_format($transaction->amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <i class="fas fa-history text-slate-200 text-5xl mb-4"></i>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No wallet activity detected</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
        
        @if($data->hasPages())
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
