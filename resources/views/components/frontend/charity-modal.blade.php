@props(['siteSettings' => []])
<div x-show="showCharityModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-brand-dark/90 backdrop-blur-sm"
    x-cloak>
    
    <div @click.away="showCharityModal = false"
        class="glass-card w-full max-w-4xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-12 relative max-h-[96vh] overflow-y-auto custom-scrollbar"
        x-data="{ activeTab: 'account', isSubmitting: false, receiptUrl: null, donationId: null, selectedUpi: '{{ addslashes($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}', selectedUpiApp: 'Default' }"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100">

        <button @click="showCharityModal = false" class="absolute top-6 right-6 md:top-8 md:right-8 text-gray-500 hover:text-white transition-colors z-10">
            <i class="fas fa-times text-xl md:text-2xl"></i>
        </button>

        <div class="mb-8 md:mb-10 text-center relative">
            <h3 class="text-3xl md:text-4xl font-black text-white mb-2 leading-tight tracking-tight text-gradient">Charity & Donations</h3>
            <p class="text-gray-400 text-sm md:text-base font-medium">Support our cause and make a difference.</p>
            
            <div class="mt-6 inline-block bg-brand-card border border-brand-border rounded-full px-6 py-2 shadow-lg">
                @php
                    $totalRaised = \App\Models\CharityDonation::where('status', 'approved')->sum('amount');
                @endphp
                <span class="text-brand-accent font-bold"><i class="fas fa-chart-line mr-2"></i>₹{{ number_format($totalRaised) }} Raised</span>
            </div>
        </div>

        <div x-show="receiptUrl" class="text-center py-10" x-cloak>
            <div class="w-20 h-20 bg-brand-accent/20 rounded-full flex items-center justify-center mx-auto mb-6 text-brand-accent">
                <i class="fas fa-check text-4xl"></i>
            </div>
            <h4 class="text-2xl font-bold text-white mb-2">Thank you for your donation!</h4>
            <p class="text-gray-400 mb-6">Your Donation ID is <span class="font-bold text-white" x-text="donationId"></span></p>
            <a :href="receiptUrl" target="_blank" class="inline-block bg-brand-primary text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-brand-primary/80 transition-colors">
                <i class="fas fa-download mr-2"></i> Download Receipt
            </a>
        </div>

        <div x-show="!receiptUrl">
            <!-- Tabs -->
            <div class="flex flex-wrap justify-center gap-2 mb-8 bg-brand-card p-1 rounded-xl border border-brand-border w-fit mx-auto">
                <button @click="activeTab = 'account'" :class="{'bg-brand-primary text-white': activeTab === 'account', 'text-gray-400 hover:text-white': activeTab !== 'account'}" class="px-6 py-2 rounded-lg font-bold text-sm transition-all">Account Transfer</button>
                <button @click="activeTab = 'upi'" :class="{'bg-brand-primary text-white': activeTab === 'upi', 'text-gray-400 hover:text-white': activeTab !== 'upi'}" class="px-6 py-2 rounded-lg font-bold text-sm transition-all">UPI Payment</button>
                <button @click="activeTab = 'qr'" :class="{'bg-brand-primary text-white': activeTab === 'qr', 'text-gray-400 hover:text-white': activeTab !== 'qr'}" class="px-6 py-2 rounded-lg font-bold text-sm transition-all">QR Code</button>
            </div>

            <!-- Tab Content -->
            <div class="grid md:grid-cols-2 gap-10 items-start">
                
                <!-- Payment Details -->
                <div class="bg-brand-dark/50 p-6 rounded-2xl border border-brand-border h-full">
                    
                    <!-- Account Transfer -->
                    <div x-show="activeTab === 'account'" class="space-y-4" x-cloak>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-brand-border pb-2"><i class="fas fa-university text-brand-primary mr-2"></i> Bank Details</h4>
                        
                        <div class="flex justify-between items-center py-2 border-b border-brand-border/50">
                            <span class="text-gray-400 text-sm">Account Holder Name</span>
                            <span class="text-white font-bold">{{ $siteSettings['charity_account_name'] ?? 'Shaurya Narayan Foundation' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-brand-border/50">
                            <span class="text-gray-400 text-sm">Bank Name</span>
                            <span class="text-white font-bold">{{ $siteSettings['charity_bank_name'] ?? 'HDFC Bank' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-brand-border/50">
                            <span class="text-gray-400 text-sm">Account Number</span>
                            <span class="text-white font-bold">{{ $siteSettings['charity_account_number'] ?? '50200012345678' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-brand-border/50">
                            <span class="text-gray-400 text-sm">IFSC Code</span>
                            <span class="text-white font-bold">{{ $siteSettings['charity_ifsc'] ?? 'HDFC0001234' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-400 text-sm">Branch Name</span>
                            <span class="text-white font-bold">{{ $siteSettings['charity_branch'] ?? 'Cyber City, Gurgaon' }}</span>
                        </div>
                    </div>

                    <!-- UPI -->
                    <div x-show="activeTab === 'upi'" class="space-y-6" x-cloak>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-brand-border pb-2"><i class="fas fa-mobile-alt text-brand-primary mr-2"></i> UPI Payment</h4>
                        
                        <div class="text-center p-4 bg-brand-card rounded-xl border border-brand-border">
                            <p class="text-gray-400 text-sm mb-1"><span x-text="selectedUpiApp"></span> UPI ID</p>
                            <p class="text-2xl font-black text-brand-primary tracking-wide" x-text="selectedUpi"></p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-sm mb-3">Pay via UPI Apps (Click to select):</p>
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
                    <div x-show="activeTab === 'qr'" class="space-y-4 text-center" x-cloak>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-brand-border pb-2"><i class="fas fa-qrcode text-brand-primary mr-2"></i> Scan & Pay</h4>
                        
                        <div class="bg-white p-4 rounded-xl inline-block mx-auto mt-4">
                            @if(isset($siteSettings['charity_qr_code']) && $siteSettings['charity_qr_code'])
                                <img src="{{ asset('storage/' . $siteSettings['charity_qr_code']) }}" alt="QR Code" class="w-48 h-48 object-contain">
                            @else
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa={{ urlencode($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}&pn={{ urlencode($siteSettings['charity_account_name'] ?? 'Shaurya Foundation') }}" alt="QR Code" class="w-48 h-48">
                            @endif
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Scan using any UPI enabled app</p>
                        @if(isset($siteSettings['charity_qr_code']) && $siteSettings['charity_qr_code'])
                            <a href="{{ asset('storage/' . $siteSettings['charity_qr_code']) }}" download class="inline-block mt-4 text-brand-primary hover:text-white transition-colors text-sm font-bold">
                                <i class="fas fa-download mr-1"></i> Download QR Code
                            </a>
                        @else
                            <a href="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa={{ urlencode($siteSettings['charity_upi_id'] ?? 'helpfund@upi') }}&pn={{ urlencode($siteSettings['charity_account_name'] ?? 'Shaurya Foundation') }}" download class="inline-block mt-4 text-brand-primary hover:text-white transition-colors text-sm font-bold">
                                <i class="fas fa-download mr-1"></i> Download QR Code
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Submit Details Form -->
                <div>
                    <h4 class="text-xl font-bold text-white mb-6">Submit Donation Details</h4>
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
                    " class="space-y-4">
                        <div>
                            <label class="block text-gray-400 text-sm font-bold mb-2">Full Name</label>
                            <input type="text" name="name" required class="w-full bg-brand-dark border border-brand-border rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-primary transition-colors">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm font-bold mb-2">Email Address <span class="font-normal text-xs">(For Receipt)</span></label>
                            <input type="email" name="email" required class="w-full bg-brand-dark border border-brand-border rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-primary transition-colors">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm font-bold mb-2">Donation Amount (₹)</label>
                            <input type="number" name="amount" min="1" required class="w-full bg-brand-dark border border-brand-border rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-primary transition-colors">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm font-bold mb-2">Transaction ID / UTR No.</label>
                            <input type="text" name="transaction_id" required class="w-full bg-brand-dark border border-brand-border rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-primary transition-colors" placeholder="e.g. 123456789012">
                        </div>
                        <button type="submit" :disabled="isSubmitting" class="w-full bg-gradient-to-r from-brand-primary to-brand-accent text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-brand-primary/50 transition-all disabled:opacity-50 mt-4">
                            <span x-show="!isSubmitting"><i class="fas fa-paper-plane mr-2"></i> Submit & Get Receipt</span>
                            <span x-show="isSubmitting"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
