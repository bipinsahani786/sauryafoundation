<x-dashboard.layout>
    <x-slot name="title">Enrolled Coaching Centers</x-slot>

    <div x-data="{ open: false }">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em] mb-1">Enrolled coaching Centers</h2>
                <p class="text-xs text-slate-400 font-medium italic">Manage the list of coaching centers you've enrolled.</p>
            </div>
            <button @click="open = true" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
                <i class="fas fa-plus mr-1"></i> Enroll New Coaching
            </button>
        </div>

        <!-- Enrollment Modal -->
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
            <div @click.away="open = false" class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-slate-200">
                <div class="mb-6 flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Enroll Coaching</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">New Merchant Access</p>
                    </div>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
                </div>

                <form action="{{ route('sales-agent.merchants.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Merchant Name</label>
                        <input type="text" name="name" placeholder="John Doe" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Coaching Name</label>
                        <input type="text" name="coaching_or_school" placeholder="ABC Coaching Center" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Mobile Number</label>
                            <input type="text" name="mobile_number" placeholder="9876543210" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Village / Address</label>
                            <input type="text" name="address" placeholder="Village Name or Address" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Block</label>
                            <input type="text" name="block" placeholder="Block Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">District</label>
                            <input type="text" name="district" placeholder="District Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">State</label>
                            <input type="text" name="state" placeholder="State Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Merchant Email</label>
                        <input type="email" name="email" placeholder="merchant@coaching.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-3">Create Password</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3 text-sm focus:border-indigo-600 outline-none transition-all" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                            Enroll Merchant <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="font-black text-slate-900 uppercase tracking-widest text-sm">Enrolled Coachings</h3>
            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-[10px] font-bold uppercase">{{ $merchants->total() }} Total</span>
        </div>
        
        <div class="divide-y divide-slate-100">
            @forelse($merchants as $merchant)
                <div x-data="{ open: false }" class="p-0">
                    <div @click="open = !open" class="p-4 flex items-center justify-between hover:bg-slate-50 cursor-pointer transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black">
                                {{ substr($merchant->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $merchant->name }}</h4>
                                <p class="text-[10px] text-slate-500">{{ $merchant->coaching_or_school ?? 'N/A' }} &bull; {{ $merchant->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->agent_permissions === null || !empty($permissions['view_students']))
                                <span class="text-xs font-bold text-slate-600"><i class="fas fa-user-graduate text-emerald-500 mr-1"></i> {{ $merchant->students->count() }} Students</span>
                            @endif
                            <i class="fas fa-chevron-down text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </div>
                    </div>
                    
                    <div x-show="open" x-collapse class="bg-slate-50 border-t border-slate-100 p-4">
                        @if(auth()->user()->agent_permissions === null || !empty($permissions['view_students']))
                            @if($merchant->students->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($merchant->students as $student)
                                        <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3 hover:shadow-md transition-all cursor-default">
                                            <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-slate-800 text-xs truncate">{{ $student->name }}</p>
                                                <p class="text-[10px] text-slate-500 truncate">{{ $student->studentClass->name ?? 'No Class' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-slate-400 italic text-center py-4">No students enrolled under this coaching yet.</p>
                            @endif
                        @else
                            <div class="p-6 text-center">
                                <i class="fas fa-lock text-slate-300 text-3xl mb-3"></i>
                                <h3 class="text-slate-500 font-bold text-sm">Students Hidden</h3>
                                <p class="text-xs text-slate-400 mt-1">You do not have permission to view the students for this coaching center.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3 class="text-slate-500 font-bold">No Coachings Enrolled</h3>
                    <p class="text-xs text-slate-400 mt-1">You have not enrolled any coachings yet.</p>
                </div>
            @endforelse
        </div>
        
        @if($merchants->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 italic font-medium">
                {{ $merchants->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
