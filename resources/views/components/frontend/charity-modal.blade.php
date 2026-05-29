@props(['siteSettings' => []])
<div x-show="showCharityModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md"
    x-cloak>
    
    <div @click.away="showCharityModal = false"
        class="bg-white w-full max-w-4xl rounded-[2rem] md:rounded-[3rem] p-5 md:p-8 relative max-h-[96vh] overflow-y-auto custom-scrollbar shadow-2xl"
        x-data="{ activeTab: 'account', isSubmitting: false, receiptUrl: null, donationId: null, selectedUpi: '{{ addslashes($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}', selectedUpiApp: 'Default' }"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100">

        <button @click="showCharityModal = false" class="absolute top-4 right-4 md:top-6 md:right-6 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-full w-8 h-8 flex items-center justify-center transition-all z-10">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="mb-4 text-center relative">
            <h3 class="text-2xl md:text-3xl font-black mb-1 leading-tight tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-400">Charity & Donations</h3>
            <p class="text-slate-500 text-xs md:text-sm font-medium">Support our cause and make a difference.</p>
        </div>

        <div x-show="receiptUrl" class="text-center py-10" x-cloak>
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 text-emerald-600">
                <i class="fas fa-check text-4xl"></i>
            </div>
            <h4 class="text-2xl font-bold text-slate-900 mb-2">Thank you for your donation!</h4>
            <p class="text-slate-500 mb-6">Your Donation ID is <span class="font-bold text-slate-900" x-text="donationId"></span></p>
            <a :href="receiptUrl" target="_blank" class="inline-block bg-indigo-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-indigo-700 transition-colors">
                <i class="fas fa-download mr-2"></i> Download Receipt
            </a>
        </div>

        <div x-show="!receiptUrl">
            <!-- Tabs -->
            <div class="flex flex-wrap justify-center gap-2 mb-3 bg-slate-100 p-1 rounded-xl border border-slate-200 w-fit mx-auto">
                <button @click="activeTab = 'account'" :class="{'bg-white text-indigo-600 shadow-sm': activeTab === 'account', 'text-slate-500 hover:text-slate-900 hover:bg-white/50': activeTab !== 'account'}" class="px-4 py-1.5 rounded-lg font-bold text-xs transition-all">Account Transfer</button>
                <button @click="activeTab = 'upi'" :class="{'bg-white text-indigo-600 shadow-sm': activeTab === 'upi', 'text-slate-500 hover:text-slate-900 hover:bg-white/50': activeTab !== 'upi'}" class="px-4 py-1.5 rounded-lg font-bold text-xs transition-all">UPI Payment</button>
                <button @click="activeTab = 'qr'" :class="{'bg-white text-indigo-600 shadow-sm': activeTab === 'qr', 'text-slate-500 hover:text-slate-900 hover:bg-white/50': activeTab !== 'qr'}" class="px-4 py-1.5 rounded-lg font-bold text-xs transition-all">QR Code</button>
            </div>
            
            <div class="text-center mb-4">
                @php
                    $totalRaised = \App\Models\CharityDonation::where('status', 'approved')->sum('amount');
                @endphp
                <div class="inline-block bg-emerald-50 border border-emerald-100 rounded-full px-4 py-1 shadow-sm">
                    <span class="text-emerald-600 font-black text-xs uppercase tracking-widest"><i class="fas fa-chart-line mr-1"></i>₹{{ number_format($totalRaised) }} Raised</span>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-5 items-start">
                
                <!-- Payment Details -->
                <div class="bg-slate-50 p-4 md:p-5 rounded-2xl border border-slate-200 h-full shadow-sm">
                    
                    <!-- Account Transfer -->
                    <div x-show="activeTab === 'account'" class="space-y-2" x-cloak>
                        <h4 class="text-base font-black text-slate-900 mb-2 border-b border-slate-200 pb-2"><i class="fas fa-university text-indigo-600 mr-2"></i> Bank Details</h4>
                        
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500 text-xs font-semibold">Account Holder Name</span>
                            <span class="text-slate-900 font-black text-xs">{{ $siteSettings['charity_account_name'] ?? 'Shaurya Narayan Foundation' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500 text-xs font-semibold">Bank Name</span>
                            <span class="text-slate-900 font-black text-xs">{{ $siteSettings['charity_bank_name'] ?? 'HDFC Bank' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500 text-xs font-semibold">Account Number</span>
                            <span class="text-slate-900 font-black text-xs">{{ $siteSettings['charity_account_number'] ?? '50200012345678' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500 text-xs font-semibold">IFSC Code</span>
                            <span class="text-slate-900 font-black text-xs">{{ $siteSettings['charity_ifsc'] ?? 'HDFC0001234' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-slate-500 text-xs font-semibold">Branch Name</span>
                            <span class="text-slate-900 font-black text-xs">{{ $siteSettings['charity_branch'] ?? 'Cyber City, Gurgaon' }}</span>
                        </div>
                    </div>

                    <!-- UPI -->
                    <div x-show="activeTab === 'upi'" class="space-y-4" x-cloak>
                        <h4 class="text-base font-black text-slate-900 mb-2 border-b border-slate-200 pb-2"><i class="fas fa-mobile-alt text-indigo-600 mr-2"></i> UPI Payment</h4>
                        
                        <div class="text-center p-4 bg-white rounded-xl border border-slate-200 shadow-sm">
                            <p class="text-slate-500 text-sm font-semibold mb-1"><span x-text="selectedUpiApp"></span> UPI ID</p>
                            <p class="text-xl font-black text-indigo-600 tracking-wide" x-text="selectedUpi"></p>
                        </div>

                        <div>
                            <p class="text-slate-500 text-sm mb-3 font-semibold">Pay via UPI Apps (Click to select):</p>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" 
                                    @click="selectedUpi = '{{ addslashes($siteSettings['charity_gpay_upi'] ?? 'helpfund@gpay') }}'; selectedUpiApp = 'GPay'" 
                                    :class="selectedUpiApp === 'GPay' ? 'ring-2 ring-brand-primary scale-105 shadow-lg' : ''"
                                    class="bg-white p-3 rounded-lg flex items-center justify-center gap-2 hover:opacity-80 transition-all focus:outline-none">
                                    <i class="fab fa-google text-red-500"></i> <span class="text-gray-800 font-bold text-sm">GPay</span>
                                </button>
                                <button type="button" 
                                    @click="selectedUpi = '{{ addslashes($siteSettings['charity_phonepe_upi'] ?? 'helpfund@ybl') }}'; selectedUpiApp = 'PhonePe'" 
                                    :class="selectedUpiApp === 'PhonePe' ? 'ring-2 ring-white scale-105 shadow-lg' : ''"
                                    class="bg-purple-600 p-3 rounded-lg flex items-center justify-center gap-2 hover:opacity-80 transition-all focus:outline-none">
                                    <span class="text-white font-bold text-sm">PhonePe</span>
                                </button>
                                <button type="button" 
                                    @click="selectedUpi = '{{ addslashes($siteSettings['charity_paytm_upi'] ?? 'helpfund@paytm') }}'; selectedUpiApp = 'Paytm'" 
                                    :class="selectedUpiApp === 'Paytm' ? 'ring-2 ring-white scale-105 shadow-lg' : ''"
                                    class="bg-blue-500 p-3 rounded-lg flex items-center justify-center gap-2 hover:opacity-80 transition-all focus:outline-none">
                                    <span class="text-white font-bold text-sm">Paytm</span>
                                </button>
                                <button type="button" 
                                    @click="selectedUpi = '{{ addslashes($siteSettings['charity_bhim_upi'] ?? 'helpfund@upi') }}'; selectedUpiApp = 'BHIM'" 
                                    :class="selectedUpiApp === 'BHIM' ? 'ring-2 ring-white scale-105 shadow-lg' : ''"
                                    class="bg-orange-500 p-3 rounded-lg flex items-center justify-center gap-2 hover:opacity-80 transition-all focus:outline-none">
                                    <span class="text-white font-bold text-sm">BHIM</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div x-show="activeTab === 'qr'" class="space-y-2 text-center" x-cloak>
                        <h4 class="text-base font-black text-slate-900 mb-2 border-b border-slate-200 pb-2"><i class="fas fa-qrcode text-indigo-600 mr-2"></i> Scan & Pay</h4>
                        
                        <div class="bg-white p-3 rounded-xl inline-block mx-auto mt-2 border border-slate-200 shadow-sm">
                            @if(isset($siteSettings['charity_qr_code']) && $siteSettings['charity_qr_code'])
                                <img src="{{ asset('storage/' . $siteSettings['charity_qr_code']) }}" alt="QR Code" class="w-32 h-32 object-contain">
                            @else
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa={{ urlencode($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}&pn={{ urlencode($siteSettings['charity_account_name'] ?? 'Shaurya Foundation') }}" alt="QR Code" class="w-32 h-32">
                            @endif
                        </div>
                        <p class="text-slate-500 text-sm mt-4 font-semibold">Scan using any UPI enabled app</p>
                        @if(isset($siteSettings['charity_qr_code']) && $siteSettings['charity_qr_code'])
                            <a href="{{ asset('storage/' . $siteSettings['charity_qr_code']) }}" download class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 transition-colors text-sm font-black uppercase tracking-widest">
                                <i class="fas fa-download mr-1"></i> Download QR Code
                            </a>
                        @else
                            <a href="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa={{ urlencode($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}&pn={{ urlencode($siteSettings['charity_account_name'] ?? 'Shaurya Foundation') }}" download class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 transition-colors text-sm font-black uppercase tracking-widest">
                                <i class="fas fa-download mr-1"></i> Download QR Code
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Submit Details Form -->
                <div class="pb-2">
                    <h4 class="text-base font-black text-slate-900 mb-3 uppercase tracking-widest">Submit Donation Details</h4>
                    <form @submit.prevent="
                        isSubmitting = true;
                        fetch('{{ route('charity.donate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name: $event.target.name.value,
                                email: $event.target.email.value,
                                amount: $event.target.amount.value,
                                transaction_id: $event.target.transaction_id.value,
                                payment_method: activeTab === 'account' ? 'bank_transfer' : (activeTab === 'upi' ? 'upi' : 'qr_code')
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            isSubmitting = false;
                            if(data.success) {
                                receiptUrl = data.receipt_url;
                                donationId = data.donation_id;
                            } else {
                                alert('An error occurred. Please check your inputs.');
                            }
                        })
                        .catch(err => {
                            isSubmitting = false;
                            alert('An error occurred while submitting.');
                        })
                    " class="space-y-3">
                        <div>
                            <label class="block text-slate-700 text-[10px] font-black uppercase tracking-widest mb-1">Full Name</label>
                            <input type="text" name="name" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-slate-900 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm">
                        </div>
                        <div>
                            <label class="block text-slate-700 text-[10px] font-black uppercase tracking-widest mb-1">Email Address <span class="font-bold text-[9px] text-slate-400 ml-1">(For Receipt)</span></label>
                            <input type="email" name="email" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-slate-900 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm">
                        </div>
                        <div>
                            <label class="block text-slate-700 text-[10px] font-black uppercase tracking-widest mb-1">Donation Amount (₹)</label>
                            <input type="number" name="amount" min="1" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-slate-900 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm">
                        </div>
                        <div>
                            <label class="block text-slate-700 text-[10px] font-black uppercase tracking-widest mb-1">Transaction ID / UTR No.</label>
                            <input type="text" name="transaction_id" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-slate-900 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm placeholder-slate-300" placeholder="e.g. 123456789012">
                        </div>
                        <div class="pt-2">
                            <button type="submit" :disabled="isSubmitting" class="w-full bg-indigo-600 text-white font-black uppercase tracking-[0.2em] py-3 rounded-xl text-xs shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 active:scale-95 transition-all disabled:opacity-50">
                                <span x-show="!isSubmitting"><i class="fas fa-paper-plane mr-2"></i> Submit & Get Receipt</span>
                                <span x-show="isSubmitting"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
