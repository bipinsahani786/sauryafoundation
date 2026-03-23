<x-frontend.layout>
    <x-slot name="title">Member Login | Shaurya Syndicate</x-slot>

    <div class="relative min-h-[85vh] flex items-center justify-center pt-24 pb-12 px-4 overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-1/4 -left-20 w-[300px] h-[300px] bg-brand-primary rounded-full mix-blend-multiply blur-[100px] opacity-10 animate-blob"></div>
        <div class="absolute bottom-1/4 -right-20 w-[300px] h-[300px] bg-brand-accent rounded-full mix-blend-multiply blur-[100px] opacity-10 animate-blob" style="animation-delay: 3s;"></div>

        <div class="max-w-sm w-full relative z-10" data-aos="zoom-in">
            <div class="glass-card p-8 rounded-[2.5rem] border-brand-primary/20 shadow-2xl">
                <div class="text-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-brand-primary to-brand-accent rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg rotate-3">
                        <i class="fas fa-fingerprint text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-white mb-1 tracking-tighter">Member Login</h2>
                    <p class="text-gray-500 font-bold uppercase tracking-[0.2em] text-[8px]">Syndicate Terminal Access</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-brand-primary uppercase tracking-[0.2em] ml-2">Credential ID</label>
                        <div class="relative group">
                            <i class="fas fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-brand-primary transition-colors text-[10px]"></i>
                            <input type="email" name="email" placeholder="email@shaurya.in" class="w-full bg-brand-dark/50 border border-brand-border rounded-full pl-10 pr-4 py-3 text-white placeholder:text-gray-700 focus:border-brand-primary outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-black text-brand-primary uppercase tracking-[0.2em] ml-2">Security Key</label>
                        <div class="relative group">
                            <i class="fas fa-key absolute left-4 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-brand-accent transition-colors text-[10px]"></i>
                            <input type="password" name="password" placeholder="••••••••" class="w-full bg-brand-dark/50 border border-brand-border rounded-full pl-10 pr-4 py-3 text-white placeholder:text-gray-700 focus:border-brand-accent outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-primary to-brand-accent text-white font-black py-3.5 rounded-full text-xs uppercase tracking-widest hover:scale-[1.02] active:scale-95 transition-all shadow-[0_10px_30px_rgba(14,165,233,0.3)]">
                            Initiate Access <i class="fas fa-bolt ml-1"></i>
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <p class="text-gray-600 text-[9px] font-bold uppercase tracking-widest">
                            New Member? <a href="{{ route('register') }}" class="text-white hover:text-brand-accent transition-colors underline decoration-brand-accent underline-offset-4 ml-1">Register Now</a>
                        </p>
                    </div>
                </form>
            </div>
            
            <p class="text-center mt-8 text-[8px] text-gray-700 uppercase tracking-[0.4em] font-black">Encrypted Channel Secure</p>
        </div>
    </div>
</x-frontend.layout>
