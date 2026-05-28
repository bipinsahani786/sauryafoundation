<x-dashboard.layout title="Charity Funds">
    
    <!-- Charity Payment Settings -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 overflow-hidden" x-data="{ openSettings: false }">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50 cursor-pointer" @click="openSettings = !openSettings">
            <div>
                <h2 class="text-lg font-bold text-slate-800"><i class="fas fa-cog text-slate-400 mr-2"></i>Charity Payment Settings</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Configure Bank details, UPI IDs, and QR code for frontend charity modal.</p>
            </div>
            <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                <i class="fas" :class="openSettings ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
            </button>
        </div>
        
        <div x-show="openSettings" x-cloak class="p-6" x-transition>
            <form action="{{ route('admin.charity.settings') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Bank Details -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold text-slate-800 border-b pb-2"><i class="fas fa-university text-indigo-500 mr-2"></i>Bank Details</h4>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Account Holder Name</label>
                            <input type="text" name="charity_account_name" value="{{ $siteSettings['charity_account_name'] ?? 'Shaurya Narayan Foundation' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Bank Name</label>
                            <input type="text" name="charity_bank_name" value="{{ $siteSettings['charity_bank_name'] ?? 'HDFC Bank' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Account Number</label>
                            <input type="text" name="charity_account_number" value="{{ $siteSettings['charity_account_number'] ?? '50200012345678' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">IFSC Code</label>
                                <input type="text" name="charity_ifsc" value="{{ $siteSettings['charity_ifsc'] ?? 'HDFC0001234' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Branch Name</label>
                                <input type="text" name="charity_branch" value="{{ $siteSettings['charity_branch'] ?? 'Cyber City, Gurgaon' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                    </div>

                    <!-- UPI & QR Code -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold text-slate-800 border-b pb-2"><i class="fas fa-qrcode text-indigo-500 mr-2"></i>UPI & QR Code</h4>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Primary/Default UPI ID (For QR)</label>
                            <input type="text" name="charity_upi_id" value="{{ $siteSettings['charity_upi_id'] ?? 'helpfund@upi' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">GPay UPI ID</label>
                                <input type="text" name="charity_gpay_upi" value="{{ $siteSettings['charity_gpay_upi'] ?? 'helpfund@gpay' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">PhonePe UPI ID</label>
                                <input type="text" name="charity_phonepe_upi" value="{{ $siteSettings['charity_phonepe_upi'] ?? 'helpfund@ybl' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Paytm UPI ID</label>
                                <input type="text" name="charity_paytm_upi" value="{{ $siteSettings['charity_paytm_upi'] ?? 'helpfund@paytm' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">BHIM UPI ID</label>
                                <input type="text" name="charity_bhim_upi" value="{{ $siteSettings['charity_bhim_upi'] ?? 'helpfund@upi' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Upload QR Code Image</label>
                            <input type="file" name="charity_qr_code" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
                            @if(isset($siteSettings['charity_qr_code']))
                                <div class="mt-2">
                                    <p class="text-xs text-slate-400 mb-1">Current QR Code:</p>
                                    <img src="{{ asset('storage/' . $siteSettings['charity_qr_code']) }}" alt="QR Code" class="h-20 border rounded shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-indigo-700 transition-colors shadow-sm">
                        <i class="fas fa-save mr-2"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                    <i class="fas fa-hand-holding-heart text-xl"></i>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Raised</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">₹{{ number_format($totalRaised) }}</h3>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Approved</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $donations->where('status', 'approved')->count() }}</h3>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Pending</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $donations->where('status', 'pending')->count() }}</h3>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h2 class="text-lg font-bold text-slate-800">All Donations</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Manage and verify incoming charity funds</p>
            </div>
        </div>
        
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left table-standard">
                <thead>
                    <tr>
                        <th>Date & ID</th>
                        <th>Donor Details</th>
                        <th>Payment Info</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($donations as $donation)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td>
                                <div class="font-bold text-slate-800">{{ $donation->created_at->format('d M, Y') }}</div>
                                <div class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">{{ $donation->donation_id }}</div>
                            </td>
                            <td>
                                <div class="font-bold text-slate-800">{{ $donation->name }}</div>
                                <div class="text-xs text-slate-500">{{ $donation->email }}</div>
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ strtoupper(str_replace('_', ' ', $donation->payment_method)) }}</div>
                                <div class="text-xs text-slate-500 break-all">Txn: {{ $donation->transaction_id }}</div>
                            </td>
                            <td>
                                <div class="font-black text-indigo-600">₹{{ number_format($donation->amount) }}</div>
                            </td>
                            <td>
                                @if($donation->status === 'approved')
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-md text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Approved</span>
                                @elseif($donation->status === 'rejected')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-md text-[10px] font-bold uppercase tracking-wider border border-red-200">Rejected</span>
                                @else
                                    <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-md text-[10px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($donation->status === 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('admin.charity.update', $donation->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 rounded-lg transition-colors tooltip" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.charity.update', $donation->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors tooltip" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Verified</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-2xl">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <p class="text-slate-500 font-medium">No donations found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($donations->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $donations->links() }}
            </div>
        @endif
    </div>

</x-dashboard.layout>
