<x-dashboard.layout>
    <x-slot name="title">Request Wallet Top-up</x-slot>

    <div class="mb-10 text-center max-w-2xl mx-auto">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase italic">Wallet Recharge</h2>
        <p class="text-xs text-slate-400 font-bold italic uppercase tracking-widest mt-1">Transfer funds to the admin account below and submit your request for wallet credit.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">
        <!-- Admin Payment Details -->
        <div class="space-y-8">
            <div class="bg-indigo-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-indigo-400"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 italic">Official Bank Details</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center border-b border-indigo-800 pb-4">
                            <span class="text-[9px] font-black uppercase tracking-widest text-indigo-300">Bank Name</span>
                            <span class="font-black text-sm tracking-tight capitalize">{{ $settings['admin_bank_name'] ?? 'Not Configured' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-indigo-800 pb-4">
                            <span class="text-[9px] font-black uppercase tracking-widest text-indigo-300">Account No</span>
                            <span class="font-black text-sm tracking-widest select-all">{{ $settings['admin_account_no'] ?? 'Not Configured' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-indigo-800 pb-4">
                            <span class="text-[9px] font-black uppercase tracking-widest text-indigo-300">IFSC Code</span>
                            <span class="font-black text-sm tracking-widest text-indigo-100 uppercase select-all">{{ $settings['admin_ifsc_code'] ?? 'Not Configured' }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-indigo-800/50 p-4 rounded-2xl">
                            <span class="text-[9px] font-black uppercase tracking-widest text-indigo-300">UPI / GPay ID</span>
                            <span class="font-black text-xs tracking-widest text-white select-all">{{ $settings['admin_upi_id'] ?? 'Not Configured' }}</span>
                        </div>
                    </div>
                </div>
                <i class="fas fa-university absolute -right-8 -bottom-8 text-[12rem] opacity-5 pointer-events-none"></i>
            </div>

            @if(isset($settings['admin_qr_code']))
            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm text-center">
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic mb-6">Scan to Pay Directly</h3>
                <div class="bg-slate-50 p-6 rounded-3xl inline-block border border-slate-100 shadow-inner">
                    <img src="{{ asset('storage/' . $settings['admin_qr_code']) }}" class="h-48 w-48 object-contain">
                </div>
                <p class="text-[9px] font-black text-slate-400 mt-6 uppercase tracking-widest">Supports all BHIM UPI Apps</p>
            </div>
            @endif
        </div>

        <!-- Request Submission Form -->
        <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-1 rounded-full bg-emerald-500"></div>
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Submission Protocol</h3>
            </div>

            <form action="{{ route('teacher.wallet.topup.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-3">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Exact Amount Paid (₹)</label>
                    <div class="relative group">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-black text-lg">₹</span>
                        <input type="number" name="amount" step="1" min="1" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-12 py-5 text-xl font-black focus:border-emerald-500 focus:bg-white outline-none transition-all placeholder:text-slate-200" required>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">UTR / Transaction ID</label>
                    <div class="relative group">
                        <i class="fas fa-barcode absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <input type="text" name="utr_number" placeholder="Enter Unique Transaction Reference" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all" required>
                    </div>
                </div>

                <div class="space-y-3" x-data="{ proofPreview: null }">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Payment Proof (Screenshot)</label>
                    <div class="relative group">
                        <input type="file" name="proof_image" @change="let reader = new FileReader(); reader.onload = (e) => { proofPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center group-hover:border-emerald-500 transition-all">
                            <template x-if="proofPreview">
                                <img :src="proofPreview" class="h-24 mx-auto mb-2 object-contain rounded-lg">
                            </template>
                            <template x-if="!proofPreview">
                                <i class="fas fa-cloud-upload-alt text-2xl text-slate-300 mb-2"></i>
                            </template>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest" x-text="proofPreview ? 'Proof selected' : 'Upload transaction screenshot'"></p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-emerald-600 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.3em] hover:bg-slate-900 transition-all shadow-xl shadow-emerald-100 active:scale-95 border-b-4 border-emerald-800 active:border-b-0 active:translate-y-1">
                        Transmit Request <i class="fas fa-paper-plane ml-2 text-[8px]"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
