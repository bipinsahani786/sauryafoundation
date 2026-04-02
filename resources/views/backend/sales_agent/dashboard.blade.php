<x-dashboard.layout>
    <x-slot name="title">Sales Agent Dashboard</x-slot>

    <div class="mb-4">
        <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600">Here's your enrollment performance overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-school text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Enrolled Coaching</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $stats['total_merchants'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Wallet Balance</p>
                    <h3 class="text-2xl font-black text-slate-900">₹{{ number_format($stats['wallet_balance'], 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Growth Rate</p>
                    <h3 class="text-2xl font-black text-slate-900">+{{ $stats['total_merchants'] > 0 ? '10' : '0' }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs">Recent Transactions</h3>
            <a href="{{ route('sales-agent.wallet') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Date</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Description</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Type</th>
                        <th class="px-6 py-4 uppercase font-bold text-slate-500 tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($stats['recent_transactions'] as $transaction)
                        <tr>
                            <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ $transaction->description }}</td>
                            <td class="px-6 py-4 uppercase font-bold {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-red-500' }}">{{ $transaction->type }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900">₹{{ number_format($transaction->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">No recent transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.layout>
