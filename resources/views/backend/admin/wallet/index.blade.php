<x-dashboard.layout title="My Wallet & Transactions">
    <div x-data="{ 
        showModal: {{ request()->has('user_id') ? 'true' : 'false' }},
        userId: '{{ request()->get('user_id', '') }}',
        userName: '{{ request()->get('user_name', '') }}',
        amount: '',
        type: 'credit',
        description: '',
        users: [],
        search: '',
        loading: false,

        searchUsers() {
            if (this.search.length < 2) {
                this.users = [];
                return;
            }
            this.loading = true;
            fetch(`{{ route('admin.wallet.search-users') }}?q=${this.search}`)
                .then(res => res.json())
                .then(data => {
                    this.users = data;
                    this.loading = false;
                });
        },
        selectUser(user) {
            this.userId = user.id;
            this.userName = user.name;
            this.users = [];
            this.search = '';
        }
    }">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Balance Card -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-wallet text-6xl text-indigo-600"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Total Balance</p>
                <h3 class="text-4xl font-black text-slate-900 leading-none mb-4">₹{{ number_format($user->wallet_balance, 2) }}</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600 italic">Account Active</span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="md:col-span-2 bg-indigo-600 rounded-3xl p-8 shadow-lg shadow-indigo-100 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 opacity-10 transform -rotate-12">
                    <i class="fas fa-coins text-[12rem] text-white"></i>
                </div>
                <div class="relative z-10">
                    <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-2">Wallet Management</h4>
                    <p class="text-indigo-100 text-[10px] font-bold uppercase tracking-widest leading-loose mb-6 opacity-80">Add or deduct funds from your account or any user's account manually with clear audit logs and remarks.</p>
                    <button @click="showModal = true" class="bg-white text-indigo-600 px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-slate-50 transition-all shadow-xl shadow-indigo-900/20 active:scale-95">
                        <i class="fas fa-plus-circle mr-2"></i> Manual Credit / Debit
                    </button>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-900">Transaction History</h4>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Showing your personal transaction logs</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Filters:</span>
                    <button class="px-4 py-1.5 rounded-full bg-white border border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition-all">Latest</button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Date</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Reference</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Description</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Amount</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="text-[10px] font-black text-slate-900 block">{{ $tx->created_at->format('d M, Y') }}</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter">{{ $tx->created_at->format('h:i A') }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-lg bg-slate-100 text-[8px] font-bold text-slate-600 uppercase tracking-widest border border-slate-200">#TXN-{{ str_pad($tx->id, 6, '0', STR_PAD_LEFT) }}</span>
                                <div class="mt-1 text-[8px] font-black uppercase tracking-widest text-slate-400">{{ $tx->source_type ?? 'Generic' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-[10px] font-black text-slate-700 leading-relaxed max-w-xs">{{ $tx->description ?? 'No remarks provided' }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs font-black {{ $tx->type === 'credit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $tx->type === 'credit' ? '+' : '-' }} ₹{{ number_format($tx->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $tx->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                    {{ $tx->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <i class="fas fa-receipt text-6xl mb-4"></i>
                                    <p class="text-[10px] font-black uppercase tracking-widest">No transactions found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
            <div class="px-8 py-6 border-t border-slate-100 bg-slate-50/50">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>

        <!-- Add Money Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showModal = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden border border-white/20">
                <div class="p-8 pb-0">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Manual Adjustment</h4>
                        <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>

                    <form action="{{ route('admin.wallet.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="user_id" :value="userId">
                        
                        <!-- User Selection -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Target User</label>
                            <div class="relative">
                                <template x-if="userName">
                                    <div class="w-full px-5 py-4 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-between">
                                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest" x-text="userName"></span>
                                        <button @click="userName = ''; userId = ''; search = ''" type="button" class="text-indigo-400 hover:text-indigo-600">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!userName">
                                    <div class="relative">
                                        <input type="text" x-model="search" @input.debounce.300ms="searchUsers()" placeholder="Search user by name or email..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-0 focus:ring-2 focus:ring-indigo-600 font-bold text-[11px] placeholder:text-slate-300 transition-all uppercase tracking-widest">
                                        <div x-show="loading" class="absolute right-4 top-1/2 -translate-y-1/2">
                                            <i class="fas fa-circle-notch fa-spin text-indigo-600"></i>
                                        </div>
                                        <div x-show="users.length > 0" class="absolute left-0 right-0 mt-2 bg-white rounded-2xl border border-slate-100 shadow-xl z-20 overflow-hidden max-h-48 overflow-y-auto custom-scrollbar">
                                            <template x-for="u in users" :key="u.id">
                                                <button @click="selectUser(u)" type="button" class="w-full px-5 py-3 text-left hover:bg-slate-50 flex flex-col transition-colors border-b border-slate-50 last:border-0">
                                                    <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest" x-text="u.name"></span>
                                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter" x-text="u.email"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Adjustment Type -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Type</label>
                                <select name="type" x-model="type" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-0 focus:ring-2 focus:ring-indigo-600 font-black text-[10px] uppercase tracking-widest transition-all">
                                    <option value="credit">Credit (+)</option>
                                    <option value="debit">Debit (-)</option>
                                </select>
                            </div>

                            <!-- Amount -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Amount (₹)</label>
                                <input type="number" name="amount" x-model="amount" step="0.01" min="0.01" required placeholder="0.00" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-0 focus:ring-2 focus:ring-indigo-600 font-black text-[10px] transition-all">
                            </div>
                        </div>

                        <!-- Description/Remarks -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Description / Remarks</label>
                            <textarea name="description" x-model="description" required placeholder="Add internal remarks about this adjustment..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-0 focus:ring-2 focus:ring-indigo-600 font-bold text-[10px] placeholder:text-slate-300 transition-all uppercase tracking-widest h-24 resize-none"></textarea>
                        </div>

                        <div class="py-8">
                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 group active:scale-[0.98]">
                                Confirm Adjustment 
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
