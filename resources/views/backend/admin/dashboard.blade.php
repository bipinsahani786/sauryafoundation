<x-dashboard.layout>
    <x-slot name="title">Superadmin Analytics</x-slot>

    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Platform Analytics</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Real-time performance overview</p>
        </div>
        <div class="flex items-center gap-2 bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
            @foreach(['all' => 'All Time', 'today' => 'Today', 'week' => '7 Days', 'month' => 'This Month'] as $key => $label)
                <a href="{{ route('admin.dashboard', ['range' => $key]) }}" 
                   class="px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all {{ ($stats['range'] ?? 'all') == $key ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-500 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 border border-emerald-100"><i class="fas fa-wallet text-sm"></i></div>
                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-tighter bg-emerald-50 px-2 py-0.5 rounded-full">+{{ number_format(($stats['total_revenue'] > 0 ? 100 : 0), 0) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Revenue</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">₹{{ number_format($stats['total_revenue'], 2) }}</h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50/50 rounded-full blur-2xl group-hover:scale-125 transition-transform"></div>
        </div>

        <!-- Profit -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100"><i class="fas fa-chart-line text-sm"></i></div>
                    <span class="text-[9px] font-black text-indigo-600 uppercase tracking-tighter bg-indigo-50 px-2 py-0.5 rounded-full">Net Profit</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Platform Payout</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">₹{{ number_format($stats['net_profit'], 2) }}</h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-50/50 rounded-full blur-2xl group-hover:scale-125 transition-transform"></div>
        </div>

        <!-- Active Users -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 border border-amber-100"><i class="fas fa-users text-sm"></i></div>
                    <span class="text-[9px] font-black text-amber-600 uppercase tracking-tighter bg-amber-50 px-2 py-0.5 rounded-full">{{ $stats['students'] + $stats['teachers'] }} Total</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Learners</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">{{ number_format($stats['students']) }}</h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50/50 rounded-full blur-2xl group-hover:scale-125 transition-transform"></div>
        </div>

        <!-- Pending Actions -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 border border-rose-100"><i class="fas fa-bell text-sm"></i></div>
                    <span class="text-[9px] font-black text-rose-600 uppercase tracking-tighter bg-rose-50 px-2 py-0.5 rounded-full">Urgent</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Payouts</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">₹{{ number_format($stats['pending_payouts'], 0) }}</h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-50/50 rounded-full blur-2xl group-hover:scale-125 transition-transform"></div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest">Revenue Growth (Last 30 Days)</h4>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-indigo-600"></span><span class="text-[9px] font-bold text-slate-400 uppercase">Daily Earnings</span></div>
                </div>
            </div>
            <div class="h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- User Mix -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-8">Role Distribution</h4>
            <div class="flex-1 flex items-center justify-center relative">
                <canvas id="userMixChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-xl font-black text-slate-900">{{ array_sum($stats['user_mix']) }}</span>
                    <span class="text-[8px] font-black text-slate-400 uppercase">Users</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <div class="space-y-1">
                    <p class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Teachers</p>
                    <p class="text-sm font-black text-slate-900">{{ $stats['teachers'] }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Agents</p>
                    <p class="text-sm font-black text-slate-900">{{ $stats['agents'] }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Students</p>
                    <p class="text-sm font-black text-slate-900">{{ $stats['students'] }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span> Members</p>
                    <p class="text-sm font-black text-slate-900">{{ $stats['members'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Transaction Ledger -->
        <div class="lg:col-span-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <div>
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest">Global Money Ledger</h4>
                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">Last 10 platform transactions</p>
                </div>
                <a href="#" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:underline italic">Full History</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">User</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-right">Amount</th>
                            <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentTransactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-900 shadow-inner">
                                        {{ substr($tx->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-black text-slate-900 uppercase leading-none">{{ $tx->user->name }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">{{ $tx->user->role }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-tighter">{{ str_replace('_', ' ', $tx->type) }}</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <span class="text-[11px] font-black {{ $tx->amount > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $tx->amount > 0 ? '+' : '' }}₹{{ number_format(abs($tx->amount), 2) }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[8px] font-black uppercase shadow-sm border border-emerald-100">Success</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-8 py-10 text-center text-slate-400 text-xs italic">No transactions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity/Leads -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Recent Leads -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest">New Leads</h4>
                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full border border-indigo-100">{{ $recentleads->count() }} New</span>
                </div>
                <div class="space-y-6">
                    @foreach($recentleads as $lead)
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-2xl bg-slate-50 group-hover:bg-indigo-50 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 transition-colors border border-slate-100 shadow-sm">
                            <i class="fas fa-user-plus text-xs"></i>
                        </div>
                        <div class="min-w-0 border-b border-slate-50 pb-4 flex-1">
                            <p class="text-[11px] font-black text-slate-900 uppercase leading-none">{{ $lead->name }}</p>
                            <p class="text-[9px] text-slate-400 font-bold uppercase mt-1 truncate italic">Looking for: {{ $lead->sector ?? 'Academy' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.applications') }}" class="block text-center mt-6 py-3 bg-slate-50 rounded-2xl text-[9px] font-black text-slate-500 uppercase tracking-widest hover:bg-slate-100 transition-all">View All Applications</a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl shadow-indigo-200 overflow-hidden relative group">
                <div class="relative z-10">
                    <h4 class="text-xs font-black text-white uppercase tracking-widest mb-6">Quick Actions</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-white/10 hover:bg-white/20 rounded-2xl border border-white/10 transition-all text-white backdrop-blur-sm shadow-inner group">
                            <i class="fas fa-user-plus text-lg translate-y-1 group-hover:translate-y-0 transition-transform"></i>
                            <span class="text-[8px] font-black uppercase tracking-tighter">Add User</span>
                        </a>
                        <a href="{{ route('admin.wallet.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-white/10 hover:bg-white/20 rounded-2xl border border-white/10 transition-all text-white backdrop-blur-sm shadow-inner group">
                            <i class="fas fa-money-check-alt text-lg translate-y-1 group-hover:translate-y-0 transition-transform"></i>
                            <span class="text-[8px] font-black uppercase tracking-tighter">Manual Pay</span>
                        </a>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full blur-2xl transition-all group-hover:scale-150"></div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Set globally for fonts/styles
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#94a3b8';

        // Revenue Trend Chart
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: @json($stats['chart_labels']),
                datasets: [{
                    label: 'Earnings',
                    data: @json($stats['chart_data']),
                    borderColor: '#4f46e5',
                    borderWidth: 4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#4f46e5',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3,
                    fill: true,
                    backgroundColor: (context) => {
                        const gradient = ctxRevenue.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.1)');
                        gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');
                        return gradient;
                    },
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 9, weight: 'bold' } } },
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#f1f5f9' },
                        ticks: { font: { size: 9, weight: 'bold' }, callback: (value) => '₹' + value }
                    }
                }
            }
        });

        // User Mix Chart
        const ctxMix = document.getElementById('userMixChart').getContext('2d');
        new Chart(ctxMix, {
            type: 'doughnut',
            data: {
                labels: ['Teachers', 'Agents', 'Students', 'Members'],
                datasets: [{
                    data: @json($stats['user_mix']),
                    backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#e2e8f0'],
                    borderWidth: 0,
                    cutout: '85%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    </script>
</x-dashboard.layout>
